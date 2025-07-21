<?php
if(basename($_SERVER['PHP_SELF']) == 'ment.php') 
  $nv=" class='current'";
include'header.php';
include'connection.php';
$custo=$conde='';
$pto=0;

// ****************************** Insurance registration ****************************
	if(isset($_POST['savei']))
		{
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$plate=$_POST['plate'];
			$compa=$_POST['compa'];
			$desc=str_replace("'", "`", $_POST['desc']);
			$compa=$_POST['compa'];
			$amo=preg_replace('/,/', '', $_POST['amo']);

			$temp1 = explode(".", $_FILES["file1"]["name"]);
$newfilename1 = round(microtime(true)) . '.' . end($temp1);
move_uploaded_file($_FILES["file1"]["tmp_name"], "insurance/" . $newfilename1);
	if(!end($temp1))
	$newfilename1='';

	$so=mysqli_query($conn, "INSERT INTO `insurance` (`Date`, `User`, `Start`, `Ending`, `Vehicle`, `File`, `Company`, `Descri`) VALUES ('$Date', '$loge', '$dato', '$datos', '$plate', '$newfilename1', '$compa', '$desc')");
	
	            if($amo){
	$tripe=mysqli_query($conn, "SELECT `Number`, `Driver` FROM `trips` WHERE `Vehicle`='$plate' AND `Date`<= '$Date' ORDER BY `ETD` DESC LIMIT 1");
			if($fripe=mysqli_num_rows($tripe)){
			$ripe=mysqli_fetch_assoc($tripe);
				$trip=$ripe['Number'];
				$driver=$ripe['Driver'];
	        }
	        else{
	            $trip=0;
	            $driver='';
	        }
				
	$doz=mysqli_query($conn, "SELECT `Rate` FROM `currency` WHERE `Code`='USD' ORDER BY `Number` DESC");
		    $roz=mysqli_fetch_assoc($doz);
			     $rate=$roz['Rate'];
			     
			     if(!$driver){
	$dozi=mysqli_query($conn, "SELECT `Driver` FROM `vehicles` WHERE `Number`='$plate' ORDER BY `Number` DESC");
		    $rozi=mysqli_fetch_assoc($dozi);
			     $driver=$rozi['Driver'];
			     }
			
    	$so=mysqli_query($conn, "INSERT INTO `repair` (`Vehicle`, `Amount`, `Garage`, `Items`, `Issue`, `Date`, `Repair`, `Driver`, `File`, `Purchase`, `Next`, `User`, `Time`, `Trip`, `Type`, `Rate`) VALUES ('$plate', '$amo', 'INSURANCE', '0', '$desc', '$Date', '$compa', '$driver', '$newfilename1', '0', '0', '$loge', '$Time', '$trip', '0', '$rate')");
	            }
    	
			$pto=10;
		}


