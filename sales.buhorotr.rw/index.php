<?php
include'connection.php';
if(isset($_POST['submit_login']))
	{
    $password=$_POST['password'];
    $email=$_POST['email'];
	if($password=='' OR $email=='')
		$pto=31;
	else{
		$passwo=md5($password);
	
  $chi=mysql_query("SELECT *FROM `employees` WHERE `Email`='$email' AND `Status`='0' LIMIT 1");
$che=mysql_query("SELECT *FROM `employees` WHERE `Password`='$passwo' AND `Status`='0' LIMIT 1");
	$ch=mysql_query("SELECT *FROM `employees` WHERE `Email`='$email' AND `Password`='$passwo' AND `Status`='0' LIMIT 1");
		if($nc=mysql_num_rows($ch) AND $ns=mysql_num_rows($che) AND $nci=mysql_num_rows($chi)){
			$res=mysql_fetch_assoc($ch);
			{
				$userid=$res['Eid'];
				$fname=$res['Fname'];
				$lname=$res['Lname'];
				$currentp=$res['Currentp'];
				$branche=$res['Branche'];
				$uname=$res['Email'];
				$loge="$fname $lname";
			}

				session_start();
                        $_SESSION['Fname']=$fname;
						$_SESSION['Lname']=$lname;
						$_SESSION['Userid']=$userid;
						$_SESSION['Branche']=$branche;
						$_SESSION['Access']=$currentp;
						$_SESSION['Loge']=$loge;
						$_SESSION['Uname']=$uname;
			if($branche){				
				$_SESSION['BR']=$branche;
			}

$ip=$_SERVER['REMOTE_ADDR'];
if($userid!='1001')
	$moves=mysql_query("INSERT INTO `moves` (`User`, `Date`, `Time`, `Address`, `Location`) VALUES ('$loge', '$Date', '$Time', '$ip', '')");
		include'privile.php';    
		if($currentp=='100900')
	       Header("location:market.php");
	       else
	       Header("location:home.php");
		}
				 else{
					 $pto=32;
				$ip=$_SERVER['REMOTE_ADDR'];
	$moves=mysql_query("INSERT INTO `moves` (`User`, `Date`, `Time`, `Address`, `Location`) VALUES ('Unknown Person', '$Date', '$Time', '$ip', '')");
				 }
}
		}
		
?>
<!DOCTYPE html>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
   
    <title><?php echo $cna ?></title>
      <link href="style/bootstrap.css" media="all" rel="stylesheet" type="text/css">
      <link rel="stylesheet" href="style/icon-font.css">
    
     <link href="style/style.css" media="all" rel="stylesheet" type="text/css">
  
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
   
         <style type="text/css">
 @media (max-width: 50em) {
.element {
display: none;
}
  }
  </style> 
  </head>
<body class="login2">
	<!-- Login Screen -->
	<div class="login-wrapper">
		<a href="#" target="_blank" class="hidden-xs">
				<img src="imgs/logo.png" width="210px" height="120px" style="border-radius:5px; opacity: 0.2;">
			 </a><br>
			 <h5>Enter your username and password</h5>
			<?php
	if($pto==31){
		print("<div class='alert alert-danger' style='border-radius:5px;'>
		<i class='lnr lnr-sad'></i> <button class='close' data-dismiss='alert' type='button'>×</button>Username or Password Cannot Be Empty.
		</div>");
	}
	if($pto==32){
		print("<div class='alert alert-danger' style='border-radius:5px;'>
		<i class='lnr lnr-sad'></i> <button class='close' data-dismiss='alert' type='button'>×</button>Incorrect username or password, please try again.
		</div>");
	}
	?>
	<form method="post" action="">
	<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon"><i class="lnr lnr-users"></i></span><input class="form-control" placeholder="Username" name="email" type="text" autofocus='autofocus' required>
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon"><i class="lnr lnr-lock"></i></span><input class="form-control" placeholder="Password" name="password" type="password" required>
				</div>
			</div>
			
			<div class="text-left ">
				<a class="pull-right" href="#">SALES</a>
			<div class="text-left">
          <label class="checkbox">
          <input name="cookie_set" value="true" type="checkbox" checked><span>Keep me logged in</span></label>
        </div>
			</div>
			
			<input class="btn btn-lg btn-primary btn-block" value="Log in" name="submit_login" type="submit">
			
		</form>
		
		
	</div>
 <script src="style/jquery-1.js" type="text/javascript">  </script>
	<script src="style/bootstrap.js" type="text/javascript"></script>
  <br><br><br><br><br><br><br><center><a style="color:grey" href="#" disabled>SALES</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="http://logistics.buhorotr.rw">LOGISTICS</a>
</body></html>
