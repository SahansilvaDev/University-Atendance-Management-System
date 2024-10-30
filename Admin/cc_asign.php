<?php
include './header.php';
include '../config.php';

$query_faculty = "SELECT * FROM faculty";
$result_faculty = mysqli_query($conn, $query_faculty);

$query_teacher = "SELECT * FROM teacher";
$result_teacher = mysqli_query($conn, $query_teacher);

$query_teacher1 = "SELECT user_id, name FROM teacher";
$result_teacher1 = mysqli_query($conn, $query_teacher1);

$query_teacher2 = "SELECT user_id, name FROM teacher";
$result_teacher2 = mysqli_query($conn, $query_teacher2);

$query_degree_module = "SELECT degree_code, degree_name, module_code, module_name, Faculty_code, Faculty_name FROM degree_module";
$result_degree_module = mysqli_query($conn, $query_degree_module);


$query_degree_module1 = "SELECT degree_code, degree_name, module_code, module_name, Faculty_code, Faculty_name FROM degree_module";
$result_degree_module1 = mysqli_query($conn, $query_degree_module1);



$query_degree_module_1 = "SELECT degree_code, degree_name, module_code, module_name, Faculty_code, Faculty_name FROM degree_module";
$result_degree_module_1 = mysqli_query($conn, $query_degree_module_1);

$query_degree_module2 = "SELECT degree_code, degree_name, module_code, module_name, Faculty_code, Faculty_name FROM degree_module";
$result_degree_module2 = mysqli_query($conn, $query_degree_module2);




$query_degree_module3 = "SELECT course_name, course_code, Faculty_name FROM courses";
$result_degree_module3 = mysqli_query($conn, $query_degree_module3);

$query_degree_module4 = "SELECT course_name, course_code, Faculty_name FROM courses";
$result_degree_module4 = mysqli_query($conn, $query_degree_module4);


$query_degreefaculty = "SELECT faculty_code, faculty_name FROM faculty";
$result_degreefaculty = mysqli_query($conn, $query_degreefaculty);


$query_degreefaculty1 = "SELECT faculty_code, faculty_name FROM faculty";
$result_degreefaculty1 = mysqli_query($conn, $query_degreefaculty1);


?>


<div class="mobile-menu-overlay"></div>

