<?php
require_once("../model/patient.php");
require_once("sql.php");

function getPatientDetails() {
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
                  FROM survey ORDER BY id DESC";

        $stmt = $sql->query($query);
        $patients = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        exit("Database error: " . $e->getMessage());
    }

    // Map the results to Patient objects
    $patientObjects = [];
    foreach ($patients as $data) {
        $patient = new Patient();
        $patient->id = $data['id'];
        $patient->name = $data['name'] ?? 'N/A';
        $patient->sex = $data['sex'];
        $patient->age = $data['age'] ?? '-';
        $patient->gap = $data['gap'] ?? '-';
        $patient->koos = number_format($data['koos_score'], 2); // Format KOOS score to 2 decimal places
        $patientObjects[] = $patient;
    }

    return $patientObjects;
}

// Function to search patients by name
function getPatientByName($name) {
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
                  FROM survey
                  WHERE name LIKE :name
                  ORDER BY id DESC";
        
        $stmt = $sql->prepare($query);
        $searchTerm = '%' . $name . '%';
        $stmt->bindParam(':name', $searchTerm, PDO::PARAM_STR);
        $stmt->execute();
        $patients = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        exit("Database error: " . $e->getMessage());
    }

    // Map the results to Patient objects
    $patientObjects = [];
    foreach ($patients as $data) {
        $patient = new Patient();
        $patient->id = $data['id'];
        $patient->name = $data['name'] ?? 'N/A';
        $patient->sex = $data['sex'];
        $patient->age = $data['age'] ?? '-';
        $patient->gap = $data['gap'] ?? '-';
        $patient->koos = number_format($data['koos_score'], 2); // Format KOOS score to 2 decimal places
        $patientObjects[] = $patient;
    }

    return $patientObjects;
}

// Decide which function to use based on the search input
function handlePatientSearch() {
    if (isset($_REQUEST["searchName"]) && !empty($_REQUEST["searchName"])) {
        return getPatientByName($_REQUEST["searchName"]); // Search by name
    }
    return getPatientDetails(); // Fetch all patients if no search term
}
?>
