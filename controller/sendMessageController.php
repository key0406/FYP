<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once("sql.php");

if (!isset($_SESSION['sender_id'])) {
    echo json_encode(["error" => "Session sender_id is not set"]);
    exit;
}

$sender_id = $_SESSION['sender_id'];
$receiver_id = $_POST['receiver_id'] ?? 'default_receiver';  // Assign default value if missing
$message = $_POST['message'] ?? '';

if ($message === '') {
    echo json_encode(["error" => "Message cannot be empty"]);
    exit;
}

// Store the chat using addChat() from sql.php
$success = addChat($sender_id, $receiver_id, $message);

if ($success) {
    echo json_encode(["status" => "success", "receiver_id" => $receiver_id, "message" => $message]);
} else {
    echo json_encode(["error" => "Database insert failed"]);
}
exit;
