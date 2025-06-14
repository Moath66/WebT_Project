<?php
require_once '../db.php';

// Get posted data
$data = json_decode(file_get_contents("php://input"));

// Validate data
if (
    !isset($data->date) ||
    !isset($data->category) ||
    !isset($data->type) ||
    !isset($data->amount)
) {
    http_response_code(400);
    echo json_encode(['message' => 'Missing required fields']);
    exit();
}

try {
    $database = new Database();
    $db = $database->getConnection();
    
    // Check if transaction exists
    $check_query = "SELECT id FROM transactions WHERE id = :id";
    $check_stmt = $db->prepare($check_query);
    $check_stmt->bindParam(":id", $id);
    $check_stmt->execute();
    
    if($check_stmt->rowCount() == 0) {
        http_response_code(404);
        echo json_encode(['message' => 'Transaction not found']);
        exit();
    }
    
    $query = "UPDATE transactions 
              SET date = :date, 
                  category = :category, 
                  type = :type, 
                  amount = :amount 
              WHERE id = :id";
              
    $stmt = $db->prepare($query);
    
    // Sanitize and bind data
    $stmt->bindParam(":id", $id);
    $stmt->bindParam(":date", $data->date);
    $stmt->bindParam(":category", $data->category);
    $stmt->bindParam(":type", $data->type);
    $stmt->bindParam(":amount", $data->amount);
    
    if($stmt->execute()) {
        http_response_code(200);
        echo json_encode(['message' => 'Transaction updated successfully']);
    } else {
        throw new Exception('Unable to update transaction');
    }
} catch(Exception $e) {
    http_response_code(500);
    echo json_encode([
        'message' => 'Error updating transaction',
        'error' => $e->getMessage()
    ]);
}
?> 