// ******************************* Technical Inspection ******************************
	if(isset($_POST['savep']))
		{
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$plate=$_POST['plate'];
			$compa=$_POST['compa'];
			$desc=str_replace("'", "`", $_POST['desc']);
			$compa=$_POST['compa'];

			$temp1 = explode(".", $_FILES["file1"]["name"]);
$newfilename1 = round(microtime(true)) . '.' . end($temp1);
move_uploaded_file($_FILES["file1"]["tmp_name"], "inspection/" . $newfilename1);
	if(!end($temp1))
	$newfilename1='';

	$so=mysqli_query($conn, "INSERT INTO `inspection` (`Date`, `User`, `Start`, `Ending`, `Vehicle`, `File`, `Place`, `Descri`) VALUES ('$Date', '$loge', '$dato', '$datos', '$plate', '$newfilename1', '$compa', '$desc')");
			$pto=20;
		}


		// ******************************* Transport Permit ******************************
	if(isset($_POST['savet']))
		{
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$plate=$_POST['plate'];
			$desc=str_replace("'", "`", $_POST['desc']);
			$compa=$_POST['compa'];
			$amo=preg_replace('/,/', '', $_POST['amo']);

			$temp1 = explode(".", $_FILES["file1"]["name"]);
$newfilename1 = round(microtime(true)) . '.' . end($temp1);
move_uploaded_file($_FILES["file1"]["tmp_name"], "permit/" . $newfilename1);
	if(!end($temp1))
	$newfilename1='';

	$so=mysqli_query($conn, "INSERT INTO `permit` (`Date`, `User`, `Start`, `Ending`, `Vehicle`, `File`, `Type`, `Descri`) VALUES ('$Date', '$loge', '$dato', '$datos', '$plate', '$newfilename1', '$compa', '$desc')");
	
	if($amo){
		$tripe=mysqli_query($conn, "SELECT `Number`, `Driver` FROM `trips` WHERE `Vehicle`='$plate' AND `Date`<= '$Date' ORDER BY `ETD` DESC LIMIT 1");
			if($fripe=mysqli_num_rows($tripe)){
			$ripe=mysqli_fetch_assoc($tripe);
				$trip=$ripe['Number'];
				$driver=$ripe['Driver'];
	        }
	        else{
	            $trip=0;
	            $driver='';
	        }
				
	$doz=mysqli_query($conn, "SELECT `Rate` FROM `currency` WHERE `Code`='USD' ORDER BY `Number` DESC");
		    $roz=mysqli_fetch_assoc($doz);
			     $rate=$roz['Rate'];
			     
			     if(!$driver){
	$dozi=mysqli_query($conn, "SELECT `Driver` FROM `vehicles` WHERE `Number`='$plate' ORDER BY `Number` DESC");
		    $rozi=mysqli_fetch_assoc($dozi);
			     $driver=$rozi['Driver'];
			     }
			
    	$so=mysqli_query($conn, "INSERT INTO `repair` (`Vehicle`, `Amount`, `Garage`, `Items`, `Issue`, `Date`, `Repair`, `Driver`, `File`, `Purchase`, `Next`, `User`, `Time`, `Trip`, `Type`, `Rate`) VALUES ('$plate', '$amo', '$compa', '0', '$desc', '$dato', '', '$driver', '$newfilename1', '0', '0', '$loge', '$Time', '$trip', '0', '$rate')");
	            }
			$pto=30;
		}

		// ******************************* Fuel Consumption ******************************
	if(isset($_POST['savef']))
		{
			$dato=$_POST['dato'];
			$qty=preg_replace('/,/', '', $_POST['qty']);
			$plate=$_POST['plate'];
			$pri=preg_replace('/,/', '', $_POST['amo']);
			$amo=$qty*$pri;
			$station=$_POST['station'];
			$invo=$_POST['invo'];
			$pucha=$_POST['pucha'];
			$curr=$_POST['curre'];
	
	$tripe=mysqli_query($conn, "SELECT `Number` FROM `trips` WHERE `Vehicle`='$plate' AND `ETD`<='$dato' ORDER BY `ETD` DESC LIMIT 1");
			$ripe=mysqli_fetch_assoc($tripe);
				$trip=$ripe['Number'];

			$temp1 = explode(".", $_FILES["file1"]["name"]);
$newfilename1 = round(microtime(true)) . '.' . end($temp1);
move_uploaded_file($_FILES["file1"]["tmp_name"], "fuel/" . $newfilename1);
	if(!end($temp1))
	$newfilename1='';

	$doz=mysqli_query($conn, "SELECT `Discount` FROM `station` WHERE `Name`='$station' ORDER BY `Number` DESC");
		$roz=mysqli_fetch_assoc($doz);
			$disc=$roz['Discount'];

	$dov=mysqli_query($conn, "SELECT `Fuel` FROM `vehicles` WHERE `Number`='$plate' ORDER BY `Number` DESC");
		$rov=mysqli_fetch_assoc($dov);
			$fuel=$rov['Fuel'];

	$so=mysqli_query($conn, "INSERT INTO `consumption` (`Vehicle`, `Amount`, `Station`, `Discount`, `Fuel`, `Date`, `Price`, `File`, `Invoice`, `Purchase`, `User`, `Quantity`, `Rate`, `Trip`) VALUES ('$plate', '$amo', '$station', '$disc', '$fuel', '$dato', '$pri', '$newfilename1', '$invo', '$pucha', '$loge', '$qty', '$curr', '$trip')");
			$pto=40;
		}


		// ******************************* Repair & Services ******************************
	if(isset($_POST['savege']))
		{
			$dato=$_POST['dato'];
			$garage=$_POST['garage'];
			$plate=$_POST['plate'];
			$driver=$_POST['driver'];
			$purcha=$_POST['purcha'];
			$next=$_POST['next'];
			$issue=str_replace("'", "`", $_POST['issue']);
			$repair=str_replace("'", "`", $_POST['repair']);
			$amo=preg_replace('/,/', '', $_POST['amo']);
			if($type=='OTHER EXPENSE')
			    $ty=1;
			else
			    $ty=0;

			$temp1 = explode(".", $_FILES["file1"]["name"]);
$newfilename1 = round(microtime(true)) . '.' . end($temp1);
move_uploaded_file($_FILES["file1"]["tmp_name"], "repair/" . $newfilename1);
	if(!end($temp1))
	$newfilename1='';
	
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
			     
			     if(!$driver){
	$dozi=mysqli_query($conn, "SELECT `Driver` FROM `vehicles` WHERE `Number`='$plate' ORDER BY `Number` DESC");
		    $rozi=mysqli_fetch_assoc($dozi);
			     $driver=$rozi['Driver'];
			     }

	$so=mysqli_query($conn, "INSERT INTO `repair` (`Vehicle`, `Amount`, `Garage`, `Items`, `Issue`, `Date`, `Repair`, `Driver`, `File`, `Purchase`, `Next`, `User`, `Time`, `Trip`, `Type`, `Rate`) VALUES ('$plate', '$amo', '$garage', '0', '$issue', '$dato', '$repair', '$driver', '$newfilename1', '$purcha', '$next', '$loge', '$Time', '$trip', '$ty', '$rate')");
			$pto=50;
		}

		// *********************** Delete an item from repaired car ********************
		if(isset($_POST['deloge']))
		{
			$numu=$_POST['numu'];
			$qts=$_POST['qts'];
			$ites=$_POST['ites'];
			$stor=$_POST['stor'];
	$then=mysqli_query($conn, "DELETE FROM `stouse` WHERE `Number`='$numu' LIMIT 1");
	
		if($stor)
	$doin=mysqli_query($conn, "UPDATE `items` SET `Quantity`=`Quantity`+'$qts' WHERE `Number`='$ites' ORDER BY `Number` DESC LIMIT 1");
		}



		// ******************************* Add an item on repaired car ******************************
	if(isset($_POST['eddoge']))
		{
			
			$num=$_POST['num'];
			$veh=$_POST['veh'];
			$i=$_POST['i'];

			$rece=mysqli_query($conn, "SELECT `Voucher` FROM `stouse` WHERE `Voucher`!='0' ORDER BY `Voucher` DESC LIMIT 1");
				$re=mysqli_fetch_assoc($rece);
					$vou=$re['Voucher']+1;

			while($i>0){
			$pri=$_POST["pri$i"];
			$item=$_POST["item$i"];
			$pieces = explode(" @ ", $item);
					$item=$pieces[0]; // piece1
					if(!$pri)
					$pri=$pieces[1]; // piece2
			$qty=$_POST["qty$i"];
				$qty=preg_replace('/,/', '', $qty);
			$store=$_POST["store$i"];
				$pri=preg_replace('/,/', '', $pri);
			
			if($qty>0){
	$doz=mysqli_query($conn, "SELECT `Number`, `Price` FROM `items` WHERE `Item`='$item' ORDER BY `Number` DESC");
		if(!$foz=mysqli_num_rows($doz)){
$then=mysqli_query($conn, "INSERT INTO `items` (`Type`, `Item`, `Price`, `Quantity`, `Label`, `Descri`, `Status`) VALUES ('Repair Part', '$item', '$pri', '0', 'Variable Asset', 'From repair', '1')");
	$doz=mysqli_query($conn, "SELECT `Number`, `Price` FROM `items` WHERE `Item`='$item' ORDER BY `Number` DESC");
		    }
		$roz=mysqli_fetch_assoc($doz);
			$ite=$roz['Number'];

	if($store){
		if(!$pri)
			$pri=$roz['Price'];
	$doin=mysqli_query($conn, "UPDATE `items` SET `Quantity`=`Quantity`-'$qty' WHERE `Number`='$ite' ORDER BY `Number` DESC LIMIT 1");
$so=mysqli_query($conn, "INSERT INTO `stouse` (`Date`, `User`, `Item`, `Quantity`, `Price`, `Destin`, `Action`, `Voucher`, `Status`, `Invoice`, `Vehicles`, `Repair`, `Store`) VALUES ('$Date', '$loge', '$ite', '$qty', '$pri', 'Used for repair', 'USED', '$vou', '0', '0', '$veh', '$num', '$store')");
	}
	else{
$so=mysqli_query($conn, "INSERT INTO `stouse` (`Date`, `User`, `Item`, `Quantity`, `Price`, `Destin`, `Action`, `Voucher`, `Status`, `Invoice`, `Vehicles`, `Repair`, `Store`) VALUES ('$Date', '$loge', '$ite', '$qty', '$pri', 'Used for repair', 'USED', '$vou', '2', '0', '$veh', '$num', '$store')");
	}
			}
					$i--;
			}
			$pto=60;
		}


		// ******************************* Transport Services ******************************
	if(isset($_POST['saves']))
		{
			$dato=$_POST['dato'];
			$dist=$_POST['dist'];
			$plate=$_POST['plate'];
			$driv=str_replace("'", "`", $_POST['driv']);
			$descri=str_replace("'", "`", $_POST['descri']);
			$loco=str_replace("'", "`", $_POST['loco']);
			$amo=preg_replace('/,/', '', $_POST['amo']);
			$wei=preg_replace('/,/', '', $_POST['wei']);
			$dista=preg_replace('/,/', '', $_POST['dista']);
			$curr=$_POST['curre'];
			$custo=$_POST['custo'];
			$vous=preg_replace('/,/', '', $_POST['vous']);

			$temp1 = explode(".", $_FILES["file1"]["name"]);
$newfilename1 = round(microtime(true)) . '.' . end($temp1);
move_uploaded_file($_FILES["file1"]["tmp_name"], "permit/" . $newfilename1);
	if(!end($temp1))
	$newfilename1='';
	
	$tripe=mysqli_query($conn, "SELECT `Number` FROM `trips` WHERE `Vehicle`='$plate' AND `Date` <= '$dato' ORDER BY `ETD` DESC LIMIT 1");
			$ripe=mysqli_fetch_assoc($tripe);
				$trip=$ripe['Number'];

	$so=mysqli_query($conn, "INSERT INTO `income` (`Date`, `Vehicle`, `Distance`, `Driver`, `Weight`, `District`, `Location`, `Descri`, `Amount`, `File`, `Status`, `Rate`, `Customer`, `User`, `Time`, `Trip`, `Voucher`) VALUES ('$dato', '$plate', '$dista', '$driv', '$wei', '$dist', '$loco', '$descri', '$amo', '$newfilename1', '0', '$curr', '$custo', '$loge', '$Time', '$trip', '$vous')");
			$pto=70;
		}


