<?php include './header.php';  ?>
<?php

include '../config.php';




$st_sql = "SELECT count(*) as st_count FROM student";
$st_result = mysqli_query($conn, $st_sql);
$row = mysqli_fetch_assoc($st_result);
$st_count = $row['st_count'];



$dm_sql = "SELECT count(*) as dm_count FROM degree_module ";
$dm_result = mysqli_query($conn, $dm_sql);
$row1 = mysqli_fetch_assoc($dm_result);
$dm_count = $row1['dm_count'];


$sa_sql = "SELECT count(*) as sa_count FROM success_attend where teacher_id = '$t_id' ";
$sa_result = mysqli_query($conn, $sa_sql);
$row2 = mysqli_fetch_assoc($sa_result);
$sa_count = $row2['sa_count'];


$qr_sql = "SELECT count(*) as qr_count FROM create_qr_attendance where teacher_id = '$t_id' ";
$qr_result = mysqli_query($conn, $qr_sql);
$row2 = mysqli_fetch_assoc($qr_result);
$qr_count = $row2['qr_count'];


?>




 <div class="main-container">
	<div class="xs-pd-20-10 pd-ltr-20">
		<div class="title pb-20">
			<h2 class="h3 mb-0">Atendance Overview</h2>

		</div>

		<div class="row pb-10">
			<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
				<div class="card-box height-100-p widget-style3">
					<div class="d-flex flex-wrap">
						<div class="widget-data">
							<div class="weight-300 font-18 text-dark">
								<?php
								$currentDate = date("d/m/Y");
								echo  $currentDate;

								?>
							</div>
							<div class="font-14 text-secondary weight-500">
								Day
							</div>
						</div>
						<div class="widget-icon">
							<div class="icon" data-color="#00eccf">
								<i class="icon-copy dw dw-calendar1"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
				<div class="card-box height-100-p widget-style3">
					<div class="d-flex flex-wrap">
						<div class="widget-data">
							<div class="weight-700 font-24 text-dark"><?php echo $st_count; ?></div>
							<div class="font-14 text-secondary weight-500">
								Total Students
							</div>
						</div>
						<div class="widget-icon">
							<div class="icon" data-color="#ff5b5b">
								<span class="icon-copy ti-user"></span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
				<div class="card-box height-100-p widget-style3">
					<div class="d-flex flex-wrap">
						<div class="widget-data">
							<div class="weight-700 font-24 text-dark"><?php echo $dm_count; ?></div>
							<div class="font-14 text-secondary weight-500">
								Total Modules
							</div>
						</div>
						<div class="widget-icon">
							<div class="icon">
								<i class="icon-copy fa fa-book" aria-hidden="true"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
				<div class="card-box height-100-p widget-style3">
					<div class="d-flex flex-wrap">
						<div class="widget-data">
							<div class="weight-700 font-24 text-dark"><?php echo $sa_count; ?></div>
							<div class="font-14 text-secondary weight-500">Atendance Count</div>
						</div>
						<div class="widget-icon">
							<div class="icon" data-color="#09cc06">
								<i class="icon-copy fa fa-clock-o" aria-hidden="true"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row pb-10">
			<div class="col-md-8 mb-20">
				<div class="card-box height-100-p pd-20  text-center">
					<div class="d-flex flex-wrap justify-content-between align-items-center pb-0 pb-md-3">
						<!-- <div class="h5 mb-md-0">Teacher Activities</div> -->
						<!-- <div class="form-group mb-md-0">
									<select class="form-control form-control-sm selectpicker">
										<option value="">Last Week</option>
										<option value="">Last Month</option>
										<option value="">Last 6 Month</option>
										<option value="">Last 1 year</option>
									</select>
								</div> -->
					</div>
					<!-- <div id="activities-chart"></div> -->


					<img src="./src/images/Asset-12.svg" alt="" style="height:23rem;">
				</div>
			</div>
			<div class="col-md-4 mb-20">
				<div class="card-box min-height-200px pd-20 mb-20" data-bgcolor="#455a64">
					<div class="d-flex justify-content-between pb-20 text-white">
						<div class="icon h1 text-white">
							<i class="fa fa-calendar" aria-hidden="true"></i>
							<!-- <i class="icon-copy fa fa-stethoscope" aria-hidden="true"></i> -->
						</div>
						<div class="font-14 text-right">
							<div><i class="icon-copy ion-arrow-up-c"></i> 2.69%</div>
							<div class="font-12">Since last month</div>
						</div>
					</div>
					<div class="d-flex justify-content-between align-items-end">
						<div class="text-white">
							<div class="font-14">engage attendance</div>
							<div class="font-24 weight-500"><?php echo $sa_count; ?></div>
						</div>
						<div class="max-width-150">
							<div id="appointment-chart"></div>
						</div>
					</div>
				</div>
				<div class="card-box min-height-200px pd-20" data-bgcolor="#265ed7">
					<div class="d-flex justify-content-between pb-20 text-white">
						<div class="icon h1 text-white">
							<i class="fa fa-clock-o" aria-hidden="true"></i>
						</div>
						<div class="font-14 text-right">
							<div><i class="icon-copy ion-arrow-down-c"></i> 3.69%</div>
							<div class="font-12">Since last month</div>
						</div>
					</div>
					<div class="d-flex justify-content-between align-items-end">
						<div class="text-white">
							<div class="font-14">Total attendance</div>
							<div class="font-24 weight-500"><?php echo $qr_count;  ?></div>
						</div>
						<div class="max-width-150">
							<div id="surgery-chart"></div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-4 col-md-6 mb-20" style="height: 25rem;">
				<div class="card-box height-100-p pd-20 min-height-200px">
					<div class="d-flex justify-content-between pb-10">
						<div class="h5 mb-0">Other Teachers</div>
						<div class="dropdown">
							<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" data-color="#1b3133" href="#" role="button" data-toggle="dropdown">
								<i class="dw dw-more"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
								<a class="dropdown-item" href="#"><i class="dw dw-eye"></i> View</a>
								<!-- Add other dropdown items if needed -->
							</div>
						</div>
					</div>

					<div class="user-list" style="overflow-y: auto;">
						<ul>
							<?php
							$t_sql = "SELECT * FROM teacher WHERE internal_external = '2'";
							$t_result = mysqli_query($conn, $t_sql);
							$t_num_rows = mysqli_num_rows($t_result);
							if ($t_num_rows > 0) {
								while ($t_row = mysqli_fetch_assoc($t_result)) {
									$user_id = $t_row['user_id'];
									$fname = $t_row['fname'];
									$lname = $t_row['lname'];
									$email = $t_row['email'];
							?>
									<li class="d-flex align-items-center justify-content-between">
										<div class="name-avatar d-flex align-items-center pr-2">
											<div class="avatar mr-2 flex-shrink-0">
												<img src="vendors/images/photo1.jpg" class="border-radius-100 box-shadow" width="50" height="50" alt="" />
											</div>
											<div class="txt">
												<span class="badge badge-pill badge-sm" data-bgcolor="#e7ebf5" data-color="#265ed7">4.9</span>
												<div class="font-14 weight-600"><?php echo $fname; ?></div>
												<div class="font-12 weight-500" data-color="#b2b1b6">Pediatrician</div>
											</div>
										</div>
										<div class="cta flex-shrink-0">
											<a href="#" class="btn btn-sm btn-outline-primary">Schedule</a>
										</div>
									</li>
							<?php
								}
							}
							?>
						</ul>
					</div>
				</div>
			</div>

			<div class="col-lg-4 col-md-6 mb-20">
				<div class="card-box height-100-p pd-20 min-height-200px">
					<div class="d-flex justify-content-between">
						<div class="h5 mb-0"> Report</div>
						<div class="dropdown">
							<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" data-color="#1b3133" href="#" role="button" data-toggle="dropdown">
								<i class="dw dw-more"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
								<a class="dropdown-item" href="#"><i class="dw dw-eye"></i> View</a>

							</div>
						</div>
					</div>

					<div id="chart9"></div>

				</div>
			</div>
			<div class="col-lg-4 col-md-12 mb-20">
				<div class="card-box height-100-p pd-20 min-height-200px">
					<div class="max-width-300 mx-auto">
						<img src="vendors/images/upgrade.svg" alt="" />
					</div>
					<div class="text-center">
						<div class="h5 mb-1"></div>
						<div class="font-14 weight-500 max-width-200 mx-auto pb-20" data-color="#a6a6a7">

						</div>
						<a href="#" class="btn btn-primary btn-lg">You can grow</a>
					</div>
				</div>
			</div>
		</div>

		<div class="card-box pb-10">
			<div class="h5 pd-20 mb-0">Classes and Details</div>
			<?php
			date_default_timezone_set('Asia/Colombo');


			if (isset($_SESSION['user_id'])) {
				$user_id = $_SESSION['user_id'];
				$filter_year = date('d F Y ');

				$sql_at_a = "SELECT t_module.t_user_id, t_module.degree_code, t_module.module_code, t_module.Faculty_code,
            CASE WHEN t_module.degree_code = degree_module.degree_code THEN degree_module.degree_name ELSE NULL END AS degree_name,
            CASE WHEN t_module.degree_code = degree_module.degree_code THEN degree_module.module_code ELSE NULL END AS module_code,
            CASE WHEN t_module.degree_code = degree_module.degree_code THEN degree_module.module_name ELSE NULL END AS module_name,
            CASE WHEN t_module.degree_code = degree_module.degree_code THEN degree_module.Faculty_code ELSE NULL END AS degree_faculty_code,
            CASE WHEN t_module.degree_code = degree_module.degree_code THEN degree_module.Faculty_name ELSE NULL END AS degree_faculty_name,
            faculty.faculty_code, faculty.faculty_name,
            student.user_id, student.degree_programe, student.batch,
            COUNT(student.user_id) AS student_count  
            FROM t_module
            LEFT JOIN degree_module ON t_module.degree_code = degree_module.degree_code
            LEFT JOIN faculty ON t_module.Faculty_code = faculty.faculty_code
            LEFT JOIN student ON t_module.degree_code = student.degree_code
            WHERE t_module.t_user_id = '$user_id'
            GROUP BY t_module.degree_code, t_module.module_code, t_module.Faculty_code";  // Grouping to count students per combination of degree, module, and faculty

				// Execute the query
				$result = mysqli_query($conn, $sql_at_a);

				// Check if the query was successful
				if ($result) {
					// Initialize variables to keep track of previously displayed records
					$previous_degree_code = null;
					$previous_module_code = null;
					$previous_faculty_code = null;
					$previous_degree_name = null;
					$previous_module_name = null;
					$previous_degree_faculty_code = null;
					$previous_degree_faculty_name = null;

					// Fetch data and display it in your HTML table
					while ($row = mysqli_fetch_assoc($result)) {
						// Check if the current record is the same as the previous one
						if (
							$row['degree_code'] != $previous_degree_code ||
							$row['module_code'] != $previous_module_code ||
							$row['faculty_code'] != $previous_faculty_code ||
							$row['degree_name'] != $previous_degree_name ||
							$row['module_name'] != $previous_module_name ||
							$row['degree_faculty_code'] != $previous_degree_faculty_code ||
							$row['degree_faculty_name'] != $previous_degree_faculty_name
						) {

							// If it's not the same, display the record
							echo "<tr>";
							$degree_code = $row['degree_code'];
							$module_code = $row['module_code'];
							$faculty_code = $row['faculty_code'];
							$degree_name = $row['degree_name'];
							$module_name = $row['module_name'];
							$degree_faculty_code = $row['degree_faculty_code'];
							$degree_faculty_name = $row['degree_faculty_name'];
							$batch = $row['batch'];
							$student_count = $row['student_count'];


							// Update the previous record variables
							$previous_degree_code = $row['degree_code'];
							$previous_module_code = $row['module_code'];
							$previous_faculty_code = $row['faculty_code'];
							$previous_degree_name = $row['degree_name'];
							$previous_module_name = $row['module_name'];
							$previous_degree_faculty_code = $row['degree_faculty_code'];
							$previous_degree_faculty_name = $row['degree_faculty_name'];
			?>













							<!-- Responsive tables Start -->

							<table class="table table-striped">
								<thead>
									<tr>
										<th scope="col">#</th>
										<th scope="col">Degree</th>
										<th scope="col">Subjects</th>
										<th scope="col">Class </th>
										<th scope="col">Student Count</th>
									</tr>
								</thead>
								<tbody>

									<tr>
										<th scope="row">1</th>
										<td><?php echo $row['degree_code'] . " - " . $row['degree_name']; ?></td>
										<td><?php echo $row['module_code'] . " - " . $row['module_name']; ?></td>
										<td><?php echo $row['batch']; ?></td>
										<td><span class="badge badge-primary"><?php echo $student_count; ?></span></td>
									</tr>

									<?php

									?>

								</tbody>
							</table>
		
		
			
            
 


	<?php
							}
						}
					} else {
						// Handle the case where the query fails
						echo "Error: " . mysqli_error($conn);
					}

					// Close the database connection
					mysqli_close($conn);
				}
	?>

		</div>


	</div>
