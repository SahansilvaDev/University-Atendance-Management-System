<?php include './link.php'; ?>


<?php

session_start();

// Access and print session variables
if (isset($_SESSION['t_id']) && isset($_SESSION['f_name'])) {
    $user_id = $_SESSION['t_id'] ;;
    $username =  $_SESSION['f_name'];




$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'attended_system';

$conn = new mysqli($hostname, $username, $password, $database);

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}



$t_s_sql = "SELECT batch FROM students";


$t_s_result = mysqli_query($conn, $t_s_sql);

if (!$t_s_result) {
	echo 'error';
}


$t_m_sql = "SELECT module_name FROM  module";


$t_m_result = mysqli_query($conn, $t_m_sql);

if (!$t_m_result) {
	echo 'error';
}



$t_stu_sql = "SELECT course FROM  students";


$t_stu_result = mysqli_query($conn, $t_stu_sql);

if (!$t_stu_result) {
	echo 'error';
}


}

?>


<script>
        $(document).ready(function() {
            $(".btn-primary").on('click', function() {
                // Get selected batches and subjects
                var selectedBatches = [];
                var selectedSubjects = [];

                $("select[placeholder='select Batch'] option:selected").each(function() {
                    selectedBatches.push($(this).val());
                });

                $("select[placeholder='select subject'] option:selected").each(function() {
                    selectedSubjects.push($(this).val());
                });

                // Get mentoring/interactive checkbox value
                var mentoringInteractive = $(".switch-btn").prop('checked') ? 1 : 0;

                // Get time and date values
                var time = $("input[name='time']").val();
                var date = $("input[name='date']").val();

                // Prepare data to send
                var sendData = {
                    batches: selectedBatches,
                    subjects: selectedSubjects,
                    mentoringInteractive: mentoringInteractive,
                    time: time,
                    date: date
                };

                // Send the data to the server using AJAX
                $.ajax({
                    type: 'POST',
                    url: 'qr.php', // Replace 'qr.php' with the correct PHP file
                    data: sendData,
                    success: function(response) {
                        console.log(response);
                        // Handle the response if needed
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            });
        });
    </script>

<div class="pd-ltr-20 xs-pd-20-10">
	<div class="min-height-200px">


		<div class="pd-20 card-box mb-30">



<div class="wizard-content">
							<form class="tab-wizard wizard-circle wizard vertical" method="post" action=""  enctype="multipart/form-data">
                                <br>
								<h5>Module Info</h5>
								<section>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Module :</label>
                                                <select
											class="custom-select2 form-control"
											name="state"
											style="width: 100%; height: 38px"
										>
											<optgroup label="Alaskan/Hawaiian Time Zone">
												<option value="AK">Alaska</option>
												<option value="HI">Hawaii</option>
											</optgroup>
											<optgroup label="Pacific Time Zone">
												<option value="CA">California</option>
												<option value="NV">Nevada</option>
												<option value="OR">Oregon</option>
												<option value="WA">Washington</option>
											</optgroup>
											<optgroup label="Mountain Time Zone">
												<option value="AZ">Arizona</option>
												<option value="CO">Colorado</option>
												<option value="ID">Idaho</option>
												<option value="MT">Montana</option>
												<option value="NE">Nebraska</option>
												<option value="NM">New Mexico</option>
												<option value="ND">North Dakota</option>
												<option value="UT">Utah</option>
												<option value="WY">Wyoming</option>
											</optgroup>
										</select>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Batch :</label>
                                     

										<select class="custom-select2 form-control"
											name="state"
											style="width: 100%; height: 38px"  multiple="multiple" placeholder="select Batch" name="batch">
											<optgroup label="Alaskan/Hawaiian Time Zone">
												<option value="AK">Alaska</option>
												<option value="HI">Hawaii</option>
											</optgroup>
											<optgroup label="Select batch">
												<?php


												// while ($row = mysqli_fetch_assoc($t_s_result)) {
												// 	$batch = $row['batch'];
												// 	echo '<option value="' . $batch . '">' . $batch . '</option>';
												// }

												// while ($row = mysqli_fetch_assoc($t_s_result)) {
												// 	$batch = $row['batch'];
												// 	echo '<option value="' . $batch . '">' . $batch . '</option>';
												// }



												?>

											</optgroup>
										</select>
											</div>
										</div>
									</div>
									<div class="row">
									<div class="col-md-6">
    <div class="form-group">
        <label class="my-2" > <span id="mentoringLabel1">Mentoring /</span> <span id="mentoringLabel">Interactive</span> </label><br>
        <input  type="checkbox" name='switch_btn' checked class="switch-btn" data-color="#0099ff" data-secondary-color="#28a745"/>

        <script>
            $(document).ready(function() {
                $(".switch-btn").on('change', function() {
                    var value = $(this).prop('checked') ? 1 : 2;
                    var label = $("#mentoringLabel");
					var label1 = $("#mentoringLabel1");

                    if (value === 1) {
                        // Change label color to blue
                        label.css("color", "#0099ff");
                    } else {
                        // Change label color to green
                        label1.css("color", "#28a745");
                    }

                    // Send the value to the server using AJAX
                    $.ajax({
                        type: 'POST',
                        url: 'qr.php', // Adjust the URL to the correct PHP file
                        data: {
                            value: value
                        },
                        success: function(response) {
                            console.log(response);
                        },
                        error: function(error) {
                            console.error(error);
                        }
                    });
                });
            });
        </script>
    </div>
</div>


										<div class="col-md-6">
											<div class="form-group">
												<label class="my-2"> Student Count:</label>
                                                <select
											class="custom-select2 form-control"
											name="state"
											style="width: 100%; height: 38px"
										>
											<optgroup label="Alaskan/Hawaiian Time Zone">
												<option value="AK">Alaska</option>
												<option value="HI">Hawaii</option>
											</optgroup>
											<optgroup label="Pacific Time Zone">
												<option value="CA">California</option>
												<option value="NV">Nevada</option>
												<option value="OR">Oregon</option>
												<option value="WA">Washington</option>
											</optgroup>
											<optgroup label="Mountain Time Zone">
												<option value="AZ">Arizona</option>
												<option value="CO">Colorado</option>
												<option value="ID">Idaho</option>
												<option value="MT">Montana</option>
												<option value="NE">Nebraska</option>
												<option value="NM">New Mexico</option>
												<option value="ND">North Dakota</option>
												<option value="UT">Utah</option>
												<option value="WY">Wyoming</option>
											</optgroup>
										</select>
												<p id="studentCount"></p>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
											<label>time Delive</label>
													<input class="form-control time-picker-default" name="time" placeholder="<?php echo date('H:S'); ?>" type="text" />
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
                                            <label>Date</label>
											<input class="form-control date-picker" name="date" placeholder=" Set Date : <?php echo date('Y:m:d');  ?>" type="text" />
											</div>
										</div>
									</div>

                                    <button type="submit" name="submit"   class="btn btn-secondary  btn-block">Send</button> <br>
                                    
								</section>
								<!-- Step 2 -->
								<h5>Qr Status</h5>
								<section>
									<div class="row">
                                    <div class="col-sm-12">
								<div class="qr_s">
									<iframe src="./qr/index.php" frameborder="0" width="100%" height="400px"></iframe>
								</div>
							</div>
										
									
									</div>
                                    
		


								</section>
							
								<!-- Step 4 -->
								<h5>Remark</h5>
                                <section>

<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">


        <!-- Responsive tables Start -->

        <div class="table-responsive" class="custom-select2 form-control" name="state" style="width: 100%; height: 50vh;">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Student Id</th>
                        <th scope="col">Attendance</th>
                        <th scope="col">Student ID</th>
                        <th scope="col">Not Attendaance</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td><span class="badge badge-primary">Attendance</span></td>
                        <td>Mark</td>
                        <td><span class="badge badge-primary">Not Attendaance</span></td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td><span class="badge badge-primary">Attendance</span></td>
                        <td>@fat</td>
                        <td>
                            <span class="badge badge-secondary">Not Attendaance</span>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>Larry</td>
                        <td><span class="badge badge-primary">Attendance</span></td>
                        <td>@twitter</td>
                        <td><span class="badge badge-success">Not Attendaance</span></td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td><span class="badge badge-primary">Attendance</span></td>
                        <td>@fat</td>
                        <td>
                            <span class="badge badge-secondary">Not Attendaance</span>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>Larry</td>
                        <td><span class="badge badge-primary">Attendance</span></td>
                        <td>@twitter</td>
                        <td><span class="badge badge-success">Not Attendaance</span></td>
                    </tr>
                </tbody>
            </table>
        </div>



        <div class="collapse collapse-box" id="responsive-table">
            <div class="code-box">
                <div class="clearfix">
                    <a href="javascript:;" class="btn btn-primary btn-sm code-copy pull-left" data-clipboard-target="#responsive-table-code"><i class="fa fa-clipboard"></i> Copy Code</a>
                    <a href="#responsive-table" class="btn btn-primary btn-sm pull-right" rel="content-y" data-toggle="collapse" role="button"><i class="fa fa-eye-slash"></i> Hide Code</a>
                </div>

                <pre><code class="xml copy-pre" id="responsive-table-code">
<div class="table-responsive">
<table class="table table-striped">
<thead>
<tr>
<th scope="col">#</th>
</tr>
</thead>
<tbody>
<tr>
<th scope="row">1</th>
</tr>
</tbody>
</table>
</div>
    </code></pre>
            </div>
        </div>
    </div>
    <!-- Responsive tables End -->




</div>
<div class="col-md-1"></div>


</div>



</section>
							</form>
						</div>
                        </div>
                        </div>
                        </div>

<!-- success Popup html Start -->
<div
						class="modal fade"
						id="success-modal"
						tabindex="-1"
						role="dialog"
						aria-labelledby="exampleModalCenterTitle"
						aria-hidden="true"
					>
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
								<div class="modal-body text-center font-18">
									<h3 class="mb-20">Form Submitted!</h3>
									<div class="mb-30 text-center">
										<img src="vendors/images/success.png" />
									</div>
									Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed
									do eiusmod
								</div>
								<div class="modal-footer justify-content-center">
									<button
										type="button"
										class="btn btn-primary"
										data-dismiss="modal"
									>
										<a href="#">Done</a>
									</button>
								</div>
							</div>
						</div>
					</div>
			
		<!-- welcome modal end -->


                      <!-- js -->
                      <?php include './qr_footer.php'; ?>
	</body>
</html>


