<?php
header('Content-Type: application/json; charset=utf-8');
require_once "../dbconn.php";
try {
    $sql = "SELECT s.subject_id, s.subject_name, s.sem_id, sem.sem_name, sem.year_id
            FROM subject_tbl s
            LEFT JOIN semester_tbl sem ON s.sem_id = sem.sem_id
            ORDER BY s.subject_id ASC";
    $stmt = $connection->prepare($sql);
    $stmt->execute();
    echo json_encode(['success' => true, 'data' => $stmt->fetchAll(PDO::FETCH_ASSOC)]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
