<?php
if(basename($_SERVER['PHP_SELF']) == 'settings.php') {
  $cu=" class='current'";
} else {
  $cu="";
} 
include'header.php';

		// Edit a given bank account record
if(isset($_POST['edito']))
		{
			$numu=$_POST['numu'];
			$acco=$_POST['acco'];
			$name=$_POST['name'];
			$bank=$_POST['bank'];
			
			if($acco=='' OR $acco=='')
	$so=mysqli_query($cons, "UPDATE `baccount` SET `Status`='1' WHERE `Account` = '' WHERE `Number`='$numu' ORDER BY `Number` ASC LIMIT 1");
			else
	$so=mysqli_query($cons, "UPDATE `baccount` SET `Account`='$acco', `Bank`='$bank', `Name`='$name' WHERE `Number`='$numu' ORDER BY `Number` ASC LIMIT 1");
		}

		// Create a new bank account record
if(isset($_POST['eddo']))
		{
			$acco=$_POST['acco'];
			$name=$_POST['name'];
			$bank=$_POST['bank'];
	$so=mysqli_query($cons, "INSERT INTO `baccount` (`Bank`, `Account`, `Name`) VALUES ('$bank', '$acco', '$name')");
		}


		// Edit a store name
if(isset($_POST['editomail']))
		{
			$acco=$_POST['acco'];
			$numu=$_POST['numu'];
			
			if($acco!='')
	$sso=mysqli_query($cons, "UPDATE `stores` SET `Name`='$acco' WHERE `Number`='$numu' ORDER BY `Number` ASC LIMIT 1");
		}


		// Edit a given mail receiver record
if(isset($_POST['editobon']))
		{
			$numu=$_POST['numu'];
			$date=$_POST['date'];
			$name=$_POST['name'];

			if($name=='' OR $name==' ')
				$soso=mysqli_query($cons, "UPDATE `vouchers` SET `Status`='1' WHERE `Number`='$numu' ORDER BY `Number` ASC LIMIT 1");
			else
				$so=mysqli_query($cons, "UPDATE `vouchers` SET `Date`='$date', `Fullname`='$name' WHERE `Number`='$numu' ORDER BY `Number` ASC LIMIT 1");
		}

		// Create a new mail receiver record
if(isset($_POST['eddobon']))
		{
			$datei=$_POST['datei'];
			$namei=$_POST['namei'];
	$so=mysqli_query($cons, "INSERT INTO `ctype` (`Date`, `Type`, `Status`) VALUES ('$datei', '$namei', '0')");
		}
?>

<div class="container-fluid main-content">
<div class="page-title hidden-print" style="height:40px;">
        <h1>Settings</h1>
		
    </div>  <div class="row">
  <div class="col-lg-6 hidden-print pull-right" style="margin-top:-40px;"> 

   <div class="col-lg-3">  </div>

  <div class="col-lg-3">
                        <button class="btn btn-success btn-block btn-sm" type="button" data-toggle="modal" data-target="#exampleModal">
						<i class="lnr lnr-laptop-phone"></i> &nbsp;&nbsp; Bank Account </button>
						</div>

		 <div class="col-lg-3"><a href="#" data-placement='top' data-toggle='modal' data-target='#modal-x1021'>
					   <button class="btn btn-info btn-block btn-sm" type="button">
						<i class="lnr lnr-store"></i> &nbsp;&nbsp; Store Config </button></a>
						</div>

			<div class="col-lg-3"><form action='' method='post'>
					   <button class="btn btn-warning btn-block btn-sm" type="submit" name='adjust'>
						<i class="lnr lnr-layers"></i> &nbsp;&nbsp; Adjust Balance </button></a>
							</form></div>
  
  </div>
