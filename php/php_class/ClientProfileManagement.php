<!-- Client Profile Class -->
<?php
    class ClientProfileManagement{
        // Client Management Variables
        private $username;
        private $fullName;
        private $add1;
        private $add2;
        private $city;
        private $state;
        private $zipcode;

        // Function to validate parameters (Params aren't empty, and within length parameters)
        function validateParams($Username, $Name, $Address1, $Address2, $City, $State, $Zipcode){
            $validParams = true;
            # Required Fields
            if ($Name == "" or $Address1 == "" or $City =="" or $State == "" or $Zipcode ==""){
                $validParams = false;
            }
            # Length Parameters
            if ((strlen($Name) > 50) or (strlen($Address1) > 100) or (strlen($Address2) > 100) or (strlen($Zipcode) > 9) or (strlen($Zipcode) < 5)){
                $validParams = false;
            }
            # Type Parameters (None)
            
            return $validParams;
        }

        // Construct function
        function __construct($Username, $Name, $Address1, $Address2, $City, $State, $Zipcode){

            // Gets DB info from the database.json file
            $JSONcontents = file_get_contents("../json/database.json");
            $databaseObj = json_decode($JSONcontents);
            $connectionString = "host=".$databaseObj->host." port=".$databaseObj->port." dbname=".$databaseObj->dbname." user=".$databaseObj->user." password=".$databaseObj->password;
            $dbconnect = pg_connect($connectionString);

            // If the parameters are valid
            if ($this->validateParams($Username, $Name, $Address1, $Address2, $City, $State, $Zipcode)){
                $this->fullName = $Name;
                $this->add1 = $Address1;
                $this->add2 = $Address2;
                $this->city = $City;
                $this->state = $State;
                $this->zipcode = $Zipcode;

                // Updates 'cooldude9' Client Information
                $sql = "UPDATE ClientInformation SET Full_Name = '$Name', Address_1 = '$Address1', Address_2 = '$Address2', City = '$City', State = '$State', Zipcode = '$Zipcode' WHERE Username = '$Username'";

                if(pg_query($dbconnect, $sql)){
                    echo "Records inserted successfully.";
                } else{
                    echo "ERROR: Could not able to execute $sql. " . pg_error($dbconnect);
                }

            }
            // If parameters aren't valid (set to null)
            else{
                $this->fullName = null;
                $this->add1 = null;
                $this->add2 = null;
                $this->city = null;
                $this->state = null;
                $this->zipcode = null;
                header("Location: ../pages/client_profile_err.html");
            }
        }

        // GetName Function
        public function getName(){
            return $this->fullName;
        }

        // GetAdd1 Function
        public function getAdd1(){
            return $this->add1;
        }

        // GetAdd2 Function
        public function getAdd2(){
            return $this->add2;
        }

        // GetCity Function
        public function getCity(){
            return $this->city;
        }

        // GetState Function
        public function getState(){
            return $this->state;
        }

        // GetZipcode Function
        public function getZipcode(){
            return $this->zipcode;
        }
    }
?>
