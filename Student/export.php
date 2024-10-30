<?php include './header.php'; ?>




<a href="#" class="btn-block" data-toggle="modal" data-target="#success-modal" type="button">
	123
</a>
<div class="modal fade" id="success-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-body text-center font-18">
				<h3 class="mb-20">Form Submitted!</h3>
				<div class="mb-30 text-center">
					<img src="vendors/images/success.png" />
				</div>
				Lorem ipsum dolor sit amet, consectetur adipisicing
				elit, sed do eiusmod
			</div>
			<div class="modal-footer justify-content-center">
				<button type="button" class="btn btn-primary" data-dismiss="modal">
					Done
				</button>
			</div>
		</div>
	</div>
</div>


<?php
// Include the configuration file
include '../config.php';

// Check if user is logged in
if (isset($_SESSION['user_id'])) {
    // Retrieve user_id from session
    $user_id = $_SESSION['user_id'];

    // SQL query to retrieve success attendance records for the logged-in user
    $st_suc_att = "SELECT * FROM success_attend WHERE user_id = '$user_id'";
    $result_suc_att = mysqli_query($conn, $st_suc_att);

    // Check if the query was executed successfully
    if ($result_suc_att) {
        // Get the number of rows (number of attendance records)
        $row_suc_att_count = mysqli_num_rows($result_suc_att);
?>

        <div class="main-container">
            <div class="pd-ltr-20">
                <div class="card-box pd-20 height-100-p mb-30">
                    <div class="row align-items-center">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <h3>Export Attendance</h3>
                        </div>
                    </div>
                </div>

                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">    </h4>
                    </div>
                    <div class="pb-20">
                        <table class="table hover multiple-select-row data-table-export nowrap">
                            <thead>
                                <tr>
                                    <th class="table-plus datatable-nosort">Attendance ID</th>
                                    <th>Subject</th>
                                    <th>Batch</th>
                                    <th>QR Code</th>
                                    <th>QR Date</th>
                                    <th>Teacher ID</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Check if there are any attendance records
                                if ($row_suc_att_count > 0) {
                                    // Loop through each attendance record
									$id =0;
                                    while ($row_suc_att = mysqli_fetch_assoc($result_suc_att)) {
                                        // Extract attendance details from the fetched row
                                        
                                        $subject_code = $row_suc_att['subject_code'];
                                        $subject_select = $row_suc_att['subject_select'];
                                        $batch = $row_suc_att['batch'];
                                        $qr_code = $row_suc_att['qr_code'];
                                        $qr_date = $row_suc_att['qr_date'];
                                        $teacher_id = $row_suc_att['teacher_id'];
                                        $date = $row_suc_att['date'];

										$id++;
                                ?>
                                        <tr>
                                            <td class="table-plus"><?php echo $id; ?></td>
                                            <td><?php echo $subject_select; ?></td>
                                            <td><?php echo $batch; ?></td>
                                            <td><?php echo $qr_code; ?></td>
                                            <td><?php echo $qr_date; ?></td>
                                            <td><?php echo $teacher_id; ?></td>
                                            <td><?php echo $date; ?></td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    // Display a message if no attendance records found
                                    echo '<tr><td colspan="7">No attendance records found.</td></tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

<?php
    } else {
        // Handle query execution error
        echo "Error executing query: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    // Display a message if user is not logged in
    echo "User ID not found in session.";
}
?>



	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="vendors/styles/core.css" />
	<link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css" />
	<link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/dataTables.bootstrap4.min.css" />
	<link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/responsive.bootstrap4.min.css" />
	<link rel="stylesheet" type="text/css" href="vendors/styles/style.css" />

	<!-- JS -->
	<script src="vendors/scripts/core.js"></script>
	<script src="vendors/scripts/script.min.js"></script>
	<script src="vendors/scripts/process.js"></script>
	<script src="vendors/scripts/layout-settings.js"></script>
	<script src="src/plugins/datatables/js/jquery.dataTables.min.js"></script>
	<script src="src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
	<script src="src/plugins/datatables/js/dataTables.responsive.min.js"></script>
	<script src="src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
	<script src="src/plugins/datatables/js/dataTables.buttons.min.js"></script>
	<script src="src/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
	<script src="src/plugins/datatables/js/buttons.print.min.js"></script>
	<script src="src/plugins/datatables/js/buttons.html5.min.js"></script>
	<script src="src/plugins/datatables/js/buttons.flash.min.js"></script>
	<script src="src/plugins/datatables/js/pdfmake.min.js"></script>
	<script src="src/plugins/datatables/js/vfs_fonts.js"></script>
	<script src="vendors/scripts/datatable-setting.js"></script>