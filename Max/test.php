<?php
require "header.php";
?>


<html>
<?php if (isset($_SESSION["email"]) && isset($_SESSION["logged_in"])) { ?>
    <p>You are logged in as <?= $_SESSION['email']?>.</p>
    <p>You may now take the exam.</p>
<?php } else { ?>
    <p>You are not logged in.</p>
    <p>Please log in to take the exam.</p>
<?php } ?>

</html>