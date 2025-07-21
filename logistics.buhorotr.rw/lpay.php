<?php
if(basename($_SERVER['PHP_SELF']) == 'lpay.php') 
  $pr=" class='current'";
include'header.php';
include'connection.php';
$year=date("Y");
$empo=0;

	 if(isset($_POST['empo']))
		{	
		$empo=$_POST['empo'];
		}
    $namb="SAVE";
?>
<div class="container-fluid main-content">
        <div class="page-title">
          <h1 style='margin-top:-20px; margin-bottom: 5px;'>
         Contribute
          </h1>
                 </div>
     
         <div class="row">
  <div class="col-lg-2 hidden-print">
   
   
   
   <ul class="list-group">
      
    <li class="list-group-item">
	  <a href="conte.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Create Contribution
                </p>
              </a></li>  

	   <li class="list-group-item">
              <a href="cloan.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Loan Configuration
                </p>
              </a></li>  

	   <li class="list-group-item">
              <a href="rloan.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Loan Request
                </p>
              </a></li>    

	   <li class="list-group-item">
              <a href="payout.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Payout/Expenses
                </p>
              </a></li>    

	   <li class="list-group-item active">
              <a href="lpay.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Loan Repayment
                </p>
              </a></li> 
                         
            </ul>
  </div>
 <div class="col-md-10">
 <div class="widget-container fluid-height clearfix">
 <div class="widget-content padded">
 <form method="post" class="form-horizontal" action="" enctype="multipart/form-data" name='myform'>
 <input name="app_file_size" id="app_file_size" type="hidden">

  <?php 
if($pto==10)
echo"<center><div class='alert alert-danger' style='width:48%;text-align:center;float:center;background-color: #60c560;color: #ffffff;border-radius:5px;'>
		<i class='lnr lnr-checkmark-circle'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>×</button>New Payrool Has Been Submitted.
		</div></center>";

if($pto==20)
echo"<center><div class='alert alert-danger' style='width:48%;text-align:center;float:center;background-color: #60c560;color: #ffffff;border-radius:5px;'>
		<i class='lnr lnr-checkmark-circle'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>×</button>Payrool Request Has Been Updated.
		</div></center>";

		echo"<input value='$rowid' name='rowid' type='hidden'><input value='$file1' name='file1' type='hidden'>";
		?>

 <div class="form-group">
		<div class='col-sm-3 text-right' style='padding-top:10px;'> Employee Name </div>
			<div class='col-sm-4'><select class='form-control' name='empo' id='category' onchange='submitForm();' required>
				<option value='' selected='selected'>Select Employee</option>
		<?php
		
	$doi=mysqli_query($conn, "SELECT `request`.`Number`, `request`.`Employee`, `employees`.`Fname`, `employees`.`Lname`, `request`.`Payment`, `request`.`Balance`, `request`.`Scount` FROM `request` INNER JOIN `employees` ON `request`.`Employee`=`employees`.`Eid` WHERE `request`.`Status`='0' AND `request`.`Approve`>'0' ORDER BY `employees`.`Fname` ASC");
			while($roi=mysqli_fetch_assoc($doi)){
				$fna=$roi['Fname'];
				$eid=$roi['Employee'];
				$lna=$roi['Lname'];
				$nuo=$roi['Number'];
				$lempo="$eid@$nuo";
				if($eid==$empo){
					$e="selected";
					$bal=$roi['Balance'];
					$pay=$roi['Payment'];
					$sta=$roi['Scount'];
					if($bal<$pay)
						$payo=number_format($bal);
					else
						$payo=number_format($pay);
				}
				else{
					$e="";
					$pay="";
					$sta="";
				}
			echo"<option value='$eid' $e> $fna $lna </option>";
			}
			   
            ?></select></div>
					</div>

 

 <div class="form-group">
            <label class="control-label col-md-3">Paid Amount</label>
            <div class="col-md-4">
              <input name="refe" class="form-control" type="text" value="<?php echo $payo ?>" required>
            </div>
 </div>


 <div class="form-group">
 <label class="control-label col-md-3">Month / Year</label>
            <div class="col-sm-2">
 <select class="form-control" name="month" required>
	<option value=""> Select Month </option>
              <?php
			  $sta = strtotime("Y-m", $sta);
    if($empo){
		$date=strtotime("+1 month", strtotime("$sta"));
		$m = date("F", $date);				$y = date("Y", $date);
    echo "<option value='$date_str' selected> $m $sta </option>";
		} 
		?>
              </select>  
	 </div>
            <div class="col-sm-2">
	<select class="form-control" name="year" required>
		<option value=""> Select Year </option>
                 <?php
		if($empo){
    echo "<option value='$y' selected>$y</option>";
		} 
		?>
              </select> 
	</div></div>

	 <div class="form-group">
            <label class="control-label col-md-3">User / Date</label>
            <div class="col-md-2">
              <input name="user" class="form-control" type="text" value="<?php echo $loge ?>" readonly="readonly" required>
            </div>

            <div class="col-sm-2">
			 <div class="input-group date datepicker">
      <input class="form-control form-center" id="from" name="dato" type="text" value="<?php echo $Date ?>" onkeypress='return isNumberKey(event)' required>
	  <span class="input-group-addon"><i class="lnr lnr-calendar-full"></i></span>
              </div>
            </div>
           
 </div>

 <div class="form-group">
            <label class="control-label col-md-3">Reference</label>
            <div class="col-md-4">
              <input name="refe" class="form-control" type="text" required>
            </div>
 </div>


 <div class="form-group"><br><br>
  <div class="col-md-2"> </div>
    <label class="control-label col-md-3">Document File</label>
                     <div class="col-md-6">
              <div class="fileupload fileupload-new" data-provides="fileupload"><input value="" name="" type="hidden">
                <span class="btn btn-default btn-file"><span class="fileupload-new">Select</span><span class="fileupload-exists">Change</span><input name="file1" id="app_file" type="file"></span><span class="fileupload-preview"></span><button class="close fileupload-exists" data-dismiss="fileupload" style="float:none" type="button">×</button>
				
				<?php echo $dfile ?>
                     
              </div>     <small>Zip, txt, jpeg, png, pdf, doc (Max : 2M)</small>
            </div> 
            
            
            
            </div>
  <div class="form-group">
  <div class="col-md-12">
  <div class="col-md-3"></div>
   <div class="col-md-3">                 
    <button class="btn btn-lg btn-block btn-success" type="submit" name="<?php echo $namb ?>"><i class="lnr lnr-checkmark-circle"></i> <?php echo $valub ?> </button>         
   </div>   
		
		 <div class="col-sm-2" align='center' style='border:0px solid black; width:255px;'>
		 <button class="btn btn-lg btn-block btn-danger" type="button" style='width:210px;' onClick="location.href='slips.php'">
		 <i class="lnr lnr-undo"></i> Cancel </button>    
 </div></div>
 
 </form>
 </div>
 </div>
<?php
include'footer.php';
?>