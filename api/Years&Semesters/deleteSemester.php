<?php
header('Content-Type: application/json; charset=utf-8');
require_once "../dbconn.php";
$input = json_decode(file_get_contents('php://input'), true);
if (!isset($input['sem_id'])) { echo json_encode(['success'=>false,'message'=>'sem_id required']); exit; }

try {
    $stmt = $connection->prepare("DELETE FROM semester_tbl WHERE sem_id = :sem_id");
    $stmt->execute([':sem_id' => $input['sem_id']]);
    echo json_encode(['success'=>true,'message'=>'Semester deleted']);
} catch (PDOException $e) {
    echo json_encode(['success'=>false,'message'=>$e->getMessage()]);
}
