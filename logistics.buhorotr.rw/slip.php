<?php
session_start();
include'connection.php';
?>
<html>
<head><title><?php echo $cna ?></title>
<style>
@media print{
   .noprint{
       display:none;
   }
}
@media screen{
   .noshow{
       display:none;
   }
}


@media print {
  .DONTPrint{ display:none }
  .DOCheck{ display:table}
			}
			
			
    @media screen {
        div.divFooter {
            display: none;
        }
    }


      table,
      th,
      td {
        padding: 2px 2px 2px 10px;
        border: 1px solid black;
        border-collapse: collapse;
      }

</style><link rel="shortcut icon" type="image/png" href="imgs/logo.png"/></head>
<body bgcolor="#COCOCO">
<center>
		<?php
		$loge=$_SESSION['Loge'];
		$hed=mysqli_query($conn, "SELECT *FROM company");
			$rd=mysqli_fetch_assoc($hed);{
				$N1x=$rd['Cname'];
				$N3x=$rd['Address'];
				$N5x=$rd['Tax'];
				$N6x=$rd['Phone1'];
				$N7x=$rd['Phone2'];
				$N8x=$rd['Email'];
				$N9x=$rd['Email'];
				$N10x=$rd['Website'];
				$Date=$rd['Date'];
			}
?><div class='divFooter' style="top: 0px;">
<IMG SRC="imgs/header.jpg" WIDTH="100%" HEIGHT="90" BORDER="0" ALT=""></div>
<br><br><script>
function goBack() {
  window.history.back();
}
</script>

<?php
	$due=date('l, jS M Y', strtotime($dte)); 
	
	echo"<table width='98%' class='gridtable' style='border:0px;'>
	<tr style='height:20px;'>
	<th style='border: 0px;' width='10%'><div class='DONTPrint'>
	<a href='$pago'><font face='Agency FB' color='blue' size='3'> BACK </a></th>
	<th style='border: 0px dotted #99cccc; font-size:20px; background-color:#F3EF53; border-radius:5px; height:30px;'><b><u> PAYMENT VOUCHER </u></b></th><th style='border: 0px;' width='10%'><div class='DONTPrint'>
	<a href='#' onclick='window.print();return false;'/>
