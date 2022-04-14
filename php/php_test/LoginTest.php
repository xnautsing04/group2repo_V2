<?php

use PHPUnit\Framework\TestCase;
require_once('./php_class/Login.php');

    class LoginTest extends TestCase{

        //Test getting the username.
        public function testUsername(): void
        {
            $userLogin = new Login ("cooldude9", "Fluffy2007!");
        
            $this->assertSame($userLogin->getUsername(), "cooldude9");
        }
        
        //Test getting the password.
        public function testPassword(): void
        {
            $userLogin = new Login ("cooldude9", "Fluffy2007!");
        
            $this->assertSame($userLogin->getPassword(), "Fluffy2007!");
        }
        
        //Test a null login.
        public function testNullLogin(): void
        {
            $userLogin = new Login (null, null);
            
            $this->assertSame($userLogin->getUsername().$userLogin->getPassword(), "NULLNULL");
        }
        
        //Test a valid login.
        public function testValidLogin(): void
        {
            $userLogin = new Login ("cooldude9", "Fluffy2007!");
        
            $this->assertSame($userLogin->getLogin(), true);
        }
        
        //Test an invalid login.
        public function testInvalidLogin(): void
        {
            $userLogin = new Login ("badUsername", "notAPassword");
        
            $this->assertSame($userLogin->getLogin(), false);
        }
        
        //Test getting a user address.
        public function testAddr():void
        {
            $this->assertSame(Login::userAddr('cooldude9'), "123 Acrobat Rd #407C, Houston, ID 11132");
        }
    }

