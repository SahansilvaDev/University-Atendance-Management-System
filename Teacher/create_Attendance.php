<?php include './header.php';  ?>



<link rel="stylesheet" href="./src/style.css">



<link
			rel="stylesheet"
			type="text/css"
			href="src/plugins/datatables/css/responsive.bootstrap4.min.css"
		/>



<?php


include '../config.php';




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





?>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />

<link rel="stylesheet" type="text/css" href="src/plugins/jquery-steps/jquery.steps.css" />
<link rel="stylesheet" type="text/css" href="vendors/styles/style.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.0/dist/JsBarcode.all.min.js"></script>
<link rel="stylesheet" type="text/css" href="src/plugins/ion-rangeslider/css/ion.rangeSlider.css">

<link
	rel="stylesheet"
	type="text/css"
	href="src/plugins/switchery/switchery.min.css"
/>


<style>
    /* Your additional styles here */
    .qr_sec {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: #f4f4f4;
    }

    #qr-code {
        width: 200px;
        height: 200px;
    }

    #barcode {
        display: none;
        margin-top: 20px;
        width: 200px;
        height: 200px;
    }

    .qr_code {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .form-group label{
        font-size: 18px;
        font-weight: 400;
        padding-bottom: 10px;
        font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;

    }
</style>




<div class="main-container " style="height: 60rem;">
    <div class="xs-pd-20-10 pd-ltr-20">
        <div class="pd-20 card-box mb-30">
            <div class="clearfix">
                <h4 class="text-blue h4"></h4>
               
            </div>
            <div class="wizard-content">
                <form class="tab-wizard wizard-circle wizard" action="./create_attendance/submit.php" method="post" enctype="multipart/form-data">

                    <!-- Step 1: Personal Info -->
                    <h5>Module Create</h5>
                    <section class="mt-3">
                        <!-- Personal Info Fields -->

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Subject Select</label>
                                    <select class="custom-select form-control" name="subject_select">
                                        <optgroup label="Condiments" data-max-options="1">
                                            <?php
                                            if ($result && $result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    $course_id = $row['id'];
                                                    $course_name = $row['course_name'];
                                                    $course_code = $row['course_code'];

                                                    echo "<option value='$course_id'> $course_code  -   $course_name</option>";
                                                }
                                            } else {
                                                echo "<option value=''>No courses available</option>";
                                            }
                                            ?>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Subject Code</label>
                                    <select class="custom-select form-control" name="subject_code">
                                        <optgroup label="Condiments" data-max-options="2">
                                            <?php
                                            if ($result1 && $result1->num_rows > 0) {
                                                while ($row = $result1->fetch_assoc()) {
                                                    $course_id = $row['id'];
                                                    $course_name = $row['course_name'];
                                                    $course_code = $row['course_code'];


                                                    echo "<option value='$course_id'><b>$course_code</b> - <i>$course_name</i></option>";
                                                }
                                            } else {
                                                echo "<option value=''>No courses available</option>";
                                            }
                                            ?>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>

                        </div>








                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Batch </label>
                                    <select class="custom-select form-control" name="batch_id">
                                        <?php
                                        if ($result_b1 && $result_b1->num_rows > 0) {
                                            while ($row = $result_b1->fetch_assoc()) {
                                                $id = $row['id'];
                                                $course_batch = $row['batch'];
                                                $date = $row['year'];
                                                $year = date("Y", strtotime($date));
                                                $course_year = $year;

                                                if ($date == NULL) {
                                                    echo "<option value='$id'>  $course_batch</option>";
                                                } else {
                                                    echo "<option value='$id'>$course_batch</option>";
                                                }
                                            }
                                        } else {
                                            echo "<option value=''>No courses available</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Batch and Year</label>
                                    <select class="custom-select form-control" name="batch_year">
                                        <?php
                                        if ($result_b && $result_b->num_rows > 0) {
                                            while ($row = $result_b->fetch_assoc()) {
                                                $id = $row['id'];
                                                $course_batch = $row['batch'];
                                                $date = $row['year'];
                                                $year = date("Y", strtotime($date));
                                                $course_year = $year;

                                                if ($date == NULL) {
                                                    echo "<option value='$id'>$date  -   $course_batch</option>";
                                                } else {
                                                    echo "<option value='$id'>$course_year  -   $course_batch</option>";
                                                }
                                            }
                                        } else {
                                            echo "<option value=''>No courses available</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>


                        </div>


                        <div class="row">
                            
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Start Time</label><br>
                                    <input class="form-control time-picker-default" placeholder="time" type="text" name="start_time" />
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">End Time</label><br>
                                    <input class="form-control time-picker-default" placeholder="time" type="text" name="end_time" />
   
                             </div>



                        </div>

                    </section>
                    <!-- Step 2: Job Status -->
                    <h5>Time Range </h5>
                    <section  class="mt-3">
                        <!-- Job Status Fields -->

                        <div class="row">
                           
                            <div class="col-sm-10">
                            <div class="form-group">
                                    <label class="mt-5 ">Create Time Range</label>
                            <input id="range_03" name="subject_time"/>
                                    </div>
                            </div>
                            <div class="col-sm-1"></div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6"> 
                                <div class="form-group">
                                    <label class="mt-5 me-3">Mentoring Or Interaction</label>
                                    <input type="checkbox" name='switch_btn' checked class="switch-btn" data-color="#0099ff" data-secondary-color="#28a745" />
              
                                </div>

                            </div>

                            <div class="col-sm-6">
                                <!-- <div class="form-group">
                                    <label for="">Time</label><br>
                                    <input class="form-control time-picker-default" placeholder="time" type="text" name="time" />
                                </div> -->
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Date</label><br>
                                    <input class="form-control date-picker" placeholder="Choose Date and Time" type="text" name="qr_date" />
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    
                                    <label for="">Time</label><br>
                                    <input class="form-control time-picker-default" placeholder="time" type="text" name="time" />
                             
                                </div>
                            </div>
                           
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                
                            </div>
                           
                        </div>


                    </section>
                    <!-- Step 3: Interview -->
                    <h5>QR Code Setup</h5>
                    <section  class="mt-3">
                        <!-- Interview Fields -->

                        <div class="row">

                            <div class="col-sm-10">
                                <div class="form-group qr_code">
                                    <h3>QR Code Generator</h3>
                                    <div id="qrcode" name="qr_code"></div><br>
                                    <button type="button" id="generate-qrcode-btn" class="btn mb-20 btn-secondary">Generate QR Code</button>

                                    <p id="qrcode-random-string" name="qr_code"></p>
                                </div>

                                <input type="hidden" id="qr_code_input" name="qr_code" value="">
                                <!-- End QR code section -->
                                <br>
                            </div>
                            <!-- <button type="submit" class="btn mb-20 btn-primary btn-block" name="submit">Submit</button> -->

                        </div>

                    </section>
                    <!-- Step 4: Remark -->
                    <h5>Finished</h5>
                    <section>
                        <!-- Remark Fields -->


                        <iframe src="./attend_details_table.php" frameborder="0" height="300px" width="100%"  id="att_iframe" style="display: none;"></iframe>


                    </section class="mt-3">
                </form>
            </div>
        </div>
    </div>
</div>

<script src="./vendors/scripts/core.js"></script>
<script src="./src/plugins/jquery-steps/jquery.steps.js"></script>

<script>
$(".tab-wizard").steps({
    headerTag: "h5",
    bodyTag: "section",
    transitionEffect: "fade",
    titleTemplate: '<span class="step">#index#</span> #title#',
    labels: {
        finish: "Submit"
    },
    onStepChanged: function(event, currentIndex, priorIndex) {
        $('.steps .current').prevAll().addClass('disabled');
    },
    onFinished: function(event, currentIndex) {
        // AJAX form submission
        $.ajax({
            url: './create_attendance/submit.php', // Path to your PHP script for form submission
            type: 'POST',
            data: $('.tab-wizard').serialize(), // Serialize form data
            success: function(response) {
                // Show the iframe after form submission
                $('#att_iframe').show();
                // Show success popup window
                $('#success-modal').modal('show');
            },
            error: function(xhr, status, error) {
                // Handle error if submission fails
                console.error(xhr.responseText);
            }
        });
    }
});

</script>

<script>
    // JavaScript code for generating QR code
    document.getElementById('generate-qrcode-btn').addEventListener('click', generateQRCode);

    function generateRandomString(length) {
        const characters = '123456789';
        let result = '';
        for (let i = 0; i < length; i++) {
            result += characters.charAt(Math.floor(Math.random() * characters.length));
        }
        return result;
    }

    function generateQRCode() {
        const randomString = generateRandomString(5);
        document.getElementById('qrcode-random-string').textContent = 'Random String: ' + randomString;

        const qrcodeInput = document.getElementById('qr_code_input');
        qrcodeInput.value = randomString; // Update hidden input value

        const qrcodeContainer = document.getElementById('qrcode');
        qrcodeContainer.innerHTML = ''; // Clear previous QR code
        new QRCode(qrcodeContainer, {
            text: randomString,
            width: 200,
            height: 200
        });

        qrcodeContainer.style.display = 'block'; // Show QR code
    }
</script>

<!-- Success Modal -->
<div class="modal fade" id="success-modal" tabindex="-1" role="dialog" aria-labelledby="success-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="success-modal-label">Success</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Your form has been submitted successfully.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- End Success Modal -->

</script>
<script src="./vendors/scripts/core.js"></script>
<script src="./vendors/scripts/script.min.js"></script>
<script src="./vendors/scripts/process.js"></script>
<script src="./vendors/scripts/layout-settings.js"></script>
<script src="./src/plugins/switchery/switchery.min.js"></script>
<script src="./src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
<script src="./src/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.js"></script>
<script src="./vendors/scripts/advanced-components.js"></script>
<script src="./src/plugins/switchery/switchery.min.js"></script>
<script src="./src/sweetalert2.all.js"></script>
<script src="./src/sweetalert2.all.js"></script>

<script src="src/plugins/ion-rangeslider/js/ion.rangeSlider.min.js"></script>
	
		<script src="./src/plugins/switchery/switchery.min.js"></script>

        <script src="src/plugins/datatables/js/dataTables.buttons.min.js"></script>
	
	
        <script>
    $(document).ready(function() {
        
			$("#range_03").ionRangeSlider({
				type: "double",
				grid: true,
				from: 1,
				to: 5,
				skin: "modern",
				type: "single",
				values: [0, 3, 5, 10, 15, 20, 30]
			});
			$("#range_03_1").ionRangeSlider({
				type: "double",
				grid: true,
				from: 1,
				to: 5,
				skin: "modern",
				values: [0, 3, 5, 10, 15, 20, 30]
			});
				});
</script>


</body>

</html>