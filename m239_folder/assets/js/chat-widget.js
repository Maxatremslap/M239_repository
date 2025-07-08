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