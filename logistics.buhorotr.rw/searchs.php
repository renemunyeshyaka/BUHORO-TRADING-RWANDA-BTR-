<?php
include'connection.php';
$search = $_GET['term'];
$select =mysqli_query($conn, "SELECT `Fullname` FROM `employees` WHERE (`Currentp`='7' OR `Currentp`='26') AND `Status`='0' ORDER BY `Fullname` ASC");
while ($row=mysqli_fetch_array($select)) 
{
 $data[] = $row['Fullname'];
}
//return json data
echo json_encode($data);
?>