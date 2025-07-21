<?php
if(basename($_SERVER['PHP_SELF']) == 'dispatch.php') 
  $nv=" class='current'";
include'header.php';
include'connection.php';
$custo=$conde=$condi='';
$code=$p=0;

if(isset($_POST['delox']))
		{
			$rowid=$_POST['code'];
	$do=mysqli_query($conn, "UPDATE `trips` SET `Status`='1' WHERE `Status`='0' AND `Number`='$rowid' ORDER BY `Number` DESC LIMIT 1");
		}

if(isset($_POST['search']))
		{
			$custo=$_POST['custo'];
			$custor=$custo;
		}

		
		if(!$custo){
			$condi="";
			$conde='';
			$lim=15;
		}
		else{
	$conde="AND (`Plate` LIKE '%$custo%' OR `Location` LIKE '%$custo%' OR `Destination` LIKE '%$custo%' OR `Final` LIKE '%$custo%' OR `Description` LIKE '%$custo%' OR `Number`='$custo')";
			$lim=9999;
			$condi='';
		}

		if($custo=='*' OR $custo=='all' OR $custo=='All' OR $custo=='ALL'){
			$condi="";
			$conde='';
			$lim=9999;
		}

		

if(isset($_POST['savedi']))
		{
			$pla=$_POST['plate'];
			$desti=str_replace("'", "`", $_POST['desti']);
			$loca=str_replace("'", "`", $_POST['loca']);
			$final=str_replace("'", "`", $_POST['final']);
			$capa=str_replace(',', '', $_POST['capa']);
			$dista=str_replace(',', '', $_POST['dista']);
			$descri=str_replace("'", "`", $_POST['descri']);
			$duda=$_POST['duda'];
			$etd=$_POST['etd'];
			$eta=$_POST['eta'];
	
$doi=mysqli_query($conn, "SELECT `Plate`, `Driver` FROM `vehicles` WHERE `Number`='$pla'");
			$roi=mysqli_fetch_assoc($doi);
				$fna=$roi['Plate'];
				$dri=$roi['Driver'];
				
	 $eld = strtotime("+3 day", strtotime("$etd"));
				$eld=date("Y-m-d", $eld);
				
	 $ead = strtotime("+7 day", strtotime("$etd"));
				$ead=date("Y-m-d", $ead);
			
$set=mysqli_query($conn, "INSERT INTO `trips` (`Date`, `Time`, `User`, `Vehicle`, `Destination`, `Location`, `Final`, `Capacity`, `Distance`, `ETD`, `ETA`, `Description`, `Status`, `Plate`, `Driver`, `Stadate`, `Destin`, `Findes`, `ELD`, `EAD`) VALUES ('$duda', '$Time', '$loge', '$pla', '$desti', '$loca', '$final', '$capa', '$dista', '$etd', '$eta', '$descri', '0', '$fna', '$dri', '$etd', '$loca', '$final', '$eld', '$ead')");

	$seti=mysqli_query($conn, "SELECT `Number` FROM `trips` WHERE `Vehicle`='$pla' ORDER BY `Number` DESC LIMIT 1");
			    $reti=mysqli_fetch_assoc($seti);
			    $trino=$reti['Number'];	
	$then=mysqli_query($conn, "UPDATE `vehicles` SET `Tripo`='$trino' WHERE `Number`='$pla' AND `Plate`='$fna' ORDER BY `Number` ASC LIMIT 1");
		}
	
		
		
