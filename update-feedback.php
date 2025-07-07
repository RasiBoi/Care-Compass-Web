<?php
include 'db_connection.php';

$id = $_POST['id'];
$content = $_POST['content'];
$author = $_POST['author'];

$stmt = $conn->prepare("UPDATE feedback SET content=?, author=? WHERE id=?");
$stmt->bind_param("ssi", $content, $author, $id);

if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "Feedback updated successfully"]);
} else {
    echo json_encode(["status" => "error", "message" => "Error updating feedback"]);
}

$stmt->close();
$conn->close();
?>
