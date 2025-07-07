<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Dashboard</title>
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
    background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
    display: flex;
    justify-content: center; /* Horizontally center the form */
    align-items: center; /* Vertically center the form */
    z-index: 1000; /* Ensure it's above all other elements */
}

.form-container {
    background: #fff;
    padding: 25px;
    border-radius: 12px;
    width: 400px;
    max-width: 90%; /* Ensure responsiveness */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Add depth to the popup */
    text-align: left; /* Align text to the left */
}



.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: 500;
}

.form-group input, .form-group select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
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

.dashboard-cards {
    display: flex;
    justify-content: center;
    gap: 20px;
    margin-top: 30px;
}

.dashboard-card {
    background-color: #1e88e5;
    color: #fff;
    text-align: center;
    border-radius: 12px;
    width: 200px;
    height: 150px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    font-family: Arial, sans-serif;
}

.dashboard-card h3 {
    font-size: 18px;
    margin-bottom: 10px;
}

.dashboard-card p {
    font-size: 28px;
    font-weight: bold;
    margin: 0;
}

/* Update Button */
button.btn-update {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 8px 15px;
    font-size: 14px;
    font-weight: bold;
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
}

button.btn-update:hover {
    background-color: #0056b3;
}

/* Delete Button */
button.btn-delete {
    background-color: #dc3545;
    color: white;
    border: none;
    padding: 8px 15px;
    font-size: 14px;
    font-weight: bold;
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
}

button.btn-delete:hover {
    background-color: #b02a37;
}


/* Add Patient Button */
button.add-patient {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 12px 20px;
    font-size: 16px;
    font-weight: bold;
    border-radius: 5px;
    cursor: pointer;
    display: block;
    margin: 20px auto;
    transition: 0.3s;
}

button.add-patient:hover {
    background-color: #0056b3;
}

button{
    background: #1e88e5;
    color: #fff;
    padding: 10px 15px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
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

/* Chat Section Styling */
.chat-box {
    height: 400px;
    overflow-y: auto;
    padding: 10px;
    background: #f9f9f9;
    border-radius: 12px;
    border: 1px solid #ddd;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.chat-message {
    padding: 8px;
    margin: 5px 0;
    border-radius: 8px;
    max-width: 70%;
    font-size: 14px;
    word-wrap: break-word;
}

.sender {
    font-weight: bold;
    color: #1e88e5;
}

.timestamp {
    font-size: 12px;
    color: #777;
}

.chat-input-container {
    display: flex;
    gap: 10px;
    margin-top: 10px;
}

.chat-category {
    padding: 10px;
    border-radius: 8px;
    border: 1px solid #ccc;
}

.chat-input {
    flex: 1;
    padding: 10px;
    border-radius: 8px;
    border: 1px solid #ccc;
}

.chat-send-btn {
    padding: 10px 15px;
    background: #1e88e5;
    color: white;
    border: none;
    border-radius: 8px;
    cursor: pointer;
}

/* My Account Section Styling */
#accountSection {
    margin-top: 30px;
    padding: 20px;
    background-color: #f4f4f4;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

#accountSection h2 {
    font-size: 28px;
    margin-bottom: 20px;
    color: #333;
    font-family: 'Roboto', sans-serif;
}

.account-info {
    background-color: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
}

.account-info h3 {
    font-size: 24px;
    margin-bottom: 15px;
    font-family: 'Roboto', sans-serif;
    color: #333;
}

.account-info p {
    font-size: 16px;
    margin: 10px 0;
    color: #555;
}

.account-info p strong {
    color: #1e88e5;
}

.account-info input[type="email"],
.account-info input[type="password"] {
    width: 100%;
    padding: 12px;
    margin: 10px 0;
    border-radius: 8px;
    border: 1px solid #ccc;
    font-size: 16px;
}

.account-info button {
    background-color: #1e88e5;
    color: white;
    padding: 12px 20px;
    font-size: 16px;
    font-weight: bold;
    border-radius: 8px;
    cursor: pointer;
    width: 100%;
    margin-top: 10px;
    transition: 0.3s ease;
}