<font face='Agency FB' color='blue' size='3'> PRINT </a></th></tr></table><br><br><br>
	

	<table width='98%' style='border: 0px;'><tr>
 <td align='right' style='font-size:18px; border:0px;'> $due <br>
 Voucher No:<b> &nbsp;&nbsp;&nbsp; $trip </b></td>
 </tr></table><br><br>";
 
 
 echo"<table width='98%' class='gridtable'>
			<tr style='height:30px;'>
			<th width='20%' style='font-size:12px; text-align:left'> 
			Payment&nbsp;Method </th>
			<th width='15%' style='font-size:12px;'> CASH </th>
			<th width='5%' style='font-size:12px;'> </th>
			<th width='15%' style='font-size:12px;'> CHEQUE </th>
			<th width='5%' style='font-size:12px;'> </th>
			<th width='15%' style='font-size:12px;'> MOMO </th>
			<th width='5%' style='font-size:12px;'> </th>
			<th width='15%' style='font-size:12px;'> BANK&nbsp;TRANSFER </th>
			<th width='5%' style='font-size:12px;'> </th></tr></table>";

	echo"<br><table width='98%' class='gridtable'>
			<tr style='height:25px; background-color:#4d8a9d;'>
			<th width='10%' style='font-size:12px;'> S/No </th>
			<th style='font-size:12px;'> Item/Activities/Task Description </th>
			<th width='20%' style='font-size:12px;'> Amount(RWF) </th>
			<th width='20%' style='font-size:12px;'> Amount(USD) </th></tr>";
			
		
		
	$roa=$mil=$othe=$pay=0;              $too=$us=0;             $im=$ir=$io='';
		        // ******************* Road Toll & Mileage ******************
		$dois=mysqli_query($conn, "SELECT *FROM `repair` WHERE `Number`='$nuo' AND `Status`='0' AND `Trip`='$trip' AND `Type`='$typ' AND `Date`='$dte' AND (`Garage`='ROAD TOLL' OR `Garage`='MILEAGE' OR `Garage`='OTHER EXPENSE' OR `Garage`='GPS SERVICES' OR `Garage`='BOND') ORDER BY `Number` ASC");
			    while($rois=mysqli_fetch_assoc($dois)){
			        $rate=$rois['Rate'];
			        $user=$rois['User'];
			        $rate=$rois['Rate'];
			        $bond=$rois['Garage'];
				    if($rois['Garage']=='ROAD TOLL'){
			        $rater=$rois['Rate'];
				$roa+=$rois['Amount'];
				$issu=$rois['Issue'];
				if($issu)
				$ir="$ir $issu;";
				    }
				    elseif($rois['Garage']=='MILEAGE'){
			        $ratem=$rois['Rate'];
				$mil+=$rois['Amount'];
				$issu=$rois['Issue'];
				if($issu)
				$im="$im $issu;";
				    }
				    else{
			        $ratet=$rois['Rate'];
				$othe+=$rois['Amount'];
				$issu=$rois['Issue'];
				if($issu)
				$io="$io $issu;";
				    }
				
				    $dri=$rois['Driver'];
				    $pla=$rois['Plate'];
			    }
			      
			if(!$othe)  
			$bond="OTHER EXPENSE";
			    $roao=number_format($roa, 2);
					$milo=number_format($mil, 2);
					$otheo=number_format($othe, 2);
						    $tot=$roa+$mil+$othe;
						    if($rate=='1')
						    $um=0;
						    else
						    $um=$mil/$rate;
						    $umo=number_format($um, 2);
						    if($rate=='1')
						    $ur=0;
						    else
						    $ur=$roa/$rate;
						    $uro=number_format($ur, 2);
						    if($rate=='1')
						    $uth=0;
						    else
						    $uth=$othe/$rate;
						    $utho=number_format($uth, 2);

echo"<tr><td align='center'> 1 </td><td style='padding-left:30px;'> MILEAGE  &nbsp;&nbsp; $im </td><td align='right'>";
if($ratem=='1'){
    $too+=$mil;
echo $milo;
}
echo"&nbsp;&nbsp;</td><td align='right'>";
if($ratem>'1'){
    $us+=$um;
echo $umo;
}
echo"&nbsp;&nbsp;</td></tr>
<tr><td align='center'> 2 </td><td style='padding-left:30px;'> ROAD TOLL &nbsp;&nbsp; $ir </td><td align='right'>";
if($rater=='1'){
    $too+=$roa;
echo $roao;
}
echo"&nbsp;&nbsp;</td><td align='right'>";
if($rater>'1'){
    $us+=$ur;
echo $uro;
}
echo"&nbsp;&nbsp;</td></tr>
<tr><td align='center'> 3 </td><td style='padding-left:30px;'> C2, SEAL </td>
<td align='right'> &nbsp;&nbsp; </td><td align='right'> &nbsp;&nbsp; </td></tr>
<tr><td align='center'> 4 </td><td style='padding-left:30px;'> $bond  &nbsp;&nbsp; $io </td><td align='right'>";
if($ratet=='1'){
    $too+=$othe;
echo $otheo;
}
echo"&nbsp;&nbsp;</td><td align='right'>";
if($ratet>'1'){
    $us+=$uth;
echo $utho;
}
echo"&nbsp;&nbsp;</td></tr>";

				$toso=number_format($too, 2);
				$uso=number_format($us, 2);

            /* *********************** Load deduction *******************
	$doil=mysqli_query($conn, "SELECT `Descri`, SUM(`Amount`) AS 'Cut' FROM `cutter` WHERE `Trip`='$trip' ORDER BY `Number` ASC");
	   	if($foil=mysqli_num_rows($doil) AND $othe=='0'){
			$roil=mysqli_fetch_assoc($doil);
				$cut=$roil['Cut'];
	    */
	    if($cut AND $mil>0){
				$rcut=$cut;
				$cuto=number_format($cut);
				$rcuto=number_format($rcut, 2);

echo"<tr style='height:25px; background-color:#F3EF53; font-size:14px;'>
<th colspan='2' align='right'> SUB-TOTAL &nbsp; </th>
<th align='right'> RWF&nbsp;$toso &nbsp;&nbsp;</th>
<th align='right'> USD&nbsp;$uso &nbsp;&nbsp;</th></tr>";
						$too=$too-$cut;
					$toso=number_format($too, 2);
						
echo"<tr style='height:25px; background-color:#F9AC08; font-size:14px;'>
<th colspan='2' align='right'> DEDUCTION &nbsp; </th>
<th align='right'> RWF&nbsp;$rcuto &nbsp;&nbsp;</th>
<th align='right'> USD&nbsp;0.00 &nbsp;&nbsp;</th></tr>";
		$cols=2;		
	   	}
	   	else
	   	    $cols=4;

