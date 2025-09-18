<?php
require '../dbconn.php';

$data = json_decode(file_get_contents("php://input"), true);

$program_name = $data['program_name'];
$ins_id = $data['ins_id'];

$sql = "INSERT INTO program_tbl (program_name, ins_id) VALUES (:program_name, :ins_id)";
$stmt = $connection->prepare($sql);
$stmt->execute([
    ':program_name' => $program_name,
    ':ins_id' => $ins_id
]);

echo json_encode([
    "success" => true,
    "id" => $connection->lastInsertId()
]);
