<?php
include'connection.php';
if(!$_SESSION['Userid']){
	Header("location:index.php");
	exit();
}
 $fname=$_SESSION['Fname'];
 $lname=$_SESSION['Lname'];
 $userid=$_SESSION['Userid'];
 $unames=$_SESSION['Uname'];
	$cna=$_SESSION['Cna'];
	$buto='';

	// ************************* Edit currency rate ***************************
if(isset($_POST['edicur']))
		{
			$c=$_POST['c'];
		while($c>0){
			$nuo=$_POST["code$c"];
			$code=$_POST["wri$c"];
			$rat=$_POST["rat$c"];
			$fna=$_POST["fna$c"];
			$ra=$_POST["pri$c"];
			$rate=str_replace(',', '', $ra);
	$so=mysqli_query($conn, "UPDATE `currency` SET `Code`='$code', `Rate`='$rate' WHERE `Number`='$nuo' ORDER BY `Number` ASC LIMIT 1");	
	        
	$sso=mysqli_query($conn, "UPDATE `baccount` SET `Rate`='$rate' WHERE `Currency`='$code' ORDER BY `Number` ASC LIMIT 30");	
	
	if($rat!=$ra){
	    $act="FROM $rat TO $ra";
	 $set=mysqli_query($conn, "INSERT INTO `moves` (`User`, `Date`, `Time`, `Address`, `Location`, `Desciption`, `Type`) VALUES ('$loge', '$Date', '$Time', '$ip', '$fna', '$act', 'RATE')");
	}
			$c--;
		}
			$pto=12503;
		}

$dase = strtotime("-125 days", strtotime("$Date"));
        $dase = date ("Y-m-d", $dase);
?>
<!DOCTYPE html>
<html class=""><head>
<meta http-equiv="content-type" content="text/html; charset=windows-1252">
    <title>   <?php echo $cna ?>    </title>

	<link rel="shortcut icon" type="image/png" href="imgs/logo.png"/>
    <link href="style/css.css" media="all" rel="stylesheet" type="text/css">
    <link href="style/bootstrap.css" media="all" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="style/icon-font.css">
    <link href="style/jquery.css" media="all" rel="stylesheet" type="text/css">
    <link href="style/fullcalendar.css" media="all" rel="stylesheet" type="text/css">
    <link href="style/datatables.css" media="all" rel="stylesheet" type="text/css">
    <link href="style/datepicker.css" media="all" rel="stylesheet" type="text/css">
    <link href="style/timepicker.css" media="all" rel="stylesheet" type="text/css">
    <link href="style/style.css" media="all" rel="stylesheet" type="text/css">
    <!-- for mark_leave date design -->
    <link href="style/jquery-ui.css" media="all" rel="stylesheet" type="text/css">
    <!-- *********************************************************** -->

    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
    <script src="style/jquery-1.js" type="text/javascript">  </script>
     <!-- for mark_leave date  -->
  <script src="style/jquery-ui.js" type="text/javascript"></script>
  <script src="style/jquery.min.js"></script>
  <script src="style/jquery-ui.min.js"></script>

  <!-- *************************************************************************** -->

		<!-- *************************************************** -->
  
  <script type="text/javascript">
	var lastDiv = "";
 function showDiv(divName) {
 // hide last div
 if (lastDiv) {
 document.getElementById(lastDiv).className = "hiddenDiv";
 }
 //if value of the box is not nothing and an object with that name exists, then change the class
 if (divName && document.getElementById(divName)) {
 document.getElementById(divName).className = "visibleDiv";
 lastDiv = divName;
 }
 }
 
 	var lastDive = "";
 function showDive(diveName) {
 // hide last div
 if (lastDive) {
 document.getElementById(lastDive).className = "hiddenDive";
 }
 //if value of the box is not nothing and an object with that name exists, then change the class
 if (diveName && document.getElementById(diveName)) {
 document.getElementById(diveName).className = "visibleDive";
 lastDive = diveName;
 }
 }
 
 </script>

				 <script>
				 $(document).ready(function () {
$('#dtVerticalScrollExample').DataTable({
"scrollY": "200px",
"scrollCollapse": false,
});
$('.dataTables_length').addClass('bs-select');
});

