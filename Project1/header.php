<!-- A header file containing the page header and
 page links.  -->

<?php
// Shared page header / navigation
?>
    <title> CITA 355 Exam </title>
    <link rel="stylesheet" href="style.css">
    <h1>CITA 355 Exam System</h1>

    <nav>
        <?php if (isset($_SESSION['logged_in']) && !empty($_SESSION['is_admin'])) { ?>
            <a href="adminSearch.php">Admin Search</a> |
            <a href="logout.php">Logout</a>
        <?php } elseif (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) { ?>
            <a href="examHomepage.php">Take Exam</a> |
            <a href="pastExams.php">Past Exams</a> |
            <a href="logout.php">Logout</a>
        <?php } else { ?>
            <a href="create_account.php">Create Account</a> |
            <a href="login.php">Login</a>
        <?php } ?>
    </nav>

    <hr>