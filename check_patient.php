<?php
include 'db_connection.php';

if (isset($_GET['patientId'])) {
    $patientId = $_GET['patientId'];

    $query = "SELECT name, email, role FROM users WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $patientId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        echo json_encode(['success' => true, 'name' => $data['name'], 'contact' => $data['email'], 'packagePrice' => 1500]);
    } else {
        echo json_encode(['success' => false]);
    }
}
?>
