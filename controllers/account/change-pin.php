<?php

// Authorizing user
$user = user_logged_in();
$user_id = intval($user['id']);

// Other variables
$setting = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($setting['name'])." | Change Pin";
$recent_notifications = query_fetch("SELECT * FROM notifications WHERE user_id = $user_id ORDER BY id DESC LIMIT 0,10");

// Handling pin update request
if ($_SERVER["REQUEST_METHOD"]=="POST") {
    // Get JSON data from the request body
    $json_data = file_get_contents("php://input");
    // Parse the JSON data into PHP array
    $data = json_decode($json_data, true);
    // Checking for csrf attack
    if ($data['csrf_token'] != $_SESSION['csrf_token']) {
        // Send response as JSON
        return_json(['status'=>"failed", 'message'=>"Invalid request"]);
    }

    try {
        // Making a query to update user details into the database
        query_db("UPDATE users SET pin = :pin WHERE id = :id LIMIT 1", ['pin'=>sanitize_input($data['new_pin']), 'id'=>$user_id]);
        // Checking if user has a virtual card to update pin too
        // Hence card isnot independent of user account, just an extension
        if ($user['has_virtual_card']) {
            query_db("UPDATE virtual_cards SET card_pin = :card_pin WHERE user_id = :user_id LIMIT 1", 
            ['card_pin'=> sanitize_input($data['new_pin']), 'user_id'=> $user_id]);
        }
        return_json(['status'=>"success", 'message'=>"Pin successfully updated"]);
    } catch(Exception $e) {
        return_json(['status'=>"failed", 'message'=>"Service is temporarily down"]);
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

account_view('change-pin', $context);