<?php

// Authorizing user
$user = user_logged_in();
$user_id = intval($user['id']);

// Other variables
$setting = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($setting['name'])." | Transactions";
$recent_notifications = query_fetch("SELECT * FROM notifications WHERE user_id = $user_id ORDER BY id DESC LIMIT 0,10");
$transactions = paginate("
(
    SELECT * FROM transactions
    WHERE from_user = $user_id
    ORDER BY date DESC
    LIMIT 5
)
UNION
(
    SELECT * FROM transactions
    WHERE to_user = $user_id
    ORDER BY date DESC
    LIMIT 5
)
ORDER BY date DESC
LIMIT 5;
", 20);


$context = [
    'setting'=> $setting, 
    'title'=> $title,
    'user'=> $user,
    'recent_notifications'=> $recent_notifications,
    'transactions'=> $transactions,
];

account_view('transactions', $context);