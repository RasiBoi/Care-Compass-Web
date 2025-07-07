<?php
include 'db_connection.php';

$response = [];

// Fetch total users
$sql = "SELECT COUNT(*) AS total FROM users";
$result = $conn->query($sql);
$response['usersCount'] = ($result) ? $result->fetch_assoc()['total'] : 0;

// Fetch total doctors
$sql = "SELECT COUNT(*) AS total FROM doctors";
$result = $conn->query($sql);
$response['doctorsCount'] = ($result) ? $result->fetch_assoc()['total'] : 0;

// Fetch total messages
$sql = "SELECT COUNT(*) AS total FROM messages";
$result = $conn->query($sql);
$response['messagesCount'] = ($result) ? $result->fetch_assoc()['total'] : 0;

// Fetch unreplied messages
$sql = "SELECT COUNT(*) AS total FROM messages WHERE reply IS NULL OR reply = ''";
$result = $conn->query($sql);
$response['unrepliedMessagesCount'] = ($result) ? $result->fetch_assoc()['total'] : 0;

// Fetch total appointments
$sql = "SELECT COUNT(*) AS total FROM bookings";
$result = $conn->query($sql);
$response['appointmentsCount'] = ($result) ? $result->fetch_assoc()['total'] : 0;

// Fetch unpaid, pending, and cancelled appointments
$sql = "SELECT COUNT(*) AS total FROM bookings WHERE payment_status = 'not paid'";
$result = $conn->query($sql);
$response['notPaidAppointments'] = ($result) ? $result->fetch_assoc()['total'] : 0;

$sql = "SELECT COUNT(*) AS total FROM bookings WHERE payment_status = 'pending'";
$result = $conn->query($sql);
$response['pendingAppointments'] = ($result) ? $result->fetch_assoc()['total'] : 0;

$sql = "SELECT COUNT(*) AS total FROM bookings WHERE payment_status = 'cancelled'";
$result = $conn->query($sql);
$response['cancelledAppointments'] = ($result) ? $result->fetch_assoc()['total'] : 0;

// Close connection
$conn->close();

// Send JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
