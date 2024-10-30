<?php  
include '../../config.php';

$sql = "SELECT * FROM create_qr_attendance";
$date = date('d F Y');

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Loop through each row of the result
    while($row = $result->fetch_assoc()) {
        // Retrieve qr_date from the current row
        $qr_date = $row['qr_date'];
        
        // Check if current date matches qr_date
        if($date == $qr_date) {
            // If they match, echo both dates
            echo "Current Date: " . $date . "<br>";
            echo "QR Date: " . $qr_date . "<br>";
        }
    }
} else {
    echo "No QR attendance records found.";
}
?>
