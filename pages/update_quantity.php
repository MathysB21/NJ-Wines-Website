<?php
// Retrieve the data from the request
$wineID = $_POST['wineID'];
$orderID = intval($_POST['orderID']);
$quantity = intval($_POST['quantity']);

echo $wineID;
echo $orderID;

// Perform the database update
$conn = new mysqli("localhost", "root", "", "nj_wines");

// and the necessary code for executing the update statement
// Here's an example using mysqli:
$stmt = $conn->prepare("UPDATE order_items SET quantity = ? WHERE wine_id = ? AND order_id = ?");
$stmt->bind_param("iii", $quantity, $wineID, $orderID);
$stmt->execute();
$stmt->close();

// Send a response back to the JavaScript
echo 'Update successful'. $orderID.$wineID.$quantity;
?>