<?php
session_start();
header("Content-Type: application/json");
echo json_encode(["session_data" => $_SESSION]);
?>
