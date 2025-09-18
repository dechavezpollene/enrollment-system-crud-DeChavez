<?php
require '../dbconn.php';

$data = json_decode(file_get_contents("php://input"), true);

$firstName = $data['First_Name'];
$middleName = $data['Middle_Name'];
$lastName = $data['Last_Name'];
$program_id = $data['program_id'];
$allowance = $data['Allowance'];

$sql = "INSERT INTO student_tbl (First_Name, Middle_Name, Last_Name, program_id, Allowance) 
        VALUES (:First_Name, :Middle_Name, :Last_Name, :program_id, :Allowance)";
$stmt = $connection->prepare($sql);
$stmt->execute([
    ':First_Name' => $firstName,
    ':Middle_Name' => $middleName,
    ':Last_Name' => $lastName,
    ':program_id' => $program_id,
    ':Allowance' => $allowance
]);

echo json_encode([
    "success" => true,
    "id" => $connection->lastInsertId()
]);
