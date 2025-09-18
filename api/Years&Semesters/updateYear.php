<?php
header('Content-Type: application/json; charset=utf-8');
require_once "../dbconn.php";

$input = json_decode(file_get_contents('php://input'), true);
if (!isset($input['year_id'])) { echo json_encode(['success'=>false,'message'=>'year_id required']); exit; }

$fields = [];
$params = [':year_id' => $input['year_id']];
if (isset($input['year_from'])) { $fields[] = "year_from = :year_from"; $params[':year_from'] = $input['year_from']; }
if (isset($input['year_to'])) { $fields[] = "year_to = :year_to"; $params[':year_to'] = $input['year_to']; }

if (empty($fields)) { echo json_encode(['success'=>false,'message'=>'No fields to update']); exit; }

try {
    $sql = "UPDATE year_tbl SET " . implode(', ', $fields) . " WHERE year_id = :year_id";
    $stmt = $connection->prepare($sql);
    $stmt->execute($params);
    echo json_encode(['success'=>true,'message'=>'Year updated']);
} catch (PDOException $e) {
    echo json_encode(['success'=>false,'message'=>$e->getMessage()]);
}
