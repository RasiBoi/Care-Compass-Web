<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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

/* Dashboard Cards Styling */
.dashboard-cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin: 30px auto;
    width: 90%;
}

.dashboard-card {
    background-color: #1e88e5;
    color: #fff;
    text-align: center;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    font-family: Arial, sans-serif;
    transition: transform 0.3s ease-in-out;
}

.dashboard-card:hover {
    transform: scale(1.05);
}

/* Chart Container */
canvas {
    margin-top: 20px;
    background: #f9f9f9;
    border-radius: 12px;
    padding: 15px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
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

/* Feedback Table Styling */
.feedback-container {
    width: 90%;
    margin: 20px auto;
}

#feedbackTable {
    width: 100%;
    border-collapse: collapse;
}

#feedbackTable th, #feedbackTable td {
    padding: 10px;
    border: 1px solid #ddd;
    text-align: center;
}

#feedbackTable th {
    background-color: #1e88e5;
    color: white;
}

.feedback-actions {
    display: flex;
    justify-content: center;
    gap: 10px;
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
    padding: 25px;
    border-radius: 12px;
    width: 400px;
    max-width: 90%;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
}

.form-group textarea, .form-group input {
    width: 100%;
    padding: 10px;
    border-radius: 8px;
    border: 1px solid #ccc;
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
    padding: 10px 15px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
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
                        <span class="title">Admin Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="#" onclick="showSection('dashboardSection')">
                        <span class="icon"><i class="fas fa-home"></i></span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="#" onclick="showSection('usersSection')">
                        <span class="icon"><i class="fas fa-users"></i></span>
                        <span class="title">Users</span>
                    </a>
                </li>
                <li>
                    <a href="#" onclick="showSection('doctorsSection')">
                        <span class="icon"><i class="fas fa-user-md"></i></span>
                        <span class="title">Doctors</span>
                    </a>
                </li>
                <li>
                    <a href="#" onclick="showSection('timetableSection')">
                        <span class="icon"><i class="fas fa-calendar-alt"></i></span>
                        <span class="title">TimeTable</span>
                    </a>
                </li>
                <li>
                    <a href="#" onclick="showSection('shopItemsSection')">
                        <span class="icon"><i class="fas fa-shopping-cart"></i></span>
                        <span class="title">Shop Items</span>
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
                    <a href="#" onclick="showSection('feedbackSection')">
                        <span class="icon"><i class="fas fa-comment-alt"></i></span>
                        <span class="title">Feedback</span>
                    </a>
                </li>
                <li>
                    <a href="#" onclick="confirmLogout(event)">
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
                    <i class=></i>
                </div>
                <div class="search">
                    <label>
                        <input type="text" id="searchInput" placeholder="Search">
                        <i class="fas fa-search"></i>
                    </label>
                </div>
                <div class="user">
                    <img src="assets/images/logo.png" alt="Admin">
                </div>
            </div>


    


            <!-- Users Section -->
            <div id="usersSection" class="content">
            <h2 style="text-align: center; margin-top: 20px; font-size: 24px; color: #333;">Users List</h2>
                <?php
                include 'db_connection.php';

                $sql = "SELECT * FROM users";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo '<table>';
                    echo '<tr><th>ID</th><th>Name</th><th>Email</th><th>Role</th><th>Actions</th></tr>';

                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $row['id'] . '</td>';
                        echo '<td>' . $row['name'] . '</td>';
                        echo '<td>' . $row['email'] . '</td>';
                        echo '<td>' . $row['role'] . '</td>';
                        echo '<td class="actions">';
                        echo '<button class="update" onclick=\'openUpdateForm(' . json_encode($row) . ')\'>Update</button>';
                        echo '<button class="delete" onclick="return confirm(\'Are you sure you want to delete this user?\') ? location.href=\'delete-user.php?id=' . $row['id'] . '\' : null;">Delete</button>';
                        echo '</td>';
                        echo '</tr>';
                    }

                    echo '</table>';
                } else {
                    echo '<p>No users found.</p>';
                }

                $conn->close();
                ?>

                <!-- Add New User Button -->
    <div style="text-align: center; margin-top: 20px;">
        <button class="update" onclick="openAddUserForm()">Add New User</button>
    </div>
            </div>

            <!-- Popup Form for Updating User -->
            <div id="updateForm" class="popup-form" style="display: none;">
                <div class="form-container">
                    <h3>Update User Details</h3>
                    <form id="userUpdateForm" method="POST" action="update-user.php">
                        <input type="hidden" id="userId" name="id">
                        <div class="form-group">
                            <label for="userName">Name</label>
                            <input type="text" id="userName" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="userEmail">Email</label>
                            <input type="email" id="userEmail" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="userRole">Role</label>
                            <select id="userRole" name="role" required>
                                <option value="Admin">Admin</option>
                                <option value="Staff">Staff</option>
                                <option value="Patient">Patient</option>
                            </select>
                        </div>
                        <button type="submit" class="update">Save Changes</button>
                        <button type="button" class="delete" onclick="closeUpdateForm()">Cancel</button>
                    </form>
                </div>
            </div>

            <div id="deleteDialog" class="popup-form" style="display: none;">
                <div class="form-container" style="text-align: center;">
                    <h3>Are you sure you want to delete this user?</h3>
                    <button id="confirmDeleteBtn" class="delete" style="margin-right: 10px;">Yes, Delete</button>
                    <button class="update" onclick="closeDeleteDialog()">Cancel</button>
                </div>
            </div>

            <!-- Add User Popup Form -->
