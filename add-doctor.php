<?php
include 'db_connection.php';

// Collect form data
$name = $_POST['name'];
$specialty = $_POST['specialty'];
$bio = $_POST['bio'];
$qualifications = $_POST['qualifications'];
$experience_years = $_POST['experience_years'];
$contact_number = $_POST['contact_number'];
$email = $_POST['email'];
$clinic_address = $_POST['clinic_address'];
$image_path = $_POST['image_path']; // Image URL provided by the user

// Prepare and execute the SQL statement
$sql = "INSERT INTO doctors (name, specialty, bio, qualifications, experience_years, contact_number, email, clinic_address, image_path) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "ssssissss",
    $name,
    $specialty,
    $bio,
    $qualifications,
    $experience_years,
    $contact_number,
    $email,
    $clinic_address,
    $image_path
);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => $stmt->error]);
}

$conn->close();
?>
