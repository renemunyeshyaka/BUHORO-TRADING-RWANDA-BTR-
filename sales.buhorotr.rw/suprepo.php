<?php
if(basename($_SERVER['PHP_SELF']) == 'suprepo.php') 
  $cm=" class='current'";
include'header.php';
include'connection.php';
$dato=$datos=$Date;
$conde=$dest='';
$custo=0;
$p=$u=0;

if(isset($_POST['search']))
		{
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$dest=$_POST['dest'];
			$p=1;
		
		$do=mysql_query("UPDATE `stouse` SET `Ticked`='0' WHERE `Ticked`!='0'");
		}

		if(isset($_POST['addopay']))
			{
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$dest=$_POST['dest'];
			$n=$_POST['n'];
			$p=$_POST['p'];
			$u=1;
		
		$do=mysql_query("UPDATE `stouse` SET `Ticked`='0' WHERE `Ticked`!='0'");
					
		while($n>0){			
			$vous=$_POST["vous$n"];
			$tick=$_POST["tic$n"];

		if($tick=='1'){
			$do=mysql_query("UPDATE `stouse` SET `Ticked`='1' WHERE `Voucher` = '$vous' AND `Status`='0' AND `Action`='RECEIVE' AND `Voucher`!='0' AND `Destin` NOT LIKE '%PRODUCTION%' ORDER BY `Item` ASC");
									$custo++;
		}
		else{
			$do=mysql_query("UPDATE `stouse` SET `Ticked`='0' WHERE `Voucher` = '$vous' AND `Status`='0' AND `Action`='RECEIVE' AND `Voucher`!='0' AND `Destin` NOT LIKE '%PRODUCTION%' ORDER BY `Item` ASC");
		}
						$n--;
					}
			}


			if(isset($_POST['supay']))
				{
				$dato=$_POST['dato'];
				$datos=$_POST['datos'];
				$amo=$_POST['amo'];
				$amo=str_replace(',', '', $amo);
				$dati=$_POST['dati'];
				$pline=$_POST['pline'];

				$cheno=$_POST['cheno'];
				$bna=$_POST['bna'];
				$slino=$_POST['slino'];
				$acco=$_POST['acco'];
				$dest=$_POST['dest'];
				$client=$_POST['client'];
			$p=$_POST['p'];

				if($pline=='CHEQUE')
		$so=mysql_query("INSERT INTO `payment` (`Date`, `Time`, `Cashier`, `Cash`, `Cheque`, `Bank`, `Credit`, `Voucher`, `Branche`, `Status`, `Customer`, `Destin`, `Description`, `Payto`, `Cheno`, `Bname`, `Pdate`, `Passed`, `Payment`) VALUES ('$dati', '$Time', '$loge', '0', '$amo', '0', '0', '$client', '100', '0', '$dest', 'PURCHASE', '', '$client', '$cheno', '$bna', '$dati', '0', '0')");
				elseif($pline=='BANK')
		$so=mysql_query("INSERT INTO `payment` (`Date`, `Time`, `Cashier`, `Cash`, `Cheque`, `Bank`, `Credit`, `Voucher`, `Branche`, `Status`, `Customer`, `Destin`, `Description`, `Payto`, `Cheno`, `Bname`, `Pdate`, `Passed`, `Payment`) VALUES ('$dati', '$Time', '$loge', '0', '0', '$amo', '0', '$client', '100', '0', '$dest', 'PURCHASE', '', '$client', '$slino', '$acco', '$dati', '0', '0')");
				else
		$so=mysql_query("INSERT INTO `payment` (`Date`, `Time`, `Cashier`, `Cash`, `Cheque`, `Bank`, `Credit`, `Voucher`, `Branche`, `Status`, `Customer`, `Destin`, `Description`, `Payto`, `Cheno`, `Bname`, `Pdate`, `Passed`, `Payment`) VALUES ('$dati', '$Time', '$loge', '$amo', '0', '0', '0', '$client', '100', '0', '$dest', 'PURCHASE', '', '$client', '', '', '$dati', '0', '0')");

		$sepa=mysql_query("SELECT `Number` FROM `payment` WHERE `Destin`='PURCHASE' AND `Date`='$dati' AND `Voucher`='$client' ORDER BY `Number` DESC");
			$repa=mysql_fetch_assoc($sepa);
				$numo=$repa['Number'];
		$i=1;

				$n=$_POST['n'];
				while($i<=$n){			
			$vous=$_POST["vous$i"];			
			$toto=$_POST["tot$i"];
			if($amo>$toto)
				$tak=$toto;
			else
				$tak=$amo;

			if($tak>0)
		$sso=mysql_query("INSERT INTO `supay` (`Number`, `Date`, `Payno`, `Docno`, `Amount`) VALUES (NULL, '$dati', '$numo', '$vous', '$tak')");		
				
				if($amo>=$toto)
	$and=mysql_query("UPDATE `stouse` SET `Paid`='1' WHERE `Voucher` = '$vous' AND `Status`='0' AND `Action`='RECEIVE' AND `Voucher`!='0' ORDER BY `Item` ASC");
					$amo-=$toto;

					$i++;
				}
				//$do=mysql_query("UPDATE `stouse` SET `Ticked`='0' WHERE `Ticked`!='0'");
			}
		
	if($custo=='0')
		$conde="";
	else
		$conde="AND `Ticked`='1' AND `Paid`='0'";

	if($dest=='')
		$cond="";
	else
		$cond="AND `Destin`='$dest'";

		if($dato==$datos)
			$mpri="ON $dato";
		else
			$mpri="FROM $dato TO $datos";
