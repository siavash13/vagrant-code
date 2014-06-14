<?php
/***
 * Creating object of RPCClient and passing the
 * phone number is done in this file
 *
 * @number the phone number passed from index.php
 * @client  Client object
 ***/

require 'client.php';
use MSISDN\client\Client;

$number = $_GET['number'];
try {
    $client = new Client($number);
} catch (\Exception $exception) {
    echo 'Something went wrong with number';
    echo $exception->getMessage();
    exit();
}
$client->printsTheResult();
?>
<br />
<a href="index.php" >Back to Home</a>
