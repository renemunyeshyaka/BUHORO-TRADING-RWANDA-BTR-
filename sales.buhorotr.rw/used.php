<html><head>
<title> </title>
</head>
<body>
<?php
if(isset($_GET['id']))
		{	
		$n=$_GET['id'];
		}
$item=$_SESSION["UITEM$n"];
$dato=$_SESSION["DATO$n"];
$datos=$_SESSION["DATOS$n"];
$brc=$_SESSION["BRC$n"];
print("<div id='modal-$n' class='modal fade' role='dialog'>
  <div class='modal-dialog'><div class='modal-content'>
      <div class='modal-header'>
        <button type='button' class='close' data-dismiss='modal'>&times;</button>
        <h4 class='modal-title'>$iname &nbsp;&nbsp; &nbsp;&nbsp; $qto</h4>
      </div>
      <div class='modal-body'><div align='center'>

<table class='table table-striped'>
          <thead>
          </thead>
          <tbody>
            <tr>
              <td width='10%'><div align='center'>#</td>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;Item&nbsp;Name</td>
              <td width='10%'><div align='center'>Config.</td>
              <td width='10%'><div align='center'>Sales</td>
              <td width='10%'><div align='center'>Quantity</td>
            </tr>");

	$i=1;
if($brc=='0' OR $brc=='')
$dori=mysql_query("SELECT *FROM `brause` WHERE `Ingre`='$item' AND `Date` BETWEEN '$dato' AND '$datos' $conde GROUP BY `Item` ORDER BY `Number` ASC");
else
$dori=mysql_query("SELECT *FROM `brause` WHERE `Destin`='$des' AND `Ingre`='$item' AND `Date` BETWEEN '$dato' AND '$datos' $conde GROUP BY `Item` ORDER BY `Number` ASC");

	while($rori=mysql_fetch_assoc($dori)){	
$mit=$rori['Item'];
$mdo=mysql_query("SELECT *FROM `iconfig` WHERE `Ingre`='$item' AND `Item`='$mit' ORDER BY `Number` ASC");
	$mro=mysql_fetch_assoc($mdo);
$mq=$mro['Quantity'];
				
$mdov=mysql_query("SELECT `Iname` FROM `items` WHERE `Number`='$mit' ORDER BY `Number` DESC LIMIT 1");
	$mrov=mysql_fetch_assoc($mdov);
		$miname=$mrov['Iname'];

if($brc=='0' OR $brc==''){
$dore=mysql_query("SELECT SUM(Quantity) AS 'QTi' FROM `sales` WHERE `Date` BETWEEN '$dato' AND '$datos' AND `Item`='$miname' GROUP BY `Item` ORDER BY `Number` ASC");
}
else{
$dore=mysql_query("SELECT SUM(Quantity) AS 'QTi' FROM `sales` WHERE `Date` BETWEEN '$dato' AND '$datos' AND `Branche`='$brco' AND `Item`='$miname' GROUP BY `Item` ORDER BY `Number` ASC");
}
			$rore=mysql_fetch_assoc($dore);
				$qtu=$rore['QTi'];
$to=$qtu*$mq;


if($item==$mit){
$mq=$qto;
$dl="/Day";
$to=$qto;
$qtu="--";
}
else
$dl='';
print("<tr><td style='$stn'><div align='right'> $i &nbsp;&nbsp; </td><td style='$stn'> $miname </td><td style='$stn'> $mq$unit$dl </td>
<td style='$stn'><div align='right'> $qtu&nbsp;&nbsp;</td><td style='$stn'><div align='right'> $to&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>");
$i++;
}

print("</tbody>
        </table>


      </div>
      <div class='modal-footer'>
        <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
      </div>
    </div></div>
    </div>");
?>
</body>
</html>

