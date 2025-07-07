<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    // Redirect to login if user is not logged in
    header("Location: login.php");
    exit();
}

include 'db_connection.php';

// Fetch patient_id using user_id from the session
$user_id = $_SESSION['user_id']; // user_id from users table
$sql = "SELECT id, name, email FROM patients WHERE user_id = '$user_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $_SESSION['patient_id'] = $row['id']; // Store correct patient_id
    $_SESSION['user_name'] = $row['name'];
    $_SESSION['user_email'] = $row['email'];
} else {
    die("Error: No matching patient record found.");
}

$patient_id = $_SESSION['patient_id'];
$patient_name = $_SESSION['user_name'];
$patient_email = $_SESSION['user_email'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Dashboard</title>
    <!-- Styles -->
    <link rel="stylesheet" href="dashboardstyles.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Popup Form Styles */
        .popup-form {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .form-container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            width: 400px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #424242;
            border-radius: 8px;
            outline: none;
        }

        button.update {
            background: #1e88e5;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        button.delete {
            background: #f44336;
            color: #fff;
            margin-left: 10px;
            padding: 10px 15px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }
        /* Account Section Styling */
.account-container {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

.profile-card {
    background: #fff;
    border-radius: 10px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    width: 350px;
    text-align: center;
    padding: 20px;
}

.profile-header {
    position: relative;
    padding-bottom: 15px;
    border-bottom: 1px solid #ddd;
}

.profile-avatar {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    border: 3px solid #28a745;
    margin-bottom: 10px;
}

.profile-header h3 {
    margin: 0;
    font-size: 22px;
    color: #333;
}

.profile-header p {
    font-size: 14px;
    color: #666;
}

.profile-details {
    margin-top: 15px;
    font-size: 16px;
    color: #444;
}

.profile-actions {
    margin-top: 20px;
}

.update-btn {
    background: #007bff;
    color: #fff;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    transition: 0.3s;
}

.update-btn:hover {
    background: #0056b3;
}

.delete-btn {
    background: #dc3545;
    color: #fff;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    transition: 0.3s;
}

.delete-btn:hover {
    background: #c82333;
}

/* Popup Form Styling */
.popup-form {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1000;
}

.form-container {
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    width: 400px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: 500;
}

.form-group input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    outline: none;
}

.profile-buttons {
    display: flex;
    justify-content: space-between;
}

    </style>
</head>

<body>
    <!-- Navigation -->
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="#">
                        <span class="title">Patient Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="#" onclick="showSection('dashboardSection')">
                        <span class="icon"><i class="fas fa-home"></i></span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="#" onclick="showSection('messagesSection')">
                        <span class="icon"><i class="fas fa-envelope"></i></span>
                        <span class="title">Messages</span>
                    </a>
                </li>
                <li>
                    <a href="#" onclick="showSection('appointmentsSection')">
                        <span class="icon"><i class="fas fa-calendar-check"></i></span>
                        <span class="title">Appointments</span>
                    </a>
                </li>
                <li>
                    <a href="#" onclick="showSection('reportsSection')">
                        <span class="icon"><i class="fas fa-file-alt"></i></span>
                        <span class="title">Reports</span>
                    </a>
                </li>
                <li>
                    <a href="#" onclick="showSection('billPaymentSection')">
                        <span class="icon"><i class="fas fa-money-bill"></i></span>
                        <span class="title">Bill Payment</span>
                    </a>
                </li>
                <li>
                    <a href="#" onclick="showSection('feedbackSection')">
                        <span class="icon"><i class="fas fa-comment-alt"></i></span>
                        <span class="title">Give Feedback</span>
                    </a>
                </li>
                <li>
                    <a href="#" onclick="showSection('accountSection')">
                        <span class="icon"><i class="fas fa-comment-alt"></i></span>
                        <span class="title">My Account</span>
                    </a>
                </li>
                <li>
                    <a href="logout.php">
                        <span class="icon"><i class="fas fa-sign-out-alt"></i></span>
                        <span class="title">Logout</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Main -->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <i class="fas fa-bars"></i>
                </div>
                <div class="user">
                    <img src="assets/images/logo.png" alt="Admin">
                </div>
            </div>

            <!-- Sections -->
            <div id="dashboardSection" class="content">Welcome to the Patient Dashboard</div>
            

<!-- My Account Section -->
<div id="accountSection" class="content" style="display: none;">
    <h2 style="text-align: center; font-size: 28px; color: #333; margin-top: 20px;">My Account</h2>
    
    <div class="account-container">
        <div class="profile-card">
            <div class="profile-header">
                <h3><?php echo htmlspecialchars($patient_name); ?></h3>
                <p>Patient ID: <?php echo htmlspecialchars($patient_id); ?></p>
            </div>
            <div class="profile-details">
                <p><strong>Email:</strong> <?php echo htmlspecialchars($patient_email); ?></p>
            </div>
            <div class="profile-actions">
                <button class="update-btn" onclick="openUpdateForm()">Edit Profile</button>
            </div>
        </div>
    </div>
</div>

<!-- Update Form Popup -->
<div id="updateForm" class="popup-form" style="display: none;">
    <div class="form-container">
        <h3>Edit Account Details</h3>
        <form id="accountUpdateForm" method="POST" action="update_account.php">
            <input type="hidden" id="patientIdInput" name="patient_id" value="<?php echo htmlspecialchars($patient_id); ?>">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($patient_name); ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($patient_email); ?>" required>
            </div>
            <div class="form-group">
                <label for="password">New Password</label>
                <input type="password" id="password" name="password" placeholder="Leave blank to keep current password">
            </div>
            <div class="profile-buttons">
                <button type="submit" class="update-btn">Save Changes</button>
                <button type="button" class="delete-btn" onclick="closeUpdateForm()">Cancel</button>
            </div>
        </form>
    </div>
</div>



            
        <!-- Messages Section -->
<div id="messagesSection" class="content" style="display: none;">
    <h2 style="text-align: center; margin-top: 20px; font-size: 24px; color: #333;">My Messages</h2>

    <?php
    include 'db_connection.php';

    // Fetch messages for the logged-in patient
    $sql = "SELECT * FROM messages WHERE email = '$patient_email' ORDER BY created_at DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<table border="1" width="100%" cellpadding="10" style="border-collapse: collapse;">';
        echo '<tr style="background: #f4f4f4;">
                <th>Subject</th>
                <th>Message</th>
                <th>Reply</th>
                <th>Created At</th>
              </tr>';

        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($row['subject']) . '</td>';
            echo '<td>' . nl2br(htmlspecialchars($row['message'])) . '</td>';
            echo '<td>' . (!empty($row['reply']) ? nl2br(htmlspecialchars($row['reply'])) : '<em>Not replied yet</em>') . '</td>';
            echo '<td>' . $row['created_at'] . '</td>';
            echo '</tr>';
        }

        echo '</table>';
    } else {
        echo '<p style="text-align: center; color: #555;">No messages found.</p>';
    }

    $conn->close();
    ?>
