<?php
include 'db_connection.php';

$id = $_POST['id'];

// Delete from patients table
$sql1 = "DELETE FROM patients WHERE id='$id'";

if ($conn->query($sql1) === TRUE) {
    echo "Patient deleted successfully!";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
