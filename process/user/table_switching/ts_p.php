<?php 
include '../../conn2.php';

$method = $_POST['method'];

if ($method == 'load_t_t1') {
	$c = 0;

	echo '<thead style="text-align: center;">
            <tr>
              <th> # </th>
              <th> C1 </th>
              <th> C2 </th>
              <th> C3 </th>
              <th> C4 </th>
              <th> Date Updated </th>
            </tr>
          </thead>
          <tbody id="t_t1_data" style="text-align: center;">';

	$query = "SELECT * FROM t_t1";

	// 1st Approach using SQL Server DB when using Select Query
	$stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach($stmt->fetchALL() as $j){
			$c++;
			echo '<tr style="cursor:pointer;" class="modal-trigger" onclick="load_t_t2(&quot;'.$j['id'].'~!~'.$j['c1'].'&quot;)">';
				echo '<td>'.$c.'</td>';
				echo '<td>'.$j['c1'].'</td>';
				echo '<td>'.$j['c2'].'</td>';
				echo '<td>'.$j['c3'].'</td>';
				echo '<td>'.$j['c4'].'</td>';
				echo '<td>'.$j['date_updated'].'</td>';
			echo '</tr>';
		}
	}else{
		echo '<tr>';
			echo '<td colspan="6" style="text-align:center; color:red;">No Result !!!</td>';
		echo '</tr>';
	}

	// 2nd Approach using SQL Server DB when using Select Query
	/*$stmt = $conn->prepare($query);
	$stmt->execute();
	$rows = $stmt->fetchAll();
	if (count($rows) > 0) {
		foreach ($rows as $j) {
			$c++;
			echo '<tr style="cursor:pointer;" class="modal-trigger" onclick="load_t_t2(&quot;'.$j['id'].'~!~'.$j['c1'].'&quot;)">';
				echo '<td>'.$c.'</td>';
				echo '<td>'.$j['c1'].'</td>';
				echo '<td>'.$j['c2'].'</td>';
				echo '<td>'.$j['c3'].'</td>';
				echo '<td>'.$j['c4'].'</td>';
				echo '<td>'.$j['date_updated'].'</td>';
			echo '</tr>';
		}
	}else{
		echo '<tr>';
			echo '<td colspan="6" style="text-align:center; color:red;">No Result !!!</td>';
		echo '</tr>';
	}*/
	echo '</tbody>';
}

if ($method == 'load_t_t2') {
	$c1 = $_POST['c1'];

	$c = 0;
	
	echo '<thead style="text-align: center;">
            <tr>
              <th> # </th>
              <th> C1 </th>
              <th> D1 </th>
              <th> D2 </th>
              <th> D3 </th>
              <th> Date Updated </th>
            </tr>
          </thead>
          <tbody id="t_t2_data" style="text-align: center;">';

	$query = "SELECT * FROM t_t2 WHERE c1 = '$c1'";

	// 1st Approach using SQL Server DB when using Select Query
	/*$stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach($stmt->fetchALL() as $j){
			$c++;
			echo '<tr>';
				echo '<td>'.$c.'</td>';
				echo '<td>'.$j['c1'].'</td>';
				echo '<td>'.$j['d1'].'</td>';
				echo '<td>'.$j['d2'].'</td>';
				echo '<td>'.$j['d3'].'</td>';
				echo '<td>'.$j['date_updated'].'</td>';
			echo '</tr>';
		}
	}else{
		echo '<tr>';
			echo '<td colspan="6" style="text-align:center; color:red;">No Result !!!</td>';
		echo '</tr>';
	}*/

	// 2nd Approach using SQL Server DB when using Select Query
	$stmt = $conn->prepare($query);
	$stmt->execute();
	$rows = $stmt->fetchAll();
	if (count($rows) > 0) {
		foreach ($rows as $j) {
			$c++;
			echo '<tr>';
				echo '<td>'.$c.'</td>';
				echo '<td>'.$j['c1'].'</td>';
				echo '<td>'.$j['d1'].'</td>';
				echo '<td>'.$j['d2'].'</td>';
				echo '<td>'.$j['d3'].'</td>';
				echo '<td>'.$j['date_updated'].'</td>';
			echo '</tr>';
		}
	}else{
		echo '<tr>';
			echo '<td colspan="6" style="text-align:center; color:red;">No Result !!!</td>';
		echo '</tr>';
	}

	echo '</tbody>';
}

$conn = NULL;
?>