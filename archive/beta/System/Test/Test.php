<?php echo "<pre>";
###################################################################################################
// TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST//
###################################################################################################
    // NOTE: Stuff to use -> print_r(); -> var_dump();
/*-----------------------------------------------------------------------------------------------*/
require_once __DIR__ . "/../.." . '/vendor/autoload.php';
require_once __DIR__ . "/../.." . "/System/Test/Timer.inc.php"; 
$stopwatch = new Stopwatch; $stopwatch->start();
echo ("\n--------------------------------------------------------------------------------------\n");
/*-----------------------------------------------------------------------------------------------*/ 
                                            /* -TEST- */
/*=========================================== Includes ==========================================*/
    require_once __DIR__ . "/../.." . "/System/Session/Session.class.php";
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
    //     __DIR__ . "/../.." . "/Resources/Settings/Settings.ini", TRUE));

    // $ini = new \Jelix\IniFile\IniModifier(
    //     __DIR__ . "/../.." . "/Resources/Settings/Settings.ini");

    //     // setting a parameter.  (section_name is optional)
    // $ini->setValue('enabled', 'true', 'charges');
    // $ini->save();

    // print_r($after = parse_ini_file(
    //     __DIR__ . "/../.." . "/Resources/Settings/Settings.ini", TRUE));
####################################################################################################
// TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST //
####################################################################################################
$stopwatch->stop(); $stopwatch->print_time(); echo "</pre>"; ?>