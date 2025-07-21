 <?php
$do=mysqli_query($conn, "SELECT *FROM `repair` WHERE `Status`='0' AND `Vehicle`='$name' AND `Trip`='$code' ORDER BY `Date` ASC LIMIT 100");

$dos=mysqli_query($conn, "SELECT *FROM `consumption` WHERE `Status`='0' AND `Vehicle`='$name' AND `Trip`='$code' ORDER BY `Date` ASC LIMIT 100");

$dol=mysqli_query($conn, "SELECT *FROM `income` WHERE `Status`='0' AND `Vehicle`='$name' AND `Trip`='$code' ORDER BY `Date` ASC LIMIT 100");

if($fo=mysqli_num_rows($do) OR $fos=mysqli_num_rows($dos) OR $fol=mysqli_num_rows($dol)){
    echo"<br><br><br><table class='table table-striped table-hover'>     
                    <thead><tr role='row'>
                     <th class='text-center'> No </th>
                        <th class='text-center' width='8%'> Date </th>
                        <th class='text-center'> Destination </th> 
                       <th class='text-center'> Vehicle </th>
						 <th class='text-center'> Purpose </th> 
                        <th class='text-center'> Customer </th> 
                        <th class='text-center'> Quantity </th>  
                        <th class='text-center'> Price </th>
						 <th class='text-center'> Amount </th>
		<th class='hidden-print text-center' width='1%'> # </th></tr></thead>
                                        <tbody>";
					
	$n=$t=1;					$tam=$tdi=$tq=$tpa=$sin=$sout=0;
					
if($_SESSION['Cancel']){
    $disa="";
   }
else{
    $disa="disabled";
    }	
					// *************** Transport Income *******************
		while($rol=mysqli_fetch_assoc($dol)){
$cods=$rol['Number'];
$emplo=$rol['Vehicle'];
$rate=$rol['Rate'];
$tm=number_format($rol['Amount']);
$amo=$rol['Amount']*$rate;
$amoo=number_format($amo, 2);
if($rate!='1')
$desin="($tm x $rate)";
else
$desin="";
$desi="Transport Income $desin";
$dte=$rol['Date'];
$pri=$rol['Amount']*$rate;
$gar=$rol['District'];
$age=$rol['Location'];
$reaso=$rol['Reason'];
$garage="$gar $age";
$qt=1;
$qty=number_format($qt, 2);
$caso=$rol['Customer'];
if(!$driv)
    $driv=$driver;

	$prio=number_format($pri, 2);

$doi=mysqli_query($conn, "SELECT *FROM `vehicles` WHERE `Number`='$emplo'");
			$roi=mysqli_fetch_assoc($doi);
				$fna=$roi['Plate'];
				
$setri=mysqli_query($conn, "SELECT `Customer` FROM `account` WHERE `Number`='$caso'");
        $file=mysqli_fetch_assoc($setri);
            $driv=$file['Customer'];
				
			$tam+=$amo;	                    $sin+=$amo;				

if($reaso)				
$stn="style='padding:1px; font-size:13px; color:red;'";
else				
$stn="style='padding:1px; font-size:13px; color:blue;'";
           
					print("<tr><td $stn class='text-center'>$n</td><td class='text-center' $stn> $dte </td><td $stn> $garage </td><td $stn>&nbsp;$fna&nbsp;</td>
						<td $stn> $desi </td><td $stn> $driv </td><td class='text-right' $stn> $qty </td>
						<td class='text-right' $stn> $prio </td>
						<td class='text-right' $stn> $amoo&nbsp;&nbsp;</td>");

echo"<div class='modal fade' id='exampleModal$n' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true' 
		style='top:220px;'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLabel'>DELETE CONFIRMATION  
		<label style='float:right;'> $fna &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		$garag &nbsp;&nbsp; $prio </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5>

      </div>
      <div class='modal-body' style='height:40px;'>
        <h5 style='color:#ff0033'>Are you sure you want to delete this record?</h5>
      </div><form method='post' action=''>
      <input type='hidden' name='rowid' value='$cods'>
      <input type='hidden' name='code' value='$code'>
      <div class='modal-footer' style='margin-top:-10px; height:50px; padding-top:5px; border:0px solid blue;'>
        <button type='button' class='btn btn-sm btn-success' data-dismiss='modal'>&nbsp;NO&nbsp;</button>
        <button type='submit' name='delete_idi' class='btn btn-sm btn-danger' $disa>YES</button>
      </div></form>
    </div>
  </div>
</div>";




echo"<div class='modal fade' id='requestModal$n' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true' 
		style='top:220px;'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLabel'>CREATE A REQUEST  
		<label style='float:right;'> $fna &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		$garag &nbsp;&nbsp; $prio </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5>

      </div><form method='post' action=''>
      <div class='modal-body' style='height:150px;'>
        <h5 style='color:#ff0033'>Write the reason of your request!</h5>
        <textarea class='form-control' name='reso' rows='3'>$reaso</textarea>
      </div>
      <input type='hidden' name='rowid' value='$cods'>
      <input type='hidden' name='code' value='$code'>
      <input type='hidden' name='custo' value='$custo'>
      <div class='modal-footer' style='margin-top:-10px; height:50px; padding-top:5px; border:0px solid blue;'>
        <button type='button' class='btn btn-sm btn-success' data-dismiss='modal' style='width:80px;'>CANCEL</button>
        <button type='submit' name='reque' class='btn btn-sm btn-warning' style='width:80px;'>SEND</button>
      </div></form>
    </div>
  </div>
</div>";

if($_SESSION['Cancel']){
$taga="#exampleModal$n";
}
else{
    $taga="#requestModal$n";
}	
						
								echo"<td align='right' class='hidden-print' style='width:20px; padding:0px;'>
						  <button type='button' class='btn btn-xs btn-danger hidden-print' style='height:18px; padding:0px; margin:0px;
						  width:25px;' data-placement='top' data-toggle='modal' data-target='$taga'>
						  <i class='lnr lnr-trash'></i></button></td></tr>";
			$n++;			  
		}		  
						  
						  
	if($n>2){
	            $sino=number_format($sin, 2);
	    print("<tr><th style='padding:1px;'> </th><th colspan='5' style='padding:1px; color:teal'> Sub-Total [INCOME] </th>
	<th colspan='3' style='padding:1px; color:teal' class='text-right'> $sino &nbsp;</th>
		<th class='hidden-print' style='padding:1px;'> </th></tr>");
	}					  
						  
						  
						  
						  
						  
						  
						  
						  // ************* Fuel Consumption ************
						  $i=1;                 $tqt=0;
						  while($ros=mysqli_fetch_assoc($dos)){
$cods=$ros['Number'];
$emplo=$ros['Vehicle'];
$amo=$ros['Amount']*$ros['Rate'];
$amoo=number_format($amo, 2);
$desi="Fuel Consumption";
$dte=$ros['Date'];
$fna=$ros['Plate'];
$pri=$ros['Price']*$ros['Rate'];
$garag=$ros['Station'];
$qt=$ros['Quantity'];
$qty=number_format($qt, 2);
$driv='';

	$prio=number_format($pri, 2);

	$tam-=$amo;		                $sout+=$amo;                $tqt+=$qt;			
				
$stn="style='padding:1px; font-size:12px;'";
           
					print("<tr><td $stn class='text-center'>$n</td><td class='text-center' $stn> $dte </td><td $stn> $garag </td><td $stn>&nbsp;$fna&nbsp;</td>
						<td $stn> $desi </td><td $stn> $driv </td><td class='text-right' $stn> $qty </td>
						<td class='text-right' style='padding:1px'> $prio </td>
						<td class='text-right' style='padding:1px'> $amoo&nbsp;&nbsp;</td>");

echo"<div class='modal fade' id='exampleModal$n' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true' 
		style='top:220px;'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLabel'>DELETE CONFIRMATION  
		<label style='float:right;'> $fna &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		$garag &nbsp;&nbsp; $prio </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5>

      </div>
      <div class='modal-body' style='height:40px;'>
        <h5 style='color:#ff0033'>Are you sure you want to delete this record?</h5>
      </div><form method='post' action=''>
      <input type='hidden' name='rowid' value='$cods'>
      <input type='hidden' name='code' value='$code'>
      <div class='modal-footer' style='margin-top:-10px; height:50px; padding-top:5px; border:0px solid blue;'>
        <button type='button' class='btn btn-sm btn-success' data-dismiss='modal'>&nbsp;NO&nbsp;</button>
        <button type='submit' name='delete_ids' class='btn btn-sm btn-danger' $disa>YES</button>
      </div></form>
    </div>
  </div>
</div>";
						
						
						
								echo"<td align='right' class='hidden-print' style='width:20px; padding:0px;'>
						  <button type='button' class='btn btn-xs btn-danger hidden-print' style='height:18px; padding:0px; margin:0px;
						  width:25px;' data-placement='top' data-toggle='modal' data-target='#exampleModal$n'>
						  <i class='lnr lnr-trash'></i></button></td></tr>";
			$n++;			                $i++;
		}		  
						  
						  
		if($i>2){
	            $souto=number_format($sout, 2);
	            $tqto=number_format($tqt, 2);
	    print("<tr><th style='padding:1px;'> </th><th colspan='5' style='padding:1px; color:teal'> Sub-Total [FUEL CONSUMPTION] </th>
	<th style='padding:1px; color:teal' class='text-right'> $tqto &nbsp;</th>
	<th colspan='2' style='padding:1px; color:teal' class='text-right'> $souto &nbsp;</th>
		<th class='hidden-print' style='padding:1px;'> </th></tr>");
	}							  
						  
						  
						  
						  
						  
						  
						  
						  
						  
		// ***************** Repair & Services ************************
						  
						            $k=1;                $otp=0;
						  	while($ro=mysqli_fetch_assoc($do)){
		$sub=0;
$cods=$ro['Number'];
$emplo=$ro['Vehicle'];
$amo=$ro['Amount'];
$amoo=number_format($amo, 2);
$desi=$ro['Issue'];
$dte=$ro['Date'];
$pri=$ro['Amount'];
$garag=$ro['Garage'];
$driv=$ro['Driver'];
$pur=$ro['Purchase'];
$resot=$ro['Reason'];
$fna=$ro['Plate'];
$rat=$ro['Rate'];
$tam-=$pri;	
$sub+=$pri;
$otp+=$pri;
$driv='';

	$prio=number_format($pri, 2);
	
	if((($garag=='MILEAGE' OR $garag=='ROAD TOLL') AND !$ro['Paid']) OR $_SESSION['Ctr'])
	        $ar="<a href='#' data-toggle='modal' data-target='#xsModal$n'>";
	else
	    $ar="";

if($resot)				
$stn="style='padding:1px; font-size:13px; color:red;'";
else
$stn="style='padding:1px; font-size:13px;'";
  if($pri){         
	print("<tr><td $stn class='text-center'>$n</td><td class='text-center' $stn> $dte </td><td $stn> $garag </td><td $stn>&nbsp;$fna&nbsp;</td>
        <td $stn> $desi </td><td $stn> $driv </td><td class='text-right' $stn> 1.00 </td><td class='text-right' $stn>$ar $prio </a></td>
		    <td class='text-right' $stn> $amoo&nbsp;&nbsp;</td>");
		    

    if((($garag=='MILEAGE' OR $garag=='ROAD TOLL') AND !$ro['Paid']) OR $_SESSION['Ctr']){
        
		    // ****************************** Edit milage ***************************
            $amos=$amo/$rat;
            $rats=number_format($rat, 2);
echo"<div class='modal fade' id='xsModal$n' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
  <div class='modal-dialog' role='document'><div class='modal-content'><div class='modal-header text-left'>
        <h5 class='modal-title' id='exampleModalLabel'> EDIT RECORD <span class='pull-right'> $pla => $dese - $loce </span></h5>

      </div><form action='' method='post'>
      <div class='modal-body text-left' style='height:140px;'>
      
      <div class='col-md-2'> </div>
      <div class='col-md-5' style='padding-right:0px;'>
	<br>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; Total Amount <br>
	<input name='amos' class='form-control text-center' type='text' onkeyup='format(this);' onkeypress='return isNumberKey(event)' value='$amos' required> </div>
  
  
  <div class='col-md-4' style='padding-left:0px;'>
	<br>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; Rate <br>
    <input name='rats' class='form-control text-center' type='text' onkeyup='format(this);' onkeypress='return isNumberKey(event)' value='$rats' required></div><div class='col-md-1'> </div>
		   
      </div><input type='hidden' name='rowid' value='$code'>
      <input type='hidden' name='custo' value='$custo'>
      <input type='hidden' name='cods' value='$cods'>
      <div class='modal-footer' style='margin-top:-10px; height:50px; padding-top:5px; border:0px solid blue;'>
        <button type='button' class='btn btn-sm btn-danger' data-dismiss='modal'  style='width:80px;'> CANCEL </button>
        <button type='submit' name='editrip' class='btn btn-sm btn-success' style='width:80px;'> UPDATE </button>
      </div></form>
    </div>
  </div>
</div>";

// *************************************** End of modal *******************
}


echo"<div class='modal fade' id='exampleModals$n' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true' 
		style='top:220px;'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLabel'>DELETE CONFIRMATION  
		<label style='float:right;'> $fna &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		$garag &nbsp;&nbsp; $prio </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5>

      </div>
      <div class='modal-body' style='height:40px;'>
        <h5 style='color:#ff0033'>Are you sure you want to delete this record?</h5>
      </div><form method='post' action=''>
      <input type='hidden' name='rowid' value='$cods'>
      <input type='hidden' name='code' value='$code'>
      <div class='modal-footer' style='margin-top:-10px; height:50px; padding-top:5px; border:0px solid blue;'>
        <button type='button' class='btn btn-sm btn-success' data-dismiss='modal'>&nbsp;NO&nbsp;</button>
        <button type='submit' name='delete_id' class='btn btn-sm btn-danger' $disa>YES</button>
      </div></form>
    </div>
  </div>
</div>";


echo"<div class='modal fade' id='requestModals$n' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true' 
		style='top:220px;'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLabel'>DELETE REQUEST  
		<label style='float:right;'> $fna &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		$garag &nbsp;&nbsp; $prio </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5>

      </div><form method='post' action=''>
      <div class='modal-body' style='height:150px;'>
        <h5 style='color:#ff0033'>Write the reason of your request!</h5>
    <textarea class='form-control' name='resot' rows='3'>$resot</textarea>
      </div>
      <input type='hidden' name='rowid' value='$cods'>
      <input type='hidden' name='code' value='$code'>
      <input type='hidden' name='custo' value='$custo'>
      <div class='modal-footer' style='margin-top:-10px; height:50px; padding-top:5px; border:0px solid blue;'>
        <button type='button' class='btn btn-sm btn-success' data-dismiss='modal' style='width:80px;'>CANCEL</button>
        <button type='submit' name='requet' class='btn btn-sm btn-warning' style='width:80px;'>SEND</button>
      </div></form>
    </div>
  </div>
</div>";	

if($_SESSION['Cancel']){
$taga="#exampleModals$n";
}
else{
    $taga="#requestModals$n";
}	
						
								echo"<td align='right' class='hidden-print' style='width:20px; padding:0px;'>
						  <button type='button' class='btn btn-xs btn-danger hidden-print' style='height:18px; padding:0px; margin:0px;
						  width:25px;' data-placement='top' data-toggle='modal' data-target='$taga'>
						  <i class='lnr lnr-trash'></i></button></td></tr>";

  }
	$dob=mysqli_query($conn, "SELECT `items`.`Item`, `stouse`.`Number`, `stouse`.`Date`, `stouse`.`Price`, `stouse`.`Quantity`, `stouse`.`Status`, `stouse`.`Store`, `stouse`.`Item` AS 'Ites' FROM `stouse` INNER JOIN `items` ON `stouse`.`Item` = `items`.`Number` WHERE `stouse`.`Status`!='1' AND `stouse`.`Repair`='$cods' ORDER BY `stouse`.`Number` ASC");
		if($fob=mysqli_num_rows($dob)){
		while($rob=mysqli_fetch_assoc($dob)){
			$stl="padding:0px; color:#6600ff;";
			$numu=$rob['Number'];
			$dati=$rob['Date'];
			$pri=$rob['Price'];
			$qty=$rob['Quantity'];
			$name=$rob['Item'];
			$status=$rob['Status'];
			$stor=$rob['Store'];
			$ites=$rob['Ites'];
			$all=$pri*$qty;

	$tam-=$all;						$sub+=$all;                 $otp+=$all;
			
			if($stor=='0')
				$garag="";
			else
				$garag="[STORE]";

			$prio=number_format($pri, 2);				
			$qto=number_format($qty, 2);			
			$allo=number_format($all, 2);

print("<tr><td style='padding:0px;'></td><td colspan='2' style='$stl $clr'>");
			
			
	echo"<div class='modal fade' id='iModal$t' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true' style='top:220px;'>
  <div class='modal-dialog' role='document'><div class='modal-content'><div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLabel'>DELETE CONFIRMATION  
		<label style='float:right;'> $name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
		$allo </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5>

      </div>
      <div class='modal-body' style='height:40px;'>
        <h5 style='color:#ff0033'>Are you sure you want to delete this record?</h5>
      </div><form method='post' action=''>
      <input type='hidden' name='rowid' value='$cods'>
	  <input type='hidden' name='code' value='$code'>
	  <input type='hidden' name='numu' value='$numu'>
	  <input type='hidden' name='stor' value='$stor'>
	  <input type='hidden' name='qts' value='$qty'>
	  <input type='hidden' name='ites' value='$ites'>
      <div class='modal-footer' style='margin-top:-10px; height:50px; padding-top:5px; border:0px solid blue;'>
        <button type='button' class='btn btn-sm btn-success' data-dismiss='modal'>&nbsp;NO&nbsp;</button>
        <button type='submit' name='deloge' class='btn btn-sm btn-danger' $disa>YES</button>
      </div></form>
    </div>
  </div>
</div>";

			
			print("</td><td style='$stl $clr'> </td>
			<td colspan='2' style='$stl $clr'>$name &nbsp;&nbsp; <font size='1'>$garag</font></td>
			<td class='text-right' style='$stl $clr'>$qto</td><td class='text-right' style='$stl $clr'>$prio</td>
			<td class='text-right' style='$stl $clr'>$allo&nbsp;&nbsp;</td>
			
			<td align='right' class='hidden-print' style='width:20px; padding:0px;'>
						  <button type='button' class='btn btn-xs btn-warning hidden-print' style='height:18px; padding:0px; margin:0px;
						  width:25px;' data-placement='top' data-toggle='modal' data-target='#iModal$t'>
						  <i class='lnr lnr-trash'></i></button></td></tr>");									
				$t++;               		$k++;		
						}
						
		}
						$n++;                   $k++;							
						}
						
	    	if($k>2){
	            $otpo=number_format($otp, 2);
	    print("<tr><th style='padding:1px;'> </th><th colspan='5' style='padding:1px; color:teal'> Sub-Total [OTHER CONSUMPTION] </th>
	<th colspan='3' style='padding:1px; color:teal' class='text-right'> $otpo &nbsp;</th>
		<th class='hidden-print' style='padding:1px;'> </th></tr>");
	}	
									
							$tam=number_format($tam, 2);					

		
                    echo"</tbody><thead> 
		<tr><th> </th><th colspan='5'>&nbsp;&nbsp;Total Balance [INCOME - CONSUMPTION] </th>
<th colspan='3' class='text-right' style='padding:0px'> $tam &nbsp;&nbsp;</th>
		<th class='hidden-print text-right' style='padding:0px'> </th></tr>
            </thead></table>";
}
    ?>