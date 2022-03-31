<?php

use PHPUnit\Framework\TestCase;
require_once('./php_class/Login.php');

    class LoginTest extends TestCase{

        //Test getting the username.
        public function testUsername(): void
        {
            $userLogin = new Login ("testUsername", "testPassword123!!");
        
            $this->assertSame($userLogin->getUsername(), "testUsername");
        }
        
        //Test getting the password.
        public function testPassword(): void
        {
            $userLogin = new Login ("testUsername", "testPassword123!!");
        
            $this->assertSame($userLogin->getPassword(), "testPassword123!!");
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
        
        //Test logging out a user.
        public function testLogout(): void
        {
            Login::logOut();
            $this->assertTrue(!isset($_COOKIE["username"]));
        }
        
        //Test getting a user address.
        public function testAddr():void
        {
            $this->assertSame(Login::userAddr('cooldude9'), "123 Alphabet Rd 456 Orange St, Houston, TX 77204");
        }
    }

