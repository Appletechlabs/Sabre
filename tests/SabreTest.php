<?php

use Appletechlabs\Sabre\Sabre;

class SabreTest extends \PHPUnit_Framework_TestCase {

    function testSabreGetToken(){
        $Sabre = new Sabre("7971",'Z7B8','SRMLA79');
        $this->assertNotEmpty($Sabre->getToken()->access_token);
        print_r($Sabre->getToken());
    }
}
