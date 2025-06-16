<?php
require_once '../../headers.php';
require_once '../../db.php';

// Get JSON body
$data = json_decode(file_get_contents("php://input"), true);

// Check required fields
if (
    !isset($data['id']) || !isset($data['type']) || !isset($data['amount']) ||
    !isset($data['category']) || !isset($data['date'])
) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Missing required fields']);
    exit;
}

try {
    $stmt = $pdo->prepare("UPDATE transactions SET 
                            type = :type, 
                            amount = :amount, 
                            category = :category, 
                            date = :date,
                            note = :note 
                          WHERE id = :id");

    $stmt->execute([
        ':id' => $data['id'],
        ':type' => $data['type'],
        ':amount' => $data['amount'],
        ':category' => $data['category'],
        ':date' => $data['date'],
        ':note' => $data['note'] ?? null
    ]);

    echo json_encode(['success' => true, 'message' => 'Transaction updated']);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Error updating transaction', 'error' => $e->getMessage()]);
}
?>
