
<?php
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'attended_system';

$conn = new mysqli($hostname, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $code = $_POST['code'];

    $stmt = $conn->prepare("INSERT INTO qr_codes (code) VALUES (?)");
    $stmt->bind_param("s", $code);

    if ($stmt->execute()) {
        echo "QR Code saved successfully!";
    } else {
        echo "Error saving QR Code: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
    exit;
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- Site favicon -->
      <link rel="apple-touch-icon" sizes="180x180" href="../vendors/images/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="../vendors/images/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="../vendors/images/favicon-16x16.png" />

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />

    <!-- CSS -->


    <link rel="stylesheet" type="text/css" href="../src/plugins/ion-rangeslider/css/ion.rangeSlider.css" />


    <title>Attendance System</title>
    <style>
        /* Your existing CSS styles */
        .container {
            text-align: center;
            margin-top: 50px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Generate QR Code</h2>
    <div id="qrcode"></div>
    <button id="generateBtn">Generate QR Code</button>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
<script>
    $(document).ready(function () {
        const generateBtn = $('#generateBtn');
        const qrcodeContainer = $('#qrcode');

        generateBtn.on('click', function () {
            // Get the current timestamp
            const timestamp = Math.floor(Date.now() / 1000);

            // Generate a random code based on the timestamp
            const randomCode = Math.floor(100000 + timestamp % 900000);

            // Display the QR code
            const qrcode = new QRCode(qrcodeContainer[0], {
                text: randomCode.toString(),
                width: 128,
                height: 128
            });

            // Send the code to the server
            $.ajax({
                type: 'POST',
                url: 'save_qr_code.php',
                data: { code: randomCode },
                success: function (response) {
                    console.log(response);
                },
                error: function (error) {
                    console.error(error);
                }
            });
        });
    });
</script>

<h4 class="h4 pb-10">Time Line</h4>
        <div class="row">
            <div class="col-md-6 mb-30 mb-md-0">
                <input id="range_03" name="time_line" />
            </div>

        </div>






        <!-- js -->
      


        <script src="../src/plugins/ion-rangeslider/js/ion.rangeSlider.min.js"></script>
        <script src="../vendors/scripts/range-slider-setting.js"></script>

</body>
</html>
