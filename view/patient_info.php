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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Detail</title>
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
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
        <p><strong>ID:</strong> <?= htmlspecialchars($patientDetails->id) ?></p>
        <p><strong>Name:</strong> <?= htmlspecialchars($patientDetails->name) ?></p>
        <p><strong>Gender:</strong> <?= htmlspecialchars($patientDetails->sex) ?></p>
        <p><strong>Age:</strong> <?= htmlspecialchars($patientDetails->age) ?></p>
        <p><strong>Duration:</strong> <?= htmlspecialchars($patientDetails->gap) ?></p>
        <p><strong>KOOS Score:</strong> <?= htmlspecialchars($patientDetails->koos) ?></p>
    <!--Add future KOOS score and comment later-->
        <textarea class="form-control" rows="3" placeholder="Add your comment here..."></textarea>
        <br>
        <button class="btn btn-primary">Submit</button>
    </div>
</body>
</html>
