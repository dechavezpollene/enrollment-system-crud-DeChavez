<?php
header('Content-Type: application/json; charset=utf-8');
require_once "../dbconn.php";
$input = json_decode(file_get_contents('php://input'), true);
if (!isset($input['subject_id'])) { echo json_encode(['success'=>false,'message'=>'subject_id required']); exit; }

try {
    // optionally remove student_load entries for this subject
    $delLoad = $connection->prepare("DELETE FROM student_load WHERE subject_id = :subject_id");
    $delLoad->execute([':subject_id' => $input['subject_id']]);

    $stmt = $connection->prepare("DELETE FROM subject_tbl WHERE subject_id = :subject_id");
    $stmt->execute([':subject_id' => $input['subject_id']]);
    echo json_encode(['success'=>true,'message'=>'Subject deleted']);
} catch (PDOException $e) {
    echo json_encode(['success'=>false,'message'=>$e->getMessage()]);
}
