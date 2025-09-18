<?php
header('Content-Type: application/json; charset=utf-8');
require_once "../dbconn.php";

try {
    $sql = "SELECT l.load_id, l.stud_id, s.Last_Name, s.First_Name, s.Middle_Name,
                   l.subject_id, sub.subject_name, sub.sem_id
            FROM student_load l
            LEFT JOIN student_tbl s ON l.stud_id = s.stud_id
            LEFT JOIN subject_tbl sub ON l.subject_id = sub.subject_id
            ORDER BY l.load_id ASC";
    $stmt = $connection->prepare($sql);
    $stmt->execute();
    $enrollments = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(['success' => true, 'data' => $enrollments]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
