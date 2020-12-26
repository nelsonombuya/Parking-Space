<?php
/*================================= CHECKout CLASS ===================================*/
/* Class for the whole checking out process                                           */
/*====================================================================================*/

/*=====================================Requirements===================================*/
    require_once __DIR__ . "/session.class.php";
    require_once SCRIPTS . "elapsed.script.php";
/*====================================================================================*/
    class Checkout extends Session
    {
        /* Class Properties */
        private $_parking_spot_ID;
        private $_parking_transaction_details;
        private $_charges;
        public $outputs;

        /* Class Constructor */
        public function __construct($parking_spot_ID)
        {
            /* Constructing Parent Class */
            parent::__construct();

            /* Removing any bad HTML code from the input and saving it as a variable */
            $this->_parking_spot_ID = $parking_spot_ID = htmlentities($parking_spot_ID);

            /* If the spot hasn't been confirmed, confirm it, else, finalize the unbooking process */
            if (!isset($_POST['confirm']))
            {
                $this->confirmation();
            }
            else
            {
                $this->_parking_transaction_details = $_SESSION['parking_transaction_details'];
                $this->finalization($this->_parking_transaction_details);
            }
        }

        /*------------------------------------------- Confirmation ---------------------------------------------*/

        private function doesParkingSpotExist()
        {
            /* Using prepared queries to prevent SQL Injection */
            $query  = "SELECT ID FROM PARKING_SPOT WHERE ID = ?";
            $result = $this->runPreparedQuery($query, "i", array($this->_parking_spot_ID));
            return empty($result) ? FALSE : TRUE;
        }

        private function getParkingSpotDetails()
        {
            /* The query for checking for the parking details in the database */
            $query =    "SELECT PARKING_TRANSACTION.ID, 
                                PARKING_TRANSACTION.USERNAME, 
                                PARKING_TRANSACTION.PARKING_SPOT_ID, 
                                PARKING_TRANSACTION.TIME_IN, 
                                LOCATION.NAME
                        FROM    PARKING_TRANSACTION, 
                                PARKING_SPOT, 
                                LOCATION
                        WHERE PARKING_TRANSACTION.PARKING_SPOT_ID = PARKING_SPOT.ID
                        AND PARKING_SPOT.LOCATION_ID = LOCATION.ID
                        AND PARKING_TRANSACTION.PARKING_SPOT_ID = ?
                        AND TIME_OUT IS NULL";
            return $this->runPreparedQuery($query, "i", array($this->_parking_spot_ID));
        }

        private function confirmParkingSpot()
        {
            if ($this->doesParkingSpotExist())
            {
                /* If the spot exists, get the spot's details */
                $this->_parking_transaction_details = $this->getParkingSpotDetails();

                /* If the getParkingSpotDetails Method returns an empty array, it means the spot is not occupied */
                if (empty($this->_parking_transaction_details))
                {
                    return "Unoccupied";
                }
                else
                {
                    /* If it returns data, the parking spot is actually occupied */
                    return TRUE;
                }
            }
            else
            {
                /* If the doesParkingSpotExist method returns false, then the spot doesn't exist */
                return "Does Not Exist";
            }
        }

        private function confirmation()
        {
            /* Confirming whether the parking spot exists, and that it's occupied */
            $status = $this->confirmParkingSpot();

            /* Stuff to do after confirmation */
            if (($status) === TRUE)
            {
                /* If the spot has been verified to exist and is occupied */
                $this->outputs("Occupied");
            }
            else
            {
                /* If the spot has been isn't occupied or doesn't exist */
                $this->outputs($status);
            }
        }

        /*--------------------------------------------- Outputs -----------------------------------------------*/

        private function outputs($FLAG = NULL)
        {
            switch ($FLAG)
            {
                case "Does Not Exist":
                    $this->outputs["Heading"] = "Parking details not found.";
                    $this->outputs["Subheading"] = "Parking Spot #$this->_parking_spot_ID doesn't exist.";
                    $this->outputs["Time"] = "Please input a correct Parking Ticket Number";
                    $this->outputs["Buttons"] = $this->outputButtons(FALSE);
                break;
                
                case "Unoccupied":
                    $this->outputs["Heading"] = "The spot is not occupied.";
                    $this->outputs["Subheading"] = "Parking Spot #$this->_parking_spot_ID isn't occupied.";
                    $this->outputs["Time"] = "Please input a correct Parking Ticket Number";
                    $this->outputs["Buttons"] = $this->outputButtons(FALSE);
                break;

                case "Occupied":
                    /* Getting the Parking Spot's details */
                    $transaction_ID = $this->_parking_transaction_details[0]["ID"];
                    $username = $this->_parking_transaction_details[0]["USERNAME"];
                    $parking_spot_ID = $this->_parking_transaction_details[0]["PARKING_SPOT_ID"];
                    $parking_spot_location = $this->_parking_transaction_details[0]["NAME"];

                    /* If the charges setting is enabled, calculate the charges, otherwise, just return false */
                    $this->_charges = $charges = $this->config['charges']['enabled'] ?
                        $this->calculateCharges($this->_parking_transaction_details[0]["TIME_IN"]) :
                        FALSE;
                    
                    /* Calculating and Formatting the Elapsed Time for Output */
                    // EXTERNAL -> time_elapsed_string() -> Function for displaying elapsed time.
                    $elapsed_time = time_elapsed_string($this->_parking_transaction_details[0]["TIME_IN"]);

                    // Returning the driver's details for confirmation
                    $this->outputs["Heading"] = "Is this your parking spot?";
                    $this->outputs["Subheading"] = "Transaction #$transaction_ID ($username) with Parking Spot #$parking_spot_ID at $parking_spot_location";
                    $this->outputs["Time"] = "You parked here $elapsed_time.";
                    $this->outputs["Buttons"] = $this->outputButtons(TRUE);
                    if ($charges !== FALSE) $this->outputs["Charges"] = "Your parking fee is Ksh.$charges";
                break;

                case "Final":
                    $this->outputs["Heading"] = "Checkout Successful";
                    $this->outputs["Subheading"] = "You may leave your parking spot in the next 20 minutes.";
                    $this->outputs["Buttons"] = $this->outputButtons(FALSE);
                break;

                default:
                    $this->outputs["Heading"] = "An Error Has Occured";
                    $this->outputs["Subheading"] = "Please Try Again";
                    $this->outputs["Buttons"] = $this->outputButtons(FALSE);
                break;
            }
        }

        private function outputButtons($status)
        {
            if ($status === TRUE)
            {
                return  "<div>".
                            "<a href='javascript:history.back()'><button type='button'>Return</button></a>".
                        "</div>".
                        "<div class='confirm'>".
                            "<input type='submit' name='confirm' value='Confirm'>".
                        "</div>";
            } 
            else 
            {
                header("refresh:15; url=check-out.php");
                return  "<div>".
                            "<a href='javascript:history.back()'><button type='button'>Return</button></a>".
                        "</div>";
                        
            }
        }

        private function calculateCharges($time_in)
        {
            /* Calculating the time difference */
            $now = strtotime("now");
            $time_in = strtotime($time_in);
            $difference = $now - $time_in;

            /* Getting set charging duration and cost from config */
            $charging_duration = $this->config['charges']['duration'];
            $charging_cost = $this->config['charges']['cost'];

            /* Calculating difference in hours */
            $cost_multiplier = (floor($difference/(60 * $charging_duration)));
            
            /* Getting the total cost the driver has to pay */
            $total_cost = $cost_multiplier * $charging_cost;

            return $total_cost;
        }

        public function saveDetailsToSession()
        {
            /* Saves the details to the session for later use during finalization */
            $_SESSION['parking_transaction_details'] = $this->_parking_transaction_details;
            $_SESSION['parking_spot_ID'] = $this->_parking_spot_ID;
            $_SESSION['charges'] = $this->_charges;
        }

        private function finalization($data)
        {
            /* Organizing the necessary data */
            $transaction_ID = $data[0]["ID"];
            $parking_spot_ID = $data[0]["PARKING_SPOT_ID"];
            $charges = $_SESSION['charges'];
            $time_out = date("Y-m-d H:i:s");
        
            /* Setting the parking spot as free */
            $query = "UPDATE PARKING_SPOT SET STATUS = 'Free' WHERE ID = ?";
            $this->runPreparedQuery($query, "i", array($parking_spot_ID));

            /* Updating the transaction's time out */
            /* NOTE: We can use normal sql statements since the data is directly from the DB */
            $query = "UPDATE PARKING_TRANSACTION SET TIME_OUT = '$time_out' WHERE ID = $transaction_ID";
            $this->runQuery($query);

            /* Adding the amount they're supposed to pay and whether they've paid */
            if ($charges !== FALSE)
            {
                $query = "UPDATE PARKING_TRANSACTION SET CHARGES = '$charges' WHERE ID = $transaction_ID";
                $this->runQuery($query);
            }

            /* Setting outputs */
            $this->outputs("Final");
        }

        public function cleanUp()
        {
            /* Clearing junk */
            unset($_POST);
            unset($_SESSION['charges']);
            unset($_SESSION['parking_spot_ID']);
            unset($_SESSION['parking_transaction_details']);
        }
    }

    /* TODO: 
        This is a function that releases a parking spot after 20 minutes (For testing, we'll use 30 seconds to 1 minute)
        We'll use a server array to store the parking ID and time_out
        We'll set these details in a queue if possible
        Then set the function to run periodically (every minute)
        It checks the time out for each parking added to the array, then if the time out has been passed
        If so, it adds it to another array
        The parking IDs in the array are then released on the SQL table
        Then released from the server array, and the array is resorted
        It should also add values to the  end of the array
    */ 

?>