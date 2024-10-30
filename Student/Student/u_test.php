<?php
// include './header.php';
include '../config.php';

session_start();

if (isset($_SESSION['user_id'])) {
    $s_id = $_SESSION['user_id'];

    // Updated query to use prepared statement to prevent SQL injection
    $s_update_query = "SELECT * FROM student WHERE user_id = ?";
    $stmt = mysqli_prepare($conn, $s_update_query);
    mysqli_stmt_bind_param($stmt, "s", $s_id);
    mysqli_stmt_execute($stmt);
    $s_update_result = mysqli_stmt_get_result($stmt);

    if (!$s_update_result) {
        die('Query failed: ' . mysqli_error($conn));
    }

    while ($row = mysqli_fetch_assoc($s_update_result)) {
        $profile_img = $row['profile_img'];

        if ($profile_img != 'NULL') {
            echo '<img src="' . $profile_img . '" alt="" />';
        } else {
            echo '<img src="vendors/images/photo1.jpg" alt="" />';
        }
    }
}
?>