<div id="addUserForm" class="popup-form" style="display: none;">
    <div class="form-container">
        <h3>Add New User</h3>
        <form id="userAddForm">
            <div class="form-group">
                <label for="addUserName">Name</label>
                <input type="text" id="addUserName" name="name" required>
            </div>
            <div class="form-group">
                <label for="addUserEmail">Email</label>
                <input type="email" id="addUserEmail" name="email" required>
            </div>
            <div class="form-group">
                <label for="addUserPassword">Password</label>
                <input type="password" id="addUserPassword" name="password" required>
            </div>
            <div class="form-group">
                <label for="addUserRole">Role</label>
                <select id="addUserRole" name="role" required>
                    <option value="Admin">Admin</option>
                    <option value="Staff">Staff</option>
                    <option value="Patient">Patient</option>
                </select>
            </div>
            <button type="button" class="update" onclick="addUser()">Add User</button>
            <button type="button" class="delete" onclick="closeAddUserForm()">Cancel</button>
        </form>
    </div>
</div>





            <!-- Doctors Section -->
            <div id="doctorsSection" class="content" style="display: none;">
            <h2 style="text-align: center; margin-top: 20px; font-size: 24px; color: #333;">Doctors List</h2>
    
            <?php
            include 'db_connection.php';

            $sql = "SELECT * FROM doctors";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo '<table>';
                echo '<tr><th>ID</th><th>Name</th><th>Specialty</th><th>Email</th><th>Contact</th><th>Actions</th></tr>';

                while ($row = $result->fetch_assoc()) {
                    echo '<tr data-id="' . $row['id'] . '">';
                    echo '<td>' . $row['id'] . '</td>';
                    echo '<td>' . $row['name'] . '</td>';
                    echo '<td>' . $row['specialty'] . '</td>';
                    echo '<td>' . $row['email'] . '</td>';
                    echo '<td>' . $row['contact_number'] . '</td>';
                    echo '<td class="actions">';
                    echo '<button class="update" onclick=\'openUpdateDoctorForm(' . json_encode($row) . ')\'>Update</button>';
                    echo '<button class="delete" onclick="deleteDoctor(' . $row['id'] . ')">Delete</button>';
                    echo '</td>';
                    echo '</tr>';
                }

                echo '</table>';
            } else {
                echo '<p>No doctors found.</p>';
            }

            $conn->close();
            ?>

            <!-- Add New Doctor Button -->
            <div style="text-align: center; margin-top: 20px;">
                <button class="update" onclick="openAddDoctorForm()">Add New Doctor</button>
            </div>
 

            <!-- Update Doctor Popup Form -->
<div id="updateDoctorForm" class="popup-form" style="display: none;">
    <div class="form-container">
        <h3>Update Doctor Details</h3>
        <form id="doctorUpdateForm" enctype="multipart/form-data">
            <input type="hidden" id="doctorId" name="id">
            <div class="form-group">
                <label for="doctorName">Name</label>
                <input type="text" id="doctorName" name="name" required>
            </div>
            <div class="form-group">
                <label for="doctorSpecialty">Specialty</label>
                <input type="text" id="doctorSpecialty" name="specialty" required>
            </div>
            <div class="form-group">
                <label for="doctorBio">Bio</label>
                <textarea id="doctorBio" name="bio" required></textarea>
            </div>
            <div class="form-group">
                <label for="doctorQualifications">Qualifications</label>
                <input type="text" id="doctorQualifications" name="qualifications" required>
            </div>
            <div class="form-group">
                <label for="doctorExperience">Experience (Years)</label>
                <input type="number" id="doctorExperience" name="experience_years" required>
            </div>
            <div class="form-group">
                <label for="doctorContact">Contact</label>
                <input type="text" id="doctorContact" name="contact_number" required>
            </div>
            <div class="form-group">
                <label for="doctorEmail">Email</label>
                <input type="email" id="doctorEmail" name="email" required>
            </div>
            <div class="form-group">
                <label for="doctorClinicAddress">Clinic Address</label>
                <input type="text" id="doctorClinicAddress" name="clinic_address" required>
            </div>
            <div class="form-group">
                <label for="doctorImage">Upload New Image (Optional)</label>
                <input type="file" id="doctorImage" name="image" accept="image/*">
            </div>
            <button type="button" class="update" onclick="updateDoctor()">Save Changes</button>
            <button type="button" class="delete" onclick="closeUpdateDoctorForm()">Cancel</button>
        </form>
    </div>
</div>

            <!-- Add New Doctor Popup Form -->
