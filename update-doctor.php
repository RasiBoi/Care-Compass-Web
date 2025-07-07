<?php
include 'db_connection.php';

$id = $_POST['id'];
$name = $_POST['name'];
$specialty = $_POST['specialty'];
$bio = $_POST['bio'];
$qualifications = $_POST['qualifications'];
$experience_years = $_POST['experience_years'];
$contact_number = $_POST['contact_number'];
$email = $_POST['email'];
$clinic_address = $_POST['clinic_address'];

$image_path = null;
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $image_name = basename($_FILES['image']['name']);
    $image_tmp_path = $_FILES['image']['tmp_name'];
    $image_dest_path = 'uploads/' . $image_name;

    if (move_uploaded_file($image_tmp_path, $image_dest_path)) {
        $image_path = $image_dest_path;
    }
}

$sql = "UPDATE doctors SET 
            name = ?, 
            specialty = ?, 
            bio = ?, 
            qualifications = ?, 
            experience_years = ?, 
            contact_number = ?, 
            email = ?, 
            clinic_address = ?" .
    ($image_path ? ", image_path = ?" : "") .
    " WHERE id = ?";
$stmt = $conn->prepare($sql);

if ($image_path) {
    $stmt->bind_param("ssssissssi", $name, $specialty, $bio, $qualifications, $experience_years, $contact_number, $email, $clinic_address, $image_path, $id);
} else {
    $stmt->bind_param("ssssisssi", $name, $specialty, $bio, $qualifications, $experience_years, $contact_number, $email, $clinic_address, $id);
}

if ($stmt->execute()) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => $stmt->error]);
}

$conn->close();
?>
