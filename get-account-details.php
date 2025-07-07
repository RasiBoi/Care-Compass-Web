<?php
session_start();
include 'db_connection.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    exit;
}

$userId = $_SESSION['user_id']; // Assuming session contains user_id
$sql = "SELECT id, name, email, role, created_at FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$stmt->bind_result($id, $name, $email, $role, $created_at);
$stmt->fetch();
$stmt->close();

// Return the user details as a JSON response
if ($id) {
    echo json_encode([
        'status' => 'success',
        'user' => [
            'id' => $id,
            'name' => $name,
            'email' => $email,
            'role' => $role,
            'created_at' => $created_at
        ]
    ]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'User not found']);
}

$conn->close();
?>
