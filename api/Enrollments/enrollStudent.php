<?php
require '../dbconn.php';

$data = json_decode(file_get_contents("php://input"), true);

$stud_id = $data['stud_id'];
$subject_id = $data['subject_id'];

$sql = "INSERT INTO student_load (stud_id, subject_id) VALUES (:stud_id, :subject_id)";
$stmt = $connection->prepare($sql);
$stmt->execute([
    ':stud_id' => $stud_id,
    ':subject_id' => $subject_id
]);

echo json_encode([
    "success" => true,
    "id" => $connection->lastInsertId()
]);
