<link rel="stylesheet" href="../assets/css/fontawesome.css">
<link rel="stylesheet" href="../assets/css/style.css">
<link rel="stylesheet" href="../assets/css/owl.css">

<style>
    .chat-widget-button {
        position: fixed;
        bottom: 25px;
        right: 25px;
        width: 60px;
        height: 60px;
        background-color: #007bff;
        border-radius: 50%;
        color: white;
        border: none;
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        z-index: 1000;
    }
    .chat-widget-button svg {
        width: 32px;
        height: 32px;
    }
    .chat-widget-window {
        display: none;
        position: fixed;
        bottom: 100px;
        right: 25px;
        width: 350px;
        height: 450px;
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        flex-direction: column;
        z-index: 1000;
        border: 1px solid #eee;
    }
    .chat-widget-header {
        background-color: #007bff;
        color: white;
        padding: 15px;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        font-weight: bold;
    }
    .chat-widget-messages {
        flex-grow: 1;
        padding: 15px;
        overflow-y: auto;
        background-color: #f9f9f9;
        display: flex;
        flex-direction: column;
    }
    .chat-widget-input {
        display: flex;
        border-top: 1px solid #eee;
    }
    .chat-widget-input input {
        flex-grow: 1;
        border: none;
        padding: 15px;
        outline: none;
    }
    .chat-widget-input button {
        border: none;
        background-color: #007bff;
        color: white;
        padding: 0 20px;
        cursor: pointer;
    }
    .chat-message {
        max-width: 80%;
        padding: 8px 12px;
        border-radius: 18px;
        margin-bottom: 8px;
        word-wrap: break-word;
    }
    .chat-message.user {
        background-color: #007bff;
        color: white;
        align-self: flex-end;
    }
    .chat-message.admin {
        background-color: #e9e9eb;
        color: #333;
        align-self: flex-start;
    }
    .chat-message strong {
        font-weight: bold;
        display: block;
        margin-bottom: 2px;
        font-size: 0.8em;
    }
</style>

</head>

<body>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="inner-content">
                        <p>Copyright © 2025 Max's Möbel</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>


    <?php if(isset($_SESSION['username'])): ?>
    <!-- Chat Widget Button -->
    <button class="chat-widget-button" id="chat-toggle-button">
        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-chat-dots-fill" viewBox="0 0 16 16">
            <path d="M16 8c0 3.866-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.584.296-1.925.864-4.181 1.234-.2.032-.352-.176-.273-.362.354-.836.674-1.95.77-2.966C.744 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7zM5 8a1 1 0 1 0-2 0 1 1 0 0 0 2 0zm4 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
        </svg>
    </button>

    <!-- Chat Widget Window -->
    <div class="chat-widget-window" id="chat-widget">
        <div class="chat-widget-header">Live Chat Support</div>
        <div class="chat-widget-messages" id="chat-messages">
            <!-- Messages will be loaded here -->
        </div>
        <div class="chat-widget-input">
            <input type="text" id="chat-input" placeholder="Type your message...">
            <button id="chat-send-button">Send</button>
        </div>
    </div>
    <?php endif; ?>


    <!-- Bootstrap core JavaScript -->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../assets/js/custom.js"></script>
    <script src="../assets/js/owl.js"></script>

    <?php if(isset($_SESSION['username'])): ?>
    <script>
        $(document).ready(function() {
            const chatWidget = $('#chat-widget');
            const chatToggleButton = $('#chat-toggle-button');
            const chatMessages = $('#chat-messages');
            const chatInput = $('#chat-input');
            const chatSendButton = $('#chat-send-button');

            let lastMessageId = 0;
            let pollingInterval;

            function fetchMessages() {
                $.ajax({
                    url: '../controller/chat_handler.php',
                    type: 'GET',
                    data: { action: 'fetch', last_id: lastMessageId },
                    dataType: 'json',
                    success: function(messages) {
                        if (messages.length > 0) {
                            messages.forEach(function(msg) {
                                const messageClass = msg.sender.toLowerCase() === 'admin' ? 'admin' : 'user';
                                const messageElement = $(
                                    '<div class="chat-message ' + messageClass + '">' +
                                        '<strong>' + $('<div />').text(msg.sender).html() + '</strong>' +
                                        $('<div />').text(msg.message).html() +
                                    '</div>'
                                );
                                chatMessages.append(messageElement);
                                lastMessageId = msg.id;
                            });
                            // Scroll to the bottom
                            chatMessages.scrollTop(chatMessages[0].scrollHeight);
                        }
                    },
                    error: function() {
                        console.error('Failed to fetch chat messages.');
                    }
                });
            }

            function sendMessage() {
                const message = chatInput.val().trim();
                if (message === '') {
                    return;
                }

                $.ajax({
                    url: '../controller/chat_handler.php',
                    type: 'POST',
                    data: { action: 'send', message: message },
                    success: function() {
                        chatInput.val('');
                        fetchMessages(); // Fetch immediately after sending
                    },
                    error: function() {
                        console.error('Failed to send message.');
                    }
                });
            }

            chatToggleButton.on('click', function() {
                const isVisible = chatWidget.is(':visible');
                chatWidget.css('display', isVisible ? 'none' : 'flex');
                
                if (!isVisible) {
                    lastMessageId = 0; // Reset on open to get full history
                    chatMessages.html(''); // Clear previous messages
                    fetchMessages();
                    pollingInterval = setInterval(fetchMessages, 3000); // Poll every 3 seconds
                } else {
                    clearInterval(pollingInterval);
                }
            });

            chatSendButton.on('click', sendMessage);

            chatInput.on('keypress', function(e) {
                if (e.which === 13) { // Enter key
                    sendMessage();
                }
            });
        });
    </script>
    <?php endif; ?>

</body>
</html> 