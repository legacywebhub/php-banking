<?php

// Authenticating user
$admin = admin_logged_in();

// Other variables
$setting = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($setting['name'])." | kyc";

// Authenticating view
if (!isset($_GET['id'])) {
    // Redirect if no kyc id passed
    redirect("kycs");
} else {
    try {
        $kyc_id = intval(sanitize_input($_GET['id']));
        $matched_kycs = query_fetch("SELECT * FROM kycs WHERE id = $kyc_id LIMIT 1");

        if (empty($matched_kycs)) {
            // Redirect if no matched kyc
            redirect("kycs");
        } else {
            // Else return kyc
            $kyc = $matched_kycs[0];
            $user = fetch_user($kyc['user_id']);
        }
    } catch (Exception) {
        redirect("kycs");
    }
}

$context = [
    'setting'=> $setting,
    'title'=> $title,
    'admin'=> $admin,
    'kyc'=> $kyc,
    'user'=> $user
];

admin_view('kyc', $context);