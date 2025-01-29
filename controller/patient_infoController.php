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
                    (100 - (p1 + p2 + p3 + p4) / (4 * 4) * 100) AS pain_score, 
                    (100 - (f1 + f2 + f3 + f4) / (4 * 4) * 100) AS func_score, 
                    (100 - (q1 + q2 + q3 + q4) / (4 * 4) * 100) AS qol_score,
                    ((100 - (p1 + p2 + p3 + p4) / (4 * 4) * 100) +
                    (100 - (f1 + f2 + f3 + f4) / (4 * 4) * 100) +
                    (100 - (q1 + q2 + q3 + q4) / (4 * 4) * 100)) / 3 AS koos_score
                  FROM survey WHERE id = :id LIMIT 1";
        $stmt = $sql->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $patient = new Patient();
            $patient->id = $result['id'];
            $patient->name = $result['name'];
            $patient->sex = $result['sex'];
            $patient->age = $result['age'];
            $patient->gap = $result['gap'];
            $patient->koos = number_format($result['koos_score'], 2);

            return $patient;
        } else {
            return null;
        }
    } catch (Exception $e) {
        exit("Database error: " . $e->getMessage());
    }
}

?>