<div id="addDoctorForm" class="popup-form" style="display: none;">
    <div class="form-container">
        <h3>Add New Doctor</h3>
        <form id="doctorAddForm">
            <div class="form-group">
                <label for="addDoctorName">Name</label>
                <input type="text" id="addDoctorName" name="name" required>
            </div>
            <div class="form-group">
                <label for="addDoctorSpecialty">Specialty</label>
                <input type="text" id="addDoctorSpecialty" name="specialty" required>
            </div>
            <div class="form-group">
                <label for="addDoctorBio">Bio</label>
                <textarea id="addDoctorBio" name="bio" required></textarea>
            </div>
            <div class="form-group">
                <label for="addDoctorQualifications">Qualifications</label>
                <input type="text" id="addDoctorQualifications" name="qualifications" required>
            </div>
            <div class="form-group">
                <label for="addDoctorExperience">Experience (Years)</label>
                <input type="number" id="addDoctorExperience" name="experience_years" required>
            </div>
            <div class="form-group">
                <label for="addDoctorContact">Contact</label>
                <input type="text" id="addDoctorContact" name="contact_number" required>
            </div>
            <div class="form-group">
                <label for="addDoctorEmail">Email</label>
                <input type="email" id="addDoctorEmail" name="email" required>
            </div>
            <div class="form-group">
                <label for="addDoctorClinicAddress">Clinic Address</label>
                <input type="text" id="addDoctorClinicAddress" name="clinic_address" required>
            </div>
            <div class="form-group">
                <label for="addDoctorImageUrl">Image URL</label>
                <input type="url" id="addDoctorImageUrl" name="image_path" required>
            </div>
            <button type="button" class="update" onclick="addDoctor()">Add Doctor</button>
            <button type="button" class="delete" onclick="closeAddDoctorForm()">Cancel</button>
        </form>
    </div>
</div>


        </div>

            <!-- Shop Items Section -->
<div id="shopItemsSection" class="content" style="display: none;">
    <h2 style="text-align: center; margin-top: 20px; font-size: 24px; color: #333;">Shop Items Management</h2>

    <!-- Display Shop Items -->
    <?php
    include 'db_connection.php';

    $sql = "SELECT * FROM shop_items";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<table>';
        echo '<thead>';
        echo '<tr>';
        echo '<th>ID</th>';
        echo '<th>Name</th>';
        echo '<th>Description</th>';
        echo '<th>Price</th>';
        echo '<th>Image</th>';
        echo '<th>Actions</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['id'] . '</td>';
            echo '<td>' . htmlspecialchars($row['name']) . '</td>';
            echo '<td>' . htmlspecialchars($row['description']) . '</td>';
            echo '<td>' . htmlspecialchars($row['price']) . '</td>';
            echo '<td><img src="' . htmlspecialchars($row['image']) . '" alt="Item Image" width="50"></td>';
            echo '<td>';
            echo '<button class="update" onclick=\'openUpdateShopItemForm(' . json_encode($row) . ')\'>Update</button>';
            echo '<button class="delete" onclick="deleteShopItem(' . $row['id'] . ')">Delete</button>';
            echo '</td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
    } else {
        echo '<p>No shop items found.</p>';
    }

    $conn->close();
    ?>

    <!-- Add New Shop Item Button -->
    <div style="text-align: center; margin-top: 20px;">
        <button class="update" onclick="openAddShopItemForm()">Add New Item</button>
    </div>
</div>

<!-- Update Shop Item Popup Form -->
<div id="updateShopItemForm" class="popup-form" style="display: none;">
    <div class="form-container">
        <h3>Update Shop Item</h3>
        <form id="shopItemUpdateForm">
            <input type="hidden" id="shopItemId" name="id">
            <div class="form-group">
                <label for="shopItemName">Name</label>
                <input type="text" id="shopItemName" name="name" required>
            </div>
            <div class="form-group">
                <label for="shopItemDescription">Description</label>
                <textarea id="shopItemDescription" name="description" required></textarea>
            </div>
            <div class="form-group">
                <label for="shopItemPrice">Price</label>
                <input type="number" id="shopItemPrice" name="price" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="shopItemImageUrl">Image URL</label>
                <input type="url" id="shopItemImageUrl" name="image" required>
            </div>
            <button type="button" class="update" onclick="updateShopItem()">Save Changes</button>
            <button type="button" class="delete" onclick="closeUpdateShopItemForm()">Cancel</button>
        </form>
    </div>
</div>

<!-- Add New Shop Item Popup Form -->
<div id="addShopItemForm" class="popup-form" style="display: none;">
    <div class="form-container">
        <h3>Add New Shop Item</h3>
        <form id="shopItemAddForm">
            <div class="form-group">
                <label for="newShopItemName">Name</label>
                <input type="text" id="newShopItemName" name="name" required>
            </div>
            <div class="form-group">
                <label for="newShopItemDescription">Description</label>
                <textarea id="newShopItemDescription" name="description" required></textarea>
            </div>
            <div class="form-group">
                <label for="newShopItemPrice">Price</label>
                <input type="number" id="newShopItemPrice" name="price" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="newShopItemImageUrl">Image URL</label>
                <input type="url" id="newShopItemImageUrl" name="image" required>
            </div>
            <button type="button" class="update" onclick="addShopItem()">Add Item</button>
            <button type="button" class="delete" onclick="closeAddShopItemForm()">Cancel</button>
        </form>
    </div>
</div>




