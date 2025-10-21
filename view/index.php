<?php
session_start();
if (empty($_SESSION['auth_patient']) ) {
  echo '<h1 class="text-custom">Please login from login Page</h1><br>';
  echo '<h1 class="text-custom"><a href="login.php">Login</a></h1>';
  exit();
}
if (!empty($_GET['lang'])) $lang = $_GET['lang'];
else $lang = 'en';
$path = '../lang/'.$lang.'.json';
$file = fopen($path, "r");
$json = fread($file, filesize($path));
$tls = json_decode($json, true);
?>

<!DOCTYPE html>
<html lang="<?php echo $lang?>"<?php if($lang =='ar') echo ' dir="rtl"'?>>
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
      <span class="fs-4"><?= $tls['title'] ?></span>
      <p class="mb=1"><?= $tls['instruction_intro']?></p>
      <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
    </header>
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

      <form class="h-adr" method="post" action="../controller/SurveyformController.php">
      <p class="mb-1"><?= $tls['name']?> <span class="text-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
  <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z"/>
</svg> <?= $tls['required'] ?></span></p>
      <input class="form-control" type="text" name="name" id="name" placeholder=<?= $tls['name_place']?> required>
      <p class="mb-1"><?= $tls['gender']?> <span class="text-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
  <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z"/>
</svg> <?= $tls['required'] ?></span></p>
      <div class="mb-2">
        <div class="form-check form-check-inline">
          <input class="form-check-input"  type="radio" name="sex" autocomplete="sex" id="male" value="Male"><label class="form-check-label" for="male"  required> <?= $tls['male']?> </label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="sex" autocomplete="sex" id="female" value="Female"><label class="form-check-label" for="female" required> <?= $tls['female']?> </label>
        </div>
      </div>
      <p><?= $tls['age']?>  <span class="text-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
  <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z"/>
