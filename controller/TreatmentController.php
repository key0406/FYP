<?php
require_once ("sql.php");

// This will convert base64 data to png 
function decodeBase64Image($base64String, $filePath) {
    if (empty($base64String)) {
        return null;
    }

    // Remove metadata if present
    $base64String = preg_replace('/^data:image\/\w+;base64,/', '', $base64String);
    $decodedData = base64_decode($base64String);
    if($decodedData === false) return null;
    $saved = file_put_contents($filePath, $decodedData);
    if($saved === false) return null;
    return $filePath;
}
if(isset($_POST["p_id"])){
    $p_id = $_POST["p_id"];
}
else{
    $p_id = "";
}
if(isset($_POST["p_name"])){
    $p_name = $_POST["p_name"];
}
else{
    $p_name = "";
}
if(isset($_POST["sex"])){
    $sex = $_POST["sex"];
}
else{
    $sex = "";
}
if(isset($_POST["p_koos"])){
    $p_koos = $_POST["p_koos"];
}
else{
    $p_koos = "";
}
if(isset($_POST["p_diagnosis"])){
    $p_diagnosis = $_POST["p_diagnosis"];
}
else{
    $p_diagnosis = "";
}
if(isset($_POST["treatment_1"])){
    $treatment_1 = $_POST["treatment_1"];
}
else{
    $treatment_1 = "";
}
if(isset($_POST["p_goal_1"])){
    $p_goal_1 = $_POST["p_goal_1"];
}
else{
    $p_goal_1 = "";
}
if(isset($_POST["p_time_1"])){
    $p_time_1 = $_POST["p_time_1"];
}
else{
    $p_time_1 = "";
}
if(isset($_POST["treatment_2"])){
    $treatment_2 = $_POST["treatment_2"];
}
else{
    $treatment_2 = "";
}
if(isset($_POST["p_goal_2"])){
    $p_goal_2 = $_POST["p_goal_2"];
}
else{
    $p_goal_2 = "";
}
if(isset($_POST["p_time_2"])){
    $p_time_2 = $_POST["p_time_2"];
}
else{
    $p_time_2 = "";
}
if(isset($_POST["treatment_3"])){
    $treatment_3 = $_POST["treatment_3"];
}
else{
    $treatment_3 = "";
}
if(isset($_POST["p_goal_3"])){
    $p_goal_3 = $_POST["p_goal_3"];
}
else{
    $p_goal_3 = "";
}
if(isset($_POST["p_time_3"])){
    $p_time_3 = $_POST["p_time_3"];
}
else{
    $p_time_3 = "";
}
if(isset($_POST["r_1"])){
    $r_1 = $_POST["r_1"];
}
else{
    $r_1 = "";
}
if(isset($_POST["r_goal"])){
    $r_goal = $_POST["r_goal"];
}
else{
    $r_goal = "";
}
if(isset($_POST["r_2"])){
    $r_2 = $_POST["r_2"];
}
else{
    $r_2 = "";
}
if(isset($_POST["r_goal_2"])){
    $r_goal_2 = $_POST["r_goal_2"];
}
else{
    $r_goal_2 = "";
}
if(isset($_POST["c_1"])){
    $c_1 = $_POST["c_1"];
}
else{
    $c_1 = "";
}
if(isset($_POST["c_2"])){
    $c_2 = $_POST["c_2"];
}
else{
    $c_2 = "";
}
if(isset($_POST["c_3"])){
    $c_3 = $_POST["c_3"];
}
else{
    $c_3 = "";
}
if(isset($_POST["rb_1"])){
    $rb_1 = $_POST["rb_1"];
}
else{
    $rb_1 = "";
}
if(isset($_POST["rb_2"])){
    $rb_2 = $_POST["rb_2"];
}
else{
    $rb_2 = "";
}
if(isset($_POST["signature_patient"])){
    $patientFilePath = '../patient_signature/patient_signature_' . time() . '.png';
    $signature_patient = $_POST["signature_patient"];
    $signature_patient = decodeBase64Image($signature_patient, $patientFilePath);
}
else{
    $signature_patient = "";
}
if(isset($_POST["p_date"])){
    $p_date = $_POST["p_date"];
    $p_date = DateTime::createFromFormat('d/m/Y', $p_date)->format('Y-m-d');
}
else{
    $p_date = "";
}
if(isset($_POST["signature_doctor"])){
    $doctorFilePath = '../doctor_signature/doctor_signature_' . time() . '.png';
    $signature_doctor = $_POST["signature_doctor"];
    $signature_doctor = decodeBase64Image($signature_doctor, $doctorFilePath);

}
else{
    $signature_doctor = "";
}
if(isset($_POST["d_date"])){
    $d_date = $_POST["d_date"];
    $d_date = DateTime::createFromFormat('d/m/Y', $d_date)->format('Y-m-d');
}
else{
    $d_date = "";
}

#SQL
$sql = connectdb();
if(!$sql) exit("DB connection failed");
$table_col = "p_id, p_name, sex, p_koos, p_diagnosis, treatment_1, p_goal_1, p_time_1, treatment_2, p_goal_2, p_time_2, treatment_3, p_goal_3, p_time_3, r_1, r_goal, r_2, r_goal_2, c_1, c_2, c_3, rb_1, rb_2, signature_patient, p_date, signature_doctor, d_date";
$stmt = $sql->prepare("INSERT INTO treatment_plan ($table_col) VALUES (".substr(str_repeat("?, ",27),0,-2). ")");
$values = [$p_id,$p_name, $sex, $p_koos, $p_diagnosis, $treatment_1, $p_goal_1, $p_time_1,$treatment_2, $p_goal_2, $p_time_2,$treatment_3, $p_goal_3, $p_time_3, $r_1, $r_goal, $r_2, $r_goal_2, $c_1, $c_2,$c_3,$rb_1, $rb_2, $signature_patient, $p_date,$signature_doctor,$d_date];
$register = $stmt->execute($values);
if (!$register) exit('DB Registration Error');
$sql = null;

//var_dump($patientSignature, $doctorSignature);




header("Location: ../view/treatment_result.php");
// Fetch the signature data
/*$stmt = $sql->prepare("SELECT signature_patient, signature_doctor FROM treatment_plan WHERE id = ?");
$stmt->execute([1]); // Replace with the correct ID
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row) {
    // Decode Base64 and save as PNG
    //Otherwise it is not possible to view the signature from DB
    $patientSignature = $row['signature_patient'];
    $doctorSignature = $row['signature_doctor'];

    // Remove the Base64 metadata if present
    $patientSignature = preg_replace('/^data:image\/\w+;base64,/', '', $patientSignature);
    $patientSignature = base64_decode($patientSignature);

    $doctorSignature = preg_replace('/^data:image\/\w+;base64,/', '', $doctorSignature);
    $doctorSignature = base64_decode($doctorSignature);

    // Save images
    file_put_contents('patient_signature.png', $patientSignature);
    file_put_contents('doctor_signature.png', $doctorSignature);

    echo "Signatures saved as PNG files!";
} else {
    echo "No signature data found!";
}
    */
    ?>