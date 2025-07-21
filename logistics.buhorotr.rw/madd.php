<?php
if(basename($_SERVER['PHP_SELF']) == 'madd.php') 
  $nv=" class='current'";
include'header.php';
include'connection.php';
$user=$loge;
$dato=$Date;
$pto=0;

if(isset($_POST['mois']))
		{
			$emplo=$_POST['emplo'];
			$amo=$_POST['amo'];
				$ami=preg_replace('/,/', '', $amo);
				$amo=-1*$ami;
			$purpo=$_POST['purpo'];
				$purpo=str_replace("'", "`", $purpo);
			$user=$_POST['user'];
			$dato=$_POST['dato'];
			$payto=$_POST['payto'];
			$pline=$_POST['pline'];
			$plate=$_POST['plate'];
			$invo=$_POST['invo'];
			$tax=$_POST['tax'];
	
		$so=mysqli_query($conn, "INSERT INTO `stouse` (`Date`, `User`, `Item`, `Quantity`, `Price`, `Destin`, `Action`, `Invoice`, `Vehicles`, `Rate`, `Tinvoice`, `Tclass`) VALUES ('$dato', '$loge', '$emplo', '1', '$amo', '$purpo', 'PAYOUT', '$payto', '$plate', '1', '$invo', '$tax')");

		$pto=20;
		if($plate){
		    $garage=$_POST['garage'];
		    
	$tripe=mysqli_query($conn, "SELECT `Number` FROM `trips` WHERE `Vehicle`='$plate' AND `Date`<= '$dato' ORDER BY `ETD` DESC LIMIT 1");
	        if($fripe=mysqli_num_rows($tripe)){
			$ripe=mysqli_fetch_assoc($tripe);
				$trip=$ripe['Number'];
	        }
	        else
	            $trip=0;
				
	$doz=mysqli_query($conn, "SELECT `Rate` FROM `currency` WHERE `Code`='USD' ORDER BY `Number` DESC");
		    $roz=mysqli_fetch_assoc($doz);
			     $rate=$roz['Rate'];
		
	$dozi=mysqli_query($conn, "SELECT `Plate`, `Driver` FROM `vehicles` WHERE `Number`='$plate' ORDER BY `Number` DESC");
		    $rozi=mysqli_fetch_assoc($dozi);
			     $driver=$rozi['Driver'];
			     $plaz=$rozi['Plate'];
			     
	$so=mysqli_query($conn, "INSERT INTO `repair` (`Vehicle`, `Amount`, `Garage`, `Items`, `Issue`, `Date`, `Repair`, `Driver`, `File`, `Purchase`, `Next`, `User`, `Time`, `Trip`, `Plate`, `Type`, `Rate`) VALUES ('$plate', '$ami', '$garage', '0', '$purpo', '$dato', '$purpo', '$driver', '', '0', '0', '$loge', '$Time', '$trip', '$plaz', '0', '$rate')");
		        }
		    }
		
// Edit a given mail receiver record
if(isset($_POST['editobon']))
		{
			$num=$_POST['num'];
				$soso=mysqli_query($conn, "DELETE FROM `dtype` WHERE `Number`='$num' ORDER BY `Number` ASC LIMIT 1");
		}

		// Create a new mail receiver record
if(isset($_POST['eddobon']))
		{
			$datei=$_POST['datei'];
			$namei=$_POST['namei'];
	$so=mysqli_query($conn, "INSERT INTO `dtype` (`Date`, `Type`) VALUES ('$datei', '$namei')");
		}
?>
<div class="container-fluid main-content">
        <div class="page-title">
          <h2 style='margin-top:-20px; margin-bottom: 5px; color:#ffcc33'>
       CashBox
          </h2>
                 </div>
     
        <div class="row">
  <div class="col-lg-2 hidden-print">
   
<ul class="list-group">
        <?php
			 if($_SESSION['Apc']){
			 ?>
	 <li class="list-group-item">
	  <a href="cashbox.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Add to Cashbox
                </p>
              </a></li> 
            <?php
			 }
			  if($_SESSION['Cpe']){
			 ?>
	 <li class="list-group-item active">
	  <a href="madd.php">
                <p>
                <i class="lnr lnr-circle-minus"></i>&nbsp;Make a Payout
                </p>
              </a></li>
              <?php
			  }
			  ?>
      
    <li class="list-group-item">
	  <a href="boxrepo.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;CashBox Report
                </p>
              </a></li> 
	</ul>
			 
  </div>
 <div class="col-md-10">
 <div class="widget-container fluid-height clearfix">
 <div class="widget-content padded">
      <?php
		 if($_SESSION['Cpe']){
			 ?>
 <form method="post" class="form-horizontal" action="" enctype="multipart/form-data">
     <?php
		 }
		 ?>
		 
 <br>
 <?php 
 $amos=number_format(-1*$amo);

