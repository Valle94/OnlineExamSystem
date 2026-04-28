<?php
require "requires.php";
require "exam_questions.php";

$studentID = $_SESSION['studentID'];

// Build answer key dynamically
$answerKey = [];
foreach ($examQuestions as $key => $q) {
    $answerKey[$key] = $q['correct'];
}

// Get student answers
$studentAnswers = [
    "q1" => $_POST['q1'] ?? "",
    "q2" => $_POST['q2'] ?? "",
    "q3" => $_POST['q3'] ?? [],
    "q4" => $_POST['q4'] ?? [],
    "q5" => $_POST['q5'] ?? "",
];

// Calculate score
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

// Save results
$submitStudentExam = $pdo->query(SubmitExam($studentID, $date, $time, $score, $correctCount, $wrongCount));

require "header.php";
?>

<!DOCTYPE html>
<html>
<body>
    <p><strong>Score:</strong> <?php echo $score; ?>%</p>
    <p><strong>Correct Answers:</strong> <?php echo $correctCount; ?></p>
    <p><strong>Wrong Answers:</strong> <?php echo $wrongCount; ?></p>
    
    <h2>Question Review</h2>
    
    <?php 
    $questionNumber = 1;
    foreach ($examQuestions as $key => $q): 
        $correct = $answerKey[$key];
        $student = $studentAnswers[$key];
        
        // Determine if answer is correct
        $isCorrect = false;
        if (is_array($correct)) {
            $correctSorted = $correct;
            sort($correctSorted);
            $studentSorted = is_array($student) ? $student : [];
            sort($studentSorted);
            $isCorrect = ($studentSorted == $correctSorted);
        } else {
            $isCorrect = ($student == $correct);
        }
    ?>
        <div class="result-block">
            <h3><?php echo $questionNumber . '. ' . htmlspecialchars($q['text']); ?></h3>
            
            <?php if ($q['image']): ?>
                <div>
                    <img src="<?php echo htmlspecialchars($q['image']); ?>" 
                         alt="Question <?php echo $questionNumber; ?> image">
                </div>
            <?php endif; ?>
            
            <?php if ($q['subtext']): ?>
                <p><?php echo $q['subtext']; ?></p>
            <?php endif; ?>
            
            <p><strong>Your Answer:</strong> 
                <?php
                if (is_array($student)) {
                    $answerTexts = [];
                    foreach ($student as $letter) {
                        if (isset($q['options'][$letter])) {
                            $answerTexts[] = $q['options'][$letter];
                        } else {
                            $answerTexts[] = $letter;
                        }
                    }
                    echo implode(", ", $answerTexts);
                } else {
                    if (isset($q['options'][$student])) {
                        echo htmlspecialchars($q['options'][$student]);
                    } else {
                        echo htmlspecialchars($student);
                    }
                }
                ?>
            </p>
            
            <p><strong>Correct Answer:</strong> 
                <?php
                if (is_array($correct)) {
                    $correctTexts = [];
                    foreach ($correct as $letter) {
                        if (isset($q['options'][$letter])) {
                            $correctTexts[] = $q['options'][$letter];
                        } else {
                            $correctTexts[] = $letter;
                        }
                    }
                    echo implode(", ", $correctTexts);
                } else {
                    if (isset($q['options'][$correct])) {
                        echo htmlspecialchars($q['options'][$correct]);
                    } else {
                        echo htmlspecialchars($correct);
                    }
                }
                ?>
            </p>
            
            <p><strong>Result:</strong> 
                <?php echo $isCorrect ? 'Correct' : 'Incorrect'; ?>
            </p>
        </div>
        <hr>
    <?php 
    $questionNumber++;
    endforeach; 
    ?>
</body>
</html>