<?php

include './header.php'; 
include '../config.php'; 
 ?>



<div class="main-container">

    <div class="col-lg-12 col-md-12 col-sm-12 mb-30">
        <div class="pd-20 card-box">
            <h5 class="h4 text-blue mb-20">Faculty Creation</h5>
            <div class="tab">
                <ul class="nav nav-pills alert alert-secondary" role="tablist">
                    <li class="nav-item ">
                        <a class="nav-link active text-black" data-toggle="tab" href="#home5" role="tab" aria-selected="true" style="font-weight:600;">Creating a faculties </a>
                    </li>
                    <li class="nav-item  mx-5">
                        <a class="nav-link text-black" data-toggle="tab" href="#profile5" role="tab" aria-selected="false" style="font-weight:600;">Creating a faculty head position</a>
                    </li>

                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="home5" role="tabpanel">
                        <div class="pd-20">
                            <div class="create_faculty">
                                <form action="./php/Faculty_create.php" method="post" enctype="multipart/form-data">

                                    <div class="form-group " class="mt-3">
                                        <label for="exampleInputEmail1">Faculty Name</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter faculty name" name="faculty_name">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Faculty Code</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter faculty Code" name="faculty_code">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Faculty Description</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="faculty_description"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Faculty Image</label>
                                        <input type="file" class="form-control" id="exampleInputPassword1" name="faculty_image">
                                    </div>
                                    <div class="form-group">

                                    </div>

                                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile5" role="tabpanel">
                        <div class="pd-20">


                            <div class="add_faculty_hed">

                                <div class="row">


                                    <div class="col-md-6 alert ">


                                        <div class="card">
                                            <div class="card-body">

                                                <div class="heder mb-md-3 alert alert-dark">
                                                    <h5>Create Faculty Hed </h5>
                                                </div>


                                                <form action="./php/Faculty_hed.php" method="post" class="mt-3">

                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Faculty Code</label>
                                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter faculty Code" name="faculty_code">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Faculty Name</label>
                                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter faculty name" name="faculty_name">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Faculty Head</label>
                                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter faculty Head" name="faculty_head">
                                                    </div>





                                                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-6 alert ">

                                        <div class="card">
                                            <div class="card-body">
                                                <div class="heder mb-md-3 alert alert-dark">
                                                    <h5>Update Faculty Hed</h5>
                                                </div>

                                                <?php 


$querys = "SELECT * FROM faculty_hed";

$result = mysqli_query($conn, $querys);




?>

                                                <form action="./php/Faculty_hed_update.php" method="post">
        

                                            <div class="form-group">
                                                <label>Faculty Name</label>
                                                <select class="selectpicker form-control" data-style="btn-outline-primary" title="Not Chosen" multiple data-selected-text-format="count" data-count-selected-text="{0} selected" name="Update_Faculty[]">
                                                    <?php 
                                                    if (mysqli_num_rows($result) > 0) {
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                            $faculty_id = $row['id']; // Assuming faculty_id is the primary key
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
                                                        <label for="exampleInputEmail1">Update Faculty Hed</label>
                                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="<?php ?>" name="faculty_hed">
                                                    </div>



                                                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                                </form>

                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>


                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


<?php include './footer.php'; ?>