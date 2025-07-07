<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $timeSlot = $_POST['time_slot'];
    $day = $_POST['day'];
    $task = $_POST['task'];
    $doctorId = $_POST['doctor_id'];

    $sql = "INSERT INTO timetable (time_slot, day, task, doctor_id) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $timeSlot, $day, $task, $doctorId);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => $conn->error]);
    }

    $stmt->close();
    $conn->close();
}
?>
