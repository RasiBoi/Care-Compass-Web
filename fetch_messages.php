<?php
session_start();
include 'db_connection.php'; // Ensure this file connects to the database

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["error" => "User not logged in"]);
    exit();
}

$patient_id = $_SESSION['user_id']; // Ensure session variable matches patient_id in DB

// Debugging: Log session user_id
file_put_contents("debug_log.txt", "Session user_id: " . $patient_id . PHP_EOL, FILE_APPEND);

$sql = "SELECT subject, message, reply, created_at FROM messages WHERE patient_id = ? ORDER BY created_at DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $patient_id);
$stmt->execute();
$result = $stmt->get_result();

$messages = [];
while ($row = $result->fetch_assoc()) {
    $messages[] = $row;
}

// Debugging: Log the number of messages found
file_put_contents("debug_log.txt", "Messages found: " . count($messages) . PHP_EOL, FILE_APPEND);

$stmt->close();
$conn->close();

echo json_encode($messages); // Send JSON response to AJAX
?>
