<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['f_name'])) {
    $f_name = $_SESSION['f_name'];
?>

<!DOCTYPE HTML>  
<html>
<head>
    <title>Header</title>
</head>
<body>  

    <h2>Welcome, <?php echo $f_name; ?>!</h2>
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
