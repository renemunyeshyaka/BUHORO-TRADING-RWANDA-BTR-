<?php
if(basename($_SERVER['PHP_SELF']) == 'createa.php') 
  $bb=" class='current'";
include'header.php';
include'connection.php';
$pto=0;
$rowid=0;
 $brc=$_SESSION['BR'];	

$name=$addre=$tele='';
$dato=$Date;
		$bala=0;

$btne="<br><button class='btn btn-lg btn-block btn-success' type='submit' name='addo'>
	<i class='lnr lnr-checkmark-circle'></i>&nbsp;&nbsp;SAVE </button>";

if(isset($_POST['addo']))
		{
			$name=$_POST['name'];
				$name=str_replace("'", "`", $name);
			$addre=$_POST['addre'];
				$addre=str_replace("'", "`", $addre);
			$done=$_POST['done'];
			$tele=$_POST['tele'];
			$bala=$_POST['bala'];
			$bala=str_replace(',', '', $bala);
			$tin=$_POST['tin'];
			$dele=$_POST['dele'];
				$dele=str_replace("'", "`", $dele);

			$temp1 = explode(".", $_FILES["file1"]["name"]);
$newfilename1 = round(microtime(true)) . '.' . end($temp1);
move_uploaded_file($_FILES["file1"]["tmp_name"], "file1" . $newfilename1);
	if(!end($temp1))
	$newfilename1='';
				
	$doix=mysql_query("INSERT INTO `account` (`Number`, `Customer`, `Address`, `Telephone`, `Date`, `Status`, `Balance`, `File`, `Branche`, `Tin`, `Delegator`) VALUES (NULL, '$name', '$addre', '$tele', '$Date', '0', '$bala', '$newfilename1', '$brc', '$tin', '$dele')");
		$name=$addre=$tele='';
		$bala=0;
		$pto=10;
		}



		if(isset($_POST['updo']))
		{	
			$rowid=$_POST['rowid'];
	$then=mysql_query("DELETE  FROM `account` WHERE `Number`='$rowid' LIMIT 1");
			$name=$_POST['name'];
				$name=str_replace("'", "`", $name);
			$addre=$_POST['addre'];
				$addre=str_replace("'", "`", $addre);
			$done=$_POST['done'];
			$tele=$_POST['tele'];
			$bala=$_POST['bala'];
			$bala=str_replace(',', '', $bala);
			$tin=$_POST['tin'];
			$dele=$_POST['dele'];
				$dele=str_replace("'", "`", $dele);

			$temp1 = explode(".", $_FILES["file1"]["name"]);
$newfilename1 = round(microtime(true)) . '.' . end($temp1);
move_uploaded_file($_FILES["file1"]["tmp_name"], "file1" . $newfilename1);
	if(!end($temp1))
	$newfilename1='';
				$doix=mysql_query("INSERT INTO `account` (`Number`, `Customer`, `Address`, `Telephone`, `Date`, `Status`, `Balance`, `File`, `Tin`, `Delegator`) VALUES ('$rowid', '$name', '$addre', '$tele', '$Date', '0', '$bala', '$newfilename1', '$tin', '$dele')");
		$pto=40;
	$btne="<br><button class='btn btn-lg btn-block btn-warning' type='submit' name='updo'>
	<i class='lnr lnr-checkmark-circle'></i>&nbsp;&nbsp;UPDATE </button>";
		}

		if(isset($_POST['open']))
		{
			$rowid=$_POST['rowid'];
	$do=mysql_query("SELECT *FROM `account` WHERE `Status`='0' AND `Number`='$rowid' ORDER BY `Number` DESC LIMIT 1");
		$ro=mysql_fetch_assoc($do);
			$name=$ro['Customer'];
			$addre=$ro['Address'];
			$tele=$ro['Telephone'];
			$bala=$ro['Balance'];
			$tin=$ro['Tin'];
			$dele=$ro['Delegator'];
	$btne="<br><button class='btn btn-lg btn-block btn-warning' type='submit' name='updo'>
	<i class='lnr lnr-checkmark-circle'></i>&nbsp;&nbsp;UPDATE </button>";
		}
