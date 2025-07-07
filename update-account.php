<?php
session_start();
include 'db_connection.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    exit;
}

$userId = $_SESSION['user_id']; // Assuming session contains user_id
$newEmail = $_POST['newEmail'];
$newPassword = $_POST['newPassword'];

// Hash the new password for security
$hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

// Update user details in the database
$sql = "UPDATE users SET email = ?, password = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssi", $newEmail, $hashedPassword, $userId);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success', 'message' => 'Account details updated successfully']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to update account details']);
}

$conn->close();
?>