</div>

<!-- Reports Section -->
<div id="reportsSection" class="content" style="display: none;">
    <h2 style="text-align: center; margin-top: 20px; font-size: 24px; color: #333;">My Reports</h2>

    <?php
    include 'db_connection.php';

    // Fetch logged-in patient ID
    $patient_id = $_SESSION['patient_id'];

    // Query to get reports for the logged-in patient
    $sql = "SELECT * FROM reports WHERE patient_id = '$patient_id' ORDER BY uploaded_at DESC";
    $result = $conn->query($sql);

    if (!$result) {
        die("Query Failed: " . $conn->error);
    }

    if ($result->num_rows > 0) {
        echo '<table border="1" width="100%" cellpadding="10" style="border-collapse: collapse; margin-top: 20px;">
                <tr style="background: #f4f4f4;">
                    <th>Report File</th>
                    <th>Uploaded At</th>
                    <th>Payment Status</th>
                    <th>Actions</th>
                </tr>';

        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            if ($row['payment_status'] == 'paid') {
                // Show report link if paid
                echo '<td><a href="uploads/' . htmlspecialchars($row['report_file']) . '" target="_blank">' . htmlspecialchars($row['report_file']) . '</a></td>';
            } else {
                // Hide report if not paid
                echo '<td><em>Report Locked</em></td>';
            }
            echo '<td>' . date("d M Y, h:i A", strtotime($row['uploaded_at'])) . '</td>';
            echo '<td>' . ucfirst(htmlspecialchars($row['payment_status'])) . '</td>';
            echo '<td>';
            if ($row['payment_status'] == 'pending') {
                echo '<button onclick="openPaymentPopup(' . $row['id'] . ')" style="background: blue; color: white; padding: 8px 12px; border: none; cursor: pointer; border-radius: 5px;">Pay Now</button>';
            } else {
                echo '<span style="color: green;">Paid</span>';
            }
            echo '</td>';
            echo '</tr>';
        }

        echo '</table>';
    } else {
        echo '<p style="text-align: center; color: #555; margin-top: 20px;">No reports found.</p>';
    }

    $conn->close();
    ?>
