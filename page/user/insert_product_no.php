<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    if (isset($data['product_nos']) && is_array($data['product_nos'])) {
        $product_nos = $data['product_nos'];
        
        // Database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "live_shipment_control_db";

        $conn = new mysqli($servername, $username, $password, $dbname);
   
        // Check connection
        if ($conn->connect_error) {
            die(json_encode(['success' => false, 'message' => 'Connection failed: ' . $conn->connect_error]));
        }

        // Prepare SQL statement
        $stmt = $conn->prepare("INSERT INTO dbo.t_production_plan (product_no) VALUES (?)");
        $stmt->bind_param("s", $product_no);

        // Execute the statement for each product_no
        foreach ($product_nos as $product_no) {
            $stmt->execute();
        }

        $stmt->close();
        $conn->close();

        echo json_encode(['success' => true, 'message' => 'Product numbers inserted successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'No product numbers provided.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
