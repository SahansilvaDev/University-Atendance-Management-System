<?php
session_start();

include './config.php';


$nameErr = $emailErr = $passwordErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = test_input($_POST['name']);
    $email = test_input($_POST['email']);
    $password = test_input($_POST['password']);


    if (empty($name)) {
        $nameErr = "Name is required";
    } else {
       
        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            $nameErr = "Only letters and white space allowed";
        }
    }

   
    if (empty($email)) {
        $emailErr = "Email is required";
    } else {
    
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }


    if (empty($password)) {
        $passwordErr = "Password is required";
    } else {
        // Add any password validation checks here if needed
    }

    // If there are no errors, proceed with database insertion
    if (empty($nameErr) && empty($emailErr) && empty($passwordErr)) {
        // Use password_hash() to hash the password with BCRYPT
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Use prepared statement to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO students (f_name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $hashed_password);
        $stmt->execute();
        $stmt->close();

        // Redirect to a success page or perform other actions
        header("Location: login.php");
        exit();
    }
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!DOCTYPE HTML>  
<html>
<head>
    <style>
        .error {color: #FF0000;}
    </style>
</head>
<body>  

    <h2>Registration Form</h2>
    <p><span class="error">* Required fields</span></p>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
        Name: <input type="text" name="name" >
        <span class="error">* <?php echo $nameErr;?></span>
        <br><br>
        E-mail: <input type="text" name="email" >
        <span class="error">* <?php echo $emailErr;?></span>
        <br><br>
        Password: <input type="password" name="password">
        <span class="error">* <?php echo $passwordErr;?></span>
        <br><br>
        <input type="submit" name="submit" value="Submit">  
    </form>

</body>
</html>
