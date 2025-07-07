<?php
include 'db_connection.php';

$patient_id = $_GET['patient_id'];

$query = "SELECT patients.name, patients.email, patients.phone, patient_packages.package_name, 
                 patient_packages.amount, patient_packages.purchased_at 
          FROM patients 
          JOIN patient_packages ON patients.id = patient_packages.patient_id 
          WHERE patients.id = '$patient_id' 
          ORDER BY patient_packages.purchased_at DESC 
          LIMIT 1"; // Get the latest package for the patient

$result = $conn->query($query);
$data = $result->fetch_assoc();

// Generate bill content
$bill_content = "
    <div class='bill-container'>
        <h2>Payment Receipt</h2>
        <p>Name: {$data['name']}</p>
        <p>Email: {$data['email']}</p>
        <p>Phone: {$data['phone']}</p>
        <p>Package: {$data['package_name']}</p>
        <p>Amount: Rs" . number_format($data['amount'], 2) . "</p>
        <p>Date: {$data['purchased_at']}</p>
        <p><strong>Payment Successful!</strong></p>
    </div>
";

// Store bill in the database
$update_query = "UPDATE patient_packages 
                 SET bill_receipt = ? 
                 WHERE patient_id = ? 
                 ORDER BY purchased_at DESC 
                 LIMIT 1";
$stmt = $conn->prepare($update_query);
$stmt->bind_param("si", $bill_content, $patient_id);
$stmt->execute();
$stmt->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Receipt</title>
    <style>
        .bill-container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ddd;
            background: #f9f9f9;
            text-align: center;
        }
    </style>
</head>
<body>
    <?= $bill_content; ?>
</body>
</html>
