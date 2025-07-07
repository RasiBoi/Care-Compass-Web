<?php
session_start();
include 'db_connection.php';

$logged_in = isset($_SESSION['user_id']);
$patient_data = null;

if ($logged_in) {
    // Fetch patient details if user is logged in
    $user_id = $_SESSION['user_id'];
    $query = "SELECT * FROM patients WHERE user_id = '$user_id'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $patient_data = $result->fetch_assoc();
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $package_name = $_POST['package_name'];
    $amount = $_POST['amount'];

    if ($logged_in && $patient_data) {
        // Logged-in patient, use existing details
        $patient_id = $patient_data['id'];
    } else {
        // New patient, insert into patients table
        $name = $_POST['name'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];

        $insert_patient = "INSERT INTO patients (name, age, gender, email, phone, address) 
                           VALUES ('$name', '$age', '$gender', '$email', '$phone', '$address')";
        $conn->query($insert_patient);
        $patient_id = $conn->insert_id;
    }

    // Insert into patient_packages table
    $insert_package = "INSERT INTO patient_packages (patient_id, package_name, amount) 
                       VALUES ('$patient_id', '$package_name', '$amount')";
    $conn->query($insert_package);
    $package_id = $conn->insert_id;

    // Generate bill content
$bill_content = "
<div class='bill-container'>
    <h2>Payment Receipt</h2>
    <p>Name: " . (isset($patient_data['name']) ? $patient_data['name'] : $name) . "</p>
    <p>Email: " . (isset($patient_data['email']) ? $patient_data['email'] : $email) . "</p>
    <p>Phone: " . (isset($patient_data['phone']) ? $patient_data['phone'] : $phone) . "</p>
    <p>Package: {$package_name}</p>
    <p>Amount: Rs" . number_format($amount, 2) . "</p>
    <p>Date: " . date("Y-m-d H:i:s") . "</p>
    <p><strong>Payment Successful!</strong></p>
</div>
";


    // Store bill in the database
    $update_query = "UPDATE patient_packages 
                     SET bill_receipt = ? 
                     WHERE id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("si", $bill_content, $package_id);
    $stmt->execute();
    $stmt->close();

    // Redirect to bill.php
    echo "<script>
            alert('Payment Successful! Order Confirmed.');
            window.location.href = 'bill.php?patient_id=$patient_id';
          </script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout | Medcity</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .checkout-container {
            max-width: 600px;
            margin: 30px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #fff;
        }

        .checkout-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            font-weight: bold;
        }

        .form-group input, .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .btn-submit {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .btn-submit:hover {
            background-color: #218838;
        }
    </style>
</head>

<body>

<div class="checkout-container">
    <h2>Checkout</h2>

    <form method="POST">
        <div class="form-group">
            <label>Package Name:</label>
            <input type="text" name="package_name" value="Health Checkup Package" readonly>
        </div>

        <div class="form-group">
            <label>Amount:</label>
            <input type="text" name="amount" value="5000.00" readonly>
        </div>

        <?php if ($logged_in && $patient_data): ?>
            <div class="form-group">
                <label>Name:</label>
                <input type="text" value="<?= $patient_data['name']; ?>" readonly>
            </div>
            <div class="form-group">
                <label>Age:</label>
                <input type="text" value="<?= $patient_data['age']; ?>" readonly>
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" value="<?= $patient_data['email']; ?>" readonly>
            </div>
            <div class="form-group">
                <label>Phone:</label>
                <input type="text" value="<?= $patient_data['phone']; ?>" readonly>
            </div>
        <?php else: ?>
            <div class="form-group">
                <label>Name:</label>
                <input type="text" name="name" required>
            </div>
            <div class="form-group">
                <label>Age:</label>
                <input type="number" name="age" required>
            </div>
            <div class="form-group">
                <label>Gender:</label>
                <select name="gender" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label>Phone:</label>
                <input type="text" name="phone" required>
            </div>
            <div class="form-group">
                <label>Address:</label>
                <input type="text" name="address" required>
            </div>
        <?php endif; ?>

        <button type="submit" class="btn-submit">Pay Now</button>
    </form>
</div>

</body>
</html>
