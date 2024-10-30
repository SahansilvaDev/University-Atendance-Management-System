<?php include './header.php'; ?>

<?php 

include '../config.php';

if (isset($_SESSION['user_id'])) {
    
	$user_id = $_SESSION['user_id'];
	$name = $_SESSION['name'];



     
?>


<?php

	




}



?>

<!-- HTML content -->
<div class="mobile-menu-overlay"></div>

<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <!-- Page Header -->
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Chat</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="index.html">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Chat
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <!-- Chat List and Chat Detail Sections -->
            <div class="bg-white border-radius-4 box-shadow mb-30">
                <div class="row no-gutters">
                    <div class="col-lg-3 col-md-4 col-sm-12">
                        <!-- Chat List Section -->
                        <div class="chat-list bg-light-gray">
                            <!-- Chat Search Input -->
                            <div class="chat-search">
                                <span class="ti-search"></span>
                                <input type="text" placeholder="Search Contact" />
                            </div>
                            
                            <!-- Chat Notification List -->
                            <div class="notification-list chat-notification-list customscroll">
                                <ul id="chatUserList">
                                    <!-- Chat User List Items -->
                                    <!-- Use PHP to dynamically generate list items -->
                                    <?php
                                    // Loop through chat users (replace static data with dynamic data)
                                    for ($i = 1; $i <= 10; $i++) {
                                    ?>
                                        <li>
                                            <a href="#" class="chatUserLink" data-user-id="<?php echo $i; ?>">
                                                <img src="vendors/images/img.jpg" alt="" />
                                                <h3 class="clearfix">admin</h3>
                                                <p>
                                                    <i class="fa fa-circle text-light-green"></i> online
                                                </p>
                                            </a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-9 col-md-8 col-sm-12">
                        <!-- Chat Detail Section (Initially Empty) -->
                        <div class="chat-detail" id="chatDetailSection">
                            <!-- Chat Profile Header (Dynamic Content) -->
                            <div class="chat-profile-header clearfix">
                                <!-- Profile Photo and Name (To be Updated Dynamically) -->
                                <div class="left">
                                    <div class="clearfix">
                                        <div class="chat-profile-photo">
                                            <img src="" alt="" id="chatProfilePhoto" />
                                        </div>
                                        <div class="chat-profile-name">
                                            <h3 id="chatProfileName"></h3>
                                            <span id="chatProfileLocation"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Chat Messages (To be Updated Dynamically) -->
                            <div class="chat-box customscroll" id="chatMessageSection" style="max-height: 400px; overflow-y: auto;">
                                <!-- Chat messages will be dynamically populated here -->
                            </div>

                            <!-- Chat Input Area -->
                            <div class="chat-footer">
                                <!-- Chat Text Area -->
                                <div class="chat_text_area">
                                    <textarea placeholder="Type your message…" id="chatMessageInput"></textarea>
                                </div>

                                <!-- Send Button -->
                                <div class="chat_send">
                                    <button class="btn btn-link" type="submit" id="sendMessageButton">
                                        <i class="icon-copy ion-paper-airplane"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript to Handle Click Events and Update Chat Detail Section -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const chatUserLinks = document.querySelectorAll('.chatUserLink');
        const chatMessageSection = document.getElementById('chatMessageSection');

        chatUserLinks.forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault();
                const userId = this.getAttribute('data-user-id');
                updateChatDetail(userId);
            });
        });

        function updateChatDetail(userId) {
            const userDetails = {
                name: 'admin',
                profilePhoto: 'vendors/images/img.jpg',
                // location: 'New York, USA',
                messages: [
                    {
                        sender: 'admin',
                        message: 'Hello admin!',
                        time: '09:40PM'
                    },
                    {
                        sender: 'user',
                        message: 'Hi there!',
                        time: '09:42PM'
                    }
                ]
            };

            document.getElementById('chatProfilePhoto').src = userDetails.profilePhoto;
            document.getElementById('chatProfileName').textContent = userDetails.name;
            document.getElementById('chatProfileLocation').textContent = userDetails.location;

            chatMessageSection.innerHTML = ''; // Clear existing chat messages
            userDetails.messages.forEach(message => {
                const messageHtml = `
                    <li class="clearfix ${message.sender === 'admin' ? 'admin_chat' : ''}">
                        <span class="chat-img">
                            <img src="vendors/images/chat-img${message.sender === 'admin' ? '2' : '1'}.jpg" alt="" />
                        </span>
                        <div class="chat-body clearfix">
                            <p>${message.message}</p>
                            <div class="chat_time">${message.time}</div>
                        </div>
                    </li>
                `;
                chatMessageSection.insertAdjacentHTML('beforeend', messageHtml);
            });

            // Scroll to the bottom of chat messages
            chatMessageSection.scrollTop = chatMessageSection.scrollHeight;
        }
    });

    // Additional JavaScript for sending and receiving real-time messages via WebSocket
    document.addEventListener('DOMContentLoaded', function() {
        const chatUserLinks = document.querySelectorAll('.chatUserLink');
        const chatMessageInput = document.getElementById('chatMessageInput');
        const chatMessageSection = document.getElementById('chatMessageSection');
        let currentUserId = null;

        chatUserLinks.forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault();
                const userId = this.getAttribute('data-user-id');
                currentUserId = userId; // Set current user ID
                updateChatDetail(userId);
            });
        });

        // WebSocket connection
        const socket = new WebSocket('ws://your-server-url'); // Replace with your WebSocket server URL

        socket.onmessage = function(event) {
            const message = JSON.parse(event.data);
            if (message.sender === currentUserId || message.receiver === currentUserId) {
                appendMessageToChat(message);
            }
        };

        function appendMessageToChat(message) {
            const messageHtml = `
                <li class="clearfix ${message.sender === currentUserId ? 'admin_chat' : ''}">
                    <span class="chat-img">
                        <img src="${message.sender === currentUserId ? 'vendors/images/chat-img2.jpg' : 'vendors/images/chat-img1.jpg'}" alt="" />
                    </span>
                    <div class="chat-body clearfix">
                        <p>${message.text}</p>
                        <div class="chat_time">${message.time}</div>
                    </div>
                </li>
            `;
            chatMessageSection.insertAdjacentHTML('beforeend', messageHtml);
            chatMessageSection.scrollTop = chatMessageSection.scrollHeight; // Scroll to the bottom
        }

        // Handle message sending
        document.getElementById('sendMessageButton').addEventListener('click', function(event) {
            event.preventDefault();
            const messageText = chatMessageInput.value.trim();
            if (messageText) {
                const message = {
                    sender: currentUserId,
                    receiver: 'other-user-id', // Replace with actual receiver user ID
                    text: messageText,
                    time: new Date().toLocaleTimeString() // Add timestamp
                };
                socket.send(JSON.stringify(message)); // Send message to WebSocket server
                appendMessageToChat(message); // Display sent message immediately
                chatMessageInput.value = ''; // Clear input field after sending message
            }
        });
    });
</script>

<?php include './footer.php'; ?>
