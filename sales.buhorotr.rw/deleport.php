<?php
if(basename($_SERVER['PHP_SELF']) == 'deleport.php') 
  $cm=" class='current'";
include'header.php';
include'connection.php';
$dato=$datos=$Date;
$conde=$custo='';

if(isset($_POST['search']))
		{
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$custo=$_POST['custo'];
		}

if(isset($_POST['restore']))
		{
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$custo=$_POST['custo'];
			$vous=$_POST['vous'];
			$deso=$_POST['deso'];
$theno=mysql_query("UPDATE `requis` SET `Status`='0' WHERE `Voucher`='$vous' AND `Destin`='$deso'");
		}
		
	if($custo=='')
		$conde="";
	else
		$conde="AND `Destin`='$custo'";

		if($dato==$datos)
			$mpri="ON $dato";
		else
			$mpri="FROM $dato TO $datos";

$doi=mysql_query("SELECT *FROM `requis` WHERE `Date` BETWEEN '$dato' AND '$datos' AND `Status`='1' AND `Action`='INTERNAL' AND `Voucher`!='0' $conde GROUP BY `Voucher`,`Destin` ORDER BY `Voucher` ASC");
$fo=mysql_num_rows($doi);
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

	 <li class="list-group-item">
	  <a href="damrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Damage Report
                </p>
              </a></li>     

	 <li class="list-group-item active">
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
         
           <div class="col-lg-4"> </div>
          
         
           

        <form action="" method="post" class="form-horizontal ">                  
                       <div class="col-lg-8 hidden-print"><div class="col-lg-3"> 
					   
			   <select class="form-control" name="custo">
 <?php
				echo"<option value='' selected='selected'> SELECT DESTINATION </option>";
				  $top=mysql_query("SELECT `Destin` FROM `requis` WHERE `Status`='1' AND `Action`='INTERNAL' GROUP BY `Destin` ORDER BY `Destin` ASC");
						while($rop=mysql_fetch_assoc($top)){
							$sup=$rop['Destin'];
			echo"<option value='$sup'> $sup </option>";
						}
						?>
			   </select>
					   
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

			<div class="divFooter"><center><u><b>RECEIVING REPORT <?php echo $mpri ?></b></u></center></div>
             <div class="row">
            <div class="col-lg-12">
             <span>Total Records Found : <b><?php echo" $fo " ?></b></span>
			 <span class="pull-right hidden-print"><b>MAIN STORE</b>
			 &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer hidden-print"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">
               
			    <?php
$gto=0;
			   while($roi=mysql_fetch_assoc($doi)){
				$vous=$roi['Voucher'];
				$deso=$roi['Destin'];
	$do=mysql_query("SELECT *FROM `requis` WHERE `Voucher` = '$vous' AND `Destin`='$deso' AND `Status`='1' AND `Action`='INTERNAL' AND `Voucher`!='0'");
				?>
                                 <table class="table table-striped table-hover">     
                                      <thead>
                     <tr role="row">
                     <th class="hidden-xs"> No </th> 
                       <th> Due&nbsp;Date </th>
                       <th> Item&nbsp;Name </th>
                        <th> Description </th>
                       <th> Supplier </th>
						 <th> Price/Unit </th>
						 <th colspan='2'> Quantity </th>
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
			$use=$ro['User'];

			if($type=='PRODUCTION A' OR $type=='PRODUCTION B'){
			$pri=$ro['Price'];				
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

	$tot=$qt*$pri;

         $toto=number_format($tot, 2);					
									$qty=number_format($qt, 2);
		print("<tr>
          <td class='hidden-xs' style='$stn'><div align='center'>$n&nbsp;&nbsp;</td>
			<td style='$stn'> $dte </td><td style='$stn'> $iname </td><td style='$stn'> $descri </td>
                <td style='$stn'> $type </td><td style='$stn'><div align='right'> $prio &nbsp;&nbsp; </td>
				<td style='$stn'><div align='right'> $qty </td><td> $unit </td><td style='$stn'><div align='right'> $toto </td></tr>");
						  $n++;					$tp+=$tot;
						}
						$tpo=number_format($tp, 2);			
						?>
						
                     </tbody><thead>
					<?php echo"<tr title='Done by: $use' data-toggle='tooltip' data-placement='top'>"; ?>
					<form action='' method='post'><th class='hidden-xs'>
					<?php
						 echo"<input type='hidden' name='vous' value='$vous'><input type='hidden' name='deso' value='$deso'>
<input type='hidden' name='dato' value='$dato'><input type='hidden' name='datos' value='$datos'><input type='hidden' name='custo' value='$custo'>";
						?>
                          <button type="submit" class="btn btn-xs btn-success hidden-print" name="restore" style="height:18px; padding:0px; margin:0px;" title="Click to restore this requisition" data-toggle="tooltip" data-placement="top">
						  &nbsp;&nbsp;<i class='lnr lnr-upload'></i>&nbsp;&nbsp;</button>
					 </th></form>

					 <form action='receive.php' method='post'><th>
					<?php
echo"$vous";
						 if($_SESSION['Edit']){
			 $dbutn='submit';
			 $disa='Click to edit this receiving';
		 }
		 else{
			 $dbutn='button';
			 $disa='You are not allowed to edit';
		 }
			
						 echo"<input type='hidden' name='vous' value='$vous'>&nbsp;&nbsp;</button>";
				
					?>
					 </th></form>
					<th colspan='5'><div align='right'> Total Amount </th>
					<th> </th><th><div align='right'><?php echo $tpo ?></th></tr>
                  </table> <br><br>
				  <?php
$gto+=$tp;
			   }
$gto=number_format($gto, 2);
if($fo>='2'){
					 ?> 
<table class="table table-striped table-hover">     
                                      <thead>
                     <tr role="row">
                     <th class="hidden-xs" width='5%'> </th> 
<th><div align='right'> Grand Total </th>
					<th width='5%'> </th><th width='10%'><div align='right'><?php echo $gto ?>&nbsp;</th>
</tr></table> 
<?php
}
?>                
                
              </div>
            </div></div>
                  </div> <span class="pull-right hidden-print">
			 &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
      
   </div></div></div>
 
   <?php
   include'footer.php';
   ?>
