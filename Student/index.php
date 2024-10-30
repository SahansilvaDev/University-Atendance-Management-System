
<?php include './header.php';  ?>
		<?php

include '../config.php';


if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

$sql_as = "SELECT 
sa.user_id,
sa.subject_code,
sa.subject_select,
sa.batch,
sa.teacher_id,
sa.qr_date AS success_qr_date,
cqra.qr_date AS create_qr_date,
COUNT(DISTINCT cqra.subject_code) AS attendance_added,
COUNT(DISTINCT sa.subject_code) AS attendance_added1
FROM 
success_attend sa
INNER JOIN 
create_qr_attendance cqra ON sa.subject_code = cqra.subject_code
AND sa.subject_select = cqra.subject_select
AND sa.batch = cqra.batch
AND sa.teacher_id = cqra.teacher_id
AND sa.qr_date = cqra.qr_date
WHERE 
sa.user_id = '$user_id'
GROUP BY 
sa.user_id,
sa.subject_code,
sa.subject_select,
sa.batch,
sa.teacher_id,
sa.qr_date,
cqra.qr_date
HAVING 
COUNT(DISTINCT cqra.subject_code) = 1
AND COUNT(DISTINCT sa.subject_code) = 1
ORDER BY 
COUNT(sa.subject_code) DESC
LIMIT 4";

    $result_as = mysqli_query($conn, $sql_as);

    if ($result_as) {
        while ($row_as = mysqli_fetch_assoc($result_as)) {
            $subject_code = $row_as['subject_code'];
            $subject_select = $row_as['subject_select'];
            $user_id = $row_as['user_id'];
            
            // Process further if needed

           
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }

   
}
?>


		
		<!-- CSS -->
		
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
			<div class="pd-ltr-20">
				<div class="card-box pd-20 height-100-p mb-30">
					<div class="row align-items-center">
						<div class="col-md-4">
							<img src="vendors/images/banner-img.png" alt="" />
						</div>
						<div class="col-md-8">
							<h4 class="font-20 weight-500 mb-10 text-capitalize">
								Welcome back
								<div class="weight-600 font-30 text-blue">
									
									<?php 

									
								   if ($result) {
       
									$row = mysqli_fetch_assoc($result);
							
								  
									if ($row) {
										$f_name = $row['name'];
									} else {
										echo "No records found for user_id: $user_id";
									}
								} else {
									echo "Error executing the query: " . $conn->error;
								}
								
								echo $f_name ;
								
								?>
								
							
							</div>
							</h4>
							<p class="font-16 max-width-600">
							Welcome As your modules are about to begin, it's time to attend and engage in the coursework.  Embrace the challenges, participate actively, and enjoy your learning journey!
							</p>
							<a href="./make_s_attend.php"><button type="button" class="btn btn-primary">Attend Yor Attendance</button></a>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xl-3 mb-30">
						<div class="card-box height-100-p widget-style1">
							<div class="d-flex flex-wrap align-items-center">
								<div class="progress-data">
									<div id="chart"></div>
								</div>
								<div class="widget-data">
									<div class="h4 mb-0">Subject Attendance</div>
									<div class="weight-600 font-14">waiting ...<?php
// Check if $subject_select is set, if not, display "waiting"
//echo isset($subject_select) ? $subject_select : "waiting ...";
?>
</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 mb-30">
						<div class="card-box height-100-p widget-style1">
							<div class="d-flex flex-wrap align-items-center">
								<div class="progress-data">
									<div id="chart2"></div>
								</div>
								<div class="widget-data">
									<div class="h4 mb-0">Subject Attendance</div>
									<div class="weight-600 font-14">waiting ...<?php
// Check if $subject_select is set, if not, display "waiting"
//echo isset($subject_select) ? $subject_select : "waiting ...";
?></div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 mb-30">
						<div class="card-box height-100-p widget-style1">
							<div class="d-flex flex-wrap align-items-center">
								<div class="progress-data">
									<div id="chart3"></div>
								</div>
								<div class="widget-data">
									<div class="h4 mb-0">Subject Attendance</div>
									<div class="weight-600 font-14">waiting ...<?php
// Check if $subject_select is set, if not, display "waiting"
//echo isset($subject_select) ? $subject_select : "waiting ...";
?></div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 mb-30">
						<div class="card-box height-100-p widget-style1">
							<div class="d-flex flex-wrap align-items-center">
								<div class="progress-data">
									<div id="chart4"></div>
								</div>
								<div class="widget-data">
									<div class="h4 mb-0">Subject Attendance</div>
									<div class="weight-600 font-14">waiting ...<?php
