<?php
    $version_settings = parse_ini_file("version.ini");
    switch ($version_settings['version'])
    {
        case "alpha":
            header ("Location: archive/alpha/") or die();
        break;

        case "beta":
            header ("Location: archive/beta/") or die();
        break;

        case "freshpaint":
            header ("Location: archive/freshpaint/") or die();
        break;

        default :
            header ("Location: public-html/") or die();
        break;
    }
?>