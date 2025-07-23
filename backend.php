<?php

    header('Content-Type: text/plain');

    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "ai_assistant";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error)
    
        {

            echo "Database connection failed: " . $conn->connect_error;
            exit;

        }

    ini_set('display_errors', 0);
    ini_set('log_errors', 1);
    ini_set('error_log', 'error_log.txt');

    if (!isset($_POST['query']))
    
        {

            echo "No query received.";
            $conn->close();
            exit;

        }

    $query = htmlspecialchars(trim($_POST['query']));

    if (empty($query))
    
        {

            echo "Please enter a query.";
            $conn->close();
            exit;
    
        }

    $apiKey = 'AIzaSyBIhtVr-Eog3GyeWt1bjOGZagxe8abBzNY';
    $apiUrl = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=' . $apiKey;

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $apiUrl);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
        'contents' => [
            [
                'parts' => [
                    ['text' => "You are a helpful AI assistant. Answer the following query: $query"]
                ]
            ]
        ]
    ]));

    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json'
    ]);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlError = curl_error($ch);

    if ($response === false || $httpCode !== 200)
    
        {

            $errorMsg = "Gemini API Error: HTTP $httpCode - " . ($curlError ?: 'No response from API.') . " Response: " . $response;
            error_log($errorMsg);

            $aiResponse = "Error: Unable to connect to Gemini API.";

            if ($response)
            
                {

                    $errorData = json_decode($response, true);

                    if (isset($errorData['error']['message']))
                    
                        {

                            $aiResponse = "Error: " . $errorData['error']['message'];

                            if ($httpCode === 401)
                            
                                {

                                    $aiResponse .= " Please verify your Gemini API key at https://aistudio.google.com.";
                            
                                }
                                
                            elseif ($httpCode === 429)
                            
                                {

                                    $aiResponse .= " API rate limit exceeded. Please try again later.";
                            
                                }
                    
                        }
            
                }

            $fallbackResponses = [
                'hello' => 'Hi! How can I help you today?',
                'how are you' => 'I’m doing great, thanks! How about you?',
                'time' => 'Tell me your timezone for the current time!',
                'weather' => 'Share your location for a weather update!',
                'what is your name' => 'I’m your AI Assistant!',
                'capital of pakistan' => 'The capital of Pakistan is Islamabad.',
                'what is 2 + 2' => '2 + 2 equals 4.'
            ];

            $queryLower = strtolower($query);

            foreach ($fallbackResponses as $key => $value)
            
                {

                    if (strpos($queryLower, $key) !== false)
                    
                        {

                            $aiResponse = $value;
                            break;
                    
                        }
            
                }

            echo $aiResponse;

        }
        
    else
    
        {
            
            $data = json_decode($response, true);
            $aiResponse = $data['candidates'][0]['content']['parts'][0]['text'] ?? 'No response from AI.';
            echo trim($aiResponse);

        }

    $stmt = $conn->prepare("INSERT INTO chat_history (user_query, ai_response) VALUES (?, ?)");
    $stmt->bind_param("ss", $query, $aiResponse);
    $stmt->execute();
    $stmt->close();

    curl_close($ch);
    $conn->close();

?>