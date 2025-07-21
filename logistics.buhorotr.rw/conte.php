<?php
if(basename($_SERVER['PHP_SELF']) == 'conte.php') 
  $pr=" class='current'";
include'header.php';
include'connection.php';
$dato=$datos=$Date;
$ope=0;

$cond='LIMIT 12';
$conde='';
$perpagevalue=12;

if(isset($_POST['save']))
		{
			$dato=$_POST['dato'];
			$month=$_POST['month'];
			$year=$_POST['year'];
			$sta=$_POST['sta'];
			$end=$_POST['end'];		
	$see=mysqli_query($conn, "SELECT `Number` FROM `contribute` WHERE `Month`='$month' AND `Year`='$year'");
	if(!$fee=mysqli_num_rows($see)){
	$sso=mysqli_query($conn, "SELECT `Number`,`Employee`,`Salary` FROM `payrolls` WHERE `Status`='0' AND `Month`='$month' AND `Year`='$year' AND `Starting`='$sta' AND `Ending`='$end' AND `Conte`='0'");
			while($rso=mysqli_fetch_assoc($sso)){
				$empo=$rso['Employee'];
				$sal=$rso['Salary'];
				$num=$rso['Number'];

	$so=mysqli_query($conn, "INSERT INTO `contribute` (`Date`, `User`, `Month`, `Year`, `Employee`, `Salary`, `Percent`, `Company`, `Status`, `Starting`, `Ending`) VALUES ('$dato', '$loge', '$month', '$year', '$empo', '$sal', '$parti', '$reco', '0', '$sta', '$end');");

	$then=mysqli_query($conn, "UPDATE `payrolls` SET `Conte`='1' WHERE `Number`='$num' ORDER BY	`Number` ASC LIMIT 1");
			}
	}
		}
if(isset($_POST['perpage']))
		{
			$perpagevalue=$_POST['perpagevalue'];
			$cond="LIMIT $perpagevalue";
		}
if(isset($_POST['search']))
		{
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$conde="AND `Date` BETWEEN '$dato' AND '$datos'";
			$cond="";
		}

 if(isset($_POST['delete_id']))
		{
			$mt=$_POST['mt'];
			$yr=$_POST['yr'];			
			$sd=$_POST['std'];			
			$ed=$_POST['end'];
			$perpagevalue=$_POST['perpagevalue'];
			$cond="LIMIT $perpagevalue";
	$do=mysqli_query($conn, "DELETE FROM `contribute` WHERE `Month`='$mt' AND `Year`='$yr'");
	$then=mysqli_query($conn, "UPDATE `payrolls` SET `Conte`='0' WHERE `Month`='$mt' AND `Year`='$yr' ORDER BY `Number` ASC LIMIT 1000");	
		}

	if(isset($_POST['open_id']))
		{
			$mt=$_POST['mt'];
			$yr=$_POST['yr'];			
			$sd=$_POST['std'];			
			$ed=$_POST['end'];
			$ope=1;
		}

if($ope)
$do=mysqli_query($conn, "SELECT *FROM `contribute` WHERE `Status`='0' AND `Month`='$mt' AND `Year`='$yr' AND `Starting`='$sd' AND `Ending`='$ed' ORDER BY `Number` ASC");
else
$do=mysqli_query($conn, "SELECT *, SUM(`Salary`) AS 'Salo', COUNT(DISTINCT(Employee)) AS `Empo` FROM `contribute` WHERE `Status`='0' $conde GROUP BY `Starting`, `Ending` ORDER BY `Date` DESC $cond");
$fo=mysqli_num_rows($do);
?>


