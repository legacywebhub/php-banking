<?php

// Authorizing admin
$admin = admin_logged_in();

// Redirecting user if id not provided
if (!isset($_GET['payment_id'])) {
    redirect("payments");
} else {
    // Getting payment id
    $payment_id = sanitize_input($_GET['payment_id']);
    //  Checking for matching payment
    $matched_payments = query_fetch("SELECT * FROM payments WHERE payment_id = '$payment_id' LIMIT 1");

    if (!empty($matched_payments)) {
        $payment = $matched_payments[0];

        try {
            // Attempting to delete payment proof
            $filename = MEDIA_PATH . "images/payments/". $payment['proof'];
            if (file_exists($filename)) {
                // Deleting proof image associated to payment
                unlink($filename);
            }
            // Deleting payment finally from database
            query_fetch("DELETE FROM payments WHERE payment_id = $payment_id");
        } catch(Exception) {
            redirect("payments", "An error occured", 'danger');
        }
        // Redirecting..
        redirect("payments", "Payment successfully deleted", "success");
    }
    redirect("payments", "Invalid Payment ID", 'danger');
}