$do=mysqli_query($conn, "SELECT *FROM `vehicles` WHERE `Status`='0' $conde ORDER BY `Number` ASC LIMIT 40");
	$fo=mysqli_num_rows($do);
		$stn="style='padding:1px; font-size:12px;'";
?>


<div class="container-fluid main-content">
        <div class="page-title hidden-xs hidden-print">
          <h2 style='margin-top:-20px; margin-bottom: 5px; color:#ffcc33'>
         Vehicles
          </h2>
                 </div>
     
        <div class="row">
  <div class="col-lg-2 hidden-print">
   
   <ul class="list-group">
                  
			  <li class="list-group-item active">
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
              
            <li class="list-group-item" style="border:1px dashed #cccccc; border-radius:5px; margin:0px 0px 4px 0px;">
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
                    
           
           
       
        <div class="col-lg-10">
                  <div class="row">

				  <?php 
if($pto==10)
echo"<center><div class='alert alert-danger' style='width:100%; height:30px; padding:4px; text-align:center; float:center; background-color:#60c560; color:#ffffff; border-radius:5px; margin-bottom:40px;'>
		<i class='lnr lnr-checkmark-circle'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>&times</button>New insurance has been saved. </div></center>";
		
if($pto==20)
echo"<center><div class='alert alert-danger' style='width:100%; height:30px; padding:4px; text-align:center; float:center; background-color:#60c560; color:#ffffff; border-radius:5px; margin-bottom:40px;'>
		<i class='lnr lnr-checkmark-circle'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>&times</button>New technical inspection has been saved. </div></center>";
		
