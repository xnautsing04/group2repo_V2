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
            
            $queryString = "SELECT Password FROM UserCredentials WHERE Username = '".$this->username."';";
            
            $queryResult = pg_query($dbconnect, $queryString);
            if (!$queryResult){
                echo "An error occured";
                exit;
            }
            
            $savedPassword = pg_fetch_row($queryResult)[0];

            
            if ($this->password != $savedPassword){
                header("Location: ../pages/login_err.html");
            }
            else{
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
    }
?>