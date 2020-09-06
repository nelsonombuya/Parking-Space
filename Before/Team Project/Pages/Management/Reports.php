<?php   // Includes 
    require "Code/PHP/Reports List.php";
    include "../../Includes/Code/Page Formats/Head.php";
    include "../../Includes/Code/Page Formats/Header.php";

    // Getting the Report Data
    switch ($_GET['report']){
        // for Parking Related Reports
        case "parking":
            $report_data = parkingReport($_GET['type']);
        break;
        case "drivers":
            $report_data = driversReport($_GET['type']);
        break;
    }
?>

<head>
    <!--For the Reports-->
    <link rel="stylesheet" type="text/css" href="Code/CSS/Reports Style.css">
</head>

<body>
    <div class="container">
        <!--Report Heading Space-->
        <div class="report-heading-space">
            <h1><?php echo reportHeadings()["heading"]; ?></h1>
        </div>

        <!--Container that'll hold the Account holder's details-->
        <div class="report-title">
            <h2><?php echo reportHeadings()["sub-heading"]; ?></h2>
        </div>
        <div class="column-titles">
            <?php reportColumnTitles(); ?>
        </div>
        <div class="report-content">
            <?php reportContent(); ?>
        </div>
    </div>
</body>

</html>

<?php
    function reportHeadings(){
        return array(
            "heading" => $GLOBALS['report_data']['headings']['heading'],
            "sub-heading" => $GLOBALS['report_data']['headings']['sub-heading'],
        );
    }

    function reportColumnTitles(){
        $titles = $GLOBALS['report_data']['column_titles'];
        foreach($titles as $title){
            echo "<strong><h3>$title</h3></strong>";
        }
    }

    function reportContent(){
        $content = $GLOBALS['report_data']["content"];
        $content_variables = $GLOBALS['report_data']["content-variables"];

        $number_of_columns = count($content_variables);
        for ($counter = 0; $counter < $number_of_columns; $counter++){
            echo "<div class='column'>";
            foreach($content as $record => $data){
                echo "<h4>" . $data[$content_variables[$counter]] . "</h4>";
            }
            echo "</div>";
        }
    }
?>