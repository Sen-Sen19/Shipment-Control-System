<?php 
include '../../conn2.php';

if (!isset($_POST['method'])) {
	echo 'method not set';
	exit;
}

$method = $_POST['method'];

if ($method == 'account_list') {
    $data = array();

	$query = "SELECT * FROM user_accounts";
	$stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach($stmt->fetchALL() as $row){
			$data[] = array(
				'id' => $row['id'],
				'id_number' => $row['id_number'],
				'username' => htmlspecialchars($row['username']),
				'full_name' => htmlspecialchars($row['full_name']),
                'section' => $row['section'],
                'role' => $row['role']
			);
		}
	}else{
		$data[] = array(
			'message' => 'No Results Found'
		);
	}
    header('Content-Type: application/json; charset=utf-8');
	echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
}

if ($method == 'search_account_list') {
	$employee_no = $_POST['employee_no'];
	$full_name = $_POST['full_name'];
	$user_type = $_POST['user_type'];

	$query = "SELECT * FROM user_accounts WHERE id_number LIKE '$employee_no%' 
            AND full_name LIKE '$full_name%' AND role LIKE '$user_type%'";
	$stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach($stmt->fetchALL() as $row){
			$data[] = array(
				'id' => $row['id'],
				'id_number' => $row['id_number'],
				'username' => htmlspecialchars($row['username']),
				'full_name' => htmlspecialchars($row['full_name']),
                'section' => $row['section'],
                'role' => $row['role']
			);
		}
	}else{
		$data[] = array(
			'message' => 'No Results Found'
		);
	}
    header('Content-Type: application/json; charset=utf-8');
	echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
}

if ($method == 'register_account') {
	$employee_no = trim($_POST['employee_no']);
	$full_name = trim($_POST['full_name']);
	$username = trim($_POST['username']);
	$password = trim($_POST['password']);
	$section = trim($_POST['section']);
	$user_type = trim($_POST['user_type']);

	$check = "SELECT id FROM user_accounts WHERE username = ?";
	$stmt = $conn->prepare($check, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
	$params = array($username);
	$stmt->execute($params);
	if ($stmt->rowCount() > 0) {
		echo 'Already Exist';
	}else{
		$stmt = NULL;
		$query = "INSERT INTO user_accounts (id_number, full_name, username, password, section, role) 
                VALUES (?, ?, ?, ?, ?, ?)";
		$stmt = $conn->prepare($query);
		$params = array($employee_no, $full_name, $username, $password, $section, $user_type);
		if ($stmt->execute($params)) {
			echo 'success';
		}else{
			echo 'error';
		}
	}
}

if ($method == 'update_account') {
	$id = $_POST['id'];
	$id_number = trim($_POST['id_number']);
	$username = trim($_POST['username']);
	$full_name = trim($_POST['full_name']);
	$password = trim($_POST['password']);
	$section = trim($_POST['section']);
	$role = trim($_POST['role']);

	$query = "SELECT id FROM user_accounts WHERE username = ?";
	$stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
	$params = array($username);
	$stmt->execute($params);
	if ($stmt->rowCount() > 0) {
		echo 'duplicate';
	}else{
		$stmt = NULL;
		$query = "UPDATE user_accounts SET id_number = ?, username = ?, full_name = ?, 
                password = ?, section = ?, role = ? WHERE id = ?";
		$stmt = $conn->prepare($query);
        $params = array($id_number, $username, $full_name, $password, $section, $role, $id);
		if ($stmt->execute($params)) {
			echo 'success';
		}else{
			echo 'error';
		}
	}
}

if ($method == 'delete_account') {
	$id = $_POST['id'];

	$query = "DELETE FROM user_accounts WHERE id = ?";
	$stmt = $conn->prepare($query);
    $params = array($id);
	if ($stmt->execute($params)) {
		echo 'success';
	}else{
		echo 'error';
	}
}

if ($method == 'delete_account_selected') {
	$id_arr = [];
	$id_arr = $_POST['id_arr'];

	$count = count($id_arr);
	foreach ($id_arr as $id) {
		$sql = "DELETE FROM user_accounts WHERE id = ?";
		$stmt = $conn -> prepare($sql);
		$params = array($id);
		$stmt -> execute($params);
		$count--;
	}

	if ($count == 0) {
		echo 'success';
	}
}

$conn = NULL;
?>