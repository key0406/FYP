<?php
require_once("../controller/sql.php"); // Ensure database connection

$sql = connectdb();
if (!$sql) {
    exit(json_encode(["error" => "Database connection failed"]));
}

// Fetch KOOS scores for Koki Ohira
$query = "SELECT name, 
                 (100 - ((p1 + p2 + p3 + p4) / (4 * 4)) * 100) AS koos_pain, 
                 (100 - ((f1 + f2 + f3 + f4) / (4 * 4)) * 100) AS koos_function, 
                 (100 - ((q1 + q2 + q3 + q4) / (4 * 4)) * 100) AS koos_qol
          FROM survey
          WHERE name = 'Koki Ohira'"; // Ensure only Koki Ohira is retrieved

$stmt = $sql->query($query);
$results = [];

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $total_score = ($row['koos_pain'] + $row['koos_function'] + $row['koos_qol']) / 3; // Calculate total KOOS score
    $results[] = [
        "name" => "Koki Ohira", 
        "koos_pain" => round($row['koos_pain'], 2),
        "koos_function" => round($row['koos_function'], 2),
        "koos_qol" => round($row['koos_qol'], 2),
        "koos_total" => round($total_score, 2)
    ];
}

echo json_encode($results);
?>
