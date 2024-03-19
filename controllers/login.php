<?php

// Variables
$setting = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($setting['name'])." | Login";

// Handling sign in request
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
    // Checking for which form was submitted using the name on the button
    // Returns true or false depending on whether it is set or not

    $email = sanitize_input($_POST['email']);
    $password = sanitize_input($_POST['password']);

    if (empty($email) || empty($password)) {
        redirect('login', "Email or password cannot be empty", 'danger');
    } else {
        $user = authenticate_user($email, $password);

        if (!$user || $user['is_blocked'] == 1){
            redirect('login', "Invalid credentials", 'danger');
        } else {
            // Unset any previous session
            if (isset($_SESSION['user'])) {
                unset($_SESSION['user']);
            }
            // Set new user session id
            $_SESSION['user'] = $user;
            // Redirect user
            redirect(ROOT."/account/dashboard");
        }
    }
        
}

// Generating CSRF Token
$csrf_token = generate_csrf_token();

$context = [
    'setting'=> $setting,
    'title'=> $title,
];


landing_view('login', $context);