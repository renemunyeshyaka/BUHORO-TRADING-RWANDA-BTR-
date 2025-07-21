<?php
if(basename($_SERVER['PHP_SELF']) == 'createa.php') 
$nv=" class='current'";
include'header.php';
include'connection.php';
$pto=$bala=$rowid=0;	

$name=$addre=$tele=$defile='';
$dato=$Date;

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
			$tag=$_POST['tag'];
				$tag=str_replace("'", "`", $tag);
			$email=$_POST['email'];

			$temp1 = explode(".", $_FILES["file1"]["name"]);
$newfilename1 = round(microtime(true)) . '.' . end($temp1);
move_uploaded_file($_FILES["file1"]["tmp_name"], "files/" . $newfilename1);
	if(!end($temp1))
		$newfilename1='';
				
	$doix=mysqli_query($conn, "INSERT INTO `account` (`Number`, `Customer`, `Address`, `Telephone`, `Date`, `Status`, `Balance`, `File`, `Tin`, `Tag`, `Email`) VALUES (NULL, '$name', '$addre', '$tele', '$Date', '0', '0', '$newfilename1', '$tin', '$tag', '$email')");
		$name=$addre=$tele=$tag=$email=$tin=$defile='';
		$bala=0;
		$pto=10;
		}



		if(isset($_POST['updo']))
		{	
			$rowid=$_POST['rowid'];
	$then=mysqli_query($conn, "DELETE  FROM `account` WHERE `Number`='$rowid' LIMIT 1");
			$name=$_POST['name'];
				$name=str_replace("'", "`", $name);
			$addre=$_POST['addre'];
				$addre=str_replace("'", "`", $addre);
			$done=$_POST['done'];
			$tele=$_POST['tele'];
			$bala=$_POST['bala'];
			$bala=str_replace(',', '', $bala);
			$tin=$_POST['tin'];
			$tag=$_POST['tag'];
				$tag=str_replace("'", "`", $tag);
			$email=$_POST['email'];

	if($_FILES["file1"]["size"]){
			$temp1 = explode(".", $_FILES["file1"]["name"]);
$newfilename1 = round(microtime(true)) . '.' . end($temp1);
move_uploaded_file($_FILES["file1"]["tmp_name"], "files/" . $newfilename1);
	if(!end($temp1))
		$newfilename1='';
	}
	else
	$newfilename1=$_POST['defile'];

$doix=mysqli_query($conn, "INSERT INTO `account` (`Number`, `Customer`, `Address`, `Telephone`, `Date`, `Status`, `Balance`, `File`, `Tin`, `Tag`, `Email`) VALUES ('$rowid', '$name', '$addre', '$tele', '$Date', '0', '$bala', '$newfilename1', '$tin', '$tag', '$email')");
		$pto=40;

	$btne="<br><button class='btn btn-lg btn-block btn-warning' type='submit' name='updo'>
	<i class='lnr lnr-checkmark-circle'></i>&nbsp;&nbsp;UPDATE </button>";

	$btxe=$btze="";
		}

		if(isset($_POST['open']))
		{
			$rowid=$_POST['rowid'];
		}

		

		if($rowid){
	$do=mysqli_query($conn, "SELECT *FROM `account` WHERE `Status`='0' AND `Number`='$rowid' ORDER BY `Number` DESC LIMIT 1");
		$ro=mysqli_fetch_assoc($do);
			$name=$ro['Customer'];
			$addre=$ro['Address'];
			$tele=$ro['Telephone'];
			$bala=$ro['Balance'];
			$tin=$ro['Tin'];
			$tag=$ro['Tag'];
			$email=$ro['Email'];
			$defile=$ro['File'];

			if($tra==1){
				$suc="success";
				$val="<input type='hidden' value='0' name='track'>";
			}
			else{
				$suc="default";
				$val="<input type='hidden' value='1' name='track'>";
			}
	$btne="<br><button class='btn btn-lg btn-block btn-warning' type='submit' name='updo'>
	<i class='lnr lnr-checkmark-circle'></i>&nbsp;&nbsp;UPDATE </button>";

		}
if(!$tele)
    $tele="+250";
