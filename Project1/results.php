<?php
//require "requires.php";

//$studentID = $_SESSION['studentID'];

//$answerKey =
//	[
	//	"q1" => "C",
	//	"q2" => "C",
	//	"q3" => ["B", "D", "F"],
	//	"q4" => ["B", "C"],
	//	"q5" => "6"
//	];

//$questions =
//	[
	//	"q1" => "Question 1",
//		"q2" => "Question 2",
//		"q3" => "Question 3",
	//	"q4" => "Question 4",
//		"q5" => "Question 5"

//	];

//$studentAnswers =
	//[
	//	"q1" => $_POST['q1'] ?? "",
	//	"q2" => $_POST['q2'] ?? "",
	//	"q3" => $_POST['q3'] ?? [],
	//	"q4" => $_POST['q4'] ?? [],
	//	"q5" => $_POST['q5'] ?? "",
//	];

//$correctCount = 0;
//$wrongCount = 0;
//$totalCount = 5;

//foreach ($answerKey as $key => $correct) {
	//$student = $studentAnswers[$key];

	// When working with checkboxes it is important to check if there
	// are multiple values selected and to order them.
	// The if statment checks to see if multiple answers have been selected
	// sort($correct); Makes sure they are sorted alphbetically
	// $studentSorted = is_array($student) ? $student : []; means
	// if a user selected multiple choices use them and if not
	// to use an empty array. Sort both correct answers and student
	// answers so order does not matter.
	//if (is_array($correct)) {
	//	sort($correct);
	//	$studentSorted = is_array($student) ? $student : [];
	//	sort($studentSorted);

		// Check to see if its wrong or right then add one to the correct/wrong count accordingly.
	//	if ($studentSorted == $correct) {
	//		$correctCount++;
	//	} else {
	//		$wrongCount++;
	//	}
//	}

	// If the answer is not an array just check if it's correct or not
	//else {
	//	if ($student == $correct) {
	//		$correctCount++;
	//	} else {
	//		$wrongCount++;
	//	}
//	}
//}

//$score = ($correctCount / $totalCount) * 100;

// Format to get the date and time
//$date = date("Y-m-d");
//$time = date("H:i:s");

// Saving the Results of the test into the Results Table in SQL
//try {
//	$submitStudentExam = $pdo->query(SubmitExam($studentID, $date, $time, $score, $correctCount, $wrongCount));
//} catch (Exception $e) {
//	echo "There was an error submitting your results.";
//}

//require "header.php";

?>

<!--
<!DOCTYPE html>
<html>

<head>
	<title> Results </title>
	<link rel="stylesheet" href="style.css">
</head>

<body>

	<p><strong>Score: </strong><?php// echo $score; ?>%</p>
	<p><strong>Correct Answers: </strong><?php //echo $correctCount; ?> </p>
	<p><strong>Wrong Answers: </strong><?php //echo $wrongCount; ?> </p>

	<h2> Question Review </h2> -->

	<!-- Different way of doing a foreach loop in php when needing to switch between html and php -->
	<?php //foreach ($questions as $key => $questionText): ?>
	<!--	<p><strong>Your Answer: </strong>
			<?php

			// implode turns an array into a string
			// htmlsecialchars() protects the page from breaking if an answer includes
			// a special character such as $ % & etc
			//if (is_array($studentAnswers[$key])) {
			//	echo implode(", ", $studentAnswers[$key]);
			//} else {
			//	echo htmlspecialchars($studentAnswers[$key]);
			//}
			?>
		</p>

		<p>
			<strong> Correct Answer: </strong>
			//<?php
			//if (is_array($answerKey[$key])) {
			//	echo implode(", ", $answerKey[$key]);
			//} else {
			//	echo htmlspecialchars($answerKey[$key]);
			//}
			?>
		</p>
	<?php //endforeach; ?>

</body>

</html> -->


<!-- AI IMPLEMENTATION -->

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

$studentID = $_SESSION['studentID'];

$answerKey = [
    "q1" => "C",
    "q2" => "C",
    "q3" => ["B", "D", "F"],
    "q4" => ["B", "C"],
    "q5" => "6"
];

$questions = [
    "q1" => "Question 1",
    "q2" => "Question 2",
    "q3" => "Question 3",
    "q4" => "Question 4",
    "q5" => "Question 5"
];

$studentAnswers = [
    "q1" => $_POST['q1'] ?? "",
    "q2" => $_POST['q2'] ?? "",
    "q3" => $_POST['q3'] ?? [],
    "q4" => $_POST['q4'] ?? [],
    "q5" => $_POST['q5'] ?? "",
];

$correctCount = 0;
$wrongCount = 0;
$totalCount = 5;

foreach ($answerKey as $key => $correct) {
    $student = $studentAnswers[$key];

    if (is_array($correct)) {
        sort($correct);
        $studentSorted = is_array($student) ? $student : [];
        sort($studentSorted);

        if ($studentSorted == $correct) {
            $correctCount++;
        } else {
            $wrongCount++;
        }
    } else {
        if ($student == $correct) {
            $correctCount++;
        } else {
            $wrongCount++;
        }
    }
}

$score = ($correctCount / $totalCount) * 100;
$date = date("Y-m-d");
$time = date("H:i:s");

try {
    $submitStudentExam = $pdo->query(
        SubmitExam($studentID, $date, $time, $score, $correctCount, $wrongCount)
    );
} catch (Exception $e) {
    $submitError = "There was an error submitting your results.";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Results</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php require "header.php"; ?>

    <?php if (!empty($submitError)) { ?>
        <p class="error"><?php echo $submitError; ?></p>
    <?php } ?>

    <p><strong>Score:</strong> <?php echo $score; ?>%</p>
    <p><strong>Correct Answers:</strong> <?php echo $correctCount; ?></p>
    <p><strong>Wrong Answers:</strong> <?php echo $wrongCount; ?></p>

    <h2>Question Review</h2>

    <?php foreach ($questions as $key => $questionText): ?>
        <p><strong><?php echo $questionText; ?></strong></p>

        <p><strong>Your Answer:</strong>
            <?php
            if (is_array($studentAnswers[$key])) {
                echo implode(", ", $studentAnswers[$key]);
            } else {
                echo htmlspecialchars($studentAnswers[$key]);
            }
            ?>
        </p>

        <p><strong>Correct Answer:</strong>
            <?php
            if (is_array($answerKey[$key])) {
                echo implode(", ", $answerKey[$key]);
            } else {
                echo htmlspecialchars($answerKey[$key]);
            }
            ?>
        </p>
        <hr>
    <?php endforeach; ?>
</body>
</html>