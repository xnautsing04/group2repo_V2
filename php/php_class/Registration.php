<?php
    class ClientRegistration{
        // Registration Variables
        private $username;
        private $password;

        // Validation Function (Validates that variables aren't empty)
        function validateParams($Username, $Password){
            if ($Username == "" or $Password == ""){
                $validParams = false;
            }
            else{
                $validParams = true;
            }
            return $validParams;
        }

        // Construct Function (Communicates with the DB to add Username and password to the DB)
        function __construct($Username, $Password){

            // Gets DB info from the database.json file
            $JSONcontents = file_get_contents("../json/database.json");
            $databaseObj = json_decode($JSONcontents);
            $connectionString = "host=".$databaseObj->host." port=".$databaseObj->port." dbname=".$databaseObj->dbname." user=".$databaseObj->user." password=".$databaseObj->password;
            $dbconnect = pg_connect($connectionString);

            // If the parameters are valid
            if ($this->validateParams($Username, $Password)){
                $this->username = $Username;
                $this->password = $Password;

                // SQL to insert Username and Password into the DB
                $sql = "INSERT INTO UserCredentials (username, password) VALUES ('$Username', crypt('$Password', gen_salt('md5')))";
                // SQL to check if there are any pre-existing Usernames that match inserted username (username is unique)
                $sql_unique = "SELECT username FROM UserCredentials where username = '$Username'";

                // Check uniqueness of Username
                $result = pg_query($dbconnect, $sql_unique);
                $row = pg_fetch_array($result);
                // If there is a single row with the inserted username already in the DB, the Username is already taken
                if($row >= 1){
                    echo "<h2>Username has already been taken. Please Register using another username.</h2>";
                }

                // If username is unique, insert Registration information into the DB
                elseif(pg_query($dbconnect, $sql)){
                    echo "Records inserted successfully.";
                    
                    // SQL to create ClientInformation Table for username
                    $sql_2 = "INSERT INTO ClientInformation (Username, Full_Name, Address_1, Address_2, City, State, Zipcode) VALUES('$Username', '', '', '', '', '', '');";
                    if(pg_query($dbconnect, $sql_2)){
                        echo "Client Information inserted successfully.";
                    }

                }
                
                // If there are any errors, echo error
                else{
                    echo "ERROR: Could not able to execute $sql. " . pg_error($dbconnect);
                }
                pg_free_result($result);
            }

            // If the parameters aren't valid (set to null)
            else{
                $this->username = null;
                $this->password = null;
                header("Location: ../pages/client_profile_err.html");
            }
        }

        // Get Username function
        public function getUsername(){
            return $this->username;
        }

        // Get Password function
        public function getPassword(){
            return $this->password;
        }
    }
?>