.account-info button:hover {
    background-color: #1565c0;
}

.account-info .btn-go-website {
    background-color: #4caf50;
    margin-top: 20px;
}

.account-info .btn-go-website:hover {
    background-color: #388e3c;
}

.account-info .btn-go-website:active {
    background-color: #2c6b2e;
}

/* Update Button Styling */
.account-info button[type="button"] {
    background-color: #f44336;
    color: white;
    border: none;
    padding: 12px 20px;
    font-size: 16px;
    font-weight: bold;
    border-radius: 8px;
    cursor: pointer;
    width: 100%;
    margin-top: 10px;
    transition: 0.3s ease;
}

.account-info button[type="button"]:hover {
    background-color: #d32f2f;
}

/* Form Input Fields Styling */
.account-info .form-group input {
    margin-bottom: 15px;
}

.account-info .form-group label {
    font-size: 14px;
    color: #555;
    font-weight: bold;
}

.account-info .form-group input:focus {
    border-color: #1e88e5;
    box-shadow: 0 0 5px rgba(30, 136, 229, 0.5);
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
                        <span class="title">Staff Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="#" onclick="showSection('dashboardSection')">
                        <span class="icon"><i class="fas fa-home"></i></span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="#" onclick="showSection('patientsSection')">
                        <span class="icon"><i class="fas fa-users"></i></span>
                        <span class="title">Patients</span>
                    </a>
                </li>
                <li>
                    <a href="#" onclick="showSection('doctorsSection')">
                        <span class="icon"><i class="fas fa-user-md"></i></span>
                        <span class="title">Doctors</span>
                    </a>
                </li>
                <li>
                    <a href="#" onclick="showSection('reportsSection')">
                        <span class="icon"><i class="fas fa-file-alt"></i></span>
                        <span class="title">Reports</span>
                    </a>
                </li>
                <li>
                    <a href="#" onclick="showSection('billPaymentsSection')">
                        <span class="icon"><i class="fas fa-money-bill"></i></span>
                        <span class="title">Bill Payments</span>
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
                    <a href="#" onclick="showSection('chatSection')">
                        <span class="icon"><i class="fas fa-comments"></i></span>
                        <span class="title">Chat</span>
                    </a>
                </li>
                <li>
                    <a href="#" onclick="showSection('accountSection')">
                        <span class="icon"><i class="fas fa-comments"></i></span>
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
            <div id="dashboardSection" class="content">Welcome to the Staff Dashboard</div>
            
            <div id="patientsSection" class="content" style="display: none;">
    <h2 style="text-align: center; margin-top: 20px; font-size: 24px; color: #333;">Manage Patients</h2>
    
    <!-- Patient Table -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="patientTableBody">
            <?php
            include 'db_connection.php'; // Include database connection
            $sql = "SELECT * FROM patients";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['age']}</td>
                        <td>{$row['gender']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['phone']}</td>
                        <td>{$row['address']}</td>
                        <td>
    <button class='btn-update' onclick='editPatient({$row['id']})'>Update</button>
    <button class='btn-delete' onclick='deletePatient({$row['id']})'>Delete</button>
</td>

                    </tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No patients found.</td></tr>";
            }
            $conn->close();
            ?>
        </tbody>
    </table>

    <!-- Add Patient Button -->
    <button class="add-patient" onclick="openPopup()">Add New Patient</button>
</div>

