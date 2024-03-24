<?php

// Authorizing admin
$admin = admin_logged_in();
$admin_id = $admin['id'];

// Redirecting user if id not provided
if (!isset($_GET['id'])) {
    redirect("users");
}

// Getting id
$id = intval($_GET['id']);
//  Checking for matching users
$matched_users = query_fetch("SELECT * FROM users WHERE id = $id LIMIT 1");

if (!empty($matched_users)) {
    $user = $matched_users[0];
    // Block user
    query_db("UPDATE users SET is_blocked = 1 WHERE id = $id");
    redirect("users", "User successfully blocked", "success");
}
redirect("users", "Invalid user", "danger");