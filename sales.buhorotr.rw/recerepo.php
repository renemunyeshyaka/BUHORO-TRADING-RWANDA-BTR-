<?php
if(basename($_SERVER['PHP_SELF']) == 'recerepo.php') 
  $cm=" class='current'";
include'connection.php';
$dato=$datos=$Date;
$conde=$custo='';
$stor=$condi='';

	if(isset($_POST['reprint']))
		{
			$vous=$_POST['vous'];
	$so=mysql_query("UPDATE `stouse` SET `Printed`='2' WHERE `Voucher`='$vou' AND `Action`='RECEIVE' AND `Printed`='1' ORDER BY `Number` ASC LIMIT 100");
			
	include'recedoc.php';
			$stor=$_POST['duse'];
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$custo=$_POST['custo'];
		}
		
include'header.php';

if(isset($_POST['search']))
		{
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$custo=$_POST['custo'];
			$stor=$_POST['duse'];
		}
		
	if($custo)
		$conde="AND `Destin`='$custo'";


		if($stor)
			$conde="AND `Store`='$stor'";

		if($dato==$datos)
			$mpri="ON $dato";
		else
			$mpri="FROM $dato TO $datos";

$doi=mysql_query("SELECT *FROM `stouse` WHERE `Date` BETWEEN '$dato' AND '$datos' AND `Status`='0' AND `Action`='RECEIVE' AND `Voucher`!='0' $conde $condi GROUP BY `Voucher` ORDER BY `Voucher` ASC");
$fo=mysql_num_rows($doi);
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
      
    <li class="list-group-item">
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

			   <li class="list-group-item active">
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
         <form action="" method="post" class="form-horizontal "> 
           <div class="col-lg-2 hidden-print"> </div><div class="col-lg-4 hidden-print">

           <div class="col-lg-4 hidden-print"><select class='form-control' name='duse' style="padding-left:5px; padding-right:5px;">
				<option value=''> STORE </option>
		<?php
	$dob=mysqli_query($cons, "SELECT *FROM `stores` WHERE `Status`>='0' ORDER BY `Number` ASC");
		while($rob=mysqli_fetch_assoc($dob)){
			$stonum=$rob['Store'];
			$stona=$rob['Name'];
			if($stonum==$stor)
				$s="selected";
			else
				$s="";
	echo"<option value='$stonum' $s> &nbsp;&nbsp; $stona </option>";
		}
				?>
		</select></div><div class="col-lg-8 hidden-print">
           
 <select class="form-control" name="custo">
 <?php
				echo"<option value='' selected='selected'> SELECT SUPPLIER </option>";
				  $top=mysql_query("SELECT `Destin` FROM `stouse` WHERE `Status`='0' AND `Action`='RECEIVE' GROUP BY `Destin` ORDER BY `Destin` ASC");
						while($rop=mysql_fetch_assoc($top)){
							$sup=$rop['Destin'];
			echo"<option value='$sup'> $sup </option>";
						}
						?>
			   </select>
					   
					   </div></div>
                         
                       <div class="col-lg-6 hidden-print"> 
					 
            <div class="col-lg-4"> 
           <div class="input-group date datepicker">
      <input class="form-control form-center" id="from" name="dato" type="text" value="<?php echo $dato ?>" onkeypress='return isNumberKey(event)' required>
	  <span class="input-group-addon"><i class="lnr lnr-calendar-full"></i></span>
			</div></div>


		  <div class="col-lg-4"> 
           <div class="input-group date datepicker">	
      <input class="form-control form-center" id="to" name="datos" type="text" value="<?php echo $datos ?>" onkeypress='return isNumberKey(event)' required>
	  <span class="input-group-addon"><i class="lnr lnr-calendar-full"></i></span>
              </div></div> 
          
		  
                      
                       
                       <div class="col-lg-3">
        <button class="btn  btn-primary btn-block" type="submit" name="search"><i class="lnr lnr-magnifier"></i> Search</button>                   
					  </div>
                         </div> 
                      
                     
                  
            </form> 
             
               
            </div>

			<div class="divFooter"><center><u><b>RECEIVING REPORT <?php echo $mpri ?></b></u></center></div>
             <div class="row">
            <div class="col-lg-12">
             <span>Total Records Found : <b><?php echo" $fo " ?></b></span>
			 <span class="pull-right hidden-print">
			 &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer hidden-print"></i></a></span>
			 
			 <span class="pull-right hidden-print">
		&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" id="exporttable" class="hidden-print" title='Export to excell' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-line-spacing"></i></a></span>
		
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">
                <table width='100%' id="htmltable"><tr><td width='100%'>
               
			    <?php
