<?php
if(basename($_SERVER['PHP_SELF']) == 'cheque.php') 
  $tt=" class='current'";
include'header.php';
include'connection.php';
$custo=$purpo='';
$conde=$condi='';
$dato=$datos=$Date;
$p=$accos=0;

// search request by date
if(isset($_POST['search']))
		{
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$purpo=$_POST['purpo'];
			$custo=$_POST['custo'];
			$p=1;
		}


// save a cheque to deposit
if(isset($_POST['depo']))
		{
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$custo=$_POST['custo'];
			$purpo=$_POST['purpo'];
			$amo=$_POST['amo'];
			$client=$_POST['client'];
			$naso=$_POST['naso'];
			$dest=$_POST['dest'];
			$sour=$_POST['sour'];
	$dati=date("Y-m-d", strtotime($_POST['dati']));
			$acco=$_POST['acco'];
			$descri=$_POST['descri'];
				if($descri==' Description ... ')
					$descri='';
			$vous=$_POST['vous'];
			$p=$_POST['p'];
			$cheno=$_POST['cheno'];

			if($dest=='SALES' OR $dest=='PAYMENT' OR ($dest=='CAUTION' AND $descri=='SALES'))
				$act='DEPOSIT';
			else
				$act='WITHDRAWAL';

	$and=mysqli_query($cons, "INSERT INTO `deposit` (`Number`, `Date`, `Time`, `User`, `Item`, `Refer`, `Amount`, `Customer`, `Operation`, `Status`, `Valid`, `Account`, `Descri`, `Client`, `Voucher`, `Source`, `Record`) VALUES (NULL, '$dati', '$Time', '$loge', '$act', '$cheno', '$amo', '$sour', '$dest', '0', '0', '$acco', '$descri', '$client', '$vous', 'CHEQUE', '$naso')");
					$so=mysqli_query($cons, "UPDATE `payment` SET `Passed`='1' WHERE `Number`='$naso'");
		}

		// save a cheque changed by cheque or deposit
