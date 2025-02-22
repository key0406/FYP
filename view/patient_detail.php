<?php
session_start();
if (empty($_SESSION['auth_doctor']) ) {
  echo '<h1 class="text-custom">Please login to the login page</h1><br>';
  echo '<h1 class="text-custom"><a href="login.php">Login</a></h1>';
  exit();
}

require_once("../controller/patient_detailController.php");

// Fetch either all patients or search results
$patientObjects = handlePatientSearch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Details</title>
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h4 class="mb-4">Patient's Details</h4>
        <div class="mb-3" id="searchName">
            <form method="GET" action="patient_detail.php">
                <input type="text" placeholder="Search patient name" name="searchName" value="<?= htmlspecialchars($_GET['searchName'] ?? '') ?>" class="form-control mb-2" />
                <input type="submit" value="Search" class="btn btn-primary" />
            </form>
        </div>
        <div class="row">
            <?php if (!empty($patientObjects)): ?>
                <?php foreach ($patientObjects as $patient): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Patient ID: <?= htmlspecialchars($patient->id) ?></h5>
                                <p class="card-text"><strong>Name:</strong> <?= htmlspecialchars($patient->name) ?></p>
                                <p class="card-text"><strong>Gender:</strong> <?= htmlspecialchars($patient->sex) ?></p>
                                <p class="card-text"><strong>Age:</strong> <?= htmlspecialchars($patient->age) ?></p>
                                <p class="card-text"><strong>Treatment Gap:</strong> <?= htmlspecialchars($patient->gap) ?></p>
                                <p class="card-text"><strong>KOOS Score:</strong> <?= htmlspecialchars($patient->koos) ?></p>
                                <p><a href="patient_info.php?id=<?= htmlspecialchars($patient->id) ?>" class="btn btn-primary">View Details</a></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No patients found.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
