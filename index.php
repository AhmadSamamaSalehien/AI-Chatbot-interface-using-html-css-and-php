<?php
// Start the session or perform any PHP initialization if needed
?>

<!DOCTYPE html>

<html lang="en">
    
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>My AI Assistant</title>
    
    <link rel="stylesheet" href="style.css">
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
</head>
    
<body>

    <main>

        <video autoplay muted class="bg-video">

            <source src="6.mp4" type="video/mp4">
    
        </video>

        <div class="right-nav">

            <div class="logo">

                <video autoplay muted loop class="vid">

                    <source src="6.mp4" type="video/mp4">

                </video>

            </div>

            <div class="right-nav-btns">

                <button><i class="fas fa-user-check"></i> Sign In</button>
                <button><i class="fas fa-user-plus"></i> Sign Up</button>

            </div>

        </div>

        <section>

            <div class="chat-container">

                <div class="full-chat">

                    <h2>Hello! Ahmad I'm your AI Assistant. Ask me anything!</h2>

                    <div class="chat-box" id="chatBox">

                    </div>

                    <div class="input-group">

                        <div class="send">

                            <input type="text" class="input-snd form-control" id="userInput" placeholder="Type your message...">
                            <button class="snd-btn btn btn-outline-secondary" onclick="sendMessage()"> Send<i class="fas fa-angle-right"></i></button>

                        </div>

                        <div class="clear-box">
                            
                            <button class="clear-btnn clear-btn" onclick="clearChat()">Clear Chat</button>
                            
                        </div>
                        
                    </div>
                    
                </div>
                
            </div>
            
        </section>
        
    </main>
    
    <script>
        
        $(document).ready(function() {
            $.ajax({
                url: 'fetch_history.php',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    data.forEach(function(chat) {
                        $('#chatBox').append(`<div class="user-message">${chat.user_query}<span class="timestamp">${chat.timestamp}</span></div>`);
                        $('#chatBox').append(`<div class="ai-message">${chat.ai_response}<span class="timestamp">${chat.timestamp}</span></div>`);
                        $('#chatBox').scrollTop($('#chatBox')[0].scrollHeight);
                    });
                }
            });
        });

        function sendMessage() {
            let userInput = $('#userInput').val().trim();
            if (userInput === '') return;

            let timestamp = new Date().toLocaleString('en-US', { hour12: true });
            $('#chatBox').append(`<div class="user-message">${userInput}<span class="timestamp">${timestamp}</span></div>`);
            $('#userInput').val('');
            $('#chatBox').scrollTop($('#chatBox')[0].scrollHeight);

            $('#chatBox').append(`<div class="ai-message loading">Thinking...</div>`);
            $('#chatBox').scrollTop($('#chatBox')[0].scrollHeight);

            $.ajax({
                url: 'backend.php',
                type: 'POST',
                data: { query: userInput },
                success: function(response) {
                    $('.loading').remove();
                    $('#chatBox').append(`<div class="ai-message">${response}<span class="timestamp">${timestamp}</span></div>`);
                    $('#chatBox').scrollTop($('#chatBox')[0].scrollHeight);
                },
                error: function() {
                    $('.loading').remove();
                    $('#chatBox').append(`<div class="ai-message">Error: Could not connect to the server.</div>`);
                    $('#chatBox').scrollTop($('#chatBox')[0].scrollHeight);
                }
            });
        }

        function clearChat() {
            $('#chatBox').empty();
            $('#chatBox').append(`<div class="ai-message">Hello! I'm your AI Assistant. Ask me anything!</div>`);
        }

        $('#userInput').keypress(function(e) {
            if (e.which == 13) {
                sendMessage();
            }
        });
    </script>
</body>
</html>
