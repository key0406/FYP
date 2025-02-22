<?php
if (!empty($_GET['lang'])) $lang = $_GET['lang'];
else $lang = 'en';
$path = '../lang_result/'.$lang.'.json';
$file = fopen($path, "r");
$json = fread($file, filesize($path));
$tls = json_decode($json, true);

// Log out the user
if (isset($_GET['logout'])) {
  session_unset(); // Remove all session variables
  session_destroy(); // Destroy the session
  header("Location: login.php"); // Redirect to the login page
  exit();
}
?>

<!DOCTYPE html>
<html lang="<?php echo $lang?>"<?php if($lang =='ar') echo ' dir="rtl"'?>>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>KOOS Survey Results</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!--jsPDF-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
</head>
  
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
    <p><?= $tls['language_preference']?></p>
      <select id="langselect" class="form-select d-inline-block w-auto">
        <option value="en" <?= ($lang == 'en') ? 'selected' : '' ?>>English</option>
        <option value="ja" <?= ($lang == 'ja') ? 'selected' : '' ?>>日本語</option>
        <option value="fr" <?= ($lang == 'fr') ? 'selected' : '' ?>>français</option>
        <option value="es" <?= ($lang == 'es') ? 'selected' : '' ?>>español</option>
        <option value="pt-BR" <?= ($lang == 'pt-BR') ? 'selected' : '' ?>>português</option>
        <option value="zh-CN" <?= ($lang == 'zh-CN') ? 'selected' : '' ?>>中文（簡体）</option>
        <option value="zh-TW" <?= ($lang == 'zh-TW') ? 'selected' : '' ?>>中文（繁体）</option>
        <option value="ko" <?= ($lang == 'ko') ? 'selected' : '' ?>>한국어</option>
        <option value="id" <?= ($lang == 'id') ? 'selected' : '' ?>>Bahasa Indonesia</option>
        <option value="th" <?= ($lang == 'th') ? 'selected' : '' ?>>ภาษาไทย</option>
        <option value="hi" <?= ($lang == 'hi') ? 'selected' : '' ?>>हिन्दी</option>
        <option value="vi" <?= ($lang == 'vi') ? 'selected' : '' ?>>Tiếng Việt</option>
        <option value="tl" <?= ($lang == 'tl') ? 'selected' : '' ?>>Tagalog</option>
        <option value="ru" <?= ($lang == 'ru') ? 'selected' : '' ?>>Русский</option>
        <option value="ar" <?= ($lang == 'ar') ? 'selected' : '' ?>>اَلْعَرَبِيَّةُ</option>
      </select>
      <h2 class="text-center"><?=$tls['title']?></h2>
      <h4 class="text-center mt-3"><?=$tls['grade']?><?=gradeSelector($_GET['total_score'],$tls)?></h4>
      <h4 class="text-center mt-3"><?=$tls['koos_score']?></h4>
      <div class="score-box mx-auto"><?= number_format($_GET['total_score'] ?? 0, 2) ?></div>
      <p class="text-left"><?=$tls['predicted_score']?></p>
      <div class="score-box mx-auto"><?php $predicted_value = $_GET['predicted_score'] ?? 0.0; // Fetch predicted_score from URL parameters
