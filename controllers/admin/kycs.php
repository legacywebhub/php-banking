<?php

// Authenticating user
$admin = admin_logged_in();

// Variables
$setting = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($setting['name'])." | KYCs";

if (isset($_GET['search'])) {
    $search = sanitize_input($_GET['search']);
    $kycs = paginate("SELECT * FROM kycs WHERE user_id = $search ORDER BY id DESC", 15);
} else {
    $kycs = paginate("SELECT * FROM kycs ORDER BY id DESC", 15);
}

$context = [
    'setting'=> $setting,
    'title'=> $title,
    'admin'=> $admin,
    'kycs'=> $kycs,
];

admin_view('kycs', $context);