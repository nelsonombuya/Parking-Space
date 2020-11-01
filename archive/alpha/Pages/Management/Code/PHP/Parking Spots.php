<?php
    function parkingReport($type = "all"){
        // Setting the heading
        $heading = "Parking Report";

        // Setting the Subheading
        $subheading = "Parking Spots";
        switch ($type){
            case "all":
                $subheading = "All " . $subheading;
            break;
        }

        // Adding the column titles
        $column_titles = array("Parking ID", "Type", "Location", "Status");

        // Querying the Data
        $query = "SELECT P_ID, P_TYPE, P_LOCATION, P_STATUS FROM PARKING";
        $results = runQuery($query);

        // Returning the Output
        return array(
            "headings" => array( "heading" => $heading, "sub-heading" => $subheading),
            "column_titles" => $column_titles,
            "content-variables" => array("P_ID", "P_TYPE", "P_LOCATION", "P_STATUS"),
            "content" => $results
        );
    }
?>