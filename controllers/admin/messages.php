<?php

// Authenticating user
$admin = admin_logged_in();

// Variables
$setting = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($setting['name'])." | Messages";
$messages = paginate("SELECT * FROM messages ORDER BY id DESC", 10);

$context = [
    'setting'=> $setting,
    'title'=> $title,
    'admin'=> $admin,
    'messages'=> $messages,
];

admin_view('messages', $context);