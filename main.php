<?php
class Connection {
    private $connection;

    public function __construct($conn) {
        $this->connection = $conn;
    }

    public function createDatabase($name, $collation = "utf8_general_ci") {
        $sql = "CREATE DATABASE $name COLLATE $collation";
        if (mysqli_query($this->connection, $sql)) {
            echo "Database created successfully<br>";
            return true;
        } else {
            echo "Error creating database: " . mysqli_error($this->connection);
            return false;
        }
    }
}

class Database {
    private $connection;
    private $name;

    public function __construct($connection, $name) {
        $this->connection = $connection;
        $this->name = $name;
    }

    public function createDocument($name, $num_columns) {
        $sql = "CREATE TABLE $this->name.$name (id INT AUTO_INCREMENT PRIMARY KEY)";
        if (mysqli_query($this->connection, $sql)) {
            echo "Document created successfully<br>";
            return true;
        } else {
            echo "Error creating document: " . mysqli_error($this->connection);
            return false;
        }
    }

    // Other methods for database operations
}

class Document {
    private $connection;
    private $name;

    public function __construct($connection, $name) {
        $this->connection = $connection;
        $this->name = $name;
    }
    public function addRow($name, $type, $length) {
        global $conn;
        // Construct the column definition
        $column_definition = "$name $type";
    
        // Add length if provided and type allows it
        if ($length && in_array($type, ['VARCHAR', 'CHAR', 'TEXT'])) {
            $column_definition .= "($length)";
        }
    
        // Construct SQL query to alter table and add the column
        $sql = "ALTER TABLE $this->name ADD COLUMN $column_definition";
    
        // Execute the query
        if (mysqli_query($this->connection, $sql)) {
            echo "Column $name added to $this->name<br>";
            return true;
        } else {
            echo "Error adding column $name to $this->name: " . mysqli_error($this->connection);
            return false;
        }
    }
    public function addData(...$data) {
        // Add data to the document
        $values = "'" . implode("', '", $data) . "'";
        $sql = "INSERT INTO $this->name VALUES ($values)";
        if (mysqli_query($this->connection, $sql)) {
            echo "Data added successfully<br>";
            return true;
        } else {
            echo "Error adding data: " . mysqli_error($this->connection);
            return false;
        }
    }
}
?>
