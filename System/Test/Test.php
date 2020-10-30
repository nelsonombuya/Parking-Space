<?php echo "<pre>";
###################################################################################################
// TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST//
###################################################################################################
    // NOTE: Stuff to use -> print_r(); -> var_dump();
/*-----------------------------------------------------------------------------------------------*/
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/System/Test/Timer.inc.php"; 
$stopwatch = new Stopwatch; $stopwatch->start();
echo ("\n--------------------------------------------------------------------------------------\n");
/*-----------------------------------------------------------------------------------------------*/ 
                                            /* -TEST- */
/*=========================================== Includes ==========================================*/
    require_once $_SERVER['DOCUMENT_ROOT'] . "/System/Session/Session.class.php";
    $Session = new Session;
/*===============================================================================================*/

                                            /* -TEST- */
/*-----------------------------------------------------------------------------------------------*/
###################################################################################################
echo ("\n--------------------------------------------------------------------------------------\n");
/*-----------------------------------------------------------------------------------------------*/
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
####################################################################################################
// TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST //
####################################################################################################
$stopwatch->stop(); $stopwatch->print_time(); echo "</pre>"; ?>