<!-- Timetable Section -->
<div id="timetableSection" class="content" style="display: none;">
    <h2 style="text-align: center; margin-top: 20px; font-size: 24px; color: #333;">Timetable Management</h2>

    <!-- Display Timetable -->
    <?php
    include 'db_connection.php';

    // Query to fetch timetable data along with doctor names
    $sql = "SELECT t.id, t.time_slot, t.day, t.task, d.name AS doctor_name 
            FROM timetable t 
            JOIN doctors d ON t.doctor_id = d.id 
            ORDER BY t.day, t.time_slot";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<table>';
        echo '<thead>';
        echo '<tr style="background-color: #1e88e5; color: white;">';
        echo '<th style="padding: 10px;">ID</th>';
        echo '<th style="padding: 10px;">Time Slot</th>';
        echo '<th style="padding: 10px;">Day</th>';
        echo '<th style="padding: 10px;">Task</th>';
        echo '<th style="padding: 10px;">Doctor Name</th>';
        echo '<th style="padding: 10px; text-align: center;">Actions</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td style="padding: 10px; border: 1px solid #ddd;">' . htmlspecialchars($row['id']) . '</td>';
            echo '<td style="padding: 10px; border: 1px solid #ddd;">' . htmlspecialchars($row['time_slot']) . '</td>';
            echo '<td style="padding: 10px; border: 1px solid #ddd;">' . htmlspecialchars($row['day']) . '</td>';
            echo '<td style="padding: 10px; border: 1px solid #ddd;">' . htmlspecialchars($row['task']) . '</td>';
            echo '<td style="padding: 10px; border: 1px solid #ddd;">' . htmlspecialchars($row['doctor_name']) . '</td>';
            echo '<td style="padding: 10px; text-align: center; border: 1px solid #ddd;">';
            echo '<button class="update" onclick=\'openUpdateTaskForm(' . json_encode($row) . ')\'>Update</button> ';
            echo '<button class="delete" onclick="deleteTask(' . $row['id'] . ')">Delete</button>';
            echo '</td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
    } else {
        echo '<p style="text-align: center;">No tasks found in the timetable.</p>';
    }

    $conn->close();
    ?>

    <!-- Add Task Button -->
    <div style="text-align: center; margin-top: 20px;">
        <button class="update" onclick="openAddTaskForm()">Add Task</button>
    </div>
</div>

<!-- Update Task Popup Form -->
<div id="updateTaskForm" class="popup-form" style="display: none;">
    <div class="form-container">
        <h3>Update Task</h3>
        <form id="taskUpdateForm">
            <input type="hidden" id="taskId" name="id">
            <div class="form-group">
                <label for="taskTimeSlot">Time Slot</label>
                <input type="text" id="taskTimeSlot" name="time_slot" required>
            </div>
            <div class="form-group">
                <label for="taskDay">Day</label>
                <select id="taskDay" name="day" required>
                    <option value="Monday">Monday</option>
                    <option value="Tuesday">Tuesday</option>
                    <option value="Wednesday">Wednesday</option>
                    <option value="Thursday">Thursday</option>
                    <option value="Friday">Friday</option>
                    <option value="Saturday">Saturday</option>
                    <option value="Sunday">Sunday</option>
                </select>
            </div>
            <div class="form-group">
                <label for="taskName">Task</label>
                <input type="text" id="taskName" name="task" required>
            </div>
            <div class="form-group">
                <label for="taskDoctorId">Doctor</label>
                <select id="taskDoctorId" name="doctor_id" required>
                    <?php
                    include 'db_connection.php';
                    $doctorQuery = "SELECT id, name FROM doctors";
                    $doctorResult = $conn->query($doctorQuery);

                    while ($doctor = $doctorResult->fetch_assoc()) {
                        echo '<option value="' . $doctor['id'] . '">' . htmlspecialchars($doctor['name']) . '</option>';
                    }

                    $conn->close();
                    ?>
                </select>
            </div>
            <button type="button" class="update" onclick="updateTask()">Save Changes</button>
            <button type="button" class="delete" onclick="closeUpdateTaskForm()">Cancel</button>
        </form>
    </div>
</div>

<!-- Add Task Popup Form -->
<div id="addTaskForm" class="popup-form" style="display: none;">
    <div class="form-container">
        <h3>Add New Task</h3>
        <form id="taskAddForm">
            <div class="form-group">
                <label for="addTaskTimeSlot">Time Slot</label>
                <input type="text" id="addTaskTimeSlot" name="time_slot" required>
            </div>
            <div class="form-group">
                <label for="addTaskDay">Day</label>
                <select id="addTaskDay" name="day" required>
                    <option value="Monday">Monday</option>
                    <option value="Tuesday">Tuesday</option>
                    <option value="Wednesday">Wednesday</option>
                    <option value="Thursday">Thursday</option>
                    <option value="Friday">Friday</option>
                    <option value="Saturday">Saturday</option>
                    <option value="Sunday">Sunday</option>
                </select>
            </div>
            <div class="form-group">
                <label for="addTaskName">Task</label>
                <input type="text" id="addTaskName" name="task" required>
            </div>
            <div class="form-group">
                <label for="addTaskDoctorId">Doctor</label>
                <select id="addTaskDoctorId" name="doctor_id" required>
                    <?php
                    include 'db_connection.php';
                    $doctorQuery = "SELECT id, name FROM doctors";
                    $doctorResult = $conn->query($doctorQuery);

                    while ($doctor = $doctorResult->fetch_assoc()) {
                        echo '<option value="' . $doctor['id'] . '">' . htmlspecialchars($doctor['name']) . '</option>';
                    }

                    $conn->close();
                    ?>
                </select>
            </div>
            <button type="button" class="update" onclick="addTask()">Add Task</button>
            <button type="button" class="delete" onclick="closeAddTaskForm()">Cancel</button>
        </form>
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

