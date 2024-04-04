<?php

// Authorizing admin
$admin = admin_logged_in();

// Other variables
$setting = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($setting['name'])." | Notifications";
$notifications = paginate("SELECT * FROM notifications ORDER BY id DESC", 20);


$context = [
    'setting'=> $setting,
    'title'=> $title,
    'admin'=> $admin,
    'notifications'=> $notifications,
];

admin_view('notifications', $context);