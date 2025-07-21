<?php
if(basename($_SERVER['PHP_SELF']) == 'rloan.php') 
  $pr=" class='current'";
include'header.php';
$dato=$datos=$Date;
$p=0;

// search request by date
if(isset($_POST['search']))
		{
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$p=1;
		}


// create a loan request
if(isset($_POST['create']))
		{
				$empo=$_POST['empo'];
			$amo=str_replace(',', '', $_POST['amo']); 
				$loan=$_POST['loan'];  
				$dato=$_POST['dato']; 

	$doi=mysqli_query($conn, "SELECT `Payment`, `Percent` FROM `loans` WHERE `Number`='$loan' AND `Status`='0' ORDER BY `Number` DESC");
		$roi=mysqli_fetch_assoc($doi);
				$rate=$roi['Percent'];
				$pay=$roi['Payment'];

	$so=mysqli_query($conn, "INSERT INTO `request` (`Date`, `User`, `Loan`, `Employee`, `Amount`, `Percent`, `Payment`) VALUES ('$dato', '$loge', '$loan', '$empo', '$amo', '$rate', '$pay')");
		}

		// approve a given loan
if(isset($_POST['uplo']))
		{
				$month=$_POST['month'];
				$year=$_POST['year'];
			$amo=str_replace(',', '', $_POST['amo']); 
			$rate=str_replace(',', '', $_POST['rate']); 
			$pay=str_replace(',', '', $_POST['pay']);
			$refe=str_replace("'", "`", $_POST['refe']); 
				$naso=$_POST['naso'];
			$end = date('m-t', strtotime($month) );
			$end="$year-$end";

	$so=mysqli_query($conn, "UPDATE `request` SET `Percent`='$rate', `Payment`='$pay', `Approve`='$amo', `Apdate`='$Date', `Balance`='$amo', `Scount`='$sta', `Reference`='$refe' WHERE `Number` = '$naso' ORDER BY `Number` ASC LIMIT 1");
		}

	// delete a given record
if(isset($_POST['delo']))
		{
			$naso=$_POST['naso'];
	$so=mysqli_query($conn, "DELETE FROM `request` WHERE `Number`='$naso'");
		}

		if($dato==$datos)
			$mpri="ON $dato";
		else
			$mpri="FROM $dato TO $datos";
?>


