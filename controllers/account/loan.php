<?php

// Authorizing user
$user = user_logged_in();
$user_id = intval($user['id']);

// Authenticating view
if (!isset($_GET['loan_id'])) {
    // Redirect if no loan id passed
    redirect("loans");
} else {
    try {
        $loan_id = sanitize_input($_GET['loan_id']);
        $matched_loans = query_fetch("SELECT * FROM loans WHERE loan_id = '$loan_id' LIMIT 1");

        if (empty($matched_loans)) {
            // Redirect if no matching loans
            redirect("loans");
        } else {
            // Else return loan
            $loan = $matched_loans[0];
        }
    } catch (Exception) {
        redirect("loans");
    }
}

// Other variables
$setting = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($setting['name'])." | Loan";
$recent_notifications = query_fetch("SELECT * FROM notifications WHERE user_id = $user_id ORDER BY id DESC LIMIT 0,10");

$context = [
    'setting'=> $setting, 
    'title'=> $title,
    'user'=> $user,
    'recent_notifications'=> $recent_notifications,
    'loan'=> $loan
];

account_view('loan', $context);