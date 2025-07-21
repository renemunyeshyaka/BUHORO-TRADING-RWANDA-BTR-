<?php
if(basename($_SERVER['PHP_SELF']) == 'requirepo.php') 
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
		
	if($custo=='')
		$conde="";
	elseif($custo=='PRODUCTION A')
		$conde="AND `Destin`='PRODUCTION A'";
	elseif($custo=='PRODUCTION B')
		$conde="AND `Destin`='PRODUCTION B'";
	elseif($custo=='BRANCHES')
		$conde="AND `Destin`!='PRODUCTION A' AND `Destin`!='PRODUCTION B'";
	else
		$conde="AND `Destin`='$custo'";

		if($dato==$datos)
			$mpri="ON $dato";
		else
			$mpri="FROM $dato TO $datos";

$doi=mysql_query("SELECT *FROM `requis` WHERE `Date` BETWEEN '$dato' AND '$datos' AND `Status`='0' AND `Action`='INTERNAL' AND `Voucher`!='0' AND `Destin`!='DAMAGED/EXPIRIES' $conde GROUP BY `Voucher`,`Destin` ORDER BY `Voucher` ASC");
$fo=mysql_num_rows($doi);
?>
<div class="container-fluid main-content">
        <div class="page-title hidden-print">
          <h2 style='margin-top:-20px; margin-bottom: 5px;'>
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

			   <li class="list-group-item active">
              <a href="requirepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Requisition Report
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
                <i class="lnr lnr-menu-circle"></i>&nbsp;Dispatch Report
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
			<?php
			if($custo=='PRODUCTION A')
					$p='selected';
				else
					$p='';

