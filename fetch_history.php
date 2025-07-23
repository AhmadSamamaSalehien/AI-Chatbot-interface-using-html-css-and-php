<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "ai_assistant";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    echo json_encode([]);
    exit;
}

$result = $conn->query("SELECT user_query, ai_response, timestamp FROM chat_history ORDER BY timestamp ASC");
$history = [];

while ($row = $result->fetch_assoc()) {
    $history[] = [
        'user_query' => $row['user_query'],
        'ai_response' => $row['ai_response'],
        'timestamp' => date('m/d/Y h:i A', strtotime($row['timestamp']))
    ];
}

echo json_encode($history);
$conn->close();
?>