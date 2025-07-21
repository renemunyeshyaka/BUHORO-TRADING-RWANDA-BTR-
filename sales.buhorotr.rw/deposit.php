<?php
if(basename($_SERVER['PHP_SELF']) == 'deposit.php') 
  $tt=" class='current'";
include'header.php';
include'connection.php';
$custo='';
$conde='';
$p=0;
$dato=$datos=$Date;

// search request by date
if(isset($_POST['search']))
		{
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$pg=$_POST['pg'];
			$custo=$_POST['custo'];
				$p=1;
		}


// search request by date
if(isset($_POST['valid']))
		{
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$custo=$_POST['custo'];
			$val=$_POST['val'];
			$p=$_POST['p'];
			$naso=$_POST['naso'];

			$so=mysqli_query($cons, "UPDATE `deposit` SET `Valid`='$val' WHERE `Number`='$naso'");
		}


		// delete a given deposit record
if(isset($_POST['delo']))
		{
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$custo=$_POST['custo'];
			$val=$_POST['val'];
			$p=$_POST['p'];
			$naso=$_POST['naso'];
			$reco=$_POST['reco'];

	$so=mysqli_query($cons, "UPDATE `deposit` SET `Status`='1', `Valid`='0' WHERE `Number`='$naso'");

			$go=mysqli_query($cons, "UPDATE `payment` SET `Passed`='0' WHERE `Number`='$reco'");
		}

if($dato==$datos)
			$mpri="ON $dato";
		else
			$mpri="FROM $dato TO $datos";
?>

