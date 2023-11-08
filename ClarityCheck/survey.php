<?php
// Imports the mysql database connection settings then checks for the existence of the users table and user_prescriptions table. 
// If they do not exist, they are created.
session_start();
include("config/connection.php");



?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title> Clarity Check Login </title>
    <link href="css/layout.css" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
   


   

    <!-- Form and CSS styling copied from https://www.w3schools.com/howto/howto_css_login_form.asp -->


    <?php
    if ($_SESSION['login'] === true) {
        echo "<h1>Please Complete the below Eye Prescription Survey</h1>";
        $html =
            "
            <form action='index.php' method='POST'>
            <button type='submit' name='logout.php' class='round-button-top-right'>LogOut</button>
            </form>
            <form method='POST' action=''>


            <label for='age'>Your Age:</label>
            <input type='number' name='age' required><br>
    
    
    
            <br>
            <label for='irritation'>Do You feel any irritation in your eyes?</label>
            <input type='radio' name='irritation' value='Yes' required>Yes
            <input type='radio' name='irritation' value='No'>No<br>
            <br>
    
            <label required for='glasses'>Do you currently wear glasses?</label>
            <input type='radio' name='glasses' value='Yes' required>Yes
            <input type='radio' name='glasses' value='No'>No<br>
    
            <img src='eye-test.png' alt='eye-test-image'/>
    
            <h4> Without reading glasses, position yourself 16 inches/ 40 cm away from the computer screen or smartphone.
            </h4>
            <h4>Test each eye separately by covering the eye not being tested.</h4>
            <h4>Choose the reading glasses strength Lens Power next to the lowest (smallest) letters you can read easily for
            each eye. Fill the data in the inputs below</h4>
          
            <label for='right-eye'>Your Right Eye Value:</label>
            <input type='number' name='right-eye' required><br>
            <br>
    
            <label for='left-eye'>Your Left Eye Value:</label>
            <input type='number' name='left-eye' required><br>
    
    
    
    
    
            <button class='default-button' name='submit' type='submit'>Submit</button>
        </form>
    
    "

        ;
        echo $html;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['submit'])) {
                $username = $_SESSION["username"];

                $age = $_POST["age"];
                $irritation = $_POST["irritation"];
                $glasses = $_POST["glasses"];
                $right_eye = $_POST["right-eye"];
                $left_eye = $_POST["left-eye"];
                
          
                $data_array = array($age, $irritation, $glasses, $right_eye, $left_eye);
                $data = implode(",",$data_array);
              
              
               
                # Insecure code - Query vulnerable to SQL Injection
                # $sql = "INSERT INTO user_prescriptions VALUES('". $username . "', '" . $data . "');";
                # $result = mysqli_query($con, $sql);
        
                // Mitigation: Prepared statement
                
                $query = "INSERT INTO user_prescriptions (username, data) VALUES(?, ?)";
                $con->execute_query($query,[$username,$data]);
                
                header("Location: logged_in.php");
            }
    
        }

    } else {
        header("Location: index.php");
    }


    ?>



</body>

</html>