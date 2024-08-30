<?php
include '../../conn_e.php'; // Connection to Oracle
include '../../conn2.php'; // Connection to SQL Server

$method = isset($_POST['method']) ? $_POST['method'] : '';
if ($method == 'count_lot') {
    $lot = isset($_POST['lot']) ? strtoupper($_POST['lot']) : '';
    $product_no = isset($_POST['product_no']) ? strtoupper($_POST['product_no']) : '';
    $date_time_from = isset($_POST['date_time_from']) ? urldecode($_POST['date_time_from']) : '';

    $total = 0;

    // Fetch data from Oracle
    $query = "SELECT COUNT(LOT) AS TOTAL 
              FROM T_PACKINGWK 
              WHERE LOT = :lot 
              AND PARTSNAME LIKE :product_no 
              AND PACKINGBOXCARDJUDGMENT = '1' 
              AND REGISTDATETIME >= TO_DATE(:date_time_from, 'yyyy-MM-dd HH24:MI:SS')";

    $stmt = oci_parse($conn_ircs, $query);

    // Bind parameters
    oci_bind_by_name($stmt, ':lot', $lot);
    oci_bind_by_name($stmt, ':product_no', $product_no . '%');
    oci_bind_by_name($stmt, ':date_time_from', $date_time_from);

    if (oci_execute($stmt)) {
        $row = oci_fetch_object($stmt, OCI_ASSOC + OCI_RETURN_NULLS);
        if ($row) {
            $total = $row->TOTAL;
        }
    } else {
        $error = oci_error($stmt);
        echo 'Query failed: ' . $error['message'];
        exit();
    }

    // Check if matching records exist in SQL Server
    try {
        $sql = "SELECT COUNT(*) AS Count
                FROM bk_t_palletconfirm_h
                WHERE Lot = :lot AND Product_No = :product_no";
        $sqlStmt = $conn2->prepare($sql);
        $sqlStmt->bindParam(':lot', $lot, PDO::PARAM_STR);
        $sqlStmt->bindParam(':product_no', $product_no, PDO::PARAM_STR);
        $sqlStmt->execute();
        $count = $sqlStmt->fetchColumn();

        if ($count > 0) {
            // Insert into SQL Server if matching records are found
            $insertSql = "INSERT INTO bk_t_palletconfirm_h (PD_Output) VALUES (:total)";
            $insertStmt = $conn2->prepare($insertSql);
            
            // Bind parameters for SQL Server
            $insertStmt->bindParam(':lot', $lot, PDO::PARAM_STR);
            $insertStmt->bindParam(':product_no', $product_no, PDO::PARAM_STR);
            $insertStmt->bindParam(':total', $total, PDO::PARAM_INT);
            $insertStmt->bindParam(':date_time_from', $date_time_from, PDO::PARAM_STR);

            // Execute the insert
            if ($insertStmt->execute()) {
                echo "Data inserted successfully";
            } else {
                echo "Failed to insert data";
            }
        } else {
            echo "No matching records found in SQL Server";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Close Oracle connection
    oci_free_statement($stmt);
    oci_close($conn_ircs);

    // Close SQL Server connection
    $conn2 = null;
}
?>