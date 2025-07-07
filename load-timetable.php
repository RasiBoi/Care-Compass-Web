<?php
include 'db_connection.php';

$sql = "SELECT t.id, t.time_slot, t.day, t.task, d.name AS doctor FROM timetable t JOIN doctors d ON t.doctor_id = d.id";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>{$row['time_slot']}</td>
            <td>{$row['day']}</td>
            <td>{$row['task']}</td>
            <td>{$row['doctor']}</td>
            <td>
                <button class='update-btn' data-id='{$row['id']}'>Update</button>
                <button class='delete-btn' data-id='{$row['id']}'>Delete</button>
            </td>
          </tr>";
}
?>
