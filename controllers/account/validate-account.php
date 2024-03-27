<?php

// Authorizing user
$user = user_logged_in();
$user_id = intval($user['id']);


// Handling OTP forwarding request
if ($_SERVER["REQUEST_METHOD"]=="POST") {
    // Get JSON data from the request body
    $json_data = file_get_contents("php://input");
    // Parse the JSON data into PHP array
    $data = json_decode($json_data, true);
    // Checking for csrf attack
    if ($data['csrf_token'] != $_SESSION['csrf_token']) {
        // Send response as JSON
        return_json(['status'=> "failed", 'message'=> "No matching accounts"]);
    } else {
        $account_number = strval(sanitize_input($data['account_number']));

        try {
            // Fetching matched accounts
            $matched_accounts = query_fetch("SELECT firstname, lastname, account_number FROM users WHERE account_number LIKE '%$account_number%'");
            return_json(['status'=>"success", 'matched_accounts'=> $matched_accounts]);
        } catch(Exception $e) {
            return_json(['status'=>"failed", 'message'=>"No matching accounts"]);
        }
    }
}