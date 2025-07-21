<?php
include'connection.php';
if(!$_SESSION['Userid'] OR !$_SESSION['Loge']){
	Header("location:index.php");
	exit;
}
 $fname=$_SESSION['Fname'];
 $lname=$_SESSION['Lname'];
 $userid=$_SESSION['Userid'];
	$cna=$_SESSION['Cna'];
	$_SESSION['Page']=basename($_SERVER['PHP_SELF']);
	$pfuquo=$pbuffe=0;

if($_SESSION['Access']!='100900'){
// delete all item from purchase list
if(isset($_POST['delopur']))
		{
		$then=mysql_query("DELETE FROM `stouse` WHERE `ACTION`='PURCHASE' AND `Voucher`='0' LIMIT 1000");
		}

	$puquo=mysql_query("SELECT *FROM `stouse` WHERE `Voucher`!='0' AND `Upda`='0' AND `Status`='0' AND `Action`='PURCHASE' AND `Requis`!='1' GROUP BY `Voucher` ORDER BY `Voucher` ASC");
			$pfuquo+=mysql_num_rows($puquo);
			
	$buffe=mysql_query("SELECT *FROM `items` WHERE `Daily`>'0' AND (`S1`+`S2`+`S3`)<=`Daily` AND `Status`='0' ORDER BY `Number` ASC");
			$pbuffe+=mysql_num_rows($buffe);
}
?>
<!DOCTYPE html>
<html class=""><head>
<meta http-equiv="content-type" content="text/html; charset=windows-1252">
    <title><?php echo $cna ?></title>

	<link rel="shortcut icon" type="image/png" href="imgs/logo.png"/>
    <link href="style/css.css" media="all" rel="stylesheet" type="text/css">
    <link href="style/bootstrap.css" media="all" rel="stylesheet" type="text/css">
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


  <!-- used for show calendar -->
   <script src="style/bootstrap.js" type="text/javascript"></script>
  <script src="style/jquery_002.js" type="text/javascript"></script>
 <!-- ****************************** -->
  
   <script src="style/jquery.js" type="text/javascript"></script>
  <script src="style/datatable-editable.js" type="text/javascript"></script>
  <!-- used for calendar -->
 <script src="Shift_files/jquery_003.js" type="text/javascript"></script>
 <!-- ******************************* -->
  
  <script src="style/bootstrap-fileupload.js" type="text/javascript"></script>
   <script src="style/bootstrap-datepicker.js" type="text/javascript"></script>
   <script src="style/bootstrap-timepicker.js" type="text/javascript"></script>
   <script src="style/jquery_004.js" type="text/javascript"></script>
<script src="style/bootstrap-confirmation.js" type="text/javascript"></script>
<script src="style/popper.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/jquery.table2excel.min.js"></script>

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

 	function disableButton(btn){
				document.getElementById(btn.id).disabled = true;
			}
		</script>
      <script>
	  function toggle() {
	var ele = document.getElementById("toggleText");
	var text = document.getElementById("displayText");
	if(ele.style.display == "block") {
    		ele.style.display = "none";
		text.innerHTML = "";
  	}
	else {
		ele.style.display = "block";
		text.innerHTML = "";
	}
} 

// Submit a form by selecting an option on client
function submitForm(){
    var val = document.myform.client.value;
    if(val!= '0'){
        document.myform.submit();
    }
}

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


	 $(function() 
{
 $( "#search" ).autocomplete({
  source: 'search.php'
 });
});

 $(function() 
{
 $( "#searcho" ).autocomplete({
  source: 'searcho.php'
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
 $( "#searchu" ).autocomplete({
  source: 'searchu.php'
 });
});

 $(function() 
{
 $( "#searchs" ).autocomplete({
  source: 'searchs.php'
 });
});

function cUpper(cObj) 
{
cObj.value=cObj.value.toUpperCase();
}
	   // validate input to be numbers only
	 function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 42 || charCode > 57))
            return false;

         return true;
      }

	  // Number format
	  function format(input)
{
    var nStr = input.value + '';
    nStr = nStr.replace( /\,/g, "");
    var x = nStr.split( '.' );
    var x1 = x[0];
    var x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while ( rgx.test(x1) ) {
        x1 = x1.replace( rgx, '$1' + ',' + '$2' );
    }
    input.value = x1 + x2;
}

