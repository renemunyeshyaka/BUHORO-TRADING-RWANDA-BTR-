<?php
if(basename($_SERVER['PHP_SELF']) == 'register.php') 
  $pp=" class='current'";
include'header.php';
include'connection.php';
$user=$loge;
$dato=$Date;
$pto=0;

if(isset($_POST['addo']))
		{
			$tag=$_POST['tag'];
				$tag=str_replace("'", "`", $tag);
			$kind=$_POST['kind'];
			$descri=$_POST['descri'];
				$descri=str_replace("'", "`", $descri);
			$sex=$_POST['sex'];
			$yi=$_POST['yi'];
			$mo=$_POST['mo'];
			$do=$_POST['do'];
			$stat=$_POST['stat'];
			$done=$_POST['done'];
			$father=$_POST['father'];
			$mother=$_POST['mother'];
			$birth="$yi-$mo-$do";
			$herd=$_POST['herd'];

			$temp1 = explode(".", $_FILES["file1"]["name"]);
$newfilename1 = round(microtime(true)) . '.' . end($temp1);
move_uploaded_file($_FILES["file1"]["tmp_name"], "file1" . $newfilename1);
	if(!end($temp1))
	$newfilename1='';
			$doit=mysql_query("SELECT *FROM `goats` WHERE `Tag`='$tag' ORDER BY `Number` ASC");
		if($foit=mysql_num_rows($doit)){
			$pto=30;
		}
		else{
				if(checkdate($mo,$do,$yi)){
	$doix=mysql_query("INSERT INTO `goats` (`Tag`, `Type`, `Sex`, `Descri`, `Birthday`, `Status`, `Date`, `Time`, `Done`, `Father`, `Mother`, `File`, `Herd`) VALUES ('$tag', '$kind', '$sex', '$descri', '$birth', '$stat', '$Date', '$Time', '$done', '$father', '$mother', '$newfilename1', '$herd')");
				$don=mysql_query("UPDATE `genres` SET `Count` = `Count` + '1' WHERE `Number` = '$kind' LIMIT 1");
				$dor=mysql_query("UPDATE `cycles` SET `Count` = `Count` + '1' WHERE `Number` = '$stat' LIMIT 1");
		$tag=$kind=$sex=$descri=$yi=$mo=$do=$stat=$father=$mother='';
		$pto=10;
			}
			else{
				$pto=20;
			}
			}
		}

