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

    // Validation
    if (empty($data['firstname'])) {
        echo json_encode(['status'=>"failed", 'message'=>"First name cannot be blank or have spaces"]);
        die();
    } else if (is_numeric($data['firstname'])) {
        echo json_encode(['status'=>"failed", 'message'=>"First name cannot be numeric"]);
        die();
    } else if (strlen($data['firstname']) < 3 || strlen($data['firstname']) > 30) {
        echo json_encode(['status'=>"failed", 'message'=>"First name cannot be less than 3 or more than 30 characters"]);
        die();
    }

    if (empty($data['lastname'])) {
        echo json_encode(['status'=>"failed", 'message'=>"Last name cannot be blank or have spaces"]);
        die();
    } else if (is_numeric($data['lastname'])) {
        echo json_encode(['status'=>"failed", 'message'=>"Last name cannot be numeric"]);
        die();
    } else if (strlen($data['lastname']) < 3 || strlen($data['lastname']) > 60) {
        echo json_encode(['status'=>"failed", 'message'=>"Last name cannot be less than 3 or more than 60 characters"]);
        die();
    }

    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['status'=>"failed", 'message'=>"Email is not valid"]);
        die();
    } else if (strlen($data['email']) > 60) {
        echo json_encode(['status'=>"failed", 'message'=>"Email cannot be more than 60 characters"]);
        die();
    } else if (email_exists($data['email'])) {
        echo json_encode(['status'=>"failed", 'message'=>"Email has already been used"]);
        die();
    }

    if (empty($data['password1']) || empty($data['password2'])) {
        echo json_encode(['status'=>"failed", 'message'=>"Passwords cannot be empty"]);
        die();
    } else if ($data['password1'] != $data['password2']) {
        echo json_encode(['status'=>"failed", 'message'=>"Passwords do not match"]);
        die();
    }

    // Checking for referrer
    $referrer_id = sanitize_input($data['referrer_id']);

    // Declaring database variables for user as PHP array
    $data = [
        'firstname' => ucfirst(sanitize_input($data['firstname'])),
        'lastname' => ucfirst(sanitize_input($data['lastname'])),
        'email' => sanitize_input($data['email']),
        'phone' => sanitize_input($data['phone']),
        'address' => sanitize_input($data['address']),
        'country' => sanitize_input($data['country']),
        'timezone' => sanitize_input($data['timezone']),
        'password' => password_hash($data['password1'], PASSWORD_DEFAULT),
        'account_type' => sanitize_input($data['account_type']),
        'account_number' => generate_account_number(),
        'currency' => sanitize_input($data['currency']),
        'ref_id' => generate_unique_id(7)
    ];

    try {
        // Making a query to insert user details into the database
        $sql = "INSERT INTO users (firstname, lastname, email, phone, address, country, timezone, account_type, account_number, currency, password, ref_id) VALUES (:firstname, :lastname, :email, :phone, :address, :country, :timezone, :account_type, :account_number, :currency, :password, :ref_id)";
        $new_user_id = intval(query_return_id($sql, $data));
        // Making a kyc for user
        $sql = "INSERT INTO kycs (user_id) VALUES (:user_id)";
        $query = query_db($sql, ['user_id'=>$new_user_id]);
        // Making an inactive/domant virtual card for user 
        $sql = "INSERT INTO virtual_cards (user_id) VALUES (:user_id)";
        $query = query_db($sql, ['user_id'=>$new_user_id]);
        // Sending registeration success email
        $email_values = [
            'name'=> $data['firstname']." ".$data['lastname'], 
            'message'=> "Welcome ".$data['firstname'].", your account was successfully created and you are now eligible to explore our ecosystem. Kindly login to get started!"
        ];
        sendMail($email, "Registeration successful", $email_values);
        // Referral system
        if (!is_null($referrer_id)) {
            // Checking and retreiving user whose ref_id matches referrer_id
            $referrer = query_fetch("SELECT * FROM users WHERE ref_id = '$referrer_id' LIMIT 1")[0];

            if (!empty($referrer)) {
                // If exists, save affiliation
                $sql = "INSERT INTO affiliates (user_id, referrer_id) VALUES (:user_id, :referrer_id)";
                $query = query_db($sql, ['user_id'=>$new_user_id, 'referrer_id'=>$referrer['id']]);
                // Notifying referrer of referral activity via notification
                notify_user($referrer['id'], "User (".$data['firstname']." ".$data['lastname'].") signed up using your referral ID recently");
                // Notifying referrer of referral activity via email
                $email_values = [
                    'name'=> $referrer['firstname']." ".$referrer['lastname'], 
                    'message'=> "Hello ".$referrer['firstname'].", this is to notify you of a sign up (user: ".$data['firstname']." ".$data['lastname'].") using your referral ID. Login into your account for more info."
                ];
                sendMail($referrer['email'], "Referral Activity", $email_values);
            }

        }
        echo json_encode(['status'=>"success", 'message'=>"You were successfully registered"]);
        die();
    } catch(Exception $e) {
        echo json_encode(['status'=>"failed", 'message'=>"Registeration failed: $e"]);
        die();
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