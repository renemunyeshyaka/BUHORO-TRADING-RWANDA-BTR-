<?php
include'connection.php';
$search = $_GET['term'];
$select =mysqli_query($conn, "SELECT `Plate` FROM `vehicles` WHERE (`Plate` LIKE '%".$search."%' AND `Status` = '0') GROUP BY `Plate` ORDER BY `Plate` ASC");
while ($row=mysqli_fetch_array($select)) 
{
 $data[] = $row['Plate'];
}
//return json data
echo json_encode($data);
?>