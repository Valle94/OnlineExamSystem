<?php

$STUDENTS_QUERY = "SELECT *
                   FROM Student";

function ReturnStudent(string $email) {
    return "SELECT *
            FROM account
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

function DeleteStudent(int $id) {
    return "DELETE FROM student
            WHERE ID = $id";
}