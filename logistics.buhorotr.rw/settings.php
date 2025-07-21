<?php 
if(basename($_SERVER['PHP_SELF']) == 'settings.php') {
  $st=" class='current'";
} else {
  $st="";
} 
include'header.php';
?>

<div class="container-fluid main-content">
<div class="page-title hidden-print" style="height:40px;">
        <h1>Settings</h1>
		
    </div>  <div class="row">
  <div class="col-lg-6 hidden-print pull-right" style="margin-top:-40px;"> 

   <div class="col-lg-5">  </div>

		 <div class="col-lg-2">
		 <?php
			  if($_SESSION['Settings']){
				  ?><button class="btn btn-success btn-block btn-sm" type="button" data-toggle="modal" data-target="#stationModal">
						<i class="lnr lnr-laptop-phone"></i> Set Stations </button>
						<?php
		 }
				  ?></div>

				   <div class="col-lg-2">
		 <?php
			  if($_SESSION['Settings']){
				  ?><button class="btn btn-info btn-block btn-sm" type="button" data-toggle="modal" data-target="#serviceModal">
						<i class="lnr lnr-laptop-phone"></i> Set Services </button>
						<?php
		 }
				  ?></div>
				  
				   <div class="col-lg-2">
		 <?php
			  if($_SESSION['Settings']){
				  ?><button class="btn btn-warning btn-block btn-sm" type="button" data-toggle="modal" data-target="#postModal">
						<i class="lnr lnr-laptop-phone"></i> Set Positions </button>
						<?php
		 }
				  ?></div>
  
  </div>
<?php
		// Delete a given station record
if(isset($_POST['delo']))
		{
			$numu=$_POST['numu'];
	$so=mysqli_query($conn, "DELETE FROM `station` WHERE `Number`='$numu' ORDER BY `Number` ASC LIMIT 1");
		}

		// Edit a given station record
if(isset($_POST['edito']))
		{
			$numu=$_POST['numu'];
			$acco=$_POST['acco'];
			$name=$_POST['name'];
	$so=mysqli_query($conn, "UPDATE `station` SET `Name`='$name', `Discount`='$acco'  WHERE `Number`='$numu' ORDER BY `Number` ASC LIMIT 1");
		}

		// Create a new station record
if(isset($_POST['eddo']))
		{
			$acco=$_POST['acco'];
			$name=$_POST['name'];
			$bank=$_POST['bank'];
	$so=mysqli_query($conn, "INSERT INTO `station` (`Date`, `Name`, `Discount`) VALUES ('$date', '$name', '$acco')");
		}


		// Delete a given garage record
if(isset($_POST['delog']))
		{
			$numu=$_POST['numu'];
	$so=mysqli_query($conn, "DELETE FROM `garage` WHERE `Number`='$numu' ORDER BY `Number` ASC LIMIT 1");
		}

		// Edit a given garage record
if(isset($_POST['editog']))
		{
			$numu=$_POST['numu'];
			$acco=$_POST['acco'];
			$name=$_POST['name'];
	$so=mysqli_query($conn, "UPDATE `garage` SET `Name`='$name'  WHERE `Number`='$numu' ORDER BY `Number` ASC LIMIT 1");
		}

		// Create a new garage record
if(isset($_POST['eddog']))
		{
			$name=$_POST['name'];
			$bank=$_POST['bank'];
	$so=mysqli_query($conn, "INSERT INTO `garage` (`Date`, `Name`, `Discount`) VALUES ('$date', '$name', '0')");
		}
		
		// Delete a given position
if(isset($_POST['delopost']))
		{
			$numu=$_POST['numu'];
	$so=mysqli_query($conn, "DELETE FROM `position` WHERE `Postid`='$numu' ORDER BY `Postid` ASC LIMIT 1");
		}

		// Create a new position
