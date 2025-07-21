<?php
if(basename($_SERVER['PHP_SELF']) == 'dadd.php') 
  $bb=" class='current'";
include'header.php';
include'connection.php';
$user=$loge;
$dato=$Date;
$pto=0;
 $brc=$_SESSION['BR'];	
 $doib=mysql_query("SELECT `Name` FROM `branches` WHERE `Number`='$brc' ORDER BY `Number` ASC");
			$roib=mysql_fetch_assoc($doib);
				$bra=$roib['Name'];

$clio=100000000000001;
							$ca=$che=$ba=$cre=0;

						 if(isset($_POST['client']))
							{	
							$clio=$_POST['client'];
							}

	if(isset($_POST['mois']) AND $_POST['form_token'] == $_SESSION['form_token'])
		{
			$client=$_POST['client'];
			$amo=$_POST['amo'];
				$amo=preg_replace('/,/', '', $amo);
			$descri=$_POST['descri'];
				$descri=str_replace("'", "`", $descri);
				if($descri==' Description ... ')
					$descri='';

		$cuse=mysql_query("SELECT *FROM `account` WHERE `Number`='$client' ORDER BY `Customer` ASC");
			$ruce=mysql_fetch_assoc($cuse);
					$Fe=$ruce['Customer'];

			$dato=$_POST['dato'];
			$pline=$_POST['pline'];

			if($pline=='CHEQUE'){
				$cheno=$_POST['cheno'];
				$bna=$_POST['cba'];
				$bto=$_POST['chpa'];
			}
			elseif($pline=='BANK'){
				$cheno=$_POST['slino'];
				$bna=$_POST['acco'];
				$bto=$_POST['cbpa'];
				
	$and=mysqli_query($cons, "INSERT INTO `deposit` (`Date`, `Time`, `User`, `Item`, `Refer`, `Amount`, `Customer`, `Operation`, `Status`, `Valid`, `Account`, `Descri`, `Client`, `Voucher`, `Source`, `Branche`) VALUES ('$bto', '$Time', '$loge', 'DEPOSIT', '$cheno', '$amo', '$Fe', 'PAYMENT', '0', '0', '$bna', '$descri', '0', '99999999999', 'DIRECT', '$brc')"); 
			}
			else{
				$cheno=$bna='';
				$bto=$dato;
			}
					
$so=mysql_query("INSERT INTO `payment` (`Date`, `Time`, `Cashier`, `Amount`, `Pline`, `Voucher`, `Branche`, `Status`, `Customer`, `Action`, `Description`, `Cheno`, `Bname`, `Pdate`, `Upda`, `Client`) VALUES ('$dato', '$Time', '$loge', '$amo', '$pline', '99999999999', '$brc', '0', '$Fe', 'PAYMENT', '$descri', '$cheno', '$bna', '$bto', '1', '$client')");

$then=mysql_query("UPDATE `account` SET `Balance` = `Balance` - '$amo' WHERE `Number` = '$client' LIMIT 1");
		$pto=20;			$clio=$client;
		}
?>
<div class="container-fluid main-content">
        <div class="page-title">
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
	  <a href="createa.php" <?php echo $dsa ?>>
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Create Account
                </p>
              </a></li> 

   <li class="list-group-item active">
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


 <div class="col-md-10">
 <div class="widget-container fluid-height clearfix">
 <div class="widget-content padded">
 <form method="post" class="form-horizontal" action="" enctype="multipart/form-data" name='myform'>
 <input name="app_file_size" id="app_file_size" type="hidden">
 <br>
 <?php 
 $amos=number_format($amo);
if($pto==10)
echo"<center><div class='alert alert-danger' style='width:48%;text-align:center;float:center;background-color: #60c560;color: #ffffff;border-radius:5px;'>
		<i class='lnr lnr-checkmark-circle'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>&times;</button>$amos is added to your cashbox.
		</div></center>";
