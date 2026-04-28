<?php

require "requires.php";

$user = [ // Initialize user variables
    'email' => '',
    'password' => '',
];

$errors = [ // initialize error messages
    'email' => '',
    'password' => ''
];

// Initialize message and invalid variables.
$message = '';
$invalid = true;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collecting form data
    $user['email'] = trim($_POST['email'] ?? '');
    $user['password'] = $_POST['password'] ?? '';

    // Returning the logged in account from the database.
    $statement = $pdo->query(ReturnStudent($user['email']));
    $account = $statement->fetch();

    // 1. Validate Email Format
    if (empty($user['email']) || !filter_var($user['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Please enter a valid email address.";
    }

    // 2. Validate Password (only if user was found)
    if (!$account) {
        $errors['email'] = "Account not found.";
    } else {
        // Use password_verify to check against the hash
        if (!password_verify($user['password'], $account['Password'])) {
            $errors['password'] = "Incorrect Password";
        }
    }

    $invalid = implode($errors);

    if (!$invalid) { // If everything is valid, set some session variables for later use
        $_SESSION["email"] = $account['Email'];
        $_SESSION["studentID"] = $account['StudentID'];
        $_SESSION["logged_in"] = true;
        $message = "Login Successful!";
    } else {
        $message = "Login Error.";
    }
}

require "header.php";

?>

<html>

<body>
    <h2>Login</h2>
    <h3>
        <?php // Message at the top of the form
        if (!$invalid) {
            echo "<p style='color: green'>$message</p>";
        } else {
            echo "<p style='color: red';>$message</p>";
        } ?>
    </h3>
    <!-- If we're not logged in, show the login form, 
     else show nothing.  -->
    <?php if (!isset($_SESSION['logged_in'])) { ?>
        <form action="login.php" method="POST">
            <span style="color: red" ;><?= $errors['email'] ?></span>
            <p>Email: <input type="text" name="email"></p>
            <span style="color: red" ;><?= $errors['password'] ?></span>
            <p>Password: <input type="password" name="password"></p>
            <p><input type="reset" value="Clear Form"></p>
            <p><input type="submit" name="Submit" value="Login"></p>
        </form>
    <?php } ?>
</body>

</html>