<!-- Chat Section -->
<div id="chatSection" class="content" style="display: none;">
    <h2 style="text-align: center; margin-top: 20px;">Group Chat</h2>

    <!-- Chat Messages Display -->
    <div id="chatBox" class="chat-box"></div>

    <!-- Chat Input Form -->
    <div class="chat-input-container">
        <select id="chatCategory" class="chat-category">
            <option value="General">General</option>
            <option value="Birthday">Birthday Wishes</option>
            <option value="Leave">Leave Messages</option>
            <option value="Bonus">Bonus Messages</option>
            <option value="Salary">Salary Messages</option>
            <option value="Notice">Important Notices</option>
        </select>
        <input type="text" id="chatMessage" placeholder="Type your message..." class="chat-input">
        <button onclick="sendMessage()" class="chat-send-btn">Send</button>
    </div>
</div>


<!-- Feedback Section -->
<div id="feedbackSection" class="content" style="display: none;">
    <h2 style="text-align: center; margin-top: 20px;">Feedback Management</h2>

    <!-- Display Feedback Table -->
    <div class="feedback-container">
        <table id="feedbackTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Feedback</th>
                    <th>Author</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Feedback rows will be dynamically loaded here -->

            </tbody>
        </table>
    </div>
<!-- Add New Feedback Button -->
<div style="text-align: center; margin-top: 20px;">
    <button class="update" onclick="openAddFeedbackForm()">Add New Feedback</button>
</div>
    

</div>

<!-- Update Feedback Popup Form -->
<div id="updateFeedbackForm" class="popup-form" style="display: none;">
    <div class="form-container">
        <h3>Update Feedback</h3>
        <form id="feedbackUpdateForm">
            <input type="hidden" id="feedbackId" name="id">
            <div class="form-group">
                <label for="feedbackContent">Feedback</label>
                <textarea id="feedbackContent" name="content" required></textarea>
            </div>
            <div class="form-group">
                <label for="feedbackAuthor">Author</label>
                <input type="text" id="feedbackAuthor" name="author" required>
            </div>
            <button type="button" class="update" onclick="updateFeedback()">Save Changes</button>
            <button type="button" class="delete" onclick="closeUpdateFeedbackForm()">Cancel</button>
        </form>
    </div>
</div>

<!-- Add Feedback Popup Form -->
<div id="addFeedbackForm" class="popup-form" style="display: none;">
    <div class="form-container">
        <h3>Add New Feedback</h3>
        <form id="feedbackAddForm">
            <div class="form-group">
                <label for="addFeedbackContent">Feedback</label>
                <textarea id="addFeedbackContent" name="content" required></textarea>
            </div>
            <div class="form-group">
                <label for="addFeedbackAuthor">Author</label>
                <input type="text" id="addFeedbackAuthor" name="author" required>
            </div>
            <button type="button" class="update" onclick="addFeedback()">Submit Feedback</button>
            <button type="button" class="delete" onclick="closeAddFeedbackForm()">Cancel</button>
        </form>
    </div>
</div>








        </div>
    </div>

    <!-- Scripts -->
    <script>

// Function to show only the selected section and hide others
function showSection(sectionId) {
    const sections = document.querySelectorAll('.content');
    sections.forEach(section => section.style.display = 'none'); // Hide all sections

    const activeSection = document.getElementById(sectionId);
    if (activeSection) {
        activeSection.style.display = 'block'; // Show the selected section
    }

    // If opening the dashboard, load data immediately
    if (sectionId === 'dashboardSection') {
        loadDashboardData();
    }

    // Store the last viewed section in localStorage
    localStorage.setItem('lastViewedSection', sectionId);
}

// Function to load the dashboard by default when the page loads
document.addEventListener("DOMContentLoaded", function () {
    const lastViewed = localStorage.getItem('lastViewedSection') || 'dashboardSection';
    showSection(lastViewed); // Show the last viewed section or default to Dashboard

    // Ensure dashboard data loads immediately on first load
    if (lastViewed === 'dashboardSection') {
        loadDashboardData();
    }
});




    document.getElementById("searchInput").addEventListener("input", function () {
    const searchValue = this.value.toLowerCase().trim();

    fetch(`search-doctor.php?name=${searchValue}`)
        .then((response) => response.json())
        .then((data) => {
            if (data.length > 0) {
                let doctor = data[0];
                alert(
                    `Doctor Found:\n\nName: ${doctor.name}\nSpecialty: ${doctor.specialty}\nEmail: ${doctor.email}\nContact: ${doctor.contact_number}`
                );
            } else {
                alert("No doctor found.");
            }
        });
});

const toggle = document.querySelector('.toggle');
const navigation = document.querySelector('.navigation');
const main = document.querySelector('.main');

toggle.addEventListener('click', () => {
    navigation.classList.toggle('active');
    main.classList.toggle('active');
});

function contactUser(email) {
        const subject = prompt("Enter the subject for your email:");
        const body = prompt("Enter your message:");

        if (subject && body) {
            // Construct a mailto link
            const mailtoLink = `mailto:${email}?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(body)}`;
            window.location.href = mailtoLink;
        } else {
            alert("Both subject and message are required to send an email.");
        }
    }

    // Function to open the popup form and populate it with user details
function openUpdateForm(user) {
    document.getElementById('updateForm').style.display = 'flex';
    document.getElementById('userId').value = user.id;
    document.getElementById('userName').value = user.name;
    document.getElementById('userEmail').value = user.email;
    document.getElementById('userRole').value = user.role;
}

// Function to close the popup form
function closeUpdateForm() {
    document.getElementById('updateForm').style.display = 'none';
}

