<!-- A header file containing the page header and
 page links.  -->

<!DOCTYPE html>

<html>

<head>
	<title> CITA 355 Exam </title>
	<link rel="stylesheet" href="style.css">
    <h1>CITA 355 Exam System</h1>
</head>

<body>
    <nav>
        <?php if (isset($_SESSION['logged_in']) ) { ?>
            <a href="examHomepage.php">Take Exam</a> |
            <a href="pastExams.php">Past Exams</a> |
            <a href="logout.php">Logout</a>
        <?php } else { ?>
            <a href="create_account.php">Create Account</a> |
            <a href="login.php">Login</a>
        <?php } ?>
    </nav>
</body>

</html>