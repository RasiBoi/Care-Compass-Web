<?php
include 'db_connection.php';

$id = $_POST['id'];
$name = $_POST['name'];
$description = $_POST['description'];
$price = $_POST['price'];
$image = $_POST['image'];

$sql = "UPDATE shop_items SET name = ?, description = ?, price = ?, image = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssdsi", $name, $description, $price, $image, $id);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => $stmt->error]);
}

$conn->close();
?>
