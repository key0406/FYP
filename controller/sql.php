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

/*function chatRequest($doctor, $patient){
    global $pdo;
    $statement = $pdo->prepare("SELECT * FROM chat_requests WHERE doctor_email = ? AND patient_email = ? AND status = 'approved'");
    $statement->execute([$doctor, $patient]);
    return $statement->rowCount() > 0;
}
    */

function receiverMessage($receiver){
    global $pdo;
    $statement = $pdo->prepare("SELECT role FROM login WHERE email = :receiver_id");
    $statement->execute([':receiver_id' => $receiver]);
    $results = $statement->fetch(PDO::FETCH_ASSOC);
    return $results;
}

function sendMessage($sender){
    global $pdo;
    $statement = $pdo->prepare("SELECT role FROM login WHERE email = :sender_id");
    //This is for the sender_id does not exist in the login so set as a placeholder
    $statement->execute([':sender_id' => $sender]);
    $results = $statement->fetch(PDO::FETCH_ASSOC);
    return $results;
}

function addChat($sender, $receiver, $message){
    global $pdo;
    try {
        $insert = $pdo->prepare("INSERT INTO messages (sender_id, receiver_id, message, date) VALUES (?,?,?,NOW())");
        $insert->execute([$sender, $receiver, $message]);
        return ["status" => "success"];
    } catch (Exception $e) {
        error_log("Error inserting chat: " . $e->getMessage());
        return ["status" => "error", "message" => "Could not send message"];
    }
}


function getChatHistory($patient, $doctor){
    global $pdo;
    $statement = $pdo->prepare("SELECT * FROM messages WHERE 
        (sender_id = ? AND receiver_id = ?) OR (sender_id = ? AND receiver_id = ?) 
        ORDER BY date ASC");
    $statement->execute([$patient, $doctor, $doctor, $patient]);
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}


function getAllChatHistory(){
    global $pdo;
    $statement = $pdo->prepare("SELECT * FROM messages");
    $statement->execute();
    $results = $statement->fetchAll(PDO::FETCH_CLASS, "Messages");
    return $results;
}

function doesReceiverExist($receiver_id){
    global $pdo;
    $statement = $pdo->prepare("SELECT id FROM login WHERE id = ?");
    $statement->execute([$receiver_id]);
    if ($statement->rowCount() == 0) {
        echo json_encode(["error" => "Receiver does not exist"]);
        exit;
    }
} 

function addTreatment(){
    global $pdo;
    
}

function closedb($db) {
    $db -> close();
}
?>