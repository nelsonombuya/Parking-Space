<?php
    function parkingReport($type = "all"){
        // Setting the heading
        $heading = "Parking Report";

        // Setting the Subheading
        $subheading = parkingReportSubHeading($type);

        // Adding the column titles
        $column_titles = array("Parking ID", "Type", "Location", "Status");

        // Querying the Data
        $results = runQuery(parkingReportQuery($type));

        // Returning the Output
        return array(
            "headings" => array( "heading" => $heading, "sub-heading" => $subheading),
            "column_titles" => $column_titles,
            "content-variables" => array("P_ID", "P_TYPE", "P_LOCATION", "P_STATUS"),
            "content" => $results
        );
    }

    function parkingReportSubHeading($type){
        $subheading = "Parking Spots";
        switch ($type){
            case "all":
                $subheading = "All " . $subheading;
            break;
            case "free":
                $subheading = "Free " . $subheading;
            break;
            case "free":
                $subheading = "Reserved " . $subheading;
            break;
        }
        return $subheading;
    }

    function parkingReportQuery($type){
        switch ($type){
            case "all":
                $query =    "SELECT P_ID, P_TYPE, P_LOCATION, P_STATUS 
                            FROM PARKING";
            break;
            case "free":
                $query =    "SELECT P_ID, P_TYPE, P_LOCATION, P_STATUS 
                            FROM PARKING
                            WHERE P_STATUS = 'Free'";
            break;
            case "reserved":
                $query =    "SELECT P_ID, P_TYPE, P_LOCATION, P_STATUS 
                            FROM PARKING
                            WHERE P_TYPE = 'Reserved'";
            break;
        }
        return $query;
    }
?>