<?php
/* 
        -TEST-
        Timer for testing 
    */
    Timer::start();

    // Files to Include
    require $_SERVER['DOCUMENT_ROOT'] . "/Resources/Scripts/Includes.php";

    // Variables for testing output
    echo "<pre>";
    print_r();
    var_dump();
    echo "</pre>";

    // Timer Stopped
    print Timer::secondsToTimeString(Timer::stop());
?>