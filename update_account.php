<?php
session_start();
include 'db_connection.php'; // Include the database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patient_id = $_POST['patient_id'];
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']); // Optional field

    // Validate inputs
    if (empty($name) || empty($email)) {
        echo "<script>alert('Name and Email are required.'); window.history.back();</script>";
        exit();
    }

    // Prepare SQL query
    $sql = "UPDATE Users SET name = ?, email = ?, password = IF(? = '', password, ?) WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Error in statement preparation: " . $conn->error);
    }
    $stmt->bind_param("ssssi", $name, $email, $password, $password, $patient_id);
    $result = $stmt->execute();

    if ($result) {
        echo "<script>alert('Account updated successfully!'); window.location.href = 'patientdashboard.php';</script>";
    } else {
        echo "<script>alert('Error updating account.'); window.history.back();</script>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
