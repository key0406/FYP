<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header("Content-Type: application/json");

require_once("sql.php");
require_once("../model/message.php");

session_start();

$sender_id = $_SESSION['sender_id'] ?? $_GET['sender_id'] ?? null;
$receiver_id = $_GET['receiver_id'] ?? null;

if (!$sender_id) {
    echo json_encode(["error" => "Sender ID is missing"]);
}

$messages = getChatHistory($sender_id, $receiver_id);

if (!$messages) {
    echo json_encode(["status" => "success", "messages" => []]); // Always return an array
} else {
    echo json_encode(["status" => "success", "messages" => $messages]);
}


$chatObjects = [];
foreach ($messages as $chatData) {
    if (is_array($chatData)) {
        // Already an array, use as is
        $chatObjects[] = $chatData;
    } elseif ($chatData instanceof Messages) {
        // Convert object to an array manually
        $chatObjects[] = [
            "id" => $chatData->id,
            "sender_id" => $chatData->sender_id,
            "receiver_id" => $chatData->receiver_id,
            "message" => $chatData->message,
            "date" => $chatData->date
        ];
    } else {
        echo json_encode(["error" => "Unexpected data format"]);
        exit();
    }
}

echo json_encode(["status" => "success", "messages" => $chatObjects]);

exit();
