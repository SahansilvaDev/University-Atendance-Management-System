<?php include './header.php'; ?>

<?php 
session_start();
if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}
?>

<div class="main-container">
    <div class="card-box mb-30">
        <h2 class="h4 pd-20">My Schedule </h2>
        <div class="pb-20">
            <table class="data-table table stripe hover nowrap">
                <thead>
                    <tr>
                        <th class="table-plus datatable-nosort">ID</th>
                        <th>Student ID</th>
                        <th>Subject Name</th>
                        
                        <th>Batch</th>
                        <th>Date</th>
                        <th class="datatable-nosort">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM success_attend WHERE user_id = ?";
                    $stmt = mysqli_prepare($conn, $sql);
                    mysqli_stmt_bind_param($stmt, "s", $user_id);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $id = $row['id'];
                            $student_id = $row['user_id'];
                            $course_name = $row['subject_select'];
                            $course_code = $row['subject_code'];
                            $batch = $row['batch'];
                            $date = $row['date'];
                    ?>
                            <tr>
                                <td class="table-plus"><?php echo $id; ?></td>
                                <td><?php echo $student_id; ?></td>
                                <td><?php echo $course_code . ' ' . $course_name; ?></td>
                                
                                <td><?php echo $batch; ?></td>
                                <td><?php echo $date; ?></td>
                                <td>
                                    <div class="dropdown">
                                        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                            <i class="dw dw-more"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                            <a class="dropdown-item" href="#"><i class="dw dw-eye"></i> View</a>
                                            <a class="dropdown-item" href="#"><i class="dw dw-edit2"></i> Edit</a>
                                            <a class="dropdown-item" href="#"><i class="dw dw-delete-3"></i> Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo "<tr><td colspan='7'>0 results</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>



						

<!-- CSS -->
<link rel="stylesheet" type="text/css" href="vendors/styles/core.css" />
<link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css" />
<link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/dataTables.bootstrap4.min.css" />
<link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/responsive.bootstrap4.min.css" />
<link rel="stylesheet" type="text/css" href="vendors/styles/style.css" />

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
