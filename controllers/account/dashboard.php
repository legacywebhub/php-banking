<?php

// Authorizing user
$user = user_logged_in();
$user_id = intval($user['id']);

// Other variables
$setting = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($setting['name'])." | Dashboard";
$recent_notifications = query_fetch("SELECT * FROM notifications WHERE user_id = $user_id ORDER BY id DESC LIMIT 0,10");
$recent_transactions = query_fetch("SELECT * FROM transactions WHERE from_user = $user_id ORDER BY id DESC LIMIT 0,10");
$recent_payments = query_fetch("SELECT * FROM payments WHERE user_id = $user_id ORDER BY id DESC LIMIT 0,10");


$context = [
    'setting'=> $setting, 
    'title'=> $title,
    'user'=> $user,
    'recent_notifications'=> $recent_notifications,
    'recent_transactions'=> $recent_transactions,
    'recent_payments'=> $recent_payments,
];

account_view('dashboard', $context);