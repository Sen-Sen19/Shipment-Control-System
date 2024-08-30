<?php
header('Content-Type: application/json');

$serverName = "172.25.115.167\SQLEXPRESS";
$connectionOptions = array(
    "Database" => "live_shipment_control_db",
    "Uid" => "sa",
    "PWD" => '#Sy$temGr0^p|115167'
);
$conn = sqlsrv_connect($serverName, $connectionOptions);
if ($conn === false) {
    echo json_encode(['success' => false, 'error' => 'Connection failed']);
    exit;
}
$input = file_get_contents('php://input');
$data = json_decode($input, true);
$productNo = $data['product_no'];

$sql = "SELECT Car_Maker, Line_No, Initial_Secondary_Process, Final_Process, Poly_Size
        FROM m_product_no
        WHERE Product_No = ?";
$params = array($productNo);
$stmt = sqlsrv_query($conn, $sql, $params);

if ($stmt === false) {
    echo json_encode(['success' => false, 'error' => 'Query failed']);
    exit;
}
$row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
if ($row) {
    echo json_encode(['success' => true, 'data' => $row]);
} else {
    echo json_encode(['success' => false, 'error' => 'Not found']);
}
sqlsrv_close($conn);
?>
