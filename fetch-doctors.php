<?php
include 'db_connection.php';

$sql = "SELECT * FROM doctors";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<table>';
    echo '<tr><th>ID</th><th>Name</th><th>Specialty</th><th>Email</th><th>Contact</th><th>Actions</th></tr>';

    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td>' . $row['name'] . '</td>';
        echo '<td>' . $row['specialty'] . '</td>';
        echo '<td>' . $row['email'] . '</td>';
        echo '<td>' . $row['contact_number'] . '</td>';
        echo '<td>';
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
