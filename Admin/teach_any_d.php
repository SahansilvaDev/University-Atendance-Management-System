<?php include './header.php'; ?>



<?php

include '../config.php';


$query_student1 = "SELECT user_id, degree_programe, degree_code, batch, name FROM student";
$result_student1 = mysqli_query($conn, $query_student1);







?>

<link rel="stylesheet" type="text/css" href="src/plugins/jvectormap/jquery-jvectormap-2.0.3.css" />


<div class="main-container">
    <div class="xs-pd-20-10 pd-ltr-20">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Teacher Analysis </h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Teacher Analysis
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>





        <div class="row">

            <div class="col-lg-6 col-md-12 col-sm-12 mb-30">
                <div class="card-box pd-30 height-100-p">
                    <h4 class="mb-30 h4">Records</h4>
                    <div id="chart" class="chart"></div>

                </div>
            </div>
        </div>



</div>
</div>













<?php include './footer.php'; ?>



