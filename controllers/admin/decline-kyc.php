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
        // Updating KYC record
        $sql = "UPDATE kycs SET passport = :passport, id_type = :id_type, id_number = :id_number, id_upload = :id_upload, status = :status WHERE id = :id LIMIT 1";
        query_db($sql, ['passport'=> null, 'id_type'=> null, 'id_number'=> null, 'id_upoad'=> null, 'status'=> "declined", 'id'=> $kyc_id]);
        // Notifying user of KYC decline
        notify_user($matched_kycs[0]['user_id'], "Sorry.. Your KYC application was declined");
        // Redirecting..
        redirect("kycs", "KYC application successfully declined", "success");
    }
    redirect("kycs", "Invalid KYC", 'danger');
}