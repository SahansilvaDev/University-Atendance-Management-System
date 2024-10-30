
<?php include './header.php'; ?>


		<link
			rel="stylesheet"
			type="text/css"
			href="src/plugins/fullcalendar/fullcalendar.css"
		/>
		
		
			
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
						<div
							id="modal-view-event"
							class="modal modal-top fade calendar-modal"
						>
							<div class="modal-dialog modal-dialog-centered">
								<div class="modal-content">
									<div class="modal-body">
										<h4 class="h4">
											<span class="event-icon weight-400 mr-3"></span
											><span class="event-title"></span>
										</h4>
										<div class="event-body"></div>
									</div>
									<div class="modal-footer">
										<button
											type="button"
											class="btn btn-primary"
											data-dismiss="modal"
										>
											Close
										</button>
									</div>
								</div>
							</div>
						</div>

						<div
							id="modal-view-event-add"
							class="modal modal-top fade calendar-modal"
						>
							<div class="modal-dialog modal-dialog-centered">
								<div class="modal-content">
									<form id="add-event">
										<div class="modal-body">
											<h4 class="text-blue h4 mb-10">Add Event Detail</h4>
											<div class="form-group">
												<label>Event name</label>
												<input type="text" class="form-control" name="ename" />
											</div>
											<div class="form-group">
												<label>Event Date</label>
												<input
													type="text"
													class="datetimepicker form-control"
													name="edate"
												/>
											</div>
											<div class="form-group">
												<label>Event Description</label>
												<textarea class="form-control" name="edesc"></textarea>
											</div>
											<div class="form-group">
												<label>Event Color</label>
												<select class="form-control" name="ecolor">
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
											<button type="submit" class="btn btn-primary">
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
							</div>
						</div>
					</div>
				</div>
				
			</div>
		</div>


		<script>
			jQuery(document).ready(function () {
	jQuery("#add-event").submit(function () {
		alert("Submitted");
		var values = {};
		$.each($("#add-event").serializeArray(), function (i, field) {
			values[field.name] = field.value;
		});
		console.log(values);
	});
});

(function () {
	"use strict";
	// ------------------------------------------------------- //
	// Calendar
	// ------------------------------------------------------ //
	jQuery(function () {
		// page is ready
		jQuery("#calendar").fullCalendar({
			themeSystem: "bootstrap4",
			// emphasizes business hours
			businessHours: false,
			defaultView: "month",
			// event dragging & resizing
			editable: true,
			// header
			header: {
				left: "title",
				center: "month,agendaWeek,agendaDay",
				right: "today prev,next",
			},
			events: [
				{
					title: "Barber",
					description:
						"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eu pellentesque nibh. In nisl nulla, convallis ac nulla eget, pellentesque pellentesque magna.",
					start: "2024-03-05",
					end: "2024-03-05",
					className: "fc-bg-default",
					icon: "circle",
				},
				{
					title: "Flight Paris",
					description:
						"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eu pellentesque nibh. In nisl nulla, convallis ac nulla eget, pellentesque pellentesque magna.",
					start: "2024-03-08T14:00:00",
					end: "2024-03-08T20:00:00",
					className: "fc-bg-deepskyblue",
					icon: "cog",
					allDay: false,
				},
				{
					title: "Team Meeting",
					description:
						"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eu pellentesque nibh. In nisl nulla, convallis ac nulla eget, pellentesque pellentesque magna.",
					start: "2024-03-10T13:00:00",
					end: "2024-03-10T16:00:00",
					className: "fc-bg-pinkred",
					icon: "group",
					allDay: false,
				},
				{
					title: "Meeting",
					description:
						"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eu pellentesque nibh. In nisl nulla, convallis ac nulla eget, pellentesque pellentesque magna.",
					start: "2024-03-12",
					className: "fc-bg-lightgreen",
					icon: "suitcase",
				},
				{
					title: "Conference",
					description:
						"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eu pellentesque nibh. In nisl nulla, convallis ac nulla eget, pellentesque pellentesque magna.",
					start: "2024-03-13",
					end: "2024-03-15",
					className: "fc-bg-blue",
					icon: "calendar",
				},
				{
					title: "Baby Shower",
					description:
						"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eu pellentesque nibh. In nisl nulla, convallis ac nulla eget, pellentesque pellentesque magna.",
					start: "2024-04-13",
					end: "2024-04-14",
					className: "fc-bg-default",
					icon: "child",
				},
				{
					title: "Birthday",
					description:
						"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eu pellentesque nibh. In nisl nulla, convallis ac nulla eget, pellentesque pellentesque magna.",
					start: "2024-03-13",
					end: "2024-03-14",
					className: "fc-bg-default",
					icon: "birthday-cake",
				},
				{
					title: "Restaurant",
					description:
						"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eu pellentesque nibh. In nisl nulla, convallis ac nulla eget, pellentesque pellentesque magna.",
					start: "2022-10-15T09:30:00",
					end: "2022-10-15T11:45:00",
					className: "fc-bg-default",
					icon: "glass",
					allDay: false,
				},
				{
					title: "Dinner",
					description:
						"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eu pellentesque nibh. In nisl nulla, convallis ac nulla eget, pellentesque pellentesque magna.",
					start: "2022-11-15T20:00:00",
					end: "2022-11-15T22:30:00",
					className: "fc-bg-default",
					icon: "cutlery",
					allDay: false,
				},
				{
					title: "Shooting",
					description:
						"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eu pellentesque nibh. In nisl nulla, convallis ac nulla eget, pellentesque pellentesque magna.",
					start: "2022-08-25",
					end: "2022-08-25",
					className: "fc-bg-blue",
					icon: "camera",
				},
				{
					title: "Go Space :)",
					description:
						"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eu pellentesque nibh. In nisl nulla, convallis ac nulla eget, pellentesque pellentesque magna.",
					start: "2022-12-27",
					end: "2022-12-27",
					className: "fc-bg-default",
					icon: "rocket",
				},
				{
					title: "Dentist",
					description:
						"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eu pellentesque nibh. In nisl nulla, convallis ac nulla eget, pellentesque pellentesque magna.",
					start: "2022-12-29T11:30:00",
					end: "2022-12-29T012:30:00",
					className: "fc-bg-blue",
					icon: "medkit",
					allDay: false,
				},
			],
			dayClick: function () {
				jQuery("#modal-view-event-add").modal();
			},
			eventClick: function (event, jsEvent, view) {
				jQuery(".event-icon").html("<i class='fa fa-" + event.icon + "'></i>");
				jQuery(".event-title").html(event.title);
				jQuery(".event-body").html(event.description);
				jQuery(".eventUrl").attr("href", event.url);
				jQuery("#modal-view-event").modal();
			},
		});
	});
})(jQuery);

		</script>
	
		<!-- js -->
		<script src="vendors/scripts/core.js"></script>
		<script src="vendors/scripts/script.min.js"></script>
		<script src="vendors/scripts/process.js"></script>
		<script src="vendors/scripts/layout-settings.js"></script>
		<script src="src/plugins/fullcalendar/fullcalendar.min.js"></script>
		<script src="vendors/scripts/calendar-setting.js"></script>
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
