<?php
include './header.php';
include '../config.php';


// session_start();


if (isset($_SESSION['user_id'])) {
    $f_name = $_SESSION['name'];
    $s_id = $_SESSION['user_id'];
    $email = $_SESSION['email']; // Corrected to fetch email address
  

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
        $full_name = $row['name'];
        // $email = $row['email'];
      
		$batch = $row['batch'];
        $course = strtoupper($row['degree_programe']);
        $address = strtoupper($row['address']);
        $phone_number = strtoupper($row['phone_number']);
        $nic = strtoupper($row['nic']);
        $dob = strtoupper($row['dob']);
        
        // Output the email address
        echo "User ID: $s_id, Email: $email";
    }
}

?>


 


<?php
$showPopup = !isset($_SESSION['popupDisabled']) || $_SESSION['popupDisabled'] !== true;
?>

<link rel="stylesheet" href="./Attendance/scan.css">

<style>
    .fingerprint_scan {
        display: none;
    }
</style>
		<div class="mobile-menu-overlay"></div>

		<div class="main-container">
			<div class="pd-ltr-20 xs-pd-20-10">
				<div class="min-height-200px">
					<div class="page-header">
						<div class="row">
							<div class="col-md-12 col-sm-12">
								<div class="title">
									<h4>Profile</h4>
								</div>
								<nav aria-label="breadcrumb" role="navigation">
									<ol class="breadcrumb">
										<li class="breadcrumb-item">
											<a href="index.html">Home</a>
										</li>
										<li class="breadcrumb-item active" aria-current="page">
											Profile
										</li>
									</ol>
								</nav>
							</div>
						</div>
					</div>
					

					<form action="./profile_update.php" method="post" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Full Name</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" name="name" type="text" placeholder="Full Name : <?php echo $full_name; ?>" require/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">User ID</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" name="userid" placeholder="<?php echo $s_id; ?>" type="text"  disabled />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Email</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" name="email" value="<?php echo $email; ?>" type="email" require disabled />
                        </div>
                    </div>
                 
                 

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Password</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" name="password" placeholder="password" type="password" require />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">batch</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" name="batch" value="<?php echo $batch; ?>" type="text" require  disabled />
                        </div>
                    </div>

            
					<div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Your Course</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control"  placeholder="<?php echo $course; ?>" type="text" disabled/>
                        </div>
                    </div>

					<div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Address</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" name="address"  value="<?php echo $address; ?>" placeholder="no : 123 main streat city" type="text" require/>
                        </div>
                    </div>

					<div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Telephone Number</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" name="tp" value="<?php echo $phone_number; ?>" placeholder="+94 123456789" type="text" require/>
                        </div>
                    </div>
              
					<div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Nic</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" name="nic" value="<?php echo $nic; ?>"  placeholder="123456789v" type="text" require/>
                        </div>
                    </div>

					<div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Date of Birth</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" name="dob" value="<?php echo $dob; ?>" placeholder="Date of Birth" type="dob" require/>
                        </div>
                    </div>

                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label">Profile Image</label>
                                <div class="col-sm-12 col-md-10">
                                    <div class="form-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="file1" />
                                            <label class="custom-file-label">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                    </div>
               

					<div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Finger Print</label>
                        <div class="col-sm-12 col-md-10" id="finger_scan">
                            <p class="badge badge-success px-3" id="scan_button" style="font-size:18px; cursor: pointer;">Scan</p>
                            <div class="fingerprint_scan">
                                <div class="scan">
                                    <div class="fingerprint"></div>
                                    <h3>Scanning...</h3>
                                </div>
                            </div>
                            <input class="form-control" name="finger" placeholder="Fingerprint" type="hidden" id="scan_finger"/>
                        </div>
                    </div>



<script>
    document.getElementById('scan_button').addEventListener('click', function() {
        // Show the fingerprint scan area
        document.querySelector('.fingerprint_scan').style.display = 'block';
        
        // Generate unique random token
        var token = generateToken();
        
        // Update hidden input field with token value
        document.getElementById('scan_finger').value = token;
        
        // Send token to the database (You need to implement this part)
        // For demonstration, let's just log the token
        console.log('Token sent to database:', token);
        
        // Hide the fingerprint scan area after 10 seconds
        setTimeout(function() {
            document.querySelector('.fingerprint_scan').style.display = 'none';
        }, 10000); // 10 seconds
    });

    // Function to generate a unique random token
    function generateToken() {
        var token = '';
        var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        var length = 10;
        for (var i = 0; i < length; i++) {
            token += characters.charAt(Math.floor(Math.random() * characters.length));
        }
        return token;
    }
</script>

                 

                  <button type="submit" name="submit" class="btn btn-primary mb-5  px-5">Submit</button>
                </form>















											<!-- Setting Tab End -->
										</div>
									</div>
								</div>



		<!-- js -->
		<script src="vendors/scripts/core.js"></script>
		<script src="vendors/scripts/script.min.js"></script>
		<script src="vendors/scripts/process.js"></script>
		<script src="vendors/scripts/layout-settings.js"></script>
		<script src="src/plugins/cropperjs/dist/cropper.js"></script>
		<script>
			window.addEventListener("DOMContentLoaded", function () {
				var image = document.getElementById("image");
				var cropBoxData;
				var canvasData;
				var cropper;

				$("#modal")
					.on("shown.bs.modal", function () {
						cropper = new Cropper(image, {
							autoCropArea: 0.5,
							dragMode: "move",
							aspectRatio: 3 / 3,
							restore: false,
							guides: false,
							center: false,
							highlight: false,
							cropBoxMovable: false,
							cropBoxResizable: false,
							toggleDragModeOnDblclick: false,
							ready: function () {
								cropper.setCropBoxData(cropBoxData).setCanvasData(canvasData);
							},
						});
					})
					.on("hidden.bs.modal", function () {
						cropBoxData = cropper.getCropBoxData();
						canvasData = cropper.getCanvasData();
						cropper.destroy();
					});
			});
		</script>
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
