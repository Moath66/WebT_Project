<?php
require_once '../../headers.php';
require_once '../../db.php';

try {
    $stmt = $pdo->query("SELECT * FROM transactions ORDER BY date DESC");
    $transactions = $stmt->fetchAll();

    echo json_encode([
        'success' => true,
        'data' => $transactions
    ]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Error fetching transactions', 'error' => $e->getMessage()]);
}
?>