<?php
if(isset($_POST['adjust']))
							{	
$seek=mysqli_query($cons, "SELECT `Customer` FROM `account` WHERE `Status`='0' GROUP BY `Customer` ORDER BY `Customer` ASC LIMIT 1000");
	$feek=mysqli_num_rows($seek);
		while($roi=mysqli_fetch_assoc($seek)){
				$fna=$roi['Customer'];
				$nuo=$roi['Number'];
	$do=mysqli_query($cons, "SELECT SUM(Price * Quantity) AS 'Sales' FROM `stouse` WHERE (`Status`='0' AND `Destin`='$fna' AND `Action`='SALES' AND `Voucher`!='0') ORDER BY `Number` ASC LIMIT 1000000");
				$ro=mysqli_fetch_assoc($do);
					$sales=$ro['Sales'];

	$cusea=mysqli_query($cons, "SELECT SUM(Amount) AS 'Pay' FROM `payment` WHERE (`Customer`='$fna' AND `Pline`!='CREDIT' AND `Status`='0' AND `Action`='PAYMENT' AND `Voucher`!='0') OR (`Customer`='$fna' AND `Pline`!='CREDIT' AND `Status`='0' AND `Action`='SALES' AND `Voucher`!='0') ORDER BY `Number` ASC");
			$rpa=mysqli_fetch_assoc($cusea);
				$pay=$rpa['Pay'];
			$bal=$sales-$pay;
$then=mysqli_query($cons, "UPDATE `account` SET `Balance` = '$bal' WHERE `Customer`='$fna' LIMIT 1");
		}
		
echo"<br><center><div class='alert alert-danger' style='width:48%;text-align:center;float:center; color: #ffffff;border-radius:5px; height:24px; padding-top:2px;'>
		<i class='lnr lnr-checkmark-circle'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>×</button> $feek accounts for customers have been adjusted. </div></center>";
							}

	// **************************************** Bank Account Modal ******************************************************		
	echo"<div class='modal fade' id='exampleModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true' 
		style='top:80px;'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content' style='border-radius:5px;'>
      <div class='modal-header' style='border-radius:5px;'>
        <h5 class='modal-title' id='exampleModalLabel'> BANK ACCOUNT SETTINGS </h5>

      </div>
      <div class='modal-body' style='height:auto;'>
	  <table class='table table-striped'>     
                                      <thead>
                    <tr role='row'><th class='hidden-xs'>&nbsp;&nbsp;NO&nbsp;&nbsp;</th><th> Account Number </th>
					<th> Bank Name </th><th> Account Name </th><th style='width:80px;'><div align='center'> # </th></th>
						 <tbody>";
				$i=1;
	  $dob=mysqli_query($cons, "SELECT *FROM `baccount` WHERE `Status`='0' ORDER BY `Number` ASC");
		while($rob=mysqli_fetch_assoc($dob)){
			$numu=$rob['Number'];
			$bank=$rob['Bank'];
			$acco=$rob['Account'];
			$name=$rob['Name'];
			$stl="padding:2px;";
			$clr="";

			print("<tr><form method='post' action=''><td class='hidden-xs' style='$stl $clr'><div align='center'>$i&nbsp;&nbsp;</td>
						<td style='$stl $clr'><div align='left'>
						<input name='acco' class='form-control' type='text' style='text-align:left; width:140px; height:24px; margin:0px 0px 0px 0px; padding:0px 10px 0px 10px; background-color:transparent;' value='$acco' onChange=this.style.color='#ff3366'></td>

						<td style='$stl $clr'><div align='left'>
						<input name='bank' class='form-control' type='text' style='text-align:left; width:120px; height:24px; margin:0px 0px 0px 0px; padding:0px 10px 0px 10px; background-color:transparent;' value='$bank' onChange=this.style.color='#ff3366'></td>

						<td style='$stl $clr'><div align='left'>
						<input name='name' class='form-control' type='text' style='text-align:left; width:160px; height:24px; margin:0px 0px 0px 0px; padding:0px 10px 0px 10px; background-color:transparent;' value='$name' onChange=this.style.color='#ff3366'><input type='hidden' name='numu' value='$numu'></td>
						<td><div align='center'><button type='submit' class='btn btn-xs btn-warning hidden-print' name='edito' style='height:22px; margin:0px 0px 0px 0px; padding:0px;' title='Edit' data-toggle='tooltip' data-placement='top'>&nbsp;&nbsp;<i class='lnr lnr-pencil'></i>&nbsp;&nbsp;</button></td>
						</form></tr>");

						$i++;
		}

		print("<tr><form method='post' action=''><td class='hidden-xs' style='$stl $clr'><div align='center'>$i&nbsp;&nbsp;</td>
						<td style='$stl $clr'><div align='left'>
						<input name='acco' class='form-control' type='text' style='text-align:left; width:140px; height:24px; margin:0px 0px 0px 0px; padding:0px 10px 0px 10px; background-color:transparent;' onChange=this.style.color='#ff3366'></td>

						<td style='$stl $clr'><div align='left'>
						<input name='bank' class='form-control' type='text' style='text-align:left; width:120px; height:24px; margin:0px 0px 0px 0px; padding:0px 10px 0px 10px; background-color:transparent;' onChange=this.style.color='#ff3366'></td>

						<td style='$stl $clr'><div align='left'>
						<input name='name' class='form-control' type='text' style='text-align:left; width:160px; height:24px; margin:0px 0px 0px 0px; padding:0px 10px 0px 10px; background-color:transparent;' onChange=this.style.color='#ff3366'><input type='hidden' name='numu' value='$numu'></td>
						<td><div align='center'><button type='submit' class='btn btn-xs btn-success hidden-print' name='eddo' style='height:22px; margin:0px 0px 0px 0px; padding:0px;' title='Edit' data-toggle='tooltip' data-placement='top'>&nbsp;&nbsp;<i class='lnr lnr-plus-circle'></i>&nbsp;&nbsp;</button></td>
						</form></tr>");

			echo"</table></div><div class='modal-footer' style='margin-top:-10px; height:50px; padding-top:5px; border:0px solid blue;'>
       
        <button type='button' class='btn btn-sm btn-danger' data-dismiss='modal' style='height:20px; padding-top:0px; width:120px;'>CLOSE</button>
      </div>
    </div>
  </div>
</div>";

// *************************************************** End of Modal ************************************************************




// ********************************************* Store Configuration **************************************************************
	echo"<div id='modal-x1021' class='modal fade' role='dialog'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content' style='border-radius:5px;'>
      <div class='modal-header' style='border-radius:5px;'>
        <h5 class='modal-title' id='exampleModalLabel'> STORE CONFIGURATION </h5>

      </div>
      <div class='modal-body' style='height:auto;'>
	  <table class='table table-striped'>     
                                      <thead>
                    <tr role='row'><th class='hidden-xs'>&nbsp;No&nbsp;&nbsp;</th><th> Store Name </th>
					<th class='text-center'> Code </th><th class='text-center'> Status </th>
					<th style='width:80px;'><div align='center'> # </th></th><tbody>";
				$i=1;
	  $dob=mysqli_query($cons, "SELECT *FROM `stores` WHERE `Status`>='0' ORDER BY `Number` ASC");
		while($rob=mysqli_fetch_assoc($dob)){
			$numu=$rob['Number'];
			$bank=$rob['Store'];
			$acco=$rob['Name'];
			if($rob['Status']=='1')
				$sta="MAIN";
			else
				$sta="SUB";
			$stl="padding:2px;";
			$clr="";

			print("<tr><form method='post' action=''><td class='hidden-xs' style='$stl $clr'><div align='center'>$i&nbsp;&nbsp;</td>
						<td style='$stl $clr'><div align='left'>
						<input name='acco' class='form-control' type='text' style='text-align:left; width:220px; height:24px; margin:0px 0px 0px 0px; padding:0px 10px 0px 10px; background-color:transparent;' value='$acco' onChange=this.style.color='#ff3366'></td>

						<td style='$stl $clr'><div align='left'>
						<input name='bank' class='form-control text-center' type='text' style='width:90px; height:24px; margin:0px 0px 0px 0px; padding:0px 10px 0px 10px; background-color:transparent;' value='$bank' onChange=this.style.color='#ff3366' disabled></td>

						<td style='$stl $clr'><div align='left'>
						<input name='stat' class='form-control text-center' type='text' style='width:80px; height:24px; margin:0px 0px 0px 0px; padding:0px 10px 0px 10px; background-color:transparent;' value='$sta' onChange=this.style.color='#ff3366' disabled></td>

						<td><input type='hidden' name='numu' value='$numu'><div align='center'><button type='submit' class='btn btn-xs btn-warning hidden-print' name='editomail' style='height:22px; margin:0px 0px 0px 0px; padding:0px; width:60px;' title='Edit' data-toggle='tooltip' data-placement='top'>&nbsp;&nbsp;<i class='lnr lnr-pencil'></i>&nbsp;&nbsp;</button></td>
						</form></tr>");

						$i++;
		}
			echo"</table></div><div class='modal-footer' style='margin-top:-10px; height:50px; padding-top:5px; border:0px solid blue;'>
       
        <button type='button' class='btn btn-sm btn-danger' data-dismiss='modal' style='height:20px; padding-top:0px; width:120px;'>CLOSE</button>
      </div>
    </div>
  </div>
</div>";

// *************************************************** End of Modal ************************************************************





// ********************************************* Charge Types **************************************************************
	echo"<div id='modal-x1123' class='modal fade' role='dialog'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLabel'> CREATE CHARGE TYPE
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </h5>

      </div>
      <div class='modal-body' style='height:auto;'>
	  <table class='table table-striped table-hover' style='margin-top:-15px;'>";
	  

		print("<tr><form method='post' action=''><td class='hidden-xs' style='$stl $clr'>
		<div align='center'>&nbsp;&nbsp;&nbsp;&nbsp;1&nbsp;&nbsp;</td><td style='$stl $clr'><div align='left'>
						<input name='datei' class='form-control' type='text' style='text-align:center; width:120px; height:24px; margin:0px 0px 0px 0px; padding:0px 10px 0px 10px; background-color:transparent;' onChange=this.style.color='#ff3366' value='$Date' id='from'></td>

						<td style='$stl $clr'><div align='left'>
						<input name='namei' class='form-control' type='text' style='text-align:left; width:320px; height:24px; margin:0px 0px 0px 0px; padding:0px 10px 0px 10px; background-color:transparent;' onChange=this.style.color='#ff3366'></td>

				<td style='$stl $clr'><div align='center'><button type='submit' class='btn btn-xs btn-success hidden-print' name='eddobon' style='height:22px; margin:0px 0px 0px 0px; padding:0px;' title='Add New' data-toggle='tooltip' data-placement='top'>&nbsp;&nbsp;<i class='lnr lnr-plus-circle'></i>&nbsp;&nbsp;</button></td></form></tr>");

				$i=2;
	  $dob=mysqli_query($cons, "SELECT *FROM `ctype` WHERE `Status`='0' ORDER BY `Type` ASC");
		while($rob=mysqli_fetch_assoc($dob)){
			$numu=$rob['Number'];
			$date=$rob['Date'];
			$acco=$rob['Type'];
			$stl="padding:0px 2px; 0px 2px";
			$clr="";

			print("<tr style='height:10px;'><form method='post' action=''>
			<td class='hidden-xs' style='$stl $clr'><div align='center'>&nbsp;&nbsp;&nbsp;&nbsp;$i&nbsp;&nbsp;</td>
						<td style='$stl $clr'><div align='left'><input type='hidden' name='numu' value='$numu'>
						<input name='date' class='form-control' type='text' style='text-align:center; width:120px; height:24px; margin:0px 0px 0px 0px; padding:0px 10px 0px 10px; background-color:transparent;' value='$date' onChange=this.style.color='#ff3366'></td>

						<td style='$stl $clr'><div align='left'>
						<input name='name' class='form-control' type='text' style='text-align:left; width:320px; height:24px; margin:0px 0px 0px 0px; padding:0px 10px 0px 10px; background-color:transparent;' value='$acco' onChange=this.style.color='#ff3366'></td>

						<td style='$stl $clr'><div align='center'><button type='submit' class='btn btn-xs btn-warning hidden-print' name='editobon' style='height:22px; margin:0px 0px 0px 0px; padding:0px;' title='Edit' data-toggle='tooltip' data-placement='top'>&nbsp;&nbsp;<i class='lnr lnr-pencil'></i>&nbsp;&nbsp;</button></td></form></tr>");

						$i++;
		}

			echo"</table></div><div class='modal-footer' style='margin-top:-10px; height:40px; padding-top:5px; border:0px solid blue;'>
       
        <button type='button' class='btn btn-sm btn-danger' data-dismiss='modal' style='height:20px; padding-top:0px; width:120px;'>CLOSE</button>
      </div>
    </div>
  </div>
</div>";

// *************************************************** End of Modal ************************************************************
					?>
			</div>
 <div class="row">
 <div class="col-md-12">
 <div class="widget-container fluid-height clearfix">
 <div class="widget-content padded">
 <form method="post" class="form-horizontal" action="" enctype="multipart/form-data">
 <div class="row">
 <div class="col-md-12">
 <div class="col-md-6">
   <div class="form-group">
            <label class="control-label col-md-3">Company-Name</label>
            <div class="col-md-6">
              <input class="form-control" name="cna" value="<?php echo $cna ?>" type="text" readonly>
            </div>
          </div>
   <div class="form-group">
            <label class="control-label col-md-3">Company-Email</label>
            <div class="col-md-6">
              <input class="form-control" name="mail" value="<?php echo $mail ?>" type="text">
            </div>
   </div>
    <div class="form-group">
 <label class="control-label col-md-3">Company-Website</label>
     <div class="col-md-6">
                <input class="form-control" name="web" value="<?php echo $web ?>" type="text">
              </div></div>
  <div class="form-group">
                   <label class="control-label col-md-3">Address</label>
                  <div class="col-md-6">
              <textarea class="form-control" name="adde"><?php echo $adde ?>          
                              </textarea>
            </div> 
          </div>
    
          <div class="form-group">
          <label class="control-label col-md-3">Country</label>
          <div class="col-md-6">
<select class="form-control" name="country">
        <option value=""></option>
    <option value="<?php echo $country ?>" selected><?php echo $country ?></option>
</select>
          </div>
          </div>
          <div class="form-group">
                   <label class="control-label col-md-3">City</label>
                  <div class="col-md-6">
             <input class="form-control" name="city" value="<?php echo $city ?>" type="text">
            </div> 
          </div>
          <div class="form-group">
                   <label class="control-label col-md-3">Telephone 1</label>
                  <div class="col-md-6">
              <input class="form-control" name="pho1" value="<?php echo $pho1 ?>" type="text">
            </div> 
          </div>
          <div class="form-group">
                   <label class="control-label col-md-3">Telephone 2</label>
                  <div class="col-md-6">
              <input class="form-control" name="pho2" value="<?php echo $pho2 ?>" type="text">
            </div> 
          </div> 
 </div>
 <div class="col-md-6">
   
  
            <div class="form-group">
    <label class="control-label col-md-3">Invoice Start From</label>
                     <div class="col-md-6">
              <input class="form-control" name="invoice" value="001" type="text">
              </div>
            </div> 
			<?php
			if($Receipt){
				$y='selected';
				$n='';
			}
			else{
				$y='';
				$n='selected';
			}
			?>
 <div class="form-group">
    <label class="control-label col-md-3">Print a Receipt</label>
                     <div class="col-md-6">
                     <select class="form-control" name="receipt"><option value="1" <?php echo $y ?>>YES</option>
                     <option value="0" <?php echo $n ?>>NO</option>        
                     </select>
              </div>
            </div> 
   <div class="form-group">
    <label class="control-label col-md-3">Tax Number</label>
                     <div class="col-md-6">
              <input class="form-control" name="tax" value="<?php echo $tax ?>" type="text">
              </div>
            </div>       
   <div class="form-group">
    <label class="control-label col-md-3">Currency Symbol</label>
                     <div class="col-md-3">
              <input class="form-control" name="curre1" value="<?php echo $curre1 ?>" style='text-align:center;' OnKeyup='return cUpper(this);' type="text">
              </div>
			   <div class="col-md-3">
              <input class="form-control" name="curre2" value="<?php echo $curre2 ?>" style='text-align:center;' OnKeyup='return cUpper(this);' readonly type="text">
              </div>
            </div>  
 <div class="form-group">
 <label class="control-label col-md-3">Auto Logout</label>
     <div class="col-md-6" style="text-align:center;">
	 <?php
	 if($bch=='1'){
		$yes="checked='checked'";
		$no='';
		}
		else{
			$yes='';
			$no="checked='checked'";
		}
		?>

              <label class="radio-inline">
              <input name="bch" id="watermark_yes" value="1" <?php echo $yes ?> type="radio">
              <span>Yes</span>
              </label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <label class="radio-inline">
              <input name="bch" id="watermark_no" value="0" <?php echo $no ?> type="radio">
              <span>No</span></label>
              </div>
              </div> 
      <div class="form-group"><br><br>
            <label class="control-label col-md-3">Upload Logo</label>
            <div class="col-md-4">
              <div class="fileupload fileupload-new" data-provides="fileupload">
              <input value="" name="" type="hidden">
                <div class="fileupload-new img-thumbnail">
                      <img src="imgs/logo.png" width="100%">
                     
                </div>
                <div class="fileupload-preview fileupload-exists img-thumbnail" style="width: 200px; max-height: 150px;"></div>
                <div>
                  <span class="btn btn-default btn-file">
                  <span class="fileupload-new">Select image</span>
                  <span class="fileupload-exists">Change</span>
                  <input name="logo" id="logo" type="file"></span>
                  <a class="btn btn-default fileupload-exists" data-dismiss="fileupload" href="#">Remove</a>&nbsp;
             <small>Only&nbsp;<b>.png</b>&nbsp;(Max&nbsp;:&nbsp;64M)</small>
                  
                </div>
              </div>
            </div>
          </div> 
 
 </div></div></div>
 <?php
				if($_SESSION['Settings']=='1'){
					?>
   <div class="form-group">
  <div class="col-md-1"></div>
   <div class="col-md-10"> <br><br>                
    <button class="btn btn-lg btn-block btn-primary" type="submit" name="submit_settings"><i class="lnr lnr-chevron-up-circle"></i> Update</button>         
   </div>
   <div class="col-md-1"></div>
 </div>
 <?php
					}
				?>

 </form></div></div><br><br><br></div></div></div>  
   <?php
   include'footer.php';
   ?>