<?php

$setting = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
$title = $setting['name'] . " | Reset Password";

// If no token passed in URL
if (!isset($_GET['token'])) {
    die("<h1>Page Not Found</h1>");
}

$token = $_GET['token'];
$token_hash = hash("sha256", $token);
$matched_users = query_fetch("SELECT * FROM users WHERE reset_token_hash = '$token_hash' LIMIT 1");

if (empty($matched_users)) {
    die("<h1>Token not found</h1>");
} else {
    // Get user
    $user = $matched_users[0];

    // Checking if token has expired
    if (strtotime($user['reset_token_expires']) <= time()) {
        die("<h1>Token has expired</h1>");
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['csrf_token'] === $_SESSION['csrf_token']) {

    $password1 = sanitize_input($_POST['password1']);
    $password2 = sanitize_input($_POST['password2']);
 
    if ($_POST['token'] != $token) {
        redirect("reset-password?token=$token", "Invalid token, please try again", "danger");
    } else if (empty($password1) || empty($password2)) {
        redirect("reset-password?token=$token", "Passwords cannot be empty", "danger");
    } else if ($password1 != $password2) {
        redirect("reset-password?token=$token", "Passwords do not match", "danger");
    }

    try {
        $sql = "UPDATE users SET password = :password, reset_token_hash = NULL, reset_token_expires = NULL WHERE id = :id";
        $query = query_db($sql, ['password'=> password_hash($password2, PASSWORD_DEFAULT), 'id'=>$user['id']]);
        // Redirecting user
        redirect("login", "Password updated. You can now sign in", "success");
    } catch (Exception) {
        redirect("reset-password?token=$token", "Unknown error occured", "danger");
    }

}

// Generating CSRF Token
$csrf_token = generate_csrf_token();

$context = [
    'title'=> $title,
    'setting'=> $setting,
    'token'=> $token
];

landing_view('reset-password', $context);