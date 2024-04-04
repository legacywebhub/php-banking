<?php

// Authorizing admin
$admin = admin_logged_in();

// Other variables
$setting = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($setting['name'])." | Add Setting";

// Handling incoming post request
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['csrf_token'] === $_SESSION['csrf_token']) {

    // Validation
    if (!empty($setting)) {
        redirect('settings', "Cannot have 2 or more settings", "danger");
    } else if (empty($_POST['name']) || empty($_POST['domain']) || empty($_POST['email'])) {
        redirect('add-setting', "Enter required fields", "danger");
    }
    
    // Declaring variables
    $data = [
        'name'=> sanitize_input($_POST['name']),
        'domain'=> sanitize_input($_POST['domain']),
        'email'=> sanitize_input($_POST['email']),
        'phone'=> sanitize_input($_POST['phone']),
        'address'=> sanitize_input($_POST['address']),
        'interest_rate'=> sanitize_input($_POST['interest_rate']),
        'bitcoin_address'=> sanitize_input($_POST['bitcoin_address']),
        'usdt_address'=> sanitize_input($_POST['usdt_address']),
        'facebook_link'=> sanitize_input($_POST['facebook_link'])
    ];

    try {
        $sql = "INSERT INTO settings (name, domain, email, phone, address, interest_rate, bitcoin_address, usdt_address, facebook_link) VALUES (:name, :domain, :email, :phone, :address, :interest_rate, :bitcoin_address, :usdt_address, :facebook_link)";
        query_db($sql, $data);
        redirect('settings', "Setting was successfully added", "success");
    } catch(Exception $e) {
        redirect('add-setting', "Unknown error occured: $e", "danger");
    }
    
}


// Generating CSRF Token
$csrf_token = generate_csrf_token();


$context = [
    'setting'=> $setting,
    'admin'=> $admin,
    'title'=> $title
];

admin_view('add-setting', $context);