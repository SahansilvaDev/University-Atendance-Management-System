<?php  
include "../../config.php";
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap demo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<form id="studentForm1" action="" method="post">
 
    <div class="row">
      <div class="col-sm-4">
        <label>Degree Code</label>
        <select class="form-select form-select-lg mb-3" aria-label="Large select example" name="degree_code">
          <?php
          $query_student1 = "SELECT user_id, degree_programe, degree_code, batch, name FROM student";
          $result_student1 = mysqli_query($conn, $query_student1);

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

      <div class="col-sm-4">
        <label>Batch</label>
        <select class="form-select form-select-lg mb-3" aria-label="Large select example" name="batch">
          <?php
          $query_student = "SELECT user_id, degree_programe, degree_code, batch, name, profile_img FROM student";
          $result_student = mysqli_query($conn, $query_student);

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

      <div class="col-sm-4">
        <label>Module Code</label>
        <select class="form-select form-select-lg mb-3" aria-label="Large select example" name="module_code">
          <?php
          $query_degree_module = "SELECT degree_code, degree_name, module_code, module_name FROM degree_module";
          $result_degree_module = mysqli_query($conn, $query_degree_module);

          if (mysqli_num_rows($result_degree_module) > 0) {
            while ($row = mysqli_fetch_assoc($result_degree_module)) {
              $module_code = $row['module_code'];
              $module_name = $row['module_name'];
              echo "<option value='$module_code'>$module_code - $module_name</option>";
            }
          } else {
            echo "<option value=''>No module available</option>";
          }
          ?>
        </select>
      </div>
    </div>

    <div class="form-group mb-3">
      <input type="submit" class="btn btn-primary mx-5 ms-5 px-5" value="Send" name="submit">
    </div>

  </div>
</form>

<div class="container mt-5" id="stu_c1" style="display: none;">
  <div class="stu_c " id="studentTable1"></div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  $(document).ready(function() {
    $('#studentForm1').submit(function(e) {
      e.preventDefault(); // Prevent form submission
      var formData = $(this).serialize(); // Serialize form data
      $.ajax({
        type: 'POST',
        url: './test.php', // PHP file to handle the request
        data: formData,
        success: function(response) {
          $('#stu_c1').show(); // Show the student table container
          $('#studentTable1').html(response); // Populate student data
        },
        error: function(xhr, status, error) {
          console.error(xhr.responseText);
        }
      });
    });
  });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
