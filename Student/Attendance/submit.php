<?php
include '../config.php';

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $t_sql = "SELECT * FROM teacher WHERE user_id = '$user_id' ";

    $sql = "SELECT * FROM courses";
    $result = $conn->query($sql);

    $sql1 = "SELECT * FROM courses";
    $result1 = $conn->query($sql1);

    $sql_b = "SELECT * FROM student";
    $result_b = $conn->query($sql_b);

    $sql_b1 = "SELECT * FROM student";
    $result_b1 = $conn->query($sql_b1);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming $conn is your database connection
    $subject_select = $_POST['subject_select'];
    $subject_code = $_POST['subject_code']; 
    $batch = $_POST['batch_id'];
    $batch_year = $_POST['batch_year'];
    $mentrol_or_interactive = isset($_POST['mentrol_or_interactive']) ? 1 : 0;
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

        // Prepared statement to insert data
        $sql_i = "INSERT INTO create_qr_attendance (subject_select, subject_code, batch, batch_year, mentrol_or_interctive, time, qr_date, start_time, end_time, subject_time, qr_code, expired) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // Prepare statement
        $stmt = $conn->prepare($sql_i);
        if ($stmt === false) {
            echo "Error preparing statement: <br>" . $conn->error;
        } else {
            // Bind parameters to the prepared statement as strings ('s') or integers ('i')
            $stmt->bind_param("ssssissssssi", $courseName, $courseCode, $batchYearText1, $batchYearText, $mentrol_or_interactive, $time, $qr_date, $start_time, $end_time, $subject_time, $qr_code, $expired);

            // Set default value for expired column
            $expired = 0;
            
            // Execute the prepared statement
            if ($stmt->execute()) {
                // Set a timer to update the 'expired' column after subject_time minutes
                $timerSeconds = $subject_time * 60;
                $timerScript = "setTimeout(function() {
                    updateExpiredStatus('$qr_code');
                }, $timerSeconds * 1000);"; // Convert seconds to milliseconds

                // Execute the JavaScript timer script
                echo "<script>$timerScript</script>";

                ?>
                <script>
                    if (confirm("Data sent Successfully")) {
                        window.location.href = "./create_atendace.php";
                    }
                </script>
                <?php
            } else {
                echo "Error: " . $stmt->error;
            }
            
            // Close statement
            $stmt->close();
        }
    } else {
        echo "Error fetching data from the database.";
    }
    
    // Close connection
    $conn->close();
}


// JavaScript function to update the 'expired' column in the database
?>
<script>
    function updateExpiredStatus(qrCode) {
        // AJAX call to update_expired_status.php script
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'update_expired_status.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {
                // Optional: Display a message or perform any other action upon successful update
                console.log(xhr.responseText);
            } else {
                console.error('Error updating expired status: ' + xhr.statusText);
            }
        };
        xhr.send('qr_code=' + qrCode);
    }
</script>



<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    <style>
        /* Custom styles for SweetAlert2 */
        .swal2-popup {
            font-family: 'Arial', sans-serif;
        }
        .swal2-title {
            color: #333;
            font-weight: bold;
            font-size: 24px;
        }
        .swal2-icon {
            width: 60px;
            height: 60px;
        }
        .swal2-confirm {
            background-color: #4caf50;
            color: white;
            padding: 10px 24px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
        }
        .swal2-confirm:hover {
            background-color: #45a049;
        }
    </style>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    Swal.fire({
        title: 'Data sent Successfully',
        icon: 'success',
        confirmButtonText: '<a href="./create_atendace.php">OK</a>'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "./create_atendace.php";
        }
    });
</script>
