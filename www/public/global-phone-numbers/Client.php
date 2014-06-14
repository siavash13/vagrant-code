<?php
namespace MSISDN\client;

/**
 * This class exposes JSONRPCClient API inside 
 * and handles calling of remote RPC server 
 * and printing out the result
 *
 * @remoteMain   jsonRPCClient object
 * @country_code country dialing code
 */

class Client
{
    private $remoteMain;
    private $result;
    private $number;
    private $country_code;
    /***
     * The constructor methof of class 
     *
     *@param input parameter which is a phone number
     ****/
    public function __construct($param)
    {
        require_once  'remote/jsonrpcphp/includes/jsonRPCClient.php';
        $this->remoteMain = new \jsonRPCClient('http://localhost/global-phone-numbers/MainRPC.php');
        $this->result = $this->remoteMain->getData($param);
        $this->number = $param;
        $this->country_code = $this->result['country_dial_code'];
    }
    
    public function printsTheResult()
    {
        //first line prints out the number by substracting the code length from the input
        echo 'number is : '. substr($this->number, strlen($this->country_code), strlen($this->number));
        echo $this->result['country_code'] . ', ' . $this->result['operator_name']. ', '
             . $this->country_code . ', ' . substr($this->number, strlen($this->country_code), strlen($this->number))
             . ', ' . $this->result['country_code'];
    }
    
    public function getResult()
    {
        return $this->result;
    }
}
