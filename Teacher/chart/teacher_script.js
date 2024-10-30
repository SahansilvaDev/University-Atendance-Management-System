function loadMessages() {
    // Fetch messages from the server (PHP/SQL) using AJAX
    fetch('teacher_get_messages.php')
    .then(response => response.json())
    .then(data => {
        const chatBox = document.getElementById('chat-box');
        chatBox.innerHTML = ''; // Clear previous messages
        data.forEach(message => {
            chatBox.innerHTML += `<div><strong>${message.sender}</strong>: ${message.message}</div>`;
        });
        // Scroll to bottom of chat box
        chatBox.scrollTop = chatBox.scrollHeight;
    })
    .catch(error => console.error('Error fetching messages:', error));
}

function sendMessage() {
    const messageInput = document.getElementById('message-input');
    const message = messageInput.value;
    if (message.trim() === '') {
        alert('Please enter a message.');
        return;
    }

    // Send message to the server (PHP/SQL) using AJAX
    fetch('teacher_send_message.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ message })
    })
    .then(response => response.json())
    .then(data => {
        console.log('Message sent successfully:', data);
        messageInput.value = ''; // Clear message input field
        loadMessages(); // Reload messages to display new message
    })
    .catch(error => console.error('Error sending message:', error));
}

// Load messages when the page loads
document.addEventListener('DOMContentLoaded', function() {
    loadMessages();
    setInterval(loadMessages, 5000); // Refresh messages every 5 seconds
});
