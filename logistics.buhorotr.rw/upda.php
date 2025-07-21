<?php
include'connection.php';
$suser="bfbms";
if($Time >= '06:00:00'){
// *********************** Insurance ***********************************
$insu=mysqli_query($conn, "SELECT `Number`, `Vehicle`, `Start`, `Ending`, `Company` FROM `insurance` WHERE `Ending`>'$Date' AND `Status`='0' AND `Upda`='0' ORDER BY `Ending` ASC LIMIT 30");	
		if($finsu=mysqli_num_rows($insu)){
	while($ri=mysqli_fetch_assoc($insu)){
	            $nuo=$ri['Number'];
				$veh=$ri['Vehicle'];
				$sta=$ri['Start'];
				$end=$ri['Ending'];
				$des=$ri['Company'];
	$do=mysqli_query($conn, "INSERT INTO `notify` (`Number`, `Date`, `Plate`, `Permit`, `Start`, `Ending`, `Descri`, `Refer`, `Source`) VALUES (NULL, '$Date', '$veh', 'INSURANCE', '$sta', '$end', '$des', '$nuo', 'insurance')");
	    }
	$so=mysqli_query($conn, "UPDATE `insurance` SET `Upda`='1' WHERE `Ending`>'$Date' AND `Status`='0' AND `Upda`='0' ORDER BY `Ending` ASC LIMIT 30");
		}
		
// *********************** Inspection ***********************************
$insu=mysqli_query($conn, "SELECT `Number`, `Vehicle`, `Start`, `Ending`, `Place` FROM `inspection` WHERE `Ending`>'$Date' AND `Status`='0' AND `Upda`='0' ORDER BY `Ending` ASC LIMIT 30");	
		if($finsu=mysqli_num_rows($insu)){
	while($ri=mysqli_fetch_assoc($insu)){
	            $nuo=$ri['Number'];
				$veh=$ri['Vehicle'];
				$sta=$ri['Start'];
				$end=$ri['Ending'];
				$des=$ri['Place'];
	$do=mysqli_query($conn, "INSERT INTO `notify` (`Number`, `Date`, `Plate`, `Permit`, `Start`, `Ending`, `Descri`, `Refer`, `Source`) VALUES (NULL, '$Date', '$veh', 'TECHNICAL INSPECTION', '$sta', '$end', '$des', '$nuo', 'inspection')");
	    }
	$so=mysqli_query($conn, "UPDATE `inspection` SET `Upda`='1' WHERE `Ending`>'$Date' AND `Status`='0' AND `Upda`='0' ORDER BY `Ending` ASC LIMIT 30");
		}
		
// *********************** T Permit ***********************************
$insu=mysqli_query($conn, "SELECT `Number`, `Vehicle`, `Start`, `Ending`, `Type` FROM `permit` WHERE `Ending`>'$Date' AND `Status`='0' AND `Upda`='0' ORDER BY `Ending` ASC LIMIT 30");	
		if($finsu=mysqli_num_rows($insu)){
	while($ri=mysqli_fetch_assoc($insu)){
	            $nuo=$ri['Number'];
				$veh=$ri['Vehicle'];
				$sta=$ri['Start'];
				$end=$ri['Ending'];
				$des=$ri['Type'];
	$do=mysqli_query($conn, "INSERT INTO `notify` (`Number`, `Date`, `Plate`, `Permit`, `Start`, `Ending`, `Descri`, `Refer`, `Source`) VALUES (NULL, '$Date', '$veh', '$des', '$sta', '$end', '$des', '$nuo', 'permit')");
	    }
	$so=mysqli_query($conn, "UPDATE `permit` SET `Upda`='1' WHERE `Ending`>'$Date' AND `Status`='0' AND `Upda`='0' ORDER BY `Ending` ASC LIMIT 30");
		}

// ************************** Flush table ******************************
	$sos=mysqli_query($conn, "DELETE FROM `notify` WHERE `Ending`<'$Date'");


// ************************** Check for amendment ***********************	
	$closs=mysqli_query($conn, "SELECT `Number`, `Ending`, `Refer`, `Source` FROM `notify` WHERE `Ending`>'$Date' ORDER BY RAND() ASC LIMIT 30");	
		if($foss=mysqli_num_rows($closs)){
	while($ross=mysqli_fetch_assoc($closs)){
	            $nuo=$ross['Number'];
	            $refe=$ross['Refer'];
				$end=$ross['Ending'];
				$sou=$ross['Source'];
		$found=mysqli_query($conn, "SELECT `Number` FROM `$sou` WHERE `Number`='$refe' AND `Ending`='$end'");
		if(!$foun=mysqli_num_rows($found))
		$sos=mysqli_query($conn, "DELETE FROM `notify` WHERE `Number`='$nuo'");
		else{
		    $date = strtotime("-5 days", strtotime("$end"));
                $date = date ("Y-m-d", $date);
                
    $sos=mysqli_query($conn, "UPDATE `notify` SET `Noted`='$date', `Time`='$Time' WHERE `Number`='$nuo' AND `Sent`='0'");
		}
	}
		}
	
	// ************************** Send notifications *********************
	if($Time>'10:00:00'){
	$not=mysqli_query($conn, "SELECT `Number`, `Ending`, `Plate`, `Permit`, `Descri` FROM `notify` WHERE `Noted`<='$Date' AND `Noted`!='0000-00-00' AND `Sent`='0' ORDER BY RAND() ASC LIMIT 10");	
		if($fot=mysqli_num_rows($not)){
	while($rot=mysqli_fetch_assoc($not)){
	    $nuo=$rot['Number'];
	    $per=$rot['Permit'];
	    $end=$rot['Ending'];
	    $veh=$rot['Plate'];
	    $des=$rot['Descri'];
	    $spass="6o7l5h";
	    
	$do=mysqli_query($conn, "SELECT `Plate`, `Driver`, `Phone1`, `Phone2`, `Email1`, `Email2`, `Email3` FROM `vehicles` WHERE `Status`='0' AND `Number`='$veh' ORDER BY `Number` ASC LIMIT 1");
            if($fo=mysqli_num_rows($do)){
                $ro=mysqli_fetch_assoc($do);
                $plate=$ro['Plate'];
                $pho1=$ro['Phone1'];
                $pho2=$ro['Phone2'];
                $eme1=$ro['Email1'];
                $eme2=$ro['Email2'];
                $eme3=$ro['Email3'];
                $driv=$ro['Driver'];
                
                $endi = date ("d-m-Y", strtotime("$end"));
                if($per=='INSURANCE')
                    $pt="Ni muri $des";
                else
                    $pt='';
	    
	// *************************** Send SMS 1 *******************************
	   if($pho1){
	        $Te=$pho1;
	    include'sends.php';
	   }
	    
    // *************************** Send SMS 2 *******************************
        if($pho2){
	         $Te=$pho2;
	    include'sends.php';
	   }   
	    
	// **************************** Send email 1 ****************************
	    if($eme1){
	        $mail=$eme1;
	    include'sendm.php';
	    }
	    
	// **************************** Send email 1 ****************************
	      if($eme2){
	        $mail=$eme2;
	    include'sendm.php';
	    } 
	    
	// **************************** Send email 1 ****************************
	     if($eme3){
	        $mail=$eme3;
	    include'sendm.php';
	    }
	    
	 // ****************** Verify SMS **************************************
	   $pho="0788355756";
	     if($pho){
	         $Te=$pho;
	    include'sends.php';
	   }  
	   
            }    
	}
		}
    	
	}
}



 
    // ************************ Fuel calculation ***********************
    $do=mysqli_query($conn, "SELECT SUM(`Quantity`) AS `Qty` FROM `stouse` WHERE `Date`<'$Date' AND `Action`='PURCHASE' AND `Status`='0' AND `Store`='0' AND `Destin`='MARTIN PETROLEUM'");
    if($fo=mysqli_num_rows($do)){
        $ro=mysqli_fetch_assoc($do);
            $qty=$ro['Qty'];
    $so=mysqli_query($conn, "UPDATE `items` SET `Quantity`=`Quantity`-'$qty' WHERE `Item`='MARTIN PETROLEUM' AND `Status`='0'");
    
    $sso=mysqli_query($conn, "UPDATE `stouse` SET `Store`='1' WHERE `Date`<'$Date' AND `Action`='PURCHASE' AND `Status`='0' AND `Store`='0' AND `Destin`='MARTIN PETROLEUM'");
    }

