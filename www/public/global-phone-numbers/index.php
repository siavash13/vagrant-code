<?php
    /***
     *This file is the main entrance of the app
     * at the start it creates a table and fill
     * it with data 
     *      
     * it displays an inputt field which is for 
     * getting the phone number from user
     * 
     * @db DBConfig2 object, creates table in DB
     ***/

    require 'client.php';
    require_once 'lib\DBConfig2.php';
    
    use MSISDN\DB\DBConfig2;
    
    $db = new DBConfig2();
    $db->createTable();
?>
<form method="get" action="compute.php">
    <input type="text" name="number" />
    <input type="submit" value="Submit" />
 </form>
