<?php
if(basename($_SERVER['PHP_SELF']) == 'damrepo.php') 
  $cm=" class='current'";
include'header.php';
include'connection.php';
$dato=$datos=$Date;
$custo='';

if(isset($_POST['search']))
		{
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$custo=$_POST['custo'];
		}
		
		if($custo){
			$conde="AND `Otype`='$custo'";
			$cs=$custo;
		}
		else{
			$conde="";
			$cs="DAMAGED/EXPIRIES";
			$d=$e='';
		}

		if($custo=='DAMAGED')
			$d='selected';

		if($custo=='EXPIRED')
			$e='selected';

		if($dato==$datos)
			$mpri="ON $dato";
		else
			$mpri="FROM $dato TO $datos";

$do=mysql_query("SELECT *FROM `stouse` WHERE `Date` BETWEEN '$dato' AND '$datos' AND `Status`='0' AND `Action`='TAKEN' AND `Voucher`!='0' AND `Destin`='DAMAGED/EXPIRIES' $conde ORDER BY `Number` ASC");
$fo=mysql_num_rows($do);
?>
<div class="container-fluid main-content">
        <div class="page-title hidden-print">
          <h2 style='margin-top:-20px; margin-bottom: 5px;'>
         Control Report
          </h2>
                 </div>
     
        <div class="row">
  <div class="col-lg-2 hidden-print">
   
   <ul class="list-group">

    <li class="list-group-item">
	  <a href="#">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Control Report
                </p>
              </a></li>  

	 <li class="list-group-item active">
	  <a href="damrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Damage Report
                </p>
              </a></li>    

	 <li class="list-group-item">
	  <a href="deleport.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Deleted Report
                </p>
              </a></li>   

	 <li class="list-group-item">
	  <a href="logrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Logging Report
                </p>
              </a></li> 
                         
            </ul>
  </div>
                    
           
           
       
        <div class="col-lg-10">
                  <div class="row">
         
           <div class="col-lg-3"> </div>
          
         
           

        <form action="" method="post" class="form-horizontal ">                  
                       <div class="col-lg-9 hidden-print"><div class="col-lg-3"> 
					   
			   <select class="form-control" name="custo">
	<option value='' selected='selected'> SELECT TYPE </option>
	<option value='DAMAGED' <?php echo $d ?>> DAMAGED </option>
	<option value='EXPIRED' <?php echo $e ?>> EXPIRED </option></select>
					   
					</div> 
					
					
            <div class="col-lg-3"> 
           <div class="input-group date datepicker">
      <input class="form-control form-center" id="from" name="dato" type="text" value="<?php echo $dato ?>" onkeypress='return isNumberKey(event)' required>
	  <span class="input-group-addon"><i class="lnr lnr-calendar-full"></i></span>
			</div></div>


		  <div class="col-lg-3"> 
           <div class="input-group date datepicker">	
      <input class="form-control form-center" id="to" name="datos" type="text" value="<?php echo $datos ?>" onkeypress='return isNumberKey(event)' required>
	  <span class="input-group-addon"><i class="lnr lnr-calendar-full"></i></span>
              </div></div> 
                       
                       <div class="col-lg-2">
                        <button class="btn  btn-primary btn-block" type="submit" name="search"><i class="lnr lnr-magnifier"></i> Search</button>
                   
					  </div>
                         </div>                 
                     
                  
            </form> 
             
               
            </div>

			<div class="divFooter"><center><u><b>DAMAGE REPORT <?php echo $mpri ?></b></u></center></div>
             <div class="row">
            <div class="col-lg-12">
             <span>Total Records Found : <b><?php echo" $fo " ?></b></span>
			 <span class="pull-right"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;MAIN STORE</b>
			 &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span><span class="pull-right"><b>&nbsp;&nbsp;&nbsp; 
			 &nbsp;&nbsp;&nbsp;<?php echo $cs ?></b></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">
               
                                 <table class="table table-striped table-hover">     
                                      <thead>
                     <tr role="row">
                     <th class="hidden-xs"> No </th> 
                       <th> Due&nbsp;Date </th>
                       <th> Done&nbsp;By </th>
                       <th> Purpose </th>
                       <th> Item&nbsp;Name </th>
                        <th> Description </th>
						 <th> Price/Unit </th>
						 <th> Quantity </th>
                       <th><div align='right'> Total&nbsp;Amount&nbsp;</th>
                     </tr>
                    </thead>
                                        <tbody>
					<?php
					$n=1;				$tp=0;	
						while($ro=mysql_fetch_assoc($do)){
				$code=$ro['Number'];
				$item=$ro['Item'];			
			$cost=$ro['Cost'];			$costo=number_format($cost, 2);
			$qt=$ro['Quantity'];
			$dte=$ro['Date'];
			$type=$ro['Destin'];
			$pers=$ro['Comment'];
			$user=$ro['User'];

			if($type=='PRODUCTION A' OR $type=='PRODUCTION B'){
			$pri=$ro['Cost'];				
			$prio=number_format($pri, 2);
			}
			else{
			$pri=$ro['Price'];				
			$prio=number_format($pri, 2);
			}

	$dov=mysql_query("SELECT *FROM `items` WHERE `Number`='$item' ORDER BY `Number` DESC LIMIT 1");
		$rov=mysql_fetch_assoc($dov);
			$kin=$rov['Type'];
			$descri=$rov['Descri'];
			$uno=$rov['Unit'];
			$iname=$rov['Iname'];

$stn="padding:1px;";				

				$dox=mysql_query("SELECT *FROM `unit` WHERE `Number`='$uno' ORDER BY `Number` ASC");
					$rox=mysql_fetch_assoc($dox);
							$unit=$rox['Unit'];

	$tot=$qt*$pri;$files = glob('path/to/temp/*'); // get all file names
foreach($files as $file){ // iterate files
  if(is_file($file))
    unlink($file); // delete file
}

         $toto=number_format($tot, 2);					
									$qty=number_format($qt, 2);
		print("<tr>
          <td class='hidden-xs' style='$stn'><div align='center'>$n&nbsp;&nbsp;</td>
			<td style='$stn'> $dte </td><td style='$stn'> $user </td> <td style='$stn'> $pers </td>
			<td style='$stn'> $iname </td><td style='$stn'> $descri </td>
               <td style='$stn'><div align='right'> $prio &nbsp;&nbsp; </td>
				<td style='$stn'> $qty&nbsp;&nbsp;$unit </td><td style='$stn'><div align='right'> $toto&nbsp;&nbsp;</td></tr>");
						  $n++;					$tp+=$tot;
						}
						$tpo=number_format($tp, 2);			
						?>
						
                     </tbody><thead>
					<tr><th class='hidden-xs'> </th>
					<th colspan='6'><div align='center'> Total Amount </th>
					<th> </th><th><div align='right'><?php echo $tpo ?></th></tr>
                  </table>
              </div>
            </div></div>
                  </div>                    
                <span class="pull-right">
			 &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
      
   </div></div></div> 
    
   <?php
$files = glob('uploads/*'); // get all file names
foreach($files as $file){ // iterate files
  if(is_file($file))
    unlink($file); // delete file
}
   include'footer.php';
   ?>
