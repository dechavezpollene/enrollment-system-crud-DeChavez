<?php
header('Content-Type: application/json; charset=utf-8');
require_once "../dbconn.php";

$input = json_decode(file_get_contents('php://input'), true);
if (!isset($input['program_id'])) {
    echo json_encode(['success' => false, 'message' => 'program_id is required']);
    exit;
}

try {
    // Optional: ensure no students exist in program, or delete them/cascade
    $stmt = $connection->prepare("DELETE FROM program_tbl WHERE program_id = :program_id");
    $stmt->execute([':program_id' => $input['program_id']]);

    echo json_encode(['success' => true, 'message' => 'Program deleted']);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