?>
<div class="container-fluid main-content">
        <div class="page-title hidden-print">
          <h3 style='margin-top:-20px; margin-bottom: 5px; color:#ffcc33'>
         Suppliers Report
          </h3>
                 </div>
     
         <div class="row">
  <div class="col-lg-2 hidden-print">
   
   <ul class="list-group">

    <li class="list-group-item active">
	  <a href="suprepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Suppliers Report
                </p>
              </a></li> 

    <li class="list-group-item">
	  <a href="payrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Payment Report
                </p>
              </a></li>  

    <li class="list-group-item">
	  <a href="advarepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Advance Report
                </p>
              </a></li>  

    <li class="list-group-item">
	  <a href="subrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Balance Report
                </p>
              </a></li> 
                       
            </ul>
  </div>
                    
           
           
       
        <div class="col-lg-10">
                  <div class="row">
         
           <div class="col-lg-1"> </div>
          
         
           

        <form action="" method="post" class="form-horizontal ">                  
                       <div class="col-lg-11 hidden-print"><div class="col-lg-3"> 
					   
			   <input type='hidden' name="custo">
					   
					   </div>
					   <div class="col-lg-3">  <select class="form-control" name="dest">
 <?php
				echo"<option value='' selected='selected'> SELECT SUPPLIER </option>";
				  $top=mysql_query("SELECT `Destin` FROM `stouse` WHERE `Status`='0' AND `Action`='RECEIVE' GROUP BY `Destin` ORDER BY `Destin` ASC");
						while($rop=mysql_fetch_assoc($top)){
							$sup=$rop['Destin'];
if($dest==$sup)
$s='selected';
else
$s='';
			echo"<option value='$sup' $s> $sup </option>";
						}
						?>
			   </select></div>
            <div class="col-lg-2"> 
           <div class="input-group date datepicker">
      <input class="form-control form-center" id="from" name="dato" type="text" value="<?php echo $dato ?>" onkeypress='return isNumberKey(event)' required>
	  <span class="input-group-addon"><i class="lnr lnr-calendar-full"></i></span>
			</div></div>


		  <div class="col-lg-2"> 
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
<?php
if($p==0)
$doi=mysql_query("SELECT *FROM (SELECT *FROM `stouse` WHERE `Status`='0' AND `Action`='RECEIVE' AND `Voucher`!='0' AND `Destin` NOT LIKE '%PRODUCTION%' $conde $cond GROUP BY `Voucher` ORDER BY `Number` DESC LIMIT 10) SUB ORDER BY `Number` ASC");
else
$doi=mysql_query("SELECT *FROM `stouse` WHERE `Date` BETWEEN '$dato' AND '$datos' AND `Status`='0' AND `Action`='RECEIVE' AND `Voucher`!='0' AND `Destin` NOT LIKE '%PRODUCTION%' $conde $cond GROUP BY `Voucher` ORDER BY `Date` ASC");
if($fo=mysql_num_rows($doi)){
?>
			<div class="divFooter"><center><u><b>SUPPLIERS PAYMENT REPORT <?php echo $mpri ?></b></u></center></div>
             <div class="row">
            <div class="col-lg-12">
             <span>Total Records Found : <b><?php echo" $fo " ?></b></span>
			 <span class="pull-right hidden-print">&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer hidden-print"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">

	<form action="" method="post"><table class="table table-striped table-hover">     
      		<thead>
                     <tr role="row">
                     <th class="hidden-xs"> No </th> 
                       <th> Due&nbsp;Date </th><th> Voucher&nbsp;No </th>
                       <th> Pay&nbsp;Date </th><th> Supplier </th><th> Items </th>
						 <th class='text-right'> Amount &nbsp;&nbsp;&nbsp;</th>
						 <th class='text-right'> Paid &nbsp;&nbsp;&nbsp;</th>
                       <th class='text-right'> Balance &nbsp;&nbsp;&nbsp;</th>
                     </tr>
                    </thead>
                                        <tbody>
               
			    <?php
						$gto=$gpa=$gba=0;							$n=1;
			   while($roi=mysql_fetch_assoc($doi)){
				$vous=$roi['Voucher'];
				$dat=$roi['Date'];
				$refer=$roi['Destin'];
				$tic=$roi['Ticked'];
				$dest=$roi['Destin'];
				$client=$roi['Client'];
				$tit='';
				
	$do=mysql_query("SELECT *FROM `stouse` WHERE `Voucher` = '$vous' AND `Status`='0' AND `Action`='RECEIVE' AND `Voucher`!='0' AND `Destin` NOT LIKE '%PRODUCTION%' $conde");
				
						$tot=0;					
		while($ro=mysql_fetch_assoc($do)){
			$code=$ro['Number'];		
			$cost=$ro['Price'];
			$item=$ro['Item'];

	$dox=mysql_query("SELECT *FROM `items` WHERE `Number`='$item' ORDER BY `Number` DESC LIMIT 1");
		$rox=mysql_fetch_assoc($dox);
			$iname=$rox['Iname'];

			$qt=$ro['Quantity'];
				$to=$qt*$cost;
				$tot+=$qt*$cost;

				 $qty=number_format($qt, 2);							 $costo=number_format($cost, 2);					 $toto=number_format($tot, 2);
$tit="$tit
	$iname     &nbsp;&nbsp;&nbsp;      $qty&nbsp;x&nbsp;$costo&nbsp;=&nbsp;$toto;
	    ";
						}

	$dov=mysql_query("SELECT *FROM `stouse` WHERE `Voucher` = '$vous' AND `Status`='0' AND `Action`='RECEIVE' AND `Voucher`!='0' AND `Destin` NOT LIKE '%PRODUCTION%' $conde GROUP BY `Item` ORDER BY `Item` ASC");
		$rov=mysql_num_rows($dov);	
		
		if($tic=='1')
			$chk="checked";
		else
			$chk="";
						$pay=0;
		$sepa=mysql_query("SELECT `supay`.`Date`, SUM(`supay`.`Amount`) AS 'Pay' FROM `supay` WHERE `supay`.`Docno`='$vous' ORDER BY `supay`.`Number` DESC");
			$repa=mysql_fetch_assoc($sepa);
				$pay=$repa['Pay'];
				$das=$repa['Date'];
				$bal=$tot-$pay;

				if($bal<=0){
					$bto="--";
	$and=mysql_query("UPDATE `stouse` SET `Paid`='1' WHERE `Voucher` = '$vous' AND `Status`='0' AND `Action`='RECEIVE' AND `Voucher`!='0' AND `Destin` NOT LIKE '%PRODUCTION%' ORDER BY `Item` ASC");
				}
				else{
					$bto="<input class='form-control' name='tic$n' type='checkbox' value='1' $chk style='margin:1px; width:20px; height:20px;'>
	<input type='hidden' name='vous$n' value='$vous'><input type='hidden' name='tot$n' value='$tot'>";
	$and=mysql_query("UPDATE `stouse` SET `Paid`='0' WHERE `Voucher` = '$vous' AND `Status`='0' AND `Action`='RECEIVE' AND `Voucher`!='0' AND `Destin` NOT LIKE '%PRODUCTION%' ORDER BY `Item` ASC");
				}

										$stn="padding:1px;";

         $toto=number_format($tot, 2);				$payo=number_format($pay, 2);				$balo=number_format($bal, 2);	           
		print("<tr title='$tit' data-toggle='tooltip' data-placement='top'>
		<td class='hidden-xs' style='$stn'><div align='center'>$n&nbsp;&nbsp;</td>
			<td style='$stn'> $dat </td><td style='$stn' class='text-center'> $vous </td><td style='$stn'> $das </td><td style='$stn'> $refer </td>
                <td class='text-center' style='$stn'> $rov </td><td style='$stn'><div align='right'> $toto &nbsp;&nbsp; </td>
				<td style='$stn'><div align='right'> $payo &nbsp;&nbsp; </td><td style='$stn'><div align='right'> $balo &nbsp;</td></tr>");
						  $n++;					$gto+=$tot;					$gpa+=$pay;					$gba+=$bal;
						}

			$spa=mysql_query("SELECT `Amount`, `Date` FROM `payment` WHERE `Customer`='$refer' AND `Voucher`>='2147483647' AND `Status`='0' AND `Action`='PURCHASE' AND `Payment`='10' $conde ORDER BY `Number` ASC");
				while($rpa=mysql_fetch_assoc($spa)){
						$ami=$rpa['Amount'];
						$dao=$rpa['Date'];
						$bal=-$ami;

		$amio=number_format($ami, 2);					$balo=number_format($bal, 2);      
		print("<tr title='$tit' data-toggle='tooltip' data-placement='top'>
		<td class='hidden-xs text-primary' style='$stn'><div align='center'>$n&nbsp;&nbsp;</td>
			<td style='$stn' class='text-primary'> $dao </td><td class='text-primary' style='$stn' class='text-center'> -- </td>
			<td class='text-primary' style='$stn'> $dao </td><td class='text-primary' style='$stn'> $refer </td>
        <td class='text-center text-primary' style='$stn'> -- </td><td class='text-primary' style='$stn'><div align='right'> -- &nbsp;&nbsp; </td>
		<td class='text-primary' style='$stn'><div align='right'> $amio &nbsp;&nbsp; </td>
		<td class='text-primary' style='$stn'><div align='right'> $balo &nbsp;</td></tr>");
						  $n++;					$gto+=$tot;					$gpa+=$pay;					$gba+=$bal;
				}
			$gto=number_format($gto, 2);				$gpa=number_format($gpa, 2);				$gba=number_format($gba, 2);				
						?>
						
                     </tbody><thead><tr>
					 <th class='hidden-xs' style='$stn'> </th>
					 <th style='$stn' colspan='5' class='text-center'> Total Amount </th><th class='text-right'><?php echo $gto ?></th>
					 <th class='text-right'><?php echo $gpa ?></th><th class='text-right'><?php echo $gba ?></th></table>
					
					  </form>
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
						<div style='text-align:center; font-size:24px; color:#ff3333'> Report not available at selected date </div><br><br><br><br><br><br><br>";
					}  
?>                
                
              </div>
            </div></div>
                  </div> <span class="pull-right hidden-print">
			 &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
      
   </div></div></div>
 
   <?php
   /*
$doxi=mysql_query("SELECT `Number`, `Docno` FROM `supay` WHERE `Amount` > '0' ORDER BY `Number` ASC");
	while($roxi=mysql_fetch_assoc($doxi)){
		$docno=$roxi['Docno'];
$num=$roxi['Number'];
$dor=mysql_query("SELECT `Voucher` FROM `stouse` WHERE `Status`='0' AND `Voucher`='$docno' AND `Upda`='1' AND `Action`='RECEIVE' GROUP BY `Voucher` ORDER BY `Number` ASC");
		if(!$for=mysql_num_rows($dor))
$do=mysql_query("UPDATE `supay` SET `Status`='1' WHERE `Number`='$num'");
}

*/
   include'footer.php';
   ?>
