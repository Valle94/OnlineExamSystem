<?php

session_start();

?>

<!DOCTYPE html>
<html> 
<head> 
	<title> CITA 355 Exam </title>
	<link rel="stylesheet" href="../style.css">
</head>

<body>
	<h1> CITA 355 Online Exam </h1>
	<p> Please Answer All Questions and Submit When Done. </p>

	<form action="results.php" method="post">

		<h3> 1. Consider the following associative array:<br><br>

		$students = [ <br>
			['name' => 'Max', 'email' => 'max@email.com', <br>'major' => 'Game Programming'],<br>
			['name' => 'Gabbie', 'email' => <br>'gabbie@email.com', 'major' => 'Cyber Security'], <br>
			['name' => 'Dan', 'email' => 'dan@email.com', 'major' => <br>'Information Technology']<br>
			]<br> <br>

			What will the following line of code output?<br>
			echo $students[1]['name'] <br><br>
		 </h3>

		<label> <input type="radio" name ="q1" value="A" required> A: Max </label> <br>
		<label> <input type="radio" name ="q1" value="B" required> B: 'name' => 'Max' </label> <br>
		<label> <input type="radio" name ="q1" value="C" required> C: Gabbie </label> <br>
		<label> <input type="radio" name ="q1" value="D" required> D: 'name' => 'Gabbie' </label> <br>
		<label> <input type="radio" name ="q1" value="E" required> E: Dan </label> <br>
		<label> <input type="radio" name ="q1" value="F" required> F: 'name' => 'Dan' </label> <br><br>


		<h3> 2. Consider the following code: <br><br>

			$num1 = 10<br>
			$num2 = 15<br>
			$equals = ($num1 === $num2) ? true : false;<br><br>

			What is the value of $equals? <br><br> 
		</h3>

		<label> <input type="radio" name ="q2" value="A" required> A: 10 </label> <br>
		<label> <input type="radio" name ="q2" value="B" required> B: True </label> <br>
		<label> <input type="radio" name ="q2" value="C" required> C: False </label> <br>
		<label> <input type="radio" name ="q2" value="D" required> D: 15 </label> <br><br>


		<h3> 3. Select All Valid PHP Variables: </h3>
		<label> <input type="checkbox" name="q3[]" value="A"> A: number = 5 </label><br>
		<label> <input type="checkbox" name="q3[]" value="B"> B: $number = 5 </label><br>
		<label> <input type="checkbox" name="q3[]" value="C"> C: $5number = 5 </label><br>
		<label> <input type="checkbox" name="q3[]" value="D"> D: $_number = 5 </label><br>
		<label> <input type="checkbox" name="q3[]" value="E"> E: $number-5 = 5 </label><br>
		<label> <input type="checkbox" name="q3[]" value="F"> F: $number_5 = 5 </label><br><br>


		<h3> 4. Select All Valid Ways of Embedding a PHP Tag Into HTML: </h3>
		<label> <input type="checkbox" name="q4[]" value="A"> A: fueiwb </label><br>
		<label> <input type="checkbox" name="q4[]" value="B"> B: gfuegf </label><br>
		<label> <input type="checkbox" name="q4[]" value="C"> C: gfuegf </label><br>
		<label> <input type="checkbox" name="q4[]" value="D"> D: gfuegf </label><br>
		<label> <input type="checkbox" name="q4[]" value="E"> E: gfuegf </label><br><br>

		<h3> 5. Using the following loop, how many times will "CITA 355" be printed? <br><br>


			for ($i = 0; $i <= 5; $i++) { <br>
			echo "CITA 355"; <br>
			}<br><br>

			
		 </h3>

		<label> <input type="number" name ="q5" min="1" max="10" required> </label><br><br>

		<input type="submit" value="Submit Exam">

	</form>


</body>
</html>