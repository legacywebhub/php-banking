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
        return_json(['status'=>"failed", 'message'=>"Invalid request"]);
    }
    // Transfer variables
    $account = strval(sanitize_input($data['account']));
    $amount = floatval(sanitize_input($data['amount']));
    $receiver_account_number = strval(sanitize_input($data['account_number']));
    $remark = sanitize_input($data['remark']);
    $pin = sanitize_input($data['pin']);

    if ($pin == $user['pin']) {
        // Fetching receiver
        $receiver = query_fetch("SELECT * FROM users WHERE account_number = $receiver_account_number LIMIT 1")[0];

        // Cheking if account number is valid or tied to a user
        if (!empty($receiver)) {
            $transfer_details = perform_internal_transfer($user, $account, $receiver, $amount, $remark);
        
            if ($transfer_details['status']=="success") {
                // Refetching user to get updated account details
                $refreshed_user = query_fetch("SELECT * FROM users WHERE id = $user_id LIMIT 1")[0];
                // Append to transfer_details array
                $transfer_details += [
                    'new_balance'=> $refreshed_user['balance'],
                    'new_overdraft'=> $refreshed_user['overdraft'],
                ];
            }
        } else {
            $transfer_details = ['status'=>"failed", 'message'=>"Invalid account number"];
        }

    } else {
        $transfer_details = ['status'=>"failed", 'message'=>"Invalid Pin"];
    }

    return_json($transfer_details);

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