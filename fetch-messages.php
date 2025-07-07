<?php
include 'db_connection.php';

$sql = "SELECT * FROM chat_messages ORDER BY created_at ASC";
$result = $conn->query($sql);

$messages = [];
while ($row = $result->fetch_assoc()) {
    $messages[] = $row;
}

echo json_encode($messages);
$conn->close();
?>
