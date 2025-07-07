<?php
session_start();
include 'db_connection.php'; // Include database connection

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    // Redirect to the signup page if accessed directly
    header("Location: signup.php");
    exit();
}

// Collect and sanitize user input
$name = trim($_POST['full-name']);
$email = trim($_POST['email']);
$password = trim($_POST['password']);
$confirmPassword = trim($_POST['confirm-password']);
$age = trim($_POST['age']);
$gender = trim($_POST['gender']);
$phone = trim($_POST['phone']);
$address = trim($_POST['address']);

// Validate inputs
if (empty($name) || empty($email) || empty($password) || empty($confirmPassword) || empty($age) || empty($gender) || empty($phone) || empty($address)) {
    echo "<script>alert('All fields are required.'); window.history.back();</script>";
    exit();
}

// Check if passwords match
if ($password !== $confirmPassword) {
    echo "<script>alert('Passwords do not match.'); window.history.back();</script>";
    exit();
}

// Check if email already exists
$checkSql = "SELECT * FROM Users WHERE email = ?";
$stmt = $conn->prepare($checkSql);
if (!$stmt) {
    die("Error in statement preparation: " . $conn->error);
}
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "<script>alert('Email already exists. Please use a different email.'); window.history.back();</script>";
    exit();
}

// Hash the password for security
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

// Insert new user into the database (users table)
$sql = "INSERT INTO Users (name, email, password, role) VALUES (?, ?, ?, 'Patient')";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Error in statement preparation: " . $conn->error);
}

$stmt->bind_param("sss", $name, $email, $hashedPassword);
$executeSuccess = $stmt->execute();

if ($executeSuccess) {
    // Insert patient details into the patients table
    $userId = $conn->insert_id; // Get the last inserted user ID

    $sqlPatient = "INSERT INTO patients (user_id, name, age, gender, email, phone, address) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmtPatient = $conn->prepare($sqlPatient);

    if (!$stmtPatient) {
        die("Error in patient statement preparation: " . $conn->error);
    }

    $stmtPatient->bind_param("isissss", $userId, $name, $age, $gender, $email, $phone, $address);
    $stmtPatient->execute();

    // Set session variables for the new user
    $_SESSION['user_id'] = $userId; // Store the user_id from the users table
    $_SESSION['user_name'] = $name;
    $_SESSION['user_email'] = $email;
    $_SESSION['user_role'] = 'Patient';

    // Redirect to the homepage with a success message
    header("Location: index.php?signup=success");
} else {
    echo "<script>alert('Registration failed. Please try again.'); window.history.back();</script>";
}

// Close the statement and connection
$stmt->close();
$stmtPatient->close();
$conn->close();
?>
