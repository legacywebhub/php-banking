<?php

// Authorizing user
$user = user_logged_in();
$user_id = $user['id'];

// Deleting old notifications
//delete_old_notifications($user_id);

// Variables
$setting = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($setting['name'])." | Support";
$recent_notifications = query_fetch("SELECT * FROM notifications WHERE user_id = $user_id ORDER BY id DESC LIMIT 0,3");

// Handling incoming AJAX request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get JSON data from the request body
    $json_data = file_get_contents("php://input");
    // Parse the JSON data into PHP array
    $data = json_decode($json_data, true);
    // Checking for csrf attack
    if ($data['csrf_token'] != $_SESSION['csrf_token']) {
        // Send response as JSON
        return_json(['status'=>"failed", 'message'=>"Invalid request"]);
    }
    // Process data here
    $data = [
        'name' => $user['fullname'], 'email' => $user['email'],
        'subject' => "Support", 'message' => sanitize_input($data['message'])
    ];

    try {
        $sql = "INSERT INTO messages (name, email, subject, message) VALUES (:name, :email, :subject, :message)";
        $query = query_db($sql, $data);
        // Trying to send mail
        sendMail($setting['email'], "Support", ['name'=>$user['fullname'], 'message'=>$data['message']]);
        // Return success response
        return_json(['status'=>"success", 'message'=>"Message successfully received"]);
    } catch(Exception $e) {
        // Return failure response
        return_json(['status'=>"failed", 'message'=>"Service unavailable at the moment"]);
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

account_view('support', $context);