$(document).ready(function () {
$('#dtDynamicVerticalScrollExample').DataTable({
"scrollY": "50vh",
"scrollCollapse": true,
});
$('.dataTables_length').addClass('bs-select');
});
</script>

<script>  
 $(document).ready(function(){  
      $('#create_excel').click(function(){  
           var excel_data = $('#excel_table').html();  
           var page = "excel.php?data=" + excel_data;  
           window.location = page;  
      });  
 });
 
 

// Submit a form by selecting an option on client
function submitForm(){
    var val = document.myform.client.value;
    if(val!= '0'){
        document.myform.submit();
    }
}
 </script>
 
 <script>
function exportTableToExcel(tableID, filename = ''){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+'.xls':'excel_data.xls';
    
    // Create download link element
    downloadLink = document.createElement("a");
    
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
}
</script>

 <script>

	var lastDiv = "";
 function showDiv(divName) {
 // hide last div
 if (lastDiv) {
 document.getElementById(lastDiv).className = "hiddenDiv";
 }
 //if value of the box is not nothing and an object with that name exists, then change the class
 if (divName && document.getElementById(divName)) {
 document.getElementById(divName).className = "visibleDiv";
 lastDiv = divName;
 }
 }
 
 $(function() {
$("#exporttable").click(function(e){
var table = $("#htmltable");
if(table && table.length){
$(table).table2excel({
exclude: ".noExl",
name: "Excel Document Name",
filename: "Excel Report.xls",
fileext: ".xls",
exclude_img: true,
exclude_links: true,
exclude_inputs: true,
preserveColors: false
});
}
});

});

function myFunction() {
  var x = document.getElementById("myDIV");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}

function sum() {
            var num1 = document.getElementById('box1').value;
            var num2 = document.getElementById('box2').value;
            var num3 = document.getElementById('box3').value;

    var use = (parseFloat(num1) / 100 * parseFloat(num2)) / parseFloat(num3);
            if (!isNaN(use)) {
                document.getElementById('paid').value = use;
            }
    
    var uss = parseFloat(num1) / parseFloat(num3);
            if (!isNaN(uss)) {
                document.getElementById('pay').value = uss;
            }
    
    var usc = ((parseFloat(num1) / 100 * parseFloat(num2)) / parseFloat(num3)) + (parseFloat(num1) / parseFloat(num3));
             if (!isNaN(usc)) {
                document.getElementById('all').value = usc;
            }
        }
        
    // Submit a form by selecting an option on client
function submitForm(){
    var val = document.myform.empo.value;
    if(val!= '0'){
        document.myform.submit();
    }
} 

 $(function() 
{
 $( "#search" ).autocomplete({
  source: 'search.php'
 });
});

$(function() 
{
 $( "#searcha" ).autocomplete({
  source: 'searcha.php'
 });
});

 $(function() 
{
 $( "#searche" ).autocomplete({
  source: 'searche.php'
 });
});

 $(function() 
{
 $( "#searchi" ).autocomplete({
  source: 'searchi.php'
 });
});

 $(function() 
{
 $( "#searchis" ).autocomplete({
  source: 'searchi.php'
 });
});

 $(function() 
{
 $( "#searcha" ).autocomplete({
  source: 'searcha.php'
 });
});

 $(function() 
{
 $( "#searchu" ).autocomplete({
  source: 'searchu.php'
 });
}); 


