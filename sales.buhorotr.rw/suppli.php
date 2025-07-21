<?php
if(basename($_SERVER['PHP_SELF']) == 'suppli.php') 
  $tt=" class='current'";
include'header.php';
include'connection.php';
$user=$loge;
$dato=$Date;
$pto=0;

if(isset($_POST['mois']))
		{
			$emplo=$_POST['emplo'];
			$amo=$_POST['amo'];
				$amo=preg_replace('/,/', '', $amo);
			$purpo=$_POST['purpo'];
				$purpo=str_replace("'", "`", $purpo);
			$user=$_POST['user'];
			$dato=$_POST['dato'];
			$payto=$_POST['payto'];
			$cheno=$_POST['cheno'];
			$bank=$_POST['bank'];
$so=mysqli_query($cons, "INSERT INTO `payment` (`Date`, `Time`, `Cashier`, `Amount`, `Pline`, `Voucher`, `Status`, `Customer`, `Action`, `Description`, `Payto`, `Cheno`, `Bname`, `Pdate`, `Branche`, `Upda`) VALUES ('$dato', '$Time', '$loge', '$amo', 'CHEQUE', '99999999999', '0', '$payto', 'PAYOUT', '$purpo', '$emplo', '$cheno', '$bank', '$dato', '0', '1')");
		$pto=20;
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
      
    <li class="list-group-item active">
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
 <div class="col-md-10">
 <div class="widget-container fluid-height clearfix" style='margin-top:-40px;'>
 <div class="widget-content padded">
 <form method="post" class="form-horizontal" action="" enctype="multipart/form-data">
 <input name="app_file_size" id="app_file_size" type="hidden">
 <br>
 <?php 
 $amos=number_format($amo);
if($pto==10)
echo"<center><div class='alert alert-danger' style='width:48%;text-align:center;float:center;background-color: #60c560;color: #ffffff;border-radius:5px;'>
		<i class='lnr lnr-checkmark-circle'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>×</button>$amos is added to your cashbox.
		</div></center>";
if($pto==20)
echo"<center><div class='alert alert-danger' style='width:48%;text-align:center;float:center;background-color: #60c560;color: #ffffff;border-radius:5px;'>
		<i class='lnr lnr-checkmark-circle'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>×</button>A cheque of RWF $amos is paid to $payto.
		</div></center>";
	
			echo"<input value='$code' name='rowid' type='hidden'>";
			?>
			<div class="form-group">
            <label class="control-label col-md-3">Destination</label>
            <div class="col-md-6">
           <select class="form-control" name="emplo" required>
				<option value='' selected='selected'>Select Destination</option>
			 <?php
			$doi=mysqli_query($cons, "SELECT *FROM `dtype` WHERE `Type`!='' ORDER BY `Type` ASC");
			while($roi=mysqli_fetch_assoc($doi)){
				$code=$roi['Number'];
				$fna=$roi['Type'];
			echo"<option value='$fna'> $fna </option>";
			}
			?>    
                            </select>
            </div>
			<span style="color:#d43f3a">
                         *
                      </span>  
 </div>
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
              <input class="form-control" name="purpo" type="text">
            </div> 
			  <span style="color:#d43f3a">
                         *
                      </span>  
			</div>
			
 <div class="form-group">
   <label class="control-label col-md-3">Paid To <font size='1'>(Receiver)</font></label>
                  <div class="col-md-6">
              <input class="form-control" name="payto" type="text" id="searcha">
            </div> 
			  <span style="color:#d43f3a">
                         *
                      </span>  
			</div>

<div class="form-group">
   <label class="control-label col-md-3">Cheque Details</label>
                  <div class="col-md-3">
              <input class="form-control" name="cheno" type="text" placeholder="Cheque No" style="text-align:center;" required>
            </div>   <div class="col-md-3"><select class="form-control" name="bank" required>
				<option value='' selected='selected'>SELECT BANK</option>
			<?php
			$doi=mysqli_query($cons, "SELECT `Fnames` FROM `banks` ORDER BY `Fnames` ASC");
			while($roi=mysqli_fetch_assoc($doi)){
				$fna=$roi['Fnames'];
			echo"<option value='$fna'> $fna </option>";
			}
			?>   
                            </select>
            </div> 
			  <span style="color:#d43f3a">
                         *
                      </span>  
			</div>


		

  <div class="form-group">
            <label class="control-label col-md-3"><br><br>Done&nbsp;by</label>
            <div class="col-md-2" style='margin-right:30px;'>
              <br><br><input name="user" class="form-control" value="<?php echo $user ?>" type="text" style='width:210px;' readonly> &nbsp;&nbsp; 
			 </div> 

			  <label class="control-label col-md-1"><br><br>Date</label>
			<div class="col-md-5"><br><br>
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
				
                     
              </div></div>
			  &nbsp;&nbsp;&nbsp;&nbsp;<small>Zip, txt, jpeg, png, pdf, doc (Max : 2M)</small>
            
            </div>

  <div class="form-group">
  <div class="col-md-12">
  
		<div class="col-sm-1"> </div>
		 <div class="col-sm-9" align='center' style='border:0px solid black;'>
		 <?php
		 if($_SESSION['Xacco']=='1'){
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