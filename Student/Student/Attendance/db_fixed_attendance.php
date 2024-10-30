<?php
include '../../config.php';
session_start();

if(isset($_POST['attend_on'])){
    // Sanitize input data
    $user_id = isset($_POST['user_id']) ? mysqli_real_escape_string($conn, $_POST['user_id']) : '';
    $subject_select = isset($_POST['subject_select']) ? mysqli_real_escape_string($conn, $_POST['subject_select']) : '';
    $subject_code = isset($_POST['subject_code']) ? mysqli_real_escape_string($conn, $_POST['subject_code']) : '';
    $batch = isset($_POST['batch']) ? mysqli_real_escape_string($conn, $_POST['batch']) : '';
    $qr_date = isset($_POST['qr_date']) ? mysqli_real_escape_string($conn, $_POST['qr_date']) : '';
    $correctCode = isset($_POST['correctCode']) ? mysqli_real_escape_string($conn, $_POST['correctCode']) : '';
    $teacher_id = isset($_POST['teacher_id']) ? mysqli_real_escape_string($conn, $_POST['teacher_id']) : '';
    $currentTime = isset($_POST['currentTime']) ? mysqli_real_escape_string($conn, $_POST['currentTime']) : '';
   
    // Check if the QR code already exists in the database
    $sql_qrcode = "SELECT qr_code FROM success_attend WHERE qr_code = '$correctCode'";
    $result_qrcode = mysqli_query($conn, $sql_qrcode);
    $row_qrcode = mysqli_fetch_assoc($result_qrcode);
    $qr_code = isset($row_qrcode['qr_code']) ? $row_qrcode['qr_code'] : '';

    if($qr_code == $correctCode){
        // QR code already exists, don't insert again
        $error_alert = "Error: QR Code already exists";
        
        echo $error_alert;
        
        

    } else {
        // Insert new record into the database
        $sql_sa = "INSERT INTO success_attend (user_id, subject_select, subject_code, batch, qr_date, qr_code, teacher_id, currentTime) VALUES ('$user_id', '$subject_select', '$subject_code', '$batch', '$qr_date', '$correctCode', '$teacher_id', '$currentTime')";
        $sa_result = mysqli_query($conn, $sql_sa);

        // Check for errors and handle accordingly
        if($sa_result){
            // Redirect upon success
           
            header("Location:../my_schedule.php");
            exit();
         
        } else {
            // Show error message
            echo "Error: Attend Not Added";
        }
    }
}
?>






 

	<!-- Include the library -->
	<script src= 
"https://cdn.jsdelivr.net/npm/sweetalert2@9"> 
	</script> 

	
	<script type="text/javascript"> 

		// Make a simple alert 
		// with the given text 
        alert();
		Swal.fire( 
			'Hey!', 
			'Error: QR Code already exists', 

            
			
		); 
        setTimeout(function(){
                // Redirect to the next page
                window.location.href = "../my_schedule.php";
            }, 1000);
	</script> 
