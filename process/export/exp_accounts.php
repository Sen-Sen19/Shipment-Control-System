<?php 
include '../conn.php';
ini_set("memory_limit", "-1");

$employee_no = $_GET['employee_no'];
$full_name = $_GET['full_name'];
$c = 0;

$filename = "Export Accounts.xls";
header("Content-Type: application/vnd.ms-excel");
header('Content-Type: text/csv; charset=utf-8');  
header("Content-Disposition: ; filename=\"$filename\"");

echo'
<html lang="en">
<body>
<table border="1">
<thead style="text-align:center;">
	<th>#</th>
        <th>ID Number</th>  
        <th>Full Name</th>
        <th>Username</th>
        <th>Password</th>
        <th>Section</th>
        <th>Role</th>
        <th>Message</th>
</thead>
<tbody>
';
$query = "SELECT `id_number`, `full_name`, `username`, `password`, `section`, `role` FROM user_accounts WHERE id_number LIKE '$employee_no%' AND full_name LIKE '$full_name%'";
$stmt = $conn->prepare($query);
$stmt->execute();
if ($stmt->rowCount() > 0) {
	foreach ($stmt->fetchALL() as $j) {
		$c++;
		echo '<tr>';
			echo '<td>'.$c.'</td>';
			echo '<td><b>'.$j['id_number'].'</b></td>';
			echo '<td>'.$j['full_name'].'</td>';
			echo '<td>'.$j['username'].'</td>';
			echo '<td>'.$j['password'].'</td>';
			echo '<td>'.$j['section'].'</td>';
			echo '<td>'.$j['role'].'</td>';
			echo '<td>Ako Po Si '.$j['full_name'].'</td>';
		echo '</tr>';
	}
}else{
	echo '<tr>';
		echo '<td style="text-align:center; color:red;" colspan="6">No Result !!!</td>';
	echo '</tr>';
}
echo '
</tbody>
</table>
</body>
</html>
';
?>