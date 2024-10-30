<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['f_name'])) {
    $f_name = $_SESSION['f_name'];
?>



<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="./css/style.css">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
		crossorigin="anonymous"></script>

	<title>Attended system </title>
</head>

<body>


	<!-- SIDEBAR -->
	<section id="sidebar">

		<a href="#" class="brand">
			<i class='bx bxs-smile  ms-3'></i>
			<span class="text hidden-text px-2" id="myText"> Welcome, <?php echo $f_name; ?></span>
		</a>

		<ul class="side-menu top">

    <li class="active">
				<a href="./index.php">
					<i class='bx bxs-shopping-bag-alt dsh_icon'></i>
					<span class="text">Atendance</span>
				</a>
			</li>


			<li >
				<a href="./dashbord.php">
					<i class='bx bxs-dashboard dsh_icon '></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
		

      <li>
				<a href="#">
					<i class='bx bxs-shopping-bag-alt dsh_icon'></i>
					<span class="text">Atendance history</span>
				</a>
			</li>


			<li>
				<a href="#">
					<i class='bx bxs-doughnut-chart dsh_icon'></i>
					<span class="text">Analytics</span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class='bx bxs-message-dots dsh_icon'></i>
					<span class="text">Message</span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class='bx bxs-group dsh_icon'></i>
					<span class="text">Team</span>
				</a>
			</li>

			<li>
				<a href="#">
					<i class='bx bxs-cog dsh_icon'></i>
					<span class="text">Settings</span>
				</a>
			</li>

		</ul>
		<ul class="side-menu">

			<li>
				<a href="./login/logout.php" class="logout">
					<i class='bx bxs-log-out-circle dsh_icon'></i>
					<span class="text">Logout</span>
				</a>
			</li>
		</ul>
	</section>
	<!-- SIDEBAR -->



	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<nav class="py-2">
			<i class='bx bx-menu menu_bar'></i>
			<a href="#" class="nav-link">Student</a>
			<form action="#">
				<div class="form-input">
					<input type="search" placeholder="Search...">
					<button type="submit" class="search-btn"><i class='bx bx-search menu_bar'></i></button>
				</div>
			</form>
			<input type="checkbox" id="switch-mode" hidden>
			<label for="switch-mode" class="switch-mode"></label>

			<div class="dropdown">

				<a href="#" class="notification" class=" dropdown-toggle" href="#" role="button" id="dropdownMenuButton1"
					data-bs-toggle="dropdown" aria-expanded="false" class="btn btn-primary" type="button"
					data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false"
					aria-controls="collapseExample">

					<i class='bx bxs-bell menu_bar'></i>
					<span class="num">8</span>

				</a>



				<ul class="dropdown-menu">
					
					<li><a class="dropdown-item" href="#">Action  </a></li>

				</ul>
			</div>

			</div>





			<a href="#" class="profile">
				<div class="dropdown">
					<a class=" dropdown-toggle" href="#" role="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
						aria-expanded="false">
						<img src="img/people.png" alt="Profile" class="profile-img">
					</a>
					<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
						<li><a class="dropdown-item" href="./update_profile.php">Ptofile</a></li>
						<li><a class="dropdown-item" href="./login/logout.php">Logout</a></li>
					
					</ul>
				</div>
			</a>
		</nav>
	













	




<?php
} else {
    // Redirect to login.php if not logged in
	header("Location: ./login/login.php");
    exit();
}
?>


<?php
include './footer.php';

?>