<!-- Popup Form -->
<div id="popupForm" class="popup-form" style="display: none;">
    <div class="form-container">
        <h3>Add Patient</h3>
        <form id="addPatientForm">
            <div class="form-group">
                <label>Name:</label>
                <input type="text" id="name" required>
            </div>
            <div class="form-group">
                <label>Age:</label>
                <input type="number" id="age" required>
            </div>
            <div class="form-group">
                <label>Gender:</label>
                <select id="gender">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" id="email" required>
            </div>
            <div class="form-group">
                <label>Password:</label>
                <input type="password" id="password" required>
            </div>
            <div class="form-group">
                <label>Phone:</label>
                <input type="text" id="phone" required>
            </div>
            <div class="form-group">
                <label>Address:</label>
                <input type="text" id="address" required>
            </div>
            <button type="button" onclick="savePatient()">Save</button>
            <button type="button" onclick="closePopup()">Cancel</button>
        </form>
    </div>
</div>

<!-- Popup Form -->
<div id="popupForm" class="popup-form" style="display: none;">
    <div class="form-container">
        <h3 id="popupFormTitle">Add Patient</h3>
        <form id="addPatientForm">
            <input type="hidden" id="patientId"> <!-- Hidden field for the patient ID -->

            <div class="form-group">
                <label>Name:</label>
                <input type="text" id="name" required>
            </div>
            <div class="form-group">
                <label>Age:</label>
                <input type="number" id="age" required>
            </div>
            <div class="form-group">
                <label>Gender:</label>
                <select id="gender">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" id="email" required>
            </div>
            <div class="form-group">
                <label>Password:</label>
                <input type="password" id="password" required>
            </div>
            <div class="form-group">
                <label>Phone:</label>
                <input type="text" id="phone" required>
            </div>
            <div class="form-group">
                <label>Address:</label>
                <input type="text" id="address" required>
            </div>
            <button type="button" id="saveButton" onclick="savePatient()">Save</button>
            <button type="button" id="updateButton" style="display:none;" onclick="updatePatient()">Update</button>
            <button type="button" onclick="closePopup()">Cancel</button>
        </form>
    </div>
</div>

<div id="doctorsSection" class="content" style="display: none;">
    <h2 style="text-align: center; margin-top: 20px; font-size: 24px; color: #333;">Manage Doctors</h2>

    <!-- Doctor Table -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Specialty</th>
                <th>Qualifications</th>
                <th>Experience (Years)</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="doctorTableBody">
            <?php
            include 'db_connection.php'; // Include database connection
            $sql = "SELECT * FROM doctors";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['specialty']}</td>
                        <td>{$row['qualifications']}</td>
                        <td>{$row['experience_years']}</td>
                        <td>
                            <button class='btn-view' onclick='viewTimetable({$row['id']})'>View</button>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No doctors found.</td></tr>";
            }
            $conn->close();
            ?>
        </tbody>
    </table>
</div>

<!-- Timetable Popup Form -->
<div id="timetablePopupForm" class="popup-form" style="display: none;">
    <div class="form-container">
        <h3>Doctor's Timetable</h3>
        <table border="1" width="100%" id="timetableTable">
            <thead>
                <tr>
                    <th>Time Slot</th>
                    <th>Day</th>
                    <th>Task</th>
                </tr>
            </thead>
            <tbody id="timetableTableBody">
                <!-- Timetable rows will be added dynamically -->
            </tbody>
        </table>
        <button type="button" onclick="closeTimetablePopup()">Close</button>
    </div>
</div>


