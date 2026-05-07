<?php
require "requires.php";

$studentID = (int)$_POST['StudentID'];

$answerKey =
	[
		"q1" => "C",
		"q2" => "C",
		"q3" => ["B", "D", "F"],
		"q4" => ["B", "C"],
		"q5" => "6"
	];

$questions =
	[
		"q1" => "Question 1",
		"q2" => "Question 2",
		"q3" => "Question 3",
		"q4" => "Question 4",
		"q5" => "Question 5"

	];

$studentAnswers =
	[
		"q1" => $_POST['q1'] ?? "",
		"q2" => $_POST['q2'] ?? "",
		"q3" => json_decode($_POST['q3']) ?? [],
		"q4" => json_decode($_POST['q4']) ?? [],
		"q5" => $_POST['q5'] ?? "",
	];

$correctCount = 0;
$wrongCount = 0;
$totalCount = 5;

foreach ($answerKey as $key => $correct) {
	$student = $studentAnswers[$key];

	// When working with checkboxes it is important to check if there
	// are multiple values selected and to order them.
	// The if statment checks to see if multiple answers have been selected
	//sort($correct); Makes sure they are sorted alphbetically
	//$studentSorted = is_array($student) ? $student : []; means
	// if a user selected multiple choices use them and if not
	//to use an empty array. Sort both correct answers and student
	//answers so order does not matter.
	if (is_array($correct)) {
		sort($correct);
		$studentSorted = is_array($student) ? $student : [];
		sort($studentSorted);

		// Check to see if its wrong or right then add one to the correct/wrong count accordingly.
		if ($studentSorted == $correct) {
			$correctCount++;
		} else {
	$wrongCount++;
	}
}

	 //If the answer is not an array just check if it's correct or not
	else {
		if ($student == $correct) {
			$correctCount++;
		} else {
			$wrongCount++;
		}
		}
}

$score = ($correctCount / $totalCount) * 100;

//Format to get the date and time
$date = date("Y-m-d");
$time = date("H:i:s");

//Saving the Results of the test into the Results Table in SQL
// try is like an if statment and catch is like the else statment
try {
    $submitStudentExam = $pdo->query(SubmitExam($studentID, $date, $time, $score, $correctCount, $wrongCount));

    $statement = $pdo->query(SELECT * FROM account WHERE StudentID = $studentID)
    $thisStudent = $statement->fetch();

    echo json_encode([
        "success" => true,
        "studentID" => $studentID,
        "firstName" => $thisStudent["FirstName"],
        "lasttName" => $thisStudent["LastName"],
        "email" => $thisStudent["Email"],
        "score" => $score,
        "correctCount" => $correctCount,
        "wrongCount" => $wrongCount,
        "totalCount" => $totalCount,
        "date" => $date,
        "time" => $time,
        "studentAnsQ1" => $studentAnswers["q1"],
        "studentAnsQ2" => $studentAnswers["q2"],
        "studentAnsQ3" => $studentAnswers["q3"],
        "studentAnsQ4" => $studentAnswers["q4"],
        "studentAnsQ5" => $studentAnswers["q5"]
    ]);
} 

catch (Exception $e) 
{
    echo json_encode([
        "success" => false,
        "message" => "There was an error submitting your results."
    	]);
}


?>

