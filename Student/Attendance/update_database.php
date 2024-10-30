

<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

<?php
include '../../config.php';


// Check if user is logged in as admin
if (isset($_SESSION['user_id'])) {
    // Get user_id from session
    $user_id = $_SESSION['user_id'];

    // Prepare SQL statement to fetch student's degree and module information
    $student_sql = "SELECT degree_code FROM student WHERE user_id = ?";
    $stmt_student = $conn->prepare($student_sql);

    $date = date('d F Y');

    if ($stmt_student) {
        // Bind parameters and execute query
        $stmt_student->bind_param("s", $user_id);
        $stmt_student->execute();
        $result_student = $stmt_student->get_result();

        if ($result_student->num_rows > 0) {
            // Fetch degree_code for the student
            $student_row = $result_student->fetch_assoc();
            $degree_code = $student_row['degree_code'];

            // Prepare SQL statement to fetch corresponding QR code
            $qr_sql = "SELECT cqa.qr_code, cqa.subject_code, cqa.batch, cqa.batch_year, cqa.mentrol_or_interctive, cqa.qr_date, cqa.subject_time
                        FROM create_qr_attendance cqa
                        INNER JOIN degree_module dm ON cqa.subject_code = dm.module_code
                        INNER JOIN student stu ON dm.degree_code = stu.degree_code AND cqa.batch = stu.batch
                        WHERE cqa.subject_code = dm.module_code
                        AND dm.degree_code = stu.degree_code
                        AND cqa.batch = stu.batch 
                        AND cqa.qr_date = '$date'
                        AND stu.user_id = '$user_id'";

            // Execute the QR code query
            $result_qr = $conn->query($qr_sql);

            if ($result_qr->num_rows > 0) {
                // Fetch QR code and other details and assign them to variables
                $qr_row = $result_qr->fetch_assoc();
                $qr_code = $qr_row['qr_code'];
                $qr_code_t1 = $qr_row['qr_code'];
                $subject_code = $qr_row['subject_code'];
                $batch = $qr_row['batch'];
                $batch_year = $qr_row['batch_year'];
                $mentrol_or_interctive = $qr_row['mentrol_or_interctive'];
                $qr_date = $qr_row['qr_date'];
                $subject_time = $qr_row['subject_time'];
            } else {
                $qr_code = "No matching QR code found.";
            }
        } else {
            $qr_code = "Student not found.";
        }
    } else {
        $qr_code = "Failed to prepare student statement.";
    }
} else {
    // Redirect or show error message if user is not logged in
    $qr_code = "You are not logged in.";
}


$date = date('d F Y');

$query_subject_time = "SELECT expired, qr_code, time, subject_time FROM create_qr_attendance WHERE qr_date = '$date'";
$result_subject_time = mysqli_query($conn, $query_subject_time);



if ($result_subject_time) {
    $row_r = mysqli_fetch_assoc($result_subject_time);
   
    $qr_code = $row_r['qr_code'];
   
    $subject_time = $row_r['subject_time'];
    
}
?>


<?php // }?>

<?php

date_default_timezone_set('Asia/Colombo');

$timestamp = strtotime($date);

// Format the timestamp to display the date
$date = date("j F Y", $timestamp);
$formatdate = date("j F Y");

$now_time = date('h:i A');




// Check if the current date matches the QR date
$expired_query = "SELECT expired, qr_code, time, subject_time FROM create_qr_attendance WHERE qr_date = '$date'";
$result = mysqli_query($conn, $expired_query);