?>
<div class="container-fluid main-content">
<div class="page-title">
        <h2 style='margin-top:-20px; margin-bottom: 5px;'>Create New</h2>
  
    </div>
   <div class="row">
  <div class="col-lg-2 hidden-print">
   
   <ul class="list-group">
      
    <?php
				    if($_SESSION['Abox']=='1'){
						?>  
    <li class="list-group-item active">
	  <a href="register.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Register
                </p>
              </a></li>  

<li class="list-group-item">
	  <a href="transfer.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Transfer
                </p>
              </a></li>  
	   <li class="list-group-item">
              <a href="sales.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Sales
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
echo"<center><div class='alert alert-danger' style='width:88%;text-align:center;float:center;background-color: #60c560;color: #ffffff;border-radius:5px;'>
		<i class='lnr lnr-checkmark-circle'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>×</button>Creation has been done successfull.
		</div></center>";
if($pto==20)
echo"<center><div class='alert alert-danger' style='width:88%;text-align:center;float:center;background-color: #ff3366;color: #ffffff;border-radius:5px;'>
		<i class='lnr lnr-checkmark-circle'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>×</button>Entered date does not exist [$birth].
		</div></center>";
if($pto==30)
echo"<center><div class='alert alert-danger' style='width:88%;text-align:center;float:center;background-color: #ff3366;color: #ffffff;border-radius:5px;'>
		<i class='lnr lnr-checkmark-circle'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>×</button>Tag number you entered already exist [$tag].
		</div></center>";
	
			echo"<input value='$code' name='rowid' type='hidden'>";
			?>
			<div class="form-group">
			<div class="col-md-2" align="right"> 
            <label class="control-label">Tag Number</label></div>
            <div class="col-md-3">
           <input name="tag" class="form-control" type="text" style="text-align:center;" value="<?php echo $tag ?>" required>
            </div><span style="color:#d43f3a">
                         mandatory
                      </span> 
			
			 	
			 
			  <div class="col-md-2" align="right">
			  <label class="control-label">Kind (Type)</label></div>	

 <div class="col-md-3">
           <select class="form-control" name="kind" required>
				<option value='' selected='selected'>Select Type</option>
			<?php
			$doi=mysql_query("SELECT *FROM `genres` ORDER BY `Name` ASC");
			while($roi=mysql_fetch_assoc($doi)){
				$code=$roi['Number'];
				$fna=$roi['Name'];
				if($kind==$code)
					$k='selected';
				else
					$k='';
			echo"<option value='$code' $k> $fna </option>";
			}
			?>   
                            </select>
            </div>

 </div>
  <div class="form-group">
   <div class="col-md-2" align="right">
			  <label class="control-label">Sex/Herd</label></div>	

 <div class="col-md-2">
           <select class="form-control" name="sex" required>
				<option value='' selected='selected'>Select Sex</option>
				<?php
				if($sex=='MALE')
					$ml='selected';
				else
					$ml='';
				
				if($sex=='FEMALE')
					$fm='selected';
				else
					$fm='';

				if($sex=='OTHER')
					$ot='selected';
				else
					$ot='';
					?>
			<option value='MALE' <?php echo $ml ?>> MALE </option>
			<option value='FEMALE' <?php echo $fm ?>> FEMALE </option>
			<option value='OTHER' <?php echo $ot ?>> OTHER </option>
                            </select>
            </div><span style="color:#d43f3a">
                         mandatory
                      </span> 







					   <div class="col-md-1" style='width:100px; left:-1%'>
           <select class="form-control" name="herd" required>
				<option value='' selected='selected'>Herd</option>
				<?php
				$x = 'A';
				$n=1;
				while($n<=26){
					if($x!='O')
				echo"<option value='$x' $mx> $x </option>";
				$x++;		$n++;
				}
				?>
                            </select>
            </div>






		<div class="col-md-2" align="right" style='left:-1%'> 
            <label class="control-label">Description</label></div>
            <div class="col-md-3" style='left:-1%'>
              <input name="descri" class="form-control" type="text" value="<?php echo $descri ?>">
            </div>

	</div>
 <div class="form-group">
 <div class="col-md-2" align="right"> 
   <label class="control-label">Date of Birth </label></div>
                  <div class="col-md-3">
				  <div class="col-md-4" style="margin:0px; padding:0px;">
              <select class="form-control" name="yi" style="text-align:center;" required> 
			  <option value='' selected='selected' style="text-align:center;">YYYY</option>
			  <?php
			  $y=date("Y");			$yis=$y-10;
			  while($yis<=$y){
				  if($yi==$yis)
					  $sy='selected';
				  else
					  $sy='';
				  echo"<option value='$yis' style='text-align:center;' $sy> $yis </option>";
					$yis++;
			  }
			  ?>
			  </select>
				</div> <div class="col-md-4" style="margin:0px; padding:0px;">
			  <select class="form-control" name="mo" style="text-align:center;" required>
			  <option value='' selected='selected' style="text-align:center;">MM</option>
			    <?php
			  $m=1;			
			  while($m<=12){
				  if($m<10)
					  $mos="0$m";
				  else
					  $mos=$m;
				  if($mo==$mos)
					  $ms='selected';
				  else
					  $ms='';
				  echo"<option value='$mos' style='text-align:center;' $ms> $mos </option>";
					$m++;
			  }
			  ?>
			  </select>
				</div> <div class="col-md-4" style="margin:0px; padding:0px;">
			  <select class="form-control" name="do" style="text-align:center;" required>
			  <option value='' selected='selected' style="text-align:center;">DD</option>
			    <?php
			  $d=1;			
			  while($d<=31){
				  if($d<10)
					  $dos="0$d";
				  else
					  $dos=$d;

				  if($do==$dos)
					  $ds='selected';
				  else
					  $ds='';
				  echo"<option value='$dos' style='text-align:center;' $ds> $dos </option>";
					$d++;
			  }
			  ?>
			  </select></div> 
            </div> 
 <div class="col-md-2" align="right">
			  <label class="control-label">Cycle/Level</label></div>	

 <div class="col-md-3">
           <select class="form-control" name="stat" required>
				<option value='' selected='selected'>Select Cycle</option> 
			<?php
			$doi=mysql_query("SELECT *FROM `cycles` ORDER BY `Name` ASC");
			while($roi=mysql_fetch_assoc($doi)){
				$code=$roi['Number'];
				$fna=$roi['Name'];
				if($stat==$code)
					$st='selected';
				else
					$st='';
			echo"<option value='$code' $st> $fna </option>";
			}
			?>   
                            </select>
            </div><span style="color:#d43f3a">
                         mandatory
                      </span> 
			</div>

<div class="form-group">
			<div class="col-md-2" align="right"> 
            <label class="control-label"> From Father</label></div>
            <div class="col-md-3">
           <input name="father" class="form-control" type="text" style="text-align:center;" value="<?php echo $father ?>">
            </div><span style="color:#d43f3a">
                         mandatory
                      </span> 	
			
			 	
			 
			  <div class="col-md-2" align="right">
			  <label class="control-label">From Mother</label></div>

 <div class="col-md-3">
           <input name="mother" class="form-control" type="text" style="text-align:center;" value="<?php echo $mother ?>">
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
                <span class="btn btn-default btn-file"><span class="fileupload-new">Select</span><span class="fileupload-exists">Change</span><input name="file1" id="app_file" type="file" readonly='readonly'></span><span class="fileupload-preview"></span><button class="close fileupload-exists" data-dismiss="fileupload" style="float:none" type="button">×</button>
		<?php echo $dfile ?>
				
                     
              </div>     <small>Zip, txt, jpeg, png, pdf, doc (Max : 2M)</small>
            </div>
            </div>

  <div class="form-group">
  <div class="col-md-12">
  <div class="col-sm-3"></div>
   <div class="col-sm-6" align='center' style='border:0px solid black;'> 
   <?php
   if($_SESSION['Payaccess']=='1'){
	   ?>
    <br><button class="btn btn-lg btn-block btn-success" type="submit" name="addo">
	<i class='lnr lnr-checkmark-circle'></i>&nbsp;&nbsp;SAVE </button>   
	  <?php
  }
	   ?>
		</div></div>
		</form></div></div></div></div>
	 
 </div></div></div>
 
<?php
include'footer.php';
?>