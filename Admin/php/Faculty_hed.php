<?php  
include "../../config.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function generateUserId()
    {
        global $conn;
        $query = "SELECT COUNT(*) AS faculty_hed FROM faculty_hed ";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $faculty_hed = $row['faculty_hed'];

        $formatted_id = sprintf("FH%05d", $faculty_hed + 1);

        return $formatted_id;
    }

    $faculty_code = test_input($_POST['faculty_code']);
    $faculty_name = test_input($_POST['faculty_name']);
    $faculty_head = test_input($_POST['faculty_head']);
    $facluty_hed_code = generateUserId();

    $stmt = $conn->prepare("INSERT INTO faculty_hed (facluty_hed_code, faculty_code, faculty_name, faculty_head) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $facluty_hed_code, $faculty_code, $faculty_name, $faculty_head);
    if ($stmt->execute()) {
        $stmt->close();
        echo "Data inserted successfully.";
        header("Location:../fc.php");
        exit(); 
    } else {
        echo "Failed to insert data into the database.";
    }
} else {
    echo "Failed ";
}
?>
