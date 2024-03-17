<?php

// Authorizing user
$user = user_logged_in();
$user_id = intval($user['id']);

// Other variables
$setting = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($setting['name'])." | Notifications";
$recent_notifications = query_fetch("SELECT * FROM notifications WHERE user_id = $user_id ORDER BY id DESC LIMIT 0,10");
$notifications = paginate("SELECT * FROM notifications WHERE user_id = $user_id ORDER BY id DESC", 20);

// Handling incoming AJAX request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get JSON data from the request body
    $json_data = file_get_contents("php://input");
    // Parse the JSON data into PHP array
    $data = json_decode($json_data, true);
    // Process data here
    try {
        query_db("DELETE FROM notifications WHERE id = :id LIMIT 1", ['id'=>intval(sanitize_input($data['id']))]);
        return_json(['status'=> "success"]);
    } catch(Exception $e) {
        return_json(['status'=> "failed"]);
    }
}

$context = [
    'setting'=> $setting, 
    'title'=> $title,
    'user'=> $user,
    'recent_notifications'=> $recent_notifications,
    'notifications'=> $notifications
];

account_view('notifications', $context);