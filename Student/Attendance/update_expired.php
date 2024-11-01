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
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>QR Code Generator</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../vendors/styles/core.css" />
    <link rel="stylesheet" type="text/css" href="../vendors/styles/icon-font.min.css" />
    <link rel="stylesheet" type="text/css" href="../src/plugins/datatables/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" type="text/css" href="../src/plugins/datatables/css/responsive.bootstrap4.min.css" />
    <link rel="stylesheet" type="text/css" href="../vendors/styles/style.css" />
    <!-- <link rel="stylesheet" href="style.css"> -->
  

    <style>
        h1,
        h3 {
            color: green;
        }

        #qrcode, #qrcode1, #time {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        :root{
  --bgColor: #111;
  --scannerColor: #3fefef;
  --imageColor: 130deg;
}


* {
    margin:0;
    padding:0;
    font-family:consolas;
}

.fingerprint_scaner {
    display:flex;
    justify-content:center;
    align-items:center;
    min-height:10vh;
    background: var(--bgColor);
}

.scan {
    position:relative;
    display:flex;
    flex-direction:column;
    align-items:center;
}

.scan .fingerprint {
    position:relative;
    width:300px;
    height:230px;
    background:url(https://www.pngall.com/wp-content/uploads/2016/06/Fingerprint-Free-Download-PNG.png);
    background-repeat: no-repeat;
    background-size:300px;
}

.scan .fingerprint::before {
    content: '';
    position:absolute;
    top:0;
    left:0;
    width:300px;
    height:230px;
    background:url(https://www.pngall.com/wp-content/uploads/2016/06/Fingerprint-Free-Download-PNG.png);
    filter: invert(100%) sepia(60%) saturate(3000%) hue-rotate(var(--imageColor)) brightness(95%) contrast(80%);
    background-size:300px;
    animation:animate 4s ease-in-out infinite;    
}


@keyframes animate {
    0%, 100% {
        height:0%;
    }
    
    50% {
        height:100%;
    }
}

.scan .fingerprint::after {
    content:'';
    position:absolute;
    top:0;
    left:0;
    width:100%;
    height:8px;
    background: var(--scannerColor);
    border-radius:8px;
    filter: drop-shadow(0 0 20px #3fefef) drop-shadow(0 0 60px #3fefef);
    animation:moveLine 4s ease-in-out infinite;
}

@keyframes moveLine {
    0%, 100% {
        top:0%;
    }
    
    50% {
        top:100%;
    }
}

.scan h3 {
    text-transform:uppercase;
    font-size:2em;
    letter-spacing:2px;
    margin-top:20px;
    color: var(--scannerColor);   
    filter:drop-shadow(0 0 20px var(--scannerColor)) drop-shadow(0 0 60px var(--scannerColor));
    animation:animate_text 0.5s steps(1) infinite;
}

@keyframes animate_text {
    0%, 100% {
        opacity:0;
    }
    
    50% {
        opacity:1;
    }
}

#model1{
    margin: 0;
    padding: 0px;
}
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
</head>

<body>



    <div class="main-container">

        <div class="row">


            <div class="col-sm-9">

                <div class="pd-ltr-20">

                    <div class="card-box pd-20 height-100-p mb-30">
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="main-title">
                                    <h3 class="mb-3">Use finger-print</h3>
                                </div>
                            </div>
                            <div class="col-sm-4">

                                <button type="button" class="btn mb-20 btn-primary btn-block" id="sa-success" class="btn-block"
									data-toggle="modal"
									data-target="#success-modal">
                                    Add Finger
                                </button>
                                <!-- 							
                </div> -->
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">


                                <div class="card-box pd-20 height-100-p mb-30" id="qr-card-w">

<!-- <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-10"></div>
    <div class="col-md-2"></div>
</div> -->
<?php
                                    $date = date('d F Y');

                                    $query_subject_time = "SELECT expired, qr_code, time, subject_time FROM create_qr_attendance WHERE qr_date = '$date'";
                                    $result_subject_time = mysqli_query($conn, $query_subject_time);



                                    if ($result_subject_time) {
                                        $row_r = mysqli_fetch_assoc($result_subject_time);

                                        $qr_code = $row_r['qr_code'];

                                        $subject_time = $row_r['subject_time'];
                                    }
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
                                            }
                                        }

                                        // Record the start time
                                        var startTime = new Date();

                                        // Update time initially
                                        updateTime();

                                        // Update time every second
                                        var interval = setInterval(updateTime, 1000);
                                    </script>

                                    <?php // }
                                    ?>













                                    <!-- Add this JavaScript code within your HTML document -->
                                    <script>
                                        // Function to update the countdown timer
                                        function updateCountdown() {
                                            var now = new Date().getTime(); // Current time in milliseconds
                                            var distance = remainingTime - now; // Remaining time in milliseconds

                                            // Calculate remaining minutes and seconds
                                            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                                            // Display the remaining time in MM:SS format
                                            var countdownElement = document.getElementById("countdown");
                                            countdownElement.innerHTML = minutes + "m " + seconds + "s ";

                                            // Update the countdown every second
                                            if (distance > 0) {
                                                setTimeout(updateCountdown, 1000); // Recursive call to update countdown
                                            } else {
                                                countdownElement.innerHTML = "Time's up!"; // Display message when countdown ends
                                            }
                                        }

                                        // Call the function to start the countdown
                                        updateCountdown();
                                    </script>

                                    <!-- Display the countdown timer -->
                                    <div id="countdown"></div>



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



                                        // Convert the initial time string to a timestamp
                                        $timestamp = strtotime($time);


                                        $new_timestamp = $timestamp;

                                        $stop_time_timestamp1 = $timestamp + ($subject_time * 60);





                                        $new_time = date('h:i:s A', $new_timestamp);

                                        $new_time1 = date('h:i:s A', $stop_time_timestamp1);



                                        // Convert "PM" to lowercase "pm"
                                        $new_time = str_replace('PM', 'pm', $new_time);

                                        $new_time1 = str_replace('PM', 'pm', $new_time1);






                                        $current_time = time();
                                        $human_readable_time = date("g:i A", $current_time);

                                        $human_readable_time1 = date("g:i a", $current_time);

                                        // echo $human_readable_time1;

                                        // if ($human_readable_time == $new_time1) {
                                        //     echo $new_time1 . ' ' . $$human_readable_time;
                                        // }





                                        // time setup  <= $new_time1

                                        if ( $new_time <= ($human_readable_time < $new_time1) ) {

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



                                            <div id="countdown"></div>


                                            <script>
                                                var remainingTime = <?php echo $remaining_time; ?>;
                                                var stopTime = new Date().getTime() + (<?php echo $subject_time; ?> * 60 * 1000);


                                                function updateCountdown() {
                                                    var countdownElement = document.getElementById("countdown");

                                                    // Calculate current time
                                                    var currentTime = new Date().getTime();

                                                    // Check if 60 seconds have elapsed
                                                    if (currentTime < stopTime) {
                                                        // Update countdown display
                                                        var newTime = new Date(new Date().getTime() + remainingTime);
                                                        var formattedTime = newTime.toLocaleTimeString('en-US', {
                                                            hour: 'numeric',
                                                            minute: '2-digit',
                                                            second: '2-digit',
                                                            hour12: true
                                                        });

                                                        countdownElement.innerHTML = formattedTime;

                                                        // Schedule the next update
                                                        setTimeout(updateCountdown, 1000); // Update every second
                                                    } else {


                                                        // countdownElement.innerHTML = confirm(

                                                        // );

                                                        // Display a confirmation dialog
                                                        var confirmed = confirm("Are you sure you want to proceed?");

                                                        // Check if user confirmed
                                                        if (confirmed) {
                                                            // Redirect to the specified URL
                                                            var qr_code = '<?php echo $qr_code; ?>';
                                                            window.location.href = './Attendance/test_r.php?qr_code=' + encodeURIComponent(qr_code);

                                                        } else {

                                                            countdownElement.innerHTML = "Action was cancelled.";
                                                        }


















                                                    }
                                                }

                                                // Call the function to start the live countdown
                                                updateCountdown();
                                            </script>







                                            <?php



                                            if ($expired == 0) {
                                            ?>

                                                <div id="qrcode"></div>

                                                <script>
                                                    var qrcode = new QRCode("qrcode", "<?php echo $qr_code; ?>");
                                                </script>

                                                <div id="qrcode1" class="my-3 text-justify">
                                                    <h4><?php echo $qr_code; ?></h4>
                                                </div>

                                    <?php
                                   
                                            } else {
                                                echo "<h4 class='my-5 py-5'>QR code expired</h4>";
                                            }
                                        } else {

                                            echo "<h4 class='my-5 py-5'>QR code expired</h4>";
                                        }
                                    } else {
                                        // Handle query error
                                        echo "Error executing query: " . mysqli_error($conn);
                                    }



                                    ?>




                                    <main>
                                        <!-- Display the fetched QR code -->
                                        
                                

                                    </main>


                                </div>


                            </div>
                            <!-- qr img -->
                            <div class="col-sm-6">
                                <div class="qr_img">
                                    <img src="./finger-print.svg" alt="">
                                </div>

                             


                              



 <form id="codeForm">
 <div class="card-container">
    
 <input type="text" name="input1" id="input1" class="card1" oninput="moveToNextInput(event, 'input2', 'input1')" onkeydown="handleBackspace(event, 'input1', 'input2')" maxlength="1" required>
                                 <input type="text" name="input2" id="input2" class="card1" oninput="moveToNextInput(event, 'input3', 'input2')" onkeydown="handleBackspace(event, 'input1', 'input2')" maxlength="1" required >
                                 <input type="text" name="input3" id="input3" class="card1" oninput="moveToNextInput(event, 'input4', 'input3')" onkeydown="handleBackspace(event, 'input2', 'input3')" maxlength="1" required >
                                 <input type="text" name="input4" id="input4" class="card1" oninput="moveToNextInput(event, 'input5', 'input4')" onkeydown="handleBackspace(event, 'input3', 'input4')" maxlength="1" required >
                                 <input type="text" name="input5" id="input5" class="card1" oninput="moveToNextInput(event, 'input6', 'input5')" onkeydown="handleBackspace(event, 'input4', 'input5')" maxlength="1" required >



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



