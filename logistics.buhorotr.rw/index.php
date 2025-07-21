<?php
include'connection.php';
if(isset($_POST['submit_login']))
	{
    $username=$_POST['email'];
    $password=$_POST['password'];

if($username=='')
	$pto=30;
elseif($password=='')
	$pto=31;
else{

$passwo=md5($password);
	
  $ch=mysql_query("SELECT *FROM `employees` WHERE `Email`='$username' AND `Password`='$passwo' LIMIT 1");
		if($nc=mysql_num_rows($ch)){
		$res=mysql_fetch_assoc($ch);
			{
				$userid=$res['Eid'];
				$fname=$res['Fname'];
				$lname=$res['Lname'];
                $unames=$res['Email'];
				$photo=$res['Photo'];
				$access=$res['Access'];
			}
			session_start();
                        $_SESSION['Fname']=$fname;
						$_SESSION['Lname']=$lname;
						$_SESSION['Uname']=$unames;
						$_SESSION['Userid']=$userid;
						$_SESSION['Photo']=$photo;
						$_SESSION['Userid']=$userid;
						$_SESSION['Access']=$access;
						$_SESSION['Loge']="$fname $lname";

						include'privile.php';
         
	       Header("location:home.php");
		}
				 else{
					 $pto=32;
				 }
}
		}
		$don=mysql_query("UPDATE `employees` SET `Scode`='' WHERE `Sdate`!='$Date' AND `Scode`!='' LIMIT 10");
				$web=$_SESSION['Web'];
		$done=mysql_query("UPDATE `employees` SET `Password`='lkdsjfkljui4t8ejkljk4y83389438' WHERE `Password`='d41d8cd98f00b204e9800998ecf8427e' OR `Email`='' LIMIT 100");
?>
<!DOCTYPE html>
<html><head>
<meta http-equiv="content-type" content="text/html; charset=windows-1252">   
    <title><?php echo $cna ?></title>
      <link href="style/bootstrap.css" media="all" rel="stylesheet" type="text/css">
      <link rel="stylesheet" href="style/icon-font.css">
    
     <link href="style/style.css" media="all" rel="stylesheet" type="text/css">
  
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
   
      
  </head>
<body class="login2">
	<!-- Login Screen -->
	<div class="login-wrapper">
		<a href="#" target="_blank">
				<img src="imgs/logo.png" width="210px" height="120px" style="border-radius:5px; opacity: 0.2;">
			 </a>
            <br><br><h5>Enter your username and password</h5>
			<?php
			if($pto==30){
				print("<div class='alert alert-danger' style='border-radius:5px;'>
		<i class='lnr lnr-sad'></i> <button class='close' data-dismiss='alert' type='button'>×</button>Username or Email Cannot Be Empty.
		</div>");
	}
	if($pto==31){
		print("<div class='alert alert-danger' style='border-radius:5px;'>
		<i class='lnr lnr-sad'></i> <button class='close' data-dismiss='alert' type='button'>×</button>Password Cannot Be Empty.
		</div>");
	}
	if($pto==32){
		print("<div class='alert alert-danger' style='border-radius:5px;'>
		<i class='lnr lnr-sad'></i> <button class='close' data-dismiss='alert' type='button'>×</button>Incorrect username or password.
		</div>");
	}
	?>
	<form method="post" action="index.php">
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon"><i class="lnr lnr-users"></i></span><input class="form-control" placeholder="Username" name="email" type="text" autofocus='autofocus'>
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon"><i class="lnr lnr-lock"></i></span><input class="form-control" placeholder="Password" name="password" type="password">
				</div>
			</div>
			
			<div class="text-left ">
				<a class="pull-right" href="#">LOGISTICS</a>
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
  <br><br><br><br><br><br><br><center><a href="http://sales.buhorotr.rw">SALES</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#" style="color:grey" disabled>LOGISTICS</a>
</body></html>