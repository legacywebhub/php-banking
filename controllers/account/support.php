<?php

// Authorizing user
$user = user_logged_in();
$user_id = $user['id'];

// Deleting old notifications
delete_old_notifications($user_id);

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
        echo json_encode(['status'=>"failed", 'message'=>"Invalid request"]);
        die();
    }
    // Process data here
    $support_data = [
        'name' => $user['fullname'], 'email' => $user['email'],
        'subject' => "Support", 'message' => sanitize_input($data['message'])
    ];

    try {
        $sql = "INSERT INTO messages (name, email, subject, message) VALUES (:name, :email, :subject, :message)";
        $query = query_db($sql, $support_data);
        sendMail($support_data['email'], $setting['email'], "Support", $support_data['message']);
        return_json(['status'=>"success"]);
    } catch(Exception $e) {
        return_json(['status'=>"failed"]);
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