// Submit a form by selecting an option on item list
function submitForme(){
    var val = document.myforme.depar.value;
    if(val!= '0'){
        document.myforme.submit();
    }
}

 // Submit a form by selecting an option on employees
function submitFormeo(){
    var val = document.myformes.deparo.value;
    if(val!= '0'){
        document.myformes.submit();
    }
}

 // Submit a form by selecting an option on contract
function submitFormet(){
    var val = document.myforme.depari.value;
    if(val!= '0'){
        document.myforme.submit();
    }
}

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

$(function() {
$("#exporttable").click(function(e){
var table = $("#htmltable");
if(table && table.length){
$(table).table2excel({
exclude: ".noExl",
name: "Excel Document Name",
filename: "Sales Report.xls",
fileext: ".xls",
exclude_img: true,
exclude_links: true,
exclude_inputs: true,
preserveColors: false
});
}
});

});
</script>

  <!-- *************************************************************************** -->
  <style type="text/css">.fancybox-margin{margin-right:0px;}</style>
  
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
z-index: 1;
top:-10px; 
float:center;
height:auto;
        }
    }

.table-hover thead tr:hover th, .table-hover tbody tr:hover td {
background-color: powderblue;
}	 
</style></head>
  <body class="default">

   <div class="divFooter">
   <table width='90%'><tr><td style="padding:0px 5px 0px 20px;" width='20%'>
   <img src="imgs/logo.png" width="120px" height="54px"></td><td align='left'>
<?php echo $cna ?> <br>
Kigali - Rwanda
</td></tr></table>
</div>

<img style="margin-left:50px; position:absolute; top:7%; left:1%;z-index:100000;width:100px; position: fixed;" class="element hidden-print" src="imgs/logo.png" width="120px" height="54px">
</a>
    <div class="modal-shiftfix">
      <!-- Navigation -->
      <div class="navbar navbar-fixed-top scroll-hide" style='height:106px;'>
        <div class="container-fluid top-bar" style='background-color:#0020C2; height:40px;'>
          <div class="pull-right">
            <ul class="nav navbar-nav pull-right">

 <li class="dropdown notifications hidden-xs">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                Office One                </a>
                <ul class="dropdown-menu">
				  <li><a href="#">
                                         	 Create New
                                   </a>
                  </li>
                </ul>
              </li>
			  <?php
			  if($_SESSION['Settings']){
				  ?>
                        <li class="dropdown notifications hidden-xs">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="lnr lnr-cog"></i> Settings
                </a>
                <ul class="dropdown-menu">
                  <li><a href="employees.php">
                    Employees
                      </a>
                  </li>      
				  
				   <li><a href="privileges.php">
                    Privileges
                      </a>
                  </li>  
				  
				  <li><a href="settings.php">
                    Campany
                      </a>
                  </li>  
				                                   </ul>

                 </li>
				 <?php
 }
				 ?>
                 
            <li class="dropdown user hidden-xs"><a data-toggle="dropdown" class="dropdown-toggle" href="#">

         <img src="<?php echo"imgs/images.png" ?>" height="24" width="24" title='<?php echo"$code : $fname $lname"; ?>'>
						 <?php echo $fname ?><b class="caret"></b>

                   </a>
                <ul class="dropdown-menu">
              <li><a href="password.php">
               <i class="lnr lnr-lock"></i>Change Password</a>
              </li>
                <li><?php echo"<a href='vemployee.php?id=$code'>"; ?>
             <i class="lnr lnr-mustache"></i>Your Profile</a>
                  </li>
		<?php
