<?php

use PHPUnit\Framework\TestCase;
require_once('./php_class/Login.php');

    class LoginTest extends TestCase{

        //more detailed testing will be possible once the database is connected
        public function testUsername(): void
        {
            $userLogin = new Login ("testUsername", "testPassword123!!");
        
            $this->assertSame($userLogin->getUsername(), "testUsername");
        }
        
        public function testPassword(): void
        {
            $userLogin = new Login ("testUsername", "testPassword123!!");
        
            $this->assertSame($userLogin->getPassword(), "testPassword123!!");
        }
        
        public function testNullLogin(): void
        {
            $userLogin = new Login (null, null);
            
            $this->assertSame($userLogin->getUsername().$userLogin->getPassword(), "NULLNULL");
        }
        
        public function testValidLogin(): void
        {
            $userLogin = new Login ("cooldude9", "Fluffy2007!");
        
            $this->assertSame($userLogin->getLogin(), true);
        }
        
        public function testInvalidLogin(): void
        {
            $userLogin = new Login ("badUsername", "notAPassword");
        
            $this->assertSame($userLogin->getLogin(), false);
        }
        
        public function testLogout(): void
        {
            Login::logOut();
            $this->assertTrue(!isset($_COOKIE["username"]));
        }
        
        public function testAddr():void
        {
            $this->assertSame(Login::userAddr('cooldude9'), "123 Alphabet Rd 456 Orange St, Houston, TX 77204");
        }
    }

