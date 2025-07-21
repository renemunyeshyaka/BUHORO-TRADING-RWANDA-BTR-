<?php
if(basename($_SERVER['PHP_SELF']) == 'cloan.php') 
  $pr=" class='current'";
include'header.php';
$dato=$datos=$Date;

// search request by date
if(isset($_POST['search']))
		{
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
		}


// create smart cards
if(isset($_POST['create']))
		{
			$name=str_replace("'", "`", $_POST['name']);
			$amo=str_replace(',', '', $_POST['amo']); 
			$rate=str_replace(',', '', $_POST['rate']);  
			$pay=str_replace(',', '', $_POST['pay']); 

	$so=mysqli_query($conn, "INSERT INTO `loans` (`Date`, `User`, `Name`, `Amount`, `Payment`, `Percent`, `Status`) VALUES ('$Date', '$loge', '$name', '$amo', '$pay', '$rate', '0')");
		}

	// delete a given record
if(isset($_POST['delo']))
		{
			$naso=$_POST['naso'];
	$so=mysqli_query($conn, "UPDATE `loans` SET `Status`='1' WHERE `Number`='$naso'");
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

	   <li class="list-group-item active">
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
		 // ******************************* Create new card modal *****************************

		echo"<div class='modal fade' id='model'>
		<div class='modal-dialog' role='document'>
		<div class='modal-content'><div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLabel'> CREATE NEW LOAN </h5>

      </div><form action='' method='post'>
      <div class='modal-body' style='height:auto;'>

       <div class='col-xs-12 text-primary'> Loan Details </div>
			<div class='col-xs-4 text-right' style='padding-top:10px;'> Loan Name </div>
			<div class='col-xs-8'><input name='name' class='form-control' type='text' required></div>
			
			<div class='col-xs-4 text-right' style='padding-top:10px;'> Limit Amount </div>
			<div class='col-xs-8'><div class='input-group' style='width:100%'>
			<input name='amo' class='form-control text-right' type='text' onkeyup='format(this);' onkeypress='return isNumberKey(event)' required>
			<span class='input-group-addon' style='width:20%; text-align:left; color:#0000cc'><b> Rwf </b></span>
			</div></div>

			<div class='col-xs-4 text-right' style='padding-top:10px;'> Interest &nbsp;Rate </div>
			<div class='col-xs-8'><div class='input-group' style='width:100%'>
			<input name='rate' class='form-control text-center' type='text' onkeypress='return isNumberKey(event)' required>
			<span class='input-group-addon' style='width:20%; text-align:left; color:#009900'><b> % </b></span>
			</div></div>			

			<div class='col-xs-4 text-right' style='padding-top:10px;'> Monthly Payment </div>
			<div class='col-xs-8'><div class='input-group' style='width:100%'>
			<input name='pay' class='form-control text-center' type='text' onkeyup='format(this);' onkeypress='return isNumberKey(event)' required>
			<span class='input-group-addon' style='width:20%; text-align:left; color:#009900'><b> Rwf </b></span>
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
		   <button type="button" class="btn btn-block btn-success hidden-print" title="Create New Contribution" data-placement="top" data-toggle="modal" data-target="#model"> CREATE&nbsp;NEW </button></div>
          
        <div class="col-lg-1 hidden-xs"> </div><form action="" method="post" class="form-horizontal ">                  
                       <div class="col-lg-8 hidden-print"><div class="col-lg-4"> 					
					 
					   </div>
             <div class="col-lg-3"> 
           <div class="input-group date datepicker">
      <input class="form-control form-center" name="dato" type="text" value="<?php echo $dato ?>" onkeypress='return isNumberKey(event)' required>
	  <span class="input-group-addon"><i class="lnr lnr-calendar-full"></i></span>
			</div></div>


		  <div class="col-lg-3"> 
           <div class="input-group date datepicker">	
      <input class="form-control form-center" name="datos" type="text" value="<?php echo $datos ?>" onkeypress='return isNumberKey(event)' required>
	  <span class="input-group-addon"><i class="lnr lnr-calendar-full"></i></span>
              </div></div>                     
                       
                       <div class="col-lg-2"><?php echo"<input type='hidden' name='pg' value='$pg'>"; ?>
                        <button class="btn  btn-primary btn-block" type="button" name="search"><i class="lnr lnr-magnifier"></i> Search</button>
                   
					  </div>
                         </div></form>               
            </div>
               <?php
		$dok=mysqli_query($conn, "SELECT *FROM `loans` WHERE `Status`='0' ORDER BY `Number` DESC");
				if($fo=mysqli_num_rows($dok)){
				?>
                 
            <div class="divFooter"><center><u><b>LOAN CONFIGURATION REPORT <?php echo $mpri ?></b></u></center></div>
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
					 <th style='padding:1px;'>&nbsp;&nbsp;&nbsp;User </th>
					 <th style='padding:1px;'><div align='center'> Loan&nbsp;Name </th>
					 <th style='padding:1px;'><div align='center'> Limit&nbsp;Amount </th>
					 <th style='padding:1px;'><div align='center'> Interest&nbsp;Rate </th>
					 <th style='padding:1px;'><div align='center'> Monthly&nbsp;Payment </th>
		<th class="hidden-print" colspan='2' style='padding:1px;'><div align='center'>&nbsp;Options&nbsp;</th>
                     </tr>
                    </thead>
                                        <tbody>
					<?php
								$i=1;		$qt=0;
						while($rok=mysqli_fetch_assoc($dok)){
			$dte=$rok['Date'];
			$name=$rok['Name'];
			$user=$rok['User'];
			$lim=$rok['Amount'];
			$rate=$rok['Percent'];
			$pay=$rok['Payment'];
			$nuo=$rok['Number'];

			$stl="padding:1px;";					$limo=number_format($lim);					$payo=number_format($pay);

				print("<tr><td class='hidden-xs' style='$stl $clr'><div align='right'>$i&nbsp;</td>
						<td style='$stl $clr'><div align='center'> $dte </td><td class='hidden-xs' style='$stl $clr'> $user </td>
						<td style='$stl $clr'> $name </td><td style='$stl $clr'><div align='center'> $limo </td>
						<td style='$stl $clr'><div align='center'> $rate % </td><td style='$stl $clr'><div align='center'> $payo </td>");



						

// ************************************* Open modal ******************************************
		echo"<div class='modal fade' id='exampleModal$i'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLabel'>DELETE CONFIRMATION 
		<label style='float:right; text-align:right;'><b>$name </b></label></h5>

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






	print("<td class='hidden-print' align='right' style='width:20px; padding:0px;'>
            <input type='hidden' name='naso' value='$code'><input type='hidden' name='dato' value='$dato'>
			<input type='hidden' name='datos' value='$datos'><input type='hidden' name='custo' value='$custo'>
            <button type='button' class='btn btn-xs btn-warning hidden-print' style='height:18px; padding:0px; margin:0px;'>&nbsp;
			<i class='lnr lnr-pencil'></i>&nbsp;&nbsp;</button></td>
	
				<td class='hidden-print' align='right' style='width:20px; padding:0px;'>
            <button type='button' class='btn btn-xs btn-danger hidden-print' style='height:18px; padding:0px; margin:0px;' title='Click to cancel this record' data-placement='top' data-toggle='modal' data-target='#exampleModal$i'>&nbsp;&nbsp;<i class='lnr lnr-trash'></i>&nbsp;&nbsp;</button></td></tr>");
				$i++;						$qt+=$qty;
						}
																$qt=number_format($qt);					
						?>
						
                    </tbody></table> 
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