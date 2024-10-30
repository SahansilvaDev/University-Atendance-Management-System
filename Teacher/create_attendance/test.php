<?php



?>




<?php
include '../../config.php';

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $t_sql = "SELECT * FROM teacher WHERE user_id = '$user_id' ";

    $sql = "SELECT * FROM degree_module";
    $result = $conn->query($sql);

    $sql1 = "SELECT * FROM degree_module";
    $result1 = $conn->query($sql1);

    $sql_b = "SELECT * FROM student";
    $result_b = $conn->query($sql_b);

    $sql_b1 = "SELECT * FROM student";
    $result_b1 = $conn->query($sql_b1);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming $conn is your database connection
    $subject_select = $_POST['subject_select'];
    $subject_code = $_POST['subject_code']; 
    $batch = $_POST['batch_id'];
    $batch_year = $_POST['batch_year'];
    $switch_btn = isset($_POST['switch_btn']) ? 1 : 0;
    $time = $_POST['time'];
    $qr_date = $_POST['qr_date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $subject_time = $_POST['subject_time'];
    $qr_code = $_POST['qr_code'];

    $courseName = "";
    $courseCode = "";
    $batchYearText1 = "";
    $batchYearText = "";

    // Fetch course name and batch-year from the database based on IDs
    $courseQuery = $conn->query("SELECT course_name FROM courses WHERE id = '$subject_select'");
    $courseCode = $conn->query("SELECT course_code FROM courses WHERE id = '$subject_code'");
    $batchYearQuery1 = $conn->query("SELECT batch  FROM student WHERE id = '$batch'");
    $batchYearQuery = $conn->query("SELECT batch, year FROM student WHERE id = '$batch_year'");

    if ($courseQuery && $courseCode && $batchYearQuery) {
        $courseData = $courseQuery->fetch_assoc();
        $courseData1 = $courseCode->fetch_assoc();
        $batchYearData1 = $batchYearQuery1->fetch_assoc();
        $batchYearData = $batchYearQuery->fetch_assoc();

        $courseName = $courseData['course_name'];
        $courseCode = $courseData1['course_code'];
        $batchYearText1 = $batchYearData1['batch'];
        $batchYearText = $batchYearData['year'] . " - " . $batchYearData['batch'];


    
            $data ="$courseName, $courseCode, $batchYearText1, $batchYearText, $switch_btn, $time, $qr_date, $start_time, $end_time, $subject_time, $qr_code, $expired, $user_id";

            
          
            // Close statement
            $stmt->close();
        }
    } else {
        echo "Error fetching data from the database.";
    }
    
    // Close connection
    $conn->close();
}


  

       






