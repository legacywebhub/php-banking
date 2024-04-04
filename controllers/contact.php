<?php

$setting = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
$title = $setting['name'] . " | Contact Us";

// Handling incoming AJAX request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get JSON data from the request body
    $json_data = file_get_contents("php://input");
    // Parse the JSON data into PHP array
    $data = json_decode($json_data, true);
    // Checking for csrf attack
    if ($data['csrf_token'] != $_SESSION['csrf_token']) {
        // Send response as JSON
        return_json(['status'=> "failed", 'message'=> "Invalid request"]);
    }
    // Process data here
    $data = [
        'name'=> sanitize_input($data['name']),
        'email'=> sanitize_input($data['email']),
        'subject'=> sanitize_input($data['subject']),
        'message'=> sanitize_input($data['message'])
    ];
    try {
        $sql = "INSERT INTO messages (name, email, subject, message) VALUES (:name, :email, :subject, :message)";
        query_db($sql, $data);
        // Notifying Admin
        $email_values = ['name'=> "Admin", 'message'=> $data['message']];
        sendMail($setting['email'], "Contact Message", $email_values);
        $response = ['status'=> "success", 'message'=> "Message was successfully received"];
    } catch(Exception $e) {
        $response = ['status'=> "failed", 'message'=> "Service unavailable at the moment"];
    }
    // Send response as JSON
    return_json($response);
}

// Generating CSRF Token
$csrf_token = generate_csrf_token();

$context = [
    'setting'=> $setting,
    'title'=> $title,
];

landing_view('contact', $context);