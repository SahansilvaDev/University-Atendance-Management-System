<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require './PHPMailer/src/Exception.php';

require 'PHPMailer/src/PHPMailer.php';

require 'PHPMailer/src/SMTP.php';


if(isset($_POST['send'])){
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
    echo "<script>
        alert('Message sentSuccess');
        document.location.href = 'index.php';
    </script>";
    
}





?>