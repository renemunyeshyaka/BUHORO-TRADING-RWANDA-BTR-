<?php
if(basename($_SERVER['PHP_SELF']) == 'outrepo.php') 
  $cm=" class='current'";
include'header.php';
include'connection.php';
$dato=$datos=$Date;
$conde=$custo=$geto='';

if(isset($_POST['search']))
		{
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$custo=$_POST['custo'];
			$geto=$_POST['geto'];
		}
		
	if($custo=='')
		$conde="";
	elseif($custo=='SALES')
		$conde="AND `Action`!='TAKEN'";
	else
		$conde="AND `Destin`='$custo'";

		if($dato==$datos)
			$mpri="ON $dato";
		else
			$mpri="FROM $dato TO $datos";

		if($geto=='GROUPED'){
			$g='selected';
$do=mysql_query("SELECT *, SUM(Quantity) AS 'Quantity' FROM `stouse` WHERE (`Date` BETWEEN '$dato' AND '$datos' AND `Status`='0' AND `Action`='TAKEN' AND `Voucher`!='0' AND `Destin`!='DAMAGED/EXPIRIES' $conde) OR (`Date` BETWEEN '$dato' AND '$datos' AND `Status`='0' AND `Action`='SALES' AND `Voucher`!='0' AND `Destin`!='DAMAGED/EXPIRIES' AND `Invoice`='MAIN STORE' $conde) GROUP BY `Item` ORDER BY `Date` DESC");
		}
		else{
			$g='';
$do=mysql_query("SELECT *FROM `stouse` WHERE (`Date` BETWEEN '$dato' AND '$datos' AND `Status`='0' AND `Action`='TAKEN' AND `Voucher`!='0' AND `Destin`!='DAMAGED/EXPIRIES' $conde) OR (`Date` BETWEEN '$dato' AND '$datos' AND `Status`='0' AND `Action`='SALES' AND `Voucher`!='0' AND `Destin`!='DAMAGED/EXPIRIES' AND `Invoice`='MAIN STORE' $conde) ORDER BY `Number` ASC");
		}