</div>

<!-- Payment Popup -->
<div id="paymentPopup" class="popup-form" style="display: none;">
    <div class="form-container">
        <h3>Complete Payment</h3>
        <form id="paymentForm">
            <input type="hidden" id="reportId" name="report_id">
            <div class="form-group">
                <label for="cardName">Cardholder Name</label>
                <input type="text" id="cardName" name="cardName" required>
            </div>
            <div class="form-group">
                <label for="cardNumber">Card Number</label>
                <input type="text" id="cardNumber" name="cardNumber" required placeholder="1234 5678 9012 3456">
            </div>
            <div class="form-group">
                <label for="expiry">Expiry Date</label>
                <input type="text" id="expiry" name="expiry" required placeholder="MM/YY">
            </div>
            <div class="form-group">
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv" required placeholder="123">
            </div>
            <button type="button" class="update" onclick="submitPayment()">Submit Payment</button>
            <button type="button" class="delete" onclick="closePaymentPopup()">Cancel</button>
        </form>
    </div>
</div>


<!-- Bill Payment Section -->
<div id="billPaymentSection" class="content" style="display: none;">
    <h2 style="text-align: center; margin-top: 20px; font-size: 24px; color: #333;">My Package & Bills</h2>

    <?php
    include 'db_connection.php';

    // Fetch logged-in patient ID from session
    $patient_id = $_SESSION['patient_id'];

    // Query to get the patient's purchased packages
    $sql = "SELECT package_name, amount, purchased_at, bill_receipt FROM patient_packages 
            WHERE patient_id = '$patient_id' ORDER BY purchased_at DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<table border="1" width="100%" cellpadding="10" style="border-collapse: collapse; margin-top: 20px;">
                <tr style="background: #f4f4f4;">
                    <th>Package Name</th>
                    <th>Amount (Rs)</th>
                    <th>Purchase Date</th>
                    <th>Bill Preview</th>
                </tr>';

        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($row['package_name']) . '</td>';
            echo '<td>Rs ' . number_format($row['amount'], 2) . '</td>';
            echo '<td>' . date("d M Y, h:i A", strtotime($row['purchased_at'])) . '</td>';
            echo '<td>' . (!empty($row['bill_receipt']) ? $row['bill_receipt'] : '<em>No bill available</em>') . '</td>';
            echo '</tr>';
        }

        echo '</table>';
    } else {
        echo '<p style="text-align: center; color: #555; margin-top: 20px;">No packages found.</p>';
    }

    $conn->close();
    ?>

    <!-- Buy New Package Button -->
    <div style="text-align: center; margin-top: 30px;">
        <a href="shop.php" style="display: inline-block; padding: 12px 24px; background: #28a745; 
            color: #fff; text-decoration: none; font-size: 18px; border-radius: 6px; font-weight: bold;">
            Buy New Package
        </a>
    </div>
</div>

