<?php

// Authorizing user
$user = user_logged_in();
$user_id = intval($user['id']);

// Authenticating view
if (!isset($_GET['payment_id'])) {
    // Redirect if no payment id passed
    redirect("fund-account");
} else {
    try {
        $payment_id = sanitize_input($_GET['payment_id']);
        $matched_payments = query_fetch("SELECT * FROM payments WHERE payment_id = '$payment_id' LIMIT 1");

        if (empty($matched_payments)) {
            // Redirect if no matching payments
            redirect("fund-account");
        } else {
            // Else return payment
            $payment = $matched_payments[0];
        }
    } catch (Exception) {
        redirect("fund-account");
    }
}

// Other variables
$setting = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($setting['name'])." | Complete Funding";
$recent_notifications = query_fetch("SELECT * FROM notifications WHERE user_id = $user_id ORDER BY id DESC LIMIT 0,10");

// Handling register request
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

    // Nothing Yet

}

// Generating CSRF Token
$csrf_token = generate_csrf_token();

$context = [
    'setting'=> $setting, 
    'title'=> $title,
    'user'=> $user,
    'recent_notifications'=> $recent_notifications,
    'payment'=> $payment
];

account_view('complete-funding', $context);