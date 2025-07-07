<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pay Online - Care Compass Hospital</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        h2 {
            color: #007bff;
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 15px;
        }

        select, input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        #patient-details {
            display: none;
            margin-top: 15px;
            padding: 10px;
            background: #f8f9fa;
            border-left: 4px solid #007bff;
        }

        button {
            width: 100%;
            padding: 10px;
            margin-top: 20px;
            background: #007bff;
            color: white;
            font-size: 18px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Pay Online</h2>
        <p>We provide you with an easy and secure way to pay hospital bills for you or your loved ones.</p>

        <form id="payment-form">
            <label for="category">Patient Category</label>
            <select id="category" name="category" required>
                <option value="" disabled selected>Please Select</option>
                <option value="appointment">Appointment Fee - Rs. 500</option>
                <option value="report">Report Fee - Rs. 1000</option>
            </select>

            <label for="patient-id">Patient ID</label>
            <input type="text" id="patient-id" name="patient-id" placeholder="Enter Patient ID" required>

            <div id="patient-details">
                <p><strong>Name:</strong> <span id="patient-name">N/A</span></p>
                <p><strong>Mobile:</strong> <span id="patient-mobile">N/A</span></p>
                <p><strong>NIC:</strong> <span id="patient-nic">N/A</span></p>
            </div>

            <button type="submit">CONTINUE</button>
        </form>
    </div>

    <script>

        document.getElementById('patient-id').addEventListener('input', function() {
        var userId = this.value.trim();

        if (userId.length > 0) {
            // Make AJAX request to fetch_patient.php
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "fetch_patient.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var response = JSON.parse(xhr.responseText);

                    if (response.error) {
                        document.getElementById('patient-details').style.display = 'none';
                    } else {
                        document.getElementById('patient-name').textContent = response.name;
                        document.getElementById('patient-mobile').textContent = response.phone;
                        document.getElementById('patient-nic').textContent = response.user_id;
                        document.getElementById('patient-details').style.display = 'block';

                        // Now check for booking
                        checkBooking(response.user_id);
                    }
                }
            };
            xhr.send("user_id=" + userId);
        } else {
            document.getElementById('patient-details').style.display = 'none';
        }
    });

    function checkBooking(userId) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "check_booking.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var response = JSON.parse(xhr.responseText);

                if (!response.error) {
                    document.getElementById('category').value = 'appointment'; // Set appointment fee
                    document.getElementById('category').disabled = true; // Disable selection
                }
            }
        };
        xhr.send("user_id=" + userId);
    }

    document.getElementById('payment-form').addEventListener('submit', function(event) {
        event.preventDefault();

        var userId = document.getElementById('patient-id').value.trim(); // Get the user_id

        if (userId.length === 0) {
            alert("Please enter a valid Patient ID.");
            return;
        }

        // Fetch the patient's email using AJAX
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "fetch_patient.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var response = JSON.parse(xhr.responseText);

                if (response.error) {
                    alert("Patient not found.");
                } else {
                    var patientEmail = response.email; // Get patient email from response

                    // Now send the payment request
                    processPayment(patientEmail);
                }
            }
        };
        xhr.send("user_id=" + userId);
    });

    function processPayment(patientEmail) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "process_payment.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                    alert("Payment Successful!");
                    window.location.href = "generate_bill.php?email=" + patientEmail;
                } else {
                    alert("Payment Failed: " + response.error);
                }
            }
        };
        xhr.send("patient_email=" + encodeURIComponent(patientEmail));
    }

    </script>
</body>

</html>
