<?php
session_start();

if (!isset($_SESSION['sender_id'])) {
    echo json_encode(["error" => "User not logged in"]);
    exit();
}
$sender_id = $_GET['sender_id'];
$receiver_id = $_GET['receiver_id'] ?? null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chat</title>
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
    <script src="../controller/message.js" defer></script>
    <style>
 body {
            background-color: #fdeef2;
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .chat-container {
            width: 100%;
            height: 100vh;
            max-width: 100%;
            display: flex;
            flex-direction: column;
            background: white;
        }
        .chat-header {
            background: #f8f9fa;
            padding: 15px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #ccc;
        }
        .chat-header img {
            width: 50px;
            height: 50px;
            margin-right: 10px;
        }
        .chat-body {
            flex: 1;
            overflow-y: auto;
            padding: 15px;
            display: flex;
            flex-direction: column;
            background-color: #fdeef2;
        }
        .message-wrapper {
            display: flex;
            margin-bottom: 12px;
        }
        .message {
            margin-bottom: 10px; /* Adds space between messages */
            padding: 10px;
            border-radius: 10px;
            max-width: 80%;
        }
        /* Sender's messages (right side) */
        .sender-wrapper {
            justify-content: flex-end;
        }
        .sender {
            background-color: #bbdefb;
            border-radius: 15px 15px 0px 15px;
            align-self: flex-end;
        }
        .sender::after {
            content: "";
            position: absolute;
            bottom: 0;
            right: -10px;
            border-width: 10px 0 0 10px;
            border-color: transparent transparent transparent #bbdefb;
            border-style: solid;
        }
        /* Receiver's messages (left side) */
        .receiver-wrapper {
            justify-content: flex-start;
        }
        .receiver {
            background-color: #cfd8dc;
            border-radius: 15px 15px 15px 0px;
            align-self: flex-start;
        }
        .receiver::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: -10px;
            border-width: 10px 10px 0 0;
            border-color: transparent #cfd8dc transparent transparent;
            border-style: solid;
        }
        .chat-footer {
            background: #f8f9fa;
            padding: 15px;
            display: flex;
            align-items: center;
            border-top: 1px solid #ccc;
        }
        .chat-footer input {
            flex: 1;
            padding: 12px;
            border-radius: 20px;
            border: 1px solid #ccc;
            margin-right: 10px;
        }
        .chat-footer button {
            background: black;
            color: white;
            border: none;
            padding: 12px 18px;
            border-radius: 50%;
            font-size: 18px;
        }
        .chat-footer .attachment-btn {
            background: transparent;
            border: none;
            font-size: 20px;
            color: black;
            margin-right: 10px;
        }
    </style>
</head>
<body>

<div class="chat-container">
    <div class="chat-header">
        <div class="d-flex align-items-center">
            <img src="logo.png" alt="Logo">
            <h5 class="mb-0">Chat with Doctor</h5>
        </div>
    </div>
    <div class="chat-body" id="chatBox">
    </div>
    <div class="chat-footer">
        <form id="chatForm">
            <button type="button" class="attachment-btn" onclick="sendAttachment()">+</button>
            <input type="hidden" id="sender_id" value="<?php echo isset($_SESSION['sender_id']) ? $_SESSION['sender_id'] : ''; ?>">
            <input type="hidden" id="receiver_id" value="<?php echo isset($receiver_id) ? htmlspecialchars($receiver_id) : ''; ?>">
            <input type="text" id="messageInput" name="message" placeholder="Enter the comment">
            <button type="submit" id="sendButton">Send</button>
        </form>
    </div>
</div>

<script>
function sendAttachment() {
    alert("ファイル添付機能は未実装です。");
}
</script>
</body>
</html>
