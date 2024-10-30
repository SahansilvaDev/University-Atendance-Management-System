<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" >

<style>
    .col {
        margin: 10px;
        padding: 10px;
        border: 1px solid black;
        border-radius: 10px;
        background-color: white;
        width: auto;
        height: auto;
        box-shadow: 10px 10px 10px #888888;
    }

    @media (max-width: 768px) {
        /* Adjusted for screens smaller than 768px wide */
        .col, .card {
            display: block;
        }
    }
</style>



<?php
include "../../config.php";

// Get selected degree program and batch
$degree_code = $_POST['degree_code'];
$batch = $_POST['batch'];

// Fetch student data based on selected degree program and batch
$query = "SELECT user_id, degree_programe, degree_code, batch, name, profile_img FROM student WHERE degree_code = '$degree_code' AND batch = '$batch'";
$result = mysqli_query($conn, $query);



if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $user_id =  $row['user_id'];
        $degree_programe = $row['degree_programe'];
        $degree_code = $row['degree_code'];
        $batch =  $row['batch'];
        $name = $row['name'];
        $profile_img = $row['profile_img'];
?>



<div class="container">
    
    <div class="row">
        <div class="col d-flex flex-row">
            <div class="card">
            <?php
                if ($profile_img == NULL) {
                    echo '<img src="./php/001.webp" class="card-img-top" alt="...">';
                } else {
                    echo '<img src="../Student/' . $profile_img . '" class="card-img-top" alt="...">';
                }
                ?>

                <div class="card-body">
                    <h5 class="card-title"><?php echo $name; ?></h5>
                    <p class="card-text"><?php echo $user_id; ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    }
} else {
    echo 'No students found.';
}
?>


