<?php
class Database{
    // Singleton Pattern
    protected static $_instance = null;

    private $connection;
    private const SERVER_NAME = "localhost";
    private const USER = "wt2";
    private const PASS = "strenggeheim";
    private const DB_NAME = "sport_calender";

    public static function getInstance() : self { // If the single instance does not yet exist, create it Then return the single instance
        if (self::$_instance === null) {
            self::$_instance = new self;
        }
        return self::$_instance;
    }
    //Prohibit copying the instance from outside
    protected function __clone() {}
    // Set up connection to DB
    protected function __construct(){
        // prohibit external instantiation
        // Create connection
        $this->connection = new mysqli(Database::SERVER_NAME, Database::USER, Database::PASS, database::DB_NAME);

        // Check connection
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
        $this->connection->set_charset('utf8mb4');
    }
    // Send query to DB
    public function query(string $sqlStatement) {
        // send query(request) to DB and check if query(get) was successful
        if ($result = $this->connection->query($sqlStatement)) {
            return $result;
        } else {
            return false;
        }
    }
    
    
}

?>