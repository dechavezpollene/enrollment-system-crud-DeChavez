<?php
header('Content-Type: application/json; charset=utf-8');
require_once "../dbconn.php";
try {
    $sql = "SELECT sem.sem_id, sem.sem_name, sem.year_id, y.year_from, y.year_to
            FROM semester_tbl sem
            LEFT JOIN year_tbl y ON sem.year_id = y.year_id
            ORDER BY sem.sem_id ASC";
    $stmt = $connection->prepare($sql);
    $stmt->execute();
    echo json_encode(['success' => true, 'data' => $stmt->fetchAll(PDO::FETCH_ASSOC)]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
