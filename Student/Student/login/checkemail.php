<?php
session_start();
include("./config.php");

if(isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    if (isset($_POST['token'])) {
        $token = $_POST['token'];
        $Token_idinti = $_POST['Token_idinti'];

        // Use prepared statements to prevent SQL injection
        $query = "SELECT user_id, token FROM student WHERE user_id = ? AND token = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $user_id, $token);
        $stmt->execute();
        $stmt->store_result();

        if($stmt->num_rows > 0){
            // If the query returns a row, the login is successful

            // Insert token_idinti into the student table
            $query_insert = "UPDATE student SET Token_idinti = ? WHERE user_id = ?";
            $stmt_insert = $conn->prepare($query_insert);
            $stmt_insert->bind_param("ss", $Token_idinti, $user_id);
            $stmt_insert->execute();
            $stmt_insert->close();

            header("Location: ../index.php");
            exit();
        } else {
            // Redirect with an error message if login fails
            header("Location: login.php?error=1");
            exit();
        }

        // Close statement
        $stmt->close();
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
        <div class="row main-bg-color">
            <div class="col-md-7 main_img"></div>
            <div class="col-md-4  mt-5 ">
                <div class="mt-5  ">
                    <div class="card reg_crd  mt-5">
                        <div class="card-body">
                            <div class="login-container">
                                <h2 class="py-3 text-center register_box1"></h2>
                                <?php
                                if (isset($_GET['error']) && $_GET['error'] == 1) {
                                    echo '<p style="color: red;">Invalid Token. Please contact your assistant.</p>';
                                }
                                ?>
                                <form action="" method="post">
                                    <div class="input-group">
                                        <input class="form-control form-control" type="text" id="username" name="token" required placeholder="Token">
                                        <input class="form-control form-control" type="hidden" value="1"  name="Token_idinti" >
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512">
                                                    <path d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z" />
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-primary btn btn-block mb-1">Login</button>
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
</html>