<div class="main-container">
    <div class="col-sm-12 col-md-12 mb-30 mt-3">
        <div class="card card-box">
            <div class="card-header">
                <ul class="nav nav-pills card-header-pills">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="pill" href="#tab1">Cource Creation</a>
                    </li>
                    <li class="nav-item  mx-5">
                        <a class="nav-link  px-5" data-toggle="pill" href="#tab2">Asign Module</a>
                    </li>
                </ul>
            </div>

            <div class="card-body">
                <div class="tab-content">
                    <div id="tab1" class="tab-pane fade show active">
                        <h5 class="card-title">Degree Creation</h5>

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
                                                    if (mysqli_num_rows($result_faculty) > 0) {
                                                        while ($row = mysqli_fetch_assoc($result_faculty)) {
                                                            $faculty_id = $row['id'];
                                                            $faculty_name = $row['faculty_name'];
                                                            echo "<option value='$faculty_name'>$faculty_name</option>";
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
                                                    if (mysqli_num_rows($result_teacher) > 0) {
                                                        while ($row = mysqli_fetch_assoc($result_teacher)) {
                                                            $teacher_id = $row['id'];
                                                            $teacher_name = $row['name'];
                                                            echo "<option value='$teacher_name'>$teacher_name</option>";
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
                    <!-- end update -->
                    <div id="tab2" class="tab-pane fade">
                        <h5 class="card-title  my-3">Asign module in teacher</h5>

                        <div class="row">
                            <div class="col-lg-8">
                        <form action="./php/asign_module.php" method="post">

                            <div class="form-group">
                                <label>Teacher ID</label>
                                <select class="selectpicker form-control" data-style="btn-outline-primary" title="Not Chosen" multiple data-selected-text-format="count" data-count-selected-text="{0} selected" name="teacher_id">
                                    <?php
                                    if (mysqli_num_rows($result_teacher1) > 0) {
                                        while ($row = mysqli_fetch_assoc($result_teacher1)) {
                                            $teacher_id = $row['id'];
                                            $teacher_user_id = $row['user_id'];
                                            $teacher_name = $row['name'];
                                            echo "<option value='$teacher_user_id'>$teacher_user_id -  $teacher_name </option>";
                                        }
                                    } else {
                                        echo "<option value=''>No teacher available</option>";
                                    }

                                  
                                    ?>
                                </select>
                            </div>


                            <div class="form-group">
                                <label>Teacher Name</label>
                                <select class="selectpicker form-control" data-style="btn-outline-primary" title="Not Chosen" multiple data-selected-text-format="count" data-count-selected-text="{0} selected" name="teacher_name">
                                    <?php
                                    if (mysqli_num_rows($result_teacher2) > 0) {
                                        while ($row = mysqli_fetch_assoc($result_teacher2)) {
                                            $teacher_id = $row['id'];
                                            $teacher_user_id = $row['user_id'];
                                            $teacher_name = $row['name'];
                                            echo "<option value='$teacher_name'>$teacher_user_id - $teacher_name </option>";
                                        }
                                    } else {
                                        echo "<option value=''>No teacher available</option>";
                                    }

                                  
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Degree Code</label>
                                <select class="selectpicker form-control" data-style="btn-outline-primary" title="Not Chosen" multiple data-selected-text-format="count" data-count-selected-text="{0} selected" name="degree_code">
                                    <?php
                                    if (mysqli_num_rows($result_degree_module3) > 0) {
                                        while ($row = mysqli_fetch_assoc($result_degree_module3)) {
                                            $degree_code = $row['course_code'];
                                            $degree_name = $row['course_name'];
                                            echo "<option value='$degree_code'>$degree_code - $degree_name</option>";
                                        }
                                    } else {
                                        echo "<option value=''>No degree module available</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Degree Name</label>
                                <select class="selectpicker form-control" data-style="btn-outline-primary" title="Not Chosen" multiple data-selected-text-format="count" data-count-selected-text="{0} selected" name="degree_name">
                                    <?php
                                    if (mysqli_num_rows($result_degree_module4) > 0) {
                                        while ($row = mysqli_fetch_assoc($result_degree_module4)) {
                                            $degree_code = $row['course_code'];
                                            $degree_name = $row['course_name'];
                                            echo "<option value='$degree_name'>$degree_code - $degree_name</option>";
                                        }
                                    } else {
                                        echo "<option value=''>No degree module available</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Module Code</label>
                                <!-- <select class="selectpicker form-control" data-style="btn-outline-primary" title="Not Chosen" multiple data-selected-text-format="count" data-count-selected-text="{0} selected" name="module_code">
                                    <?php
                                //  if ($result_degree_module1 && mysqli_num_rows($result_degree_module1) > 0) {
                                //     while ($row = mysqli_fetch_assoc($result_degree_module1)) {
                                //         $degree_code = $row['degree_code'];
                                //         $degree_name = $row['degree_name'];
                                //         $module_code = $row['module_code'];
                                //         $module_name = $row['module_name'];
                                //         $faculty_code = $row['Faculty_code'];
                                //         $faculty_name = $row['Faculty_name'];
                                
                                //         echo "<option value='$module_code'>$module_code -  $module_name</option>";
                                    
                                
                                //     }
                                // } else {
                                //     echo "No module available";
                                // }
                                    ?>
                                </select> -->

                                <input class="form-control form-control-lg" type="text" name="module_code" placeholder="Module Code" required />
                           
                            </div>


                            <div class="form-group">
                                <label>Module Name</label>
                                <!-- <select class="selectpicker form-control" data-style="btn-outline-primary" title="Not Chosen" multiple data-selected-text-format="count" data-count-selected-text="{0} selected" name="module_name">
                                    <?php
                                //  if ($result_degree_module_1 && mysqli_num_rows($result_degree_module_1) > 0) {
                                //     while ($row = mysqli_fetch_assoc($result_degree_module_1)) {
                                //         $degree_code = $row['degree_code'];
                                //         $degree_name = $row['degree_name'];
                                //         $module_code = $row['module_code'];
                                //         $module_name = $row['module_name'];
                                //         $faculty_code = $row['Faculty_code'];
                                //         $faculty_name = $row['Faculty_name'];
                                
                                //         echo "<option value='$module_name'>$module_code -  $module_name</option>";
                                    
                                
                                //     }
                                // } else {
                                //     echo "No module available";
                                // }
                                    ?>
                                </select> -->

                                <input class="form-control form-control-lg" type="text" name="module_name" placeholder="Module name" required />
                           
                            </div>


                            <div class="form-group">
                                <label>Faculty Code</label>
                                <select class="selectpicker form-control" data-style="btn-outline-primary" title="Not Chosen" multiple data-selected-text-format="count" data-count-selected-text="{0} selected" name="faculty_code">
                                <?php
                                 if ($result_degreefaculty && mysqli_num_rows($result_degreefaculty) > 0) {
                                    while ($row = mysqli_fetch_assoc($result_degreefaculty)) {
                                        
                                        $faculty_code = $row['faculty_code'];
                                        $faculty_name = $row['faculty_name'];
                                
                                        echo "<option value='$faculty_code'>$faculty_code -  $faculty_name   </option>";
                                    
                                
                                    }
                                } else {
                                    echo "No module available";
                                }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Faculty Name</label>
                                <select class="selectpicker form-control" data-style="btn-outline-primary" title="Not Chosen" multiple data-selected-text-format="count" data-count-selected-text="{0} selected" name="faculty_name">
                                <?php
                                 if ($result_degreefaculty1 && mysqli_num_rows($result_degreefaculty1) > 0) {
                                    while ($row = mysqli_fetch_assoc($result_degreefaculty1)) {
                                        
                                        $faculty_code = $row['faculty_code'];
                                        $faculty_name = $row['faculty_name'];
                                
                                        echo "<option value='$faculty_name'>$faculty_code -  $faculty_name   </option>";
                                    
                                
                                    }
                                } else {
                                    echo "No module available";
                                }
                                    ?>
                                </select>
                            </div>


                            <input type="submit" class="btn btn-primary" value="Assign" name="submit" />

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
</div>

<?php include './footer.php'; ?>
