<?php

?>
<script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
<link rel="stylesheet" type="text/css" href="src/plugins/sweetalert2/sweetalert2.css" />
<link rel="stylesheet" href="./src/styles/qr_b.css">

<?php
include("../config.php");

// Check if the session is started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

try {
    // Check if session variables are set
    if (!isset($_SESSION['f_name'])) {
        throw new Exception("Session not set");
    }

    $f_name = $_SESSION['f_name'];
    $s_id = $_SESSION['s_id'];

    // Output session ID
    echo $s_id;

    $id_to_search = 1;

    $qr_code_set = "
        SELECT module.id, module.module_code, module.module_name, module.date, students.f_name, students.s_id, qr_codes.code
        FROM module
        JOIN students ON module.id = students.id
        JOIN qr_codes ON module.id = qr_codes.id
        WHERE module.id = ?";

    // Use the object-oriented style for prepared statements
    $stmt = $conn->prepare($qr_code_set);

    if (!$stmt) {
        throw new Exception("Query preparation failed: " . $conn->error);
    }

    $stmt->bind_param("i", $id_to_search);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check for errors
    if (!$result) {
        throw new Exception("Query execution failed: " . $stmt->error);
    }

    // Fetch and process the results
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $qr_code = $row['code'];
             $expired = $row['expired'];
            // Output or use $qr_code as needed
            echo "QR Code: " . (isset($qr_code) ? $qr_code : "N/A");
        }
    } else {
        echo "No results found.";
    }

    // Close the result set
    $result->close();
    // Close the prepared statement
    $stmt->close();

} catch (Exception $e) {
    // Display a user-friendly error message
    echo "An error occurred: " . $e->getMessage();
}

// Close the database connection
if (isset($conn)) {
    $conn->close();
}

?>

<?php
// Start or resume the session

try {
    // Establish database connection
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'attended_system';

    $conn = new mysqli($hostname, $username, $password, $database);

    // Check for connection errors
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    // Fetch data based on the session ID
    if (isset($_SESSION['f_name'])) {
        $f_name = $_SESSION['f_name'];
        $s_id = $_SESSION['s_id'];

        // Retrieve course, course_id, module, t_id, and code from students, qr_data, and qr_codes tables
        $query = "SELECT s.course, s.course_id, q.module, q.t_id, c.code, m.faculty
                  FROM students s
                  JOIN qr_data q ON s.course = q.module
                  LEFT JOIN qr_codes c ON q.t_id = c.t_id
                  LEFT JOIN module m ON s.course_id = m.id
                  WHERE s.s_id = ?";

        $stmt = $conn->prepare($query);

        if (!$stmt) {
            throw new Exception("Query preparation failed: " . $conn->error);
        }

        $stmt->bind_param("s", $s_id);
        $stmt->execute();

        $result = $stmt->get_result();

        // Check for errors
        if (!$result) {
            throw new Exception("Query execution failed: " . $stmt->error);
        }

        $data = $result->fetch_assoc();

        // If course_id is found, retrieve the faculty from the module table
        if (isset($data['course_id'])) {
            $courseId = $data['course_id'];

            $facultyQuery = "SELECT faculty FROM module WHERE module_code = ?";
            $facultyStmt = $conn->prepare($facultyQuery);

            if (!$facultyStmt) {
                throw new Exception("Query preparation failed: " . $conn->error);
            }

            $facultyStmt->bind_param("s", $courseId);
            $facultyStmt->execute();

            $facultyResult = $facultyStmt->get_result();

            // Check for errors
            if (!$facultyResult) {
                throw new Exception("Query execution failed: " . $facultyStmt->error);
            }

            $facultyData = $facultyResult->fetch_assoc();

            $data['faculty'] = isset($facultyData['faculty']) ? $facultyData['faculty'] : null;

            $facultyStmt->close();
        }

        // Find the date_and_time column in the qr_data table by the t_id
        $tId = $data['t_id'];

        $dateTimeQuery = "SELECT date_and_time FROM qr_data WHERE t_id = ?";
        $dateTimeStmt = $conn->prepare($dateTimeQuery);

        if (!$dateTimeStmt) {
            throw new Exception("Query preparation failed: " . $conn->error);
        }

        $dateTimeStmt->bind_param("s", $tId);
        $dateTimeStmt->execute();

        $dateTimeResult = $dateTimeStmt->get_result();

        // Check for errors
        if (!$dateTimeResult) {
            throw new Exception("Query execution failed: " . $dateTimeStmt->error);
        }

        $dateTimeData = $dateTimeResult->fetch_assoc();

        $data['date_and_time'] = isset($dateTimeData['date_and_time']) ? $dateTimeData['date_and_time'] : null;

        $dateTimeStmt->close();

        // Check if 'faculty' is null before accessing it
        if (!isset($data['faculty'])) {
            $data['faculty'] = "N/A"; // Set a default value or handle it accordingly
        }

        // Separate data into individual keys in the JSON output
        $output = [
            'course' => isset($data['course']) ? $data['course'] : null,
            'course_id' => isset($data['course_id']) ? $data['course_id'] : null,
            'module' => isset($data['module']) ? $data['module'] : null,
            't_id' => isset($data['t_id']) ? $data['t_id'] : null,
            'code' => isset($data['code']) ? $data['code'] : null,
            'faculty' => $data['faculty'],
            'date_and_time' => isset($data['date_and_time']) ? $data['date_and_time'] : null,
        ];

        $output1 = [
            isset($data['code']) ? $data['code'] : null,
        ];

        $jsonOutput = json_encode($output1, JSON_UNESCAPED_UNICODE);

        // Trim leading and trailing characters
        $jsonOutput = trim($jsonOutput, '[]{} "" ""');

        // Output the JSON data
        echo json_encode($output1);

       

        // Use prepared statement to prevent SQL injection
        $expired_query = "SELECT * FROM qr_codes WHERE code = ?";
        $stmt = $conn->prepare($expired_query);
        $stmt->bind_param("i", $jsonOutput);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if (!$result) {
            echo "Error: " . $stmt->error;
        } else {
            // Check if there are any rows returned
            if ($result->num_rows > 0) {
                // Fetch the first row
                $row = $result->fetch_assoc();
                $expired = $row['expired'];
        
                if ($expired == 1) {
                    echo '<p style="color:red;">This QR code has expired.</p>';
                } else {
                    echo '<p>This QR code is valid.</p>';
                    // Add code here to display the QR code or perform other actions for a valid QR code
                }
            } else {
                echo '<p style="color:red;">QR code not found.</p>';
            }
        }

        // Close the prepared statement
        $stmt->close();




// Check if the session variables are set


   




    } else {
        throw new Exception("Session not set"); // Add an error message or redirection as needed
    }

} catch (Exception $e) {
    // Display a user-friendly error message
    echo "An error occurred: " . $e->getMessage();
}

