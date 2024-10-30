<?php
include './header.php';

include '../config.php';

$query_student1 = "SELECT user_id, degree_programe, degree_code, batch, name FROM student";
$result_student1 = mysqli_query($conn, $query_student1);



$query_student = "SELECT user_id, degree_programe, degree_code, batch, name, profile_img FROM student";
$result_student = mysqli_query($conn, $query_student);


$query_teacher = "SELECT user_id, name, fname, lname FROM teacher";
$result_teacher = mysqli_query($conn, $query_teacher);


$query_degree_module = "SELECT degree_code, degree_name, module_code, module_name FROM degree_module";
$result_degree_module = mysqli_query($conn, $query_degree_module);






?>


<div class="mobile-menu-overlay"></div>

<div class="main-container">
    <div class="col-sm-12 col-md-12 mb-30 mt-3">
        <div class="card card-box">
            <div class="card-header">
                <ul class="nav nav-pills card-header-pills">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="pill" href="#tab1">Subject Assign</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link " data-toggle="pill" href="#tab2">Module Assign</a>
                    </li>


                    <li class="nav-item  ">
                        <a class="nav-link px-5" data-toggle="pill" href="#tab3">Elective Subject Assign</a>
                    </li>
                </ul>
            </div>

            <div class="card-body">
                <div class="tab-content">
                    <div id="tab1" class="tab-pane fade show active">
                        <h5 class="card-title">All Details For Subject Assign for Students</h5>

                        <div class="pd-20">
                            <div class="admin_main crd-box-img1">
                                <form id="studentForm" action="" method="post">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Degree Programme</label>
                                                <select class="selectpicker form-control" data-style="btn-outline-primary" title="Not Chosen" multiple data-selected-text-format="count" data-count-selected-text="{0} selected" name="degree_code">
                                                    <?php
                                                    if (mysqli_num_rows($result_student1) > 0) {
                                                        while ($row = mysqli_fetch_assoc($result_student1)) {
                                                            $degree_code = $row['degree_code'];
                                                            $degree_name = $row['degree_programe'];
                                                            echo "<option value='$degree_code'>$degree_code - $degree_name</option>";
                                                        }
                                                    } else {
                                                        echo "<option value=''>No degree available</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Batch</label>
                                                <select class="selectpicker form-control" data-style="btn-outline-primary" title="Not Chosen" multiple data-selected-text-format="count" data-count-selected-text="{0} selected" name="batch">
                                                    <?php
                                                    mysqli_data_seek($result_student, 0); // Reset pointer
                                                    if (mysqli_num_rows($result_student) > 0) {
                                                        while ($row = mysqli_fetch_assoc($result_student)) {
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
                                    </div>
                                    <div class="form-group mb-3">
                                        <button type="submit" class="btn btn-primary">Show Student</button>
                                    </div>




                                </form>

                                <div class="container mt-3" id="stu_c" style="display: none;">

                                    <div class="stu_c d-flex flex-row" id="studentTable"></div>


                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab2" class="tab-pane fade">
                        <h5 class="card-title my-3">Elective Subject Assign</h5>

                        <iframe src="./php/asign_student_subject.php"></iframe>



                        <style>
                            /* Disable vertical scrolling */
                            iframe {
                                display: block;
                                /* iframes are inline by default */
                                height: 100vh;
                                /* Set height to 100% of the viewport height */
                                width: 100%;
                                /* Set width to 100% of the viewport width */
                                border: none;
                                /* Remove default border */
                                background: lightyellow;
                                /* Just for styling */
                            }
                        </style>




                    </div>





                    <div id="tab3" class="tab-pane fade">
                        <h5 class="card-title my-3">Elective Subject Assign</h5>
                        <div class="row">
                            <div class="col-lg-8">
                                <form action="#" method="post">

                                <iframe src="./php/asign_student_subject.php"></iframe>

                                    <input type="submit" class="btn btn-primary" value="Assign Elective" name="submit" />
                                </form>
                            </div>
                            <div class="col-lg-2"></div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>

<?php include './footer.php'; ?>

<style>
    .container {
        display: flex;
        flex-direction: row;
        justify-content: center;
    }

    @media (max-width: 467px) {

        /* For screens smaller than 768px wide */
        .col,
        .card {
            display: block;
        }
    }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#studentForm').submit(function(e) {
            e.preventDefault(); // Prevent form submission
            var formData = $(this).serialize(); // Serialize form data
            $.ajax({
                type: 'POST',
                url: './php/show_students.php', // PHP file to handle the request
                data: formData,
                success: function(response) {
                    $('#stu_c').show(); // Show the student table container
                    $('#studentTable').html(response); // Populate student data
                }
            });
        });
    });
</script>