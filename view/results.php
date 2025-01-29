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
    .contact-section {
      background-color: white;
      border: 1px solid #ddd;
      border-radius: 8px;
      padding: 15px;
      margin-top: 20px;
      font-size: 0.9rem;
    }
    .contact-section textarea {
      width: 100%;
      height: 100px;
      padding: 10px;
      font-size: 1rem;
      border-radius: 8px;
      border: 1px solid #ddd;
    }
    .contact-section p {
      margin-top: 10px;
    }
  </style>
</head>
<body>
  <div class="container mt-5">
    <div class="card mx-auto p-4" style="max-width: 600px;">
      <h2 class="text-center">Results of the survey</h2>
      <h4 class="text-center mt-3">Grade: A</h4>
      <h4 class="text-center mt-3">Your KOOS score is...</h4>
      <div class="score-box mx-auto"><?= number_format($_GET['total_score'] ?? 0, 2) ?></div>
      <p class="text-left">Your next KOOS score will be...</p>
      <div class="score-box mx-auto">77.2</div>
      <div class="recommendation mt-4">
        <h5>Recommendation from Doctor</h5>
        <p>
          Based on the KOOS score, <strong><?= number_format($_GET['total_score'] ?? 0, 2) ?></strong> indicates a moderate condition!<br>
          This score suggests that knee joint function is somewhat restricted, but there is room for improvement with early intervention. Incorporating exercise therapy and weight management can help alleviate symptoms and prevent further deterioration.
        </p>
        <p class="advice">Advice on Exercise Therapy:</p>
        <ul>
          <li><span class="advice">Low-impact exercises</span> (e.g., walking, cycling, and water-based exercises) can improve muscle strength while reducing stress on the knees.</li>
          <li><span class="advice">Stretching</span> is important to maintain joint flexibility. Focus especially on quadriceps and hamstrings.</li>
        </ul>
      </div>
      <div class="contact-section">
        <h5>Advice on Diet and Weight Management:</h5>
        <ul>
          <li><span class="advice">Managing weight</span> is crucial for reducing stress on the knees. Aim for a balanced diet to maintain a healthy BMI.</li>
          <li><span class="advice">Anti-inflammatory foods</span> (such as fish, nuts, and olive oil) can help reduce knee inflammation.</li>
        </ul>
        <p>
          <strong>Note:</strong> If symptoms worsen, consult a doctor to consider PRP treatments or Stem cell injection therapy!
        </p>
        <p><strong>This is a link for advised exercise:</strong></p>
        <p><a href="https://www.figma.com/design/creZDwroB1v3ObzyjOYdbQ/FYP-prototype?node-id=198-625&t=8yUnONPMlbISAhmE-0" target="_blank">Exercise Advice</a></p>
        <p><strong>This is a link for the treatment:</strong></p>
        <p><a href="https://www.figma.com/design/creZDwroB1v3ObzyjOYdbQ/FYP-prototype?node-id=198-625&t=8yUnONPMlbISAhmE-0" target="_blank">Treatment Options</a></p>
        <h5 class="mt-4">You can contact the Doctor from the textbox below:</h5>
        <textarea readonly>I am having a knee pain and considering a PRP treatment.</textarea>
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
  <!-- Bootstrap JS (optional) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
