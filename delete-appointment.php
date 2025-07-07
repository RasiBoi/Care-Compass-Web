<?php
include 'db_connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM bookings WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Appointment deleted successfully!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to delete appointment."]);
    }

    $stmt->close();
    $conn->close();
}
?>
