<?php

class PriceCalculator{
    
    //This function returns the suggested price per gallon.
    public static function suggestedPrice($username, $gallons){
        $JSONcontents = file_get_contents("../json/database.json");
        $databaseObj = json_decode($JSONcontents);
        $connectionString = "host=".$databaseObj->host." port=".$databaseObj->port." dbname=".$databaseObj->dbname." user=".$databaseObj->user." password=".$databaseObj->password;
        $dbconnect = pg_connect($connectionString);

        // Check to see if client has any past fuel history
        $sql_history = "SELECT * FROM FuelQuote WHERE Username = '$username';";
        $result = pg_query($dbconnect, $sql_history);
        if (pg_num_rows($result) >= 1){
            $fuelhistory = .01;
        }
        else{
            $fuelhistory = .00;
        }
        
        //Check to see if the client is from Texas
        $sql_state = "SELECT state FROM ClientInformation WHERE Username = '$username' AND state = 'TX';";
        $result = pg_query($dbconnect, $sql_state);
        if (pg_num_rows($result) >= 1){
            $state = .02;
        }
        else{
            $state = .04;
        }
        
        // Check to see if the client ordered more than 1000 gallons of fuel
        if($gallons > 1000){
            $gallonamount =.02;
        }
        else{
            $gallonamount = .03;
        }

        $margin = (1.50)*($state-$fuelhistory+$gallonamount+.1);
        $sugg_price = $margin + (1.50);

        // Total Amount = gallons * suggested price/gallon

        return '$'.$sugg_price;
    }
}
