<?php
header('Content-Type: application/json; charset=utf-8');
require_once "../dbconn.php";
$input = json_decode(file_get_contents('php://input'), true);

if (!isset($input['load_id'])) { echo json_encode(['success'=>false,'message'=>'load_id is required']); exit; }

$fields = []; $params = [':load_id'=>$input['load_id']];
if (isset($input['stud_id'])) { $fields[] = "stud_id = :stud_id"; $params[':stud_id'] = $input['stud_id']; }
if (isset($input['subject_id'])) { $fields[] = "subject_id = :subject_id"; $params[':subject_id'] = $input['subject_id']; }
if (empty($fields)) { echo json_encode(['success'=>false,'message'=>'No fields to update']); exit; }

try {
    $sql = "UPDATE student_load SET " . implode(', ', $fields) . " WHERE load_id = :load_id";
    $stmt = $connection->prepare($sql);
    $stmt->execute($params);
    echo json_encode(['success' => true, 'message' => 'Enrollment updated']);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
