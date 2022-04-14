<?php
    class Login{
        //This variable stores the username submitted by the user.
        private $username;
        
        //This variable stores the password submitted by the user.
        private $password;
        
        //This variable stores true if the login is vald, and false if it is not.
        private $validLogin;

        //This function checks that neither username or password are null.
        function validateParams($Username, $Password){
            if ($Username != null && $Password != null){
                $validParams = true;
            }
            else{
                $validParams = false;
            }
            
            return $validParams;
        }
        
        //Check the username and password with what is encrypted in the database.
        function checkUserPassword(){
            $JSONcontents = file_get_contents("../json/database.json");
            $databaseObj = json_decode($JSONcontents);
        
            $connectionString = "host=".$databaseObj->host." port=".$databaseObj->port." dbname=".$databaseObj->dbname." user=".$databaseObj->user." password=".$databaseObj->password;
        
            $dbconnect = pg_connect($connectionString);
            
            $queryString = "SELECT Password FROM UserCredentials WHERE Username = '".$this->username."' AND Password = crypt('".$this->password."', password);";
            
            $queryResult = pg_query($dbconnect, $queryString);
            if (!$queryResult){
                echo "An error occured";
                exit;
            }

            if (!pg_fetch_row($queryResult)){
                return false;
            }
            else{
                $this->validLogin = true;
                return true;
            }
        }

        //Constructor that validates the parameter and then checks the username for a valid entry.
        function __construct($Username, $Password){
            
            $this -> validLogin = false;
            if ($this->validateParams($Username, $Password)){
                $this->username = $Username;
                $this->password = $Password;

            }
            else{
                $this->username = "NULL";
                $this->password = "NULL";
            }
            
            if(!$this -> checkUserPassword()){
                $this->username = "NULL";
                $this->password = "NULL";
            }
        }

        //This function returns the username.
        public function getUsername(){
            return $this->username;
        }

        //This function returns the password.
        public function getPassword(){
            return $this->password;
        }
        
        //This function returns whether the login is valid or not.
        public function getLogin(){
            return $this->validLogin;
        }
        
        
        //This function retrieves the address for the user submitted.
        public static function userAddr($loggedUser){
            $JSONcontents = file_get_contents("../json/database.json");
            $databaseObj = json_decode($JSONcontents);
        
            $connectionString = "host=".$databaseObj->host." port=".$databaseObj->port." dbname=".$databaseObj->dbname." user=".$databaseObj->user." password=".$databaseObj->password;
        
            $dbconnect = pg_connect($connectionString);
            
            $queryString = "SELECT Address_1, Address_2, City, State, Zipcode FROM ClientInformation WHERE Username = '".$loggedUser."';";
            $queryResult = pg_query($dbconnect, $queryString);
            
            if(!$queryResult){
                echo("Error");
                exit();
            }
            
            $userAddress = pg_fetch_row($queryResult);
            $addressString = $userAddress[0]." ".$userAddress[1].", ".$userAddress[2].", ".$userAddress[3]." ".$userAddress[4];
            return $addressString;
        }
    }
?>
