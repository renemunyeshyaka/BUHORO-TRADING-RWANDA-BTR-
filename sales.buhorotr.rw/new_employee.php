<?php
if(basename($_SERVER['PHP_SELF']) == 'new_employee.php') {
  $cu=" class='current'";
} else {
  $cu="";
} 
include'header.php';
include'connection.php';

if(isset($_POST['submit_employee']))
		{
			$fname=$_POST['fname'];
			$lname=$_POST['lname'];
			$idno=$_POST['idno'];
			$contact1=$_POST['contact1'];
			$contact2=$_POST['contact2'];
			$gender=$_POST['gender'];
			$email=$_POST['email'];
			$pass1=$_POST['password'];
			$pass2=$_POST['confirm_password'];
			$depart=$_POST['depart'];
			$salary=$_POST['salary'];
				$salary=preg_replace('/,/', '', $salary);
			$qualify=$_POST['qualify'];
			$start=$_POST['start'];
			$currentp=$_POST['currentp'];
			$pass2=md5($pass2);

$temp = explode(".", $_FILES["photo"]["name"]);
$newfilename = round(microtime(true)) . '.' . end($temp);
move_uploaded_file($_FILES["photo"]["tmp_name"], "photos/" . $newfilename);

if(!end($temp))
	$newfilename='';

	$do=mysql_query("INSERT INTO `employees` (`Fname`, `Lname`, `Idno`, `Contact1`, `Contact2`, `Gender`, `Photo`, `Email`, `Password`, `Depart`, `Salary`, `Branche`, `Currentp`, `Owner`, `Date`) VALUES ('$fname', '$lname', '$idno', '$contact1', '$contact2', '$gender', '$newfilename', '$email', '$pass2', '$depart', '$salary', '$qualify', '$currentp', '$loge', '$Date')");
 
 $pto=10;
		}

			$fname='';
			$rowid='';
			$lname='';
			$idno='';
			$contact1='';
			$contact2='';
			$gender='Male';
			$email='';
			$pass1=$password='';
			$pass2='';
			$depart='';
			$salary='0';
			$qualify='';
			$start='';
			$currentp='';
			$photo="imgs/-text.png";
			$namb="submit_employee";
				$valub="Submit";

if(isset($_POST['edit_id']))
		{
			$rowid=$_POST['rowid'];
$do=mysql_query("SELECT *FROM `employees` WHERE `Eid`='$rowid' ORDER BY `Eid` ASC LIMIT 1");
while($ro=mysql_fetch_assoc($do)){
$rowid=$ro['Eid'];
$fname=$ro['Fname'];
$lname=$ro['Lname'];
$depart=$ro['Depart'];
$contact1=$ro['Contact1'];
$contact2=$ro['Contact2'];
$idno=$ro['Idno'];
$currentp=$ro['Currentp'];
$gender=$ro['Gender'];
$email=$ro['Email'];
$password=$ro['Password'];
$confirm_password=$ro['Password'];
$salary=number_format($ro['Salary']);
$qualify=$ro['Branche'];
$start=$ro['Starting'];
$photo=$ro['Photo'];
	if(!$photo)
		$photo="imgs/-text.png";
	else
		$photo="photos/$photo";
}

$namb="update_employee";
				$valub="Update";

	}

	if(isset($_POST['update_employee']))
		{
			$rowid=$_POST['rowid'];
			$fname=$_POST['fname'];
			$lname=$_POST['lname'];
			$idno=$_POST['idno'];
			$contact1=$_POST['contact1'];
			$contact2=$_POST['contact2'];
			$gender=$_POST['gender'];
			$email=$_POST['email'];
			$pass1=$_POST['password'];
			$pass2=$_POST['confirm_password'];
			$depart=$_POST['depart'];
			$salary=$_POST['salary'];
				$salary=preg_replace('/,/', '', $salary);
			$qualify=$_POST['qualify'];
			$start=$_POST['start'];
			$photoc=$_POST['photoc'];
			$passwo=$_POST['passwo'];
		if($passwo!=$pass2)
			$pass2=md5($pass2);			
			$currentp=$_POST['currentp'];
			$password=$pass2;

$temp = explode(".", $_FILES["photo"]["name"]);
$newfilename = round(microtime(true)) . '.' . end($temp);
move_uploaded_file($_FILES["photo"]["tmp_name"], "photos/" . $newfilename);

if(!end($temp)){
	$newfilename='';
	$phos='';
	$photo=$photoc;
}
else{
	$photo=$newfilename;
	$phos="`Photo`='$photo',";
}

if(!$photo)
		$photo="imgs/-text.png";
	else
		$photo="photos/$photo";

$namb="update_employee";
				$valub="Update";

	$do=mysql_query("UPDATE `employees` SET `Fname`='$fname', `Lname`='$lname', `Idno`='$idno', `Contact1`='$contact1', `Contact2`='$contact2', `Gender`='$gender', $phos `Email`='$email', `Password`='$pass2', `Depart`='$depart', `Salary`='$salary', `Branche`='$qualify', `Currentp`='$currentp', `Owner`='$loge' WHERE `Eid`='$rowid'");
 
	$salary=number_format($salary);
 $pto=20;

		}