if(isset($_POST['savall']))
		{
			$desti=str_replace("'", "`", $_POST['desti']);
			$loca=str_replace("'", "`", $_POST['loca']);
			$final=str_replace("'", "`", $_POST['final']);
			$capa=str_replace(',', '', $_POST['capa']);
			$dista=str_replace(',', '', $_POST['dista']);
			$descri=str_replace("'", "`", $_POST['descri']);
			$etd=$_POST['etd'];
			$eta=$_POST['eta'];
			$a=$_POST['a'];
			
			for($t=1; $t<=$a; $t++){
			$pla=$_POST["plate$t"];
	if($pla){
$doi=mysqli_query($conn, "SELECT `Plate`, `Driver` FROM `vehicles` WHERE `Number`='$pla'");
			$roi=mysqli_fetch_assoc($doi);
				$fna=$roi['Plate'];
				$dri=$roi['Driver'];
				
	 $eld = strtotime("+3 day", strtotime("$etd"));
				$eld=date("Y-m-d", $eld);
				
	 $ead = strtotime("+7 day", strtotime("$etd"));
				$ead=date("Y-m-d", $ead);
			
$set=mysqli_query($conn, "INSERT INTO `trips` (`Date`, `Time`, `User`, `Vehicle`, `Destination`, `Location`, `Final`, `Capacity`, `Distance`, `ETD`, `ETA`, `Description`, `Status`, `Plate`, `Driver`, `Stadate`, `Destin`, `Findes`, `ELD`, `EAD`) VALUES ('$Date', '$Time', '$loge', '$pla', '$desti', '$loca', '$final', '$capa', '$dista', '$etd', '$eta', '$descri', '0', '$fna', '$dri', '$etd', '$loca', '$final', '$eld', '$ead')");
        $trino=mysqli_insert_id($conn);

	$then=mysqli_query($conn, "UPDATE `vehicles` SET `Tripo`='$trino', `Locate`='' WHERE `Number`='$pla' AND `Plate`='$fna' ORDER BY `Number` ASC LIMIT 1");
	
	
            if($_POST['customer']){
			$customer=$_POST['customer'];
			$amo=str_replace(',', '', $_POST['amo']);
			$curr=$_POST['currency'];
	$so=mysqli_query($conn, "INSERT INTO `income` (`Date`, `Vehicle`, `Distance`, `Driver`, `Weight`, `District`, `Location`, `Descri`, `Amount`,  `Status`, `Rate`, `Customer`, `User`, `Time`, `Trip`, `External`, `Plate`) VALUES ('$Date', '$pla', '$dista', '$dri', '$capa', '$dista', '$loca', '$descri', '$amo', '0', '$curr', '$customer', '$loge', '$Time', '$trino', '1', '$fna')");
            }
            
		}
		}
		}
			


	if(isset($_POST['usavedi']))
		{
			$pla=$_POST['plate'];
			$desti=str_replace("'", "`", $_POST['desti']);
			$loca=str_replace("'", "`", $_POST['loca']);
			$final=str_replace("'", "`", $_POST['final']);
			$capa=str_replace(',', '', $_POST['capa']);
			$dista=str_replace(',', '', $_POST['dista']);
			$descri=str_replace("'", "`", $_POST['descri']);
			$rowid=$_POST['rowid'];
			$duda=$_POST['duda'];
			$etd=$_POST['etd'];
			$eta=$_POST['eta'];
	
$doi=mysqli_query($conn, "SELECT `Plate`, `Driver` FROM `vehicles` WHERE `Number`='$pla'");
			$roi=mysqli_fetch_assoc($doi);
				$fna=$roi['Plate'];
				$dri=$roi['Driver'];
				
$set=mysqli_query($conn, "UPDATE `trips` SET `Date`='$duda', `User`='$loge', `Vehicle`='$pla', `Destination`='$desti', `Location`='$loca', `Final`='$final', `Capacity`='$capa', `Distance`='$dista', `ETD`='$etd', `ETA`='$eta', `Description`='$descri', `Plate`='$fna', `Driver`='$dri' WHERE `Number`='$rowid' ORDER BY `Number` ASC LIMIT 1");
		}

	if(isset($_POST['open']))
		{
			$code=$_POST['rowid'];
			$custo=$_POST['custo'];
			$custor=$custo;
			$p=1;
		}
		
	    if(isset($_POST['reque']))
		    {
			$code=$_POST['code'];
			$custo=$_POST['custo'];
			$rowid=$_POST['rowid'];
			$custor=$custo;
			$p=1;
			$reso=str_replace("'", "`", $_POST['reso']);
$doxe=mysqli_query($conn, "UPDATE `income` SET `Reason`='$reso', `Rby`='$loge' WHERE `Number`='$rowid' ORDER BY `Number` ASC LIMIT 1");
		    }
		
	    if(isset($_POST['requet']))
		    {
			$code=$_POST['code'];
			$custo=$_POST['custo'];
			$rowid=$_POST['rowid'];
			$custor=$custo;
			$p=1;
			$resot=str_replace("'", "`", $_POST['resot']);
$doxe=mysqli_query($conn, "UPDATE `repair` SET `Reason`='$resot', `Rby`='$loge' WHERE `Number`='$rowid' ORDER BY `Number` ASC LIMIT 1");
		    }
		
		
		if(isset($_POST['depo']))
		{
			$code=$_POST['rowid'];
			$custo=$_POST['custo'];
			$custor=$custo;
			$p=$_POST['p'];
			$dai=$_POST['dai'];
			$descri=str_replace("'", "`", $_POST['descri']);
$set=mysqli_query($conn, "INSERT INTO `trip_note` (`Date`, `Time`, `User`, `Trip`, `Comment`) VALUES ('$dai', '$Time', '$loge', '$code', '$descri')");
		}	
		
		
		if(isset($_POST['dedelo']))
		{
			$nums=$_POST['nums'];
			$code=$_POST['rowid'];
			$custo=$_POST['custo'];
			$custor=$custo;
			$p=$_POST['p'];
	$set=mysqli_query($conn, "DELETE FROM `trip_note` WHERE `Number`='$nums'");
		}
		
	if(isset($_POST['toll']))
		{
			$code=$_POST['code'];
			$plat=$_POST['plat'];
			$dato=$_POST['dato'];
			$pri=str_replace(',', '', $_POST['amo']);
			$curre=str_replace(',', '', $_POST['curre']);
			$amo=$pri*$curre;
			$descri=str_replace("'", "`", $_POST['descri']);
			$dri=str_replace("'", "`", $_POST['drive']);
			$type=$_POST['type'];
			$rate=$_POST['curre'];
			if($type=='OTHER EXPENSE')
			    $ty=1;
			else
			    $ty=0;
			    
		$doi=mysqli_query($conn, "SELECT `Plate` FROM `vehicles` WHERE `Number`='$plat'");
			$roi=mysqli_fetch_assoc($doi);
				$fna=$roi['Plate'];
				
	$set=mysqli_query($conn, "INSERT INTO `repair` (`Vehicle`, `Amount`, `Garage`, `Items`, `Issue`, `Date`, `Repair`, `Driver`, `Trip`, `User`, `Time`, `External`, `Plate`, `Type`, `Rate`) VALUES ('$plat', '$amo', '$type', '0', '$descri', '$dato', '', '$dri', '$code', '$loge', '$Time', '1', '$fna', '$ty', '$rate')");
		}


	if(isset($_POST['saves']))
		{
			$code=$_POST['code'];
			$dato=$_POST['dato'];
			$dist=$_POST['dist'];
			$plate=$_POST['plate'];
			$driv=str_replace("'", "`", $_POST['driv']);
			$descri=str_replace("'", "`", $_POST['descri']);
			$loco=str_replace("'", "`", $_POST['loco']);
			$amo=preg_replace('/,/', '', $_POST['amo']);
			$wei=preg_replace('/,/', '', $_POST['wei']);
			$dista=preg_replace('/,/', '', $_POST['dista']);
			$curr=$_POST['currency'];
			$custo=$_POST['custo'];
			
	$doi=mysqli_query($conn, "SELECT `Plate` FROM `vehicles` WHERE `Number`='$plate'");
			$roi=mysqli_fetch_assoc($doi);
				$fna=$roi['Plate'];

	$so=mysqli_query($conn, "INSERT INTO `income` (`Date`, `Vehicle`, `Distance`, `Driver`, `Weight`, `District`, `Location`, `Descri`, `Amount`,  `Status`, `Rate`, `Customer`, `User`, `Time`, `Trip`, `External`, `Plate`) VALUES ('$dato', '$plate', '$dista', '$driv', '$wei', '$dist', '$loco', '$descri', '$amo', '0', '$curr', '$custo', '$loge', '$Time', '$code', '1', '$fna')");
		}
		
		
			if(isset($_POST['delete_id']))
		        {
			$code=$_POST['code'];
			$rowid=$_POST['rowid'];
	$then=mysqli_query($conn, "DELETE FROM `repair` WHERE `Number`='$rowid' LIMIT 1");

	$doi=mysqli_query($conn, "SELECT *FROM `stouse` WHERE `Repair`='$rowid'");
			while($roi=mysqli_fetch_assoc($doi)){
				$numu=$roi['Number'];
				$qts=$roi['Quantity'];
				$its=$roi['Item'];
				$stor=$roi['Store'];
	$then=mysqli_query($conn, "DELETE FROM `stouse` WHERE `Number`='$numu' LIMIT 1");
	
		if($stor)
	$doin=mysqli_query($conn, "UPDATE `items` SET `Quantity`=`Quantity`+'$qts' WHERE `Number`='$its' ORDER BY `Number` DESC LIMIT 1");
			}

		}
		
		if(isset($_POST['delete_idi']))
		        {
			$code=$_POST['code'];
			$rowid=$_POST['rowid'];
	$then=mysqli_query($conn, "DELETE FROM `income` WHERE `Number`='$rowid' LIMIT 1");
			}

			if(isset($_POST['delete_ids']))
		        {
			$code=$_POST['code'];
			$rowid=$_POST['rowid'];
	$then=mysqli_query($conn, "DELETE FROM `consumption` WHERE `Number`='$rowid' LIMIT 1");
			}

	if(isset($_POST['deloge']))
		{
			$code=$_POST['code'];
			$rowid=$_POST['rowid'];

			$numu=$_POST['numu'];
			$qts=$_POST['qts'];
			$ites=$_POST['ites'];
			$stor=$_POST['stor'];
	$then=mysqli_query($conn, "DELETE FROM `stouse` WHERE `Number`='$numu' LIMIT 1");
	
		if($stor)
	$doin=mysqli_query($conn, "UPDATE `items` SET `Quantity`=`Quantity`+'$qts' WHERE `Number`='$ites' ORDER BY `Number` DESC LIMIT 1");
		}
		
	if(isset($_POST['editrip']))
		{
		$code=$_POST['rowid'];
		$custo=$_POST['custo'];
		$cods=$_POST['cods'];
		$custor=$custo;
			
		$amos=preg_replace('/,/', '', $_POST['amos']);
		$rats=preg_replace('/,/', '', $_POST['rats']);
		$amos=$amos*$rats;
	$set=mysqli_query($conn, "UPDATE `repair` SET `Amount`='$amos', `Rate`='$rats' WHERE `Number`='$cods' ORDER BY `Number` ASC LIMIT 1");
			$p=1;
		    }

		if($code)
			$condi="AND `Number`='$code'";


$doj=mysqli_query($conn, "SELECT *FROM `trips` WHERE `Status`='0' $conde $condi ORDER BY `Number` DESC LIMIT $lim");
$fo=mysqli_num_rows($doj);
?>

<script>
$(document).ready(function() {
$('input[type="checkbox"]').change(function(){
var total_checked=  $("input[type='checkbox']:checked").length 
$("#d1").html("Selected Vehicles: <b> " + total_checked );
});
/////////////
var total_checked=  $("input[type='checkbox']:checked").length 
$("#d1").html("Selected Vehicles: <b> " + total_checked );
///////
});


   function check_uncheck_checkbox(isChecked) {
	if(isChecked) {
		$('input[type="checkbox"]').each(function() { 
			this.checked = true; 
		});
	} else {
		$('input[type="checkbox"]').each(function() {
			this.checked = false;
		});
	}
}	
</script>