if(isset($_POST['paido']))
		{
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$custo=$_POST['custo'];
			$purpo=$_POST['purpo'];
			$client=$_POST['client'];
			$naso=$_POST['naso'];
			$dest=$_POST['dest'];
			$sour=$_POST['sour'];
			$usa=$_POST['usa'];
			$ption=$_POST['ption'];
	$dati=date("Y-m-d", strtotime($_POST['dati']));



			$vous=$_POST['voucher'];
			$p=$_POST['p'];
			$paid=str_replace(',', '', $_POST['paid']);
			$cheno=$_POST['cheno'];
			$paydac=date("Y-m-d", strtotime($_POST['paydac']));
			$bna=$_POST['bna'];
			$slino=$_POST['slino'];
			$paydas=date("Y-m-d", strtotime($_POST['paydas']));
			$accos=$_POST['accos'];

			if($accos!='' AND $accos!='0'){
				if($dest=='SALES' OR $dest=='PAYMENT')
					$act='DEPOSIT';
				else
					$act='WITHDRAWAL';
	$and=mysqli_query($cons, "INSERT INTO `deposit` (`Number`, `Date`, `Time`, `User`, `Item`, `Refer`, `Amount`, `Customer`, `Operation`, `Status`, `Valid`, `Account`, `Descri`, `Client`, `Voucher`, `Source`, `Changing`) VALUES (NULL, '$dati', '$Time', '$loge', '$act', '$slino', '$paid', '$sour', '$dest', '0', '0', '$accos', 'CHEQUE CHANGING', '$client', '$vous', 'DIRECT', '$naso')");

	
   $then=mysqli_query($cons, "INSERT INTO `payment` (`Number`, `Date`, `Time`, `Cashier`, `Cash`, `Cheque`, `Bank`, `Credit`, `Voucher`, `Branche`, `Status`, `Customer`, `Destin`, `Description`, `Payto`, `Cheno`, `Bname`, `Pdate`, `Changing`) VALUES (NULL, '$dati', '$Time', '$loge', '0', '0', '$paid', '0', '$vous', '1', '0', '$sour', '$dest', '$ption', '$client', '$slino', '$accos', '$paydas', '$naso')");
			}
			
			if($cheno AND $bna)
   $then=mysqli_query($cons, "INSERT INTO `payment` (`Number`, `Date`, `Time`, `Cashier`, `Cash`, `Cheque`, `Bank`, `Credit`, `Voucher`, `Branche`, `Status`, `Customer`, `Destin`, `Description`, `Payto`, `Cheno`, `Bname`, `Pdate`, `Changing`) VALUES (NULL, '$dati', '$Time', '$loge', '0', '$paid', '0', '0', '$vous', '1', '0', '$sour', '$dest', '$ption', '$client', '$cheno', '$bna', '$paydac', '$naso')");


					$so=mysqli_query($cons, "UPDATE `payment` SET `Clearing`='1' WHERE `Number`='$naso'");
		}
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

    <li class="list-group-item">
	  <a href="deposit.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Bank Slip Record
                </p>
              </a></li>  

	 <li class="list-group-item active">
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
                         
            </ul>
  </div>
           
     <div class="col-lg-10">
                  <div class="row">
         
           <div class="col-lg-1"> </div>
          
         
           

        <form action="" method="post" class="form-horizontal ">                  
                       <div class="col-lg-11 hidden-print"><div class="col-lg-3"> 					
					  <select class="form-control" name="custo">
 <?php
				echo"<option value='' selected='selected'> SELECT DESTINATION </option>";
	 $top=mysqli_query($cons, "SELECT `Customer` FROM `payment` WHERE `Status`='0' AND `Pline`='CHEQUE' AND `Customer`!='' GROUP BY `Customer` ORDER BY `Customer` ASC");
						while($rop=mysqli_fetch_assoc($top)){
							$sup=$rop['Customer'];
							if($custo==$sup)
								$s='selected';
							else
								$s='';
			echo"<option value='$sup' $s> $sup </option>";
						}
						?>
			   </select>  
					   </div>
					   
					   <div class="col-lg-3"> 					
					  <select class="form-control" name="purpo">
 <?php
				echo"<option value='' selected='selected'> SELECT PURPOSE </option>";
	 $top=mysqli_query($cons, "SELECT `Action` FROM `payment` WHERE `Status`='0' AND `Pline`='CHEQUE' AND `Action`!='' GROUP BY `Action` ORDER BY `Action` ASC");
						while($rop=mysqli_fetch_assoc($top)){
							$pus=$rop['Action'];
							if($purpo==$pus)
								$d='selected';
							else
								$d='';
			echo"<option value='$pus' $d> $pus </option>";
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
                       
                       <div class="col-lg-2"><?php echo"<input type='hidden' name='pg' value='$pg'>"; ?>
                        <button class="btn  btn-primary btn-block" type="submit" name="search"><i class="lnr lnr-magnifier"></i> Search</button>
                   
					  </div>
                         </div></form> 
               
            </div>
               <?php
					if($custo)
						$conde="AND `Customer`='$custo'";

					if($purpo)
						$condi="AND `Action`='$purpo'";

				if($p!=0)
		$dok=mysqli_query($cons, "SELECT *FROM `payment` WHERE `Pline`='CHEQUE' AND `Status`='0' AND `Passed`='0' AND `Date` BETWEEN '$dato' AND '$datos' $conde $condi ORDER BY `Number` ASC LIMIT 1000");
				else
		$dok=mysqli_query($cons, "SELECT *FROM `payment` WHERE `Pline`='CHEQUE' AND `Status`='0' AND `Passed`='0' AND `Date` <= '$Date' $conde $condi ORDER BY `Number` ASC LIMIT 40");
				if($fo=mysqli_num_rows($dok)){
				   ?>
                 
             <div class="row">
            <div class="col-lg-12" style='margin-top:-20px;'>
             <span> &nbsp;&nbsp; Total Records Found : <b><?php echo" $fo " ?></b></span>
			 <span class="pull-right hidden-print">&nbsp;&nbsp;
			 <a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'>
			 <i class="lnr lnr-printer"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">

								<table class="table table-striped" style="font-size:11px; padding:1px;">     
                                      <thead>
                    <tr role="row">
                     <th class="hidden-xs" style='padding:1px;'>&nbsp;&nbsp; No </th><th style='padding:1px;'>&nbsp;&nbsp; Date </th>
                       <th style='padding:1px;'>Source </th><th style='padding:1px;'> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Destination </th>
					   <th style='padding:1px;'><div align='center'> Cheque No </th>
                        <th><div align='center'> Bank Name </th><th><div align='center'> Payment Date </th>
                        <th><div align='center'>&nbsp;&nbsp; Pay-In </th><th><div align='center'>&nbsp;&nbsp; Pay-Out </th>
						<th class="hidden-print" colspan="2"><div align='center'>&nbsp;&nbsp; Options </th>
                     </tr>
                    </thead>
                                        <tbody>
					<?php
								$i=$n=1;			$tpin=$tpout=0;						$k=3810;
		while($rok=mysqli_fetch_assoc($dok)){
				$code=$rok['Number'];
				$cheno=$rok['Cheno'];
			$sour=$rok['Customer'];
			$dte=$rok['Date'];
			$dest=$rok['Action'];
			$bna=$rok['Bname'];				
			$pda=$rok['Pdate'];				
			$vous=$rok['Voucher'];
			$ption=$rok['Description'];
												$pin=$pout=0;
			$client=$rok['Payto'];
			$amo=$rok['Amount'];
			$clear=$rok['Clearing'];
			$stl="style='padding:1px;'";

			if($clear==1){
				$sk="<strike>";
				$sks="</strike>";
			}
			else
				$sk=$sks='';

					if($dest=='SALES' OR $dest=='PAYMENT' OR ($dest=='CAUTION' AND $ption=='SALES'))
						$pin=$amo;
					else
						$pout=$amo;				$pino=number_format($pin);					$pouto=number_format($pout);

						$pay=0;
	$spa=mysqli_query($cons, "SELECT *FROM `payment` WHERE `Voucher`!='0' AND `Status`='0' AND `Changing`='$code' AND `Action`='$dest' ORDER BY `Number` ASC");
				while($rpa=mysqli_fetch_assoc($spa)){
						$pay+=$rpa['Amount'];
				}
											$payo=number_format($pay);
				if($pay)
					$payoo="title='$payo paid by change' data-toggle='tooltip' data-placement='top'";
				else
					$pay="1";

				if($pay>=$amo)
					$so=mysqli_query($cons, "UPDATE `payment` SET `Status`='2' WHERE `Number`='$code'");

				print("<tr $payoo><td class='hidden-xs' $stl><div align='center'>$sk$i$sks&nbsp;</td>
						<td $stl><div align='center'>&nbsp;$sk$dte$sks&nbsp;</td><td $stl>&nbsp; $sk$dest$sks </td><td $stl>&nbsp; $sk$sour$sks </td>
						<td $stl><div align='right'> $sk$cheno$sks &nbsp;</td><td $stl><div align='left'>&nbsp; $sk$bna$sks </td>
						<td $stl><div align='center'> $sk$pda$sks </td><td $stl><div align='right'> $sk$pino$sks &nbsp;</td>
						<td $stl><div align='right'> $sk$pouto$sks &nbsp;</td><td class='hidden-xs hidden-print' style='padding:0px;'>");

									$amoo=number_format($amo);

				// ****************************** Cheque deposit modal *********************************
		echo"<div class='modal fade' id='exampleModal$i' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true' 
		style='top:20px;'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLabel'> $sour 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
						<b>$dte</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; RWF<b>$amoo</b> </h5>

      </div>
      <div class='modal-body' style='height:120px;'>

		<div class='col-md-5'><div align='right'><form method='post' action=''><select class='form-control' name='acco' required>
				<option value='' selected='selected'>SELECT ACCOUNT</option>";
			
			$doi=mysqli_query($cons, "SELECT *FROM `baccount` ORDER BY `Number` ASC");
			while($roi=mysqli_fetch_assoc($doi)){
				$nu=$roi['Number'];
				$fna=$roi['Bank'];
				$acco=$roi['Account'];
			echo"<option value='$nu' title='$purpo'> $fna $acco </option>";
			}
		
		 echo"</select></div></div>

			<div class='col-md-7'>
		 <TEXTAREA name='descri' class='form-control' rows='3' cols='56' onfocus=this.value=''> Description ... </TEXTAREA>
			</div>
		
		<div class='col-md-5' style='margin-top:-35px;'>
	<input class='form-control form-center' name='dati' type='text' value='$pda' onkeypress='return isNumberKey(event)'>
		
			</div>

      </div> <input type='hidden' name='naso' value='$code'><input type='hidden' name='dest' value='$dest'>
	  <input type='hidden' name='custo' value='$custo'><input type='hidden' name='client' value='$client'>
	  <input type='hidden' name='dato' value='$dato'><input type='hidden' name='datos' value='$datos'><input type='hidden' name='p' value='$p'>
	  <input type='hidden' name='sour' value='$sour'><input type='hidden' name='voucher' value='$voucher'>
	  <input type='hidden' name='purpo' value='$purpo'><input type='hidden' name='amo' value='$amo'>
	  <input type='hidden' name='cheno' value='$cheno'><hr>
      <div class='modal-footer' style='margin-top:-10px; height:50px; padding-top:5px; border:0px solid blue;'>
        <button type='button' class='btn btn-sm btn-danger' data-dismiss='modal' style='width:120px;'>CANCEL</button>
        <button type='submit' class='btn btn-sm btn-success' name='depo' style='width:120px;'>SAVE</button>
      </div></form>
    </div></form>
  </div>
</div>";

		// ************************************************ End of modal ************************************

		// ************************************************ Cheque change modal *********************************



	echo"<div class='modal fade' id='exampleModal$k' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true' 
		style='top:20px;'><div class='modal-dialog' role='document'>
    <div class='modal-content'><div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLabel'> $sour 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
						<b>$dte</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; RWF<b>$amoo</b> </h5>

      </div>
      <div class='modal-body' style='text-align:center; height:60px;'><form action='' method='post'>";
	  $amos=number_format($amo-$pay);
	  ?>
	
	
 <div class="col-md-2" align="right">
			 <label class="control-label">Done&nbsp;By</label></div> 
			 
	<div class="col-md-5">
			 <input name="usa" class="form-control" type="text" onkeyup='format(this);' onkeypress='return isNumberKey(event)' value="<?php echo $loge ?>" style='height:24px; width:220px' readonly></div>

		<div class="col-md-2" align="right"> 
            <label class="control-label">Due&nbsp;Date</label></div> 
			
	<div class="col-md-3"><input class="form-control form-center" name="dati" type="text" value="<?php echo $Date ?>" onkeypress='return isNumberKey(event)' style="height:24px; width:120px;"></div>

 <div class="col-md-6" align="right" style="margin-top:30px;">
           <input name="paid" class="form-control text-center" type="text" onkeyup='format(this);' onkeypress='return isNumberKey(event)' value="<?php echo $amos ?>" style='height:24px; width:150px;' placeholder="Paid Amount"></div>

		<div class="col-md-1" align="right" style="margin-top:30px;"> 
            <label class="control-label"> </label></div>

            <div class="col-md-5" style="margin-top:30px;">
			<?php
				echo"<button class='btn btn-xs btn-warning hidden-print' type='button' onclick='myFunction$n()' style='height:24'>CHEQUE</button> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
					<button class='btn btn-xs btn-warning hidden-print' type='button' onclick='myFunctions$n()' style='height:24'>BANKED</button> &nbsp;&nbsp;&nbsp;&nbsp;
			</div></div>
	<script>
function myFunction$n() {
  var x = document.getElementById('myDIV$n');
  if (x.style.display === 'none') {
    x.style.display = 'block';
  } else {
    x.style.display = 'none';
  }
} 

function myFunctions$n() {
  var x = document.getElementById('myDIVS$n');
  if (x.style.display === 'none') {
    x.style.display = 'block';
  } else {
    x.style.display = 'none';
  }
} 
</script>";
?>

<?php
	echo"<div id='myDIV$n' style='display: none; padding-top:30px; margin-top:40px; position:relative;'>";
?>
		
<div class="col-md-1"> </div>
<div class="col-md-3 align-right">
<input class="form-control form-center" name="cheno" type="text" placeholder="CHEQUE No" onkeypress='return isNumberKey(event)' style="height:22px;"></div>
	<div class="col-md-2 align-right"> Pay Date&nbsp;:&nbsp;</div><div class="col-md-2">
	<input class="form-control form-center" id="to" name="paydac" type="text" value="<?php echo $Date ?>" onkeypress='return isNumberKey(event)' 
	style="height:22px; width:100px; margin-left:-25px;">
		<?php
							echo"<input type='hidden' name='vouch' value='$vouch'><input type='hidden' name='dest' value='$dest'>
		<input type='hidden' name='client' value='$client'>";
						?>
			</div>
		<div class="col-md-4"><div align='right'><select class="form-control" name="bna" style="height:22px; padding:0px;">
				<option value='' selected='selected'>SELECT BANK</option>
			<?php
			$doi=mysqli_query($cons, "SELECT `Fnames` FROM `banks` ORDER BY `Fnames` ASC");
			while($roi=mysqli_fetch_assoc($doi)){
				$fna=$roi['Fnames'];
			echo"<option value='$fna'> $fna </option>";
			}
			?>   
                            </select></div></div>
</div>

<?php
	if($dest=='SALES' OR $dest=='PAYMENT'){
	echo"<div id='myDIVS$n' style='display: none; padding-top:30px; margin-top:40px; position:relative;'>";
?>

<div class="col-md-1"> </div>
<div class="col-md-3 align-right">
<input class="form-control form-center" name="slino" type="text" placeholder="BANK SLIP No" onkeypress='return isNumberKey(event)' style="height:22px;"></div>
	<div class="col-md-2 align-right"> Deposit&nbsp;:&nbsp; </div><div class="col-md-2">
	<input class="form-control form-center" id="to" name="paydas" type="text" value="<?php echo $Date ?>" onkeypress='return isNumberKey(event)' style="height:22px; width:100px; margin-left:-25px;">
		<?php
							echo"<input type='hidden' name='vouch' value='$vouch'><input type='hidden' name='dest' value='$dest'>
		<input type='hidden' name='client' value='$client'>";
						?>
			</div>
		<div class="col-md-4"><div align='right'><select class="form-control" name="accos" style="height:22px; padding:0px;">
				<option value='' selected='selected'>BANK ACCOUNT</option>
			<?php
			$doi=mysqli_query($cons, "SELECT *FROM `baccount` ORDER BY `Number` ASC");
			while($roi=mysqli_fetch_assoc($doi)){
				$nu=$roi['Number'];
				$fna=$roi['Bank'];
				$acco=$roi['Account'];
			echo"<option value='$nu' title='$fna $acco'> $fna $acco </option>";
			}
			?>   
                            </select></div></div>
		</div>


<?php
}
	echo"<br><br><br></div><div class='modal-header' style='height:50px; text-align:right; padding:10px 20px 5px 5px;'> 
		<input type='hidden' name='naso' value='$code'><input type='hidden' name='dest' value='$dest'>
	  <input type='hidden' name='custo' value='$custo'><input type='hidden' name='client' value='$client'>
	  <input type='hidden' name='dato' value='$dato'><input type='hidden' name='datos' value='$datos'><input type='hidden' name='p' value='$p'>
	  <input type='hidden' name='sour' value='$sour'><input type='hidden' name='voucher' value='$vous'><input type='hidden' name='naso' value='$code'>
	  <input type='hidden' name='purpo' value='$purpo'><input type='hidden' name='amo' value='$amo'><input type='hidden' name='ption' value='$ption'>
        <button type='button' class='btn btn-sm btn-default' style='width:80px' data-dismiss='modal'>&nbsp;CLOSE&nbsp;</button>
        <button type='submit' class='btn btn-sm btn-success' style='width:80px' name='paido'>&nbsp;&nbsp;SAVE&nbsp;&nbsp;</button>
      </div></form>
    </div></div>
    </form></div>";

	// ***************************************************** End of modal ********************************************
						
						print("<div align='right'><button type='button' class='btn btn-xs btn-default hidden-print' name='paid' style='height:18px; width:80px; padding:0px; margin:0px;' title='Click to change' data-placement='top' data-toggle='modal' data-target='#exampleModal$k'>&nbsp;&nbsp;<i class='lnr lnr-checkmark-circle'></i> CHANGE </button></td>
						
						<td style='padding:0px;'><div align='right'><button type='button' class='btn btn-xs btn-warning hidden-print' name='paid' style='height:18px; width:80px; padding:0px; margin:0px;' title='Click to pay' data-placement='top'  data-toggle='modal' data-target='#exampleModal$i'>&nbsp;&nbsp;<i class='lnr lnr-checkmark-circle'></i> PAID </button></td></tr>");
									$i++;				$k++;				 $n++;					$tpin+=$pin;				$tpout+=$pout;
						}
						$tp=number_format($tpin);				$tr=number_format($tpout);				$tb=number_format($tb);	
						?>
						
                    </tbody>
					 <thead>
					<tr><th class='hidden-xs'> </th><th colspan='6'><div align='center'> Grand Total </th>
					<th><div align='right'><?php echo $tp ?></th><th><div align='right'><?php echo $tr ?></th>
					<th class='hidden-print' colspan="2"><div align='center'> -- </th></tr>
                  </table> <div class="row"><br> 

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