$(function() 
{
 $( "#csearchs" ).autocomplete({
  source: 'csearchs.php'
 });
});
        
 </script>

  <style type="text/css">.fancybox-margin{margin-right:0px;}</style>

   <style type="text/css" media="screen">
 .hiddenDiv {
 display: none;
 }
 .visibleDiv {
 display: block;
 border: 1px grey solid;
 margin-top: 5px;
  margin-bottom: 0px;
   padding-top: 5px;
    padding-bottom: 5px;
 }
 
 .hiddenDive {
 display: none;
 }
 .visibleDive {
 display: block;
 border: 1px grey solid;
 margin-top: 5px;
  margin-bottom: 0px;
   padding-top: 5px;
    padding-bottom: 5px;
 }
 </style>

 <style>
			.table-hover thead tr:hover th, .table-hover tbody tr:hover td {
    background-color: powderblue;
}
</style>
  
  <style type="text/css">
        .dollars:before {  }
    </style>
    <style type="text/css">

 @media (max-width: 50em) {
.element {
display: none;
}
  }

@media (min-width: 49em) {
.mobile {
display: none;
}
  }
</style>

<style type="text/css">
    @media screen {
        div.divFooter {
            display: none;
        }
    }
    @media print {
        div.divFooter {
    position: relative;
margin:-5px 10px 0px 40px; 
float:center;
height:auto;
        }
    }
	 
</style></head>
   <div class="divFooter">
   <table width='90%'><tr><td style="padding:0px 5px 0px 20px;" width='20%'>
   <img src="imgs/logo.png" width="120px" height="54px"></td><td align='left'>
<?php echo $cna ?> <br><?php echo"$pho1 &nbsp;&nbsp; &nbsp;&nbsp; $pho2"; ?> <br> TIN/VAT: <?php echo $tax ?>
</td></tr></table>
</div>
  <body class="default">

<img style="margin-left:50px; position:absolute; top:7%; left:1%;z-index:100000; position: fixed;" class="element hidden-print hidden-sm hidden-xs" src="imgs/logo.png" width="120px" height="54px">

    <div class="modal-shiftfix">
      <!-- Navigation -->
      <div class="navbar navbar-fixed-top scroll-hide" style='height:106px;'>
        <div class="container-fluid top-bar" style='background-color:#0020C2; height:40px;'>
          <div class="pull-right">
            <ul class="nav navbar-nav pull-right">
                <?php
    $gio=mysqli_query($conn, "SELECT `Rate` FROM `currency` WHERE `Code`='USD' ORDER BY `Number` ASC");
		$rio=mysqli_fetch_assoc($gio);
		    $rase=$rio['Rate'];
		$rate=number_format($rase);
			?>

    <li class="dropdown notifications hidden-xs" style="margin-top:-10px;">
                <a class="dropdown-toggle" href="#" data-toggle="modal" data-target="#modal-xi1020"> Exchange Rate 
       <span class='badge hidden-print hidden-xs' style='font-size:12px; width:50px; border-radius:10px; margin-top:-3px; height:18px; background-color:#F88220; text-align:center; color:#ffffff; margin-left:20px;'> <?php echo $rate ?></span></a>
              </li>
			  <?php
			  if($_SESSION['Setings']){
				  ?>
                        <li class="dropdown notifications hidden-xs">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="lnr lnr-cog"></i> Settings
                </a>
                <ul class="dropdown-menu">      
		 <?php
			  if($_SESSION['Access']=='ADMINISTRATOR'){
				  ?>
				  
				  <li><a href="settings.php">
                   Campany info
                      </a>
                  </li> 
                  <li><a href="users.php">
                    System Users
                      </a>
                  </li> 
				   <li><a href="privileges.php">
                    User Privileges
                      </a>
                  </li>
				  <?php
				  }
				  ?>
                  
				                                   </ul>

                 </li>
				 <?php
 }
				 ?>
                 
            <li class="dropdown user hidden-xs"><a data-toggle="dropdown" class="dropdown-toggle" href="#" class="hidden xs">

         <img src="<?php echo"imgs/images.png" ?>" height="24" width="24" title="<?php echo"$code : $fname $lname"; ?>">
						 <?php echo $fname ?><b class="caret"></b>

                   </a>
                <ul class="dropdown-menu">
              <li><a href="password.php">
               <i class="lnr lnr-lock"></i>Change Password</a>
              </li>
                <li><?php echo"<a href='vemployee.php?id=$userid'>"; ?>
             <i class="lnr lnr-mustache"></i>Your Profile</a>
                  </li>
              <li><a href="destroy.php">
                    <i class="lnr lnr-power-switch"></i>Logout</a>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
          
          <button class="navbar-toggle"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
          <a class="logo" href="#">
       <?php echo $cna ?></a>
        </div>
       <div class="container-fluid main-nav clearfix">
          <div class="nav-collapse" style='margin-top:-5px;'>
          <ul class="nav">

              <li style="border: 0px solid black; margin-top:4px;">
                <a <?php echo $co ?> href="home.php">
                <span aria-hidden="true" class="lnr lnr-home"></span>Home</a>
              </li>
              
			   <?php
            // if($_SESSION['Empopa'])
                $ps='employees.php';
            // else
            //    $ps='#';
             ?>

              
             <li class="dropdown"><a data-toggle="dropdown" <?php echo $py ?> href="#">
                <span aria-hidden="true" class="hightop-forms"><i class="lnr lnr-briefcase"></i></span>Resources<b class="caret"></b></a>