if($pto==30)
echo"<center><div class='alert alert-danger' style='width:100%; height:30px; padding:4px; text-align:center; float:center; background-color:#60c560; color:#ffffff; border-radius:5px; margin-bottom:40px;'>
		<i class='lnr lnr-checkmark-circle'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>&times</button>New transport permit has been saved. </div></center>";
		
if($pto==40)
echo"<center><div class='alert alert-danger' style='width:100%; height:30px; padding:4px; text-align:center; float:center; background-color:#60c560; color:#ffffff; border-radius:5px; margin-bottom:40px;'>
		<i class='lnr lnr-checkmark-circle'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>&times</button>New fuel consumption has been saved. </div></center>";		
		
if($pto==50)
echo"<center><div class='alert alert-danger' style='width:100%; height:30px; padding:4px; text-align:center; float:center; background-color:#60c560; color:#ffffff; border-radius:5px; margin-bottom:40px;'>
		<i class='lnr lnr-checkmark-circle'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>&times</button>New car repair has been saved. </div></center>";

if($pto==60)
echo"<center><div class='alert alert-danger' style='width:100%; height:30px; padding:4px; text-align:center; float:center; background-color:#60c560; color:#ffffff; border-radius:5px; margin-bottom:40px;'>
		<i class='lnr lnr-checkmark-circle'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>&times</button>Item has been added successfully. </div></center>";

		if($pto==70)
