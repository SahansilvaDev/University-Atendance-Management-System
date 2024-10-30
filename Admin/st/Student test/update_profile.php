<?php

include './login/config.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $reg_no = $_POST["reg_no"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $province = $_POST["province"];

  
    if ($_FILES["profile_image"]["name"]) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["profile_image"]["name"]);
        move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file);
        $profile_image = $target_file;
    } else {
   
        $profile_image = "default_profile.jpg";
    }


    $sql = "UPDATE student SET name='$name', email='$email', profile_image='$profile_image', address='$address', province='$province' WHERE reg_no='$reg_no'";

    if ($conn->query($sql) === TRUE) {
        echo "Profile updated successfully";
    } else {
        echo "Error updating profile: " . $conn->error;
    }


    $conn->close();
}
?>


<?php  include'./header.php';?>


  


<main class="ps-3">
    <form action="update_profile.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="reg_no" class="form-label">Registration Number:</label>
            <input type="text" class="form-control" id="reg_no" name="reg_no" required>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="profile_image" class="form-label">Profile Image:</label>
            <input type="file" class="form-control" id="profile_image" name="profile_image" onchange="previewImage(this)">
            <div class="image-preview" id="image-preview"></div>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address:</label>
            <input type="text" class="form-control" id="address" name="address">
        </div>
        <div class="mb-3">
            <label for="province" class="form-label">Province:</label>
            <input type="text" class="form-control" id="province" name="province">
        </div>
        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
</main>




<?php include './footer.php'; ?>
