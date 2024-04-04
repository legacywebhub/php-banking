<?php

// Authorizing admin
$admin = admin_logged_in();

// Redirecting if loan id not provided
if (!isset($_GET['loan_id'])) {
    redirect("loans");
} else {
    // Getting loan id
    $loan_id = sanitize_input($_GET['loan_id']);
    //  Checking for matching loans
    $matched_loans = query_fetch("SELECT * FROM loans WHERE loan_id = '$loan_id' LIMIT 1");

    if (!empty($matched_loans)) {
        // Updating loan record
        $sql = "UPDATE loans SET status = :status WHERE loan_id = :loan_id LIMIT 1";
        query_db($sql, ['status'=> "declined", 'loan_id'=> $loan_id]);
        // Notifying user of loan approval
        notify_user($loan['user_id'], "Sorry.. Your loan application was declined");
        // Redirecting..
        redirect("loans", "Loan was declined", "success");
    }
    redirect("loans", "Invalid Loan", 'danger');
}