



		
		if(isset($_POST['submit'])) {
			
			$batch = $_POST['batch'];
			$subject = $_POST['subject'];
			$switch_btn = $_POST['switch_btn'];
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








							<div class="row">
								<div class="col-sm-6 ">
								
									<br>
									<div class="mb-30">
										Mentoring / Interactive

										<input type="checkbox" name='switch_btn' checked class="switch-btn" data-color="#0099ff" data-secondary-color="#28a745" />

										<script>
											$(document).ready(function() {
												// Assuming you have jQuery included
												$(".switch-btn").on('change', function() {
													var value = $(this).prop('checked') ? 1 : 2;

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
								


<script>
	function getStudentCount(selectedSubject) {
		$.ajax({
			url: 'getStudentCount.php',
			type: 'POST',
			data: {
				subject: selectedSubject
			},
			success: function(response) {
				$('#studentCount').text('Number of students: ' + response);
			},
			error: function() {
				$('#studentCount').text('Error fetching student count.');
			}
		});
	}
</script>







