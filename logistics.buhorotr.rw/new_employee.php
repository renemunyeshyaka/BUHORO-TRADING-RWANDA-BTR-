<?php
if(basename($_SERVER['PHP_SELF']) == 'new_employee.php') {
  $py=" class='current'";
} else {
  $py="";
} 
include'header.php';
include'connection.php';
$t=0;

if(isset($_POST['submit_employee']))
		{
			$fname=$_POST['fname'];
			$lname=$_POST['lname'];
			$birth=$_POST['birth'];
			$address=$_POST['address'];
			$idno=$_POST['idno'];
			$contact1=$_POST['contact1'];
			$contact2=$_POST['contact2'];
			$gender=$_POST['gender'];
			$email=$_POST['email'];
			$pass1=$_POST['password'];
			$pass2=$_POST['confirm_password'];
			$bank=$_POST['bank'];
			$branch=$_POST['branch'];

			$account=$_POST['account'];
			$remarks=$_POST['remarks'];
			$rssb=$_POST['rssb'];
			$depart=$_POST['depart'];
			$salary=$_POST['salary'];
			$salary=preg_replace('/,/', '', $salary);
			$qualify=$_POST['qualify'];
			$start=$_POST['start'];
			$currentp=$_POST['currentp'];
			$acce=$_POST['acce'];

	if($pass1==$pass2){
		if($pass2)
			$pass2=md5($pass2);
		else
			$pass2="";

$temp = explode(".", $_FILES["photo"]["name"]);
$newfilename = round(microtime(true)) . '.' . end($temp);
move_uploaded_file($_FILES["photo"]["tmp_name"], "photos/" . $newfilename);

$temp1 = explode(".", $_FILES["file1"]["name"]);
$newfilename1 = round(microtime(true)) . '.' . end($temp1);
move_uploaded_file($_FILES["file1"]["tmp_name"], "files1/" . $newfilename1);

$temp2 = explode(".", $_FILES["file2"]["name"]);
$newfilename2 = round(microtime(true)) . '.' . end($temp2);
move_uploaded_file($_FILES["file2"]["tmp_name"], "files2/" . $newfilename2);

$temp3 = explode(".", $_FILES["file3"]["name"]);
$newfilename3 = round(microtime(true)) . '.' . end($temp3);
move_uploaded_file($_FILES["file3"]["tmp_name"], "files3/" . $newfilename3);

if(!end($temp))
	$newfilename='';

if(!end($temp1))
	$newfilename1='';

if(!end($temp2))
	$newfilename2='';

if(!end($temp3))
	$newfilename3='';

	$do=mysqli_query($conn, "INSERT INTO `employees` (`Fname`, `Lname`, `Birth`, `Address`, `Idno`, `Contact1`, `Contact2`, `Gender`, `Photo`, `Email`, `Password`, `Bank`, `Branch`, `Account`, `Remarks`, `Rssb`, `Depart`, `Salary`, `Qualify`, `File1`, `File2`, `Starting`, `File3`, `Currentp`, `Owner`, `Date`, `Access`) VALUES ('$fname', '$lname', '$birth', '$address', '$idno', '$contact1', '$contact2', '$gender', '$newfilename', '$email', '$pass2', '$bank', '$branch', '$account', '$remarks', '$rssb', '$depart', '$salary', '$qualify', '$newfilename1', '$newfilename2', '$start', '$newfilename3', '$currentp', '$loge', '$Date', '$acce')");
 
 $pto=10;				$t=0;
	}
	else{
		$t=1;							$pto=30;
			$namb="submit_employee";
				$valub="Submit";
	}
		}
			if($t==0){
			$fname='';
			$rowid='';
			$lname='';
			$birth='';
			$address='';
			$idno='';
			$contact1='';
			$contact2='';
			$gender='Male';
			$email='';
			$pass1=$password='';
			$pass2='';
			$bank='';
			$branch='';
			$account='';
			$remarks='';
			$rssb='';
			$depart='';
			$salary='';
			$qualify='';
			$start='';
			$currentp='';
			$parte='';
			$file1='';
			$file2='';
			$file3='';
			$dfile1='';
			$dfile2='';
			$dfile3='';
			$photo="imgs/-text.png";
			$namb="submit_employee";
				$valub="Submit";
}

