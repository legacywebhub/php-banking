<?php

// Authorizing user
$user = user_logged_in();
$user_id = intval($user['id']);


// Handling OTP forwarding request
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
        // Forwarding OTP via mail
        $email_values = [
            'name'=> $user['fullname'], 
            'message'=> "Your OTP is: ".sanitize_input($data['otp'])
        ];
        sendMail($user['email'], "One Time Password", $email_values);
        return_json(['status'=>"success", 'message'=>"OTP forwarded successfully"]);
    } catch(Exception $e) {
        return_json(['status'=>"failed", 'message'=>"An error occured"]);
    }

}