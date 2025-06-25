<?php
require_once '../../headers.php';
require_once '../../db.php';

try {
    $stmt = $pdo->prepare("DELETE FROM transactions");
    $stmt->execute();

    echo json_encode(['success' => true, 'message' => 'All transactions deleted']);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Error clearing transactions',
        'error' => $e->getMessage()
    ]);
}
?>