?>

 <div class="container-fluid main-content">
<div class="page-title">
        <h1 style='margin-top:-20px; margin-bottom: 5px;'>New Employee</h1>
        </div>
 <div class="row">
 <div class="col-md-2">
		<ul class="list-group">
		 		 	  <li class="list-group-item">
           <a href="employees.php">
           <p>
           <i class="lnr lnr-menu-circle"></i>&nbsp;Users` List
           </p></a>
           </li>
           
		 
                          <li class="list-group-item active">
           <a href="new_employee.php">
           <p>
           <i class="lnr lnr-plus-circle"></i>&nbsp;Create New
           </p></a>
           </li>
           </li>
                       </ul>
                          </ul><br><br><center>
						   <span style="color:#d43f3a"><small>(*) Mandatory fields must be filled.</small></span>
		</div>
	
 <div class="col-md-10">
 <div class="widget-container fluid-height clearfix">
 <div class="widget-content padded">
 <form method="post" class="form-horizontal" name="myform" action="new_employee.php" enctype="multipart/form-data">
<?php
	if($pto==10)
echo"<center><div class='alert alert-danger' style='text-align:center;float:center;background-color: #60c560;color: #ffffff; border-radius:5px;'>
		<i class='lnr lnr-checkmark-circle'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>×</button>New Employee Has Been Created.
		</div></center>";

	if($pto==20)
echo"<center><div class='alert alert-danger' style='text-align:center;float:center;background-color: #60c560;color: #ffffff; border-radius:5px;'>
		<i class='lnr lnr-checkmark-circle'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>×</button>Employee Has Been Updated.
		</div></center>";

		echo"<input value='$rowid' name='rowid' type='hidden'><input value='$file1' name='file1' type='hidden'>
		<input value='$password' name='passwo' type='hidden'><input value='$file2' name='file2' type='hidden'>
		<input value='$file3' name='file3' type='hidden'><input value='$photo' name='photoc' type='hidden'>";
		?>
 
 <div class="row">
 <div class="col-md-12">
 <div class="col-md-6">
 <div class="heading"><h3>Personal Details</h3></div>
   <div class="form-group">
            <label class="control-label col-md-3">First Name</label>
            <div class="col-md-6">
              <input class="form-control" name="fname" type="text" value="<?php echo $fname ?>" required>
            </div>
                         <span style="color:#d43f3a">
                         Displayed
                      </span>          </div>    
   <div class="form-group">
            <label class="control-label col-md-3">Last Name</label>
            <div class="col-md-6">
              <input class="form-control" name="lname" type="text" value="<?php echo $lname ?>">
            </div>
		 </div>
            <div class="form-group">
                   <label class="control-label col-md-3">ID Number</label>
                  <div class="col-md-6">
             <input class="form-control" name="idno" type="text"  value="<?php echo $idno ?>" onkeypress='return isNumberKey(event)' required>
            </div> 
			  <span style="color:#d43f3a">
                         *
                      </span>   
			</div>
			 <div class="form-group">
                   <label class="control-label col-md-3">Contact No.1</label>
                  <div class="col-md-6">
             <input class="form-control" name="contact1" type="text" value="<?php echo $contact1 ?>" required>
            </div> 
			 <span style="color:#d43f3a">
                         *
                      </span>   
          </div>
           <div class="form-group">
                   <label class="control-label col-md-3">Contact No.2</label>
                  <div class="col-md-6">
              <input class="form-control" name="contact2" type="text" value="<?php echo $contact2 ?>">
            </div> 
          </div>
		  <div class="form-group">
		  <?php
		  if($gender=='Male'){
			$male='checked';
			$female='';
		}
		  else{
			$male='';
			$female='checked';
		}
		?>

                   <label class="control-label col-md-3">Gender</label>
                  <div class="col-md-6" style='padding-top:8px;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <input name="gender" type="radio" value='Male' <?php echo $male ?>> Male &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			  <input name="gender" type="radio" value='Female' <?php echo $female ?>> Female
            </div> 
          </div>
    <div class="form-group">
            <label class="control-label col-md-3"><br>Photograph
           
            </label> 
            <div class="col-md-5">
              <div class="fileupload fileupload-new" data-provides="fileupload"><input type="hidden">
              <input value="" name="" type="hidden">
                <div class="fileupload-new img-thumbnail" style="width: 150px; height: 100px;">
                  <img src="<?php echo $photo ?>">
                </div>
                <div class="fileupload-preview fileupload-exists img-thumbnail" style="width: 200px; max-height: 150px;"></div>
                <div>
                  <span class="btn btn-default btn-file"><span class="fileupload-new">Select image</span>
                  
                  <span class="fileupload-exists">Change</span>
                  <input name="photo" id="profile_pic" type="file"></span>
                  <a class="btn btn-default fileupload-exists" data-dismiss="fileupload" href="#">Remove</a>
                 <br> <small>Only jpg ,png &amp; jpeg (Max : 2MB)</small>
                </div>
              </div>
            </div>
          </div>

		 
 </div>
 <div class="col-md-6">
 <div class="heading"><h3>Other Details</h3></div>
  <div class="form-group">
            <label class="control-label col-md-3">Salary&nbsp;Calculation</label>
            <div class="col-md-6">
              <select class="form-control" name="depart" required>
			  <?php
		$de=mysql_query("SELECT *FROM `depart` ORDER BY `Number` ASC");
			  while($re=mysql_fetch_assoc($de)){
					$ne=$re['Number'];
					$dep=$re['Depart'];
					if($ne==$depart)
						$sed="selected=selected'";
					else
						$sed="";
			echo"<option value='$ne' $sed>$dep</option>";
			  }
			  ?>
                            </select>
            </div>
                         <span style="color:#d43f3a">
                         *
                      </span>     </div> 
  <div class="form-group">
            <label class="control-label col-md-3">Gross Salary</label>
            <div class="col-md-6" TITLE="Rwandan Francs">
             <div class="input-group">
            <span class="input-group-addon">RWF</span>
              <input class="form-control" name="salary" value="<?php echo $salary ?>" type="text" onkeyup='format(this);' onkeypress='return isNumberKey(event)' required>
            </div>
          </div>
                     <span style="color:#d43f3a">
                       *
                      </span>          </div>
  
  <div class="form-group">
   <label class="control-label col-md-3">Branch Limit</label>

                  <div class="col-md-6">
			  <select class="form-control" name="qualify">
			<?php
				echo"<option value='' selected='selected'> SELECT BRANCH </option>";
			
	$dois=mysql_query("SELECT `Name` FROM `branches` ORDER BY `Number` ASC");
			while($rois=mysql_fetch_assoc($dois)){
				$fna=$rois['Name'];
				if($qualify==$fna)
					$t='selected';
				else
					$t='';
			echo"<option value='$fna' $t> $fna </option>";
			}
			?>		</select>
            </div> 
               <small></small>
            
            </div>
 
							  <div class="form-group">
            <label class="control-label col-md-3">Privileges</label>
            <div class="col-md-6"><select class="form-control" name="currentp" required>
			  <option value="0">Select&nbsp;Position</option>
			  <option value="100900" style="padding: 2px 0px 10px 2px;">PURCHASE</option>
			  <?php
		
			$de=mysql_query("SELECT *FROM `position` WHERE `Status` = '0' ORDER BY `Postid` ASC");
			  while($re=mysql_fetch_assoc($de)){
					$ne=$re['Postid'];
					$dep=$re['Postname'];
					$tit=$re['Owner'];
					if($ne==$currentp)
						$sed="selected=selected'";
					else
						$sed="";
			echo"<option value='$ne' $sed title='$tit'>$dep</option>";
			  }
			  ?>
                            </select>
            </div>
                        <span style="color:#d43f3a">
                         *
                      </span>     </div> 







					   <br><div class="heading"><h4>Log-in details</h4></div>
          <div class="widget-container fluid-height" style='padding:20px 5px 5px 5px;'>
		   <div class="form-group">
                   <label class="control-label col-md-4">Username</label>
                  <div class="col-md-6">
              <input class="form-control" name="email" type="text" value="<?php echo $email ?>">
            </div> 
                                </div>
          <div class="form-group">
                   <label class="control-label col-md-4">Password</label>
                  <div class="col-md-6">
              <input class="form-control" name="password" id="password" type="password" value="<?php echo $password ?>">
            </div> 
                                 </div>
          <div class="form-group">
                   <label class="control-label col-md-4">Confirm Password</label>
                  <div class="col-md-6">
              <input class="form-control" type="password" name="confirm_password" id="confirm_password"  value="<?php echo $password ?>"/> <span id='message'></span>
            </div> 
                                   </div></div>      








 </div>
 </div></div>


  <div class="form-group">
  <div class="col-md-12">
  <?php
   if($_SESSION['Settings']=='1'){
						?>
  <div class="col-md-6">                 
  <button class="btn btn-lg btn-block btn-danger" type="reset"><i class="lnr lnr-undo"></i> Reset</button>         
  </div> 
   <div class="col-md-6">                 
    <button class="btn btn-lg btn-block btn-success" type="submit"  name="<?php echo $namb ?>"><i class="lnr lnr-checkmark-circle"></i> <?php echo $valub ?> </button>         
   </div> 
  <?php
  }
						?>
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
