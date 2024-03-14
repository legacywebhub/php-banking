<?php

// Authorizing user
$user = user_logged_in();
$user_id = intval($user['id']);

// Other variables
$setting = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($setting['name'])." | My Profile";
$recent_notifications = query_fetch("SELECT * FROM notifications WHERE user_id = $user_id ORDER BY id DESC LIMIT 0,10");

// Handling profile update request
if ($_SERVER["REQUEST_METHOD"]=="POST") {
    
    // Checking to see if user has a pending KYC application
    if ($user['kyc']['status']=='pending' || $user['kyc']['status']=='approved') {
        // Send response as JSON
        echo json_encode(['status'=>"failed", 'message'=>"You already have a KYC application"]);
        die();
    }

    // Variables
    $passport = upload_image($_FILES['passport'], 'images/users');
    $id_upload = upload_document($_FILES['id-image'], 'documents');

    // Validation
    if ($passport['status'] != "success" || $id_upload['status'] != "success") {
        // Send response as JSON
        echo json_encode(['status'=>"failed", 'message'=>"Invalid file type or size"]);
        die();
    }

    // Declaring database variables for user as PHP array
    $data = [
        'user_id' => $user_id,
        'passport' => $passport['new_file_name'],
        'id_type' => sanitize_input($_POST['id-type']),
        'id_number' => sanitize_input($_POST['id-number']),
        'id_upload' => $id_upload['new_file_name'],
        'status' => "pending"
    ];

    try { // Submitting data
        // Making a query to kyc details into the database
        $sql = "UPDATE kycs SET passport = :passport, id_type = :id_type, id_number = :id_number, id_upload = :id_upload, status = :status WHERE user_id = :user_id LIMIT 1";
        query_db($sql, $data);
        echo json_encode(['status'=>"success", 'message'=>"KYC application successful"]);
        die();
    } catch(Exception $e) {
        echo json_encode(['status'=>"failed", 'message'=>"An error occured: $e"]);
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

account_view('profile', $context);