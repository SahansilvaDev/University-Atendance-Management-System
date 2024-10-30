<?php
include '../config.php';
session_start();



if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];

    $sql = "SELECT 
    s.user_id,
    c.subject_select,
    c.subject_code,
    c.batch,
    c.mentrol_or_interctive,
    c.qr_date,
    c.start_time,
    c.end_time,
    c.subject_time,
    c.expired
FROM 
    create_qr_attendance c
JOIN 
    degree_module d ON c.subject_code = d.module_code
JOIN 
    student s ON d.degree_code = s.degree_code
WHERE 
    c.subject_code = d.module_code 
    AND s.user_id = '$user_id'
    ";



$sql2 = "SELECT 
            s.user_id,
            c.subject_select,
            c.subject_code,
            c.batch,
            c.mentrol_or_interctive,
            c.qr_date,
            c.start_time,
            c.end_time,
            c.subject_time,
            c.expired
        FROM 
            create_qr_attendance c
        JOIN 
            degree_module d ON c.subject_code = d.module_code
        JOIN 
            student s ON d.degree_code = s.degree_code
        WHERE 
            c.subject_code = d.module_code 
            AND s.user_id = '$user_id'
            AND DATE(c.qr_date) = CURDATE()  
            AND c.start_time BETWEEN DATE_SUB(NOW(), INTERVAL 5 MINUTE) AND NOW()";


$sql4 = "SELECT fname, lname, t_notification FROM teacher";




    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "User ID: " . $row["user_id"]. "<br>";
            echo "Subject Select: " . $row["subject_select"]. "<br>";
            echo "Subject Code: " . $row["subject_code"]. "<br>";
            echo "Batch: " . $row["batch"]. "<br>";
            echo "Mentrol or Interactive: " . $row["mentrol_or_interctive"]. "<br>";
        }
    } else {
        echo "No matching records found.";
    }
}
include './footer.php';
?>
