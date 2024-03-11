<?php

// Variables
$setting = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($setting['name'])." | Register";

// Handling register request
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

    $firstname = sanitize_input($_POST['firstname']);
    $lastname = sanitize_input($_POST['lastname']);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $phone = sanitize_input($_POST['phone']);
    $timezone = sanitize_input($_POST['timezone']);
    $password1 = sanitize_input($_POST['password1']);
    $password2 = sanitize_input($_POST['password2']);
    $timezone = sanitize_input($_POST['timezone']);
    $account_type = sanitize_input($_POST['account_type']);
    $account_number = generate_account_number();
    $ref = sanitize_input($_POST['ref']);


    // Validation
    if (empty($firstname)) {
        redirect('register', "First name cannot be blank or have spaces", 'danger');
    } else if (is_numeric($firstname)) {
        redirect('register', "First name cannot be numeric", 'danger');
    } else if (strlen($firstname) < 3 || strlen($firstname) > 60) {
        redirect('register', "First name cannot be less than 3 or more than 60 characters", 'danger');
    }

    if (empty($lastname)) {
        redirect('register', "Last name cannot be blank or have spaces", 'danger');
    } else if (is_numeric($lastname)) {
        redirect('register', "Last name cannot be numeric", 'danger');
    } else if (strlen($lastname) < 3 || strlen($lastname) > 60) {
        redirect('register', "Last name cannot be less than 3 or more than 60 characters", 'danger');
    }

    if (empty($username) || ctype_space($username)) {
        redirect('register', "Username cannot be blank or have spaces", 'danger');
    } else if (is_numeric($username)) {
        redirect('register', "Username cannot be numeric", 'danger');
    } else if (!preg_match("/^[a-zA-Z]+$/", $username)) {
        redirect('register', "Username can only have letters and no spaces", 'danger');
    } else if (strlen($username) < 4 || strlen($username) > 15) {
        redirect('register', "Username cannot be less than 4 or more than 15 characters", 'danger');
    }

    if (!$email) {
        redirect('register', "Email is not valid", 'danger');
    } else if (strlen($email) > 60) {
        redirect('register', "Email cannot be more than 60 characters", 'danger');
    } else if (email_exists($email)) {
        redirect('register', "Email has already been used", 'danger');
    }

    if (empty($password1) || empty($password2)) {
        redirect('register', "Passwords cannot be empty", 'danger');
    } else if ($password1 != $password2) {
        redirect('register', "Passwords do not match", 'danger');
    }

    // Declaring database variables for user as PHP array
    $data = [];
    $data['firstname'] = $firstname;
    $data['username'] = $username;
    $data['email'] = $email;
    $data['password'] = password_hash($password2, PASSWORD_DEFAULT);
    $data['timezone'] = $timezone;

    try {
        // Making a query to insert user details into the database
        $sql = "INSERT INTO users (firstname, username, email, timezone, password) VALUES (:firstname, :username, :email, :timezone, :password)";
        $query = query_db($sql, $data);
        // Sending registeration success email
        $email_values = [
            'name'=> $username, 
            'message'=> "Welcome $username, your account was successfully created and you are now eligible to explore our ecosystem. Kindly login to get started!"
        ];
        sendMail($email, "Registeration successful", $email_values);

        // Referral system
        if (!empty($ref) && username_exists($ref)) {
            $referrer = query_fetch("SELECT * FROM users WHERE username = '$ref' LIMIT 1")[0];
            $new_user = query_fetch("SELECT * FROM users WHERE username = '$username' LIMIT 1")[0];
            // Saving affiliation
            $sql = "INSERT INTO affiliates (user_id, referrer_id) VALUES (:user_id, :referrer_id)";
            $query = query_db($sql, ['user_id'=>$new_user['id'], 'referrer_id'=>$referrer['id']]);
            // Notifying referrer of referral activity via notification
            $sql = "INSERT INTO notifications (user_id, message) VALUES (:user_id, :message)";
            $query = query_db($sql, ['user_id'=>$referrer['id'], 'message'=> "User ($username) signed up using your referral ID recently"]);
            // Notifying referrer of referral activity via email
            $email_values = [
                'name'=> $referrer['username'], 
                'message'=> "Hello ".$referrer['username'].", this is to notify you of a sign up (user - $username) using your referral ID. Login into your account for more info."
            ];
            sendMail($referrer['email'], "Referral Activity", $email_values);
        }
        // Redirecting user to login page
        redirect('login', "You were successfully registered", 'success');
    } catch(Exception $e) {
        redirect('register', "Registeration failed: $e", 'danger');
    }

}

// Generating CSRF Token
$csrf_token = generate_csrf_token();

$context = [
    'setting'=> $setting,
    'title'=> $title,
];

include(APP_PATH . "views/register.view.php");

unset_message();