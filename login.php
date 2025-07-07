<?php
session_start();
include 'db_connection.php'; // Include the database connection

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    // Redirect to the login page if accessed directly
    header("Location: login.php");
    exit();
}

$email = trim($_POST['email']);
$password = trim($_POST['password']);

// Validate the inputs
if (empty($email) || empty($password)) {
    echo "<script>alert('Please fill out all fields.'); window.history.back();</script>";
    exit();
}

// Prepare SQL to fetch user details
$sql = "SELECT * FROM Users WHERE email = ?";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Error in statement preparation: " . $conn->error);
}
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

// Check if the user exists
if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    // Verify the password
    if ($password === $user['password']) { // Direct comparison for testing
        // Set session variables
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_role'] = $user['role'];

        // Redirect based on user role
        switch ($user['role']) {
            case 'Admin':
                header("Location: admin-dashboard.php");
                break;
            case 'Staff':
                header("Location: staff-dashboard.php");
                break;
            case 'Patient':
                // Redirect patients back to the homepage
                header("Location: index.php");
                break;
            default:
                echo "<script>alert('Invalid user role.'); window.history.back();</script>";
                break;
        }
    } else {
        // Invalid password
        echo "<script>alert('Invalid password. Please try again.'); window.history.back();</script>";
    }
} else {
    // No user found
    echo "<script>alert('No user found with this email address.'); window.history.back();</script>";
}

// Close connections
$stmt->close();
$conn->close();
