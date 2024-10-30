<?php include './header.php'; ?>


<style>
	.card-box {
		width: 100%;
		height: 100%;
	}

	.nav-link{
		/* font-size: 20px; */
		font-weight: bold;
		
		border-radius: 10px;
		background-color: rgba(255, 255, 255, 0.2);
	
		transition: 0.5s;
		box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
	
		cursor: pointer;
		
		

	}

	.crd-box-img1{
		width: 100%;
		height: auto !important;
		background-position: right top;
		background-repeat: no-repeat;
		background-image: url('./vendors/images/Artboard_1_28.svg');
		background-size: fixed;
		
	}


	.crd-box-img2{
		width: 100%;
		height: auto !important;
		background-position: right top;
		background-repeat: no-repeat;
		background-image: url('./vendors/images/Artboard_1_31.svg');
		background-size: fixed;
		
	}
	
	.crd-box-img3{
		width: 100%;
		height: auto !important;
		background-position: right top;
		background-repeat: no-repeat;
		background-image: url('./src/images/Artboard 1 29.png');
		background-size: fixed;
		
	}
</style>

<div class="main-container">



	



			<!-- xjclclmc -->



			<div class="pd-20 card-box ">
				<h5 class="h4 text-blue mb-20"> Users Addding Section</h5>

				<div class="tab "  >
					<ul class="nav nav-tabs customtab" role="tablist">
						<li class="nav-item mx-4 my-1">
							<a class="nav-link active" data-toggle="tab" href="#home2" role="tab" aria-selected="true">Admin</a>
						</li>
						<li class="nav-item mx-4 my-1">
							<a class="nav-link" data-toggle="tab" href="#profile2" role="tab" aria-selected="false">Teacher</a>
						</li>
						<li class="nav-item mx-4 my-1">
							<a class="nav-link" data-toggle="tab" href="#contact2" role="tab" aria-selected="false">Student</a>
						</li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane fade show active" id="home2" role="tabpanel">
							<div class="pd-20">
								<div class="admin_main crd-box-img1">
								<div class="row  " >
	<div class="col-md-6 ">
									<form action="./php/reg.php" method="post">

				

										<div class="form-group">
											<label>Frist Name</label>
											<input class="form-control form-control-lg" type="text" name="fname" placeholder="Your Frist Name " required />
										</div>

										<div class="form-group">
											<label>Last Name</label>
											<input class="form-control form-control-lg" type="text" name="lname" placeholder="Your Last Name" required />
										</div>
										<!-- Only letters, numbers, and white space allowed -->
										<div class="form-group">
											<label>User Name</label>
											<input class="form-control form-control-lg " type="text" name="uname" value="<?php echo ''; ?>" placeholder="Your UserName" required data-toggle="tooltip" title="Only letters, and white space allowed"/>
										</div>

										<div class="form-group">
											<label>Email</label>
											<input class="form-control form-control-lg" type="email" name="email" placeholder="Test@gmail.com" required />
										</div>

										<div class="form-group">
											<label>Password</label>
											<input class="form-control form-control-lg" type="password" name="password" required />
										</div>



										<div class="form-group">
											<label>Date of birth</label>
											<input class="form-control form-control-lg date-picker" type="text" name="dob" />
										</div>

										<div class="form-group">
											<label>NIC Number</label>
											<input class="form-control form-control-lg" type="text" name="nic" />
										</div>

										<div class="form-group">
											<label>Phone Number</label>
											<input class="form-control form-control-lg" type="text" name="phone_number" />
										</div>
										<div class="form-group">
											<label>Address</label>
											<textarea class="form-control" name="address"></textarea>
										</div>

										<div class="form-group mb-0">
											<input type="submit" class="btn btn-primary" value="Send Information" name="submit" />
										</div>


									</form>




								</div>
							</div>
						</div>
					</div>
				</div>

			

						<div class="tab-pane fade" id="profile2" role="tabpanel">
							<div class="pd-20">
								<div class="admin_teacher crd-box-img2">
								<div class="row  " >
	<div class="col-md-6 ">
									<form action="./php/teacher.php" method="post">

									<div class="form-group">
                <label>Internal/External</label>
                <select class="selectpicker form-control" 
                        data-style="btn-outline-primary" 
                        title="Not Chosen" 
                        multiple 
                        data-selected-text-format="count" 
                        data-count-selected-text="{0} selected" 
                        name="internal_or_external[]">
                    <option value="1">Internal</option>
                    <option value="2">External</option>
                </select>
            </div>


										<div class="form-group">
											<label>Frist Name</label>
											<input class="form-control form-control-lg" type="text" name="fname" placeholder="Your Frist Name " required />
										</div>

										<div class="form-group">
											<label>Last Name</label>
											<input class="form-control form-control-lg" type="text" name="lname" placeholder="Your Last Name" required />
										</div>

										<div class="form-group">
											<label>User Name</label>
											<input class="form-control form-control-lg" type="text" name="uname" value="<?php echo ''; ?>" placeholder="Your UserName" required data-toggle="tooltip" title="Only letters, and white space allowed"/>
										</div>

										<div class="form-group">
											<label>Email</label>
											<input class="form-control form-control-lg" type="email" name="email" placeholder="Test@gmail.com" required />
											<input class="form-control form-control-lg" type="hidden" name="subject" value=" This is Your Token use This Token Login in TTC System   " />
											
											<!-- Add this HTML input element where you want to store the generated token -->
											<input class="form-control form-control-lg" type="hidden" name="message" id="token" value="This is Your Token. Please Use This Token to Login Our System.<br>" style="font-family: Arial, sans-serif; font-size: 16px; color: #333; padding: 10px; border: 1px solid #ccc; border-radius: 5px; background-color: #f9f9f9; margin-bottom: 10px;" />


								<!-- Add this JavaScript code to generate the token -->
								<script>
									function generateToken() {
										// Define the length of the token (you can adjust this as needed)
										const tokenLength = 16;

										// Create an array to store random bytes
										const randomBytes = new Uint8Array(tokenLength);

										// Generate cryptographically secure random values
										crypto.getRandomValues(randomBytes);

										// Convert the random bytes to hexadecimal string
										const token = Array.from(randomBytes)
											.map(byte => byte.toString(16).padStart(2, '0'))
											.join('');

										// Set the generated token as the value of the input element
										document.getElementById('token').value = token;
									}

									// Call the generateToken function when the page loads or when needed
									generateToken();
								</script>

										</div>

										<div class="form-group">
											<label>Password</label>
											<input class="form-control form-control-lg" type="password" name="password" required />
										</div>



										<div class="form-group">
											<label>Date of birth</label>
											<input class="form-control form-control-lg date-picker" type="text" name="dob" />
										</div>

										<div class="form-group">
											<label>NIC Number</label>
											<input class="form-control form-control-lg" type="text" name="nic" />
										</div>

										<div class="form-group">
											<label>Phone Number</label>
											<input class="form-control form-control-lg" type="text" name="phone_number" />
										</div>
										<div class="form-group">
											<label>Address</label>
											<textarea class="form-control" name="address"></textarea>
										</div>

										<div class="form-group mb-0">
											<input type="submit" class="btn btn-primary" value="Send Information" name="t_submit" />
										</div>


									</form>




								</div>
							</div>
						</div>

	</div>
				</div>

			

						<div class="tab-pane fade" id="contact2" role="tabpanel">
							<div class="pd-20">
								<div class="admin_student crd-box-img3">
								<div class="row " >
	<div class="col-md-6 ">
									<form action="./php/student.php" method="post">

										<!-- <div class="form-group">
											<label>Student ID</label>
											<input class="form-control form-control-lg" type="text" name="id" placeholder="Student  ID" required />
										</div> -->

										<div class="form-group">
											<label>Frist Name</label>
											<input class="form-control form-control-lg" type="text" name="fname" placeholder="Your Frist Name " required />
										</div>

										<div class="form-group">
											<label>Last Name</label>
											<input class="form-control form-control-lg" type="text" name="lname" placeholder="Your Last Name" required />
										</div>

										<div class="form-group">
											<label>User Name</label>
											<input class="form-control form-control-lg" type="text" name="uname" value="<?php echo ''; ?>" placeholder="Your UserName" required data-toggle="tooltip" title="Only letters, and white space allowed"/>
										</div>

										<div class="form-group">
											<label>Email</label>
											<input class="form-control form-control-lg" type="email" name="email" placeholder="Test@gmail.com" required />
											<input class="form-control form-control-lg" type="hidden" name="subject" value=" This is Your Token use This Token Login in TTC System   " />
											
											<!-- Add this HTML input element where you want to store the generated token -->
											<input class="form-control form-control-lg" type="hidden" name="message" id="token" value="This is Your Token. Please Use This Token to Login Our System.<br>" style="font-family: Arial, sans-serif; font-size: 16px; color: #333; padding: 10px; border: 1px solid #ccc; border-radius: 5px; background-color: #f9f9f9; margin-bottom: 10px;" />


								<!-- Add this JavaScript code to generate the token -->
								<script>
									function generateToken() {
										// Define the length of the token (you can adjust this as needed)
										const tokenLength = 16;

										// Create an array to store random bytes
										const randomBytes = new Uint8Array(tokenLength);

										// Generate cryptographically secure random values
										crypto.getRandomValues(randomBytes);

										// Convert the random bytes to hexadecimal string
										const token = Array.from(randomBytes)
											.map(byte => byte.toString(16).padStart(2, '0'))
											.join('');

										// Set the generated token as the value of the input element
										document.getElementById('token').value = token;
									}

									// Call the generateToken function when the page loads or when needed
									generateToken();
								</script>

										</div>



										<div class="form-group">
											<label>Password</label>
											<input class="form-control form-control-lg" type="password" name="password" required />
										</div>




										<div class="form-group">
											<label>Date of birth</label>
											<input class="form-control form-control-lg date-picker" type="text" name="dob" placeholder="<?php echo date('y:m:H'); ?>"/>
										</div>

										<div class="form-group">
											<label>NIC Number</label>
											<input class="form-control form-control-lg" type="text" name="nic" placeholder="123456789v" />
										</div>

										<div class="form-group">
											<label>Degree Programe</label>
											<input class="form-control form-control-lg" type="text" name="degree" placeholder="Software Engineering" />
										</div>
                                          

										<div class="form-group">
											<label>Degree Code</label>
											<input class="form-control form-control-lg" type="text" name="degree_code" placeholder="SE" />
										</div>

										<div class="form-group">
											<label>Year</label>
											<input class=" form-control-lg form-control datetimepicker-range" type="text" name="year" placeholder="<?php echo date('Y'); ?>"/>
										</div>

										<div class="form-group">
											<label>Batch</label>
											<input class="form-control form-control-lg" type="text" name="batch" placeholder="10A" />
										</div>

										<div class="form-group">
											<label>Phone Number</label>
											<input class="form-control form-control-lg" type="text" name="phone_number" placeholder="123456789"/>
										</div>
										<div class="form-group">
											<label>Address</label>
											<textarea class="form-control" name="address"></textarea>
										</div>

										<div class="form-group mb-0">
											<input type="submit" class="btn btn-primary" value="Send Information" name="stu_submit" />
										</div>


									</form>




								</div>
							</div>
						</div>
					</div>
				</div>
	


		</div>

