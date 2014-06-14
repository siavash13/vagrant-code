<?php
namespace MSISDN\unitTest;

use MSISDN\DB\DBConfig2;
use MSISDN\client\Client;

/***
 * This class is handling the Unit Tests the first 2 assertions test
 * that codes of DB returns the right values the first 2 should return
 * the same result
 * 
 * The next assert should check if the result of clientRPC call and server
 * returns the same value
 * 
 * @randomNumber is a random number in range 
 *               of id(s) of prefix table   
 * @randomRow    holds a record of prefix table with id equals to
 *               randomNumber
 * @resultRow    holds a record of prefix table that matches the 
 *               prefix code
 * @prefix_code  the phone number used in tests      
 * @clientRPC    object Client 
 * 
***/

class UnitTest extends \PHPUnit_Framework_TestCase
{
    private $randomNumber;
    private $resultRow;
    private $randomRow;
    private $clientRPC;
    private $clientRecord;

    public function testDBData()
    {
        require_once 'Client.php';
        require_once './lib/DBConfig2.php';
        $dbConnection = new DBConfig2();
                
        $this->randomNumber  = rand(1, 1700);
        $this->randomRow = $dbConnection->getById($this->randomNumber);
        //prefix_code firstly initialized with a first digits of random record
        $prefix_code = $this->randomRow['first_digits'];
        //a random number is added to prefix code to create a 10 digits phone number
        for ($i = 1; $i < 10-strlen($this->randomNumber); ++$i) {
            $prefix_code .= rand(0, 9);
        }
        //creates a ClientRPC
        $this->clientRPC = new Client($prefix_code);
        $this->resultRow = $dbConnection->getData($prefix_code);
        //get the record and stores in @clientRPC
        $this->clientRecord = $this->clientRPC->getResult();
        $this->assertEquals($this->randomRow['first_digits'], $this->resultRow['first_digits']);
        $this->assertEquals($this->randomRow['country_code'], $this->resultRow['country_code']);
        $this->assertEquals($this->clientRecord['country_code'], $this->resultRow['country_code']);
        
    }
}
