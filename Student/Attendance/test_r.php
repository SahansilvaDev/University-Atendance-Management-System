<?php
include '../../config.php'; 



if(isset($_GET['qr_code'])) {
    $correctCode = $_GET['qr_code'];

    $query_update = "UPDATE create_qr_attendance SET expired = 1 WHERE qr_code = '$correctCode'"; 
    $result_update = mysqli_query($conn, $query_update);

   

    if (!$result_update) {
        echo "Error: " . mysqli_error($conn);
    }else{
        header("location:../make_s_attend.php");
        exit();
      
    }

}



?>
