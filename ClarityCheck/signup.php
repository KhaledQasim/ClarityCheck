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
        <form action="" method="POST"> 
        <div class="container">

            <!-- Validate username -->
            <label for="username"><b>Username</b></label>
            <input 
            type="text" 
            placeholder="Enter Username" 
            name="username" 
            pattern="^[a-zA-Z0-9]*$"
            oninvalid="this.setCustomValidity('Username must only contain letters and numbers')"
            oninput ="setCustomValidity('')"
            required>

            <!-- Mitigation: Client-side password validation -->
            <label for="password"><b>Password</b></label>
            <input 
            type="password" 
            placeholder="Enter Password" 
            name="password" 
            pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$"
            oninvalid="this.setCustomValidity('Password must contain at least 8 characters including one uppercase and lowercase letter, one number, and one special character')"
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

                    // Mitigation: Server-side password validation (https://www.codexworld.com/how-to/validate-password-strength-in-php/)
                    $uppercase = preg_match('@[A-Z]@', $password);
                    $lowercase = preg_match('@[a-z]@', $password);
                    $number    = preg_match('@[0-9]@', $password);
                    $specialChars = preg_match('@[^\w]@', $password);
                    
                    if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {

                        echo 'Password must contain at least 8 characters including one uppercase and lowercase letter, one number, and one special character';
                    
                    } else {
                        # Mitigation - Password hashing
                        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                        # Insecure code - Query vulnerbale to SQL Injection
                        # $sql = "INSERT INTO users VALUES('". $username . "', '" . $password . "');";
                        # $result = mysqli_query($con, $sql);

                        # Mitigation: Prepared Statement
                        $params = array($username, $hashed_password);
                        $result = $con->execute_query("INSERT INTO users VALUES(?, ?)", $params);

                        echo "<br>";
                        echo "Account Created!";
                        echo "<a href='index.php'> Login here. </a>";
                    }
                }
            }
        ?>



    </body>
</html>