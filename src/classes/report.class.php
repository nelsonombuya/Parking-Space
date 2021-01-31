<?php
/*================================== REPORT CLASS ====================================*/
/* Class for the whole reports page                                                   */
/*====================================================================================*/

/*=====================================Requirements===================================*/
    require_once __DIR__ . "/sql.class.php";
/*====================================================================================*/
    class Report extends SQL
    {
        private $_type;
        private $_title;
        private $_filter;

        public function __construct($type, $filter)
        {
            /* Constructing the parent class */
            parent::__construct();

            /* Initializing the class variables */
            $this->_type = $type;
            $this->_filter = $filter;
            $this->_title = $this->getReportHeadingFilter() . " " . $this->getReportHeading();
        }

        /*------------------------------ Outputs -----------------------------------*/
        public function printTableHeading()
        {
            foreach ($this->getTableHeading() as $title) 
            {
                echo "<th scope='col'>$title</th>";
            }
        }

        public function printReportHeading()
        {
            echo "$this->_title";
        }

        public function printTableData()
        {
            $table_data = $this->getTableData();

            foreach ($table_data as $row)
            {
                /* Used to define the beginning of another row */
                $counter = 0;

                echo "<tr>";
                foreach ($row as $row_data)
                {
                    echo ($counter == 0) ? "<th scope='row'>$row_data</th>" : "<td>$row_data</td>";
                    $counter++;
                }
                echo "</tr>";
            }        
        }

        /*------------------------------- Inputs ------------------------------------*/
        private function getTableHeading()
        {
            switch ($this->_type)
            {
                case "parking":
                    return array(
                        "Parking ID",
                        "Type",
                        "Status",
                        "Location"
                    );
                
            }
        }

        private function getReportHeading()
        {
            switch ($this->_type)
            {
                case "parking":
                    return "Parking Spots";
                
            }
        }

        private function getReportHeadingFilter()
        {
            switch ($this->_filter)
            {
                case "all":
                    return "All";
                
            }
        }

        private function getTableData()
        {
            switch ($this->_type)
            {
                case "parking":
                    return $this->getParkingSpotsData();
                
            }
        }

        /*-------------------------- Report/Table Data -------------------------------*/
        private function getParkingSpotsData()
        {
            switch ($this->_filter)
            {
                case "all":
                    return $this->runQuery(
                        "SELECT PARKING_SPOT.ID, PARKING_SPOT.TYPE, PARKING_SPOT.STATUS, LOCATION.NAME 
                        FROM PARKING_SPOT, LOCATION
                        WHERE PARKING_SPOT.LOCATION_ID = LOCATION.ID"
                    );
                

                case "reserved":
                    return $this->runQuery(
                        "SELECT PARKING_SPOT.ID, PARKING_SPOT.TYPE, PARKING_SPOT.STATUS, LOCATION.NAME 
                        FROM PARKING_SPOT, LOCATION
                        WHERE PARKING_SPOT.LOCATION_ID = LOCATION.ID
                        AND PARKING_SPOT.TYPE = 'Reserved'"
                    );
                

                case "free":
                    return $this->runQuery(
                        "SELECT PARKING_SPOT.ID, PARKING_SPOT.TYPE, PARKING_SPOT.STATUS, LOCATION.NAME 
                        FROM PARKING_SPOT, LOCATION
                        WHERE PARKING_SPOT.LOCATION_ID = LOCATION.ID
                        AND PARKING_SPOT.STATUS = 'Free'
                        AND PARKING_SPOT.TYPE != 'Reserved'"
                    );
                

                default:
                    return $this->runQuery(
                        "SELECT PARKING_SPOT.ID, PARKING_SPOT.TYPE, PARKING_SPOT.STATUS, LOCATION.NAME 
                        FROM PARKING_SPOT, LOCATION
                        WHERE PARKING_SPOT.LOCATION_ID = LOCATION.ID"
                    );
                
            }
        }
    }