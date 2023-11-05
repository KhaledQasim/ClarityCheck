<?php
    include("config/connection.php");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset= "utf-8" />
    <title> Clarity Check Signup </title>
    <link href = "css/layout.css" rel = "stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
    <body>
    <!-- Form and CSS styling copied from https://www.w3schools.com/howto/howto_css_login_form.asp -->
        <form action="" method="POST"> <!-- index.php -->
        <div class="container">

            <label for="username"><b>Username</b></label>
            <input 
            type="text" 
            placeholder="Enter Username" 
            name="username" 
            required>

            <label for="password"><b>Password</b></label>
            <input 
            type="password" 
            placeholder="Enter Password" 
            name="password" 
            required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
            oninvalid="this.setCustomValidity('Password must contain 8 characters including an uppercase, lowercase and a number')"
            oninput ="setCustomValidity('')"
            required>
            
            <button name="submit" type="submit">Create Account</button>
            <a href="index.php"> Already have an account? </a>
        </div>
        </form>

        <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset($_POST['submit'])) {
                    $username = $_POST["username"];
                    $password = $_POST["password"];

                    # Mitigation - Password is sent and stored as a hash.
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                    # Query vulnerbale to SQL Injection
                    # $sql = "INSERT INTO users VALUES('". $username . "', '" . $password . "');";
                    # $result = mysqli_query($con, $sql);

                    # Mitigation - Prepares, binds parameters, and executes SQL statement (https://www.php.net/manual/en/mysqli.execute-query.php)
                    $params = array($username, $hashed_password);
                    $result = $con->execute_query("INSERT INTO users VALUES(?, ?)", $params);
                }
            }
        ?>



    </body>
</html>