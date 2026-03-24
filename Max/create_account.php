<?php
require "header.php";

$user = [
    'firstname' => '',
    'lastname' => '',
    'email' => '',
    'password' => '',
    'pwconfirm' => '',
];

$errors = [
    'firstname' => '',
    'lastname' => '',
    'email' => '',
    'password' => '',
    'pwconfirm' => '',
];

$message = '';
$invalid = true;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collecting form data
    $user['firstname'] = trim($_POST['firstname'] ?? '');
    $user['lastname'] = trim($_POST['lastname'] ?? '');
    $user['email'] = trim($_POST['email'] ?? '');
    $user['password'] = $_POST['password'] ?? '';
    $user['pwconfirm'] = $_POST['pwconfirm'] ?? '';

    if (empty($user['firstname'])) {
        $errors['firstname'] =  "Please enter your first name.";
    } elseif (strlen($user['firstname']) > 30) {
        $errors['firstname'] = "First name exceeds 30 character limit.";
    } else {
        $errors['firstname'] = '';
    }

    if (empty($user['lastname'])) {
        $errors['lastname'] =  "Please enter your last name.";
    } elseif (strlen($user['lastname']) > 30) {
        $errors['lastname'] = "Last name exceeds 30 character limit.";
    } else {
        $errors['lastname'] = '';
    }

    $errors['email'] = ( // Email exists and is a valid email (contains @ and a . address)
        empty($user['email']) ||
        !filter_var($user['email'], FILTER_VALIDATE_EMAIL)) ? "Please enter a valid email address." : '';

    $errors['password'] = ( // Password exists, is greater than 8 characters, contains an upper
        empty($user['password']) || // case letter and a number. 
        strlen($user['password']) < 8 ||
        !preg_match('/[A-Z]/', $user['password']) ||
        !preg_match('/[0-9]/', $user['password'])
    ) ? "Password must be at least 8 characters, include one uppercase letter and one number." : '';
    $errors['pwconfirm'] = ( // Retype password exists and is the same as first password
        empty($user['pwconfirm']) ||
        $user['password'] !== $user['pwconfirm']) ? "Please re-enter your password." : '';

    $invalid = implode($errors);
}

if (!$invalid) {
    $insert = $pdo->query(AddStudent(
        $user['firstname'],
        $user['lastname'],
        $user['email'],
        password_hash($user['password'], PASSWORD_DEFAULT)
    ));

    // Adjust top message
    $message = "Account Creation Successful! You may now log in.";
} elseif ($invalid && $_SERVER["REQUEST_METHOD"] == "POST") {
    $message = "Please correct the following errors:";
} else {
    $message = '';
}
?>

<html>

<body>
    <h2>Account Registration</h2>
    <h3>
        <?php // Message at the top of the form
        if (!$invalid) {
            echo "<p style='color: green'>$message</p>";
        } else {
            echo "<p style='color: red';>$message</p>";
        } ?>
    </h3>
    <form action="create_account.php" method="POST">
        <span style="color: red" ;><?= $errors['firstname'] ?></span>
        <p>First Name: <input type="text" name="firstname"></p>
        <span style="color: red" ;><?= $errors['lastname'] ?></span>
        <p>Last Name: <input type="text" name="lastname"></p>
        <span style="color: red" ;><?= $errors['email'] ?></span>
        <p>Email Address: <input type="text" name="email"></p>
        <span style="color: red" ;><?= $errors['password'] ?></span>
        <p>Password: <input type="password" name="password"></p>
        <span style="color: red" ;><?= $errors['pwconfirm'] ?></span>
        <p>Re-type Password: <input type="password" name="pwconfirm"></p>
        <p><input type="reset" value="Clear Form"></p>
        <p><input type="submit" name="Submit" value="Submit Form"></p>
    </form>
</body>

</html>