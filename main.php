<?php
$conn = new mysqli("127.0.0.1","root","");
class Connection{
    private $conn;
    function __construct($conn) {
        $this->conn = $conn;
    }
    function close(){
        $this->conn->close();
    }
    function createDatabase($name, $collation){
        $sql = "CREATE DATABASE $name COLLATE $collation";
        if ($this->conn->query($sql) === TRUE) {
            $this->conn->select_db($name);
            return new Database($this->conn,$name,$collation);
        } else {
            echo "Error creating database";
            return false;
        }
    }
    function connectDatabase($name){
        $this->conn->select_db($name);
        if ($this->conn->connect_error) {
            echo "Error connecting to database";
            return false;
        } else {
            return new Database($this->conn,$name);
        }
    }
}
class Database{
    private $name;
    private $collation;
    private $conn;
    function __construct($conn,$name, $collation = ""){
        $this->name = $name;
        $this->collation = $collation;
        $this->conn = $conn;
    }
    function createDocument($name,$num_of_rows){   
        $rows = "";
        for ($i = 1; $i <= $num_of_rows; $i++) {
            $rows .= "column$i VARCHAR(255), ";
        }
        $rows = rtrim($rows, ', ');
         $sql = "CREATE TABLE $name($rows)";           
         if ($this->conn->query($sql) === TRUE) {
            return new Document($this->conn,$name,$num_of_rows);
        } else {
            echo "Error creating document";
            return false;
        }     
    }
}
class Document{
    private $name;
    private $num_of_rows;
    private $conn;
    function __construct($conn,$name, $num_of_rows){
        $this->name = $name;
        $this->num_of_rows = $num_of_rows;
        $this->conn = $conn;
    }
}
$connection = new Connection($conn);
$database = $connection->connectDatabase("testingDatabase");
$document = $database->createDocument("testingTable", 10);
$connection->close();
#TODO: 
// Connection
// new Connection($...data) - Connection between server and client using parameters: ip, user, password

// Database
// createDatabase($db_name, $collation) - Create database
// connectDatabase($db_name) - Connect database (mysqli_select_db("dbname", $conn))
// edit($db_name, $collation) - Edit database
// delete() - Delete database

// Document
// createDocument($doc_name, $num_of_rows) - Create document
// connectDocument($doc_name) - Connect document
// edit($doc_name, $num_of_rows) - Edit document
// delete() - Delete document

// Column
// createColumn($col_name, $type, $length, ...$data) - Create column
// findColumn($unique_column) - Find column
// edit($col_name, $type, $length, ...$data) - Edit column
// delete() - Delete column

// Data
// addData(...$data) - Add data
// findData($unique_value) - Find data
// edit($unique_value,...$data) - Edit data
// delete() - Delete data
?>
