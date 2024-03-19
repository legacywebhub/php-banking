<?php

// Authenticating user
$admin = admin_logged_in();

// Other variables
$setting = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($setting['name'])." | Add User";


// Handling add user request
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

    // Validation
    if (empty($data['firstname'])) {
        return_json(['status'=>"failed", 'message'=>"First name cannot be blank or have spaces"]);
    } else if (is_numeric($data['firstname'])) {
        return_json(['status'=>"failed", 'message'=>"First name cannot be numeric"]);
    } else if (strlen($data['firstname']) < 3 || strlen($data['firstname']) > 30) {
        return_json(['status'=>"failed", 'message'=>"First name cannot be less than 3 or more than 30 characters"]);
    }

    if (empty($data['lastname'])) {
        return_json(['status'=>"failed", 'message'=>"Last name cannot be blank or have spaces"]);
    } else if (is_numeric($data['lastname'])) {
        return_json(['status'=>"failed", 'message'=>"Last name cannot be numeric"]);
    } else if (strlen($data['lastname']) < 3 || strlen($data['lastname']) > 60) {
        return_json(['status'=>"failed", 'message'=>"Last name cannot be less than 3 or more than 60 characters"]);
    }

    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        return_json(['status'=>"failed", 'message'=>"Email is not valid"]);
    } else if (strlen($data['email']) > 60) {
        return_json(['status'=>"failed", 'message'=>"Email cannot be more than 60 characters"]);
    } else if (email_exists($data['email'])) {
        return_json(['status'=>"failed", 'message'=>"Email has already been used"]);
    }

    if (empty($data['password1']) || empty($data['password2'])) {
        return_json(['status'=>"failed", 'message'=>"Passwords cannot be empty"]);
    } else if ($data['password1'] != $data['password2']) {
        return_json(['status'=>"failed", 'message'=>"Passwords do not match"]);
    }

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
        'ref_id' => generate_unique_id(7),
        'is_staff' => sanitize_input($data['is_staff']),
        'is_superuser' => sanitize_input($data['is_superuser'])
    ];

    try {
        // Making a query to insert user details into the database
        $sql = "INSERT INTO users (firstname, lastname, email, phone, address, country, timezone, account_type, account_number, currency, password, ref_id, is_staff, is_superuser) VALUES (:firstname, :lastname, :email, :phone, :address, :country, :timezone, :account_type, :account_number, :currency, :password, :ref_id, :is_staff, :is_superuser)";
        $new_user_id = intval(query_return_id($sql, $data));
        // Making a kyc for user
        $sql = "INSERT INTO kycs (user_id) VALUES (:user_id)";
        query_db($sql, ['user_id'=>$new_user_id]);
        // Making an inactive/domant virtual card for user 
        $sql = "INSERT INTO virtual_cards (user_id) VALUES (:user_id)";
        query_db($sql, ['user_id'=>$new_user_id]);
        return_json(['status'=>"success", 'message'=>"User successfully added"]);
    } catch(Exception $e) {
        return_json(['status'=>"failed", 'message'=>"Registeration failed: $e"]);
    }

}

// Generating CSRF Token
$csrf_token = generate_csrf_token();

$context = [
    'setting'=> $setting,
    'title'=> $title,
    'admin'=> $admin,
];

admin_view('add-user', $context);