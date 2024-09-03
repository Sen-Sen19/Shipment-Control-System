<?php
$serverName = "172.25.115.167\SQLEXPRESS";
$connectionOptions = array(
    "Database" => "live_shipment_control_db",
    "Uid" => "sa",
    "PWD" => '#Sy$temGr0^p|115167'
);

 
$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}

// SQL query to fetch relevant columns
$sql = "SELECT product_no, Car_Maker, Line_No, Initial_Secondary_Process, Final_Process, Poly_Size FROM m_product_no";
$stmt = sqlsrv_query($conn, $sql);

$data = array();
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $data[] = $row;
}

// Return data as JSON
echo json_encode($data);

// Free the statement and close the connection
sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);

