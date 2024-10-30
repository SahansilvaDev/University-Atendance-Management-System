<?php  

include "../../config.php";

session_start();


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require '../phpemail/PHPMailer/src/Exception.php';

require '../phpemail/PHPMailer/src/PHPMailer.php';

require '../phpemail/PHPMailer/src/SMTP.php';



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
    $internal_or_external = $_POST['internal_or_external'];
    $user_role = 2;

    $message = test_input($_POST['message']);

    $message1 = "This is Your Token. Please Use This Token to Login Our System.<br>";
    $message1 .= "<span style='font-family: Arial, sans-serif; font-size: 16px; color: #333; padding: 10px; border: 1px solid #ccc; border-radius: 5px; background-color: #f9f9f9; margin-bottom: 10px;'>Token = $message</span>";
     


    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host ='smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'chathu19990702@gmail.com';
    $mail->Password = 'umfh hrfd njhw xdkt';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('chathu19990702@gmail.com');
    $mail->addAddress($_POST['email']);
    $mail->Subject = $_POST['subject'];
    $mail->isHTML(true);
    $mail->Body = $_POST['message'];

    $mail->send();

    // Generate user ID
    $user_id = generateUserId();

    $internal_external_str = implode(',', $internal_or_external);

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
        $stmt = $conn->prepare("INSERT INTO users (user_id, name, email, password, role, token) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssis", $user_id, $name, $email, $hashed_password, $user_role, $message);
        $stmt->execute();
        $stmt->close();

        // Insert user into admin table
        $stmt = $conn->prepare("INSERT INTO teacher (user_id, fname, lname, name, email, dob, nic, phone_number, address, password, internal_external, token) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssssssss", $user_id, $fname, $lname, $name, $email, $dob, $nic, $phone_number, $address, $hashed_password, $internal_external_str, $message);
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
    $query = "SELECT COUNT(*) AS user_count FROM users where role = 2";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    $user_count = $row['user_count'];

    // Format user ID with leading zeros
    $formatted_id = sprintf("T%05d", $user_count + 1);

    return $formatted_id;
}
?>




  
<style>
    .popup {
      display: none;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background-color: rgba(0, 0, 0, 0.5);
      color: #fff;
      padding: 20px;
      border-radius: 5px;
    }

    .popup-content {
      text-align: center;
      width: 400px;
      height: 200px;
    }

    /* Add styles for the loading animation */
    .loading-animation {
      position: relative;
      height: 50px;
    }

    .loading-circle {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      width: 20px;
      height: 20px;
      border-radius: 50%;
      background-color: #ff5733; /* Change color as needed */
      animation: moveRight 2s linear infinite; /* Animation */
    }

    /* Keyframe animation */
    @keyframes moveRight {
      0% {
        left: -20px;
        opacity: 0;
      }
      50% {
        opacity: 1;
      }
      100% {
        left: calc(100% + 20px);
        opacity: 0;
      }
    }
  </style>
</head>
<body>
  <div class="popup" id="waitingPopup">
    <div class="popup-content">
      <div class="loading-animation">
        <!-- Colored circles representing the loading animation -->
        <div class="loading-circle" style="animation-delay: 0s;"></div>
        <div class="loading-circle" style="animation-delay: 0.2s;"></div>
        <div class="loading-circle" style="animation-delay: 0.4s;"></div>
        <div class="loading-circle" style="animation-delay: 0.6s;"></div>
        <div class="loading-circle" style="animation-delay: 0.8s;"></div>
      </div>
      <p>Please wait...</p>
    </div>
  </div>
  
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      // Show the popup
      document.getElementById("waitingPopup").style.display = "block";

      // Hide the popup after 10 seconds
      setTimeout(function() {
        document.getElementById("waitingPopup").style.display = "none";
        // Redirect to index.php after 10 seconds
        window.location.href = '../user_registration.php';
      }, 10000); // 10 seconds
    });
  </script>
