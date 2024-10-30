<?php include './header.php'; ?>
<?php include '../config.php';

$query_student1 = "SELECT user_id, degree_programe, degree_code, batch, name FROM student";
$result_student1 = mysqli_query($conn, $query_student1);

?>

<link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/dataTables.bootstrap4.min.css" />

<div class="main-container">
    <div class="xs-pd-20-10 pd-ltr-20">

        <!-- Select-2 Start -->
        <div class="pd-20 card-box mb-30">
            <form method="post">
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>Select subject</label>
                            <select class="custom-select2 form-control" name="batch[]" style="width: 100%; height: 38px">
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
                    </div>
                    <div class="col-md-4">
                        <div class="form-group py-4 mt-2">
                            <button type="submit" class="btn btn-outline-primary" name="submit">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Checkbox select Datatable start -->
        <div class="card-box mb-30">
            <div class="pd-20">
                <h4 class="text-blue h4">Students Overview</h4>
            </div>
            <div class="pb-20">
                <table class="checkbox-datatable table nowrap">
                    <thead>
                        <tr>
                            <th>
                                <div class="dt-checkbox">
                                    <input type="checkbox" name="select_all" value="1" id="example-select-all" />
                                    <span class="dt-checkbox-label"></span>
                                </div>
                            </th>
                            <th>Reg ID</th>
                            <th>Name</th>
                            <th>Degree</th>
                            <th>Batch</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        if (isset($_POST['submit'])) {
                            $selected_batches = $_POST['batch'];
                            if (!empty($selected_batches)) {
                                $batch_filter = "'" . implode("','", $selected_batches) . "'";
                                $query_student = "SELECT user_id, degree_programe, degree_code, batch, fname, lname
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

                                if (mysqli_num_rows($result_student) > 0) {
                                    while ($row = mysqli_fetch_assoc($result_student)) {
                                        $degree_code = $row['degree_code'];
                                        $degree_programe = $row['degree_programe'];
                                        $fname = $row['fname'];
                                        $lname = $row['lname'];
                                        $batch = $row['batch'];
                                        $user_id = $row['user_id'];
                        ?>
                                        <tr>
                                            <td></td>
                                            <td><?php echo $user_id; ?></td>
                                            <td><?php echo $fname . ' ' . $lname; ?></td>
                                            <td><?php echo $degree_code . ' - ' . $degree_programe; ?></td>
                                            <td><?php echo $batch; ?></td>
                                        </tr>
                        <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='5'>No students found for the selected batch.</td></tr>";
                                }
                            } else {
                                echo "<tr><td colspan='5'>Please select at least one batch.</td></tr>";
                            }
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
        <!-- Checkbox select Datatable End -->

    </div>
</div>

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
