<?php

require "dbConnection.php";
require "queries.php";

$response = ["success" => "false", "message" => "", "studentID" => null];

try {
    if (empty($_POST)) {
        throw new Exception("No POST data received");
    }

    $email = trim($_POST['Email'] ?? '');
    $password = $_POST['Password'] ?? '';

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception("Please enter a valid email address.");
    }

    $statement = $pdo->query(ReturnStudent($email));
    $account = $statement->fetch();

    if (!$account) {
        throw new Exception("Account not found.");
    }

    if (!password_verify($password, $account['Password'])) {
        throw new Exception("Incorrect Password");
    }

    // Login successful
    $response["success"] = "true";
    $response["message"] = "Login Successful!";
    $response["studentID"] = (string)$account['StudentID'];
} catch (Exception $e) {
    $response["success"] = "false";
    $response["message"] = $e->getMessage();
    $response["studentID"] = null;
}

echo json_encode($response);
