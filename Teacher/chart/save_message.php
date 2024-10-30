<?php
// Simulated server-side operation to save message to a JSON file
$message = json_decode(file_get_contents("php://input"), true)["message"];
$file = "messages.json";
$currentMessages = json_decode(file_get_contents($file), true)["messages"];
$currentMessages[] = $message;
file_put_contents($file, json_encode(["messages" => $currentMessages]));
http_response_code(200);
?>
