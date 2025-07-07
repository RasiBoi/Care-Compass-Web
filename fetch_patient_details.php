<?php
include 'db_connection.php';

$patient_id = $_GET['patient_id'];

$sql = "SELECT * FROM patients WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $patient_id);
$stmt->execute();
$patient_result = $stmt->get_result();
$patient = $patient_result->fetch_assoc();

if (!$patient) {
    echo json_encode(["status" => "error", "message" => "Patient not found"]);
    exit();
}

$sql = "SELECT b.id, d.name AS doctor, t.time_slot, b.payment_status, r.report_file AS report
        FROM bookings b
        JOIN doctors d ON b.doctor_id = d.id
        JOIN timetable t ON b.schedule_id = t.id
        LEFT JOIN reports r ON b.id = r.appointment_id
        WHERE b.patient_name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $patient['name']);
$stmt->execute();
$appointments = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

echo json_encode(["status" => "success", "patient" => $patient, "appointments" => $appointments]);
?>
