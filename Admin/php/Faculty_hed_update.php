<?php

include "../../config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Check if the faculty name and faculty ID are set in the form submission
    if (isset($_POST['faculty_hed']) && isset($_POST['Update_Faculty'])) {
        // Sanitize input data
        $new_faculty_name = mysqli_real_escape_string($conn, $_POST['faculty_hed']);
        $faculty_id = $_POST['Update_Faculty'][0]; // Assuming only one faculty can be updated at a time

        // Prepare and execute the SQL update query
        $query = "UPDATE faculty_hed SET faculty_head = ? WHERE `faculty_hed`.`id` = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("si", $new_faculty_name, $faculty_id);

        if ($stmt->execute()) {
            // Redirect back to the page where the update form was submitted
            header("Location: ../fc.php");
            exit();
        } else {
            // Handle database update error
            echo "Failed to update faculty head. Please try again.";
        }
    } else {
        // Handle missing form data error
        echo "Missing form data. Please make sure all fields are filled.";
    }
} else {
    // Redirect back to the form page if accessed directly without form submission
    header("Location: ../fc.php");
    exit();
}
?>




