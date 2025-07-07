<?php
include 'db_connection.php';

if (isset($_GET['id'])) {
    $doctorId = $_GET['id'];

    // Delete dependent timetable entries
    $deleteTimetable = $conn->prepare("DELETE FROM timetable WHERE doctor_id = ?");
    $deleteTimetable->bind_param("i", $doctorId);
    $deleteTimetable->execute();

    // Delete the doctor
    $deleteDoctor = $conn->prepare("DELETE FROM doctors WHERE id = ?");
    $deleteDoctor->bind_param("i", $doctorId);

    if ($deleteDoctor->execute()) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => $conn->error]);
    }

    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid doctor ID.']);
}
?>
