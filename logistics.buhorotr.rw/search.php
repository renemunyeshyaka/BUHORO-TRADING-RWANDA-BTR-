<?php
include'connection.php';
$search = $_GET['term'];
$select =mysqli_query($conn, "SELECT * FROM `items` WHERE (`Item` LIKE '%".$search."%' AND `Status` = '0') OR (`Type` LIKE '%".$search."%' AND `Status` = '0') GROUP BY `Item` ORDER BY `Item` ASC");
while ($row=mysqli_fetch_array($select)) 
{
 $data[] = $row['Item'];
}
//return json data
echo json_encode($data);
?>