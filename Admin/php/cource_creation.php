<?php  

include "../../config.php";

session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Loop through $_POST array to sanitize each input individually
    foreach ($_POST as $key => $value) {
        $_POST[$key] = test_input($value);
    }

    // Assign sanitized values to variables
    $course_name = $_POST['course_name'];
    $course_code = $_POST['course_code'];
    $faculty_name = implode(',', $_POST['faculty_name']); // Convert array to comma-separated string
    $teacher_name = implode(',', $_POST['teacher_name']); // Convert array to comma-separated string
    $course_description = $_POST['course_description'];

    $stmt = $conn->prepare("INSERT INTO courses (course_name, course_code, faculty_name, teacher_name, course_description) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $course_name, $course_code, $faculty_name, $teacher_name, $course_description);
    $stmt->execute();
    $stmt->close();


    header("Location: ../cc_asign.php");
        exit();
}

function test_input($data) {
    global $conn; // Assuming $conn is your database connection variable
    if (is_array($data)) {
        foreach ($data as $key => $value) {
            $data[$key] = test_input($value);
        }
    } else {
        $data = isset($conn) ? $conn->real_escape_string($data) : $data;
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
    }
    return $data;
}

?>