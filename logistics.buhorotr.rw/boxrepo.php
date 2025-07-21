<?php
if(basename($_SERVER['PHP_SELF']) == 'boxrepo.php') 
  $nv=" class='current'";
include'header.php';
include'connection.php';
$dato=$datos=$Date;
$cust=$conde='';
$deso=$condi='';
$i=0;


	$dos=mysqli_query($conn, "SELECT `Date` FROM `stouse` WHERE (`Status`='0' AND `Action`='CASHBOX') OR (`Status`='0' AND `Action`='PAYOUT') ORDER BY `Date` DESC LIMIT 10");
				while($ros=mysqli_fetch_assoc($dos)){
					$dato=$ros['Date'];
				}

// search for cashbox report
if(isset($_POST['search']))
		{
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$cust=$_POST['cust'];
			$deso=$_POST['deso'];
			$i=1;
		}

// delete a given record from cashbox report
if(isset($_POST['delo']))
		{
			$cust=$_POST['cust'];
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$dest=$_POST['dest'];
			$deso=$_POST['deso'];
			$nuo=$_POST['nuo'];
			$i=$_POST['i'];

	$andi=mysqli_query($conn, "DELETE FROM `stouse` WHERE `Number`='$nuo' AND `Action`='$dest' ORDER BY `Number` ASC LIMIT 1");
				}

if($dato==$datos)
			$mpri="ON $dato";
		else
			$mpri="FROM $dato TO $datos";

if($cust)
	$conde="AND `Action`='$cust'";
else
	$conde='';
	
if($deso)
	$condi="AND `Tclass`='$deso'";
else
	$condi='';
		?>