</div>
</div>
</div>
		<script>
			// Wait for the document to be ready
			$(document).ready(function() {
				// Initially hide the batch field
				$('#batchField').hide();

				// Add change event listener to the user role dropdown
				$('#userRole').change(function() {
					// Get the selected value
					var selectedRole = $(this).val();

					// Check the selected role and show/hide the batch field accordingly
					if (selectedRole == '1') { // Student
						$('#batchField').show();
					} else {
						$('#batchField').hide();
					}
				});
			});


			$(document).ready(function() {
				// Initially hide the batch field
				$('#batchField1').hide();

				// Add change event listener to the user role dropdown
				$('#userRole').change(function() {
					// Get the selected value
					var selectedRole = $(this).val();

					// Check the selected role and show/hide the batch field accordingly
					if (selectedRole == '1') { // Student
						$('#batchField1').show();
					} else {
						$('#batchField1').hide();
					}
				});
			});

			$(document).ready(function() {
				// Initially hide the batch field
				$('#batchField2').hide();

				// Add change event listener to the user role dropdown
				$('#userRole').change(function() {
					// Get the selected value
					var selectedRole = $(this).val();

					// Check the selected role and show/hide the batch field accordingly
					if (selectedRole == '1') { // Student
						$('#batchField2').show();
					} else {
						$('#batchField2').hide();
					}
				});
			});
		</script>

		<?php include './footer.php'; ?>