<div class="container-fluid main-content">
        <div class="page-title">
          <h1 style='margin-top:-20px; margin-bottom: 5px;'>
         Contribute
          </h1>
                 </div>
     
         <div class="row">
  <div class="col-lg-2 hidden-print">
   
   
   
   <ul class="list-group">
      
    <li class="list-group-item">
	  <a href="conte.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Create Contribution
                </p>
              </a></li>  

	   <li class="list-group-item">
              <a href="cloan.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Loan Configuration
                </p>
              </a></li>  

	   <li class="list-group-item active">
              <a href="rloan.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Loan Request
                </p>
              </a></li>   

	   <li class="list-group-item">
              <a href="payout.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Payout/Expenses
                </p>
              </a></li>     

	   <li class="list-group-item">
              <a href="lpay.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Loan Repayment
                </p>
              </a></li> 
                         
            </ul>
  </div>

  
		 <?php
		 // ******************************* Create new request modal *****************************

		echo"<div class='modal fade' id='model'>
		<div class='modal-dialog' role='document'>
		<div class='modal-content'><div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLabel'> CREATE NEW REQUEST </h5>

      </div><form action='' method='post'>
      <div class='modal-body' style='height:auto;'>

       <div class='col-xs-12 text-primary'> Loan Details </div>
			<div class='col-xs-4 text-right' style='padding-top:10px;'> Employee Name </div>
			<div class='col-xs-8'> <select class='form-control' name='empo' required>
				<option value='' selected='selected'>Select Employee</option>";
		
	$doi=mysqli_query($conn, "SELECT `Eid`, `Fname`, `Lname` FROM `employees` WHERE `Status`='0' ORDER BY `Fname` ASC");
			while($roi=mysqli_fetch_assoc($doi)){
				$fna=$roi['Fname'];
				$eid=$roi['Eid'];
				$lna=$roi['Lname'];
			echo"<option value='$eid'> $fna $lna </option>";
			}
			   
                 echo"</select></div>
			
			<div class='col-xs-4 text-right' style='padding-top:10px;'> Loan Name </div>
			<div class='col-xs-8'><select class='form-control' name='loan' required>
				<option value='' selected='selected'>Select Loan</option>";
		
	$doi=mysqli_query($conn, "SELECT `Number`, `Name`, `Amount`, `Payment` FROM `loans` WHERE `Status`='0' ORDER BY `Number` DESC");
			while($roi=mysqli_fetch_assoc($doi)){
				$na=$roi['Name'];
				$nuo=$roi['Number'];
				$lna=$roi['Lname'];
				$pay=number_format($roi['Payment']);
			echo"<option value='$nuo'> $na @ $pay / Month</option>";
			}
			   
                 echo"</select></div>

			<div class='col-xs-4 text-right' style='padding-top:10px;'> Total&nbsp;Amount </div>
			<div class='col-xs-8'><div class='input-group' style='width:100%'>
			<input name='amo' class='form-control text-center' type='text' onkeyup='format(this);' onkeypress='return isNumberKey(event)' required>
			<span class='input-group-addon' style='width:20%; text-align:left; color:#009900'><b> Rwf </b></span>
			</div></div>			

			<div class='col-xs-4 text-right' style='padding-top:10px;'> Due Date </div>
			<div class='col-xs-8'><div class='input-group date datepicker' style='width:100%'>
			<input name='dato' class='form-control text-center' type='text' id='from' 
			value='$Date' onkeypress='return isNumberKey(event)' required>
			<span class='input-group-addon' style='width:20%;'><i class='lnr lnr-calendar-full'></i></span>
			</div></div>

			<div class='row'> </div>

		<div class='col-xs-12 text-primary text-center'><br> &nbsp; </div>
		
	<div class='row'> </div>	

      <div class='modal-footer' style='margin-top:0px; height:45px; padding-top:5px; margin:0px; padding:0px;'> 

	  <div class='col-xs-5' style='padding-left:1px; padding-right:1px;'> </div>

	<div class='col-xs-7 text-right pull-right' style='padding-left:1px; padding-right:1px; margin-right:0px;'>
        <button type='button' class='btn btn-sm btn-default' data-dismiss='modal' style='width:80px; padding:5px;'> CLOSE </button>
        <button type='submit' name='create' class='btn btn-sm btn-success' style='width:80px; padding:5px;'>CREATE</button>
      </div></div></form>
    </div></div></div></div>";

