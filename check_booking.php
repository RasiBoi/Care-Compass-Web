<?php
include 'db_connection.php';

if (isset($_POST['user_id'])) {
    $user_id = intval($_POST['user_id']);

    // First, get patient email from the patients table
    $sql = "SELECT email FROM patients WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $patient = $result->fetch_assoc();
        $email = $patient['email'];

        // Now check if this email has an appointment booking
        $sql = "SELECT * FROM bookings WHERE email = ? AND payment_status = 'pending'";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo json_encode($result->fetch_assoc());
        } else {
            echo json_encode(["error" => "No pending appointments found"]);
        }
    } else {
        echo json_encode(["error" => "No patient found"]);
    }

    $stmt->close();
    $conn->close();
}
?>