<div class="container-fluid main-content">
        <div class="page-title hidden-print">
          <h2 style='margin-top:-20px; margin-bottom: 5px; color:#ffcc33'>
         Vehicles
          </h2>
  
    </div>
   <div class="row">
  <div class="col-lg-2 hidden-print">
   
  <ul class="list-group">
                  
			  <li class="list-group-item">
              <a href="ment.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Repair & Services
                </p>
              </a></li>

    <li class="list-group-item">
	  <a href="mainsto.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;List of Vehicles
                </p>
              </a></li> 

	   <li class="list-group-item">
              <a href="crete.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Create a Vehicle
                </p>
              </a></li>  

	   <li class="list-group-item">
              <a href="tools.php">
                <p>
                <i class="lnr lnr-book"></i>&nbsp;Tools & Materials
                </p>
              </a></li>   

	   <li class="list-group-item">
              <a href="notes.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Notifications
                </p>
              </a></li> 
                       
            </ul><br><br>

			<li class="list-group-item" style="border:1px dashed #cccccc; border-radius:5px; margin:0px 0px 4px 0px;">
	  <a href="createa.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Create Customers
                </p>
              </a></li>	
              
            <li class="list-group-item active" style="border:1px dashed #cccccc; border-radius:5px; margin:0px 0px 4px 0px;">
	  <a href="dispatch.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Create Vehicle Trip
                </p>
              </a></li>	
            
                <?php
              if($_SESSION['Cpo']){
                  ?>
			  <li class="list-group-item" style="border:1px dashed #cccccc; border-radius:5px; margin:0px 0px 4px 0px;">
              <a href="purcha.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Purchase Orders
                </p>
              </a></li>
              <?php
              }
              if($_SESSION['Cpi']){
                  ?>
            <li class="list-group-item" style="border:1px dashed #cccccc; border-radius:5px; margin:0px 0px 4px 0px;">
	  <a href="profo.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Create Proforma
                </p>
              </a></li>	
              <?php
              }
              ?>
              
            <li class="list-group-item" style="border:1px dashed #cccccc; border-radius:5px; margin:0px 0px 4px 0px;">
	  <a href="payslip.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Payment Vouchers
                </p>
              </a></li>	
              
            <li class="list-group-item" style="border:1px dashed #cccccc; border-radius:5px; margin:0px 0px 4px 0px;">
	  <a href="conterepo.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Container Dispatch
                </p>
              </a></li>		
  </div>
                    
           
           
       

	   <?php
	   // ***************** Create a single trip record *********************
	    echo"<div class='modal fade' id='Modaldis' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
  <div class='modal-dialog' role='document'><div class='modal-content'><div class='modal-header text-left'>
        <h5 class='modal-title' id='exampleModalLabel'>CREATE NEW TRIP 
        <span class='pull-right'>  </span></h5>

      </div><form action='' method='post'>
      <div class='modal-body text-left'><div class='row'>
      
       <div class='form-group'>	 
			  <div class='col-md-5' align='right'>
			  <label class='control-label'>Due Date</label>
			</div>	

	 <div class='col-md-6'>
          <div class='input-group date' data-provide='datepicker'><input class='form-control form-center' name='duda' type='text' value='$Date' onkeypress='return isNumberKey(event)' style='padding-left:2px; padding-right:2px;' required><div class='input-group-addon'><span class='lnr lnr-calendar-full'></span></div></div>
            </div>
		</div>

        <div class='form-group'>
			<div class='col-md-5' align='right'> 
            <label class='control-label'>Vehicle&nbsp;ID</label></div>
            <div class='col-md-6'>
<select class='form-control' name='plate' style='font-size:16px; height:34px;' required>
	 <option value=''> </option>";

$do=mysqli_query($conn, "SELECT `Number`, `Plate` FROM `vehicles` WHERE `Status`='0' AND `Trip`='1' ORDER BY `Plate` ASC");
		while($ro=mysqli_fetch_assoc($do)){
			$numb=$ro['Number'];
			$plate=$ro['Plate'];
			echo"<option value='$numb'> $plate </option>";
		}
		
		echo"</select>
            </div>          
		</div>
			
			 	
		 <div class='form-group'>	 
			  <div class='col-md-5' align='right'>
			  <label class='control-label'>Trip Destination</label></div>	

	 <div class='col-md-6'>
          <input name='desti' class='form-control' type='text'>
            </div>
		</div>

		<div class='form-group'>	 
			  <div class='col-md-5' align='right'>
			  <label class='control-label'>Package Location</label></div>	

	 <div class='col-md-6'>
          <input name='loca' class='form-control' type='text'>
            </div>
		</div>


		 <div class='form-group'>
			<div class='col-md-5' align='right'> 
            <label class='control-label'>Final Destination</label></div>
            <div class='col-md-6'>
           <input name='final' class='form-control' type='text'>
            </div>
		</div>


		 <div class='form-group'>
			<div class='col-md-5' align='right'> 
            <label class='control-label'>Capacity / Distance</label></div>
            <div class='col-md-3'><div class='input-group'>
           <input name='capa' class='form-control' type='text' style='text-align:center;' onkeyup='format(this);' onkeypress='return isNumberKey(event)'><span class='input-group-addon text-info'>TON</span>
            </div></div>
            <div class='col-md-3'><div class='input-group'>
           <input name='dista' class='form-control' type='text' style='text-align:center;' onkeyup='format(this);' onkeypress='return isNumberKey(event)'><span class='input-group-addon text-info'>KM</span>
            </div></div>
		</div><div class='row'></div>
		
		<div class='form-group'>
			<div class='col-md-5' align='right'> 
            <label class='control-label'>ETD / ETA</label></div>
            <div class='col-md-3' style='padding-right:0px;'><br class='hidden-xs'><div class='input-group date' data-provide='datepicker'><input class='form-control form-center' name='etd' type='text' value='$Date' onkeypress='return isNumberKey(event)' style='padding-left:2px; padding-right:2px;' required><div class='input-group-addon'><span class='lnr lnr-calendar-full'></span></div></div>
            </div>
            
             <div class='col-md-3' style='padding-left:0px;'><br class='hidden-xs'><div class='input-group date' data-provide='datepicker'><input class='form-control form-center' name='eta' type='text' value='$Date' onkeypress='return isNumberKey(event)' style='padding-left:2px; padding-right:2px;' required><div class='input-group-addon'><span class='lnr lnr-calendar-full'></span></div></div>
             </div>
		</div><div class='row'></div>


		<div class='form-group'>
   <div class='col-md-5' align='right'><br class='hidden-xs'>
			  <label class='control-label'>Description</label></div>

 <div class='col-md-6'>
<textarea class='form-control' name='descri' style='height:60px; font-size:14px;'></textarea>
	</div>
	
	</div></div>
		
	</div><div class='modal-header text-right' style='height:50px; padding-top:15px;'><a href='' class='pull-left text-left' data-toggle='modal' data-target='#Modaldisc' data-dismiss='modal' style='padding-top:3px; margin-left:40px;'>Trip Bulk Record</a>	
		<button type='button' class='btn btn-xs btn-danger' data-dismiss='modal' style='width:80px;'> CANCEL </button>
        <button type='submit' name='savedi' class='btn btn-xs btn-success' style='width:80px;'> SAVE </button></div>
      </form>
  </div></div>
