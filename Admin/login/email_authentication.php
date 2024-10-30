<?php
session_start();
include("./config.php");

if (isset($_POST['userid'])) {
    $email = $conn->real_escape_string($_POST['userid']); 


   
    $sql = "SELECT * FROM staff WHERE st_id = '$userid' ";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    
        $row = $result->fetch_assoc(); 

        $_SESSION['email'] = $row['email'];
        $_SESSION['s_name'] = $row['s_name'];
        $_SESSION['st_id'] = $row['st_id'];
       
        header("Location:../index.php");
        
        
        exit();
    } else {
       
        echo "Authentication error! please check your email inbox or spam folder";
    }
}

// Close connection
$conn->close();
?>








<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100vh;
            margin: 0;
        }

        .card {
            width: 550px;
        }
    </style>

</head>

<body>

<form action="" method="post">

<div class="row">
<div class="card">
                <div class="card-body">
                    <form>
                        <div class="form-group">
                            <label for="exampleInputEmail1">User ID</label>
                            <input type="text" class="form-control" name="userid" id="exampleInputEmail1" aria-describedby="emailHelp">
                            <small id="emailHelp" class="form-text text-muted">add Your user ID for authentication</small>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg btn-block">submit</button>

                    </form>
                </div>
            </div>
</div>





</form>


    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>


</body>

</html>
