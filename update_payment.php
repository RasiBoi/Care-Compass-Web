<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['report_id'])) {
    $report_id = $_POST['report_id'];

    // Update payment status in database
    $sql = "UPDATE reports SET payment_status = 'paid' WHERE id = '$report_id'";
    if ($conn->query($sql) === TRUE) {
        echo "Payment updated successfully!";
    } else {
        echo "Error updating payment: " . $conn->error;
    }

    $conn->close();
}
?>
