<?php
include 'db_connection.php';

if (isset($_POST['user_id'])) {
    $user_id = intval($_POST['user_id']);

    // Fetch patient details
    $sql = "SELECT name, phone, user_id, email FROM patients WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo json_encode($result->fetch_assoc());
    } else {
        echo json_encode(["error" => "No patient found"]);
    }
    $stmt->close();
    $conn->close();
}
?>
