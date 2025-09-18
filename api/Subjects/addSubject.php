<?php
require '../dbconn.php';

$data = json_decode(file_get_contents("php://input"), true);

$subject_name = $data['subject_name'];
$sem_id = $data['sem_id'];

$sql = "INSERT INTO subject_tbl (subject_name, sem_id) VALUES (:subject_name, :sem_id)";
$stmt = $connection->prepare($sql);
$stmt->execute([
    ':subject_name' => $subject_name,
    ':sem_id' => $sem_id
]);

echo json_encode([
    "success" => true,
    "id" => $connection->lastInsertId()
]);