// Check if $subject_select is set, if not, display "waiting"
//echo isset($subject_select) ? $subject_select : "waiting ...";
?></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xl-8 mb-30">
						<div class="card-box height-100-p pd-20">
							<h2 class="h4 mb-20">Activity</h2>
							<div id="chart5"></div>
						</div>
						<script>
    // Get today's date
    // var today = new Date();
    // var currentMonth = today.getMonth(); // Get current month (0-indexed)
    
    // // Calculate start month (6 months back from current month)
    // var startMonth = currentMonth - 6;
    // if (startMonth < 0) {
    //     startMonth = 12 + startMonth; // Wrap around to previous year
    // }
    
    // // Create array of month labels for the last 6 months
    // var months = [];
    // for (var i = 0; i < 6; i++) {
    //     var monthIndex = (startMonth + i) % 12;
    //     var monthName = getMonthName(monthIndex);
    //     months.push(monthName);
    // }

    // // Function to get month name from month index (0-indexed)
    // function getMonthName(monthIndex) {
    //     var monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    //     return monthNames[monthIndex];
    // }

    // // Reverse months array to display in chronological order (oldest to newest)
    // months.reverse();

    // // Highcharts chart initialization with updated xAxis categories
    // Highcharts.chart('chart5', {
    //     title: {
    //         text: 'Pie point CSS'
    //     },
    //     xAxis: {
    //         categories: months
    //     },
    //     series: [{
    //         type: 'pie',
    //         allowPointSelect: true,
    //         keys: ['name', 'y', 'selected', 'sliced'],
    //         data: [
    //             ['Apples', 29.9, false],
    //             ['Pears', 71.5, false],
    //             ['Oranges', 106.4, false],
    //             ['Plums', 129.2, false],
    //             ['Bananas', 144.0, false],
    //             ['Peaches', 176.0, false],
    //             ['Prunes', 135.6, true, true],
    //             ['Avocados', 148.5, false]
    //         ],
    //         showInLegend: true
    //     }]
    // });
</script>

						</script>
					</div>
					<div class="col-xl-4 mb-30">
						<div class="card-box height-100-p pd-20">
							<h2 class="h4 mb-20">Lead Target</h2>
							<div id="chart6"></div>
						</div>
					</div>
				</div>
				<div class="card-box mb-30">

				<iframe src="./index_table.php" frameborder="0" width="100%" height="750px"></iframe>
					
				</div>
			
			</div>
		</div>

		       <!-- popup -->
			   <style>
            /* Styles for the overlay and popup */
			.overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            justify-content: center;
            align-items: center;
            z-index: 1;
        }

        .popup {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            text-align: center;
        }
    </style>	


<!-- Display overlay and popup if details are not filled and form is not submitted -->
<?php
// Start the session


// Check if the user details are not filled and the popup has not been displayed for the current user ID
if ((!isset($_SESSION['popupDisplayed']) || !$_SESSION['popupDisplayed'])) {
    // Assuming $conn is your database connection
 

    // Check if the 'nic' column is filled for the current user ID
    $stmt = $conn->prepare("SELECT nic FROM student WHERE user_id = ?");
    $stmt->bind_param("s", $_SESSION['user_id']);
    $stmt->execute();
    $stmt->bind_result($nic);
    $stmt->fetch();

    if (empty($nic)) {
        // 'nic' column is not filled, display the popup
        ?>
        <div class="overlay">
            <div class="popup">
                <p>Please fill in your details in the profile page.</p>
                <br>
                <a href="./profile.php"><button type="button" name="" id="okButton" class="btn btn-primary btn-lg btn-block">OK</button></a>
            </div>
        </div>

        <script>
            // Display the overlay and popup
            document.addEventListener("DOMContentLoaded", function () {
                document.querySelector('.overlay').style.display = 'flex';
            });

            // Set session variable when OK button is clicked
            document.getElementById('okButton').addEventListener('click', function () {
                document.querySelector('.overlay').style.display = 'none';

                // Set the session variable to indicate that the popup has been displayed for the current user ID
                <?php $_SESSION['popupDisplayed'] = $_SESSION['user_id']; ?>;
            });
        </script>
        <?php
    }
    $stmt->close();
    $conn->close();
}
?>




	
		<!-- js -->
		<script src="vendors/scripts/core.js"></script>
		<script src="vendors/scripts/script.min.js"></script>
		<script src="vendors/scripts/process.js"></script>
		<script src="vendors/scripts/layout-settings.js"></script>
		<script src="src/plugins/apexcharts/apexcharts.min.js"></script>
		<script src="src/plugins/datatables/js/jquery.dataTables.min.js"></script>
		<script src="src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
		<script src="src/plugins/datatables/js/dataTables.responsive.min.js"></script>
		<script src="src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
		<script src="vendors/scripts/dashboard.js"></script>
		<!-- Google Tag Manager (noscript) -->
		<noscript
			><iframe
				src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS"
				height="0"
				width="0"
				style="display: none; visibility: hidden"
			></iframe
		></noscript>
		<!-- End Google Tag Manager (noscript) -->
	</body>
</html>