$fo=mysql_num_rows($do);
?>
<div class="container-fluid main-content">
        <div class="page-title hidden-print">
           <h2 style='margin-top:-20px; margin-bottom: 5px; color:#ffcc33'>
         Store Report
          </h2>
                 </div>
     
        <div class="row">
  <div class="col-lg-2 hidden-print">
   
   <ul class="list-group">

    <li class="list-group-item">
	  <a href="storeport.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Store Report
                </p>
              </a></li>  

	 <li class="list-group-item">
	  <a href="inrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;S.In Report
                </p>
              </a></li>  
      
    <li class="list-group-item active">
	  <a href="outrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;S.Out Report
                </p>
              </a></li>  

	<li class="list-group-item">
      <a href="transrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Transfer Report
                </p>
              </a></li>

			   <li class="list-group-item">
              <a href="delirepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Delivery Report
                </p>
              </a></li> 
			  
			   <li class="list-group-item">
              <a href="recerepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Receiving Report
                </p>
              </a></li>

			  <li class="list-group-item">
              <a href="purrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Purchase Report
                </p>
              </a></li>   

	 <li class="list-group-item">
	  <a href="dispatch.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Count Report
                </p>
              </a></li>     

	 <li class="list-group-item">
	  <a href="stobal.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Item Report
                </p>
              </a></li>  
                         
            </ul>
  </div>
                    
           
           
       
        <div class="col-lg-10">
                  <div class="row">
         
           <div class="col-lg-2"> </div>
          
         
           

        <form action="" method="post" class="form-horizontal ">                  
                       <div class="col-lg-10 hidden-print"><div class="col-lg-2"> 
			 <select class="form-control" name="geto">
			   <option value='' selected>ALL ITEMS</option>
			   <option value='GROUPED' <?php echo $g ?>>GROUPED</option></select>
			   </div>
						<div class="col-lg-3"> 
			   <select class="form-control" name="custo">
			<?php
				echo"<option value='' selected='selected'> SELECT DESTINATION </option>
				<option value='DAMAGED/EXPIRIES'> DAMAGED/EXPIRIES </option><option value='SALES'> SALES </option>";
			
	$doi=mysql_query("SELECT `Name` FROM `branches` ORDER BY `Number` ASC");
			while($roi=mysql_fetch_assoc($doi)){
				$fna=$roi['Name'];
			echo"<option value='$fna'> $fna </option>";
			}
			?>		</select>
					   
					   </div>
            <div class="col-lg-2"> 
           <div class="input-group date datepicker">
      <input class="form-control form-center" id="from" name="dato" type="text" value="<?php echo $dato ?>" onkeypress='return isNumberKey(event)' style="padding-left:2px; padding-right:2px;" required>
	  <span class="input-group-addon"><i class="lnr lnr-calendar-full"></i></span>
			</div></div>


		  <div class="col-lg-2"> 
           <div class="input-group date datepicker">	
      <input class="form-control form-center" id="to" name="datos" type="text" value="<?php echo $datos ?>" onkeypress='return isNumberKey(event)' style="padding-left:2px; padding-right:2px;" required>
	  <span class="input-group-addon"><i class="lnr lnr-calendar-full"></i></span>
              </div></div> 
          
		  
                      
                       
                       <div class="col-lg-2">
                        <button class="btn  btn-primary btn-block" type="submit" name="search"><i class="lnr lnr-magnifier"></i> Search</button>
                   
					  </div>
                         </div> 
                      
                     
                  
            </form> 
             
               
            </div>

			<div class="divFooter"><center><u><b>STOCK OUT REPORT <?php echo $mpri ?></b></u></center></div>
             <div class="row">
            <div class="col-lg-12">
             <span>Total Records Found : <b><?php echo" $fo " ?></b></span>
			 <span class="pull-right"><b>MAIN STORE</b>
			 &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Print' data-toggle='tooltip' data-placement='top'>
			 <i class="lnr lnr-printer"></i></a></span><span class="pull-right"><b><?php echo $custo ?></b>&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">
               
             <div class='table-responsive'><table class="table table-striped table-hover">     
                  <thead>
                     <tr role="row">
                     <th class="hidden-xs"> No </th> 
                       <th> Due&nbsp;Date </th>
                       <th> Destination </th>
                        <th> Brand&nbsp;Name </th>
                       <th> Item&nbsp;Name </th>
                       <th> Taken&nbsp;by </th>
						 <th> Price/Unit </th>
						 <th colspan='2' class='text-center'> Quantity </th>
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
			$pers=$ro['Person'];
			$pri=$ro['Price'];				
			$prio=number_format($pri, 2);
			
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
					
	$don=mysql_query("SELECT *FROM `itype` WHERE `Number`='$kin' ORDER BY `Number` ASC");
		$ron=mysql_fetch_assoc($don);
				$tyso=$ron['Type'];

	$tot=$qt*$pri;

         $toto=number_format($tot, 2);					
									$qty=number_format($qt, 2);
$typo=$type;
		print("<tr>
          <td class='hidden-xs' style='$stn'><div align='center'>$n&nbsp;&nbsp;</td>
			<td style='$stn'> $dte </td><td style='$stn'> $typo </td>
			<td style='$stn'> $tyso </td><td style='$stn'> $iname </td>
                <td style='$stn'> $pers </td><td style='$stn'><div align='right'> $prio &nbsp;&nbsp; </td>
				<td class='text-right' style='$stn'> $qty&nbsp;</td><td style='$stn'>&nbsp;$unit </td>
				<td style='$stn'><div align='right'> $toto&nbsp;&nbsp;</td></tr>");
						  $n++;					$tp+=$tot;
						}
						$tpo=number_format($tp, 2);			
						?>
						
                     </tbody><thead>
					<tr><th class='hidden-xs'> </th>
					<th colspan='7'><div align='center'> Total Amount </th>
					<th> </th><th><div align='right'><?php echo $tpo ?></th></tr>
                  </table></br></div>

              </div>
            </div></div>
                  </div>                    
                <span class="pull-right">
			 &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
      
   </div></div></div> 
    
   <?php
   include'footer.php';
   ?>