<!-- Appointments Section -->
<div id="appointmentsSection" class="content" style="display: none;">
    <h2 style="text-align: center; margin-top: 20px; font-size: 24px; color: #333;">Appointments List</h2>

    <?php
    include 'db_connection.php';

    $sql = "SELECT b.*, d.name AS doctor_name, t.time_slot 
            FROM bookings b
            JOIN doctors d ON b.doctor_id = d.id
            JOIN timetable t ON b.schedule_id = t.id
            ORDER BY b.created_at DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<table>';
        echo '<tr><th>ID</th><th>Doctor</th><th>Time Slot</th><th>Patient Name</th><th>Email</th><th>Mobile</th><th>NIC</th><th>Created At</th><th>Payment Status</th><th>Actions</th></tr>';

        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['id'] . '</td>';
            echo '<td>' . htmlspecialchars($row['doctor_name']) . '</td>';
            echo '<td>' . htmlspecialchars($row['time_slot']) . '</td>';
            echo '<td>' . htmlspecialchars($row['patient_name']) . '</td>';
            echo '<td>' . htmlspecialchars($row['email']) . '</td>';
            echo '<td>' . htmlspecialchars($row['mobile']) . '</td>';
            echo '<td>' . htmlspecialchars($row['nic']) . '</td>';
            echo '<td>' . $row['created_at'] . '</td>';
            echo '<td>' . htmlspecialchars($row['payment_status']) . '</td>';
            echo '<td>';
            echo '<button class="update" onclick=\'openUpdateAppointmentForm(' . json_encode($row) . ')\'>Update</button>';
            echo '<button class="delete" onclick="deleteAppointment(' . $row['id'] . ')">Delete</button>';
            echo '<button class="notify" onclick="notifyPatient(\'' . $row['email'] . '\', \'' . $row['patient_name'] . '\', \'' . $row['doctor_name'] . '\', \'' . $row['time_slot'] . '\')">Notify</button>';
            echo '</td>';
            echo '</tr>';
        }

        echo '</table>';
    } else {
        echo '<p>No appointments found.</p>';
    }

    $conn->close();
    ?>
</div>

<!-- Update Appointment Popup Form -->
<div id="updateAppointmentForm" class="popup-form" style="display: none;">
    <div class="form-container">
        <h3>Update Appointment</h3>
        <form id="appointmentUpdateForm">
            <input type="hidden" id="appointmentId" name="id">
            
            <div class="form-group">
                <label for="appointmentPatientName">Patient Name</label>
                <input type="text" id="appointmentPatientName" name="patient_name" required>
            </div>
            
            <div class="form-group">
                <label for="appointmentEmail">Email</label>
                <input type="email" id="appointmentEmail" name="email" required>
            </div>

            <div class="form-group">
                <label for="appointmentMobile">Mobile</label>
                <input type="text" id="appointmentMobile" name="mobile" required>
            </div>

            <div class="form-group">
                <label for="appointmentNic">NIC</label>
                <input type="text" id="appointmentNic" name="nic" required>
            </div>

            <div class="form-group">
                <label for="appointmentPaymentStatus">Payment Status</label>
                <select id="appointmentPaymentStatus" name="payment_status">
                    <option value="pending">Pending</option>
                    <option value="completed">Completed</option>
                    <option value="failed">Failed</option>
                    <option value="refunded">Refunded</option>
                </select>
            </div>

            <button type="button" class="update" onclick="updateAppointment()">Save Changes</button>
            <button type="button" class="delete" onclick="closeUpdateAppointmentForm()">Cancel</button>
        </form>
    </div>
</div>


<!-- Chat Section for Staff -->
<div id="chatSection" class="content" style="display: none;">
    <h2 style="text-align: center; margin-top: 20px;">Staff Chat</h2>

    <!-- Chat Messages Display -->
    <div id="chatBox" class="chat-box"></div>

    <!-- Chat Input Form -->
    <div class="chat-input-container">
        <select id="chatCategory" class="chat-category">
            <option value="General">General</option>
            <option value="Leave">Leave Requests</option>
            <option value="Notice">Notices</option>
        </select>
        <input type="text" id="chatMessage" placeholder="Type your message..." class="chat-input">
        <button onclick="sendMessage()" class="chat-send-btn">Send</button>
    </div>
</div>


