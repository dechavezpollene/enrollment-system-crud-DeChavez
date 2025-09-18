<?php
header('Content-Type: application/json; charset=utf-8');
require_once "../dbconn.php";
$input = json_decode(file_get_contents('php://input'), true);
if (!isset($input['sem_id'])) { echo json_encode(['success'=>false,'message'=>'sem_id required']); exit; }

$fields = []; $params = [':sem_id'=>$input['sem_id']];
if (isset($input['sem_name'])) { $fields[] = "sem_name = :sem_name"; $params[':sem_name'] = $input['sem_name']; }
if (isset($input['year_id'])) { $fields[] = "year_id = :year_id"; $params[':year_id'] = $input['year_id']; }
if (empty($fields)) { echo json_encode(['success'=>false,'message'=>'No fields to update']); exit; }

try {
    $sql = "UPDATE semester_tbl SET " . implode(', ', $fields) . " WHERE sem_id = :sem_id";
    $stmt = $connection->prepare($sql);
    $stmt->execute($params);
    echo json_encode(['success'=>true,'message'=>'Semester updated']);
} catch (PDOException $e) {
    echo json_encode(['success'=>false,'message'=>$e->getMessage()]);
}
