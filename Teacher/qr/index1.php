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

    // Get the selected expiration time from the JavaScript code
    $expirationTime = $_POST['expiration_time'];

    $not_expired = 1;
    $expired = 0;

    // Check if the code is expired
    if (isset($_POST['expired']) && $_POST['expired'] == 1) {
        $not_expired = 0;
        $expired = 1;
        echo "expired";
    } else {
        echo "not expired";
    }

    $stmt = $conn->prepare("INSERT INTO qr_codes (code, not_expired, expired, expiration_time) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("siid", $code, $not_expired, $expired, $expirationTime);

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
        .main {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            align-items: center;
            justify-content: center;
            /* height: 100vh; */
            margin: 0;
        }

        .container {
            text-align: center;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            width: 100%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        button {
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }

        #qrcode{
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>

<body>



    <div class="main">



        <div class="container">
            <h4 class="h4 pb-10 ">Time Line</h4>

            <div class="row ">

                <div class="col-md-6 mb-30 mb-md-0 ">
                    <input id="range_03" name="time_line" /><br>
                </div>

            </div>

            <h2>Generate QR Code</h2>
            <div id="qrcode"></div>
            <button id="generateBtn">Generate QR Code</button>
        </div>


    </div>


    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>

    <script>
    $(document).ready(function () {
        const generateBtn = $('#generateBtn');
        const qrcodeContainer = $('#qrcode');

        $("#range_03").ionRangeSlider({
            type: "double",
            grid: true,
            from: 1,
            to: 5,
            skin: "modern",
            values: [0, 3, 6, 10, 15, 18]
        });

        generateBtn.on('click', function () {
            // Get the selected expiration time from the range slider
            const expirationTime = $("#range_03").val();

            // Get the current timestamp
            const timestamp = Math.floor(Date.now() / 1000);

            // Generate a random code based on the timestamp
            const randomCode = Math.floor(100000 + timestamp % 900000);

            // Display the QR code
            const qrcode = new QRCode(qrcodeContainer[0], {
                text: randomCode.toString(),
                width: 150,
                height: 150
            });

            // Send the code and expiration time to the server
            $.ajax({
                type: 'POST',
                url: 'save_qr_code.php',
                data: {
                    code: randomCode,
                    expiration_time: expirationTime
                },
                success: function (response) {
                    console.log(response);
                },
                error: function (error) {
                    console.error(error);
                }
            });

            // Schedule a timeout to update the database after expiration time
            setTimeout(function () {
                // Update the database to mark the code as expired
                $.ajax({
                    type: 'POST',
                    url: 'index.php',
                    data: {
                        code: randomCode
                    },
                    success: function (response) {
                        console.log(response);
                    },
                    error: function (error) {
                        console.error(error);
                    }
                });
            }, expirationTime * 60 * 1000); // Convert expiration time to milliseconds
        });
    });
</script>








    <!-- js -->

<script src="./range-slider-setting.js"></script>

    <script src="../src/plugins/ion-rangeslider/js/ion.rangeSlider.min.js"></script>
    <script src="../vendors/scripts/range-slider-setting.js"></script>

</body>

</html>