let userIdToDelete = null;

    // Function to open the delete confirmation dialog
    function confirmDelete(userId) {
        userIdToDelete = userId; // Store the user ID to delete
        document.getElementById('deleteDialog').style.display = 'flex';
    }

    // Function to close the delete confirmation dialog
    function closeDeleteDialog() {
        userIdToDelete = null; // Reset the stored user ID
        document.getElementById('deleteDialog').style.display = 'none';
    }

    // Function to proceed with the delete
    document.getElementById('confirmDeleteBtn').addEventListener('click', () => {
        if (userIdToDelete) {
            // Redirect to the delete-user.php with the user ID
            window.location.href = `delete-user.php?id=${userIdToDelete}`;
        }
    });


    // Open the Update Doctor Form and populate it with the selected doctor's details
function openUpdateDoctorForm(doctor) {
    document.getElementById('updateDoctorForm').style.display = 'flex';
    document.getElementById('doctorId').value = doctor.id;
    document.getElementById('doctorName').value = doctor.name;
    document.getElementById('doctorSpecialty').value = doctor.specialty;
    document.getElementById('doctorBio').value = doctor.bio;
    document.getElementById('doctorQualifications').value = doctor.qualifications;
    document.getElementById('doctorExperience').value = doctor.experience_years;
    document.getElementById('doctorContact').value = doctor.contact_number;
    document.getElementById('doctorEmail').value = doctor.email;
    document.getElementById('doctorClinicAddress').value = doctor.clinic_address;
}

// Close the Update Doctor Form
function closeUpdateDoctorForm() {
    document.getElementById('updateDoctorForm').style.display = 'none';
}

function updateDoctor() {
    const formData = new FormData(document.getElementById('doctorUpdateForm'));

    fetch('update-doctor.php', {
        method: 'POST',
        body: formData,
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.status === 'success') {
                alert('Doctor updated successfully.');
                closeUpdateDoctorForm();
                reloadDoctorTable(); // Refresh the table dynamically
            } else {
                alert('Error updating doctor: ' + data.message);
            }
        })
        .catch((error) => {
            console.error('Error updating doctor:', error);
        });
}

// Dynamically reload the doctor table
function reloadDoctorTable() {
    fetch('fetch-doctors.php')
        .then((response) => response.text())
        .then((html) => {
            document.getElementById('doctorsSection').innerHTML = html;
        })
        .catch((error) => console.error('Error reloading doctor table:', error));
}

    // Function to delete a doctor with confirmation
function deleteDoctor(doctorId) {
    const confirmed = confirm('Are you sure you want to delete this doctor?');
    if (confirmed) {
        fetch(`delete-doctor.php?id=${doctorId}`, {
            method: 'POST'
        })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    alert('Doctor deleted successfully.');
                    reloadDoctorTable(); // Refresh the doctor table
                } else {
                    alert('Error deleting doctor: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error deleting doctor:', error);
            });
    }
}

// Function to reload the doctor table dynamically
function reloadDoctorTable() {
    fetch('fetch-doctors.php') // A PHP file to fetch the updated table
        .then(response => response.text())
        .then(html => {
            document.getElementById('doctorsTable').innerHTML = html;
        })
        .catch(error => {
            console.error('Error reloading doctor table:', error);
        });
}

// Open the Add Doctor Form
function openAddDoctorForm() {
    document.getElementById('addDoctorForm').style.display = 'flex';
}

// Close the Add Doctor Form
function closeAddDoctorForm() {
    document.getElementById('addDoctorForm').style.display = 'none';
}

// Add Doctor Function
function addDoctor() {
    const formData = new FormData(document.getElementById('doctorAddForm'));

    fetch('add-doctor.php', {
        method: 'POST',
        body: formData,
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.status === 'success') {
                alert('Doctor added successfully.');
                closeAddDoctorForm();
                reloadDoctorTable(); // Refresh the table dynamically
            } else {
                alert('Error adding doctor: ' + data.message);
            }
        })
        .catch((error) => {
            console.error('Error adding doctor:', error);
        });
}

// Reload the doctor table dynamically
function reloadDoctorTable() {
    fetch('fetch-doctors.php') // Fetch the updated doctors table
        .then((response) => response.text())
        .then((html) => {
            document.getElementById('doctorsSection').innerHTML = html;
        })
        .catch((error) => console.error('Error reloading doctor table:', error));
}

// Open Add Shop Item Form
function openAddShopItemForm() {
    document.getElementById('addShopItemForm').style.display = 'flex';
}

// Close Add Shop Item Form
function closeAddShopItemForm() {
    document.getElementById('addShopItemForm').style.display = 'none';
}

// Add New Shop Item
function addShopItem() {
    const formData = new FormData(document.getElementById('shopItemAddForm'));

    fetch('add-shop-item.php', {
        method: 'POST',
        body: formData,
    })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                alert('Shop item added successfully.');
                closeAddShopItemForm();
                reloadShopItemsTable();
            } else {
                alert('Error adding shop item: ' + data.message);
            }
        })
        .catch(error => console.error('Error adding shop item:', error));
}

// Open Update Shop Item Form
function openUpdateShopItemForm(item) {
    document.getElementById('updateShopItemForm').style.display = 'flex';
    document.getElementById('shopItemId').value = item.id;
    document.getElementById('shopItemName').value = item.name;
    document.getElementById('shopItemDescription').value = item.description;
    document.getElementById('shopItemPrice').value = item.price;
    document.getElementById('shopItemImageUrl').value = item.image;
}

