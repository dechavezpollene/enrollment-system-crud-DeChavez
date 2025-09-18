<?php
header('Content-Type: application/json; charset=utf-8');
require_once "../dbconn.php";

$input = json_decode(file_get_contents('php://input'), true);
if (!isset($input['program_id'])) {
    echo json_encode(['success' => false, 'message' => 'program_id is required']);
    exit;
}

$fields = [];
$params = [':program_id' => $input['program_id']];
if (isset($input['program_name'])) { $fields[] = "program_name = :program_name"; $params[':program_name'] = $input['program_name']; }
if (array_key_exists('ins_id', $input)) { $fields[] = "ins_id = :ins_id"; $params[':ins_id'] = $input['ins_id']; }

if (empty($fields)) { echo json_encode(['success'=>false,'message'=>'No fields to update']); exit; }

try {
    $sql = "UPDATE program_tbl SET " . implode(', ', $fields) . " WHERE program_id = :program_id";
    $stmt = $connection->prepare($sql);
    $stmt->execute($params);
    echo json_encode(['success' => true, 'message' => 'Program updated']);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
