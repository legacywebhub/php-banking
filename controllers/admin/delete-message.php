<?php

// Authorizing admin
$admin = admin_logged_in();

// Redirecting if message id not provided
if (!isset($_GET['id'])) {
    redirect("messages");
}

// Getting id
$id = intval(sanitize_input($_GET['id']));
//  Checking for matching messages
$matched_messages = query_fetch("SELECT * FROM messages WHERE id = $id LIMIT 1");

if (!empty($matched_messages)) {
    // Deleting message finally from database
    query_fetch("DELETE FROM messages WHERE id = $id");
    redirect("messages", "Message successfully deleted", "success");
}
redirect("messages", "Invalid message", "danger");