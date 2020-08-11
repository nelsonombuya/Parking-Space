<?php   // Session
    session_start();

    function logout()
    {
        unset($_SESSION['username']);
        session_destroy();
    }

    //TODO: No user logged in output
    function session_outputs($output)
    {
        if ($_SESSION[$output] === "")
        {
            return "User Not Logged In";
        }
        else
        {
            return $_SESSION[$output];
        }
    }
    //TODO: Already Logged In
    function already_logged_in()
    {
        if ($_SESSION['username'] !== "")
        {
            header("../../Pages/Login/Login.html");
        }
        else
        {
            echo "<script> alert ('You're already logged in as'" . $_SESSION['username'] . ")</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!--Stuff To Include-->
    <!--Monsterrat Font-->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    
    <!--Poppins Font-->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <!--CSS-->
    <!--From the Pages Folder-->
    <link rel="stylesheet" type="text/css" href="../../Includes/Code/CSS/Main Style.css">

    <!-- Javascript (From Fontawesome) [Has the Username And Password Icons] -->
    <!-- <script src="https://kit.fontawesome.com/a81368914c.js"></script> -->
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_SESSION['page_title'] ?></title>
</head>
