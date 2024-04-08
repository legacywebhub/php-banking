<?php

// Authorizing admin
$admin = admin_logged_in();

// Redirecting user if id not provided
if (!isset($_GET['id'])) {
    redirect("kycs");
} else {
    // Getting kyc id
    $kyc_id = intval(sanitize_input($_GET['id']));
    //  Checking for matching kycs
    $matched_kycs = query_fetch("SELECT * FROM kycs WHERE id = $kyc_id LIMIT 1");

    if (!empty($matched_kycs)) {
        $now = new DateTime('now', new DateTimeZone('UTC'));
        $approved_date = $now->format('Y-m-d H:i:s');
        // Updating KYC record
        $sql = "UPDATE kycs SET status = :status, approved_date = :approved_date WHERE id = :id LIMIT 1";
        query_db($sql, ['status'=> "approved", 'approved_date'=> $approved_date, 'id'=> $kyc_id]);
        // Notifying user of KYC approval
        notify_user($matched_kycs[0]['user_id'], "Congrats.. Your KYC application was successfully approved");
        // Redirecting..
        redirect("kycs", "KYC application successfully approved", "success");
    }
    redirect("kycs", "Invalid KYC", 'danger');
}