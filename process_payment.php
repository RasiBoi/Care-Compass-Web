<?php
include 'db_connection.php';

if (isset($_POST['patient_email'])) {
    $patient_email = $_POST['patient_email'];

    // Debugging: Log request
    file_put_contents("debug_log.txt", "Received email: " . $patient_email . PHP_EOL, FILE_APPEND);

    // Update payment status
    $sql = "UPDATE bookings SET payment_status = 'completed' WHERE email = ? AND payment_status = 'pending'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $patient_email);

    if ($stmt->execute() && $stmt->affected_rows > 0) {
        echo json_encode(["success" => "Payment completed"]);
    } else {
        echo json_encode(["error" => "No pending payments found or update failed"]);
    }

    $stmt->close();
    $conn->close();
}
?>