<ul class="dropdown-menu">
        <?php
         //   if($_SESSION['Empopa']){
                 ?>
                     <li><a href="<?php echo $ps ?>">
                <i class="lnr lnr-users"></i>Employees</a>
              </li>
              
              <?php
         //    }
   //     if($_SESSION['Payro']){
            ?>
                                      <li>
                    <a class="" href="slips.php"><i class="lnr lnr-diamond"></i>Payrolls</a>
                  </li>
				  
				    <li>
                    <a class="" href="dlist.php"><i class="lnr lnr-thumbs-down"></i>Deduction</a>
                  </li>

				   <li>
                    <a class="" href="alist.php"><i class="lnr lnr-thumbs-up"></i>Allowance</a>
                  </li>

				   <li>
                    <a class="" href="plist.php"><i class="lnr lnr-chart-bars"></i>Payments</a>
                  </li>

				   <li>
                    <a class="" href="conte.php"><i class="lnr lnr-book"></i>Contribute</a>
                  </li>
 <?php
	//		 }
			 ?>
                </ul>
              </li>

           
              
              <?php
             //  if($_SESSION['Alogi'])
			 $roll="data-toggle='dropdown'";
		//	 else
		//	 $roll="";
			 ?>
			  
 <li class="dropdown"><a <?php echo $roll ?> <?php echo $nv ?> href="#">
                <span aria-hidden="true" class="hightop-forms"><i class="lnr lnr-apartment"></i></span>Logistics<b class="caret"></b></a>

                <ul class="dropdown-menu">
                  <li>
                    <a href="ment.php"><i class="lnr lnr-bus"></i>Vehicles</a>
                  </li>
                   <li>
                    <a href="store.php"><i class="lnr lnr-layers"></i>Materials</a>
                  </li>
                   <li>
                    <a href="boxrepo.php"><i class="lnr lnr-briefcase"></i>CashBox</a>
                  </li>
                </ul>
              </li>

                         
                                           
                <li class="dropdown">
                    <a data-toggle="dropdown" <?php echo $cm ?> href="#">
                <span aria-hidden="true" class="hightop-forms">
    <i class="lnr lnr-calendar-full"></i></span>Reports<b class="caret"></b></a>

                <ul class="dropdown-menu">
			 <?php
        if($_SESSION['Payrepo'])
                $pl='rollrepo.php';
             else
                $pl='#';
                ?>
					  <li>
                    <a class="" href="<?php echo $pl ?>">Payroll Report</a>
                  </li>
			 <?php
        if($_SESSION['Avr']){
                $mx="#modal-xy1020";
                $ms="starepo.php";
        }
             else
                $mx=$ms='#';
                ?>

                  <li>
                    <a class="dropdown-toggle" href="#" data-toggle="modal" data-target="<?php echo $mx ?>">Vehicles Report</a>
                  </li>

					  <li>
                    <a class="" href="<?php echo $ms ?>">Stations Report</a>
                  </li>
			 <?php
        if($_SESSION['Avt'])
                $tpr="triprepo.php";
             else
                $tpr='#';
                ?>
					  <li>
                    <a class="" href="<?php echo $tpr ?>">Trip Report</a>
                  </li>
			 <?php
        if($_SESSION['Asr'])
                $str="storepo.php";
             else
                $str='#';
                ?>
					  <li>
                    <a class="" href="<?php echo $str ?>">Store Report</a>
                  </li>

                </ul>
              </li>
              
              <?php
			 if($_SESSION['Settings'])
			 $sett="data-toggle='dropdown'";
			 else
			 $sett="";
				?>

			   <li class="dropdown"><a <?php echo $sett ?> <?php echo $st ?> href="#">
                <span aria-hidden="true" class="hightop-forms"><i class="lnr lnr-cog"></i></span>Settings<b class="caret"></b></a>
                
                <ul class="dropdown-menu">
                   <li>
                    <a href="users.php"><i class="lnr lnr-users"></i>System Users</a>
                  </li>
                   <li>
                    <a href="privileges.php"><i class="lnr lnr-pencil"></i>User Privileges</a>
                  </li>
                  <li>
                    <a href="settings.php"><i class="lnr lnr-cog"></i>System Settings</a>
                  </li>
                </ul>
                
            </li>    

              <li style="border: 0px solid black; margin-top:4px;">
                <a href="destroy.php">
                <span aria-hidden="true" class="lnr lnr-exit"></span>Log Out</a>
              </li>
                
            </ul>
          </div>
        </div>
      </div>
      </div>


















	  



	   <div id="myModo" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times-circle" aria-hidden="true"></i></button>

                <h4 class="modal-title" id="myModalLabel">&nbsp;&nbsp;&nbsp;<i class="fa fa-bars"></i> Create New Item </h4>

            </div>

            <div class="modal-body">

                
                <!-- Email Logins-->

                

                <form action="" method="post" enctype='multipart/form-data'>

                     <div class="row">

                        <div class="col-sm-6" style="padding-top:7px; font-weight:bold;">

                           &nbsp; <i class="fa fa-user"></i> Item Name
                        </div><div class="col-sm-6" style="padding-top:7px; font-weight:bold;">

                           &nbsp; <i class="fa fa-puzzle-piece"></i> Item Type
                        </div>

                        <div class="col-sm-6">

                            <input type="text" class="form-control" name="item" style="font-size:16px; height:38px;" required>

                        </div>

						<div class="col-sm-6">

                            <select class="form-control" name="itype" style="font-size:16px; height:38px;" required>	
							<option value=''> Select Type </option>

							<?php
		$tee=mysqli_query($conn, "SELECT `Number`, `Type` FROM `itype` WHERE `Type`!='' AND `Location`='1' ORDER BY `Number` ASC");
			while($reo=mysqli_fetch_assoc($tee)){
				$no=$reo['Number'];
				$type=$reo['Type'];
				echo"<option value='$type'> $type </option>";
			}
				?>
							</select>

                        </div>




						<div class="col-sm-6" style="padding-top:7px; font-weight:bold;">

                           &nbsp; <i class="fa fa-money"></i> Item Price
                        </div><div class="col-sm-6" style="padding-top:7px; font-weight:bold;">

                           &nbsp; <i class="fa fa-bell"></i> Item Label
                        </div>

                        <div class="col-sm-6">

             <input type="text" class="form-control text-center" name="iprice" style="font-size:16px; height:38px;" onkeyup="format(this);" value="0" required>

                        </div>

						<div class="col-sm-6">

                             <select class="form-control" name="ilabel" style="font-size:16px; height:38px;" required>	
							<option value=''> Select Label </option><option value='Fixed Asset'> Fixed Asset </option>
							<option value='Variable Asset'> Variable Asset </option></select>

                        </div>

                     </div>

                     <br>

                     <div class="row">

                        <div class="col-sm-6" style="padding-top:7px;font-weight:bold;">

                            &nbsp; <i class="fa fa-id-card-o"></i> Description
                        </div><div class="col-sm-4" style="padding-top:7px;font-weight:bold;">

                            &nbsp; <i class="fa fa-id-card-o"></i> Picture 
                        </div>

                        <div class="col-sm-6">

                            <textarea placeholder="Item description here..." class="form-control" rows="4" name="idescri"></textarea>

                        </div>

						  <div class="col-md-4 text-center"><hr><input name='files' id='app_file' type='file' readonly='readonly' required><hr>
						
                     
              </div>

                     </div>

                                          
                     <br>

                     <div class="row">

                        <div class="col-sm-12" style="text-align:center"><hr>

                           
                     <button class="view-listing-button" type="submit" name="creati" style="border:1px solid #99ccff; width:240px; float:center; height:30px; border-radius:5px; font-size:18px;"><i class="fa fa-check-square-o"></i> &nbsp; Save  </button>
                        </div>

                     </div>

                </form>

            </div>

            <div class="modal-footer" style="color:#ccc; text-align:center;"> Please fill the form bellow in order to create a new item

            </div>

        </div>

        <!-- /.modal-content -->

    </div>

    <!-- /.modal-dialog -->

