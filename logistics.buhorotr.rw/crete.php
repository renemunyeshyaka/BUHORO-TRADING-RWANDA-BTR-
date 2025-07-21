<?php
if(basename($_SERVER['PHP_SELF']) == 'crete.php') 
  $nv=" class='current'";
include'header.php';
include'connection.php';
$pto=0;
$rowid=0;
$date=$Date;

		$make=$mode=$chassis=$year=$fuel=$vid=$source='';
		
$btne="<button class='btn btn-lg btn-block btn-success' type='submit' name='addo'>
	<i class='lnr lnr-checkmark-circle'></i>&nbsp;&nbsp;SAVE </button>";

if(isset($_POST['addo']))
		{
			$make=$_POST['make'];
			$mode=$_POST['mode'];
				$mode=str_replace("'", "`", $mode);
			$chassis=$_POST['chassis'];
				$chassi=str_replace("'", "`", $chassis);
			$year=$_POST['year'];
			$fuel=$_POST['fuel'];
			$descri=$_POST['descri'];
				$descri=str_replace("'", "`", $descri);
			$date=$_POST['date'];
			$source=$_POST['source'];
			$vid=$_POST['vid'];
			$driver=$_POST['driver'];
			$driver=str_replace("'", "`", $_POST['driver']);
			$trip=$_POST['trip'];

	$doix=mysqli_query($conn, "INSERT INTO `vehicles` (`Date`, `User`, `Make`, `Mode`, `Chassis`, `Year`, `Fuel`, `Plate`, `Source`, `Descri`, `Status`, `Driver`, `Trip`) VALUES ('$date', '$loge', '$make', '$mode', '$chassis', '$year', '$fuel', '$vid', '$source', '$desri', '0', '$driver', '$trip')");
		$make=$mode=$chassis=$year=$fuel=$vid=$source='';
		$date=$Date;

		$pto=10;
			}
	

		if(isset($_POST['updo']))
		{	
			$rowid=$_POST['rowid'];
			$make=$_POST['make'];
			$mode=$_POST['mode'];
				$mode=str_replace("'", "`", $mode);
			$chassis=$_POST['chassis'];
				$chassi=str_replace("'", "`", $chassis);
			$year=$_POST['year'];
			$fuel=$_POST['fuel'];
			$descri=$_POST['descri'];
				$descri=str_replace(',', '', $descri);
			$date=$_POST['date'];
			$source=$_POST['source'];
			$vid=$_POST['vid'];
			$driver=$_POST['driver'];
			$driver=str_replace("'", "`", $_POST['driver']);
			$trip=$_POST['trip'];
			
	$do=mysqli_query($conn, "SELECT *FROM `vehicles` WHERE `Number`='$rowid' LIMIT 1");	
	    $ro=mysqli_fetch_assoc($do);
			$phon1=$ro['Phone1'];
			$phon2=$ro['Phone2'];
			$drive=$ro['Driver'];
			$eme1=$ro['Email1'];
			$eme2=$ro['Email2'];
			$eme3=$ro['Email3'];

			$then=mysqli_query($conn, "DELETE  FROM `vehicles` WHERE `Number`='$rowid' LIMIT 1");
	$doix=mysqli_query($conn, "INSERT INTO `vehicles` (`Number`, `Make`, `Mode`, `Chassis`, `Year`, `Fuel`, `Plate`, `Source`, `Descri`, `Status`, `Driver`, `Phone1`, `Phone2`, `Email1`, `Email2`, `Email3`, `Trip`) VALUES ($rowid, '$make', '$mode', '$chassis', '$year', '$fuel', '$vid', '$source', '$desri', '0', '$driver', '$phon1', '$phon2', '$eme1', '$eme2', '$eme3', '$trip')");
		$pto=40;
			
	$btne="<br><button class='btn btn-lg btn-block btn-warning' type='submit' name='updo'>
	<i class='lnr lnr-checkmark-circle'></i>&nbsp;&nbsp;UPDATE </button>";
		$pto=40;
		}

		if(isset($_POST['open']))
		{
			$rowid=$_POST['rowid'];
	$do=mysqli_query($conn, "SELECT *FROM `vehicles` WHERE `Number`='$rowid' ORDER BY `Number` DESC LIMIT 1");
		$ro=mysqli_fetch_assoc($do);
			$make=$ro['Make'];
			$mode=$ro['Mode'];
			$chassis=$ro['Chassis'];
			$year=$ro['Year'];	
			$source=$ro['Source'];

			$fuel=$ro['Fuel'];
			$descri=$ro['Descri'];
			$vid=$ro['Plate'];
			$date=$ro['Date'];
			$trip=$ro['Trip'];

	$btne="<br><button class='btn btn-lg btn-block btn-warning' type='submit' name='updo'>
	<i class='lnr lnr-checkmark-circle'></i>&nbsp;&nbsp;UPDATE </button>";
		}

