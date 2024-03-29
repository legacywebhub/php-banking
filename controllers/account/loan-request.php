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
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
    
    // Checking for previous active loans
    $previous_loans = query_db("SELECT COUNT(*) AS active_loans FROM loans WHERE user_id = $user_id AND status = 'active'")[0]['active_loans'];
    
    if (!empty($previous_loans)) {
        // Send response as JSON
        return_json(['status'=>"failed", 'message'=>"You have an outstanding loan to pay"]);
    }

    // Validating documents

    // Required fields
    if ($_FILES['personal_identification']) {
        $personal_identification = upload_document($_FILES['personal_identification'], 'documents');
        
        if ($personal_identification['status'] == "failed") {
            return_json(['status'=>"failed", 'message'=>"Invalid file type or size for personal identification upload"]);
        }
        $personal_identification = $personal_identification['new_file_name'];
    } 

    if ($_FILES['proof_of_income']) {
        $proof_of_income = upload_document($_FILES['proof_of_income'], 'documents');

        if ($proof_of_income['status'] == "failed") {
            return_json(['status'=>"failed", 'message'=>"Invalid file type or size for proof of income upload"]);
        }
        $proof_of_income = $proof_of_income['new_file_name'];
    }

    // Optional file fields
    if (!empty($_FILES['business_documentation']['name'])) {
        $business_documentation = upload_document($_FILES['business_documentation'], 'documents');

        if ($business_documentation['status'] == "failed") {
            return_json(['status'=>"failed", 'message'=>"Invalid file type or size for business documentation upload"]);
        }
        $business_documentation = $business_documentation['new_file_name'];
    } else {
        $business_documentation = null;
    }

    if (!empty($_FILES['collateral_documentation']['name'])) {
        $collateral_documentation = upload_document($_FILES['collateral_documentation'], 'documents');

        if ($collateral_documentation['status'] == "failed") {
            return_json(['status'=>"failed", 'message'=>"Invalid file type or size for collateral documentation upload"]);
        }
        $collateral_documentation = $collateral_documentation['new_file_name'];
    } else {
        $collateral_documentation = null;
    }


    // Determining loan interest rate depending on loan duration
    $duration_in_months =  sanitize_input($_POST['duration_in_months']);
    $amount = sanitize_input($_POST['amount']);

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
        'user_id' => $user_id, 'loan_id' => generate_unique_id(10),
        'loan_type' => sanitize_input($_POST['loan_type']),
        'personal_identification' => $personal_identification,
        'proof_of_income' => $proof_of_income,
        'business_documentation' => $business_documentation,
        'collateral_documentation' => $collateral_documentation,
        'currency'=> $user['currency'], 'amount'=> $amount,
        'duration_in_months' => $duration_in_months,
        'remark' => sanitize_input($_POST['remark']),
        'interest'=> $interest, 'total_returns'=> $total_returns,
        'monthly_payment'=> $monthly_payment,
        'user_monthly_income'=> sanitize_input($_POST['user_monthly_income'])
    ];

    try {
        // Making a query to insert loan details into the database
        $sql = "INSERT INTO loans (user_id, loan_id, loan_type, personal_identification, proof_of_income, business_documentation, collateral_documentation, currency, amount, duration_in_months, remark, interest, total_returns, monthly_payment, user_monthly_income) 
        VALUES (:user_id, :loan_id, :loan_type, :personal_identification, :proof_of_income, :business_documentation, :collateral_documentation, :currency, :amount, :duration_in_months, :remark, :interest, :total_returns, :monthly_payment, :user_monthly_income)";
        $loanID = intval(query_return_id($sql, $data));
        // Refetching loan to pass to frontend
        $loan = query_fetch("SELECT * FROM loans WHERE id = $loanID LIMIT 1")[0];
        return_json(['status'=>"success", 'loan'=>$loan]);
    } catch(Exception $e) {
        return_json(['status'=>"failed", 'message'=>"An error occured: $e"]);
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