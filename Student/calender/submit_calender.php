<?php
include '../../config.php';
session_start();

if(isset($_POST['submit'])){
    $ecode=$_POST['ecode'];
    $ename=$_POST['ename'];
    $eurl=$_POST['eurl'];
    $edate=$_POST['edate'];
    $edate1=$_POST['edate1'];
    $ebatch=$_POST['ebatch'];
    $ecolor=$_POST['ecolor'];
    $edesc=$_POST['edesc'];
    $ecolor1=$_POST['ecolor1'];
    $eicon=$_POST['eicon'];

    // Modify the SQL query to include the correct column names



$sql = "INSERT INTO calender(subject_code, subject_select, subject_url, title, start_time, end_time, batch, description, color, color1, eicon) 
VALUES ('$ecode', '$ename', '$eurl', '$ename', '$edate', '$edate1', '$ebatch', '$edesc', '$ecolor', '$ecolor1', '$eicon')";

    $result = mysqli_query($conn, $sql);

    if($result){
        echo "<script>alert('Subject Added Successfully');</script>";
        echo "<script>window.location.href='calender.php';</script>";
    } else {
        echo "Error: ". $sql. "<br>". mysqli_error($conn);
    }
}
?>
