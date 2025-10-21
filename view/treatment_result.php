<?php
require_once("../controller/TreatmentResultsController.php"); 
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
    <title>Treatment Results</title>
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <!--jsPDF-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
</head>
<style>
    html, body {
      height: 100%;
      margin: 0%;
      padding: 0;
    }
    body {
      background-color: #F8E4F3;
    }
    p.confidential{
        font-family: "Times New Roman", Times, serif;
        text-align: center;
    }
    div.container{
      background-color: #F8E4F3;
    }
    .container {
      min-height: 100vh;
      background-color: #F8E4F3;
    }
    .recommendation {
      background-color: white;
      border: 1px solid #ddd;
      border-radius: 8px;
      padding: 15px;
      font-size: 0.9rem;
    }
  </style>
<body>
<div class="container">
    <h1 class="mb-4">Treatment Results</h1>
    <div class="row">
        <?php if (!empty($treatmentObjects)): ?>
            <?php foreach ($treatmentObjects as $treatment): ?>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Patient ID: <?= htmlspecialchars($treatment->p_id) ?></h5>
                            <p class="card-text"><strong>Patient Name:</strong> <?= htmlspecialchars($treatment->p_name) ?></p>
                            <p class="card-text"><strong>Sex:</strong> <?= htmlspecialchars($treatment->sex) ?></p>
                            <p class="card-text"><strong>KOOS Score:</strong> <?= htmlspecialchars($treatment->p_koos) ?></p>
                            <p class="card-text"><strong>Diagnosis:</strong> <?= htmlspecialchars($treatment->p_diagnosis) ?></p>
                            <p class="card-text"><strong>Treatment Plan 1:</strong><?= htmlspecialchars($treatment->treatment_1) ?>
                            <p class="card-text"><strong>Goal:</strong><?= htmlspecialchars($treatment->p_goal_1) ?></p>
                            <p class="card-text"><strong>Timeline:</strong><?= htmlspecialchars($treatment->p_time_1) ?></p>
                            <p class="card-text"><strong>Treatment Plan 2:</strong><?= htmlspecialchars($treatment->treatment_2) ?>
                            <p class="card-text"><strong>Goal:</strong><?= htmlspecialchars($treatment->p_goal_2) ?></p>
                            <p class="card-text"><strong>Timeline:</strong><?= htmlspecialchars($treatment->p_time_2) ?></p>
                            <p class="card-text"><strong>Treatment Plan 3:</strong><?= htmlspecialchars($treatment->treatment_3) ?>
                            <p class="card-text"><strong>Goal:</strong><?= htmlspecialchars($treatment->p_goal_3) ?></p>
                            <p class="card-text"><strong>Timeline:</strong><?= htmlspecialchars($treatment->p_time_3) ?></p>
                            <p class="card-text"><strong>Patient Responsibilities:</strong></p>
                            <p class="card-text"><strong>1.:</strong><?= htmlspecialchars($treatment->r_1) ?></p>
                            <p class="card-text"><strong>Goal:</strong><?= htmlspecialchars($treatment->r_goal) ?></p>
                            <p class="card-text"><strong>2.:</strong><?= htmlspecialchars($treatment->r_2) ?></p>
                            <p class="card-text"><strong>Goal.:</strong><?= htmlspecialchars($treatment->r_goal_2) ?></p>
                            <p class="card-text"><strong>Doctor's Commitment We will:</strong></p>
                            <p class="card-text"><strong>1.:</strong><?= htmlspecialchars($treatment->c_1) ?></p>
                            <p class="card-text"><strong>2.:</strong><?= htmlspecialchars($treatment->c_2) ?></p>
                            <p class="card-text"><strong>3.:</strong><?= htmlspecialchars($treatment->c_3) ?></p>
                            <p class="card-text"><strong>Potiental Risks and Benefits:</strong></p>
                            <p class="card-text"><strong>1.:</strong><?= htmlspecialchars($treatment->rb_1) ?></p>
                            <p class="card-text"><strong>2.:</strong><?= htmlspecialchars($treatment->rb_2) ?></p>
                            <p class="card-text"><strong>Agreement and Consent:</strong></p>
                            <p class="card-text"><strong>1.I understand the proposed treatment plan, including its goals, steps, and potential risks</strong></p>
                            <p class="card-text"><strong>2.I agree to actively participate in my treatment and follow the recommended steps.</strong></p>
                            <p class="card-text"><strong>Patient Signature:</strong></p>
                            <p class="card-text"><img src="../patient_signature/<?= htmlspecialchars($treatment->signature_patient) ?>" alt="Patient Signature" style="width: 200px; height: auto; border: 1px solid #000;"></p>
                            <p class="card-text"><strong>Date: </strong><?= htmlspecialchars($treatment->p_date) ?></p>
                            <p class="card-text"><strong>Doctor's Signature:</strong></p>
                            <p class="card-text"><img src="../doctor_signature/<?= htmlspecialchars($treatment->signature_doctor) ?>" alt="Doctor Signature" style="width: 200px; height: auto; border: 1px solid #000;" /></p>
                            <p class="card-text"><strong>Date: </strong><?= htmlspecialchars($treatment->d_date) ?></p>
                            <button type="button" onclick="downloadPageAsPDF()">Download as PDF</button> 
                            <a href="?logout=true" class="btn btn-danger btn-sm">Logout</a>
                            </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No treatments found.</p>
        <?php endif; ?>
    </div>
</div>
<script>
  //This function allow user to download the page in PDF format
  async function downloadPageAsPDF() {
    const { jsPDF } = window.jspdf;
    // Select the container you want to convert to a PDF
    const container = document.querySelector('.container');
    const canvas = await html2canvas(container);
    const imgData = canvas.toDataURL('image/png');
    // Create a jsPDF instance
    const pdf = new jsPDF('p', 'mm', 'a4'); // Portrait, millimeters, A4 size
    const pdfWidth = 210;
    const pdfHeight = (canvas.height * pdfWidth) / canvas.width;
    pdf.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight);
    pdf.save('treatmentplan.pdf');
  }
</script>
</body>
</html>