<div id="accountSection" class="content" style="display: none;">
    <h2 style="text-align: center; margin-top: 20px; font-size: 24px; color: #333;">My Account</h2>

    <!-- Account Info -->
    <div class="account-info">
        <h3>Staff Details</h3>
        <p><strong>Name:</strong> <span id="staffName">Loading...</span></p>
        <p><strong>Email:</strong> <span id="staffEmail">Loading...</span></p>
        <p><strong>Role:</strong> <span id="staffRole">Loading...</span></p>
        <p><strong>Created At:</strong> <span id="staffCreatedAt">Loading...</span></p>
        
        <!-- Update Email and Password Form -->
        <h3>Update Details</h3>
        <form id="updateAccountForm">
            <div class="form-group">
                <label for="newEmail">New Email:</label>
                <input type="email" id="newEmail" name="newEmail" required>
            </div>
            <div class="form-group">
                <label for="newPassword">New Password:</label>
                <input type="password" id="newPassword" name="newPassword" required>
            </div>
            <button type="button" onclick="updateAccount()">Update</button>
        </form>

        <!-- Go to Website Button -->
        <button class="btn-go-website" onclick="goToWebsite()">Go to Website</button>
    </div>
</div>




            <!-- Messages Section -->
<div id="messagesSection" class="content" style="display: none;">
    <h2 style="text-align: center; margin-top: 20px; font-size: 24px; color: #333;">Patient Messages</h2>

    <?php
    include 'db_connection.php';
    
    $sql = "SELECT * FROM messages ORDER BY created_at DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<table>';
        echo '<tr><th>ID</th><th>Name</th><th>Email</th><th>Subject</th><th>Message</th><th>Reply</th><th>Actions</th></tr>';

        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['id'] . '</td>';
            echo '<td>' . htmlspecialchars($row['name']) . '</td>';
            echo '<td>' . htmlspecialchars($row['email']) . '</td>';
            echo '<td>' . htmlspecialchars($row['subject']) . '</td>';
            echo '<td>' . htmlspecialchars($row['message']) . '</td>';
            echo '<td>' . (!empty($row['reply']) ? htmlspecialchars($row['reply']) : 'No reply yet') . '</td>';
            echo '<td>';
            echo '<button class="update" onclick=\'openReplyForm(' . json_encode($row) . ')\'>Reply</button>';
            echo '</td>';
            echo '</tr>';
        }

        echo '</table>';
    } else {
        echo '<p>No messages found.</p>';
    }

    $conn->close();
    ?>
</div>

<div id="replyForm" class="popup-form" style="display: none;">
    <div class="form-container">
        <h3>Reply to Message</h3>
        <form id="replyMessageForm">
            <input type="hidden" id="messageId" name="id">
            <div class="form-group">
                <label for="replyText">Reply</label>
                <textarea id="replyText" name="reply" required></textarea>
            </div>
            <button type="button" class="update" onclick="sendReply()">Send Reply</button>
            <button type="button" class="delete" onclick="closeReplyForm()">Cancel</button>
        </form>
    </div>
</div>

<!-- Reports Section -->
<div id="reportsSection" class="content" style="display: none;">
    <h2 style="text-align: center; margin-top: 20px; font-size: 24px; color: #333;">Patient Reports</h2>

    <div style="text-align: center; margin-bottom: 20px;">
        <label for="patientIdInput">Enter Patient ID:</label>
        <input type="number" id="patientIdInput" required>
        <button onclick="fetchPatientDetails()">Search</button>
    </div>

    <div id="patientDetails" style="display: none;">
        <h3>Patient Information</h3>
        <p><strong>Name:</strong> <span id="patientName"></span></p>
        <p><strong>Email:</strong> <span id="patientEmail"></span></p>
        <p><strong>Phone:</strong> <span id="patientPhone"></span></p>
        <p><strong>Address:</strong> <span id="patientAddress"></span></p>
    </div>

    <div id="appointmentDetails" style="display: none;">
        <h3>Appointments</h3>
        <table border="1" width="100%" cellpadding="10" style="border-collapse: collapse;">
            <thead>
                <tr>
                    <th>Appointment ID</th>
                    <th>Doctor</th>
                    <th>Time Slot</th>
                    <th>Payment Status</th>
                    <th>Report</th>
                </tr>
            </thead>
            <tbody id="appointmentTableBody"></tbody>
        </table>
    </div>
</div>

