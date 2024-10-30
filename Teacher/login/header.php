<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['f_name'])) {
    $f_name = $_SESSION['f_name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <!-- Your additional head content goes here -->
</head>
<body>

<h2>Welcome, <?php echo $f_name; ?>!</h2>
<p>This is your dashboard.</p>
<!-- Your page content goes here -->

</body>
</html>

<?php
} else {
    // Redirect to login.php if not logged in
    header("Location: login.php");
    exit();
}
?>
