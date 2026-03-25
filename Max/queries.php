<?php

$STUDENTS_QUERY = "SELECT *
                   FROM Student";

function ReturnStudent(string $email) {
    return "SELECT *
            FROM account
            WHERE email = '$email'";
}

function ReturnExamResults(string $email) {
    return "SELECT *
            FROM examresults
            WHERE email = '$email'";
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

function SubmitExam (
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

function DeleteStudent(int $id) {
    return "DELETE FROM student
            WHERE ID = $id";
}