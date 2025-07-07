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
}

$conn->close();
?>
