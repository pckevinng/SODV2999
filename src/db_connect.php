<?php

class DatabaseConnection {
    private $host;
    private $port;
    private $database;
    private $username;
    private $password;
    private $connection;

    public function __construct() {
        $this->host = 'localhost';
        $this->port = 3306;
        $this->database = 'traxidy';
        $this->username = 'root';
        $this->password = 'QAZxc123@!';
        $this->connect();
    }

    private function connect() {
        try {
            // Use the PDO class directly
            $this->connection = new PDO(
                "mysql:host={$this->host};port={$this->port};dbname={$this->database}",
                $this->username,
                $this->password
            );
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected to the database successfully!";
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->connection;
    }

    public function closeConnection() {
        $this->connection = null;
        echo "Connection closed!";
    }
}

// Example usage:
$databaseConnection = new DatabaseConnection();
$pdo = $databaseConnection->getConnection();

// Perform database operations using $pdo

// Close the connection when done
$databaseConnection->closeConnection();
?>
