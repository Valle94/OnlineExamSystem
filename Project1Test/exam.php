<?php
require "requires.php";
require "exam_questions.php";

$results = $pdo->query(TestTakenToday($_SESSION['studentID']));
$testTaken = $results->fetch();
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
    <?php if ($canExam) { ?>
        <h1>CITA 355 Online Exam</h1>
        <p>Please Answer All Questions and Submit When Done.</p>
        
        <form action="results.php" method="post">
            <?php 
            $questionNumber = 1;
            foreach ($examQuestions as $key => $q): 
            ?>
                <div class="question-block">
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
                    
                    <?php if ($q['type'] == 'radio'): ?>
                        <?php foreach ($q['options'] as $val => $label): ?>
                            <label>
                                <input type="radio" name="<?php echo $key; ?>" value="<?php echo $val; ?>" required> 
                                <?php echo htmlspecialchars($label); ?>
                            </label><br>
                        <?php endforeach; ?>
                    
                    <?php elseif ($q['type'] == 'checkbox'): ?>
                        <?php foreach ($q['options'] as $val => $label): ?>
                            <label>
                                <input type="checkbox" name="<?php echo $key; ?>[]" value="<?php echo $val; ?>"> 
                                <?php echo htmlspecialchars($label); ?>
                            </label><br>
                        <?php endforeach; ?>
                    
                    <?php elseif ($q['type'] == 'number'): ?>
                        <label>
                            Number of prints: 
                            <input type="number" name="<?php echo $key; ?>" min="0" max="10" required>
                        </label><br>
                    <?php endif; ?>
                </div>
                <hr>
            <?php 
            $questionNumber++;
            endforeach; 
            ?>
            
            <input type="submit" value="Submit Exam">
        </form>
        
    <?php } else { ?>
        <h3>You cannot take the exam more than once per day.<br>
        Try again tomorrow.</h3>
    <?php } ?>
</body>
</html>