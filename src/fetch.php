<?php

require_once 'db_connect.php';

class FetchData {
    private $pdo;

    public function __construct(DatabaseConnection $databaseConnection) {
        $this->pdo = $databaseConnection->getConnection();
    }

    public function getAllActions() {
        try {
            $query = "SELECT * FROM actions";
            $statement = $this->pdo->query($query);
    
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    
            // Display the data in an HTML table
            $this->displayTable($result);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    private function displayTable($data) {
        echo '<table border="1">';
        echo '<tr>';
        foreach ($data[0] as $key => $value) {
            echo '<th>' . $key . '</th>';
        }
        echo '</tr>';
        
        foreach ($data as $row) {
            echo '<tr>';
            foreach ($row as $value) {
                echo '<td>' . $value . '</td>';
            }
            echo '</tr>';
        }
        
        echo '</table>';
    }
}

// Example usage:
$databaseConnection = new DatabaseConnection();
$fetchData = new FetchData($databaseConnection);
$fetchData->getAllActions();

// Close the connection when done
$databaseConnection->closeConnection();
?>
