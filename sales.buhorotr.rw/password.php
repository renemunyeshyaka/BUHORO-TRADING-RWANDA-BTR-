<?php
	session_start();
include'connection.php';
 $oldpassword='';
    $newpassword='';
		$confirmpassword='';
		$ipto=0;
if(isset($_POST['submit_changepassword']))
	{
    $oldpassword=$_POST['oldpassword'];
    $newpassword=$_POST['newpassword'];
    $confirmpassword=$_POST['confirmpassword'];

	if($oldpassword=='')
		$ipto=10;
	elseif($newpassword=='')
		$ipto=11;
	elseif($confirmpassword=='')
		$ipto=12;	
	else{

		$use=$_SESSION['Userid'];
		$oldpasswo=md5($oldpassword);
		$newpasswo=md5($newpassword);

	$dot=mysql_query("SELECT *FROM `employees` WHERE `Eid`='$use' AND `Password`='$oldpasswo' LIMIT 1");
	if($fot=mysql_num_rows($dot)){
		if($newpassword!=$confirmpassword){
		$newpassword='';
		$confirmpassword='';
		$ipto=13;
		}
elseif(!preg_match("#[0-9]+#", $newpassword) OR !preg_match("#[a-z]+#", $newpassword) OR strlen($newpassword) < 5){
			$newpassword='';
		$confirmpassword='';
		$ipto=14;
		}
		else{
		$dots=mysql_query("SELECT *FROM `employees` WHERE `Eid`!='$use' AND `Password`='$newpasswo' LIMIT 1");
			if($fots=mysql_num_rows($dots)){
				$newpassword='';
		$confirmpassword='';
				$ipto=14;
			}
			else{
	$do=mysql_query("UPDATE `employees` SET `Password`='$newpasswo' WHERE `Eid`='$use' AND `Password`='$oldpasswo'");
		$oldpassword='';
		 $newpassword='';
		$confirmpassword='';
		$_SESSION['ipto']=14;
		Header("location:index.php");
		}
	}
	}
		else{
			$ipto=15;
			 $oldpassword='';
		}
	}
	
	}

	include'header.php';


	$_SESSION['Oldpassword']=$oldpassword;
	$_SESSION['Newpassword']=$newpassword;
	$_SESSION['Confirmpassword']=$Confirmpassword;
	?>
<div class="container-fluid main-content">
        <div class="page-title">
          <h2 style='margin-top:-20px; margin-bottom: 5px; color:#ffcc33'>

        Change Password</h2>
    </div>
<div class="row">
 <div class="col-md-12">
 <div class="widget-container fluid-height clearfix">
 <div class="widget-content padded" style='padding-top:40px;'>
 <form method="post" class="form-horizontal" action="password.php" enctype="multipart/form-data">

<?php
	$oldpassword=$_SESSION['Oldpassword'];
	$newpassword=$_SESSION['Newpassword'];
	$Confirmpassword=$_SESSION['Confirmpassword'];
if($ipto==10)
echo"<center><div class='alert alert-danger' style='text-align:center;float:center;border-radius:5px;'>
		<i class='lnr lnr-sad'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>×</button>Old password cannot be bmpty.
		</div>";

if($ipto==11)
echo"<center><div class='alert alert-danger' style='text-align:center;float:center;border-radius:5px;'>
		<i class='lnr lnr-sad'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>×</button>New password cannot be pmpty.
		</div></center>";

if($ipto==12)
echo"<center><div class='alert alert-danger' style='text-align:center;float:center;border-radius:5px;'>
		<i class='lnr lnr-sad'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>×</button>Confirm password cannot be empty.
		</div></center>";

if($ipto==13)
echo"<center><div class='alert alert-danger' style='text-align:center;float:center;border-radius:5px;'>
		<i class='lnr lnr-sad'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>×</button>New password does not match with confirmation.
		</div></center>";

if($ipto==14)
echo"<center><div class='alert alert-danger' style='text-align:center;float:center;border-radius:5px;'>
<i class='lnr lnr-checkmark-circle'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>×</button>Your new password is not strong enough.
		</div></center>";

if($ipto==15)
echo"<center><div class='alert alert-danger' style='text-align:center;float:center;border-radius:5px;'>
		<i class='lnr lnr-sad'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>×</button>Old password is incorrect. 
		</div></center>";

		?>

 <div class="row">
 <div class="col-md-12">
 <div class="form-group">
 <label class="control-label col-md-3">Old Password</label>
            <div class="col-md-6">
              <input class="form-control" name="oldpassword" value="<?php echo $oldpassword ?>" type="password" required>
            </div>
          </div>
 <div class="form-group">
 <label class="control-label col-md-3">New Password</label>
            <div class="col-md-6">
              <input class="form-control" name="newpassword" pattern=".{5,10}" value="<?php echo $newpassword ?>" type="password" required>&nbsp;&nbsp;&nbsp;&nbsp;<font size='2' color='red'>Use atleast 6 characters and mix letters with numbers </font>
            </div>
          </div>
 <div class="form-group">
 <label class="control-label col-md-3">Confirm Password</label>
            <div class="col-md-6">
              <input class="form-control" name="confirmpassword" pattern=".{5,10}" value="<?php echo $confirmpassword ?>" type="password" required>
            </div>
          </div>
  <div class="form-group">
   <div class="col-md-12">  
   <div class="col-md-3"></div>  
   <div class="col-md-6">             
    <button class="btn btn-lg btn-block btn-warning" type="submit" name="submit_changepassword"><i class="lnr lnr-chevron-up-circle"></i> Update</button>  
    </div>       
   <div class="col-md-3"></div>
   </div>
 </div>
 </div></div>
 </form>
</div>
</div>
</div>
</div></div>
<?php
include'footer.php';
?>
