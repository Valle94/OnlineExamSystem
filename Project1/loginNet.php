<?php

require "requires.php";

$user = [ // Initialize user variables
    'email' => '',
    'password' => '',
];

$errors = [ // initialize error messages
    'email' => '',
    'password' => ''
];

// Initialize message and invalid variables.
$message = '';
$invalid = true;


// Collecting form data
$user['email'] = trim($_POST['Email'] ?? '');
$user['password'] = $_POST['Password'] ?? '';

// Returning the logged in account from the database.
if ($user['email'] && $user['password']){
    $statement = $pdo->query(ReturnStudent($user['email']));
    $account = $statement->fetch();
}

// 1. Validate Email Format
if (empty($user['email']) || !filter_var($user['email'], FILTER_VALIDATE_EMAIL)) {
    $error = "Please enter a valid email address.";
}

// 2. Validate Password (only if user was found)
if (!$account) {
    $error = "Account not found.";
} else {
    // Use password_verify to check against the hash
    if (!password_verify($user['password'], $account['Password'])) {
        $error = "Incorrect Password";
    }
}

if (!$error){
    $invalid = false;
}

if (!$invalid) { // If everything is valid, set some session variables for later use
    $_SESSION["email"] = $account['Email'];
    $_SESSION["studentID"] = $account['StudentID'];
    $_SESSION["logged_in"] = true;
    $message = "Login Successful!";
    echo json_encode([$message, $account['StudentID']]);
} else {
    $message = "Login Error.";
    echo json_encode([$error, $account['StudentID']]);
}
