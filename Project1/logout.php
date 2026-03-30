<?php
session_start(); // Start the session
session_unset(); // Unset all session variables
session_destroy(); // Destroy the session
// echo "Session destroyed.";
require "header.php";
?>

<html>
    <body>
        <p>You are now logged out.</p>
    </body>
</html>