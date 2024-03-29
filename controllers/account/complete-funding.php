<?php

// Authorizing user
$user = user_logged_in();
$user_id = intval($user['id']);

// Other variables
$setting = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($setting['name'])." | Complete Funding";
$recent_notifications = query_fetch("SELECT * FROM notifications WHERE user_id = $user_id ORDER BY id DESC LIMIT 0,10");

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

            $payment += [
                'payment_network'=> $payment['method']=="usdt" ? "TRC20" : "BTC",
                'payment_address'=> $payment['method']=="usdt" ? $setting['usdt_address'] : $setting['bitcoin_address']
            ];
        }
    } catch (Exception) {
        redirect("fund-account");
    }
}


// Handling register request
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
    
    // Variables
    $proof = upload_image($_FILES['payment_proof'], 'images/payments');

    // Validation
    if ($proof['status'] != "success") {
        redirect("complete-funding?payment_id=$payment_id", 'Invalid file type or size', 'danger');
    }
    
    try {
        // Making a query to update payment in the database
        $sql = "UPDATE payments SET proof = :proof WHERE payment_id = :payment_id LIMIT 1";
        query_db($sql, ['payment_id' => $payment_id, 'proof' => $proof['new_file_name']]);
        redirect("payment-history", 'Payment is now processing', 'success');
    } catch(Exception) {
        redirect("complete-funding?payment_id=$payment_id", 'An error occured please contact support', 'danger');
    }

}

// Generating CSRF Token
$csrf_token = generate_csrf_token();

$context = [
    'setting'=> $setting, 
    'title'=> $title,
    'user'=> $user,
    'recent_notifications'=> $recent_notifications,
    'payment'=> $payment,
];

account_view('complete-funding', $context);