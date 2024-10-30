<?php
include './header.php';
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

if (isset($_SESSION['f_name'])) {
    $f_name = $_SESSION['f_name'];
    $s_id = $_SESSION['s_id'];
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
    $stmt->bind_param("i", $id_to_search);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check for errors
    if (!$result) {
        die("Query failed: " . $stmt->error);
    }

    // Fetch and process the results



    // Fetch and process the results
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $qr_code = $row['code'];

            // Output or use $qr_code as needed
            echo "QR Code: $qr_code";
        }
    } else {
        echo "No results found.";
    }

    // Close the result set
    $result->close();
} else {
    echo "Session not set.";
}




// Close the prepared statement
$stmt->close();

// Close the database connection
$conn->close();
?>


<?php
// Start or resume the session


// Establish database connection
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'attended_system';

$conn = new mysqli($hostname, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
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
    $stmt->bind_param("s", $s_id);
    $stmt->execute();

    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    // If course_id is found, retrieve the faculty from the module table
    if ($data['course_id']) {
        $courseId = $data['course_id'];

        $facultyQuery = "SELECT faculty FROM module WHERE module_code = ?";
        $facultyStmt = $conn->prepare($facultyQuery);
        $facultyStmt->bind_param("s", $courseId);
        $facultyStmt->execute();

        $facultyResult = $facultyStmt->get_result();
        $facultyData = $facultyResult->fetch_assoc();

        $data['faculty'] = $facultyData['faculty'];

        $facultyStmt->close();
    }

    // Find the date_and_time column in the qr_data table by the t_id
    $tId = $data['t_id'];

    $dateTimeQuery = "SELECT date_and_time FROM qr_data WHERE t_id = ?";
    $dateTimeStmt = $conn->prepare($dateTimeQuery);
    $dateTimeStmt->bind_param("s", $tId);
    $dateTimeStmt->execute();

    $dateTimeResult = $dateTimeStmt->get_result();
    $dateTimeData = $dateTimeResult->fetch_assoc();

    $data['date_and_time'] = $dateTimeData['date_and_time'];

    $dateTimeStmt->close();

    // Check if 'faculty' is null before accessing it
    if ($data['faculty'] === null) {
        $data['faculty'] = "N/A"; // Set a default value or handle it accordingly
    }

    // Separate data into individual keys in the JSON output
    $output = [
        'course' => $data['course'],
        'course_id' => $data['course_id'],
        'module' => $data['module'],
        't_id' => $data['t_id'],
        'code' => $data['code'],
        'faculty' => $data['faculty'],
        'date_and_time' => $data['date_and_time'],
    ];


    $output1 = [
        $data['code'],
    ];
    
    $jsonOutput1 = json_encode($output1, JSON_UNESCAPED_UNICODE);
    

    $jsonOutput1 = trim($jsonOutput1, '[]{} ""');
    
    // echo $jsonOutput1;




    $output4 = [
        $data['code'],
    ];

    $jsonOutput4 = json_encode($output4 , JSON_UNESCAPED_UNICODE);
    

    $jsonOutput4 = trim($jsonOutput4, '[]{} ""');
    
    // echo $jsonOutput4;
    
    $output5 = [
        $data['module'],
    ];

    $jsonOutput5 = json_encode($output5 , JSON_UNESCAPED_UNICODE);
    

    $jsonOutput5 = trim($jsonOutput5, '[]{} ""');
    
    // echo $jsonOutput5;
    
    $output3 = [
        $data['date_and_time'],
    ];

    $jsonOutput3 = json_encode($output3 , JSON_UNESCAPED_UNICODE);
    

    $jsonOutput3 = trim($jsonOutput3, '[]{} ""');
    
    // echo $jsonOutput3;
    

    
   
    
 

    $stmt->close();
} else {
    echo "Session not set"; 
}

$conn->close();
?>











<div class="mobile-menu-overlay"></div>
<div class="main-container">

    <div class="row pb-10">
        <div class="col-md-9 mb-20">
            <div class="card-box height-100-p pd-20">
            

              
                    <div class="row">
                        <div class="col-sm-7">

                        
                              
                                    <form action="" method="POST">
                                        
                                    <div class="row  mt-1 pt-5">
                                            <div class="col-sm-5"><p>Registartion No </p></div>
                                            <div class="col-sm-7"><p>: <?php echo  $s_id; ?></p></div>
                                        </div>
                                        

                                        <div class="row ">
                                            <div class="col-sm-5"><p>Name </p></div>
                                            <div class="col-sm-7"><p>: <?php echo  $f_name; ?></p></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-5"><p>Module  </p></div>
                                            <div class="col-sm-7"><p>: <?php  echo $jsonOutput5; ?></p></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-5"><p>Code </p></div>
                                            <div class="col-sm-7"><p>: <?php  echo $jsonOutput4; ?></p></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-5"><p>Date  </p></div>
                                            <div class="col-sm-7"><h6p>: <?php  echo $jsonOutput3; ?></h6p></div>
                                        </div>
                                        
                                    
                                    </form>
                               
                                    </div>
                                        <div class="col-sm-5">
                                            <div class="atend_fing_img">
                                                        <img src="./img/Artboard 1 13.png" alt="">
                                            </div>
                     
                                        <button type="button" class="btn btn-primary ">Refresh <i class="fa fa-refresh" aria-hidden="true"></i></button>

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