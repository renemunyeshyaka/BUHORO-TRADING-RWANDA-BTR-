<?php
include'connection.php';
$search = $_GET['term'];

$select =mysql_query("SELECT `Customer` FROM `account` WHERE (`Customer` LIKE '%".$search."%' AND `Status` = '0') OR (`Address` LIKE '%".$search."%' AND `Status` = '0') GROUP BY `Customer` ORDER BY `Customer` ASC");
while ($row=mysql_fetch_array($select)) 
{
 $data[] = $row['Customer'];
}
//return json data
echo json_encode($data);
?>