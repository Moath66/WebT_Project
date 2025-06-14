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
    
    $query = "INSERT INTO transactions (date, category, type, amount) VALUES (:date, :category, :type, :amount)";
    $stmt = $db->prepare($query);
    
    // Sanitize and bind data
    $stmt->bindParam(":date", $data->date);
    $stmt->bindParam(":category", $data->category);
    $stmt->bindParam(":type", $data->type);
    $stmt->bindParam(":amount", $data->amount);
    
    if($stmt->execute()) {
        http_response_code(201);
        echo json_encode([
            'message' => 'Transaction created successfully',
            'id' => $db->lastInsertId()
        ]);
    } else {
        throw new Exception('Unable to create transaction');
    }
} catch(Exception $e) {
    http_response_code(500);
    echo json_encode([
        'message' => 'Error creating transaction',
        'error' => $e->getMessage()
    ]);
}
?> 