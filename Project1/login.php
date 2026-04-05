<?php

// require "requires.php";

// $user = [ // Initialize user variables
    //'email' => '',
    //'password' => '',
//];

//$errors = [ // initialize error messages
   // 'email' => '',
    //'password' => ''
//];

// Initialize message and invalid variables.
//$message = '';
//$invalid = true;

//if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collecting form data
   // $user['email'] = trim($_POST['email'] ?? '');
   // $user['password'] = $_POST['password'] ?? '';

    // Returning the logged in account from the database.
   // $statement = $pdo->query(ReturnStudent($user['email']));
   // $account = $statement->fetch();

    // 1. Validate Email Format
    //if (empty($user['email']) || !filter_var($user['email'], FILTER_VALIDATE_EMAIL)) {
      //  $errors['email'] = "Please enter a valid email address.";
   // }

    // 2. Validate Password (only if user was found)
    //if (!$account) {
     //   $errors['email'] = "Account not found.";
    //} else {
        // Use password_verify to check against the hash
       // if (!password_verify($user['password'], $account['Password'])) {
          //  $errors['password'] = "Incorrect Password";
       // }
    //}

   // $invalid = implode($errors);

    //if (!$invalid) { // If everything is valid, set some session variables for later use
       // $_SESSION["email"] = $account['Email'];
       // $_SESSION["studentID"] = $account['StudentID'];
       // $_SESSION["logged_in"] = true;
       // $message = "Login Successful!";
  //  } else {
       // $message = "Login Error.";
   // }
//}

//require "header.php";

//?>

<!--<html>

<body>
    <h2>Login</h2>
    <h3>
        <?php // Message at the top of the form
        //if (!$invalid) {
            //echo "<p style='color: green'>$message</p>";
       // } else {
          //  echo "<p style='color: red';>$message</p>";
       // } ?>
    </h3> -->
    <!-- If we're not logged in, show the login form, 
     else show nothing.  -->
    <?php //if (!isset($_SESSION['logged_in'])) { ?>
        <!--<form action="login.php" method="POST">
            <span style="color: red" ;><?//= //$errors['email'] ?></span>
            <p>Email: <input type="text" name="email"></p>
            <span style="color: red" ;><?//= //$errors['password'] ?></span>
            <p>Password: <input type="password" name="password"></p>
            <p><input type="reset" value="Clear Form"></p>
            <p><input type="submit" name="Submit" value="Login"></p>
        </form>
    <?php //} ?>
</body>

</html> -->

<!-- AI IMPLEMENTATION -->

<?php
require "requires.php";

$user = [
    'email' => '',
    'password' => '',
];

$errors = [
    'email' => '',
    'password' => ''
];

$message = '';
$invalid = true;

// Preset admin login
$adminUsername = 'admin';
$adminPassword = 'Admin123!';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user['email'] = trim($_POST['email'] ?? '');
    $user['password'] = $_POST['password'] ?? '';

    // Admin login path
    if ($user['email'] === $adminUsername) {
        if ($user['password'] === $adminPassword) {
            $_SESSION["email"] = $adminUsername;
            $_SESSION["logged_in"] = true;
            $_SESSION["is_admin"] = true;
            unset($_SESSION["studentID"]);

            header("Location: adminSearch.php");
            exit();
        } else {
            $errors['password'] = "Incorrect admin password.";
        }
    } else {
        // Normal student login
        if (empty($user['email']) || !filter_var($user['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Please enter a valid email address.";
        } else {
            $statement = $pdo->query(ReturnStudent($user['email']));
            $account = $statement->fetch();

            if (!$account) {
                $errors['email'] = "Account not found.";
            } else {
                if (!password_verify($user['password'], $account['Password'])) {
                    $errors['password'] = "Incorrect password.";
                }
            }
        }

        $invalid = implode($errors);

        if (!$invalid && isset($account)) {
            $_SESSION["email"] = $account['Email'];
            $_SESSION["studentID"] = $account['StudentID'];
            $_SESSION["logged_in"] = true;
            $_SESSION["is_admin"] = false;

            header("Location: examHomepage.php");
            exit();
        }
    }

    $invalid = implode($errors);

    if ($invalid) {
        $message = "Login Error.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php require "header.php"; ?>

    <h2>Login</h2>

    <?php if ($message !== '') { ?>
        <p class="error"><?php echo $message; ?></p>
    <?php } ?>

    <?php if (!isset($_SESSION['logged_in'])) { ?>
        <form action="login.php" method="POST">
            <span style="color: red"><?php echo $errors['email']; ?></span>
            <p>Email Address or Admin Username:
                <input type="text" name="email" value="<?php echo htmlspecialchars($user['email']); ?>">
            </p>

            <span style="color: red"><?php echo $errors['password']; ?></span>
            <p>Password:
                <input type="password" name="password">
            </p>

            <p><input type="reset" value="Clear Form"></p>
            <p><input type="submit" name="Submit" value="Login"></p>
        </form>

        <p><strong>Preset admin login:</strong> username = admin, password = Admin123!</p>
    <?php } else { ?>
        <p class="success">You are already logged in.</p>
    <?php } ?>
</body>
</html>