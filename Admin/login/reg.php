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
        $hashed_password = $password;

        // Use prepared statement to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO staff (s_name, email, password) VALUES (?, ?, ?)");
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

        <div class="row nav mt-1">
            <div class="col-sm-8 ">

            </div>
            <div class="col-sm-4">
                <h3 class=" registration-heading">Registration</h3>
            </div>
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
