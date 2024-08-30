<?php
include 'conn3.php'; 

$offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;
$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 20;

$sql = "SELECT [ID], [Product_No], [Car_Maker], [Line_No], [Initial_Secondary_Process], [Final_Process], [Poly_Size]
        FROM [live_shipment_control_db].[dbo].[m_product_no]
        ORDER BY [ID]
        OFFSET ? ROWS FETCH NEXT ? ROWS ONLY";
$params = array($offset, $limit);
$stmt = sqlsrv_query($conn, $sql, $params);

if ($stmt === false) {
    die(json_encode(array('error' => sqlsrv_errors())));
}

$data = array();
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $data[] = $row;
}

sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);

echo json_encode($data);
?>
