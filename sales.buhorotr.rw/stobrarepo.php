<?php
if(basename($_SERVER['PHP_SELF']) == 'stobrarepo.php') 
  $cm=" class='current'";
include'header.php';
include'connection.php';
$dato=$datos=$Date;
$conde=$custo=$diso='';
$duse='';
$brancho=$_SESSION['Branche'];
$duse=$_SESSION['Branchei'];

$t=$i=0;
$fiva="FIGURE";

if(isset($_POST['search']))
		{
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$custo=$_POST['custo'];
			$fiva=$_POST['fiva'];
			$duse=$_POST['duse'];
			$i=1;
		}
		
if(isset($_POST['open']))
		{
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$code=$_POST['code'];
			$custo=$_POST['custo'];
			$fiva=$_POST['fiva'];
			$duse=$_POST['duse'];
			$t=1;
		}

		if($custo){
			$conde="AND (`Iname` LIKE '%$custo%' OR `Descri` LIKE '%$custo%')";
			$lim=9999;
		}
		else{
			$conde='';
			$lim=1400;
		}

		if($i=='1')
			$limo="ORDER BY `Iname` ASC";
		else
			$limo="ORDER BY `Iname` ASC LIMIT 4000";
		
		if($dato==$datos)
			$mpri="ON $dato";
		else
			$mpri="FROM $dato TO $datos";

if($duse){
if($duse=='SNACKS'){
$fld="Produ";
$diso="AND `Destin`='PRODUCTION A'";
}
elseif($duse=='BAKERY'){
$fld="Prodi";
$diso="AND `Destin`='PRODUCTION B'";
}
else{
$doib=mysql_query("SELECT `Number` FROM `branches` WHERE `Name`='$duse' ORDER BY `Number` ASC");
			$roib=mysql_fetch_assoc($doib);
				$bra=$roib['Number'];
$fld="S$bra";
$diso="AND `Destin`='$duse'";
}
}

$do=mysql_query("SELECT *FROM `items` WHERE `Store`<='2' AND `Status`='0' $condi $conde $limo");
$fo=mysql_num_rows($do);
?>
<div class="container-fluid main-content">
        <div class="page-title hidden-print">
          <h2 style='margin-top:-20px; margin-bottom: 5px;'>
         Store Report
          </h2>
                 </div>
     
        <div class="row">
  <div class="col-lg-2 hidden-print">
   
 <ul class="list-group">

    <li class="list-group-item">
	  <a href="sarepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Sales Report
                </p>
              </a></li>    

    <li class="list-group-item">
	  <a href="surepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Item Used Report
                </p>
              </a></li> 

<li class="list-group-item">
	  <a href="preceive.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Purchase Report
                </p>
              </a></li> 

	 <li class="list-group-item">
	  <a href="brarepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Config Report
                </p>
              </a></li> 

	 <li class="list-group-item active">
	  <a href="stobrarepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Store Report
                </p>
              </a></li> 
                         
            </ul>
  </div>
                    
           
           
     <form action="" method="post" class="form-horizontal">   
        <div class="col-lg-10">
                  <div class="row">
         
           <div class="col-lg-1 hidden-print"> </div>
		   <div class="col-lg-2 hidden-print"> <select class="form-control" name="duse">
			<?php
			if($duse=='SNACKS')
					$p='selected';
				else
					$p='';

			if($duse=='BAKERY')
					$b='selected';
				else
					$b='';
if($brancho)
echo"<option value='$brancho' selected> $brancho </option>";
else{
				echo"<option value='' selected='selected'> SELECT DESTINATION </option>
				<option value='SNACKS' $p> SNACKS </option><option value='BAKERY' $b> BAKERY </option>";
			
	$dois=mysql_query("SELECT `Name` FROM `branches` ORDER BY `Number` ASC");
			while($rois=mysql_fetch_assoc($dois)){
				$fna=$rois['Name'];
				if($duse==$fna)
					$ti='selected';
				else
					$ti='';
			echo"<option value='$fna' $ti> $fna </option>";
			}
}
			?>		</select> </div>
           
