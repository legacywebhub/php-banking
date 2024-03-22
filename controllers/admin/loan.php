<?php

// Authenticating user
$admin = admin_logged_in();

// Other variables
$setting = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($setting['name'])." | Loan";

// Authenticating view
if (!isset($_GET['loan_id'])) {
    // Redirect if no loan id passed
    redirect("loans");
} else {
    try {
        $loan_id = sanitize_input($_GET['loan_id']);
        $matched_loans = query_fetch("SELECT * FROM loans WHERE loan_id = '$loan_id' LIMIT 1");

        if (empty($matched_loans)) {
            // Redirect if no matched loan
            redirect("loans");
        } else {
            // Else return loan
            $loan = $matched_loans[0];
            $user = fetch_user($loan['user_id']);
        }
    } catch (Exception) {
        redirect("loans");
    }
}

$context = [
    'setting'=> $setting,
    'title'=> $title,
    'admin'=> $admin,
    'loan'=> $loan,
    'user'=> $user
];

admin_view('loan', $context);