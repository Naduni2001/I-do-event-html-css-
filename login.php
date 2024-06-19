<?php
session_start();
@include 'config.php';

if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $select = "SELECT * FROM user_form WHERE email = '$email'";

    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        $stored_password = $row['password'];

        if (password_verify($password, $stored_password)) {
            // Password is correct. Login the user.
            header('location: IDOevent.html');
            exit();
        } else {
            $error[] = 'Incorrect email or password!';
        }
    } else {
        $error[] = 'User not found!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoginPage</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>


    <form action="" method="post">
        <div class="container">
                
          <a href="#" class="logo">
                <!-- <img src="Images/Logo.png" alt="Logo"> -->
                 <span>i do event</span>
            </a>

            <h1>User Login</h1>
            <p>Login Here</p>
            <?php
            if (isset($error)) {
                foreach ($error as $errorMsg) {
                    echo '<span class="error-msg">' . $errorMsg . '</span>';
                }
            }
            ?>
            <hr>
            <label for="email"><b>Email</b></label>
            <input type="text" placeholder="Enter Email" name="email" id="email" required>

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="password" id="psw" required>

            <hr>

            <button type="submit" name="submit" class="registerbtn">Login</button>

            <div class="signin">
                <p>Don't have an account? <a href="registration.php">Sign up</a>.</p>
            </div>
        </div>
    </form>
    
</body>
</html>
