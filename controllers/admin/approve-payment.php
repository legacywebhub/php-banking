<?php

// Authorizing admin
$admin = admin_logged_in();

// Redirecting user if id not provided
if (!isset($_GET['payment_id'])) {
    redirect("payments");
} else {
    // Getting payment id
    $payment_id = sanitize_input($_GET['payment_id']);
    //  Checking for matching payment
    $matched_payments = query_fetch("SELECT * FROM payments WHERE payment_id = '$payment_id' LIMIT 1");

    if (!empty($matched_payments)) {
        $payment = $matched_payments[0];
        $user_id = $payment['user_id'];
        $user = fetch_user($user_id);
        $now = new DateTime('now', new DateTimeZone('UTC'));

        // Checking if pending payment
        if ($payment['status'] == 'pending') {
            // Checking purpose of payment
            if ($payment['purpose'] == 'funding') {

                // Crediting user deposited funds
                update_account($user_id, 'balance', 'credit', $payment['amount']);
                // Updating payment status
                update_payment_status($payment['payment_id'], "approved");
                // Notifying user of successful funding
                notify_user($user_id, "Congrats.. Your account was successfully funded");
            
            } else if ($payment['purpose'] == 'loan') {

                // Fetch the active loan of the user
                $loan = query_fetch("SELECT * FROM loans WHERE user_id = $user_id AND status = 'active' LIMIT 1")[0];

                if (!empty($loan)) {
                    // Calculating loan debt paid
                    $paid = $loan['paid'] + $payment['amount'];
                    // Diverting residuals if any to user balance
                    if ($paid > $loan['total_returns']) {
                        // Calcuating residual
                        $residual = $paid - $loan['total_returns'];
                        // Crediting user
                        update_account($payment['user_id'], 'balance', 'credit', $residual);
                        // Updating loan paid
                        $paid = $loan['total_returns'];
                    }
                    // Determining loan status
                    $status = ($paid == $loan['total_returns']) ? "closed" : "active";

                    try {
                        // Updating loan record
                        $sql = "UPDATE loans SET paid = :paid, last_payment_date = :last_payment_date, status = :status WHERE loan_id = :loan_id LIMIT 1";
                        query_db($sql, ['paid'=> $paid, 'last_payment_date'=> $now->format('Y-m-d H:i:s'), 'status'=> $status, 'loan_id'=> $loan['loan_id']]);
                        // Updating payment status
                        update_payment_status($payment['payment_id'], "approved");
                        // Notifying user of loan payment approval
                        if ($status == "active") {
                            notify_user($user_id, "Congrats.. your loan payment was successfully received");
                        } else if ($status == "closed") {
                            notify_user($user_id, "Hurray.. your loan has been successfully cleared!");
                        }
                    } catch(Exception) {
                        redirect("payments", "Error occured while updating loan record", 'danger');
                    }
                }
            
            } else if ($payment['purpose'] == 'card') {
                
                // Fetch the card of the user
                $user_card = query_fetch("SELECT * FROM virtual_cards WHERE user_id = $user_id LIMIT 1")[0];

                if (!empty($user_card) && $user_card['status'] != "active") {
                    // Setting approved date
                    $approved_date =  $now->format('Y-m-d');
                    // Calculating end date after 2years
                    $expiry_date = $now->modify("+730 days")->format('Y-m-d');

                    $virtual_card_data = [
                        'id' => $user_card['id'],
                        'card_type' => "mastercard",
                        'card_name' => $user['fullname'],
                        'card_number' => generate_virtual_card_number(),
                        'cvv' => generate_CVV(),
                        'card_pin' => $user['pin'],
                        'approved_date' => $approved_date,
                        'expiry_date' => $expiry_date,
                        'valid_till' => extract_card_validity($expiry_date),
                        'status' => "active"
                    ];

                    try {
                        // Updating virtual card record
                        $sql = "UPDATE virtual_cards SET card_type = :card_type, card_name = :card_name, card_number = :card_number, cvv = :cvv, card_pin = :card_pin, approved_date = :approved_date, expiry_date = :expiry_date, valid_till = :valid_till, status = :status WHERE id = :id LIMIT 1";
                        query_db($sql, $virtual_card_data);
                        // Updating payment status
                        update_payment_status($payment['payment_id'], "approved");
                        // Notifying user of card approval
                        notify_user($user_id, "Hurray! Your card payment was acknowleged successfully and your virtual card now active");
                        // Notifying user of card pin
                        notify_user($user_id, "Dear user, do take note that your virtual card pin is always defaulted to your account pin");
                    } catch(Exception) {
                        redirect("payments", "Error occured while updating virtual card record", 'danger');
                    }
                } else {
                    // Diverting funds to user balance since user has an active card
                    update_account($payment['user_id'], 'balance', 'credit', $payment['amount']);
                    // Notifying user of fund divert
                    notify_user($user_id, "You already have an active card and hence card payment was funded to your balance instead");
                }

            }
            // Redirecting..
            redirect("payments", "Payment successfully approved", "success");
        }
        redirect("payments", "Non pending payment passed", 'danger');

    }
    redirect("payments", "Invalid Payment ID", 'danger');
}