<?php
// Include the configuration file
include '../config.php';

// Start the session
session_start();

// Assuming user_id is provided dynamically or retrieved from session
if (isset($_SESSION['user_id'])) {
    // Get the user_id from the session
    $user_id = $_SESSION['user_id'];
    echo $user_id; 

    // Establish a connection to the database (assuming $conn is your database connection)
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check if connection was successful
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to fetch data
    $sql = "SELECT
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
                s.user_id = '$user_id' 
                AND s.degree_code = dm.degree_code 
                AND s.batch = cqa.batch";

    // Execute the query
    $result = $conn->query($sql);

    if ($result === false) {
        // Handle query execution error
        echo "Error executing query: " . $conn->error;
    } else {
        // Check if there are rows returned
        if ($result->num_rows > 0) {
            // Loop through the result set
            while ($row = $result->fetch_assoc()) {
                // Process each row of data
                $row['user_id'];
                 $row['module_code'];
                print_r($row); 
            }
        } else {
            echo "No records found"; // Handle case where no matching records are found
        }
    }

    // Close the database connection
    $conn->close();
}
?>
