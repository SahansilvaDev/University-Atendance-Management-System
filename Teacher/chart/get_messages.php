<?php
include '../../config.php'; 

// Establish database connection


// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve messages from the database
$sql = "SELECT * FROM messages ORDER BY id DESC";
$result = mysqli_query($conn, $sql);

$messages = [];
while ($row = mysqli_fetch_assoc($result)) {
    $messages[] = [
        'sender' => $row['sender'],
        'message' => $row['message']
    ];
}

// Close the connection
mysqli_close($conn);

// Set response header to JSON format
header('Content-Type: application/json');
// Send JSON response
echo json_encode($messages);
?>
