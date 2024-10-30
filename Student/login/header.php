<?php
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'attended_system';

$conn = new mysqli($hostname, $username, $password, $database);

if (!$conn) {
    echo 'error';
}

session_start();

// Check if the user is logged in
if (isset($_SESSION['s_id'])) {
    $f_name = $_SESSION['f_name'];
    $s_id = $_SESSION['s_id'];

    $s_sql = "SELECT f_name FROM students WHERE s_id = 4";

    $result = mysqli_query($conn, $s_sql);
     
    if(!$result){
       echo 'error'; 
    }

    if($row = mysqli_fetch_assoc($result)){
            $f_name = $row['f_name'];

            echo $f_name;
    }
 
    
    ?>
    <!DOCTYPE HTML>  
    <html>
    <head>
        <title>Header</title>
    </head>
    <body>  
        <!-- Additional header content goes here -->
        <a href="./logout.php">Logout</a>
    </body>
    </html>
    <?php
} else {
    // Redirect to login.php if not logged in
    header("Location: login.php");
    exit();
}
?>
