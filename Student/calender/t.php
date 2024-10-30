<?php  
include '../../config.php';
session_start();

// Check if the user is logged in
if(isset($_SESSION['user_id'])){
  $user_id = $_SESSION['user_id'];

  $sql = "SELECT batch, degree_code FROM student WHERE user_id = '$user_id'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $batch = $row['batch'];
    $degree_code = $row['degree_code'];

    $sql1 = "SELECT dm.module_code, dm.faculty_code
             FROM degree_module dm
             WHERE dm.degree_code = '$degree_code'";
    $result1 = $conn->query($sql1);

    if ($result1->num_rows > 0) {
      $row1 = $result1->fetch_assoc();
      $module_code = $row1['module_code'];
      $faculty_code = $row1['faculty_code'];

      $sql2 = "SELECT c.subject_code, c.subject_select, c.title, c.description, c.start_time, c.end_time 
               FROM calender c 
               WHERE c.subject_code = '$module_code' AND c.batch = '$batch' ";
      $result2 = $conn->query($sql2);

      if ($result2->num_rows > 0) {
        ?>
        <link rel="stylesheet" type="text/css" href="../vendors/styles/core.css" />
        <link rel="stylesheet" type="text/css" href="../vendors/styles/icon-font.min.css" />
        <link rel="stylesheet" type="text/css" href="../src/plugins/datatables/css/dataTables.bootstrap4.min.css" />
        <link rel="stylesheet" type="text/css" href="../src/plugins/datatables/css/responsive.bootstrap4.min.css" />
        <link rel="stylesheet" type="text/css" href="../vendors/styles/style.css" />
        <link rel="stylesheet" type="text/css" href="../src/plugins/fullcalendar/fullcalendar.css" />

        <div class="mobile-menu-overlay"></div>
        <div class="main-container">
            <div class="pd-ltr-20 xs-pd-20-10">
                <div class="min-height-200px">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="title">
                                    <h4>Calendar</h4>
                                </div>
                                <nav aria-label="breadcrumb" role="navigation">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="index.html">Home</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">
                                            Calendar
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="pd-20 card-box mb-30">
                        <div class="calendar-wrap">
                            <div id="calendar"></div>
                        </div>
                        <!-- calendar modal -->
                        <div id="modal-view-event" class="modal modal-top fade calendar-modal">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <h4 class="h4">
                                            <span class="event-icon weight-400 mr-3"></span><span class="event-title"></span>
                                        </h4>
                                        <div class="event-body"></div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="modal-view-event-add" class="modal modal-top fade calendar-modal">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <form id="add-event" action="./submit_calender.php" method="post">
                                        <div class="modal-body">
                                            <h4 class="text-blue h4 mb-10">Add Detail</h4>
                                            <!-- Form fields for adding event -->


                                            <form id="add-event" action="./submit_calender.php" method="post">
										<div class="modal-body">
											<h4 class="text-blue h4 mb-10">Add  Detail</h4>


                      <div class="form-group">
												<label>Subject Code</label>
												<input type="text" class="form-control" name="ecode" />
											</div>

											<div class="form-group">
												<label>Subject name</label>
												<input type="text" class="form-control" name="ename" />
											</div>

                      <div class="form-group">
												<label>Subject Url </label>
												<input type="text" class="form-control" name="eurl" />
											</div>

											<div class="form-group">
												<label>Subject start Date</label>
												<input
													type="text"
													class="datetimepicker form-control"
													name="edate"
												/>
											</div>


                      <div class="form-group">
												<label>Subject end Date</label>
												<input
													type="text"
													class="datetimepicker form-control"
													name="edate1"
												/>
											</div>


                      <div class="form-group">
												<label> Batch </label>
												<input type="text" class="form-control" name="ebatch" />
											</div>

                      <!-- <div class="form-group">
												<label>Online or physicle</label>
												<input type="text" class="form-control" name="eonline_or_phy" />
											</div> -->


                      <div class="form-group">
                        <label>Online or Physical</label>
                        <select class="form-control" name="ecolor">
                            <option value="1">Online</option>
                            <option value="2">Physical</option>
                        </select>
                    </div>


                      <!-- <div class="form-group">
												<label>Subject start time</label>
												<input
													type="text"
													class="time-picker-default form-control"
													name="estime"
												/>
											</div>


                      <div class="form-group">
												<label>Subject end time</label>
												<input
													type="text"
													class=" form-control time-picker-default" 
													name="etimeend"
												/>
											</div> -->
											<div class="form-group">
												<label>Event Description</label>
												<textarea class="textarea_editor  form-control" name="edesc"></textarea>
											</div>
											<div class="form-group">
												<label>Event Color</label>
												<select class="form-control" name="ecolor1">
													<option value="fc-bg-default">fc-bg-default</option>
													<option value="fc-bg-blue">fc-bg-blue</option>
													<option value="fc-bg-lightgreen">
														fc-bg-lightgreen
													</option>
													<option value="fc-bg-pinkred">fc-bg-pinkred</option>
													<option value="fc-bg-deepskyblue">
														fc-bg-deepskyblue
													</option>
												</select>
											</div>
											<div class="form-group">
												<label>Event Icon</label>
												<select class="form-control" name="eicon">
													<option value="circle">circle</option>
													<option value="cog">cog</option>
													<option value="group">group</option>
													<option value="suitcase">suitcase</option>
													<option value="calendar">calendar</option>
												</select>
											</div>
										</div>
										<div class="modal-footer">
											<button type="submit" class="btn btn-primary"  name="submit">
												Save
											</button>
											<button
												type="button"
												class="btn btn-primary"
												data-dismiss="modal"
											>
												Close
											</button>
										</div>
									</form>
		

                                    
                                        </div>
                                    
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="../vendors/scripts/core.js"></script>
        <script src="../vendors/scripts/script.min.js"></script>
        <script src="../vendors/scripts/process.js"></script>
        <script src="../vendors/scripts/layout-settings.js"></script>
        <script src="./fullcalendar.min.js"></script>

        <script>
            jQuery(document).ready(function () {
                // Initialize FullCalendar
                jQuery("#calendar").fullCalendar({
                    themeSystem: "bootstrap4",
                    businessHours: false,
                    defaultView: "month",
                    editable: true,
                    header: {
                        left: "title",
                        center: "month,agendaWeek,agendaDay",
                        right: "today prev,next",
                    },
                    events: [
                        <?php  
                        while ($row2 = $result2->fetch_assoc()) {
                            $title = $row2['title'];
                            $description = $row2['description'];
                            $start_time = $row2['start_time'];
                            $end_time = $row2['end_time'];
                        ?>
                        
                        {
                            title: "<?php echo $title; ?>",
                            description: "<?php echo $description; ?>",
                            start: "<?php echo $start_time; ?>",
                            end: "<?php echo $end_time; ?>",
                            time: "12pm",
                            className: "fc-bg-default",
                            icon: "circle",
                        },
                        <?php  
                        } 
                        ?>
                    ],
                    dayClick: function () {
                        jQuery("#modal-view-event-add").modal();
                    },
                    eventClick: function (event, jsEvent, view) {
    // Set the content of the modal with the event details
    var modal = jQuery("#modal-view-event");
    modal.find(".event-icon").html("<i class='fa fa-" + event.icon + "'></i>");
    modal.find(".event-title").text(event.title);
    modal.find(".event-body").html("<strong>Description:</strong> " + event.description + "<br>" +
                                   "<strong>Time:</strong> " + event.start.format('YYYY-MM-DD HH:mm') + " - " + event.end.format('YYYY-MM-DD HH:mm') + "<br>" +
                                   "<strong>Title:</strong> " + event.title + "<br>" +
                                   "<strong>Batch:</strong> " + event.batch);
    modal.modal();
}
                });
            });
        </script>
        <?php
      } else {
        echo "No matching calendar events found for the student.";
      }
    } else {
      echo "No related degree modules found for the student.";
    }
  }
} else {
  echo "User not logged in.";
}
?>
