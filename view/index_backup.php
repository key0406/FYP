<?php
session_start();
if (empty($_SESSION['auth_patient']) ) {
  echo '<h1 class="text-custom">Please login from login Page</h1><br>';
  echo '<h1 class="text-custom"><a href="login.php">Login</a></h1>';
  exit();
}
if (!empty($_GET['lang'])) $lang = $_GET['lang'];
else $lang = 'en';
$path = 'lang/'.$lang.'.json';
$file = fopen($path, "r");
$json = fread($file, filesize($path));
$tls = json_decode($json, true);
?>
?>

<!DOCTYPE html>
<html lang="<?php echo $lang?>">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="robots" content="noindex">
  <title>KOOS-12 Surveyform</title>
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
  </style>
</head>
<body>
  <div class="container">
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
      <span class="fs-4">KOOS-12 Knee Survey</span>
      <p class="mb=1">Instruction: This survey asks for your views about your knee. Answer every question by marking the appropriate choice, only one answer for each question. 
        If you are unsure about how to answer a question, please give the best answer you can.
      </p>
      <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">

    </header>
    <p><?= $tls['introduction']?></p>
    <select id="langselect" class="form-select d-inline-block w-auto">
        <option></option>
        <option value="en" lang="en">English</option>
        <option value="fr" lang="fr">français</option>
        <option value="es" lang="es">español</option>
        <option value="pt-BR" lang="pt-BR">português</option>
        <option value="zh-CN" lang="zh-CN">中文（簡体）</option>
        <option value="zh-TW" lang="zh-TW">中文（繁体）</option>
        <option value="ko" lang="ko">한국어</option>
        <option value="id" lang="id">Bahasa Indonesia</option>
        <option value="th" lang="th">ภาษาไทย</option>
        <option value="hi" lang="hi">हिन्दी</option>
        <option value="vi" lang="vi">Tiếng Việt</option>
        <option value="tl" lang="tl">Tagalog</option>
        <option value="ru" lang="ru">Русский</option>
        <option value="ar" lang="ar">اَلْعَرَبِيَّةُ</option>
    </select>
      <p>Please choose your language with the bar above and fill in the form.</p>
      <form class="h-adr" method="post" action="../controller/SurveyformController.php">
      <p class="mb-1">Name</p>
      <input class="form-control" type="text" name="name" id="name" placeholder="Enter your name" required>
      <p class="mb-1">Gender</p>
      <div class="mb-2">
        <div class="form-check form-check-inline">
          <input class="form-check-input"  type="radio" name="sex" autocomplete="sex" id="male" value="Male"><label class="form-check-label" for="male"  required> Male</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="sex" autocomplete="sex" id="female" value="Female"><label class="form-check-label" for="female" required> Female</label>
        </div>
      </div>
      <p>Age</p>
      (Age: 
      <select name="age" id="age" class="form-select d-inline-block w-auto" required>
        <option value="10">10</option>
        <option value="20">20</option>
        <option value="30">30</option>
        <option value="40">40</option>
        <option value="50">50</option>
        <option value="60">60</option>
        <option value="70">70</option>
        <option value="80">80</option>
        <option value="90">90</option>
        <option value="100">100</option>
      </select>)
      <p>Treatment gap</p>
      <input class="form-control" type="text" name="gap" id="gap" placeholder="How long have you been waiting for treatment?" required>
      <div class="survey">
        <h2>KOOS-12 Survey</h2>
        <p>※If you want to take an survey for both Knee, take this survey twice</p>
        <div class="mb-2">
          <div class="form-check form-check-inline">
            <input class="form-check-input"  type="radio" name="knee" autocomplete="knee" id="left" value="left"><label class="form-check-label" for="left"  required>left</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="knee" autocomplete="knee" id="right" value="right"><label class="form-check-label" for="right" required>right</label>
          </div>
        </div>
        <div class="mb-2" id="pain">
          <h3>Pain</h3>
          <p class="mb-1">1.How often do you experience knee pain?</p>
          <div class="mb-2">
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="p1" id="p1_0" value="0"><label class="form-check-label" for="p1_0" required>Never</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="p1" id="p1_1" value="1"><label class="form-check-label" for="p1_1" required>Monthly</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="p1" id="p1_2" value="2"><label class="form-check-label" for="p1_2" required>Weekly</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="p1" id="p1_3" value="3"><label class="form-check-label" for="p1_3" required>Daily</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="p1" id="p1_4" value="4"><label class="form-check-label" for="p1_4" required>Always</label>
            </div>
          </div>
          <p class="mb-1">2.Walking on a flat surface</p>
          <div class="mb-2">
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="p2" id="p2_0" value="0"><label class="form-check-label" for="p2_0" required>None</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="p2" id="p2_1" value="1"><label class="form-check-label" for="p2_1" required>Mild</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="p2" id="p2_2" value="2"><label class="form-check-label" for="p2_2" required>Moderate</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="p2" id="p2_3" value="3"><label class="form-check-label" for="p2_3" required>Severe</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="p2" id="p2_4" value="4"><label class="form-check-label" for="p2_4" required>Extreme</label>
            </div>
          </div>
          <p class="mb-1">3.Going up or down stairs</p>
          <div class="mb-2">
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="p3" id="p3_0" value="0"><label class="form-check-label" for="p3_0" required>None</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="p3" id="p3_1" value="1"><label class="form-check-label" for="p3_1" required>Mild</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="p3" id="p3_2" value="2"><label class="form-check-label" for="p3_2" required>Moderate</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="p3" id="p3_3" value="3"><label class="form-check-label" for="p3_3" required>Severe</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="p3" id="p3_4" value="4"><label class="form-check-label" for="p3_4" required>Extreme</label>
            </div>
          </div>
          <p class="mb-1">4.Sitting or lying</p>
          <div class="mb-2">
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="p4" id="p4_0" value="0"><label class="form-check-label" for="p4_0" required>None</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="p4" id="p4_1" value="1"><label class="form-check-label" for="p4_1" required>Mild</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="p4" id="p4_2" value="2"><label class="form-check-label" for="p4_2" required>Moderate</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="p4" id="p4_3" value="3"><label class="form-check-label" for="p4_3" required>Severe</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="p4" id="p4_4" value="4"><label class="form-check-label" for="p4_4" required>Extreme</label>
            </div>
          </div>
        </div>
          <div class="mb-2" id="ADL">
            <h3>Function and daily living</h3>
            <p>The following questions concern your physical function.
              <br> By this we mean your ability to move around and to look after yourself.
              <br> For each of the following activities please indicate the degree of difficulty you have experienced in the last week due to your knee.
            </p>
            <p class="mb-1">5. Rising from sitting</p>
            <div class="mb-2">
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="f1" id="f1_0" value="0"><label class="form-check-label" for="f1_0" required>None</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="f1" id="f1_1" value="1"><label class="form-check-label" for="f1_1" required>Mild</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="f1" id="f1_2" value="2"><label class="form-check-label" for="f1_2" required>Moderate</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="f1" id="f1_3" value="3"><label class="form-check-label" for="f1_3" required>Severe</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="f1" id="f1_4" value="4"><label class="form-check-label" for="f1_4" required>Extreme</label>
              </div>
            </div>
            <p class="mb-1">6.Standing</p>
            <div class="mb-2">
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="f2" id="f2_0" value="0"><label class="form-check-label" for="f2_0" required>None</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="f2" id="f2_1" value="1"><label class="form-check-label" for="f2_1" required>Mild</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="f2" id="f2_2" value="2"><label class="form-check-label" for="f2_2" required>Moderate</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="f2" id="f2_3" value="3"><label class="form-check-label" for="f2_3" required>Severe</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="f2" id="f2_4" value="4"><label class="form-check-label" for="f2_4" required>Extreme</label>
              </div>
            </div>
            <p class="mb-1">7.Getting in/out of a car</p>
            <div class="mb-2">
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="f3" id="f3_0" value="0"><label class="form-check-label" for="f3_0" required>None</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="f3" id="f3_1" value="1"><label class="form-check-label" for="f3_1" required>Mild</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="f3" id="f3_2" value="2"><label class="form-check-label" for="f3_2" required>Moderate</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="f3" id="f3_3" value="3"><label class="form-check-label" for="f3_3" required>Severe</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="f3" id="f3_4" value="4"><label class="form-check-label" for="f3_4" required>Extreme</label>
              </div>
            </div>
            <p class="mb-1">8.Twisting/pivoting on your injured knee</p>
            <div class="mb-2">
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="f4" id="f4_0" value="0"><label class="form-check-label" for="f4_0" required>None</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="f4" id="f4_1" value="1"><label class="form-check-label" for="f4_1" required>Mild</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="f4" id="f4_2" value="2"><label class="form-check-label" for="f4_2" required>Moderate</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="f4" id="f4_3" value="3"><label class="form-check-label" for="f4_3" required>Severe</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="f4" id="f4_4" value="4"><label class="form-check-label" for="f4_4" required>Extreme</label>
              </div>
            </div>
          </div>
          <div class="mb-2" id="QOL">
          <h3>Quality of Life</h3>
          <p class="mb-1">9.How often are you aware of your knee problem?</p>
          <div class="mb-2">
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="q1" id="q1_0" value="0"><label class="form-check-label" for="q1_0" required>Never</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="q1" id="q1_1" value="1"><label class="form-check-label" for="q1_1" required>Monthly</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="q1" id="q1_2" value="2"><label class="form-check-label" for="q1_2" required>Weekly</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="q1" id="q1_3" value="3"><label class="form-check-label" for="q1_3" required>Daily</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="q1" id="q1_4" value="4"><label class="form-check-label" for="q1_4" required>Constantly</label>
            </div>
          </div>
          <p class="mb-1">10.Have you modified your life style to avoid potentially damaging activities to your knee2</p>
          <div class="mb-2">
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="q2" id="q2_0" value="0"><label class="form-check-label" for="q2_0" required>Not at all</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="q2" id="q2_1" value="1"><label class="form-check-label" for="q2_1" required>Mildly</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="q2" id="q2_2" value="2"><label class="form-check-label" for="q2_2" required>Moderately</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="q2" id="q2_3" value="3"><label class="form-check-label" for="q2_3" required>Severely</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="q2" id="q2_4" value="4"><label class="form-check-label" for="q2_4" required>Totally</label>
            </div>
          </div>
          <p class="mb-1">11.How much are you troubled with lack of confidence in your knee?</p>
          <div class="mb-2">
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="q3" id="q3_0" value="0"><label class="form-check-label" for="q3_0" required>Not at all</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="q3" id="q3_1" value="1"><label class="form-check-label" for="q3_1" required>Mildly</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="q3" id="q3_2" value="2"><label class="form-check-label" for="q3_2" required>Moderately</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="q3" id="q3_3" value="3"><label class="form-check-label" for="q3_3" required>Severely</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="q3" id="q3_4" value="4"><label class="form-check-label" for="q3_4" required>Totally</label>
            </div>
          </div>
          <p class="mb-1">12.In general how much difficulty do you have with your knee?</p>
            <div class="mb-2">
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="q4" id="q4_0" value="0"><label class="form-check-label" for="q4_0" required>None</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="q4" id="q4_1" value="1"><label class="form-check-label" for="q4_1" required>Mild</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="q4" id="q4_2" value="2"><label class="form-check-label" for="q4_2" required>Moderate</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="q4" id="q4_3" value="3"><label class="form-check-label" for="q4_3" required>Severe</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="q4" id="q4_4" value="4"><label class="form-check-label" for="q4_4" required>Extreme</label>
              </div>
            </div>
          </div>
      </div>
    </header>
    <p class="text-center"><button class="btn btn-primary btn-lg w-25 rounded-pill">Submit</button></p> 
    <p class="confidential"><strong>The information you provide here is strictly confidential. Thank you very much for completing this questionnaire.</strong></p>
  </div>
    