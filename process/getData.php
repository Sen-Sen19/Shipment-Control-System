<?php
// Include database connection
include 'conn3.php';

// SQL Query
$sql = "
    DECLARE @cols AS NVARCHAR(MAX);
    SET @cols = STUFF((SELECT DISTINCT 
                        ',' + QUOTENAME(CONVERT(NVARCHAR, Date, 23))
                      FROM [dbo].[t_production_plan]
                      FOR XML PATH(''), TYPE
                      ).value('.', 'NVARCHAR(MAX)')
                      ,1,1,'');
                  
    DECLARE @query AS NVARCHAR(MAX);
    SET @query = N'SELECT Car_Model, Car_Kind,Car_Maker, Product_No, ' + @cols + '
                   FROM 
                   (
                       SELECT Car_Model, Car_Kind, Car_Maker,Product_No, 
                              CONVERT(NVARCHAR, Date, 23) AS Date, 
                              Value
                       FROM [dbo].[t_production_plan]
                   ) x
                   PIVOT 
                   (
                       SUM(Value)
                       FOR Date IN (' + @cols + ')
                   ) p';
    
    EXEC sp_executesql @query;
";

// Execute the query
$result = sqlsrv_query($conn, $sql);

if ($result === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Fetch data
$data = array();
while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
    $data[] = $row;
}

// Output JSON
header('Content-Type: application/json');
echo json_encode($data);

// Close connection
sqlsrv_close($conn);
?>