if($pto==20)
echo"<center><div class='alert alert-danger' style='width:48%;text-align:center;float:center;background-color: #60c560;color: #ffffff;border-radius:5px;'>
		<i class='lnr lnr-checkmark-circle'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>&times;</button> A payment of $amos is taken to your cashbox.
		</div></center>";
	
			echo"<input value='$code' name='rowid' type='hidden'>";
			?>
			<div class="form-group"><center>
				<table border="0" width="50%"><tr><td colspan='2'><select name='client' class="form-control" title='Customers list' id='category' onchange='submitForm();' required><option value='100000000000001' selected> Select Account </option>
			
			<?php
	$cuse=mysql_query("SELECT *FROM `account` WHERE `Status`='0' GROUP BY `Customer` ORDER BY `Customer` ASC");
			while($ruce=mysql_fetch_assoc($cuse)){
					$Fe=$ruce['Customer'];
					$Ae=$ruce['Address'];
					$Te=$ruce['Telephone'];
					$De=$ruce['Date'];
					$Ne=$ruce['Number'];
					$Be=number_format($ruce['Balance']);
					$CLe="$Fe";
					if($Ne==$clio)
						$se="selected";
					else
						$se='';

					if($ruce['Balance']>100)
						$cll="color:blue";
					else
						$cll='';
			
				print("<option value='$Ne' title='$CLe
				$Ae - $Te 
				Account No: $Ne 
				Balance : $Be RWF
				Created on: $De' style='font-size:16px;font-weight:normal; $cll' $se> $CLe </option>");
			}
				?>
				
			
				</select></td></tr>
		<?php
		if($clio!='100000000000001'){
			$tot=0;
	$cuse=mysql_query("SELECT `Destin`, SUM(`Price`*`Quantity`) AS 'TOT' FROM `stouse` WHERE `Client`='$clio' AND `Action`='SALES' AND `Status`='0' AND `Upda`='1' ORDER BY `Number` ASC");
			$ruce=mysql_fetch_assoc($cuse);
					$Fe=$ruce['Destin'];
					$tot=$ruce['TOT'];					

			$pay=0;
	$cusea=mysql_query("SELECT SUM(`Amount`) AS 'Amo' FROM `payment` WHERE `Client`='$clio' AND `Pline`!='CREDIT' AND `Status`='0' AND (`Action`='SALES' OR `Action`='PAYMENT') ORDER BY `Number` ASC");
			$rpa=mysql_fetch_assoc($cusea);
					$pay=$rpa['Amo'];
			
			$bal=$tot-$pay;
		$payo=number_format($pay);					$prev=number_format($tot);						$balo=number_format($bal);
					?>

<tr><td colspan='2'><div align="text-align:right;"><TEXTAREA class="form-control" name="apo" rows="3" disabled 
style='text-align:left; font-size:14px; width:90%; margin-left:10%; padding-top:5px; margin-top:5px;'> Total amount to be paid :  <?php echo $prev ?> &nbsp;&nbsp; 
&nbsp;Total previous payments : <?php echo $payo ?> &nbsp;&nbsp; 
&nbsp;Total remaining payment : <?php echo $balo ?> &nbsp;&nbsp; </TEXTAREA></td></tr>
<?php
	$then=mysql_query("UPDATE `account` SET `Balance` =  '$bal' WHERE `Number` = '$clio' LIMIT 1");
				}
?>
		<tr style='height:50px;'><td>
<INPUT type="text" name="amo" class="form-control" style='font-size:14px; text-align:center; width:270px;' onkeyup='format(this);' onkeypress='return isNumberKey(event)' placeholder='Paid amount' required></td><td width="10%"><div style="text-align:right;">
<SELECT name="pline" class="form-control" style='width:160px; font-size:14px;' onchange='showDiv(this.value);'>
	<OPTION VALUE="CASH" SELECTED>CASH</OPTION>
		<OPTION VALUE="CHEQUE">CHEQUE</OPTION>
 <OPTION value='BANK'>DEPOSIT</OPTION>
</SELECT></div></td></tr>	

<tr style="height:5px;"><td colspan='2'> <div class="col-md-12" style="padding:0px; margin:0px;">
 <div id="CHEQUE" class='hiddenDiv' style="border:1px solid #6666ff; border-radius:5px; padding:15px; color:#000099; 
 font-weight:normal; height:95px; width:100%; margin:0px 0px 15px 0px;">

<div class="col-md-6"> <input class="form-control form-center" name="cheno" type="text" placeholder="CHEQUE No" onkeypress='return isNumberKey(event)' style="height:22px;"></div>
		<div class="col-md-6"><div align='right'><select class="form-control" name="cba" style="height:22px; padding:0px;">
				<option value='' selected='selected'>BANK NAME</option>
			<?php
			$dois=mysqli_query($cons, "SELECT `Fnames` FROM `banks` ORDER BY `Fnames` ASC");
			while($rois=mysqli_fetch_assoc($dois)){
				$bank=$rois['Fnames'];
			echo"<option value='$bank'> $bank </option>";
			}
			?>   
                            </select></div></div>

	<div class="col-md-6"><div align='right'><br> Date of Payment
			&nbsp;:&nbsp; </div></div><div class="col-md-6"><br>
	<input class="form-control form-center" name="chpa" type="text" value="<?php echo $Date ?>" onkeypress='return isNumberKey(event)' style="height:22px;">
		
			</div>
					</div>
							</div>



            <div class="col-md-12" style="padding:0px; margin:0px;">
 <div id="BANK" class='hiddenDiv' style="border:1px solid #6666ff; border-radius:5px; padding:15px; color:#000099; 
 font-weight:normal; height:95px; width:100%; margin:0px 0px 15px 0px;">

<div class="col-md-6"> <input class="form-control form-center" name="slino" type="text" placeholder="BANK SLIP No" onkeypress='return isNumberKey(event)' style="height:22px;"></div>
		<div class="col-md-6"><div align='right'><select class="form-control" name="acco" style="height:22px; padding:0px;">
				<option value='' selected='selected'>BANK ACCOUNT</option>
			<?php
			$dois=mysqli_query($cons, "SELECT *FROM `baccount` WHERE `Status`='0' ORDER BY `Number` ASC");
			while($rois=mysqli_fetch_assoc($dois)){
				$nu=$rois['Number'];
				$bank=$rois['Bank'];
				$acco=$rois['Account'];
				$purpo=$rois['Purpose'];
			echo"<option value='$nu' title='$purpo'> $bank $acco </option>";
			}
			?>   
                            </select></div></div>

	<div class="col-md-6"><div align='right'><br> Date of Deposit
			&nbsp;:&nbsp; </div></div><div class="col-md-6"><br>
	<input class="form-control form-center" name="cbpa" type="text" value="<?php echo $Date ?>" onkeypress='return isNumberKey(event)' style="height:22px;">
		
			</div>
					</div>
							</div></td></tr>

<tr><td colspan='2'><TEXTAREA name="descri" class="form-control" rows="2" cols="56" onfocus='this.value=""'> Description ... </TEXTAREA></td></tr>

</table>

			</div>


		

  <div class="form-group">
            <label class="control-label col-md-3"><br><br>Done&nbsp;by</label>
            <div class="col-md-2" style='margin-right:30px;'>
              <br><br><input name="user" class="form-control" value="<?php echo $user ?>" type="text" style="width:210px;" readonly> &nbsp;&nbsp; 
			 </div> 

			  <label class="control-label col-md-1"><br><br>Date</label>
			<div class="col-md-5"><br><br>
			  <input name="dato" id="from" class="form-control" value="<?php echo $dato ?>" type="text" style="width:210px; text-align:center;" required>
            </div> 
 </div>

 <div class="form-group">
 <label class="control-label col-md-2"> </label>
    <label class="control-label col-md-3">Document File</label>
                     <div class="col-md-4">
              <div class="fileupload fileupload-new" data-provides="fileupload"><input value="<?php echo $rowid ?>" name="rowid" type="hidden">
                <span class="btn btn-default btn-file"><span class="fileupload-new">Select</span><span class="fileupload-exists">Change</span><input name="file1" id="app_file" type="file" readonly='readonly'></span><span class="fileupload-preview"></span><button class="close fileupload-exists" data-dismiss="fileupload" style="float:none" type="button">×</button>
		<?php echo $dfile ?>
				
                     
              </div>     <small>Zip, txt, jpeg, png, pdf, doc (Max : 2M)</small>
            </div>
            </div>

  <div class="form-group">
  <div class="col-md-12">
  
		<div class="col-sm-3"> </div>
		 <div class="col-sm-6" align='center' style='border:0px solid black;'>
		 <?php
		 if($_SESSION['Xacco']=='1'){
			 // form token 
        $form_token = uniqid();
 
        // create form token session variable and store generated id in it.
        $_SESSION['form_token'] = $form_token;
  	  echo"<input type='hidden' name='form_token' value='$form_token'>";
			 ?>
		 <button class="btn btn-lg btn-block btn-info" type="submit" name="mois"><i class="lnr lnr-exit-up"></i>&nbsp;&nbsp;SAVE </button> 
		 <?php
		}
			 ?>
   </div>
      
 </div></div>
 
 </form>
 </div>
 </div>
 </div>
 </div> 
</div>  
   <?php
   include'footer.php';
   ?>