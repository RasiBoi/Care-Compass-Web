<?php
include 'db_connection.php';

$name = $_POST['name'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Encrypt password
$phone = $_POST['phone'];
$address = $_POST['address'];

// Insert into patients table
$sql1 = "INSERT INTO patients (name, age, gender, email, phone, address) VALUES ('$name', '$age', '$gender', '$email', '$phone', '$address')";

if ($conn->query($sql1) === TRUE) {
    // Insert into users table
    $sql2 = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$password', 'Patient')";
    $conn->query($sql2);

    echo "Patient added successfully!";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
