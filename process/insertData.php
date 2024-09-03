<?php
include 'conn3.php';  // Include your database connection

// Get the raw POST data
$data = json_decode(file_get_contents('php://input'), true);

if (empty($data)) {
    echo json_encode(['message' => 'No data received']);
    exit;
}

try {
    foreach ($data as $row) {
        $carModel = $row['carModel'];
        $carKind = $row['carKind'];
        $productNumber = $row['productNumber'];
        $date = $row['date'];
        $value = $row['value'];

        // Fetch Car_Maker from m_product_no table
        $carMakerQuery = "SELECT Car_Maker FROM [m_product_no] WHERE Product_No = :productNumber";
        $stmtCarMaker = $conn->prepare($carMakerQuery);
        $stmtCarMaker->bindParam(':productNumber', $productNumber);
        $stmtCarMaker->execute();

        $carMaker = $stmtCarMaker->fetchColumn(); // Fetch the Car_Maker if it exists

        // Insert data into the t_production_plan table
        $query = "INSERT INTO [live_shipment_control_db].[dbo].[t_production_plan] 
                  (Product_No, Car_Kind, Car_Model, Car_Maker, Date, Value) 
                  VALUES (:productNumber, :carKind, :carModel, :carMaker, :date, :value)";
        
        $stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        $stmt->bindParam(':productNumber', $productNumber);
        $stmt->bindParam(':carKind', $carKind);
        $stmt->bindParam(':carModel', $carModel);
        $stmt->bindParam(':carMaker', $carMaker); // Include Car_Maker in the insertion
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':value', $value);
        $stmt->execute();
    }

    echo json_encode(['message' => 'Data inserted successfully']);
} catch (PDOException $e) {
    echo json_encode(['message' => 'Failed to insert data: ' . $e->getMessage()]);
}

?>

    $colsQuery = "DECLARE @cols AS NVARCHAR(MAX);
    SET @cols = STUFF((SELECT DISTINCT 
                        ',' + QUOTENAME(CONVERT(NVARCHAR, Date, 23))
                      FROM [live_shipment_control_db].[dbo].[t_production_plan]
                      FOR XML PATH(''), TYPE
                      ).value('.', 'NVARCHAR(MAX)')
                      ,1,1,'');
    DECLARE @query AS NVARCHAR(MAX);
    SET @query = N'SELECT Product_No, ' + @cols + '
                   FROM 
                   (
                       SELECT Product_No, 
                              CONVERT(NVARCHAR, Date, 23) AS Date, 
                              Value
                       FROM [live_shipment_control_db].[dbo].[t_production_plan]
                   ) x
                   PIVOT 
                   (
                       SUM(Value)
                       FOR Date IN (' + @cols + ')
                   ) p';
    EXEC sp_executesql @query;";

$stmtCols = $conn->prepare($colsQuery);
$stmtCols->execute();

// Fetch the results
$results = $stmtCols->fetchAll(PDO::FETCH_ASSOC);

// Output the results as JSON
echo json_encode($results);

} catch (PDOException $e) {
echo json_encode(['message' => 'Failed to insert data: ' . $e->getMessage()]);
}
?>
