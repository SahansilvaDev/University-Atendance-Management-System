<?php  

include "../../config.php";

session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assign sanitized values to variables
    $teacher_id = $_POST['teacher_id'];
    $t_name = $_POST['teacher_name'];
    $degree_code = $_POST['degree_code'];
    $degree_name = $_POST['degree_name'];
    $module_code = $_POST['module_code'];
    $module_name = $_POST['module_name']; 
    $faculty_code = $_POST['faculty_code']; 
    $faculty_name = $_POST['faculty_name'];
    
        
    // Prepare the first SQL statement for inserting into 't_module' table
    $stmt = $conn->prepare("INSERT INTO t_module (t_user_id, t_name, degree_code, module_code, module_name, Faculty_code) VALUES (?, ?, ?, ?, ?, ?)");

    // Check if the statement preparation was successful
    if ($stmt === false) {
        die('Error in preparing SQL statement: ' . $conn->error);
    }

    // Bind parameters to the first statement
    $stmt->bind_param("ssssss", $teacher_id, $t_name, $degree_code, $module_code, $module_name, $faculty_code);

    // Execute the first statement
    if ($stmt->execute()) {
        // Close the first statement
        $stmt->close();

        // Prepare the second SQL statement for inserting into 'degree_module' table
        $stmt1 = $conn->prepare("INSERT INTO degree_module (degree_code, degree_name, module_code, module_name, Faculty_code, Faculty_name) VALUES (?, ?, ?, ?, ?, ?)");

        // Check if the second statement preparation was successful
        if ($stmt1 === false) {
            die('Error in preparing SQL statement: ' . $conn->error);
        }

        // Bind parameters to the second statement
        $stmt1->bind_param("ssssss", $degree_code, $degree_name, $module_code, $module_name, $faculty_code, $faculty_name);

        // Execute the second statement
        if ($stmt1->execute()) {
            // Redirect back to the page where the update form was submitted
            header("Location: ../cc_asign.php");
            exit();
        } else {
            // Handle database update error for the second statement
            echo "Failed to insert into degree_module. Please try again.";
        }

        // Close the second statement
        $stmt1->close();
    } else {
        // Handle database update error for the first statement
        echo "Failed to insert into t_module. Please try again.";
    }
}

    // Close the database connection
    $conn->close();
    ?>

