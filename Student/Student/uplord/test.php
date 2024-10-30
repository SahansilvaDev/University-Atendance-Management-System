
<?php
session_start();
// Start or resume the session


// Establish database connection
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'attended_system';

$conn = new mysqli($hostname, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data based on the session ID
if (isset($_SESSION['f_name'])) {
    $f_name = $_SESSION['f_name'];
    $s_id = $_SESSION['s_id'];
    

    // Retrieve course, course_id, module, t_id, and code from students, qr_data, and qr_codes tables
    $query = "SELECT s.course, s.course_id, q.module, q.t_id, c.code, m.faculty
              FROM students s
              JOIN qr_data q ON s.course = q.module
              LEFT JOIN qr_codes c ON q.t_id = c.t_id
              LEFT JOIN module m ON s.course_id = m.id
              WHERE s.s_id = ?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $s_id);
    $stmt->execute();

    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    // If course_id is found, retrieve the faculty from the module table
    if ($data['course_id']) {
        $courseId = $data['course_id'];

        $facultyQuery = "SELECT faculty FROM module WHERE module_code = ?";
        $facultyStmt = $conn->prepare($facultyQuery);
        $facultyStmt->bind_param("s", $courseId);
        $facultyStmt->execute();

        $facultyResult = $facultyStmt->get_result();
        $facultyData = $facultyResult->fetch_assoc();

        $data['faculty'] = $facultyData['faculty'];

        $facultyStmt->close();
    }

    // Find the date_and_time column in the qr_data table by the t_id
    $tId = $data['t_id'];

    $dateTimeQuery = "SELECT date_and_time FROM qr_data WHERE t_id = ?";
    $dateTimeStmt = $conn->prepare($dateTimeQuery);
    $dateTimeStmt->bind_param("s", $tId);
    $dateTimeStmt->execute();

    $dateTimeResult = $dateTimeStmt->get_result();
    $dateTimeData = $dateTimeResult->fetch_assoc();

    $data['date_and_time'] = $dateTimeData['date_and_time'];

    $dateTimeStmt->close();

    // Check if 'faculty' is null before accessing it
    if ($data['faculty'] === null) {
        $data['faculty'] = "N/A"; // Set a default value or handle it accordingly
    }

    // Separate data into individual keys in the JSON output
    $output = [
        'course' => $data['course'],
        'course_id' => $data['course_id'],
        'module' => $data['module'],
        't_id' => $data['t_id'],
        'code' => $data['code'],
        'faculty' => $data['faculty'],
        'date_and_time' => $data['date_and_time'],
    ];

    $output1 = [
       
        $data['code'],
        
    ];

    $jsonOutput = json_encode($output1, JSON_UNESCAPED_UNICODE);

            // Trim leading and trailing characters
            $jsonOutput = trim($jsonOutput, '[]{} "" ""');

            // echo $jsonOutput;


    // echo json_encode($output1);
    // echo json_encode($output);  




// Assuming $jsonOutput contains the expected code in JSON format
$expectedCode = $jsonOutput;
 // Replace with your actual expected code


if (isset($_POST['attend_on'])) {
    // Retrieve values from the input fields
    $input1 = $_POST['input1'];
    $input2 = $_POST['input2'];
    $input3 = $_POST['input3'];
    $input4 = $_POST['input4'];
    $input5 = $_POST['input5'];
    $input6 = $_POST['input6'];

    // Combine input values into a single string for comparison
    $typedCode = $input1 . $input2 . $input3 . $input4 . $input5 . $input6;

    // Compare the typed code with the expected code
    if ($typedCode == $expectedCode) {
        // Code is correct, redirect to result_attendance.php
        header("Location: ../result_attendance.php");
        
        exit();
    } else {
        // Code is wrong, display an error message
        $error_message = "Attend code is wrong";
    }
}

$stmt->close();
} else {
    echo "Session not set"; // Add an error message or redirection as needed
}
?>
