<?php
session_start();
@include 'config.php';

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    $select = "SELECT * FROM user_form WHERE email = '$email'";

    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        $error[] = 'User already exists!';
    } else {
        if ($password !== $cpassword) {
            $error[] = 'Passwords do not match!';
        } else {
            // Hash the password before storing it in the database
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $insert = "INSERT INTO user_form (name, email, password) VALUES ('$name', '$email', '$hashed_password')";

            mysqli_query($conn, $insert);
            header('location: login.php');
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RegistrationPage</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>


    <form action="" method="post">
        <div class="container">

        <a href="#" class="logo">
        <img src="Images/Logo.png" alt="Logo">
        <span>I DO EVENT</span>
    </a>

            <h1>Register</h1>
            <p>Please fill in this form to create an account.</p>
            <?php
            if (isset($error)) {
                foreach ($error as $errorMsg) {
                    echo '<span class="error-msg">' . $errorMsg . '</span>';
                }
            }
            ?>
            <hr>
            <label for="name"><b>Name</b></label>
            <input type="text" placeholder="Enter Name" name="name" id="name" required>

            <label for="email"><b>Email</b></label>
            <input type="text" placeholder="Enter Email" name="email" id="email" required>

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="password" id="psw" required>

            <label for="cpsw"><b>Confirm Password</b></label>
            <input type="password" placeholder="Confirm Password" name="cpassword" id="cpsw" required>

            <hr>

            <button type="submit" name="submit" class="registerbtn">Register</button>

            <div class="signin">
                <p>Already have an account? <a href="login.php">Sign in</a>.</p>
            </div>
        </div>
    </form>
</body>
</html>
