<?php include './header.php'; ?>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<style>
    .update_faculty {
        font-size: 20px;
        font-weight: bold;
        color: blue;
        cursor: pointer;
    }
</style>

<?php
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'attended_system';

$conn = new mysqli($hostname, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



if (isset($_POST['submit1'])) {
    $faculty_name = htmlspecialchars($_POST['faculty']);
    $faculty_owner = htmlspecialchars($_POST['faculty_owner']);

    // Assuming $conn is your database connection
    $f_query = "INSERT INTO faculty (faculty, faculty_owner) VALUES ('$faculty_name', '$faculty_owner')";
    $f_result = mysqli_query($conn, $f_query);

    if ($f_result) {
        echo "'Faculty Added Successfully';";
    } else {
        echo "'Faculty Not Added'";
    }
}
$show_f_faculty = "SELECT * FROM faculty";
$s_f_result = mysqli_query($conn, $show_f_faculty);

while ($row = mysqli_fetch_assoc($s_f_result)) {
    $Faculty = $row['faculty'];
    $Faculty_Owner = $row['faculty_owner'];
}

?>


<div class="mobile-menu-overlay"></div>

<div class="main-container">
    <div class="col-sm-12 col-md-10 mb-30">
        <div class="card card-box">
            <div class="card-header">
                <ul class="nav nav-pills card-header-pills">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="pill" href="#tab1">Faculty Creation</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#tab2">Courses Creation</a>
                    </li>
                </ul>
            </div>

            <div class="card-body">
                <div class="tab-content">
                    <div id="tab1" class="tab-pane fade show active">
                        <h5 class="card-title">Faculty Creation</h5>
                        <form action="" method="post">

                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label">Faculty</label>
                                <div class="col-sm-12 col-md-10">
                                    <input class="form-control" name="faculty" type="text" placeholder="Faculty Name" />
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label">Faculty Head</label>
                                <div class="col-sm-12 col-md-10">
                                    <input class="form-control" name="faculty_owner" type="text" placeholder="Faculty Owner" />
                                </div>
                            </div>







                            <button type="submit" name="submit1" class="btn btn-primary">Create</button>
                        </form>


                        <!-- update -->
                        <?php
                        if (isset($_POST['update'])) {
                            $selectedFaculty = htmlspecialchars($_POST['role']); // Get the selected faculty
                            $faculty_owner = htmlspecialchars($_POST['faculty_owner']);

                            // Ensure you have a unique identifier for each faculty (for example, an ID column)
                            $f_update = "UPDATE faculty SET faculty_owner = '$faculty_owner' WHERE faculty = '$selectedFaculty'";
                            $update_result = mysqli_query($conn, $f_update);

                            if ($update_result) {
                                echo "<script>alert('Faculty Updated Successfully');</script>";
                                // Perform any other actions or redirects as needed
                            } else {
                                echo "<script>alert('Faculty Update Failed');</script>";
                            }
                        }
                        ?>


                        <form action="" method="POST">
                            <div class="update_faculty my-3 " id="update_faculty">Update section</div>

                            <div class="update_faculty_section">
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Faculty</label>
                                    <div class="col-sm-12 col-md-10">
                                        <select class="custom-select col-12" name="role">
                                            <option selected="">Choose...</option>
                                            <?php
                                            $s_f_result = mysqli_query($conn, $show_f_faculty);
                                            while ($row = mysqli_fetch_assoc($s_f_result)) {
                                                $Faculty = $row['faculty'];
                                                echo "<option value='$Faculty'>$Faculty</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Faculty Owner</label>
                                    <div class="col-sm-12 col-md-10">
                                        <input class="form-control" name="faculty_owner" type="text" placeholder="<?php echo  $Faculty_Owner; ?>" />
                                    </div>
                                </div>

                                <button type="submit" name="update" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                    <!-- end update -->

                </div>


                <?php

             
                if(isset($_POST['submit2'])){
                    $faculty_id = $_POST['role'];  
                    $course_code = strtolower(htmlspecialchars($_POST['course_code']));
                    $course_name = strtolower(htmlspecialchars($_POST['course_name']));

     
                                        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                           
                                            if (isset($_POST['role'])) {
                                                $selectedFaculty = $_POST['role'];
                                               

                    // Insert the data into the module_code table, including the faculty_id
                    $M_course_query = "INSERT INTO module (faculty, faculty_id, module_code, module_name) VALUES('$selectedFaculty', '$faculty_id', '$course_code', '$course_name')";
                    $course_result = mysqli_query($conn, $M_course_query);

                    if(!$course_result){
                        echo "Course Not Added";
                    } else {
                        echo "Course Added Successfully";
                    }
                }    } else {
                    echo "Please select a faculty.";
                }
            }
                ?>



                <div id="tab2" class="tab-pane fade">
                    <h5 class="card-title">Course Creation</h5>
                    <form action="" method="post">

                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Faculty</label>
                            <div class="col-sm-12 col-md-10">
                            <select class="custom-select col-12" name="role">
                                <option selected="">Choose...</option>
                                <?php
                                $s_f_result = mysqli_query($conn, $show_f_faculty);
                                while ($row = mysqli_fetch_assoc($s_f_result)) {
                                    $Faculty = $row['faculty'];
                                    echo "<option value='$Faculty'>$Faculty</option>";
                                }
                                ?>
                            </select>

                            <?php
                            // Check if the form is submitted
                         
                            ?>




                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Course Code</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" name="course_code" type="text" placeholder="EEEC" />
                            </div>
                        </div>



                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Course Name</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" name="course_name" type="text" placeholder="Mobile Application" />
                            </div>
                        </div>

                        <button type="submit" name="submit2" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>





<?php include './footer.php'; ?>


<script>
    // Wait for the document to be ready
    $(document).ready(function() {
        // Initially hide the update faculty section
        $('.update_faculty_section').hide();

        // Add click event listener to the update faculty button
        $('#update_faculty').click(function() {
            // Toggle the visibility of the update faculty section
            $('.update_faculty_section').toggle();
        });
    });
</script>