<!-- Upload Report Form -->
<div id="uploadReportForm" class="popup-form" style="display: none;">
    <div class="form-container">
        <h3>Upload Report</h3>
        <form id="reportUploadForm" enctype="multipart/form-data">
            <input type="hidden" id="reportPatientId">
            <input type="hidden" id="reportAppointmentId">
            <div class="form-group">
                <label for="reportFile">Select Report (PDF Only):</label>
                <input type="file" id="reportFile" name="reportFile" accept="application/pdf" required>
            </div>
            <button type="button" onclick="uploadReport()">Upload</button>
            <button type="button" onclick="closeUploadForm()">Cancel</button>
        </form>
    </div>
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

        function openPopup() {
    document.getElementById("popupForm").style.display = "flex";
}

function closePopup() {
    document.getElementById("popupForm").style.display = "none";
}

// Save new patient or update existing one
function savePatient() {
    let name = document.getElementById("name").value;
    let age = document.getElementById("age").value;
    let gender = document.getElementById("gender").value;
    let email = document.getElementById("email").value;
    let password = document.getElementById("password").value;
    let phone = document.getElementById("phone").value;
    let address = document.getElementById("address").value;

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "save_patient.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            alert(xhr.responseText);
            location.reload(); // Reload page after saving
        }
    };

    xhr.send(`name=${name}&age=${age}&gender=${gender}&email=${email}&password=${password}&phone=${phone}&address=${address}`);
}

// Update existing patient
function updatePatient() {
    let id = document.getElementById("patientId").value; // Get the patient ID
    let name = document.getElementById("name").value;
    let age = document.getElementById("age").value;
    let gender = document.getElementById("gender").value;
    let email = document.getElementById("email").value;
    let phone = document.getElementById("phone").value;
    let address = document.getElementById("address").value;

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "update_patient.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            alert(xhr.responseText);
            location.reload(); // Reload page after updating
        }
    };

    xhr.send(`id=${id}&name=${name}&age=${age}&gender=${gender}&email=${email}&phone=${phone}&address=${address}`);
}


// Delete patient
function deletePatient(id) {
    if (confirm("Are you sure you want to delete this patient?")) {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "delete_patient.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                alert(xhr.responseText);
                location.reload(); // Reload page after deletion
            }
        };

        xhr.send(`id=${id}`);
    }
}

// Open the update form and pre-fill data
function editPatient(id, name, age, gender, email, phone, address) {
    // Set the form values
    document.getElementById("name").value = name;
    document.getElementById("age").value = age;
    document.getElementById("gender").value = gender;
    document.getElementById("email").value = email;
    document.getElementById("phone").value = phone;
    document.getElementById("address").value = address;

    // Change form action to update
    document.getElementById("popupFormTitle").textContent = "Update Patient"; // Change form title
    document.getElementById("updateButton").style.display = "inline-block"; // Show update button
    document.getElementById("saveButton").style.display = "none"; // Hide save button (only for add new)
    
    // Save the patient ID in a hidden field for later use
    document.getElementById("patientId").value = id;

    // Show the popup
    openPopup();
}


    // Show the Doctor's Timetable in the Popup
    function viewTimetable(doctorId) {
        // Fetch the doctor's timetable from the database using AJAX
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "get_doctor_timetable.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Populate the timetable table with the response data
                let data = JSON.parse(xhr.responseText);
                let timetableTableBody = document.getElementById("timetableTableBody");
                timetableTableBody.innerHTML = ""; // Clear previous data

                data.forEach(row => {
                    let tr = document.createElement("tr");
                    tr.innerHTML = `
                        <td>${row.time_slot}</td>
                        <td>${row.day}</td>
                        <td>${row.task}</td>
                    `;
                    timetableTableBody.appendChild(tr);
                });

                // Open the timetable popup
                document.getElementById("timetablePopupForm").style.display = "flex";
            }
        };

        xhr.send(`doctor_id=${doctorId}`);
    }

    // Close the Timetable Popup
    function closeTimetablePopup() {
        document.getElementById("timetablePopupForm").style.display = "none";
    }

    // Open the Update Appointment Form
