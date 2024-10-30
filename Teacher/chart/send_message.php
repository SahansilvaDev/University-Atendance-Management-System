<?php
include '../../config.php'; 



// Receive data from the client
$data = json_decode(file_get_contents('php://input'), true);
$message = isset($data['message']) ? mysqli_real_escape_string($conn, $data['message']) : '';

// Insert message into the database
if ($message !== '') {
    $sender = 'Student'; // Assuming the sender is always the student
    $sql = "INSERT INTO messages (sender, message) VALUES ('$sender', '$message')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Error inserting message into database']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Message cannot be empty']);
}

// Close the connection
mysqli_close($conn);
?>
