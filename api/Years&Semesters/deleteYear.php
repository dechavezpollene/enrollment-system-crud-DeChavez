<?php
header('Content-Type: application/json; charset=utf-8');
require_once "../dbconn.php";
$input = json_decode(file_get_contents('php://input'), true);
if (!isset($input['year_id'])) { echo json_encode(['success'=>false,'message'=>'year_id required']); exit; }

try {
    $stmt = $connection->prepare("DELETE FROM year_tbl WHERE year_id = :year_id");
    $stmt->execute([':year_id' => $input['year_id']]);
    echo json_encode(['success'=>true,'message'=>'Year deleted']);
} catch (PDOException $e) {
    echo json_encode(['success'=>false,'message'=>$e->getMessage()]);
}