if($custo=='PRODUCTION B')
					$pe='selected';
				else
					$pe='';

				echo"<option value='' selected='selected'> SELECT DESTINATION </option>
				<option value='PRODUCTION A' $p> SNACKS </option><option value='PRODUCTION B' $pe> BAKERY </option>";
			
	$dois=mysql_query("SELECT `Name` FROM `branches` ORDER BY `Number` ASC");
			while($rois=mysql_fetch_assoc($dois)){
				$fna=$rois['Name'];
				if($custo==$fna)
					$t='selected';
				else
					$t='';
			echo"<option value='$fna' $t> $fna </option>";
			}
			?>		</select>
					   
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

			<div class="divFooter"><center><u><b>REQUISITION REPORT <?php echo $mpri ?></b></u></center></div>
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
	$do=mysql_query("SELECT *, SUM(Quantity) AS 'QT' FROM `requis` WHERE `Voucher` = '$vous' AND `Destin`='$deso' AND `Status`='0' AND `Action`='INTERNAL' GROUP BY `Item` ORDER BY `Number` ASC");
				?>
                                 <table class="table table-striped table-hover">     
                                      <thead>
                     <tr role="row">
                     <th class="hidden-xs"> No </th> 
                       <th> Due&nbsp;Date </th>
                       <th> Destination </th>
                       <th> Item&nbsp;Name </th>
                        <th> Description </th>
                       <th> Request </th>
						 <th> Unit </th>
						 <th> Taken </th>
						 <th><div align='right'> Balance&nbsp;&nbsp;&nbsp;&nbsp;</th>
                     </tr>
                    </thead>
                                        <tbody>
					<?php
					$n=1;				$tp=0;	
						while($ro=mysql_fetch_assoc($do)){
				$code=$ro['Number'];
				$item=$ro['Item'];			
			$cost=$ro['Cost'];			
			$qt=$ro['QT'];
			$dte=$ro['Date'];
			$type=$ro['Destin'];
			$pers=$ro['Person'];
			$vouc=$ro['Voucher'];
			$use=$ro['User'];
			$pri=$ro['Price'];

	$dov=mysql_query("SELECT *FROM `items` WHERE `Number`='$item' ORDER BY `Number` DESC LIMIT 1");
		$rov=mysql_fetch_assoc($dov);
			$kin=$rov['Type'];
			$descri=$rov['Descri'];
			$uno=$rov['Unit'];
			$iname=$rov['Iname'];

			$stn="padding:0px;";	

				$dox=mysql_query("SELECT *FROM `unit` WHERE `Number`='$uno' ORDER BY `Number` ASC");
					$rox=mysql_fetch_assoc($dox);
							$unit=$rox['Unit'];

			$dox=mysql_query("SELECT SUM(Quantity) AS 'QTO' FROM `stouse` WHERE `Requis` = '$vouc' AND `Status`='0' AND `Action`='TAKEN' AND `Item`='$item' AND `Destin`='$type'");
				$rox=mysql_fetch_assoc($dox);
					$qto=$rox['QTO'];

	$bal=$qt-$qto;

         $balo=number_format($bal, 2);		$qty=number_format($qt, 2);			$qtos=number_format($qto, 2);
$doti=mysql_query("SELECT *FROM `production` WHERE `Convert`='$type' ORDER BY `Number` ASC");
if($foti=mysql_num_rows($doti)){
	$roti=mysql_fetch_assoc($doti);
		$typo=$roti['Name'];
}
else
$typo=$type;
		print("<tr>
          <td class='hidden-xs' style='$stn'><div align='center'>$n&nbsp;&nbsp;</td>
			<td style='$stn'> $dte </td><td style='$stn'> $type </td>
			<td style='$stn'> $iname </td><td style='$stn'> $descri </td>
				<td style='$stn'><div align='right'> $qty&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td style='$stn'> $unit </td>
				<td style='$stn'><div align='right'> $qtos &nbsp;&nbsp; </td>
				<td style='$stn'><div align='right'> $balo </td></tr>");
						  $n++;					$tp+=($qt*$pri);
						}
						$tpo=number_format($tp, 2);			
						?>
						
                     </tbody><thead>
					<?php echo"<tr title='Done by: $use' data-toggle='tooltip' data-placement='top'>"; ?>
					<form action='requidoc.php' method='post' target='_blank'><th style='padding:1px;' class='hidden-xs'> </th>
<th style='padding:1px;'><div align='right'>
					<?php
			echo"<input type='hidden' name='vous' value='$vous'><input type='hidden' name='des' value='$type'>";
						?>
                          <button type='submit' class='btn btn-xs btn-success hidden-print' name='open' style='height:18px; padding:0px; margin:0px;' title='Click to open delivery voucher' data-toggle='tooltip' data-placement='top'> &nbsp;&nbsp;<i class='lnr lnr-download'></i>&nbsp;&nbsp;</button>
					 </th></form>

					 <form action='taken.php' method='post'><th style='padding:1px;'><div right='left'>
					<?php
		if($_SESSION['Edit']){
			 $dbutn='submit';
			 $disa='You can`t edit this requisition';
		 }
		 else{
			 $dbutn='button';
			 $disa='You can`t edit this requisition';
		 }
			$dor=mysql_query("SELECT *FROM `stouse` WHERE `Status`='0' AND `Voucher`='0' AND `Action`='TAKEN' ORDER BY `Number` DESC");
				if($for=mysql_num_rows($dor)){
		echo"<input type='hidden' name='vous' value='$vous'>						
                         <button type='button' class='btn btn-xs btn-warning hidden-print' name='edivo' style='height:18px; padding:0px; margin:0px;' title='$disa' data-toggle='tooltip' data-placement='top'>&nbsp;&nbsp;<i class='lnr lnr-pencil'></i>&nbsp;&nbsp;</button>";
				}
				else{
						 echo"<input type='hidden' name='vous' value='$vous'>						
                         <button type='button' class='btn btn-xs btn-warning hidden-print' name='edivo' style='height:18px; padding:0px; margin:0px;' title='$disa' data-toggle='tooltip' data-placement='top' disabled> &nbsp;&nbsp;<i class='lnr lnr-pencil'></i>&nbsp;&nbsp;</button>";
				}
					?>
					 </th></form>

					<th style='padding:1px;' colspan='5'><div align='center'> &nbsp;&nbsp; </th>
					<th style='padding:1px;'> </th><th style='padding:1px;'><div align='right'>&nbsp;&nbsp;</th></tr>
                  </table><br>
				  <?php
$gto+=$tp;
			   }

$gto=number_format($gto, 2);
if($fo>='2'){
					 ?> 
<?php
}
?>                
              </div>
            </div></div>
                  </div>                    
                <span class="pull-right hidden-print">
			 &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
      
   </div></div></div> 
    
   <?php
   include'footer.php';
   ?>
