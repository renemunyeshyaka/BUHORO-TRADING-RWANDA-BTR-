<?php
include'connection.php';
session_start();
$bt='submit';
 $scode='';
    $newpassword='';
		$confirmpassword='';
if(isset($_POST['submit_change']))
	{
    $scode=$_POST['scode'];
    $newpassword=$_POST['newpassword'];
    $confirmpassword=$_POST['confirmpassword'];
	$_SESSION['Co']=10;
	if($scode=='')
		$pto=10;
	elseif($newpassword=='')
		$pto=11;
	elseif($confirmpassword=='')
		$pto=12;
	else{
	if($newpassword!=$confirmpassword){
    $newpassword='';
		$confirmpassword='';
		$pto=13;
	}
	else{
		$newpasswo=md5($newpassword);

		$dot=mysql_query("SELECT *FROM `employees` WHERE `Scode`='$scode' AND `Sdate`='$Date' LIMIT 1");
	$fot=mysql_num_rows($dot);
		if($fot){
			$rot=mysql_fetch_assoc($dot);
				$eid=$rot['Eid'];
	$do=mysql_query("UPDATE `employees` SET `Password`='$newpasswo',`Scode`='',`Sdate`='' WHERE `Eid`='$eid' AND `Scode`='$scode' LIMIT 1");
		$scode='';
		 $newpassword='';
		$confirmpassword='';
		$pto=14;
		}
		else{
			$pto=15;
			 $scode='';
		}
	}

	}
	}

	$_SESSION['Scode']=$scode;
	$_SESSION['Newpassword']=$newpassword;
	$_SESSION['Confirmpassword']=$Confirmpassword;
?>
<!DOCTYPE html>
<html><head>
<meta http-equiv="content-type" content="text/html; charset=windows-1252">   
    <title>
      Shift    </title>
      <link href="style/bootstrap.css" media="all" rel="stylesheet" type="text/css">
      <link rel="stylesheet" href="style/icon-font.css">
    
     <link href="style/style.css" media="all" rel="stylesheet" type="text/css">
  
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
   
      
  </head>
<body class="login2">
	<!-- Login Screen -->
	<div class="login-wrapper">
		<a href="http://tsirwanda.com/topsec/" target="_blank">
				<img src="imgs/logo.png" width="191px" height="63px">
			 </a>
            <br><br><h2>Reset Password</h2>
			<?php
		$scode=$_SESSION['Scode'];
	$newpassword=$_SESSION['Newpassword'];
	$Confirmpassword=$_SESSION['Confirmpassword'];

	if($_SESSION['Co']==60)
				print("<div class='alert alert-danger' style='text-align:center;float:center;background-color: #60c560;color: #ffffff;border-radius:5px;'>
		<i class='lnr lnr-smile'></i> <button class='close' data-dismiss='alert' type='button'>×</button>Open your Email to Find Security Code.
		</div>");
	
	if($pto==10)
echo"<center><div class='alert alert-danger' style='text-align:center;float:center;border-radius:5px;'>
		<i class='lnr lnr-sad'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>×</button>Security Code Cannot Be Empty.
		</div>";

if($pto==11)
echo"<center><div class='alert alert-danger' style='text-align:center;float:center;border-radius:5px;'>
		<i class='lnr lnr-sad'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>×</button>New Password Cannot Be Empty.
		</div></center>";

if($pto==12)
echo"<center><div class='alert alert-danger' style='text-align:center;float:center;border-radius:5px;'>
		<i class='lnr lnr-sad'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>×</button>Confirm Password Cannot Be Empty.
		</div></center>";

if($pto==13)
echo"<center><div class='alert alert-danger' style='text-align:center;float:center;border-radius:5px;'>
		<i class='lnr lnr-sad'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>×</button>Password Does Not Match.
		</div></center>";

if($pto==14){
	$bt="button";
echo"<center><div class='alert alert-danger' style='text-align:center;float:center;background-color: #60c560;color: #ffffff;border-radius:5px;'>
		<i class='lnr lnr-checkmark-circle'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>×</button>Your Password Has Been Changed.
		</div></center>";
}
if($pto==15)
echo"<center><div class='alert alert-danger' style='text-align:center;float:center;border-radius:5px;'>
		<i class='lnr lnr-sad'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>×</button>Your Security Code is Incorrect.
		</div></center>";
if($_SESSION['Co']==10 OR $_SESSION['Co']==60){
	?>
	<form method="post" action="preset.php">
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon"><i class="lnr lnr-enter"></i></span>
					<input class="form-control" placeholder="Security Code" name="scode" type="text" value="<?php echo $scode ?>" onkeyup='this.value = digitGroup(this.value);' maxlength='7'>
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon"><i class="lnr lnr-lock"></i></span>
					<input class="form-control" placeholder="New Password" name="newpassword" type="password" value="<?php echo $newpassword ?>">
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon"><i class="lnr lnr-lock"></i></span>
					<input class="form-control" placeholder="Confirm New Password" name="confirmpassword" type="password" value="<?php echo $confirmpassword ?>">
				</div>
			</div>
			
			<input class="btn btn-lg btn-primary btn-block" value="Change" name="submit_change" type="<?php echo $bt ?>">
			
		</form>
	<?php
}
		?>
		 <div class="text-left checkbox">
				<a class="pull-right" href="index.php">Back To Login</a>
			</div>
	</div>
 <script src="style/jquery-1.js" type="text/javascript">  </script>
	<script src="style/bootstrap.js" type="text/javascript"></script>
  <script>
   function digitGroup(dInput) {
                var output = "";
                try {
                    dInput = dInput.replace(/[^0-9]/g, ""); // remove all chars including spaces, except digits.
                    var totalSize = dInput.length;
                    for (var i = totalSize - 1; i > -1; i--) {
                        output = dInput.charAt(i) + output;
                        var cnt = totalSize - i;
                        if (cnt % 3 === 0 && i !== 0) {
                            output = "-" + output; // seperator is " "
                        }
                    }
                } catch (err)
                {
                    output = dInput; // it won't happen, but it's sweet to catch exceptions.
                }
                return output;
            }
</script>
</body></html>