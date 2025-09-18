<?php
header('Content-Type: application/json; charset=utf-8');
require_once "../dbconn.php";

$input = json_decode(file_get_contents('php://input'), true);
if (!isset($input['stud_id'])) {
    echo json_encode(['success' => false, 'message' => 'stud_id is required']);
    exit;
}

try {
    // optionally remove related student_load records first (if you want cascade)
    $delLoad = $connection->prepare("DELETE FROM student_load WHERE stud_id = :stud_id");
    $delLoad->execute([':stud_id' => $input['stud_id']]);

    $sql = "DELETE FROM student_tbl WHERE stud_id = :stud_id";
    $stmt = $connection->prepare($sql);
    $stmt->execute([':stud_id' => $input['stud_id']]);

    echo json_encode(['success' => true, 'message' => 'Student deleted']);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