</div>";




	   // *************** Create a bulk trip record **********************
	    echo"<div class='modal fade' id='Modaldisc' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
  <div class='modal-dialog' role='document' style='width:70%;'>
  <div class='modal-content'><div class='modal-header text-left'>
        <h5 class='modal-title' id='exampleModalLabel'>CREATE TRIP BULK RECORD 
        <span class='pull-right'>  </span></h5>

      </div><form action='' method='post'>
      <div class='modal-body text-left'><div class='row'>

    <div class='col-md-6 text-center' style='height:360px; overflow-x:auto;'>";
        
        $a=1;
    $do=mysqli_query($conn, "SELECT `Number`, `Plate` FROM `vehicles` WHERE `Status`='0' AND `Trip`='1' ORDER BY `Plate` ASC");
		while($ro=mysqli_fetch_assoc($do)){
			$numb=$ro['Number'];
			$plate=$ro['Plate'];
	echo"<label class='btn btn-default active' for='my$a' style='width:110px;' title='$plate' data-toggle='tooltip' data-placement='top'>
          <input id='my$a' type='checkbox' value='$numb' name='plate$a' style='border:0px; height:12px;'> $plate </label>";
                 $a++;
		}
    
    
    
    echo"</div><div class='col-md-6'>
    
        	 	
		 <div class='form-group'>	 
			  <div class='col-md-4' align='right'>
			  Trip Destination</div>	

	 <div class='col-md-8'>
          <input name='desti' class='form-control' type='text'>
            </div>
		</div>

		<div class='form-group'>	 
			  <div class='col-md-4' align='right'>
			  Package Location</div>	

	 <div class='col-md-8'>
          <input name='loca' class='form-control' type='text'>
            </div>
		</div>


		 <div class='form-group'>
			<div class='col-md-4' align='right'> 
            Final Destination</div>
            <div class='col-md-8'>
           <input name='final' class='form-control' type='text'>
            </div>
		</div>


		 <div class='form-group'>
			<div class='col-md-4' align='right'> 
            Capacity / Distance</div>
            <div class='col-md-4'><div class='input-group'>
           <input name='capa' class='form-control' type='text' style='text-align:center;' onkeyup='format(this);' onkeypress='return isNumberKey(event)'><span class='input-group-addon text-info'>TON</span>
            </div></div>
            <div class='col-md-4'><div class='input-group'>
           <input name='dista' class='form-control' type='text' style='text-align:center;' onkeyup='format(this);' onkeypress='return isNumberKey(event)'><span class='input-group-addon text-info'>KM</span></div></div>
		</div>
		
		<div class='form-group'>
			<div class='col-md-4' align='right'> 
            <br class='hidden-xs'>ETD / ETA</div>
        <div class='col-md-4' style='padding-right:0px;'><br class='hidden-xs'><div class='input-group date' data-provide='datepicker'><input class='form-control form-center' name='etd' type='text' value='$Date' onkeypress='return isNumberKey(event)' style='padding-left:2px; padding-right:2px;' required><div class='input-group-addon'><span class='lnr lnr-calendar-full'></span></div></div>
        </div>
            
        <div class='col-md-4' style='padding-left:0px;'><br class='hidden-xs'><div class='input-group date' data-provide='datepicker'><input class='form-control form-center' name='eta' type='text' value='$Date' onkeypress='return isNumberKey(event)' style='padding-left:2px; padding-right:2px;' required><div class='input-group-addon'><span class='lnr lnr-calendar-full'></span></div></div>
             </div></div><div class='row'> </div><br>
		

		<div class='form-group'>
   <div class='col-md-4' align='right'><br class='hidden-xs'>
		Description</div>

 <div class='col-md-8'>
<textarea class='form-control' name='descri' style='height:60px; font-size:14px;'></textarea>
	</div></div><div class='row'> </div><br><br>
	
	
            
		<div class='form-group'>	 
			  <div class='col-md-4' align='right'><br class='hidden-xs'><br class='hidden-xs'> Customer Name</div>	

	 <div class='col-md-8'><br class='hidden-xs'><br class='hidden-xs'>
          <select class='form-control' name='customer' style='font-size:16px; height:34px;'>
	 <option value=''> Select a Customer </option>";

$doz=mysqli_query($conn, "SELECT `Number`, `Customer` FROM `account` WHERE `Status`='0' ORDER BY `Customer` ASC");
		while($roz=mysqli_fetch_assoc($doz)){
			$cust=$roz['Customer'];
			$cods=$roz['Number'];
	echo"<option value='$cods'> $cust </option>";
		}
		
		echo"</select>
            </div>
		</div>
		
			<div class='form-group'>	 
			  <div class='col-md-4' align='right'><br class='hidden-xs'> Total Amount</div>	

	 <div class='col-md-5'><br class='hidden-xs'>
    <input class='form-control form-center' name='amo' type='text' onkeyup='format(this);' onkeypress='return isNumberKey(event)' required></div>
        
    <div class='col-md-3'><br class='hidden-xs'>
    <select class='form-control' name='currency' required>
				<option value='' selected='selected'>Currency</option>";
			 
			$doi=mysqli_query($conn, "SELECT `Code`, `Rate` FROM `currency` WHERE `Code`!='' ORDER BY `Code` ASC");
			while($roi=mysqli_fetch_assoc($doi)){
				$fna=$roi['Code'];
				$rate=$roi['Rate'];
				$rte=number_format($rate, 2);
			echo"<option value='$rate'> $fna @ $rte </option>";
			}
	
		  echo"</select>
            </div>
		</div>
		
		
		</div>
	
	</div></div>
	    
	            <input type='hidden' name='a' value='$a'>	
	<div class='modal-header text-right' style='height:50px; padding-top:15px;'>
	
	<label class='pull-left text-left' style='margin-left:40px;'>
	
	<input type='checkbox' name='checkall' id='checkall' style='height:22px; width:24px; margin-top:0px;' onClick='check_uncheck_checkbox(this.checked);'> &nbsp; <button type='button' class='btn btn-secondary' id='d1' style='margin-top:-10px;'></button></label>
    
		<button type='button' class='btn btn-xs btn-danger' data-dismiss='modal' style='width:80px;'> CANCEL </button>
        <button type='submit' name='savall' class='btn btn-xs btn-success' style='width:80px;'> SAVE </button></div>
      </form>
  </div></div>
</div>";
?>
        <div class="col-lg-10">
                  <div class="row hidden-print">
         
           <div class="col-lg-2" style="margin-left:40px;">
               <?php
             if($_SESSION['Cnt']){
                 ?>
       <button class="btn  btn-warning btn-block" type="button" data-toggle='modal' data-target='#Modaldis'> Create New Trip </button>
       <?php
             }
             ?>
						</div>
          
         
           

        <form action="" method="post" class="form-horizontal ">                  
                       <div class="col-lg-9 no-print"><div class="col-lg-6 text-center"> 					
					<?php
	if($pto==80)
echo"<center><div class='alert alert-danger' style='width:80%; text-align:center; float:center; border-radius:5px; height:32px; padding-top:5px; margin-bottom:0px;'><i class='lnr lnr-cross-circle'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>&times;</button>
		Container was already created before. </div></center>";
		
	if($pto==100)
echo"<center><div class='alert alert-danger' style='width:80%; text-align:center; float:center; border-radius:5px; height:32px; padding-top:5px; margin-bottom:0px;'><i class='lnr lnr-cross-circle'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>&times;</button>
		Container is full. </div></center>";

if($pto==200)
echo"<center><div class='alert alert-success' style='width:80%; text-align:center; float:center; border-radius:5px; height:32px; padding-top:5px; margin-bottom:0px;'><i class='lnr lnr-checkmark-circle'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>&times;</button>
		Package is added successfull. </div></center>";

