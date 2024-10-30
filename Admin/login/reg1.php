<?php

session_start();

include './config.php';

$nameErr = $emailErr = $passwordErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = test_input($_POST['name']);
    $email = test_input($_POST['email']);
    $password = test_input($_POST['password']);
    $user_role = 1;

    // Generate user ID
    $user_id = generateUserId();

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
    }

    if (empty($nameErr) && empty($emailErr) && empty($passwordErr)) {

        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Insert user into database
        $stmt = $conn->prepare("INSERT INTO users (user_id, name, email, password, role) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssi", $user_id, $name, $email, $hashed_password, $user_role);
        $stmt->execute();
        $stmt->close();

        $stmt = $conn->prepare("INSERT INTO admin (user_id, name, email, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $user_id, $name, $email, $hashed_password);
        $stmt->execute();
        $stmt->close();

        // Send registration confirmation email
        $subject = 'Registration Confirmation';
        $message = "Dear $name,\n\nThank you for registering with us. Your User ID is: $user_id\n\nRegards,\nThe XYZ Team";
        $headers = 'From: chathu19990702@gmail.com';

        // Use the following line to send HTML emails (optional)
        // $headers .= "Content-type: text/html; charset=UTF-8";

        mail($email, $subject, $message, $headers);

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

function generateUserId()
{
    // Retrieve the current user count from the database
    global $conn;
    $query = "SELECT COUNT(*) AS user_count FROM users";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    $user_count = $row['user_count'];

    // Format user ID with leading zeros
    $formatted_id = sprintf("AD%05d", $user_count + 1);

    return $formatted_id;
}
?>






<!-- Your HTML form goes here -->


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Login Form</title>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <style>
        .error {color: #FF0000;}
    </style>
</head>

<body>

    <div class="main">

        <div class="row nav ">
            <div class="col-sm-8 ">

            </div>
            <!-- <div class="col-sm-4">
                <h3 class=" registration-heading">Registration</h3>
            </div> -->
        </div>




        <div class="row main-bg-color">
            <div class="col-md-7 main_img_r"></div>
            <div class="col-md-4 ">
                <div class="mt-5  ">
                    <div class="card  reg_crd  ">
                        <div class="card-body">
                            <div class="login-container">
                                <h2 class="py-3 text-center register_box">

                                </h2>
                             

                            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
                                    <div class="form-group">
                                    <label for="username">Username:<span class="error">* <?php echo $nameErr;?></span></label>
                                    <input class="form-control" type="text" id="username" name="name" required placeholder="Username">
                                    
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email address <span class="error">* <?php echo $emailErr;?></span></label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp">
                                    
                                </div>
                                                                



                                    <!-- <label for="exampleInputPassword1" class="py-2">Password</label> -->

                                    <div class="form-group">
                                    <label for="username">Password: <span class="error">* <?php echo $passwordErr;?></span></label>
                                        <input type="password" class="form-control form-control" id="password" name="password" placeholder="***************" required>
                                        
                                        
                                        
                                    </div>

                                 

    

                                    <button type="submit" name="submit" class="btn btn-primary btn btn-block mb-1">Sign Up</button>
                                    <h5 class="text-center py-2">OR</h5>
                                    <button type="submit" class="btn btn-outline-primary btn btn-block g_btn mb-3"> <img src="./google.png" class="px-2">  Continue With Google </button>
                                   <p class="text-muted"> Already have an account?  <a href="./login1.php" target="_blank" rel="noopener noreferrer " class="text-center pt-3 mt-2  " >sign in</a> </p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>

</body>
