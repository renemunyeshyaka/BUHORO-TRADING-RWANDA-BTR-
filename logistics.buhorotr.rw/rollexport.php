<?php	
	session_start();
	?>
<html>
 <head>
  <title> Payroll Report </title>
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
			$hed=mysql_query("SELECT *FROM company");
			$rd=mysql_fetch_assoc($hed);{
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

	if(isset($_POST['submit']))
		{
			$repo=$_POST['repo'];
		}

$do=mysql_query("SELECT *FROM `payrolls` WHERE `Month`='$mt' AND `Year`='$yr' AND `Level`='1' ORDER BY `Number` ASC");
		$fo=mysql_num_rows($do);
$_SESSION['excell']='rollexport.php';
?>

<table width='98%' style='font-size:11px;' border='0' class='myOtherTable'>
<tr style='height:20px;'>
<?php
	print("<form action='rollrepo.php' method=post><td width='20%'><div class='DONTPrint'><div align='left'>
	<INPUT TYPE=hidden NAME='year' VALUE='$yr'><INPUT TYPE=hidden NAME='month' VALUE='$mt'>
				<input type=submit name=search value='BACK' style='background-color:Transparent; width: 90px; 
				border: 0px; height: 20px; color: #FF0000; cursor:pointer;'/></div></div></td></form><td><center>
<h1>PAYROLL REPORT : $mt $yr</h1></td>
	<td width='20%'><div class='DONTPrint'><div align='right'>

<input type=button onclick='javascript:printpage()' 
	VALUE='PRINT' style='background-color:Transparent; width: 90px; border: 0px; height: 20px; color: #FF0000; cursor:pointer;' /></div></div></td>");
				?></tr></table><br>
                               <table  class="data-table" width='98%'>
                                      <thead>
                    <tr>
		<?php
                   echo"<th> S.NO</th> 					  
                       <th> FULL NAME </th>";
			if($repo=='BANK')
				echo"<th> BANK </th><th> BRANCH </th><th> ACCOUNT </th>";
					 if($repo=='FULL' OR $repo=='PAYMENT')
						 echo"<th> POSITION </th>					  
                       <th> SALARY </th>	
                       <th> TPR </th>"; 
		
		
			$doi=mysql_query("SELECT *FROM `rolling` WHERE `Month`='$mt' AND `Year`='$yr' AND `Employee`>'0' ORDER BY `Number` ASC");
		while($roi=mysql_fetch_assoc($doi)){
			$des=$roi['Description'];
			$vue=$roi['Employee'];
		if($vue<100){
		$per="%";
		$vu=$vue;
		}
	else{
		$per="";
		$vu="";
	}
		if($repo!='BANK')
			echo"<th align='center'> $vu$per$des </th>";
			  }
		if($repo=='FULL')							  
                     echo"<th> ALLOW. </th> 	 							  
                       <th> DEDUCT </th>";
	
			$doi=mysql_query("SELECT *FROM `rolling` WHERE `Month`='$mt' AND `Year`='$yr' AND `Employer`>'0' ORDER BY `Number` ASC");
		while($roi=mysql_fetch_assoc($doi)){
			$des=$roi['Description'];
			$vue=$roi['Employer'];
		if($vue<100){
		$per="%";
		$vu=$vue;
		}
	else{
		$per="";
		$vu="";
	}
			if($repo!='BANK')
			echo"<th align='center'> $vu$per$des </th>";
			  }
			  
			if($repo!='PAYMENT')
                     echo"<th> NET&nbsp;PAY </th>";

				?>
                     </tr>
                    </thead>
                                        <tbody>
<?php
$n=1;

						$isal=$itpr=$iall=$ided=$inet=0;
		   
		   $icsri=$icost=$itot=0;
	
			if($repo=='BANK'){
	$dou=mysql_query("SELECT *FROM `payrolls` WHERE `Month`='$mt' AND `Year`='$yr' AND `Level`='1' GROUP BY `Bank` ORDER BY `Bank` ASC");
			}
			else{
	$dou=mysql_query("SELECT *FROM `payrolls` WHERE `Month`='$mt' AND `Year`='$yr' AND `Level`='1' GROUP BY `Bank` ORDER BY `Bank` ASC LIMIT 1");
			}
	while($rou=mysql_fetch_assoc($dou)){
		$banko=$rou['Bank'];
		$netb=0;

			if($repo=='BANK'){
	$do=mysql_query("SELECT *FROM `payrolls` WHERE `Month`='$mt' AND `Year`='$yr' AND `Level`='1' AND `Bank`='$banko' ORDER BY `Number` ASC");
			}
			else{
	$do=mysql_query("SELECT *FROM `payrolls` WHERE `Month`='$mt' AND `Year`='$yr' AND `Level`='1' ORDER BY `Number` ASC");
			}
	
	while($ro=mysql_fetch_assoc($do)){
$numb=$ro['Number'];
$mt=$ro['Month'];
$user=$ro['User'];
$yr=$ro['Year'];
$dati=$ro['Date'];
$st=$ro['Status'];
$sal=$ro['Salary'];
$empo=$ro['Employee'];
$currentp=$ro['Currentp'];

$doe=mysql_query("SELECT *FROM `employees` WHERE `Eid`='$empo' ORDER BY `Fname` ASC");
		$foe=mysql_num_rows($doe);
		while($roe=mysql_fetch_assoc($doe)){
			$fna=$roe['Fname'];
			$lna=$roe['Lname'];
			$bank=$roe['Bank'];
			$branch=$roe['Branch'];
			$acco=$roe['Account'];
		}

$dei=mysql_query("SELECT *FROM `position` WHERE `Postid`='$currentp' ORDER BY `Postname` ASC");
			 if($fei=mysql_num_rows($dei)){
				 $rei=mysql_fetch_assoc($dei);
					$post=$rei['Postname'];
			 }
			 else
				 $post="N/A";

			 if($sal>100000)
				 $tpr=((100000-30000)*(20/100))+(($sal-100000)*(30/100));
			 else
				 $tpr=($sal-30000)*(20/100);
	
		$acti="";
	
           $salo=number_format($sal);
		   $tpro=number_format($tpr);
		print("<tr>
                        <td class=hidden-xs><div align='right'>$n </td>
						<td align='left'>$fna $lna</td>");
				if($repo=='BANK')
					echo"<td><div align='left'> $bank </td><td><div align='left'> $branch </td><td><div align='left'> $acco </td>";
						 if($repo=='FULL' OR $repo=='PAYMENT')
							 print("<td> $post </td>
                        <td align='right'>$salo</td>
                        <td align='right'> $tpro </td>");
						
						$empoe=0;	
				$doi=mysql_query("SELECT *FROM `rolling` WHERE `Month`='$mt' AND `Year`='$yr' AND `Employee`>'0' ORDER BY `Number` ASC");
		while($roi=mysql_fetch_assoc($doi)){
			$des=$roi['Description'];
			$vue=$roi['Employee'];
		if($vue<100){
		$vu=($vue/100*$sal);
		}
	else{
		$vu=$vue;
		}
	$vuo=number_format($vu);
		$empoe+=$vu;
		if($repo!='BANK')
			echo"<td align='right'> $vuo </td>";
			  }		














			  $allow=0;
// ******************************* allowances for selected month *******************************************
	$allo1=mysql_query("SELECT *FROM `allows` WHERE `Employee`='$empo' AND `M1`='$mt' AND `Y1`='$yr' AND `Status`='0'");
			while($ro1=mysql_fetch_assoc($allo1)){
				$allow+=$ro1['A1'];
			}
	$allo2=mysql_query("SELECT *FROM `allows` WHERE `Employee`='$empo' AND `M2`='$mt' AND `Y2`='$yr' AND `Status`='0'");
			while($ro2=mysql_fetch_assoc($allo2)){
				$allow+=$ro2['A2'];
			}
	$allo3=mysql_query("SELECT *FROM `allows` WHERE `Employee`='$empo' AND `M3`='$mt' AND `Y3`='$yr' AND `Status`='0'");
			while($ro3=mysql_fetch_assoc($allo3)){
				$allow+=$ro3['A3'];
			}
	$allo4=mysql_query("SELECT *FROM `allows` WHERE `Employee`='$empo' AND `M4`='$mt' AND `Y4`='$yr' AND `Status`='0'");
			while($ro4=mysql_fetch_assoc($allo4)){
				$allow+=$ro4['A4'];
			}

	
	$duct=0;
// ******************************* deductions for selected month *******************************************
	$duct1=mysql_query("SELECT *FROM `deduct` WHERE `Employee`='$empo' AND `M1`='$mt' AND `Y1`='$yr' AND `Status`='0'");
			while($ro1=mysql_fetch_assoc($duct1)){
				$duct+=$ro1['A1'];
			}
	$duct2=mysql_query("SELECT *FROM `deduct` WHERE `Employee`='$empo' AND `M2`='$mt' AND `Y2`='$yr' AND `Status`='0'");
			while($ro2=mysql_fetch_assoc($duct2)){
				$duct+=$ro2['A2'];
			}
	$duct3=mysql_query("SELECT *FROM `deduct` WHERE `Employee`='$empo' AND `M3`='$mt' AND `Y3`='$yr' AND `Status`='0'");
			while($ro3=mysql_fetch_assoc($duct3)){
				$duct+=$ro3['A3'];
			}
	$duct4=mysql_query("SELECT *FROM `deduct` WHERE `Employee`='$empo' AND `M4`='$mt' AND `Y4`='$yr' AND `Status`='0'");
			while($ro4=mysql_fetch_assoc($duct4)){
				$duct+=$ro4['A4'];
			}		

$allowo=number_format($allow);
$ducto=number_format($duct);














			  $net=$sal-$empoe-$tpr+$allow-$duct;
		   $neto=number_format($net);
					
						if($repo=='FULL')
						echo"<td align='right'><b> $allowo </b></td>
						<td align='right'><b> $ducto </b></td>";
						
						
				$empor=0;
				$doi=mysql_query("SELECT *FROM `rolling` WHERE `Month`='$mt' AND `Year`='$yr' AND `Employer`>'0' ORDER BY `Number` ASC");
		while($roi=mysql_fetch_assoc($doi)){
			$des=$roi['Description'];
			$vue=$roi['Employer'];
		if($vue<100){
		$vu=($vue/100*$sal);
		}
	else{
		$vu=$vue;
		}
	$vuo=number_format($vu);
		$empor+=$vu;
		if($repo!='BANK')
			echo"<td align='right'> $vuo </td>";
			  }		
		if($repo=='PAYMENT')
			$tot=$empor+$empoe+$tpr;
			else
			  $tot=$empor;

		   $toto=number_format($tot);			
			if($repo!='PAYMENT')
						echo"<td align='right'><b> $neto </b></td></tr></tbody>";
	$n++;
	$isal+=$sal;
	$itpr+=$tpr;

	$inet+=$net;
	$iall+=$allow;
	$ided+=$duct;
		$netb+=$net;
		   $itot+=$tot;
	}
	if($repo=='BANK'){
		   $netbo=number_format($netb);
		print("<thead><tr><th colspan='5' style='align:center; padding-left:80px; background-color:#66cccc;'> SUB-TOTAL [$banko] </th>
		<th style='text-align:right; background-color:#66cccc;'> $netbo </th></tr>");
	}
	}

			$isalo=number_format($isal);
		   $itpro=number_format($itpr);
		   $iallo=number_format($iall);
		   $idedo=number_format($ided);
		   $ineto=number_format($inet);
		   
		   $icsrio=number_format($icsri);
		   $icosto=number_format($icost);
		   $itoto=number_format($itot);

		   if($repo=='BANK')
				$col=5;
			else
				$col=3;

	print("<thead><tr><th colspan='$col' style='align:center; padding-left:80px;'> TOTAL AMOUNT </th>");

	if($repo!='BANK')
		print("<th><div style='text-align:right'> $isalo </div></th><th><div style='text-align:right'> $itpro </div></th>");

		$empoe=0;	
				$doi=mysql_query("SELECT *FROM `rolling` WHERE `Month`='$mt' AND `Year`='$yr' AND `Employee`>'0' ORDER BY `Number` ASC");
		while($roi=mysql_fetch_assoc($doi)){
			$des=$roi['Description'];
			$vue=$roi['Employee'];
		if($vue<100){
		$icsr=($vue/100*$isal);
		}
	else{
		$icsr=$vue*$fo;
		}
		   $icsro=number_format($icsr);
		$empoe+=$vu;
		if($repo!='BANK')
			echo"<th><div style='text-align:right'> $icsro </div></th>";
			  }	
			  if($repo=='FULL')
	print("<th><div style='text-align:right'> $iallo </div></th>
	<th><div style='text-align:right'> $idedo </div></th>");
			
			
	
	$empoe=0;	
				$doi=mysql_query("SELECT *FROM `rolling` WHERE `Month`='$mt' AND `Year`='$yr' AND `Employer`>'0' ORDER BY `Number` ASC");
		while($roi=mysql_fetch_assoc($doi)){
			$des=$roi['Description'];
			$vue=$roi['Employer'];
		if($vue<100){
		$icsr=($vue/100*$isal);
		}
	else{
		$icsr=$vue*$fo;
		}
		   $icsro=number_format($icsr);
		$empoe+=$vu;
		if($repo!='BANK')
			echo"<th><div style='text-align:right'> $icsro </div></th>";
			  }		
	
	if($repo!='PAYMENT')
	print("<th><div style='text-align:right'> $ineto </div></th>");

print("</tr></thead>");
	?>
              
                    </tbody>   
                  </table><br>

<table width='98%' style='font-size:11px;' border='0' class='myOtherTable'>
<tr style='height:20px;'>
<?php
	print("<form action='rollrepo.php' method=post><td width='15%'><div class='DONTPrint'><div align='left'>
	<INPUT TYPE=hidden NAME='year' VALUE='$yr'><INPUT TYPE=hidden NAME='month' VALUE='$mt'>
				<input type=submit name=search value='BACK' style='background-color:Transparent; width: 90px; 
				border: 0px; height: 20px; color: #FF0000; cursor:pointer;'/></div></div></td><td><center> &nbsp; </td>
	<td width='15%'><div class='DONTPrint'><div align='right'><input type=button onclick='javascript:printpage()' 
	VALUE='PRINT' style='background-color:Transparent; width: 90px; border: 0px; height: 20px; color: #FF0000; cursor:pointer;' /></div></div></td>");
				?></tr></table><br><br><br><br>
  
 
 </body></html>
