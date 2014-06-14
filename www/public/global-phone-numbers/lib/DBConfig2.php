<?php
namespace MSISDN\DB;

/*
 * This class handles database creation and also
 * queries to dagtabase
 *
 * @mysql mysqli object
 */
class DBConfig2
{
    private $mysqli;

    public function __construct()
    {
         include  'lib'.DIRECTORY_SEPARATOR. 'Config.php';
         $this->mysqli = new \mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
    }

    /***
     * This function create the table if not exists
     *
     * @sql the query that import data into table
     ***/
    public function createTable()
    {
        $sql = file_get_contents("lib\msisdn.sql");
        $this->mysqli->multi_query($sql);
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
    }

     /***
     * This function takes a phone number as input and returns details
     * relating to it as output
     *
     * @number the phone number
     * @row the record that fetched from table which holds phone number
     *      details
     ***/
    public function getData($number)
    {
        $result = $this->mysqli->query(
            "select t.* from prefix t where $number like concat(t.first_digits, '%')
                order by length(t.first_digits) desc limit 1"
        );
        $row = mysqli_fetch_array($result);
        return $row;
    }

    /***
     * This function takes an id as input and returns details of the
     * record with that id
     *
     * @id the id of row in prefix table
     * @row the record that fetched from table which id is @id
     *      details
     ***/
    public function getById($prefix_id)
    {
        $result = $this->mysqli->query(
            "select t.* from prefix t where id = $prefix_id"
        );
        $row = mysqli_fetch_array($result);
        return $row;
    }
}
