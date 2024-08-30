<?php 
include '../../conn.php';

$method = $_POST['method'];

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

if ($method == 'count_account_list') {
	echo count_account_list($conn);
}

if ($method == 'account_list') {
	$current_page = intval($_POST['current_page']);
	$c = 0;

	$results_per_page = 10;
	$page = $current_page;

	//determine the sql LIMIT starting number for the results on the displaying page
	$page_first_result = ($page-1) * $results_per_page;

	$c = $page_first_result;

	$query = "SELECT * FROM user_accounts LIMIT ".$page_first_result.", ".$results_per_page;
	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach($stmt->fetchALL() as $j){
			$c++;
			echo '<tr>';
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
}

if ($method == 'account_list_pagination') {
	$current_page = intval($_POST['current_page']);

	$results_per_page = 10;

	$number_of_result = intval(count_account_list($conn));

	//determine the total number of pages available  
	$number_of_page = ceil($number_of_result / $results_per_page);

	echo '<ul class="pagination">';

	//echo '<li class="paginate_button page-item previous disabled" id="accounts_table_pagination_prev"><a href="#" aria-controls="accounts_table" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li>';

	for ($page = 1; $page <= $number_of_page; $page++) {
		if ($page == $current_page) {
			echo '<li class="paginate_button page-item active"><a href="#" aria-controls="accounts_table" data-dt-idx="'.$page.'" tabindex="0" class="page-link" onclick="load_accounts('.$page.')">'.$page.'</a></li>';
		} else {
			echo '<li class="paginate_button page-item"><a href="#" aria-controls="accounts_table" data-dt-idx="'.$page.'" tabindex="0" class="page-link" onclick="load_accounts('.$page.')">'.$page.'</a></li>';
		}
    }

    //echo '<li class="paginate_button page-item next disabled" id="accounts_table_pagination_next"><a href="#" aria-controls="accounts_table" data-dt-idx="7" tabindex="0" class="page-link">Next</a></li>';

    echo '</ul>';
}

if ($method == 'search_account_list') {
	$employee_no = $_POST['employee_no'];
	$full_name = $_POST['full_name'];
	$user_type = $_POST['user_type'];
	$c = 0;

	$query = "SELECT * FROM user_accounts WHERE id_number LIKE '$employee_no%' AND full_name LIKE '$full_name%' AND role LIKE '$user_type%'";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach($stmt->fetchALL() as $j){
			$c++;
			echo '<tr>';
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
}

$conn = NULL;
?>