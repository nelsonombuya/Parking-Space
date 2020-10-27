<?php
/*================================= CHECK-IN CLASS ===================================*/
/* Class for the whole checking in process                                            */
/*====================================================================================*/

/*=====================================Requirements===================================*/
    require_once $_SERVER['DOCUMENT_ROOT'] . "/System/Session/Session.class.php";
/*====================================================================================*/

    class CheckIn extends Session 
    {
        private $_page;
        private $_options;
        public $heading;
        public $subheading;

        public function __construct()
        {
            /* Constructing the parent class to allow for the use of the session and SQL stuff */
            parent::__construct();

            /* Initializing variables */
            /* Page */
            $this->_page = $this->page();

            /* Other Variables depending on the page */
            if ($this->_page < 3)
            {
                /* Heading */
                $this->heading = $this->heading($this->_page);

                /* Subheading remains blank until the user has a parking spot suggested to them */

                /* Options */
                $this->_options = $this->options($this->_page);
            }
            else if ($this->_page == 3)
            {
                /* Once we reach page 3+, we start the booking process */
                $this->book($_SESSION['selections']);
            }
            else
            {
                /* Once we pass page 3, we finalize the booking process */
                $this->finalizeBooking();
            }
        }

        /*------------------------------------------------- Outputs --------------------------------------------------*/
        private function page()
        {
            if (isset($_GET['page']))
            {
                /* If the page is set, we start from that page */
                return $_GET['page'];
            }
            else
            {
                /* If the page isn't set, we start from the first page */
                return $_GET['page'] = 0;
            }
        }

        private function heading($_page)
        {
            switch ($_page)
            {
                case 0:
                    return "Where would you like to go?";
                break;

                case 1:
                    return "How long will you stay?";
                break;

                case 2:
                    return "Would you prefer handicapped parking?";
                break;
            }
        }

        private function options($_page)
        {
            switch ($_page)
            {
                case 0:
                    return $this->locations();
                break;

                case 1:
                    return array(
                        "Around 30 Minutes",
                        "More than 30 Minutes"
                    );
                break;

                case 2:
                    return array(
                        "No",
                        "Yes"
                    );
            }
        }

        public function printOptions()
        {
            /* Outputting the answers depending on the page that the driver is currently on */
            foreach ($this->_options as $option)
            {
                if ($option === "Return")
                {
                    echo    "<div class='option'>".
                            "<a href='?page=0&selection=".$option."'>".$option."</a>".
                        "</div>";
                }
                else
                {
                    echo    "<div class='option'>".
                            "<a href='?page=".($this->_page + 1)."&selection=".$option."'>".$option."</a>".
                        "</div>";
                }
            }
        }
        
        /*-------------------------------------------------- Data ----------------------------------------------------*/
        private function locations()
        {
            /* 
                Since this class extends the Session class, which extends the SQL class
                We have access to the SQL methods contained in the SQL class
            */
            /* Running a query to get the list of locations in the database */
            $results = $this->runQuery("SELECT NAME FROM LOCATION");

            /* Getting list of locations as a single dimension array */
            $counter = 0; 
            foreach ($results as $result => $location_name)
            {
                $locations_array[$counter] = $location_name["NAME"];
                $counter++;
            }

            return $locations_array;
        }

        private function book($selection)
        {
            /* First, we check whether there is an available parking spot depending on the options they selected */
            if (!empty($result = $this->checkForAvailableParkingSpot($selection)))
            {
                /* A parking spot was found */
                $_SESSION['SPOT'] = $parking_id = $result[0]['ID'];
                $_SESSION['LOCATION'] = $location = $result[0]['NAME'];

                /* Heading */
                $this->heading = "Confirm Parking Spot";

                /* Subheading */
                $this->subheading = "Parking Spot Found At P#$parking_id near $location";

                /* Options */
                $this->_options = array("Confirm");

            }
            else
            {
                /* 
                    A parking spot was not found 
                    Finding another available parking spot
                */
                /* This algorithm is set from settings.ini */
                $next_closest_parking = $this->settings['system']['next_closest_spot'] ? "Next Closest Parking" : "Any";

                if (!empty($result = $this->checkForAvailableParkingSpot($selection, $next_closest_parking)))
                {
                    /* A parking spot was found */
                    $_SESSION['SPOT'] = $parking_id = $result[0]['ID'];
                    $_SESSION['LOCATION'] = $location = $result[0]['NAME'];

                    /* Heading */
                    $this->heading = "Found a different parking spot";

                    /* Subheading */
                    $this->subheading = "Parking Spot Found At P#$parking_id near $location";

                    /* Options */
                    $this->_options = array("Return", "Confirm");
                }
                else
                {
                    /* No Parking spot was found */
                    /* Heading */
                    $this->heading = "There's no available parking spot";

                    /* Subheading */
                    $this->subheading = "Try again later";

                    /* Options */
                    $this->_options = array("Return");
                }
            }
        }

        private function checkForAvailableParkingSpot($selection, $FLAG = NULL)
        {
            /* 
                Selections
                [0] => Location where they want to park (Location)
                [1] => How long they want to stay (Around 30 Minutes, More than 30 Minutes)
                [2] => Whether they need handicapped parking (Yes, No)
            */
            
            /* Checking where there is an available parking spot depending on what the user has chosen */
            if ($FLAG === NULL)
            {
                if ($selection[2] === "Yes")
                {
                    if ($selection[1] === "Around 30 Minutes")
                    {
                        /* In this case they've selected both handicapped and pick-up */
                        $result = $this->runParkingQuery($selection[0], "Both");
                    }
                    else
                    {
                        /* They only selected handicapped parking */
                        $result = $this->runParkingQuery($selection[0], "Handicapped");
                    }
                }
                else if ($selection[1] === "Around 30 Minutes")
                {
                    /* They selected pick-up parking */
                    $result = $this->runParkingQuery($selection[0], "Pick-Up");
                }
                else
                {
                    /* They don't need handicapped parking and will be there for more than 30 Min */
                    $result = $this->runParkingQuery($selection[0]);
                }
            }
            else
            {
                /* If the selection is not an array, we'll automatically look for the closest available parking */
                $result = $this->runParkingQuery($selection, $FLAG);
            }

            return $result;
        }

        private function runParkingQuery($location, $FLAG = null)
        {
            /* 
                Setting up the query
                1. If the driver want's handicapped parking, we try that first
                2. If the driver doesn't need handicapped parking, but will only be here for a short time, we try that
                3. If the driver doesn't need handicapped parking and won't be here long, give them regular parking
                (The above also applies if the driver wants both handicapped parking and will be there for a short time)
            */

            if ($FLAG === "Both")
            {
                /* 
                    If the user selected both Handicapped parking and that they'd stay for longer than 30 min 
                    We check for both scenarios
                */
                if(!empty($result = $this->runParkingQuery($location, "Handicapped")))
                {
                    /* IF a parking spot was found */
                    return $result;
                }
                else
                {
                    /* If a handicapped parking spot wasn't found */
                    return $result = $this->runParkingQuery($location, "Pick-Up");
                }
            }
            else if ($FLAG === "Any")
            {
                $query = $this->generateParkingQuery($FLAG);
                return $result = $this->runPreparedQuery($query);
            }
            else if ($FLAG === "Next Closest Spot")
            {
                $location = $this->nextClosestLocation($location);  // TODO: Sort this algorithm
                return $result = $this->runParkingQuery($location);
            }
            else
            {
                $query = $this->generateParkingQuery($FLAG);
                return $result = $this->runPreparedQuery($query, "s", array($location));
            }
        }

        private function generateParkingQuery($FLAG = null)
        {
            switch ($FLAG)
            {
                case "Handicapped":
                    return  "SELECT SPOT.ID, LOCATION.NAME 
                            FROM SPOT, LOCATION
                            WHERE SPOT.LOCATION_ID = LOCATION.ID
                            AND LOCATION.NAME = ?
                            AND SPOT.TYPE = 'Handicapped'
                            AND SPOT.STATUS = 'Free'";
                break;

                case "Pick-Up":
                    return  "SELECT SPOT.ID, LOCATION.NAME 
                            FROM SPOT, LOCATION
                            WHERE SPOT.LOCATION_ID = LOCATION.ID
                            AND LOCATION.NAME = ?
                            AND SPOT.TYPE = 'Pick-Up'
                            AND SPOT.STATUS = 'Free'";
                break;
                    
                case "Any":
                    return  "SELECT SPOT.ID, LOCATION.NAME 
                            FROM SPOT, LOCATION
                            WHERE SPOT.LOCATION_ID = LOCATION.ID
                            AND SPOT.TYPE = 'Open'
                            AND SPOT.STATUS = 'Free'"; 
                break;

                default:
                    return  "SELECT SPOT.ID, LOCATION.NAME 
                            FROM SPOT, LOCATION
                            WHERE SPOT.LOCATION_ID = LOCATION.ID
                            AND LOCATION.NAME = ?
                            AND SPOT.TYPE = 'Open'
                            AND SPOT.STATUS = 'Free'";
                break;
            }
        }

        private function finalizeBooking()
        {
            /* Getting the necessary details ready */
            $username = isset($_SESSION['username']) ? $_SESSION['username'] : "guest";
            $parking_id = $_SESSION['SPOT'];
            $location = $_SESSION['LOCATION'];
            $time_in = date("Y-m-d H:i:s");

            /* Query for storing the details in the Parking Transactions Table */
            $booking_query =    "INSERT INTO PARKING_TRANSACTION (USERNAME, SPOT_ID, TIME_IN)
                                VALUES ('$username', $parking_id, '$time_in')";

            /* The query for updating the Parking Spots Table */
            $updating_status_query =    "UPDATE SPOT
                                        SET STATUS = 'Taken'
                                        WHERE ID = $parking_id";
            
            /* Running the Queries */
            $this->runQuery($booking_query);
            $this->runQuery($updating_status_query);

            /* Outputs */
            /* Heading */
            $this->heading = "Parking has been booked successfully";

            /* Subheading */
            $this->subheading = "Proceed to P#$parking_id near $location";

            /* Options */
            $this->_options = array("Return");
        }

        /*------------------------------------------------ Inputs -------------------------------------------------*/
        public function saveSelections($_page, $selection)
        {
            /* Saves the user selected answers as a session variable for later access */
            $_SESSION['selections'][$_page - 1] = $selection;
        }
    }