?>
<div class="container-fluid main-content">
<div class="page-title">
        <h2 style='margin-top:-20px; margin-bottom: 5px; color:#ffcc33'>Vehicles</h2>
  
    </div>

         <div class="row">
  <div class="col-lg-2 hidden-print">
   
   <ul class="list-group">
                  
			  <li class="list-group-item">
              <a href="ment.php">
                <p>
                <i class="lnr lnr-circle-minus"></i>&nbsp;Repair & Services
                </p>
              </a></li>

    <li class="list-group-item">
	  <a href="mainsto.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;List of Vehicles
                </p>
              </a></li> 

	   <li class="list-group-item active">
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

			<li class="list-group-item" style="border:1px dashed #cccccc; border-radius:5px; margin:0px 0px 4px 0px;">
	  <a href="createa.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Create Customers
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
              
            <li class="list-group-item" style="border:1px dashed #cccccc; border-radius:5px; margin:0px 0px 4px 0px;">
	  <a href="payslip.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Payment Vouchers
                </p>
              </a></li>	
              
            <li class="list-group-item" style="border:1px dashed #cccccc; border-radius:5px; margin:0px 0px 4px 0px;">
	  <a href="conterepo.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Container Dispatch
                </p>
              </a></li>
  </div>

 <div class="col-md-10">
 <div class="widget-container fluid-height clearfix">
 <div class="widget-content padded">
 <form method="post" class="form-horizontal" action="" enctype="multipart/form-data">
 <input name="app_file_size" id="app_file_size" type="hidden">
 <br>
 <?php 
if($pto==10)
echo"<center><div class='alert alert-danger' style='width:88%;text-align:center;float:center;background-color: #60c560;color: #ffffff;border-radius:5px;margin-top:-20px; margin-bottom:0px;'>
		<i class='lnr lnr-checkmark-circle'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>×</button>New car has been created successfully. </div></center>";
if($pto==40)
echo"<center><div class='alert alert-danger' style='width:88%;text-align:center;float:center;background-color: #60c560;color: #ffffff;border-radius:5px; margin-top:-20px; margin-bottom:0px;'>
		<i class='lnr lnr-checkmark-circle'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>×</button>Information has been updated successfully. </div></center>";
	
			echo"<input value='$code' name='rowid' type='hidden'>";
			?>
			<br><div class="form-group">

			  <div class="col-md-2" align="right">
			  <label class="control-label">Vehicle Brand Name</label></div>	

 <div class="col-md-3">
           <select class="form-control" name="make" required>
				<option value='' selected='selected'>Select Make</option>
			<?php
			$doi=mysqli_query($conn, "SELECT *FROM `itype` WHERE `Type`!='' AND `Location`='0' ORDER BY `Number` ASC");
			while($roi=mysqli_fetch_assoc($doi)){
				$fna=$roi['Type'];
				if($make==$fna)
					$k='selected';
				else
					$k='';
			echo"<option value='$fna' $k> $fna </option>";
			}
			?>   
                            </select>
            </div>
 

			<div class="col-md-2" align="right"> 
            <label class="control-label">Model Name</label></div>
            <div class="col-md-3">
           <input name="mode" class="form-control" type="text" style="text-align:left;" value="<?php echo $mode ?>" OnKeyup='return cUpper(this);' required>
            </div><span style="color:#d43f3a">
                         Required
                      </span> 
			</div>
			 	
			 
			

 <div class="form-group">

 <div class="col-md-2" align="right">
			  <label class="control-label">Chassis Number</label></div>	

 <div class="col-md-3">
     <input name="chassis" class="form-control" type="text" value="<?php echo $chassis ?>" OnKeyup='return cUpper(this);'>
            </div>
			

