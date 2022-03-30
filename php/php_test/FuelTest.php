<?php
use PHPUnit\Framework\TestCase;
require_once('./php_class/FuelQuote.php');

    class FuelTest extends TestCase{

    public function testFuelGetGallons(): void
    {
        $quoteTester = new FuelQuote(50, "2022-05-07", "cooldude9");
        $this->assertSame($quoteTester -> getGallons(), 50);
    }
    public function testFuelGetDate(): void
    {
        $quoteTester = new FuelQuote(50, "2022-05-07", "cooldude9");
        $this->assertSame($quoteTester -> getDate(), "2022-05-07");
    }
    public function testFuelNaNGallons(): void
    {
        $quoteTester = new FuelQuote("not a number", "2022-08-30", "cooldude9");
        $this->assertSame($quoteTester -> getGallons(), -1);
    }
    public function testFuelLowGallons(): void
    {
        $quoteTester = new FuelQuote(-18, "2022-08-30", "cooldude9");
        $this->assertSame($quoteTester -> getGallons(), -1);
    }
    public function testFuelNotTime(): void
    {
        $quoteTester = new FuelQuote(230, "on my birthday", "cooldude9");
        $this->assertSame($quoteTester -> getDate(), "1901-01-01");
    }
    public function testFuelEarlyTime(): void
    {
        $quoteTester = new FuelQuote(230, "2022-01-05", "cooldude9");
        $this->assertSame($quoteTester -> getDate(), "1901-01-01");
    }
    public function testFuelSameDay(): void
    {
        $quoteTester = new FuelQuote(230, "now", "cooldude9");
        $this->assertSame($quoteTester -> getDate(), "1901-01-01");
    }
    public function testFuelNextDay(): void
    {
        $quoteTester = new FuelQuote(230, date("Y-m-d", strtotime("now+1 day")), "cooldude9");
        $this->assertSame($quoteTester -> getDate(), "1901-01-01");
    }
    public function testFuelTwoDays(): void
    {
        $quoteTester = new FuelQuote(230, date("Y-m-d", strtotime("now+2 day")), "cooldude9");
        $this->assertSame($quoteTester -> getDate(), date("Y-m-d", strtotime("now+2 day")));
    }
    public function testPriceInt(): void
    {
        $quoteTester = new FuelQuote(100, "2022-05-07", "cooldude9");
        $this->assertSame($quoteTester->calculatePrice(), "$250.00");
    }
    public function testPriceFloat(): void
    {
        $quoteTester = new FuelQuote(101, "2022-05-07", "cooldude9");
        $this->assertSame($quoteTester->calculatePrice(), "$252.50");
    }
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
