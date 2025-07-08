<?php
session_start();

header('Content-Type: application/json');

// Ensure the user is logged in to use the chat
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Not authenticated']);
    exit;
}

$logFile = __DIR__ . '/../tmp/chat_log.json';

// Make sure the log file exists and is an empty array if not
if (!file_exists($logFile)) {
    file_put_contents($logFile, json_encode([]));
}

$action = $_POST['action'] ?? $_GET['action'] ?? '';

if ($action === 'send' && isset($_POST['message'])) {
    $message = trim($_POST['message']);
    if (empty($message)) {
        echo json_encode(['status' => 'error', 'message' => 'Message cannot be empty']);
        exit;
    }

    $chatLog = json_decode(file_get_contents($logFile), true);

    $newMessage = [
        'timestamp' => time(),
        'user_id' => $_SESSION['user_id'],
        'username' => $_SESSION['username'],
        'is_admin' => (strtolower($_SESSION['username']) === 'admin'),
        'message' => htmlspecialchars($message, ENT_QUOTES, 'UTF-8')
    ];

    $chatLog[] = $newMessage;

    // Keep the log from getting too big, store last 100 messages
    if (count($chatLog) > 100) {
        $chatLog = array_slice($chatLog, -100);
    }

    file_put_contents($logFile, json_encode($chatLog, JSON_PRETTY_PRINT));

    echo json_encode(['status' => 'success']);
    exit;
}

if ($action === 'get') {
    $lastTimestamp = isset($_GET['since']) ? (int)$_GET['since'] : 0;

    $chatLog = json_decode(file_get_contents($logFile), true);
    
    $newMessages = [];
    foreach ($chatLog as $message) {
        if ($message['timestamp'] > $lastTimestamp) {
            $newMessages[] = $message;
        }
    }

    echo json_encode([
        'status' => 'success',
        'messages' => $newMessages
    ]);
    exit;
}

echo json_encode(['status' => 'error', 'message' => 'Invalid action']); 