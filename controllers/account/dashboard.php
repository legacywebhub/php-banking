<?php

// Authorizing user
//$user = logged_in();
//$user_id = $user['id'];

// Other variables
$setting = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($setting['name'])." | Dashboard";
//$recent_notifications = query_fetch("SELECT * FROM notifications WHERE user_id = $user_id ORDER BY id DESC LIMIT 0,3");


// Generating CSRF Token
$csrf_token = generate_csrf_token();

$context = [
    'setting'=> $setting,
    'title'=> $title,
    //'user'=> $user,
    //'recent_notifications'=> 
    $recent_notifications,
];

account_view('dashboard', $context);