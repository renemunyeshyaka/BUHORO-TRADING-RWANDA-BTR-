 <?php
 include'connection.php';
		   $date = strtotime("-63 days", strtotime("$Date"));
				$date = date ("Y-m-d", $date);

$sqlQuery = "SELECT `items`.`Iname`, SUM((`stouse`.`Quantity`*`stouse`.`Price`)-(`stouse`.`Quantity`*`stouse`.`Cost`)) AS 'Total' FROM `stouse` INNER JOIN `items` ON `items`.`Number`=`stouse`.`Item` WHERE `stouse`.`Date` >= '$date' AND `stouse`.`Action`='SALES' AND `stouse`.`Status`='0' $conde GROUP BY `stouse`.`Item` ORDER BY `Total` DESC LIMIT 10";

$result = mysqli_query($cons,$sqlQuery);

$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

echo json_encode($data);
	?>