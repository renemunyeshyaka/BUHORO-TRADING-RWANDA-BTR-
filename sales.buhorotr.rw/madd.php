<?php
if(basename($_SERVER['PHP_SELF']) == 'madd.php') 
  $bb=" class='current'";
include'header.php';
include'connection.php';
$user=$loge;
$dato=$Date;
$pto=0;
 $brc=$_SESSION['BR'];	
 $doib=mysql_query("SELECT `Name` FROM `branches` WHERE `Number`='$brc' ORDER BY `Number` ASC");
			$roib=mysql_fetch_assoc($doib);
				$bra=$roib['Name'];

$fld="S$brc";

if(isset($_POST['mois']))
		{
			$emplo=$_POST['emplo'];
			$amo=$_POST['amo'];
				$amo=preg_replace('/,/', '', $amo);
			$purpo=$_POST['purpo'];
				$purpo=str_replace("'", "`", $purpo);
			$user=$_POST['user'];
			$dato=$_POST['dato'];
			$payto=$_POST['payto'];
$so=mysql_query("INSERT INTO `payment` (`Date`, `Time`, `Cashier`, `Amount`, `Pline`, `Voucher`, `Branche`, `Status`, `Customer`, `Action`, `Description`, `Payto`, `Pdate`, `Upda`) VALUES ('$dato', '$Time', '$loge', '$amo', 'CASH', '99999999999', '$brc', '0', '$payto', 'PAYOUT', '$purpo', '$emplo', '$dato', '1')");
		$pto=10;
		}


	// Delete a given dtype
if(isset($_POST['editobon']))
		{
			$num=$_POST['num'];
				$soso=mysqli_query($cons, "DELETE FROM `dtype` WHERE `Number`='$num' ORDER BY `Number` ASC LIMIT 1");
		}

		// Create a new dtype
if(isset($_POST['eddobon']))
		{
			$datei=$_POST['datei'];
			$namei=$_POST['namei'];
	$so=mysqli_query($cons, "INSERT INTO `dtype` (`Date`, `Type`) VALUES ('$datei', '$namei')");
		}	

?>
<div class="container-fluid main-content">
        <div class="page-title hidden-print">
          <h2 style='margin-top:-20px; margin-bottom: 5px; color:#ffcc33'>
       Sales/Payment
          </h2>
                 </div>
     
        <div class="row">
  <div class="col-lg-2 hidden-print">
   
    <ul class="list-group">

	   <li class="list-group-item">
              <a href="stobranch.php" <?php echo $dsa ?>>
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Store Status
                </p>
              </a></li>

   <li class="list-group-item">
	  <a href="createa.php" <?php echo $dsa ?>>
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Create Account
                </p>
              </a></li> 

   <li class="list-group-item">
	  <a href="dadd.php" <?php echo $dsa ?>>
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Pay on Account
                </p>
              </a></li>   

   <li class="list-group-item">
	  <a href="cashbox.php" <?php echo $dsa ?>>
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Add to Cashbox
                </p>
              </a></li> 

   <li class="list-group-item active">
	  <a href="madd.php" <?php echo $dsa ?>>
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Make a Payout
                </p>
              </a></li> 
                       
            </ul>
			<?php
			if($brc>='1'){
				?>
<center>
<?php
/*
if($_SESSION['Phyc']){
?>
			<a href="counte.php" class="btn btn-warning" style="width:100%;"><i class="lnr lnr-layers">&nbsp;Physical Count</i></a>
<?php
}
*/
?>

		<br><br>
  
				 <ul class="list-group text-left">
        <?php
        if($_SESSION['Acrepo']){
            ?>
   <li class="list-group-item" style="border:1px dashed #cccccc; border-radius:5px; margin:0px 0px 4px 0px;">
	  <a href="urepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Sales Report
                </p>
              </a></li> 
              <?php
        }
        else{
        ?>
   <li class="list-group-item" style="border:1px dashed #cccccc; border-radius:5px; margin:0px 0px 4px 0px;">
	  <a href="irepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Control Report
                </p>
              </a></li> 
              <?php
        }
        ?>

			   <li class="list-group-item" style="border:1px dashed #cccccc; border-radius:5px; margin:0px 0px 4px 0px;">
	  <a href="transit.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Payment Report
				<?php
$doq=mysqli_query($cons, "SELECT `Amount` FROM `payment` WHERE `Status`='0' AND `Action`='SALES' AND `Branche`='$brc' AND `Voucher`='0' ORDER BY `Number` ASC");
				if($foq=mysqli_num_rows($doq))
echo"<span class='badge' style='float:right; font-size:12px; margin-right:0px; margin-top:0px; height:18px; background-color:#ffcc66; width:auto;'> $foq </span>";
					?>
                </p>
              </a></li> 

   <li class="list-group-item" style="border:1px dashed #cccccc; border-radius:5px; margin:0px 0px 4px 0px;">
	  <a href="isrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Cashiers Report
                </p>
              </a></li>  
			  
			  <li class="list-group-item" style="border:1px dashed #cccccc; border-radius:5px; margin:0px 0px 4px 0px;">
	  <a href="bopi.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Bank Deposit
                </p>
              </a></li>
	</ul>
			  <?php
			}
   ?>
  </div>




 <div class="col-md-10">
 <div class="widget-container fluid-height clearfix">
 <div class="widget-content padded">
 <form method="post" class="form-horizontal" action="" enctype="multipart/form-data">
 <input name="app_file_size" id="app_file_size" type="hidden">
 <br>
 <?php 
 $amos=number_format($amo);
