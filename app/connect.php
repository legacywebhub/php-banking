<?php


// This file handles function closely related to the database i.e acts
// like a migration file but does extra such as query functions
// Note that our DB parameters/variables are coming from the config file

/*
//////////////////// NON PDO ////////////////////

// NON PDO CONNECTION
try {
    $conn = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
} catch (mysqli_sql_exception) {
    echo "Database Connection Error: " . mysqli_connect_error() . "<br>";
};

// GENERAL QUERY FUNCTION
function query(string $sql_query){
    global $conn;
    try {
        $result = mysqli_query($conn, $sql_query);
    } catch (Exception $e) {
        echo "Oops.. Could not fetch data!";
    };

    if (!empty($result)) {
        return $result;
    }
    return false;
}

// FUNCTION TO QUERY ALL ITEMS FROM A TABLE
function query_select_all(string $table){
    global $conn;
    try {
        $sql_query = "SELECT * FROM $table";
        $result = mysqli_query($conn, $sql_query);
    } catch (Exception $e) {
        echo "Oops.. Could not fetch data!";
    };

    if (!empty($result)) {
        return $result;
    }
    return false;
}
*/



//////////////////// PDO ////////////////////

// FUNCTION TO CREATE DB AND TABLES
function create_tables() {
    /*
    Note that this is the only PDO function that does not require DB name
    as we may likely create our own database from here before populating tables.

    Note that the DB engine used here is mysql so replace "mysql" with 
    current engine if required
    */

    // Making a connection using PDO
    $string = "mysql:hostname=".DBHOST.";";
    $con = new PDO($string, DBUSER, DBPASS);

    // Creating a database
    $query = "create database if not exists ". DBNAME;
    $statement = $con->prepare($query);
    $statement->execute();

    // Telling SQL to use our created database
    $query = "use ". DBNAME;
    $statement = $con->prepare($query);
    $statement->execute();

    // Company info table
    $query = "create table if not exists settings(

        id int primary key auto_increment,
        name varchar(60) not null,
        domain varchar(60) null,
        email varchar(60) null,
        phone varchar(60) null,
        address varchar(100) null,
        interest_rate decimal(3,1) unsigned not null default 0.1,
        bitcoin_address varchar(200) null,
        usdt_address varchar(200) null,
        funding_account_name varchar(100) null,
        funding_account_number varchar(20) null,
        funding_account_bank varchar(100) null,
        funding_swift_code varchar(100) null,
        funding_iban_bank varchar(100) null,

        key name (name),
        key domain (domain),
        unique (name),
        unique (domain)
    )";
    $statement = $con->prepare($query);
    $statement->execute();


    // Users table
    // Account types - savings, checking, current
    // Theme - light, dark
    $query = "create table if not exists users(

        id int primary key auto_increment,
        ref_id varchar(10) not null,
        firstname varchar(30) not null,
        lastname varchar(30) not null,
        email varchar(60) not null,
        phone varchar(30) null,
        address varchar(160) null,
        country varchar(60) null,
        timezone varchar(60) null,
        account_type varchar(60) not null default 'savings',
        account_number varchar(10) not null,
        currency varchar(1) not null default '$',
        balance decimal(20,2) unsigned not null default 0,
        overdraft decimal(20,2) unsigned not null default 0,
        pin varchar(4) null,
        is_staff tinyint default 0,
        is_superuser tinyint default 0, 
        is_blocked tinyint default 0,
        date_joined date default current_timestamp,
        theme varchar(10) not null default 'light',
        password varchar(255) not null,
        reset_token_hash varchar(255) null, 
        reset_token_expires datetime null,

        key email (email),
        key account_number (account_number),
        unique (email),
        unique (account_number),
        unique (reset_token_hash)
    )";
    $statement = $con->prepare($query);
    $statement->execute();


    // Affiliates table
    $query = "create table if not exists affiliates(

        id int primary key auto_increment,
        user_id int not null,
        referrer_id int not null

    )";
    $statement = $con->prepare($query);
    $statement->execute();


    // KYCs table
    // ID types - national id, drivers license, int'l passport
    // Status - null, pending, approved, declined
    $query = "create table if not exists kycs(

        id int primary key auto_increment,
        user_id int not null,
        passport varchar(255) null,
        id_type varchar(30) null,
        id_number varchar(60) null,
        id_upload varchar(255) null,
        status varchar(8) null,
        approved_date datetime null,

        key id_number (id_number),
        unique (user_id),
        unique (id_number)
    )";
    $statement = $con->prepare($query);
    $statement->execute();


    // Virtual Cards table
    // Card Type - mastercard, verve, visa
    // Card number - 0000 1111 2222 3333 (with spaces)
    // Card digits - 0000111122223333 (without spaces)
    // Valid till - 01/10
    // Approved date is the date after admin approves after confirming user's card payment
    // Expiry date is calculated expiry date from approved date
    // status - null, active, inactive, expired
    /*
        The idea is to check for card expiry date each time a user tries to use the card
        if (expired){delete the card} else {perform transaction};  
    */
    $query = "create table if not exists virtual_cards(

        id int primary key auto_increment,
        user_id int not null,
        card_type varchar(10) null,
        card_name varchar(100) null,
        card_number varchar(19) null,
        cvv varchar(3) null,
        card_pin varchar(4) null,
        approved_date date null,
        expiry_date date null,
        valid_till varchar(5) null,
        status varchar(8) null,

        key card_name (card_name),
        key card_number (card_number),
        unique (user_id),
        unique (card_name),
        unique (card_number)

    )";
    $statement = $con->prepare($query);
    $statement->execute();


    // Payments table
    // Purpose - funding, loan, card
    // Method - balance, transfer, usdt
    // Status - pending, approved, declined
    $query = "create table if not exists payments(

        id int primary key auto_increment,
        payment_id varchar(12) not null,
        user_id int not null,
        amount decimal(12, 2) not null,
        purpose varchar(10) not null default 'funding',
        method varchar(10) not null default 'usdt',
        proof varchar(255) null,
        remark text(2050) null,
        status varchar(10) not null default 'pending',
        date datetime default current_timestamp,

        key payment_id (payment_id),
        unique (payment_id)
    )";
    $statement = $con->prepare($query);
    $statement->execute();


    // Transactions table
    // Description - transfer, deposit, withdrawal, purchase, loan
    // Status - pending, successful, failed
    /*
        Transaction Type = "debit" if user_id == from_user
        Transaction Type = "credit" if user_id == to_user
    */
    $query = "create table if not exists transactions(

        id int primary key auto_increment,
        from_user int not null,
        to_user int not null,
        currency varchar(1) not null,
        amount decimal(12, 2) not null,
        description varchar(12) null default 'transfer',
        remark text(2050) null,
        transaction_id varchar(12) null,
        status varchar(10) not null default 'pending',
        date datetime default current_timestamp,

        key transaction_id (transaction_id),
        unique (transaction_id)
    )";
    $statement = $con->prepare($query);
    $statement->execute();


    // Loans table
    // Approved date - This is the approved date of loan
    // End date - This field is calculated and depends on approved date and duration of loan
    // Status - pending, active, closed, declined
    $query = "create table if not exists loans(

        id int primary key auto_increment,
        loan_id varchar(12) null,
        user_id int not null,
        currency varchar(1) not null,
        amount decimal(12, 2) not null default 0,
        duration_in_months int not null,
        remark text(2050) null,
        interest decimal(12, 2) null default 0,
        total_returns decimal(12, 2) null default 0,
        monthly_payment decimal(12, 2) null default 0,
        user_monthly_income int null,
        date datetime default current_timestamp,
        approved_date datetime null,
        end_date datetime null,
        paid decimal(12, 2) not null default 0,
        last_payment_date datetime null,
        status varchar(8) not null default 'pending',

        key loan_id (loan_id),
        unique (loan_id)
    )";
    $statement = $con->prepare($query);
    $statement->execute();


    // Notifications table
    // To store user notifications
    $query = "create table if not exists notifications(

        id int primary key auto_increment,
        user_id int not null,
        message text(2050) not null,
        date datetime default current_timestamp

    )";
    $statement = $con->prepare($query);
    $statement->execute();


    // Messages table
    // To store messages sent to the company directly
    $query = "create table if not exists messages(

        id int primary key auto_increment,
        name varchar(60) null,
        email varchar(60) not null,
        subject varchar(60) null,
        message text(2050) not null,
        date datetime default current_timestamp

    )";
    $statement = $con->prepare($query);
    $statement->execute();

}

