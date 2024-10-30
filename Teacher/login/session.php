<?php
session_start();


if (!isset($_SESSION['t_id'])) {
 
    header("Location: login.php");
   
}


$userID = $_SESSION['t_id'];
$username = $_SESSION['f_name'];

echo "User ID: $userID, Username: $username";




// Logout button
echo '<a href="logout.php">Logout</a>';
?>