if($pto==20)
echo"<center><div class='alert alert-danger' style='width:48%;text-align:center;float:center;background-color: #60c560;color: #ffffff;border-radius:5px;'>
		<i class='lnr lnr-checkmark-circle'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>&times;</button>$amos RWF is removed from your cashbox. </div></center>";
	
			echo"<input value='$code' name='rowid' type='hidden'>";
			?>
			<div class="form-group">
            <label class="control-label col-md-3">Destination</label>
            <div class="col-md-6"><div class='input-group'>
           <select class="form-control" name="emplo" required>
				<option value='' selected='selected'>Select Destination</option>
			 <?php
			$doi=mysqli_query($conn, "SELECT *FROM `dtype` WHERE `Type`!='' ORDER BY `Type` ASC");
			while($roi=mysqli_fetch_assoc($doi)){
				$code=$roi['Number'];
				$fna=$roi['Type'];
			echo"<option value='$code'> $fna </option>";
			}
			?>    
                            </select><span class='input-group-addon'><a href='#' data-placement='top' data-toggle='modal' data-target='#modal-x1123'>
		 <i class="lnr lnr-sync"></i></a></span></div>
					  

					  </div>
 </div><div class="row"></div>
  <div class="form-group">
            <label class="control-label col-md-3">Total Amount</label>
            <div class="col-md-4">
              <input name="amo" class="form-control text-center" type="text" onkeypress='return isNumberKey(event)' onkeyup='format(this);' required></div><div class="col-md-2">
 <SELECT name="pline" class="form-control" onchange='showDiv(this.value);'>
	<OPTION VALUE="CASH" SELECTED>CASH</OPTION>
 <OPTION value='CHEQUE'>CHEQUE</OPTION>
 <OPTION value='DEPOSIT'>DEPOSIT</OPTION>
</SELECT>
                </div>
			  <span style="color:#d43f3a">
                         *
                      </span>  
 </div>


<div class="row"></div>
  <div class="form-group">
            <label class="control-label col-md-3">Invoice No</label>
            <div class="col-md-4">
              <input name="invo" class="form-control text-center" type="text" OnKeyup='return cUpper(this);'></div><div class="col-md-2">
 <SELECT name="tax" class="form-control" required>
	<OPTION VALUE="" SELECTED>SELECT TYPE</OPTION>
	<OPTION VALUE="VAT INCLUSIVE">VAT INCLUSIVE</OPTION>
 <OPTION value='VAT EXCLUSIVE'>VAT EXCLUSIVE</OPTION>
 <OPTION value='NO INVOICE'>NO INVOICE</OPTION>
</SELECT>
                </div>
			  <span style="color:#d43f3a">
                         *
                      </span>  
 </div>




  <div class='form-group'>
 <div id='CHEQUE' class='hiddenDiv' style="padding:0px; height:90px; border:1px solid #ffffff; margin:0px;">

<div class="col-md-3"> </div>
     
     <div class="col-md-6" style="border:1px solid #6666ff; border-radius:5px; padding:20px 0px 20px 0px; margin:0px; background-color:#fcfcf6;">

<div class='col-md-6'> <input class='form-control form-center' name='cheno' type='text' placeholder='CHEQUE No' onkeypress='return isNumberKey(event)' style='height:24px;'></div>
		<div class='col-md-6'><div align='right'><select class='form-control' name='bna' style='height:24px; padding:0px;'>
				<option value='' selected='selected'>ACCOUNT NUMBER</option>
			<?php
			$doi=mysqli_query($conn, "SELECT *FROM `baccount` ORDER BY `Number` ASC");
			while($roi=mysqli_fetch_assoc($doi)){
				$nu=$roi['Number'];
				$fna=$roi['Bank'];
				$acco=$roi['Account'];
				$purpo=$roi['Purpose'];
			echo"<option value='$nu' title='$purpo'> $fna $acco </option>";
			}
			?>   
                            </select></div></div>

	<div class="col-md-6"><div align='right'><br> Date of Payment
			&nbsp;:&nbsp; </div></div><div class="col-md-6"><br>
	<input class="form-control form-center" name="pda" type="text" value="<?php echo $Date ?>" onkeypress='return isNumberKey(event)' style="height:24px;">
		
			</div></div>
                    <div class="col-md-3"> </div>
					</div>
							</div>





 
 <div class="form-group">
 
 <div id='DEPOSIT' class='hiddenDiv' style="padding:0px; height:90px; border:1px solid #ffffff; margin:0px;">
     
     <div class="col-md-3"> </div>
     
     <div class="col-md-6" style="border:1px solid #6666ff; border-radius:5px; padding:20px 0px 20px 0px; margin:0px; background-color:#fcfcf6;">

