<?php
include '../config.php';
session_start();
date_default_timezone_set('Asia/Colombo');

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
	$filter_year = date('d F Y '); // Get the current date and time in the specified format

	// Output the month and date components
	

	$att_sql = "
    SELECT 
        s.user_id, 
        s.email, 
        s.degree_code, 
        s.batch, 
        dm.module_code, 
        dm.module_name,
        sa.qr_date, 
        sa.teacher_id,
        sa.qr_date      

    FROM 
        success_attend sa 
    JOIN 
        student s ON sa.user_id = s.user_id 
    JOIN 
        degree_module dm ON s.degree_code = dm.degree_code 
    WHERE 
        sa.teacher_id = '$user_id' and sa.qr_date = '$filter_year'  ";

	

    $att_result = mysqli_query($conn, $att_sql);


}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Table</title>
    <!-- Include necessary CSS -->
    <link rel="stylesheet" type="text/css" href="vendors/styles/core.css">
    <link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css">
    <link rel="stylesheet" type="text/css" href="src/plugins/switchery/switchery.min.css">
    <!-- Include your custom CSS -->
    <link rel="stylesheet" type="text/css" href="vendors/styles/style.css">
    <link rel="stylesheet" type="text/css" href="src/plugins/ion-rangeslider/css/ion.rangeSlider.css">
</head>

<body>
    <div class="card-box mb-30 ">
        <div class="pb-20 py-5">
            <table class="data-table table stripe hover nowrap mt-5">
                <thead>
                    <tr>
                        <th class="table-plus datatable-nosort">Student ID</th>
                        <th>Subject</th>
                        <th>Subject Code</th>
                        <th>Batch</th>
                        <th>Date</th>
                        <th class="datatable-nosort">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($att_result)) {
                        $user_id = $row['user_id'];
                        $subject_select = $row['module_name'];
                        $subject_code = $row['module_code'];
                        $batch = $row['batch'];
                        $qr_date = $row['qr_date'];
                    ?>
                        <tr>
                            <td class="table-plus"><?php echo $user_id; ?></td>
                            <td><?php echo $subject_select; ?></td>
                            <td><?php echo $subject_code; ?></td>
                            <td><?php echo $batch; ?></td>
                            <td><?php echo $qr_date; ?></td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                        <i class="dw dw-more"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                        <a class="dropdown-item" href="#"><i class="dw dw-eye"></i> View</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody >
            </table class="pb-5  mb-5">
        </div>
    </div>


	
	<?php 
    $currentTime = date('H:i:s'); // Get the current date and time in "Y-m-d H:i:s" format
    echo $currentTime;
    ?>

    <script src="vendors/scripts/core.js"></script>
    <script src="vendors/scripts/script.min.js"></script>
    <script src="vendors/scripts/process.js"></script>
    <script src="vendors/scripts/layout-settings.js"></script>
    <script src="src/plugins/datatables/js/jquery.dataTables.min.js"></script>
    <script src="src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
    <script src="src/plugins/datatables/js/dataTables.responsive.min.js"></script>
    <script src="src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
    <!-- buttons for Export datatable -->
    <script src="src/plugins/datatables/js/dataTables.buttons.min.js"></script>
    <script src="src/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
    <script src="src/plugins/datatables/js/buttons.print.min.js"></script>
    <script src="src/plugins/datatables/js/buttons.html5.min.js"></script>
    <script src="src/plugins/datatables/js/buttons.flash.min.js"></script>
    <script src="src/plugins/datatables/js/pdfmake.min.js"></script>
    <script src="src/plugins/datatables/js/vfs_fonts.js"></script>
    <!-- Datatable Setting js -->
    <script src="vendors/scripts/datatable-setting.js"></script>
</body>

</html>
