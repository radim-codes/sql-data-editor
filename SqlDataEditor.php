<?php

class Connection {
    private $host;          // Hostname or IP address of the MySQL server
    private $username;      // Username for MySQL authentication
    private $password;      // Password for MySQL authentication
    private $charset;       // Character set for the MySQL connection
    private $pdo;           // PDO instance for the database connection

    /**
     * Constructor for the Connection class.
     *
     * @param PDO|string|null $connection An existing PDO connection or the host string.
     * @param string|null $username MySQL username (if $connection is not a PDO instance).
     * @param string|null $password MySQL password (if $connection is not a PDO instance).
     * @param string|null $charset Character set for the connection (optional).
     */
    public function __construct($connection = null, $username = null, $password = null, $charset = null) {
        if ($connection instanceof PDO) { // Use the existing PDO connection if provided
            $this->pdo = $connection;
            $this->host = $this->pdo->getAttribute(PDO::ATTR_CONNECTION_STATUS);
        } else {
            // Ensures that necessary connection parameters are provided
            if ($connection === null) {
                die("Connection failed: You need to provide a host.");
            }
            $this->host = $connection;

            if ($username === null) {
                die("Connection failed: You need to provide a username.");
            }
            $this->username = $username;

            if ($password === null) {
                die("Connection failed: You need to provide a password.");
            }
            $this->password = $password;

            $this->charset = $charset ?? 'utf8mb4'; // Set default charset if not provided

            try { // Establish a new PDO connection
                $this->pdo = new PDO("mysql:host=$this->host;charset=$this->charset", $this->username, $this->password);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Connection failed: " . $e->getMessage());
            }
        }
    }

    public function close() { // Closes the connection to the MySQL server.
        $this->pdo = null;
    }
}
