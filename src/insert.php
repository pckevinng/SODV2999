<?php

require_once 'db_connect.php';

class InsertData {
    private $pdo;

    public function __construct(DatabaseConnection $databaseConnection) {
        $this->pdo = $databaseConnection->getConnection();
    }

    public function insertAction($data) {
        try {
            $query = "INSERT INTO actions (creator_id, project_id, issue_id, owner_contact_id, owner_contact_name, action_identifier, description, original_description, due_date, decision_made, status, progress, gyr, created_at, updated_at) 
                      VALUES (:creator_id, :project_id, :issue_id, :owner_contact_id, :owner_contact_name, :action_identifier, :description, :original_description, :due_date, :decision_made, :status, :progress, :gyr, :created_at, :updated_at)";
    
            $statement = $this->pdo->prepare($query);
            
            // Bind parameters
            $statement->bindParam(':creator_id', $data['creator_id']);
            $statement->bindParam(':project_id', $data['project_id']);
            $statement->bindParam(':issue_id', $data['issue_id']);
            $statement->bindParam(':owner_contact_id', $data['owner_contact_id']);
            $statement->bindParam(':owner_contact_name', $data['owner_contact_name']);
            $statement->bindParam(':action_identifier', $data['action_identifier']);
            $statement->bindParam(':description', $data['description']);
            $statement->bindParam(':original_description', $data['original_description']);
            $statement->bindParam(':due_date', $data['due_date']);
            $statement->bindParam(':decision_made', $data['decision_made']);
            $statement->bindParam(':status', $data['status']);
            $statement->bindParam(':progress', $data['progress']);
            $statement->bindParam(':gyr', $data['gyr']);
            $statement->bindParam(':created_at', $data['created_at']);
            $statement->bindParam(':updated_at', $data['updated_at']);
            
            // Execute the query
            $statement->execute();

            echo "Record inserted successfully!";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}

// Example usage:
$databaseConnection = new DatabaseConnection();
$insertData = new InsertData($databaseConnection);

// Example data to insert (modify as needed)
$newActionData = [
    'creator_id' => 3,
    'project_id' => 5,
    'issue_id' => 4,
    'owner_contact_id' => 7,
    'owner_contact_name' => 'John Doe',
    'action_identifier' => 'I2-A1',
    'description' => 'New action description',
    'original_description' => 'New action',
    'due_date' => '2022-02-28',
    'decision_made' => 1,
    'status' => 'open',
    'progress' => 50,
    'gyr' => 'yellow',
    'created_at' => date('Y-m-d H:i:s'),
    'updated_at' => date('Y-m-d H:i:s'),
];

// Insert the new record
$insertData->insertAction($newActionData);

// Close the connection when done
$databaseConnection->closeConnection();
?>
