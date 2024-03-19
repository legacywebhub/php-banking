<?php

// Authenticating user
$admin = admin_logged_in();

// Other variables
$setting = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($setting['name'])." | Dashboard";
$total_users = query_fetch("SELECT COUNT(*) AS total_users FROM users")[0]['total_users'];
$verified_users = query_fetch("SELECT COUNT(*) AS verified_users FROM kycs WHERE status = 'approved'")[0]['verified_users'];
$active_card_users = query_fetch("SELECT COUNT(*) AS active_card_users FROM virtual_cards WHERE status = 'active'")[0]['active_card_users'];
$pending_payments = query_fetch("SELECT COUNT(*) AS pending_payments FROM payments WHERE status = 'pending'")[0]['pending_payments'];
$pending_loans = query_fetch("SELECT COUNT(*) AS pending_loans FROM loans WHERE status = 'pending'")[0]['pending_loans'];
$total_payments = query_fetch("SELECT COUNT(*) AS total_payments FROM payments")[0]['total_payments'];
$total_transactions = query_fetch("SELECT COUNT(*) AS total_transactions FROM transactions")[0]['total_transactions'];
$total_loans = query_fetch("SELECT COUNT(*) AS total_loans FROM loans")[0]['total_loans'];
$total_messages = count(query_fetch("select * from messages"));

// Handling incoming AJAX request to delete message
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get JSON data from the request body
    $json_data = file_get_contents("php://input");
    // Parse the JSON data into PHP array
    $data = json_decode($json_data, true);
    // Process data here
    try {
        $message_id = intval($data['id']);
        $query = query_fetch("DELETE FROM messages WHERE id = $message_id");
        $response = "success";
    } catch(Exception $e) {
        $response = "failed: $e";
    }
    // Send response as JSON
    echo json_encode($response);
    die();
}

$context = [
    'setting'=> $setting,
    'title'=> $title,
    'admin'=> $admin,
    'total_users'=> $total_users,
    'verified_users'=> $verified_users,
    'active_card_users'=> $active_card_users,
    'total_payments'=> $total_payments,
    'pending_payments'=> $pending_payments,
    'total_loans'=> $total_loans,
    'pending_loans'=> $pending_loans,
    'total_transactions'=> $total_transactions,
    'total_messages'=> $total_messages
];

admin_view('dashboard', $context);