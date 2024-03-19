<?php

// Authenticating user
$admin = admin_logged_in();

// Variables
$setting = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($setting['name'])." | Virtual Cards";
$virtual_cards = paginate("SELECT * FROM virtual_cards ORDER BY id DESC", 10);

$context = [
    'setting'=> $setting,
    'title'=> $title,
    'admin'=> $admin,
    'virtual_cards'=> $virtual_cards,
];

admin_view('virtual-cards', $context);