if(isset($_POST['addpost']))
		{
			$name=$_POST['name'];
	$so=mysqli_query($conn, "INSERT INTO `position` (`Postname`, `Status`) VALUES ('$name', '0')");
		}

	// **************************************** Station Configuration Modal ******************************************************		
	echo"<div class='modal fade' id='stationModal' tabindex='-1' role='dialog' aria-labelledby='ModalLabel' aria-hidden='true' style='top:40px;'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'><div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLabel'> STATIONS CONFIGURATION </h5>

      </div>
      <div class='modal-body' style='height:auto;'>
	  <table class='table table-striped table-hover'>     
                                      <thead>
                    <tr role='row'><th class='hidden-xs'>&nbsp;&nbsp;NO&nbsp;&nbsp;</th><th>&nbsp;&nbsp;  Date </th>
					<th> Station Name </th><th> Discount </th><th colspan='2' style='width:80px;'><div align='center'> # </th></th>
						 <tbody>";
				$i=1;
	  $dob=mysqli_query($conn, "SELECT *FROM `station` ORDER BY `Number` ASC");
		while($rob=mysqli_fetch_assoc($dob)){
			$numu=$rob['Number'];
			$dato=$rob['Date'];
			$acco=$rob['Discount'];
			$name=$rob['Name'];
			$stl="padding:0px;";
			$clr="";

print("<tr><form method='post' action=''><td class='hidden-xs' style='$stl $clr'><div align='center'>$i&nbsp;&nbsp;</td>
						<td style='$stl $clr'><div align='left'>
						<input name='dato' class='form-control' type='text' style='text-align:center; width:100px; height:24px; margin:0px 0px 0px 0px; padding:0px 10px 0px 10px; background-color:transparent;' value='$dato' onChange=this.style.color='#ff3366' readonly></td>

						<td style='$stl $clr'><div align='left'>
						<input name='name' class='form-control' type='text' style='text-align:left; width:180px; height:24px; margin:0px 0px 0px 0px; padding:0px 10px 0px 10px; background-color:transparent;' value='$name' onChange=this.style.color='#ff3366'></td>

						<td style='$stl $clr'><div align='left'>
						<input name='acco' class='form-control' type='text' style='text-align:right; width:100px; height:24px; margin:0px 0px 0px 0px; padding:0px 10px 0px 10px; background-color:transparent;' onChange=this.style.color='#ff3366' value='$acco'>
						<input type='hidden' name='numu' value='$numu'></td>
						<td class='text-center'><button type='submit' class='btn btn-xs btn-warning hidden-print' name='edito' style='height:22px; margin:0px 0px 0px 0px; padding:0px;' title='Edit' data-toggle='tooltip' data-placement='top'>&nbsp;&nbsp;<i class='lnr lnr-pencil'></i>&nbsp;&nbsp;</button></td>
						
						<td class='text-center'><button type='submit' class='btn btn-xs btn-danger hidden-print' style='height:22px; margin:0px 0px 0px 0px; padding:0px;' data-placement='top' name='delo' title='Delete' data-toggle='tooltip' data-placement='top'>
						  &nbsp;&nbsp;<i class='lnr lnr-trash'></i>&nbsp;&nbsp;</button></td></form></tr>");

						$i++;
		}

		print("<tr><form method='post' action=''><td class='hidden-xs' style='$stl $clr'><div align='center'>$i&nbsp;&nbsp;</td>
						<td style='$stl $clr'><div align='left'>
						<input name='dato' class='form-control' type='text' style='text-align:left; width:100px; height:24px; margin:0px 0px 0px 0px; padding:0px 10px 0px 10px; background-color:transparent;' value='$Date' onChange=this.style.color='#ff3366'></td>

						<td style='$stl $clr'><div align='left'>
						<input name='name' class='form-control' type='text' style='text-align:left; width:180px; height:24px; margin:0px 0px 0px 0px; padding:0px 10px 0px 10px; background-color:transparent;' onChange=this.style.color='#ff3366'></td>

						<td style='$stl $clr'><div align='left'>
						<input name='acco' class='form-control' type='text' style='text-align:right; width:100px; height:24px; margin:0px 0px 0px 0px; padding:0px 10px 0px 10px; background-color:transparent;' onChange=this.style.color='#ff3366' onkeyup='format(this);' onkeypress='return isNumberKey(event)'><input type='hidden' name='numu' value='$numu'></td>
						<td colspan='2' class='text-center'><button type='submit' class='btn btn-xs btn-success hidden-print' name='eddo' style='height:22px; margin:0px 0px 0px 0px; padding:0px;' title='Create' data-toggle='tooltip' data-placement='top'>&nbsp;&nbsp;<i class='lnr lnr-plus-circle'></i>&nbsp;CREATE&nbsp;</button></td></form></tr>");

			echo"</table></div><div class='modal-footer' style='margin-top:-10px; height:50px; padding-top:5px; border:0px solid blue;'>
       
        <button type='button' class='btn btn-sm btn-danger' data-dismiss='modal' style='height:20px; padding-top:0px; width:120px;'>CLOSE</button>
      </div>
    </div>
  </div>
</div>";





// **************************************** Services Configuration Modal ******************************************************		
	echo"<div class='modal fade' id='serviceModal' tabindex='-1' role='dialog' aria-labelledby='ModalLabel' aria-hidden='true' style='top:40px;'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'><div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLabel'> SERVICES CONFIGURATION
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </h5>

      </div>
      <div class='modal-body' style='height:auto;'>
	  <table class='table table-striped table-hover'>     
                                      <thead>
                    <tr role='row'><th class='hidden-xs'>&nbsp;&nbsp;NO&nbsp;&nbsp;</th><th>&nbsp;&nbsp; Date </th>
					<th> Service Name </th><th colspan='2' style='width:80px;'><div align='center'> # </th></th>
						 <tbody>";
				$i=1;
	  $dob=mysqli_query($conn, "SELECT *FROM `garage` ORDER BY `Number` ASC");
		while($rob=mysqli_fetch_assoc($dob)){
			$numu=$rob['Number'];
			$dato=$rob['Date'];
			$name=$rob['Name'];
			$stl="padding:0px;";
			$clr="";

			print("<tr><form method='post' action=''><td class='hidden-xs' style='$stl $clr'><div align='center'>$i&nbsp;&nbsp;</td>
						<td style='$stl $clr'><div align='left'>
						<input name='dato' class='form-control' type='text' style='text-align:center; width:100px; height:24px; margin:0px 0px 0px 0px; padding:0px 10px 0px 10px; background-color:transparent;' value='$dato' onChange=this.style.color='#ff3366' readonly></td>

						<td style='$stl $clr'><div align='left'>
						<input name='name' class='form-control' type='text' style='text-align:left; width:280px; height:24px; margin:0px 0px 0px 0px; padding:0px 10px 0px 10px; background-color:transparent;' value='$name' onChange=this.style.color='#ff3366'>

						<input type='hidden' name='numu' value='$numu'></td>
						<td class='text-center'><button type='submit' class='btn btn-xs btn-warning hidden-print' name='editog' style='height:22px; margin:0px 0px 0px 0px; padding:0px;' title='Edit' data-toggle='tooltip' data-placement='top'>&nbsp;&nbsp;<i class='lnr lnr-pencil'></i>&nbsp;&nbsp;</button></td><td class='text-center'><button type='submit' class='btn btn-xs btn-danger hidden-print' style='height:22px; margin:0px 0px 0px 0px; padding:0px;' data-toggle='tooltip' data-placement='top' title='Delete' name='delog'>
						  &nbsp;&nbsp;<i class='lnr lnr-trash'></i>&nbsp;&nbsp;</button></td></form></tr>");

						$i++;
		}

		print("<tr><form method='post' action=''><td class='hidden-xs' style='$stl $clr'><div align='center'>$i&nbsp;&nbsp;</td>
						<td style='$stl $clr'><div align='left'>
						<input name='dato' class='form-control' type='text' style='text-align:left; width:100px; height:24px; margin:0px 0px 0px 0px; padding:0px 10px 0px 10px; background-color:transparent;' value='$Date' onChange=this.style.color='#ff3366'></td>

						<td style='$stl $clr'><div align='left'>
						<input name='name' class='form-control' type='text' style='text-align:left; width:280px; height:24px; margin:0px 0px 0px 0px; padding:0px 10px 0px 10px; background-color:transparent;' onChange=this.style.color='#ff3366'>
						
						<input type='hidden' name='numu' value='$numu'></td>
						<td colspan='2' class='text-center'><button type='submit' class='btn btn-xs btn-success hidden-print' name='eddog' style='height:22px; margin:0px 0px 0px 0px; padding:0px;' title='Create' data-toggle='tooltip' data-placement='top'>&nbsp;&nbsp;<i class='lnr lnr-plus-circle'></i>&nbsp;CREATE&nbsp;</button></td>
						</form></tr>");

			echo"</table></div><div class='modal-footer' style='margin-top:-10px; height:50px; padding-top:5px; border:0px solid blue;'>
       
        <button type='button' class='btn btn-sm btn-danger' data-dismiss='modal' style='height:20px; padding-top:0px; width:120px;'>CLOSE</button>
      </div>
    </div>
  </div>
</div>";

// *************************************************** End of Modal ************************************************************




// ********************************************* Post Configuration Modal **************************************************************
	echo"<div class='modal fade' id='postModal' tabindex='-1' role='dialog' aria-labelledby='ModalLabel' aria-hidden='true' style='top:40px;'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLabel'> POST & POSITIONS
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </h5>

      </div>
      <div class='modal-body' style='height:auto;'>
	  <table class='table table-striped'>     
                                      <thead>
                    <tr role='row'><th class='hidden-xs'>&nbsp;No&nbsp;&nbsp;</th><th> Date </th><th> Position Name </th>
					<th style='width:80px;'><div align='center'> # </th></th>
						 <tbody>";
				$i=1;
	  $dob=mysqli_query($conn, "SELECT *FROM `position` WHERE `Status`='0' ORDER BY `Postname` ASC");
		while($rob=mysqli_fetch_assoc($dob)){
			$numu=$rob['Postid'];
			$name=$rob['Postname'];
			$stl="padding:2px;";
			$clr="";

			print("<tr><form method='post' action=''><td class='hidden-xs' style='$stl $clr'><div align='center'>$i&nbsp;&nbsp;</td>
						<td style='$stl $clr'><div align='left'>
						<input name='dato' class='form-control text-center' type='text' style='width:120px; height:24px; margin:0px 0px 0px 0px; padding:0px 10px 0px 10px; background-color:transparent;' value='$Date' onChange=this.style.color='#ff3366'></td>

						<td style='$stl $clr'><div align='left'>
						<input name='name' class='form-control' type='text' style='text-align:left; width:290px; height:24px; margin:0px 0px 0px 0px; padding:0px 10px 0px 10px; background-color:transparent;' value='$name' onChange=this.style.color='#ff3366'></td>
						
						<td><div align='center'><input type='hidden' name='numu' value='$numu'><button type='submit' class='btn btn-xs btn-danger hidden-print' name='delopost' style='height:22px; margin:0px 0px 0px 0px; padding:0px;' title='Edit' data-toggle='tooltip' data-placement='top'>&nbsp;&nbsp;<i class='lnr lnr-trash'></i>&nbsp;&nbsp;</button></td></form></tr>");

						$i++;
		}

		print("<tr><form method='post' action=''><td class='hidden-xs' style='$stl $clr'><div align='center'>$i&nbsp;&nbsp;</td>
						<td style='$stl $clr'><div align='left'>
						<input name='dato' class='form-control text-center' type='text' style='width:120px; height:24px; margin:0px 0px 0px 0px; padding:0px 10px 0px 10px; background-color:transparent;' onChange=this.style.color='#ff3366' value='$Date'></td>

						<td style='$stl $clr'><div align='left'>
						<input name='name' class='form-control' type='text' style='text-align:left; width:290px; height:24px; margin:0px 0px 0px 0px; padding:0px 10px 0px 10px; background-color:transparent;' onChange=this.style.color='#ff3366'></td>

					<td><div align='center'><button type='submit' class='btn btn-xs btn-success hidden-print' name='addpost' style='height:22px; margin:0px 0px 0px 0px; padding:0px;' title='Edit' data-toggle='tooltip' data-placement='top'>&nbsp;&nbsp;<i class='lnr lnr-plus-circle'></i>&nbsp;&nbsp;</button></td></form></tr>");

			echo"</table></div><div class='modal-footer' style='margin-top:-10px; height:50px; padding-top:5px; border:0px solid blue;'>
       
        <button type='button' class='btn btn-sm btn-danger' data-dismiss='modal' style='height:20px; padding-top:0px; width:120px;'>CLOSE</button>
      </div>
    </div>
  </div>
</div>";

// *************************************************** End of Modal ************************************************************





// ********************************************* Charge Types **************************************************************
	echo"<div id='modal-x1123' class='modal fade' role='dialog'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLabel'> CREATE CHARGE TYPE
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </h5>

      </div>
      <div class='modal-body' style='height:auto;'>
	  <table class='table table-striped table-hover' style='margin-top:-15px;'>";
	  

		print("<tr><form method='post' action=''><td class='hidden-xs' style='$stl $clr'>
		<div align='center'>&nbsp;&nbsp;&nbsp;&nbsp;1&nbsp;&nbsp;</td><td style='$stl $clr'><div align='left'>
						<input name='datei' class='form-control' type='text' style='text-align:center; width:120px; height:24px; margin:0px 0px 0px 0px; padding:0px 10px 0px 10px; background-color:transparent;' onChange=this.style.color='#ff3366' value='$Date' id='from'></td>

						<td style='$stl $clr'><div align='left'>
						<input name='namei' class='form-control' type='text' style='text-align:left; width:320px; height:24px; margin:0px 0px 0px 0px; padding:0px 10px 0px 10px; background-color:transparent;' onChange=this.style.color='#ff3366'></td>

				<td style='$stl $clr'><div align='center'><button type='submit' class='btn btn-xs btn-success hidden-print' name='eddobon' style='height:22px; margin:0px 0px 0px 0px; padding:0px;' title='Add New' data-toggle='tooltip' data-placement='top'>&nbsp;&nbsp;<i class='lnr lnr-plus-circle'></i>&nbsp;&nbsp;</button></td></form></tr>");

				$i=2;
	  $dob=mysqli_query($conn, "SELECT *FROM `ctype` WHERE `Status`='0' ORDER BY `Type` ASC");
		while($rob=mysqli_fetch_assoc($dob)){
			$numu=$rob['Number'];
			$date=$rob['Date'];
			$acco=$rob['Type'];
			$stl="padding:0px 2px; 0px 2px";
			$clr="";

			print("<tr style='height:10px;'><form method='post' action=''>
			<td class='hidden-xs' style='$stl $clr'><div align='center'>&nbsp;&nbsp;&nbsp;&nbsp;$i&nbsp;&nbsp;</td>
						<td style='$stl $clr'><div align='left'><input type='hidden' name='numu' value='$numu'>
						<input name='date' class='form-control' type='text' style='text-align:center; width:120px; height:24px; margin:0px 0px 0px 0px; padding:0px 10px 0px 10px; background-color:transparent;' value='$date' onChange=this.style.color='#ff3366'></td>

						<td style='$stl $clr'><div align='left'>
						<input name='name' class='form-control' type='text' style='text-align:left; width:320px; height:24px; margin:0px 0px 0px 0px; padding:0px 10px 0px 10px; background-color:transparent;' value='$acco' onChange=this.style.color='#ff3366'></td>

						<td style='$stl $clr'><div align='center'><button type='submit' class='btn btn-xs btn-warning hidden-print' name='editobon' style='height:22px; margin:0px 0px 0px 0px; padding:0px;' title='Edit' data-toggle='tooltip' data-placement='top'>&nbsp;&nbsp;<i class='lnr lnr-pencil'></i>&nbsp;&nbsp;</button></td></form></tr>");

						$i++;
		}

			echo"</table></div><div class='modal-footer' style='margin-top:-10px; height:40px; padding-top:5px; border:0px solid blue;'>
       
        <button type='button' class='btn btn-sm btn-danger' data-dismiss='modal' style='height:20px; padding-top:0px; width:120px;'>CLOSE</button>
      </div>
    </div>
  </div>
</div>";

// *************************************************** End of Modal ************************************************************
					?>
			</div>
 <div class="row">
 <div class="col-md-12">
 <div class="widget-container fluid-height clearfix">
 <div class="widget-content padded">
 <form method="post" class="form-horizontal" action="" enctype="multipart/form-data">
 <div class="row">
 <div class="col-md-12">
 <div class="col-md-6">
   <div class="form-group">
            <label class="control-label col-md-3">Company-Name</label>
            <div class="col-md-6">
              <input class="form-control" name="cna" value="<?php echo $cna ?>" type="text" readonly>
            </div>
          </div>
   <div class="form-group">
            <label class="control-label col-md-3">Company-Email</label>
            <div class="col-md-6">
              <input class="form-control" name="mail" value="<?php echo $mail ?>" type="text">
            </div>
   </div>
    <div class="form-group">
 <label class="control-label col-md-3">Company-Website</label>
     <div class="col-md-6">
                <input class="form-control" name="web" value="<?php echo $web ?>" type="text">
              </div></div>
  <div class="form-group">
                   <label class="control-label col-md-3">Address</label>
                  <div class="col-md-6">
              <textarea class="form-control" name="adde"><?php echo $adde ?>          
                              </textarea>
            </div> 
          </div>
    
          <div class="form-group">
          <label class="control-label col-md-3">Country</label>
          <div class="col-md-6">
<select class="form-control" name="country">
        <option value=""></option>
    <option value="<?php echo $country ?>" selected><?php echo $country ?></option>
</select>
          </div>
          </div>
          <div class="form-group">
                   <label class="control-label col-md-3">City</label>
                  <div class="col-md-6">
             <input class="form-control" name="city" value="<?php echo $city ?>" type="text">
            </div> 
          </div>
          <div class="form-group">
                   <label class="control-label col-md-3">Telephone 1</label>
                  <div class="col-md-6">
              <input class="form-control" name="pho1" value="<?php echo $pho1 ?>" type="text">
            </div> 
          </div>
          <div class="form-group">
                   <label class="control-label col-md-3">Telephone 2</label>
                  <div class="col-md-6">
              <input class="form-control" name="pho2" value="<?php echo $pho2 ?>" type="text">
            </div> 
          </div> 
 </div>
 <div class="col-md-6">
   
  
            <div class="form-group">
    <label class="control-label col-md-3">Participation <br>
    </label>
        <div class="col-md-3"><div class='input-group' style='width:100%'>
              <input class="form-control text-center" name="parti" type="text" value="<?php echo $parti ?>">
			<span class='input-group-addon' style='width:10%; text-align:left;'><b> % </b></span>
			</div><font color="blue"> &nbsp;&nbsp;&nbsp; Employee </font>
              </div>
              
              <div class="col-md-3"><div class='input-group' style='width:100%'><input class="form-control text-center pull-right" name="reco" type="text" value="<?php echo $reco ?>">
			<span class='input-group-addon' style='width:10%; text-align:left;'><b> % </b></span>
              </div><font color="blue"> &nbsp;&nbsp;&nbsp; Company </font></div>
            </div> 
 <div class="form-group">
    <label class="control-label col-md-3">Fiscal Month</label>
                     <div class="col-md-6">
                     <select class="form-control" name="fiscalmonth"><option value="january">January</option>
                     <option value="february">February</option>
                     <option value="march" selected="selected">March</option>
                     <option value="april">April</option>
        <option value="may">May</option>
        <option value="june">June</option>
        <option value="july">July</option>
        <option value="august">August</option>
        <option value="september">September</option> 
        <option value="october">October</option>
        <option value="november">November</option>
        <option value="december">December</option>            
                     </select>
              </div>
            </div> 
   <div class="form-group">
    <label class="control-label col-md-3">Tax Number</label>
                     <div class="col-md-6">
              <input class="form-control" name="tax" value="<?php echo $tax ?>" type="text">
              </div>
            </div>       
   <div class="form-group">
    <label class="control-label col-md-3">Currency Symbol</label>
                     <div class="col-md-3">
              <input class="form-control" name="curre" value="<?php echo $curre ?>" style='text-align:center;' OnKeyup='return cUpper(this);' type="text">
              </div>
			   <div class="col-md-3">
              <input class="form-control" name="curre2" value="<?php echo $curre ?>" style='text-align:center;' OnKeyup='return cUpper(this);' readonly type="text">
              </div>
            </div>  
 <div class="form-group">
 <label class="control-label col-md-3">Auto Logout</label>
     <div class="col-md-6" style="text-align:center;">
	 <?php
	 if($bch=='1'){
		$yes="checked='checked'";
		$no='';
		}
		else{
			$yes='';
			$no="checked='checked'";
		}
		?>

              <label class="radio-inline">
              <input name="bch" id="watermark_yes" value="1" <?php echo $yes ?> type="radio">
              <span>Yes</span>
              </label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <label class="radio-inline">
              <input name="bch" id="watermark_no" value="0" <?php echo $no ?> type="radio">
              <span>No</span></label>
              </div>
              </div> 
      <div class="form-group"><br><br>
            <label class="control-label col-md-3">Upload Logo</label>
            <div class="col-md-4">
              <div class="fileupload fileupload-new" data-provides="fileupload">
              <input value="" name="" type="hidden">
                <div class="fileupload-new img-thumbnail">
                      <img src="imgs/logo.png" width="100%">
                     
                </div>
                <div class="fileupload-preview fileupload-exists img-thumbnail" style="width: 200px; max-height: 150px;"></div>
                <div>
                  <span class="btn btn-default btn-file">
                  <span class="fileupload-new">Select image</span>
                  <span class="fileupload-exists">Change</span>
                  <input name="logo" id="logo" type="file"></span>
                  <a class="btn btn-default fileupload-exists" data-dismiss="fileupload" href="#">Remove</a>&nbsp;
             <small>Only&nbsp;<b>.png</b>&nbsp;(Max&nbsp;:&nbsp;64M)</small>
                  
                </div>
              </div>
            </div>
          </div> 
 
 </div></div></div><hr>
   <div class="form-group">
  <div class="col-md-1"></div>
   <div class="col-md-10"><br>                
    <button class="btn btn-lg btn-block btn-warning" type="submit" name="submit_settings"><i class="lnr lnr-chevron-up-circle"></i> Update</button>         
   </div>
   <div class="col-md-1"></div>
 </div>
 
 </form></div></div><br><br><br></div></div></div>  
   <?php
   include'footer.php';
   ?>