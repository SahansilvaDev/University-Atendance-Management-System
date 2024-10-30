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


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Generator</title>
    <!-- Add your CSS links here -->
    <link rel="stylesheet" type="text/css" href="../Student/src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" />
    <link rel="stylesheet" type="text/css" href="../Student/src/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.css" />
    <link rel="stylesheet" type="text/css" href="../Student/src/plugins/switchery/switchery.min.css" />
    <link rel="stylesheet" type="text/css" href="../Student/vendors/styles/core.css" />
    <link rel="stylesheet" type="text/css" href="../Student/vendors/styles/icon-font.min.css" />
    <link rel="stylesheet" type="text/css" href="../Student/src/plugins/datatables/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" type="text/css" href="../Student/src/plugins/datatables/css/responsive.bootstrap4.min.css" />
    <link rel="stylesheet" type="text/css" href="../Student/vendors/styles/style.css" />
    <link rel="stylesheet" href="style.css">
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
    </style>
    <!-- Add your JavaScript libraries here -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.0/dist/JsBarcode.all.min.js"></script>
</head>

<body>
    <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
            <div class="card-box min-height-200px pd-20 mb-20">
            <form action="./submit.php" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label>Subject Select</label>
        <select class="selectpicker form-control" data-style="btn-outline-primary" name="subject_select">
            <optgroup label="Condiments" data-max-options="2">
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


    <div class="form-group">
        <label>Subject Code</label>
        <select class="selectpicker form-control" data-style="btn-outline-primary" name="subject_code">
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

    

    <div class="form-group">
        <label>Batch </label>
        <select class="selectpicker form-control" data-style="btn-outline-primary" name="batch_id">
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




    <!-- <div class="form-group">
        <label>Batch</label>
        <select class="selectpicker form-control" data-style="btn-outline-primary" name="batch_id">
            <?php
            // if ($result_b1 && $result_b1->num_rows > 0) {
            //     while ($row = $result_b1->fetch_assoc()) {
            //         $id = $row['id'];
            //         $course_batch = $row['batch'];
                 

            //             echo "<option value='$id'>$course_batch</option>";
                  
            //     }
            // } else {
            //     echo "<option value=''>No courses available</option>";
            // }
            ?>
        </select>
    </div> -->

    <!-- <div class="form-group">
                        <label for="">Batch</label><br>
                        <input class="form-control " placeholder="batch" type="text" name="batch_id" />
                    </div> -->




    <div class="form-group">
        <label>Batch and Year</label>
        <select class="selectpicker form-control" data-style="btn-outline-primary" name="batch_year">
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


    <div class="form-group">
    <label class="mx-2">Mentoring and Interaction</label>
    <input type="checkbox" checked class="switch-btn" name="mentrol_or_interctive" id="btn_clicked">

    <script>
        // Function to toggle switch button color
        function toggleColor() {
            // Get the switch button element
            var switchBtn = document.getElementById("btn_clicked");

            // Check if the switch button is checked
            if (switchBtn.checked) {
                // Set the color to #0099ff if checked (left side)
                switchBtn.setAttribute("data-color", "#0099ff");
            } else {
                // Set the color to #ff0000 if not checked (right side)
                switchBtn.setAttribute("data-color", "#ff0000");
            }
        }

        // Add event listener to toggle color on click
        document.getElementById("btn_clicked").addEventListener("click", toggleColor);

        // Initial call to set the color based on the initial checked state
        toggleColor();
    </script>
</div>



                    <div class="form-group">
                        <label for="">Time</label><br>
                        <input class="form-control time-picker-default" placeholder="time" type="text" name="time" />
                    </div>
                    <div class="form-group">
                        <label for="">Date</label><br>
                        <input class="form-control datetimepicker" placeholder="Choose Date and Time" type="text" name="qr_date" />
                    </div>
                    <div class="form-group">
                        <label for="">Start Time</label><br>
                        <input class="form-control time-picker-default" placeholder="time" type="text" name="start_time" />
                    </div>
                    <div class="form-group">
                        <label for="">End Time</label><br>
                        <input class="form-control time-picker-default" placeholder="time" type="text" name="end_time" />
                    </div>
                    <div class="form-group">
                        <label for="">Subject Time</label><br>
                        <input class="form-control " placeholder="time" type="text" name="subject_time" />
                    </div>
                    <br>



                    <div class="form-group qr_code">
                        <h3>QR Code Generator</h3>
                        <div id="qrcode" name="qr_code"></div><br>
                        <button type="button" id="generate-qrcode-btn" class="btn mb-20 btn-secondary">Generate QR Code</button>

                        <p id="qrcode-random-string" name="qr_code"></p>
                    </div>

                    <input type="hidden" id="qr_code_input" name="qr_code" value="">
                    <!-- End QR code section -->
                    <br>
                    <button type="submit" class="btn mb-20 btn-primary btn-block" name="submit">Submit</button>

 


                </form>
            </div>
        </div>
        <div class="col-sm-1"></div>
    </div>










    <!-- Add your JavaScript scripts here -->
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




<script src="vendors/scripts/core.js"></script>
<script src="src/plugins/jquery-steps/jquery.steps.js"></script>
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




    <script src="../Student/vendors/scripts/core.js"></script>
    <script src="../Student/vendors/scripts/script.min.js"></script>
    <script src="../Student/vendors/scripts/process.js"></script>
    <script src="../Student/vendors/scripts/layout-settings.js"></script>
    <script src="../Student/src/plugins/switchery/switchery.min.js"></script>
    <script src="../Student/src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
    <script src="../Student/src/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.js"></script>
    <script src="../Student/vendors/scripts/advanced-components.js"></script>
    <script src="../Student/src/plugins/switchery/switchery.min.js"></script>
    <script src="sweetalert2.all.js"></script>
    <script src="sweet-alert.init.js"></script>
    <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS" height="0" width="0" style="display: none; visibility: hidden"></iframe>
    </noscript>
    <!-- End Google Tag Manager (noscript) -->
</body>

</html>






