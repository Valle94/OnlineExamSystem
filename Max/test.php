<?php
require "header.php";
?>


<html>
<?php if (isset($_SESSION["email"]) && $_SESSION["logged_in"] === true) { ?>
    <p>You are logged in as <?= $_SESSION['email'] ?>.</p>
    <p>You may now take the exam.</p>
    <form action="exam.php">
        <p>
            <input type="submit" value="Start Exam">
        </p>
    </form>
<?php } else { ?>
    <p>You are not logged in.</p>
    <p>Please log in to take the exam.</p>
<?php } ?>

</html>