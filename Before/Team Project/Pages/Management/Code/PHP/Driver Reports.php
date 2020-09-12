<?php
    function driversReport($type = "all"){
        // Setting the heading
        $heading = "Drivers' Report";

        // Setting the Subheading
        $subheading = driversReportSubHeading($type);

        // Adding the column titles
        $column_titles = array("Driver's ID", "Username", "Parking ID", "Time In", "Time Out");

        // Querying the Data
        $results = runQuery(driversReportQuery($type));

        // Returning the Output
        return array(
            "headings" => array( "heading" => $heading, "sub-heading" => $subheading),
            "column_titles" => $column_titles,
            "content-variables" => array("DRIVER_ID", "USERNAME", "P_ID", "TIME_IN", "TIME_OUT"),
            "content" => $results
        );
    }

    function driversReportSubHeading($type){
        $subheading = "Drivers";
        switch ($type){
            case "all":
                $subheading = "All " . $subheading;
            break;
            case "registered":
                $subheading = "Registered " . $subheading;
            break;
        }
        return $subheading;
    }

    function driversReportQuery($type){
        switch ($type){
            case "all":
                $query =    "SELECT *
                            FROM DRIVERS";
            break;
            case "registered":
                $query =    "SELECT * 
                            FROM DRIVERS
                            WHERE USERNAME != 'guest'";
            break;
        }
        return $query;
    }
?>