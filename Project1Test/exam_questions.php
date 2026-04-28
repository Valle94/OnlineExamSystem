<?php
// exam_questions.php
$examQuestions = [
    'q1' => [
        'text' => 'Consider the following associative array:',
        'image' => '../Images/Question1.png',  // Add image path
        'subtext' => 'What will the following line of code output?<br>echo $students[1]["name"]',
        'type' => 'radio',
        'options' => ['A' => 'Max', 'B' => "'name' => 'Max'", 'C' => 'Gabbie', 'D' => "'name' => 'Gabbie'", 'E' => 'Dan', 'F' => "'name' => 'Dan'"],
        'correct' => 'C'
    ],
    'q2' => [
        'text' => 'Consider the following code:',
        'image' => '../Images/Question2.png',
        'subtext' => 'What is the value of $equals?',
        'type' => 'radio',
        'options' => ['A' => '10', 'B' => 'True', 'C' => 'False', 'D' => '15'],
        'correct' => 'C'
    ],
    'q3' => [
        'text' => 'Select All Valid PHP Variables:',
        'image' => null,  // No image for this question
        'subtext' => null,
        'type' => 'checkbox',
        'options' => ['A' => 'number = 5', 'B' => '$number = 5', 'C' => '$5number = 5', 'D' => '$_number = 5', 'E' => '$number-5 = 5', 'F' => '$number_5 = 5'],
        'correct' => ['B', 'D', 'F']
    ],
    'q4' => [
        'text' => 'Select All Valid Ways of Embedding a PHP Tag Into HTML:',
        'image' => null,
        'subtext' => null,
        'type' => 'checkbox',
        'options' => ['A' => '&lt;php&gt; &lt;/php&gt;', 'B' => '&lt;?php ?&gt;', 'C' => '&lt;?= ?&gt;', 'D' => '&lt;php= ?&gt;', 'E' => '&lt;?php= ?&gt;'],
        'correct' => ['B', 'C']
    ],
    'q5' => [
        'text' => 'Using the following loop, how many times will "CITA 355" be printed?',
        'image' => '../Images/Question5.png',
        'subtext' => null,
        'type' => 'number',
        'options' => [],
        'correct' => '6'
    ]
];
?>