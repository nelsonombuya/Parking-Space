<?php
    class Dashboard 
    {
        private $_category_list;

        public function __construct()
        {
            /* Initializing category list */
            $this->_category_list = array(
                "Reports" => array(
                    "All Parking Spots"     => "reports.php?type=parking&filter=all",
                    "Free Parking Spots"    => "reports.php?type=parking&filter=free",
                    "Reserved Parking Spots"=> "reports.php?type=parking&filter=reserved" 
                ),

                "Settings" => array(
                    "Change Password"  => "password-change.php",
                ),

                "System" => array(
                    "Change System Settings" => "setup.php?state=modify",
                    "Restore Factory Settings" => "setup.php?state=reset"
                )
            );
        }

        public function printCategories()
        {
            foreach($this->_category_list as $category => $options)
            {
                /* Echo's the list of page categories */
                echo    "<a class='list-group-item list-group-item-action' 
                            id='list-".$category."-list' data-toggle='list' href='#list-".$category."' 
                            role='tab' aria-controls='".$category."'>"
                                .$category.
                        "</a>";
            }
        }

        public function printOptions()
        {
            foreach($this->_category_list as $category => $options)
            {
                echo    "<div class='tab-pane fade show' id='list-".$category."' 
                            role='tabpanel' aria-labelledby='list-".$category."-list'>
                                <ul class='list-group '>";
                foreach ($options as $option => $link)
                {
                    echo            "<li class='list-group-item '><a href='".$link."'>".$option."</a></li>";
                }
                echo            "</ul>
                        </div>";

            }
        }
    }
?>