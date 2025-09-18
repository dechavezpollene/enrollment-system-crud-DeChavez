<?php
require '../dbconn.php';

$data = json_decode(file_get_contents("php://input"), true);

$year_from = $data['year_from'];
$year_to = $data['year_to'];

$sql = "INSERT INTO year_tbl (year_from, year_to) VALUES (:year_from, :year_to)";
$stmt = $connection->prepare($sql);
$stmt->execute([
    ':year_from' => $year_from,
    ':year_to' => $year_to
]);

echo json_encode([
    "success" => true,
    "id" => $connection->lastInsertId()
]);
