<?php
require '../../process/conn_fsib.php';
require '../../process/conn_ircs.php';

$method = $_POST['method'];

if ($method == 'count') {
    // Get delivery status from POST data
    $date_from = isset($_POST['date_from']) ? $_POST['date_from'] : '';
    $date_to = isset($_POST['date_to']) ? $_POST['date_to'] : '';
    $delivery_status = isset($_POST['delivery_status']) ? $_POST['delivery_status'] : '';

    if ($date_from && $date_to) {
        $date_from = DateTime::createFromFormat('Y-m-d', $date_from)->format('Y/m/d');
        $date_to = DateTime::createFromFormat('Y-m-d', $date_to)->format('Y/m/d');
    }

    if (!empty($delivery_status)) {
        // Base query
        $query = "SELECT COUNT(*) as total FROM V_WH_PALLETIZING_RESULTS a ";


        // Modify query based on delivery status
        if ($delivery_status == 'not_delivery') {
            $query .= "LEFT JOIN (SELECT C_PONO, C_FAPHINBAN, C_LOTNO, SUM(L_SUU) AS SHIP_STATUS 
                        FROM T_YUSYUTDAT 
                        WHERE C_INVNO IS NULL 
                        GROUP BY C_FAPHINBAN, C_LOTNO, C_PONO) c 
                        ON a.C_PRODUCTNO = c.C_FAPHINBAN 
                        AND a.C_LOTNO = c.C_LOTNO 
                        AND a.C_PONO = c.C_PONO 
                        
                        LEFT JOIN (SELECT C_PONO, C_FAPHINBAN, C_LOTNO, SUM(L_SUU) AS SHIP 
                        FROM T_YUSYUTDAT 
                        WHERE C_INVNO IS NOT NULL AND C_CONTGR LIKE '%SHIP%' 
                        GROUP BY C_FAPHINBAN, C_LOTNO, C_PONO) d 
                        ON a.C_PRODUCTNO = d.C_FAPHINBAN 
                        AND a.C_LOTNO = d.C_LOTNO 
                        AND a.C_PONO = d.C_PONO 
                        
                        LEFT JOIN (SELECT C_PONO, C_FAPHINBAN, C_LOTNO, SUM(L_SUU) AS AIR 
                        FROM T_YUSYUTDAT 
                        WHERE C_INVNO IS NOT NULL AND C_CONTGR LIKE '%AIR%' 
                        GROUP BY C_FAPHINBAN, C_LOTNO, C_PONO) e 
                        ON a.C_PRODUCTNO = e.C_FAPHINBAN 
                        AND a.C_LOTNO = e.C_LOTNO 
                        AND a.C_PONO = e.C_PONO 
                        
                        WHERE a.C_PRODUCTION_DATE BETWEEN :date_from AND :date_to AND a.L_REMAINORDER != 0";
                        // WHERE a.L_REMAINORDER != 0";
        } elseif ($delivery_status == 'delivery_finish') {
            $query .= "LEFT JOIN (SELECT C_PONO, C_FAPHINBAN, C_LOTNO, SUM(L_SUU) AS SHIP_STATUS 
                        FROM T_YUSYUTDAT 
                        WHERE C_INVNO IS NOT NULL 
                        GROUP BY C_FAPHINBAN, C_LOTNO, C_PONO) c 
                        ON a.C_PRODUCTNO = c.C_FAPHINBAN 
                        AND a.C_LOTNO = c.C_LOTNO 
                        AND a.C_PONO = c.C_PONO 
                        
                        LEFT JOIN (SELECT C_PONO, C_FAPHINBAN, C_LOTNO, SUM(L_SUU) AS SHIP 
                        FROM T_YUSYUTDAT 
                        WHERE C_INVNO IS NOT NULL AND C_CONTGR LIKE '%SHIP%' 
                        GROUP BY C_FAPHINBAN, C_LOTNO, C_PONO) d 
                        ON a.C_PRODUCTNO = d.C_FAPHINBAN 
                        AND a.C_LOTNO = d.C_LOTNO 
                        AND a.C_PONO = d.C_PONO 
                        
                        LEFT JOIN (SELECT C_PONO, C_FAPHINBAN, C_LOTNO, SUM(L_SUU) AS AIR 
                        FROM T_YUSYUTDAT 
                        WHERE C_INVNO IS NOT NULL AND C_CONTGR LIKE '%AIR%' 
                        GROUP BY C_FAPHINBAN, C_LOTNO, C_PONO) e 
                        ON a.C_PRODUCTNO = e.C_FAPHINBAN 
                        AND a.C_LOTNO = e.C_LOTNO 
                        AND a.C_PONO = e.C_PONO 
                        
                        WHERE a.C_PRODUCTION_DATE BETWEEN :date_from AND :date_to AND a.L_REMAINORDER = 0";
                        // WHERE a.L_REMAINORDER = 0";
        }

        // Prepare the statement
        $stmt = oci_parse($conn_fsib, $query);

        // Bind the variables directly
        oci_bind_by_name($stmt, ':date_from', $date_from);
        oci_bind_by_name($stmt, ':date_to', $date_to);

        // Execute the statement
        oci_execute($stmt);

        // Fetch the result
        $row = oci_fetch_assoc($stmt);
        if ($row !== false) {
            echo $row['TOTAL'];
        } else {
            echo '0';
        }
    }
}



