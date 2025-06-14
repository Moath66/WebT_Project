<?php
require_once '../db.php';

try {
    $database = new Database();
    $db = $database->getConnection();
    
    $query = "DELETE FROM transactions";
    $stmt = $db->prepare($query);
    
    if($stmt->execute()) {
        http_response_code(200);
        echo json_encode(['message' => 'All transactions deleted successfully']);
    } else {
        throw new Exception('Unable to delete transactions');
    }
} catch(Exception $e) {
    http_response_code(500);
    echo json_encode([
        'message' => 'Error deleting transactions',
        'error' => $e->getMessage()
    ]);
}
?> 