<div class="container-fluid main-content">
        <div class="page-title hidden-print">
          <h3 style='margin-top:-20px; margin-bottom: 5px; color:#ffcc33'>
       CashBox
          </h3>
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

	 <li class="list-group-item">
	  <a href="madd.php">
                <p>
                <i class="lnr lnr-circle-minus"></i>&nbsp;Make a Payout
                </p>
              </a></li>
              <?php
			  }
			  ?>
      
    <li class="list-group-item active">
	  <a href="boxrepo.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;CashBox Report
                </p>
              </a></li>  
              
            </ul>
  </div>
                    
           
           
       
        <div class="col-lg-10">
                  <div class="row">
        <form action="" method="post" class="form-horizontal ">
         
           <div class="col-lg-2 hidden-print"> </div>
           
           <div class="col-lg-2 hidden-print"> <select class="form-control" name="deso"><option value=''> SELECT TYPE </option>			
			 <?php
	$doi=mysqli_query($conn, "SELECT `Tclass` FROM `stouse` WHERE `Action`='PAYOUT' AND `Tclass`!='' GROUP BY `Tclass` ORDER BY `Tclass` ASC LIMIT 10");
		while($roi=mysqli_fetch_assoc($doi)){
				$fna=$roi['Tclass'];
			if($deso==$fna)
				$sc="selected";
			else
				$sc="";
	echo"<option value='$fna' $sc> $fna </option>";
			}
			?>			    
            </select> </div>
           <div class="col-lg-8 hidden-print">
           <div class="col-lg-3 hidden-print"> 
		   
		   <select class="form-control" name="cust"><option value=''> SELECT OPTION </option>			
			 <?php
	$doi=mysqli_query($conn, "SELECT `Action` FROM `stouse` WHERE `Action`='CASHBOX' OR `Action`='PAYOUT' GROUP BY `Action` ORDER BY `Action` ASC LIMIT 10");
		while($roi=mysqli_fetch_assoc($doi)){
				$fna=$roi['Action'];
			if($cust==$fna)
				$sa="selected";
			else
				$sa="";
	echo"<option value='$fna' $sa> $fna </option>";
			}
			?>			    
            </select> </div>
          
         
                            
                      
            <div class="col-lg-3 hidden-print"> 
           <div class="input-group date" data-provide="datepicker">
      <input class="form-control form-center" id="from" name="dato" type="text" value="<?php echo $dato ?>" onkeypress='return isNumberKey(event)' required>
	  <span class="input-group-addon"><i class="lnr lnr-calendar-full"></i></span>
			</div></div>


		  <div class="col-lg-3 hidden-print"> 
           <div class="input-group date" data-provide="datepicker">	
      <input class="form-control form-center" id="to" name="datos" type="text" value="<?php echo $datos ?>" onkeypress='return isNumberKey(event)' required>
	  <span class="input-group-addon"><i class="lnr lnr-calendar-full"></i></span>
              </div></div>                      
                       
                       <div class="col-lg-2 hidden-print">
		<button class="btn  btn-primary btn-block" type="submit" name="search" data-toggle='tooltip' data-placement='top'>
			 <i class="lnr lnr-magnifier"></i> Search </button>
                   
					  
                         </div>  <div class="col-lg-1 hidden-print"> 					
					   <input type="hidden" name="custo">
			
					   </div>
                      
                   </div>  
                  
            </form> 
             
               
            </div>
               <?php
		$do=mysqli_query($conn, "SELECT *FROM `stouse` WHERE (`Date` BETWEEN '$dato' AND '$datos' AND `Status`='0' AND `Action`='CASHBOX' $conde $condi) OR (`Date` BETWEEN '$dato' AND '$datos' AND `Status`='0' AND `Action`='PAYOUT' $conde $condi) GROUP BY `Number` ORDER BY `Date` ASC, `Number` ASC LIMIT 4000");
				if($fo=mysqli_num_rows($do)){
				   ?>
            <div class="divFooter"><center><u><b>CASHBOX REPORT <?php echo $mpri ?></b></u></center></div>     
             <div class="row">
            <div class="col-lg-12">
             <span class="hidden-print"> &nbsp;&nbsp; Total Records Found : <b><?php echo" $fo " ?></b></span> 
			 <span class="pull-right hidden-print"> &nbsp;&nbsp; &nbsp;&nbsp; <?php echo $cust ?> &nbsp;&nbsp; &nbsp;&nbsp; <?php echo $deso ?> &nbsp;&nbsp; &nbsp;&nbsp;
	<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">

								 <form action="" method="post" class="form-horizontal "> 
				<table class="table table-striped table-hover" style="padding:1px;">     
                             <thead><tr role="row">
                     <th class="hidden-xs"> No </th> 
        <th width='8%' class='text-center'> Date </th>
            <th> User </th><th> Type </th><th> Purpose </th>
            <th> Paid&nbsp;To/From </th>
        <th> Description </th><th><div align='center'> Cash&nbsp;In </th>
                <th><div align='center'> Cash&nbsp;Out </th>
                <th><div align='center'> Balance </th>
    <th class="hidden-xs hidden-print" style="width:20px; text-align:center;" colspan='2'> Options </th>
                     </tr>
                    </thead>
                                        <tbody>
					<?php
	$doi=mysqli_query($conn, "SELECT SUM(`Price`) AS 'CA' FROM `stouse` WHERE (`Date`<'$dato' AND `Status`='0' AND `Action`='CASHBOX' $conde) OR (`Date`<'$dato' AND `Status`='0' AND `Action`='PAYOUT' $conde) ORDER BY `Date` ASC");
								 $roi=mysqli_fetch_assoc($doi);
									$ba=$roi['CA'];

					$n=1;				$tp=0;				$tin=$tout=$tba=0;
			while($ro=mysqli_fetch_assoc($do)){
				$nuo=$ro['Number'];
				$vou=$ro['Voucher'];
				$dte=$ro['Date'];
				$tme=$ro['Time'];
				$cashier=$ro['User'];
				$client=$ro['Item'];
				$dest=$ro['Action'];
				$descri=$ro['Destin'];
				$payto=$ro['Invoice'];
				$ca=$ro['Price'];							$in=$out=0;
				$tc=$ro['Tclass'];

				if($dest=='CASHBOX'){
					$in=$ca;
					$stn="padding:1px; color:blue; font-size:12px;";
					$client="RECEIVE";
				}
				elseif($dest=='PAYOUT'){
					$out=$ca;
					$stn="padding:1px; font-size:12px;";
			$doi=mysqli_query($conn, "SELECT `Type` FROM `dtype` WHERE `Number`='$client' ORDER BY `Type` ASC");
			$roi=mysqli_fetch_assoc($doi);
				$client=$roi['Type'];
				}

					$ba+=$ca;
				$cao=number_format($ca, 2);
				$ino=number_format($in, 2);
				$outo=number_format($out, 2);
				if($conde OR $condi)
				$bao="****";
				else
				$bao=number_format($ba, 2);

        print("<tr><td class=hidden-xs style='$stn'><div align='center'>$n&nbsp;&nbsp;</td><td style='$stn'> $dte </td>
		<td style='$stn'> $cashier </td><td style='$stn'> $tc </td>
		<td style='$stn'> $client </td><td style='$stn'> $payto </td><td style='text-align:left; $stn'> $descri </td><td style='$stn'><div align='right'> $ino </td><td style='$stn'><div align='right'> $outo </td><td style='$stn'><div align='right'> $bao </td><td class='hidden-xs hidden-print' align='right' style='width:20px; padding:0px;'>");

// ************************************* Delete modal ******************************************
		echo"<div class='modal fade' id='ModalDele$n' tabindex='-1' role='dialog' 
		aria-labelledby='exampleModalLabel' aria-hidden='true' style='top:220px;'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content text-left'><div class='modal-header text-left'>
        <h5 class='modal-title' id='exampleModalLabel'>DELETE CONFIRMATION 
&nbsp;&nbsp;&nbsp;&nbsp;<label class='pull-right'><b>$cao</b></label></h5>

      </div><form action='' method='post'>
      <div class='modal-body' style='height:80px;'>
        <h5>Are sure you want to delete this record? &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		[ RWF <b>$cao</b> &nbsp;/&nbsp; $dest]</h5><br></div><form method='post' action=''>
	<input type='hidden' name='i' value='$i'><input type='hidden' name='nuo' value='$nuo'>
	<input type='hidden' name='dato' value='$dato'><input type='hidden' name='datos' value='$datos'>
	<input type='hidden' name='dest' value='$dest'><input type='hidden' name='cust' value='$cust'><input type='hidden' name='deso' value='$deso'>
      <div class='modal-header text-right' style='margin-top:-10px; height:50px; padding-top:10px; border:0px solid blue;'>
        <button type='button' class='btn btn-sm btn-success' data-dismiss='modal'>&nbsp;&nbsp;NO&nbsp;</button>
        <button type='submit' name='delo' class='btn btn-sm btn-danger'>YES</button>
      </div></form>
    </div>
  </div>
</div>";
			
if($_SESSION['Cancel'] OR $_SESSION['Eccr']){
$tags="#ModalDele$n";
$disa="";
}
else{
    $tags="#";
    $disa="disabled";
}

       print("<button type='button' class='btn btn-xs btn-warning hidden-print' name='edit' style='height:18px; padding:0px; margin:0px;'  title='Edit' data-toggle='tooltip' data-placement='top' disabled> &nbsp;&nbsp;<i class='lnr lnr-pencil'></i>&nbsp;&nbsp;</button></td>
						  
		<td class='hidden-xs hidden-print' align='right' style='width:20px; padding:0px;' title='Delete' data-toggle='tooltip' data-placement='top'>
				<input type='hidden' name='i' value='$i'><input type='hidden' name='nuo' value='$nuo'>
					<input type='hidden' name='dato' value='$dato'> <input type='hidden' name='datos' value='$datos'>
						<input type='hidden' name='dest' value='$dest'><input type='hidden' name='custo' value='$custo'>
       <button type='button' class='btn btn-xs btn-danger hidden-print' style='height:18px; padding:0px; margin:0px;' data-toggle='modal' data-target='$tags' $disa> &nbsp;&nbsp;<i class='lnr lnr-trash'></i>&nbsp;&nbsp;</button></td></tr>");
						  $n++;							$tin+=$in;					$tout+=$out;					
						}
						$tino=number_format($tin, 2);	
						$touto=number_format($tout, 2);
						if($conde OR $condi)
				            $tbao="****";
				        else
				            $tbao=number_format($ba, 2);
						?>
						
                     </tbody>

					 <thead>
					<tr><th class="hidden-xs"> </th><th colspan='6'><div align='center'> Total Amount </th>
					<th><div align='right'><?php echo $tino ?></th>
					<th><div align='right'><?php echo $touto ?></th>
					<th><div align='right'><?php echo $tbao ?></th>
					<th colspan='2' class="hidden-xs hidden-print"><div align='center'> -- </th></tr>
                  </table><br>

				  
				  <?php
				}
				 else{
						echo"<div class='row'>
            <div class='col-lg-12' style='margin-top:-20px;'>
             <span> &nbsp;&nbsp; Total Records Found : <b> 0 </b></span>
			 <span class='pull-right hidden-print'> $bra &nbsp;&nbsp;<a href='#' onclick='return window.print()' class='hidden-print' title='Click to print' data-toggle='tooltip' data-placement='top'><i class='lnr lnr-printer'></i></a></span>
            <div class='widget-container fluid-height clearfix'>
            <div class='widget-content padded clearfix'>
			<br><br><br><br><br><br>
						<div style='text-align:center; font-size:24px; color:#ff3333'> Report not available on selected date </div><br><br><br><br><br><br><br>";
					}  

?>       
              </div>
            </div></div>
                  </div>                  
                <span class="pull-right hidden-print">
			 &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title="Click to print" data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
      
   </div></div></div>  
   <?php
   include'footer.php';
   ?>