<?php

// Authenticating user
$admin = admin_logged_in();

// Other variables
$setting = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($setting['name'])." | Edit User";

// Authenticating view
if (!isset($_GET['id'])) {
    // Redirect if no user id passed
    redirect("users");
} else {
    try {
        $user_id = intval(sanitize_input($_GET['id']));
        $matched_users = query_fetch("SELECT * FROM users WHERE id = $user_id LIMIT 1");

        if (empty($matched_users)) {
            // Redirect if no matched user
            redirect("users");
        } else {
            // Else return user
            $user = $matched_users[0];
        }
    } catch (Exception) {
        redirect("users");
    }
}

// Handling add user request
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['csrf_token'] === $_SESSION['csrf_token']) {

    // Checking and validating password
    if (!empty($_POST['password1']) && !empty($_POST['password2'])) {
        if ($_POST['password1'] != $_POST['password2']) {
            redirect("edit-user?id=$user_id", 'Passwords do not match', 'danger');
        } else {
            $user_password = password_hash($_POST['password2'], PASSWORD_DEFAULT);
        }
    } else {
        $user_password = $user['password'];
    }

    if (isset($_POST['is_staff'])) {
        $is_staff = 1;
    } else {
        $is_staff = 0;
    }

    if (isset($_POST['is_superuser'])) {
        $is_superuser = 1;
    } else {
        $is_superuser = 0;
    }

    if (isset($_POST['is_blocked'])) {
        $is_blocked = 1;
    } else {
        $is_blocked = 0;
    }

    // Declaring database variables for user as PHP array
    $user_data = [
        'id' => $user_id,
        'firstname' => ucfirst(sanitize_input($_POST['firstname'])),
        'lastname' => ucfirst(sanitize_input($_POST['lastname'])),
        'email' => sanitize_input($_POST['email']),
        'phone' => sanitize_input($_POST['phone']),
        'address' => sanitize_input($_POST['address']),
        'country' => sanitize_input($_POST['country']),
        'password' => $user_password,
        'account_type' => sanitize_input($_POST['account_type']),
        'currency' => sanitize_input($_POST['currency']),
        'balance' => sanitize_input($_POST['balance']),
        'overdraft' => sanitize_input($_POST['overdraft']),
        'is_staff' => $is_staff,
        'is_superuser' => $is_superuser,
        'is_blocked' => $is_blocked
    ];

    try {
        // Making a query to update user details in the _POSTbase
        $sql = "UPDATE users SET firstname = :firstname, lastname = :lastname, email = :email, phone = :phone, address = :address, country = :country, account_type = :account_type, currency = :currency, balance = :balance, overdraft = :overdraft, password = :password, is_staff = :is_staff, is_superuser = :is_superuser, is_blocked = :is_blocked WHERE id = :id LIMIT 1";
        query_db($sql, $user_data);
        redirect('users', "User successfully updated", 'success');
    } catch(Exception $e) {
        redirect("edit-user?id=$user_id", "An errr occured while saving data", 'danger');
    }

}

// Generating CSRF Token
$csrf_token = generate_csrf_token();

$context = [
    'setting'=> $setting,
    'title'=> $title,
    'admin'=> $admin,
    'user'=> $user
];

admin_view('edit-user', $context);