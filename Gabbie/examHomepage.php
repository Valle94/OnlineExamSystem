<?php
require "header.php";
?>

<!DOCTYPE html>
<html>
<head> 
    <title> Exam Homepage </title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <h1> Exam Homepage</h1>
    <h2> Welcome to the CITA 355 Online Exam </h2>

    <p>This exam contains 5 questions. <br>
    Make Sure to Answer all the Questions to the best of your Ability </p>

<?php if (isset($_SESSION["email"]) && isset($_SESSION["logged_in"])) { ?>
    <p>You are logged in as <?= $_SESSION['email']?>.</p>
    <p>You may now take the exam.</p>
<?php } else { ?>
    <p>You are not logged in.</p>
    <p>Please log in to take the exam.</p>
<?php } ?>
</body>

</html>
