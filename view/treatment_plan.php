<?php
 session_start();
 if (empty($_SESSION['auth_doctor']) ) {
   echo '<h1 class="text-custom">Please login to the login page</h1><br>';
   echo '<h1 class="text-custom"><a href="login.php">Login</a></h1>';
   exit();
 }
 require_once('../controller/sql.php');

 $patient = null;
if (isset($_GET['patient_id'])) {
    $patient_id = intval($_GET['patient_id']);
    $patient = getPatientForTreatmentPlan($patient_id);
}

?>

 <!DOCTYPE html>
<html lang="<?php echo $lang?>">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="robots" content="noindex">
  <title>Treatment plan creator</title>
  <link href="../../css/bootstrap.min.css" rel="stylesheet">
  
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
</head>
<body>
  <div class="container">
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
      <span class="fs-4">Treatment plan creator</span>
    </header>
  <div>
<form class="h-adr" method="post" action="../controller/TreatmentController.php">
    <p class="mb-1">Patient ID</p>
        <div class="mb-3">
        <div class="form-check form-check-inline">
          <input class="form-control" type="text" name="p_id" id="p_id" placeholder="Enter patientID" 
          value="<?= htmlspecialchars($patient['id'] ?? '') ?>" required>        </div> 
      </div>
    <p class="mb-1">Patient Name</p>
    <div class="mb-3">
    <div class="form-check form-check-inline">
      <input class="form-control" type="text" name="p_name" id="p_name" placeholder="Enter patient name" 
      value="<?= htmlspecialchars($patient['name'] ?? '') ?>" required>     </div> 
    </div>
    <p class="mb-1">Sex</p>
    <div class="mb-3">
    <div class="form-check form-check-inline">
    <input 
            class="form-check-input" 
            type="radio" 
            name="sex" 
            id="male" 
            value="Male" 
            required 
            <?= (isset($patient['sex']) && $patient['sex'] === 'Male') ? 'checked' : '' ?>
        ><label class="form-check-label" for="male"  required> Male</label>
    </div>
    <div class="form-check form-check-inline">
    <input 
            class="form-check-input" 
            type="radio" 
            name="sex" 
            id="female" 
            value="Female" 
            required 
            <?= (isset($patient['sex']) && $patient['sex'] === 'Female') ? 'checked' : '' ?>
        ><label class="form-check-label" for="female" required> Female</label>
    </div>
    <p class="mb-1">KOOS score</p>
    <div class="mb-3">
    <div class="form-check form-check-inline">
      <input class="form-control" type="text" name="p_koos" id="p_koos" placeholder="Enter KOOS score of the patient" 
      value="<?= number_format(htmlspecialchars($patient['koos_score'] ?? ''),2) ?>" required>     </div> 
    </div>
    <p class="mb-1">Diagnosis</p>
    <div class="mb-3">
    <div class="form-check form-check-inline">
        <input class="form-control" type="text" name="p_diagnosis" id="p_diagnosis" placeholder="Moderate" required>
     </div> 
    </div>
    <div class="survey">
        <h2>Treatment plan</h2>
        <div id="treatment_plan">
          
        </div>
        
        <input type="button" value="+" onClick="addTreatment();">
        <div>
            <h3>Patient Responsibilities</h3>
            <p>1. <input class="form-control" type="text" name="r_1" id="r_1" placeholder="Exercise Therapy" required></p>
            <h5>Goal</h5>
            <p>
              <textarea class="form-control" rows="3"  name="r_goal" id="r_goal" placeholder="Enter your goal" required></textarea>
            </p>
        </div>
            <p>2. <input class="form-control" type="text" name="r_2" id="r_2" placeholder="Regular follow up" required></p>
                <h5>Goal</h5>
                <p>
                <textarea class="form-control" rows="3"  name="r_goal_2" id="r_goal_2" placeholder="Enter your goal" required></textarea>
                </p>
            </div>
    </div>
    <div>
        <p>Doctor's Commitment We will</p>
        <p>1. <input class="form-control" type="text" name="c_1" id="c_1" placeholder="Commitment1" required></p>
        <p>2. <input class="form-control" type="text" name="c_2" id="c_2" placeholder="Commitment2" required></p>
        <p>3. <input class="form-control" type="text" name="c_3" id="c_3" placeholder="Commitment3" required></p>
    </div>
    <div>
        <p>Potiental Risks and Benefits</p>
        <p>1. <input class="form-control" type="text" name="rb_1" id="rb_1" placeholder="Risk and Benefit 1" required></p>
        <p>2. <input class="form-control" type="text" name="rb_2" id="rb_2" placeholder="Risk and Benefit 2" required></p>
    </div>
    <div>
        <h3>Agreement and Consent</h3>
        <p>1.I understand the proposed treatment plan, including its goals, steps, and potential risks.<br>
        2.I agree to actively participate in my treatment and follow the recommended steps.</p>
        <canvas id="patient-signature-pad" width="400" height="150" style="border: 1px solid black; background-color: white;"></canvas>
        <button type="button" onclick="clearSignature('patient')">Clear</button>
        <input type="hidden" name="signature_patient" id="signature_patient" required />
        <p>Date: <input class="form-control" type="text" name="p_date" id="p_date" required></p>
        <p>Doctor Signature:</p>
        <canvas id="doctor-signature-pad" width="400" height="150" style="border: 1px solid black; background-color: white;"></canvas>
        <button type="button" onclick="clearSignature('doctor')">Clear</button>
        <input type="hidden" name="signature_doctor" id="signature_doctor" required />
        <p>Date: <input class="form-control" type="text" name="d_date" id="d_date" required></p>

    </div>
    <p class="text-center"><button class="btn btn-primary btn-lg w-25 rounded-pill">Submit</button></p> 
    

    