</div>

<?php
if(isset($_POST['creati']))
			{
			$item=str_replace("'", "`", $_POST['item']);
			$itype=$_POST['itype'];
			$iprice=str_replace(',', '', $_POST['iprice']);
			$ilabel=$_POST['ilabel'];
			$idescri=str_replace("'", "`", $_POST['idescri']);			

/*
$temp = explode(".", $_FILES["files"]["name"]);
$newfilename = round(microtime(true)) . '.' . end($temp);
move_uploaded_file($_FILES["files"]["tmp_name"], "images/" . $newfilename);
*/

$then=mysqli_query($conn, "INSERT INTO `items` (`Type`, `Item`, `Price`, `Quantity`, `Label`, `Descri`, `Status`) VALUES ('$itype', '$item', '$iprice', '0', '$ilabel', '$idescri', '0')");
			}
			?>





	<div id="myModos" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times-circle" aria-hidden="true"></i></button>

                <h4 class="modal-title" id="myModalLabel">&nbsp;&nbsp;&nbsp;<i class="fa fa-bars"></i> Store Consumption </h4>

            </div>

            <div class="modal-body">

                
                <!-- Email Logins-->

                

                <form action="" method="post" enctype='multipart/form-data'>

                     <div class="row">

                        <div class="col-sm-8" style="padding-top:7px; font-weight:bold;">

                           &nbsp; <i class="fa fa-user"></i> Item Name
                        </div><div class="col-sm-4" style="padding-top:7px; font-weight:bold;">

                           &nbsp; <i class="fa fa-puzzle-piece"></i> Quantity
                        </div>

                        <label class="control-label col-sm-8">

     <input type="text" class="form-control" name="ites" style="font-size:16px; height:38px;" list="item" required><datalist style="border:1px solid blue; " id="item">
