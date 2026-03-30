<?php
require "requires.php";

// This query fetches returns a record of exams taken by 
// the current user on the current day.
$results = $pdo->query(TestTakenToday($_SESSION['studentID']));
$testTaken = $results->fetch();
// If the current date equals the date in the returned row,
// the user will not be allowed to take the exam. 
if (date('Y-m-d') == $testTaken['Date']) {
	$canExam = false;
} else {
	$canExam = true;
}

require "header.php";

?>

<!DOCTYPE html>
<html>

<body>
	<!-- If the user can take the exam show the exam form -->
	<?php if ($canExam) { ?>
		<h1> CITA 355 Online Exam </h1>
		<p> Please Answer All Questions and Submit When Done. </p>
		<form action="results.php" method="post">

			<!-- Question 1 and 2 are radio buttons with only one correct answer. -->
			<h3> 1. Consider the following associative array:<br><br>

				<!-- We used images to show code blocks to avoid ugly html formatting. -->
				<img src="../Images/Question1.png" alt=""><br>
				What will the following line of code output?<br>
				echo $students[1]['name'] <br>
			</h3>

			<label> <input type="radio" name="q1" value="A" required> A: Max </label> <br>
			<label> <input type="radio" name="q1" value="B" required> B: 'name' => 'Max' </label> <br>
			<label> <input type="radio" name="q1" value="C" required> C: Gabbie </label> <br>
			<label> <input type="radio" name="q1" value="D" required> D: 'name' => 'Gabbie' </label> <br>
			<label> <input type="radio" name="q1" value="E" required> E: Dan </label> <br>
			<label> <input type="radio" name="q1" value="F" required> F: 'name' => 'Dan' </label> <br><br>


			<h3> 2. Consider the following code: <br><br>

				<img src="../Images/Question2.png" alt=""><br>

				What is the value of $equals? <br>
			</h3>

			<label> <input type="radio" name="q2" value="A" required> A: 10 </label> <br>
			<label> <input type="radio" name="q2" value="B" required> B: True </label> <br>
			<label> <input type="radio" name="q2" value="C" required> C: False </label> <br>
			<label> <input type="radio" name="q2" value="D" required> D: 15 </label> <br><br>

			<!-- Questions 3 and 4 are checkbox questions with multiple correct answers. -->
			<h3> 3. Select All Valid PHP Variables: </h3>
			<label> <input type="checkbox" name="q3[]" value="A"> A: number = 5 </label><br>
			<label> <input type="checkbox" name="q3[]" value="B"> B: $number = 5 </label><br>
			<label> <input type="checkbox" name="q3[]" value="C"> C: $5number = 5 </label><br>
			<label> <input type="checkbox" name="q3[]" value="D"> D: $_number = 5 </label><br>
			<label> <input type="checkbox" name="q3[]" value="E"> E: $number-5 = 5 </label><br>
			<label> <input type="checkbox" name="q3[]" value="F"> F: $number_5 = 5 </label><br><br>


			<h3> 4. Select All Valid Ways of Embedding a PHP Tag Into HTML: </h3>
			<label> <input type="checkbox" name="q4[]" value="A"> A: &lt;php&gt; &lt;/php&gt; </label><br>
			<label> <input type="checkbox" name="q4[]" value="B"> B: &lt;?php ?&gt; </label><br>
			<label> <input type="checkbox" name="q4[]" value="C"> C: &lt;?= ?&gt; </label><br>
			<label> <input type="checkbox" name="q4[]" value="D"> D: &lt;php= ?&gt; </label><br>
			<label> <input type="checkbox" name="q4[]" value="E"> E: &lt;?php= ?&gt; </label><br><br>

			<!-- Question 5 uses a number input (0-10) -->
			<h3> 5. Using the following loop, how many times will "CITA 355" be printed? <br><br>

				<img src="../Images/Question5.png" alt="">

			</h3>

			<label>Number of prints: <input type="number" name="q5" min="0" max="10" required> </label><br><br>

			<input type="submit" value="Submit Exam">

		</form>
	<?php } else { ?> <!-- If the user has taken the exam today, show error -->
		<h3>You cannot take the exam more than once per day. <br>
			Try again tomorrow.</h3>
	<?php } ?>




</body>

</html>