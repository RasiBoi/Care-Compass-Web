<?php
include 'db_connection.php';

$sql = "SELECT t.id, t.time_slot, t.day, t.task, d.name AS doctor_name 
        FROM timetable t 
        JOIN doctors d ON t.doctor_id = d.id 
        ORDER BY t.day, t.time_slot";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<br>';
    echo '<table style="margin: auto; width: 90%; border-collapse: collapse; text-align: left;">';
    echo '<thead>';
    echo '<tr style="background-color: #1e88e5; color: white;">';
    echo '<th>ID</th><th>Time Slot</th><th>Day</th><th>Task</th><th>Doctor Name</th><th>Actions</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($row['id']) . '</td>';
        echo '<td>' . htmlspecialchars($row['time_slot']) . '</td>';
        echo '<td>' . htmlspecialchars($row['day']) . '</td>';
        echo '<td>' . htmlspecialchars($row['task']) . '</td>';
        echo '<td>' . htmlspecialchars($row['doctor_name']) . '</td>';
        echo '<td>';
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
