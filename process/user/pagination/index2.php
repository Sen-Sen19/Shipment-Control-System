<html>  
<head>  
<title> Pagination </title>  
</head>  
<body>  
  
<?php
    function count_account_list($conn) {
        $query = "SELECT count(id) AS total FROM user_accounts";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            foreach($stmt->fetchALL() as $j){
                $total = $j['total'];
            }
        }else{
            $total = 0;
        }
        return $total;
    }
  
    date_default_timezone_set('Asia/Manila');
    $servername = 'localhost'; $username = 'root'; $password = '';

    try {
        $conn = new PDO ("mysql:host=$servername;dbname=web_template",$username,$password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo 'NO CONNECTION'.$e->getMessage();
    }
  
    //define total number of results you want per page  
    $results_per_page = 10;  
  
    //find the total number of results stored in the database 
    $number_of_result = count_account_list($conn);  
    echo $number_of_result;
    echo "<br>";
  
    //determine the total number of pages available  
    $number_of_page = ceil($number_of_result / $results_per_page);

    echo $number_of_page;
    echo "<br>";  
  
    //determine which page number visitor is currently on  
    if (!isset ($_GET['page']) ) {  
        $page = 1;  
    } else {  
        $page = $_GET['page'];  
    }

    echo $page;
    echo "<br>";
  
    //determine the sql LIMIT starting number for the results on the displaying page  
    $page_first_result = ($page-1) * $results_per_page;  
  
    //retrieve the selected results from database   
    $query = "SELECT * FROM user_accounts LIMIT ".$page_first_result.", ".$results_per_page;
    $stmt = $conn->prepare($query);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        foreach($stmt->fetchALL() as $row){
            echo $row['id'] . ' ' . $row['id_number'] . '</br>';  
        }
    }
  
    //display the link of the pages in URL  
    for($page = 1; $page <= $number_of_page; $page++) {  
        echo '<a href = "index2.php?page=' . $page . '">' . $page . ' </a>';
    }

?>  
</body>  
</html>  