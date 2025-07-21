<?php
if(basename($_SERVER['PHP_SELF']) == 'allows.php') 
  $pr=" class='current'";
include'header.php';
include'connection.php';
$pto=0;

if(isset($_POST['submit_duct']))
		{
			$emplo=$_POST['emplo'];
			$amo=$_POST['amo'];
				$amo=preg_replace('/,/', '', $amo);
			$purpo=$_POST['purpo'];
			$user=$_POST['user'];
			$dato=$_POST['dato'];

	$temp1 = explode(".", $_FILES["file1"]["name"]);
$newfilename1 = round(microtime(true)) . '.' . end($temp1);
move_uploaded_file($_FILES["file1"]["tmp_name"], "allows/" . $newfilename1);
	if(!end($temp1))
	$newfilename1='';

$so=mysql_query("INSERT INTO `allows` (`Employee`, `Amount`, `Purpose`, `File1`, `User`, `Date`) VALUES ('$emplo', '$amo', '$purpo', '$newfilename1', '$loge', '$dato')");
		$pto=10;
		}

		if(isset($_POST['edit_id']))
		{
			$rowid=$_POST['rowid'];
			$do=mysql_query("SELECT *FROM `allows` WHERE `Number`='$rowid' LIMIT 1");
				$ro=mysql_fetch_assoc($do);
					$code=$ro['Number'];
					$amo=number_format($ro['Amount']);
					$emplo=$ro['Employee'];
					$purpo=$ro['Purpose'];
					$user=$ro['User'];
					$dato=$ro['Date'];

					$file1=$ro['File1'];
					if($file1)
						$dfile="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='down_allo.php?link=$file1'>Download File</a>";
					else
						$dfile="";

				$namb="update_duct";
				$valub="Update";
		}
		else{
			$emplo='';
			$amo='';
			$purpo='';
			$user=$loge;
			$dato=$Date;

			$dfile="";
			$rowid=0;
			
			$namb="submit_duct";
				$valub="Submit";
		}

		if(isset($_POST['update_duct']))
		{
			$rowid=$_POST['rowid'];
			$emplo=$_POST['emplo'];
			$amo=$_POST['amo'];
				$amo=preg_replace('/,/', '', $amo);
			$purpo=$_POST['purpo'];
			$user=$loge;
			$dato=$Date;

	$temp1 = explode(".", $_FILES["file1"]["name"]);
$newfilename1 = round(microtime(true)) . '.' . end($temp1);
move_uploaded_file($_FILES["file1"]["tmp_name"], "allows/" . $newfilename1);
	if(!end($temp1)){
	$newfilename1='';
	$upda="";
	}
	else{
	$upda=", `File1`='$newfilename1'";
	}

$so=mysql_query("UPDATE `allows` SET `Employee`='$emplo', `Amount`='$amo', `Purpose`='$purpo', `User`='$loge', `Date`='$dato' $upda WHERE `Number`='$rowid' LIMIT 1");
$pto=20;
			$amo=number_format($amo);		

				$namb="update_duct";
				$valub="Update";
		}

		
		


//$do=mysql_query("SELECT *FROM `position`");
//$fo=mysql_num_rows($do);
?>
<div class="container-fluid main-content">
<div class="page-title">
        <h1 style='margin-top:-20px; margin-bottom: 5px;'>Allowance</h1>
  
    </div>
<div class="row">
<div class="col-md-2">
 
  <ul class="list-group">
   
      <li class="list-group-item">
	  <a href="alist.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Allowance List
                </p>
              </a></li>  

	   <li class="list-group-item active">
              <a href="allows.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Create New Record
                </p>
              </a></li> 
          </ul>
        </div>
 <div class="col-md-10">
 <div class="widget-container fluid-height clearfix">
 <div class="widget-content padded">
 <form method="post" class="form-horizontal" action="allows.php" enctype="multipart/form-data">
 <input name="app_file_size" id="app_file_size" type="hidden">
 <br>
 <?php 
if($pto==10)
echo"<center><div class='alert alert-danger' style='width:48%;text-align:center;float:center;background-color: #60c560;color: #ffffff;border-radius:5px;'>
		<i class='lnr lnr-checkmark-circle'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>×</button>Allowance Record Has Been Created.
		</div></center>";