function openUpdateAppointmentForm(appointment) {
    document.getElementById('updateAppointmentForm').style.display = 'flex';
    document.getElementById('appointmentId').value = appointment.id;
    document.getElementById('appointmentPatientName').value = appointment.patient_name;
    document.getElementById('appointmentEmail').value = appointment.email;
    document.getElementById('appointmentMobile').value = appointment.mobile;
    document.getElementById('appointmentNic').value = appointment.nic;
    document.getElementById('appointmentPaymentStatus').value = appointment.payment_status;
}

// Close the Update Appointment Form
function closeUpdateAppointmentForm() {
    document.getElementById('updateAppointmentForm').style.display = 'none';
}

// Update Appointment
function updateAppointment() {
    const formData = new FormData(document.getElementById('appointmentUpdateForm'));

    fetch('update-appointment.php', {
        method: 'POST',
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
        closeUpdateAppointmentForm();
        location.reload();
    })
    .catch(error => console.error('Error updating appointment:', error));
}

// Delete Appointment
function deleteAppointment(appointmentId) {
    if (confirm('Are you sure you want to delete this appointment?')) {
        fetch(`delete-appointment.php?id=${appointmentId}`, { method: 'POST' })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            location.reload();
        })
        .catch(error => console.error('Error deleting appointment:', error));
    }
}

// Notify Patient via Email
function notifyPatient(email, patientName, doctorName, timeSlot) {
    const subject = `Appointment Reminder with Dr. ${doctorName}`;
    const body = `Hello ${patientName},\n\nThis is a reminder of your appointment with Dr. ${doctorName} at ${timeSlot}. Please be on time.\n\nThank you.`;

    window.location.href = `mailto:${email}?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(body)}`;
}

// Function to load chat messages
function loadMessages() {
    fetch('fetch-chat-messages.php')
        .then(response => response.json())
        .then(messages => {
            let chatBox = document.getElementById('chatBox');
            chatBox.innerHTML = '';

            messages.forEach(msg => {
                let messageDiv = document.createElement('div');
                messageDiv.classList.add('chat-message');
                messageDiv.innerHTML = `
                    <p><span class="sender">${msg.sender}:</span> ${msg.message}</p>
                    <p class="timestamp">${msg.category} - ${msg.created_at}</p>
                `;
                chatBox.appendChild(messageDiv);
            });

            chatBox.scrollTop = chatBox.scrollHeight;
        })
        .catch(error => console.error('Error loading messages:', error));
}

// Automatically refresh chat messages every 5 seconds
setInterval(() => {
    if (document.getElementById('chatSection').style.display === 'block') {
        loadMessages();
    }
}, 5000); // Adjust the time interval as needed

// Function to send a new message
function sendMessage() {
    let message = document.getElementById('chatMessage').value.trim();
    let category = document.getElementById('chatCategory').value;

    if (message === "") {
        alert("Message cannot be empty!");
        return;
    }

    let formData = new FormData();
    formData.append("message", message);
    formData.append("category", category);

    fetch('send-chat-message.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === "success") {
            document.getElementById('chatMessage').value = ""; // Clear input
            loadMessages(); // Reload chat messages
        } else {
            alert(data.message);
        }
    })
    .catch(error => console.error('Error sending message:', error));
}

// Fetch logged-in staff details and display them
function loadAccountDetails() {
    fetch('get-account-details.php')
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                // Update HTML with the fetched staff details
                document.getElementById('staffName').textContent = data.user.name;
                document.getElementById('staffEmail').textContent = data.user.email;
                document.getElementById('staffRole').textContent = data.user.role;
                document.getElementById('staffCreatedAt').textContent = data.user.created_at;
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Error fetching account details:', error);
            alert('There was an error fetching your account details.');
        });
}

// Call this function when the My Account section is displayed
document.addEventListener('DOMContentLoaded', () => {
    if (document.getElementById('accountSection').style.display === 'block') {
        loadAccountDetails();
    }
});