if ($result) {
    $row = mysqli_fetch_assoc($result);
    $expired = $row['expired'];
    $qr_code = $row['qr_code'];
    $time = $row['time'];
    $subject_time = $row['subject_time'];

    


 

    $timestamp = strtotime($time);
    
     echo  $timestamp;
   
    $new_timestamp = $timestamp; 

    $stop_time_timestamp1 = $timestamp + ($subject_time * 60); 

  

   
    $new_time = date('h:i:s A', $new_timestamp);
    
    $new_stop_time1 = date('h:i:s A', $stop_time_timestamp1);

    // Convert "PM" to lowercase "pm"
    $new_time = str_replace('pm', 'PM', $new_time);

    // $new_time1 = str_replace('PM', 'pm', $new_time1);

   
    

    echo $new_stop_time1;

    echo "<br>";

    $current_time = time(); 
    $human_readable_time = date("g:i A", $current_time);

 

    if ($new_time <= $human_readable_time) {
        echo "124djdd <br>";
        echo $new_time;
   



    
    $current_time = time(); // Current time in seconds
    $target_time = $new_timestamp; // Target time in seconds

    // Calculate remaining time in milliseconds
    $remaining_time = ($target_time - $current_time) * 1000; // Convert to milliseconds for JavaScript

    // Pass remaining time to JavaScript
    echo "<script>";
    echo "var remainingTime = $remaining_time;"; // JavaScript variable for remaining time in milliseconds
 
    echo "</script>";


    echo "<script>";
    echo "var stopremainingTime1 = $new_stop_time1;"; 
 
    echo "</script>";


?>










<?php

} else {
        
}  
 
    if ($expired == 0 ) {
?>

        <div id="qrcode"></div>

        <script>
      
            var qrcode = new QRCode("qrcode", "<?php echo $qr_code; ?>");
        </script>

        <div id="qrcode1" class="my-3 text-justify" ><h4><?php echo $qr_code; ?></h4></div>

<?php
    } else {
        
        echo "<h4 class='my-5 py-5'>QR code expired</h4>";
    }
} else {
    // Handle query error
    echo "Error executing query: " . mysqli_error($conn);
}



?>



<form id="codeForm">
                                    <div class="card-container">

                                        <input type="text" name="input1" id="input1" class="card1" oninput="moveToNextInput(event, 'input2', 'input1')" onkeydown="handleBackspace(event, 'input1', 'input2')" maxlength="1" required>
                                        <input type="text" name="input2" id="input2" class="card1" oninput="moveToNextInput(event, 'input3', 'input2')" onkeydown="handleBackspace(event, 'input1', 'input2')" maxlength="1" required>
                                        <input type="text" name="input3" id="input3" class="card1" oninput="moveToNextInput(event, 'input4', 'input3')" onkeydown="handleBackspace(event, 'input2', 'input3')" maxlength="1" required>
                                        <input type="text" name="input4" id="input4" class="card1" oninput="moveToNextInput(event, 'input5', 'input4')" onkeydown="handleBackspace(event, 'input3', 'input4')" maxlength="1" required>
                                        <input type="text" name="input5" id="input5" class="card1" oninput="moveToNextInput(event, 'input6', 'input5')" onkeydown="handleBackspace(event, 'input4', 'input5')" maxlength="1" required>



                                    </div>
                                    <button type="submit" name="attend_on" class="btn btn-outline-primary btn-lg-outline btn-block mt-3 ">
                                        Attend On
                                    </button>
                                </form>


                                <script>
                                    // Event listener for form submission<script>
                                    document.getElementById('codeForm').addEventListener('submit', function(event) {
                                        event.preventDefault(); // Prevent the default form submission

                                        // Concatenate the values from the input fields to form the entered code
                                        var enteredCode = '';
                                        for (var i = 1; i <= 5; i++) {
                                            enteredCode += document.getElementById('input' + i).value;
                                        }

                                        // Define the correct code
                                        var correctCode = '<?php echo $qr_code_t1; ?>';

                                        // Check if the entered code is correct before sending the data
                                        if (enteredCode === correctCode) {
                                            // Redirect to fixed_attend.php with correctCode as parameter
                                            window.location.href = './fixed_attend.php?correctCode=' + encodeURIComponent(correctCode);

                                        } else {
                                            // Display an error message if the code is incorrect
                                            alert('Incorrect code. Please try again.');
                                        }
                                    });
                                </script>



                                <?php //echo $qr_code_t1; 
                                ?>







                            </div>