echo"<tr style='height:25px; background-color:#F3EF53; font-size:14px;'>
<th colspan='2' align='right'> TOTAL &nbsp; </th>
<th align='right'> RWF&nbsp;$toso &nbsp;&nbsp;</th>
<th align='right'> USD&nbsp;$uso &nbsp;&nbsp;</th></tr>";

include'convert.php';
if($us>=1000)
$uso=$us;
$word = convertNumberToWordsForUsd($uso);
$words = convertNumberToWordsForRwf($too);
if($us AND $too)
$an="and";
else
$an="";
echo"<tr style='height:50px;'>
<td colspan='4' align='left' valign='top' style='font-size:13px;'>&nbsp;<b><u>Amount in words</u>:</b>";

if($us)
echo $word;
echo" $an ";
if($too)
echo$words;

echo"</td></tr><tr style='height:90px;'>
<th colspan='$cols' align='left' valign='top'><br>&nbsp;<b> Driver: </b>
$dri <br> Vehicle ID: $pla <br> Destination: $deso </th>";

if($cols=='2')
echo"<th colspan='2'> $des </th>"; 


echo"</tr></table><br><br>

<table width='98%' class='gridtable' style='border:0px;'>
	<tr><th width='20%' style='font-size:12px; border:0px; color:#2f913c' valign='top'> -------------------------- <br>
	Received by <br> [Name & Sign] </th>
	<th style='font-size:12px; border:0px; color:#7e1c0b' valign='top'> -------------------------- <br> Logistics <br> [Prepared By] <br>
	<font size='1' color='#f9f9f9'> $user </font></th>
	<th style='font-size:12px; border:0px; color:#d8f347' valign='top'> -------------------------- <br> Accountant <br> [Verified By] <br></th>
		<th width='20%' style='font-size:12px; border:0px; color:#1d87c0' valign='top'> -------------------------- <br>
		Managing Director <br> [Approved By] <br></th></tr></table><br>
		
		<table width='98%' class='gridtable' style='border:0px;'>
	<tr style='height:20px;'>
	<th style='border: 0px;' width='10%'><div class='DONTPrint'>
	<a href='$pago'><font face='Agency FB' color='blue' size='3'> BACK </a></th>
	<th style='border: 0px;'> </th><th style='border: 0px;' width='10%'><div class='DONTPrint'>
	<a href='#' onclick='window.print();return false;'/>
<font face='Agency FB' color='blue' size='3'> PRINT </a></th></tr></table>
		
    <table width='98%' class='gridtable'>
	<tr style='height:100px;'><th width='20%' style='font-size:12px;'>  </th>
			<th style='font-size:12px;'> </th>
			<th style='font-size:12px;'> </th>
		<th width='20%' style='font-size:12px;'> </th></tr>
		</table><br><br><br>";
?>
<div class="divFooter" style="left: 0px; bottom: 0px; right:0px; width: 100%; text-align: center; position:fixed;"><IMG SRC="imgs/footer.jpg" WIDTH="100%" HEIGHT="60" BORDER="0" ALT=""></div>
    <?php
    exit();
    ?>
      </body>
</body>


