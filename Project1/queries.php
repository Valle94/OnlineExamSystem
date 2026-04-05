<?php
// These functions are used to more nicely format
// the queries in the other PHP docs. They take in 
// query-specific arguments and returns the query 
// as a string. 

//function ReturnStudent(string $email) {
//    return "SELECT *
//            FROM account
//            WHERE email = '$email'";
//}

//function ReturnResultsByStudent(int $studentID) {
//    return "SELECT *
 //           FROM examresults
//            WHERE studentID = '$studentID'";
//}


//function TestTakenToday(int $studentID) {
//    return "SELECT *
//            FROM examresults
//            WHERE studentID = '$studentID' AND
 //           Date = CURDATE()";
//}

//function AddStudent(
//    string $fName, 
//    string $lName,
 //   string $email,
//    string $password
 //   ) {
//    return "INSERT INTO account (FirstName, LastName, Email, Password)
//            VALUES (
//                '$fName',
//                '$lName',
//                '$email',
 //               '$password'
 //           )";
//}

//function SubmitExam (
//    int $studentid,
//    string $date,
//    string $time,
//    float $score,
//    int $correctAnswers,
//    int $wrongAnswers
//    ) {
//        return "INSERT INTO examresults (StudentID, Date, Time, Score, CorrectAnswers, WrongAnswers)
//                VALUES (
//                    $studentid,
 //                   '$date',
//                    '$time',
//                    $score,
//                    $correctAnswers,
 //                   $wrongAnswers
//                )";
//    }


// AI IMPLEMENTATION 

?>

<?php
function ReturnStudent(string $email) {
    return "SELECT *
            FROM account
            WHERE Email = '$email'";
}

function ReturnResultsByStudent(int $studentID) {
    return "SELECT *
            FROM examresults
            WHERE StudentID = '$studentID'";
}

function TestTakenToday(int $studentID) {
    return "SELECT *
            FROM examresults
            WHERE StudentID = '$studentID'
            AND Date = CURDATE()";
}

function AddStudent(
    string $fName,
    string $lName,
    string $email,
    string $password
) {
    return "INSERT INTO account (FirstName, LastName, Email, Password)
            VALUES (
                '$fName',
                '$lName',
                '$email',
                '$password'
            )";
}

function SubmitExam(
    int $studentid,
    string $date,
    string $time,
    float $score,
    int $correctAnswers,
    int $wrongAnswers
) {
    return "INSERT INTO examresults (StudentID, Date, Time, Score, CorrectAnswers, WrongAnswers)
            VALUES (
                $studentid,
                '$date',
                '$time',
                $score,
                $correctAnswers,
                $wrongAnswers
            )";
}
?>