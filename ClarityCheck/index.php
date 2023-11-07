<?php
    include("config/connection.php");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset= "utf-8" />
    <title> Clarity Check Login </title>
    <link href = "css/layout.css" rel = "stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
    <body>
        
    <!-- Form and CSS styling copied from https://www.w3schools.com/howto/howto_css_login_form.asp -->
        <form action="" method="GET"> 
        <div class="container">
            <label for="username"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="username" required>

            <!-- Mitigation - Type password hides passwords from being shown in clear text and prevents shoulder surfing -->
            <label for="password"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="password" required>
            
            <button name="submit" type="submit">Login</button>
            <a href="signup.php"> Don't have an account? </a>
        </div>
        </form>

        <?php

            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                if (isset($_GET['submit'])) {

                    $username = $_GET["username"];
                    $password = $_GET["password"];

                    // Query vulnerbale to SQL Injection
                    //$sql = "SELECT * FROM users WHERE username='". $username . "' AND password='" . $password . "';";
                    //$result = mysqli_query($con, $sql);

                    // Mitigation - Parameters are prepared and statement is executed
                    $params = array($username);
                    $result = $con->execute_query("SELECT * FROM users WHERE username=?", $params);

                    if (mysqli_num_rows($result) > 0 ) {
                        $user_data = mysqli_fetch_assoc($result);
                        $hashed_password = $user_data["password"];

                        if (password_verify($password, $hashed_password)) {

                            session_start();
                            $_SESSION['login']=true;
                            $_SESSION['username'] = $username;
                            echo "<br>";
                            echo "Successfully logged in!";
                            echo "<a href='view_prescription.php'> View your prescriptions here. </a>";
                        
                        } else {
                            print("Password is invalid");
                        }

                    } else {
                        print("Username or password is invalid");
                    }
                }
            }
        ?>

    </body>
</html>