// *********************************************** End of modal **************************************
?>

      <div class="col-lg-10">
                  <div class="row">
         
           <div class="col-lg-2" style="padding-left:50px;">
		   <button type="button" class="btn btn-block btn-success hidden-print" title="Create Smart Card" data-placement="top" data-toggle="modal" data-target="#model"> CREATE&nbsp;NEW </button></div><div class="col-lg-1 hidden-xs"> </div>
          
        <form action="" method="post" class="form-horizontal ">                  
                       <div class="col-lg-8 hidden-print"><div class="col-lg-4"> 					
					 
					   </div>
             <div class="col-lg-3"> 
           <div class="input-group date datepicker">
      <input class="form-control form-center" name="dato" type="text" value="<?php echo $dato ?>" id="to" onkeypress='return isNumberKey(event)' required>
	  <span class="input-group-addon"><i class="lnr lnr-calendar-full"></i></span>
			</div></div>


		  <div class="col-lg-3"> 
           <div class="input-group date datepicker">	
      <input class="form-control form-center" name="datos" type="text" value="<?php echo $datos ?>" id="to" onkeypress='return isNumberKey(event)' required>
	  <span class="input-group-addon"><i class="lnr lnr-calendar-full"></i></span>
              </div></div>                     
                       
                       <div class="col-lg-2"><?php echo"<input type='hidden' name='pg' value='$pg'>"; ?>
                        <button class="btn  btn-primary btn-block" type="submit" name="search"><i class="lnr lnr-magnifier"></i> Search</button>
                   
					  </div>
                         </div></form>               
            </div>
               <?php
               if($p)
	$dok=mysqli_query($conn, "SELECT *FROM `request` WHERE `Status`='0' AND `Date` BETWEEN '$dato' AND '$datos' ORDER BY `Number` ASC LIMIT 15");
		        else
		$dok=mysqli_query($conn, "SELECT *FROM `request` WHERE `Status`='0' AND `Approve`='0' ORDER BY `Number` ASC LIMIT 15");
				if($fo=mysqli_num_rows($dok)){
				?>
                 
            <div class="divFooter"><center><u><b>LOAN REQUEST REPORT <?php echo $mpri ?></b></u></center></div>
             <div class="row">
            <div class="col-lg-12">
             <span> &nbsp;&nbsp; Total Records Found : <b><?php echo" $fo " ?></b></span>
			 <span class="pull-right hidden-print"><?php echo"$bank   $account"; ?>&nbsp;&nbsp;
			 <a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'>
			 <i class="lnr lnr-printer"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">

	<table class="table table-striped table-hover">     
                                      <thead>
                    <tr role="row">
                     <th class="hidden-xs" style='padding:1px;' width='5%'>&nbsp;&nbsp;&nbsp;&nbsp; No </th>
					 <th style='text-align:center; padding:1px;'>&nbsp;&nbsp;&nbsp;Date </th>
					 <th style='padding:1px;'>&nbsp;&nbsp;&nbsp;User </th><th style='padding:1px;'>&nbsp;&nbsp;&nbsp;Employee </th>
					 <th style='padding:1px;'><div align='center'> Loan&nbsp;Name </th>
					 <th style='padding:1px;'><div align='center'> Loan&nbsp;Amount </th>
					 <th style='padding:1px;'><div align='center'> Interest&nbsp;Rate </th>
					 <th style='padding:1px;'><div align='center'> Pay&nbsp;Amount </th>
					 <th style='padding:1px;'><div align='center'> Monthly&nbsp;Payment </th>
					 <th style='padding:1px;' width='5%'><div align='center'> Status </th>
		<th class="hidden-print" colspan='2' style='padding:1px;'><div align='center'>&nbsp;Options&nbsp;</th>
                     </tr>
                    </thead>
                                        <tbody>
					<?php
								$i=1;		$tamo=$tpay=0;
						while($rok=mysqli_fetch_assoc($dok)){
			$dte=$rok['Date'];
			$empo=$rok['Employee'];
			$user=$rok['User'];
			$lim=$rok['Amount'];
			$rate=$rok['Percent'];
			$pay=$rok['Payment'];
			$nuo=$rok['Number'];
			$loa=$rok['Loan'];
			
	if($ro['Approve']>'0')
		$lbt="<span class='label label-success' style='width:70px; height:20px; margin:0px; padding:3px 0px 0px 0px;'>TAKEN</span>";
	else
		$lbt="<span class='label label-warning' style='width:70px; height:20px; margin:0px; padding:3px 0px 0px 0px'>PENDING</span>";

		$doe=mysql_query("SELECT `Fname`, `Lname`, `Salary` FROM `employees` WHERE `Eid`='$empo' ORDER BY `Fname` ASC");
		$foe=mysql_num_rows($doe);
		$roe=mysql_fetch_assoc($doe);
			$fna=$roe['Fname'];
			$lna=$roe['Lname'];
			$sal=$roe['Salary'];

		$doi=mysqli_query($conn, "SELECT `Name` FROM `loans` WHERE `Number`='$loa' ORDER BY `Number` DESC");
		$roi=mysqli_fetch_assoc($doi);
				$name=$roi['Name'];
				
				$all=$lim+($lim*$rate/100);

	$stl="padding:1px;";					$limo=number_format($lim);			$payo=number_format($pay);				$salo=number_format($sal);
	        $allo=number_format($all);

				print("<tr><td class='hidden-xs' style='$stl $clr'><div align='right'>$i&nbsp;</td>
						<td style='$stl $clr'><div align='center'> $dte </td><td class='hidden-xs' style='$stl $clr'> $user </td>
	<td class='hidden-xs' style='$stl $clr'> $fna $lna </td><td style='$stl $clr'> $name </td><td style='$stl $clr'><div align='right' style='padding-right:20px;'> $limo </td>
						<td style='$stl $clr'><div align='right'> $rate % &nbsp;&nbsp;</td><td style='$stl $clr'><div align='right' style='padding-right:20px;'> $allo </td>
						
						<td style='$stl $clr'>
						<div align='right'> $payo </td>
						<td style='$stl $clr'> $lbt </td>");


// ************************************* Open delete confirmation modal ******************************************
		echo"<div class='modal fade' id='exampleModal$i'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLabel'>DELETE CONFIRMATION 
		<label style='float:right; text-align:right;'><b>$fna $lna &nbsp;&nbsp;&nbsp;&nbsp; $limo </b></label></h5>

      </div>
      <div class='modal-body' style='height:40px;'>
        <h5 style='color:#ff0033'>Do you want to delete this record?</h5>
      </div><form method='post' action=''><input type='hidden' name='naso' value='$nuo'>
      <div class='modal-footer' style='margin-top:-10px; height:50px; padding-top:5px; border:0px solid blue;'>
        <button type='button' class='btn btn-sm btn-success' data-dismiss='modal'>&nbsp;NO&nbsp;</button>
        <button type='submit' name='delo' class='btn btn-sm btn-danger'>YES</button>
      </div></form>
    </div>
  </div>
</div>";
	// ****************************************** End of modal ****************************************	



// ************************************* Open loan approval modal ******************************************
		echo"<div class='modal fade' id='exampleModals$i'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'><div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLabel'>LOAN APPROVAL 
		<label style='float:right; text-align:right;'><b>$fna $lna </b></label></h5>";

$dote=mysql_query("SELECT SUM(`Salary`*`Percent`/100) AS 'Conte', SUM(`Salary`*`Company`/100) AS 'Compe' FROM `contribute` WHERE `Status`='0'");
		$rote=mysql_fetch_assoc($dote);
	$conte=$rote['Conte']+$rote['Compe'];				
	    $conto=number_format($conte);
	    
	    $balo=0;

$out=mysql_query("SELECT SUM(`Salary`*`Percent`/100) AS 'Conte', SUM(`Salary`*`Company`/100) AS 'Compa', COUNT(DISTINCT(Ending)) AS `Mo` FROM `contribute` WHERE `Status`='0' AND `Employee`='$empo'");
		$rout=mysql_fetch_assoc($out);
			$sav=$rout['Conte'];
			$mo=$rout['Mo'];
			$savo=number_format($sav);
			$mt="Mt";

      echo"</div><form method='post' action=''>
      <div class='modal-body' style='height:340px;'>
        <div class='col-xs-4 text-center'> Contribution: $conto </div>
		<div class='col-xs-4 text-center text-primary'> Cash-In: $limo </div><div class='col-xs-4 text-center'> Cash-Out: $balo </div>

		
        <div class='col-xs-4 text-center text-primary'> Net Salary: $salo </div>
		<div class='col-xs-4 text-center'> Saving ($mo$mt): $savo </div><div class='col-xs-4 text-center text-primary'> Available: $limo </div>
		<br><br><hr style='border:1px solid #f0f0f0;'>

		<div class='col-xs-6 text-right' style='padding-top:5px;'> Allowed Amount </div><div class='col-md-6'> 
              <input name='amo' value='$limo' class='form-control text-center' type='text' onkeypress='return isNumberKey(event)' onkeyup='format(this);'>
            </div><br><br>
			
		<div class='col-xs-6 text-right' style='padding-top:5px;'> Payment / Rate </div><div class='col-md-3'> 
              <input name='pay' value='$payo' class='form-control text-right' type='text' onkeypress='return isNumberKey(event)' onkeyup='format(this);'>
            </div><div class='col-md-3'><div class='input-group' style='width:100%'>
			<input name='rate' value='$rate' class='form-control text-right' type='text' onkeypress='return isNumberKey(event)' required>
			<span class='input-group-addon' style='width:20%; text-align:left; color:#009900'><b> % </b></span>
			</div></div><br><br>			
			
		<div class='col-xs-6 text-right' style='padding-top:5px;'> Start Counting </div><div class='col-md-3'> 
              <select class='form-control' name='month' required>
			<option value='' selected='selected'> Month </option>";
             $year=date("Y");
    for ($t = 1; $t < 13;   $t++) {
     $date_str = date("F", mktime(0, 0, 0, $t, 10));
	if($date_str==$month)
		$st='selected';
	else
		$st='';
    echo "<option value='$date_str' $st>".$date_str ."</option>";
    } 
	
              echo"</select>  
	 </div>
            <div class='col-xs-3'>
	<select class='form-control' name='year' required>
		<option value='' selected='selected'> Year </option>";
                 
				 $l=date("Y")+2;
				 $e=$l-11;
    for ($k = $l; $k > $e;   $k--) {
		if($k==$year)
			$si='selected';
		else
			$si='';
    echo "<option value='$k' $si>".$k."</option>";
    } 
	
              echo"</select></div><br><br>

	<div class='col-xs-6 text-right' style='padding-top:5px;'> Reference </div><div class='col-md-6'> 
              <input name='refe' class='form-control' type='text'>
            </div>

		<br><br><hr style='border:1px solid #f0f0f0;'>
      <div class='row'></div><input type='hidden' name='naso' value='$nuo'>
      <div class='modal-footer' style='margin-top:-10px; height:50px; padding-top:5px; border:0px solid blue;'>
        <button type='button' class='btn btn-sm btn-danger' data-dismiss='modal' style='width:100px'>CANCEL</button>
        <button type='submit' name='uplo' class='btn btn-sm btn-success' style='width:100px'> SAVE </button>
      </div></form>
    </div>
  </div>
</div>";
	// ****************************************** End of modal ****************************************	




	print("<td class='hidden-print' align='right' style='width:20px; padding:0px;'>
            <input type='hidden' name='naso' value='$code'><input type='hidden' name='dato' value='$dato'>
			<input type='hidden' name='datos' value='$datos'><input type='hidden' name='custo' value='$custo'>
            <button type='button' class='btn btn-xs btn-info hidden-print' style='height:18px; padding:0px; margin:0px;' data-placement='top' data-toggle='modal' data-target='#exampleModals$i'>&nbsp; <i class='lnr lnr-sync'></i>&nbsp;&nbsp;</button></td>
	
				<td class='hidden-print' align='right' style='width:20px; padding:0px;'>
            <button type='button' class='btn btn-xs btn-danger hidden-print' style='height:18px; padding:0px; margin:0px;' title='Click to cancel this record' data-placement='top' data-toggle='modal' data-target='#exampleModal$i'>&nbsp;&nbsp;<i class='lnr lnr-trash'></i>&nbsp;&nbsp;</button></td></tr>");
		$i++;						$tamo+=$lim;				$tpay+=$all;
						}
								$tamo=number_format($tamo);								$tpay=number_format($tpay);					
						?>
						
                    </tbody>
		<tr><th class='hidden-xs'> </th><th colspan='3'> Total Amount </th>
			<th colspan='2' class='text-right' style='padding-right:20px;'>
			<?php echo $tamo ?></th>	<th colspan='2' class='text-right' style='padding-right:20px;'>
			<?php echo $tpay ?></th><th> </th><th colspan='3' class='text-center'> -- </th></tr></table> 
								</div></div>
								<span class="pull-right hidden-print">
			 <a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'>
			 <i class="lnr lnr-printer"></i></a></span><br><br><br>  

			<?php
				}
				else{
						echo"<div class='row'>
            <div class='col-lg-12' style='margin-top:-20px;'>
             <span> &nbsp;&nbsp; Total Records Found : <b> 0 </b></span>
            <div class='widget-container fluid-height clearfix'>
            <div class='widget-content padded clearfix'>
			<br><br><br><br><br><br>
	<div style='text-align:center; font-size:24px; color:#ff9999'>Report not available on selected date </div><br><br><br><br><br><br>";
					}
			
					?>
                                      
                
              </div>
            </div></div>
                  </div>
   <?php
   include'footer.php';
   ?>