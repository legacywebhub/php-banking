<?php

$setting = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
$title = $setting['name'] . " | Forgot Password";

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['csrf_token'] === $_SESSION['csrf_token']) {

    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

    if (!$email) {
        redirect('forgot-password', "Email is not valid", "danger");
    }

    $token = bin2hex(random_bytes(16));
    $token_hash = hash("sha256", $token);
    $expiry = date("Y-m-d H:i:s", time() + 60*30);
    
    if (email_exists($email)) {
        // Add token and token expiry to user details
        $sql = "UPDATE users SET reset_token_hash = :hash, reset_token_expires = :expiry WHERE email = :email";
        $query = query_db($sql, ['hash'=>$token_hash, 'expiry'=>$expiry, 'email'=>$email]);
        // Send reset link
        $email_values = ['name'=> '', 'message'=> "Click <a href=".ROOT."/reset-password?token=".$token.">here</a> to reset your password"];
        sendMail($email, "Password Reset", $email_values);
        // Redirect to forgot password page to display message
        redirect('reset-success', "A link to reset your password has been sent to your email", "success");
    } else {
        redirect('forgot-password', "Email does not exist", "danger");
    }
    
}

// Generating CSRF Token
$csrf_token = generate_csrf_token();

$context = [
    'title'=> $title,
    'setting'=> $setting,
];

landing_view('forgot-password', $context);