<div class="col-md-2" align="right"> 
            <label class="control-label">Year / Fuel</label></div>
            <div class="col-md-1">
       <select class="form-control" name="year" style="width:100px;">
				<option value='' selected='selected'>Year</option>
			<?php
			$ya=date("Y");			$st=$ya-30;
			while($ya>=$st){
				if($ya==$year)
					$k='selected';
				else
					$k='';
			echo"<option value='$ya' $k> $ya </option>";
				$ya--;
			}
			?>   
              <option value=''>Year</option></select>
            </div>
			
			<div class="col-md-1"> </div>
			
			<div class="col-md-1">
       <select class="form-control" name="fuel" style="margin-left:-30px; width:100px; padding-left:2px; padding-right:2px;" required>
				<option value='' selected='selected'>Fuel</option>
			<?php
			$doi=mysqli_query($conn, "SELECT *FROM `fuel` ORDER BY `Fuel` ASC");
			while($roi=mysqli_fetch_assoc($doi)){
				$fna=$roi['Fuel'];
				if($fuel==$fna)
					$k='selected';
				else
					$k='';
			echo"<option value='$fna' $k> $fna </option>";
			}
			?>   
                            </select>
            </div><span style="color:#d43f3a">
                         Required
                      </span> 			
            </div>   


	<div class="form-group">
   <div class="col-md-2" align="right">
			  <label class="control-label">Vehicle ID <br><br><br>
			  Trip Record</label></div>	

 <div class="col-md-3">
			  
			  <?php
			  if($vid)
			  $eco="value='$vid'";
			  else
			  $eco="placeholder='Plate No'";
			  ?>
           <input name="vid" class="form-control text-center" type="text" <?php echo $eco ?> style="background-color:#efffff" OnKeyup='return cUpper(this);' required><br>
           
           <select class="form-control" name="trip" required>
				<option value='' selected='selected'>Select Trip Type</option>
		<?php
		if($trip=='1'){
		    $in='selected';
		    $lo='';
		}
		if($trip=='0'){
		    $in='';
		    $lo='selected';
		}
		?>
		    
				<option value='0' <?php echo $lo ?>> LOCAL </option>
				<option value='1' <?php echo $in ?>> TRANSIT </option>
                            </select>
            </div>

<div class="form-group">
   <div class="col-md-2" align="right">
			  <label class="control-label">Source</label></div>

 <div class="col-md-3">
			<select multiple class="form-control" name='source' style="height:90px; cursor:pointer; font-size:14px; padding-top:10px;" required>
			<?php
		if($source=='RENTING'){
			$d='selected';
			$s='';
		 }
		else{
			$d='';
			$s='selected';
		}
			?>
      <option value='COMPANY' <?php echo $s ?>>COMPANY</option>
      <option value='RENTING' <?php echo $d ?>>RENTING</option>
    </select> </div>
	</div><div class='row'></div><div class='row'></div>

	<div class="form-group" style="border:1px solid #ffffff; width:auto; margin-top:-30px; padding-top:0px;">
   <div class="col-md-2" align="right">
<label class="control-label" style="margin-top:10px;">Due Date</label></div>

 <div class="col-md-3">
           <input name="date" class="form-control text-center" type="text" value="<?php echo $Date ?>" style="margin-top:10px;" readonly>
            </div>
            
     <div class="col-md-2" align="right">
<label class="control-label" style="margin-top:10px;">Driver</label></div>	

 <div class="col-md-3">
     
      <select class="form-control" name="driver" style="margin-top:10px;">
          <option value=""> SELECT DRIVER'S NAME </option>
<?php
$doe=mysqli_query($conn, "SELECT `Fullname` FROM `employees` WHERE (`Currentp` = '7' OR `Currentp`='26') AND `Status` = '0' AND `Fullname`!='' ORDER BY `Fullname` ASC");
		while($roe=mysqli_fetch_assoc($doe)){
			$fna=$roe['Fullname'];
			if($fna==$driver)
			$s="selected";
			else
			$s="";
			echo"<option value='$fna' $s> $fna </option>";
		}
		?>
     </select>
            </div>
			</div>

	<div class="form-group">
		<div class="col-md-7" align="right"> 
            <label class="control-label">&nbsp;&nbsp;</label></div>
            <div class="col-md-3" style="margin-top:0px; text-align:center;">
              &nbsp;&nbsp; <a href='javascript:toggle()'; id='displayText' onclick="return pageScroll()">Description</a>
            </div>
	</div>







	
   <div id='toggleText' style='display: none; border:0px solid powderblue; border-radius:5px;  
   color:#000099; font-weight:normal; width:80%; float:center; margin-left:100px; margin-top:-30px; margin-bottom:20px; padding-bottom:0px;'>
   <div class="form-group">
	<div class="col-md-1" align="right"> </div>
   <div class="col-md-11" align="right">
		
<textarea class="form-control" id="exampleFormControlTextarea4" rows="3" name="descri" placeholder="Write description here"><?php echo $descri ?></textarea>
		

	</div>
		 </div>
   </div>


 
  <div class="form-group">
  <div class="col-md-12">
  <div class="col-sm-1"></div>
   <div class="col-sm-9" align='center' style='border:0px solid black;'> 
   <?php
	  echo"<input type='hidden' name='rowid' value='$rowid'><input type='hidden' name='stat' value='$stat'><input type='hidden' name='rec' value='$rec'> $btne";
	   ?>
		<br><br></div></div>
		</form></div></div></div></div>
	 
 </div></div></div>
 
<?php
include'footer.php';
?>