<!-- Feedback Section -->
<div id="feedbackSection" class="content" style="display: none;">
    <h2 style="text-align: center; margin-top: 20px; font-size: 24px; color: #333;">Submit Your Feedback</h2>

    <form onsubmit="openEmailClient(); return false;" style="max-width: 500px; margin: 20px auto; padding: 20px; background: #fff; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
        <div class="form-group">
            <label for="subject">Subject:</label>
            <input type="text" id="subject" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
        </div>
        <div class="form-group">
            <label for="message">Message:</label>
            <textarea id="message" rows="5" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;"></textarea>
        </div>
        <button type="submit" style="width: 100%; padding: 12px; background: #28a745; color: #fff; border: none; border-radius: 5px; cursor: pointer; font-size: 16px;">
            Submit Feedback
        </button>
    </form>
</div>

<script>
function openEmailClient() {
    // Set the Admin's Email (Change this to your Admin email)
    var adminEmail = "admin@gmail.com"; 

    // Get user input
    var subject = document.getElementById('subject').value;
    var message = document.getElementById('message').value;

    // Encode values for URL
    var mailtoLink = "mailto:" + adminEmail + "?subject=" + encodeURIComponent(subject) + "&body=" + encodeURIComponent(message);

    // Open default email client
    window.location.href = mailtoLink;
}
</script>





<!-- Appointments Section -->
<div id="appointmentsSection" class="content" style="display: none;">
    <h2 style="text-align: center; margin-top: 20px; font-size: 24px; color: #333;">My Appointments</h2>

    <?php
    include 'db_connection.php';

    // Fetch appointments for the logged-in patient
    $sql = "SELECT b.id, d.name AS doctor_name, t.time_slot, b.created_at, b.payment_status 
            FROM bookings b
            JOIN doctors d ON b.doctor_id = d.id
            JOIN timetable t ON b.schedule_id = t.id
            WHERE b.email = '$patient_email'
            ORDER BY b.created_at DESC";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<table border="1" width="100%" cellpadding="10" style="border-collapse: collapse;">';
        echo '<tr style="background: #f4f4f4;">
                <th>Doctor</th>
                <th>Time Slot</th>
                <th>Payment Status</th>
                <th>Booked At</th>
              </tr>';

        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($row['doctor_name']) . '</td>';
            echo '<td>' . htmlspecialchars($row['time_slot']) . '</td>';
            echo '<td>' . ucfirst(htmlspecialchars($row['payment_status'])) . '</td>';
            echo '<td>' . $row['created_at'] . '</td>';
            echo '</tr>';
        }

        echo '</table>';
    } else {
        echo '<p style="text-align: center; color: #555;">No appointments found.</p>';
    }

    $conn->close();
    ?>
</div>



        </div>
    </div>

    <!-- Scripts -->
    <script>
        function showSection(sectionId) {
            const sections = document.querySelectorAll('.content');
            sections.forEach(section => section.style.display = 'none');

            const activeSection = document.getElementById(sectionId);
            if (activeSection) {
                activeSection.style.display = 'block';
            }
        }

        const toggle = document.querySelector('.toggle');
        const navigation = document.querySelector('.navigation');
        const main = document.querySelector('.main');

        toggle.addEventListener('click', () => {
            navigation.classList.toggle('active');
            main.classList.toggle('active');
        });

        function showSection(sectionId) {
            const sections = document.querySelectorAll('.content');
            sections.forEach(section => section.style.display = 'none');

            const activeSection = document.getElementById(sectionId);
            if (activeSection) {
                activeSection.style.display = 'block';
            }
        }

        function openUpdateForm() {
            document.getElementById('updateForm').style.display = 'flex';
        }

        function closeUpdateForm() {
            document.getElementById('updateForm').style.display = 'none';
        }

        function openPaymentPopup(reportId) {
    document.getElementById('paymentPopup').style.display = 'flex';
    document.getElementById('reportId').value = reportId;
}

function closePaymentPopup() {
    document.getElementById('paymentPopup').style.display = 'none';
}

function submitPayment() {
    var reportId = document.getElementById('reportId').value;

    // Simulate payment processing delay
    setTimeout(function () {
        alert("Payment Successful!");

        // Update payment status in database via AJAX
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "update_payment.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Reload page to show paid report
                location.reload();
            }
        };
        xhr.send("report_id=" + reportId);

    }, 2000);
}


    

    </script>
</body>

</html>
