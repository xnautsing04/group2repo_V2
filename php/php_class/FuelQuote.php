<?php
require_once('PriceCalculator.php');
    class FuelQuote{
        //This variable stores the number of gallons ordered.
        private $numGallons;
        
        //This variable stores the requested delivery date.
        private $deliveryDate;
        
        //This variable stores the username who requested the fuel quote.
        private $username;

        //This function ensures the data sent are valid, such as nonnegative numbers and a date that is not in the past.
        function validateParams($gallons, $delivery, $username){
            $validParams = true;
            if (!is_numeric($gallons)){
                $validParams = false;
            }
            if (intval($gallons) < 0){
                $validParams = false;
            }
            
            if(!strtotime($delivery)){
                $validParams = false;
            }
            
            if(strtotime($delivery) < strtotime("now+1 day")){
                $validParams = false;
            }
            
            return $validParams;
        }
        
        //Constructor that ensures the parameters are valid and if not, display the error page.
        function __construct($gallons, $delivery, $username){
            if ($this->validateParams($gallons, $delivery, $username)){
                $this->numGallons = $gallons;
                $this->deliveryDate = $delivery;
                $this->username = $username;
            }
            else{
                $this->numGallons = -1;
                $this->deliveryDate = "1901-01-01";
            }
        }

        //Returns the number of gallons ordered.
        public function getGallons(){
            return $this->numGallons;
        }

        //Return the date requested.
        public function getDate(){
            return $this->deliveryDate;
        }
        
        //Use the Price Calculator and the number of gallons requested to calculate the total price.
        public function calculatePrice(){
             //This will later be calculated/gathered from the pricing module, saved as it's own object.
            $suggestedCost = PriceCalculator::suggestedPrice();
    
            $price = floatval(substr($suggestedCost, 1));
            $gallonNumber = intval($this->numGallons);

            $totalCost = ($price * $gallonNumber);
            
            $totalCostFormat = strval(number_format($totalCost, 2));

            return("$".$totalCostFormat);
        }
        
        //Use the database information to input the requested data into the database.
        public function insertData(){
            $JSONcontents = file_get_contents("../json/database.json");
            $databaseObj = json_decode($JSONcontents);
        
            $connectionString = "host=".$databaseObj->host." port=".$databaseObj->port." dbname=".$databaseObj->dbname." user=".$databaseObj->user." password=".$databaseObj->password;
       
            $dbconnect = pg_connect($connectionString);
            
            $queryString = "SELECT Address_1, Address_2, City, State, Zipcode FROM ClientInformation WHERE Username = '".$this->username."';";
            $queryResult = pg_query($dbconnect, $queryString);
            
            if(!$queryResult){
                echo("Error");
                exit();
            }
            
            $userAddress = pg_fetch_row($queryResult);
            if($userAddress)
            {
                $addressString = $userAddress[0]." ".$userAddress[1].", ".$userAddress[2].", ".$userAddress[3]." ".$userAddress[4];
            $suggestedPrice = floatval(substr(PriceCalculator::suggestedPrice(), 1));
            $totalPrice = floatval(substr($this->calculatePrice(), 1));
            $time = strval(time());
            
            $insertString = 'INSERT INTO FuelQuote (Serial_No, Username, Address, Delivery_Date, Gallon_Number, Suggested_Price, Total_Price)';
            $insertString .= ' VALUES (\''.$time.'\', \''.$this->username.'\', \''.$addressString.'\', \''.$this->deliveryDate.'\', '.$this->numGallons.', '.$suggestedPrice.', '.$totalPrice.');';
            
            $res = pg_query($dbconnect, $insertString);
            if ($res){
                return true;
            }
            else{
                return false;
            }
            }
            else
            {
                return false;
            }
            
        }
    }

