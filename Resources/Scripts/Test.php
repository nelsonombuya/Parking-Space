<?php echo "<pre>";
##################################################################################################
    // NOTE: Stuff to use -> print_r(); -> var_dump();
/*----------------------------------------------------------------------------------------------*/
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/Resources/Scripts/Test/Timer.inc.php"; 
$stopwatch = new Stopwatch; $stopwatch->start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/Resources/Scripts/Includes.php";
echo ("\n------------------------------------------------------------------------------------\n");
/*----------------------------------------------------------------------------------------------*/ 
                                            /* -TEST- */


                                            /* -TEST- */
/*----------------------------------------------------------------------------------------------*/
###################################################################################################
echo ("\n------------------------------------------------------------------------------------\n");
/*----------------------------------------------------------------------------------------------*/
                                            /* PREVIOUS */
                                        /* JELIX INI PARSER */
    // print_r($before = parse_ini_file(
    //     $_SERVER['DOCUMENT_ROOT'] . "/Resources/Settings/Settings.ini", TRUE));

    // $ini = new \Jelix\IniFile\IniModifier(
    //     $_SERVER['DOCUMENT_ROOT'] . "/Resources/Settings/Settings.ini");

    //     // setting a parameter.  (section_name is optional)
    // $ini->setValue('enabled', 'true', 'charges');
    // $ini->save();

    // print_r($after = parse_ini_file(
    //     $_SERVER['DOCUMENT_ROOT'] . "/Resources/Settings/Settings.ini", TRUE));
##################################################################################################
$stopwatch->stop(); $stopwatch->print_time(); echo "</pre>"; ?>