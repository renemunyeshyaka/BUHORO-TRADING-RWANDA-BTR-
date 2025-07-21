<?php
if(basename($_SERVER['PHP_SELF']) == 'createsu.php') 
  $co=" class='current'";
include'header.php';
include'connection.php';
$pto=0;
$rowid=0;

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

			$temp1 = explode(".", $_FILES["file1"]["name"]);
$newfilename1 = round(microtime(true)) . '.' . end($temp1);
move_uploaded_file($_FILES["file1"]["tmp_name"], "file1" . $newfilename1);
	if(!end($temp1))
	$newfilename1='';
				
	$doix=mysql_query("INSERT INTO `suppliers` (`Number`, `Supplier`, `Address`, `Telephone`, `Date`, `Status`, `Balance`, `File`) VALUES (NULL, '$name', '$addre', '$tele', '$Date', '0', '$bala', '$newfilename1')");
		$name=$addre=$tele='';
		$bala=0;
		$pto=10;
		}



		if(isset($_POST['updo']))
		{	
			$rowid=$_POST['rowid'];
	$then=mysql_query("DELETE  FROM `suppliers` WHERE `Number`='$rowid' LIMIT 1");
			$name=$_POST['name'];
				$name=str_replace("'", "`", $name);
			$addre=$_POST['addre'];
				$addre=str_replace("'", "`", $addre);
			$done=$_POST['done'];
			$tele=$_POST['tele'];
			$bala=$_POST['bala'];
			$bala=str_replace(',', '', $bala);
			$namo=$_POST['namo'];

			$temp1 = explode(".", $_FILES["file1"]["name"]);
$newfilename1 = round(microtime(true)) . '.' . end($temp1);
move_uploaded_file($_FILES["file1"]["tmp_name"], "file1" . $newfilename1);
	if(!end($temp1))
	$newfilename1='';
				$doix=mysql_query("INSERT INTO `suppliers` (`Number`, `Supplier`, `Address`, `Telephone`, `Date`, `Status`, `Balance`, `File`) VALUES ('$rowid', '$name', '$addre', '$tele', '$Date', '0', '$bala', '$newfilename1')");

		if($name!=$namo){
				$do=mysql_query("UPDATE `stouse` SET `Destin`='$name' WHERE `Name`='$namo' AND `Action`='RECEIVE'");
				$dod=mysql_query("UPDATE `payment` SET `Customer`='$name' WHERE `Customer`='$namo' AND `Action`='PURCHASE'");
		}

		$pto=40;
	$btne="<br><button class='btn btn-lg btn-block btn-warning' type='submit' name='updo'>
	<i class='lnr lnr-checkmark-circle'></i>&nbsp;&nbsp;UPDATE </button>";
		}

		if(isset($_POST['open']))
		{
			$rowid=$_POST['rowid'];
	$do=mysql_query("SELECT *FROM `suppliers` WHERE `Status`='0' AND `Number`='$rowid' ORDER BY `Number` DESC LIMIT 1");
		$ro=mysql_fetch_assoc($do);
			$name=$ro['Supplier'];
			$addre=$ro['Address'];
			$tele=$ro['Telephone'];
			$bala=$ro['Balance'];
	$btne="<br><button class='btn btn-lg btn-block btn-warning' type='submit' name='updo'>
	<i class='lnr lnr-checkmark-circle'></i>&nbsp;&nbsp;UPDATE </button>";
		}

?>
<div class="container-fluid main-content">
<div class="page-title">
        <h2 style='margin-top:-20px; margin-bottom: 5px;'>Create New Supplier</h2>
  
    </div>
   <div class="row">
  <div class="col-lg-2 hidden-print">
   
  <ul class="list-group">
    
    <li class="list-group-item">
	  <a href="supplier.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Suppliers' List
                </p>
              </a></li>  

	   <li class="list-group-item active">
              <a href="createsu.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Create New Supplier
                </p>
              </a></li> 
                  
			  <li class="list-group-item">
              <a href="receive.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Receive Items
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
		<i class='lnr lnr-checkmark-circle'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>×</button>New supplier is created successfully.
		</div></center>";
if($pto==40)
echo"<center><div class='alert alert-danger' style='width:88%;text-align:center;float:center;background-color: #60c560;color: #ffffff;border-radius:5px;'>
		<i class='lnr lnr-checkmark-circle'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>×</button>Supplier has been updated successfully.
		</div></center>";
	
			echo"<input value='$code' name='rowid' type='hidden'>";
			?>
			<div class="form-group">
			<div class="col-md-2" align="right"> 
            <label class="control-label">Supplier's Name</label></div>
            <div class="col-md-3">
           <input name="name" class="form-control" type="text" style="text-align:left;" value="<?php echo $name ?>" required>
            </div><span style="color:#d43f3a">
                         mandatory
                      </span> 
			
			 	
			 
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
            </div><span style="color:#d43f3a">
                         mandatory
                      </span> 	
			
			 	
			 
			  <div class="col-md-2" align="right">
			  <label class="control-label"> Balance </label></div>

 <div class="col-md-3">
           <input name="bala" class="form-control" type="text" style="text-align:center; background-color:#f9f9f9;" value="<?php echo $bala ?>">
            </div>

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
                <span class="btn btn-default btn-file"><span class="fileupload-new">Select</span><span class="fileupload-exists">Change</span><input name="file1" id="app_file" type="file" readonly='readonly'></span><span class="fileupload-preview"></span><button class="close fileupload-exists" data-dismiss="fileupload" style="float:none" type="button">x</button>&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
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
	  echo"<input type='hidden' name='rowid' value='$rowid'><input type='hidden' name='namo' value='$namo'> $btne";
	   ?>
		</div></div>
		</form></div></div></div></div>
	 
 </div></div></div>
 
<?php
include'footer.php';
?>
