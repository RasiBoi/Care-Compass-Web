<?php
include 'db_connection.php'; // Ensure this file contains $conn

header('Content-Type: application/json');

// Check if POST data exists
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message_id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $reply_text = isset($_POST['reply']) ? trim($_POST['reply']) : '';

    // Validate inputs
    if ($message_id == 0 || empty($reply_text)) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid message ID or empty reply.']);
        exit;
    }

    // Update the messages table with the reply
    $sql = "UPDATE messages SET reply = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $reply_text, $message_id);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Reply saved successfully!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Database update failed!']);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>
