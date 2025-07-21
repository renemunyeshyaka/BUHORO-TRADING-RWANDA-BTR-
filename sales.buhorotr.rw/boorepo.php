<?php
if(basename($_SERVER['PHP_SELF']) == 'boorepo.php') 
  $bb=" class='current'";
include'connection.php';
$dato=$datos=$Date;
$custo='';
$conde='';
$t=$p=$k=0;
 $brc=$_SESSION['BR'];	

  // reprint a proforma invoice
if(isset($_POST['reprint']))
		{
			$vous=$_POST['vous'];
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$custo=$_POST['custo'];
			$clie=$_POST['clie'];
			$deso=$_POST['deso'];
			$plino=$_POST['plino'];
			$empo=$ro['empo'];
			$dte=$_POST['dte'];
			$tme=$_POST['tme'];
			$pla=$_POST['pla'];
			$p=$_POST['p'];
			$requi=4;
			$t=$k=1;

$so=mysql_query("UPDATE `stouse` SET `Printed`='2' WHERE `Voucher`='$vous' AND `Action`='PROFORMA' AND `Status`='10' ORDER BY `Number` ASC LIMIT 100");
			include'creceipt.php';
		}

include'header.php';
 $doib=mysql_query("SELECT `Name` FROM `branches` WHERE `Number`='$brc' ORDER BY `Number` ASC");
			$roib=mysql_fetch_assoc($doib);
				$bra=$roib['Name'];

$fld="S$brc";

// search for an item to be added to the chart
if(isset($_POST['search']))
		{
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$custo=$_POST['custo'];
			$p=1;
		}

// open for a given requisition to mark as taken
if(isset($_POST['open']))
		{
			$vous=$_POST['vous'];
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$custo=$_POST['custo'];
			$dte=$_POST['dte'];
			$p=$_POST['p'];
			$t=1;
		}

		// Return back to orders list
if(isset($_POST['back']))
		{
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$custo=$_POST['custo'];
			$custo=$_POST['custo'];
			$p=$_POST['p'];
		}

