<?php

error_reporting(E_ALL);
ini_set('display_error',1);

class Donation{
    public $id;
    public $name;
    public $description;
    public $create_at;
    public $updated_at;


    private $connection;
    private $table = "donations";

    
    public function __construct($database){
        $this->connection = $database;
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE TABLE IF NOT EXISTS $this->table (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255),
            description TEXT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
        
        $this->connection->exec($sql);
    }

    public function getAllDonations(){
        $query = 'SELECT * FROM donations';
        $donationList = $this->connection->prepare($query);
        $donationList->execute();
        return $donationList;
    }

}