document.addEventListener("DOMContentLoaded", function() {
    const scanBtn = document.getElementById("scanBtn");
    const messageDiv = document.getElementById("message");

    scanBtn.addEventListener("click", function() {
    
        const fingerprint = getDeviceFingerprint();


        sendFingerprintToServer(fingerprint);
    });

    function getDeviceFingerprint() {
      
        return {
            userAgent: navigator.userAgent,
            resolution: `${window.screen.width}x${window.screen.height}`
          
        };
    }

    function sendFingerprintToServer(fingerprint) {
      
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "authenticate.php", true);
        xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");

        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    handleAuthenticationResponse(response);
                } else {
                    console.error("Error: Unable to send fingerprint to server");
                }
            }
        };

        xhr.send(JSON.stringify(fingerprint));
    }

    function handleAuthenticationResponse(response) {
        if (response.success) {
            messageDiv.innerHTML = "<p style='color: green;'>Fingerprint matched. Access granted.</p>";
          
        } else {
            messageDiv.innerHTML = "<p style='color: red;'>Fingerprint not recognized. Access denied.</p>";
        }
    }
});
