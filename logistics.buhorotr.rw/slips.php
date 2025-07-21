<?php
if(basename($_SERVER['PHP_SELF']) == 'slips.php') 
  $pr=" class='current'";
include'header.php';
include'connection.php';
$dato=$datos=$Date;

$cond='LIMIT 12';
$conde='';
$perpagevalue=12;
$ope=0;

if(isset($_POST['perpage']))
		{
			$perpagevalue=$_POST['perpagevalue'];
			$cond="LIMIT $perpagevalue";
		}

		// *************************** Open a given payroll *************************************
if(isset($_POST['open_id']))
		{
			$mt=$_POST['mt'];
			$yr=$_POST['yr'];			
			$sd=$_POST['std'];			
			$ed=$_POST['end'];
			$ope=1;
		}
		
		// ****************************** Delete a given payroll *******************************
if(isset($_POST['delete_id']))
		{
			$mt=$_POST['mt'];
			$yr=$_POST['yr'];			
			$sd=$_POST['std'];			
			$ed=$_POST['end'];
			$perpagevalue=$_POST['perpagevalue'];
			$cond="LIMIT $perpagevalue";

	$sso=mysqli_query($conn, "SELECT *FROM `payrolls` WHERE `Month`='$mt' AND `Year`='$yr' AND `Advance`>'0'");
			while($sro=mysqli_fetch_assoc($sso)){
				$eidi=$sro['Employee'];
				$advas=$sro['Advance'];

				$my="$mt $yr";
$dots=mysqli_query($conn, "UPDATE `advance` SET `Balance`=`Balance`+'$advas', `Month`='' WHERE `Date` <= '$ed' AND `Employee`='$eidi' AND `Status`='0' AND `Month`='$my' ORDER BY `Number` DESC LIMIT 1000");
			}

		$do=mysqli_query($conn, "DELETE FROM `payrolls` WHERE `Month`='$mt' AND `Year`='$yr'");	
		}

		// **************************** Create fixed payroll *********************************
if(isset($_POST['submit_pay']))
		{
			$dato=$_POST['dato'];
			$user=$_POST['user'];
			$month=$_POST['month'];
			$year=$_POST['year']; 
			$mti = date("m", strtotime($month, '01'));
			$std="$year-$mti-01";
			$days = date('t', strtotime($month) );
			$end="$year-$mti-$days";
	
	$dot=mysqli_query($conn, "SELECT *FROM `payrolls` WHERE `Month`='$month' AND `Year`='$year'");
		if($fot=mysqli_num_rows($dot)){
			$pto=20;
		}
		else{
$do=mysqli_query($conn, "SELECT *FROM `employees` WHERE `Eid`!='1001' AND `Status`='0' AND `Salary`>'0' ORDER BY `Fname` ASC");
		$fo=mysqli_num_rows($do);
		while($ro=mysqli_fetch_assoc($do)){
			$eid=$ro['Eid'];
			$sala=$ro['Salary'];
			$curp=$ro['Currentp'];
			$bank=$ro['Bank'];
			$acco=$ro['Account'];
			$depat=$ro['Depart'];
			$brce=$ro['Branch'];

			// **************************** Balance from last month **************************************
	$dote=mysqli_query($conn, "SELECT `Closing` FROM `payrolls` WHERE `Ending`<='$std' AND `Year`<='$year' AND `Employee`='$eid' AND `Closing`>'0' ORDER BY `Number` DESC LIMIT 1");
		if($fote=mysqli_num_rows($dote)){
			$rote=mysqli_fetch_assoc($dote);
				$bal=$rote['Closing'];
		}
		else
			$bal=0;

// **************************** Load allowances in current month **************************************
$dota=mysqli_query($conn, "SELECT SUM(`Amount`) AS 'Allo' FROM `allows` WHERE `Date` BETWEEN '$std' AND '$end' AND `Employee`='$eid' AND `Status`='0' ORDER BY `Number` DESC LIMIT 1000");
		if($fota=mysqli_num_rows($dota)){
			$rota=mysqli_fetch_assoc($dota);
				$allo=$rota['Allo'];
		}
		else
			$allo=0;

// **************************** Load deductions in current month **************************************
$doti=mysqli_query($conn, "SELECT SUM(`Amount`) AS 'Dedo' FROM `deduct` WHERE `Date` BETWEEN '$std' AND '$end' AND `Employee`='$eid' AND `Status`='0' ORDER BY `Number` DESC LIMIT 1000");
		if($foti=mysqli_num_rows($doti)){
			$roti=mysqli_fetch_assoc($doti);
				$dedu=$roti['Dedo'];
		}
		else
			$dedu=0;

// **************************** Load advance to be paid in current month **************************************
$doto=mysqli_query($conn, "SELECT SUM(`Amount`) AS 'Amo', SUM(`Payment`) AS 'Adva' FROM `advance` WHERE `Date` BETWEEN '$std' AND '$end' AND `Employee`='$eid' AND `Status`='0' ORDER BY `Number` DESC LIMIT 1000");
		if($foto=mysqli_num_rows($doto)){
			$roto=mysqli_fetch_assoc($doto);
				$adva=$roto['Adva'];
				$amo=$roto['Amo'];
		}
		else
			$adva=$amo=0;

$so=mysqli_query($conn, "INSERT INTO `payrolls` (`Date`, `User`, `Employee`, `Month`, `Year`, `Salary`, `Currentp`, `Bank`, `Account`, `Tadvance`, `Advance`, `Balance`, `Allowance`, `Deduction`, `Payment`, `Starting`, `Ending`, `Depart`, `Branch`) VALUES ('$dato', '$user', '$eid', '$month', '$year', '$sala', '$curp', '$bank', '$acco', '$amo', '$adva', '$bal', '$allo', '$dedu', '0', '$std', '$end', '$depat', '$brce')");

	$my="$month $year";
$dots=mysqli_query($conn, "UPDATE `advance` SET `Month`='$my', `Balance`=`Balance`-'$adva' WHERE `Date` <= '$end' AND `Employee`='$eid' AND `Status`='0' AND `Balance`>'0' AND `Month`!='$my' ORDER BY `Number` DESC LIMIT 1000");

		}
$pto=10;
			$dato=$Date;
			$month='';
			$year=date("Y");
		}	
		}
		

		


	if($ope=='1')
