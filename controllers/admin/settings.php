<?php

// Authorizing admin
$admin = admin_logged_in();

// Other variables
$settings = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1");
$title = ucfirst($settings[0]['name'])." | Settings";


$context = [
    'setting'=> $settings[0],
    'title'=> $title,
    'admin'=> $admin,
    'settings'=> $settings,
];

admin_view('settings', $context);