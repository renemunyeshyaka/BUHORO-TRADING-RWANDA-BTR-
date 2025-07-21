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
	$sd=$_SESSION['SD'];
	$ed=$_SESSION['ED'];

	if(isset($_POST['submit']))
		{
			$repot=$_POST['repot'];
$repo=$_POST['repo'];
		}

if($repo=='FIXED')
$conde="AND `Depart`='1' AND `Status`='0'";
if($repo=='CASUAL')
$conde="AND `Depart`='2' AND `Status`='0'";
if($repo=='SUSPEND')
$conde="AND `Status`='1'";
if($repo=='DELETED')
$conde="AND `Status`='2'";

$do=mysql_query("SELECT *FROM `employees` WHERE `Eid`!='1001' $conde");
$fo=mysql_num_rows($do);
?>

<table width='98%' style='font-size:11px;' border='0' class='myOtherTable'>
<tr style='height:20px;'>
<?php
	print("<form action='erepo.php' method=post><td width='20%'><div class='DONTPrint'><div align='left'>
<INPUT TYPE=hidden NAME='repo' VALUE='$repo'>
				<input type=submit name='search' value='BACK' style='background-color:Transparent; width: 90px; 
				border: 0px; height: 20px; color: #FF0000; cursor:pointer;'/></div></div></td></form><td><center>
<h1>EMPLOYEES REPORT</h1></td>
	<td width='20%'><div class='DONTPrint'><div align='right'><input type=button onclick='javascript:printpage()' 
	VALUE='PRINT' style='background-color:Transparent; width: 90px; border: 0px; height: 20px; color: #FF0000; cursor:pointer;' /></div></div></td>");
				?></tr></table>
                               <table  class="data-table" width='98%'>
                       <caption class="title">&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;</caption>
                                      <thead>
                    <tr>
		 <th class="hidden-xs"> S.NO</th> 
                       <th> First&nbsp;Name </th>
                       <th> Last&nbsp;Name</th> 
                       <th class="hidden-xs"> Calcul</th>
                       <th> Contact</th>
					   <th class="hidden-xs"> ID_Number</th>
					   <th class="hidden-xs"> Address</th>
					   <th class="hidden-xs"><center> Post</th>
					   <th><center> Salary</th>
					   <th class="hidden-xs"><center> Bank</th>
					   <th class="hidden-xs"><center> Stat_Date</th>
                     </tr>

 </thead>
                                        <tbody>
                                          
				<?php
				$n=1;
				while($ro=mysql_fetch_assoc($do)){
$code=$ro['Eid'];
$fna=$ro['Fname'];
$lna=$ro['Lname'];
$dep=$ro['Depart'];
$cont=$ro['Contact1'];
$idn=$ro['Idno'];
$pos=$ro['Currentp'];
$adde=$ro['Address'];
$sala=number_format($ro['Salary']);
$bank=$ro['Bank'];
$acco=$ro['Account'];
$std=$ro['Starting'];
if(!$bank AND !$acco)
$banko='';
else
$banko="$acco/$bank";

$then=mysql_query("SELECT `Depart` FROM `depart` WHERE `Number` = '$dep'");
$ren=mysql_fetch_assoc($then);
$dep=$ren['Depart'];

$theni=mysql_query("SELECT `Postname` FROM `position` WHERE `Postid` = '$pos'");
$reni=mysql_fetch_assoc($theni);
$pos=$reni['Postname'];

	print("<tr><td class='hidden-xs'> $n</td><td> $fna</td><td> $lna</td><td class='hidden-xs'><div align='left'> $dep</td>
	<td align='right'> $cont</td><td class='hidden-xs' align='right'> $idn</td><td class='hidden-xs'> $adde</td>
<td class='hidden-xs'> $pos</td><td><div align='right'> $sala</td><td class='hidden-xs'> $banko</td><td class='hidden-xs'> $std</td></tr>");
												$n++;
				}
				?>
                    </tbody>   
                  </table><br>

<table width='98%' style='font-size:11px;' border='0' class='myOtherTable'>
<tr style='height:20px;'>
<?php
	print("<form action='erepo.php' method=post><td width='15%'><div class='DONTPrint'><div align='left'>
	<INPUT TYPE=hidden NAME='repo' VALUE='$repo'>
				<input type=submit name='search' value='BACK' style='background-color:Transparent; width: 90px; 
				border: 0px; height: 20px; color: #FF0000; cursor:pointer;'/></div></div></td><td><center> &nbsp; </td>
	<td width='15%'><div class='DONTPrint'><div align='right'><input type=button onclick='javascript:printpage()' 
	VALUE='PRINT' style='background-color:Transparent; width: 90px; border: 0px; height: 20px; color: #FF0000; cursor:pointer;' /></div></div></td>");
				?></tr></table><br><br><br><br>
  
 
 </body></html>
