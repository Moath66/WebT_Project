<?php
require_once '../../headers.php';
require_once '../../db.php';

// Get raw input
$data = json_decode(file_get_contents("php://input"), true);

// Validate input
if (
    !isset($data['type']) || !isset($data['amount']) ||
    !isset($data['category']) || !isset($data['date'])
) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Missing required fields']);
    exit;
}

try {
    $stmt = $pdo->prepare("INSERT INTO transactions (type, amount, category, date, note)
                           VALUES (:type, :amount, :category, :date, :note)");

    $stmt->execute([
        ':type' => $data['type'],
        ':amount' => $data['amount'],
        ':category' => $data['category'],
        ':date' => $data['date'],
        ':note' => $data['note'] ?? null
    ]);

    echo json_encode(['success' => true, 'message' => 'Transaction added']);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Error adding transaction',
        'error' => $e->getMessage()
    ]);
}
?>
