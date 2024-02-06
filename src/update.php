<?php

require_once 'db_connect.php';

class UpdateData {
    private $pdo;

    public function __construct(DatabaseConnection $databaseConnection) {
        $this->pdo = $databaseConnection->getConnection();
    }

    public function updateOwnerContactName($actionId, $newOwnerContactName) {
        try {
            // Check if the record exists before attempting to update
            if ($this->checkActionExists($actionId)) {
                $query = "UPDATE actions SET owner_contact_name = :new_owner_contact_name WHERE id = :action_id";
                $statement = $this->pdo->prepare($query);
                $statement->bindParam(':new_owner_contact_name', $newOwnerContactName);
                $statement->bindParam(':action_id', $actionId);
                $statement->execute();

                echo "Record updated successfully!";
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
$updateData = new UpdateData($databaseConnection);

// Example action_id and new owner_contact_name to update (modify as needed)
$actionIdToUpdate = 1300;
$newOwnerContactName = 'Peter Pan';

// Update the record
$updateData->updateOwnerContactName($actionIdToUpdate, $newOwnerContactName);

// Close the connection when done
$databaseConnection->closeConnection();
?>