function showSection(sectionId) {
    const sections = document.querySelectorAll('.content');
    sections.forEach(section => section.style.display = 'none');

    const activeSection = document.getElementById(sectionId);
    if (activeSection) {
        activeSection.style.display = 'block';
        if (sectionId === 'accountSection') {
            loadAccountDetails(); // Fetch and display account details
        }
    }
}

function openReplyForm(message) {
    document.getElementById('replyForm').style.display = 'flex';
    document.getElementById('messageId').value = message.id;
}


function closeReplyForm() {
    document.getElementById('replyForm').style.display = 'none';
}

function sendReply() {
    const formData = new FormData(document.getElementById('replyMessageForm'));

    fetch('reply-message.php', { 
        method: 'POST', 
        body: formData 
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message); // Show response message
        closeReplyForm();
        location.reload();  // Reload to see updated reply
    })
    .catch(error => console.error('Error:', error));
}

// Fetch patient details and appointments
function fetchPatientDetails() {
    let patientId = document.getElementById("patientIdInput").value;

    if (patientId.trim() === "") {
        alert("Please enter a Patient ID.");
        return;
    }

    fetch(`fetch_patient_details.php?patient_id=${patientId}`)
        .then(response => response.json())
        .then(data => {
            if (data.status === "success") {
                document.getElementById("patientDetails").style.display = "block";
                document.getElementById("patientName").textContent = data.patient.name;
                document.getElementById("patientEmail").textContent = data.patient.email;
                document.getElementById("patientPhone").textContent = data.patient.phone;
                document.getElementById("patientAddress").textContent = data.patient.address;

                document.getElementById("appointmentDetails").style.display = "block";
                let appointmentTable = document.getElementById("appointmentTableBody");
                appointmentTable.innerHTML = "";

                data.appointments.forEach(appointment => {
                    let reportButton = appointment.report
                        ? `<a href="uploads/${appointment.report}" target="_blank">View Report</a>`
                        : `<button onclick="openUploadForm(${data.patient.id}, ${appointment.id})">Upload Report</button>`;

                    let row = `
                        <tr>
                            <td>${appointment.id}</td>
                            <td>${appointment.doctor}</td>
                            <td>${appointment.time_slot}</td>
                            <td>${appointment.payment_status}</td>
                            <td>${reportButton}</td>
                        </tr>`;
                    appointmentTable.innerHTML += row;
                });
            } else {
                alert(data.message);
            }
        })
        .catch(error => console.error("Error fetching patient details:", error));
}

// Open the Upload Report Form
function openUploadForm(patientId, appointmentId) {
    document.getElementById("uploadReportForm").style.display = "flex";
    document.getElementById("reportPatientId").value = patientId;
    document.getElementById("reportAppointmentId").value = appointmentId;
}

// Close the Upload Report Form
function closeUploadForm() {
    document.getElementById("uploadReportForm").style.display = "none";
}

// Upload Report via AJAX
function uploadReport() {
    let formData = new FormData();
    let fileInput = document.getElementById("reportFile");
    let patientId = document.getElementById("reportPatientId").value;
    let appointmentId = document.getElementById("reportAppointmentId").value;

    // Ensure a file is selected
    if (fileInput.files.length === 0) {
        alert("Please select a PDF file before uploading.");
        return;
    }

    formData.append("reportFile", fileInput.files[0]);
    formData.append("patient_id", patientId);
    formData.append("appointment_id", appointmentId);

    console.log("Uploading Report: ", formData);

    fetch("upload_report.php", {
        method: "POST",
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        console.log("Upload Response: ", data);
        alert(data.message);
        if (data.status === "success") {
            closeUploadForm();
            fetchPatientDetails(); // Refresh the report section
        }
    })
    .catch(error => {
        console.error("Error uploading report:", error);
        alert("Error uploading report. Check console for details.");
    });
}




    </script>
</body>

</html>
