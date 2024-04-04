<?php

// Authorizing admin
$admin = admin_logged_in();

// Redirecting if no setting ID was provided
if (!isset($_GET['id'])) {
    redirect('settings');
} else {
    $id = intval(sanitize_input($_GET['id']));
    $matched_settings = query_fetch("SELECT * FROM settings WHERE id = $id LIMIT 1");

    // Redirecting if setting does not exists
    if (empty($matched_settings)) {
        redirect('settings');
    }
    $setting = $matched_settings[0];
    $setting_id = $setting['id'];
}

// Other variables
$setting = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($setting['name'])." | Edit Setting";

// Handling incoming post request
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['csrf_token'] === $_SESSION['csrf_token']) {

    // Validation
    if (empty($_POST['name']) || empty($_POST['domain']) || empty($_POST['email'])) {
        redirect("edit-setting?id=$setting_id", "Enter required fields", "danger");
    }
    
    // Declaring variables
    $data = [
        'id'=> $setting_id,
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
        $sql = "UPDATE settings SET name = :name, domain = :domain, email = :email, phone = :phone, address = :address, interest_rate = :interest_rate, bitcoin_address = :bitcoin_address, usdt_address = :usdt_address, facebook_link = :facebook_link WHERE id = :id LIMIT 1";
        query_db($sql, $data);
        redirect('settings', "Setting was successfully updated", "success");
    } catch(Exception $e) {
        redirect("edit-setting?id=$setting_id", "Unknown error occured", "danger");
    }
    
}

// Generating CSRF Token
$csrf_token = generate_csrf_token();

$context = [
    'setting'=> $setting,
    'admin'=> $admin,
    'title'=> $title
];

admin_view('edit-setting', $context);