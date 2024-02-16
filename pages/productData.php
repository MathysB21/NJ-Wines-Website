<?php
session_start();

$mysqli = new mysqli("localhost", "root", "", "nj_wines");
if($mysqli->connect_error) {
  exit('Could not connect');
}

$sql = "SELECT * FROM wines WHERE id = ?";

$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $_GET['q']);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($id, $name, $year, $flavours, $details, $price, $amount, $image_link, $wine_range);
$stmt->fetch();
$stmt->close();

$_SESSION['id'] = $id;
$_SESSION['name'] = $name;
$_SESSION['year'] = $year;
$_SESSION['flavours'] = $flavours;
$_SESSION['details'] = $details;
$_SESSION['price'] = $price;
$_SESSION['amount'] = $amount;
$_SESSION['image_link'] = $image_link;
$_SESSION['wine_range'] = $wine_range;

header('Location: product.php');
exit();
?>