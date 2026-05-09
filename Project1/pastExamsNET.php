<?php
require "dbConnection.php";

// Fetch all past exams by the currently logged in student.
$results = $pdo->query("SELECT * FROM ExamResults");
$pastExams = array_reverse($results->fetchall());

echo json_encode($pastExams);

?>
