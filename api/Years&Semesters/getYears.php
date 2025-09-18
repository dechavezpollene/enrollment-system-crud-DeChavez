<?php
header('Content-Type: application/json; charset=utf-8');
require_once "../dbconn.php";
try {
    $stmt = $connection->prepare("SELECT * FROM year_tbl ORDER BY year_id ASC");
    $stmt->execute();
    echo json_encode(['success' => true, 'data' => $stmt->fetchAll(PDO::FETCH_ASSOC)]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
