<?php  include'./header.php';?>


<main class="ps-3">

<div class="head-title">
				<div class="left">
					<h3>Welcome</h3>
					<ul class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right menu_bar'></i></li>
						<li>
							<a class="active" href="#">Home</a>
						</li>
					</ul>
				</div>
				<a href="#" class="btn-download">
					<i class='bx bxs-cloud-download '></i>
					<span class="text">Download PDF</span>
				</a>
			</div>

			<div class="main_section ms-2 ">
				<div class="row">
					<div class="col-lg-6">
						<div class="dsh_img">
							<img src="img/dashboard.jpg" alt="" />
						</div>
					</div>

					<div class="col-lg-6 main_mobile_section">
						<!-- frist layer -->

						<div class="row mb-4">
							<div class="col-sm-6 main_mobile_crd_sec">
								<div class="card color_blue dsh_main_side_section">
									<div class="card-body">
										This is some text within a card body.
									</div>
								</div>
							</div>

							<div class="col-sm-6 ">
								<div class="card color_teal dsh_main_side_section">
									<div class="card-body">
										This is some text within a card body.
									</div>
								</div>
							</div>

						</div>
						<!-- end frist layer -->




						<!-- second lyer -->

						<div class="row">
							<div class="col-sm-6 main_mobile_crd_sec">
								<div class="card color_red dsh_main_side_section">
									<div class="card-body">
										This is some text within a card body.
									</div>
								</div>
							</div>

							<div class="col-sm-6 main_mobile_crd_sec">
								<div class="card color_gray dsh_main_side_section">
									<div class="card-body">
										This is some text within a card body.
									</div>
								</div>
							</div>
						</div>

						<!-- end seocnd lyer -->
					</div>
				</div>

			</div>

			<!-- second section -->

			<div class="scond_section my-4">
				<div class="row">
					<div class="col-sm-6">
						<div class="card main_stu_crd_charts">
							<div class="card-body">
								<h2>student report</h2>
								<!-- charts -->
								<div class="main_stu_charts">
									<html>

									<head>
										<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
										<script type="text/javascript">
											google.charts.load('current', { 'packages': ['corechart'] });
											google.charts.setOnLoadCallback(drawChart);

											function drawChart() {

												var data = google.visualization.arrayToDataTable([
													['Task', 'Hours per week', { role: 'style' }],
													['Attendance', 20, 'color: #3366cc'],
													['Modules', 5, 'color: #dc3912'],
													['Project Management', 10, 'color: #ff9900'],
													['Testing', 8, 'color: #109618'],
													['Documentation', 7, 'color: #990099']
												]);

												var options = {
													title: 'My Daily Activities'
												};

												var chart = new google.visualization.PieChart(document.getElementById('piechart'));

												chart.draw(data, options);
											}
										</script>
									</head>

									<body>
										<div id="piechart" style="width: 100%; height: 300px;"></div>
									</body>

									</html>


								</div>

								<!-- end charts -->
							</div>
						</div>
					</div>
					<div class="col-sm-6">




						<div class="card main_section_todo">
							<div class="card-body">
								<div class="container todo-container">
									<h2 class="text-center my-4">To-Do List</h2>
									<div class="input-group mb-3">
										<input type="text" id="taskInput" class="form-control" placeholder="Add a new task"
											aria-label="Add a new task" aria-describedby="addTaskButton">
										<div class="input-group-append">
											<button class="btn btn-outline-secondary  bg_svg_task" type="button" id="addTaskButton">
												<svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512" >
													<path
														d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z" />
												</svg>
											</button>
										</div>
									</div>
									<ul class="list-group" id="taskList">
										<!-- Tasks will be added dynamically here -->
									</ul>
								</div>
							</div>
						</div>

					</div>


				</div>
			</div>


			</div>
			</div>
</main>
</section>

      <?php include './footer.php'; ?>