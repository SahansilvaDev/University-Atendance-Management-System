<?php include './header.php'; ?>



<?php

include '../config.php';


$query_student1 = "SELECT user_id, degree_programe, degree_code, batch, name FROM student";
$result_student1 = mysqli_query($conn, $query_student1);







?>

<link rel="stylesheet" type="text/css" href="src/plugins/jvectormap/jquery-jvectormap-2.0.3.css" />


<div class="main-container">
    <div class="xs-pd-20-10 pd-ltr-20">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Student Analysis </h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Student Analysis
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>





        <div class="row">

            <div class="col-lg-6 col-md-12 col-sm-12 mb-30">
                <div class="card-box pd-30 height-100-p">
                    <h4 class="mb-30 h4">Records</h4>
                    <div id="chart" class="chart"></div>

                </div>
            </div>
        </div>



        <div class="row">

            <div class="col-lg-12 col-md-12 col-sm-12 mb-30">
                <div class="card-box pd-30 height-100-p">
                    <h4 class="mb-30 h4">Records</h4>

                    <div class="form  ">
    <form method="post"  class="mb-5">
        <div class="form-group">
            <label for="batch">Batch</label>
            <select class="selectpicker form-control" data-style="btn-outline-primary" title="Not Chosen" multiple data-selected-text-format="count" data-count-selected-text="{0} selected" name="batch[]">
                <?php
                if (mysqli_num_rows($result_student1) > 0) {
                    while ($row = mysqli_fetch_assoc($result_student1)) {
                        $batch = $row['batch'];
                        echo "<option value='$batch'>$batch</option>";
                    }
                } else {
                    echo "<option value=''>No batch available</option>";
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-success  mb-5" name="submit">Search</button>
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $selected_batches = $_POST['batch'];
        if (!empty($selected_batches)) {
            // Construct the batch filter for the SQL query
            $batch_filter = "'" . implode("','", $selected_batches) . "'";
            
            // Construct the SQL query to retrieve degree codes related to the selected batches
            $query_student = "SELECT user_id, degree_programe, degree_code, batch, name
                            FROM student
                            WHERE batch IN ($batch_filter)
                            AND degree_code IN (
                                SELECT DISTINCT degree_code
                                FROM student AS s1
                                WHERE NOT EXISTS (
                                    SELECT 1
                                    FROM student AS s2
                                    WHERE s2.degree_programe = s1.degree_programe
                                    AND s2.degree_code != s1.degree_code
                                )
                            )";

            $result_student = mysqli_query($conn, $query_student);

            $unique_degree_codes = array();
            $total_students = mysqli_num_rows($result_student);
            if ($total_students > 0) {
                while ($row = mysqli_fetch_assoc($result_student)) {
                    $degree_code = $row['degree_code'];
                    $degree_programe = $row['degree_programe'];
                    
                    // Count the number of students for each degree code within the selected degree program
                    if (!isset($unique_degree_codes[$degree_code])) {
                        $unique_degree_codes[$degree_code] = array('degree_programe' => $degree_programe, 'count' => 1);
                    } else {
                        $unique_degree_codes[$degree_code]['count']++;
                    }
                }

                // Output the degree code, degree program, and percentage of students for each degree code
                foreach ($unique_degree_codes as $code => $info) {
                    $degree_programe = $info['degree_programe'];
                    $count = $info['count'];
                    $percentage = ($count / $total_students) * 100;
                   
                


?>

<div class="card">
    <div class="card-body  my-3 mx-2">

 

<div class="row ">
    <div class="col-sm-4">Degree   Programme</div>
    <div class="col-sm-8"><?php echo  $code . ' ' . $degree_programe; ?></div>
</div>

<div class="row mb-3">
    <div class="col-sm-4">Student Count</div>
    <div class="col-sm-8"><?php echo  $count; ?></div>
</div>


<div class="row">
    <div class="col-sm-4">Percentage</div>
    <div class="col-sm-8"><?php echo  $percentage; ?>%</div>
</div>

</div>
</div>



<?php
}


            } else {
                echo "No students found for the selected batch.";
            }
        } else {
            echo "Please select at least one batch.";
        }
    }
    ?>
</div>


















<script src="https://cdn.plot.ly/plotly-latest.min.js"></script>


<div id="myPlot" style="width:100%;max-width:700px"></div>

<script>
const xArray = [1,2,3,4];
const yArray = [10,20,30,40];

const trace1 = {
  x: xArray,
  y: yArray,
  mode: 'markers',
  marker: {
    color: ['red', 'green',  'blue', 'orange'],
    size: [20, 30, 40, 50]
  }
};

const trace2 = {
  x: [1, 2, 3, 4],
  y: [15, 30, 45, 60],
  mode: 'markers',
  marker: {
    color: 'rgb(31, 119, 180)',
    size: 18,
    symbol: ['circle', 'square', 'diamond', 'cross']
  },
};

const data = [trace1, trace2];

const layout = {
  title: ""
};

Plotly.newPlot('myPlot', data, layout);
</script>

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
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS" height="0" width="0" style="display: none; visibility: hidden"></iframe></noscript>
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
    const options = {
        timeZone: 'Asia/Colombo'
    };

    // Get the current date in Colombo timezone
    const localDate = new Date();

    // Create an array to hold the week by week categories
    var categories = [];

    // Loop to create categories for each day of the current week starting from April 23rd
    for (var i = 0; i < 10; i++) {
        var currentDate = new Date(localDate.getTime() + (i * 24 * 60 * 60 * 1000));
        var formattedDate = formatDate(currentDate);
        categories.push(formattedDate);
    }

    var categories1 = [];

    for (var i = 0; i < 7; i++) {
        var currentDate = new Date(localDate.getTime() + (i * 24 * 60 * 60 * 1000));
        var formattedDate = formatDate(currentDate);
        categories1.push(formattedDate);
    }

    // Output the week by week categories with day and month names
    console.log('Categories with Day and Month Names:', categories);
    console.log('Categories with Day and Month Names:', categories1);


    var category = ('Categories:', categories);
    var category1 = ('Categories:', categories1);









    $(".dial1").knob();
    $({
        animatedVal: 0
    }).animate({
        animatedVal: 80
    }, {
        duration: 3000,
        easing: "swing",
        step: function() {
            $(".dial1").val(Math.ceil(this.animatedVal)).trigger("change");
        }
    });

    $(".dial2").knob();
    $({
        animatedVal: 0
    }).animate({
        animatedVal: 70
    }, {
        duration: 3000,
        easing: "swing",
        step: function() {
            $(".dial2").val(Math.ceil(this.animatedVal)).trigger("change");
        }
    });

    $(".dial3").knob();
    $({
        animatedVal: 0
    }).animate({
        animatedVal: 90
    }, {
        duration: 3000,
        easing: "swing",
        step: function() {
            $(".dial3").val(Math.ceil(this.animatedVal)).trigger("change");
        }
    });

    $(".dial4").knob();
    $({
        animatedVal: 0
    }).animate({
        animatedVal: 65
    }, {
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
        zoomOnScroll: false,
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
                formatter: function() {
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
        series: [{
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
            }
        ]
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
            lineWidth: 1,
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
            lineWidth: 1,
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
            data: [50, 30, 40, 70, 20, 50, 30, 40, 70, 20, ]
        }, {
            name: 'Warning',
            maxPointWidth: 10,
            data: [0, 20, 30, 20, 10, 50, 30, 40, 10, 20, ]
        }, {
            name: 'Error',
            maxPointWidth: 10,
            data: [50, 50, 30, 10, 70, 0, 40, 20, 20, 60, ]
        }]
    });
</script>