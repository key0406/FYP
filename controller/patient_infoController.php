<?php
require_once("../model/patient.php");
require_once("sql.php");

function getPatientById($id) {
    $sql = connectdb();
    if (!$sql) {
        exit("Database connection failed");
    }

    try {
        $query = "SELECT 
                    id, 
                    name, 
                    sex, 
                    age, 
                    gap, 
                    (100 - (p1 + p2 + p3 + p4) / (4 * 4) * 100) AS koos_pain, 
                    (100 - (f1 + f2 + f3 + f4) / (4 * 4) * 100) AS koos_function, 
                    (100 - (q1 + q2 + q3 + q4) / (4 * 4) * 100) AS koos_qol,
                    ((100 - (p1 + p2 + p3 + p4) / (4 * 4) * 100) +
                    (100 - (f1 + f2 + f3 + f4) / (4 * 4) * 100) +
                    (100 - (q1 + q2 + q3 + q4) / (4 * 4) * 100)) / 3 AS koos_total
                  FROM survey WHERE id = :id LIMIT 1";
        $stmt = $sql->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    } catch (Exception $e) {
        exit("Database error: " . $e->getMessage());
    }
}

if (!isset($_GET['id'])) {
    exit("No patient ID specified.");
}

$patientId = intval($_GET['id']);
$patientDetails = getPatientById($patientId);

if (!$patientDetails) {
    exit("Patient not found.");
}
?>