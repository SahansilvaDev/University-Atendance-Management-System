<?php
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'attended_system';

$conn = new mysqli($hostname, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $code = $_POST['code'];

    // Set not_expired to 0 and expired to 1
    $stmt = $conn->prepare("UPDATE qr_codes SET not_expired = 0, expired = 1 WHERE code = ?");
    $stmt->bind_param("i", $code);

    if ($stmt->execute()) {
        echo "QR Code updated successfully!";
    } else {
        echo "Error updating QR Code: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
    exit;
}
?>
