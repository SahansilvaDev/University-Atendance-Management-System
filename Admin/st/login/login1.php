<?php
session_start();

include("./config.php");

if (isset($_POST['name'], $_POST['password'])) {
    $name = $conn->real_escape_string($_POST['name']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM students WHERE f_name=?");
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row['password'])) {
            $_SESSION['teacher_id'] = $row['teacher_id'];
            $_SESSION['f_name'] = $row['f_name'];

            header("Location: ../index.php");
            exit();
        }
    }

    header("Location: ./login.php?error=1");
    exit();
}

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
                    <div class="card shadow p-3 mb-5 bg-white rounded">
                        <div class="card-body">
                            <div class="login-container">
                                <h2 class="py-3 text-center">Login</h2>
                                <?php
                                if (isset($_GET['error']) && $_GET['error'] == 1) {
                                    echo '<p style="color: red;">Invalid username or password.</p>';
                                }
                                ?>

                                <form action="" method="post">
                                    <!-- <div class="form-group">
                                    <label for="username">Username:</label>
                                    <input class="form-control" type="text" id="username" name="name" required placeholder="Username">
                                </div> -->
                                <!-- <label for="username" class="py-2">Username:</label> -->

                                    <div class="input-group ">
                                        
                                        <input class="form-control form-control-lg" type="text" id="username" name="name" required placeholder="Username">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/></svg></span>
                                        </div>
                                    </div>
                                    <br>


                                    <!-- <label for="exampleInputPassword1" class="py-2">Password</label> -->

                                    <div class="input-group">
                                        
                                        <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="***************" required>
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
                                    <button type="submit" class="btn btn-outline-primary btn btn-block ">Google</button>
                                    <a href="./reg1.php" target="_blank" rel="noopener noreferrer" class="float-right mt-2 text-muted ">Register To Create Account</a>
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
