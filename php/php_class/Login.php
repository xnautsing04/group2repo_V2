<?php
    class Login{
        private $username;
        private $password;
        private $validLogin;

        function validateParams($Username, $Password){
            if ($Username != null && $Password != null){
                $validParams = true;
            }
            else{
                $validParams = false;
            }
            
            return $validParams;
        }
        
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
                header("Location: ../pages/login_err.html");
            }
            else{
                setcookie("username",$this->username,time() + 60*60*24*30);
                setcookie("password",$this->password,time() + 60*60*24*30);
                header("Location: ../php/fuelQuoteForm.php");
                $this->validLogin = true;
            }
        }

        function __construct($Username, $Password){
            
            $this -> validLogin = false;
            if ($this->validateParams($Username, $Password)){
                $this->username = $Username;
                $this->password = $Password;

            }
            else{
                $this->username = "NULL";
                $this->password = "NULL";
                header("Location: ../pages/login_err.html");
            }
            
            $this -> checkUserPassword();
        }

        public function getUsername(){
            return $this->username;
        }

        public function getPassword(){
            return $this->password;
        }
        
        public function getLogin(){
            return $this->validLogin;
        }
        
        public static function logOut(){
            setcookie("username","",time() - 3600);
            setcookie("password","",time() -3600);
            header("Location: ../php/login.php");
        }
        
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