<script type="text/javascript">
$(document).ready(function()
{	
	$(document).on('submit', '#registration_Form', function()
	{		
		var data = $(this).serialize();
		$.ajax({
		type : 'POST',
		url  : 'send_datas.php',
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
          <h1 style='margin-top:-20px; margin-bottom: 5px;'>
         Contribute
          </h1>
                 </div>
     
        <div class="row">
  <div class="col-lg-2">
   
   <ul class="list-group">
      
    <li class="list-group-item active">
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

	   <li class="list-group-item">
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
		 // ******************************* CREATE NEW CONTRIBUTION *****************************

		echo"<div class='modal fade' id='model'>
		<div class='modal-dialog' role='document'>
		<div class='modal-content'><div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLabel'> CREATE NEW CONTRIBUTION </h5>

      </div><form action='' method='post'>
      <div class='modal-body' style='height:210px;'>";
	  
	$sdo=mysqli_query($conn, "SELECT `Month`, `Year`, `Starting`, `Ending` FROM `payrolls` WHERE `Status`='0' AND `Conte`='0' ORDER BY `Number` DESC LIMIT 1");
		$sro=mysqli_fetch_assoc($sdo);
			$mon=$sro['Month'];
			$yea=$sro['Year'];
			$sta=$sro['Starting'];
			$end=$sro['Ending'];

	echo"<input value='$dato' name='dato' type='hidden'><input value='$dato' name='dato' type='hidden'>
	<input value='$sta' name='sta' type='hidden'><input value='$end' name='end' type='hidden'>";
	  ?>

       
            <div class="col-md-4" style="height:34px; padding:8px;">Due Date</div>
         <div class="col-md-4"><div class="input-group date datepicker">
      <input class="form-control form-center" name="dato" type="text" value="<?php echo $dato ?>" onkeypress='return isNumberKey(event)' required>
	  <span class="input-group-addon"><i class="lnr lnr-calendar-full"></i></span>
              </div></div><div class="col-md-4" style="height:34px;"> &nbsp; </div>
	
	<div class="form-group">
       <div class="col-md-4" style="height:34px; padding:8px;">Done by</div>
       <div class="col-md-8" style="height:34px;">
   <input name="user" class="form-control" type="text" value="<?php echo $loge ?>" readonly="readonly" required>
     </div>
 </div>


 <div class="form-group">
 <div class="col-xs-4" style="height:34px; padding:8px;">Month / Year</div>
            <div class="col-xs-4">
 <select class="form-control" name="month" required>
	<?php
    echo "<option value='$mon'> $mon </option>";
	?>
              </select>  
	 </div>
            <div class="col-xs-4">
	<select class="form-control" name="year" required>
	<?php
    echo "<option value='$yea'> $yea </option>"; 
	?>
              </select> 
	</div></div>


 <div class="form-group">
  <div class="col-xs-3"> </div>
    <div class="col-xs-3" style="height:34px; padding:8px;"><br>Document File</div>
                     <div class="col-xs-6"><br>
              <div class="fileupload fileupload-new" data-provides="fileupload"><input value="" name="" type="hidden">
                <span class="btn btn-default btn-file"><span class="fileupload-new">Select</span><span class="fileupload-exists">Change</span><input name="file1" id="app_file" type="file"></span><span class="fileupload-preview"></span><button class="close fileupload-exists" data-dismiss="fileupload" style="float:none" type="button">×</button>
				
				<?php echo $dfile ?>
                     
              </div>     <small>Zip, txt, jpeg, png, pdf, doc (Max : 2M)</small>
            </div></div></div><div class="modal-header" style="height:60px;"> 

	<div class='col-xs-6 text-right pull-right' style='padding-left:1px; padding-right:1px; margin-right:0px;'>
        <button type='button' class='btn btn-sm btn-default' data-dismiss='modal' style='width:80px; padding:5px;'> CLOSE </button>
        <button type='submit' name='save' class='btn btn-sm btn-success' style='width:80px; padding:5px;'>SAVE</button>
      </div></form>
    </div></div></div></div>
	<?php
	// *********************************************** End of modal **************************************
	?>     
           
       
        <div class="col-lg-10">
                  <div class="row">
           <form action="" method="POST" class="form-horizontal ">
        <input name="searchkeyword" value="" type="hidden">
        <input name="column_name" value="" type="hidden">
    
				<div class="col-lg-2" style="padding-left:50px;"> 
			<?php 
		if($sfo=mysqli_num_rows($sdo)){
			?>
           <button class="btn  btn-primary  btn-block btn-success" type="submit" name="create" style="width:120px;"
				  data-placement="top" data-toggle="modal" data-target="#model">CREATE NEW</button>
				  <?php
		}
				  ?>
          
         </div>    
          <div class="col-lg-4"> </div></form> 

        <form action="" method="post" class="form-horizontal ">                  
                       <div class="col-lg-2"> 
           <div class="input-group date datepicker">
      <input class="form-control form-center" id="from" name="dato" type="text" value="<?php echo $dato ?>" onkeypress='return isNumberKey(event)' required>
	  <span class="input-group-addon"><i class="lnr lnr-calendar-full"></i></span>
			</div></div>

		  <div class="col-md-2"> 
           <div class="input-group date datepicker">	
      <input class="form-control form-center" id="to" name="datos" type="text" value="<?php echo $datos ?>" onkeypress='return isNumberKey(event)' required>
	  <span class="input-group-addon"><i class="lnr lnr-calendar-full"></i></span>
              </div></div> 
                      
                       
                       <div class="col-lg-2">
                        <button class="btn  btn-primary" type="submit" name="search"><i class="lnr lnr-magnifier"></i> Search</button>
                      
					  </div>   
                      
                     
                  
            </form> </div>
             
               
            <div class="col-lg-12">
             <span>Total Records Found : <b><?php echo" $fo " ?></b></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">

	
				<?php
			if($ope=='1'){
		?>
     <table class="table table-striped table-hover">
                       
                                      <thead>
                    <tr role="row">
                      <th> No</th> 					  
            <th align='center'> Full Name </th>			  
            <th> Position </th><th> Month / Year 
            <th> Salary </th><th> Count </th> 	
            <th class="text-center"> Amount </th><th> Company </th> 	
            <th class="text-center"> Amount </th>
            <th class="text-center"> Total </th>
        <th class="text-center hidden-print"> #&nbsp; </th>
                     </tr>
                    </thead>
                                        <tbody>
<?php
$n=1;					$tsa=0;						$tco=0;         $tpo=0;
	while($ro=mysqli_fetch_assoc($do)){
$numb=$ro['Number'];
$mt=$ro['Month'];
$user=$ro['User'];
$yr=$ro['Year'];
$dati=$ro['Date'];
$st=$ro['Status'];
$sal=$ro['Salary'];
$empo=$ro['Employee'];
$cont=$ro['Percent'];
$cot=($sal*$cont)/100;
$comp=$ro['Company'];
$cop=($sal*$comp)/100;

$doe=mysql_query("SELECT *FROM `employees` WHERE `Eid`='$empo' ORDER BY `Fname` ASC");
		$foe=mysql_num_rows($doe);
		while($roe=mysql_fetch_assoc($doe)){
			$fna=$roe['Fname'];
			$lna=$roe['Lname'];
			$currentp=$roe['Currentp'];
		}

$dei=mysql_query("SELECT *FROM `position` WHERE `Postid`='$currentp' ORDER BY `Postname` ASC");
			 if($fei=mysql_num_rows($dei)){
				 $rei=mysql_fetch_assoc($dei);
					$post=$rei['Postname'];
			 }
			 else
				 $post="N/A";
	
           $salo=number_format($sal);				
           $coto=number_format($cot);				
           $copo=number_format($cop);				
           $toto=number_format($cop+$cot);				
           $stn="style='padding:1px;'";
	
		echo"<div class='modal fade' id='exampleModal$n' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'
		style='top:40px; padding:0px; height:360px; float:center;'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLabel'>PAYMENT CONFIGURATION 
<label style='float:right;'> $fna $lna </label></h5>

      </div><form method='post' id='registration_Form'>
      <div class='modal-body' style='height:160px;'>
        <div class='col-md-12'>


			<div class='col-md-6'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Basic Salary <br>
              <input name='sala' id='sala' class='form-control text-center' type='text' value='$salo' onkeypress='return isNumberKey(event)' onkeyup='format(this);' readonly>
            </div> 


			<div class='col-md-6'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Percentage (%)<br>
              <input name='coun' id='coun' class='form-control text-center' type='text' value='$cont' onkeypress='return isNumberKey(event)' onkeyup='format(this);' required>
            </div> 


			<br><br><br><br>
      </div><input type='hidden' name='numb' id='numb' value='$numb'>
      <div class='modal-footer' style='margin-top:0px; height:46px; padding-top:5px; border:0px solid blue;'>
	    <hr style='border:1px solid #ffffff; margin:-10px 0px 10px 0px; padding:0px;'>
        <button type='button' class='btn btn-sm btn-warning' data-dismiss='modal' style='width:120px;'>&nbsp;CLOSE&nbsp;</button>
        <button type='submit' id='submit' class='btn btn-sm btn-success' onclick=this.style.display='none' style='width:120px;'>SAVE</button>
      </div></form>
    </div>
  </div>
</div>";



				print("<tr onclick=this.style.color='#0066ff'>
						<td $stn class='text-right'>$n &nbsp;</td><td $stn>$fna $lna</td><td $stn> $post </td>
                        <td $stn class='text-right'> $mt&nbsp;/&nbsp;$yr </td><td $stn class='text-right'>$salo</td>
						<td $stn class='text-right'>$cont %</td><td $stn class='text-right'> $coto </td>
						<td $stn class='text-right'>$comp %</td><td $stn class='text-right'> $copo </td><td $stn class='text-right'> $toto </td>
						
						<td class='hidden-print' align='right' style='width:20px; padding:0px; padding-left:20px;'>
					<button type='button' class='btn btn-xs btn-success hidden-print' style='height:20px; padding:0px; margin-top:2px; margin-botton:2px; width:25px;' data-placement='top' data-toggle='modal' data-target='#exampleModal$n' $disa>
						 <i class='lnr lnr-pencil'></i></button></td></tr>");
	$n++;			$tsa+=$sal;				$tco+=$cot;             $tpo+=$cop;
	}

			$tsao=number_format($tsa);							
			$tto=number_format($tpo+$tco);							
			$tco=number_format($tco);							
			$tpo=number_format($tpo);
		   $stn="style='padding-right:1px;'";

	print("<tr><th> </th> 
	<th colspan='3' style='align:center; padding-left:80px;'> Total Amount </th>
	<th class='text-right' $stn> $tsao </th><th colspan='2'  class='text-right' $stn> $tco </th><th colspan='2'  class='text-right' $stn> $tpo </th>
	<th class='text-right' $stn> $tto </th><th class='text-center hidden-print'> -- </th></tr></tr>");
	?>              
                    </tbody>   
                  </table>

			<?php

			  }
			  else{
				  ?>
               
                                 <table class="table table-striped">     
                                      <thead>
                    <tr role="row">
                      <th> No </th> 					  
                       <th align='center'> Due&nbsp;Date </th> 							  
                       <th> Done&nbsp;By </th> 					  
                       <th> Type </th><th> Month </th>
                       <th> Year </th>
                       <th> Employees </th><th> Count </th> 
                       <th class="text-center"> Amount </th><th> Company </th> 
                       <th class="text-center"> Amount </th><th class="text-center"> Total </th>
                        <th class="hidden-xs hidden-print" style="text-align:center;" colspan='2'>Actions</th>
                     </tr>
                    </thead>
                                        <tbody>
<?php
$n=1;				$tamo=$camo=0;
	while($ro=mysqli_fetch_assoc($do)){
$numb=$ro['Number'];
$mt=$ro['Month'];
$user=$ro['User'];
$yr=$ro['Year'];
$dati=$ro['Date'];
$st=$ro['Status'];
$std=$ro['Starting'];
$end=$ro['Ending'];
$per=$ro['Percent'];
$cop=$ro['Company'];
$sala=$ro['Salo'];
$fot=$ro['Empo'];
$stn="style='padding:1px;'";
	$lvo="CONTRIBUTION";
	
	$amo=$sala*$per/100;            $comp=$sala*$cop/100;

	$then=mysqli_query($conn, "UPDATE `payrolls` SET `Conte`='1' WHERE `Month`='$mt' AND `Year`='$yr' ORDER BY `Number` ASC LIMIT 1000");

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
	

	echo"<div class='modal fade' id='exampleModal$n' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLabel'>DELETE CONFIRMATION 
			<label style='float:right'><b> $mt $yr </b></label></h5>

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
      <div class='modal-footer' style='margin-top:-10px; height:50px; padding-top:5px; border:0px solid blue;'>
        <button type='button' class='btn btn-sm btn-success' data-dismiss='modal'>&nbsp;NO&nbsp;</button>
        <button type='submit' name='delete_id' class='btn btn-sm btn-danger' $disa>YES</button>
      </div></form>
    </div>
  </div>
</div>";


	 $amoo=number_format($amo);	            $compo=number_format($comp);
	 $tot=number_format($amo+$comp);
		print("<tr><form action='' method='post'>
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
                        <td $stn class='text-center'> $fot </td><td $stn class='text-right'> $per % &nbsp;&nbsp;&nbsp;</td>
                        <td align='right' style='padding:1px; padding-right:10px;'> $amoo </td>
                        
                        <td $stn class='text-right'> $cop % &nbsp;&nbsp;&nbsp;</td>
                        <td align='right' style='padding:1px; padding-right:10px;'> $compo </td>
                        <td align='right' style='padding:1px; padding-right:10px;'> $tot </td> $acti   $act         	
                        </form></tr>");
	$n++;             $tamo+=$amo;                  $camo+=$comp;      
	}
	$tamoo=number_format($tamo);            $camoo=number_format($camo);
	
	 $toto=number_format($camo+$tamo);
	?>
						
                    </tbody> 
	<tr><th colspan='2'> </th><th colspan='5'> Total Amount </th>
	<th colspan='2' class='text-right'> <?php echo $tamoo ?></th>
	<th colspan='2' class='text-right'> <?php echo $camoo ?></th>
	<th class='text-right'> <?php echo $toto ?></th>
	<th class='text-center' colspan='2'> -- </th></tr>
                  </table>
                    <div class="row">
                  <div class="col-lg-12">
                  <div class="pull-right">
                  <ul class="pagination">
				   <li>
                                 <a class="icon" href="#">
           <i class="lnr lnr-chevron-left"></i></a>
                                            </li>
                      <li>
                                            </li>
                      <li class="active">
                        <a href="#">
                        1                        </a>
                      </li>
                            <li>
                                              <a class="icon" href="#">
                        <i class="lnr lnr-chevron-right"></i></a>
                                           </li>
                    </ul>
              </div></div></div>                     
              <?php
			  }
					?>
              </div>
            </div></div>
                  </div>
      
 <?php
 include'footer.php';
 ?>