echo"<center><div class='alert alert-danger' style='width:100%; height:30px; padding:4px; text-align:center; float:center; background-color:#60c560; color:#ffffff; border-radius:5px; margin-bottom:40px;'>
		<i class='lnr lnr-checkmark-circle'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>&times</button>Transport income saved successfully. </div></center>";
		?>
            <div class="col-lg-12" style='margin-top:-20px;'>
             <span> &nbsp;&nbsp; Total Records Found : <b><?php echo" $fo " ?></b></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix" style="padding-left:0px; padding-right:0px;">
               
                 <?php			
				
				
				
				
				// *************************************** Repair & Services ******************************************		
				
		$repa=mysqli_query($conn, "SELECT `vehicles`.`Plate`, `repair`.* FROM `repair` INNER JOIN `vehicles` ON `repair`.`Vehicle`=`vehicles`.`Number` WHERE `repair`.`Vehicle`>'0' ORDER BY `repair`.`Number` DESC LIMIT 7");	
			$fepa=mysqli_num_rows($repa);		
				
				echo"<div class='col-md-4 col-sm-4' title='Repair & Services' style='margin-left:0px;'>

					<span class='badge' style='float:right; font-size:10px; margin:0px; margin-right:10px; margin-top:-15px; height:18px; background-color:#99cccc; width:auto; text-align:center; color:#ffffff; position:relative;'> Repair & Services </span>

                    <div class='thumbnail thumb-shadow grid' style=' border:1px solid #d7d7c1; background-color:transparent;'>
                        <div class='property-header' style='height:70px; margin-top:0px;' onmouseover='this.style.opacity=0.2;this.filters.alpha.opacity=20' 
            onmouseout='this.style.opacity=1;this.filters.alpha.opacity=100'>
	<a href='#' data-toggle='modal' data-target='#repair'><img class='property-header-image' src='photos/garage.png' alt='Insurance' style='width:140px; height:60px; border-radius:5px;'>
         <label style='text-align:right; float:right; padding:10px; font-size:18px; margin-right:30px; padding-top:20px; cursor:pointer'> CREATE NEW </label></a>
                        </div>
                       <div class='caption' style='height:160px; width:100%; padding:0px; margin-top:-8px; overflow-x:none; font-size:10px; overflow-y:auto;'>     
						
			 <table class='table table-striped table-hover' style='font-size:10px;'>
							<thead><tr>
                     <th colspan='2' width='1%' $stn>&nbsp;&nbsp;&nbsp;No </th><th $stn><div align='center'> DATE </th>
					 <th $stn><div align='center'> VEHICLE </th><th $stn><div align='center'> ITEMS </th>
					 <th $stn><div align='center'> AMOUNT </th><th $stn>&nbsp;&nbsp;# </th>
							</tr> </thead>
                                        <tbody>";
					
					$n=1;
			while($rif=mysqli_fetch_assoc($repa)){
				$num=$rif['Number'];
				$veh=$rif['Plate'];
				$sta=$rif['Date'];
				$file=$rif['File'];
				$vei=$rif['Vehicle'];

				echo"<style>
tr img { display:none; }
tr:hover img { display:block; }
	</style>";


				echo"<tr>";

				if($file)
	echo"<td $stn style='width:1px;'><img src='repair/$file' style='margin-left:5px; margin-top:-280px; position:absolute;' width='310' height='240' /></td>";
				else
			echo"<td $stn style='width:1px;'> </td>";
				
				echo"<td class='text-right' $stn>$n&nbsp;";
				
				include"itmodal.php";
				$end=number_format($rif['Amount']+$to);
				
				echo"</td><td class='text-center' $stn> $sta </td><td $stn> $veh </td>
				<td class='text-right' $stn> $fob&nbsp;<button type='button' class='btn btn-xs btn-warning hidden-print' style='height:18px; width:20px; padding:0px; margin:-2px 0px 0px 0px;' title='Add Item' data-placement='top' data-toggle='modal' data-target='#mode$n'>
				<i class='lnr lnr-plus-circle'></i></button></td><td class='text-right' $stn> $end&nbsp;</td><td class='text-center' $stn>";
				if($file)
					echo"<a href='down_repa.php?link=$file'>
				<button type='button' class='btn btn-xs btn-info hidden-print' style='height:18px; width:26px; padding:0px; margin:-2px 0px 0px 0px;' title='Download this Image' data-toggle='tooltip' data-placement='top'>&nbsp;&nbsp;<i class='lnr lnr-download'></i> &nbsp;&nbsp;</button></a>";
						  else
							  echo"--";
						  
						  echo"</td></tr>";
                     $n++;
			}
                        
						  echo"</tbody></table>
                        </div>
                    </div><br>
                </div>";
				
				
				
				
			// ******************************* Fuel Consumption ***************************************************	
				
				
	$fuel=mysqli_query($conn, "SELECT `vehicles`.`Plate`, `consumption`.* FROM `consumption` INNER JOIN `vehicles` ON `consumption`.`Vehicle`=`vehicles`.`Number` WHERE `consumption`.`Vehicle`>'0' ORDER BY `consumption`.`Number` DESC LIMIT 7");	
			$fl=mysqli_num_rows($fuel);				
				
				echo"<div class='col-md-4 col-sm-4' title='Fuel Consumption' style='border:1px solid #ffffff'>

					<span class='badge' style='float:right; font-size:10px; margin:0px; margin-right:10px; margin-top:-15px; height:18px; background-color:#99cccc; width:auto; text-align:center; color:#ffffff; position:relative;'> Fuel Consumption </span>

                    <div class='thumbnail thumb-shadow grid' style=' border:1px solid #d7d7c1; background-color:transparent;'>
                        <div class='property-header' style='height: 70px; margin-top:0px;' onmouseout='this.style.opacity=1;this.filters.alpha.opacity=100' 
            onmouseover='this.style.opacity=0.2;this.filters.alpha.opacity=60'><a href='#' data-toggle='modal' data-target='#fuel'>
                            <img class='property-header-image' src='photos/fuel.png' alt='Insurance' style='width:140px; height:60px; border-radius:5px;'>
         <label style='text-align:right; float:right; padding:10px; font-size:18px; margin-right:30px; padding-top:20px; cursor:pointer'> CREATE NEW </label></a>
                        </div>
                       <div class='caption' style='height:160px; width:100%; padding:0px; margin-top:-8px; overflow-x:none; font-size:10px;'>     
						
			 <table class='table table-striped table-hover' style='font-size:10px;'>
							<thead><tr>
                     <th colspan='2' width='1%' $stn>&nbsp;&nbsp;&nbsp;No </th><th $stn><div align='center'> DATE </th>
					 <th $stn><div align='center'> VEHICLE </th><th $stn><div align='center'>&nbsp;&nbsp;&nbsp;QTY&nbsp;&nbsp;&nbsp;</th>
					 <th $stn><div align='center'> AMOUNT </th><th $stn>&nbsp;&nbsp;&nbsp;# </th>
							</tr> </thead>
                                        <tbody>";
					
					$n=1;
			while($rif=mysqli_fetch_assoc($fuel)){
				$veh=$rif['Plate'];
				$sta=$rif['Date'];
				$end=number_format($rif['Price']);
				$file=$rif['File'];
				$qty=number_format($rif['Quantity'], 2);
				$stas=$rif['Station'];

				echo"<style>
tr img { display:none; }
tr:hover img { display:block; }
	</style>";

		echo"<tr title='$stas' data-toggle='tooltip' data-placement='top'>";

				if($file)
					echo"<td style='width:1px;'> 						  
				<img src='fuel/$file' style='margin-left:5px; margin-top:-280px; position:absolute;' width='310' height='240' /></td>";
				else
					echo"<td style='width:1px;'> </td>";
				
				echo"<td class='text-right' $stn>$n&nbsp;&nbsp;</td><td class='text-center' $stn> $sta </td><td $stn> $veh </td>
				<td class='text-right' $stn> $qty&nbsp;</td><td class='text-right' $stn> $end&nbsp;</td><td class='text-center' $stn>";
				if($file)
					echo"<a href='down_fuel.php?link=$file'>
				<button type='button' class='btn btn-xs btn-info hidden-print' style='height:18px; width:26px; padding:0px; margin:-2px 0px 0px 0px;' title='Download this Image' data-toggle='tooltip' data-placement='top'>
						  &nbsp;&nbsp;<i class='lnr lnr-download'></i> &nbsp;&nbsp;</button></a>";
						  else
							  echo"--";
						  
						  echo"</td></tr>";
                     $n++;
			}
                        
						  echo"</tbody></table>
                        </div>
                    </div><br>
                </div>";

				// *************************************** Transport Services **************************************8
				
				 echo"<div class='col-md-4 col-sm-4' title='Transport Services' style='border:1px solid #ffffff'>

					<span class='badge' style='float:right; font-size:10px; margin:0px; margin-right:10px; margin-top:-15px; height:18px; background-color:#99cccc; width:auto; text-align:center; color:#ffffff; position:relative;'> Transport Services </span>

                    <div class='thumbnail thumb-shadow grid' style=' border:1px solid #d7d7c1; background-color:transparent;'>
                        <div class='property-header' style='height: 70px; margin-top:0px;' onmouseout='this.style.opacity=1;this.filters.alpha.opacity=100' 
            onmouseover='this.style.opacity=0.2;this.filters.alpha.opacity=60'><a href='#' data-toggle='modal' data-target='#myTrans'>
                            <img class='property-header-image' src='photos/truck.jpg' alt='Spare Parts' style='width:140px; height:60px; border-radius:5px;'>
         <label style='text-align:right; float:right; padding:10px; font-size:18px; margin-right:30px; padding-top:20px; cursor:pointer'> CREATE NEW </label></a>
                        </div>
                       <div class='caption' style='height:160px; width:100%; padding:0px; margin-top:-8px; overflow-x:none; font-size:10px;'>     
						
			 <table class='table table-striped table-hover' style='font-size:10px;'>
							<thead><tr>
                     <th width='1%' $stn>&nbsp;&nbsp;&nbsp;No </th><th $stn><div align='center'> DATE </th>
					 <th $stn><div align='center'> VEHICLE </th><th $stn><div align='center'> &nbsp;LOCATION&nbsp; </th>
					 <th $stn><div align='right'> AMOUNT&nbsp;&nbsp;</th></tr></thead>
                                        <tbody>";
				$i=1;		//	$stne="style='padding:1px; font-size:12px;'";
