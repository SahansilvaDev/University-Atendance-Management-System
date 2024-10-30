<?php  
include "../../config.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    function handle_file_upload($file_field) {
        if (!empty($_FILES[$file_field]['name']) && $_FILES[$file_field]['error'] == UPLOAD_ERR_OK) {
            $upload_dir = "../upload/Faculty_img/";
            
            // Ensure the directory exists, if not create it
            if (!file_exists($upload_dir) && !is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }
    
            if (is_dir($upload_dir) && is_writable($upload_dir)) {
                $file_name = uniqid() . '_' . basename($_FILES[$file_field]['name']);
                $file_path = $upload_dir . $file_name;
    
                if (move_uploaded_file($_FILES[$file_field]['tmp_name'], $file_path)) {
                    return $file_path;
                } else {
                    return null;
                }
            } else {
                return null; // Directory not writable
            }
        } else {
            return null; // No file uploaded or other errors
        }
    }
    

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $faculty_code = test_input($_POST['faculty_code']);
    $faculty_name = test_input($_POST['faculty_name']);
    $faculty_description = test_input($_POST['faculty_description']);
    $faculty_image = handle_file_upload('faculty_image');

    if ($faculty_image !== null) {
        $stmt = $conn->prepare("INSERT INTO faculty (faculty_code, faculty_name, faculty_description, faculty_image) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $faculty_code, $faculty_name, $faculty_description, $faculty_image);
        if ($stmt->execute()) {
            $stmt->close();
            echo "Data inserted successfully.";
            header("Location:../faculty.php");
        } else {
            echo "Failed to insert data into the database.";
        }
    } else {
        echo "Failed to upload file.";
    }
}
?>


