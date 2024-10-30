<?php
date_default_timezone_set('Asia/Colombo');

$countdownDurationSeconds = 1 * 60 * 1000;


$qrCode = 'your_qr_code_here'; 
?>

<div id="time"></div>

<script>
    // Function to update the countdown timer
    function updateTime() {
        
        var currentTime = Math.floor(Date.now() / 1000); 
        var startTime = sessionStorage.getItem('startTime');
        if (!startTime) {
            startTime = currentTime;
            sessionStorage.setItem('startTime', startTime);
        }

        
        var remainingTime = <?php echo $countdownDurationSeconds; ?> - (currentTime - startTime);

       
        var minutes = Math.floor(remainingTime / 60);
        var seconds = remainingTime % 60;

       
        var formattedTime = minutes.toString().padStart(2, '0') + ":" + seconds.toString().padStart(2, '0');

       
        document.getElementById("time").innerHTML = "Remaining Time: " + formattedTime;

        
        if (remainingTime <= 0) {
            clearInterval(interval);
            document.getElementById("time").innerHTML = "Time's up!";
            // Hide the QR code if time is up
            document.getElementById("qrcode").style.display = "none";
            document.getElementById("qrcode1").style.display = "none";

            // Prompt the user to mark attendance
            var confirmed = confirm("Time's up! Mark Your Attendance! Do you want to proceed?");

            if (confirmed) {
                // Redirect to attendance test page with QR code parameter
                var qrCode = '<?php echo $qrCode; ?>';
                window.location.href = './Attendance/test_r.php?qr_code=' + encodeURIComponent(qrCode);
            } else {
                // Display a message if the user chooses not to proceed
                document.getElementById("time").innerHTML = "Hurry UP!";
            }

            // Clear the session storage when the countdown is completed
            sessionStorage.removeItem('startTime');
        }
    }

    // Update the countdown initially
    updateTime();

    // Update the countdown every second using setInterval
    var interval = setInterval(updateTime, 1000);
</script>
