<?php

use PHPUnit\Framework\TestCase;
require_once('./php_class/FuelHistory.php');

    class HistoryTest extends TestCase{

        //more detailed testing will be possible once the database is connected
        public function testGenerateHistory(): void
        {
        
            $this->assertTrue(FuelHistory::generateHistory("cooldude9") != "");
        }
        
    }
