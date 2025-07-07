<?php
include 'db_connection.php'; // Include database connection

// Collect and sanitize input data
$id = $_POST['id'];
$name = $_POST['name'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];

// Update query to modify the patient's details
$sql = "UPDATE patients SET name = ?, age = ?, gender = ?, email = ?, phone = ?, address = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sissssi", $name, $age, $gender, $email, $phone, $address, $id);

if ($stmt->execute()) {
    echo "Patient updated successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
