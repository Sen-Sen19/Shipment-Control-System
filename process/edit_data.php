<?php
include 'conn3.php'; 

header('Content-Type: application/json');

if (!$conn) {
    echo json_encode(['success' => false, 'error' => 'Database connection failed']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $Product_No = $_POST['ProductNo'];
    $Car_Maker = $_POST['carMaker'];
    $Line_No = $_POST['lineNo'];
    $Initial_Secondary_Process = $_POST['initialSecondaryProcess'];
    $Final_Process = $_POST['finalProcess'];
    $Poly_Size = $_POST['polySize'];


    $sql = "UPDATE [live_shipment_control_db].[dbo].[m_product_no] 
            SET [Car_Maker] = ?, [Line_No] = ?, [Initial_Secondary_Process] = ?, [Final_Process] = ?, [Poly_Size] = ?
            WHERE [Product_No] = ?";
    
    $params = array($Car_Maker, $Line_No, $Initial_Secondary_Process, $Final_Process, $Poly_Size, $Product_No);
    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt === false) {
        echo json_encode(['success' => false, 'error' => sqlsrv_errors()]);
    } else {
        echo json_encode(['success' => true]);
    }

    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}
?>