<div class="col-lg-9 hidden-print"><div class="col-lg-2"> 
	<select class="form-control" name="fiva" required>
			  
			   <?php
			   if($fiva=='FIGURE')
			echo"<option value='FIGURE'> FIGURE </option><option value='VALUE'> VALUE </option>";
				else
			echo"<option value='VALUE'> VALUE </option><option value='FIGURE'> FIGURE </option>";
			?>    
                            </select>
		   
		   </div>  
		   
		   <div class="col-lg-2"> 
					   
	<input class="form-control form-center" id="searchu" name="custo" type="text" value="<?php echo $custo ?>" placeholder="Item Name">		   
					   
					   </div>
            <div class="col-lg-3"> 
           <div class="input-group date datepicker">
      <input class="form-control form-center" id="from" name="dato" type="text" value="<?php echo $dato ?>" onkeypress='return isNumberKey(event)' required>
	  <span class="input-group-addon"><i class="lnr lnr-calendar-full"></i></span>
			</div></div>


		  <div class="col-lg-3"> 
           <div class="input-group date datepicker">	
      <input class="form-control form-center" id="to" name="datos" type="text" value="<?php echo $datos ?>" onkeypress='return isNumberKey(event)' required>
	  <span class="input-group-addon"><i class="lnr lnr-calendar-full"></i></span>
              </div></div> 
          
		  
                      
                       
                       <div class="col-lg-2">
                        <button class="btn  btn-primary btn-block" type="submit" name="search"><i class="lnr lnr-magnifier"></i> Search</button>
                   
					  </div>
                         </div> 
                      
                     
                  
            </form>             
               
            </div>

			<div class="divFooter"><center><u><b>STORE REPORT <?php echo $mpri ?></b></u></center></div>
             <div class="row">
            <div class="col-lg-12">
             <br><span>&nbsp;&nbsp;</span>
			 <span class="pull-right hidden-print"><b><?php echo"$duse / $fiva "; ?></b>
			 &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer hidden-print"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">
               <?php
			   if($t==0){
				   ?>
                                 <table class="table table-hover table-sm table-striped">     
                                      <thead>
                     <tr role="row">
                     <th class="hidden-xs"> No </th>
                       <th> Item&nbsp;Name </th>
                        <th> Description </th>
                       <th> Item&nbsp;Type </th>
						 <th> Price/Unit </th>
                       <th> Count&nbsp;Unit </th>
                        <th><div align='center'> Open. </th><th><div align='center'> New </th>
						<th><div align='center'> Used </th><th><div align='center'> Clos. </th>
                     <th class="hidden-xs"> Open </th>
                     </tr>
                    </thead>
                                        <tbody>
					<?php
					$n=1;				$topen=$trec=$tuse=$tqt=0;	
						while($ro=mysql_fetch_assoc($do)){
				$code=$ro['Number'];
				$iname=$ro['Iname'];
			$kin=$ro['Type'];
			$descri=$ro['Descri'];
			$uno=$ro['Unit'];			
			$cost=$ro['Cost'];			$costo=number_format($cost, 2);
			if($duse==''){
				$qt=$ro['S1'] + $ro['S2'] + $ro['S3'] + $ro['S4'] + $ro['S5'] + $ro['S6'] + $ro['S7'] + $ro['S8'] + $ro['S9'] + $ro['S10'] + $ro['S11'] + $ro['S12'] + $ro['S13'] + $ro['S14'] + $ro['S15'] + $ro['Produ'] + $ro['Prodi'];
				}
			else{ 
			$qt=$ro["$fld"];
			}
			$smin=$ro['Smin'];
			$sval=$ro['Svalue'];
			$bmin=$ro['Bvalue'];
			$bval=$ro['Bvalue'];

			if($smin=='0' AND $sval=='0' AND $bmin=='0' AND $bval=='0')
				$stn="color:#3333cc; padding:1px;";
			else
				$stn="padding:1px;";

$doi=mysql_query("SELECT *FROM `itype` WHERE `Number`='$kin' ORDER BY `Number` ASC");
		$roi=mysql_fetch_assoc($doi);
				$type=$roi['Type'];

				$dox=mysql_query("SELECT *FROM `unit` WHERE `Number`='$uno' ORDER BY `Number` ASC");
					$rox=mysql_fetch_assoc($dox);
							$unit=$rox['Unit'];

	// received item on selected period
	$rec=$use=0;
	if($duse=='')
	$dor=mysql_query("SELECT *FROM `stouse` WHERE `Item`='$code' AND `Status`='0' AND `Voucher`!='0' AND `Upda`='1' AND `Date` BETWEEN '$dato' AND '$datos' AND `Action`='TAKEN' ORDER BY `Number` DESC");
	else
	$dor=mysql_query("SELECT *FROM `stouse` WHERE `Item`='$code' AND `Status`='0' AND `Voucher`!='0' AND `Upda`='1' AND `Date` BETWEEN '$dato' AND '$datos' AND `Action`='TAKEN' $diso ORDER BY `Number` DESC");
		while($ror=mysql_fetch_assoc($dor)){
						$act=$ror['Action'];
						$qts=$ror['Quantity'];
						$rec+=$qts;
						}

	// Used item on selected period
	if($duse=='')
	$dor=mysql_query("SELECT *FROM `brause` WHERE `Ingre`='$code' AND `Status`='0' AND `Date` BETWEEN '$dato' AND '$datos' ORDER BY `Number` DESC");
	else
	$dor=mysql_query("SELECT *FROM `brause` WHERE `Ingre`='$code' AND `Status`='0' AND `Date` BETWEEN '$dato' AND '$datos' $diso ORDER BY `Number` DESC");
		while($ror=mysql_fetch_assoc($dor)){
						$act=$ror['Sale'];
						$qts=$ror['Quantity'];
	$use+=$qts;
		}

		// received and used item affer selected period
	$xrec=$xuse=0;
	if($duse=='')
	$xdor=mysql_query("SELECT *FROM `stouse` WHERE `Item`='$code' AND `Status`='0' AND `Voucher`!='0' AND `Upda`='1' AND `Date` > '$datos' AND `Action`='TAKEN' ORDER BY `Number` DESC");
	else
	$xdor=mysql_query("SELECT *FROM `stouse` WHERE `Item`='$code' AND `Status`='0' AND `Voucher`!='0' AND `Upda`='1' AND `Date` > '$datos' AND `Action`='TAKEN' $diso ORDER BY `Number` DESC");
		while($xror=mysql_fetch_assoc($xdor)){
						$xact=$xror['Action'];
						$xqts=$xror['Quantity'];
						$xrec+=$xqts;
		}
		
		// Used item after selected period
	if($duse=='')
	$xdor=mysql_query("SELECT *FROM `brause` WHERE `Ingre`='$code' AND `Status`='0' AND `Date`>'$datos' ORDER BY `Number` DESC");
	else
	$xdor=mysql_query("SELECT *FROM `brause` WHERE `Ingre`='$code' AND `Status`='0' AND `Date`>'$datos' $diso ORDER BY `Number` DESC");
		while($xror=mysql_fetch_assoc($xdor)){
						$xact=$xror['Sale'];
						$xqts=$xror['Quantity'];
	$xuse+=$xqts;
		}

	$qt=$qt-$xrec+$xuse;

	$open=$qt-$rec+$use;
	
if($fiva=='VALUE'){
$dore=mysql_query("SELECT `Price` FROM `stouse` WHERE `Item`='$code' AND `Status`='0' AND `Voucher`!='0' AND `Action`='RECEIVE' AND `Upda`='1' AND `Date` <= '$datos' ORDER BY `Number` DESC LIMIT 1");
if($fore=mysql_num_rows($dore)){
	$rore=mysql_fetch_assoc($dore);
		$cost=$rore['Price'];
}	

	 $vopen=$open*$cost;
	 $vrec=$rec*$cost;
	 $vuse=$use*$cost;
	 $vqt=$qt*$cost;

         $rece=number_format($vrec, 2);					$uses=number_format($vuse, 2);				$opens=number_format($vopen, 2);
									$qty=number_format($vqt, 2);
						}
						else{

	 $rece=number_format($rec, 2);					$uses=number_format($use, 2);				$opens=number_format($open, 2);
									$qty=number_format($qt, 2);
						}

	if($rec!='0' OR $use!='0' OR $open!='0' OR $qt!='0'){
		print("<tr>
          <td class='hidden-xs' style='$stn'><div align='center'>$n&nbsp;&nbsp;</td>
			<td style='$stn'> $iname </td><td style='$stn'> $descri </td>
                <td style='$stn'> $type </td><td style='$stn'><div align='right'> $costo </td>
				<td style='$stn'> &nbsp;&nbsp; $unit </td><td style='$stn'><div align='right'> $opens </td>
					<td style='$stn'><div align='right'> $rece </td><td style='$stn'><div align='right'> $uses </td>
						<td style='$stn'><div align='right'> $qty&nbsp;&nbsp;</td>
						
						<form method=post action=''><td class='hidden-xs hidden-print' align='right' style='width:40px; padding:0px;'>
  <input type='hidden' name='code' value='$code'><input type='hidden' name='dato' value='$dato'><input type='hidden' name='fiva' value='$fiva'>
 <input type='hidden' name='datos' value='$datos'><input type='hidden' name='custo' value='$custo'><input type='hidden' name='duse' value='$duse'>
     <button type='submit' class='btn btn-xs btn-success hidden-print' name='open' style='height:18px; padding:0px; margin:0px;'>
						  &nbsp;&nbsp;<i class='lnr lnr-download'></i>&nbsp;&nbsp;</button></td></form>						  
				</tr>");
				  $n++;	
	}
									
			$tqt+=$vqt;				$topen+=$vopen;				$trec+=$vrec;			$tuse+=$vuse;
						}
$tqt=number_format($tqt, 2);		$topen=number_format($topen, 2);        $tuse=number_format($tuse, 2);        $trec=number_format($trec, 2);			
						?>
						
                    </tbody>
					<?php
						if($fiva=='VALUE'){
						?>
						<thead>
					<tr><th class='hidden-xs'> </th>
					<th colspan='5'><div align='center'> Total Amount </th>
					<th><div align='right'><?php echo $topen ?></th><th><div align='right'><?php echo $trec ?></th>
					<th><div align='right'><?php echo $tuse ?></th><th><div align='right'><?php echo $tqt ?></th>
					<th class='hidden-xs'> -- </th></tr>
					<?php
					}
						?>
                  </table>                  
                <?php
			}
					else{
						if($duse='')
	$do=mysql_query("SELECT *FROM `stouse` WHERE `Item`='$code' AND `Status`='0' AND `Voucher`!='0' AND `Upda`='1' AND `Date` BETWEEN '$dato' AND '$datos' AND `Action`='TAKEN' ORDER BY `Date` ASC, `Number` ASC");
						else
	$do=mysql_query("SELECT *FROM `stouse` WHERE `Item`='$code' AND `Status`='0' AND `Voucher`!='0' AND `Upda`='1' AND `Date` BETWEEN '$dato' AND '$datos' AND `Action`='TAKEN' $diso ORDER BY `Date` ASC, `Number` ASC");
						$fo=mysql_num_rows($do);
						?>

 <table class="table table-hover table-sm table-striped">     
                                      <thead>
                     <tr role="row">
                     <th class="hidden-xs"> No </th>
					 <th><div align='center'> Date </th>
                       <th> Item&nbsp;Name </th>
                        <th> Description </th>
                       <th> Destination </th>
						 <th> Price/Unit </th>
                       <th> Count&nbsp;Unit </th>
                        <th><div align='center'> Received </th><th><div align='center'>Used </th>
						<th><div align='center'> Closing </th>
                     </tr>
                    </thead>

<?php
	$n=1;
	$dov=mysql_query("SELECT *FROM `items` WHERE `Number`='$code' ORDER BY `Number` DESC LIMIT 1");
		$rov=mysql_fetch_assoc($dov);
			$code=$rov['Number'];
			$kin=$rov['Type'];
			$descri=$rov['Descri'];
			$uno=$rov['Unit'];
			$iname=$rov['Iname'];
			if($duse==''){
				$qty=$rov['S1'] + $rov['S2'] + $rov['S3'] + $rov['S4'] + $rov['S5'] + $rov['S6'] + $rov['S7'] + $rov['S8'] + $rov['S9'] + $rov['S10'] + $rov['S11'] + $rov['S12'] + $rov['S13'] + $rov['S14'] + $rov['S15'];
}
			else{ 
						$qty=$rov["$fld"];
			}
		$cost=$rov['Cost'];			$costo=number_format($cost, 2);

				$dox=mysql_query("SELECT *FROM `unit` WHERE `Number`='$uno' ORDER BY `Number` ASC");
					$rox=mysql_fetch_assoc($dox);
							$unit=$rox['Unit'];

		// received and used item affer selected period
	$xrec=$xuse=0;
	if($duse=='')
	$xdor=mysql_query("SELECT *FROM `stouse` WHERE `Item`='$code' AND `Status`='0' AND `Voucher`!='0' AND `Upda`='1' AND `Date` >= '$datos' AND `Action`='TAKEN' ORDER BY `Number` DESC");
	else
	$xdor=mysql_query("SELECT *FROM `stouse` WHERE `Item`='$code' AND `Status`='0' AND `Voucher`!='0' AND `Upda`='1' AND `Date` >= '$datos' AND `Action`='TAKEN' $diso ORDER BY `Number` DESC");
		while($xror=mysql_fetch_assoc($xdor)){
						$xact=$xror['Action'];
						$xqts=$xror['Quantity'];
						$xrec+=$xqts;
		}
		
		// Used item after selected period
	if($duse=='')
	$xdor=mysql_query("SELECT *FROM `brause` WHERE `Ingre`='$code' AND `Status`='0' AND `Date`>'$datos' ORDER BY `Number` DESC");
	else
	$xdor=mysql_query("SELECT *FROM `brause` WHERE `Ingre`='$code' AND `Status`='0' AND `Date`>'$datos' $diso ORDER BY `Number` DESC");
		while($xror=mysql_fetch_assoc($xdor)){
						$xact=$xror['Sale'];
						$xqts=$xror['Quantity'];
						$xuse+=$xqts;
		}

	$qty=$qty-$xrec+$xuse;
			$rec=$use=0;
				$clo=$qty;			$qto=number_format($qty, 2);

				print("<thead><tr TITLE='$code'>
          <th class='hidden-xs' style='$stn'><div align='center'> &nbsp;&nbsp;</th>
			<th style='$stn' colspan='6'><div align='center'> Opening stock on $dato </th><th style='$stn'><div align='right'><b> 0.00&nbsp;&nbsp;</th>
			<th style='$stn'><div align='right'><b> 0.00&nbsp;&nbsp;</th><th style='$stn'><div align='right'><b> $qto&nbsp;&nbsp;</th></tr></thead>
                                        <tbody>");

	$trec=$tuse=$use=$rec=0;	
	if(!$fo)
		$steo=$dato;
	$steos=$datos;
while($ro=mysql_fetch_assoc($do)){
				$code=$ro['Number'];
				$item=$ro['Item'];			
			$cost=$ro['Price'];			$costo=number_format($cost, 2);
			$qt=$ro['Quantity'];
			$dte=$ro['Date'];
			$type=$ro['Destin'];
						$act=$ro['Action'];
						$pers=$ro['Person'];
						$qts=$ro['Quantity'];
						$sing=$ro['Closing'];
						$steo=$dte;
if($act=='TAKEN'){
	$rec=$qts;
	$use=0;

if($pers)
	$perso=" / $pers";
}
$stn="padding:1px;";

$clo=$clo+$rec-$use;
$cloo=number_format($clo, 2);				$reco=number_format($rec, 2);					$useo=number_format($use, 2);

print("<tr title='$code'>
          <td class='hidden-xs' style='$stn'><div align='center'>$n&nbsp;&nbsp;</td>
			<td style='$stn'> $dte </td><td style='$stn'> $iname </td><td style='$stn'> $descri </td>
                <td style='$stn'> $type $perso </td><td style='$stn'><div align='right'> $costo &nbsp; </td>
				<td style='$stn'> $unit </td><td style='$stn'><div align='right'> $reco&nbsp;&nbsp;</td>
				<td style='$stn'><div align='right'> $useo&nbsp;&nbsp;</td><td style='$stn'><div align='right'> $cloo&nbsp;&nbsp;</td></tr>");
						  $n++;					$trec+=$rec;			$tuse+=$use;
		
		// **************************** Next date to be selected *********************************
						if($duse='')
	$doda=mysql_query("SELECT `Date` FROM `Stouse` WHERE `Date` > '$dte AND `Status`='0' AND `Item`='$code' AND `Action`='TAKEN' ORDER BY `Date` ASC, `Number` ASC LIMIT 1");
						else
	$doda=mysql_query("SELECT `Date` FROM `Stouse` WHERE `Date` > '$dte' AND `Status`='0' AND `Item`='$code' AND `Action`='TAKEN' $diso ORDER BY `Date` ASC, `Number` ASC LIMIT 1");
						if(!$foda=mysql_num_rows($doda))
							$steos=$datos;
						else{
							$roda=mysql_fetch_assoc($doda);
								$steos=$roda['Date'];
						}
// Used item on selected period
	if($duse=='')
	$dor=mysql_query("SELECT *FROM `brause` WHERE `Ingre`='$code' AND `Status`='0' AND `Date` > '$steo' AND `Date` <= '$steos' ORDER BY `Number` DESC");
	else
	$dor=mysql_query("SELECT *FROM `brause` WHERE `Ingre`='$code' AND `Status`='0' AND `Date` > '$steo' AND `Date` <= '$steos' $diso ORDER BY `Number` DESC");
		while($ror=mysql_fetch_assoc($dor)){
						$act=$ror['Sale'];
						$qts=$ror['Quantity'];
	$use=$qts;
	$rec=0;

	$clo=$clo+$rec-$use;
$cloo=number_format($clo, 2);				$reco=number_format($rec, 2);					$useo=number_format($use, 2);

print("<tr title='$code'>
          <td class='hidden-xs' style='$stn'><div align='center'>$n&nbsp;&nbsp;</td>
			<td style='$stn'> $dte </td><td style='$stn'> $iname </td><td style='$stn'> $descri </td>
                <td style='$stn'> $type $perso </td><td style='$stn'><div align='right'> $costo &nbsp; </td>
				<td style='$stn'> $unit </td><td style='$stn'><div align='right'> $reco&nbsp;&nbsp;</td>
				<td style='$stn'><div align='right'> $useo&nbsp;&nbsp;</td><td style='$stn'><div align='right'> $cloo&nbsp;&nbsp;</td></tr>");
						  $n++;					$trec+=$rec;			$tuse+=$use;
		}
		


						}
						if(!$fo){
			// Used item on selected period
	if($duse=='')
	$dor=mysql_query("SELECT *FROM `brause` WHERE `Ingre`='$code' AND `Status`='0' AND `Date` > '$steo' AND `Date` <= '$steos' ORDER BY `Number` DESC");
	else
	$dor=mysql_query("SELECT *FROM `brause` WHERE `Ingre`='$code' AND `Status`='0' AND `Date` > '$steo' AND `Date` <= '$steos' $diso ORDER BY `Number` DESC");
		while($ror=mysql_fetch_assoc($dor)){
						$act=$ror['Sale'];
						$dte=$ror['Date'];
						$qts=$ror['Quantity'];
	$use=$qts;
	$rec=0;

	$clo=$clo+$rec-$use;
$cloo=number_format($clo, 2);				$reco=number_format($rec, 2);					$useo=number_format($use, 2);

print("<tr title='$code'>
          <td class='hidden-xs' style='$stn'><div align='center'>$n&nbsp;&nbsp;</td>
			<td style='$stn'> $dte </td><td style='$stn'> $iname </td><td style='$stn'> $descri </td>
                <td style='$stn'> $type $perso </td><td style='$stn'><div align='right'> $costo &nbsp; </td>
				<td style='$stn'> $unit </td><td style='$stn'><div align='right'> $reco&nbsp;&nbsp;</td>
				<td style='$stn'><div align='right'> $useo&nbsp;&nbsp;</td><td style='$stn'><div align='right'> $cloo&nbsp;&nbsp;</td></tr>");
						  $n++;					$trec+=$rec;			$tuse+=$use;
		}
						}
						$treco=number_format($trec, 2);				$tuseo=number_format($tuse, 2);			$cloo=number_format($clo, 2);
						?>
						
                     </tbody><thead>
					<tr><th class='hidden-xs'> </th>
					<th colspan='6'><div align='center'> Closing stock on <?php echo $datos ?></th>
					<th><div align='right'><?php echo $treco ?>&nbsp;&nbsp;</th><th><div align='right'><?php echo $tuseo ?>&nbsp;&nbsp;</th>
					<th><div align='right'><?php echo $cloo ?>&nbsp;&nbsp;</th></tr>
                  </table>   

			<?php						
					}
						?>
              </div>
            </div></div>
                  </div> 
				  <span class="pull-right hidden-print">
			 &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
      
   </div></div></div>   
 
   <?php
   include'footer.php';
   ?>