if($acces==1)
	print(" <li><a href='settings.php'>
               <i class='lnr lnr-lock'></i>System Settings</a>
              </li>");
		?>
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
        <div class="container-fluid main-nav clearfix" style='border:0px solid red; background-color:#f9f9f9;'>
          <div class="nav-collapse" style='margin-top:-5px;'>
          <ul class="nav">

<?php
if($_SESSION['Access']!='100900'){
    ?>
              <li style="border: 0px solid black; margin-top:4px;">
                <a <?php echo $co ?> href="home.php">
                <span aria-hidden="true" class="lnr lnr-home"></span>Home</a>
              </li>
		 <?php
				    if($_SESSION['Accusto']=='1'){
						?>
			    <li style="padding-left:5px; padding-right:5px; margin-left:0px; margin-right:0px;"><a <?php echo $pp ?> href="mainsto.php">
                <span aria-hidden="true" class="hightop-forms"><i class="lnr lnr-store"></i></span>Main Store<b class="caret"><?php
                $fuquo=$pfuquo+$pbuffe;
				if($fuquo>0)
	  echo"<span class='badge' style='float:right; font-size:12px; margin-right:0px; margin-top:-30px; height:18px; background-color:#ff66cc; width:auto; text-align:center; color:#ffffff;'> $fuquo </span>";
						?>
				</b></a>
              </li>
			  <?php
			  }
						
		 if($_SESSION['Abra']=='1'){
						?>

			   <li style="padding-left:5px; padding-right:5px; margin-left:0px; margin-right:0px;"><a <?php echo $bb ?> href="branches.php?br=">
                <span aria-hidden="true" class="hightop-forms"><i class="lnr lnr-cart"></i></span>Sales/Payment<b class="caret">
				</b></a>
              </li>
         <?php
						} 
						
						if($_SESSION['Apro']=='1'){
						?>

			    <li style="padding-left:5px; padding-right:5px; margin-left:0px; margin-right:0px;"><a <?php echo $tt ?> href="deposit.php">
                <span aria-hidden="true" class="hightop-forms"><i class="lnr lnr-layers"></i></span>Operations<b class="caret">
				<?php
				if($pfequo)
							echo"<span class='badge' style='float:right; font-size:12px; margin-right:-5px; margin-top:-30px; height:18px; background-color:#F2928C; width:26px;'> 1 </span>";
						?></b></a>
              </li>
			  <?php
						 }
				    if($_SESSION['Acrepo']=='1'){
						?>
                <li style="padding-left:5px; padding-right:5px; margin-left:0px; margin-right:0px;" class="dropdown">
				<a data-toggle="dropdown" <?php echo $cm ?> href="#"><span aria-hidden="true" class="hightop-forms">
				<i class="lnr lnr-calendar-full"></i></span>Reports<b class="caret"></b></a>

                <ul class="dropdown-menu">
			<?php
		if($_SESSION['Xsto']=='1'){
			?>
				 <li>
                    <a class="" href="storeport.php">Store Report</a>
                  </li>
		<?php
				}
		if($_SESSION['Xpay']=='1'){
			?>
					  <li>
                    <a class="" href="suprepo.php">Suppliers Report</a>
                  </li>
			<?php
		}
		if($_SESSION['Xbra']=='1'){
			?>		 
				  	<li>
                    <a class='' href='sarepo.php'>Sales/Payment Report</a>
                  </li>

		<?php
		}
		if($_SESSION['Xcon']=='1'){
			?>

				   <li>
                    <a class="" href="prirepo.php">Customers&nbsp;&nbsp;Report</a>
                  </li>
		<?php
		}
		if($_SESSION['Xpro']=='1'){
			?>
						<li>
                    <a class='' href='deporepo.php'>Operations Report</a>
                  </li>
		<?php
		}
				   ?>
                </ul>
              </li>
			<?php
				}
}
  if($_SESSION['Settings']=='1'){
						?>
                <li style="padding-left:5px; padding-right:5px; margin-left:0px; margin-right:0px;" class="dropdown">
				<a data-toggle="dropdown" <?php echo $cu ?> href="#"><span aria-hidden="true" class="hightop-forms">
				<i class="lnr lnr-cog"></i></span>Settings<b class="caret"></b></a>

                <ul class="dropdown-menu">
                  <li><a href="employees.php">
                    Employees
                      </a>
                  </li>      
				  
				   <li><a href="privileges.php">
                    Privileges
                      </a>
                  </li>  
				  
				  <li><a href="settings.php">
                    Campany
                      </a>
                  </li>  
				                                   </ul>

                 </li>
				 <?php
 }
				 ?>
            
					
						    <li><a href="destroy.php"><span aria-hidden="true">
				<i class="lnr lnr-exit"></i></span>Log Out</a>

                  </li>
                </ul>
              </li>
                
            </ul>
          </div>
        </div>
      </div>
      </div>

	 <?php
	 // Set operation report
if(isset($_POST['store']))
		{
			$_SESSION['Store']=$_POST['store'];
		}
		?>