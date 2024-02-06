<?php

require_once 'db_connect.php';

class DeleteData {
    private $pdo;

    public function __construct(DatabaseConnection $databaseConnection) {
        $this->pdo = $databaseConnection->getConnection();
    }

    public function deleteAction($actionId) {
        try {
            // Check if the record exists before attempting to delete
            if ($this->checkActionExists($actionId)) {
                $query = "DELETE FROM actions WHERE id = :action_id";
                $statement = $this->pdo->prepare($query);
                $statement->bindParam(':action_id', $actionId);
                $statement->execute();

                echo "Record deleted successfully!";
            } else {
                echo "Error: The provided action_id does not exist in the actions table.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    private function checkActionExists($actionId) {
        $query = "SELECT COUNT(*) FROM actions WHERE id = :action_id";
        $statement = $this->pdo->prepare($query);
        $statement->bindParam(':action_id', $actionId);
        $statement->execute();

        $count = $statement->fetchColumn();
        return ($count > 0);
    }
}

// Example usage:
$databaseConnection = new DatabaseConnection();
$deleteData = new DeleteData($databaseConnection);

// Example action_id to delete (modify as needed)
$actionIdToDelete = 1297;

// Delete the record
$deleteData->deleteAction($actionIdToDelete);

// Close the connection when done
$databaseConnection->closeConnection();
?>
