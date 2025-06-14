<?php
require_once '../db.php';

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
    
    $query = "DELETE FROM transactions WHERE id = :id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":id", $id);
    
    if($stmt->execute()) {
        http_response_code(200);
        echo json_encode(['message' => 'Transaction deleted successfully']);
    } else {
        throw new Exception('Unable to delete transaction');
    }
} catch(Exception $e) {
    http_response_code(500);
    echo json_encode([
        'message' => 'Error deleting transaction',
        'error' => $e->getMessage()
    ]);
}
?> 