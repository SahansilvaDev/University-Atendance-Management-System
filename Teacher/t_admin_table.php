<?php include './header.php'; ?>


<?php
include '../config.php'; 
date_default_timezone_set('Asia/Colombo');


if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $filter_year = date('d F Y ');

    $sql_at_a = "SELECT t_module.t_user_id, t_module.degree_code, t_module.module_code, t_module.Faculty_code,
            CASE WHEN t_module.degree_code = degree_module.degree_code THEN degree_module.degree_name ELSE NULL END AS degree_name,
            CASE WHEN t_module.degree_code = degree_module.degree_code THEN degree_module.module_code ELSE NULL END AS module_code,
            CASE WHEN t_module.degree_code = degree_module.degree_code THEN degree_module.module_name ELSE NULL END AS module_name,
            CASE WHEN t_module.degree_code = degree_module.degree_code THEN degree_module.Faculty_code ELSE NULL END AS degree_faculty_code,
            CASE WHEN t_module.degree_code = degree_module.degree_code THEN degree_module.Faculty_name ELSE NULL END AS degree_faculty_name,
            faculty.faculty_code, faculty.faculty_name,
            student.user_id, student.degree_programe, student.batch,
            COUNT(student.user_id) AS student_count  
            FROM t_module
            LEFT JOIN degree_module ON t_module.degree_code = degree_module.degree_code
            LEFT JOIN faculty ON t_module.Faculty_code = faculty.faculty_code
            LEFT JOIN student ON t_module.degree_code = student.degree_code
            WHERE t_module.t_user_id = '$user_id'
            GROUP BY t_module.degree_code, t_module.module_code, t_module.Faculty_code";  
 
    $result = mysqli_query($conn, $sql_at_a);

  
    if ($result) {

        $previous_degree_code = null;
        $previous_module_code = null;
        $previous_faculty_code = null;
        $previous_degree_name = null;
        $previous_module_name = null;
        $previous_degree_faculty_code = null;
        $previous_degree_faculty_name = null;


        while ($row = mysqli_fetch_assoc($result)) {
           
            if (
                $row['degree_code'] != $previous_degree_code ||
                $row['module_code'] != $previous_module_code ||
                $row['faculty_code'] != $previous_faculty_code ||
                $row['degree_name'] != $previous_degree_name ||
                $row['module_name'] != $previous_module_name ||
                $row['degree_faculty_code'] != $previous_degree_faculty_code ||
                $row['degree_faculty_name'] != $previous_degree_faculty_name
            ) {

                // If it's not the same, display the record
                echo "<tr>";
                $degree_code = $row['degree_code'];
                $module_code = $row['module_code'];
                $faculty_code = $row['faculty_code'];
                $degree_name = $row['degree_name'];
                $module_name = $row['module_name'];
                $degree_faculty_code = $row['degree_faculty_code'];
                $degree_faculty_name = $row['degree_faculty_name'];
                $batch = $row['batch'];
                $student_count = $row['student_count'];


                // Update the previous record variables
                $previous_degree_code = $row['degree_code'];
                $previous_module_code = $row['module_code'];
                $previous_faculty_code = $row['faculty_code'];
                $previous_degree_name = $row['degree_name'];
                $previous_module_name = $row['module_name'];
                $previous_degree_faculty_code = $row['degree_faculty_code'];
                $previous_degree_faculty_name = $row['degree_faculty_name'];
?>









                <div class="main-container">
                    <div class="pd-ltr-20 xs-pd-20-10">





                        <!-- Responsive tables Start -->

                        <div class="table-responsive" class="custom-select2 form-control" name="state" style="width: 100%; height: 50vh;">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Degree</th>
                                        <th scope="col">Subjects</th>
                                        <th scope="col">Class </th>
                                        <th scope="col">Student Count</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        <th scope="row">1</th>
                                        <td><?php echo $row['degree_code'] . " - " . $row['degree_name']; ?></td>
                                        <td><?php echo $row['module_code'] . " - " . $row['module_name']; ?></td>
                                        <td><?php echo $row['batch']; ?></td>
                                        <td><span class="badge badge-primary"><?php echo $student_count; ?></span></td>
                                    </tr>

                                    <?php

                                    ?>

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
            </div>
 


<?php
            }
        }
    } else {
        // Handle the case where the query fails
        echo "Error: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}
?>





    <!-- js -->
    <script src="vendors/scripts/core.js"></script>
    <script src="vendors/scripts/script.min.js"></script>
    <script src="vendors/scripts/process.js"></script>
    <script src="vendors/scripts/layout-settings.js"></script>
    <script src="src/plugins/datatables/js/jquery.dataTables.min.js"></script>
    <script src="src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
    <script src="src/plugins/datatables/js/dataTables.responsive.min.js"></script>
    <script src="src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
    <!-- buttons for Export datatable -->
    <script src="src/plugins/datatables/js/dataTables.buttons.min.js"></script>
    <script src="src/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
    <script src="src/plugins/datatables/js/buttons.print.min.js"></script>
    <script src="src/plugins/datatables/js/buttons.html5.min.js"></script>
    <script src="src/plugins/datatables/js/buttons.flash.min.js"></script>
    <script src="src/plugins/datatables/js/pdfmake.min.js"></script>
    <script src="src/plugins/datatables/js/vfs_fonts.js"></script>
    <!-- Datatable Setting js -->
    <script src="vendors/scripts/datatable-setting.js"></script>

    </body>

    </html>