</form>
<script type="text/javascript">
  let treatmentCount = 0;
const maxSteps = 2;

function addTreatment() {
  if (treatmentCount > maxSteps) {
    alert("You can only add up to 3 treatment steps.");
    return;
  }
  const treatmentsData = getCurrentTreatments();
  treatmentCount++;

  const div = document.getElementById('treatment_plan');
  div.innerHTML = '';

  treatmentsData.forEach((data, index) => {
    renderTreatmentStep(index + 1, data.treatment, data.goal, data.timeline);
  });

  renderTreatmentStep(treatmentCount, '', '', '');
}

function deleteTreatment(id) {
  const treatmentsData = getCurrentTreatments().filter((_, index) => `treatment_${index + 1}` !== id);
  treatmentCount--;

  const div = document.getElementById('treatment_plan');
  div.innerHTML = '';

  treatmentsData.forEach((data, index) => {
    renderTreatmentStep(index + 1, data.treatment, data.goal, data.timeline);
  });
}

function getCurrentTreatments() {
  const treatments = document.querySelectorAll('#treatment_plan > div');
  const treatmentsData = [];

  treatments.forEach(treatment => {
    const treatmentSelect = treatment.querySelector('select').value;
    const goalTextarea = treatment.querySelector('textarea').value;
    const timelineInput = treatment.querySelector('input').value;

    treatmentsData.push({
      treatment: treatmentSelect,
      goal: goalTextarea,
      timeline: timelineInput,
    });
  });

  return treatmentsData;
}

