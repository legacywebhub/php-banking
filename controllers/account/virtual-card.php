<?php

// Authorizing user
$user = user_logged_in();
$user_id = intval($user['id']);

// Other variables
$setting = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($setting['name'])." | Virtual Card";
$recent_notifications = query_fetch("SELECT * FROM notifications WHERE user_id = $user_id ORDER BY id DESC LIMIT 0,10");

// Handling virtual card requests
if ($_SERVER["REQUEST_METHOD"]=="POST" && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
    
    // Remember to send data as form objects and send back response in JSON

    
    if ($user['has_active_card']) { // Checking if user has an active card

        return_json(['status'=> "failed", 'message'=> "You have an active card currently"]);

    } else if (isset($_FILES['proof'])){ // Checking if payment proof was uploaded
        $proof = upload_document($_FILES['proof'], 'documents');

        if ($proof['status'] == "success") {
            try {
                // Updating payment details in database
                $sql = "UPDATE payments SET proof = :proof WHERE payment_id = :payment_id LIMIT 1";
                query_db($sql, ['proof'=> $proof['new_file_name'], 'payment_id'=> sanitize_input($_POST['payment_id'])]);
                notify_user($user_id, "Virtual card application successful and pending");
                return_json(['status'=>"success", 'message'=> "Virtual card application successful and pending"]);
            } catch(Exception) {
                return_json(['status'=>"failed", 'message'=>"Service timed out"]);
            }
        } else {
            return_json(['status'=>"failed", 'message'=>"Invalid file type or size"]);
        }

    } else { // Else payment order is created for the first time

        // Fetching previous pending card payment of the user
        $pending_card_payment = query_fetch("SELECT * FROM payments WHERE user_id = $user_id AND purpose = 'card' AND status = 'pending' LIMIT 1")[0];

        if (!empty($pending_card_payment)) { // Checking if user has a pending card payment

            // If he has then return the payment id of the previous payment
            return_json(['status'=>"success", 'payment_id'=>$pending_card_payment['payment_id']]);
    
        } else { // Else create new card payment record
        
            // Declaring database variables for user as PHP array
            $data = [
                'user_id' => $user_id, 'payment_id' => generate_unique_id(7),
                'amount' => intval(sanitize_input($_POST['amount'])), 'purpose' => "card",
                'method' => sanitize_input($_POST['method']), 'status' => "pending"
            ];
            

            try {
                // Making a query to insert payment details into the database
                $sql = "INSERT INTO payments (user_id, payment_id, amount, purpose, method, status) VALUES (:user_id, :payment_id, :amount, :purpose, :method, :status)";
                $payment_id = intval(query_return_id($sql, $data));
                return_json(['status'=>"success", 'payment_id'=>$data['payment_id']]);
            } catch(Exception $e) {
                return_json(['status'=>"failed", 'message'=>"An error occured: $e"]);
            }
        }
    }
}

// Generating CSRF Token
$csrf_token = generate_csrf_token();

$context = [
    'setting'=> $setting, 
    'title'=> $title,
    'user'=> $user,
    'recent_notifications'=> $recent_notifications,
];

account_view('virtual-card', $context);