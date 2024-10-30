<?php  include './header.php';  ?>




<?php  
include '../config.php';

$st_count_query = "SELECT COUNT(*) AS st_count FROM `student`";
$st_count_result = mysqli_query($conn, $st_count_query);

if (!$st_count_result) {
    echo "Error";
}

$row = mysqli_fetch_assoc($st_count_result);
$st_count = $row['st_count'];


?>


<?php  
$t_count_query = "SELECT COUNT(internal_external) AS t_count FROM `teacher` WHERE internal_external = 1";
$t_count_result = mysqli_query($conn, $t_count_query);

if (!$t_count_result) {
    echo "Error";
}

$row = mysqli_fetch_assoc($t_count_result);
$it_count = $row['t_count'];
?> 

<?php  
$et_count_query = "SELECT COUNT(internal_external) AS et_count FROM `teacher` WHERE internal_external = 2";
$et_count_result = mysqli_query($conn, $et_count_query);

if (!$et_count_result) {
    echo "Error";
}

$row = mysqli_fetch_assoc($et_count_result);
$et_count = $row['et_count'];
?> 


<link
			rel="stylesheet"
			type="text/css"
			href="src/plugins/jvectormap/jquery-jvectormap-2.0.3.css"
		/>




		<!-- <div class="mobile-menu-overlay"></div> -->

		<div class="main-container">
			<div class="xs-pd-20-10 pd-ltr-20">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Dashboard</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">
										Dashboard
									</li>
								</ol>
							</nav>
						</div>
						<div class="col-md-6 col-sm-12 text-right">
							<!-- <div class="dropdown">
								<a
									class="btn btn-primary dropdown-toggle"
									href="#"
									role="button"
									data-toggle="dropdown"
								>
									January 2018
								</a>
								<div class="dropdown-menu dropdown-menu-right">
									<a class="dropdown-item" href="#">Export List</a>
									<a class="dropdown-item" href="#">Policies</a>
									<a class="dropdown-item" href="#">View Assets</a>
								</div>
							</div> -->
						</div>
					</div>
				</div>
				<div class="row clearfix progress-box">
					<div class="col-lg-3 col-md-6 col-sm-12 mb-30">
						<div class="card-box pd-30 height-100-p">
							<div class="progress-box text-center">
								<!-- <input
									type="text"
									class="knob dial1"
									value="50"
									data-width="120"
									data-height="120"
									data-linecap="round"
									data-thickness="0.12"
									data-bgColor="#fff"
									data-fgColor="#1b00ff"
									data-angleOffset="180"
									readonly
								/> -->
								<h5 class="text-blue padding-top-10 h5">Students</h5>
								<span class="d-block "style="font-size:20px;font-weight:bold;"
									><?php echo  $st_count ; ?> <i class="fa fa-line-chart text-blue  px-2"></i
								></span>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-6 col-sm-12 mb-30">
						<div class="card-box pd-30 height-100-p">
							<div class="progress-box text-center">
								<!-- <input
									type="text"
									class="knob dial2"
									value="70"
									data-width="120"
									data-height="120"
									data-linecap="round"
									data-thickness="0.12"
									data-bgColor="#fff"
									data-fgColor="#00e091"
									data-angleOffset="180"
									readonly
								/> -->
								<h5 class="text-light-green padding-top-10 h5">
									Interner Lecturs
								</h5>
								<span class="d-block "style="font-size:20px;font-weight:bold;"
									><?php echo  $it_count ; ?> <i class="fa text-light-green fa-line-chart px-2"></i
								></span>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-6 col-sm-12 mb-30">
						<div class="card-box pd-30 height-100-p">
							<div class="progress-box text-center">
								<!-- <input
									type="text"
									class="knob dial3"
									value="90"
									data-width="120"
									data-height="120"
									data-linecap="round"
									data-thickness="0.12"
									data-bgColor="#fff"
									data-fgColor="#f56767"
									data-angleOffset="180"
									readonly
								/> -->
								<h5 class="text-light-orange padding-top-10 h5">
									Externel Lecturs
								</h5>
								<span class="d-block" style="font-size:20px;font-weight:bold;"
									><?php echo  $et_count ; ?> <i class="fa text-light-orange fa-line-chart px-2"></i 
								></span>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-6 col-sm-12 mb-30">
						<div class="card-box pd-30 height-100-p">
							<div class="progress-box text-center">
								<!-- <input
									type="text"
									class="knob dial4"
									value="65"
									data-width="120"
									data-height="120"
									data-linecap="round"
									data-thickness="0.12"
									data-bgColor="#fff"
									data-fgColor="#a683eb"
									data-angleOffset="180"
									readonly
								/> -->
								<h5 class="text-light-purple padding-top-10 h5">
									MSC Student
								</h5>
								<span class="d-block "
									><b>1</b> <i class="fa text-light-purple fa-line-chart mx-2"></i
								></span>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-4 col-md-6 col-sm-12 mb-30">
						<div class="card-box pd-30  height-100-p">
							<h2 class="mb-30 h4">Today's Registration</h2>
							<div class="browser-visits">
								<ul>
									<li class="d-flex flex-wrap align-items-center">
										<div class="icon">
											<img src="vendors/images/chrome.png" alt="" />
										</div>
										<div class="browser-name">Google Chrome</div>
										<div class="visit">
											<span class="badge badge-pill badge-primary">50%</span>
										</div>
									</li>
									<li class="d-flex flex-wrap align-items-center">
										<div class="icon">
											<img src="vendors/images/firefox.png" alt="" />
										</div>
										<div class="browser-name">Mozilla Firefox</div>
										<div class="visit">
											<span class="badge badge-pill badge-secondary">0%</span>
										</div>
									</li>
									<li class="d-flex flex-wrap align-items-center">
										<div class="icon">
											<img src="vendors/images/safari.png" alt="" />
										</div>
										<div class="browser-name">Safari</div>
										<div class="visit">
											<span class="badge badge-pill badge-success">0%</span>
										</div>
									</li>
									<li class="d-flex flex-wrap align-items-center">
										<div class="icon">
											<img src="vendors/images/edge.png" alt="" />
										</div>
										<div class="browser-name">Microsoft Edge</div>
										<div class="visit">
											<span class="badge badge-pill badge-warning">50%</span>
										</div>
									</li>
									<li class="d-flex flex-wrap align-items-center">
										<div class="icon">
											<img src="vendors/images/opera.png" alt="" />
										</div>
										<div class="browser-name">Opera Mini</div>
										<div class="visit">
											<span class="badge badge-pill badge-info">0%</span>
										</div>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-lg-8 col-md-6 col-sm-12 mb-30">
						<div class="card-box  height-100-p">
							
								<div class="to_dp_list">
								<iframe id="todo-frame" src="./todo/index.php" frameborder="0" width="100%" scrolling="no"></iframe>

										<script>
											// Adjust iframe height based on content
											function adjustIframeHeight() {
												var iframe = document.getElementById('todo-frame');
												iframe.style.height = iframe.contentWindow.document.body.scrollHeight + 'px';
											}

											// Call the adjustIframeHeight function when the iframe content has loaded
											document.getElementById('todo-frame').onload = adjustIframeHeight;
										</script>


								</div>




						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-7 col-md-12 col-sm-12 mb-30">
						<div class="card-box pd-30 height-100-p">
							<h4 class="mb-30 h4">Compliance Trend</h4>
							<div id="compliance-trend" class="compliance-trend"></div>
						</div>
					</div>
					<div class="col-lg-5 col-md-12 col-sm-12 mb-30">
						<div class="card-box pd-30 height-100-p">
							<h4 class="mb-30 h4">Records</h4>
							<div id="chart" class="chart"></div>

						</div>
					</div>
				</div>
		
			</div>
		</div>
		
		<!-- js -->
		<script src="vendors/scripts/core.js"></script>
		<script src="vendors/scripts/script.min.js"></script>
		<script src="vendors/scripts/process.js"></script>
		<script src="vendors/scripts/layout-settings.js"></script>
		<script src="src/plugins/jQuery-Knob-master/jquery.knob.min.js"></script>
		<script src="src/plugins/highcharts-6.0.7/code/highcharts.js"></script>
		<script src="src/plugins/highcharts-6.0.7/code/highcharts-more.js"></script>
		<script src="src/plugins/jvectormap/jquery-jvectormap-2.0.3.min.js"></script>
		<script src="src/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
		<!-- <script src="vendors/scripts/dashboard2.js"></script> -->
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


