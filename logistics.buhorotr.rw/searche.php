<?php
include'connection.php';
$search = $_GET['term'];
$select =mysqli_query($conn, "SELECT `Owner` FROM `employees` WHERE (`Owner` LIKE '%".$search."%' AND `Status` = '0') GROUP BY `Owner` ORDER BY `Owner` ASC");
while ($row=mysqli_fetch_array($select)) 
{
 $data[] = $row['Owner'];
}
//return json data
echo json_encode($data);
?>