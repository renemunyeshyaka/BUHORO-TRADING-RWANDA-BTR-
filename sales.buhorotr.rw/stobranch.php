<?php
if(basename($_SERVER['PHP_SELF']) == 'stobranch.php') 
  $bb=" class='current'";
include'header.php';
include'connection.php';
$dato=$datos=$Date;
$conde=$custo=$condi='';

 $brc=$_SESSION['BR'];	
 $doib=mysql_query("SELECT `Name` FROM `branches` WHERE `Number`='$brc' ORDER BY `Number` ASC");
			$roib=mysql_fetch_assoc($doib);
				$bra=$roib['Name'];

$fld="S$brc";

$t=$i=0;
$fiva="FIGURE";

if(isset($_POST['search']))
		{
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$custo=$_POST['custo'];
			$fiva=$_POST['fiva'];
			$i=1;
		}
		
if(isset($_POST['open']))
		{
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$code=$_POST['code'];
			$custo=$_POST['custo'];
			$fiva=$_POST['fiva'];
			$t=1;
		}

		if($custo){
			$conde="AND (`items`.`Iname` LIKE '%$custo%' OR `items`.`Descri` LIKE '%$custo%' OR `itype`.`Type` LIKE '%$custo%')";
		}
		else{
			$conde='';
		}

		if($i=='1')
			$limo="GROUP BY `items`.`Number` ORDER BY `itype`.`Type` ASC";
		else
	$limo="GROUP BY `items`.`Number` ORDER BY `itype`.`Type` ASC LIMIT 4000";
		
		if($dato==$datos)
			$mpri="ON $dato";
		else
			$mpri="FROM $dato TO $datos";

if($bra)
	$dsa="";
else
	$dsa="style='pointer-events: none;'";