$do=mysql_query("SELECT *FROM `payrolls` WHERE `Month`='$mt' AND `Year`='$yr' GROUP BY `Starting`, `Ending` ORDER BY `Number` ASC");
	else
$do=mysql_query("SELECT *FROM `payrolls` GROUP BY `Starting`, `Ending` ORDER BY `Date` DESC $cond");
$fo=mysql_num_rows($do);
?>

<script type="text/javascript">
$(document).ready(function()
{	
	$(document).on('submit', '#registration_Form', function()
	{		
		var data = $(this).serialize();
		$.ajax({
		type : 'POST',
		url  : 'send_data.php',
		data : data,
		success :  function(data)
				   {						
						$("#registration_Form").fadeOut(500).hide(function()
						{
							$(".result_1").fadeIn(500).show(function()
							{
								$(".result_1").html(data);
							});
						});
				   }
		});
		return false;
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
</script>
<div class="container-fluid main-content">
<div class="page-title">
 
 <h1 style='margin-top:-20px; margin-bottom: 5px;'>Payrolls</h1>

</div>
<div class="row"></div>
 <div class="row">

        <div class="col-md-12">
         <div class="row">
             <div class="col-lg-4 hidden-print"> 
           <form action="" method="POST" class="form-horizontal ">
        <input name="searchkeyword" value="" type="hidden">
        <input name="column_name" value="" type="hidden">
     
            <div class="col-lg-6 hidden-print"> 
           <select name="perpagevalue" class="form-control">
                              <option selected="selected" value="20">20 per page</option>
                              <option value="50">50 per page</option>
                              <option value="100">100 per page</option>
                              <option value="200">200 per page</option>
                              <option value="1000">1000 per page</option>
                            
               </select>
          
         </div>    
        
                    <div class="col-lg-4 hidden-print"> 
      
                 <button class="btn  btn-primary  btn-block" type="submit" name="perpage"><i class="lnr lnr-chevron-right-circle"></i>Show</button>
          </div> 
    
        </form>
           
           
              </div>


		    <div class="col-md-8 hidden-print" style="text-align:right;">

		<div class="col-md-8 hidden-print">
    
	     <?php 
if($pto==10)
echo"<center><div class='alert alert-success' style='text-align:center; float:center; border-radius:5px; padding:6px;'>
<i class='lnr lnr-checkmark-circle'></i> &nbsp;&nbsp; New Payrool Has Been Created.
<button class='close' data-dismiss='alert' type='button'>&times</button></div></center>";

if($pto==20)
echo"<center><div class='alert alert-danger' style='text-align:center; float:center; border-radius:5px; padding:6px;'>
		<i class='lnr lnr-checkmark-sad'></i> &nbsp;&nbsp; Payroll for $month $year is alread saved in your database.
		<button class='close' data-dismiss='alert' type='button' style='margin:0px;'>&times</button></div></center>";
		?>
          
                    </div><div class="col-md-1 "></div><div class="col-md-3 "> 
                 <button class="btn  btn-primary  btn-block btn-success" type="submit" name="create" style="width:120px;"
				  onclick="window.location.href='pays.php'">CREATE NEW</button>
          </div> 

		 
            <div class="col-md-1 hidden-print"> 
        
           
         </div></form></div>
         
         <!--  Mark Attendance -->
<!-- mark attendance end  -->
         
        
          
         
          </div>
		  
          <div class="row">
            <div class="col-md-12">
     
              <span>Total Records Found : <b><?php echo $fo ?></b></span>
			  <span class="pull-right"><a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">
			<?php
			if($ope=='1'){
	$do=mysql_query("SELECT *FROM `payrolls` WHERE `Month`='$mt' AND `Year`='$yr' ORDER BY `Currentp` ASC");

?>
     <table class="table table-striped table-hover">
                       
                                      <thead>
                    <tr role="row">
                      <th> No</th> 					  
                       <th align='center'> Full Name </th>			  
                       <th> Position </th><th> Month </th>
                       <th> Year </th><th> Credit </th>
                       <th> Salary </th><th> Counted </th>
                       <th class='text-center'> Advance </th> 
                       <th class="text-center"> Allow. </th> 	 							  
                       <th class="text-center"> Deduct </th>
                       <th class="text-center"> Payment </th> 	
                       <th class="text-center"> Net&nbsp;Pay </th>
                       <th> Balance </th> 	
                       <th class="text-center hidden-print"> #&nbsp; </th>
                     </tr>
                    </thead>
                                        <tbody>
<?php
$n=1;

	while($ro=mysql_fetch_assoc($do)){
$numb=$ro['Number'];
$mt=$ro['Month'];
$user=$ro['User'];
$yr=$ro['Year'];
$dati=$ro['Date'];
$st=$ro['Status'];
$sal=$ro['Salary'];
$empo=$ro['Employee'];
$currentp=$ro['Currentp'];
$allow=$ro['Allowance'];
$duct=$ro['Deduction'];
$adva=$ro['Advance'];
$bala=$ro['Balance'];
$pay=$ro['Payment'];
$count=$ro['Counted'];
$tadva=$ro['Tadvance'];
$my="$mt $yr";

$doe=mysql_query("SELECT *FROM `employees` WHERE `Eid`='$empo' ORDER BY `Fname` ASC");
		$foe=mysql_num_rows($doe);
		while($roe=mysql_fetch_assoc($doe)){
			$fna=$roe['Fname'];
			$lna=$roe['Lname'];
		}

$dei=mysql_query("SELECT *FROM `position` WHERE `Postid`='$currentp' ORDER BY `Postname` ASC");
			 if($fei=mysql_num_rows($dei)){
				 $rei=mysql_fetch_assoc($dei);
					$post=$rei['Postname'];
			 }
			 else
				 $post="N/A";

		/*
			 if($sal>100000)
				 $tpr=((100000-30000)*(20/100))+(($sal-100000)*(30/100));
			 else
				 $tpr=($sal-30000)*(20/100);
		*/
	
           $salo=number_format($sal);
		   $advao=number_format($adva);
		   $tadvao=number_format($tadva);

$allowo=number_format($allow);
$ducto=number_format($duct);
if($count)
$net=$count+$allow-$adva-$pay;
else
$net=$sal+$allow-$adva-$pay;

$clo=$tadva+$bala+$duct-$pay-$adva;
$neto=number_format($net);
$balao=number_format($bala);
$payo=number_format($pay+$adva);
$counto=number_format($count);
$paso=number_format($pay);
	
	$dots=mysqli_query($conn, "UPDATE `payrolls` SET `Closing`='$clo', `Home`='$net' WHERE `Number` = '$numb'");

			  $tot=$empor;
		   $toto=number_format($tot);
		   $cloo=number_format($clo);							$stn="style='padding:1px;'";
	
		echo"<div class='modal fade' id='exampleModal$n' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'
		style='top:40px; padding:0px; height:360px; float:center;'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLabel'>PAYMENT CONFIGURATION 
<label style='float:right'> $fna $lna </label></h5>

      </div><form method='post' id='registration_Form'>
      <div class='modal-body' style='height:215px;'>
        <div class='col-md-12'>


			<div class='col-md-6'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Basic Salary <br>
              <input name='sala' id='sala' class='form-control text-center' type='text' value='$salo' onkeypress='return isNumberKey(event)' onkeyup='format(this);' required>
            </div> 


			<div class='col-md-6'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Counted Salary <br>
              <input name='coun' id='coun' class='form-control text-center' type='text' value='$counto' onkeypress='return isNumberKey(event)' onkeyup='format(this);' required>
            </div> 


		
		 <div class='col-md-12'>


			<div class='col-md-6'><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Advance Paid <br>
              <input name='ada' id='ada' class='form-control text-center' type='text' value='$advao' onkeypress='return isNumberKey(event)' onkeyup='format(this);' required>
            </div> 


			<div class='col-md-6'><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Other Payment <br>
              <input name='pda' id='pda' class='form-control text-center' type='text' value='$paso' onkeypress='return isNumberKey(event)' onkeyup='format(this);' required>
            </div> 



		</div>
      </div><br><br><br><br><input type='hidden' name='numb' id='numb' value='$numb'><input value='$adva' name='pad' id='pad' type='hidden'>
	  <input value='$empo' name='eid' id='eid' type='hidden'><input value='$my' name='mt' id='mt' type='hidden'>
      <div class='modal-footer' style='margin-top:10px; height:30px; padding-top:5px; border:0px solid blue;'>
	    <hr style='border:1px solid #ffffff; margin:10px 0px 20px 0px; padding:0px;'>
        <button type='button' class='btn btn-sm btn-warning' data-dismiss='modal' style='width:120px;'>&nbsp;CLOSE&nbsp;</button>
        <button type='submit' id='submit' class='btn btn-sm btn-success' onclick=this.style.display='none' style='width:120px;'>SAVE</button>
      </div></form>
    </div>
  </div>
</div>";



				print("<tr onclick=this.style.color='#0066ff'>
						<td $stn class='text-right'>$n &nbsp;</td><td $stn>$fna $lna</td><td $stn> $post </td>
                        <td $stn> $mt </td><td $stn> $yr </td><td $stn class='text-right'>$balao</td>
						<td $stn class='text-right'>$salo</td>
						<td $stn class='text-right'>$counto</td><td $stn class='text-right'> $tadvao </td>
						<td $stn class='text-right'> $allowo </td><td $stn class='text-right'> $ducto </td>
						<td $stn class='text-right'> $payo </td><td $stn class='text-right'> $neto </td>
						<td $stn class='text-right'> $cloo&nbsp;&nbsp;</td>
						
						<td class='hidden-print' align='right' style='width:20px; padding:0px;'>
					<button type='button' class='btn btn-xs btn-success hidden-print' style='height:20px; padding:0px; margin-top:2px; margin-botton:2px; width:25px;' data-placement='top' data-toggle='modal' data-target='#exampleModal$n' $disa>
						 <i class='lnr lnr-pencil'></i></button></td></tr>");
	$n++;
	$isal+=$sal;
	$iadv+=$tadva;

	$inet+=$net;
	$iall+=$allow;
	$ided+=$duct;
	$ibal+=$bala;
	$ipay+=($pay+$adva);
	$iclo+=$clo;
	$icou+=$count;

		   $itot+=$tot;
	}

			$isalo=number_format($isal);
		   $iadvo=number_format($iadv);
		   $iallo=number_format($iall);
		   $idedo=number_format($ided);
		   $ineto=number_format($inet);
		   
		   $itoto=number_format($itot);
		   $ibalo=number_format($ibal);
		   $ipayo=number_format($ipay);
		   $iclo=number_format($iclo);
		   $icouo=number_format($icou);
		   $stn="style='padding-right:1px;'";

	print("<tr><th> </th> 
	<th colspan='4' style='align:center; padding-left:80px;'> Total Amount </th>
	<th class='text-right' $stn> $ibalo </th><th class='text-right' $stn> $isalo </th><th class='text-right' $stn> $icouo </th>
	<th class='text-right' $stn> $iadvo </th><th class='text-right' $stn> $iallo </th>
	<th class='text-right' $stn> $idedo </th><th class='text-right' $stn> $ipayo </th>
	<th class='text-right' $stn> $ineto </th><th class='text-right' $stn> $iclo&nbsp;&nbsp;</th>
	<th class='text-left hidden-print'> -- </th></tr></tr>");
	?>              
                    </tbody>   
                  </table>

			<?php

			  }
			  else{
				  ?>
                
                                 <table class="table table-striped table-hover">
                       
                                      <thead>
                    <tr role="row">
                      <th> No </th> 					  
                       <th align='center'> Due&nbsp;Date </th> 							  
                       <th> Done&nbsp;By </th> 					  
                       <th> Type </th><th> Month </th>
                       <th> Year </th>
                       <th> Employees </th> 
                       <th class="text-center"> Amount </th>
                       <th class="text-center"> Allowance </th>
                       <th class="text-center"> Advance </th>
                       <th class="text-center"> Deduction </th>
                       <th class="text-center"> Payment </th>
					   <th class="hidden-xs hidden-print" style="width: 40px;text-align:center;"> Status </th>
                        <th class="hidden-xs hidden-print" style="text-align:center;" colspan='2'>Actions</th>
                     </tr>
                    </thead>
                                        <tbody>
<?php
$n=1;
	while($ro=mysql_fetch_assoc($do)){
$numb=$ro['Number'];
$mt=$ro['Month'];
$user=$ro['User'];
$yr=$ro['Year'];
$dati=$ro['Date'];
$st=$ro['Status'];
$lv=$ro['Level'];
$std=$ro['Starting'];
$end=$ro['Ending'];
$stn="style='padding:1px;'";
	if($ro['Conte'])
		$lbt="<span class='label label-success' style='width:80px; height:20px; margin:0px; padding:3px 0px 0px 0px;'>TAKEN</span>";
	else
		$lbt="<span class='label label-warning' style='width:80px; height:20px; margin:0px; padding:3px 0px 0px 0px'>PENDING</span>";

	$lvo="PAYROLL";

	if($st){
		$act="<td class='text-center hidden-xs hidden-print' $stn><center> -- </td>";
		$acti="<td class='text-right hidden-xs hidden-print' style='width:20px; padding:1px;'>
      <button type='submit' name='open_id' class='btn btn-xs btn-warning hidden-print text-center' name='edit_id' style='height:20px; padding:0px; margin-top:2px; margin-botton:2px; width:25px; text-align:center; padding-right:5px;' title='Open' data-toggle='tooltip' data-placement='top'>
						  &nbsp;&nbsp;<i class='lnr lnr-download'></i></button></td>";
	}
	else{
		$act="<td class='text-right hidden-xs hidden-print' style='width:20px; padding:1px;'>
     <button class='btn btn-xs btn-danger hidden-print' style='height:20px; padding:0px; margin-top:2px; margin-botton:2px; width:25px;' type='button'  data-toggle='modal' data-target='#exampleModal$n'><i class='lnr lnr-trash'></i></button></td>";

		$acti="<td class='text-right hidden-xs hidden-print' style='width:20px; padding:1px;'>
   <button type='submit' name='open_id' class='btn btn-xs btn-info hidden-print text-center' name='edit_id' style='height:20px; padding:0px; margin-top:2px; margin-botton:2px; width:25px; text-align:center; padding-right:5px;' title='Open' data-toggle='tooltip' data-placement='top'>
						  &nbsp;&nbsp;<i class='lnr lnr-download'></i></button></td>";
	}
	
		$amo=$adva=$ded=$allo=0;
$dot=mysql_query("SELECT *FROM `payrolls` WHERE `Month`='$mt' AND `Year`='$yr'");
		if($fot=mysql_num_rows($dot)){
			while($rot=mysql_fetch_assoc($dot)){
					$amo+=$rot['Salary'];
					$adva+=$rot['Tadvance'];
					$dedu+=$rot['Deduction'];
					$allo+=$rot['Allowance'];
					$pay+=($rot['Payment']+$rot['Advance']);
			}
		}	

	echo"<div class='modal fade' id='exampleModal$n' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true' 
		style='top:220px;'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLabel'>DELETE CONFIRMATION 
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> $mt $yr </b></h5>

      </div>
      <div class='modal-body' style='height:40px;'>
        <h5 style='color:#ff0033'>Are you sure you want to delete this payroll?</h5>
      </div><form method='post' action=''>
						<input type='hidden' value='$numb' name='numb'>
						<input type='hidden' value='$mt' name='mt'>
						<input type='hidden' value='$yr' name='yr'>
						<input type='hidden' value='$std' name='std'>
						<input type='hidden' value='$end' name='end'>
						<input type='hidden' value='$perpagevalue' name='perpagevalue'>
						<input type='hidden' value='$lv' name='lv'>
      <div class='modal-footer' style='margin-top:-10px; height:50px; padding-top:5px; border:0px solid blue;'>
        <button type='button' class='btn btn-sm btn-success' data-dismiss='modal'>&nbsp;NO&nbsp;</button>
        <button type='submit' name='delete_id' class='btn btn-sm btn-danger' $disa>YES</button>
      </div></form>
    </div>
  </div>
</div>";


 $amoo=number_format($amo);			$alloo=number_format($allo);			$advao=number_format($adva);				$deduo=number_format($dedu);
                $payo=number_format($pay);
		print("<tr><form action='slips.php' method='post'>
                        <td $stn class='text-right'>$n &nbsp;
						<input type='hidden' value='$numb' name='numb'>
						<input type='hidden' value='$mt' name='mt'>
						<input type='hidden' value='$yr' name='yr'>
						<input type='hidden' value='$std' name='std'>
						<input type='hidden' value='$end' name='end'>
						<input type='hidden' value='$perpagevalue' name='perpagevalue'>
						<input type='hidden' value='$lv' name='lv'></td>
                        <td $stn class='text-center'>$dati</td>
                        <td $stn>$user</td>
                        <td $stn> $lvo </td> <td $stn> $mt </td><td $stn> $yr </td>
                        <td $stn class='text-center'> $fot </td>
                        <td align='right' style='padding:1px; padding-right:10px;'> $amoo </td>
                        <td align='right' style='padding:1px; padding-right:10px;'> $alloo </td>
                        <td align='right' style='padding:1px; padding-right:10px;'> $advao </td>
                        <td align='right' style='padding:1px; padding-right:10px;'> $deduo </td>
                        <td align='right' style='padding:1px; padding-right:10px;'> $payo&nbsp;&nbsp;</td>
                        <td align='right' style='padding:1px; padding-right:10px;' class='hidden-xs hidden-print'> $lbt </td>
                            $acti   $act         	
                        </form></tr>");
	$n++;                   $allo=$deduo=$advao=$amoo=$payo=0;
	$allo=$amo=$adva=$pay=$dedu=0;
	}
	?>
              
                    </tbody>   
                  </table>
				  <?php
			  }
					?>
                                      <div class="row">
                  <div class="col-md-12 hidden-print">
                  <div class="pull-right">
                  <ul class="pagination">
                      <li>
                                 <a class="icon" href="#">
           <i class="lnr lnr-chevron-left"></i></a>
                                            </li>
                      <li class="active">
                        <a href="#">
                        1                       </a>
                      </li>

                                            <li>
                                              <a class="icon" href="#">
                        <i class="lnr lnr-chevron-right"></i></a>
                                           </li>
                    </ul>
              </div></div></div>
                                
              </div>
            </div>
        </div>
</div></div></div></div>
<?php
include'footer.php';
?>