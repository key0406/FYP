<?php
if (!$_POST) exit('Unauthorized access');
require_once '../vendor/autoload.php';
use Stichoza\GoogleTranslate\GoogleTranslate;
require_once("sql.php");

if (!empty($_GET['lang'])) $lang = $_GET['lang'];
else $lang = 'en';
$path = '../lang_result/'.$lang.'.json';
$file = fopen($path, "r");
$json = fread($file, filesize($path));
$tls = json_decode($json, true);
/*#多言語化
if (!empty($_POST['lang'])) $lang = $_POST['lang'];
else $lang = 'en';
$file = fopen($path, "r");
$json = fread($file, filesize($path));
$tls = json_decode($json, true);
*/


if(isset($_POST["name"])){
    $name = $_POST["name"];
}
else{
    $name = "";
}
if(isset($_POST["sex"])){
    $sex = $_POST["sex"];
}
else{
    $sex = "";
}
if(isset($_POST["age"])){
    $age = $_POST["age"];
}
else{
    $age = "";
}
if(isset($_POST["gap"])){
    $gap = $_POST["gap"];
}
else{
    $gap = "";
}
if(isset($_POST["knee"])){
    $knee = $_POST["knee"];
}
else{
    $knee = "";
}
if(isset($_POST["p1"])){
    $p1 = $_POST["p1"];
}
else{
    $p1 = "";
}
if(isset($_POST["p2"])){
    $p2 = $_POST["p2"];
}
else{
    $p2 = "";
}
if(isset($_POST["p3"])){
    $p3 = $_POST["p3"];
}
else{
    $p3 = "";
}
if(isset($_POST["p4"])){
    $p4 = $_POST["p4"];
}
else{
    $p4 = "";
}
if(isset($_POST["f1"])){
    $f1 = $_POST["f1"];
}
else{
    $f1 = "";
}
if(isset($_POST["f2"])){
    $f2 = $_POST["f2"];
}
else{
    $f2 = "";
}
if(isset($_POST["f3"])){
    $f3 = $_POST["f3"];
}
else{
    $f3 = "";
}
if(isset($_POST["f4"])){
    $f4 = $_POST["f4"];
}
else{
    $f4 = "";
}
if(isset($_POST["q1"])){
    $q1 = $_POST["q1"];
}
else{
    $q1 = "";
}
if(isset($_POST["q2"])){
    $q2 = $_POST["q2"];
}
else{
    $q2 = "";
}
if(isset($_POST["q3"])){
    $q3 = $_POST["q3"];
}
else{
    $q3 = "";
}
if(isset($_POST["q4"])){
    $q4 = $_POST["q4"];
}
else{
    $q4 = "";
}

/*Google Translate API
$tr = new GoogleTranslate();
$tr->setSource('en'); 
$tr->setTarget($lang);
/*
$tr_e = new GoogleTranslate();
$tr_e->setsource($lang);
$tr_e->setTarget('en');
*/

#SQL
$sql = connectdb();
if (!$sql) exit("DB接続失敗");
$table_col = "name,sex,age,gap,knee,p1,p2,p3,p4,f1,f2,f3,f4,q1,q2,q3,q4";
$stmt = $sql->prepare("INSERT INTO survey ($table_col) VALUES (" . substr(str_repeat("?, ", 17), 0, -2) . ")");
$values = [$name, $sex, $age, $gap, $knee, $p1, $p2, $p3, $p4, $f1, $f2, $f3, $f4, $q1, $q2, $q3, $q4];
$register = $stmt -> execute($values);
if (!$register) exit('データベース登録エラー');
$sql = null;

// Calculate KOOS scores
$total_pain = $p1 + $p2 + $p3 + $p4;
$KOOS_pain = 100 - ($total_pain / (4 * 4)) * 100;

$total_function = $f1 + $f2 + $f3 + $f4;
$KOOS_function = 100 - ($total_function / (4 * 4)) * 100;

$total_quality_of_life = $q1 + $q2 + $q3 + $q4;
$KOOS_quality_of_life = 100 - ($total_quality_of_life / (4 * 4)) * 100;

$total_score = ($KOOS_pain + $KOOS_function + $KOOS_quality_of_life) / 3;

// 🔹 **ML Model Integration - Calling Flask API**
$flask_url = "https://koosml.onrender.com/predict"; // Update with your deployed Render URL

// Prepare JSON payload for Flask API
$ml_data = array(
    "features" => array(
        "P1" => $p1,
        "P2" => $p2,
        "P3" => $p3,
        "P4" => $p4,
        "f1" => $f1,
        "f2" => $f2,
        "f3" => $f3,
        "f4" => $f4,
        "q1" => $q1,
        "q2" => $q2,
        "q3" => $q3,
        "q4" => $q4,
        "Pain" => $KOOS_pain,
        "Function" => $KOOS_function,
        "QOL" => $KOOS_quality_of_life
    )
);

$options = array(
    "http" => array(
        "header" => "Content-Type: application/json\r\n",
        "method" => "POST",  // Ensure this is set to POST
        "content" => json_encode($ml_data),
    ),
);

var_dump($flask_url);

$context = stream_context_create($options);
var_dump($context);

$flask_url = "https://koosml.onrender.com/predict"; // Flask API URL

$ml_data = array(
    "features" => array(
        "P1" => (int)$p1,
        "P2" => (int)$p2,
        "P3" => (int)$p3,
        "P4" => (int)$p4,
        "f1" => (int)$f1,
        "f2" => (int)$f2,
        "f3" => (int)$f3,
        "f4" => (int)$f4,
        "q1" => (int)$q1,
        "q2" => (int)$q2,
        "q3" => (int)$q3,
        "q4" => (int)$q4,
        "Pain" => $KOOS_pain,
        "Function" => $KOOS_function,
        "QOL" => $KOOS_quality_of_life
    )
);

$ch = curl_init($flask_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($ml_data));

$ml_response = curl_exec($ch);
$http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE); // Get HTTP status code
$curl_error = curl_error($ch); // Get cURL error if any
curl_close($ch);

// Debugging: Print API Response and Status
//var_dump($http_status);
//var_dump($curl_error);
//var_dump($ml_response);

$prediction = json_decode($ml_response, true);
if (isset($prediction["prediction"][0])) {
    $predicted_score = $prediction["prediction"][0];
} else {
    $predicted_score = "N/A";
}

/*var_dump($predicted_score);
exit;


// Debugging: Check final extracted value
var_dump($predicted_score);
exit;


var_dump($ml_response);
$prediction = json_decode($ml_response, true);
var_dump($prediction);
$predicted_score = $prediction["prediction"][0] ?? 'N/A';
var_dump($predicted_score);
exit;
*/
// Redirect to results.php
header("Location: ../view/results.php?lang=$lang&total_pain=$KOOS_pain&total_func=$KOOS_function&total_qol=$KOOS_quality_of_life&total_score=$total_score&predicted_score=$predicted_score");
exit;
?>