if ($method == 'get_fsib_data') {

    $date_from = isset($_POST['date_from']) ? $_POST['date_from'] : '';
    $date_to = isset($_POST['date_to']) ? $_POST['date_to'] : '';
    $delivery_status = isset($_POST['delivery_status']) ? $_POST['delivery_status'] : '';


    if ($date_from && $date_to) {
        $date_from = DateTime::createFromFormat('Y-m-d', $date_from)->format('Y/m/d');
        $date_to = DateTime::createFromFormat('Y-m-d', $date_to)->format('Y/m/d');
    }

    echo "<script>console.log(" . json_encode($date_from) . ");</script>";
    echo "<script>console.log(" . json_encode($date_to) . ");</script>";


    if (!empty($delivery_status)) {

        $query = "SELECT a.C_PONO,a.C_PRODUCTNO as Product_No,a.C_LOTNO as Lot_No , a.C_PRODUCTION_DATE as Production_Date,a.L_ORDER_QTY as PO_Qty, a.L_PALLETIZING_QTY as FG_Scanned
        ,a.L_REMAINORDER, a.C_DUEDATE as DUEDATE, a.C_DESTINATION as DESTINATION ,a.C_MODE_OF_SHIPMENT as MODE_OF_SHIPMENT,a.C_UNIT_PRICE as UNIT_PRICE
        ,c.SHIP_STATUS,d.SHIP,e.AIR";

        if ($delivery_status == 'not_delivery') {
            $query .= " FROM V_WH_PALLETIZING_RESULTS a 
        LEFT JOIN (SELECT C_PONO,C_FAPHINBAN,C_LOTNO, SUM(L_SUU) AS SHIP_STATUS  FROM T_YUSYUTDAT 
        WHERE C_INVNO IS  NULL
        GROUP BY C_FAPHINBAN,C_LOTNO,C_PONO) c ON  a.C_PRODUCTNO = c.C_FAPHINBAN  and a.C_LOTNO = c.C_LOTNO AND a.C_PONO = c.C_PONO
        
        LEFT JOIN (SELECT C_PONO,C_FAPHINBAN,C_LOTNO, SUM(L_SUU) AS SHIP  FROM T_YUSYUTDAT 
        WHERE  C_INVNO IS NOT NULL AND C_CONTGR LIKE '%SHIP%'
        GROUP BY C_FAPHINBAN,C_LOTNO,C_PONO) d ON  a.C_PRODUCTNO = d.C_FAPHINBAN  and a.C_LOTNO = d.C_LOTNO and a.C_PONO = d.C_PONO
        
        LEFT JOIN (SELECT C_PONO,C_FAPHINBAN,C_LOTNO, SUM(L_SUU) AS AIR  FROM T_YUSYUTDAT 
        WHERE  C_INVNO IS NOT NULL AND C_CONTGR LIKE '%AIR%'
        GROUP BY C_FAPHINBAN,C_LOTNO,C_PONO) e ON  a.C_PRODUCTNO = e.C_FAPHINBAN  and a.C_LOTNO = e.C_LOTNO and a.C_PONO = e.C_PONO
        
        where C_PRODUCTION_DATE BETWEEN :date_from AND :date_to and a.L_REMAINORDER != 0 ORDER BY a.C_PRODUCTION_DATE ASC";
        } else if ($delivery_status == 'delivery_finish') {
            $query .= " FROM V_WH_PALLETIZING_RESULTS a LEFT JOIN (SELECT C_PONO,C_FAPHINBAN,C_LOTNO, SUM(L_SUU) AS SHIP_STATUS  FROM T_YUSYUTDAT 
        WHERE C_INVNO IS NOT NULL
        GROUP BY C_FAPHINBAN,C_LOTNO,C_PONO
        ) c ON  a.C_PRODUCTNO = c.C_FAPHINBAN  and a.C_LOTNO = c.C_LOTNO AND a.C_PONO = c.C_PONO
        
        LEFT JOIN (SELECT C_PONO,C_FAPHINBAN,C_LOTNO, SUM(L_SUU) AS SHIP  FROM T_YUSYUTDAT 
        WHERE  C_INVNO IS NOT NULL AND C_CONTGR LIKE '%SHIP%'
        GROUP BY C_FAPHINBAN,C_LOTNO,C_PONO
        ) d ON  a.C_PRODUCTNO = d.C_FAPHINBAN  and a.C_LOTNO = d.C_LOTNO and a.C_PONO = d.C_PONO
        
        LEFT JOIN (SELECT C_PONO,C_FAPHINBAN,C_LOTNO, SUM(L_SUU) AS AIR  FROM T_YUSYUTDAT 
        WHERE  C_INVNO IS NOT NULL AND C_CONTGR LIKE '%AIR%'
        GROUP BY C_FAPHINBAN,C_LOTNO,C_PONO
        ) e ON  a.C_PRODUCTNO = e.C_FAPHINBAN  and a.C_LOTNO = e.C_LOTNO and a.C_PONO = e.C_PONO
        
        where C_PRODUCTION_DATE BETWEEN :date_from AND :date_to and a.L_REMAINORDER = 0";
        }


        $stmt = oci_parse($conn_fsib, $query);

        // Bind variables
        oci_bind_by_name($stmt, ':date_from', $date_from);
        oci_bind_by_name($stmt, ':date_to', $date_to);
        $c=0;
        // Execute the statement
        oci_execute($stmt);

        // Start the HTML table
        // echo '<table id="sp_cotdb" class="table table-sm table-head-fixed text-nowrap table-hover">';
        // echo '<thead id="sp_cotdb_head" style="text-align: center;">';
        // echo '<tr>';
        // echo '<th>#</th>';
        // echo '<th>PO No</th>';
        // echo '<th>Product No</th>';
        // echo '<th>Lot No</th>';
        // echo '<th>Production Date</th>';
        // echo '<th>PO Qty</th>';
        // echo '<th>FG Scanned</th>';
        // echo '<th>Remain Order</th>';
        // echo '<th>Due Date</th>';
        // echo '<th>Destination</th>';
        // echo '<th>Mode of Shipment</th>';
        // echo '<th>Unit Price</th>';
        // echo '<th>Status</th>';
        // echo '<th>Ship</th>';
        // echo '<th>Air</th>';
        // echo '<th>IRCS Record</th>';
        // echo '</tr>';
        // echo '</thead>';

        // Fetch each row of the result
        while ($row = oci_fetch_assoc($stmt)) {
            // $lotNo = $row['LOT_NO'];
            $c++;
            // // Query to get count of LOT
            // $count_query = "SELECT COUNT(LOT) AS PACK_COUNT FROM T_PACKINGWK WHERE LOT = :lotNo AND PACKINGBOXCARDJUDGMENT = '1'";
            // $stmt_count = oci_parse($conn_ircs, $count_query);
            // oci_bind_by_name($stmt_count, ':lotNo', $lotNo);
            // oci_execute($stmt_count);

            // $count_row = oci_fetch_assoc($stmt_count);
            // $packCount = $count_row['PACK_COUNT'] ?? 0; // Default to 0 if no result
            echo '<tr>';
            echo '<td>' . $c . '</td>';
            echo '<td>' . htmlspecialchars($row['C_PONO']) . '</td>';
            echo '<td>' . htmlspecialchars($row['PRODUCT_NO']) . '</td>';
            echo '<td>' . htmlspecialchars($row['LOT_NO']) . '</td>';
            echo '<td>' . htmlspecialchars($row['PRODUCTION_DATE']) . '</td>';
            echo '<td>' . htmlspecialchars($row['PO_QTY']) . '</td>';
            echo '<td>' . htmlspecialchars($row['FG_SCANNED']) . '</td>';
            echo '<td>' . htmlspecialchars($row['L_REMAINORDER']) . '</td>';
            echo '<td>' . htmlspecialchars($row['DUEDATE']) . '</td>';
            echo '<td>' . htmlspecialchars($row['DESTINATION']) . '</td>';
            echo '<td>' . htmlspecialchars($row['MODE_OF_SHIPMENT']) . '</td>';
            echo '<td>' . htmlspecialchars($row['UNIT_PRICE']) . '</td>';
            echo '<td>' . htmlspecialchars($row['SHIP_STATUS']) . '</td>';
            echo '<td>' . htmlspecialchars($row['SHIP']) . '</td>';
            echo '<td>' . htmlspecialchars($row['AIR']) . '</td>';
            // echo '<td>' . htmlspecialchars($packCount) . '</td>'; // Output the pack count
            echo '</tr>';

            // Free the statement resources for count query
            // oci_free_statement($stmt_count);
        }

        // // End the table
        // echo '</tbody>'; // End tbody
        // echo '</table>';

        // Free the statement resources for main query
        oci_free_statement($stmt);
    } else {
        echo '<script>alert("Please select delivery status. ");</script>';
    }
}
