<?php
include './config.php';

// Assume you have a valid user ID or email to identify the user
$userEmail = "chathu19990702@gmail.com";

// Retrieve the token from the database based on the user's email
$stmt = $conn->prepare("SELECT token FROM students WHERE email = ?");
$stmt->bind_param("s", $userEmail);
$stmt->execute();
$stmt->bind_result($token);
$stmt->fetch();
$stmt->close();

if (!empty($token)) {
    // Send email with the token
    $subject = "Your Registration Token";
    $message = "Your registration token is: $token";
    $headers = "From: webmaster@example.com"; // Change this to your email address

    mail($userEmail, $subject, $message, $headers);

    echo "Token sent successfully to $userEmail.";
} else {
    echo "Token not found for $userEmail.";
}

$conn->close();
?>
