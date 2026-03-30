<?php
require "requires.php";
require "header.php";

?>

<!DOCTYPE html>
<html>

<head>
    <title> Exam Homepage </title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1> Exam Homepage</h1>
    <h2> Welcome to the CITA 355 Online Exam </h2>

    <p>This exam contains 5 questions. <br>
        Make sure to answer all questions completely before submitting.</p>

    <!-- This check only shows the "take exam" button if 
 the user is logged in as a valid account.  -->
    <?php if (isset($_SESSION["email"]) && $_SESSION["logged_in"] === true) { ?>
        <p>You are logged in as <?= $_SESSION['email'] ?>.</p>
        <p>You may now take the exam.</p>

        <form action="exam.php" method="POST">
            <input type="submit" value="START EXAM">
        </form>
    <?php } else { ?> <!-- If not logged in, show error. -->
        <p>You are not logged in.</p>
        <p>Please log in to take the exam.</p>
    <?php } ?>
</body>

</html>