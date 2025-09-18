<?php
header('Content-Type: application/json; charset=utf-8');
require_once "../dbconn.php";

try {
    $sql = "SELECT s.stud_id, s.Last_Name, s.First_Name, s.Middle_Name,
                   s.program_id, s.Allowance, p.program_name
            FROM student_tbl s
            LEFT JOIN program_tbl p ON s.program_id = p.program_id";
    $stmt = $connection->prepare($sql);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(["success" => true, "data" => $rows]);
} catch (Exception $e) {
    echo json_encode(["success" => false, "message" => $e->getMessage()]);
}
