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
handleDeleteRequest();

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
        <a href="?logout=true" class="btn btn-danger btn-sm">Logout</a>
        <div class="row">
            <?php if (!empty($patientObjects)): ?>
                <?php foreach ($patientObjects as $patient): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">
                                <?= alertSeverePatient($patient->koos) ?>
                                    Patient ID: <?= htmlspecialchars($patient->id) ?>
                                </h5>
                                <p class="card-text"><strong>Name:</strong> <?= htmlspecialchars($patient->name) ?></p>
                                <p class="card-text"><strong>Gender:</strong> <?= htmlspecialchars($patient->sex) ?></p>
                                <p class="card-text"><strong>Age:</strong> <?= htmlspecialchars($patient->age) ?></p>
                                <p class="card-text"><strong>Treatment Gap:</strong> <?= htmlspecialchars($patient->gap) ?></p>
                                <?=alertSeverePatient($patient->koos)?><strong>KOOS Score:</strong> <?= htmlspecialchars($patient->koos) ?></p>
                                <p><a href="patient_info.php?id=<?= htmlspecialchars($patient->id) ?>" class="btn btn-primary">View Details</a></p>
                                <form method="POST" onsubmit="return confirm('Are you sure you want to delete this patient?');">
                                    <input type="hidden" name="delete_id" value="<?= htmlspecialchars($patient->id) ?>">
                                <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
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

<?php
function alertSeverePatient($koos) {
    $state = false;
    $output = '';
    if ($koos < 40) { 
        $state = true;
        
    }
    if($state){
        $output .= '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="red" class="ms-2" viewBox="0 0 16 16">
            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
        </svg>';
        $output.='<span class="text-danger">';
        return $output;
    }else{
        return '<p class="card-text">';
    }
}
?>
