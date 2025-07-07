<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $message = $_POST['message'];
    $category = $_POST['category'];
    $sender = 'Staff'; // or use the logged-in staff name, if necessary

    $stmt = $conn->prepare("INSERT INTO chat_messages (sender, message, category) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $sender, $message, $category);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to send message"]);
    }
    $stmt->close();
    $conn->close();
}
?>
