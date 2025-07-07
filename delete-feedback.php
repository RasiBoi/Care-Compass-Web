<?php
include 'db_connection.php';

$id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM feedback WHERE id=?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "Feedback deleted successfully"]);
} else {
    echo json_encode(["status" => "error", "message" => "Error deleting feedback"]);
}

$stmt->close();
$conn->close();
?>