<div class="col-md-6"> <input class="form-control form-center" name="slino" type="text" placeholder="REFERENCE No" onkeypress='return isNumberKey(event)' style="height:30px;"></div>
		<div class="col-md-6"><div align='right'><select class="form-control" name="acco" style="height:30px; padding:0px;">
				<option value='' selected='selected'>BANK NAME</option>
			<?php
			$doi=mysqli_query($conn, "SELECT `Fnames` FROM `banks` ORDER BY `Fnames` ASC");
			while($roi=mysqli_fetch_assoc($doi)){
				$fna=$roi['Fnames'];
			echo"<option value='$fna'> $fna </option>";
			}
			?>   
                            </select></div></div>
                    <div class="col-md-3"> </div>
             </div></div>
 <div class="form-group">
   <label class="control-label col-md-3">Description</label>
                  <div class="col-md-6">
              <input class="form-control" name="purpo" type="text">
            </div> 
			  <span style="color:#d43f3a">
                         *
                      </span>  
			</div>

			
 <div class="form-group">
   <label class="control-label col-md-3">Paid To </label>
                  <div class="col-md-6">
              <input class="form-control" name="payto" type="text" id="searcha">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <font size='1'>(Receiver)</font></div> 
			  <span style="color:#d43f3a">
                         *
                      </span>  
			</div><div class="row"></div>

<div class="form-group" style="margin-top:-10px;">
  <div class="col-md-6"> </div>
  <div class="col-md-3 text-right" style="margin-top:-20px;">
      
     <a href="javascript:myFunction()" style="font-size:14px;padding-right:20px;">Add Vehicle</a>
</div></div>

<div class="form-group" style="margin-top:-10px;">
  <div class="col-md-3" style="border:1px solid #ffffff;"> </div><div class="col-md-6" style="border:1px solid #ffffff; padding-bottom:0px; text-align:center;">
<div id="myDIV" style="display:none; border:1px solid powderblue; border-radius:5px; margin-bottom:0px; height:95px; text-align:center; padding-top:10px;">
  <label class="control-label col-sm-6" style="text-align:center"><i class="fa fa-truck"></i> Vehicle ID <br><select class="form-control" name="plate" style="font-size:16px; height:34px;">
	 <option value=''> </option>
<?php
$do=mysqli_query($conn, "SELECT `Number`, `Plate` FROM `vehicles` WHERE `Status`='0' ORDER BY `Plate` ASC");
		while($ro=mysqli_fetch_assoc($do)){
			$numb=$ro['Number'];
			$plate=$ro['Plate'];
			echo"<option value='$numb'> $plate </option>";
		}
		?>
		</select> </label>
  <label class="control-label col-sm-6" style="text-align:center"><i class="fa fa-bars"></i> Repair/Service Type <br><select class="form-control" name="garage" style="font-size:16px; height:34px;">
	 <option value=''> Select Type </option>
<?php
$doz=mysqli_query($conn, "SELECT `Name` FROM `garage` ORDER BY `Name` ASC");
		while($roz=mysqli_fetch_assoc($doz)){
			$name=$roz['Name'];
			echo"<option value='$name'> $name </option>";
		}
		?>
		</select> </label>
