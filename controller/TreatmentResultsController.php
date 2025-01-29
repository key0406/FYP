<?php
require_once ("sql.php");
require_once ("../model/treatment.php");
$sql = connectdb();
if(!$sql) exit("Database connection failed");
try{
    //This is the query for just get the added treatment_plan just created by user
    $query = "SELECT * FROM treatment_plan ORDER BY id DESC LIMIT 1";
    $stmt = $sql->query($query);
    $treatments = $stmt->fetchAll(PDO::FETCH_ASSOC);
}catch (Exception $e) {
    exit("Database error: " . $e->getMessage());
}

$treatmentObjects = [];
foreach ($treatments as $data) {
    $treatment = new treatment();
    $treatment->id = $data['id'];
    $treatment->p_id = $data['p_id'];
    $treatment->p_name = $data['p_name'];
    $treatment->sex = $data['sex'];
    $treatment->p_koos = $data['p_koos'];
    $treatment->p_diagnosis = $data['p_diagnosis'];
    $treatment->treatment_1 = $data['treatment_1'];
    $treatment->p_goal_1 = $data['p_goal_1'];
    $treatment->p_time_1 = $data['p_time_1'];
    $treatment->treatment_2 = $data['treatment_2'];
    $treatment->p_goal_2 = $data['p_goal_2'];
    $treatment->p_time_2 = $data['p_time_2'];
    $treatment->treatment_3 = $data['treatment_3'];
    $treatment->p_goal_3 = $data['p_goal_3'];
    $treatment->p_time_3 = $data['p_time_3'];
    $treatment->r_1 = $data['r_1'];
    $treatment->r_goal = $data['r_goal'];
    $treatment->r_2 = $data['r_2'];
    $treatment->r_goal_2 = $data['r_goal_2'];
    $treatment->c_1 = $data['c_1'];
    $treatment->c_2 = $data['c_2'];
    $treatment->c_3 = $data['c_3'];
    $treatment->rb_1 = $data['rb_1'];
    $treatment->rb_2 = $data['rb_2'];
    $treatment->signature_patient = $data['signature_patient'];
    $treatment->p_date = $data['p_date'];
    $treatment->signature_doctor = $data['signature_doctor'];
    $treatment->d_date = $data['d_date'];
    $treatmentObjects[] = $treatment;
}
?>