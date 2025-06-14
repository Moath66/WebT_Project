<?php
require_once '../db.php';

try {
    $database = new Database();
    $db = $database->getConnection();
    
    $query = "SELECT * FROM transactions ORDER BY date DESC";
    $stmt = $db->prepare($query);
    $stmt->execute();
    
    $transactions = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    http_response_code(200);
    echo json_encode($transactions);
} catch(PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'message' => 'Database error',
        'error' => $e->getMessage()
    ]);
}
?> 