</div>
  
        </div><div class="col-md-6"> </div></div></div>
        <div class="row"></div>
        
  <div class="form-group" style="margin-top:-20px; padding-top:0px;">
            <label class="control-label col-md-3"><br>Done&nbsp;by</label>
            <div class="col-md-2" style='margin-right:30px;'>
              <br><input name="user" class="form-control" value="<?php echo $user ?>" type="text" style='width:210px;' readonly> &nbsp;&nbsp; </div> 

			  <label class="control-label col-md-1"><br>Date</label>
			<div class="col-md-5"><br><input name="dato" id="from" class="form-control" value="<?php echo $dato ?>" type="text" style='width:210px; text-align:center;' required>
            </div> 
        </div><div class="row"></div>

 <div class="form-group">
  <label class="control-label col-md-2"> </label>
    <label class="control-label col-md-3">Document File</label>
                     <div class="col-md-1">
              <div class="fileupload fileupload-new" data-provides="fileupload"><input value="<?php echo $rowid ?>" name="rowid" type="hidden">
                <span class="btn btn-default btn-file"><span class="fileupload-new">Select</span><span class="fileupload-exists">Change</span><input name="file1" id="app_file" type="file" readonly='readonly'></span><span class="fileupload-preview"></span><button class="close fileupload-exists" data-dismiss="fileupload" style="float:none" type="button">×</button>
		<?php echo $dfile ?>
				
                     
              </div></div>     &nbsp;&nbsp;&nbsp;&nbsp;<small>Zip, txt, jpeg, png, pdf, doc (Max : 2M)</small>
            </div>
            </div>

  
  <div class="form-group">
  <div class="col-md-12">
		<div class="col-sm-2"> </div>
		 <div class="col-sm-7" align='center' style='border:0px solid black; margin:10px 10px 30px; 10px;'>
		 <?php
		 if($_SESSION['Cpe']){
			 ?>
		 <button class="btn btn-lg btn-block btn-info" type="submit" name="mois"><i class="lnr lnr-exit-up"></i>&nbsp;&nbsp;SAVE </button></form> 
		 <?php
		}









			 // ********************************************* Charge Types **************************************************************
	echo"<div id='modal-x1123' class='modal fade' role='dialog'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLabel'> CREATE A NEW TYPE
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </h5>

      </div>
      <div class='modal-body' style='height:400px; overflow-x:auto;'>
	  <table class='table table-striped table-hover' style='margin-top:-15px;'>";
			$stl="padding:0px 2px; 0px 2px";
			$clr="";
	  

		print("<tr><form method='post' action=''><td class='hidden-xs' style='$stl $clr'>
		<div align='center'>&nbsp;&nbsp;&nbsp;&nbsp;1&nbsp;&nbsp;</td><td style='$stl $clr'><div align='left'>
						<input name='datei' class='form-control' type='text' style='text-align:center; width:120px; height:24px; margin:0px 0px 0px 0px; padding:0px 10px 0px 10px; background-color:transparent;' onChange=this.style.color='#ff3366' value='$Date' id='from'></td>

						<td style='$stl $clr'><div align='left'>
						<input name='namei' class='form-control' type='text' style='text-align:left; width:320px; height:24px; margin:0px 0px 0px 0px; padding:0px 10px 0px 10px; background-color:transparent;' onChange=this.style.color='#ff3366'></td>

				<td style='$stl $clr'><div align='center'><button type='submit' class='btn btn-xs btn-success hidden-print' name='eddobon' style='height:22px; margin:0px 0px 0px 0px; padding:0px;' title='Add New' data-toggle='tooltip' data-placement='top'>&nbsp;&nbsp;<i class='lnr lnr-plus-circle'></i>&nbsp;&nbsp;</button></td></form></tr>");

				$i=2;
	  $dob=mysqli_query($conn, "SELECT *FROM `dtype` ORDER BY `Type` ASC");
		while($rob=mysqli_fetch_assoc($dob)){
			$num=$rob['Number'];
			$date=$rob['Date'];
			$acco=$rob['Type'];

			print("<tr style='height:10px;'><form method='post' action=''>
			<td class='hidden-xs' style='$stl $clr'><div align='center'>&nbsp;&nbsp;&nbsp;&nbsp;$i&nbsp;&nbsp;</td>
						<td style='$stl $clr'><div align='left'><input type='hidden' name='numu' value='$numu'>
						<input name='date' class='form-control' type='text' style='text-align:center; width:120px; height:24px; margin:0px 0px 0px 0px; padding:0px 10px 0px 10px; background-color:transparent;' value='$date' onChange=this.style.color='#ff3366'></td>

						<td style='$stl $clr'><div align='left'><input type='hidden' name='num' value='$num'>
						<input name='name' class='form-control' type='text' style='text-align:left; width:320px; height:24px; margin:0px 0px 0px 0px; padding:0px 10px 0px 10px; background-color:transparent;' value='$acco' onChange=this.style.color='#ff3366'></td>

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
 
 </form>
 </div>
 </div>
 </div>
 </div> 
</div>  
   <?php
   include'footer.php';
   ?>