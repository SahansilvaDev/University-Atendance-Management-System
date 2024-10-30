<?php

include '../config.php';

session_start();

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    $sql_as = "SELECT 
                sa.user_id,
                sa.subject_code,
                sa.subject_select,
                sa.batch,
                sa.teacher_id,
                sa.qr_date AS success_qr_date,
                cqra.qr_date AS create_qr_date,
                COUNT(DISTINCT cqra.subject_code) AS attendance_added,
                COUNT(DISTINCT sa.subject_code) AS attendance_added1
            FROM 
                success_attend sa
            INNER JOIN 
                create_qr_attendance cqra ON sa.subject_code = cqra.subject_code
                AND sa.subject_select = cqra.subject_select
                AND sa.batch = cqra.batch
                AND sa.teacher_id = cqra.teacher_id
                AND sa.qr_date = cqra.qr_date
            WHERE 
                sa.user_id = '$user_id'
            GROUP BY 
                sa.user_id,
                sa.subject_code,
                sa.subject_select,
                sa.batch,
                sa.teacher_id,
                sa.qr_date,
                cqra.qr_date
            HAVING 
                COUNT(DISTINCT cqra.subject_code) = 1
                AND COUNT(DISTINCT sa.subject_code) = 1
            ORDER BY 
                COUNT(sa.subject_code) DESC
            LIMIT 4";


    $result_as = mysqli_query($conn, $sql_as);

    if ($result_as) {
        $count = 1;
        while ($row_as = mysqli_fetch_assoc($result_as)) {
            $subject_code = $row_as['subject_code'];
            $subject_select = $row_as['subject_select'];
            $user_id = $row_as['user_id'];
            $attendance_added= $row_as ['attendance_added'];
            $attendance_added1= $row_as ['attendance_added1'];

            
            // Process further if needed
        
            echo $user_id , $subject_select,' ',  $attendance_added, ' ',  $attendance_added1;
        
            
        }
        
    } else {
        echo "Error: " . mysqli_error($conn);
    }

  
}
?>
