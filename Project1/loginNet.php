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
$statement = $pdo->query(ReturnStudent($user['email']));
$account = $statement->fetch();

// 1. Validate Email Format
if (empty($user['email']) || !filter_var($user['email'], FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = "Please enter a valid email address.";
}

// 2. Validate Password (only if user was found)
if (!$account) {
    $errors['email'] = "Account not found.";
} else {
    // Use password_verify to check against the hash
    if (!password_verify($user['password'], $account['Password'])) {
        $errors['password'] = "Incorrect Password";
    }
}

$invalid = implode($errors);

if (!$invalid) { // If everything is valid, set some session variables for later use
    $_SESSION["email"] = $account['Email'];
    $_SESSION["studentID"] = $account['StudentID'];
    $_SESSION["logged_in"] = true;
    $message = "Login Successful!";
    echo $message;
} else {
    $message = "Login Error.";
    foreach ($errors as $error) {
        echo $error;
    }
}

require "header.php";
