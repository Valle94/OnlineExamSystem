<?php
session_start();
require "dbconnection.php";
require "queries.php";
?>

<!DOCTYPE html>

<html>

<head>
    <h1>Online Exam System</h1>
</head>

<body>
    <nav>
        <a href="create_account.php">Create Account</a> |
        <a href="login.php">Login</a> |
        <a href="test.php">Login Test</a> |
        <a href="logout.php">Logout</a>
    </nav>
</body>

</html>