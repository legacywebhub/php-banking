<?php

// Authorizing user
$user = user_logged_in();
$user_id = intval($user['id']);

// Other variables
$setting = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($setting['name'])." | Fund Account";
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

    // Declaring database variables for user as PHP array
    $data = [
        'user_id' => $user_id,
        'payment_id' => generate_unique_id(7),
        'amount' => sanitize_input($data['amount']),
        'purpose' => sanitize_input($data['purpose']),
        'method' => sanitize_input($data['method']),
    ];

    try {
        // Making a query to insert payment details into the database
        $sql = "INSERT INTO payments (user_id, payment_id, amount, purpose, method) VALUES (:user_id, :payment_id, :amount, :purpose, :method)";
        $payment_id = intval(query_return_id($sql, $data));
        return_json(['status'=>"success", 'payment_url'=>"complete-funding?payment_id=".$data['payment_id']]);
    } catch(Exception $e) {
        return_json(['status'=>"failed", 'message'=>"An error occured: $e"]);
    }

}

// Generating CSRF Token
$csrf_token = generate_csrf_token();

$context = [
    'setting'=> $setting, 
    'title'=> $title,
    'user'=> $user,
    'recent_notifications'=> $recent_notifications,
];

account_view('fund-account', $context);