function renderTreatmentStep(stepNumber, treatment, goal, timeline) {
  const div = document.getElementById('treatment_plan');

  div.innerHTML += `
    <div id="treatment_${stepNumber}" class="mt-3">
      <h3 class="mb-1">Step ${stepNumber}: Initial Therapy</h3>
      <div class="d-flex justify-content-start gap-2 mt-2">
        <button type="button" onclick="deleteTreatment('treatment_${stepNumber}')">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
            <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
          </svg>
        </button>
      </div>
      Treatment:
      <select name="treatment_${stepNumber}" id="treatment_${stepNumber}" class="form-select d-inline-block w-auto" required>
        <option ${treatment === 'PRP' ? 'selected' : ''}>PRP</option>
        <option ${treatment === 'Stem cell therapy' ? 'selected' : ''}>Stem cell therapy</option>
        <option ${treatment === 'Stem cell clump therapy' ? 'selected' : ''}>Stem cell clump therapy</option>
        <option ${treatment === 'PRP fusion fluid' ? 'selected' : ''}>PRP fusion fluid</option>
        <option ${treatment === 'drip-feed' ? 'selected' : ''}>drip-feed</option>
        <option ${treatment === 'Follow up 1 month' ? 'selected' : ''}>Follow up 1 month</option>
        <option ${treatment === 'Follow up 3 month' ? 'selected' : ''}>Follow up 3 month</option>
        <option ${treatment === 'Follow up 6 month' ? 'selected' : ''}>Follow up 6 month</option>
        <option ${treatment === 'Follow up 12 month' ? 'selected' : ''}>Follow up 12 month</option>
      </select>
      <h5>Goal</h5>
      <p>
        <textarea class="form-control" rows="3" name="p_goal_${stepNumber}" id="p_goal_${stepNumber}" placeholder="Enter your goal" required>${goal}</textarea>
      </p>
      <p>Timeline: <input class="form-control" type="text" name="p_time_${stepNumber}"id="p_time_${stepNumber}" placeholder="6 weeks follow up" value="${timeline}" required></p>
    </div>
  `;
}


document.addEventListener("DOMContentLoaded", function () {
  const dateInput = document.getElementById('p_date');
  const dateInput_doctor = document.getElementById('d_date');
  const currentDate = new Date();

  const ukDate = `${String(currentDate.getDate()).padStart(2, '0')}/${String(currentDate.getMonth() + 1).padStart(2, '0')}/${currentDate.getFullYear()}`; // Correct template literal
  if (dateInput) dateInput.value = ukDate; // Safeguard for null elements
  if (dateInput_doctor) dateInput_doctor.value = ukDate; // Safeguard for null elements
});


  function initializeSignaturePad(canvasId, hiddenInputId) {
    const canvas = document.getElementById(canvasId);
    const ctx = canvas.getContext('2d');
    let isDrawing = false;

    canvas.addEventListener('mousedown', (e) => {
      isDrawing = true;
      ctx.beginPath();
      ctx.moveTo(e.offsetX, e.offsetY);
    });

    canvas.addEventListener('mousemove', (e) => {
      if (!isDrawing) return;
      ctx.lineTo(e.offsetX, e.offsetY);
      ctx.stroke();
    });

    canvas.addEventListener('mouseup', () => {
      if (!isDrawing) return;
      isDrawing = false;
      saveSignature(canvasId, hiddenInputId);
    });

    canvas.addEventListener('mouseout', () => {
      if (!isDrawing) return;
      isDrawing = false;
    });
  }

  function saveSignature(canvasId, hiddenInputId) {
    const canvas = document.getElementById(canvasId);
    const signatureData = canvas.toDataURL('image/png');
    document.getElementById(hiddenInputId).value = signatureData;
  }

  function clearSignature(type) {
    const canvasId = type === 'patient' ? 'patient-signature-pad' : 'doctor-signature-pad';
    const hiddenInputId = type === 'patient' ? 'signature_patient' : 'signature_doctor';
    const canvas = document.getElementById(canvasId);
    const ctx = canvas.getContext('2d');
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    document.getElementById(hiddenInputId).value = '';
  }

  document.addEventListener('DOMContentLoaded', () => {
    initializeSignaturePad('patient-signature-pad', 'signature_patient');
    initializeSignaturePad('doctor-signature-pad', 'signature_doctor');
  });

</script>
</div>