<?php
$do=mysqli_query($conn, "SELECT `Item` FROM `items` WHERE `Status`='0' ORDER BY `Item` ASC");
		while($ro=mysqli_fetch_assoc($do)){
			$iname=$ro['Item'];
			echo"<option value='$iname'></option>";
		}
		?>
		</datalist>


</label>
                       

						<div class="col-sm-4">

       <input type="text" class="form-control text-center" name="qts" style="font-size:16px; height:38px;" onkeyup="format(this);" value="1" onfocus="this.value=''" required>

                        </div>

</div>


						

                     <div class="row">

                        <div class="col-sm-6" style="padding-top:7px;font-weight:bold;">

                            &nbsp; <i class="fa fa-id-card-o"></i> Description
                        </div><div class="col-sm-4" style="padding-top:7px;font-weight:bold;">

                            &nbsp; 
                        </div>

                        <div class="col-sm-12">

                            <textarea placeholder="Write description here..." class="form-control" rows="4" name="des"></textarea>

                        </div>

						 

                     </div>

                                          
                     <br>

                     <div class="row">

                        <div class="col-sm-12" style="text-align:center;"><hr>

                           
                     <button class="view-listing-button" type="submit" name="used" style="border:1px solid #99ccff; width:240px; float:center; height:30px; border-radius:5px; font-size:18px;"><i class="fa fa-check-square-o"></i> &nbsp; Save  </button>
                        </div>

                     </div>

                </form>

            </div>


        </div>

        <!-- /.modal-content -->

    </div>

    <!-- /.modal-dialog -->

