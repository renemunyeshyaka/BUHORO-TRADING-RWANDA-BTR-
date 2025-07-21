<?php
if(basename($_SERVER['PHP_SELF']) == 'transit.php') 
  $bb=" class='current'";
include'header.php';
include'connection.php';
$dato=$datos=$Date;
$custo='';
$conde=$waiter='';
$t=$i=0;
 $brc=$_SESSION['BR'];	
 $doib=mysqli_query($cons, "SELECT `Name` FROM `branches` WHERE `Number`='$brc' ORDER BY `Number` ASC");
			$roib=mysqli_fetch_assoc($doib);
				$bra=$roib['Name'];

$fld="S$brc";

// search for cashbox report
if(isset($_POST['search']))
		{
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$custo=$_POST['custo'];
			$waiter=$_POST['waiter'];
			$i=1;
		}

// delete a given record from cashbox report
if(isset($_POST['delo']))
		{
			$custo=$_POST['custo'];
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$custo=$_POST['custo'];
			$client=$_POST['client'];
			$waiter=$_POST['waiter'];
			$nuos=$_POST['nuos'];
			$to=$_POST['to'];
			$ba=$_POST['ba'];
			$vous=$_POST['vous'];
			$bna=$_POST['bna'];
			$refe=$_POST['refe'];
			$dest=$_POST['dest'];
			$cre=$_POST['cre'];
			$amo=$_POST['amo'];
			$i=$_POST['i'];
			
if($dest=='SALES'){
	$tbs=mysqli_query($cons, "UPDATE `stouse` SET `Paid`='0' WHERE `Voucher`='$vous' AND `Action`='SALES' AND `Client`='$client' AND `Branche`='$brc' ORDER BY `Number` ASC LIMIT 100");

   if($cre>0)
  $crd=mysqli_query($cons, "UPDATE `account` SET `Balance`=`Balance`-'$cre' WHERE `Customer`='$client' AND `Branche`='$brc' ORDER BY `Number` ASC LIMIT 1");
			}

			 if($dest=='PAYMENT')
  $crd=mysqli_query($cons, "UPDATE `account` SET `Balance`=`Balance`+'$amo' WHERE `Customer`='$client' AND `Branche`='$brc' ORDER BY `Number` ASC LIMIT 1");

	 if($ba>0)
  $crd=mysqli_query($cons, "UPDATE `deposit` SET `Status`='1' WHERE `Customer`='$client' AND `Amount`='$ba' AND `Operation`='$dest' AND `Account`='$bna' AND `Date`='$cda' AND `Refer`='$refe' AND `Voucher`='$vous' AND `Branche`='$brc' ORDER BY `Number` ASC LIMIT 1");

			$andi=mysqli_query($cons, "UPDATE `payment` SET `Status`='1', `Upda`='0' WHERE `Number`='$nuos' AND `Action`='$dest' ORDER BY `Number` ASC LIMIT 1");

			$andu=mysqli_query($cons, "DELETE FROM `supay` WHERE `Payno`='$nuos' AND `Supplier`='$client' ORDER BY `Number` ASC LIMIT 1000");
				}
		
		if(!$_SESSION['Acrepo']){
		    $i=1;
		    $datos=$dato;
		}

		if($dato==$datos)
			$mpri="ON $dato";
		else
			$mpri="FROM $dato TO $datos";

if($waiter)
	$condi="AND `Cashier`='$waiter'";
else
	$condi='';

