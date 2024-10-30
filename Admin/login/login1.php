<link
        rel="apple-touch-icon"
        sizes="180x180"
        href="./Student/vendors/images/apple-touch-icon.png"
    />
    <link
        rel="icon"
        type="image/png"
        sizes="32x32"
        href="./Student/vendors/images/favicon-32x32.png"
    />
    <link
        rel="icon"
        type="image/png"
        sizes="16x16"
        href="./Student/vendors/images/favicon-16x16.png"
    />


<?php
session_start();
include("./config.php");

if (isset($_POST['email'], $_POST['password'])) {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);

    // Query to check login credentials
    $sql = "SELECT * FROM student WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verify password using password_verify
        if (password_verify($password, $row['password'])) {
            // Login successful
            $_SESSION['email'] = $row['email'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['user_id'] = $row['user_id'];

            header("Location:../../Student/index.php");
            exit();
            // include '../../Student/index.php';
        } else {
            // Login failed
            echo "Invalid email or password";
        }
    } else {
        // Login failed
        echo "Invalid email or password1";
    }
}

// Close connection
$conn->close();
?>






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

</head>

<body>

    <div class="main">

        <div class="row nav mt-1">
            <div class="col-sm-8 ">

            </div>
            <div class="col-sm-4">
                <h3 class=" registration-heading">Registration</h3>
            </div>
        </div>




        <div class="row main-bg-color">
            <div class="col-md-7 main_img"></div>
            <div class="col-md-4">
                <div class="mt-5  ">
                    <div class="card reg_crd">
                        <div class="card-body">
                            
                            <div class="login-container">
                                <h2 class="py-3 text-center register_box1">

                                </h2>
                                <?php
                                if (isset($_GET['error']) && $_GET['error'] == 1) {
                                    echo '<p style="color: red;">Invalid username or password.</p>';
                                }
                                ?>

                                <form action="" method="post">
                             

                                <div class="input-group">
                                    <input class="form-control form-control" type="text" id="username" name="email" required placeholder="E m a i l">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"/></svg></span>
                                    </div>
                                </div>
                                    <br>


                                    <!-- <label for="exampleInputPassword1" class="py-2">Password</label> -->

                                    <div class="input-group">
                                        
                                        <input type="password" class="form-control form-control" id="password" name="password" placeholder="***************" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path d="M144 144v48H304V144c0-44.2-35.8-80-80-80s-80 35.8-80 80zM80 192V144C80 64.5 144.5 0 224 0s144 64.5 144 144v48h16c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V256c0-35.3 28.7-64 64-64H80z"/></svg></span>
                                        </div>
                                    </div>

                                    <div class="form-group form-check pt-3 pb-3">

                                    <input type="checkbox" class="form-check-input  " id="exampleCheck1" style="width: 20px; height: 20px;">

                                        <div class="row me-1">
                                            <div class="col-sm-5 " style="margin-left:8px;"><label class="form-check-label" for="exampleCheck1">Check me out</label></div>

                                            <div class="col-sm-6 float-right" ><a href="#"><label class="form-check-labe2 " for="exampleCheck1">Forget password</label></a></div>
                                        </div>


                                    </div>


                                    <button type="submit" class="btn btn-primary btn btn-block mb-1">Sign In</button>
                                    <h5 class="text-center py-2">OR</h5>
                                    <button type="submit" class="btn btn-outline-primary btn btn-block g_btn mb-3"> <img src="./google.png" class="px-2">  Continue With Google </button>
                                   <p class="text-muted"> Don’t have an account?   <a href="./reg1.php" target="_blank" rel="noopener noreferrer " class="text-center pt-3 mt-2  " >sign Up</a> </p>
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