$do=mysqli_query($conn, "SELECT `income`.`Date`, `income`.`Amount`, `income`.`District`, `vehicles`.`Plate` FROM `income` INNER JOIN `vehicles` ON `income`.`Vehicle` = `vehicles`.`Number` WHERE `income`.`Status`='0' ORDER BY `income`.`Number` DESC LIMIT 7");
		while($ro=mysqli_fetch_assoc($do)){
			$pla=$ro['Plate'];
			$dat=$ro['Date'];
			$dist=$ro['District'];
			$amo=number_format($ro['Amount']);
			$vou=$ro['Voucher'];
			if($vou)
			$tle="title='Voucher=$vou'";
			else
			$tle="";
		echo"<tr $tle><td $stn><div align='right'>$i&nbsp;&nbsp;</td><td $stn><div align='center'>&nbsp;$dat&nbsp;</td><td $stn> $pla </td>
<td $stn> $dist </td><td $stn><div align='right'> $amo&nbsp;&nbsp;</td></tr>";
			$i++;
		}

                       echo"</table>                          
                        </div>
                    </div><br>
                </div></div>";
				
			//echo"<div class='row'>";	
				
		// ********************************* Control Technique **********************************************		
				
				
				
			$insp=mysqli_query($conn, "SELECT `vehicles`.`Plate`, `inspection`.* FROM `inspection` INNER JOIN `vehicles` ON `inspection`.`Vehicle`=`vehicles`.`Number` WHERE `inspection`.`Ending`>'$Date' ORDER BY `inspection`.`Ending` ASC LIMIT 7");	
			$finsp=mysqli_num_rows($insp);	
				
				
			echo"<div class='col-md-4 col-sm-4' title='Technical Inspection'>

					<span class='badge' style='float:right; font-size:10px; margin:0px; margin-right:10px; margin-top:-15px; height:18px; background-color:#99cccc; width:auto; text-align:center; color:#ffffff; position:relative;'> Technical Inspection </span>

                    <div class='thumbnail thumb-shadow grid' style=' border:1px solid #d7d7c1; background-color:transparent;'>
                        <div class='property-header' style='height: 70px; margin-top:0px;' onmouseout='this.style.opacity=1;this.filters.alpha.opacity=100' 
            onmouseover='this.style.opacity=0.2;this.filters.alpha.opacity=60'><a href='#' data-toggle='modal' data-target='#inspect'>
                            <img class='property-header-image' src='photos/inspection.png' alt='Insurance' style='width:140px; height:60px; border-radius:5px;'>
         <label style='text-align:right; float:right; padding:10px; font-size:18px; margin-right:30px; padding-top:20px; cursor:pointer'> CREATE NEW </label></a>
                        </div>
                       <div class='caption' style='height:160px; width:100%; padding:0px; margin-top:-8px; overflow-x:none; font-size:10px;'>     
						
			 <table class='table table-striped table-hover' style='font-size:10px;'>
							<thead><tr>
                     <th colspan='2' width='1%' $stn>&nbsp;&nbsp;&nbsp;No </th><th $stn><div align='center'> VEHICLE </th>
					 <th $stn><div align='center'> STARTING </th><th $stn><div align='center'> ENDING </th>
					 <th $stn>&nbsp;&nbsp;&nbsp;&nbsp;# </th>
							</tr> </thead>
                                        <tbody>";
					
					$n=1;
			while($rip=mysqli_fetch_assoc($insp)){
				$veh=$rip['Plate'];
				$sta=$rip['Start'];
				$end=$rip['Ending'];
				$file=$rip['File'];

				echo"<style>
tr img { display:none; }
tr:hover img { display:block; }
	</style>";

				echo"<tr>";

				if($file)
					echo"<td $stn style='width:1px;'> 						  
				<img src='inspection/$file' style='margin-left:5px; margin-top:-280px; position:absolute' width='310' height='240' /></td>";
				else
					echo"<td $stn style='width:1px;'> </td>";
				
				echo"<td class='text-right' $stn>$n&nbsp;&nbsp;</td><td $stn> $veh </td><td class='text-center' $stn> $sta </td>
				<td class='text-center' $stn> $end </td><td class='text-center' $stn>";
				if($file)
					echo"<a href='down_insu.php?link=$file'>
				<button type='button' class='btn btn-xs btn-info hidden-print' style='height:18px; width:26px; padding:0px; margin:-2px 0px 0px 0px;' title='Download this Image' data-toggle='tooltip' data-placement='top'>
						  &nbsp;&nbsp;<i class='lnr lnr-download'></i> &nbsp;&nbsp;</button></a>";
						  else
							  echo"--";
						  
						  echo"</td></tr>";
                     $n++;
			}
                        
						  echo"</tbody></table>
                        </div>
                    </div><br>
                </div>";
				
				
				
				
				// ************************************* Transport Permit *****************************************************
				
				
				
		$inst=mysqli_query($conn, "SELECT `vehicles`.`Plate`, `permit`.* FROM `permit` INNER JOIN `vehicles` ON `permit`.`Vehicle`=`vehicles`.`Number` WHERE `permit`.`Ending`>'$Date' ORDER BY `permit`.`Ending` ASC LIMIT 7");	
			$finst=mysqli_num_rows($inst);			
				
				
				echo"<div class='col-md-4 col-sm-4' title='Transport Permit'>

					<span class='badge' style='float:right; font-size:10px; margin:0px; margin-right:10px; margin-top:-15px; height:18px; background-color:#99cccc; width:auto; text-align:center; color:#ffffff; position:relative;'> Transport Permit </span>

                    <div class='thumbnail thumb-shadow grid' style=' border:1px solid #d7d7c1; background-color:transparent;'>
                        <div class='property-header' style='height:70px;' onmouseout='this.style.opacity=1;this.filters.alpha.opacity=100' 
            onmouseover='this.style.opacity=0.2;this.filters.alpha.opacity=60'><a href='#' data-toggle='modal' data-target='#permit'>
                            <img class='property-header-image' src='photos/permit.png' alt='Insurance' style='width:140px; height:60px; border-radius:5px;'>
         <label style='text-align:right; float:right; padding:10px; font-size:18px; margin-right:30px; padding-top:20px; cursor:pointer'> CREATE NEW </label></a>
                        </div>
                        <div class='caption' style='height:160px; width:100%; padding:0px; margin-top:-8px; overflow-x:none;'>     
						
			 <table class='table table-striped table-hover' style='font-size:10px;'>
                     	<thead><tr>
                     <th colspan='2' width='1%' $stn>&nbsp;&nbsp;&nbsp;No </th><th $stn><div align='center'> VEHICLE </th>
					 <th $stn><div align='center'> STARTING </th><th $stn><div align='center'> ENDING </th>
					 <th $stn>&nbsp;&nbsp;&nbsp;&nbsp;# </th>
							</tr> </thead>
                                        <tbody>";
					
					$n=1;
			while($ri=mysqli_fetch_assoc($inst)){
				$veh=$ri['Plate'];
				$sta=$ri['Start'];
				$end=$ri['Ending'];
				$file=$ri['File'];

				echo"<style>
tr img { display:none; }
tr:hover img { display:block; }
	</style>";

				echo"<tr>";

				if($file)
					echo"<td $stn style='width:1px;'> 						  
				<img src='permit/$file' style='margin-left:5px; margin-top:-280px; position:absolute' width='310' height='240' /></td>";
				else
					echo"<td $stn style='width:1px;'> </td>";
				
				echo"<td class='text-right' $stn>$n&nbsp;&nbsp;</td><td $stn> $veh </td><td class='text-center' $stn> $sta </td>
				<td class='text-center' $stn> $end </td><td class='text-center' $stn>";
				if($file)
					echo"<a href='down_inst.php?link=$file'>
				<button type='button' class='btn btn-xs btn-info hidden-print' style='height:18px; width:26px; padding:0px; margin:-2px 0px 0px 0px;' title='Download this Image' data-toggle='tooltip' data-placement='top'>
						  &nbsp;&nbsp;<i class='lnr lnr-download'></i> &nbsp;&nbsp;</button></a>";
						  else
							  echo"--";
						  
						  echo"</td></tr>";
                     $n++;
			}
                        
						  echo"</tbody></table>
                        </div>
                    </div><br>
                </div>";
				
				
				
			// ***************************************** Insurance record ********************************************	
				
				
				
		$insu=mysqli_query($conn, "SELECT `vehicles`.`Plate`, `insurance`.* FROM `insurance` INNER JOIN `vehicles` ON `insurance`.`Vehicle`=`vehicles`.`Number` WHERE `insurance`.`Ending`>'$Date' ORDER BY `insurance`.`Ending` ASC LIMIT 7");	
			$finsu=mysqli_num_rows($insu);

				
				
				echo"<div class='col-md-4 col-sm-4' title='Insurance Records'>

					<span class='badge' style='float:right; font-size:10px; margin:0px; margin-right:10px; margin-top:-15px; height:18px; background-color:#99cccc; width:auto; text-align:center; color:#ffffff; position:relative;'> Insurance Records </span>

                    <div class='thumbnail thumb-shadow grid' style=' border:1px solid #d7d7c1; background-color:transparent;'>
                        <div class='property-header' style='height:70px;' onmouseout='this.style.opacity=1;this.filters.alpha.opacity=100' 
            onmouseover='this.style.opacity=0.2;this.filters.alpha.opacity=60'><a href='#' data-toggle='modal' data-target='#insure'>
                            <img class='property-header-image' src='photos/insurance.png' alt='Insurance' style='width:140px; height:60px; border-radius:5px;'>
         <label style='text-align:right; float:right; padding:10px; font-size:18px; margin-right:30px; padding-top:20px; cursor:pointer'> CREATE NEW </label></a>
                        </div>
                        <div class='caption' style='height:160px; width:100%; padding:0px; margin-top:-8px; overflow-x:none;'>     
						
			 <table class='table table-striped table-hover' style='font-size:10px;'>
							<thead><tr>
                     <th colspan='2' width='1%' $stn>&nbsp;&nbsp;&nbsp;No </th><th $stn><div align='center'> VEHICLE </th>
					 <th $stn><div align='center'> STARTING </th><th $stn><div align='center'> ENDING </th>
					 <th $stn>&nbsp;&nbsp;&nbsp;&nbsp;# </th>
							</tr> </thead>
                                        <tbody>";
					
					$n=1;
			while($ri=mysqli_fetch_assoc($insu)){
				$veh=$ri['Plate'];
				$sta=$ri['Start'];
				$end=$ri['Ending'];
				$file=$ri['File'];

				echo"<style>
tr img { display:none; }
tr:hover img { display:block; }
	</style>";

				echo"<tr>";

				if($file)
					echo"<td $stn style='width:1px;'> 						  
				<img src='insurance/$file' style='margin-left:5px; margin-top:-280px; position:absolute' width='310' height='240' /></td>";
				else
					echo"<td $stn style='width:1px;'> </td>";
				
				echo"<td class='text-right' class='text-center' $stn>$n&nbsp;&nbsp;</td><td $stn> $veh </td>
				<td class='text-center' $stn> $sta </td><td class='text-center' $stn> $end </td><td class='text-center' $stn>";
				if($file)
					echo"<a href='down_insu.php?link=$file'>
				<button type='button' class='btn btn-xs btn-info hidden-print' style='height:18px; width:26px; padding:0px; margin:-2px 0px 0px 0px;' title='Download this Image' data-toggle='tooltip' data-placement='top'>
						  &nbsp;&nbsp;<i class='lnr lnr-download'></i> &nbsp;&nbsp;</button></a>";
						  else
							  echo"--";
						  
						  echo"</td></tr>";
                     $n++;
			}
                        
						  echo"</thead></table>
                        </div>
                    </div><br>
                </div>";


				include'modals.php';
				?>

					

                  </div>                     
                
              </div>
            </div></div>
                  </div>
      
   </div></div></div>  
   <?php
   include'footer.php';
   ?>