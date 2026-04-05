<?php
//require "requires.php";

// Fetch all past exams by the currently logged in student.
//$results = $pdo->query(ReturnResultsByStudent($_SESSION['studentID']));
//$pastExams = array_reverse($results->fetchall());

//require "header.php";

?>
<!--
<html>
<h2>Previous Exams for: <?= //$_SESSION['email'] ?></h2>

<body>
    <table>
        <thead>

            <tr>
                <th>Date</th>
                <th>Time</th>
                <th>Score</th>
                <th>Correct Answers</th>
                <th>Wrong Answers</th>
            </tr>
        </thead>
        <tbody>
            <?php //foreach ($pastExams as $exams) { ?>
                <tr>
                    <td><?//= $exams['Date'] ?></td>
                    <td><?//= //$exams['Time'] ?></td>
                    <td><?//= $exams['Score'] ?></td>
                    <td><?//= $exams['CorrectAnswers'] ?></td>
                    <td><?//= $exams['WrongAnswers'] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>

</html> -->


<!-- AI IMPLEMTATION -->

<?php
require "requires.php";

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

if (!empty($_SESSION['is_admin'])) {
    header("Location: adminSearch.php");
    exit();
}

$results = $pdo->query(ReturnResultsByStudent($_SESSION['studentID']));
$pastExams = array_reverse($results->fetchAll());
?>
<!DOCTYPE html>
<html>
<head>
    <title>Past Exams</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php require "header.php"; ?>

    <h2>Previous Exams for: <?php echo htmlspecialchars($_SESSION['email']); ?></h2>

    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Time</th>
                <th>Score</th>
                <th>Correct Answers</th>
                <th>Wrong Answers</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pastExams as $exams) { ?>
                <tr>
                    <td><?php echo $exams['Date']; ?></td>
                    <td><?php echo $exams['Time']; ?></td>
                    <td><?php echo $exams['Score']; ?></td>
                    <td><?php echo $exams['CorrectAnswers']; ?></td>
                    <td><?php echo $exams['WrongAnswers']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>