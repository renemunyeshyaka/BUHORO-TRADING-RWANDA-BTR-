<?php
if(basename($_SERVER['PHP_SELF']) == 'storeport.php') 
  $cm=" class='current'";
include'header.php';
include'connection.php';
$dato=$datos=$Date;
$conde=$custo='';
$t=$i=0;
$fiva="FIGURE";
$duse='';

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
			$types=$_POST['types'];
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
			$limo="ORDER BY `Star` DESC LIMIT 40";
		
		if($duse)
			$condi="AND `Store`='$duse'";
		else
			$condi="";

		if($dato==$datos)
			$mpri="ON $dato";
		else
			$mpri="FROM $dato TO $datos";

if($t==1)
$do=mysql_query("SELECT *FROM `stouse` WHERE ((`Date` BETWEEN '$dato' AND '$datos' AND `Status`='0' AND `Item`='$code' AND `Action`='RECEIVE' $condi) OR (`Date` BETWEEN '$dato' AND '$datos' AND `Status`='0' AND `Item`='$code' AND `Action`='TAKEN' $condi) OR (`Date` BETWEEN '$dato' AND '$datos' AND `Status`='0' AND `Item`='$code' AND `Action`='SALES' $condi)) ORDER BY `Date` ASC, `Number` ASC");
else
$do=mysql_query("SELECT *FROM `items` WHERE `Store`<='2' AND `Status`='0' $conde $limo");
$fo=mysql_num_rows($do);
?>
<div class="container-fluid main-content">
        <div class="page-title hidden-print">
          <h2 style='margin-top:-20px; margin-bottom: 5px; color:#ffcc33'>
         Store Report
          </h2>
                 </div>
     
        <div class="row">
  <div class="col-lg-2 hidden-print">
   
   <ul class="list-group">

    <li class="list-group-item active">
	  <a href="storeport.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Store Report
                </p>
              </a></li>  

	 <li class="list-group-item">
	  <a href="inrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;S.In Report
                </p>
              </a></li>  
      
    <li class="list-group-item">
	  <a href="outrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;S.Out Report
                </p>
              </a></li>   

			   <li class="list-group-item">
              <a href="transrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Transfer Report
                </p>
              </a></li> 

			   <li class="list-group-item">
              <a href="delirepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Delivery Report
                </p>
              </a></li>

			   <li class="list-group-item">
              <a href="recerepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Receiving Report
                </p>
              </a></li>

			  <li class="list-group-item">
              <a href="purrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Purchase Report
                </p>
              </a></li>   

	 <li class="list-group-item">
	  <a href="dispatch.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Count Report
                </p>
              </a></li>       

	 <li class="list-group-item">
	  <a href="stobal.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Item Report
                </p>
              </a></li>         

	 <li class="list-group-item">
	  <a href="wiserepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Stock-Wise Report
                </p>
              </a></li>  
                         
            </ul>
  </div>
                    
           
           
     <form action="" method="post" class="form-horizontal">   
        <div class="col-lg-10">
                  <div class="row">
         
           <div class="col-lg-1 hidden-print"> </div>
		   <div class="col-lg-3 hidden-print">
		   <div class="col-lg-6">
		<select class='form-control' name='duse' style="padding-left:5px; padding-right:5px;">
			<option value=''> STORE </option>
		<?php
	$dob=mysqli_query($cons, "SELECT *FROM `stores` WHERE `Status`>='0' ORDER BY `Number` ASC");
		while($rob=mysqli_fetch_assoc($dob)){
			$stonum=$rob['Store'];
			$stona=$rob['Name'];
			if($stonum==$stor)
				$s="selected";
			else
				$s="";
	echo"<option value='$stonum' $s> &nbsp;&nbsp; $stona </option>";
		}
				?>
		</select> </div>
           
    <div class="col-lg-6"> 
	<select class="form-control" name="fiva" required>
			  
			   <?php
			   if($fiva=='FIGURE')
			echo"<option value='FIGURE' selected> FIGURE </option><option value='VALUE'> VALUE </option>";
				else
			echo"<option value='VALUE' selected> VALUE </option><option value='FIGURE'> FIGURE </option>";
			?>    
                            </select>
		   
		   </div></div>  
		   
		   <div class="col-lg-8 hidden-print">
		   <div class="col-lg-4"> 
					   
	<input class="form-control form-left" id="searchu" name="custo" type="text" value="<?php echo $custo ?>" placeholder="Item Name">		   
					   
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
			 <span class="pull-right hidden-print">
			 &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer hidden-print"></i></a></span>
			 
			 <span class="pull-right hidden-print">
		&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" id="exporttable" class="hidden-print" title='Export to excell' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-line-spacing"></i></a></span>
		
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">
               <?php
					if($fiva=='STORE')
						$col="colspan='2'";
					else
						$col='';
			   if($t==0){
				   
                    echo"<table class='table table-hover table-sm table-striped'  id='htmltable'>     
                                      <thead>
                     <tr role='row'>
                     <th class='hidden-xs'> No </th>
                       <th> Brand&nbsp;Name </th><th> Item&nbsp;Name </th>";
				if($fiva!='STORE'){
					$coli=5;
                       echo"<th> Description </th>";
				}
				else
					$coli=4;

				echo"<th class='text-center'> Price </th><th class='text-center'> Unit </th><th $col><div align='center'> Opening </th><th $col><div align='center'> Received </th>
						<th $col><div align='center'> Sold/Out </th><th $col><div align='center'> Closing </th>
                     <th class='hidden-xs'> Open </th>
                     </tr>
                    </thead>
                                        <tbody>";
					
					$n=1;				$topen=$trec=$tuse=$tqt=0;	
						while($ro=mysql_fetch_assoc($do)){
				$code=$ro['Number'];
				$iname=$ro['Iname'];
			$kin=$ro['Type'];
			$descri=$ro['Descri'];
			$uno=$ro['Unit'];			
			$cost=$ro['Cost'];			$costo=number_format($cost, 2);

			if($duse)
				$qt=$ro["$duse"];
			else
				$qt=$ro['S1']+$ro['S2']+$ro['S3']+$ro['S4'];
			
			$smin=$ro['Smin'];
			$sval=$ro['Svalue'];
			$bmin=$ro['Bvalue'];
			$bval=$ro['Bvalue'];

				$stn="padding:1px;";

$doi=mysql_query("SELECT *FROM `itype` WHERE `Number`='$kin' ORDER BY `Number` ASC");
		$roi=mysql_fetch_assoc($doi);
				$type=$roi['Type'];

				$dox=mysql_query("SELECT *FROM `unit` WHERE `Number`='$uno' ORDER BY `Number` ASC");
					$rox=mysql_fetch_assoc($dox);
							$unit=$rox['Unit'];

	// received and used item on selected period
	$rec=$use=0;
	$dor=mysql_query("SELECT *FROM `stouse` WHERE `Item`='$code' AND `Status`='0' AND `Voucher`!='0' AND `Upda`='1' AND `Date` BETWEEN '$dato' AND '$datos' AND (`Action`='RECEIVE' OR `Action`='TAKEN' OR `Action`='SALES') $condi ORDER BY `Number` DESC");
		while($ror=mysql_fetch_assoc($dor)){
						$act=$ror['Action'];
						$qts=$ror['Quantity'];
						$stor=$duse;
						
						if($duse){
				if(($ror['Action']=='RECEIVE' AND $ror['Store']=='$stor') OR ($ror['Action']=='TRANSFER' AND $ror['Destin']=='$stor'))
	$rec+=$qts;

if(($ror['Action']=='TAKEN' AND $ror['Store']=='$stor') OR ($ror['Action']=='SALES' AND $ror['Store']=='$stor') OR ($ror['Action']=='TRANSFER' AND $ror['Store']=='$stor'))
	$use+=$qts;  
						}
						else{
if($act=='RECEIVE')
	$rec+=$qts;

if($act=='TAKEN' OR $act=='SALES')
	$use+=$qts;
		}
		}


		// received and used item after selected period
	$xrec=$xuse=0;
	$xdor=mysql_query("SELECT *FROM `stouse` WHERE `Item`='$code' AND `Status`='0' AND `Voucher`!='0' AND `Upda`='1' AND `Date`>'$datos' AND (`Action`='RECEIVE' OR `Action`='TAKEN' OR `Action`='SALES') $condi ORDER BY `Number` DESC");
		while($xror=mysql_fetch_assoc($xdor)){
						$xact=$xror['Action'];
						$xqts=$xror['Quantity'];
						
							if($duse){
				if(($xror['Action']=='RECEIVE' AND $xror['Store']=='$stor') OR ($xror['Action']=='TRANSFER' AND $xror['Destin']=='$stor'))
	$xrec+=$xqts;

if(($xror['Action']=='TAKEN' AND $xror['Store']=='$stor') OR ($xror['Action']=='SALES' AND $xror['Store']=='$stor') OR ($xror['Action']=='TRANSFER' AND $xror['Store']=='$stor'))
	$xuse+=$xqts;  
						}
						else{
if($xact=='RECEIVE')
	$xrec+=$xqts;

if($xact=='TAKEN' OR $xact=='SALES')
	$xuse+=$xqts;
		}
		}
		
	$qt=$qt-$xrec+$xuse;

	$open=$qt-$rec+$use;

if($fiva=='VALUE'){
	 $vopen=$open*$cost;
	 $vrec=$rec*$cost;
	 $vuse=$use*$cost;
	 $vqt=$qt*$cost;	
				
				$tqt+=$vqt;				$topen+=$vopen;				$trec+=$vrec;			$tuse+=$vuse;

         $rece=number_format($vrec, 2);					$uses=number_format($vuse, 2);				$opens=number_format($vopen, 2);
									$qty=number_format($vqt, 2);
						}
						else{

	 $rece=number_format($rec, 2);					$uses=number_format($use, 2);				$opens=number_format($open, 2);
									$qty=number_format($qt, 2);
						}

	if($iname){
		print("<tr>
          <td class='hidden-xs' style='$stn'><div align='center'>$n&nbsp;&nbsp;</td>
			<td style='$stn'> $type </td><td style='$stn'> $iname </td>");
			
			if($fiva!='STORE'){
				echo"<td style='$stn'> $descri </td>";
				$opo=$roco=$solo=$colo='';
			}
			else{
				$vopen=$open*$cost;
				$vrec=$rec*$cost;
				$vuse=$use*$cost;
				$vqt=$qt*$cost;

$vreco=number_format($vrec, 2);				$vuseo=number_format($vuse, 2);			$vopeno=number_format($vopen, 2);			$vqto=number_format($vqt, 2);

				$opo="<td style='$stn'><div align='right'> $vopeno&nbsp;&nbsp;</td>";
				$roco="<td style='color:blue; $stn'><div align='right'> $vreco&nbsp;&nbsp;</td>";
				$solo="<td style='color:#66cc00; $stn'><div align='right'> $vuseo&nbsp;&nbsp;</td>";
				$colo="<td style='color:blue; $stn'><div align='right'> $vqto&nbsp;&nbsp;</td>";	
				
				$tqt+=$vqt;				$topen+=$vopen;				$trec+=$vrec;			$tuse+=$vuse;
			}
			
			echo("<td style='$stn'><div align='right'> $costo </td>
				<td style='$stn'> &nbsp;&nbsp; $unit </td>
				<td style='$stn'><div align='right'> $opens </td>$opo
					<td style='color:blue; $stn'><div align='right'> $rece </td>$roco
					<td style='color:#66cc00; $stn'><div align='right'> $uses </td>$solo
						<td style='color:blue; $stn'><div align='right'> $qty </td>$colo
						
						<form method=post action=''><td class='hidden-xs hidden-print' align='right' style='width:40px; padding:0px;'>
  <input type='hidden' name='code' value='$code'><input type='hidden' name='dato' value='$dato'><input type='hidden' name='fiva' value='$fiva'>
  <input type='hidden' name='types' value='$type'>
                              <input type='hidden' name='datos' value='$datos'> <input type='hidden' name='custo' value='$custo'>
                          <button type='submit' class='btn btn-xs btn-success hidden-print' name='open' style='height:18px; padding:0px; margin:0px;'>
						  &nbsp;&nbsp;<i class='lnr lnr-download'></i>&nbsp;&nbsp;</button></td></form>						  
				</tr>");
				  $n++;	
	}
									
		
						}
$tqt=number_format($tqt, 2);		$topen=number_format($topen, 2);        $tuse=number_format($tuse, 2);        $trec=number_format($trec, 2);			
						?>
						
                    </tbody>
					<?php
						if($fiva!='FIGURE'){
							echo"<thead>
					<tr><th class='hidden-xs'> </th>
					<th colspan='$coli'><div align='center'> Total Amount </th>
					<th $col><div align='right'> $topen </th><th style='color:blue;' $col><div align='right'> $trec </th>
					<th style='$color:#66cc00' $col><div align='right'> $tuse </th><th style='color:blue;' $col><div align='right'> $tqt </th>
					<th class='text-right hidden-xs'> -- </th></tr>";
					}
						?>
                  </table>                  
                <?php
			}
					else{
						?>

 <table class="table table-hover table-sm table-striped" id="htmltable">     
                                      <thead>
                     <tr role="row">
                     <th class="hidden-xs"> No </th>
					 <th><div align='center'> Date </th>
                        <th> Store </th>
                       <th> Item&nbsp;Name </th>
                       <th> Destination </th>
						 <th> Price/Unit </th>
                        <th><div align='center'> Received </th><th><div align='center'>Sold/Out </th>
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
						$cost=$rov['Cost'];		
						$costo=number_format($cost, 2);

				$dox=mysql_query("SELECT *FROM `unit` WHERE `Number`='$uno' ORDER BY `Number` ASC");
					$rox=mysql_fetch_assoc($dox);
							$unit=$rox['Unit'];
							$stor=$duse;


							// received and used item affer selected period
	$xrec=$xuse=0;
	$xdor=mysql_query("SELECT *FROM `stouse` WHERE ((`Item`='$code' AND `Status`='0' AND `Voucher`!='0' AND `Upda`='1' AND `Date`>='$dato' AND `Action`='RECEIVE' $condi) OR (`Item`='$code' AND `Status`='0' AND `Voucher`!='0' AND `Upda`='1' AND `Date`>='$dato' AND `Action`='TAKEN' $condi) OR (`Item`='$code' AND `Status`='0' AND `Voucher`!='0' AND `Upda`='1' AND `Date`>='$dato' AND `Action`='SALES' $condi)) OR (`Item`='$code' AND `Status`='0' AND `Voucher`!='0' AND `Upda`='1' AND `Date`>='$dato' AND `Action`='TRANSFER' $condi) OR (`Item`='$code' AND `Status`='0' AND `Voucher`!='0' AND `Upda`='1' AND `Date`>='$dato' AND `Action`='SALES' $condi)) ORDER BY `Number` DESC");
		while($xror=mysql_fetch_assoc($xdor)){
						$xact=$xror['Action'];
						$xqts=$xror['Quantity'];
						$cost=$xrov['Price'];
						$costo=number_format($cost, 2);
						
						if($duse){
						    if(($xror['Action']=='RECEIVE' AND $xror['Store']=='$stor') OR ($xror['Action']=='TRANSFER' AND $xror['Destin']=='$stor'))
	$xrec+=$xqts;

if(($xror['Action']=='TAKEN' AND $xror['Store']=='$stor') OR ($xror['Action']=='SALES' AND $xror['Store']=='$stor') OR ($xror['Action']=='TRANSFER' AND $xror['Store']=='$stor'))
	$xuse+=$xqts;
						}
            else{
if($xact=='RECEIVE')
	$xrec+=$xqts;

if($xact=='TAKEN' OR $xact=='SALES')
	$xuse+=$xqts;
		}
		}
	$qty=$qty-$xrec+$xuse;
			$rec=$use=0;
				$clo=$qty;			$qto=number_format($qty, 2);

				print("<thead><tr TITLE='$code'>
          <th class='hidden-xs' style='$stn'><div align='center'> &nbsp;&nbsp;</th>
			<th style='$stn' colspan='5'><div align='center'> Opening stock on $dato </th><th style='$stn'><div align='right'><b> 0.00 </th>
			<th style='$stn'><div align='right'><b> 0.00 </th><th style='$stn'><div align='right'><b> $qto </th></tr></thead>
                                        <tbody>");

	$trec=$tuse=0;			
while($ro=mysql_fetch_assoc($do)){
				$code=$ro['Number'];
				$item=$ro['Item'];			
			$cost=$ro['Price'];			$costo=number_format($cost, 2);
			$qt=$ro['Quantity'];
			$dte=$ro['Date'];
			$deso=$ro['Destin'];
			$stok=$ro['Store'];
			
	$dob=mysqli_query($cons, "SELECT `Name` FROM `stores` WHERE `Store`='$stok' ORDER BY `Number` ASC LIMIT 1");
		$rob=mysqli_fetch_assoc($dob);
			$stok=$rob['Name'];
			
						$act=$ro['Action'];
						$pers=$ro['Person'];
			if($duse)
				$qts=$ro["$duse"];
			else
				$qts=$ro['Quantity'];
						$sing=$ro['Closing'];
						
				$type=$roi['Type'];
				
						
		if($duse){
if(($ro['Action']=='RECEIVE' AND $ro['Store']=='$stor') OR ($ro['Action']=='TRANSFER' AND $ro['Destin']=='$stor')){
	$rec+=$qts;
	$use=0;
	$perso='';
	$cls="color:blue;";
}

if(($ro['Action']=='TAKEN' AND $ro['Store']=='$stor') OR ($ro['Action']=='SALES' AND $ro['Store']=='$stor') OR ($ro['Action']=='TRANSFER' AND $ro['Store']=='$stor')){
	$use+=$qts;  
	$rec=0;
	$cls="";

if($pers)
	$perso=" / $pers";
}
						}
						else{
				
if($act=='RECEIVE'){
	$rec=$qts;
	$use=0;
	$perso='';
	$cls="color:blue;";
}

if($act=='TAKEN' OR $act=='SALES'){
	$use=$qts;
	$rec=0;
	$cls="";

if($pers)
	$perso=" / $pers";
}
}
$stn="padding:1px;";

$clo=$clo+$rec-$use;
$cloo=number_format($clo, 2);				$reco=number_format($rec, 2);					$useo=number_format($use, 2);

print("<tr title='$code'>
          <td class='hidden-xs' style='$stn $cls'><div align='center'>$n&nbsp;&nbsp;</td>
			<td style='$stn $cls'> $dte </td>
			<td style='$stn $cls'> $stok </td>
			<td style='$stn $cls'> $iname </td>
                <td style='$stn $cls'> $deso $perso </td><td style='$stn $cls'><div align='right'> $costo&nbsp;/&nbsp;$unit </td><td style='$stn $cls'><div align='right'> $reco&nbsp;&nbsp;</td>
				<td style='$stn $cls'><div align='right'> $useo&nbsp;&nbsp;</td><td style='$stn $cls'><div align='right'> $cloo&nbsp;&nbsp;</td></tr>");
						  $n++;					$trec+=$rec;		
						  $tuse+=$use;              $perso='';
						}
						$treco=number_format($trec, 2);				$tuseo=number_format($tuse, 2);			
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
			 
			 <span class="pull-right hidden-print">
		&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" id="exporttable" class="hidden-print" title='Export to excell' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-line-spacing"></i></a></span>
      
   </div></div></div>   
 
   <?php
   include'footer.php';
   ?>
