<?php
    // Session
    session_start();
    function logout()
    {
        unset($_SESSION['username']);
        session_destroy();
        session_start();
        $_SESSION['username'] = "guest";
    }
    //TODO: No user logged in output FIXME: Might be redundant
    function session_outputs($output)
    {
        if ($_SESSION[$output] === "guest")
        {
            return "Guest";
        }
        else
        {
            return $_SESSION[$output];
        }
    }
    
    //TODO: Already Logged In //FIXME: Issues with moving to login Page
    function already_logged_in()
    {
        return header("../../Pages/Login/Login.html");
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
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
