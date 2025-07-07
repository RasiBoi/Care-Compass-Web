<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $patient_name = $_POST['patient_name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $nic = $_POST['nic'];
    $payment_status = $_POST['payment_status'];

    $sql = "UPDATE bookings SET patient_name=?, email=?, mobile=?, nic=?, payment_status=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $patient_name, $email, $mobile, $nic, $payment_status, $id);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Appointment updated successfully!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to update appointment."]);
    }

    $stmt->close();
    $conn->close();
}
?>
