<?php
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'attended_system';

$conn = new mysqli($hostname, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();

// Access and print session variables
if (isset($_SESSION['t_id']) && isset($_SESSION['f_name'])) {
    $user_id = $_SESSION['t_id'] ;;
    $username =  $_SESSION['f_name'];

  



    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $code = $_POST['code'];
        $expirationTime = $_POST['expiration_time'];
        $startTime = $_POST['startTime'];

        $not_expired = 1;
        $expired = 0;

        $stmt = $conn->prepare("INSERT INTO qr_codes (code, not_expired, expired, time) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("siid", $code, $not_expired, $expired, $expirationTime);

        if ($stmt->execute()) {
            echo "QR Code saved successfully!";
        } else {
            echo "Error saving QR Code: " . $stmt->error;
        }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $code = $_POST['code'];
        $expirationTime = $_POST['expiration_time'];
        $startTime = $_POST['start_time'];  

        $not_expired = 1;
        $expired = 0;

        $stmt = $conn->prepare("INSERT INTO qr_codes (code, not_expired, expired, time, start_time, t_id, t_name) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("siiddss", $code, $not_expired, $expired, $expirationTime, $startTime, $user_id, $username);

        if ($stmt->execute()) {
            echo "QR Code saved successfully!";
        } else {
            echo "Error saving QR Code: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
        exit;
    }

 


    
        // if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //     $code = $_POST['code'];
        //     $expirationTime = $_POST['expiration_time'];
        //     $startTime = $_POST['start_time'];
        //     $timeLine = $_POST['time_line_value'];
    
        //     $not_expired = 1;
        //     $expired = 0;
    
        //     $checkStmt = $conn->prepare("SELECT code FROM qr_codes WHERE code = ?");
        //     $checkStmt->bind_param("s", $code);
        //     $checkStmt->execute();
        //     $checkResult = $checkStmt->get_result();
        //     $checkStmt->close();
    
        //     if ($checkResult->num_rows > 0) {
        //         $updateStmt = $conn->prepare("UPDATE qr_codes SET start_time = ? WHERE code = ?");
        //         $updateStmt->bind_param("ss", $startTime, $code);
    
        //         if ($updateStmt->execute()) {
        //             echo "Start time updated successfully!";
        //         } else {
        //             echo "Error updating start time: " . $updateStmt->error;
        //         }
    
        //         $updateStmt->close();
        //     } else {
        //         $stmt = $conn->prepare("INSERT INTO qr_codes (code, not_expired, expired, time, start_time, range, t_id, t_name) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        //         $stmt->bind_param("siiddssi", $code, $not_expired, $expired, $expirationTime, $startTime, $timeLine, $user_id, $username);
    
        //         if ($stmt->execute()) {
        //             echo "QR Code saved successfully!";
        //         } else {
        //             echo "Error saving QR Code: " . $stmt->error;
        //         }
    
        //         $stmt->close();
        //     }
    
        //     $conn->close();
        //     exit;
        // }
    }
}
    ?>