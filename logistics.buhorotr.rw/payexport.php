<?php	
	session_start();
	?>
<html>
 <head>
  <title> Payment Report </title>
  <meta name="Generator" content="EditPlus">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
	<script language="JavaScript" type="text/javascript">
	function printpage()
  {  
window.print();
  } 
</script>

  <style type="text/css">
		body {
			font-size: 12px;
			color: #343d44;
			font-family: "segoe-ui", "open-sans", tahoma, arial;
			padding: 0;
			margin: 0;
		}
		table {
			margin: auto;
			font-family: "Lucida Sans Unicode", "Lucida Grande", "Segoe Ui";
			font-size: 12px;
		}

		h1 {
			margin: 20px auto 0;
			text-align: center;
			text-transform: uppercase;
			font-size: 15px;
		}

		table td {
			transition: all .5s;
		}
		
		/* Table */
		.data-table {
			border-collapse: collapse;
			font-size: 12px;
			min-width: 600px;
		}

		.data-table th, 
		.data-table td {
			border: 1px solid #f9f9f9;
			padding: 5px 5px;
		}
		.data-table caption {
			margin: 5px;
		}

		/* Table Header */
		.data-table thead th {
			background-color: #508abb;
			color: #FFFFFF;
			border-color: #6ea1cc !important;
			text-transform: uppercase;
		}

		/* Table Body */
		.data-table tbody td {
			color: #353535;
		}
		.data-table tbody td:first-child,
		.data-table tbody td:nth-child(4),
		.data-table tbody td:last-child {
			text-align: right;
		}

		.data-table tbody tr:nth-child(odd) td {
			background-color: #f9f9f9;
		}
		.data-table tbody tr:hover td {
			background-color: #ffffa2;
			border-color: #f9f9f9;
		}

		/* Table Footer */
		.data-table tfoot th {
			background-color: #e5f5ff;
			text-align: right;
		}
		.data-table tfoot th:first-child {
			text-align: left;
		}
		.data-table tbody td:empty
		{
			background-color: #ffcccc;
		}
	</style>
	<style type="text/css">