?>
<div class="score-box mx-auto"><?= htmlspecialchars(number_format($predicted_value, 1)) ?></div>
</div>
      <div class="recommendation mt-4">
        <h5><?=$tls['recommendation']?></h5>
        <p>
        <?=$tls['based_on']?> <strong><?= number_format($_GET['total_score'] ?? 0, 2) ?></strong><?=$tls['considered']?>
        <br><strong><?=gradeDeterminer($_GET['total_score'],$tls)?></strong>
        </p>
        <p class="advice"><?=$tls['doctor_recommendation']?></p>
        <ul>
          <?= $recommendations = generateRecommendations($_GET['total_score'],$tls) ?>
        </ul>
      </div>
      <div class="details-section">
        <h4><?=$tls['detailed_title']?></h4>
        <p><?=$tls['detailed_title_2']?></p>
        <ul>
          <li><strong><?=$tls['pain']?></strong> <?= number_format($_GET['total_pain'] ?? 0, 2) ?></li>
          <li><strong><?=$tls['function']?></strong> <?= number_format($_GET['total_func'] ?? 0, 2) ?></li>
          <li><strong><?=$tls['qol']?></strong> <?= number_format($_GET['total_qol'] ?? 0, 2) ?></li>
        </ul>
      </div>
      <div class="details-section">
        <h4><?=$tls['grading']?></h4>
        <p><?=$tls['grading_1']?></p>

        <h5><?=$tls['A']?></h5>
        <ul>
            <li><strong><?=$tls['A_1']?></strong></li>
            <li><?=$tls['A_2']?></li>
            <li><?=$tls['A_3']?></li>
            <li><?=$tls['A_4']?></li>
        </ul>
        <h5><?=$tls['B']?></h5>
        <ul>
            <li><strong><?=$tls['B_1']?></strong></li>
            <li><?=$tls['B_2']?></li>
            <li><?=$tls['B_3']?></li>
            <li><?=$tls['B_4']?></li>
        </ul>
        <h5><?=$tls['C']?></h5>
        <ul>
            <li><strong><?=$tls['C_1']?></strong></li>
            <li><?=$tls['C_2']?></li>
            <li><?=$tls['C_3']?></li>
            <li><?=$tls['C_4']?></li>
        </ul>
        <h5><?=$tls['D']?></h5>
        <ul>
            <li><strong><?=$tls['D_1']?></strong></li>
            <li><?=$tls['D_2']?></li>
            <li><?=$tls['D_3']?></li>
            <li><?=$tls['D_4']?></li>
        </ul>
        <h5><?=$tls['E']?></h5>
        <ul>
            <li><strong><?=$tls['E_1']?></strong></li>
            <li><?=$tls['E_2']?></li>
            <li><?=$tls['E_3']?></li>
            <li><?=$tls['E_4']?></li>
        </ul>
      </div>
      <div class="details-section">
        <h4><?=$tls['score_grading']?></h4>
        <p><?=$tls['score_grading_dec']?></p>

        <h5><?=$tls['score_grading_1']?></h5>
        <ul>
            <li><strong><?=$tls['score_grading_1_1']?></strong><?=$tls['score_grading_1_1_dec']?></li>
            <li><strong><?=$tls['score_grading_1_2']?></strong> <?=$tls['score_grading_1_2_1']?></li>
            <li><strong><?=$tls['score_grading_1_3']?></strong> <?=$tls['score_grading_1_3_1']?></li>
        </ul>

        <h5><?=$tls['score_grading_2']?></h5>
        <p><?=$tls['score_grading_2_1_dec_1']?> <strong><?=$tls['score_grading_2_1_dec_2']?></strong> <?=$tls['score_grading_2_1_dec_3']?> <strong><?=$tls['score_grading_2_1_dec_4']?></strong><?=$tls['score_grading_2_1_dec_5']?>

        <h5><?=$tls['score_grading_3']?></h5>
        <ul>
            <li><?=$tls['score_grading_3_dec']?> <strong><?=$tls['score_grading_3_dec_2']?> </strong><?=$tls['score_grading_3_dec_3']?> </li>
            <ul>
                <li><strong><?=$tls['score_grading_3_1']?></strong><?=$tls['score_grading_3_1_1']?></li>
                <li><strong><?=$tls['score_grading_3_2']?></strong><?=$tls['score_grading_3_2_1']?></li>
            </ul>
            <li><?=$tls['score_grading_3_3']?></li>
        </ul>

        <h5><?=$tls['score_grading_4']?></h5>
        <ul>
            <li><?=$tls['score_grading_4_1']?><strong><?=$tls['score_grading_4_1_1']?></strong><?=$tls['score_grading_4_1_2']?></li>
            <li><?=$tls['score_grading_4_2']?></li>
            <li><?=$tls['score_grading_4_3']?><strong><?=$tls['score_grading_4_3_1']?></strong>.</li>
        </ul>
      </div>
    </div>
    <button type="button" onclick="downloadPageAsPDF()"><?=$tls['download']?></button> 
  </div>
  <a href="?logout=true" class="btn btn-danger">Logout</a>
