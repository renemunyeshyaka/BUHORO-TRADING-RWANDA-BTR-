<?php
include'connection.php';
session_start();
if(isset($_POST['forgot_pass']))
	{
    $email=$_POST['email'];

if($email=='')
	$pto=30;
else{
$do=mysql_query("SELECT *FROM `employees` WHERE `Email`='$email'");
	$fo=mysql_num_rows($do);
		if(!$fo)
			$pto=31;
		else{
$ro=mysql_fetch_assoc($do);
	$eid=$ro['Eid'];
	
		$ai = mt_rand(100000,999999); 
		$a = number_format($ai, 0, '', '-');
		$ax = number_format($ai, 0, '', ' ');

		$don=mysql_query("UPDATE `employees` SET `Scode`='$a', `Sdate`='$Date' WHERE `Eid`='$eid' LIMIT 1");

    $message = "Here is your Security Code : $a";

  $to = $email;
$subject = "Security Code";
$txt = $message;
$headers = "From: webmaster@example.com" . "\r\n" .
"CC: karaixte@gmail.com";

mail($to,$subject,$txt,$headers);

	$_SESSION['Co']=60;

	 Header("location:preset.php");
}
  
		}
}
	

?>
<!DOCTYPE html>
<html><head>
<meta http-equiv="content-type" content="text/html; charset=windows-1252">   
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
		<a href="#" target="_blank">
				<img src="imgs/logo.png" width="120px" height="63px" class="element">
			 </a>
      <h2>Forgot Password</h2>

	  <?php
			if($pto==30){
				print("<div class='alert alert-danger' style='border-radius:5px;'>
		<i class='lnr lnr-sad'></i> <button class='close' data-dismiss='alert' type='button'>×</button>Your Email Cannot Be Empty.
		</div>");
	}
	if($pto==31){
		print("<div class='alert alert-danger' style='border-radius:5px;'>
		<i class='lnr lnr-sad'></i> <button class='close' data-dismiss='alert' type='button'>×</button>The Email you entered is not recorded.
		</div>");
	}
	if($pto==32){
		print("<div class='alert alert-danger' style='border-radius:5px;'>
		<i class='lnr lnr-sad'></i> <button class='close' data-dismiss='alert' type='button'>×</button>Incorrect username or password.
		</div>");
	}
	if($pto==60){
		print("<div class='alert alert-danger' style='border-radius:5px;'>
		<i class='lnr lnr-sad'></i> <button class='close' data-dismiss='alert' type='button'>×</button>Operation did not succeed, Please try again.
		</div>");
	}
	?>          
              <form method="post" action="forgot.php">
      <!-- <input type="hidden" name="setting_ip" value="0c50d5ef8dfa7832c40f51cd30d41ea4be8089e89fc9718ecf94991ce1902dddb49df8eb3d0de0debe139c8c5312b1a2b17eaeaa572d9cf4345eae9b4f15c64a78ff66b1da44aebb66f05e73b86011ce0cd898019fd5b45d52f731c486df068076b37a89f20c704b94851b7062099a90069ed33a3b5cfc8e888b522db005bd4c78336840a6f50b383c84318fd47191d0da3680ef197.157.155.230FirefoxUnknown OS Platform"> -->
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon"><i class="lnr lnr-envelope"></i></span>
            <input class="form-control" placeholder="Email" name="email" type="text" autofocus='autofocus'>
          </div>
        </div>
       <!-- <input class="btn btn-lg btn-primary btn-block" name="forgot_pass" type="submit" value="Submit"> -->
       <button class="btn btn-lg btn-primary btn-block" name="forgot_pass" type="submit"><i class="lnr lnr-checkmark-circle"></i> Submit</button>
        </form>
                
                
        
     <div class="text-left checkbox">
				<a class="pull-right" href="index.php">Back To Login</a>
			</div></div>
    <!-- End Login Screen -->
    <script src="style/jquery-1.js" type="text/javascript">  </script>
    <script src="style/bootstrap.js" type="text/javascript"></script>
  
</body></html>