if($pto==10)
echo"<center><div class='alert alert-danger' style='width:48%;text-align:center;float:center;background-color: #60c560;color: #ffffff;border-radius:5px;'>
		<i class='lnr lnr-checkmark-circle'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>&times;</button>A payout of RWF $amos is made to your cashbox.
		</div></center>";
	
			echo"<input value='$code' name='rowid' type='hidden'>";
			?>
			<div class="form-group">
            <label class="control-label col-md-3">Destination</label>
            <div class="col-md-6"><div class='input-group'>
           <select class="form-control" name="emplo" required>
				<option value='' selected='selected'>Select Destination</option>
			 <?php
			$doi=mysql_query("SELECT *FROM `dtype` WHERE `Type`!='' ORDER BY `Type` ASC");
			while($roi=mysql_fetch_assoc($doi)){
				$code=$roi['Number'];
				$fna=$roi['Type'];
			echo"<option value='$fna'> $fna </option>";
			}
			?>    
                            </select><span class='input-group-addon'><a href='#' data-placement='top' data-toggle='modal' data-target='#modal-x1123'>
		 <i class="lnr lnr-sync"></i></a></span>
	
	</div>
            </div>
			<span style="color:#d43f3a">
                         *
                      </span>  
 </div>
  <div class="form-group">
            <label class="control-label col-md-3">Total Amount</label>
            <div class="col-md-6">
              <input name="amo" class="form-control" type="text" onkeypress='return isNumberKey(event)' onkeyup='format(this);' required>
            </div>
			  <span style="color:#d43f3a">
                         *
                      </span>  
 </div>
 <div class="form-group">
   <label class="control-label col-md-3">Description</label>
                  <div class="col-md-6">
              <input class="form-control" name="purpo" type="text" required>
            </div> 
			  <span style="color:#d43f3a">
                         *
                      </span>  
			</div>

			
 <div class="form-group">
   <label class="control-label col-md-3">Paid To</label>
                  <div class="col-md-6">
    <input class="form-control" name="payto" type="text" id="searcha" required>
            </div> 
			  <span style="color:#d43f3a">
                         *
                      </span>  
			</div>


		

  <div class="form-group">
            <label class="control-label col-md-3"><br><br>Done&nbsp;by</label>
            <div class="col-md-2" style='margin-right:30px;'>
              <br><br><input name="user" class="form-control" value="<?php echo $user ?>" type="text" style='width:210px;' readonly> &nbsp;&nbsp; 
			 </div> 

			  <label class="control-label col-md-1"><br><br>Date</label>
			<div class="col-md-5"><br><br>
			  <input name="dato" id="from" class="form-control" value="<?php echo $dato ?>" type="text" style='width:210px; text-align:center;' required>
            </div> 
 </div>

 <div class="form-group">
  <label class="control-label col-md-2"> </label>
    <label class="control-label col-md-3">Document File</label>
                     <div class="col-md-4">
              <div class="fileupload fileupload-new" data-provides="fileupload"><input value="<?php echo $rowid ?>" name="rowid" type="hidden">
                <span class="btn btn-default btn-file"><span class="fileupload-new">Select</span><span class="fileupload-exists">Change</span><input name="file1" id="app_file" type="file" readonly='readonly'></span><span class="fileupload-preview"></span><button class="close fileupload-exists" data-dismiss="fileupload" style="float:none" type="button">×</button>
		<?php echo $dfile ?>
				
                     
              </div>     <small>Zip, txt, jpeg, png, pdf, doc (Max : 2M)</small>
            </div>
            </div>

  <div class="form-group">
  <div class="col-md-12">
  
		<div class="col-sm-3"> </div>
		 <div class="col-sm-6" align='center' style='border:0px solid black;'>
		 <?php
		 if($_SESSION['Xput']=='1'){
			 ?>
		 <button class="btn btn-lg btn-block btn-info" type="submit" name="mois"><i class="lnr lnr-exit-up"></i>&nbsp;&nbsp;SAVE </button> 
		 <?php
		}
 
 


			  // ********************************************* Charge Types **************************************************************
	echo"</form><div id='modal-x1123' class='modal fade' role='dialog'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <button type='button' class='close' data-dismiss='modal'>&times;</button>
        <h5 class='modal-title' id='exampleModalLabel'> CREATE A NEW DESTINATION
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </h5>

      </div>
      <div class='modal-body' style='height:440px; overflow-y:auto;'>
	  <table class='table table-striped table-hover' style='margin-top:-15px;'>";
			$stl="padding:0px 2px; 0px 2px";
			$clr="";
	  

		print("<tr><form method='post' action=''><td class='hidden-xs' style='$stl $clr'>
		<div align='center'>&nbsp;&nbsp;&nbsp;&nbsp;1&nbsp;&nbsp;</td><td style='$stl $clr'><div align='left'>
						<input name='datei' class='form-control' type='text' style='text-align:center; width:120px; height:24px; margin:0px 0px 0px 0px; padding:0px 10px 0px 10px; background-color:transparent;' onChange=this.style.color='#ff3366' value='$Date' id='from'></td>

						<td style='$stl $clr'><div align='left'>
						<input name='namei' class='form-control' type='text' style='text-align:left; width:320px; height:24px; margin:0px 0px 0px 0px; padding:0px 10px 0px 10px; background-color:transparent;' OnKeyup='return cUpper(this);' onChange=this.style.color='#ff3366'></td>

				<td style='$stl $clr'><div align='center'><button type='submit' class='btn btn-xs btn-success hidden-print' name='eddobon' style='height:22px; margin:0px 0px 0px 0px; padding:0px;' title='Add New' data-toggle='tooltip' data-placement='top'>&nbsp;&nbsp;<i class='lnr lnr-plus-circle'></i>&nbsp;&nbsp;</button></td></form></tr>");

				$i=2;
	  $dob=mysqli_query($cons, "SELECT *FROM `dtype` ORDER BY `Type` ASC");
		while($rob=mysqli_fetch_assoc($dob)){
			$num=$rob['Number'];
			$date=$rob['Date'];
			$acco=$rob['Type'];

			print("<tr style='height:10px;'><form method='post' action=''>
			<td class='hidden-xs' style='$stl $clr'><div align='center'>&nbsp;&nbsp;&nbsp;&nbsp;$i&nbsp;&nbsp;</td>
						<td style='$stl $clr'><div align='left'><input type='hidden' name='numu' value='$numu'>
						<input name='date' class='form-control' type='text' style='text-align:center; width:120px; height:24px; margin:0px 0px 0px 0px; padding:0px 10px 0px 10px; background-color:transparent;' value='$date' onChange=this.style.color='#ff3366'></td>

						<td style='$stl $clr'><div align='left'><input type='hidden' name='num' value='$num'>
						<input name='name' class='form-control' type='text' style='text-align:left; width:320px; height:24px; margin:0px 0px 0px 0px; padding:0px 10px 0px 10px; background-color:transparent;' OnKeyup='return cUpper(this);' value='$acco' onChange=this.style.color='#ff3366'></td>

						<td style='$stl $clr'><div align='center'><button type='submit' class='btn btn-xs btn-danger hidden-print' name='editobon' style='height:22px; margin:0px 0px 0px 0px; padding:0px;' title='Edit' data-toggle='tooltip' data-placement='top'>&nbsp;&nbsp;<i class='lnr lnr-trash'></i>&nbsp;&nbsp;</button></td></form></tr>");

						$i++;
		}

				echo"</table></div><div class='modal-header text-right' style='margin-top:-10px; height:50px; padding-top:15px; border:0px solid blue;'>
       
        <button type='button' class='btn btn-sm btn-warning' data-dismiss='modal' style='height:30px; padding-top:0px; width:120px;'>CLOSE</button>
      </div>
    </div>
  </div>
</div>";

// *************************************************** End of Modal ************************************************************
			 ?>
   </div>
      
 </div></div>
 </div>
 </div>
 </div>
 </div> 
</div>  
   <?php
   include'footer.php';
   ?>