// Delete a given PROFORMA order
if(isset($_POST['delo']))
		{
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$vous=$_POST['vous'];
			$custo=$_POST['custo'];
			$p=$_POST['p'];
			$t=$_POST['t'];
	$so=mysql_query("DELETE FROM `stouse` WHERE `Action`='PROFORMA' AND `Voucher`='$vous' AND `Status`='10' ORDER BY `Number` ASC LIMIT 100");
	
//	$sso=mysql_query("DELETE FROM `payment` WHERE `Action`='PROFORMA' AND `Voucher`='$vous' AND `Status`='0' ORDER BY `Number` ASC LIMIT 100");

			include'amens.php';
		}
		
		if(!$_SESSION['Acrepo'])
		    $datos=$dato;


        if($dato==$datos)
			$mpri="ON $dato";
		else
			$mpri="FROM $dato TO $datos";
			
			

		if($custo)
			$conde="AND `Destin`='$custo'";
		else
			$conde='';
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

	   <li class="list-group-item">
              <a href="proforma.php" <?php echo $dsa ?>>
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Create New Proforma
                </p>
              </a></li>

   <li class="list-group-item active">
	  <a href="boorepo.php" <?php echo $dsa ?>>
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Proformas` Report
                </p>
              </a></li>  

	   <li class="list-group-item">
              <a href="branches.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Sales/Payment
                </p>
              </a></li>  
                       
            </ul><br><br>
  
				 <ul class="list-group text-left">
        <?php
        if($_SESSION['Acrepo']=='1000'){
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
$doq=mysql_query("SELECT `Amount` FROM `payment` WHERE `Status`='0' AND `Action`='PROFORMA' AND `Voucher`='0' ORDER BY `Number` ASC");
				if($foq=mysql_num_rows($doq))
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
			
             ?>
  </div>
                    
           
           
       
        <div class="col-lg-10">
                  <div class="row">
         
           <div class="col-lg-4"> </div>
          
         
           

        <form action="" method="post" class="form-horizontal "> 
    <div class="col-lg-3"><select class="form-control" name="custo">
			   <option value='' selected> ALL CUSTOMERS </option>
			   
		<?php
	$seco=mysql_query("SELECT `Destin` FROM `stouse` WHERE `Action`='PROFORMA' AND `Status`='10' AND `Voucher`!='0' GROUP BY `Destin` ORDER BY `Destin` ASC");
	while($reco=mysql_fetch_assoc($seco)){
	    $deso=$reco['Destin'];
	    if($deso==$custo)
	        $s="selected";
	     else
	        $s="";
	
		echo"<option value='$deso' $s>$deso</option>";
		}
		?></select></div>                   
        <div class="col-lg-5 hidden-print">
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
                        <button class="btn  btn-primary btn-block" type="<?php echo $dbutn ?>" name="search" title="<?php echo $disa ?>" data-toggle='tooltip' data-placement='top'><i class="lnr lnr-magnifier"></i> Search</button>
                   
					  </div>
                         </div> 
                      
                     
                  
            </form> 
             
               
            </div>
               <?php
			   if($t==0){
				   if($p)
		$do=mysql_query("SELECT *FROM `stouse` WHERE `Date` BETWEEN '$dato' AND '$datos' AND `Voucher`!='0' AND `Status`='10' $conde GROUP BY `Voucher` ORDER BY `Voucher` ASC LIMIT 400");
				   else
		$do=mysql_query("SELECT *FROM `stouse` WHERE `Date`<='$Date' AND `Voucher`!='0' AND `Status`='10' GROUP BY `Voucher` ORDER BY `Date` DESC LIMIT 15");
				if($fo=mysql_num_rows($do)){
				   ?>
            <div class="divFooter"><center><u><b>PROFORMAS` REPORT <?php echo $mpri ?></b></u></center></div>     
             <div class="row">
            <div class="col-lg-12">
             <span> &nbsp;&nbsp; Total Records Found : <b><?php echo" $fo " ?></b></span> 
			 <span class="pull-right"><?php echo $bra ?>&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">

			<div class="table-responsive">
				<table class="table table-striped table-hover">     
                                      <thead>
                    <tr role="row">
                     <th class="hidden-xs"> No </th> 
                       <th><div align='left'> Date </th><th> Cashier </th>
                        <th> Customer </th><th> Reference </th>
                <th> Voucher&nbsp;No </th><th class='text-center'> Items </th>
			    <th><div align='right'>Total&nbsp;Amount&nbsp;&nbsp;</th>
        <th class='text-center'> Status </th><th class="hidden-xs hidden-print" style="width:40px; text-align:center;" colspan='3'> Options </th>
                     </tr>
                    </thead>
                                        <tbody>
					<?php
					$n=1;				$tp=$tpa=$tba=0;
						while($ro=mysql_fetch_assoc($do)){
				$vou=$ro['Voucher'];
				$dte=$ro['Date'];
				$des=$ro['Branche'];
				$tme=$ro['Time'];
				$cashier=$ro['User'];
				$ftype=$ro['Invoice'];
				$dest=$ro['Destin'];
				$comme=$ro['Comment'];
	
	$doibi=mysql_query("SELECT `Number` FROM `account` WHERE `Customer`='$dest' ORDER BY `Number` ASC");
					$roibi=mysql_fetch_assoc($doibi);
						$clie=$roibi['Number'];

				$to=0;              $sold=0;
$dor=mysql_query("SELECT `Price`, SUM(Quantity) AS 'QTO', `Sales` FROM `stouse` WHERE `Voucher`='$vou' AND `Status`='10' AND `Action`='PROFORMA' GROUP BY `Item`, `Price` ORDER BY `Number` ASC");
			$for=mysql_num_rows($dor);
				while($ror=mysql_fetch_assoc($dor)){
				$pri=$ror['Price'];
				$qty=$ror['QTO'];
			    $to+=$pri*$qty;
			    $sold+=$ror['Sales'];
				}
			
			if($sold)
			    $stat="<font color='blue'>SOLD</font>";
			else
			    $stat="<font color='pink'>WAITING</font>";	
				
		if($_SESSION['Cancel']){
			 $dbutn='submit';
			 $disa='';
		 }
		 else{
			 $dbutn='button';
			 $disa='disabled';
		 }
						$too=number_format($to, 2);

						$stn="padding:1px;";
						
						/*
			
			$plino='';		    $pay=0;	
	$doil=mysql_query("SELECT `Pline`, `Description`, `Amount` FROM `payment` WHERE `Voucher`='$vou' AND `Action`='PROFORMA' AND `Status`='0' AND `Pline`!='CREDIT' ORDER BY `Number` ASC");
		    while($roil=mysql_fetch_assoc($doil)){
				$plin=$roil['Pline'];
				$plino="$plino $plin";
				$deso=$roil['Description'];
				$pay+=$roil['Amount'];
		    }
		    
                    $payo=number_format($pay, 2);
                    $bal=$to-$pay;
                    $balo=number_format($bal, 2);
                    
            */
            
	// ************************************ Delete confirmation modal ******************************************

						echo"<div class='modal fade' id='exampleModal$n' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true' 
		style='top:220px;'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLabel'>DELETE CONFIRMATION 
<label class='text-right pull-right'> $dest &nbsp;&nbsp; <b>$too</b> </label></h5>

      </div>
      <div class='modal-body' style='height:40px;'>
        <h5 style='color:#ff0033'>Are you sure you want to delete this proforma?</h5>
      </div><form method='post' action=''>
      <input type='hidden' name='vous' value='$vou'>
      <input type='hidden' name='p' value='$p'> 
      <input type='hidden' name='t' value='$t'> 
		<input type='hidden' name='dato' value='$dato'> 
		<input type='hidden' name='datos' value='$datos'>
       <input type='hidden' name='custo' value='$custo'>
      <div class='modal-footer' style='margin-top:-10px; height:50px; padding-top:5px; border:0px solid blue;'>
        <button type='button' class='btn btn-sm btn-success' data-dismiss='modal'>&nbsp;NO&nbsp;</button>
        <button type='$dbutn' name='delo' class='btn btn-sm btn-danger' $disa>YES</button>
      </div></form>
    </div>
  </div>
</div>";



				// *********************************** Edit confirmation modal *************************************

echo"<div class='modal fade' id='exampleModalo$n' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true' 
		style='top:220px;'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLabel'>AMENDMENT CONFIRMATION 
<label class='text-right pull-right'> $dest &nbsp;&nbsp; <b>$too</b> </label></h5>

      </div>
      <div class='modal-body' style='height:40px;'>
        <h5 style='color:#ff0033'>Are you sure you want to amend this proforma?</h5>
      </div><form method='post' action='proforma.php'>
      <input type='hidden' name='vous' value='$vou'>
      <input type='hidden' name='custo' value='$custo'> 
		<input type='hidden' name='dato' value='$dato'> 
		<input type='hidden' name='datos' value='$datos'>
      <div class='modal-footer' style='margin-top:-10px; height:50px; padding-top:5px; border:0px solid blue;'>
        <button type='button' class='btn btn-sm btn-success' data-dismiss='modal'>&nbsp;NO&nbsp;</button>
        <button type='$dbutn' name='amend' class='btn btn-sm btn-danger' $disa>YES</button>
      </div></form>
    </div>
  </div>
</div>";




		print("<tr><td class=hidden-xs style='$stn'><div align='center'>$n&nbsp;&nbsp;</td><td style='$stn'> $dte </td>
    <td style='$stn'> $cashier </td><td style='$stn'> $dest </td><td style='$stn'> $comme </td><td style='$stn'><div align='center'> $vou </td><td style='$stn' class='text-center'> $for </td><td style='$stn'><div align='right'> $too &nbsp;</td><td style='$stn'><div align='center'> $stat &nbsp;</td>
						
		<td class='hidden-xs hidden-print' align='right' style='width:30px; padding:0px;'>
       <button type='submit' class='btn btn-xs btn-warning hidden-print' style='height:18px; padding:0px; margin:0px;' title='Edit' data-placement='top' data-toggle='modal' data-target='#exampleModalo$n' $disa>&nbsp;&nbsp;<i class='lnr lnr-pencil'></i>&nbsp;&nbsp;</button></td></form>
						  
            <td class='hidden-xs hidden-print' align='right' style='width:30px; padding:0px;'>
       <button type='button' class='btn btn-xs btn-danger hidden-print' title='Delete' style='height:18px; padding:0px; margin:0px;'
	    data-placement='top' data-toggle='modal' data-target='#exampleModal$n' $disa>
						  &nbsp;&nbsp;<i class='lnr lnr-trash'></i>&nbsp;&nbsp;</button></td>
						  
						  <form method=post action=''><td class='hidden-xs hidden-print' align='right' style='width:30px; padding:0px;'>
						<input type='hidden' name='p' value='$p'>
						<input type='hidden' name='dte' value='$dte'>
       <input type='hidden' name='vous' value='$vou'> 
       <input type='hidden' name='dato' value='$dato'>
       <input type='hidden' name='datos' value='$datos'>
       <input type='hidden' name='custo' value='$custo'>
       <input type='hidden' name='deso' value='$deso'>
       <input type='hidden' name='plino' value='$plino'>
       <button type='submit' class='btn btn-xs btn-success hidden-print' name='open' style='height:18px; padding:0px; margin:0px;' title='Open' data-toggle='tooltip' data-placement='top'>&nbsp;&nbsp;<i class='lnr lnr-download'></i>&nbsp;&nbsp;</button></td></form></tr>");
				$n++;		$tp+=$to;       
				//$tpa+=$pay;         $tba+=$bal;

    //$so=mysql_query("UPDATE `stouse` SET `Client`='$clie' WHERE `Voucher`='$vou' AND `Action`='PROFORMA' AND `Status`='10' ORDER BY `Number` ASC LIMIT 100");
    //$so=mysql_query("UPDATE `payment` SET `Client`='$clie', `Upda`='1' WHERE `Voucher`='$vou' AND `Action`='PROFORMA' ORDER BY `Number` ASC LIMIT 100");
						}
						$tpo=number_format($tp, 2);
					//	$tpa=number_format($tpa, 2);
					//	$tba=number_format($tba, 2);	
						?>
						
                     </tbody>

					 <thead>
					<tr><th class="hidden-xs"> </th><th colspan='6'><div align='center'> Total Amount </th><th><div align='right'><?php echo $tpo ?> </th><th> &nbsp; </th><th colspan='3' class="hidden-xs hidden-print"><div align='center'> - - - </th></tr>
                  </table><br></div>

				  
				  <?php
				}
				 else{
						echo"<div class='row'>
            <div class='col-lg-12' style='margin-top:-20px;'>
             <span> &nbsp;&nbsp; Total Records Found : <b> 0 </b></span>
			 <span class='pull-right hidden-print'> $bra &nbsp;&nbsp;<a href='#' onclick='return window.print()' class='hidden-print' title='Click to print' data-toggle='tooltip' data-placement='top'><i class='lnr lnr-printer'></i></a></span>
            <div class='widget-container fluid-height clearfix'>
            <div class='widget-content padded clearfix'>
			<br><br><br><br><br><br>
						<div style='text-align:center; font-size:24px; color:#ff3333'> There is no proforma on selected date </div><br><br><br><br><br><br><br>";
					}  
			}
				   else{
		$dor=mysql_query("SELECT *, SUM(Quantity) AS 'QTY' FROM `stouse` WHERE `Voucher`='$vous' AND `Status`='10' GROUP BY `Item`,`Price` ORDER BY `Number` ASC");
				if($for=mysql_num_rows($dor)){
					?>

		<div class="divFooter"><center><u><b>PROFORMA REPORT <?php echo"ON $dte"; ?></b></u></center></div>
		 <div class="row">
            <div class="col-lg-12">
             <span> &nbsp;&nbsp; Total Records Found : <b><?php echo" $for " ?></b></span>
			 <span class="pull-right hidden-print"><?php echo $bra ?>&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">

				<div class="table-responsive">
					<table class="table table-striped table-hover">     
                                      <thead>
								<tr role="row">
                     <th class="hidden-xs"> &nbsp;No </th>
                    <th class='text-align:center'> Date </th>
                       <th> Cashier </th><th> Customer </th>
                       <th class='text-center'> Item&nbsp;Name </th>
                       <th colspan='2'>&nbsp;&nbsp;Quantity&nbsp;&nbsp;</th>
						 <th> Sales&nbsp;Price </th>
						<th>Total&nbsp;Amount</th>
                        <th class="hidden-xs hidden-print" style="text-align:center;"> Status </th>
                     </tr>
                    </thead>
                                        <tbody>
										<?php
	$n=1;			$tot=0;
					while($ror=mysql_fetch_assoc($dor)){
						$code=$ror['Number'];
						$item=$ror['Item'];
						$sale=$ror['Price'];
						$qt=$ror['QTY'];
						$des=$ror['Invoice'];
						$vous=$ror['Voucher'];
				$dte=$ror['Date'];
				$tme=$ror['Time'];
				$cashier=$ror['User'];
				$tnu=$ror['Destin'];
				$upri=$ror['Uprice'];
				$clie=$ror['Client'];
				$sales=$ror['Sales'];
			
			if($ror['Otype']=='SOLD' AND $sales)
			    $stat="<font color='blue'>SOLD</font>";
			else
			    $stat="<font color='pink'>WAITING</font>";

				$stn="padding:1px;";

	$do=mysql_query("SELECT *FROM `items` WHERE (`Iname`='$item' AND `Price`='$sale') OR (`Number`='$item') ORDER BY `Number` DESC LIMIT 1");
		$ro=mysql_fetch_assoc($do);
			$iname=$ro['Iname'];
			$kin=$ro['Type'];
			$descri=$ro['Descri'];
			$uno=$ro['Unit'];
			
	$doi=mysql_query("SELECT *FROM `itype` WHERE `Number`='$kin' ORDER BY `Number` ASC");
		$roi=mysql_fetch_assoc($doi);
				$type=$roi['Type'];

	$qty=number_format($qt, 2);			$costo=number_format($cost, 2);			$sales=number_format($sale, 2);			$qto=number_format($qt, 2);

          $to=$sale*$qt;				$too=number_format($to, 2);			$qino=number_format($qin, 2);
          
    	$plino='';			
	$doil=mysql_query("SELECT `Pline`, `Description` FROM `payment` WHERE `Voucher`='$vous' AND `Action`='PROFORMA' ORDER BY `Number` ASC");
		    while($roil=mysql_fetch_assoc($doil)){
				$plin=$roil['Pline'];
				$plino="$plino $plin";
				$deso=$roil['Description'];
		    }
				
		print("<tr><td class='hidden-xs' style='$stn'><div align='center'><b>$vous&nbsp;&nbsp;</td><td style='$stn'> $dte </td><td style='$stn'> $cashier </td><td style='$stn'> $tnu </td>
		<td style='$stn'> $iname </td><td style='$stn'><div align='right'> $qty </td><td style='$stn'> $unit </td><td style='$stn'><div align='right'>&nbsp;$sales&nbsp;</td>
		<td style='$stn'><div align='right'>$too&nbsp;&nbsp;</td>
	<td class='hidden-xs hidden-print text-center' style='$stn'> $stat </td></tr>");
						  $n++;				$tot+=$to;
						}
						$toto=number_format($tot, 2);
						
							
				
		if($_SESSION['Cancel']){
			 $dbutn='submit';
			 $disa='';
		 }
		 else{
			 $dbutn='button';
			 $disa='disabled';
		 }


				// ********************************* Delete confirmation modal *******************************************

	echo"<div class='modal fade' id='exampleModaldel' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'	style='top:220px;'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'><div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLabel'>DELETE CONFIRMATION 
<label class='text-right pull-right'> $tnu &nbsp;&nbsp; <b>$toto</b> </lable></h5>

      </div>
      <div class='modal-body' style='height:40px;'>
        <h5 style='color:#ff0033'>Are you sure you want to delete this proforma?</h5>
      </div><form method='post' action=''><input type='hidden' name='vous' value='$vous'><input type='hidden' name='p' value='$p'> 
		<input type='hidden' name='dato' value='$dato'> <input type='hidden' name='datos' value='$datos'><input type='hidden' name='custo' value='$custo'>
      <div class='modal-footer' style='margin-top:-10px; height:50px; padding-top:5px; border:0px solid blue;'>
        <button type='button' class='btn btn-sm btn-success' data-dismiss='modal'>&nbsp;NO&nbsp;</button>
        <button type='$dbutn' name='delo' class='btn btn-sm btn-danger' $disa>YES</button>
      </div></form>
    </div>
  </div>
</div>";
			// ********************************** End of modal *********************************************



// ********************************** Edit confirmation modal ************************************

echo"<div class='modal fade' id='exampleModaledo' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true' style='top:220px;'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'><div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLabel'>AMENDMENT CONFIRMATION 
<label class='text-right pull-right'> $tnu &nbsp;&nbsp; <b>$toto</b> </label></h5>

      </div>
      <div class='modal-body' style='height:40px;'>
        <h5 style='color:#ff0033'>Are you sure you want to amend this proforma?</h5>
      </div><form method='post' action='proforma.php'><input type='hidden' name='vous' value='$vous'><input type='hidden' name='custo' value='$custo'> 
		<input type='hidden' name='dato' value='$dato'> <input type='hidden' name='datos' value='$datos'>
      <div class='modal-footer' style='margin-top:-10px; height:50px; padding-top:5px; border:0px solid blue;'>
        <button type='button' class='btn btn-sm btn-success' data-dismiss='modal'>&nbsp;NO&nbsp;</button>
        <button type='$dbutn' name='amend' class='btn btn-sm btn-danger' $disa>YES</button>
      </div></form>
    </div>
  </div>
</div>";
			// ********************************** End of modal *********************************************
			
			
			// ********************************** Edit confirmation modal ************************************
			
	$do=mysql_query("SELECT *FROM `stouse` WHERE `Status`='0' AND `Voucher`='0' AND `User`='$loge' ORDER BY `Number` DESC LIMIT 100");
				if($fo=mysql_num_rows($do)){
				    $disal="disabled readonly";
				    $disol="data-dismiss='modal'";
				    $note="<h5 style='color:#ff0033'>Your cart is not empty, please check it!</h5>";

$bone="<button type='button' class='btn btn-sm btn-warning' data-dismiss='modal' style='width:180px;'><i class='lnr lnr-reply'> CLOSE </button>";
				}
				else{
		$note="<h5>Are you sure you want to sale this proforma?</h5>";
$bone="<button type='button' class='btn btn-sm btn-danger' data-dismiss='modal' style='width:80px;'>&nbsp;NO&nbsp;</button>
        <button type='submit' name='ameni' class='btn btn-sm btn-success' style='width:80px;'>YES</button>";
				}

echo"<div class='modal fade' id='exampleModalede' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true' style='top:220px;'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'><div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLabel'>SALE THIS PROFORMA 
<label class='text-right pull-right'> $tnu &nbsp;&nbsp; <b>$toto</b> </label></h5>

      </div></form>
      <div class='modal-body' style='height:80px;'> $note
      </div><form method='post' action='branches.php'><input type='hidden' name='vous' value='$vous'><input type='hidden' name='custo' value='$custo'> 
		<input type='hidden' name='dato' value='$dato'> <input type='hidden' name='datos' value='$datos'>
      <div class='modal-footer' style='margin-top:-10px; height:50px; padding-top:5px; border:0px solid blue;'>
       $bone </div></form>
    </div></div></div>";
			// ********************************** End of modal *********************************************
						?>
						
                    </tbody>

					 <thead>
					<tr><th class="hidden-xs"> </th>
					<form action='' method='post'>
					<?php 
			echo"<input type='hidden' name='dato' value='$dato'>
			<input type='hidden' name='datos' value='$datos'>
			<input type='hidden' name='p' value='$p'>
			<input type='hidden' name='custo' value='$custo'>
       <input type='hidden' name='deso' value='$deso'>
       <input type='hidden' name='plino' value='$plino'>
		<input type='hidden' name='dte' value='$dte'>
		<input type='hidden' name='tme' value='$tme'>
			<input type='hidden' name='pla' value='$tnu'>
			<input type='hidden' name='empo' value='$cashier'>
		<input type='hidden' name='vous' value='$vous'>
		<input type='hidden' name='clie' value='$clie'>";

	echo"<th class='text-right'><button type='submit' class='btn btn-xs btn-info hidden-print' name='back' style='height:18px; padding:0px; margin:0px; width:80px;' title='Back to orders list' data-toggle='tooltip' data-placement='top'>&nbsp;&nbsp;<i class='lnr lnr-chevron-left-circle'></i>&nbsp;&nbsp;Back&nbsp;&nbsp;</button></th><th>";
		
			if($k=='0'){
					 ?>
					 
					 <button type='submit' class='btn btn-xs btn-default hidden-print' name='reprint' style='height:18px; padding:0px; margin:0px; width:80px;' title='Back to orders list' data-toggle='tooltip' data-placement='top'>&nbsp;&nbsp;<i class='lnr lnr-printer'></i>&nbsp;&nbsp;Reprint&nbsp;&nbsp;</button>
					 
					 <?php
		}
					 ?></th></form>

						  <th class='text-right'>
       <button type='button' class='btn btn-xs btn-warning hidden-print' style='height:18px; padding:0px; margin:0px; width:80px;' title='Edit' data-placement='top' data-toggle='modal' data-target='#exampleModaledo' <?php echo $disa ?>>&nbsp;&nbsp;<i class='lnr lnr-pencil'></i>&nbsp;&nbsp;Edit&nbsp;&nbsp;</button></th>
       
       <th class='text-right'><button type='button' class='btn btn-xs btn-danger hidden-print' title='Delete' style='height:18px; padding:0px; margin:0px;width:80px;'
	    data-placement='top' data-toggle='modal' data-target='#exampleModaldel' <?php echo $disa?>>
						  &nbsp;&nbsp;<i class='lnr lnr-trash'></i>&nbsp;Delete&nbsp;</button></th>
						  
		<?php
		echo"<th title='Sale this proforma' data-toggle='tooltip' data-placement='top'>
		<input type='hidden' name='dato' value='$dato'>
			<input type='hidden' name='datos' value='$datos'>
			<input type='hidden' name='p' value='$p'>
			<input type='hidden' name='custo' value='$custo'>
       <input type='hidden' name='deso' value='$deso'>
       <input type='hidden' name='plino' value='$plino'>
		<input type='hidden' name='dte' value='$dte'>
		<input type='hidden' name='vous' value='$vous'>
		<input type='hidden' name='clie' value='$clie'>
	<button type='button' class='btn btn-xs btn-success hidden-print' data-toggle='modal' data-target='#exampleModalede' style='height:18px; padding:0px; margin:0px; width:80px;'>&nbsp;&nbsp;<i class='lnr lnr-cart'></i>&nbsp;&nbsp;Sale&nbsp;&nbsp;</button></th>";
		?>

					<th colspan='2'><div align='center'> Total Amount </th>
					<th><div align='right'><?php echo $toto ?>&nbsp;&nbsp;</th>
					<th class="hidden-xs hidden-print"><div align='center'> - - </th></form></tr>
                  </table><br></div>

				<?php
				}
					else{
						echo"<div class='row'>
            <div class='col-lg-12' style='margin-top:-20px;'>
             <span> &nbsp;&nbsp; Total Records Found : <b> 0 </b></span>
			 <span class='pull-right hidden-print'> $bra &nbsp;&nbsp;<a href='#' onclick='return window.print()' class='hidden-print' title='Click to print' data-toggle='tooltip' data-placement='top'><i class='lnr lnr-printer'></i></a></span>
            <div class='widget-container fluid-height clearfix'>
            <div class='widget-content padded clearfix'>
			<br><br><br><br><br><br>
						<div style='text-align:center; font-size:24px; color:#ff9999'>Proforma not found on selected date </div><br><br><br><br><br><br><br>";
					}
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
