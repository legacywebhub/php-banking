<?php

// Authorizing user
$user = user_logged_in();
$user_id = intval($user['id']);

// Other variables
$setting = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($setting['name'])." | Update Pasword";
$recent_notifications = query_fetch("SELECT * FROM notifications WHERE user_id = $user_id ORDER BY id DESC LIMIT 0,10");

// Handling password update request
if ($_SERVER["REQUEST_METHOD"]=="POST") {
    // Get JSON data from the request body
    $json_data = file_get_contents("php://input");
    // Parse the JSON data into PHP array
    $data = json_decode($json_data, true);
    // Checking for csrf attack
    if ($data['csrf_token'] != $_SESSION['csrf_token']) {
        // Send response as JSON
        echo json_encode(['status'=>"failed", 'message'=>"Invalid request"]);
        die();
    }
    // Validating
    if (!password_verify($data['old_password'], $user['password'])) {
        echo json_encode(['status'=>"failed", 'message'=>"Old password is incorrect"]);
        die();
    } else if (empty($data['password1']) || empty($data['password2'])) {
        echo json_encode(['status'=>"failed", 'message'=>"Passwords cannot be empty"]);
        die();
    } else if ($data['password1'] != $data['password2']) {
        echo json_encode(['status'=>"failed", 'message'=>"Passwords do not match"]);
        die();
    }

    try {
        // Making a query to update user details into the database
        query_db("UPDATE users SET password = :password WHERE id = :id LIMIT 1", ['password'=>password_hash($data['password2'], PASSWORD_DEFAULT), 'id'=>$user_id]);
        echo json_encode(['status'=>"success", 'message'=>"Password successfully updated"]);
        die();
    } catch(Exception $e) {
        echo json_encode(['status'=>"failed", 'message'=>"Service is temporarily down"]);
        die();
    }

}

// Generating CSRF Token
$csrf_token = generate_csrf_token();

$context = [
    'setting'=> $setting, 
    'title'=> $title,
    'user'=> $user,
    'recent_notifications'=> $recent_notifications,
];

account_view('update-password', $context);