</div>

<script src="src/plugins/apexcharts/apexcharts.min.js"></script>




<?php include './footer.php'; ?>
<script src="src/plugins/apexcharts/apexcharts.min.js"></script>
		<!-- <script src="vendors/scripts/apexcharts-setting.js"></script> -->
		<script>
	

var options9 = {
	series: [176, 67, 61, 5],
	chart: {
		height: 350,
		type: 'radialBar',
	},
	plotOptions: {
		radialBar: {
			offsetY: 0,
			startAngle: 0,
			endAngle: 270,
			hollow: {
				margin: 5,
				size: '40%',
				background: 'transparent',
				image: undefined,
			},
			dataLabels: {
				name: {
					show: false,
				},
				value: {
					show: false,
				}
			}
		}
	},
	colors: ['#1ab7ea', '#0084ff', '#39539E', '#0077B5'],
	labels: ['student Count', 'Subjects', 'Teachers', 'clasess'],
	legend: {
		show: true,
		floating: true,
		fontSize: '14px',
		position: 'left',
		offsetX: 40,
		offsetY: 15,
		labels: {
			useSeriesColors: true,
		},
		markers: {
			size: 0
		},
		formatter: function(seriesName, opts) {
			return seriesName + ":  " + opts.w.globals.series[opts.seriesIndex]
		},
		itemMargin: {
			vertical: 3
		}
	},
	responsive: [{
		breakpoint: 480,
		options: {
			legend: {
				show: false
			}
		}
	}]
};
var chart = new ApexCharts(document.querySelector("#chart9"), options9);
chart.render();
</script>