// ********************** Upload plate to tables *************************
$sepa=mysqli_query($conn, "SELECT `Number`, `Plate` FROM `vehicles` WHERE `Plate` != '' AND `Status`='0' GROUP BY `Plate` ORDER BY `Plate` ASC LIMIT 100");
while($repa=mysqli_fetch_assoc($sepa)){
    $pla=$repa['Plate'];
    $veh=$repa['Number'];
    
$then=mysqli_query($conn, "UPDATE `repair` SET `Plate`='$pla' WHERE `Vehicle`='$veh' AND `Plate`!='$veh' ORDER BY `Number` DESC LIMIT 10");	

$then=mysqli_query($conn, "UPDATE `consumption` SET `Plate`='$pla' WHERE `Vehicle`='$veh' AND `Plate`!='$veh' ORDER BY `Number` DESC LIMIT 100");

$then=mysqli_query($conn, "UPDATE `income` SET `Plate`='$pla' WHERE `Vehicle`='$veh' AND `Plate`!='$veh' ORDER BY `Number` DESC LIMIT 10");
}

$then=mysqli_query($conn, "UPDATE `repair` SET `Type`='1' WHERE `Garage`='OTHER EXPENSE' ORDER BY `Number` DESC LIMIT 10");
		mysqli_close($conn);
?>