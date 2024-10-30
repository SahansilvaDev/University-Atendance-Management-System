<?php
// Include database configuration file
include '../../config.php';

// Set timezone to Asia/Colombo
date_default_timezone_set('Asia/Colombo');

// Get today's date in 'd F Y' format
$date = date('d F Y');

echo $date;

// Query to fetch relevant data from database
$query_subject_time = "SELECT id, expired, qr_code, time, subject_time FROM create_qr_attendance WHERE qr_date = '$date' ORDER BY id DESC";

// Execute the query
$result_subject_time = mysqli_query($conn, $query_subject_time);

// Check if the query executed successfully
if (!$result_subject_time) {
    die('Query execution failed: ' . mysqli_error($conn));
}

// Check if any rows were returned
if (mysqli_num_rows($result_subject_time) > 0) {
    // Fetch the first row
    $row_r = mysqli_fetch_assoc($result_subject_time);

    // Check if $row_r is not null
    if ($row_r) {
        // Access data from the row
        $qr_code = $row_r['qr_code'];
        $subject_time = $row_r['subject_time'];
        $time = $row_r['time'];

        // Output or process retrieved data
        echo $qr_code;
    } else {
        echo "Data not available.";
    }
} else {
    echo "No results found for today's date.";
}

// Free the result set
mysqli_free_result($result_subject_time);

// Close the database connection
mysqli_close($conn);
?>
