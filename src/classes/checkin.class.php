<?php
/*================================= CHECK-IN CLASS ===================================*/
/* Class for the whole checking in process                                            */
/*====================================================================================*/

/*=====================================Requirements===================================*/
    require_once __DIR__ . "/session.class.php";
/*====================================================================================*/

/*
    The Check-In Page is made up of 5 "pages":
        0 -> Asks the user to select a location where they want to park
        1 -> Asks the user how long they're planning on parking in the premises
        2 -> Asks the user whether they require handicapped parking
        3 -> Acts as an intermidiary page when checking for the available parking spots according to the user's needs
        4 -> Provides the available parking spot or notifies the user if there's no available spot

    These pages are seperated into 3 Sections:
        Heading
            These are the questions asked to the user when making a selection
                E.g. The location they want to park, how long they want to park, if they require handicapped parking
        Subheading
            These are the suggestions offered to the user when a parking spot has been found
                E.g. Parking spot found at ..., no parking spot was found
        Options
            These are the context senstitive options given to the user when the user makes a selection
                E.g. The locations the user can park, Yes or No when the user is asked whether they require handicapped parking
*/

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
            $this->_page = $this->page();   // This sets the page number accordingly

            /* Other Variables depending on the page */
            if ($this->_page < 3)
            {
                /* 
                    If the page number is less than 3, the user hasn't specified the kind of parking spot they want
                    We therefore set the headings and options according to the page they're on
                */

                /* Heading */
                $this->heading = $this->heading($this->_page);

                /* Subheading remains blank until the user has a parking spot suggested to them */

                /* Options */
                $this->_options = $this->options($this->_page);
            }
            else if ($this->_page == 3)
            {
                /* 
                    One the user is on page 3, 
                    we save their inputs and use their options to get a parking spot for them
                    NOTE: 
                        This page acts as an intermediary page so that we can save the user inputs properly
                        The actual checking of the available parking spots happens on the next page
                */
                /* Heading */
                $this->heading = $this->heading($this->_page);

                /* Subheading */
                $this->subheading = "Checking for available parking spot";

                /* Options */
                $this->_options = $this->options($this->_page);

                /* 
                    One the setting's have been saved, 
                    go to the next page, 
                    check and provide the suggested parking spot 
                */
                header("refresh:0.5; check-in.php?page=4&selection=done");
            }
            else if ($this->_page == 4)
            {
                /* Once we reach page 4, we start the booking process */
                $this->booking($_SESSION['selections']);
            }
            else
            {
                /* Once we pass page 3, we finalize the booking process */
                $this->finalizeBooking();
            }
        }

        /*------------------------------------------------- Outputs --------------------------------------------------*/
        /* Method for setting the current page that the user is on */
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

        /* Method for setting the page headings according to the page that the user is on */
        private function heading($page)
        {
            switch ($page)
            {
                case 0:
                    return "Where would you like to go?";

                case 1:
                    return "How long will you stay?";

                case 2:
                    return "Would you prefer handicapped parking?";

                case 3:
                    return "Please Wait";
            }
        }

        /* Method for setting the page options according to the page that the user is on */
        private function options($page)
        {
            switch ($page)
            {
                case 0:
                    return $this->locations();

                case 1:
                    return array(
                        "Around 30 Minutes",
                        "More than 30 Minutes"
                    );

                case 2:
                    return array(
                        "No",
                        "Yes"
                    );

                default:
                    return array();
            }
        }

        /* Method for outputting the options for the user in HTML */
        public function printOptions()
        {
            /* Outputting the answers depending on the page that the driver is currently on */
            foreach ($this->_options as $option)
            {
                if ($option === "Return")
                {
                    echo    "<a href='?page=0&selection=".$option."'>
                                <button type='button' class='btn btn-secondary btn-lg btn-block'>"
                                    .$option.
                                "</button>
                            </a>";
                            
                }
                else
                {
                    echo    "<a href='?page=".($this->_page + 1)."&selection=".$option."'>
                                <button type='button' class='btn btn-secondary btn-lg btn-block'>"
                                    .$option.
                                "</button>
                            </a>";
                }
            }
        }
        
        /*-------------------------------------------------- Data ----------------------------------------------------*/
        /* Method for obtaining the list of available parking locations according to those in the database */
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

        /* Method for the booking of the parking spot */
        private function booking($selection)
        {
            /* First, we check whether there is an available parking spot depending on the options they selected */
            $result = $this->checkForAvailableParkingSpot($selection);
            if (!empty($result))
            {
                /* If the result isn't empty, a parking spot was found */
                $_SESSION['PARKING_SPOT_ID'] = $parking_spot_ID = $result[0]['ID'];
                $_SESSION['LOCATION'] = $location = $result[0]['NAME'];

                /* Heading */
                $this->heading = "Confirm Parking Spot";

                /* Subheading */
                $this->subheading = "Parking Spot Found At P#$parking_spot_ID near $location";

                /* Options */
                $this->_options = array("Confirm", "Return");

            }
            else
            {
                /* 
                    If the results are empty, a parking spot was not found 
                    Finding another available parking spot
                */
                /* 
                    The variable contatining system settings is contained in the config variable from the config class
                    The algorithm to be used is set from config.ini and can be found from the config variable
                    The algorithm can be : 
                        Any available spot =>  config['system']['next_closest_spot'] will be FALSE
                        Next Closest Parking => config['system']['next_closest_spot'] will be TRUE
                */
                $FLAG = $this->config['system']['next_closest_spot'] ? "Next Closest Parking" : "Any";
                
                /* Now we check for an available parking spot using the flag for the algorithm we want to use */
                $result = $this->checkForAvailableParkingSpot($selection, $FLAG);

                if (!empty($result))
                {
                    /* A parking spot was found */
                    $_SESSION['PARKING_SPOT_ID'] = $parking_spot_ID = $result[0]['ID'];
                    $_SESSION['LOCATION'] = $location = $result[0]['NAME'];

                    /* Heading */
                    $this->heading = "Found a different parking spot";

                    /* Subheading */
                    $this->subheading = "Parking Spot Found At P#$parking_spot_ID near $location";

                    /* Options */
                    $this->_options = array("Confirm", "Return");
                }
                else
                {
                    /* No Parking spot was found altogether */
                    /* Heading */
                    $this->heading = "There are no available parking spot";

                    /* Subheading */
                    $this->subheading = "Try again later";

                    /* Options */
                    $this->_options = array("Return");
                }
            }
        }

        /* Method for checking for an available parking spot from the database */
        private function checkForAvailableParkingSpot($selection, $FLAG = NULL)
        {
            /* 
                The user's selections are saved in an array containing the following:
                At position...
                [0] => Location where they want to park (Location)
                [1] => How long they want to stay (Around 30 Minutes, More than 30 Minutes)
                [2] => Whether they need handicapped parking (Yes, No)

                The flag variable is used when checking for a parking spot while specifying the algorithm to use
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
                /* 
                    If the flag is added, it means that there weren't any available parking spots that meet the user's requirements.
                    So we're using the algorithm to find the next closest parking
                */
                $result = $this->runParkingQuery($selection, $FLAG);
            }

            return $result;
        }

        /* Method for running the database queries to check whether the specified parking spot is available */
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
                    If the user selected both Handicapped parking and that they'd stay for less than 30 min 
                    We check for both scenarios
                */

                /* First, check for handicapped parking */
                $result = $this->runParkingQuery($location, "Handicapped");

                if(!empty($result))
                {
                    /* If handicapped parking was found, give them that spot */
                    return $result;
                }
                else
                {
                    /* If a handicapped parking spot wasn't found, check for a pick-up parking spot */
                    return $this->runParkingQuery($location, "Pick-Up");
                }
            }
            else if ($FLAG === "Any")
            {
                /* 
                    If the system is set to provide any available parking spot when the desired parking spot is unavailable; get the relevant query and run it 
                */
                $query = $this->generateParkingQuery($FLAG);
                return $this->runPreparedQuery($query);
            }
            else if ($FLAG === "Next Closest Spot")
            {
                /* 
                    If the system is set to provide the closest available parking spot when the desired parking spot is unavailable; get the closest location with available parking and run the query using that location 
                */
                $location = $this->nextClosestLocation($location);  // TODO: Sort this algorithm
                return $this->runParkingQuery($location);
            }
            else
            {
                /* Else if none of the flags are set, run the query normally */
                $query = $this->generateParkingQuery($FLAG);
                return $this->runPreparedQuery($query, "s", array($location));
            }
        }

        /* Method to generate the relevant query to be used in the database querying */
        private function generateParkingQuery($FLAG = null)
        {
            switch ($FLAG)
            {
                case "Handicapped":
                    return  "SELECT PARKING_SPOT.ID, LOCATION.NAME 
                            FROM PARKING_SPOT, LOCATION
                            WHERE PARKING_SPOT.LOCATION_ID = LOCATION.ID
                            AND LOCATION.NAME = ?
                            AND PARKING_SPOT.TYPE = 'Handicapped'
                            AND PARKING_SPOT.STATUS = 'Free'";

                case "Pick-Up":
                    return  "SELECT PARKING_SPOT.ID, LOCATION.NAME 
                            FROM PARKING_SPOT, LOCATION
                            WHERE PARKING_SPOT.LOCATION_ID = LOCATION.ID
                            AND LOCATION.NAME = ?
                            AND PARKING_SPOT.TYPE = 'Pick-Up'
                            AND PARKING_SPOT.STATUS = 'Free'";
                    
                case "Any":
                    return  "SELECT PARKING_SPOT.ID, LOCATION.NAME 
                            FROM PARKING_SPOT, LOCATION
                            WHERE PARKING_SPOT.LOCATION_ID = LOCATION.ID
                            AND PARKING_SPOT.TYPE = 'Open'
                            AND PARKING_SPOT.STATUS = 'Free'"; 

                default:
                    return  "SELECT PARKING_SPOT.ID, LOCATION.NAME 
                            FROM PARKING_SPOT, LOCATION
                            WHERE PARKING_SPOT.LOCATION_ID = LOCATION.ID
                            AND LOCATION.NAME = ?
                            AND PARKING_SPOT.TYPE = 'Open'
                            AND PARKING_SPOT.STATUS = 'Free'";
            }
        }

        /* 
            Method to finalize the booking in the database once the user has confirmed that they're okay with the parking spot provided 
        */
        private function finalizeBooking()
        {
            /* Getting the necessary details ready */
            $username = isset($_SESSION['username']) ? $_SESSION['username'] : "guest";
            $parking_spot_ID = $_SESSION['PARKING_SPOT_ID'];
            $location = $_SESSION['LOCATION'];
            $time_in = date("Y-m-d H:i:s");

            /* Query for storing the details in the Parking Transactions Table */
            $booking_query =    "INSERT INTO PARKING_TRANSACTION (USERNAME, PARKING_SPOT_ID, TIME_IN)
                                VALUES ('$username', $parking_spot_ID, '$time_in')";

            /* The query for updating the Parking Spots Table */
            $updating_status_query =    "UPDATE PARKING_SPOT
                                        SET STATUS = 'Taken'
                                        WHERE ID = $parking_spot_ID";
            
            /* Running the Queries */
            $this->runQuery($booking_query);
            $this->runQuery($updating_status_query);

            /* Outputs */
            /* Heading */
            $this->heading = "Parking has been booked successfully";

            /* Subheading */
            $this->subheading = "Proceed to P#$parking_spot_ID near $location";

            /* Options */
            $this->_options = array("Return");
        }

        /*------------------------------------------------ Inputs -------------------------------------------------*/
        /* Method used to save the user's inputs to the SESSION variables */
        public function saveSelections($page, $selection)
        {
            /* Saves the user selected answers as a session variable for later access */
            $_SESSION['selections'][$page - 1] = $selection;
        }
    }