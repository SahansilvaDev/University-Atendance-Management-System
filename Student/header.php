<?php

include '../config.php';


?>
<?php


// Start the session
session_start();
// Set session timeout to 24 hours
$timeout_duration = 86400; // 24 hours in seconds

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout_duration) {
       
        session_unset();
        session_destroy();
        header("Location: ./login/login.php");
        exit();
    } else {
       
        $_SESSION['last_activity'] = time();

	
    }
} else {
    
    header("Location: ./login/login.php");
    exit();
}


date_default_timezone_set('Asia/Colombo');

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
	$f_name = $_SESSION['name'];
	$s_id = $_SESSION['user_id'];
    

	$s_sql = "SELECT name FROM student WHERE user_id = ?";

 

	$stmt = $conn->prepare($s_sql);
	$stmt->bind_param("s", $s_id);
	$stmt->execute();


	$result = $stmt->get_result();





?>



	<!DOCTYPE html>
	<html>

	<head>
		<!-- Basic Page Info -->
		<meta charset="utf-8" />
		<title>Atended System</title>

		<!-- Site favicon -->
		<link rel="apple-touch-icon" sizes="180x180" href="vendors/images/apple-touch-icon.png" />
		<link rel="icon" type="image/png" sizes="32x32" href="vendors/images/favicon-32x32.png" />
		<link rel="icon" type="image/png" sizes="16x16" href="vendors/images/favicon-16x16.png" />


		<!-- Mobile Specific Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

		<!-- Google Font -->
		<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
		<!-- CSS -->
		<link rel="stylesheet" type="text/css" href="vendors/styles/core.css" />
		<link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css" />
		<link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/dataTables.bootstrap4.min.css" />
		<link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/responsive.bootstrap4.min.css" />
		<link rel="stylesheet" type="text/css" href="vendors/styles/style.css" />

		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=G-GBZ3SGGX85"></script>
		<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2973766580778258" crossorigin="anonymous"></script>
		<script>
			window.dataLayer = window.dataLayer || [];

			function gtag() {
				dataLayer.push(arguments);
			}
			gtag("js", new Date());

			gtag("config", "G-GBZ3SGGX85");
		</script>
		<!-- Google Tag Manager -->
		<script>
			(function(w, d, s, l, i) {
				w[l] = w[l] || [];
				w[l].push({
					"gtm.start": new Date().getTime(),
					event: "gtm.js"
				});
				var f = d.getElementsByTagName(s)[0],
					j = d.createElement(s),
					dl = l != "dataLayer" ? "&l=" + l : "";
				j.async = true;
				j.src = "https://www.googletagmanager.com/gtm.js?id=" + i + dl;
				f.parentNode.insertBefore(j, f);
			})(window, document, "script", "dataLayer", "GTM-NXZMQSS");
		</script>
		<!-- End Google Tag Manager -->
	</head>

	<body>
		<div class="pre-loader">
			<div class="pre-loader-box">
				<a href="index.php">
					<div class="loader-logo">
					<img src="./vendors/images/logo/logo1.webp" alt="" />
					</div>
				</a>
				<div class="loader-progress" id="progress_div">
					<div class="bar" id="bar1"></div>
				</div>
				<div class="percent" id="percent1">0%</div>
				<div class="loading-text">Loading...</div>
			</div>
		</div>

		<div class="header">
			<div class="header-left">
				<div class="menu-icon bi bi-list"></div>

				<div class="search-toggle-icon bi bi-search" data-toggle="header_search"></div>
				<div class="header-search">
					<form>
						<div class="form-group mb-0">
							<i class="dw dw-search2 search-icon"></i>
							<input type="text" class="form-control search-input" placeholder="Search Here" />
							<div class="dropdown">
								<a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
									<i class="ion-arrow-down-c"></i>
								</a>
								<div class="dropdown-menu dropdown-menu-right">
									<div class="form-group row">
										<label class="col-sm-12 col-md-2 col-form-label">From</label>
										<div class="col-sm-12 col-md-10">
											<input class="form-control form-control-sm form-control-line" type="text" />
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-12 col-md-2 col-form-label">To</label>
										<div class="col-sm-12 col-md-10">
											<input class="form-control form-control-sm form-control-line" type="text" />
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-12 col-md-2 col-form-label">Subject</label>
										<div class="col-sm-12 col-md-10">
											<input class="form-control form-control-sm form-control-line" type="text" />
										</div>
									</div>
									<div class="text-right">
										<button class="btn btn-primary">Search</button>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="header-right">
				<div class="dashboard-setting user-notification">
					<div class="dropdown">
						<a class="dropdown-toggle no-arrow" href="javascript:;" data-toggle="right-sidebar">
							<i class="dw dw-settings2"></i>
						</a>
					</div>
				</div>




				<div class="user-notification">
					<div class="dropdown">
						<a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
							<i class="icon-copy dw dw-notification"></i>
							<span class="badge notification-active"></span>
						</a>

						<div class="dropdown-menu dropdown-menu-right">
							<div class="notification-list mx-h-350 customscroll">

							<iframe src="./notify.php" frameborder="0" height="400px" scrolling="yes" style="height: 400px; width: 100%;"></iframe>


							</div>
						</div>

					</div>
				</div>

				






				<div class="user-info-dropdown">
					<div class="dropdown">
						<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
							<span class="user-icon">
								<!-- <img src="vendors/images/photo1.jpg" alt="" /> -->
								<?php

								if (isset($_SESSION['user_id'])) {
									$s_id = $_SESSION['user_id'];

									// Updated query to use prepared statement to prevent SQL injection
									$s_update_query = "SELECT * FROM student WHERE user_id = ?";
									$stmt = mysqli_prepare($conn, $s_update_query);
									mysqli_stmt_bind_param($stmt, "s", $s_id);
									mysqli_stmt_execute($stmt);
									$s_update_result = mysqli_stmt_get_result($stmt);

									if (!$s_update_result) {
										die('Query failed: ' . mysqli_error($conn));
									}

									while ($row = mysqli_fetch_assoc($s_update_result)) {
										$profile_img = $row['profile_img'];

										if ($profile_img != 'NULL') {
											echo '<img src="' . $profile_img . '" alt="" />';
										} else {
											echo '<img src="vendors/images/photo1.jpg" alt="" />';
										}
									}
								}
								?>

							</span>
							<span class="user-name"><?php echo $s_id; ?></span>
						</a>
						<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
							<a class="dropdown-item" href="profile.php"><i class="dw dw-user1"></i> Profile</a>
							<a class="dropdown-item" href="profile.php"><i class="dw dw-settings2"></i> Setting</a>
							<a class="dropdown-item" href="faq.php"><i class="dw dw-help"></i> Help</a>
							<a class="dropdown-item" href="./login/logout.php"><i class="dw dw-logout"></i> Log Out</a>
						</div>
					</div>
				</div>

			</div>
		</div>

		<div class="right-sidebar">
			<div class="sidebar-title">
				<h3 class="weight-600 font-16 text-blue">
					Layout Settings
					<span class="btn-block font-weight-400 font-12">User Interface Settings</span>
				</h3>
				<div class="close-sidebar" data-toggle="right-sidebar-close">
					<i class="icon-copy ion-close-round"></i>
				</div>
			</div>
			<div class="right-sidebar-body customscroll">
				<div class="right-sidebar-body-content">
					<h4 class="weight-600 font-18 pb-10">Header Background</h4>
					<div class="sidebar-btn-group pb-30 mb-10">
						<a href="javascript:void(0);" class="btn btn-outline-primary header-white active">Light</a>
						<a href="javascript:void(0);" class="btn btn-outline-primary header-dark">Dark</a>
					</div>

					<h4 class="weight-600 font-18 pb-10">Sidebar Background</h4>
					<div class="sidebar-btn-group pb-30 mb-10">
						<a href="javascript:void(0);" class="btn btn-outline-primary sidebar-light">Light</a>
						<a href="javascript:void(0);" class="btn btn-outline-primary sidebar-dark active">Dark</a>
					</div>

					
					<div class="reset-options pt-30 text-center">
						<button class="btn btn-danger" id="reset-settings">
							Reset Settings
						</button>
					</div>
				</div>
			</div>
		</div>

		<div class="left-side-bar">
			<div class="brand-logo">
			<a href="index.php">
					<img src="./vendors/images/logo/logo1.webp" alt="" class="dark-logo" />
					<img
						src="./vendors/images/logo/sltc.webp"
						alt=""
						class="light-logo"
					/>
				</a>
				<div class="close-sidebar" data-toggle="left-sidebar-close">
					<i class="ion-close-round"></i>
				</div>
			</div>
			<div class="menu-block customscroll">
				<div class="sidebar-menu">
					<ul id="accordion-menu">
						<li class="dropdown">
							<a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-house"></span><span class="mtext">Home</span>
							</a>
							<ul class="submenu">
								<li><a href="./make_s_attend.php">Setup Attendance</a></li>
								<!-- <li><a href="index2.html">Dashboard style 2</a></li>
								<li><a href="index3.html">Dashboard style 3</a></li> -->
							</ul>
						</li>
						<li class="dropdown">
							<a href="javascript:;" class="dropdown-toggle">
								<span class="micon"><i class="icon-copy dw dw-layout1"></i></span><span class="mtext">Schedule Details</span>
							</a>
							<ul class="submenu">
								<li><a href="./my_schedule.php">My schedule</a></li>


							</ul>
						</li>
						<!-- <li class="dropdown">
							<a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-table"></span
								><span class="mtext">Module Details</span>
							</a>
							<ul class="submenu">
								<li><a href="./">Details</a></li>
								
							</ul>
						</li> -->
						<li>
							<a href="calendar.php" class="dropdown-toggle no-arrow">
								<span class="micon bi bi-calendar4-week"></span><span class="mtext">Calendar</span>
							</a>
						</li>
						<li class="dropdown">
							<a href="javascript:;" class="dropdown-toggle">
								<span class="micon "><i class="icon-copy dw dw-analytics-3"></i></span><span class="mtext"> Anlysis </span>
							</a>
							<ul class="submenu">
								<li><a href="./all_Students.php">Student</a></li>
								<li><a href="./all_subject.php">Modules</a></li>
								<li><a href="./attendance_any.php">Attendance</a></li>
								<li><a href="./all_any.php">All Details</a></li>


							</ul>
						</li>
						<li class="dropdown">
							<a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-command"></span><span class="mtext">Export</span>
							</a>
							<ul class="submenu">
								<li><a href="./export.php">Export</a></li>


							</ul>
						</li>


						<li>
							<a href="chat.php" class="dropdown-toggle no-arrow">
								<span class="micon bi bi-chat-right-dots"></span><span class="mtext">Chat</span>
							</a>
						</li>
						<li>

						</li>

					</ul>
				</div>
			</div>
		</div>




		<!-- welcome modal start -->
		<div class="welcome-modal">
			<button class="welcome-modal-close">
				<i class="bi bi-x-lg"></i>
			</button>
			<iframe class="w-100 border-0" src="https://embed.lottiefiles.com/animation/31548"></iframe>
			<div class="text-center">
				<input type="text" name="" id="">
			</div>
			<div class="text-center mb-1">


			</div>
			<a href="" class="btn btn-success btn-sm mb-0 mb-md-3 w-100">
				chat Us
				<i class="fa fa-download"></i>
			</a>

		</div>

		<button class="welcome-modal-btn">
			<i class="fa fa-comment"></i> Chat Us
		</button>
		<!-- welcome modal end -->




	<?php
} else {

	header("Location: ./login/login.php");

	exit();
}

	?>