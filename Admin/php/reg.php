<?php  

include "../../config.php";

session_start();

$nameErr = $emailErr = $passwordErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = test_input($_POST['fname']);
    $lname = test_input($_POST['lname']);
    $name = test_input($_POST['uname']);
    $email = test_input($_POST['email']);
    $password = test_input($_POST['password']);
    $dob = test_input($_POST['dob']);
    $nic = test_input($_POST['nic']);
    $phone_number = test_input($_POST['phone_number']);
    $address = test_input($_POST['address']);

    $user_role = 1;

    // Generate user ID
    $user_id = generateUserId();

    if (empty($name)) {
        $nameErr = "Name is required";
    } else {
        if (!preg_match("/^[a-zA-Z-0-9-' ]*$/", $name)) {
            $nameErr = "Only letters, numbers, and white space allowed";
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

        // Insert user into users table
        $stmt = $conn->prepare("INSERT INTO users (user_id, name, email, password, role) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssi", $user_id, $name, $email, $hashed_password, $user_role);
        $stmt->execute();
        $stmt->close();

        // Insert user into admin table
        $stmt = $conn->prepare("INSERT INTO admin (user_id, fname, lname, name, email, dob, nic, phone_number, address, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssssss", $user_id, $fname, $lname, $name, $email, $dob, $nic, $phone_number, $address, $hashed_password);
        $stmt->execute();
        $stmt->close();

        // Send registration confirmation email
        $subject = 'Registration Confirmation';
        $message = "Dear $name,\n\nThank you for registering with us. Your User ID is: $user_id\n\nRegards,\nThe XYZ Team";
        $headers = 'From: chathu19990702@gmail.com';

        mail($email, $subject, $message, $headers);

        // Redirect to login page
        header("Location: ../user_registration.php");
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
    $query = "SELECT COUNT(*) AS user_count FROM users where role = 1";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    $user_count = $row['user_count'];

    // Format user ID with leading zeros
    $formatted_id = sprintf("AD%05d", $user_count + 1);

    return $formatted_id;
}
?>