// Close Update Shop Item Form
function closeUpdateShopItemForm() {
    document.getElementById('updateShopItemForm').style.display = 'none';
}

// Update Shop Item
function updateShopItem() {
    const formData = new FormData(document.getElementById('shopItemUpdateForm'));

    fetch('update-shop-item.php', {
        method: 'POST',
        body: formData,
    })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                alert('Shop item updated successfully.');
                closeUpdateShopItemForm();
                reloadShopItemsTable();
            } else {
                alert('Error updating shop item: ' + data.message);
            }
        })
        .catch(error => console.error('Error updating shop item:', error));
}

// Delete Shop Item
function deleteShopItem(itemId) {
    if (confirm('Are you sure you want to delete this item?')) {
        fetch(`delete-shop-item.php?id=${itemId}`, { method: 'POST' })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    alert('Shop item deleted successfully.');
                    reloadShopItemsTable();
                } else {
                    alert('Error deleting shop item: ' + data.message);
                }
            })
            .catch(error => console.error('Error deleting shop item:', error));
    }
}

// Reload Shop Items Table
function reloadShopItemsTable() {
    fetch('fetch-shop-items.php')
        .then(response => response.text())
        .then(html => {
            document.getElementById('shopItemsSection').innerHTML = html;
        })
        .catch(error => console.error('Error reloading shop items table:', error));
}

// Function to load dashboard data
function loadDashboardData() {
    fetch('fetch-dashboard-data.php')
        .then(response => response.json())
        .then(data => {
            // Populate the counts
            document.getElementById('usersCount').innerText = data.usersCount;
            document.getElementById('doctorsCount').innerText = data.doctorsCount;
        })
        .catch(error => console.error('Error fetching dashboard data:', error));
}

// Call the function when the dashboard section is shown
document.querySelector('a[onclick="showSection(\'dashboardSection\')"]').addEventListener('click', loadDashboardData);

    // Functions for managing tasks
    function openUpdateTaskForm(task) {
        document.getElementById('updateTaskForm').style.display = 'flex';
        document.getElementById('taskId').value = task.id;
        document.getElementById('taskTimeSlot').value = task.time_slot;
        document.getElementById('taskDay').value = task.day;
        document.getElementById('taskName').value = task.task;
        document.getElementById('taskDoctorId').value = task.doctor_id;
    }

    function closeUpdateTaskForm() {
        document.getElementById('updateTaskForm').style.display = 'none';
    }

    function updateTask() {
        const formData = new FormData(document.getElementById('taskUpdateForm'));

        fetch('update-task.php', {
            method: 'POST',
            body: formData,
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.status === 'success') {
                    alert('Task updated successfully.');
                    closeUpdateTaskForm();
                    location.reload(); // Reload to see the changes
                } else {
                    alert('Error updating task: ' + data.message);
                }
            })
            .catch((error) => {
                console.error('Error updating task:', error);
            });
    }

    function openAddTaskForm() {
        document.getElementById('addTaskForm').style.display = 'flex';
    }

    function closeAddTaskForm() {
        document.getElementById('addTaskForm').style.display = 'none';
    }

    function addTask() {
    const formData = new FormData(document.getElementById('taskAddForm'));

    fetch('add-task.php', {
        method: 'POST',
        body: formData,
    })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                alert('Task added successfully.');
                closeAddTaskForm();
                reloadTimetable(); // Dynamically reload the timetable
            } else {
                alert('Error adding task: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error adding task:', error);
        });
}

// Function to dynamically reload the timetable
function reloadTimetable() {
    fetch('fetch-timetable.php') // Fetch the updated timetable
        .then(response => response.text())
        .then(html => {
            document.getElementById('timetableSection').innerHTML = html;
        })
        .catch(error => console.error('Error reloading timetable:', error));
}


    function deleteTask(taskId) {
        if (confirm('Are you sure you want to delete this task?')) {
            fetch(`delete-task.php?id=${taskId}`, {
                method: 'POST',
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.status === 'success') {
                        alert('Task deleted successfully.');
                        location.reload(); // Reload to see the changes
                    } else {
                        alert('Error deleting task: ' + data.message);
                    }
                })
                .catch((error) => {
                    console.error('Error deleting task:', error);
                });
        }
    }

    // Open the Add User Form
function openAddUserForm() {
    document.getElementById('addUserForm').style.display = 'flex';
}

// Close the Add User Form
function closeAddUserForm() {
    document.getElementById('addUserForm').style.display = 'none';
}

// Add User Function
function addUser() {
    const formData = new FormData(document.getElementById('userAddForm'));

    fetch('add-user.php', {
        method: 'POST',
        body: formData,
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.status === 'success') {
                alert('User added successfully.');
                closeAddUserForm();
                location.reload(); // Reload to show the updated user list
            } else {
                alert('Error adding user: ' + data.message);
            }
        })
        .catch((error) => {
            console.error('Error adding user:', error);
        });
}

