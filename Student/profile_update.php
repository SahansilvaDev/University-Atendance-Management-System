<?php

session_start();

// $hostname = 'localhost';
// $username = 'root';
// $password = '';
// $database = 'ttc';

// $conn =  mysqli_connect($hostname, $username, $password, $database);

// if (!$conn) {
//     echo 'errors';
// }

include '../config.php';

if (isset($_POST['submit'])) {

    // Set the session popupDisplayed
    $_SESSION['popupDisplayed'] = true;

    // Assuming you stored the student ID in the session earlier
    $s_id = $_SESSION['user_id'];

    $name = test_input($_POST['name']);
    // $email = test_input($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    // $batch = test_input($_POST['batch']);
    // $degree = test_input($_POST['degree_programe']);
    $address =test_input( $_POST['address']);
    $tp = test_input($_POST['tp']);
    $nic = test_input($_POST['nic']);
    $dob = test_input($_POST['dob']);
    $finger = test_input($_POST['finger']);


    $target_file = ""; // Initialize $target_file

    if (isset($_FILES["file1"]) && $_FILES["file1"]["size"] > 0) {
        $target_dir = "./uploads/";
        $target_file = $target_dir . basename($_FILES["file1"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a valid image
        if (!getimagesize($_FILES["file1"]["tmp_name"])) {
            echo "File is not a valid image.";
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["file1"]["size"] > 50000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        $allowedFormats = ["jpg", "jpeg", "png", "gif", "webp"];
        if (!in_array($imageFileType, $allowedFormats)) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            // if everything is ok, try to upload file
            if (move_uploaded_file($_FILES["file1"]["tmp_name"], $target_file)) {
                echo "The file " . htmlspecialchars(basename($_FILES["file1"]["name"])) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    // Corrected SQL query
    $sql = "UPDATE student SET name='$name',  password='$password', degree_programe='$degree', address='$address', phone_number='$tp', nic='$nic', dob='$dob', profile_img='$target_file', fingerprint='$finger' WHERE user_id='$s_id'";
    $s_result = mysqli_query($conn, $sql);

    if ($s_result) {
        // If the form is submitted successfully, disable the popup permanently
        $_SESSION['popupDisabled'] = true;
        
        header("Location:./index.php");

    } else {
        echo 'Error updating student record: ' . mysqli_error($conn);
    }
} else {
    echo "Form not submitted.";
}

// Close the database connection
mysqli_close($conn);


function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = strtolower($data);
    return $data;
}
?>


