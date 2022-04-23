<?php
use PHPUnit\Framework\TestCase;
require_once('./php_class/FuelQuote.php');

    class FuelTest extends TestCase{

    //Test getting the gallon number.
    public function testFuelGetGallons(): void
    {
        $quoteTester = new FuelQuote(50, "2022-05-07", "cooldude9");
        $this->assertSame($quoteTester -> getGallons(), 50);
    }
    
    //Test getting the delivery date.
    public function testFuelGetDate(): void
    {
        $quoteTester = new FuelQuote(50, "2022-05-07", "cooldude9");
        $this->assertSame($quoteTester -> getDate(), "2022-05-07");
    }
    
    //Test a gallon number that is not a number.
    public function testFuelNaNGallons(): void
    {
        $quoteTester = new FuelQuote("not a number", "2022-08-30", "cooldude9");
        $this->assertSame($quoteTester -> getGallons(), -1);
    }
    
    //Test a gallon number that is negative.
    public function testFuelLowGallons(): void
    {
        $quoteTester = new FuelQuote(-18, "2022-08-30", "cooldude9");
        $this->assertSame($quoteTester -> getGallons(), -1);
    }
    
    //Test a delivery date that is not a date.
    public function testFuelNotTime(): void
    {
        $quoteTester = new FuelQuote(230, "on my birthday", "cooldude9");
        $this->assertSame($quoteTester -> getDate(), "1901-01-01");
    }
    
    //Test a delivery date that is earlier than the current date.
    public function testFuelEarlyTime(): void
    {
        $quoteTester = new FuelQuote(230, "2022-01-05", "cooldude9");
        $this->assertSame($quoteTester -> getDate(), "1901-01-01");
    }
    
    //Test a delivery date that is on the same day.
    public function testFuelSameDay(): void
    {
        $quoteTester = new FuelQuote(230, "now", "cooldude9");
        $this->assertSame($quoteTester -> getDate(), "1901-01-01");
    }
    
    //Test a delivery date that is on the next day.
    public function testFuelNextDay(): void
    {
        $quoteTester = new FuelQuote(230, date("Y-m-d", strtotime("now+1 day")), "cooldude9");
        $this->assertSame($quoteTester -> getDate(), "1901-01-01");
    }
    
    //Test a delivery date that is two days from now.
    public function testFuelTwoDays(): void
    {
        $quoteTester = new FuelQuote(230, date("Y-m-d", strtotime("now+2 day")), "cooldude9");
        $this->assertSame($quoteTester -> getDate(), date("Y-m-d", strtotime("now+2 day")));
    }
    
    //Test an interger price.
    public function testPriceInt(): void
    {
        $this->assertSame("$171.00", FuelQuote::calculatePrice("cooldude9", 100));
    }
    
    //Test a float price.
    public function testPriceFloat(): void
    {
        $this->assertSame("$210.33", FuelQuote::calculatePrice("cooldude9", 123));
    }
    
    //Test inserting data into the database.
    public function testInsertData(): void
    {
        $quoteTester = new FuelQuote(1011, "2022-05-07", "cooldude9");
        $quoteTester -> insertData();
        
        $JSONcontents = file_get_contents("../json/database.json");
        $databaseObj = json_decode($JSONcontents);
        
        $connectionString = "host=".$databaseObj->host." port=".$databaseObj->port." dbname=".$databaseObj->dbname." user=".$databaseObj->user." password=".$databaseObj->password;
       
        $dbconnect = pg_connect($connectionString);
            
        $queryString = "SELECT * FROM FuelQuote WHERE Username = 'cooldude9' AND Gallon_Number = 1011 AND Delivery_Date = '2022-05-07';";
        $queryResult = pg_query($dbconnect, $queryString);
        
        $this->assertTrue(!empty($queryResult));
    }
}
?>
