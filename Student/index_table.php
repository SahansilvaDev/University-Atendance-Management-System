<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
<?php
include '../config.php';
session_start();

// Assuming user_id is provided dynamically or retrieved from session
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];



    // SQL query to fetch distinct values with counts
    $sql = "SELECT
                s.user_id,
                s.degree_code,
                s.degree_programe,
                s.batch,
                dm.module_code,
                dm.module_name,
                COUNT(DISTINCT cqa.subject_code) AS subject_count,
                COUNT(DISTINCT cqa.subject_select) AS subject_select_count,
                cqa.time,
                cqa.qr_date,
                COUNT(DISTINCT cqa.teacher_id) AS teacher_count,
                cqa.qr_code
            FROM
                student s
            JOIN
                degree_module dm ON s.degree_code = dm.degree_code
            JOIN
                create_qr_attendance cqa ON dm.module_code = cqa.subject_code
            WHERE
                s.user_id = '$user_id'
                AND s.degree_code = dm.degree_code
                AND s.batch = cqa.batch
            GROUP BY
                s.user_id,
                s.degree_code,
                s.degree_programe,
                s.batch,
                dm.module_code,
                dm.module_name,
                cqa.time,
                cqa.qr_date,
                cqa.qr_code";

    $result = $conn->query($sql);

    if ($result === false) {
        echo "Error executing query: " . $conn->error;
    } else {
        if ($result->num_rows > 0) {
            ?>
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-title"></p>
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table table-hover" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th  scope="col">User ID</th>
                                                    <th scope="col">Degree Code</th>
                                                    <th scope="col">Degree Program</th>
                                                    <th scope="col">Batch</th>
                                                    <th scope="col">Module Code</th>
                                                    <th scope="col">Module Name</th>
                                                    <th scope="col">Subject Count</th>
                                                    <th scope="col">Subject Select Count</th>
                                                    <th scope="col">Time</th>
                                                  
                                                    <th scope="col">QR Code</th>
                                                </tr>
                                            </thead>
                                            <tbody>
												<?php

            while ($row = $result->fetch_assoc()) {
                echo '
                                                <tr>
                                                    <td>'.$row['user_id'].'</td>
                                                    <td>'.$row['degree_code'].'</td>
                                                    <td>'.$row['degree_programe'].'</td>
                                                    <td>'.$row['batch'].'</td>
                                                    <td>'.$row['module_code'].'</td>
                                                    <td>'.$row['module_name'].'</td>
                                                    <td>'.$row['subject_count'].'</td>
                                                    <td>'.$row['subject_select_count'].'</td>
                                                    <td>'.$row['time'].'</td>
                                                    <td>'.$row['qr_date'].'</td>
                                                  
                                                    <td>'.$row['qr_code'].'</td>
                                                </tr>';
            }

          ?>
		  
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

			<?php
        } else {
            echo "No data found";
        }
    }

    // Close the database connection
    $conn->close();
}
?>



<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>