$gto=0;
			   while($roi=mysql_fetch_assoc($doi)){
				$vous=$roi['Voucher'];
				
	$do=mysql_query("SELECT *FROM `stouse` WHERE `Voucher` = '$vous' AND `Status`='0' AND `Action`='RECEIVE'");
				?>
                                 <table class="table table-striped table-hover">     
                                      <thead>
                     <tr role="row">
                     <th class="hidden-xs"> No </th> 
                       <th> Due&nbsp;Date </th>
                        <th> Brand&nbsp;Name </th>
                       <th> Item&nbsp;Name </th>
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
			$stor=$ro['Store'];
			$comm=$ro['Comment'];
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

         $toto=number_format($tot, 2);												$qty=number_format($qt, 2);
		print("<tr>
          <td class='hidden-xs' style='$stn'><div align='center'>$n&nbsp;&nbsp;</td>
			<td style='$stn'> $dte </td><td style='$stn'> $tyso </td><td style='$stn'> $iname </td>
                <td style='$stn'> $type </td><td style='$stn'><div align='right'> $prio &nbsp;&nbsp; </td>
				<td style='$stn'><div align='right'> $qty </td><td style='$stn'> $unit </td>
<td style='$stn'><div align='right'> $toto </td></tr>");
						  $n++;					$tp+=$tot;
						}
						$tpo=number_format($tp, 2);			
						?>
						
                     </tbody><thead>
					<?php echo"<tr title='Done by: $use' data-toggle='tooltip' data-placement='top'>"; ?>
					<form action='' method='post'>
					    <th class='hidden-xs'><div align='right'>
					<?php
						 echo"<input type='hidden' name='vous' value='$vous'>
						 <input type='hidden' name='dato' value='$dato'>
						 <input type='hidden' name='custo' value='$custo'>
						 <input type='hidden' name='datos' value='$datos'>
						 <input type='hidden' name='duse' value='$duse'>";
						?>
        <button type='submit' class='btn btn-xs btn-success hidden-print' name='reprint' style='height:18px; padding:0px; margin:0px;' title='Reprint receiving voucher' data-toggle='tooltip' data-placement='top'>
			&nbsp;&nbsp;<i class='lnr lnr-printer'></i>&nbsp;&nbsp;</button>
					 </th></form>

					 <form action='receive.php' method='post'><th>
					<?php
		if($_SESSION['Edit']){
			 $dbutn='submit';
			 $disa='Click to edit this receiving';
		 }
		 else{
			 $dbutn='button';
			 $disa='You are not allowed to edit';
		 }
	$dor=mysql_query("SELECT *FROM `stouse` WHERE `Status`='0' AND `Voucher`='0' AND `Action`='RECEIVE' ORDER BY `Number` DESC");
				if($for=mysql_num_rows($dor)){
		echo"<input type='hidden' name='vous' value='$vous'>						
                         <button type='button' class='btn btn-xs btn-warning hidden-print' name='edivo' style='height:18px; padding:0px; margin:0px;' title='Not allowed at this moment' data-toggle='tooltip' data-placement='top'>
						  &nbsp;&nbsp;<i class='lnr lnr-pencil'></i>&nbsp;&nbsp;</button>";
				}
				else{
						 echo"<input type='hidden' name='vous' value='$vous'>						
                         <button type='$dbutn' class='btn btn-xs btn-warning hidden-print' name='edivo' style='height:18px; padding:0px; margin:0px;' title='$disa' data-toggle='tooltip' data-placement='top'>
						  &nbsp;&nbsp;<i class='lnr lnr-pencil'></i>&nbsp;&nbsp;</button>";
				}
				
				$dob=mysqli_query($cons, "SELECT `Name` FROM `stores` WHERE `Status`>='0' AND `Store`='$stor' ORDER BY `Number` ASC");
                		    $rob=mysqli_fetch_assoc($dob);
		                    	$stor=$rob['Name'];
					?>
					 </th></form><th><div align='center' style="color:powderblue"> STORE : <?php echo $stor ?></th>
			<th colspan='2' class='text-warning'><?php echo $comm ?></th>
					<th colspan='2'><div align='right'> Total Amount </th>
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
        </td></tr></table>        
              </div>
            </div></div>
                  </div> <span class="pull-right hidden-print">
			 &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
			 
			 <span class="pull-right hidden-print">
		&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" id="exporttable" class="hidden-print" title='Export to excell' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-line-spacing"></i></a></span>
      
   </div></div></div>
 
   <?php
   include'footer.php';
   ?>