</body>
</html>
  <?
  function gradeSelector($score,$tls){
    if($score >= 80) return $tls['grade_select_A'];
    else if($score >= 60) return $tls['grade_select_B'];
    else if($score >= 40) return $tls[' grade_select_C'];
    else if($score >= 20) return $tls['grade_select_D'];
    else return $tls['grade_select_E'];
  }
  function gradeDeterminer($score, $tls){
    if($score >= 80) return $tls['determine'];
    else if($score >= 60) return $tls['determine_1'];
    else if($score >= 40) return $tls['determine_2'];
    else if($score >= 20) return $tls['determine_3'];
    else return $tls['determine_4'];
  }
  function generateRecommendations($score, $tls) {
    if ($score >= 80) {
        return "
        <ul>
            <li><span class='advice'>{$tls['recommendation_1_1']}</span> – {$tls['recommendation_1_1_1']}<br>
                <a href='https://bsmfoundation.ca/knee-osteoarthritis/#:~:text=The%20first%20step%20in%20OA,%2Dday%20function%20%5B9%5D.'>Read more</a>
            </li>
            <li><span class='advice'>{$tls['recommendation_1_2']}</span> – {$tls['recommendation_1_2_1']}<br>
                <a href='https://pubmed.ncbi.nlm.nih.gov/35091326/#:~:text=Conclusions:%20Stretching%20exercises%20can%20be,reviewregistry813).'>Read more</a>
            </li>
            <li><span class='advice'>{$tls['recommendation_1_3']}</span> – {$tls['recommendation_1_3_1']}<br>
                <a href='https://www.hopkinsarthritis.org/patient-corner/disease-management/role-of-body-weight-in-osteoarthritis/'>Read more</a>
            </li>
        </ul>";
    } elseif ($score >= 60) {
        return "
        <ul>
            <li><span class='advice'>{$tls['recommendation_2_1']}</span> – {$tls['recommendation_2_1_1']}<br>
                <a href='https://www.webmd.com/osteoarthritis/ss/slideshow-knee-exercises'>Read more</a>
            </li>
            <li><span class='advice'>{$tls['recommendation_2_2']}</span> – {$tls['recommendation_2_2_1']}<br>
                <a href='https://www.nhs.uk/conditions/osteoarthritis/treatment/#:~:text=Hot%20or%20cold%20packs,work%20in%20the%20same%20way.'>Read more</a>
            </li>
            <li><span class='advice'>{$tls['recommendation_2_3']}</span> – {$tls['recommendation_2_3_1']}<br>
                <a href='https://www.nyp.org/healthlibrary/articles/modifying-activities-for-osteoarthritis'>Read more</a>
            </li>
        </ul>";
    } elseif ($score >= 40) {
        return "
        <ul>
            <li><span class='advice'>{$tls['recommendation_3_1']}</span> – {$tls['recommendation_3_1_1']}<br>
                <a href='https://www.mayoclinic.org/diseases-conditions/osteoarthritis/diagnosis-treatment/drc-20351930'>Read more</a>
            </li>
            <li><span class='advice'>{$tls['recommendation_3_2']}</span> – {$tls['recommendation_3_2_1']}<br>
                <a href='https://www.bupa.co.uk/health-information/knee-pain/treatment-options-knee-pain'>Read more</a>
            </li>
            <li><span class='advice'>{$tls['recommendation_3_3']}</span> – {$tls['recommendation_3_3_1']}<br>
                <a href='https://arthritis.ca/about-arthritis/arthritis-types-(a-z)/types/osteoarthritis/osteoarthritis-self-management#:~:text=Lifestyle%20changes%20such%20as%20increasing,and%20a%20more%20positive%20outlook.'>Read more</a>
            </li>
        </ul>";
    } else {
        return "
        <ul>
            <li><span class='advice'>{$tls['recommendation_4_1']}</span> – {$tls['recommendation_4_1_1']}<br>
                <a href='https://www.hcahealthcare.co.uk/blog/stem-cell-treatment-for-knee-osteoarthritis'>Read more</a>
            </li>
            <li><span class='advice'>{$tls['recommendation_4_2']}</span> – {$tls['recommendation_4_2_1']}<br>
                <a href='https://www.nhs.uk/conditions/osteoarthritis/treatment/'>Read more</a>
            </li>
            <li><span class='advice'>{$tls['recommendation_4_3']}</span> – {$tls['recommendation_4_3_1']}<br>
                <a href='https://www.racgp.org.au/clinical-resources/clinical-guidelines/handi/patient-resources/managing-osteoarthritis/walking-aid-for-knee-or-hip-osteoarthritis'>Read more</a>
            </li>
        </ul>";
    }
}

?>
  <!-- Bootstrap JS (optional) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
  async function downloadPageAsPDF() {
    const { jsPDF } = window.jspdf;
    const container = document.querySelector('.container');

    // Capture the content as a high-quality image with compression
    const canvas = await html2canvas(container, {
      scale: 2, // High quality but optimized for file size
      useCORS: true,
      allowTaint: true,
      logging: false
    });

    const imgData = canvas.toDataURL('image/jpeg', 0.5); // Compressed JPEG (50% quality)

    // Get full image dimensions
    const imgWidth = 210; // A4 width in mm
    const imgHeight = (canvas.height * imgWidth) / canvas.width; // Maintain aspect ratio

    // Create a PDF with multiple pages if needed
    const pdf = new jsPDF({
      orientation: imgHeight > 297 ? 'portrait' : 'landscape', // Auto-switch if needed
      unit: 'mm',
      format: 'a4'
    });

    let yPosition = 0; // Track Y position for pages
    let pageHeight = 297; // A4 page height in mm

    // Handle multi-page PDFs
    while (yPosition < imgHeight) {
      pdf.addImage(imgData, 'JPEG', 0, yPosition * -1, imgWidth, imgHeight);
      yPosition += pageHeight;
      if (yPosition < imgHeight) pdf.addPage();
    }

    pdf.save('KOOS-12_Survey_Results.pdf'); // Save the PDF
  }
</script>

<script>
    // Language selection without affecting other URL parameters
    document.getElementById("langselect").addEventListener("change", function() {
        var selectedLang = this.value;
        var url = new URL(window.location.href);
        url.searchParams.set('lang', selectedLang);
        window.location.href = url.toString();
    });
</script>

</body>
</html>
