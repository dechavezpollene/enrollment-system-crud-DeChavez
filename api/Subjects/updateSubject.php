<?php
header('Content-Type: application/json; charset=utf-8');
require_once "../dbconn.php";
$input = json_decode(file_get_contents('php://input'), true);
if (!isset($input['subject_id'])) { echo json_encode(['success'=>false,'message'=>'subject_id required']); exit; }

$fields=[]; $params=[':subject_id'=>$input['subject_id']];
if (isset($input['subject_name'])) { $fields[]="subject_name = :subject_name"; $params[':subject_name']=$input['subject_name']; }
if (isset($input['sem_id'])) { $fields[]="sem_id = :sem_id"; $params[':sem_id']=$input['sem_id']; }
if (empty($fields)) { echo json_encode(['success'=>false,'message'=>'No fields to update']); exit; }

try {
    $sql = "UPDATE subject_tbl SET " . implode(', ', $fields) . " WHERE subject_id = :subject_id";
    $stmt = $connection->prepare($sql);
    $stmt->execute($params);
    echo json_encode(['success'=>true,'message'=>'Subject updated']);
} catch (PDOException $e) {
    echo json_encode(['success'=>false,'message'=>$e->getMessage()]);
}