<?php //echo $qr_code_t1; ?>







                            </div>

                            <!-- end -->
                        </div>

                    </div>
                </div>
            </div>








            <div class="col-sm-3">

                <br>

                <div class="card-box min-height-200px pd-20 mb-20" data-bgcolor="#455a64">
                    <div class="d-flex justify-content-between pb-20 text-white">
                        <div class="icon h1 text-white">
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                            <!-- <i class="icon-copy fa fa-stethoscope" aria-hidden="true"></i> -->
                        </div>
                        <div class="font-14 text-right">
                            <div><i class="icon-copy ion-arrow-up-c"></i> 2.69%</div>
                            <div class="font-12">Since last Week</div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-end">
                        <div class="text-white">
                            <div class="font-14">Total attendance</div>
                            <div class="font-24 weight-500">1865</div>
                        </div>
                        <div class="max-width-150">
                            <div id="appointment-chart"></div>
                        </div>
                    </div>
                </div><br>

                <div class="card-box min-height-200px pd-20" data-bgcolor="#265ed7">
                    <div class="d-flex justify-content-between pb-20 text-white">
                        <div class="icon h1 text-white">
                            <i class="fa fa-stethoscope" aria-hidden="true"></i>
                        </div>
                        <div class="font-14 text-right">
                            <div><i class="icon-copy ion-arrow-down-c"></i> 3.69%</div>
                            <div class="font-12">Since last week</div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-end">
                        <div class="text-white">
                            <div class="font-14">engagment attandance</div>
                            <div class="font-24 weight-500">250</div>
                        </div>
                        <div class="max-width-150">
                            <div id="surgery-chart"></div>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>



    
								
  
								<div
									class="modal fade"
									id="success-modal"
									tabindex="-1"
									role="dialog"
									aria-labelledby="exampleModalCenterTitle"
									aria-hidden="true"
								>
									<div
										class="modal-dialog modal-dialog-centered" 
										role="document"
									>
										<div class="modal-content "  id="model1">
                                            
											<div class="modal-body text-center font-18">
												
												<div class="fingerprint_scaner">
                                                <div class="scan">
                                                    <div class="fingerprint"></div>
                                                    <h3>Scanning...</h3>
                                                </div>
                                                </div>

												
											</div>
											<div class="modal-footer justify-content-center">
												<button
													type="button"
													class="btn btn-primary"
													data-dismiss="modal"
												>
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

    <!-- js -->
    <script src="../vendors/scripts/core.js"></script>
    <script src="../vendors/scripts/script.min.js"></script>
    <script src="../vendors/scripts/process.js"></script>
    <script src="../vendors/scripts/layout-settings.js"></script>
    <script src="../src/plugins/apexcharts/apexcharts.min.js"></script>
    <script src="../src/plugins/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
    <script src="../src/plugins/datatables/js/dataTables.responsive.min.js"></script>
    <script src="../src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
    <script src="../vendors/scripts/dashboard3.js"></script>

    <script src="./vendors/sweetalert2.all.js"></script>
    <script src="./vendors/sweet-alert.init.js"></script>

    <script src="sweetalert2.all.js"></script>
    <script src="sweet-alert.init.js"></script>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS" height="0" width="0" style="display: none; visibility: hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
</body>

</html>