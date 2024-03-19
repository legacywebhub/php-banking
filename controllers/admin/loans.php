<?php

// Authenticating user
$admin = admin_logged_in();

// Variables
$setting = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($setting['name'])." | Loans";
$loans = paginate("SELECT * FROM loans ORDER BY id DESC", 10);

$context = [
    'setting'=> $setting,
    'title'=> $title,
    'admin'=> $admin,
    'loans'=> $loans,
];

admin_view('loans', $context);