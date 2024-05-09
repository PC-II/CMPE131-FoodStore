<?php
// Connect to your database
include 'config.php';

// Query the store_inventory table
$result = mysqli_query($conn, "SELECT item_name FROM store_inventory");

// Create an array to store the product names
$productNames = array();

while ($row = mysqli_fetch_assoc($result)) {
    $productNames[] = $row['item_name'];
}

// Close the database connection
mysqli_close($conn);

// Output the product names as JSON
echo json_encode($productNames);
?>