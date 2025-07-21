    <!doctype html>
    <html>
    <head lang="en">
    <meta charset="utf-8">
    <title>Ajax File Upload with jQuery and PHP</title>
    <link rel="stylesheet" href="style.css" type="text/css" />
    <script type="text/javascript" src="js/jquery-1.11.3-jquery.min.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    </head>
    <body>
    <div class="container">
    <div class="row">
    <div class="col-md-8">
    <h1><a href="#" target="_blank"><img src="logo.png" width="80px"/>Ajax File Uploading with Database MySql</a></h1>
    <hr> 
    <form id="form" action="uploads.php" method="post" enctype="multipart/form-data">
    <div class="form-group">
    <label for="name">NAME</label>
    <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" required />
    </div>
    <div class="form-group">
    <label for="email">EMAIL</label>
    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required />
    </div>
    <input id="uploadImage" type="file" accept="image/*" name="file" />
    <div id="preview"><img src="filed.png" /></div><br>
    <input class="btn btn-success" type="submit" value="Upload" name="send">
    </form>
    <div id="err"></div>
    <hr>
    <p><a href="https://www.cloudways.com" target="_blank">www.Cloudways.com</a></p>
    </div>
    </div>
    </div></body></html>
<?php
$dbHost = 'localhost';
$dbUsername = 'camel';
$dbPassword = 'QlK76dTRJwofXYpw';
$dbName = 'camellia';
//Create connection and select DB
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
if($db->connect_error){
   die("Unable to connect database: " . $db->connect_error);
}

if(isset($_POST['send']))
		{
			$namo=$_POST['name'];
			$email=$_POST['email'];

$name = $_FILES['file']['name'];
$size = $_FILES['file']['size'];
$type = $_FILES['file']['type'];
$tmp_name = $_FILES['file']['tmp_name'];
$extension = substr($name, strpos($name, '.') + 1);
if(!empty($name)){
	//if(($extension == "jpg" || $extension == "jpeg") && $type == "image/jpeg" && $extension == $size<=$max_size){
			$location = "uploads/";
		if(move_uploaded_file($tmp_name, $location.$name)){
			$smsg = "Uploaded Successfully";
		}else{
			$fmsg = "Failed to Upload File";
		}
}
else{
	$fmsg = "Please Select a File";
}


$query = "INSERT INTO `uploads` (Name, Email, Upload) VALUES ('$namo', '$email', '$location$name')";
$result = mysqli_query($db, $query);


}
?>


<?php if(isset($smsg)){ ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div><?php } ?>
<?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>
