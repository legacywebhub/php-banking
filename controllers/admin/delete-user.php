<?php

// Authorizing admin
$admin = admin_logged_in();

// Redirecting user if id not provided
if (!isset($_GET['id'])) {
    redirect("users");
} else {
    // Authorizing action
    if ($admin['is_superuser'] == 0) {
        redirect("users", "Sorry.. you don't have such privilege", 'danger');
    }

    // Getting id
    $user_id = intval(sanitize_input($_GET['id']));
    //  Checking for matching users
    $matched_users = query_fetch("SELECT * FROM users WHERE id = $user_id LIMIT 1");

    if (!empty($matched_users)) {
        // Deleting user finally from database
        query_fetch("DELETE FROM users WHERE id = $user_id LIMIT 1");
        // Deleting user kyc from database
        query_fetch("DELETE FROM kycs WHERE user_id = $user_id LIMIT 1");
        // Deleting user virtual card from database
        query_fetch("DELETE FROM virtual_cards WHERE user_id = $user_id LIMIT 1");
        // Redirecting...
        redirect("users", "User successfully deleted", "success");
    }
    redirect("users", "Invalid user", 'danger');
}

