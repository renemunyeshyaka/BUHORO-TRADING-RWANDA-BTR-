<?php
if(basename($_SERVER['PHP_SELF']) == 'cashbox.php') 
  $nv=" class='current'";
include'header.php';
include'connection.php';
$user=$loge;
$dato=$Date;
$pto=0;

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
			$curr=$_POST['currency'];

		if($emplo=='BANK'){
			$cheno=$_POST['cheno'];
			$pdate=$_POST['bto'];
			$bank=$_POST['bna'];
		}
		else{
			$cheno=$bank='';
			$pdate=$dato;
		}


	$so=mysqli_query($conn, "INSERT INTO `stouse` (`Date`, `User`, `Item`, `Quantity`, `Price`, `Destin`, `Action`, `Invoice`, `Rate`) VALUES ('$dato', '$loge', '0', '1', '$amo', '$purpo', 'CASHBOX', '$emplo', '$curr')");

		$pto=10;
		}

?>
<div class="container-fluid main-content">
        <div class="page-title hidden-print">
          <h2 style='margin-top:-20px; margin-bottom: 5px; color:#ffcc33'>
      CashBox
          </h2>
                 </div>
     
         <div class="row">
  <div class="col-lg-2 hidden-print">
   
   <ul class="list-group">
        <?php
			 if($_SESSION['Apc']){
			 ?>
	 <li class="list-group-item active">
	  <a href="cashbox.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Add to Cashbox
                </p>
              </a></li> 
              <?php
			 }
			 
			  if($_SESSION['Cpe']){
			 ?>

	 <li class="list-group-item">
	  <a href="madd.php">
                <p>
                <i class="lnr lnr-circle-minus"></i>&nbsp;Make a Payout
                </p>
              </a></li>
              <?php
			  }
              ?>
      
    <li class="list-group-item">
	  <a href="boxrepo.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;CashBox Report
                </p>
              </a></li> 
                         
            </ul><br><br>
            
  </div>
                    
           
           
       
         <div class="col-md-10">
 <div class="widget-container fluid-height clearfix">
 <div class="widget-content padded">
     <?php
   if($_SESSION['Apc']){
	   ?>
 <form method="post" class="form-horizontal" action="" enctype="multipart/form-data">
     <?php
   }
   ?>
   
 <br>
 <?php 
 $amos=number_format($amo);
if($pto==10)
echo"<center><div class='alert alert-danger' style='width:48%;text-align:center;float:center;background-color: #60c560;color: #ffffff;border-radius:5px;'>
		<i class='lnr lnr-checkmark-circle'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>&times;</button> $amos RWF is added to your cashbox. </div></center>";
	
			echo"<input value='$code' name='rowid' type='hidden'>";
			?>
			<div class="form-group">
            <label class="control-label col-md-3">Description</label>
            <div class="col-md-6">
           <select class="form-control" name="emplo" onchange='showDiv(this.value);' required>
				<option value='' selected='selected'>Source of payment</option>
			 <option value='BANK'> BANK </option>
			 <option value='SALES'> SALES </option>
			 <option value='OTHER'> OTHER </option>
                            </select>
            </div>
			<span style="color:#d43f3a">
                         *
                      </span>  
 </div><div class="row"></div>






















 <div class="form-group">
            <label class="control-label col-md-3"> </label>
            <div class="col-md-6">
 <div id='BANK' class='hiddenDiv' style="border:1px solid #6666ff; border-radius:5px; padding:15px; color:#000099; 
 font-weight:normal; height:100px; padding-top:20px;">
 <div style="margin-left:-95px; margin-bottom:0px; position:absolute;"></div>

<div class="col-md-6"> <input class="form-control form-center" name="cheno" type="text" placeholder="CHEQUE No" onkeypress='return isNumberKey(event)' style="height:22px;"></div>
		<div class="col-md-6"><div align='right'><select class="form-control" name="bna" style="height:22px; padding:0px;">
				<option value='' selected='selected'>ACCOUNT NUMBER</option>
			<?php
			$doi=mysqli_query($conn, "SELECT *FROM `baccount` ORDER BY `Number` ASC");
			while($roi=mysqli_fetch_assoc($doi)){
				$nu=$roi['Number'];
				$fna=$roi['Bank'];
				$acco=$roi['Account'];
				$purpo=$roi['Purpose'];
			echo"<option value='$nu' title='$purpo'> $fna $acco </option>";
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
            <label class="control-label col-md-3">Total Amount</label>
            <div class="col-md-4"><div class='input-group'>
              <span class='input-group-addon'><a href='#'>RWF</a></span><input name="amo" class="form-control text-center" type="text" 
			  onkeypress='return isNumberKey(event)' onkeyup='format(this);' required></div>
            </div><div class='col-md-2'>
		   <?php
		   echo"<select class='form-control' name='currency' required>";
			 
			$doi=mysqli_query($conn, "SELECT `Code`, `Rate` FROM `currency` WHERE `Code`!='' AND `Box`='1' ORDER BY `Code` ASC");
			while($roi=mysqli_fetch_assoc($doi)){
				$fna=$roi['Code'];
				$rate=$roi['Rate'];
				$rte=number_format($rate, 2);
			echo"<option value='$rate' selected> $fna @ $rte </option>";
			}
		
		   echo"</select>";
		   ?>
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
   if($_SESSION['Apc']){
	   ?>
    <button class="btn btn-lg btn-block btn-info" type="submit" name="addo" style="margin-top:30px;">
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