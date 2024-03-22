<?php

// Authenticating user
$admin = admin_logged_in();

// Variables
$setting = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($setting['name'])." | Loans";

if (isset($_GET['search'])) {
    $search = sanitize_input($_GET['search']);
    $loans = paginate("SELECT * FROM loans WHERE loan_id = $search ORDER BY id DESC", 15);
} else {
    $loans = paginate("SELECT * FROM loans ORDER BY id DESC", 15);
}


$context = [
    'setting'=> $setting,
    'title'=> $title,
    'admin'=> $admin,
    'loans'=> $loans
];

admin_view('loans', $context);