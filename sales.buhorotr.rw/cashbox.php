<?php
if(basename($_SERVER['PHP_SELF']) == 'cashbox.php') 
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

if(isset($_POST['addo']))
		{
			$emplo=$_POST['emplo'];
			$amo=$_POST['amo'];
				$amo=preg_replace('/,/', '', $amo);
				//$amo=-1*$amo;
			$purpo=$_POST['purpo'];
				$purpo=str_replace("'", "`", $purpo);
			$user=$_POST['user'];
			$dato=$_POST['dato'];

		if($emplo=='CHEQUE'){
			$cheno=$_POST['cheno'];
			$bto=$_POST['bto'];
			$bna=$_POST['bna'];
		}
		elseif($emplo=='BANK'){
				$cheno=$_POST['slino'];
				$bna=$_POST['acco'];
				$bto=$_POST['cbpa'];
				
	$and=mysqli_query($cons, "INSERT INTO `deposit` (`Date`, `Time`, `User`, `Item`, `Refer`, `Amount`, `Customer`, `Operation`, `Status`, `Valid`, `Account`, `Descri`, `Client`, `Voucher`, `Source`, `Branche`) VALUES ('$bto', '$Time', '$loge', 'DEPOSIT', '$cheno', '$amo', '', 'CASHBOX', '0', '0', '$bna', '$purpo', '0', '99999999999', 'DIRECT', '$brc')"); 
			}
			else{
				$cheno=$bna='';
				$bto=$dato;
			}
			
$so=mysqli_query($cons, "INSERT INTO `payment` (`Date`, `Time`, `Cashier`, `Amount`, `Pline`, `Status`, `Action`, `Description`, `Payto`, `Cheno`, `Bname`, `Pdate`, `Voucher`, `Branche`) VALUES ('$dato', '$Time', '$loge', '$amo', '$emplo', '0', 'CASHBOX', '$purpo', '', '$cheno', '$bna', '$bto', '99999999999', '$brc')");
		$pto=10;
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

   <li class="list-group-item">
	  <a href="dadd.php" <?php echo $dsa ?>>
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Pay on Account
                </p>
              </a></li>  

   <li class="list-group-item active">
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
		
			  <?php
		if($_SESSION['Xbra']){
			 $dbutn='submit';
			 $disa='';
		 }
		 else{
			 $dbutn='button';
			 $disa='You are not allowed to use this button';
		 }
   ?>
  
                    
           
           
       
         <div class="col-md-10">
 <div class="widget-container fluid-height clearfix">
 <div class="widget-content padded">
 <form method="post" class="form-horizontal" action="" enctype="multipart/form-data">
 <input name="app_file_size" id="app_file_size" type="hidden">
 <br>
 <?php 
 $amos=number_format($amo);
if($pto==10)
echo"<center><div class='alert alert-danger' style='width:48%;text-align:center;float:center;background-color: #60c560;color: #ffffff;border-radius:5px;'>
		<i class='lnr lnr-checkmark-circle'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>×</button>$amos RWF is added to your cashbox.
		</div></center>";
if($pto==20)
echo"<center><div class='alert alert-danger' style='width:48%;text-align:center;float:center;background-color: #60c560;color: #ffffff;border-radius:5px;'>
		<i class='lnr lnr-checkmark-circle'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>×</button>$amos RWF is removed from your cashbox.
		</div></center>";
	
			echo"<input value='$code' name='rowid' type='hidden'>";
			?>
			<div class="form-group">
            <label class="control-label col-md-3"> Destination </label>
            <div class="col-md-6">
           <select class="form-control" name="emplo" onchange='showDiv(this.value);' required>
				<option value='' selected='selected'>Mode of payment</option><option value='CASH'> CASH </option>
			 <option value='CHEQUE'> CHEQUE </option>
			 <option value='BANK'> DEPOSIT </option>
                            </select>
            </div>
			<span style="color:#d43f3a">
                         *
                      </span>  
 </div>






















 <div class="form-group">
            <label class="control-label col-md-3"> </label>
            <div class="col-md-6">
 <div id='CHEQUE' class='hiddenDiv' style="border:1px solid #6666ff; border-radius:5px; padding:15px; color:#000099; 
 font-weight:normal; height:100px; padding-top:20px;">
 <div style="margin-left:-95px; margin-bottom:0px; position:absolute;">CHEQUE</div>

<div class="col-md-6"> <input class="form-control form-center" name="cheno" type="text" placeholder="CHEQUE No" onkeypress='return isNumberKey(event)' style="height:22px;"></div>
		<div class="col-md-6"><div align='right'><select class="form-control" name="bna" style="height:22px; padding:0px;">
				<option value='' selected='selected'>BANK NAME</option>
			<?php
			$doi=mysqli_query($conn, "SELECT `Fnames` FROM `banks` ORDER BY `Fnames` ASC");
			while($roi=mysqli_fetch_assoc($doi)){
				$fna=$roi['Fnames'];
			echo"<option value='$fna'> $fna </option>";
			}
			?>   
                            </select></div></div>

	<div class="col-md-6"><div align='right'><br> Date of Payment
			&nbsp;:&nbsp; </div></div><div class="col-md-6"><br>
	<input class="form-control form-center" id="to" name="bto" type="text" value="<?php echo $Date ?>" onkeypress='return isNumberKey(event)' style="height:22px;">
		<?php
							echo"<input type='hidden' name='custo' value='$custo'>";
						?>
			</div>
					</div>
							<div class="col-md-3"> </div></div></div>
							
		<div class="form-group">					
							<label class="control-label col-md-3"> </label>
            <div class="col-md-6">
 <div id="BANK" class='hiddenDiv' style="border:1px solid #6666ff; border-radius:5px; padding:15px; color:#000099; 
 font-weight:normal; height:95px; width:100%; margin:0px 0px 15px 0px;">
 <div style="margin-left:-95px; margin-bottom:0px; position:absolute;">DEPOSIT</div>

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
					</div><div class="col-md-3"> </div>
							</div></div>




















  <div class="form-group">
            <label class="control-label col-md-3">Total Amount</label>
            <div class="col-md-6">
              <input name="amo" class="form-control" type="text" onkeypress='return isNumberKey(event)' onkeyup='format(this);' required>
            </div>
			  <span style="color:#d43f3a">
                         *
                      </span>  
 </div>
 <div class="form-group">
   <label class="control-label col-md-3">Description</label>
                  <div class="col-md-6">
              <input class="form-control" name="purpo" type="text" required>
            </div> 
			  <span style="color:#d43f3a">
                        *
                      </span>  
			</div>


		

  <div class="form-group">
            <label class="control-label col-md-3"><br>Done&nbsp;by</label>
            <div class="col-md-2" style='margin-right:30px;'>
              <br><input name="user" class="form-control" value="<?php echo $user ?>" type="text" style='width:210px;' readonly> &nbsp;&nbsp; 
			 </div> 

			  <label class="control-label col-md-1"><br>Date</label>
			<div class="col-md-5"><br>
			  <input name="dato" id="from" class="form-control" value="<?php echo $dato ?>" type="text" style='width:210px; text-align:center;' required>
            </div> 
 </div>

 <div class="form-group">
    <label class="control-label col-md-2"> </label>
    <label class="control-label col-md-3">Document File</label>
                     <div class="col-md-1">
              <div class="fileupload fileupload-new" data-provides="fileupload"><input value="<?php echo $rowid ?>" name="rowid" type="hidden">
                <span class="btn btn-default btn-file"><span class="fileupload-new">Select</span><span class="fileupload-exists">Change</span><input name="file1" id="app_file" type="file" readonly='readonly'></span><span class="fileupload-preview"></span><button class="close fileupload-exists" data-dismiss="fileupload" style="float:none" type="button">×</button>
		<?php echo $dfile ?>
				
                     
              </div></div>     &nbsp;&nbsp;&nbsp;&nbsp;<small>Zip, txt, jpeg, png, pdf, doc (Max : 2M)</small>
            
            </div>

  <div class="form-group">
  <div class="col-md-12">
  <div class="col-sm-2"></div>
   <div class="col-sm-7" align='center' style='border:0px solid black;'> 
   <?php
   if($_SESSION['Xacco']=='1'){
	   ?>
    <button class="btn btn-lg btn-block btn-success" type="submit" name="addo">
	<i class="lnr lnr-enter-down"></i>&nbsp;&nbsp;SAVE </button>   
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