<script>



// Function to get the month name
function getMonthName(monthIndex) {
    const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    return months[monthIndex];
}

// Function to format date
function formatDate(date) {
    var day = date.getDate();
    var monthIndex = date.getMonth(); // Months are zero-based
    var monthName = getMonthName(monthIndex);
    return day + ' ' + monthName;

}

// Set the timezone to 'Asia/Colombo'
const options = { timeZone: 'Asia/Colombo' };

// Get the current date in Colombo timezone
const localDate = new Date();

// Create an array to hold the week by week categories
var categories = [];


var categories = []; 

for (var i = 0; i < 10; i++) {
    var currentDate = new Date(); 
    currentDate.setDate(currentDate.getDate() - i); 

    var formattedDate = formatDate(currentDate); 

    categories.push(formattedDate);
}

categories.reverse();


var categories1 = [];

for (var i = 0; i < 7; i++) {
    var currentDate = new Date(); 
    currentDate.setDate(currentDate.getDate() - i); 

    var formattedDate = formatDate(currentDate); 

    categories1.push(formattedDate);
}

categories1.reverse();

// Output the week by week categories with day and month names
console.log('Categories with Day and Month Names:', categories);
console.log('Categories with Day and Month Names:', categories1);


var category  = ('Categories:', categories);
var category1  = ('Categories:', categories1);








								
								$(".dial1").knob();