.myOtherTable { border-collapse:collapse;color:#000;font-size:12px; }
.myOtherTable td, .myOtherTable th { padding:1px; border:0; }
.myOtherTable td { border-bottom:1px dotted #BDB76B; font-size:12px;}
.myOtherTable th { border-bottom:1px dotted #BDB76B; font-size:12px;}
</style>
<style type="text/css">
@media print {
  .DONTPrint{ display:none }
  .DOCheck{ display:table}
			}
</style>
 </head>

 <body>
 <CENTER><BR>
<TABLE WIDTH="98%"><TR>
<th width='15%'><div align='center'><IMG SRC="imgs/logo.png" WIDTH="80" HEIGHT="60" BORDER="0" ALT=""></th>
<TD ALIGN="LEFT" WIDTH="60%">
			<?php
include'connection.php';
			$hed=mysqli_query($conn, "SELECT *FROM company");
			$rd=mysqli_fetch_assoc($hed);{
				$N1x=$rd['Cname'];
				$N3x=$rd['Address'];
				$N4x=$rd['Location'];
				$W=$rd['Website'];
							$T1=$rd['Phone1'];
								$T2=$rd['Phone2'];
								$E1=$rd['Email'];

			}
			?>
 <div align='left'> <?php echo $N1x ?> <BR>
 <u><?php echo $W ?><br></u>
<?php echo"$E1" ?><br />
 Tel : <?php echo "$T2 / $T1"; ?><br>

</TD>
<TD ALIGN="LEFT">
Day : ....................... <BR>
Month : ................... <BR>
Year : ..................... <BR>
</TD>
</TR></TABLE>

 <?php
	$mt=$_SESSION['MT'];
	$yr=$_SESSION['YR'];	
	$sd=$_SESSION['SD'];
	$ed=$_SESSION['ED'];

	if(isset($_POST['submit']))
		{
			$repo=$_POST['repo'];
		}

$do=mysqli_query($conn, "SELECT *FROM `payrolls` WHERE `Starting`='$sd' AND `Ending`='$ed' AND `Level`='2' ORDER BY `Number` ASC");
		$fo=mysqli_num_rows($do);
?>

<table width='98%' style='font-size:11px;' border='0' class='myOtherTable'>
<tr style='height:20px;'>
<?php
	print("<form action='payrepo.php' method=post><td width='20%'><div class='DONTPrint'><div align='left'>
	<INPUT TYPE=hidden NAME='year' VALUE='$yr'><INPUT TYPE=hidden NAME='month' VALUE='$mt'>
	<INPUT TYPE=hidden NAME='std' VALUE='$sd'><INPUT TYPE=hidden NAME='end' VALUE='$ed'>
				<input type=submit name='open_id' value='BACK' style='background-color:Transparent; width: 90px; 
				border: 0px; height: 20px; color: #FF0000; cursor:pointer;'/></div></div></td></form><td><center>
<h1>PAYMENT REPORT : $mt $yr</h1></td>
	<td width='20%'><div class='DONTPrint'><div align='right'><input type=button onclick='javascript:printpage()' 
	VALUE='PRINT' style='background-color:Transparent; width: 90px; border: 0px; height: 20px; color: #FF0000; cursor:pointer;' /></div></div></td>");
				?></tr></table><br>
                               <table  class="data-table" width='98%'>
                    
                                      <thead>
                    <tr>
		<?php
                   echo"<th class='hidden-xs'> S.NO</th> 					  
                       <th align='center'> FULL NAME </th>";
				if($repo=='FULL' OR $repo=='-'){
                      echo"<th class='hidden-xs'> POSITION </th>
					   <th class='hidden-xs'> START_DATE </th>
                       <th class='hidden-xs'> END_DATE </th> 	 			
                       <th><div style='text-align:right'> ALLOW. </div></th> 			
                       <th><div style='text-align:right'> DEDUCT </div></th>					  
                       <th class='hidden-xs'><div style='text-align:right'> SALARY </div></th>";	
				if($repo=='FULL'){


$date=$sd; 
 while(strtotime($date) <= strtotime($ed)){
			 $pieces = explode("-", $date);
					$ii=$pieces[0];
					$mti=$pieces[1];
					 $mti = date("F", mktime(0, 0, 0, $mti, 10));
					   $yri=$pieces[2];

						  echo"<th><div style='text-align:center'> $ii </th>";

			$date = strtotime("+1 day", strtotime("$date"));
				 $date=date("d-m-Y", $date);
					  }



				}
                       echo"<th><div style='text-align:right'> COUNT </div></th>"; 
				}
				if($repo=='BANK')
					echo"<th> BANK </th><th> BRANCH </th><th> ACCOUNT </th>";

						echo"<th><div style='text-align:right'> AMOUNT </div></th>";

				?>
                     </tr>
                    </thead>
                                        <tbody>
<?php
		$n=1;			$tout=0;				$tall=$tduc=0;
if($repo=='BANK')
	$gr="Bank";
else
	$gr="Currentp";
		$dot=mysqli_query($conn, "SELECT *FROM `payrolls` WHERE `Starting`='$sd' AND `Ending`='$ed' AND `Level`='2' GROUP BY `$gr` ORDER BY `Number` ASC");
			while($rot=mysqli_fetch_assoc($dot)){
				$curp=$rot["$gr"];
				$tos=0;			$tal=$tdu=0;
$do=mysqli_query($conn, "SELECT *FROM `payrolls` WHERE `Starting`='$sd' AND `Ending`='$ed' AND `Level`='2' AND `$gr`='$curp' GROUP BY `Employee` ORDER BY `Number` ASC");
			
while($ro=mysqli_fetch_assoc($do)){
			$numb=$ro['Number'];
			$mt=$ro['Month'];
			$user=$ro['User'];
			$yr=$ro['Year'];
			$dati=$ro['Date'];
			$st=$ro['Status'];
			$sal=$ro['Salary'];
			$empo=$ro['Employee'];
			$toti=$ro['Total'];
			$currentp=$ro['Currentp'];
		$std=$ro['Starting'];
		$end=$ro['Ending'];
			$bank=$ro['Bank'];
$toti=0;

$ndy = 1 + ((strtotime("$end") - strtotime("$std")) / (60 * 60 * 24));
$ndy = round($ndy);


$date=$std; 
 while(strtotime($date) <= strtotime($end)){
			 $pieces = explode("-", $date);
					$ii=$pieces[0];
					$mti=$pieces[1];
					 $mti = date("F", mktime(0, 0, 0, $mti, 10));
					   $yri=$pieces[2];

	 $doi=mysqli_query($conn, "SELECT *FROM `payrolls` WHERE `Employee`='$empo' AND `Month`='$mti' AND `Year`='$yri' AND `D$ii`='1'");
		if($foi=mysqli_num_rows($doi))
			$toti++;
		
	$date = strtotime("+1 day", strtotime("$date"));
				 $date=date("d-m-Y", $date);
 }

$doe=mysqli_query($conn, "SELECT *FROM `employees` WHERE `Eid`='$empo' ORDER BY `Fname` ASC");
		$foe=mysqli_num_rows($doe);
		while($roe=mysqli_fetch_assoc($doe)){
			$fna=$roe['Fname'];
			$lna=$roe['Lname'];
			$branch=$roe['Branch'];
			$acco=$roe['Account'];
		}

		$dei=mysqli_query($conn, "SELECT *FROM `position` WHERE `Postid`='$currentp' ORDER BY `Postname` ASC");
			 if($fei=mysqli_num_rows($dei)){
				 $rei=mysqli_fetch_assoc($dei);
					$post=$rei['Postname'];
			 }
			 else
				 $post="N/A";

			 if($repo=='BANK')
				 $post=$curp;

			 	$allow=0;
// ******************************* allowances for selected month *******************************************
	$allo1=mysqli_query($conn, "SELECT *FROM `allows` WHERE `Employee`='$empo' AND `M1`='$mt' AND `Y1`='$yr' AND `Status`='0'");
			while($ro1=mysqli_fetch_assoc($allo1)){
				$allow+=$ro1['A1'];
			}
	$allo2=mysqli_query($conn, "SELECT *FROM `allows` WHERE `Employee`='$empo' AND `M2`='$mt' AND `Y2`='$yr' AND `Status`='0'");
			while($ro2=mysqli_fetch_assoc($allo2)){
				$allow+=$ro2['A2'];
			}
	$allo3=mysqli_query($conn, "SELECT *FROM `allows` WHERE `Employee`='$empo' AND `M3`='$mt' AND `Y3`='$yr' AND `Status`='0'");
			while($ro3=mysqli_fetch_assoc($allo3)){
				$allow+=$ro3['A3'];
			}
	$allo4=mysqli_query($conn, "SELECT *FROM `allows` WHERE `Employee`='$empo' AND `M4`='$mt' AND `Y4`='$yr' AND `Status`='0'");
			while($ro4=mysqli_fetch_assoc($allo4)){
				$allow+=$ro4['A4'];
			}

	
	$duct=0;
// ******************************* deductions for selected month *******************************************
	$duct1=mysqli_query($conn, "SELECT *FROM `deduct` WHERE `Employee`='$empo' AND `M1`='$mt' AND `Y1`='$yr' AND `Status`='0'");
			while($ro1=mysqli_fetch_assoc($duct1)){
				$duct+=$ro1['A1'];
			}
	$duct2=mysqli_query($conn, "SELECT *FROM `deduct` WHERE `Employee`='$empo' AND `M2`='$mt' AND `Y2`='$yr' AND `Status`='0'");
			while($ro2=mysqli_fetch_assoc($duct2)){
				$duct+=$ro2['A2'];
			}
	$duct3=mysqli_query($conn, "SELECT *FROM `deduct` WHERE `Employee`='$empo' AND `M3`='$mt' AND `Y3`='$yr' AND `Status`='0'");
			while($ro3=mysqli_fetch_assoc($duct3)){
				$duct+=$ro3['A3'];
			}
	$duct4=mysqli_query($conn, "SELECT *FROM `deduct` WHERE `Employee`='$empo' AND `M4`='$mt' AND `Y4`='$yr' AND `Status`='0'");
			while($ro4=mysqli_fetch_assoc($duct4)){
				$duct+=$ro4['A4'];
			}		

$amo=($toti*$sal)+$allow-$duct;
$allowo=number_format($allow);
$ducto=number_format($duct);

  $tpro=number_format($tpr);						$salo=number_format($sal);                         $amoo=number_format($amo);
		print("<tr><form action='payslip.php' method='post' target='_blank'>
                        <td class=hidden-xs align='center'>$n 
						<input type='hidden' value='$numb' name='numb'>
						<input type='hidden' value='$mt' name='mt'>
						<input type='hidden' value='$yr' name='yr'>
						<input type='hidden' value='$perpagevalue' name='perpagevalue'>
						</td><td align='left'>$fna $lna</td>");
						
					if($repo=='FULL' OR $repo=='-'){
						print("<td class='hidden-xs'><div align='left'> $post </td>
                        <td class='hidden-xs' align='center'> $std </td><td class='hidden-xs' align='center'> $end </td>
						<td class=hidden-xs align='right'>$allowo</td><td class=hidden-xs align='right'>$ducto</td>
						<td class=hidden-xs align='right'>$salo</td>");

			if($repo=='FULL'){
						  $date=$sd; 
 while(strtotime($date) <= strtotime($ed)){
			 $pieces = explode("-", $date);
					$ii=$pieces[0];
					$mti=$pieces[1];
					 $mti = date("F", mktime(0, 0, 0, $mti, 10));
					   $yri=$pieces[2];

				$doi=mysqli_query($conn, "SELECT *FROM `payrolls` WHERE `Employee`='$empo' AND `D$ii`='1' ORDER BY `Number` ASC");
		if($roi=mysqli_num_rows($doi))
			$chk="checked";
		else
			$chk='';
						  echo"<td><div style='text-align:center'> <input type='checkbox' class='input-assumpte' id='input-confidencial' value='1' $chk> </td>";
								$date = strtotime("+1 day", strtotime("$date"));
				 $date=date("d-m-Y", $date);
					  }
			}

					  print("<td align='right'> $toti / $ndy </td>");
					}
					if($repo=='BANK')
						print("<td><div align='left'> $bank </td><td><div align='left'> $branch </td><td><div align='left'> $acco </td>");
					
					print("<td align='right'> $amoo </td></form></tr>");
		$tout+=$amo;					$n++;					$tos+=$amo;			$tall+=$allow;				$tduc+=$duct;
				$tal+=$allow;		$tdu+=$duct;
			}
			$toso=number_format($tos);					$tal=number_format($tal);              	$tdu=number_format($tdu);
	$ndy = 1 + ((strtotime("$ed") - strtotime("$sd")) / (60 * 60 * 24));
					$ndy = round($ndy);
print("<tr><th colspan='5' style='background-color:#66cccc;'><div style='text-align:center;'> SUB-TOTAL : $post </th>");
			if($repo=='FULL' OR $repo=='-'){
					print("<th style='background-color:#66cccc;'><div style='text-align:right'> $tal </th>
					<th style='background-color:#66cccc;'><div style='text-align:right'> $tdu </th>
					<th style='background-color:#66cccc;'><div style='text-align:right'> &nbsp; </th>");
			if($repo=='FULL')
					print("<th colspan='$ndy' style='background-color:#66cccc;'><div style='text-align:right'> &nbsp; </th>");

					print("<th colspan='2' style='background-color:#66cccc;'><div style='text-align:right'> $toso </th></tr>");
			}
			if($repo=='BANK')
						print("<th style='background-color:#66cccc;'><div style='text-align:right'> $toso </th></tr>");
			}
			$touto=number_format($tout);				$tall=number_format($tall);              	$tduc=number_format($tduc);
	print("<thead><tr><th colspan='5'><div style='text-align:center'> TOTAL AMOUNT </th>");
			if($repo=='FULL' OR $repo=='-'){
					print("<th><div style='text-align:right'> $tall </th>
					<th><div style='text-align:right'> $tduc </th><th><div style='text-align:right'> &nbsp; </th>");
			if($repo=='FULL')
					print("<th colspan='$ndy'><div style='text-align:right'> &nbsp; </th>");

					print("
					<th colspan='2'><div style='text-align:right'> $touto </th></tr></thead></tr>");
			}
			if($repo=='BANK')
						print("<th><div style='text-align:right'> $touto </th></tr></thead></tr>");
		
	?>
              
                    </tbody>   
                  </table><br>

<table width='98%' style='font-size:11px;' border='0' class='myOtherTable'>
<tr style='height:20px;'>
<?php
	print("<form action='payrepo.php' method=post><td width='15%'><div class='DONTPrint'><div align='left'>
	<INPUT TYPE=hidden NAME='year' VALUE='$yr'><INPUT TYPE=hidden NAME='month' VALUE='$mt'>
	<INPUT TYPE=hidden NAME='std' VALUE='$sd'><INPUT TYPE=hidden NAME='end' VALUE='$ed'>
				<input type=submit name='open_id' value='BACK' style='background-color:Transparent; width: 90px; 
				border: 0px; height: 20px; color: #FF0000; cursor:pointer;'/></div></div></td><td><center> &nbsp; </td>
	<td width='15%'><div class='DONTPrint'><div align='right'><input type=button onclick='javascript:printpage()' 
	VALUE='PRINT' style='background-color:Transparent; width: 90px; border: 0px; height: 20px; color: #FF0000; cursor:pointer;' /></div></div></td>");
				?></tr></table><br><br><br><br>
  
 
 </body></html>
