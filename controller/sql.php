<?php
$pdo = new PDO("mysql:host=sql301.infinityfree.com;dbname=if0_38042181_db_fyp", 
"if0_38042181", "xR6KY9yUHWhiD",
[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]                                   
);

function connectdb() {
    $user = "if0_38042181";
    $pass = "xR6KY9yUHWhiD";
    $sql = new PDO("mysql:host=sql301.infinityfree.com;dbname=if0_38042181_db_fyp", $user, $pass);
    return $sql;
}
//Login
function getLogin($email){
    global $pdo;
    $statement = $pdo->prepare("SELECT email, password, role FROM login WHERE email = ?");
    $statement->execute([$email]);
    $results = $statement->fetchObject("Login2");
    return $results;
}
function addLogin($login){
    global $pdo;
    if($login != null){
        $hash_pass = password_hash($login->password, PASSWORD_DEFAULT);
        $insert = $pdo->prepare("INSERT INTO login (email, username, password, role) VALUES (?, ?, ?, ?)");
        $insert->execute([$login->email, $login->username, $hash_pass, $login->role]);
    }
}

function getAllPatients(){
    global $pdo;
    $statement = $pdo->prepare("SELECT * FROM survey");
    $statement->execute();
    $results = $statement->fetchAll(PDO::FETCH_CLASS,"survey");
    return $results;
}
#Cheese search function (1st functional requirement)
/*function getPatientByID($id){
    global $pdo;
    $statement = $pdo->prepare("SELECT * FROM survey WHERE id = ?");
    $statement->execute([$id]);
    $results = $statement->fetchAll(PDO::FETCH_CLASS, "survey");
    return $results[0];
}
    */
/*function getPatientByName($name){
    global $pdo;
    $statement = $pdo->prepare("SELECT * FROM survey WHERE name = ?");
    $statement->execute([$name]);
    $results = $statement->fetchAll(PDO::FETCH_CLASS, "survey");
    return $results;
}
    */
#cheeseNameAJAX
/*function getPatientByStartOfName($partialPatientName)
{
  global $pdo;
  $statement = $pdo->prepare('SELECT DISTINCT cheeseName FROM cheese
                              WHERE cheeseName LIKE ?');
  $partialCheeseNameWithWildCard = $partialCheeseName."%";
  $statement->execute([$partialCheeseNameWithWildCard]);
  $cheese = $statement->fetchAll(PDO::FETCH_COLUMN,0);
  return $cheese;
}
  */

function getPatientBySex($sex){
    global $pdo;
    $statement = $pdo->prepare("SELECT * FROM survey WHERE sex = ?");
    $statement->execute([$sex]);
    $results = $statement->fetchAll(PDO::FETCH_CLASS, "survey");
    return $results;
}

function getPatientByAge($age){
    global $pdo;
    $statement = $pdo->prepare("SELECT * FROM survey WHERE age = ?");
    $statement->execute([$age]);
    $results = $statement->fetchAll(PDO::FETCH_CLASS, "survey");
    return $results;
}

function getPatientByGap($gap){
    global $pdo;
    $statement = $pdo->prepare("SELECT * FROM survey WHERE gap = ?");
    $statement->execute([$gap]);
    $results = $statement->fetchAll(PDO::FETCH_CLASS, "survey");
    return $results;
}

function getPatientByKOOS($koos){
    global $pdo;
    $statement = $pdo->prepare("SELECT * FROM survey WHERE koos = ?");
    $statement->execute([$koos]);
    $results = $statement->fetchAll(PDO::FETCH_CLASS, "survey");
    return $results;
}

function getPatientByFKOOS($f_koos){
    global $pdo;
    $statement = $pdo->prepare("SELECT * FROM survey WHERE f_koos = ?");
    $statement->execute([$f_koos]);
    $results = $statement->fetchAll(PDO::FETCH_CLASS, "survey");
    return $results;
}

function getComment($comment){
    global $pdo;
    $statement = $pdo->prepare("SELECT * FROM survey WHERE comment = ?");
    $statement->execute([$comment]);
    $results = $statement->fetchAll(PDO::FETCH_CLASS, "survey");
    return $results;
}

function getAllPatientTreatment(){
    global $pdo;
    $statement = $pdo->prepare("SELECT * FROM treatment_plan");
    $statement->execute();
    $results = $statement->fetchAll(PDO::FETCH_CLASS, "treatment");
    return $results;
}

function addTreatment(){
    global $pdo;
    
}

function closedb($db) {
    $db -> close();
}
?>