<div class="container-fluid main-content">
        <div class="page-title hidden-print">
          <h2 style='margin-top:-20px; margin-bottom: 5px; color:#ffcc33'>
        Operations
          </h2>
                 </div>
     
         <div class="row">
  <div class="col-lg-2 hidden-print">
   
   <ul class="list-group">

    <li class="list-group-item active">
	  <a href="deposit.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Bank Slip Record
                </p>
              </a></li>  

	 <li class="list-group-item">
	  <a href="cheque.php">
                <p>
                <i class="lnr lnr-briefcase"></i>&nbsp;Cheque Record
                </p>
		<?php
		if($fequo)
		echo"<span class='badge' style='float:right; font-size:11px; margin-right:5px; height:18px; background-color:#66ff33; width:25px; text-align:center; margin-top:-35px; color:#ffffff;'> $fequo </span>";
			?>
              </a></li> 
      
    <li class="list-group-item">
	  <a href="suppli.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Cheque &nbsp; Payout
                </p>
              </a></li> 
      
    <li class="list-group-item">
	  <a href="billpay.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Supplier Payment
                </p>
              </a></li> 
      
    <li class="list-group-item">
	  <a href="bope.php">
                <p>
                <i class="lnr lnr-laptop-phone"></i>&nbsp;Bank Operation
                </p>
              </a></li> 
      
    <li class="list-group-item">
	  <a href="purchase.php">
                <p>
                <i class="lnr lnr-license"></i>&nbsp;Purchase Orders
                </p>
              </a></li>   
                         
            </ul>
  </div>
       
        <div class="col-lg-10">
                  <div class="row">
         
           <div class="col-lg-3"> </div>
          
         
           

        <form action="" method="post" class="form-horizontal ">                  
                       <div class="col-lg-8 hidden-print"><div class="col-lg-4"> 					
					  <select class="form-control" name="custo">
			 <?php
				echo"<option value='' selected='selected'> SELECT ACCOUNT </option>";
		$doi=mysqli_query($cons, "SELECT *FROM `baccount` ORDER BY `Number` ASC");
			while($roi=mysqli_fetch_assoc($doi)){
				$nu=$roi['Number'];
				$fna=$roi['Bank'];
				$acco=$roi['Account'];
				if($custo==$nu)
					$s="selected";
				else
					$s="";
			echo"<option value='$nu' title='$purpo' $s> $fna $acco </option>";
			}
						?>
			   </select>  
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
                       
                       <div class="col-lg-2"><?php echo"<input type='hidden' name='pg' value='$pg'>"; ?>
                        <button class="btn  btn-primary btn-block" type="submit" name="search"><i class="lnr lnr-magnifier"></i> Search</button>
                   
					  </div>
                         </div></form>               
            </div>
               <?php
					if($custo){
						$conde="AND `Account`='$custo'";
				$doin=mysqli_query($cons, "SELECT *FROM `baccount` WHERE `Number`='$custo' ORDER BY `Number` ASC");
						$roi=mysqli_fetch_assoc($doin);
							$bank=$roi['Bank'];
							$account=$roi['Account'];
					  }
					  else{
						  $bank=$account='';
					  }

				if($p)
		$dok=mysqli_query($cons, "SELECT *FROM `deposit` WHERE `Status`='0' AND `Date` BETWEEN '$dato' AND '$datos' $conde ORDER BY `Number` ASC LIMIT 1000");
				else
		$dok=mysqli_query($cons, "SELECT *FROM (SELECT *FROM `deposit` WHERE `Status`='0' AND `Date` <= '$Date' $conde ORDER BY `Number` DESC LIMIT 20) SUB ORDER BY `Date` ASC");
				if($fo=mysqli_num_rows($dok)){
				?>
                 
            <div class="divFooter"><center><u><b>BANK REPORT <?php echo $mpri ?></b></u></center></div>
             <div class="row">
            <div class="col-lg-12">
             <span> &nbsp;&nbsp; Total Records Found : <b><?php echo" $fo " ?></b></span>
			 <span class="pull-right hidden-print"><?php echo"$bank   $account"; ?>&nbsp;&nbsp;
			 <a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'>
			 <i class="lnr lnr-printer"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">

								<table class="table table-striped table-hover">     
                                      <thead>
                    <tr role="row">
                     <th width='3%' class="hidden-xs" style='padding:1px;'>&nbsp;&nbsp;No&nbsp;</th>
					 <th width='8%' style='padding:1px;'>&nbsp;&nbsp;&nbsp;Date </th>
                       <th style='padding:1px;'>&nbsp;&nbsp;Source </th><th style='padding:1px;'>&nbsp;&nbsp;&nbsp;&nbsp;Destination </th>
					   <th style='padding:1px;'><div align='center'> From&nbsp;Account </th><th style='padding:1px;'><div align='center'> Purpose </th>
					   <th style='padding:1px;'><div align='center'> Description </th><th><div align='center'>&nbsp;&nbsp;&nbsp;Debit </th>
					   <th style='padding:1px;'><div align='center'>&nbsp;&nbsp;&nbsp;Credit </th>
						<th class="hidden-print" colspan='2' style='padding:1px;'><div align='center'>&nbsp;Options&nbsp;</th>
                     </tr>
                    </thead>
                                        <tbody>
					<?php
								$i=1;			$tpin=$tpout=0;
						while($rok=mysqli_fetch_assoc($dok)){
				$code=$rok['Number'];
				$cheno=$rok['Refer'];
			$sour=$rok['Customer'];
			$dte=$rok['Date'];
			$dest=$rok['Source'];
			$bna=$rok['Operation'];				
			$pda=$rok['Descri'];				
			$item=$rok['Item'];
			$valide=$rok['Valid'];
			$reco=$rok['Record'];
			$acco=$rok['Account'];
			if($dest=='DIRECT')
				$dest="CASH";

			$doi=mysqli_query($cons, "SELECT *FROM `baccount` WHERE `Number`='$acco' ORDER BY `Number` ASC");
				$roi=mysqli_fetch_assoc($doi);
					$fna=$roi['Bank'];
					$acco=$roi['Account'];

					if($valide=='1'){
						$btn="<button type='submit' class='btn btn-xs btn-default hidden-print' name='valid' style='height:18px; width:25px; padding:0px; margin:0px; margin-right:2px;' title='Uncheck' data-toggle='tooltip' data-placement='bottom'> &nbsp;<i class='lnr lnr-checkmark-circle'></i>&nbsp; </button>";
						$val=0;
						$clr='';
					}
					else{
						$btn="<button type='submit' class='btn btn-xs btn-info hidden-print' name='valid' style='height:18px; width:25px; padding:0px; margin:0px; margin-right:2px;' title='Check' data-toggle='tooltip' data-placement='bottom'> &nbsp;<i class='lnr lnr-checkmark-circle'></i>&nbsp; </button>";
						$val=1;
						$clr="color:blue;";
					}
												$pin=$pout=0;
			$amo=$rok['Amount'];								$amoo=number_format($amo);
			$stl="padding:1px;";

					if($item=='DEPOSIT')
						$pin=$amo;
					else
						$pout=$amo;				$pino=number_format($pin);					$pouto=number_format($pout);

				print("<tr><td class='hidden-xs' style='$stl $clr'><div align='right'>&nbsp;$i&nbsp;&nbsp;</td>
						<td style='$stl $clr'><div align='center'>&nbsp;$dte&nbsp;</td><td style='$stl $clr'>&nbsp; $dest </td>
						<td style='$stl $clr'>&nbsp; $sour </td><td style='$stl $clr'><div align='left'> $acco &nbsp;</td>
						<td style='$stl $clr'><div align='left'>&nbsp; $bna </td><td style='$stl $clr'><div align='left'> $pda </td>
						<td style='$stl $clr'><div align='right'> $pouto &nbsp;</td><td style='$stl $clr'><div align='right'> $pino &nbsp;</td>");



						

// ************************************* Open modal ******************************************
		echo"<div class='modal fade' id='exampleModal$i' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true' style='top:220px;'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLabel'>DELETE CONFIRMATION 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>$dte</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; RWF<b>$amoo</b> </h5>

      </div>
      <div class='modal-body' style='height:40px;'>
        <h5 style='color:#ff0033'>Do you want to delete this?</h5>
      </div><form method='post' action=''><input type='hidden' name='dato' value='$dato'>
	  <input type='hidden' name='datos' value='$datos'><input type='hidden' name='p' value='$p'>
	<input type='hidden' name='custo' value='$custo'><input type='hidden' name='naso' value='$code'><input type='hidden' name='reco' value='$reco'>
      <div class='modal-footer' style='margin-top:-10px; height:50px; padding-top:5px; border:0px solid blue;'>
        <button type='button' class='btn btn-sm btn-success' data-dismiss='modal'>&nbsp;NO&nbsp;</button>
        <button type='submit' name='delo' class='btn btn-sm btn-danger'>YES</button>
      </div></form>
    </div>
  </div>
</div>";
	// ****************************************** End of modal ****************************************	






	print("<form action='' method='post'><td class='hidden-xs hidden-print' style='padding:0px;'> 
	 <input type='hidden' name='dato' value='$dato'><input type='hidden' name='datos' value='$datos'>
	 <input type='hidden' name='p' value='$p'><input type='hidden' name='custo' value='$custo'><input type='hidden' name='naso' value='$code'>
	<div align='right'><input type='hidden' name='val' value='$val'> $btn </td></form>
	
	<td class='hidden-xs hidden-print' align='right' style='width:20px; padding:0px;'>
            <input type='hidden' name='naso' value='$code'><input type='hidden' name='dato' value='$dato'>
			<input type='hidden' name='datos' value='$datos'><input type='hidden' name='custo' value='$custo'>
            <button type='button' class='btn btn-xs btn-danger hidden-print' style='height:18px; padding:0px; margin:0px;' title='Click to cancel this deposit' data-placement='top' data-toggle='modal' data-target='#exampleModal$i'>&nbsp;&nbsp;<i class='lnr lnr-trash'></i>&nbsp;&nbsp;</button></td></tr>");
									$i++;					$tpin+=$pin;				$tpout+=$pout;
						}
						$tp=number_format($tpin);				$tr=number_format($tpout);				$tb=number_format($tb);	
						?>
						
                    </tbody>
					 <thead>
					<tr><th class='hidden-xs'> </th><th colspan='6'><div align='center'> Total Amount </th>
					<th><div align='right'><?php echo $tr ?></th><th><div align='right'><?php echo $tp ?></th>
					<th class='hidden-print' colspan='2'><div align='center'> -- </th></tr>
                  </table> 
								</div></div>
								<span class="pull-right hidden-print">
			 <a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'>
			 <i class="lnr lnr-printer"></i></a></span><br><br><br>  

			<?php
				}
				else{
						echo"<div class='row'>
            <div class='col-lg-12' style='margin-top:-20px;'>
             <span> &nbsp;&nbsp; Total Records Found : <b> 0 </b></span>
            <div class='widget-container fluid-height clearfix'>
            <div class='widget-content padded clearfix'>
			<br><br><br><br><br><br>
	<div style='text-align:center; font-size:24px; color:#ff9999'>Report not available on selected date </div><br><br><br><br><br><br>";
					}
			
					?>
                                      
                
              </div>
            </div></div>
                  </div>
   <?php
   include'footer.php';
   ?>