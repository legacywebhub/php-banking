<?php

// Authorizing user
$user = user_logged_in();
$user_id = intval($user['id']);

// Other variables
$setting = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($setting['name'])." | Internal Transfer";
$recent_notifications = query_fetch("SELECT * FROM notifications WHERE user_id = $user_id ORDER BY id DESC LIMIT 0,10");

// Handling fund account request
if ($_SERVER["REQUEST_METHOD"]=="POST") {
    // Get JSON data from the request body
    $json_data = file_get_contents("php://input");
    // Parse the JSON data into PHP array
    $data = json_decode($json_data, true);
    // Checking for csrf attack
    if ($data['csrf_token'] != $_SESSION['csrf_token']) {
        // Send response as JSON
        echo json_encode(['status'=>"failed", 'message'=>"Invalid request"]);
        die();
    }
    // Transfer variables
    $account = sanitize_input($data['account']);
    $amount = intval(sanitize_input($data['amount']));
    $receiver_account_number = sanitize_input($data['account_number']);
    $remark = sanitize_input($data['remark']);
    $pin = sanitize_input($data['pin']);

    if ($pin == $user['pin']) {
        $feedback = perform_internal_transfer($user_id, $account, $receiver_account_number, $amount, $remark);
        
        if ($feedback['status']=="success") {
            // Refetching user to get updated values
            $refreshed_user = query_fetch("SELECT * FROM users WHERE id = $user_id LIMIT 1")[0];
            // Append to feedback array
            $feedback += [
                'new_balance'=> $refreshed_user['balance'],
                'new_overdraft'=> $refreshed_user['overdraft'],
            ];
        }

    } else {
        $feedback = ['status'=>"failed", 'message'=>"Invalid Pin"];
    }

    echo json_encode($feedback);
    die();

}

// Generating CSRF Token
$csrf_token = generate_csrf_token();

$context = [
    'setting'=> $setting, 
    'title'=> $title,
    'user'=> $user,
    'recent_notifications'=> $recent_notifications,
];

account_view('internal-transfer', $context);