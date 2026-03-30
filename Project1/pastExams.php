<?php
require "requires.php";

// Fetch all past exams by the currently logged in student.
$results = $pdo->query(ReturnResultsByStudent($_SESSION['studentID']));
$pastExams = array_reverse($results->fetchall());

require "header.php";

?>

<html>
<h2>Previous Exams for: <?= $_SESSION['email'] ?></h2>

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
            <?php foreach ($pastExams as $exams) { ?>
                <tr>
                    <td><?= $exams['Date'] ?></td>
                    <td><?= $exams['Time'] ?></td>
                    <td><?= $exams['Score'] ?></td>
                    <td><?= $exams['CorrectAnswers'] ?></td>
                    <td><?= $exams['WrongAnswers'] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>

</html>