$({animatedVal: 0}).animate({animatedVal: 80}, {
	duration: 3000,
	easing: "swing",
	step: function() {
		$(".dial1").val(Math.ceil(this.animatedVal)).trigger("change");
	}
});

$(".dial2").knob();
$({animatedVal: 0}).animate({animatedVal: 70}, {
	duration: 3000,
	easing: "swing",
	step: function() {
		$(".dial2").val(Math.ceil(this.animatedVal)).trigger("change");
	}
});

$(".dial3").knob();
$({animatedVal: 0}).animate({animatedVal: 90}, {
	duration: 3000,
	easing: "swing",
	step: function() {
		$(".dial3").val(Math.ceil(this.animatedVal)).trigger("change");
	}
});

$(".dial4").knob();
$({animatedVal: 0}).animate({animatedVal: 65}, {
	duration: 3000,
	easing: "swing",
	step: function() {
		$(".dial4").val(Math.ceil(this.animatedVal)).trigger("change");
	}
});
// map
jQuery('#browservisit').vectorMap({
	map: 'world_mill_en',
	backgroundColor: '#fff',
	borderWidth: 1,
	zoomOnScroll : false,
	color: '#ddd',
	regionStyle: {
		initial: {
			fill: '#fff'
		}
	},
	enableZoom: true,
	normalizeFunction: 'linear',
	showTooltip: true
});


// chart
Highcharts.chart('chart', {
	chart: {
		type: 'line'
	},
	title: {
		text: ''
	},
	xAxis: {
		categories: categories1,
		labels: {
			style: {
				color: '#1b00ff',
				fontSize: '12px',
			}
		}
	},
	yAxis: {
		labels: {
			formatter: function () {
				return this.value;
			},
			style: {
				color: '#1b00ff',
				fontSize: '14px'
			}
		},
		title: {
			text: ''
		},
	},
	credits: {
		enabled: false
	},
	tooltip: {
		crosshairs: true,
		shared: true
	},
	plotOptions: {
		spline: {
			marker: {
				radius: 10,
				lineColor: '#1b00ff',
				lineWidth: 2
			}
		}
	},
	legend: {
		align: 'center',
		x: 0,
		y: 0
	},
	series: [
	{
		name: 'Create Attenance',
		color: '#236adc',
		marker: {
			symbol: 'circle'
		},
		data: [40, 20, 10, 40, 15, 15, 20]
	},
	
	{
		name: 'Sucess Attendance',
		color: '#264653',
		marker: {
			symbol: 'circle'
		},
		data: [35, 25, 10, 40, 15, 5, 38]
	},
	{
		name: 'Pending Attendance',
		color: '#ff686b',
		marker: {
			symbol: 'circle'
		},
		data: [0, 15, 5, 30, 40, 30, 28]
	}]
});




Highcharts.chart('compliance-trend', {
	chart: {
		type: 'column'
	},
	colors: ['#0051bd', '#00eccf', '#d11372'],
	title: {
		text: ''
	},
	credits: {
		enabled: false
	},



	xAxis: {
		categories: categories,
		crosshair: true,
		lineWidth:1,
		lineColor: '#979797',
		labels: {
			style: {
				fontSize: '10px',
				color: '#5a5a5a'
			}
		},
	},
	yAxis: {
		min: 0,
		max: 100,
		gridLineWidth: 0,
		lineWidth:1,
		lineColor: '#979797',
		title: {
			text: ''
		},
		stackLabels: {
			enabled: false,
			style: {
				fontWeight: 'bold',
				color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
			}
		}
	},
	legend: {
		enabled: true
	},
	tooltip: {
		headerFormat: '<b>{point.x}</b><br/>',
		pointFormat: '{series.name}: {point.y}'
	},
	plotOptions: {
		column: {
			stacking: 'normal',
			dataLabels: {
				enabled: false,
				color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
			},
			borderWidth: 0
		}
	},
	series: [{
		name: 'Normal',
		maxPointWidth: 10,
		data: [50, 30, 40, 70, 20, 50, 30, 40, 70, 20,]
	}, {
		name: 'Warning',
		maxPointWidth: 10,
		data: [0, 20, 30, 20, 10, 50, 30, 40, 10, 20,]
	}, {
		name: 'Error',
		maxPointWidth: 10,
		data: [50, 50, 30, 10, 70, 0, 40, 20, 20, 60,]
	}]
});
															</script>