/*
	if($custo==''){
		$custoo="SALES";
		$conde="AND `Action`='SALES'";
	}
	*/
	if($custo){
		$custoo=$custo;
		$conde="AND `Action`='$custo'";
	}
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
              <a href="stobranch.php" <?php echo $dsa ?>>
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Store Status
                </p>
              </a></li>

   <li class="list-group-item">
	  <a href="dadd.php" <?php echo $dsa ?>>
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
                       
            </ul><br>
			<?php
			if($brc>='1'){
				?>
<center>
<?php
/*
if($_SESSION['Phyc']){
?>
			<a href="counte.php" class="btn btn-warning" style="width:100%;"><i class="lnr lnr-layers">&nbsp;Physical Count</i></a>
<?php
}
*/
?>
		<br>
  
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

			   <li class="list-group-item active" style="border:1px dashed #cccccc; border-radius:5px; margin:0px 0px 4px 0px;">
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
                    
           
           
       
        <div class="col-lg-10">
                  <div class="row">
            <div class="col-lg-2">  </div>

        <form action="" method="post" class="form-horizontal ">           
                         
                       <div class="col-lg-12 hidden-print"> 
         
           <div class="col-lg-2"> 
			   </div>
			
			<div class="col-lg-2"> 					
					   <select class="form-control" name="custo">
			<?php
				echo"<option value='' selected='selected'> DESTINATION </option>";
				
			$doi=mysqli_query($cons, "SELECT `Action` FROM `payment` WHERE `Action`!='' GROUP BY `Action` ORDER BY `Action` ASC");
			while($roi=mysqli_fetch_assoc($doi)){
				$fnas=$roi['Action'];
				if($custo==$fnas)
					$s='selected';
				else
					$s='';
			echo"<option value='$fnas' $s> $fnas </option>";
			}
				?>
				</select>
					   </div>
            <div class="col-lg-2"> 
           <div class="input-group date datepicker">
      <input class="form-control form-center" id="from" name="dato" type="text" value="<?php echo $dato ?>" onkeypress='return isNumberKey(event)' required>
	  <span class="input-group-addon"><i class="lnr lnr-calendar-full"></i></span>
			</div></div>


		  <div class="col-lg-2"> 
           <div class="input-group date datepicker">	
      <input class="form-control form-center" id="to" name="datos" type="text" value="<?php echo $datos ?>" onkeypress='return isNumberKey(event)' required>
	  <span class="input-group-addon"><i class="lnr lnr-calendar-full"></i></span>
              </div></div>                      
                       
                       <div class="col-lg-2">
                        <button class="btn  btn-primary btn-block" type="<?php echo $dbutn ?>" name="search" title="<?php echo $disa ?>" data-toggle='tooltip' data-placement='top'><i class="lnr lnr-magnifier"></i> Search</button>
                   
					  </div>
                         </div> 
                      
                     
                  
            </form> 
             
               
            </div>
               <?php
			   if($t==0){
				   if($i==0)
		$do=mysqli_query($cons, "SELECT *FROM `payment` WHERE `Status`='0' AND `Branche`='$brc' $conde $condi GROUP BY `Number` ORDER BY `Date` DESC, `Number` DESC LIMIT 20");
				   else
		$do=mysqli_query($cons, "SELECT *FROM `payment` WHERE `Date` BETWEEN '$dato' AND '$datos' AND `Status`='0' AND `Branche`='$brc' $conde $condi GROUP BY `Number` ORDER BY `Number` ASC LIMIT 4000");
				   
				if($fo=mysqli_num_rows($do)){
				   ?>
            <div class="divFooter"><center><u><b>PAYMENT REPORT <?php echo $mpri ?></b></u></center></div>     
             <div class="row">
            <div class="col-lg-12">
             <span> &nbsp;&nbsp; Total Records Found : <b><?php echo" $fo " ?></b></span> 
			 <span class="pull-right hidden-print"><?php echo $custoo ?>&nbsp;&nbsp;|&nbsp;&nbsp;<?php echo $bra ?>
			 <a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'>
			 <i class="lnr lnr-printer"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">

								 <form action="" method="post" class="form-horizontal"> 
				<table class="table table-striped table-hover">     
                                      <thead>
                    <tr role="row">
                     <th class="hidden-xs">&nbsp;&nbsp;&nbsp;&nbsp;No </th>
        <th>&nbsp;&nbsp;&nbsp;Due&nbsp;Date&nbsp;&nbsp;</th> 
                       <th> Destination </th>
                       <th> Action </th>
                       <th> Purpose </th>
                        <th><div align='center'> Cash </th>
                        <th><div align='center'> Deposit </th>
                        <th><div align='center'> Cheque </th>
                        <th><div align='center'> Credit </th>
                        <th class="hidden-xs hidden-print" style="width:40px; text-align:center;" colspan='2'> Options </th>
                     </tr>
                    </thead>
                                        <tbody>
					<?php
					$n=1;				$tca=$tche=$tba=$tcre=0;
		while($ro=mysqli_fetch_assoc($do)){
				$nuos=$ro['Number'];
				$vou=$ro['Voucher'];
				$dte=$ro['Date'];
				$tme=$ro['Time'];
				$des=$ro['Branche'];
				$tme=$ro['Time'];
				$cashier=$ro['Cashier'];
				$dest=$ro['Action'];
				$descri=$ro['Description'];
				$payto=$ro['Payto'];
				$vous=$ro['Voucher'];
						$pline=$ro['Pline'];
						$client=$ro['Customer'];
						$amo=$ro['Amount'];
						$che=$ba=$cre=$ca=0;
				$stn="padding:1px;";

				if($dest=='SALES'){
					$descri="Invoice No:$vou";
				}
				if($dest=='CASHBOX'){
				    $client=$ro['Cashier'];
			$stn="padding:1px; color:blue;";
				}
				if($dest=='PAYOUT'){
				    $amo=-$amo;				
			$stn="padding:1px; color:red;";
				}
				
					if($pline=='CHEQUE')	
						$che=$amo;
					if($pline=='BANK')
						$ba=$amo;
					if($pline=='CREDIT')
						$cre=$amo;
					if($pline=='CASH')
						$ca=$amo;

				$cao=number_format($ca, 2);
				$bao=number_format($ba, 2);
				$creo=number_format($cre, 2);
				$cheo=number_format($che, 2);

		if($_SESSION['Cancel'] AND $dest!='SALES'){
			 $dbutn='submit';
			 $disa='';
		 }
		 else{
			 $dbutn='button';
			 $disa='disabled';
		 }

		if($descri=='Supplier Advance')
			$stn="padding:1px; color:blue;";

		 $amo=$ba+$ca+$che;

				echo"<div class='modal fade' id='exampleModal$n' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true' 
		style='top:220px;'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLabel'>DELETE CONFIRMATION 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $client
					 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $cao $cheo $creo </h5>

      </div>
      <div class='modal-body' style='height:40px;'>
        <h5 style='color:#ff0033'>Are you sure you want to delete this sale?</h5>
      </div><form method='post' action=''><input type='hidden' name='amo' value='$amo'>
       <input type='hidden' name='vous' value='$vou'><input type='hidden' name='dato' value='$dato'><input type='hidden' name='datos' value='$datos'>
	   <input type='hidden' name='dte' value='$dte'><input type='hidden' name='dest' value='$dest'><input type='hidden' name='i' value='$i'>
	   <input type='hidden' name='ba' value='$ba'><input type='hidden' name='nuos' value='$nuos'><input type='hidden' name='dato' value='$dato'>
	   <input type='hidden' name='dest' value='$dest'><input type='hidden' name='datos' value='$datos'><input type='hidden' name='nuos' value='$nuos'>
	   <input type='hidden' name='cre' value='$cre'><input type='hidden' name='ca' value='$ca'><input type='hidden' name='che' value='$che'>
		<input type='hidden' name='to' value='$to'><input type='hidden' name='custo' value='$custo'><input type='hidden' name='client' value='$client'>
      <div class='modal-footer' style='margin-top:-10px; height:50px; padding-top:5px; border:0px solid blue;'>
        <button type='button' class='btn btn-sm btn-success' data-dismiss='modal'>&nbsp;NO&nbsp;</button>
        <button type='$dbutn' name='delo' class='btn btn-sm btn-danger' $disa>YES</button>
      </div></form>
    </div>
  </div>
</div>";

		print("<tr title='Done by: $cashier' data-toggle='tooltip' data-placement='left'>
		<td class=hidden-xs style='$stn' width='4%'><div align='right'>&nbsp;&nbsp;$n&nbsp;&nbsp;</td>		
						<td style='$stn'>&nbsp;$dte&nbsp;$tme </td>
						<td style='$stn'>&nbsp;$client&nbsp;</td>
						<td style='text-align:left; $stn'>&nbsp;$dest </td>
						<td style='text-align:left; $stn'>&nbsp;$descri </td>
				<td style='$stn'><div align='right'>&nbsp;$cao&nbsp;</td>
				<td style='$stn'><div align='right'>&nbsp;$bao&nbsp;</td>
				<td style='$stn'><div align='right'>&nbsp;$cheo&nbsp;</td>
				<td style='$stn'><div align='right'>&nbsp;$creo&nbsp;</td>

						<form method=post action=''>  
						<td class='hidden-xs hidden-print' align='right' style='width:20px; padding:0px;'>
                          <button type='button' class='btn btn-xs btn-warning hidden-print' name='edit' style='height:18px; padding:0px; margin:0px;'  title='Edit' data-toggle='tooltip' data-placement='top' disabled>
						  &nbsp;&nbsp;<i class='lnr lnr-pencil'></i>&nbsp;&nbsp;</button></td></form>
						  
				<td class='hidden-xs hidden-print' align='right' style='width:20px; padding:0px;'>
       <button type='submit' class='btn btn-xs btn-danger hidden-print' title='Delete this payment' style='height:18px; padding:0px; margin:0px;' data-placement='top' data-toggle='modal' data-target='#exampleModal$n' $disa> &nbsp;&nbsp;<i class='lnr lnr-trash'></i>&nbsp;&nbsp;</button></td></tr>");
	$n++;	     	$tca+=$ca;				$tche+=$che;             $tba+=$ba;         	  $tcre+=$cre;		
	
	if($custo=='PAYMENT'){	
	$doibi=mysql_query("SELECT `Number` FROM `account` WHERE `Customer`='$client' ORDER BY `Number` ASC");
					$roibi=mysql_fetch_assoc($doibi);
						$clie=$roibi['Number'];
$so=mysql_query("UPDATE `payment` SET `Client`='$clie' WHERE `Customer`='$client' AND `Action`='PAYMENT' ORDER BY `Number` ASC LIMIT 100");
	}
						}
						
				$tcao=number_format($tca, 2);
				$tbao=number_format($tba, 2);
				$tcreo=number_format($tcre, 2);
				$tcheo=number_format($tche, 2);
						?>
						
                     </tbody>

					 <thead>
					<tr><th class="hidden-xs"> </th>
					<th colspan='4'><div align='center'><b> Total Amount </th>
					<th><div align='right'><b><?php echo $tcao ?></th>
					<th><div align='right'><b><?php echo $tbao ?></th>
					<th><div align='right'><b><?php echo $tcheo ?></th>
					<th><div align='right'><b><?php echo $tcreo ?></th>
					<th colspan='2' class="hidden-xs hidden-print"><b><div align='center'> -- </th></tr>
                  </table><br>

				  
				  <?php
				}
				 else{
						echo"<div class='row'>
            <div class='col-lg-12' style='margin-top:-20px;'>
             <span> &nbsp;&nbsp; Total Records Found : <b> 0 </b></span>
			 <span class='pull-right hidden-print'> $custoo &nbsp;&nbsp;<a href='#' onclick='return window.print()' class='hidden-print' title='Click to print' data-toggle='tooltip' data-placement='top'><i class='lnr lnr-printer'></i></a></span>
            <div class='widget-container fluid-height clearfix'>
            <div class='widget-content padded clearfix'>
			<br><br><br><br><br><br>
	<div style='text-align:center; font-size:24px; color:#ff9999'>Payment not found on selected date </div><br><br><br><br><br><br>";
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
   ?>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     