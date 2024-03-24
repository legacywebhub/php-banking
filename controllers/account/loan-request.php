<?php

// Authorizing user
$user = user_logged_in();
$user_id = intval($user['id']);

// Other variables
$setting = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($setting['name'])." | Request Loan";
$recent_notifications = query_fetch("SELECT * FROM notifications WHERE user_id = $user_id ORDER BY id DESC LIMIT 0,10");
$recent_loans = query_fetch("SELECT * FROM loans WHERE user_id = $user_id ORDER BY id DESC LIMIT 0,10");

// Handling loan apply request
if ($_SERVER["REQUEST_METHOD"]=="POST") {
    // Get JSON data from the request body
    $json_data = file_get_contents("php://input");
    // Parse the JSON data into PHP array
    $data = json_decode($json_data, true);
    // Checking for csrf attack
    if ($data['csrf_token'] != $_SESSION['csrf_token']) {
        // Send response as JSON
        echo json_encode(['status'=>"failed", 'message'=>"Invalid request"]);
        die();
    }
    // Checking for previous active loans
    $previous_loans = query_db("SELECT * FROM loans WHERE user_id = $user_id AND status = 'active' LIMIT 1");
    if (!empty($previous_loans)) {
        // Send response as JSON
        echo json_encode(['status'=>"failed", 'message'=>"You have an outstanding loan to pay"]);
        die();
    }

    // Determining loan interest rate depending on loan duration
    $duration_in_months =  sanitize_input($data['duration_in_months']);
    $amount = sanitize_input($data['amount']);

    if ($duration_in_months <= 6) {
        $loan_interest_rate = 10;
    } else if($duration_in_months > 6 && $duration_in_months <= 12) {
        $loan_interest_rate = 15;
    } else if($duration_in_months > 12 && $duration_in_months <= 18) {
        $loan_interest_rate = 20;
    } else if($duration_in_months > 18 && $duration_in_months <= 24) {
        $loan_interest_rate = 35;
    } else {
        $loan_interest_rate = 50;
    }

    // Calculating loan parameters
    $interest = ($loan_interest_rate / 100) * $amount;
    $total_returns = $amount + $interest;
    $monthly_payment = $total_returns / $duration_in_months;

    // Declaring database variables for user as PHP array
    $data = [
        'user_id' => $user_id, 'loan_id' => generate_unique_id(7),
        'currency'=> $user['currency'], 'amount'=> $amount,
        'duration_in_months' => $duration_in_months,
        'remark' => sanitize_input($data['remark']),
        'interest'=> $interest, 'total_returns'=> $total_returns,
        'monthly_payment'=> $monthly_payment,
        'user_monthly_income'=> sanitize_input($data['user_monthly_income'])
    ];

    try {
        // Making a query to insert loan details into the database
        $sql = "INSERT INTO loans (user_id, loan_id, currency, amount, duration_in_months, remark, interest, total_returns, monthly_payment, user_monthly_income) 
        VALUES (:user_id, :loan_id, :currency, :amount, :duration_in_months, :remark, :interest, :total_returns, :monthly_payment, :user_monthly_income)";
        $loanID = intval(query_return_id($sql, $data));
        // Refetching loan to pass to frontend
        $loan = query_fetch("SELECT * FROM loans WHERE id = $loanID LIMIT 1")[0];
        echo json_encode(['status'=>"success", 'loan'=>$loan]);
        die();
    } catch(Exception $e) {
        echo json_encode(['status'=>"failed", 'message'=>"An error occured: $e"]);
        die();
    }
}

// Generating CSRF Token
$csrf_token = generate_csrf_token();

$context = [
    'setting'=> $setting, 
    'title'=> $title,
    'user'=> $user,
    'recent_notifications'=> $recent_notifications,
    'recent_loans'=> $recent_loans
];

account_view('loan-request', $context);