// Close the database connection
if (isset($conn)) {
    $conn->close();
}
?>






<div class="mobile-menu-overlay"></div>
<div class="main-container">

    <div class="row pb-10">
        <div class="col-md-9 mb-20">
            <div class="card-box height-100-p pd-20">
                <div class="d-flex flex-wrap justify-content-between align-items-center pb-0 pb-md-3">
                    <div class="h5 mb-md-0">Attend Your Fingerprint</div>
                    <div class="form-group mb-md-0">
                        <!-- <button type="button" class="btn btn-primary">Your Fingerprint</button> -->




                        <!-- fingerprint strat -->


                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            Use Your Fingerprint <i class="fas fa-fingerprint    "></i>
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <!-- <h5 class="modal-title" id="exampleModalLabel">Modal title</h5> -->
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body h-25">
                                        <?php include './bios/index.php'; ?>
                                    </div>
                                    <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
                                </div>
                            </div>
                        </div>





                        <!-- fingerprint end -->



                    </div>
                </div>

                <div class="qr_setup">
                    <div class="row">
                        <div class="col-sm-7">
                            <div class="card">


                                <?php
                                ?>

                                <form action="" method="post">
                                    <div class="card-container">
                                        <div id="qrcode"></div>






                                        <script>
                                            const qrcode = new QRCode(document.getElementById("qrcode"), {
                                                text: "<?php   echo $jsonOutput; ?>",
                                                width: 250,
                                                height: 250
                                            });
                                        </script>
                                    </div>
                                </form>

                                <h3 class="bold-text py-2"><?php  echo $jsonOutput; ?></h3>
                                

                            </div>
                        </div>

                        <div class="col-sm-5  ">

                            <div class="atend_fing_img">
                                <img src="./finger-print.svg" alt="">
                            </div>

                            <div class="qr_svg_setup">

                                <div class="sm_crd">
                             
                             

<form action="./uplord/test.php" method="POST">
    <div class="card-container">
        <input type="text" name="input1" id="input1" class="card1" oninput="moveToNextInput(event, 'input2', 'input1')">
        <input type="text" name="input2" id="input2" class="card1" oninput="moveToNextInput(event, 'input3', 'input2')">
        <input type="text" name="input3" id="input3" class="card1" oninput="moveToNextInput(event, 'input4', 'input3')">
        <input type="text" name="input4" id="input4" class="card1" oninput="moveToNextInput(event, 'input5', 'input4')">
        <input type="text" name="input5" id="input5" class="card1" oninput="moveToNextInput(event, 'input6', 'input5')">
        <input type="text" name="input6" id="input6" class="card1" oninput="moveToNextInput(event, null, 'input6')">
    </div>
    <button type="submit" name="attend_on" class="btn btn-outline-primary btn-lg-outline btn-block mt-3">
        Attend On
    </button>
</form>


                                </div>

                                
                            </div>



                        </div>

                    </div>
                </div>



            </div>
        </div>
        <div class="col-md-3 mb-20">
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
            </div>
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



    






<?php

?>
<script>
    function moveToNextInput(event, nextInputId, currentInputId) {
        const currentInput = event.target;

        currentInput.value = currentInput.value.charAt(0); // Allow only one character

        currentInput.addEventListener('input', function(event) {
            if (event.data === null) {
                // Backspace was pressed, move to the previous input
                if (currentInputId) {
                    document.getElementById(currentInputId).focus();
                }
                return;
            }

            if (currentInput.value.length === 1) {
                // Move to the next input
                if (nextInputId) {
                    document.getElementById(nextInputId).focus();
                }
            }
        });
    }

    // tag
</script>
<?php include './footer.php'; ?>


<script src="src/plugins/sweetalert2/sweetalert2.all.js"></script>
<script src="src/plugins/sweetalert2/sweet-alert.init.js"></script>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS" height="0" width="0" style="display: none; visibility: hidden"></iframe></noscript>