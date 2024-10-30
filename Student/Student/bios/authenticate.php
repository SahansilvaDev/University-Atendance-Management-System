<?php

include './config.php';


$query = "SELECT * FROM fingerprints WHERE user_agent = ? AND resolution = ?";

$stmt = $conn->prepare($query);
$stmt->bind_param("ss", $data['userAgent'], $data['resolution']);
$stmt->execute();


$result = $stmt->get_result();

if ($result->num_rows > 0) {
    
    echo json_encode(["success" => true]);
} else {
    
    echo json_encode(["success" => false]);
}


$stmt->close();
$conn->close();
?>
