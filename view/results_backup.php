<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>KOOS Survey Results</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f7e4f5;
      font-family: Arial, sans-serif;
    }
    .card {
      border: none;
      background-color: #f7e4f5;
    }
    .score-box {
      background-color: white;
      border-radius: 8px;
      font-size: 2rem;
      font-weight: bold;
      padding: 10px 20px;
      text-align: center;
      margin: 20px 0;
    }
    .recommendation {
      background-color: white;
      border: 1px solid #ddd;
      border-radius: 8px;
      padding: 15px;
      font-size: 0.9rem;
    }
    .recommendation .advice {
      color: green;
      font-weight: bold;
    }
    .details-section {
      background-color: white;
      border: 1px solid #ddd;
      border-radius: 8px;
      padding: 15px;
      margin-top: 20px;
    }
    .details-section h4 {
      color: #333;
      font-weight: bold;
      margin-bottom: 10px;
    }
    .details-section ul {
      padding-left: 20px;
    }
    .details-section li {
      font-size: 1rem;
      margin-bottom: 5px;
    }
  </style>
</head>
<body>
  <div class="container mt-5">
    <div class="card mx-auto p-4" style="max-width: 600px;">
      <h2 class="text-center">Results of the Survey</h2>
      <h4 class="text-center mt-3">Grade: A</h4>
      <h4 class="text-center mt-3">Your KOOS Score is...</h4>
      <div class="score-box mx-auto"><?= number_format($_GET['total_score'] ?? 0, 2) ?></div>
      <p class="text-left">Your next KOOS score will be...</p>
      <div class="score-box mx-auto">77.2</div>

      <div class="recommendation mt-4">
        <h5>Recommendation from Doctor</h5>
        <p>
          Based on the KOOS score, <strong><?= number_format($_GET['total_score'] ?? 0, 2) ?></strong><br>
        </p>
        <p class="advice">Doctor's Recommendation</p>
        <ul>
          <?= $recommendations = generateRecommendations($_GET['total_score']) ?>
        </ul>
      </div>

      <div class="details-section">
        <h4>KOOS-12 Scoring Guide</h4>
        <p>This section explains how your KOOS-12 score is calculated and interpreted.</p>

        <h5>1. KOOS-12 Subscale Scores</h5>
        <ul>
            <li><strong>Pain Scale Score:</strong> Sum of responses in the pain section (Questions 1–4).</li>
            <li><strong>Function Scale Score:</strong> Sum of responses in the function section (Questions 5–8).</li>
            <li><strong>Quality of Life (QOL) Scale Score:</strong> Sum of responses in the QOL section (Questions 9–12).</li>
        </ul>

        <h5>2. Minimum Required Responses</h5>
        <p>At least <strong>half</strong> of the items in each section (a minimum of <strong>2 answered questions</strong>) must be completed to calculate a score. If data is missing, person-specific estimation may be used.</p>

        <h5>3. Score Interpretation</h5>
        <ul>
            <li>KOOS-12 scores are transformed on a scale from <strong>0 to 100</strong>, where:</li>
            <ul>
                <li><strong>0</strong> = Worst possible condition</li>
                <li><strong>100</strong> = Best possible outcome</li>
            </ul>
            <li>This transformation is consistent with the original KOOS scoring method.</li>
        </ul>

        <h5>4. KOOS-12 Summary Knee Impact Score</h5>
        <ul>
            <li>Calculated as the <strong>average</strong> of KOOS-12 Pain, Function, and QOL scores.</li>
            <li>Not calculated if any of the three subscale scores are missing.</li>
            <li>Also ranges from <strong>0 (worst) to 100 (best)</strong>.</li>
        </ul>
      </div>

      <div class="details-section">
        <h4>Detailed Results of Your Survey</h4>
        <p>These scores can assist in your consultation with the doctor:</p>
        <ul>
          <li><strong>Pain:</strong> <?= number_format($_GET['total_pain'] ?? 0, 2) ?></li>
          <li><strong>Function:</strong> <?= number_format($_GET['total_func'] ?? 0, 2) ?></li>
          <li><strong>Quality of Life:</strong> <?= number_format($_GET['total_qol'] ?? 0, 2) ?></li>
        </ul>
      </div>
    </div>
  </div>

  <?
  function generateRecommendations($score) {
    if ($score >= 80) {
        return "
        <ul>
            <li><span class='advice'>Maintain an active lifestyle</span> – Regular low-impact exercises like walking and swimming help maintain joint mobility.<br><a href='https://bsmfoundation.ca/knee-osteoarthritis/#:~:text=The%20first%20step%20in%20OA,%2Dday%20function%20%5B9%5D.'</a></li>
            <li><span class='advice'>Stretching and strength training</span> – Keep knee-supporting muscles strong.<br><a href='https://pubmed.ncbi.nlm.nih.gov/35091326/#:~:text=Conclusions:%20Stretching%20exercises%20can%20be,reviewregistry813).'>https://pubmed.ncbi.nlm.nih.gov/35091326/#:~:text=Conclusions:%20Stretching%20exercises%20can%20be,reviewregistry813).</a></li>
            <li><span class='advice'>Healthy weight management</span> – Reduce stress on the knee joints.<br><a href='https://www.hopkinsarthritis.org/patient-corner/disease-management/role-of-body-weight-in-osteoarthritis/'>https://www.hopkinsarthritis.org/patient-corner/disease-management/role-of-body-weight-in-osteoarthritis/</a></li>
        </ul>";
    } elseif ($score >= 60) {
        return "
        <ul>
            <li><span class='advice'>Physical therapy</span> – A structured therapy plan can help restore movement and manage pain.<br><a href='https://www.webmd.com/osteoarthritis/ss/slideshow-knee-exercises'>https://www.webmd.com/osteoarthritis/ss/slideshow-knee-exercises</a></li>
            <li><span class='advice'>Pain relief strategies</span> – Consider heat/cold therapy and over-the-counter pain relievers.<br><a href='https://www.nhs.uk/conditions/osteoarthritis/treatment/#:~:text=Hot%20or%20cold%20packs,work%20in%20the%20same%20way.'>https://www.nhs.uk/conditions/osteoarthritis/treatment/#:~:text=Hot%20or%20cold%20packs,work%20in%20the%20same%20way.</a></li>
            <li><span class='advice'>Modify daily activities</span> – Avoid prolonged standing and heavy lifting.<br><a href='https://www.nyp.org/healthlibrary/articles/modifying-activities-for-osteoarthritis'>https://www.nyp.org/healthlibrary/articles/modifying-activities-for-osteoarthritis</a></li>
        </ul>";
    } elseif ($score >= 40) {
        return "
        <ul>
            <li><span class='advice'>Use of assistive devices</span> – A knee brace or walking cane can help reduce pressure on joints.<br><a href='https://www.mayoclinic.org/diseases-conditions/osteoarthritis/diagnosis-treatment/drc-20351930'>https://www.mayoclinic.org/diseases-conditions/osteoarthritis/diagnosis-treatment/drc-20351930</a></li>
            <li><span class='advice'>Targeted pain management</span> – Work with a healthcare provider to explore medications or injections.<br><a href='https://www.bupa.co.uk/health-information/knee-pain/treatment-options-knee-pain'>https://www.bupa.co.uk/health-information/knee-pain/treatment-options-knee-pain</a></li>
            <li><span class='advice'>Lifestyle changes</span> – Reduce joint strain with modifications in posture and movement.<br><a href='https://arthritis.ca/about-arthritis/arthritis-types-(a-z)/types/osteoarthritis/osteoarthritis-self-management#:~:text=Lifestyle%20changes%20such%20as%20increasing,and%20a%20more%20positive%20outlook.'>https://arthritis.ca/about-arthritis/arthritis-types-(a-z)/types/osteoarthritis/osteoarthritis-self-management#:~:text=Lifestyle%20changes%20such%20as%20increasing,and%20a%20more%20positive%20outlook.</a></li>
        </ul>";
    } else {
        return "
        <ul>
            <li><span class='advice'>Medical interventions</span> – Consult a specialist to explore PRP therapy, stem cell therapy, or surgery.<br><a href='https://www.hcahealthcare.co.uk/blog/stem-cell-treatment-for-knee-osteoarthritis'>https://www.hcahealthcare.co.uk/blog/stem-cell-treatment-for-knee-osteoarthritis</a></li>
            <li><span class='advice'>Advanced pain management</span> – Prescription medication or corticosteroid injections may be required.<br><a href='https://www.nhs.uk/conditions/osteoarthritis/treatment/'>https://www.nhs.uk/conditions/osteoarthritis/treatment/</a></li>
            <li><span class='advice'>Assistive devices and mobility solutions</span> – Consider mobility aids to improve daily function.<br><a href='https://www.racgp.org.au/clinical-resources/clinical-guidelines/handi/patient-resources/managing-osteoarthritis/walking-aid-for-knee-or-hip-osteoarthritis'>https://www.racgp.org.au/clinical-resources/clinical-guidelines/handi/patient-resources/managing-osteoarthritis/walking-aid-for-knee-or-hip-osteoarthritis</a></li>
        </ul>";
    }
}
?>
  <!-- Bootstrap JS (optional) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