$do=mysql_query("SELECT `items`.* FROM `items` INNER JOIN `itype` ON `items`.`Type` = `itype`.`Number` WHERE `items`.`Store`='1' AND `items`.`Status`='0' $conde $limo");
$fo=mysql_num_rows($do);
?>
<div class="container-fluid main-content">
        <div class="page-title hidden-print">
          <h2 style='margin-top:-20px; margin-bottom: 5px; color:#ffcc33'>
         Sales/Payment
          </h2>
                 </div>
     
        <div class="row">
  <div class="col-lg-2 hidden-print">
   
   <ul class="list-group">

	   <li class="list-group-item active">
              <a href="stobranch.php" <?php echo $dsa ?>>
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Store Status
                </p>
              </a></li>

   <li class="list-group-item">
	  <a href="createa.php" <?php echo $dsa ?>>
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Create Account
                </p>
              </a></li> 

   <li class="list-group-item">
	  <a href="dadd.php" <?php echo $dsa ?>>
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Pay on Account
                </p>
              </a></li>   

   <li class="list-group-item">
	  <a href="cashbox.php" <?php echo $dsa ?>>
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Add to Cashbox
                </p>
              </a></li> 

   <li class="list-group-item">
	  <a href="madd.php" <?php echo $dsa ?>>
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Make a Payout
                </p>
              </a></li> 
                       
            </ul>
			<?php
			if($brc>='1'){
				?>

		<br><br>
  
				 <ul class="list-group text-left">
        <?php
        if($_SESSION['Acrepo']){
            ?>
   <li class="list-group-item" style="border:1px dashed #cccccc; border-radius:5px; margin:0px 0px 4px 0px;">
	  <a href="urepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Sales Report
                </p>
              </a></li> 
              <?php
        }
        else{
        ?>
   <li class="list-group-item" style="border:1px dashed #cccccc; border-radius:5px; margin:0px 0px 4px 0px;">
	  <a href="irepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Control Report
                </p>
              </a></li> 
              <?php
        }
        ?>

			   <li class="list-group-item" style="border:1px dashed #cccccc; border-radius:5px; margin:0px 0px 4px 0px;">
	  <a href="transit.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Payment Report
				<?php
$doq=mysqli_query($cons, "SELECT `Amount` FROM `payment` WHERE `Status`='0' AND `Action`='SALES' AND `Branche`='$brc' AND `Voucher`='0' ORDER BY `Number` ASC");
				if($foq=mysqli_num_rows($doq))
echo"<span class='badge' style='float:right; font-size:12px; margin-right:0px; margin-top:0px; height:18px; background-color:#ffcc66; width:auto;'> $foq </span>";
					?>
                </p>
              </a></li> 

   <li class="list-group-item" style="border:1px dashed #cccccc; border-radius:5px; margin:0px 0px 4px 0px;">
	  <a href="isrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Cashiers Report
                </p>
              </a></li>  
			  
			  <li class="list-group-item" style="border:1px dashed #cccccc; border-radius:5px; margin:0px 0px 4px 0px;">
	  <a href="bopi.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Bank Deposit
                </p>
              </a></li>
	</ul>
			  <?php
			}
   ?>
  </div>
           
           
     <form action="" method="post" class="form-horizontal">   
        <div class="col-lg-10">
                  <div class="row">
         
           <div class="col-lg-1 hidden-print"> </div>
           
            <div class="col-lg-2"> 
	<select class="form-control" name="fiva" required>
			  
			   <?php
			   if($fiva=='FIGURE')
			echo"<option value='FIGURE'> FIGURE </option><option value='VALUE'> VALUE </option>";
				else
			echo"<option value='VALUE'> VALUE </option><option value='FIGURE'> FIGURE </option>";
			?>    
                            </select>
		   
		   </div>  
		   
		   <div class="col-lg-3"> 
					   
	<input class="form-control" id="searchu" name="custo" type="text" value="<?php echo $custo ?>" placeholder="Item Name">		   
					   
					   </div><div class="col-lg-6 hidden-print">
            <div class="col-lg-4"> 
           <div class="input-group date datepicker">
      <input class="form-control form-center" id="from" name="dato" type="text" value="<?php echo $dato ?>" onkeypress='return isNumberKey(event)' required>
	  <span class="input-group-addon"><i class="lnr lnr-calendar-full"></i></span>
			</div></div>


		  <div class="col-lg-4"> 
           <div class="input-group date datepicker">	
      <input class="form-control form-center" id="to" name="datos" type="text" value="<?php echo $datos ?>" onkeypress='return isNumberKey(event)' required>
	  <span class="input-group-addon"><i class="lnr lnr-calendar-full"></i></span>
              </div></div> 
          
		  
                      
                       
                       <div class="col-lg-3">
                        <button class="btn  btn-primary btn-block" type="submit" name="search"><i class="lnr lnr-magnifier"></i> Search</button>
                   
					  </div>
                         </div> 
                      
                     
                  
            </form>             
               
            </div>

			<div class="divFooter"><center><u><b>STORE REPORT <?php echo $mpri ?></b></u></center></div>
             <div class="row">
            <div class="col-lg-12">
             <br><span>&nbsp;&nbsp;</span>
			 <span class="pull-right hidden-print"><b><?php echo" $fo &nbsp;&nbsp;|&nbsp;&nbsp; $bra"; ?></b>
			 &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer hidden-print"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">
               <?php
			   if($t==0){
				   ?>
                                 <table class="table table-hover table-sm table-striped">     
                                      <thead>
                     <tr role="row">
                     <th class="hidden-xs">&nbsp;&nbsp;&nbsp;&nbsp;No&nbsp;&nbsp;</th><th> Brand&nbsp;Name </th>
                       <th> Item&nbsp;Name </th><th> Description </th>
                       <th class='text-center' colspan='2'> Price/Unit </th>
                        <th><div align='center'> Opening </th><th><div align='center'> Received </th>
						<th><div align='center'> Sold/Out </th><th><div align='center'> Closing </th>
                     <th class="hidden-xs"> Open </th>
                     </tr>
                    </thead>
                                        <tbody>
					<?php
					$n=1;				$topen=$trec=$tuse=$tqt=0;	        $fld="Quantity";
						while($ro=mysql_fetch_assoc($do)){
				$code=$ro['Number'];
				$iname=$ro['Iname'];
			$kin=$ro['Type'];
			$descri=$ro['Descri'];
			$uno=$ro['Unit'];			
			$cost=$ro['Price'];			$costo=number_format($cost, 2);
				$qt=$ro["$fld"];
				$stn="padding:1px;";

$doi=mysql_query("SELECT *FROM `itype` WHERE `Number`='$kin' ORDER BY `Number` ASC");
		$roi=mysql_fetch_assoc($doi);
				$type=$roi['Type'];

				$dox=mysql_query("SELECT *FROM `unit` WHERE `Number`='$uno' ORDER BY `Number` ASC");
					$rox=mysql_fetch_assoc($dox);
							$unit=$rox['Unit'];

		// Received item on selected period
			$rec=$use=$qts=0;
	$dor=mysql_query("SELECT *FROM `stouse` WHERE `Item`='$code' AND `Status`='0' AND `Voucher`!='0' AND `Upda`='1' AND `Date` BETWEEN '$dato' AND '$datos' AND `Action`='RECEIVE' ORDER BY `Number` DESC");
		while($ror=mysql_fetch_assoc($dor)){
						$act=$ror['Action'];
						$qts=$ror['Quantity'];
						$rec+=$qts;
						}

		// Sold item on selected date
			$qts=0;
	$dors=mysql_query("SELECT *FROM `stouse` WHERE `Item`='$code' AND `Status`='0' AND `Voucher`!='0' AND `Upda`='1' AND `Date` BETWEEN '$dato' AND '$datos' AND (`Action`='SALES' OR `Action`='TAKEN') ORDER BY `Number` DESC");
		while($rors=mysql_fetch_assoc($dors)){
						$act=$rors['Sale'];
						$qts=$rors['Quantity'];
	$use+=$qts;
		}

		// Received and used item affer selected period
			$xrec=$xuse=$xqts=0;
	$xdor=mysql_query("SELECT *FROM `stouse` WHERE `Item`='$code' AND `Status`='0' AND `Voucher`!='0' AND `Upda`='1' AND `Date` > '$datos' AND `Action`='RECEIVE' AND `Destin`='$bra' ORDER BY `Number` DESC");
		while($xror=mysql_fetch_assoc($xdor)){
						$xact=$xror['Action'];
						$xqts=$xror['Quantity'];
						$xrec+=$xqts;
		}
		
		// Sold item after selected period
			$xqts=0;
	$xdors=mysql_query("SELECT *FROM `stouse` WHERE `Item`='$code' AND `Status`='0' AND `Voucher`!='0' AND `Upda`='1' AND `Date` > '$datos' AND (`Action`='SALES' OR `Action`='TAKEN')' ORDER BY `Number` DESC");
		while($xrors=mysql_fetch_assoc($xdor)){
						$xact=$xrors['Sale'];
						$xqts=$xrors['Quantity'];
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
          <td class='hidden-xs' style='$stn'><div align='right'>$n&nbsp;&nbsp;&nbsp;&nbsp;</td><td style='$stn'> $type </td>
			<td style='$stn'> $iname </td><td style='$stn'> $descri </td>
                <td style='$stn'><div align='right'> $costo </td>
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
	$do=mysql_query("SELECT *FROM `stouse` WHERE (`Item`='$code' AND `Status`='0' AND `Voucher`!='0' AND `Upda`='1' AND `Date` BETWEEN '$dato' AND '$datos' AND `Action`='RECEIVE') OR (`Item`='$code' AND `Status`='0' AND `Voucher`!='0' AND `Upda`='1' AND `Date` BETWEEN '$dato' AND '$datos' AND `Action`='SALES') OR (`Item`='$code' AND `Status`='0' AND `Voucher`!='0' AND `Upda`='1' AND `Date` BETWEEN '$dato' AND '$datos' AND `Action`='TAKEN') ORDER BY `Date` ASC, `Number` ASC");
						$fo=mysql_num_rows($do);
						?>

 <table class="table table-hover table-sm table-striped">     
                                      <thead>
                     <tr role="row">
                     <th class="hidden-xs">&nbsp;&nbsp;&nbsp;&nbsp;No </th>
					 <th><div align='center'> Date </th>
                       <th> Item&nbsp;Name </th>
                       <th> Destination </th><th colspan='2'> Price/Unit </th>
                        <th><div align='center'> Received </th><th><div align='center'>Sold&nbsp;Out </th>
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
			$qty=$rov['Quantity'];
		
				$cost=$rov['Price'];									$costo=number_format($cost, 2);

				$dox=mysql_query("SELECT *FROM `unit` WHERE `Number`='$uno' ORDER BY `Number` ASC");
					$rox=mysql_fetch_assoc($dox);
							$unit=$rox['Unit'];

		// Received item affer selected period
	$xrec=$xuse=$xqts=0;
	$xdor=mysql_query("SELECT *FROM `stouse` WHERE `Item`='$code' AND `Status`='0' AND `Voucher`!='0' AND `Upda`='1' AND `Date` >= '$dato' AND `Action`='RECEIVE' ORDER BY `Number` DESC");
		while($xror=mysql_fetch_assoc($xdor)){
						$xact=$xror['Action'];
						$xqts=$xror['Quantity'];
						$xrec+=$xqts;
		}
		
		// Sold item after selected period
			$xqts=0;
	$xdor=mysql_query("SELECT *FROM `stouse` WHERE (`Item`='$code' AND `Status`='0' AND `Voucher`!='0' AND `Upda`='1' AND `Date` >= '$dato' AND `Action`='SALES') OR (`Item`='$code' AND `Status`='0' AND `Voucher`!='0' AND `Upda`='1' AND `Date` >= '$dato' AND `Action`='TAKEN') ORDER BY `Number` DESC");
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
			<th style='$stn' colspan='5'><div align='center'> Opening stock on $dato </th><th style='$stn'><div align='right'><b> 0.00</th>
			<th style='$stn'><div align='right'><b> 0.00</th><th style='$stn'><div align='right'><b> $qto</th></tr></thead>
                                        <tbody>");

	$trec=$tuse=$use=$rec=0;
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
if($act=='RECEIVE'){
	$perso="";
	$rec=$qts;
	$use=0;
	
	if(!$_SESSION['Acrepo']){
				    $costo="******&nbsp;&nbsp;";
				}
				else{
				    $costo=number_format($cost, 2);
				}
				$cls="color:blue;";
}
else{
	$rec=0;
	$use=$qts;
	$perso="";
				$cls="";
}

$stn="padding:1px;";

$clo=$clo+$rec-$use;
$cloo=number_format($clo, 2);				$reco=number_format($rec, 2);					$useo=number_format($use, 2);

print("<tr title='$code'>
          <td class='hidden-xs' style='$stn $cls'><div align='center'>$n&nbsp;&nbsp;</td>
			<td style='$stn $cls'> $dte </td><td style='$stn $cls'> $iname </td><td style='$stn $cls'> $type $perso </td>
			<td style='$stn $cls'><div align='right'> $costo &nbsp; </td><td style='$stn $cls'> $unit </td><td style='$stn $cls'><div align='right'> $reco&nbsp;&nbsp;</td>
				<td style='$stn $cls'><div align='right'> $useo&nbsp;&nbsp;</td><td style='$stn $cls'><div align='right'> $cloo&nbsp;&nbsp;</td></tr>");
						  $n++;					$trec+=$rec;			$tuse+=$use;
		}
						
						$treco=number_format($trec, 2);				$tuseo=number_format($tuse, 2);			$cloo=number_format($clo, 2);
						?>
						
                     </tbody><thead>
					<tr><th class='hidden-xs'> </th>
					<th colspan='5'><div align='center'> Closing stock on <?php echo $datos ?></th>
					<th><div align='right'><?php echo $treco ?></th><th><div align='right'><?php echo $tuseo ?></th>
					<th><div align='right'><?php echo $cloo ?></th></tr>
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
