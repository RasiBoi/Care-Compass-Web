<?php
include 'db_connection.php'; // Include database connection

if (isset($_GET['email'])) {
    $email = $_GET['email'];

    // Fetch booking details for the given email
    $sql = "SELECT * FROM bookings WHERE email = ? AND payment_status = 'completed' LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $booking = $result->fetch_assoc();
        
        // Assigning fetched data to variables
        $patient_name = $booking['patient_name'];
        $mobile = $booking['mobile'];
        $nic = $booking['nic'];
        $service = "Appointment Fee";
        $amount = "Rs. 500";
        $date = date("Y-m-d H:i:s", strtotime($booking['created_at'])); // Convert timestamp to readable date

    } else {
        echo "<h2 style='color: red; text-align: center;'>No completed payments found for this email.</h2>";
        exit;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<h2 style='color: red; text-align: center;'>Invalid request.</h2>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Bill</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 20px;
        }
        .bill-container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            border: 2px solid #000;
            border-radius: 5px;
            text-align: left;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .bill-details p {
            margin: 5px 0;
            font-size: 16px;
        }
        .print-button {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            font-size: 16px;
            background: blue;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <div class="bill-container">
        <h2>Hospital Bill Receipt</h2>
        <div class="bill-details">
            <p><strong>Patient Name:</strong> <?php echo $patient_name; ?></p>
            <p><strong>Email:</strong> <?php echo $email; ?></p>
            <p><strong>Mobile:</strong> <?php echo $mobile; ?></p>
            <p><strong>NIC:</strong> <?php echo $nic; ?></p>
            <p><strong>Service:</strong> <?php echo $service; ?></p>
            <p><strong>Amount:</strong> <?php echo $amount; ?></p>
            <p><strong>Payment Date:</strong> <?php echo $date; ?></p>
        </div>
    </div>

    <button class="print-button" onclick="window.print()">Download / Print Bill</button>

</body>
</html>
