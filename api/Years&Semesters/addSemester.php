<?php
require '../dbconn.php';

$data = json_decode(file_get_contents("php://input"), true);

$sem_name = $data['sem_name'];
$year_id = $data['year_id'];

$sql = "INSERT INTO semester_tbl (sem_name, year_id) VALUES (:sem_name, :year_id)";
$stmt = $connection->prepare($sql);
$stmt->execute([
    ':sem_name' => $sem_name,
    ':year_id' => $year_id
]);

echo json_encode([
    "success" => true,
    "id" => $connection->lastInsertId()
]);
