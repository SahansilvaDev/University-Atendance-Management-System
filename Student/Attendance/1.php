<?php include './header.php'; ?>

<?php

include '../../../config.php'; ?>


<?php
// Include database connection



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


            $qr_sql = "SELECT cqa.id, cqa.qr_code, cqa.subject_code, cqa.batch, cqa.batch_year, cqa.mentrol_or_interctive, cqa.qr_date, cqa.subject_time
                        FROM create_qr_attendance cqa
                        INNER JOIN degree_module dm ON cqa.subject_code = dm.module_code
                        INNER JOIN student stu ON dm.degree_code = stu.degree_code AND cqa.batch = stu.batch
                        WHERE cqa.subject_code = dm.module_code
                        AND dm.degree_code = stu.degree_code
                        AND cqa.batch = stu.batch 
                        AND cqa.qr_date = '$date'
                        AND stu.user_id = '$user_id' ORDER BY cqa.id DESC ";

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
?>



<!-- <link rel="stylesheet" href="style.css"> -->


<style>
    h1,
    h3 , h2 {
        color: green;
    }

    #qrcode,
    #qrcode1,
    #time {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    :root {
        --bgColor: #111;
        --scannerColor: #3fefef;
        --imageColor: 130deg;
    }


    * {
        margin: 0;
        padding: 0;
        font-family: consolas;
    }

    .fingerprint_scaner {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 10vh;
        background: var(--bgColor);
    }

    .scan {
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .scan .fingerprint {
        position: relative;
        width: 300px;
        height: 230px;
        background: url(https://www.pngall.com/wp-content/uploads/2016/06/Fingerprint-Free-Download-PNG.png);
        background-repeat: no-repeat;
        background-size: 300px;
    }

    .scan .fingerprint::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 300px;
        height: 230px;
        background: url(https://www.pngall.com/wp-content/uploads/2016/06/Fingerprint-Free-Download-PNG.png);
        filter: invert(100%) sepia(60%) saturate(3000%) hue-rotate(var(--imageColor)) brightness(95%) contrast(80%);
        background-size: 300px;
        animation: animate 4s ease-in-out infinite;
    }


    @keyframes animate {

        0%,
        100% {
            height: 0%;
        }

        50% {
            height: 100%;
        }
    }

    .scan .fingerprint::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 8px;
        background: var(--scannerColor);
        border-radius: 8px;
        filter: drop-shadow(0 0 20px #3fefef) drop-shadow(0 0 60px #3fefef);
        animation: moveLine 4s ease-in-out infinite;
    }

    @keyframes moveLine {

        0%,
        100% {
            top: 0%;
        }

        50% {
            top: 100%;
        }
    }

    .scan h3 {
        text-transform: uppercase;
        font-size: 2em;
        letter-spacing: 2px;
        margin-top: 20px;
        color: var(--scannerColor);
        filter: drop-shadow(0 0 20px var(--scannerColor)) drop-shadow(0 0 60px var(--scannerColor));
        animation: animate_text 0.5s steps(1) infinite;
    }

    @keyframes animate_text {

        0%,
        100% {
            opacity: 0;
        }

        50% {
            opacity: 1;
        }
    }

    #model1 {
        margin: 0;
        padding: 0px;
    }


    #qr-card-w {
        border: 1px solid rgba(126, 126, 126, 0.301) !important;
    }

    /* .qr_img {
        height: 200px;
    width: 200px;
    } */


    /* .qr_code_img{
        height: 200px;
    width: 200px;
    }  */

    .card-container {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-left: 20px;

    }

    .card1 {
        width: 40px;
        height: 40px;
        margin: 0 5px;
        border: 1px solid #ccc;
        border-radius: 5px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-family: 'Arial', sans-serif;
        font-size: 18px;
        cursor: pointer;
        text-align: center;
        transition: background-color 0.3s;
        font-weight: 600;
    }

    .card1:hover {
        border: solid 2px #333;

    }

    .card1:focus {
        background-color: #C6D7FF;
        /* Green color */
    }


    /* atend_fing_img */

    .atend_fing_img,
    img,
    .sm_crd {
        background-position: center;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
</head>

<body>



    <div class="main-panel">
        <div class="content-wrapper">

            <div class="row">


                <div class="col-sm-6">

                    <div class="pd-ltr-20">

                        <div class="card-box pd-20 height-100-p mb-30">
                            <div class="row">
                                <div class="col-sm-8  mb-3">
                                    <div class="main-title">
                                        <h3 class="mb-3">Use finger-print</h3>
                                    </div>
                                </div>
                                <div class="col-sm-4">

                                    <button type="button" class="btn mb-20 btn-primary btn-block" id="sa-success" class="btn-block" data-toggle="modal" data-target="#success-modal">
                                        Add Finger
                                    </button>
                                    <!-- 							
                </div> -->
                                </div>
                            </div>

                            <div class="row">
                                <!-- <div class="col-sm-6"> -->

                                     
                                    <div class="card-box pd-20 height-100-p mb-30 qr_code_img" id="qr-card-w">

                                        <!-- <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-10"></div>
    <div class="col-md-2"></div>
</div> -->

<?php
error_reporting(E_ERROR | E_PARSE);
    
    date_default_timezone_set('Asia/Colombo');

$date = date('d F Y');





$query_subject_time = "SELECT id, expired, qr_code, time, subject_time FROM create_qr_attendance WHERE qr_date = '$date' ORDER BY id DESC ";
$result_subject_time = mysqli_query($conn, $query_subject_time);




if ($result_subject_time) {
    $row_r = mysqli_fetch_assoc($result_subject_time);

    $qr_code = $row_r['qr_code'];

    $subject_time = $row_r['subject_time'];

    $time = $row_r['time'];
    $expired = $row_r['expired'];


   
   
    





?>

            <div id="time"></div>

            <script>
                // Function to update the time every second
                function updateTime() {
                    // Get the current time
                    var currentTime = new Date();

                    // Set the countdown duration to 4 minutes (in milliseconds)
                    var countdownDuration = <?php echo $subject_time; ?> * 60 * 1000;

                    // Calculate the remaining time in milliseconds
                    var remainingTime = countdownDuration - (currentTime - startTime);

                    // Calculate remaining minutes and seconds
                    var minutes = Math.floor((remainingTime / (1000 * 60)) % 60);
                    var seconds = Math.floor((remainingTime / 1000) % 60);

                    // Add leading zeros if needed
                    minutes = minutes < 10 ? "0" + minutes : minutes;
                    seconds = seconds < 10 ? "0" + seconds : seconds;

                    // Format the time as MM:SS
                    var formattedTime = minutes + ":" + seconds;

                    // Display the formatted time
                    document.getElementById("time").innerHTML = "Remaining Time: " + formattedTime;

                    // Check if the countdown is finished
                    if (remainingTime <= 0) {
                        clearInterval(interval);
                        document.getElementById("time").innerHTML = "Time's up!";
                        // Hide the QR code if time is up
                        document.getElementById("qrcode").style.display = "none";
                        document.getElementById("qrcode1").style.display = "none";


                        
                        

                        var confirmed = confirm(" Time's up!  Mark Your Attendance! Do you want to proceed?");

                        if (confirmed) {
                            // Redirect to the attendance test page with the QR code
                            var qrCode = '<?php echo $qr_code; ?>';
                            window.location.href = './st_make_at.php?qr_code=' + encodeURIComponent(qrCode);
                        } else {
                            // Handle if user chooses not to mark attendance
                            document.getElementById("countdownElement").innerHTML = "Hurry UP!";
                        }
                    }

                }

                // Record the start time
                var startTime = new Date();

                // Update time initially
                updateTime();

                // Update time every second
                var interval = setInterval(updateTime, 1000);
            </script>

<?php 

?>

                <?php
                            
                            $current_time = date("g:i a");
                       
                        

                          
                           
                            
                            
                        
                            // $new_time = strtotime($time) + ($subject_time * 60); 
                            // $formatted_new_time = date("g:i a", $new_time);
                            
                           
                         
                           
                            


                            //                             if ( ($current_time == $time) < ($formatted_new_time)) {

                            //                               echo  'dfjf';


                            //                             }


                if ($expired == 0) {
                ?>
<div class="card">

<div class="card-body">
                <div id="qrcode"></div>

                

                <script>
                var qrcode = new QRCode("qrcode", "<?php echo $qr_code; ?>");
                </script>



                <div id="qrcode1" class="my-3 text-justify">
                <h2><?php echo $qr_code; ?></h2>
                </div>

          

</div>
</div>


                <?php

                
            }
                } else {
                
                echo "<h4 class='my-5 py-5'>QR code has expired</h4>";
                }

             

                // Close the database connection at the end of the script
                mysqli_close($conn);
                ?>







                                        <main>
                                            <!-- Display the fetched QR code -->



                                        </main>


                                    </div>


                                </div>
                            




<style>
    .card1{
        color: #111;
        background-color: lightblue;
        border: 1px solid #111;
        
    }
</style>

<div class="card my-3">
    <div class="card-body text-center">
        <h4 class="my-2 mb-3">  Mark the Attendance</h4>
        
                                    <form id="codeForm">
                                        <div class="card-container">

                                            <input type="text" name="input1" id="input1" class="card1" oninput="moveToNextInput(event, 'input2', 'input1')" onkeydown="handleBackspace(event, 'input1', 'input2')" maxlength="1" required>
                                            <input type="text" name="input2" id="input2" class="card1" oninput="moveToNextInput(event, 'input3', 'input2')" onkeydown="handleBackspace(event, 'input1', 'input2')" maxlength="1" required>
                                            <input type="text" name="input3" id="input3" class="card1" oninput="moveToNextInput(event, 'input4', 'input3')" onkeydown="handleBackspace(event, 'input2', 'input3')" maxlength="1" required>
                                            <input type="text" name="input4" id="input4" class="card1" oninput="moveToNextInput(event, 'input5', 'input4')" onkeydown="handleBackspace(event, 'input3', 'input4')" maxlength="1" required>
                                            



                                        </div>
                                        <div class="mark_on text-center">
                                        <button type="submit" name="attend_on" class="btn btn-outline-primary btn-lg-outline btn-block mt-3 ">
                                            Mark
                                        </button>
                                        </div>
                                    </form>
                                    </div>
                                   
</div>


                                    <script>
                                        // Event listener for form submission<script>
                                        document.getElementById('codeForm').addEventListener('submit', function(event) {
                                            event.preventDefault(); // Prevent the default form submission

                                            // Concatenate the values from the input fields to form the entered code
                                            var enteredCode = '';
                                            for (var i = 1; i <= 4; i++) {
                                                enteredCode += document.getElementById('input' + i).value;
                                            }

                                            // Define the correct code
                                            var correctCode = '<?php echo $qr_code; ?>';

                                            // Check if the entered code is correct before sending the data
                                            if (enteredCode === correctCode) {
                                                // Redirect to fixed_attend.php with correctCode as parameter
                                                window.location.href = './sucsess_attend.php?correctCode=' + encodeURIComponent(correctCode);

                                            } else {
                                                // Display an error message if the code is incorrect
                                                alert('Incorrect code. Please try again.');
                                            }
                                        });
                                    </script>



                                    <?php // echo  $qr_code; 
                                    echo $undefinedVariable;
                                    ?>







                                </div>

                                <!-- end -->
                            </div>

                        </div>
         
                








                <div class="col-sm-6">
                     

                <img src="./h1.svg" alt="">


                </div>
            </div>
        </div>






        <div class="modal fade" id="success-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content " id="model1">

                    <div class="modal-body text-center font-18">

                        <div class="fingerprint_scaner">
                            <div class="scan">
                                <div class="fingerprint"></div>
                                <h3>Scanning...</h3>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">
                            Done
                        </button>
                    </div>
                </div>
            </div>
        </div>











        <script>
            function moveToNextInput(event, nextInputId, currentInputId) {
                const currentInput = event.target;
                if (currentInput.value.length > 1) {
                    currentInput.value = currentInput.value.charAt(0); // Allow only one character
                }
                if (currentInput.value.length === 1 && nextInputId) {
                    // Move to the next input
                    document.getElementById(nextInputId).focus();
                }
            }

            function handleBackspace(event, prevInputId, currentInputId) {
                if (event.key === 'Backspace' && event.target.value.length === 0) {
                    // Backspace was pressed, move to the previous input
                    if (prevInputId) {
                        event.preventDefault(); // Prevent default backspace behavior
                        document.getElementById(prevInputId).focus();
                    }
                }
            }
        </script>






        <?php include './footer.php'; ?>