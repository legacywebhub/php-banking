<?php

// Authorizing user
$user = user_logged_in();
$user_id = intval($user['id']);

// Other variables
$setting = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($setting['name'])." | My Profile";
$recent_notifications = query_fetch("SELECT * FROM notifications WHERE user_id = $user_id ORDER BY id DESC LIMIT 0,10");

// Handling profile update/kyc upload request
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
    
    // Checking to see if user has a pending KYC application
    if ($user['kyc']['status']=='pending' || $user['kyc']['status']=='approved') {
        // Send response as JSON
        return_json(['status'=>"failed", 'message'=>"You already have a KYC application"]);
    }

    // Variables
    $passport = upload_image($_FILES['passport'], 'documents');
    $id_upload = upload_document($_FILES['id_upload'], 'documents');

    // Validation
    if ($passport['status'] != "success" || $id_upload['status'] != "success") {
        // Send response as JSON
        return_json(['status'=>"failed", 'message'=>"Invalid file type or size"]);
    }

    // Declaring database variables for user as PHP array
    $data = [
        'user_id' => $user_id,
        'passport' => $passport['new_file_name'],
        'id_type' => sanitize_input($_POST['id_type']),
        'id_number' => sanitize_input($_POST['id_number']),
        'id_upload' => $id_upload['new_file_name'],
        'status' => "pending"
    ];

    try { // Submitting data
        // Making a query to update kyc details into the database
        $sql = "UPDATE kycs SET passport = :passport, id_type = :id_type, id_number = :id_number, id_upload = :id_upload, status = :status WHERE user_id = :user_id LIMIT 1";
        query_db($sql, $data);
        return_json(['status'=>"success", 'message'=>"KYC application successful"]);
    } catch(Exception $e) {
        return_json(['status'=>"failed", 'message'=>"An error occured: $e"]);
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