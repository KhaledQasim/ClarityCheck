<?php
// Imports the mysql database connection settings then checks for the existence of the users table and user_prescriptions table. 
// If they do not exist, they are created.
include("config/connection.php");

session_start();

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
    <form action="index.php" method="POST">
        <!-- <input type="submit" name="run_php" value="Run PHP Code"> -->
        <button type="submit" name="logout.php" class="round-button-top-right">LogOut</button>
    </form>
    
    <!-- Form and CSS styling copied from https://www.w3schools.com/howto/howto_css_login_form.asp -->


    <?php
        echo "<h1> Welcome " . $_SESSION['username'] . "</h1>";
    ?>



</body>

</html>