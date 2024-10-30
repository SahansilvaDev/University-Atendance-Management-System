<?php
include './header.php';
include '../config.php';

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
            s.degree_code = dm.degree_code
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
    ?>
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <!-- Export Datatable start -->
            <div class="card-box mb-30">
                <div class="pd-20">
                    <h4 class="text-blue h4">Export Details</h4>
                </div>
                <div class="pb-20">
                    <table class="table hover multiple-select-row data-table-export nowrap">
                        <thead>
                            <tr>
                                <th class="table-plus datatable-nosort">ID</th>
                                <th>User ID</th>
                                <th>Degree Code</th>
                                <th>Degree Program</th>
                                <th>Batch</th>
                                <th>Module Code</th>
                                <th>Module Name</th>
                                <th>Subject Count</th>
                                <th>Subject Select Count</th>
                                <th>Time</th>
                                <th>QR Code</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $id = 0; // Initialize ID counter before the loop

                            while ($row = $result->fetch_assoc()) {
                                $id++; // Increment ID for each row

                                echo '<tr>
                                        <td>'.$id.'</td>
                                        <td>'.$row['user_id'].'</td>
                                        <td>'.$row['degree_code'].'</td>
                                        <td>'.$row['degree_programe'].'</td>
                                        <td>'.$row['batch'].'</td>
                                        <td>'.$row['module_code'].'</td>
                                        <td>'.$row['module_name'].'</td>
                                        <td>'.$row['subject_count'].'</td>
                                        <td>'.$row['subject_select_count'].'</td>
                                        <td>'.$row['time'].'</td>
                                        <td>'.$row['qr_code'].'</td>
                                      </tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Export Datatable End -->
        </div>
    </div>
    <?php
}
?>

<!-- CSS -->
<link rel="stylesheet" type="text/css" href="vendors/styles/core.css">
<link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css">
<link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="vendors/styles/style.css">

<!-- JS -->
<script src="vendors/scripts/core.js"></script>
<script src="vendors/scripts/script.min.js"></script>
<script src="vendors/scripts/process.js"></script>
<script src="vendors/scripts/layout-settings.js"></script>
<script src="src/plugins/datatables/js/jquery.dataTables.min.js"></script>
<script src="src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
<script src="src/plugins/datatables/js/dataTables.responsive.min.js"></script>
<script src="src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
<script src="src/plugins/datatables/js/dataTables.buttons.min.js"></script>
<script src="src/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
<script src="src/plugins/datatables/js/buttons.print.min.js"></script>
<script src="src/plugins/datatables/js/buttons.html5.min.js"></script>
<script src="src/plugins/datatables/js/buttons.flash.min.js"></script>
<script src="src/plugins/datatables/js/pdfmake.min.js"></script>
<script src="src/plugins/datatables/js/vfs_fonts.js"></script>
<script src="vendors/scripts/datatable-setting.js"></script>
