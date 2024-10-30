

<link rel="stylesheet" type="text/css" href="vendors/styles/core.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

<?php
include '../config.php'; // Assuming this file contains your database connection settings

session_start();

date_default_timezone_set('Asia/Colombo');

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $date = date('d F Y');
    $current_time = time(); 
    $human_readable_time1 = date("g:i a", $current_time);

 

    $sql_att = "SELECT
                    s.user_id,
                    s.degree_code,
                    s.degree_programe,
                    s.batch,
                    dm.module_code,
                    dm.module_name,
                    cqa.subject_code,
                    cqa.subject_select,
                    cqa.batch AS cqa_batch,
                    cqa.time,
                    cqa.qr_date,
                    cqa.teacher_id,
                    cqa.qr_code
                FROM
                    student s
                JOIN
                    degree_module dm ON s.degree_code = dm.degree_code
                JOIN
                    create_qr_attendance cqa ON dm.module_code = cqa.subject_code
                WHERE
                    s.user_id = ?
                    AND s.degree_code = dm.degree_code
                    AND s.batch = cqa.batch
                    AND cqa.qr_date = ?   ";
                   

    // Use prepared statement to avoid SQL injection
    $stmt = mysqli_prepare($conn, $sql_att);
    mysqli_stmt_bind_param($stmt, "ss", $user_id, $date);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
   

    


 


    
    // Check if the query result has rows
    if (mysqli_num_rows($result) > 0) {
        // Array to store messages
        $messages = [];

        // Loop through each row in the result set
        while ($row = $result->fetch_assoc()) {
            // Extract data from the current row
            $subject_select = $row['subject_select'];
            $subject_code = $row['subject_code'];
            $teacher_id = $row['teacher_id'];
    
            // Construct the attendance message
            $attendanceMessage = "Stay Engaged! Make Your Attendance in <span style='font-size: 14px; color: green;'>$subject_select ($subject_code)</span>";

    
            // Store the message in the messages array
            $messages[] = $attendanceMessage;
        }
    
        // Display attendance messages
        foreach ($messages as $message) {
            // echo "<p>$message</p>"; // Display each message

            ?>
        


            <div class="alert alert-primary alert-dismissible fade show" role="alert">
            <strong><?php echo $teacher_id ;?></strong> ]
            <?php echo $message ; ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>

            <?php
        }
    
       
      
    } else {
      
    }
}


    ?>

  


<style>
    .card {
    border: 1px solid #ccc; /* Border style */
    border-radius: 5px; /* Rounded corners */
    box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1); /* Shadow effect */
    padding: 10px;
  
    background-color: #fff; /* Background color */
}

.card-body {
    font-size: 16px; /* Font size */
    color: #333; /* Text color */
}

.card p{
    text-align: justify;
    font-size: 12px;
    color:#333;
}
</style>


<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>