</div>



<?php
if(isset($_POST['used']))
			{
			$ite=str_replace("'", "`", $_POST['ites']);
			$qts=str_replace(',', '', $_POST['qts']);
			$des=str_replace("'", "`", $_POST['des']);			

	if($qts){
$do=mysqli_query($conn, "SELECT *FROM `items` WHERE `Status`='0' AND `Item`='$ite' ORDER BY `Number` DESC");
if($fo=mysqli_num_rows($do)){
		$ro=mysqli_fetch_assoc($do);
			$ites=$ro['Number'];
			$pris=$ro['Price'];

$rece=mysqli_query($conn, "SELECT `Voucher` FROM `stouse` WHERE `Voucher`!='0' ORDER BY `Voucher` DESC LIMIT 1");
				$re=mysqli_fetch_assoc($rece);
					$vou=$re['Voucher']+1;

$so=mysqli_query($conn, "INSERT INTO `stouse` (`Date`, `User`, `Item`, `Quantity`, `Price`, `Destin`, `Action`, `Voucher`, `Status`, `Store`) VALUES ('$Date', '$loge', '$ites', '$qts', '$pris', '$des', 'USED', '$vou', '0', '1')");
	$doin=mysqli_query($conn, "UPDATE `items` SET `Quantity`=`Quantity`-'$qts' WHERE `Number`='$ites' ORDER BY `Number` DESC LIMIT 1");

	print("<div class='alert alert-info' style='border-radius:5px; text-align:center; font-size:22px; padding:2px;'>
		<i class='lnr lnr-checkmark-circle'></i> <button class='close' data-dismiss='alert' type='button' style='margin:2px;'>&times;</button><b>$ite</b> has been removed from your store.
		</div>");
}
else{
	print("<div class='alert alert-danger' style='border-radius:5px; text-align:center; font-size:22px; padding:2px;'>
		<i class='lnr lnr-sad'></i> <button class='close' data-dismiss='alert' type='button' style='margin:2px;'>&times;</button>Item not found, please try again.
		</div>");
}

				}
			}
			
			

		
		$do=mysqli_query($conn, "SELECT `Number` FROM `vehicles` WHERE `Status`='0' AND `Trip`='0' ORDER BY `Number` ASC LIMIT 400");
		        $fo=mysqli_num_rows($do);
		
		$dos=mysqli_query($conn, "SELECT `Number` FROM `vehicles` WHERE `Status`='0' AND `Trip`='1' ORDER BY `Number` ASC LIMIT 400");
		        $fos=mysqli_num_rows($dos);
		        
		        if($_SESSION['Aiv'])
		            $intel="verepo.php";
		        else
		            $intel="#";
		      
		      if($_SESSION['Alv'])
		            $loco="verepos.php";
		        else
		            $loco="#";
		
// **************************** Vehicle report separation *********************
echo"<div id='modal-xy1020' class='modal fade' role='dialog' style='top:80px;'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLabel'> VEHICLE SELECTION </h5>

      </div><form method='post' action=''>
      <div class='modal-body' style='height:180px;'>
      
      <div class='col-xs-6'>
      <button type='button' class='btn btn-lg btn-block btn-info' style='height:80px; margin-top:20px;' data-toggle='tooltip' data-placement='top' onclick=window.location.href='$intel'><i class='lnr lnr-bus' style='top:0px; position:absolute; color:blue; margin-left:20px;'></i><span class='badge' style='float:right; right:20px; top:2px; position: absolute; font-size:12px; padding:5px 20px 5px 20px;'> $fos Vehicles </span><font style='font-weight:bold; font-size:18px;'> TRANSIT VEHICLES </font></button>
				
		</div><div class='col-xs-6'>
		<button type='button' class='btn btn-lg btn-block btn-success' style='height:80px; margin-top:20px;' data-toggle='tooltip' data-placement='top' onclick=window.location.href='$loco'><i class='lnr lnr-car' style='top:0px; position:absolute; color:blue; margin-left:20px;'></i><span class='badge' style='float:right; right:20px; top:2px; position: absolute; font-size:12px; padding:5px 20px 5px 20px;'> $fo Vehicles </span><font style='font-weight:bold; font-size:18px;'> LOCAL TRANSPORT </font></button>
		
		</div>
      
      </div></div></div></div>";
      
	if($_SESSION['Arat']){	
		// ********************************************** Set Rate Modal **************************************
echo"<div id='modal-xi1020' class='modal fade' role='dialog' style='top:-20px;'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLabel'> RATE SETTINGS </h5>

      </div><form method='post' action=''>
      <div class='modal-body' style='height:auto;'><table class='table-hover' width='90%'>
	  <tr><th>&nbsp;&nbsp;&nbsp;&nbsp; Currency Name </th><th class='text-center'> Code </th><th class='text-center'> Rate </th></tr>";
			$c=1;
	  $gio=mysqli_query($conn, "SELECT *FROM `currency` ORDER BY `Number` ASC");
		while($rio=mysqli_fetch_assoc($gio)){
			$fname=$rio['Name'];
			$prio=number_format($rio['Rate'], 2);
			$wrio=$rio['Code'];
			$code=$rio['Number'];
	echo"<tr style='height:20px;'><td width='60%' style='color:#000000; padding-left:40px; padding-top:5px;'> $fname </td>

	<td style='text-align:right;'><input type='hidden' name='code$c' value='$code'>
	<input name='wri$c' class='form-control' type='text' style='text-align:left; width:90px; height:20px; margin:0px 0px 0px 0px; padding:0px 0px 0px 10px;' value='$wrio' OnKeyup='return cUpper(this);' onChange=this.style.color='#ff3366'> </td>

	<td style='text-align:right;' width='20%'>
	<input type='hidden' name='code$c' value='$code'>
	<input type='hidden' name='rat$c' value='$prio'>
	<input type='hidden' name='fna$c' value='$wrio'>
	<input name='pri$c' class='form-control' type='text' onkeyup='format(this);' onkeypress='return isNumberKey(event)' style='text-align:right; width:90px; height:20px; margin:0px 0px 0px 0px; padding:0px 10px 0px 0px;' value='$prio' onChange=this.style.color='#ff3366'> </td></tr>";
			$c++;
		}
		if($_SESSION['Arat']=='1')
		$bso='submit';
		else
		$bso='submit';
      echo"</table></div>
      <div class='modal-footer' style='margin-top:-30px; height:80px; padding-top:0px; border:0px solid blue;'><hr><input type='hidden' name='c' value='$c'>
	   <button type='button' class='btn btn-sm btn-warning' data-dismiss='modal' style='width:120px;'>&nbsp;CANCEL&nbsp;</button>
        <button type='$bso' name='edicur' class='btn btn-sm btn-success' style='width:120px;'>&nbsp;UPDATE&nbsp;</button>
      </div></form>
    </div>
  </div>
</div>";
}
// *************************************************** End of Modal ************************************************************
			
			if($_SESSION['Cancel'])
			    $disa='';
			else
			    $disa="disabled";
			?>