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
    function createDocument($name){   
         $sql = "CREATE TABLE $name(SDE_PLACEHOLDER INT)";           
         if ($this->conn->query($sql) === TRUE) {
            return new Document($this->conn,$name);
        } else {
            echo "Error creating document";
            return false;
        }     
    }
}
class Document{
    private $name;
    private $conn;
    private $columns;
    function __construct($conn,$name){
        $this->name = $name;
        $this->conn = $conn;
        $this->columns = 0;
    }
    function createColumn($row_name, $type, $length){
        if($this->columns == 0){
            $sql = "ALTER TABLE $this->name CHANGE COLUMN SDE_PLACEHOLDER $row_name $type($length)";
        }else{
            $sql = "ALTER TABLE $this->name ADD $row_name $type($length)";
        }
        if ($this->conn->query($sql) === FALSE) {
            echo "Error creating row";
            return false;
        } 
        $this->columns += 1;
        return true;
    }
}
$connection = new Connection($conn);

$database = $connection->createDatabase("Database", "utf8_general_ci");

$document = $database->createDocument("Document");

$document->createColumn("id", "INT", 10);
$document->createColumn("username", "VARCHAR", 20);
$document->createColumn("email", "VARCHAR", 255);
$document->createColumn("password", "VARCHAR", 255);

$connection->close();
#TODO: 
// Connection
// new Connection($...data) - Connection between server and client using parameters: ip, user, password

// Database
// connectDatabase($db_name) - Connect database (mysqli_select_db("dbname", $conn))
// edit($db_name, $collation) - Edit database
// delete() - Delete database

// Document
// connectDocument($doc_name) - Connect document
// edit($doc_name, $num_of_rows) - Edit document
// delete() - Delete document

// Column
// findColumn($unique_column) - Find column
// edit($col_name, $type, $length, ...$data) - Edit column
// delete() - Delete column

// Data
// addData(...$data) - Add data
// findData($unique_value) - Find data
// edit($unique_value,...$data) - Edit data
// delete() - Delete data
?>
