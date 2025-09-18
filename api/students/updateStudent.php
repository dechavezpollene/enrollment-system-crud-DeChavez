<?php
header('Content-Type: application/json; charset=utf-8');
require_once "../dbconn.php";

$input = json_decode(file_get_contents('php://input'), true);
if (!isset($input['stud_id'])) {
    echo json_encode(['success' => false, 'message' => 'stud_id is required']);
    exit;
}

$fields = [];
$params = [':stud_id' => $input['stud_id']];

if (isset($input['Last_Name'])) { $fields[] = "Last_Name = :Last_Name"; $params[':Last_Name'] = $input['Last_Name']; }
if (isset($input['First_Name'])) { $fields[] = "First_Name = :First_Name"; $params[':First_Name'] = $input['First_Name']; }
if (isset($input['Middle_Name'])) { $fields[] = "Middle_Name = :Middle_Name"; $params[':Middle_Name'] = $input['Middle_Name']; }
if (isset($input['program_id'])) { $fields[] = "program_id = :program_id"; $params[':program_id'] = $input['program_id']; }
if (isset($input['Allowance'])) { $fields[] = "Allowance = :Allowance"; $params[':Allowance'] = $input['Allowance']; }

if (empty($fields)) {
    echo json_encode(['success' => false, 'message' => 'No fields to update']);
    exit;
}

try {
    $sql = "UPDATE student_tbl SET " . implode(', ', $fields) . " WHERE stud_id = :stud_id";
    $stmt = $connection->prepare($sql);
    $stmt->execute($params);

    echo json_encode(['success' => true, 'message' => 'Student updated']);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