// Delete User Function
function deleteUser(userId) {
    if (confirm('Are you sure you want to delete this user?')) {
        fetch(`delete-user.php?id=${userId}`, {
            method: 'POST',
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.status === 'success') {
                    alert('User deleted successfully.');
                    location.reload(); // Reload to see the updated list
                } else {
                    alert('Error deleting user: ' + data.message);
                }
            })
            .catch((error) => {
                console.error('Error deleting user:', error);
            });
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

function loadMessages() {
    fetch('fetch-messages.php')
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

function loadFeedback() {
    fetch('fetch-feedback.php')
        .then(response => response.json())
        .then(feedback => {
            let feedbackTable = document.querySelector("#feedbackTable tbody");
            feedbackTable.innerHTML = '';

            feedback.forEach(fb => {
                let row = `
                    <tr>
                        <td>${fb.id}</td>
                        <td>${fb.content}</td>
                        <td>${fb.author}</td>
                        <td>${fb.created_at}</td>
                        <td class="feedback-actions">
                            <button class="update" onclick='openUpdateFeedbackForm(${JSON.stringify(fb)})'>Update</button>
                            <button class="delete" onclick="deleteFeedback(${fb.id})">Delete</button>
                        </td>
                    </tr>
                `;
                feedbackTable.innerHTML += row;
            });
        })
        .catch(error => console.error('Error loading feedback:', error));
}

// Automatically refresh feedback every 10 seconds
setInterval(() => {
    if (document.getElementById('feedbackSection').style.display === 'block') {
        loadFeedback();
    }
}, 10000); // Adjust the time interval as needed


// Load messages when the chat section is opened
document.querySelector('a[onclick="showSection(\'chatSection\')"]').addEventListener('click', loadMessages);

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

    fetch('send-message.php', {
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

// Load feedback when the section is opened


// Open the Update Feedback Form
function openUpdateFeedbackForm(feedback) {
    document.getElementById('updateFeedbackForm').style.display = 'flex';
    document.getElementById('feedbackId').value = feedback.id;
    document.getElementById('feedbackContent').value = feedback.content;
    document.getElementById('feedbackAuthor').value = feedback.author;
}

// Close the Update Feedback Form
function closeUpdateFeedbackForm() {
    document.getElementById('updateFeedbackForm').style.display = 'none';
}

// Update Feedback
function updateFeedback() {
    let formData = new FormData(document.getElementById('feedbackUpdateForm'));

    fetch('update-feedback.php', { method: 'POST', body: formData })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            closeUpdateFeedbackForm();
            loadFeedback();
        })
        .catch(error => console.error('Error updating feedback:', error));
}

// Delete Feedback
function deleteFeedback(id) {
    if (confirm("Are you sure you want to delete this feedback?")) {
        fetch(`delete-feedback.php?id=${id}`, { method: 'GET' })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                loadFeedback();
            })
            .catch(error => console.error('Error deleting feedback:', error));
    }
}

// Load feedback when the section is opened
document.querySelector('a[onclick="showSection(\'feedbackSection\')"]').addEventListener('click', loadFeedback);

// Open the Add Feedback Form
function openAddFeedbackForm() {
    document.getElementById('addFeedbackForm').style.display = 'flex';
}

// Close the Add Feedback Form
function closeAddFeedbackForm() {
    document.getElementById('addFeedbackForm').style.display = 'none';
}

// Add Feedback
function addFeedback() {
    let formData = new FormData(document.getElementById('feedbackAddForm'));

    fetch('add-feedback.php', { method: 'POST', body: formData })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            closeAddFeedbackForm();
            loadFeedback(); // Reload feedback table
        })
        .catch(error => console.error('Error adding feedback:', error));
}

function confirmLogout(event) {
    event.preventDefault(); // Prevent the default link behavior

    let isConfirmed = confirm("Are you sure you want to log out?");
    if (isConfirmed) {
        window.location.href = "logout.php"; // Redirect to logout page
    }
}

document.getElementById("searchInput").addEventListener("input", function () {
    const query = this.value.toLowerCase().trim();
    const activeSection = document.querySelector('.content:not([style*="display: none"])'); // Find the currently active section

    if (!activeSection) return;

    const table = activeSection.querySelector("table"); // Get the table inside the active section

    if (table) {
        const rows = table.querySelectorAll("tbody tr");

        rows.forEach(row => {
            const cells = row.querySelectorAll("td");
            let match = false;

            cells.forEach(cell => {
                if (cell.innerText.toLowerCase().includes(query)) {
                    match = true;
                }
            });

            if (match) {
                row.style.display = ""; // Show row if it matches
                row.style.backgroundColor = "#ffff99"; // Highlight matching rows
            } else {
                row.style.display = "none"; // Hide non-matching rows
            }
        });
    }
});

document.addEventListener("DOMContentLoaded", function () {
    const lastViewed = localStorage.getItem('lastViewedSection') || 'dashboardSection';
    showSection(lastViewed); // Show the last viewed section or default to Dashboard

    if (lastViewed === 'dashboardSection') {
        loadDashboardData();
    } else if (lastViewed === 'chatSection') {
        loadMessages();
    } else if (lastViewed === 'feedbackSection') {
        loadFeedback();
    }
});

// Modify showSection function to load data dynamically when a section is opened
function showSection(sectionId) {
    const sections = document.querySelectorAll('.content');
    sections.forEach(section => section.style.display = 'none'); // Hide all sections

    const activeSection = document.getElementById(sectionId);
    if (activeSection) {
        activeSection.style.display = 'block'; // Show the selected section
    }

    // Load data dynamically when sections are opened
    if (sectionId === 'dashboardSection') {
        loadDashboardData();
    } else if (sectionId === 'chatSection') {
        loadMessages();
    } else if (sectionId === 'feedbackSection') {
        loadFeedback();
    }

    localStorage.setItem('lastViewedSection', sectionId);
}



    </script>
</body>

</html>
