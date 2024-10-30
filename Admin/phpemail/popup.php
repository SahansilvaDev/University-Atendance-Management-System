<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Waiting Popup</title>
  
  <style>
    /* CSS styles for the popup and loading animation */
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

    /* Styles for the loading animation */
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
  <!-- Popup with loading animation -->
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
        window.location.href = 'index.php';
      }, 10000); // 10 seconds
    });
  </script>
</body>
</html>
