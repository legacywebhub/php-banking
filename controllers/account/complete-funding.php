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
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
    
    // Variables
    $proof = upload_image($_FILES['proof'], 'images/payments');

    // Validation
    if ($proof['status'] != "success") {
        // Send response as JSON
        return_json(['status'=>"failed", 'message'=>"Invalid file type or size"]);
    }
    
    try {
        // Making a query to update payment in the database
        $sql = "UPDATE payments SET proof = :proof, WHERE payment_id = :payment_id LIMIT 1";
        query_db($sql, ['payment_id' => $payment_id, 'proof' => $proof['new_file_name']]);
        return_json(['status'=> "success", 'message'=> "Payment was successful and pending"]);
    } catch(Exception) {
        return_json(['status'=> "failed", 'message'=> "An error occured"]);
    }

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