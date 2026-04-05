<?php
//session_start(); // Start the session
//session_unset(); // Unset all session variables
//session_destroy(); // Destroy the session
// echo "Session destroyed.";
//require "header.php";
?>

<!--
<html>
    <body>
        <p>You are now logged out.</p>
    </body>
</html> -->

<!-- AI IMPLEMENTATION -->

<?php
require "requires.php";

session_unset();
session_destroy();
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Logout</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php require "header.php"; ?>
    <p>You are now logged out.</p>
</body>
</html>