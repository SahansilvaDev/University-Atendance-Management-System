<?php
session_start();

$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'attended_system';

$conn = new mysqli($hostname, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Validate and sanitize user input
if (isset($_POST['name'], $_POST['password'])) {
    $name = $conn->real_escape_string($_POST['name']);
    $password = $_POST['password']; 

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM staff WHERE s_name=?");
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verify the password using password_verify
        if (password_verify($password, $row['password'])) {
            // Set session variables with user data
            $_SESSION['st_id'] = $row['st_id'];
            $_SESSION['s_name'] = $row['s_name'];
            
            // Redirect to header.php or any other page after successful login
            header("Location: ../index.php");
            exit();
        }
    }

    // Redirect with an error parameter
    header("Location: ./login.php?error=1");
    exit();

    $stmt->close();
}



$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Login Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            width: 300px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h2>Login</h2>
    <?php
    // Display an error message if redirected with an error parameter
    if (isset($_GET['error']) && $_GET['error'] == 1) {
        echo '<p style="color: red;">Invalid username or password.</p>';
    }
    ?>
    <form action="" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="name" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Login</button>
    </form>
</div>

</body>
</html>
