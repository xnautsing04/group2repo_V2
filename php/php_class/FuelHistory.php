<?php
require_once('FuelQuote.php');
class FuelHistory{
    
    //This function generates HTML from the information retrieved from the database.
    static function generateHistory($username){
        
        $JSONcontents = file_get_contents("../json/database.json");
        $databaseObj = json_decode($JSONcontents);
        
        $connectionString = "host=".$databaseObj->host." port=".$databaseObj->port." dbname=".$databaseObj->dbname." user=".$databaseObj->user." password=".$databaseObj->password;
        
        $dbconnect = pg_connect($connectionString);
       
        $queryString = "SELECT * FROM FuelQuote WHERE Username ='".$username."';";
        
        $queryResult = pg_query($dbconnect, $queryString);
        if (!$queryResult){
            echo "An error occured";
            exit;
        }
        
        
        $tableHTML = '';
        
        //This will later be retrieved from the database and stored in a Profile class.
        
        //This simulates getting tables from database with username given, then begin iterating through
        $historyData = array();

        while ($row = pg_fetch_row($queryResult)){
            $tableHTML .= '<table class = "histTable">';
            $tableHTML .= '<p class = "text-center">'.strval($row[3]).'</p>';
            $tableHTML .= "<tr>";
            $tableHTML .= "<th>Gallon Number:</th><td>";
            $tableHTML .= strval($row[4]);
            $tableHTML .= "</td></tr>";
            $tableHTML .= "<th>Delivery Address:</th><td>";
            $tableHTML .= $row[2];
            $tableHTML .= "</td></tr><tr><th>Delivery Date: </th><td>";
            $tableHTML .= strval($row[3]);
            $tableHTML .= "</td></tr><tr><th>Total Price: </th><td>";
            $tableHTML .= strval($row[6]);
            $tableHTML .= "</td></tr></table><br>";
        }
        return $tableHTML;
    }
}