if($_SESSION['Acrepo'])
$lin="customer.php";
else
$lin="#";
?>
<div class="container-fluid main-content">
        <div class="page-title hidden-print">
          <h3 style='margin-top:-20px; margin-bottom: 5px; color:#ffcc33'>
         Create New Customer
          </h3>
  
    </div>
   <div class="row">
  <div class="col-lg-2 hidden-print">
   
  <ul class="list-group">
    
    <li class="list-group-item">
	  <a href="<?php echo $lin ?>">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Customers' Accounts
                </p>
              </a></li>  

	   <li class="list-group-item active">
              <a href="createa.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Create New Customer
                </p>
              </a></li>   

	   <li class="list-group-item">
              <a href="branches.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Sales/Payment
                </p>
              </a></li> 
                
            </ul>

  </div>
 <div class="col-md-10">
 <div class="widget-container fluid-height clearfix">
 <div class="widget-content padded">
 <form method="post" class="form-horizontal" action="" enctype="multipart/form-data">
 <input name="app_file_size" id="app_file_size" type="hidden">
 <br>
 <?php 
if($pto==10)
echo"<center><div class='alert alert-danger' style='width:88%;text-align:center;float:center;background-color: #60c560;color: #ffffff;border-radius:5px;'>
		<i class='lnr lnr-checkmark-circle'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>×</button>New customer is created successfully.
		</div></center>";
if($pto==40)
echo"<center><div class='alert alert-danger' style='width:88%;text-align:center;float:center;background-color: #60c560;color: #ffffff;border-radius:5px;'>
		<i class='lnr lnr-checkmark-circle'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>×</button>Customer has been updated successfully.
		</div></center>";
	
			echo"<input value='$code' name='rowid' type='hidden'>";
			?>
			<div class="form-group">
			<div class="col-md-2" align="right"> 
            <label class="control-label">Customer's Name</label></div>
            <div class="col-md-3">
           <input name="name" class="form-control" type="text" style="text-align:left;" value="<?php echo $name ?>" id="searcha" required>
            </div>
			
			 	
			 
			  <div class="col-md-2" align="right">
			  <label class="control-label">Address</label></div>	

 <div class="col-md-3">
          <input name="addre" class="form-control" type="text" value="<?php echo $addre ?>">
            </div>

 </div>
 
 <div class="form-group">
			<div class="col-md-2" align="right"> 
            <label class="control-label"> Telephone </label></div>
            <div class="col-md-3">
           <input name="tele" class="form-control" type="text" style="text-align:center;" value="<?php echo $tele ?>">
            </div>	
			 	
			 
			  <div class="col-md-2" align="right">
			  <label class="control-label"> TIN/VAT No </label></div>

 <div class="col-md-3"><?php echo"<input type='hidden' name='bala' value='$bala'>"; ?>
           <input name="tin" class="form-control text-center" type="text" value="<?php echo $tin ?>">
            </div>
</div>

	<div class="form-group">
			<div class="col-md-2" align="right"> 
            <label class="control-label"> Delegator </label></div>
            <div class="col-md-3">
           <input name="dele" class="form-control" type="text" style="text-align:left;" value="<?php echo $dele ?>">
            </div>			
			 	
			 
			  <div class="col-md-2" align="right">
			  <label class="control-label">  </label></div>

 <div class="col-md-3">            </div>

 </div>
		

  <div class="form-group">
            <label class="control-label col-md-3"><br><br>Done&nbsp;By</label>
            <div class="col-md-3" style='margin-right:10px;'>
              <br><br><select class="form-control" name="done" required>
			  
			   <?php
			echo"<option value='$loge'> $loge </option>";
			?>    
                            </select> &nbsp;&nbsp; 
			 </div> 

			 
			<div class="col-md-4" style='text-align:right; margin-left:20px;'><br><br>
			  <input name="dato" id="from" class="form-control" value="<?php echo $dato ?>" type="text" style='width:210px; text-align:center;' readonly required>
            </div> 
 </div>

 <div class="form-group"> <div class="col-md-2" align="right"> </div>
    <label class="control-label col-md-3">Document File</label>
                     <div class="col-md-6">
              <div class="fileupload fileupload-new" data-provides="fileupload"><input value="<?php echo $rowid ?>" name="rowid" type="hidden">
                <span class="btn btn-default btn-file"><span class="fileupload-new">Select</span><span class="fileupload-exists">Change</span><input name="file1" id="app_file" type="file" readonly='readonly'></span><span class="fileupload-preview"></span><button class="close fileupload-exists" data-dismiss="fileupload" style="float:none" type="button">×</button>
		<?php echo $dfile ?>
				
              <small>Zip, txt, jpeg, png, pdf, doc (Max : 2M)</small>       
              </div>     
            </div>
            </div>

  <div class="form-group">
  <div class="col-md-12">
  <div class="col-sm-1"></div>
   <div class="col-sm-9" align='center' style='border:0px solid black;'> 
   <?php
	  echo"<input type='hidden' name='rowid' value='$rowid'> $btne";
	   ?>
		</div></div>
		</form></div></div></div></div>
	 
 </div></div></div>
 
<?php
include'footer.php';
?>