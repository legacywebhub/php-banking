<?php

// Authenticating user
$admin = admin_logged_in();

// Variables
$setting = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($setting['name'])." | Transactions";

if (isset($_GET['search'])) {
    $search = sanitize_input($_GET['search']);
    $transactions = paginate("SELECT * FROM transactions WHERE transaction_id = '$search' ORDER BY id DESC", 30);
} else {
    $transactions = paginate("SELECT * FROM transactions ORDER BY id DESC", 30);
}

$context = [
    'setting'=> $setting,
    'title'=> $title,
    'admin'=> $admin,
    'transactions'=> $transactions
];

admin_view('transactions', $context);