if($pto==330)
echo"<center><div class='alert alert-warning' style='width:80%; text-align:center; float:center; border-radius:5px; height:32px; padding-top:5px; margin-bottom:0px;'><i class='lnr lnr-checkmark-circle'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>&times;</button>
		Cost is added successfull. </div></center>";
		?>
					   </div>
            <div class="col-lg-4"> 
      <input class="form-control"  name="custo" type="text" value="<?php echo $custo ?>" id="searcho" required>
			</div>                      
                       
                       <div class="col-lg-2">
                        <button class="btn  btn-primary btn-block" type="submit" name="search"><i class="lnr lnr-magnifier"></i> Search</button>
                   
					  </div>
                         </div> 
                      
                     
                  
            </form> 
             
               
            </div>
             <div class="row">
            <div class="col-lg-12" style='margin-top:-20px;'>
             <span>Total Records Found : <b><?php echo" $fo " ?></b></span>
			  <span class="pull-right"><a href="#" onclick="return window.print()" class="hidden-print" title='Print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a>&nbsp;&nbsp;&nbsp;</span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">

<div class="table-responsive">
			<table class="table table-striped table-hover table-sm" style="font-size:8px;">     
                                      <thead>
                    <tr role="row"> 
					<th width='4px'> &nbsp;No&nbsp;</th>
		<th class="text-center" width='7%'> Date </th>
		<th><div align='center'> Driver </th><th> Vehicle </th>
    <th> Destination </th><th> Location </th><th> Final </th>
    <th> Load&nbsp;Size </th><th> Distance </th>
    <th><div align='center'> Inconce </th>
    <th><div align='center'> Charges </th><th><div align='center'> Balance </th>
	<th class="hidden-print" style="width:40px; text-align:center;" colspan='2'> Options </th></tr>
                    </thead><tbody>
		<?php
					$n=1;									$balo="0.00";
		while($ro=mysqli_fetch_assoc($doj)){
$code=$ro['Number'];
$name=$ro['Vehicle'];
$dte=$ro['Date'];
$loce=$ro['Location'];
$dicha=$ro['Final'];
$dese=$ro['Destination'];
$desc=$ro['Description'];
$capa=$ro['Capacity'];									
$capao=number_format($capa, 2);
$caps=number_format($capa);
$dista=$ro['Distance'];									
$distao=number_format($dista, 2);
$dists=number_format($dista);
$driver=$ro['Driver'];

$seco=mysqli_query($conn, "SELECT *FROM `trip_note` WHERE `Trip`='$code'");
$seco=mysqli_query($conn, "UPDATE `trips` SET `Target`='$targ' WHERE `Number`='$code' AND `Target`='0'");
$d='KM';
$c='TON';

$etd=$ro['ETD'];
$eta=$ro['ETA'];
$pla=$ro['Plate'];

if($feco=mysqli_num_rows($seco))
$stl="style='padding:1px; font-size:12px; color:#C27935;'";
else
$stl="style='padding:1px; font-size:12px;'";

if($fo=='1')
	$ttl="";
else
	$ttl="title='$desc'";

	$custoi=mysqli_query($conn, "SELECT `account`.`Customer` FROM `account` INNER JOIN `income` ON `account`.`Number` = `income`.`Customer` WHERE `income`.`Trip`='$code' AND `income`.`Status`='0' AND `income`.`Customer`!='0' ORDER BY `income`.`Number` DESC LIMIT 1");
			$rustoi=mysqli_fetch_assoc($custoi);
				$cusi=$rustoi['Customer'];
				
	$inco=mysqli_query($conn, "SELECT SUM(`Amount`*`Rate`) AS 'Amon' FROM `income` WHERE `Trip`='$code' AND `Status`='0'");
	$rinco=mysqli_fetch_assoc($inco);
	    $tco=$rinco['Amon'];
	    $tcoo=number_format($tco);
	    
	    $tca=0;
	$char=mysqli_query($conn, "SELECT SUM(`Amount`) AS 'Amoc' FROM `repair` WHERE `Trip`='$code' AND `Status`='0'");
	$rar=mysqli_fetch_assoc($char);
	    $tca+=$rar['Amoc'];
	    $tcao=number_format($tca);
	    
    $fl=mysqli_query($conn, "SELECT SUM(`Amount`*`Rate`) AS 'Amol' FROM `consumption` WHERE `Trip`='$code' AND `Status`='0'");
	$rl=mysqli_fetch_assoc($fl);
	    $tca+=$rl['Amol'];
	    $tcao=number_format($tca);
	    
	                                $bal=$tco-$tca;
	  $balo=number_format($bal, 2);

print("<tr $ttl data-toggle='tooltip' data-placement='top'>
<td $stl><div align='center'> $n&nbsp;</td>
<td $stl><div align='center'>$dte</td><td $stl> $driver </td>
	<td $stl>$pla</td><td $stl> $dese </td><td $stl> $loce </td>
	<td $stl>&nbsp;&nbsp;$dicha </td>
	<td $stl><div align='right'>&nbsp;$capao&nbsp;$c&nbsp;</td>
    <td $stl><div align='right'>&nbsp;$distao&nbsp;$d&nbsp;</td>
	<td $stl><div align='right'>&nbsp;$tcoo&nbsp;</td>
	<td $stl><div align='right'>&nbsp;$tcao&nbsp;");


	echo"<div class='modal fade' id='Modal$n' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
  <div class='modal-dialog' role='document'><div class='modal-content'>
  <div class='modal-header text-left'>
        <h5 class='modal-title' id='exampleModalLabel'>EDIT A TRIP <span class='pull-right'> $pla => $dese - $loce </span></h5>

      </div><form action='' method='post'>
      <div class='modal-body text-left'><div class='row'>
      
       <div class='form-group'>	 
			  <div class='col-md-5' align='right'>
			  <label class='control-label'>Due Date</label>
			</div>	

	 <div class='col-md-6'>
          <div class='input-group date' data-provide='datepicker'><input class='form-control form-center' name='duda' type='text' value='$dte' onkeypress='return isNumberKey(event)' style='padding-left:2px; padding-right:2px;' required><div class='input-group-addon'><span class='lnr lnr-calendar-full'></span></div></div>
            </div>
		</div>

        <div class='form-group'>
			<div class='col-md-5' align='right'> 
            <label class='control-label'>Vehicle&nbsp;ID</label></div>
            <div class='col-md-6'>
<select class='form-control' name='plate' style='font-size:16px; height:34px;' required>
	 <option value=''> </option>";

$do=mysqli_query($conn, "SELECT `Number`, `Plate` FROM `vehicles` WHERE `Status`='0' AND `Plate` NOT LIKE '%GEN%' ORDER BY `Plate` ASC");
		while($ro=mysqli_fetch_assoc($do)){
			$numb=$ro['Number'];
			$plate=$ro['Plate'];
			if($plate==$pla)
			    $sl='selected';
			else
			    $sl='';
			echo"<option value='$numb' $sl> $plate </option>";
		}
		
		echo"</select>
            </div>          
		</div>
			
			 	
		 <div class='form-group'>	 
			  <div class='col-md-5' align='right'>
			  <label class='control-label'>Trip Destination</label></div>	

	 <div class='col-md-6'>
          <input name='desti' class='form-control' type='text' value='$dese'>
            </div>
		</div>

		<div class='form-group'>	 
			  <div class='col-md-5' align='right'>
			  <label class='control-label'>Package Location</label></div>	

	 <div class='col-md-6'>
          <input name='loca' class='form-control' type='text' value='$loce'>
            </div>
		</div>


		 <div class='form-group'>
			<div class='col-md-5' align='right'> 
            <label class='control-label'>Final Destination</label></div>
            <div class='col-md-6'>
           <input name='final' class='form-control' type='text' value='$dicha'>
            </div>
		</div>


		 <div class='form-group'>
			<div class='col-md-5' align='right'> 
            <label class='control-label'>Capacity / Distance</label></div>
            <div class='col-md-3'><div class='input-group'>
           <input name='capa' class='form-control' type='text' style='text-align:center;' onkeyup='format(this);' onkeypress='return isNumberKey(event)' value='$capa'><span class='input-group-addon text-info'>TON</span>
            </div></div>
            <div class='col-md-3'><div class='input-group'>
           <input name='dista' class='form-control' type='text' style='text-align:center;' onkeyup='format(this);' onkeypress='return isNumberKey(event)' value='$dista'><span class='input-group-addon text-info'>KM</span>
            </div></div>
		</div>
		
		<div class='form-group'>
			<div class='col-md-5' align='right'> 
            <label class='control-label'>
            <br class='hidden-xs'>ETD / ETA</label></div>
            <div class='col-md-3' style='padding-right:0px;'><br class='hidden-xs'><div class='input-group date' data-provide='datepicker'><input class='form-control form-center' name='etd' type='text' value='$etd' onkeypress='return isNumberKey(event)' style='padding-left:2px; padding-right:2px;' required><div class='input-group-addon'><span class='lnr lnr-calendar-full'></span></div></div>
            </div>
            
             <div class='col-md-3' style='padding-left:0px;'><br class='hidden-xs'><div class='input-group date' data-provide='datepicker'><input class='form-control form-center' name='eta' type='text' value='$eta' onkeypress='return isNumberKey(event)' style='padding-left:2px; padding-right:2px;' required><div class='input-group-addon'><span class='lnr lnr-calendar-full'></span></div></div>
             </div>
		</div>


		<div class='form-group'>
   <div class='col-md-5' align='right'><br class='hidden-xs'>
			  <label class='control-label'>Description</label></div>

 <div class='col-md-6'>
<textarea class='form-control' name='descri' style='height:60px; font-size:14px;'>$desc</textarea>
	</div>
	
	</div></div>
		
	</div><div class='modal-header text-right' style='height:50px; padding-top:15px;'><input type='hidden' name='rowid' value='$code'>	
		<button type='button' class='btn btn-xs btn-danger' data-dismiss='modal' style='width:80px;'> CANCEL </button>
        <button type='submit' name='usavedi' class='btn btn-xs btn-success' style='width:80px;'> UPDATE </button></div>
      </form>
  </div></div>
</div>";
					   
		print("</td><td $stl><div align='right'>&nbsp;$balo&nbsp;</td>  
		<td class='hidden-print' align='right' style='width:20px; padding:0px;'><span title='Edit' data-toggle='tooltip' data-placement='top'>
		<input type='hidden' name='rowid' value='$code'><button type='button' class='btn btn-xs btn-warning hidden-print' data-toggle='modal' data-target='#Modal$n' style='height:18px; padding:0px; margin:3px;'> &nbsp;&nbsp;<i class='lnr lnr-pencil'></i>&nbsp;&nbsp;</button></span></td>
						  
			<form method=post action=''>
	<td class='hidden-print' align='right' style='width:20px; padding:0px;'>
              <input type='hidden' name='rowid' value='$code'>
              <input type='hidden' name='custo' value='$custor'>
    <button type='submit' name='open' class='btn btn-xs btn-success hidden-print' style='height:18px; padding:0px; margin:3px;'>&nbsp;&nbsp;<i class='lnr lnr-download'></i>&nbsp;&nbsp;</button></td></form></tr>
    
    
<tr><td> </td><form method=post action=''><td class='text-center' style='padding:2px 4px 20px 4px; font-size:12px; vertical-align:top;'>");

if($p)
echo"<button type='submit' class='btn btn-xs btn-info hidden-print' name='search' style='height:18px; padding:0px; font-size:12px; margin:0px; width:80px;' title='Back to list' data-toggle='tooltip' data-placement='top'>&nbsp;&nbsp;<i class='lnr lnr-chevron-left-circle'></i>&nbsp;&nbsp;BACK&nbsp;&nbsp;</button>";

    print("<input type='hidden' name='custo' value='$custor'>
    </th></form></td><td class='text-center' style='color:blue; padding:0px 0px 20px 0px; font-size:11px;'> ETD: $etd </td>
	<td colspan='2' class='text-center' style='color:blue; padding:0px 0px 20px 0px; font-size:11px;' $stl> ETA: $eta </td>
	<td colspan='4' style='padding:0px 0px 20px 0px; color:blue; font-size:10px;'>#$code &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; $cusi");
	
	
	// ********* Calculate fuel per trip ***************************
		$secoi=mysqli_query($conn, "SELECT SUM(`Quantity`) AS `Qty` FROM `consumption` WHERE `Vehicle`='$name' AND `Trip`='$code' ORDER BY `Number` DESC LIMIT 1");
		if($fecoi=mysqli_num_rows($secoi)){
			 $recoi=mysqli_fetch_assoc($secoi);
			 $qto=number_format($recoi['Qty']);
			    $un="L";
			    if($qto)
	echo"&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; $qto$un";
			    }
			    
	
	if($billo)
	    echo"<button type='button' class='btn btn-xs btn-danger btn-link' style='height:18px; padding:0px; margin:0px;'
	data-toggle='modal' data-target='#fiModal$n'><i class='lnr lnr-cross-circle text-danger'></i></button>BILL&nbsp;No: <a href='files/$file' style='color:blue' target='_blank'>$billo</a>";
	    
	print("</td><td colspan='2' class='text-success' style='padding:0px 0px 20px 0px; font-size:11px;'> $desc </td>");
			$n++;	
			

			if($fo==1){
	echo"<td class='text-right text-danger' style='padding:2px 0px 20px 0px; font-size:12px; vertical-align:top;'> </td>
	
	<td colspan='2' style='padding:2px 4px 20px 4px; font-size:12px; vertical-align:top;'>";
	
	    if($_SESSION['Ctr'])
	echo"<button type='button' class='btn btn-xs btn-danger btn-block' style='height:18px; padding:0px; font-size:10px; margin:0px;'
	data-toggle='modal' data-target='#xModal$n'>
	<i class='lnr lnr-trash'></i>&nbsp;DELETE&nbsp;</button>";
		
		
		
	
// ****************************** Delete a trip ***************************

echo"<div class='modal fade' id='xModal$n' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
  <div class='modal-dialog' role='document'><div class='modal-content'><div class='modal-header text-left'>
        <h5 class='modal-title' id='exampleModalLabel'>DELETE CONFIRMATION <span class='pull-right'> $pla => $dese - $loce </span></h5>

      </div><form action='' method='post'>
      <div class='modal-body text-left' style='height:40px;'>
        <h5 style='color:#ff0033'>Are you sure you want to delete this container ?</h5>
      </div><input type='hidden' name='code' value='$code'>
      <div class='modal-footer' style='margin-top:-10px; height:50px; padding-top:5px; border:0px solid blue;'>
        <button type='button' class='btn btn-sm btn-success' data-dismiss='modal'>&nbsp;NO&nbsp;</button>
        <button type='submit' name='delox' class='btn btn-sm btn-danger'>YES</button>
      </div></form>
    </div>
  </div>
</div>";

// *************************************** End of modal *******************




				echo"</td>";
			}
			else
			    echo"<td colspan='3' style='color:blue; padding:0px 0px 20px 0px; font-size:13px;'> &nbsp; </td>";
			
			echo"</tr>";
	}

				?></tbody>
                  </table>
	<?php
	if($fo=='1'){	
	    
	    
	    
	    // ****************************** Comment on selected trip *********************************
		echo"<div class='modal fade' id='tricom' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true' 
		style='top:20px;'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'><div class='modal-body' style='height:auto;'>
    <div class='col-md-12'>";
    
    if($feco=mysqli_num_rows($seco)){
        
    echo"<table class='table table-striped table-hover'>     
                                      <thead>
                    <tr role='row'>
    <th width='15%' style='padding:1px; text-align:center'> Date </th>
	<th><div align='center'> User </th><th><div align='center'> Note </th>
			<th><div align='center'> # </th></tr>";    
			$trico='';
	while($reco=mysqli_fetch_assoc($seco)){
	    $nums=$reco['Number'];
	    $dae=$reco['Date'];
	    $usa=$reco['User'];
	    $note=$reco['Comment'];
	    $trico="$trico $note <br>";
	echo"<tr><form method='post' action=''>
	<td style='padding:0px;'><div align='center'> $dae </td>
<td style='padding:0px;'> $usa </td><td class='text-primary' style='padding:0px;'> $note </td><td style='padding:0px; text-align:center;'>
              <input type='hidden' name='nums' value='$nums'>
              <input type='hidden' name='p' value='$p'>
              <input type='hidden' name='rowid' value='$code'>
              <input type='hidden' name='custo' value='$custor'><button type='submit' name='dedelo' class='btn btn-xs btn-link text-danger hidden-print' style='height:10px; padding:0px; margin:-10px 0px 0px 0px; width:15px;'><i class='lnr lnr-trash'></i></button></td></form></tr>";
	}
        
    echo"</table><br>"; 
        
    }
    
    
    echo"</div><div class='row'> </div>
	<div class='col-md-5'><div align='right'><form method='post' action=''>
<select class='form-control'><option value='' selected='selected'>$pla</option>
				</select></div></div>

			<div class='col-md-7'>
		 <TEXTAREA name='descri' class='form-control' rows='4' cols='56' placeholder='Write Here'></TEXTAREA>
			</div>
		
		<div class='col-md-5' style='margin-top:-35px;'>
		<div class='input-group date' data-provide='datepicker'>
	<input class='form-control form-center' name='dai' type='text' value='$Date' onkeypress='return isNumberKey(event)'><span class='input-group-addon'><i class='lnr lnr-calendar-full'></i></span>
			</div>
		
			</div>

      </div><div class='row'> </div> 
              <input type='hidden' name='p' value='$p'>
              <input type='hidden' name='rowid' value='$code'>
              <input type='hidden' name='custo' value='$custor'><hr>
      <div class='modal-footer' style='margin-top:-14px; height:38px; padding-top:2px; border:0px solid blue;'>
        <button type='button' class='btn btn-sm btn-danger' data-dismiss='modal' style='width:120px;'>CANCEL</button>
        <button type='submit' class='btn btn-sm btn-success' name='depo' style='width:120px;'>SAVE</button>
      </div></form>
    </div></form>
  </div>
</div>";

		// ************************************************ End of modal ************************************
		
		
		
		
		
		
		
		
		
		
		
	echo"<div class='col-md-7'><button type='button' class='btn btn-xs btn-info btn-default text-primary' style='height:24px; padding:0px; width:140px; font-size:13px;'
	data-toggle='modal' data-target='#aModal'> Add Services </button>
	
	<button type='button' class='btn btn-xs btn-info btn-default text-primary' style='height:24px; padding:0px; width:140px; font-size:13px;'
	data-toggle='modal' data-target='#bModal'> Add Trip Income </button>
	
	<button type='button' class='btn btn-xs btn-info btn-default text-danger' style='height:24px; padding:0px; width:140px; font-size:13px;'
	data-toggle='modal' data-target='#tricom'>";
	if($feco)
	echo"<span class='badge pull-right' style='margin-top:-10px; background-color:red;'>$feco</span>";
	
	echo"Trip Comment </button></div>
	<div class='col-md-5 text-danger'> $trico </div>
            </div><div class='row' style='margin-top:0px;'>";
            
            
            
            
				
		// *********************** Road Toll ******************************
			echo"<div class='modal fade' id='aModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
  <div class='modal-dialog' role='document'><div class='modal-content'><div class='modal-header text-left'>
        <h5 class='modal-title' id='exampleModalLabel'> ADD SERVICES
        <span class='pull-right'> $pla => $loce &nbsp;&nbsp; $distao $d </span></h5>

      </div><form action='' method='post'>
      <div class='modal-body text-left'>
			<div class='row'><div class='col-md-12'>
			<div class='col-md-4'><br>&nbsp;&nbsp;&nbsp;Vehicle ID <br>
		   <select class='form-control' name='plat' required>
				<option value='$name' selected='selected'> $pla </option>";
		
		   echo"</select>
            </div>


	<div class='col-md-4' style='padding-right:0px;'>
	<br>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; Total Amount <br>
	<input name='amo' class='form-control text-center' type='text' onkeyup='format(this);' onkeypress='return isNumberKey(event)' title='Road Toll' data-toggle='tooltip' data-placement='top' required>
  </div>

	<div class='col-md-4' style='padding-left:0px;'>
	<br>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; Currency <br>
		   <select class='form-control' name='curre' style='padding-left:1px; padding-right:0px; font-size:14px; padding-top:4px;' required>
		   <option value='' selected='selected'>Select Currency</option>";
			 
			$doi=mysqli_query($conn, "SELECT `Code`, `Rate` FROM `currency` WHERE `Code`!='' ORDER BY `Code` ASC");
			while($roi=mysqli_fetch_assoc($doi)){
				$fna=$roi['Code'];
				$rate=$roi['Rate'];
				$rte=number_format($rate, 2);
				if($curr==$fna)
					$sc="selected";
				else
					$sc="";
			echo"<option value='$rate' $sc> $fna @ $rte </option>";
			}
		
		   echo"</select></div>

			</div></div>
			
			
			
				<div class='row'><div class='col-md-12'>
			<div class='col-md-6'><br>&nbsp;&nbsp;&nbsp;Driver`s Name <br>
            <input type='text' class='form-control' name='drive' list='dlist' value='$driver' OnKeyup='return cUpper(this);'>
            <datalist id='dlist'>";
		$doi=mysqli_query($conn, "SELECT `Driver` FROM `vehicles` WHERE `Driver`!='' AND `Driver`!='$driver'");
			while($roi=mysqli_fetch_assoc($doi)){
				$dri=$roi['Driver'];
			echo"<option value='$dri'>";	
			}
		   echo"</datalist>
            </div>
            
            	<div class='col-md-6'><br>&nbsp;&nbsp;&nbsp;Payment Type <br>
		   <select class='form-control' name='type' required>
				<option value=''> Select Type </option>
			<option value='ROAD TOLL'> ROAD TOLL </option>
			<option value='MILEAGE'> MILEAGE </option>
			<option value='SALARY'> SALARY </option>
			<option value='BOND'> BOND </option>
			<option value='COMMISSION'> COMMISION </option>
			<option value='OTHER EXPENSE'> OTHER EXPENSE </option>
			<option value='GPS SERVICES'> GPS SERVICES </option></select>
            </div>
            
            
            
            </div></div>
			
		<div class='row'><div class='col-md-12'><br>	
		<textarea class='form-control' name='descri' style='height:60px; font-size:14px;' placeholder='Decription ...'></textarea></div>
			</div></div>
			<hr><input type='hidden' name='code' value='$code'>
      <div class='modal-footer' style='margin-top:-10px; height:50px; padding-top:5px; border:0px solid blue;'>
      
<div class='col-md-2 text-right' style='padding-top:8px;'> Due&nbsp;Date </div>
      <div class='col-md-4 text-right'>

		   <div class='input-group date' data-provide='datepicker'>
      <input class='form-control form-center' name='dato' type='text' value='$Date' onkeypress='return isNumberKey(event)' required>
	  <span class='input-group-addon'><i class='lnr lnr-calendar-full'>
	  </i></span></div>
			</div><div class='col-md-6 text-right'>
			
			
        <button type='button' class='btn btn-sm btn-danger' data-dismiss='modal' style='width:85px; height:33px;'> CANCEL </button>
        <button type='submit' name='toll' class='btn btn-sm btn-success' style='width:85px; height:33px;'> SAVE </button>
      </div></div></form>
    </div>
  </div>
</div>";

// ************************ End of Modal *******************************



// *************************** Trip Income Modal **********************
        ?>
        
        <div id="bModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

    <div class="modal-dialog">

        <div class="modal-content" style="border-radius:5px;">

            <div class="modal-header" style="border-radius:5px; height:50px;">

                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times-circle" aria-hidden="true"></i></button>

                <h4 class="modal-title" id="myModalLabel">&nbsp;&nbsp;&nbsp;<i class="fa fa-bars"></i> Trip Income 
                <?php echo"<span class='pull-right' style='font-size:12px;'> $pla => $loce &nbsp;&nbsp; $distao $d </span>";
                ?></h4>

            </div>

            <div class="modal-body">

                
                <!-- Email Logins-->

                

                <form action="" method="post" enctype='multipart/form-data'>

                     <div class="row"> 

                        <div class="col-sm-6" style="padding-top:7px; font-weight:bold;">

                           &nbsp; <i class="fa fa-calendar"></i> Due Date
                        </div><div class="col-sm-6" style="padding-top:7px; font-weight:bold;">

                           &nbsp; <i class="fa fa-truck"></i> Vehicle ID
                        </div>

                        <label class="control-label col-sm-6">

    <input class="form-control form-center" name="dato" type="text" value="<?php echo $Date ?>" onkeypress='return isNumberKey(event)' id='from' required>

</label>
                       

						<div class="col-sm-6">

       <select class="form-control" name="plate" style="font-size:16px; height:34px;" required>
<?php
			echo"<option value='$name' selected='selected'> $pla </option>";
		?>
		</select>

                        </div>
</div>


 <div class="row"> 


 <div class="col-sm-6" style="padding-top:0px; font-weight:bold;">

                           &nbsp; <i class="fa fa-area-chart"></i> Distance (KM)
                        </div><div class="col-sm-6" style="padding-top:0px; font-weight:bold;">

                           &nbsp; <i class="fa fa-briefcase"></i> Total Amount
                        </div>

                        <label class="control-label col-sm-6">
 <input class="form-control form-center" name="dista" type="text" onkeyup="format(this);" onkeypress="return isNumberKey(event)" value="<?php echo $dists ?>" required>
    
					</label>
                       

<div class="col-sm-3 col-xs-7' style='padding-right:0px; margin-right:0px;">
     <input class="form-control form-center" name="amo" type="text" onkeyup="format(this);" onkeypress="return isNumberKey(event)" style="margin-right:0px; width:110%;" required></div>
        
    <div class='col-md-3 col-xs-5' style='padding-left:0px; margin-left:0px;'>
    <select class='form-control' name='currency' title='Currency' data-toggle='tooltip' data-placement='top' style="margin-left:0px; border-radius: 0px 5px 5px 0px; padding-left:5px; padding-right:5px;" required>
				<option value='' selected='selected'>Currency</option>
			 <?PHP
			$doi=mysqli_query($conn, "SELECT `Code`, `Rate` FROM `currency` WHERE `Code`!='' ORDER BY `Code` ASC");
			while($roi=mysqli_fetch_assoc($doi)){
				$fna=$roi['Code'];
				$rate=$roi['Rate'];
				$rte=number_format($rate, 2);
			echo"<option value='$rate'> $fna @ $rte </option>";
			}
		?>
		   </select>
            </div>
					
					</div>

 <div class="row"> 

						<div class="col-sm-6" style="padding-top:0px; font-weight:bold;">

                           &nbsp; <i class="fa fa-user"></i> Drivers` Name
                        </div><div class="col-sm-6" style="padding-top:0px; font-weight:bold;">

                           &nbsp; <i class="fa fa-balance-scale"></i> Weight (TON)
                        </div>

                        <label class="control-label col-sm-6">
 <input class="form-control" name="driv" type="text" OnKeyup='return cUpper(this);' list="dive" value="<?php echo $driver ?>" required>
     <datalist id="dive">
<?php
$doi=mysqli_query($conn, "SELECT `Driver` FROM `vehicles` WHERE `Driver`!='' AND `Driver`!='$driver'");
			while($roi=mysqli_fetch_assoc($doi)){
				$dri=$roi['Driver'];
			echo"<option value='$dri'>";	
			}
		?>
		</datalist>
					</label>
                       

						<div class="col-sm-6">
      <input class="form-control form-center" name="wei" type="text" onkeyup="format(this);" onkeypress="return isNumberKey(event)" value="<?php echo $caps ?>" required>

                        </div>

</div>

 <div class="row"> 
 

 <div class="col-sm-6" style="padding-top:0px; font-weight:bold;">

                           &nbsp; <i class="fa fa-bars"></i> District
                        </div><div class="col-sm-6" style="padding-top:0px; font-weight:bold;">

                           &nbsp; <i class="fa fa-map-marker"></i> Location
                        </div>

                   <div class="col-sm-6" style="padding-top:0px; font-weight:bold; height:60px;">

  <select class="form-control" name="dist" style="font-size:16px; height:34px;" required>
	 <option value=''> Select a District </option>
<?php
$doz=mysqli_query($conn, "SELECT `Name` FROM `districts` ORDER BY `Name` ASC");
		while($roz=mysqli_fetch_assoc($doz)){
			$dti=$roz['Name'];
			echo"<option value='$dti'> $dti </option>";
		}
		?></select>
                        </div>

   
                        <label class="control-label col-sm-6">
				
<input class="form-control" name="loco" type="text" value="<?php echo $loce ?>">
					</label>

</div>

 <div class="row"> 
                       

		<div class="col-sm-6" style="margin-top:-20px;">
 
    <textarea placeholder="Description...." class="form-control" rows="2" name="descri"><?php echo $desc ?></textarea><br>

	</div><div class="col-sm-6" style="margin-top:-20px;">
    
     &nbsp; <i class="fa fa-user"></i> Customer <br>
      <select class="form-control" name="custo" style="font-size:16px; height:34px;" required>
	 <option value=''> Select a Customer </option>
<?php
$doz=mysqli_query($conn, "SELECT `Number`, `Customer` FROM `account` WHERE `Status`='0' AND `Number`!='1' ORDER BY `Customer` ASC");
		while($roz=mysqli_fetch_assoc($doz)){
			$cust=$roz['Customer'];
			$cods=$roz['Number'];
	echo"<option value='$cods'> $cust </option>";
		}
		?>
		</select></div>

</div>

    <?php echo"<input type='hidden' name='code' value='$code'>"; ?>                                      
                  

        <div class="col-sm-12" style="text-align:center; margin-top:-20px;"><hr>

                     <button class="view-listing-button" type="submit" name="saves" style="border:1px solid #99ccff; width:240px; float:center; height:30px; border-radius:5px; font-size:18px;"><i class="fa fa-check-square-o"></i> &nbsp; Save  </button>
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
    include'loading.php';
		}
			?>
                    </div></div></div></div></div>                 
               <div class="col-lg-12 hidden-print"> <span class="pull-right hidden-print"><a href="#" onclick="return window.print()" class="hidden-print" title='Print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a>&nbsp;&nbsp;&nbsp;</span></div> 
                          
                  </div>
      
   </div></div></div>
   <?php
   
   $doin=mysqli_query($conn, "UPDATE `repair` SET `Currency`='RWF' WHERE `Rate`='1' ORDER BY `Number` DESC LIMIT 10");
   $doin=mysqli_query($conn, "UPDATE `repair` SET `Currency`='USD' WHERE `Rate`!='1' ORDER BY `Number` DESC LIMIT 10");
   $doin=mysqli_query($conn, "UPDATE `cutter` SET `Currency`='RWF' WHERE `Currency`='' ORDER BY `Number` DESC LIMIT 10");
   
   include'footer.php';
   ?>