</svg> <?= $tls['required'] ?></span></p>
      (<?= $tls['age']?>: 
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
      <p><?= $tls['treatment_gap']?></p>
      <input class="form-control" type="text" name="gap" id="gap" placeholder=<?= $tls['treatment_gap_place']?>>
      <div class="survey">
        <h2><?= $tls['survey_title']?></h2>
        <span class="text-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
  <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z"/>
</svg> <?= $tls['required'] ?></span>
        <p>※</i><?= $tls['survey_dec']?></p>
        <div class="mb-2">
          <div class="form-check form-check-inline">
            <input class="form-check-input"  type="radio" name="knee" autocomplete="knee" id="left" value="left"><label class="form-check-label" for="left"  required><?= $tls['left']?></label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="knee" autocomplete="knee" id="right" value="right"><label class="form-check-label" for="right" required><?= $tls['right']?></label>
          </div>
        </div>
        <div class="mb-2" id="pain">
          <h3><?= $tls['pain']?></h3>
          <p class="mb-1"><?= $tls['p1']?> <span class="text-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
  <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z"/>
</svg> <?= $tls['required'] ?></span></p>
          <div class="mb-2">
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="p1" id="p1_0" value="0"><label class="form-check-label" for="p1_0" required><?= $tls['never']?></label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="p1" id="p1_1" value="1"><label class="form-check-label" for="p1_1" required><?= $tls['monthly']?></label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="p1" id="p1_2" value="2"><label class="form-check-label" for="p1_2" required><?= $tls['weekly']?></label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="p1" id="p1_3" value="3"><label class="form-check-label" for="p1_3" required><?= $tls['daily']?></label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="p1" id="p1_4" value="4"><label class="form-check-label" for="p1_4" required><?= $tls['always']?></label>
            </div>
          </div>
          <p class="mb-1"><?= $tls['p2']?> <span class="text-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
  <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z"/>
</svg> <?= $tls['required'] ?></span></p>
          <div class="mb-2">
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="p2" id="p2_0" value="0"><label class="form-check-label" for="p2_0" required><?= $tls['none']?></label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="p2" id="p2_1" value="1"><label class="form-check-label" for="p2_1" required><?= $tls['mild']?></label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="p2" id="p2_2" value="2"><label class="form-check-label" for="p2_2" required><?= $tls['moderate']?></label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="p2" id="p2_3" value="3"><label class="form-check-label" for="p2_3" required><?= $tls['severe']?></label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="p2" id="p2_4" value="4"><label class="form-check-label" for="p2_4" required><?= $tls['extreme']?></label>
            </div>
          </div>
          <p class="mb-1"><?= $tls['p3']?> <span class="text-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
  <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z"/>
</svg> <?= $tls['required'] ?></span></p>
          <div class="mb-2">
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="p3" id="p3_0" value="0"><label class="form-check-label" for="p3_0" required><?= $tls['none']?></label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="p3" id="p3_1" value="1"><label class="form-check-label" for="p3_1" required><?= $tls['mild']?></label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="p3" id="p3_2" value="2"><label class="form-check-label" for="p3_2" required><?= $tls['moderate']?></label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="p3" id="p3_3" value="3"><label class="form-check-label" for="p3_3" required><?= $tls['severe']?></label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="p3" id="p3_4" value="4"><label class="form-check-label" for="p3_4" required><?= $tls['extreme']?></label>
            </div>
          </div>
          <p class="mb-1"><?= $tls['p4']?> <span class="text-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
  <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z"/>
</svg> <?= $tls['required'] ?></span></p>
          <div class="mb-2">
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="p4" id="p4_0" value="0"><label class="form-check-label" for="p4_0" required><?= $tls['none']?></label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="p4" id="p4_1" value="1"><label class="form-check-label" for="p4_1" required><?= $tls['mild']?></label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="p4" id="p4_2" value="2"><label class="form-check-label" for="p4_2" required><?= $tls['moderate']?></label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="p4" id="p4_3" value="3"><label class="form-check-label" for="p4_3" required><?= $tls['severe']?></label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="p4" id="p4_4" value="4"><label class="form-check-label" for="p4_4" required><?= $tls['extreme']?></label>
            </div>
          </div>
        </div>
          <div class="mb-2" id="ADL">
            <h3><?= $tls['function']?></h3>
            <p><?=$tls['function_dec']?></p>
            <p class="mb-1"><?=$tls['f1']?> <span class="text-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
  <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z"/>
</svg> <?= $tls['required'] ?></span></p>
            <div class="mb-2">
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="f1" id="f1_0" value="0"><label class="form-check-label" for="f1_0" required><?=$tls['none']?></label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="f1" id="f1_1" value="1"><label class="form-check-label" for="f1_1" required><?=$tls['mild']?></label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="f1" id="f1_2" value="2"><label class="form-check-label" for="f1_2" required><?=$tls['moderate']?></label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="f1" id="f1_3" value="3"><label class="form-check-label" for="f1_3" required><?=$tls['severe']?></label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="f1" id="f1_4" value="4"><label class="form-check-label" for="f1_4" required><?=$tls['extreme']?></label>
              </div>
            </div>
            <p class="mb-1"><?=$tls['f2']?> <span class="text-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
  <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z"/>
</svg> <?= $tls['required'] ?></span></p>
            <div class="mb-2">
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="f2" id="f2_0" value="0"><label class="form-check-label" for="f2_0" required><?=$tls['none']?></label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="f2" id="f2_1" value="1"><label class="form-check-label" for="f2_1" required><?=$tls['mild']?></label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="f2" id="f2_2" value="2"><label class="form-check-label" for="f2_2" required><?=$tls['moderate']?></label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="f2" id="f2_3" value="3"><label class="form-check-label" for="f2_3" required><?=$tls['severe']?></label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="f2" id="f2_4" value="4"><label class="form-check-label" for="f2_4" required><?=$tls['extreme']?></label>
              </div>
            </div>
            <p class="mb-1"><?=$tls['f3']?> <span class="text-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
  <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z"/>
</svg> <?= $tls['required'] ?></span></p>
            <div class="mb-2">
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="f3" id="f3_0" value="0"><label class="form-check-label" for="f3_0" required><?=$tls['none']?></label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="f3" id="f3_1" value="1"><label class="form-check-label" for="f3_1" required><?=$tls['mild']?></label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="f3" id="f3_2" value="2"><label class="form-check-label" for="f3_2" required><?=$tls['moderate']?></label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="f3" id="f3_3" value="3"><label class="form-check-label" for="f3_3" required><?=$tls['severe']?></label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="f3" id="f3_4" value="4"><label class="form-check-label" for="f3_4" required><?=$tls['extreme']?></label>
              </div>
            </div>
            <p class="mb-1"><?=$tls['f4']?> <span class="text-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
  <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z"/>
</svg> <?= $tls['required'] ?></span></p>
            <div class="mb-2">
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="f4" id="f4_0" value="0"><label class="form-check-label" for="f4_0" required><?=$tls['none']?></label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="f4" id="f4_1" value="1"><label class="form-check-label" for="f4_1" required><?=$tls['mild']?></label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="f4" id="f4_2" value="2"><label class="form-check-label" for="f4_2" required><?=$tls['moderate']?></label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="f4" id="f4_3" value="3"><label class="form-check-label" for="f4_3" required><?=$tls['severe']?></label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="f4" id="f4_4" value="4"><label class="form-check-label" for="f4_4" required><?=$tls['extreme']?></label>
              </div>
            </div>
          </div>
          <div class="mb-2" id="QOL">
          <h3><?=$tls['qol']?></h3>
          <p class="mb-1"><?=$tls['q1']?> <span class="text-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
  <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z"/>
</svg> <?= $tls['required'] ?></span></p>
          <div class="mb-2">
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="q1" id="q1_0" value="0"><label class="form-check-label" for="q1_0" required><?=$tls['never']?></label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="q1" id="q1_1" value="1"><label class="form-check-label" for="q1_1" required><?=$tls['monthly']?></label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="q1" id="q1_2" value="2"><label class="form-check-label" for="q1_2" required><?=$tls['weekly']?></label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="q1" id="q1_3" value="3"><label class="form-check-label" for="q1_3" required><?=$tls['daily']?></label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="q1" id="q1_4" value="4"><label class="form-check-label" for="q1_4" required><?=$tls['constantly']?></label>
            </div>
          </div>
          <p class="mb-1"><?=$tls['q2']?> <span class="text-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
  <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z"/>
</svg> <?= $tls['required'] ?></span></p>
          <div class="mb-2">
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="q2" id="q2_0" value="0"><label class="form-check-label" for="q2_0" required><?=$tls['not']?></label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="q2" id="q2_1" value="1"><label class="form-check-label" for="q2_1" required><?=$tls['mildly']?></label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="q2" id="q2_2" value="2"><label class="form-check-label" for="q2_2" required><?=$tls['moderately']?></label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="q2" id="q2_3" value="3"><label class="form-check-label" for="q2_3" required><?=$tls['severely']?></label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="q2" id="q2_4" value="4"><label class="form-check-label" for="q2_4" required><?=$tls['totally']?></label>
            </div>
          </div>
          <p class="mb-1"><?=$tls['q3']?> <span class="text-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
  <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z"/>
</svg> <?= $tls['required'] ?></span></p>
          <div class="mb-2">
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="q3" id="q3_0" value="0"><label class="form-check-label" for="q3_0" required><?=$tls['not']?></label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="q3" id="q3_1" value="1"><label class="form-check-label" for="q3_1" required><?=$tls['mildly']?></label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="q3" id="q3_2" value="2"><label class="form-check-label" for="q3_2" required><?=$tls['moderately']?></label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="q3" id="q3_3" value="3"><label class="form-check-label" for="q3_3" required><?=$tls['severely']?></label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="q3" id="q3_4" value="4"><label class="form-check-label" for="q3_4" required><?=$tls['totally']?></label>
            </div>
          </div>
          <p class="mb-1"><?=$tls['q4']?> <span class="text-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
  <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z"/>
</svg> <?= $tls['required'] ?></span></p>
            <div class="mb-2">
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="q4" id="q4_0" value="0"><label class="form-check-label" for="q4_0" required><?=$tls['none']?></label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="q4" id="q4_1" value="1"><label class="form-check-label" for="q4_1" required><?=$tls['mild']?></label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="q4" id="q4_2" value="2"><label class="form-check-label" for="q4_2" required><?=$tls['moderate']?></label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="q4" id="q4_3" value="3"><label class="form-check-label" for="q4_3" required><?=$tls['severe']?></label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="q4" id="q4_4" value="4"><label class="form-check-label" for="q4_4" required><?=$tls['extreme']?></label>
              </div>
            </div>
          </div>
      </div>
    </header>
    <p class="text-center"><button class="btn btn-primary btn-lg w-25 rounded-pill"><?=$tls['submit']?></button></p> 
    <p class="confidential"><strong><?=$tls['confidential']?></strong></p>
  </div>
  <script>
    //This is for language selection
    document.getElementById("langselect").addEventListener("change", function() {
        var selectedLang = this.value;
        if (selectedLang) {
            window.location.href = "?lang=" + selectedLang;
        }
    });
</script>
<script>
  document.querySelector("form").addEventListener("submit", function (event) {
      let requiredTextFields = ["name", "gap"]; // Add more required text fields if needed
      let requiredRadioGroups = {
          "sex": "Gender",
          "knee": "Knee affected",
          "p1": "Pain - Walking",
          "p2": "Pain - Standing",
          "p3": "Pain - Sitting",
          "p4": "Pain - Lying Down",
          "f1": "Function - Getting Dressed",
          "f2": "Function - Climbing Stairs",
          "f3": "Function - Getting Up",
          "f4": "Function - Bending",
          "q1": "Quality of Life - Daily Activities",
          "q2": "Quality of Life - Pain Interference",
          "q3": "Quality of Life - Knee Awareness",
          "q4": "Quality of Life - General"
      };

      let missingFields = [];
      let isFormValid = true;

      document.querySelector("form").addEventListener("submit", function (event) {
      let requiredTextFields = ["name"]; // Add more required fields, but NOT "gap"
      let isFormValid = true;

      if (!isFormValid) {
          event.preventDefault(); // Prevent form submission
      }
  });
      // Validate radio buttons
      Object.keys(requiredRadioGroups).forEach((groupName) => {
          let radios = document.getElementsByName(groupName);
          let isChecked = Array.from(radios).some(radio => radio.checked);
          if (!isChecked) {
              missingFields.push(requiredRadioGroups[groupName]);
              isFormValid = false;
          }
      });

      if (!isFormValid) {
          alert("Please fill in all mandatory fields.\n- " + missingFields.join("\n- "));
          event.preventDefault(); // Prevent form submission
      }
  });
</script>




    