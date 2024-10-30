<?php
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'attended_system';

$conn = new mysqli($hostname, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Include your database connection code here

if (isset($_POST['subject'])) {
    $selectedSubject = $_POST['subject'];

    // Query to get the count of students for the selected subject
    $query = "SELECT COUNT(s_id) as student_count FROM students WHERE course = '$selectedSubject'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $studentCount = $row['student_count'];
        echo $studentCount;
    } else {
        echo 'Error executing query.';
    }
} else {
    echo 'Invalid request.';
}

?>