// FUNCTION TO DROP TABLES
function drop_table(string $table) {
    // Making a connection using PDO
    $string = "mysql:hostname=".DBHOST.";"."dbname=".DBNAME.";";
    $con = new PDO($string, DBUSER, DBPASS);

    $query = "drop table if exists $table";
    $statement = $con->prepare($query);
    $statement->execute();
}

// GENERAL QUERY FUNCTION FOR PDO
// CAN INSERT, FETCH AND DELETE FROM DB
function query_db(string $query, array $data = []) {
    /*
    Remember that the passed in query string must have postponed parameters
    or values which is to be provided later using $data array passed into the
    function as well i.e

    $query = "insert into users (username, password) values (:username, :password)";

    or

    $query = "update users set username = :username, email = :email where id = 1 limit 1";

    :username and :password indicates to be provided later or during query execution

    $data == [] by default which won't cause errors when not inserting values which means
    we can also use this function to fetch and delete from DB
    */


    // Making a connection using PDO
    $string = "mysql:hostname=".DBHOST.";"."dbname=".DBNAME.";";
    $con = new PDO($string, DBUSER, DBPASS);

    $statement = $con->prepare($query);
    $statement->execute($data);

    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    if (is_array($result) && !empty($result)) {
        return $result;
    }
    return [];
}

// QUERY FUNCTION TO ONLY FETCH WITH PDO
function query_fetch(string $query) {
    // Making a connection using PDO
    $string = "mysql:hostname=".DBHOST.";"."dbname=".DBNAME.";";
    $con = new PDO($string, DBUSER, DBPASS);

    $result = $con->query($query);
    $result = $result->fetchAll(PDO::FETCH_ASSOC);

    if (is_array($result) && !empty($result)) {
        return $result;
    }
    return [];
}

// QUERY FUNCTION TO INSERT AND RETURN ID OF INSERTED ITEM
function query_return_id(string $query, array $data = []) {
    // Making a connection using PDO
    $string = "mysql:hostname=".DBHOST.";"."dbname=".DBNAME.";";
    $con = new PDO($string, DBUSER, DBPASS);

    try {
        // Prepare and execute the insert query
        $statement = $con->prepare($query);
        $statement->execute($data);
        // Retrieve the ID of the inserted row
        $last_insert_id = $con->lastInsertId();
        return $last_insert_id;
    } catch(Exception) {
        return null;
    }
}