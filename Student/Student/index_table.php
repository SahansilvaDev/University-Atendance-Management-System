<?php

include '../config.php'; // Include your database configuration file

session_start(); // Start or resume the current session

date_default_timezone_set('Asia/Colombo'); // Set the timezone (change as needed)

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Current date formatted as 'd F Y' (e.g., '30 April 2024')
    $date = date('d F Y');

    // Current UNIX timestamp (seconds since Unix Epoch)
    $current_time = time();

    // Prepare and execute the SQL query
    $sql = "
        SELECT
            s.user_id,
            s.degree_code,
            s.degree_programe,
            s.batch,
            dm.module_code,
            dm.module_name,
            cqa.subject_code,
            cqa.subject_select,
            cqa.batch AS cqa_batch,
            cqa.time,
            cqa.qr_date,
            cqa.teacher_id,
            cqa.qr_code,
            (
                SELECT COUNT(*) 
                FROM create_qr_attendance 
                WHERE subject_code = cqa.subject_code 
                AND batch = cqa.batch 
                AND qr_date = cqa.qr_date
            ) AS qr_attendee_count,
            (
                SELECT COUNT(*) 
                FROM success_attend 
                WHERE user_id = s.user_id 
                AND subject_code = cqa.subject_code 
                AND MONTH(qr_date) = MONTH(CURRENT_DATE()) 
                AND YEAR(qr_date) = YEAR(CURRENT_DATE())
            ) AS success_attendee_count
        FROM
            student s
        JOIN
            degree_module dm ON s.degree_code = dm.degree_code
        JOIN
            create_qr_attendance cqa ON dm.module_code = cqa.subject_code
        WHERE
            s.user_id = '$user_id' 
            AND s.degree_code = dm.degree_code
            AND s.batch = cqa.batch;
    ";

    $result = mysqli_query($conn, $sql);

 
    if ($result) {
       
        while ($row = $result->fetch_assoc()) {
			$user_id = $row['user_id'];
			$degree_code = $row['degree_code'];
			$degree_programme = $row['degree_programe'];
			$batch = $row['batch'];
			$module_code = $row['module_code'];
			$module_name = $row['module_name'];
			$subject_code = $row['subject_code'];
			$subject_select = $row['subject_select'];
			$cqa_batch = $row['cqa_batch'];
			$time = $row['time'];
			$qr_date = $row['qr_date'];
			$teacher_id = $row['teacher_id'];
			$qr_code = $row['qr_code'];
			$qr_attendee_count = $row['qr_attendee_count'];
			$success_attendee_count = $row['success_attendee_count'];

			

			
         


           
        }

        // Free result set
        $result->free();
    } else {
       
    }

}
?>


		
		
		<!-- CSS -->
		<link rel="stylesheet" type="text/css" href="vendors/styles/core.css" />
		<link
			rel="stylesheet"
			type="text/css"
			href="vendors/styles/icon-font.min.css"
		/>
		<link
			rel="stylesheet"
			type="text/css"
			href="src/plugins/datatables/css/dataTables.bootstrap4.min.css"
		/>
		<link
			rel="stylesheet"
			type="text/css"
			href="src/plugins/datatables/css/responsive.bootstrap4.min.css"
		/>
		<link rel="stylesheet" type="text/css" href="vendors/styles/style.css" />

		<div class="mobile-menu-overlay"></div>

		<div class="main-container">
		
				<div class="card-box mb-30">
					<h2 class="h4 pd-20">Subjects</h2>
				

				

					
				
						<div class="pb-20">
							<table class="data-table table stripe hover nowrap">
								<thead>
									<tr>
										<th class="table-plus datatable-nosort">Subject Code</th>
										<th>Subject Name</th>
				
										<th>Start Date</th>
										<th class="datatable-nosort">Action</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td class="table-plus">cs</td>
										<td>25</td>
										
										<td>29-03-2018</td>
										<td>
											<div class="dropdown">
												<a
													class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
													href="#"
													role="button"
													data-toggle="dropdown"
												>
													<i class="dw dw-more"></i>
												</a>

												<div
													class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"
												>
													<a class="dropdown-item" href="#"
														><i class="dw dw-eye"></i> View</a
													>
													<a class="dropdown-item" href="#"
														><i class="dw dw-edit2"></i> Edit</a
													>
													<a class="dropdown-item" href="#"
														><i class="dw dw-delete-3"></i> Delete</a
													>
												</div>
											</div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<!-- Simple Datatable End -->
					
				</div>
				
			</div>
		</div>
	


			<!-- js -->
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
	
		<!-- End Google Tag Manager (noscript) -->

		

