<?php

// Authorizing user
$user = user_logged_in();
$user_id = intval($user['id']);

// Authenticating view
if (!isset($_GET['transaction_id'])) {
    // Redirect if no transaction id passed
    redirect("transactions");
} else {
    try {
        $transaction_id = sanitize_input($_GET['transaction_id']);
        $matched_transactions = query_fetch("SELECT * FROM transactions WHERE transaction_id = '$transaction_id' LIMIT 1");

        if (empty($matched_transactions)) {
            // Redirect if no matching transactions
            redirect("transactions");
        } else {
            // Else return transaction
            $transaction = $matched_transactions[0];
        }
    } catch (Exception) {
        redirect("transactions");
    }
}

// Other variables
$setting = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($setting['name'])." | Transaction";
$recent_notifications = query_fetch("SELECT * FROM notifications WHERE user_id = $user_id ORDER BY id DESC LIMIT 0,10");

$context = [
    'setting'=> $setting, 
    'title'=> $title,
    'user'=> $user,
    'recent_notifications'=> $recent_notifications,
    'transaction'=> $transaction
];

account_view('transaction', $context);