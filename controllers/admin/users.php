<?php

// Authorizing user
$admin = admin_logged_in();

// View variables
$setting = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($setting['name'])." | Users";

if (isset($_GET['search'])) {
    $search = sanitize_input($_GET['search']);
    $users = paginate("SELECT * FROM users WHERE CONCAT(firstname, ' ', lastname) LIKE '%$search%' ORDER BY id DESC", 15);
} else {
    $users = paginate("SELECT * FROM users ORDER BY id DESC", 15);
}

$context = [
    'setting'=> $setting,
    'title'=> $title,
    'admin'=> $admin,
    'users'=> $users,
];

admin_view('users', $context);