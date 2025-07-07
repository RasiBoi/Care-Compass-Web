<?php
include 'db_connection.php'; // Include your database connection

// Get the doctor ID from the request
$doctor_id = $_POST['doctor_id'];

// SQL query to get the doctor's timetable
$sql = "SELECT * FROM timetable WHERE doctor_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $doctor_id);
$stmt->execute();
$result = $stmt->get_result();

$timetable = array();
while ($row = $result->fetch_assoc()) {
    $timetable[] = $row;
}

// Return the timetable as JSON
echo json_encode($timetable);

// Close the connection
$stmt->close();
$conn->close();
?>
