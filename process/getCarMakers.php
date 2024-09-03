<?php
include 'conn2.php'; // Include your database connection

header('Content-Type: application/json');

// Check if the product numbers are provided
if (!isset($_GET['productNos']) || empty($_GET['productNos'])) {
    echo json_encode([]);
    exit();
}

$productNos = $_GET['productNos'];
$productNosArray = explode(',', $productNos); // Convert comma-separated list to array

// Prepare and execute the query
$placeholders = implode(',', array_fill(0, count($productNosArray), '?'));
$sql = "SELECT Product_No, Car_Maker FROM m_product_no WHERE Product_No IN ($placeholders)";
$params = $productNosArray;
$stmt = sqlsrv_query($conn, $sql, $params);

if ($stmt === false) {
    echo json_encode([]);
    exit();
}

// Fetch results and prepare JSON response
$carMakers = [];
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $carMakers[$row['Product_No']] = $row['Car_Maker'];
}

echo json_encode($carMakers);
?>
