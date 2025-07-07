<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $taskId = intval($_POST['id']);
    $timeSlot = $_POST['time_slot'];
    $day = $_POST['day'];
    $task = $_POST['task'];
    $doctorId = intval($_POST['doctor_id']);

    $sql = "UPDATE timetable SET time_slot = ?, day = ?, task = ?, doctor_id = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssii", $timeSlot, $day, $task, $doctorId, $taskId);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => $conn->error]);
    }

    $stmt->close();
    $conn->close();
}
?>