if($pto==20)
echo"<center><div class='alert alert-danger' style='width:48%;text-align:center;float:center;background-color: #60c560;color: #ffffff;border-radius:5px;'>
		<i class='lnr lnr-checkmark-circle'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>×</button>Allowance Record Has Been Updated.
		</div></center>";
if($pto==30)
echo"<center><div class='alert alert-danger' style='width:48%;text-align:center;float:center;border-radius:5px;'>
		<i class='lnr lnr-checkmark-circle'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>×</button>Nothing Has Been Changed.
		</div></center>";
	
			echo"<input value='$code' name='rowid' type='hidden'>";
			?>
			<div class="form-group">
            <label class="control-label col-md-3">Employee</label>
            <div class="col-md-6">
           <select class="form-control" name="emplo" required>
				<option value='' selected='selected'>Select Employee</option>
			 <?php
			$doi=mysql_query("SELECT *FROM `employees` WHERE `Status`='0' ORDER BY `Fname` ASC");
			while($roi=mysql_fetch_assoc($doi)){
				$code=$roi['Eid'];
				$fna=$roi['Fname'];
				$lna=$roi['Lname'];
				if($code==$emplo)
					$sle="selected='selected'";
				else
					$sle='';
			echo"<option value='$code' $sle> $fna $lna </option>";
			}
			?>    
                            </select>
            </div>
			<span style="color:#d43f3a">
                         mandatory
                      </span>  
 </div>
  <div class="form-group">
            <label class="control-label col-md-3">Total Amount</label>
            <div class="col-md-6">
              <input name="amo" class="form-control text-center" type="text" value="<?php echo $amo ?>" onkeypress='return isNumberKey(event)' onkeyup='format(this);' required>
            </div> 
 </div>
 <div class="form-group">
   <label class="control-label col-md-3">Purpose/Issue</label>
                  <div class="col-md-6">
              <input class="form-control" name="purpo" type="text" value="<?php echo $purpo ?>" required>
            </div> 
			</div>
		

  <div class="form-group">
            <label class="control-label col-md-3"><br><br>Done&nbsp;by</label>
            <div class="col-md-2" style='margin-right:20px;'>
              <br><br><input name="user" class="form-control" value="<?php echo $user ?>" style='width:260px;' type="text" readonly> &nbsp;&nbsp; 
			 </div> 

			  <label class="control-label col-md-2"><br><br>Due&nbsp;Date</label>
			<div class="col-md-2"><br><br>
			  <input name="dato" class="form-control" value="<?php echo $dato ?>" type="text" style='width:130px; text-align:center;' 
			  id="from">
            </div> 
 </div>

 <div class="form-group">
	<div class="col-md-3"> </div>
    <label class="control-label col-md-2">Document File</label>
                     <div class="col-md-6">
              <div class="fileupload fileupload-new" data-provides="fileupload"><input value="<?php echo $rowid ?>" name="rowid" type="hidden">
                <span class="btn btn-default btn-file"><span class="fileupload-new">Select</span><span class="fileupload-exists">Change</span><input name="file1" id="app_file" type="file" readonly='readonly'></span><span class="fileupload-preview"></span><button class="close fileupload-exists" data-dismiss="fileupload" style="float:none" type="button">×</button>
		<?php echo $dfile ?>
				
                     
              </div>     <small>Zip, txt, jpeg, png, pdf, doc (Max : 2M)</small>
            </div>
            </div>

  <div class="form-group">
  <div class="col-md-12"><br>
  <div class="col-md-3"></div>
   <div class="col-sm-2" align='center' style='border:0px solid black; width:255px;'>                 
    <button class="btn btn-lg btn-block btn-success" type="submit" name="<?php echo $namb ?>" style='width:210px;'>
	<i class="lnr lnr-checkmark-circle"></i> <?php echo $valub ?></button>   
	  
		</div>
		
		 <div class="col-sm-2" align='center' style='border:0px solid black; width:255px;'>
		 <button class="btn btn-lg btn-block btn-danger" type="reset" style='width:210px;'><i class="lnr lnr-undo"></i> Reset</button>  
   </div> 
  <div class="col-md-3"></div>      
 </div></div>
 
 </form>
 </div>
 </div>
 <?php include'footer.php';
 ?>