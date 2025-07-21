<?php
include'connection.php';
$search = $_GET['term'];

$select =mysql_query("SELECT * FROM `items` WHERE (`Iname` LIKE '%".$search."%' AND `Status` = '0' AND `Store`<='2') OR (`Descri` LIKE '%".$search."%' AND `Status` = '0' AND `Store`<='2') OR (`items`.`Ecode`='".$search."') ORDER BY `Iname` ASC");
while ($row=mysql_fetch_array($select)) 
{
 $data[] = $row['Iname'];
}
//return json data
echo json_encode($data);
?>