if(isset($_POST['edit_id']))
		{
			$rowid=$_POST['rowid'];
$do=mysqli_query($conn, "SELECT *FROM `employees` WHERE `Eid`='$rowid' ORDER BY `Eid` ASC LIMIT 1");
while($ro=mysqli_fetch_assoc($do)){
$rowid=$ro['Eid'];
$fname=$ro['Fname'];
$lname=$ro['Lname'];
$depart=$ro['Depart'];
$birth=$ro['Birth'];
$contact1=$ro['Contact1'];
$contact2=$ro['Contact2'];
$idno=$ro['Idno'];
$currentp=$ro['Currentp'];
$address=$ro['Address'];
$gender=$ro['Gender'];
$email=$ro['Email'];
$password=$ro['Password'];
$confirm_password=$ro['Password'];
$bank=$ro['Bank'];
$branch=$ro['Branch'];
$account=$ro['Account'];
$remarks=$ro['Remarks'];
$rssb=$ro['Rssb'];
$salary=number_format($ro['Salary']);
$qualify=$ro['Qualify'];
$start=$ro['Starting'];
$photo=$ro['Photo'];
$file1=$ro['File1'];
$file2=$ro['File2'];
$file3=$ro['File3'];
$acce=$ro['Access'];
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
			$birth=$_POST['birth'];
			$address=$_POST['address'];
			$idno=$_POST['idno'];
			$contact1=$_POST['contact1'];
			$contact2=$_POST['contact2'];
			$gender=$_POST['gender'];
			$email=$_POST['email'];
			$pass1=$_POST['password'];
			$pass2=$_POST['confirm_password'];
			$bank=$_POST['bank'];
			$branch=$_POST['branch'];
			$account=$_POST['account'];
			$remarks=$_POST['remarks'];
			$rssb=$_POST['rssb'];
			$depart=$_POST['depart'];
			$salary=$_POST['salary'];
			$salary=preg_replace('/,/', '', $salary);
			$qualify=$_POST['qualify'];
			$start=$_POST['start'];
			$photoc=$_POST['photoc'];
			$file1=$_POST['file1'];
			$file2=$_POST['file2'];
			$file3=$_POST['file3'];
			$passwo=$_POST['passwo'];
if($pass1==$pass2){
		if($passwo!=$pass2 AND $pass2!='')
			$pass2=md5($pass2);			
			$currentp=$_POST['currentp'];
			$acce=$_POST['acce'];
			$password=$pass2;

$temp = explode(".", $_FILES["photo"]["name"]);
$newfilename = round(microtime(true)) . '.' . end($temp);
move_uploaded_file($_FILES["photo"]["tmp_name"], "photos/" . $newfilename);

$temp1 = explode(".", $_FILES["file1"]["name"]);
$newfilename1 = round(microtime(true)) . '.' . end($temp1);
move_uploaded_file($_FILES["file1"]["tmp_name"], "files1/" . $newfilename1);

$temp2 = explode(".", $_FILES["file2"]["name"]);
$newfilename2 = round(microtime(true)) . '.' . end($temp2);
move_uploaded_file($_FILES["file2"]["tmp_name"], "files2/" . $newfilename2);

$temp3 = explode(".", $_FILES["file3"]["name"]);
$newfilename3 = round(microtime(true)) . '.' . end($temp3);
move_uploaded_file($_FILES["file3"]["tmp_name"], "files3/" . $newfilename3);

if(!end($temp)){
	$newfilename='';
	$phos='';
	$photo=$photoc;
}
else{
	$photo=$newfilename;
	$phos="`Photo`='$photo',";
}

if(!end($temp1)){
	$newfilename1='';
	$fils1='';
}
else{
	$file1=$newfilename1;
	$fils1="`File1`='$file1',";
}

if(!end($temp2)){
	$newfilename2='';
	$fils2='';
}
else{
	$file2=$newfilename2;
	$fils2="`File2`='$file2',";
}

if(!end($temp3)){
	$newfilename3='';
	$fils3='';
}
else{
	$file3=$newfilename3;
	$fils3="`File3`='$file3',";
}

if(!$photo)
		$photo="imgs/-text.png";
	else
		$photo="photos/$photo";

$namb="update_employee";
				$valub="Update";

	$do=mysqli_query($conn, "UPDATE `employees` SET `Fname`='$fname', `Lname`='$lname', `Birth`='$birth', `Address`='$address', `Idno`='$idno', `Contact1`='$contact1', `Contact2`='$contact2', `Gender`='$gender', $phos `Email`='$email', `Password`='$pass2', `Bank`='$bank', `Branch`='$branch', `Account`='$account', `Remarks`='$remarks', `Rssb`='$rssb', `Depart`='$depart', `Salary`='$salary', `Qualify`='$qualify', $fils1 $fils2 `Starting`='$start', $fils3 `Currentp`='$currentp', `Owner`='$loge', `Access`='$acce' WHERE `Eid`='$rowid'");

	$dos=mysqli_query($conn, "SELECT `Photo` FROM `employees` WHERE `Eid`='$rowid' ORDER BY `Eid` ASC LIMIT 1");
			$ros=mysqli_fetch_assoc($dos);
				$photo=$ros['Photo'];
	if(!$photo)
		$photo="imgs/-text.png";
	else
		$photo="photos/$photo";
 
	$salary=number_format($salary);
 $pto=20;
 }
	else{
		$pto=30;
			$namb="update_employee";
				$valub="Update";
	}
		}


	if($file1)
	$dfile1="&nbsp;&nbsp;<a href='down_file1.php?link=$file1'>Download&nbsp;File1</a>";
else
	$dfile1="";

	if($file2)
	$dfile2="&nbsp;&nbsp;<a href='down_file2.php?link=$file2'>Download&nbsp;File2</a>";
else
	$dfile2="";

	if($file3)
	$dfile3="&nbsp;&nbsp;<a href='down_file3.php?link=$file3'>Download&nbsp;File3</a>";
else
	$dfile3="";
?>

 <div class="container-fluid main-content">
<div class="page-title">
        <h1 style='margin-top:-20px; margin-bottom: 5px;'>
         Employees
          </h1>
        </div>
 <div class="row">
 <div class="col-md-2">
		<ul class="list-group">
		 		 <li class="list-group-item">
           <a href="employees.php">
           <p>
           <i class="lnr lnr-menu-circle"></i>&nbsp;List of Employees
           </p></a>
           </li>
                          <li class="list-group-item active">
           <a href="new_employee.php">
           <p>
           <i class="lnr lnr-plus-circle"></i>&nbsp;Create Employee
           </p></a>
           </li>
                       </ul>


                          <br><br><center>
						   <span style="color:#d43f3a"><small>Mandatory fields must be filled.</small></span>
		</div>
	
 <div class="col-md-10">
 <div class="widget-container fluid-height clearfix">
 <div class="widget-content padded">
 <form method="post" class="form-horizontal" name="myform" action="new_employee.php" enctype="multipart/form-data">
<?php
	if($pto==10)
echo"<center><div class='alert alert-success' style='text-align:center; float:center; color: #3366ff; border-radius:5px;'>
		<i class='lnr lnr-checkmark-circle'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>&times;</button>New Employee Has Been Created. </div></center>";

	if($pto==20)
echo"<center><div class='alert alert-info' style='text-align:center; float:center; color: #3366ff; border-radius:5px;'>
		<i class='lnr lnr-checkmark-circle'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>&times;</button>Employee Has Been Updated.
		</div></center>";

	if($pto==30)
echo"<center><div class='alert alert-warning' style='text-align:center; float:center; color: #ff6666; border-radius:5px;'>
		<i class='lnr lnr-checkmark-circle'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>&times;</button>Password not matching, please verify. </div></center>";

		echo"<input value='$rowid' name='rowid' type='hidden'><input value='$file1' name='file1' type='hidden'>
		<input value='$password' name='passwo' type='hidden'><input value='$file2' name='file2' type='hidden'>
		<input value='$file3' name='file3' type='hidden'><input value='$photo' name='photoc' type='hidden'>";
		?>
 
 <div class="row">
 <div class="col-md-12">
 <div class="col-md-6">
 <div class="heading"><h2>Personal Details</h2></div><br>
   <div class="form-group">
            <label class="control-label col-md-3">First Name</label>
            <div class="col-md-6">
              <input class="form-control" name="fname" type="text" value="<?php echo $fname ?>" required>
            </div>
                         <span style="color:#d43f3a">
                         mandatory
                      </span>          </div>    
   <div class="form-group">
            <label class="control-label col-md-3">Last Name</label>
            <div class="col-md-6">
              <input class="form-control" name="lname" type="text" value="<?php echo $lname ?>">
            </div>
   </div>
    <div class="form-group">
 <label class="control-label col-md-3">Date Of Birth</label>
     <div class="col-md-6">
 <div class="input-group date datepicker">
      <input class="form-control form-center" id="dob" name="birth" type="text" value="<?php echo $birth ?>" onkeypress='return isNumberKey(event)'>
	  <span class="input-group-addon"><i class="lnr lnr-calendar-full"></i></span>
              </div></div></div>
            
          <div class="form-group">
                   <label class="control-label col-md-3">Passport/ID&nbsp;No </label>
                  <div class="col-md-6">
             <input class="form-control" name="idno" type="text"  value="<?php echo $idno ?>" onkeypress='return isNumberKey(event)'>
            </div> 
			  <span style="color:#d43f3a">
                         mandatory
                      </span>   
			</div>
			 <div class="form-group">
                   <label class="control-label col-md-3">Contact No.1</label>
                  <div class="col-md-6">
             <input class="form-control" name="contact1" type="text" value="<?php echo $contact1 ?>">
            </div> 
			 <span style="color:#d43f3a">
                         mandatory
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
                 <br> <small>Only jpg ,png &amp; jpeg (Max : 2M)</small>
                </div>
              </div>
            </div>
          </div><br><br>
           <fieldset><div class="form-group">
                   <label class="control-label col-md-3">Username</label>
                  <div class="col-md-6">
              <input class="form-control" name="email" type="text" value="<?php echo $email ?>">
            </div> 
                                </div>
          <div class="form-group">
                   <label class="control-label col-md-3">Password</label>
                  <div class="col-md-6">
              <input class="form-control" name="password" id="password" type="password" value="<?php echo $password ?>">
            </div> 
                                 </div>
          <div class="form-group">
                   <label class="control-label col-md-3">Confirmation</label>
                  <div class="col-md-6">
              <input class="form-control" type="password" name="confirm_password" id="confirm_password"  value="<?php echo $password ?>"/> <span id='message'></span>
            </div> 
                                   </div></fieldset>      
 </div>
 <div class="col-md-6">
 <div class="heading"><h2>Other Details</h2></div><br>
     <div class="form-group">
                   <label class="control-label col-md-3">Physical Address</label>
                  <div class="col-md-6">
              <textarea class="form-control" name="address"><?php echo $address ?></textarea>
            </div> 
          </div>
               <div class="form-group">
 <label class="control-label col-md-3">Employee&nbsp;Number</label>
 <div class="col-md-6">
 <input class="form-control" name="rssb" type="text" value="<?php echo $rssb ?>">
 </div>
   <span style="color:#d43f3a">
                        RSSB Number
                      </span> </div>
  <div class="form-group">
            <label class="control-label col-md-3">Salary&nbsp;Calculation</label>
            <div class="col-md-6">
              <select class="form-control" name="depart">
			  <?php
		$de=mysqli_query($conn, "SELECT *FROM `depart` ORDER BY `Number` ASC");
			  while($re=mysqli_fetch_assoc($de)){
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
                         mandatory
                      </span>     </div> 
  <div class="form-group">
            <label class="control-label col-md-3">Employee Salary</label>
            <div class="col-md-6" TITLE="Rwandan Francs">
             <div class="input-group">
            <span class="input-group-addon">RWF</span>
              <input class="form-control" name="salary" value="<?php echo $salary ?>" type="text" onkeyup='format(this);' onkeypress='return isNumberKey(event)' required>
            </div>
          </div>
                     <span style="color:#d43f3a">
                       mandatory
                      </span>          </div>
  
  <div class="form-group">
   <label class="control-label col-md-3">Qualification</label>

                  <div class="col-md-6">
              <input class="form-control" name="qualify" type="text" value="<?php echo $qualify ?>">
            </div> 
               <small>Use commas to separate names</small>
            
            </div>
 <div class="form-group">
    <label class="control-label col-md-3"></label>
                     <div class="col-md-6">
              <div class="fileupload fileupload-new" data-provides="fileupload"><input value="" name="" type="hidden">
                <span class="btn btn-default btn-file"><span class="fileupload-new">Select file1</span><span class="fileupload-exists">Change</span>
                <input name="file1" id="qual_1" type="file"></span><span class="fileupload-preview"></span><button class="close fileupload-exists" data-dismiss="fileupload" style="float:none" type="button">×</button>

				<?php echo $dfile1 ?>
              </div>
                 <small>Zip, txt, jpeg, png, pdf, doc (Max : 2M)</small>
            </div> </div>
   <div class="form-group">
    <label class="control-label col-md-3"></label>
                     <div class="col-md-6">
              <div class="fileupload fileupload-new" data-provides="fileupload"><input value="" name="" type="hidden">
                <span class="btn btn-default btn-file"><span class="fileupload-new">Select file2</span><span class="fileupload-exists">Change</span>
                <input name="file2" id="qual_2" type="file">
                </span><span class="fileupload-preview"></span><button class="close fileupload-exists" data-dismiss="fileupload" style="float:none" type="button">×</button>

				<?php echo $dfile2 ?>
              </div>
                      <small>Zip, txt, jpeg, png, pdf, doc (Max : 2M)</small>
            </div> </div>

   <div class="form-group">
           <label class="control-label col-md-3">Starting Date</label>
   <div class="col-md-6">
 <div class="input-group date datepicker">
      <input class="form-control form-center" id="from" name="start" type="text" value="<?php echo $start ?>" onkeypress='return isNumberKey(event)'>
	  <span class="input-group-addon"><i class="lnr lnr-calendar-full"></i></span>
              </div></div></div>
            <div class="form-group">
    <label class="control-label col-md-3"></label>
                     <div class="col-md-6">
              <div class="fileupload fileupload-new" data-provides="fileupload"><input value="" name="" type="hidden">
                <span class="btn btn-default btn-file"><span class="fileupload-new">Select file3</span><span class="fileupload-exists">Change</span><input name="file3" id="add_proof" type="file"></span><span class="fileupload-preview"></span><button class="close fileupload-exists" data-dismiss="fileupload" style="float:none" type="button">×</button>
				<?php echo $dfile3 ?>
              </div>        <small>Zip, txt, jpeg, png, pdf, doc (Max : 2M)</small>
            </div> </div>





			


     <div class="form-group">
    <label class="control-label col-md-3"><br><br><br><br>System Access</label>
            <div class="col-md-6">
            <br><br><br><br><select class="form-control" name="acce" required>
			  <option value="0">Select&nbsp;Access</option>
			  <?php
		
			$de=mysqli_query($conn, "SELECT *FROM `access` WHERE `Status` = '0' ORDER BY `Access` ASC");
			  while($re=mysqli_fetch_assoc($de)){
					$ne=$re['Number'];
					$dep=$re['Access'];
					if($dep==$acce)
						$sedi="selected=selected'";
					else
						$sedi="";
			echo"<option value='$dep' $sedi>$dep</option>";
			  }
			  ?>
                            </select>
            </div><br><br><br><br><span style="color:#d43f3a">
                         mandatory
                      </span> 
                             </div>   
							 







							  <div class="form-group">
            <label class="control-label col-md-3">Current&nbsp;Position</label>
            <div class="col-md-6"><select class="form-control" name="currentp" required>
			  <option value="0">Select&nbsp;Position</option>
			  <?php
		
			$de=mysqli_query($conn, "SELECT *FROM `position` WHERE `Status` = '0' ORDER BY `Postname` ASC");
			  while($re=mysqli_fetch_assoc($de)){
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
                         mandatory
                      </span>     </div> 
 </div>
 </div></div>
          <div class="row">
          <div class="col-md-12">
          <div class="form-group">
          <div class="col-md-6">
          <div class="heading">
 <h2>Bank Details</h2>
 </div></div></div>
 <div class="col-md-6">
 <div class="form-group">
            <label class="control-label col-md-3">Bank Name</label>
            <div class="col-md-6">
		   <select class="form-control" name="bank" required>
			  <option value=" ">Select&nbsp;Bank</option>
			  <?php
		
			$de=mysqli_query($conn, "SELECT `Fnames` FROM `banks` WHERE `Fnames` != '' ORDER BY `Fnames` ASC");
			  while($re=mysqli_fetch_assoc($de)){
					$ban=$re['Fnames'];
					if($bank==$ban)
						$seb="selected=selected'";
					else
						$seb="";
			echo"<option value='$ban' $seb title='$tit'>$ban</option>";
			  }
			  ?>
                            </select>
            </div>
			  <span style="color:#d43f3a">
                         mandatory
                      </span>   
 </div>
           
          <div class="form-group">
            <label class="control-label col-md-3">Branch/Code</label>
            <div class="col-md-6">
              <input class="form-control" name="branch" type="text" value="<?php echo $branch ?>">
            </div>
</div>
         
</div> </div>
<div class="col-md-6">
<div class="form-group">
            <label class="control-label col-md-3">Account Number</label>
            <div class="col-md-6">
              <input class="form-control" name="account" type="text" value="<?php echo $account ?>">
            </div> 
</div>


          
          <div class="form-group">
            <label class="control-label col-md-3">Remarks</label>
            <div class="col-md-6">
              <textarea class="form-control" name="remarks"><?php echo $remarks ?></textarea>
            </div>
             </div>
           </div>  
</div>
<?php
if($_SESSION['Empopa']){
    ?>
  <div class="form-group">
  <div class="col-md-12">
   <div class="col-md-6">                 
    <button class="btn btn-lg btn-block btn-success" type="submit"  name="<?php echo $namb ?>" onClick='return validatepass(form);'><i class="lnr lnr-checkmark-circle"></i> <?php echo $valub ?> </button>         
   </div> 
  <div class="col-md-6">                 
  <button class="btn btn-lg btn-block btn-danger" type="reset"><i class="lnr lnr-undo"></i> Reset</button>         
  </div>       
 </div></div>
 <?php
}
?>
  </form>
 </div>
 </div>
 </div>
 </div>
 </div>

<?php
include'footer.php';
?>