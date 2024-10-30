<?php include './header.php'; ?>

<?php
include '../config.php';
date_default_timezone_set('Asia/Colombo');

session_start();
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $filter_year = date('d F Y '); 

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT t_module.t_user_id, t_module.degree_code, t_module.module_code, t_module.Faculty_code,
                CASE WHEN t_module.degree_code = degree_module.degree_code THEN degree_module.degree_name ELSE NULL END AS degree_name,
                CASE WHEN t_module.degree_code = degree_module.degree_code THEN degree_module.module_code ELSE NULL END AS module_code,
                CASE WHEN t_module.degree_code = degree_module.degree_code THEN degree_module.module_name ELSE NULL END AS module_name,
                CASE WHEN t_module.degree_code = degree_module.degree_code THEN degree_module.Faculty_code ELSE NULL END AS degree_faculty_code,
                CASE WHEN t_module.degree_code = degree_module.degree_code THEN degree_module.Faculty_name ELSE NULL END AS degree_faculty_name,
                faculty.faculty_code, faculty.faculty_name,
                student.user_id, student.degree_programe, student.batch 
            FROM t_module
            LEFT JOIN degree_module ON t_module.degree_code = degree_module.degree_code
            LEFT JOIN faculty ON t_module.Faculty_code = faculty.faculty_code
            LEFT JOIN student ON t_module.degree_code = student.degree_code
            WHERE t_module.t_user_id = '$user_id'";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        ?>
        <div class="main-container">
            <div class="pd-ltr-20 xs-pd-20-10">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Degree</th>
                                <th scope="col">Subjects</th>
                                <th scope="col">Class</th>
                                <th scope="col">Student Count</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <tr>
                                    <th scope="row">1</th>
                                    <td><?php echo $row['degree_code'] . " - " . $row['degree_name']; ?></td>
                                    <td><?php echo $row['module_code'] . " - " . $row['module_name']; ?></td>
                                    <td><?php echo $row['batch']; ?></td>
                                    <td><span class="badge badge-primary">Primary</span></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>

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
</body>
</html>
