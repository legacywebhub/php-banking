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
        $loan = $matched_loans[0];
        $duration_in_days = $loan['duration_in_months']*30;
        // Calculating approved and end date of loan
        $now = new DateTime('now', new DateTimeZone('UTC'));
        $approved_date = $now->format('Y-m-d H:i:s');
        $end_date = $now->modify("+$duration_in_days days");
        $end_date = $end_date->format('Y-m-d H:i:s');
        // Updating loan record
        $sql = "UPDATE loans SET status = :status, approved_date = :approved_date, end_date = :end_date WHERE loan_id = :loan_id LIMIT 1";
        query_db($sql, ['status'=> "active", 'approved_date'=> $approved_date, 'end_date'=> $end_date, 'loan_id'=> $loan_id]);
        // Crediting user account
        update_account($loan['user_id'], 'balance', 'credit', $loan['amount']);
        // Notifying user of loan approval
        notify_user($loan['user_id'], "Congrats.. Your loan application was successfully approved");
        // Redirecting..
        redirect("loans", "Loan application successfully approved", "success");
    }
    redirect("loans", "Invalid Loan", 'danger');
}