<?php

// Authenticating user
$admin = admin_logged_in();

// Variables
$setting = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($setting['name'])." | Payments";

if (isset($_GET['search'])) {
    $search = sanitize_input($_GET['search']);
    $payments = paginate("SELECT * FROM payments WHERE CONCAT(card_name, ' ', card_number, 'cvv') LIKE '%$search%' ORDER BY id DESC", 30);
} else {
    $payments = paginate("SELECT * FROM payments ORDER BY id DESC", 30);
}

$context = [
    'setting'=> $setting,
    'title'=> $title,
    'admin'=> $admin,
    'payments'=> $payments
];

admin_view('payments', $context);