<?php
use PHPUnit\Framework\TestCase;
require_once('./php_class/Registration.php');

    class RegistrationTest extends TestCase{

    #Test empty parameters
    public function testEmptyUsername(): void
    {
        $regTester = new ClientRegistration("", "fluffy2015");
        $this->assertSame($regTester -> getUsername(), null);
    }
    public function testEmptyPassword(): void
    {
        $regTester = new ClientRegistration("cooldude9", "");
        $this->assertSame($regTester -> getPassword(), null);
    }


    #Test get functions
    public function testRegGetUsername(): void
    {
        $regTester = new ClientRegistration("cooldude9", "fluffy2015");
        $this->assertSame($regTester -> getUsername(), "cooldude9");
    }
    public function testRegGetPassword(): void
    {
        $regTester = new ClientRegistration("cooldude9", "fluffy2015");
        $this->assertSame($regTester -> getPassword(), "fluffy2015");
    }

    #Test New Username
    public function testNewUser(): void
    {
        $regTester = new ClientRegistration("niceGuy3", "gg3");
        $this->assertSame($regTester -> getUsername(), "niceGuy3");
    }
}
?>
