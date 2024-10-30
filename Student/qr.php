
<?php
session_start();

// ... your form processing logic

// Assuming the form is valid and processed successfully
$_SESSION['formSubmitted'] = true;

// ... other code
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Page Title</title>

    <!-- popup styles -->
    <style>
        /* Styles for the overlay and popup */
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            justify-content: center;
            align-items: center;
            z-index: 1;
        }

        .popup {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            text-align: center;
        }
    </style>
</head>
<body>

<?php
// Check if user details are filled
$userDetailsFilled = false;

// Check your condition to determine if details are filled (e.g., checking if required fields are not empty)
if (!empty($_POST['username']) && !empty($_POST['email'])) {
    $userDetailsFilled = true;
}
?>

<!-- Display overlay and popup if details are not filled and form is not submitted -->
<?php if (!$userDetailsFilled && !$formSubmitted): ?>
    <div class="overlay">
        <div class="popup">
            <p>Please fill in your details in the profile page.</p>
            <br>
            <a href="./profile.php"><button type="button" name="" id="okButton" class="btn btn-primary btn-lg btn-block">OK</button></a>
        </div>
    </div>

    <script>
        // Display the overlay and popup
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelector('.overlay').style.display = 'flex';
        });

        // Disable the popup when clicking the OK button
        document.getElementById('okButton').addEventListener('click', function () {
            // You can add an additional check here before disabling the popup if needed
            document.querySelector('.overlay').style.display = 'none';
        });
    </script>
<?php endif; ?>

</body>
</html>
