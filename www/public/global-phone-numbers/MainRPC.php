<?php
/***
* This file, wrapping the Main object
* inside a jsonRPCServer and exposes its
* functionalities. 
*
*@main Main object
***/
require 'Main.php';
require_once  'remote/jsonrpcphp/includes/jsonRPCServer.php';
use MSISDN\Tool\Main;

$main = new Main();

jsonRPCServer::handle($main);
