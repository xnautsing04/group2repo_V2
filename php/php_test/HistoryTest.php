<?php

use PHPUnit\Framework\TestCase;
require_once('./php_class/FuelHistory.php');

    class HistoryTest extends TestCase{

        //This function ensures that an HTML form is being generated by the function with database information.
        public function testGenerateHistory(): void
        {
            $this->assertTrue(FuelHistory::generateHistory("cooldude9") != "");
        }
        
    }
