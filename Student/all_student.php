<?php
// Include header and config
include './header.php';
include '../config.php';

// Check if user is logged in
if (isset($_SESSION['user_id'])) {
    // Retrieve user_id from session
    $user_id = $_SESSION['user_id'];





    // Get the current date
    $current_date = date('Y-m-d');

    // Calculate one week (7 days) ago from today
    $one_week_ago = date('d F Y', strtotime('-7 days', strtotime($current_date)));

    echo $one_week_ago; // Output will be in the format "27 April 2024"

            
        

    




    // Initialize arrays to store subject counts
    $subjectCounts = [];
    $suc_subjectCounts = [];

    // SQL query to fetch attendance data from create_qr_attendance
    $st_att = "SELECT id, subject_code, subject_select FROM create_qr_attendance 
           WHERE id BETWEEN '$one_week_ago' AND '$current_date'";
    $result_att = mysqli_query($conn, $st_att);

    if ($result_att) {
        // Loop through each row fetched from the query result
        while ($row_att = mysqli_fetch_assoc($result_att)) {
            $subjectCode = $row_att['subject_code'];
            $subjectSelect = $row_att['subject_select'];

            // Increment the count for the existing subject_code
            if (isset($subjectCounts[$subjectCode])) {
                $subjectCounts[$subjectCode]['count']++;
            } else {
                // Initialize a new entry for the subject_code
                $subjectCounts[$subjectCode] = [
                    'subject_select' => $subjectSelect,
                    'count' => 1
                ];
            }
        }
    } else {
        // Handle query execution error
        echo "Error executing query: " . mysqli_error($conn);
    }

    // SQL query to fetch attendance data from success_attend
    $st_suc_att = "SELECT id, subject_code, subject_select 
    FROM success_attend 
    WHERE user_id = '$user_id' 
    AND id BETWEEN '$one_week_ago' AND '$current_date'";

    $result_suc_att = mysqli_query($conn, $st_suc_att);

    if ($result_suc_att) {
        // Loop through each row fetched from the query result
        while ($row_suc_att = mysqli_fetch_assoc($result_suc_att)) {
            $suc_subjectCode = $row_suc_att['subject_code'];
            $suc_subjectSelect = $row_suc_att['subject_select'];

            // Increment the count for the existing subject_code
            if (isset($suc_subjectCounts[$suc_subjectCode])) {
                $suc_subjectCounts[$suc_subjectCode]['count']++;
            } else {
                // Initialize a new entry for the subject_code
                $suc_subjectCounts[$suc_subjectCode] = [
                    'subject_select' => $suc_subjectSelect,
                    'count' => 1
                ];
            }
        }
    } else {
        // Handle query execution error
        echo "Error executing query: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);

    // Output the results or further process the data as needed
    // (e.g., display charts using $subjectCounts and $suc_subjectCounts)
} else {
    // Handle session user_id not set
    echo "User ID not found in session.";
}
?>

<!-- Include Google Charts loader script -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<div class="main-container">
    <div class="pd-ltr-20">
        <div class="card-box pd-20 height-100-p mb-30">
            <div class="row align-items-center">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <h3>Student Analysis</h3>
                   
                </div>
            </div>

        </div>


        <div class="row">

            <div class="col-md-6">
                <div class="card-box pd-20 height-100-p mb-30">
                    <div id="piechart_div" ></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card-box pd-20 height-100-p mb-30">
                    <div id="barchart_div" ></div>
                </div>
            </div>



        </div>
    </div>
</div>

<script type="text/javascript">
    // Load Charts and the corechart package
    google.charts.load('current', {
        'packages': ['corechart']
    });

    // Draw the pie chart and bar chart when Google Charts is loaded
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Subject');
        data.addColumn('number', 'Count');

        // Populate data rows based on subjectCounts array
        <?php foreach ($subjectCounts as $code => $data) : ?>
            data.addRow(['<?= $data['subject_select'] ?>', <?= $data['count'] ?>]);
        <?php endforeach; ?>

        // Pie chart options
        var piechart_options = {
        title: 'Pie Chart: Attendance by Subject',
        width: 400,
        height: 300,
        titleTextStyle: {
            fontSize: 16,  
        }
        };

        var piechart = new google.visualization.PieChart(document.getElementById('piechart_div'));
        piechart.draw(data, piechart_options);

        // Bar chart options

        var data1 = new google.visualization.DataTable();
        data1.addColumn('string', 'Subject');
        data1.addColumn('number', 'Count');

        // Populate data rows based on subjectCounts array
        <?php foreach ($suc_subjectCounts as $code => $data1) : ?>
            data1.addRow(['<?= $data1['subject_select'] ?>', <?= $data1['count'] ?>]);
        <?php endforeach; ?>

        var barchart_options = {
            title: 'Bar Chart: Attendance by Subject',
            width: 400,
            height: 300,
            legend: 'none'
        };
        var barchart = new google.visualization.BarChart(document.getElementById('barchart_div'));
        barchart.draw(data1, barchart_options);
    }
</script>

















<?php include './footer.php'; ?>