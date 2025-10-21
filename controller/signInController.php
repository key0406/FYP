<?php
require_once("sql.php");
require_once("../model/login.php");

session_start();

if(isset($_POST["email"])){
  $email = $_POST["email"];
}
else{
  $email = "";
}
if(isset($_POST["username"])){
  $username = $_POST["username"];
}
else{
  $username = "";
}
if(isset($_POST["password"])){
  $password = $_POST["password"];
}
else{
  $password = "";
}
if(isset($_POST["role"])){
  $role = $_POST["role"];
}
else{
  $role = "";
}

$exists = userExists($email, $username);
$emailExists = $exists["email"];
$usernameExists = $exists["username"];

if ($emailExists || $usernameExists) {
    if ($emailExists) {
        $_SESSION['error_email'] = "This email is already used";
    }
    if ($usernameExists) {
        $_SESSION['error_username'] = "This username is already used.";
    }
    header("Location: ../view/signIn.php");
    exit();
}

$login = new Login();
$login->email = $email;
$login->username = $username;
$login->password = $password;
$login->role = $role;
try {
  addLogin($login);
  $_SESSION['success'] = "Register Success!";
} catch (Exception $e) {
  die("Database Insert Error: " . $e->getMessage());
}


header("Location: ../view/login.php");
exit;

?>