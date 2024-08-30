<?php 
require_once '../../DatabaseConnections.php';

$method = $_POST['method'];

if ($method == 'register_account') {
	$employee_no = trim($_POST['employee_no']);
	$full_name = trim($_POST['full_name']);
	$username = trim($_POST['username']);
	$password = trim($_POST['password']);
	$section = trim($_POST['section']);
	$user_type = trim($_POST['user_type']);

	// Open Connection
	$connectionArr = $db->connect();

	if ($connectionArr['connected'] == 1) {
	    $conn = $connectionArr['connection'];
	    
	    $check = "SELECT id FROM user_accounts WHERE username = ?";
		$stmt = $conn->prepare($check, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
		$params = array($username);
		$stmt->execute($params);
		if ($stmt->rowCount() > 0) {
			echo 'Already Exist';
		} else {
			$stmt = NULL;
			$query = "INSERT INTO user_accounts (id_number, full_name, username, password, section, role)VALUES(?,?,?,?,?,?)";
			$stmt = $conn->prepare($query);
			$params = array($employee_no, $full_name, $username, $password, $section, $user_type);
			if ($stmt->execute($params)) {
				echo 'success';
			} else {
				echo 'error';
			}
		}
	} else {
		echo $connectionArr['title'] . " " . $connectionArr['message'];
	}

	// Close Connection
	$conn = null;
}

/*if ($method == 'account_list') {
	$employee_no = $_POST['employee_no'];
	$full_name = $_POST['full_name'];
	$user_type = $_POST['user_type'];
	$c = 0;

	$query = "SELECT * FROM user_accounts WHERE id_number LIKE '$employee_no%' AND full_name LIKE '$full_name%' AND role LIKE '$user_type%'";
	$stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach($stmt->fetchALL() as $j){
			$c++;
			echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#update_account" onclick="get_accounts_details(&quot;'.$j['id'].'~!~'.$j['id_number'].'~!~'.$j['username'].'~!~'.$j['full_name'].'~!~'.$j['password'].'~!~'.$j['section'].'~!~'.$j['role'].'&quot;)">';
				echo '<td>'.$c.'</td>';
				echo '<td>'.$j['id_number'].'</td>';
				echo '<td>'.$j['username'].'</td>';
				echo '<td>'.$j['full_name'].'</td>';
				echo '<td>'.$j['section'].'</td>';
				echo '<td>'.strtoupper($j['role']).'</td>';
			echo '</tr>';
		}
	}else{
		echo '<tr>';
			echo '<td colspan="6" style="text-align:center; color:red;">No Result !!!</td>';
		echo '</tr>';
	}
}*/

if ($method == 'account_list') {
	$c = 0;

	// Open Connection
	$connectionArr = $db->connect();

	if ($connectionArr['connected'] == 1) {
	    $conn = $connectionArr['connection'];

	    $query = "SELECT * FROM user_accounts";
		$stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
		$stmt->execute();
		if ($stmt->rowCount() > 0) {
			foreach($stmt->fetchALL() as $j){
				$c++;
				echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#update_account" onclick="get_accounts_details(&quot;'.$j['id'].'~!~'.$j['id_number'].'~!~'.$j['username'].'~!~'.$j['full_name'].'~!~'.$j['password'].'~!~'.$j['section'].'~!~'.$j['role'].'&quot;)">';
					echo '<td>'.$c.'</td>';
					echo '<td>'.$j['id_number'].'</td>';
					echo '<td>'.$j['username'].'</td>';
					echo '<td>'.$j['full_name'].'</td>';
					echo '<td>'.$j['section'].'</td>';
					echo '<td>'.strtoupper($j['role']).'</td>';
				echo '</tr>';
			}
		} else {
			echo '<tr>';
				echo '<td colspan="6" style="text-align:center; color:red;">No Result !!!</td>';
			echo '</tr>';
		}
	} else {
		echo $connectionArr['title'] . " " . $connectionArr['message'];
	}

	// Close Connection
	$conn = null;
}

if ($method == 'search_account_list') {
	$employee_no = $_POST['employee_no'];
	$full_name = $_POST['full_name'];
	$user_type = $_POST['user_type'];
	$c = 0;

	// Open Connection
	$connectionArr = $db->connect();

	if ($connectionArr['connected'] == 1) {
	    $conn = $connectionArr['connection'];

	    $query = "SELECT * FROM user_accounts WHERE id_number LIKE '$employee_no%' AND full_name LIKE '$full_name%' AND role LIKE '$user_type%'";
		$stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
		$stmt->execute();
		if ($stmt->rowCount() > 0) {
			foreach($stmt->fetchALL() as $j){
				$c++;
				echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#update_account" onclick="get_accounts_details(&quot;'.$j['id'].'~!~'.$j['id_number'].'~!~'.$j['username'].'~!~'.$j['full_name'].'~!~'.$j['password'].'~!~'.$j['section'].'~!~'.$j['role'].'&quot;)">';
					echo '<td>'.$c.'</td>';
					echo '<td>'.$j['id_number'].'</td>';
					echo '<td>'.$j['username'].'</td>';
					echo '<td>'.$j['full_name'].'</td>';
					echo '<td>'.$j['section'].'</td>';
					echo '<td>'.strtoupper($j['role']).'</td>';
				echo '</tr>';
			}
		} else {
			echo '<tr>';
				echo '<td colspan="6" style="text-align:center; color:red;">No Result !!!</td>';
			echo '</tr>';
		}
	} else {
		echo $connectionArr['title'] . " " . $connectionArr['message'];
	}

	// Close Connection
	$conn = null;
}

if ($method == 'update_account') {
	$id = $_POST['id'];
	$id_number = trim($_POST['id_number']);
	$username = trim($_POST['username']);
	$full_name = trim($_POST['full_name']);
	$password = trim($_POST['password']);
	$section = trim($_POST['section']);
	$role = trim($_POST['role']);

	// Open Connection
	$connectionArr = $db->connect();

	if ($connectionArr['connected'] == 1) {
	    $conn = $connectionArr['connection'];
	    
	    $query = "SELECT id FROM user_accounts WHERE username = ? AND id_number = ? AND full_name = ? AND section = ?";
		$stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
		$params = array($username, $id_number, $full_name, $section);
		$stmt->execute($params);
		if ($stmt->rowCount() > 0) {
			echo 'duplicate';
		} else {
			$stmt = NULL;
			$query = "UPDATE user_accounts SET id_number = ?, username = ?, full_name = ?, password = ?, section = ?, role = ? WHERE id = ?";
			$stmt = $conn->prepare($query);
			$params = array($id_number, $username, $full_name, $password, $section, $role, $id);
			if ($stmt->execute($params)) {
				echo 'success';
			} else {
				echo 'error';
			}
		}
	} else {
		echo $connectionArr['title'] . " " . $connectionArr['message'];
	}

	// Close Connection
	$conn = null;
}

if ($method == 'delete_account') {
	$id = $_POST['id'];

	// Open Connection
	$connectionArr = $db->connect();

	if ($connectionArr['connected'] == 1) {
	    $conn = $connectionArr['connection'];
	    
	    $query = "DELETE FROM user_accounts WHERE id = ?";
	    $stmt = $conn->prepare($query);
	    $params = array($id);
	    if ($stmt->execute($params)) {
	    	echo 'success';
	    } else {
	    	echo 'error';
	    }
	} else {
		echo $connectionArr['title'] . " " . $connectionArr['message'];
	}

	// Close Connection
	$conn = null;
}
?>