?>
<div class="container-fluid main-content">
        <div class="page-title hidden-print">
          <h2 style='margin-top:-20px; margin-bottom: 5px; color:#ffcc33'>
         Customers
          </h2>
  
    </div>
   <div class="row">
  <div class="col-lg-2 hidden-print">
   
  <ul class="list-group">
                  
			  <li class="list-group-item">
              <a href="ment.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Repair & Services
                </p>
              </a></li>

    <li class="list-group-item">
	  <a href="mainsto.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;List of Vehicles
                </p>
              </a></li> 

	   <li class="list-group-item">
              <a href="crete.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Create a Vehicle
                </p>
              </a></li>   

	   <li class="list-group-item">
              <a href="tools.php">
                <p>
                <i class="lnr lnr-book"></i>&nbsp;Tools & Materials
                </p>
              </a></li>  

	   <li class="list-group-item">
              <a href="notes.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Notifications
                </p>
              </a></li> 
              </ul><br><br>
              
              <ul class="list-group">
    
    <li class="list-group-item" style="border:1px dashed #cccccc; border-radius:5px; margin:0px 0px 4px 0px;">
	  <a href="customer.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Customers' List
                </p>
              </a></li>  

	   <li class="list-group-item active" style="border:1px dashed #cccccc; border-radius:5px; margin:0px 0px 4px 0px;">
              <a href="createa.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Create Customer
                </p>
              </a></li> 
              
            <li class="list-group-item" style="border:1px dashed #cccccc; border-radius:5px; margin:0px 0px 4px 0px;">
	  <a href="dispatch.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Create Vehicle Trip
                </p>
              </a></li>		
                
                <?php
              if($_SESSION['Cpo']){
                  ?>
			  <li class="list-group-item" style="border:1px dashed #cccccc; border-radius:5px; margin:0px 0px 4px 0px;">
              <a href="purcha.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Purchase Orders
                </p>
              </a></li>
              <?php
              }
              if($_SESSION['Cpi']){
                  ?>
            <li class="list-group-item" style="border:1px dashed #cccccc; border-radius:5px; margin:0px 0px 4px 0px;">
	  <a href="profo.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Create Proforma
                </p>
              </a></li>	
              <?php
              }
              ?>
                
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
echo"<center><div class='alert alert-info' style='width:88%;text-align:center;float:center;border-radius:5px;'>
		<i class='lnr lnr-checkmark-circle'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>&times</button>New customer is created successfully. </div></center>";
if($pto==40)
echo"<center><div class='alert alert-warning' style='width:88%;text-align:center;float:center;border-radius:5px;'>
		<i class='lnr lnr-checkmark-circle'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>&times</button>Customer has been updated successfully. </div></center>";
	
			echo"<input value='$code' name='rowid' type='hidden'>";
			?>
			<div class="form-group">
			<div class="col-md-2" align="right"> 
            <label class="control-label">Customer's Name</label></div>
            <div class="col-md-3">
           <input name="name" class="form-control" type="text" style="text-align:left;" value="<?php echo $name ?>" id="searchs" OnKeyup="return cUpper(this);" required>
            </div>
			
			 	
			 
			  <div class="col-md-2" align="right">
			  <label class="control-label">Address</label></div>	

 <div class="col-md-3">
          <input name="addre" class="form-control" type="text" value="<?php echo $addre ?>">
            </div>

 </div>
 
<div class="form-group">
			<div class="col-md-2" align="right"> 
            <label class="control-label"> Telephone Number </label></div>
            <div class="col-md-3">
           <input name="tele" class="form-control" type="text" style="text-align:center;" value="<?php echo $tele ?>">
            </div>	
				 	
			 
			  <div class="col-md-2" align="right">
			  <label class="control-label"> TIN/VAT </label></div>

 <div class="col-md-3">
           <input name="tin" class="form-control" type="text" style="text-align:center;" value="<?php echo $tin ?>">
            </div>

 </div>
			 	
<div class="form-group">
		<div class="col-md-2" align="right"> 
            <label class="control-label"> Email Address </label></div>
            <div class="col-md-3">
           <input name="email" class="form-control" type="text" style="text-align:left;" value="<?php echo $email ?>">
            </div>


			  <div class="col-md-2" align="right">
			  <label class="control-label"> </label></div>

 <div class="col-md-3">
           <input name="tag" class="form-control" type="hidden" style="text-align:center; margin-bottom:0px;" value="<?php echo $tag ?>">
		    &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<label style='color:blue; font-size:10px; margin-top:-20px;'> </label>
            </div><div class="col-md-2"> &nbsp; </div>

 </div>
 
			
		
<br><br><br>
  

 <div class="form-group"> <div class="col-md-2" align="right"> </div>
    <label class="control-label col-md-3">Document File</label>
                     <div class="col-md-6">
              <div class="fileupload fileupload-new" data-provides="fileupload"><input value="<?php echo $rowid ?>" name="rowid" type="hidden">
                <span class="btn btn-default btn-file"><span class="fileupload-new">Select</span><span class="fileupload-exists">Change</span><input name="file1" id="app_file" type="file" readonly='readonly'></span><span class="fileupload-preview"></span><button class="close fileupload-exists" data-dismiss="fileupload" style="float:none" type="button">&times;</button>
		<?php echo $dfile ?>
				
              <br><small>Zip, txt, jpeg, png, pdf, doc (Max : 2M)</small>       
              </div>     
            </div>
            </div>

  <div class="form-group">
  <div class="col-md-12">
  <div class="col-sm-1"></div>
   <div class="col-sm-9" align='center' style='border:0px solid black;'> 
   <?php
	  echo"<input type='hidden' name='rowid' value='$rowid'><input type='hidden' name='done' value='$loge'>
	  <input type='hidden' name='defile' value='$defile'><input type='hidden' name='bala' value='$bala'> $btne";
	   ?>
		</div></div>
		</form></div></div></div></div>
	 
 </div></div></div>
 
<?php
include'footer.php';
?>