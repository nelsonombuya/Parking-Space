<?php
/*=====================================Requirements===================================*/
    require_once $_SERVER['DOCUMENT_ROOT'] . "/Resources/Scripts/Parser.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/Resources/Classes/Setup.class.php";
/*====================================================================================*/
    echo "<pre>";
    print_r($setup = new Setup);
    echo "</pre>";
?>