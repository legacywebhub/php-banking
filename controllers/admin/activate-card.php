<?php

// Authorizing admin
$admin = admin_logged_in();

// Redirecting user if id not provided
if (!isset($_GET['id'])) {
    redirect("virtual-cards");
} else {
    // Getting virtual card id
    $card_id = intval(sanitize_input($_GET['id']));
    //  Checking for matching virtual cards
    $matched_cards = query_fetch("SELECT * FROM virtual_cards WHERE id = $card_id LIMIT 1");

    if (!empty($matched_cards)) {
        // Updating virtual card record
        $sql = "UPDATE virtual_cards SET status = :status WHERE id = :id LIMIT 1";
        query_db($sql, ['status'=> "active", 'id'=> $card_id]);
        // Redirecting..
        redirect("virtual-cards", "Virtual card successfully activated", "success");
    }
    redirect("virtual-cards", "Invalid virtual card", 'danger');
}