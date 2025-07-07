<?php
include 'db_connection.php';

$sender = "Admin"; // You can modify this based on logged-in user
$message = $_POST['message'];
$category = $_POST['category'];

if (!empty($message)) {
    $stmt = $conn->prepare("INSERT INTO chat_messages (sender, message, category) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $sender, $message, $category);
    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Message sent"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to send message"]);
    }
    $stmt->close();
} else {
    echo json_encode(["status" => "error", "message" => "Message cannot be empty"]);
}

$conn->close();
?>
