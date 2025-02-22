<?php
require_once("../controller/patient_infoController.php");

if (!isset($_GET['id'])) {
    exit("No patient ID specified.");
}

$patientId = intval($_GET['id']);
$patientDetails = getPatientById($patientId); 

if (!$patientDetails) {
    exit("Patient not found.");
}
if (isset($_GET['logout'])) {
    session_unset(); // Remove all session variables
    session_destroy(); // Destroy the session
    header("Location: login.php"); // Redirect to the login page
    exit();
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Detail</title>
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .patient-detail {
            background-color: #ffe6f2;
            border-radius: 10px;
            padding: 20px;
            margin: 20px auto;
            max-width: 800px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="patient-detail">
        <h4 class="mb-4">Patient's Detail</h4>
        <p><strong>ID:</strong> <?= htmlspecialchars($patientDetails['id']) ?></p>
        <p><strong>Name:</strong> <?= htmlspecialchars($patientDetails['name']) ?></p>
        <p><strong>Gender:</strong> <?= htmlspecialchars($patientDetails['sex']) ?></p>
        <p><strong>Age:</strong> <?= htmlspecialchars($patientDetails['age']) ?></p>
        <p><strong>Duration:</strong> <?= htmlspecialchars($patientDetails['gap']) ?></p>
    
        <div id="chartContainer" style="height: 370px; width: 100%;"></div>
        <script>
            let dataPoints = [
                { label: "KOOS Pain", y: parseFloat(<?= json_encode($patientDetails['koos_pain']) ?>) },
                { label: "KOOS Function", y: parseFloat(<?= json_encode($patientDetails['koos_function']) ?>) },
                { label: "KOOS QOL", y: parseFloat(<?= json_encode($patientDetails['koos_qol']) ?>) },
                { label: "KOOS Total", y: parseFloat(<?= json_encode($patientDetails['koos_total']) ?>) }
            ];

            let chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                theme: "light2",
                title: {
                    text: "KOOS Scores for Patient ID: <?= json_encode($patientId) ?>"
                },
                axisY: {
                    title: "Score (0-100)",
                    maximum: 100,
                    minimum: 0
                },
                data: [{
                    type: "column", 
                    dataPoints: dataPoints
                }]
            });
            chart.render();
        </script>
        <br>
        <div>
        <a href="treatment_plan.php?patient_id=<?= htmlspecialchars($patientId) ?>" class="btn btn-primary">
        Make a treatment plan</a>
        <a href="?logout=true" class="btn btn-danger btn-sm">Logout</a>
        </div>
        <br>
        
</body>
</html>

