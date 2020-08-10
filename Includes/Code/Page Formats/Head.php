<?php   // Session
    session_start();
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
    <title><?php echo $_SESSION['page_title'] ?></title>
</head>
