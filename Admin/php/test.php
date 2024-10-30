<?php  
include "../../config.php";

// Validate and sanitize input
$degree_code = isset($_POST['degree_code']) ? mysqli_real_escape_string($conn, $_POST['degree_code']) : "";
$batch = isset($_POST['batch']) ? mysqli_real_escape_string($conn, $_POST['batch']) : "";
$module_code = isset($_POST['module_code']) ? mysqli_real_escape_string($conn, $_POST['module_code']) : "";

// Prepare the SQL query with placeholders
$query = "
    SELECT 
        s.user_id,
        s.degree_code,
        s.degree_programe,
        s.batch,
        dm.module_code AS related_module_code,
        dm.module_name AS related_module_name,
        dm.faculty_code AS related_faculty_code,
        (
            SELECT COUNT(*) 
            FROM student 
            WHERE degree_code = s.degree_code AND batch = s.batch
        ) AS student_count,
        tm.t_user_id,
        tm.module_code AS t_module_code,
        tm.module_name AS t_module_name,
        tm.faculty_code AS t_faculty_code
    FROM 
        student s
    LEFT JOIN 
        degree_module dm ON s.degree_code = dm.degree_code
    LEFT JOIN 
        t_module tm ON s.degree_code = tm.degree_code
    WHERE
        s.degree_code = '$degree_code' AND
        s.batch = '$batch' AND
        dm.module_code = '$module_code'
";

// Execute the query
$result = mysqli_query($conn, $query);

// Check if the query was successful
if ($result) {
    // Display the results
    ?>

    <div class="table-responsive">
        <table class="table table-success">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">User Id</th>
                    <th scope="col">Degree Program</th>
                    <th scope="col">Module Name</th>
                    <th scope="col">Batch</th>
                    <th scope="col">Teacher id</th>
                    <th scope="col">Faculty</th>
                </tr>
            </thead>
            <tbody>

    <?php
    $counter = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        // Access and process the data as needed
        $User_id = $row['user_id'];
        $degree_code = $row['degree_code'];
        $degree_program = $row['degree_programe'];
        $batch = $row['batch'];
        $related_module_code = $row['related_module_code'];
        $related_module_name = $row['related_module_name'];
        $related_faculty_code = $row['related_faculty_code'];
        $t_user_id = $row['t_user_id'];
        $t_faculty_code = $row['t_faculty_code'];
        ?>

        <tr>
            <th scope="row"><?php echo $counter++; ?></th>
            <td><?php echo $User_id; ?></td>
            <td><?php echo $degree_code . ' - ' . $degree_program; ?></td>
            <td><?php echo $related_module_code . ' - ' . $related_module_name; ?></td>
            <td><?php echo $batch; ?></td>
            <td><?php echo $t_user_id; ?></td>
            <td><?php echo $t_faculty_code; ?></td>
        </tr>

        <?php
    }

    ?>
            </tbody>
        </table>
    </div>

    <?php
} else {
    // Display error if the query fails
    echo "Error executing query: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>  
