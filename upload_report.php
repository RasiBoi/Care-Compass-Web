<?php
include 'db_connection.php';

// Ensure file is uploaded
if (!isset($_FILES["reportFile"])) {
    echo json_encode(["status" => "error", "message" => "No file uploaded."]);
    exit();
}

$patient_id = $_POST['patient_id'];
$appointment_id = $_POST['appointment_id'];
$file = $_FILES["reportFile"];

// Validate file type (PDF only)
$file_ext = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
if ($file_ext !== "pdf") {
    echo json_encode(["status" => "error", "message" => "Only PDF files are allowed."]);
    exit();
}

// Generate a unique filename
$file_name = time() . "_" . basename($file["name"]);
$target_path = "uploads/" . $file_name;

// Move file to uploads folder
if (move_uploaded_file($file["tmp_name"], $target_path)) {
    $sql = "INSERT INTO reports (patient_id, appointment_id, report_file) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iis", $patient_id, $appointment_id, $file_name);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Report uploaded successfully."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Database error: " . $conn->error]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "File upload failed."]);
}
?>
