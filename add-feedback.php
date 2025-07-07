<?php
include 'db_connection.php';

$content = $_POST['content'];
$author = $_POST['author'];

$stmt = $conn->prepare("INSERT INTO feedback (content, author) VALUES (?, ?)");
$stmt->bind_param("ss", $content, $author);

if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "Feedback added successfully"]);
} else {
    echo json_encode(["status" => "error", "message" => "Error adding feedback"]);
}

$stmt->close();
$conn->close();
?>
