<?php
require_once '../../headers.php';
require_once '../../db.php';

// Read raw input
$data = json_decode(file_get_contents("php://input"), true);

// Check for ID
if (!isset($data['id'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Transaction ID is required']);
    exit;
}

try {
    $stmt = $pdo->prepare("DELETE FROM transactions WHERE id = :id");
    $stmt->execute([':id' => $data['id']]);

    echo json_encode(['success' => true, 'message' => 'Transaction deleted']);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Error deleting transaction',
        'error' => $e->getMessage()
    ]);
}
?>
