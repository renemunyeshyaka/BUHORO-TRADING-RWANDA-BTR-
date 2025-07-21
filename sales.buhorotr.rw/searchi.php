<?php
include'connection.php';
$search = $_GET['term'];

$select = mysql_query("SELECT `items`.`Iname`, `items`.`Price` FROM `items` INNER JOIN `itype` ON `items`.`Type` = `itype`.`Number` WHERE (`items`.`Iname` LIKE '%".$search."%' AND `items`.`Status` = '0' AND `items`.`Store`='1') OR (`items`.`Ecode`='".$search."') OR (`items`.`Descri` LIKE '%".$search."%' AND `items`.`Status` = '0' AND `items`.`Store`='1') OR (`itype`.`Type` LIKE '%".$search."%') GROUP BY `items`.`Iname`, `items`.`Price` ORDER BY `items`.`Iname` ASC");
while ($row=mysql_fetch_array($select)) 
{
	$na = $row['Iname'];
	$pri = $row['Price'];
 $data[] = "$na @ $pri";
}
//return json data
echo json_encode($data);
?>