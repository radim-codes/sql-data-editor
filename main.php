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
}
$connection = new Connection($conn);
//Insert your code here
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
