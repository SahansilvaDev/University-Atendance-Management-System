<?php
include './header.php';
include '../config.php';

$querys = "SELECT * FROM faculty";
$result1 = mysqli_query($conn, $querys);

$querys = "SELECT * FROM teacher";
$result = mysqli_query($conn, $querys);

// Form submission handling

?>

<div class="main-container">
    <div class="pd-20 card-box">
        <h5 class="h4 text-blue mb-20">Users Adding Section</h5>
        <div class="pd-20">
            <div class="admin_main crd-box-img1">
                <div class="row">
                    <div class="col-md-6">
                        <form action="./php/cource_creation.php" method="post">
                            <div class="form-group">
                                <label>Course Name</label>
                                <input class="form-control form-control-lg" type="text" name="course_name" placeholder="Course Name" required />
                            </div>
                            <div class="form-group">
                                <label>Course Code</label>
                                <input class="form-control form-control-lg" type="text" name="course_code" placeholder="Course Code" required />
                            </div>
                            <div class="form-group">
                                <label>Faculty Name</label>
                                <select class="selectpicker form-control" data-style="btn-outline-primary" title="Not Chosen" multiple data-selected-text-format="count" data-count-selected-text="{0} selected" name="faculty_name[]">
                                    <?php
                                    if (mysqli_num_rows($result1) > 0) {
                                        while ($row = mysqli_fetch_assoc($result1)) {
                                            $faculty_id = $row['id'];
                                            $faculty_name = $row['faculty_name'];
                                            echo "<option value='$faculty_id'>$faculty_name</option>";
                                        }
                                    } else {
                                        echo "<option value=''>No faculty available</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Teacher Name</label>
                                <select class="selectpicker form-control" data-style="btn-outline-primary" title="Not Chosen" multiple data-selected-text-format="count" data-count-selected-text="{0} selected" name="teacher_name[]">
                                    <?php
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $teacher_id = $row['id'];
                                            $teacher_name = $row['name'];
                                            echo "<option value='$teacher_id'>$teacher_name</option>";
                                        }
                                    } else {
                                        echo "<option value=''>No teacher available</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="course_description"></textarea>
                            </div>
                            <div class="form-group mb-0">
                                <input type="submit" class="btn btn-primary" value="Send Information" name="submit" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include './footer.php'; ?>
