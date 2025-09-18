<?php
header('Content-Type: application/json; charset=utf-8');
require_once "../dbconn.php";
$input = json_decode(file_get_contents('php://input'), true);

if (!isset($input['load_id'])) { echo json_encode(['success'=>false,'message'=>'load_id is required']); exit; }

try {
    $stmt = $connection->prepare("DELETE FROM student_load WHERE load_id = :load_id");
    $stmt->execute([':load_id' => $input['load_id']]);
    echo json_encode(['success' => true, 'message' => 'Enrollment removed']);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
