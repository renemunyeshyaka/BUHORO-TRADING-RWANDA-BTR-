<?php
if(basename($_SERVER['PHP_SELF']) == 'billpay.php') 
  $pp=" class='current'";
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
				$brc=$_POST['brc'];
					$p=$_POST['p'];

				if($pline=='CHEQUE')
		$so=mysql_query("INSERT INTO `payment` (`Date`, `Time`, `Cashier`, `Amount`, `Pline`, `Voucher`, `Branche`, `Status`, `Customer`, `Action`, `Description`, `Cheno`, `Bname`, `Pdate`, `Upda`) VALUES ('$dati', '$Time', '$loge', '$amo', '$pline', '99999999999', '$brc', '0', '$client', 'PURCHASE', 'Supplier Payment', '$cheno', '$bna', '$dati', '1')");
				elseif($pline=='BANK'){
		$so=mysql_query("INSERT INTO `payment` (`Date`, `Time`, `Cashier`, `Amount`, `Pline`, `Voucher`, `Branche`, `Status`, `Customer`, `Action`, `Description`, `Cheno`, `Bname`, `Pdate`, `Upda`) VALUES ('$dati', '$Time', '$loge', '$amo', '$pline', '99999999999', '$brc', '0', '$client', 'PURCHASE', 'Supplier Payment', '$slino', '$acco', '$dati', '1')");
		
       $and=mysqli_query($cons, "INSERT INTO `deposit` (`Number`, `Date`, `Time`, `User`, `Item`, `Refer`, `Amount`, `Customer`, `Operation`, `Status`, `Valid`, `Account`, `Descri`, `Client`, `Voucher`, `Source`, `Record`, `Branche`) VALUES (NULL, '$dati', '$Time', '$loge', 'PAYMENT', '$slino', '$amo', '$client', 'WITHDRAWAL', '0', '0', '$acco', 'Supplier Payment', '$client', '99999999999', 'TRANSFER', '$numo', '$brc')");
				}
				else
		$so=mysql_query("INSERT INTO `payment` (`Date`, `Time`, `Cashier`, `Amount`, `Pline`, `Voucher`, `Branche`, `Status`, `Customer`, `Action`, `Description`, `Cheno`, `Bname`, `Pdate`, `Upda`) VALUES ('$dati', '$Time', '$loge', '$amo', '$pline', '99999999999', '$brc', '0', '$client', 'PURCHASE', 'Supplier Payment', '', '', '$dati', '1')");

		$sepa=mysql_query("SELECT `Number` FROM `payment` WHERE `Action`='PURCHASE' AND `Date`='$dati' AND `Status`='0' AND `Description`='Supplier Payment' ORDER BY `Number` DESC LIMIT 1");
			$repa=mysql_fetch_assoc($sepa);
				$numo=$repa['Number'];

					$i=1;

				$n=$_POST['n'];
				$m=$n-1;
				while($i<=$n){			
			$vous=$_POST["vous$i"];			
			$toto=$_POST["tot$i"];
			if($amo>$toto AND $i!=$m)
				$tak=$toto;
			else
				$tak=$amo;

			if($tak>0)
		$sso=mysql_query("INSERT INTO `supay` (`Number`, `Date`, `Payno`, `Docno`, `Amount`, `Supplier`) VALUES (NULL, '$dati', '$numo', '$vous', '$tak', '$client')");		
				
				if($amo>=$toto)
	$and=mysql_query("UPDATE `stouse` SET `Paid`='1' WHERE `Voucher` = '$vous' AND `Status`='0' AND `Action`='RECEIVE' AND `Voucher`!='0' ORDER BY `Item` ASC");
					$amo-=$toto;

					$i++;
				}
			}

	if(isset($_POST['adpaid']))
		{
			$supo=$_POST['supo'];
			$amo=str_replace(',', '', $_POST['amo']);
			$mode=$_POST['mode'];
			$pieces = explode("-", $mode);
					$mode=$pieces[1]; // piece2

	$sepa=mysql_query("SELECT `Supplier` FROM `suppliers` WHERE `Supplier`='$supo' ORDER BY `Number` DESC");
			if($fepa=mysql_num_rows($sepa)=='1'){

if($mode=='CASH'){
	$cheno=$bna='';
	$pda=$_POST['capa'];
	$brc=$_POST['abra'];
}
if($mode=='CHEQUE'){	
	$cheno=$_POST['cheno'];
	$bna=$_POST['cba'];
	$pda=$_POST['chpa'];
	$brc=$_POST['cbra'];
}
if($mode=='BANK'){	
	$cheno=$_POST['slino'];
	$bna=$_POST['acco'];
	$pda=$_POST['cbpa'];
	$brc=$_POST['bbra']; 

	
$and=mysqli_query($cons, "INSERT INTO `deposit` (`Number`, `Date`, `Time`, `User`, `Item`, `Refer`, `Amount`, `Customer`, `Operation`, `Status`, `Valid`, `Account`, `Descri`, `Client`, `Voucher`, `Source`, `Record`, `Branche`) VALUES (NULL, '$pda', '$Time', '$loge', 'PAYMENT', '$cheno', '$amo', '$supo', 'WITHDRAWAL', '0', '0', '$bna', 'Supplier Advance', '0', '99999999999', 'TRANSFER', '$numo', '$brc')");
}

	$then=mysqli_query($cons, "INSERT INTO `payment` (`Date`, `Time`, `Cashier`, `Amount`, `Pline`, `Voucher`, `Branche`, `Status`, `Customer`, `Action`, `Description`, `Payto`, `Cheno`, `Bname`, `Pdate`, `Payment`, `Upda`) VALUES ('$pda', '$Time', '$loge', '$amo', '$mode', '99999999999', '$brc', '0', '$supo', 'PURCHASE', 'Supplier Advance', '', '$cheno', '$bna', '$pda', '10', '1')");
			
			$pto=10;
			}
			else
				$pto=20;
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
         Main Store
          </h3>
                 </div>
     
         <div class="row">
  <div class="col-lg-2 hidden-print">
   
   <ul class="list-group">

    <li class="list-group-item">
	  <a href="mainsto.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Store Status
                </p>
              </a></li> 

	   <li class="list-group-item">
              <a href="crete.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Create New Items
                </p>
              </a></li>  

			  <li class="list-group-item">
              <a href="purcha.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Purchase Orders
				<?php
				if($pfuquo)
					echo"<span class='badge' style='float:right; font-size:12px; margin-right:0px; margin-top:0px; height:18px; background-color:#99ff33; width:26px;'> $pfuquo </span>";
					?>
                </p>
              </a></li> 	
       <?php
if($_SESSION['Ari']){
    ?>           
			  <li class="list-group-item">
              <a href="receive.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Receive Items
                </p>
              </a></li>
	<?php
}
if($_SESSION['Asd']){
    ?>		  
			   <li class="list-group-item">
              <a href="taken.php">
                <p>
                <i class="lnr lnr-circle-minus"></i>&nbsp;Stock &nbsp; Delivery
                </p>
              </a></li>   
<?php
}
if($_SESSION['Spay']){
    ?>
			  <li class="list-group-item active">
              <a href="billpay.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Supplier Payment
                </p>
              </a></li> 
              <?php
}
if($pbuffe){
?>

 <li class="list-group-item">
              <a href="buffer.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Buffer &nbsp; Report
                </p>
              </a></li>	
    <?php
}
?>
                       
            </ul>
  </div>
                    
   <?php
		include'advance.php';
	?>
           
       
        <div class="col-lg-10">
                  <div class="row">

			<?php
		if($pto==10)
echo"<center><div class='alert alert-info' style='width:98%; text-align:center;float:center; color: #ffffff;border-radius:5px; font-size:18px;'>
		<i class='lnr lnr-checkmark-circle'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>&times;</button>Advance has been paid to $supo.</div></center>";
		
		if($pto==20)
echo"<center><div class='alert alert-danger' style='width:98%; text-align:center;float:center; color: #ffffff;border-radius:5px; font-size:18px;'>
		<i class='lnr lnr-checkmark-circle'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>&times;</button>Select name not found in your suppliers.</div></center>";
		?>
         
          <div class="col-lg-2" style="padding-left:30px;">
<button class="btn btn-md btn-block btn-warning" type="button" data-toggle="modal" data-target="#modal-x11">
	<i class='lnr lnr-briefcase'></i> &nbsp; ADVANCE </button></div>
         
           
				<div class="col-lg-1"> </div>
        <form action="" method="post" class="form-horizontal ">                  
                       <div class="col-lg-9 hidden-print">
					   <div class="col-lg-4">  
			<input type='hidden' name="custo"><select class="form-control" name="dest">
 <?php
				echo"<option value='' selected='selected'> SELECT SUPPLIER </option>";
				  $top=mysql_query("SELECT `Destin` FROM `stouse` WHERE `Status`='0' AND `Action`='RECEIVE' GROUP BY `Destin` ORDER BY `Destin` ASC");
						while($rop=mysql_fetch_assoc($top)){
							$sup=$rop['Destin'];
							if($sup==$dest)
								$s='selected';
							else
								$s='';
			echo"<option value='$sup'> $sup </option>";
						}
						?>
			   </select></div><div class="col-lg-8">
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
                      
                    </div> 
                  
            </form> 
             
               
            </div>
<?php
if($p==0)
$doi=mysql_query("SELECT *FROM (SELECT *FROM `stouse` WHERE `Status`='0' AND `Action`='RECEIVE' AND `Voucher`!='0' AND `Destin` NOT LIKE '%PRODUCTION%' AND `Destin` NOT LIKE '%IMPORTATION%' $conde $cond GROUP BY `Voucher` ORDER BY `Number` DESC LIMIT 10) SUB ORDER BY `Number` ASC");
else
$doi=mysql_query("SELECT *FROM `stouse` WHERE `Date` BETWEEN '$dato' AND '$datos' AND `Status`='0' AND `Action`='RECEIVE' AND `Voucher`!='0' AND `Destin` NOT LIKE '%PRODUCTION%' AND `Destin` NOT LIKE '%IMPORTATION%' $conde $cond GROUP BY `Voucher` ORDER BY `Date` ASC");
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
                       <th> Due&nbsp;Date </th>
                        <th> Voucher&nbsp;No </th>
                       <th> Supplier </th>
                       <th> Items </th>
						 <th class='text-right'> Amount &nbsp;&nbsp;&nbsp;</th>
						 <th class='text-right'> Paid &nbsp;&nbsp;&nbsp;</th>
                       <th class='text-right'> Balance &nbsp;&nbsp;&nbsp;</th>
                     <th class="hidden-print" style="width:10px;"> # </th> 
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
				$desti=$roi['Destin'];
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
&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;
	    ";
						}

	$dov=mysql_query("SELECT *FROM `stouse` WHERE `Voucher` = '$vous' AND `Status`='0' AND `Action`='RECEIVE' AND `Voucher`!='0' AND `Destin` NOT LIKE '%PRODUCTION%' $conde GROUP BY `Item` ORDER BY `Item` ASC");
		$rov=mysql_num_rows($dov);	
		
		if($tic=='1')
			$chk="checked";
		else
			$chk="";
						$pay=0;
		$sepa=mysql_query("SELECT SUM(Amount) AS 'Pay' FROM `supay` WHERE `Docno`='$vous' ORDER BY `Number` DESC");
			$repa=mysql_fetch_assoc($sepa);
				$pay=$repa['Pay'];
				$bal=$tot-$pay;

				if($bal<=0){
					$bto="--";
	$and=mysql_query("UPDATE `stouse` SET `Paid`='1' WHERE `Voucher` = '$vous' AND `Status`='0' AND `Action`='RECEIVE' AND `Voucher`!='0' AND `Destin` NOT LIKE '%PRODUCTION%' ORDER BY `Item` ASC");
				}
				else{
					$bto="<input class='form-control' name='tic$n' type='checkbox' value='1' $chk style='margin:1px; width:20px; height:20px;'>
	<input type='hidden' name='vous$n' value='$vous'><input type='hidden' name='tot$n' value='$tot'><input type='hidden' name='client' value='$desti'>";
	$and=mysql_query("UPDATE `stouse` SET `Paid`='0' WHERE `Voucher` = '$vous' AND `Status`='0' AND `Action`='RECEIVE' AND `Voucher`!='0' AND `Destin` NOT LIKE '%PRODUCTION%' ORDER BY `Item` ASC");
				}

										$stn="padding:1px;";

         $toto=number_format($tot, 2);				$payo=number_format($pay, 2);				$balo=number_format($bal, 2);	           
		print("<tr title='$tit' data-toggle='tooltip' data-placement='top'>
		<td class='hidden-xs' style='$stn'><div align='center'>$n&nbsp;&nbsp;</td>
			<td style='$stn'> $dat </td><td style='$stn' class='text-center'> $vous </td><td style='$stn'> $refer </td>
                <td class='text-center' style='$stn'> $rov </td><td style='$stn'><div align='right'> $toto &nbsp;&nbsp; </td>
				<td style='$stn'><div align='right'> $payo &nbsp;&nbsp; </td><td style='$stn'><div align='right'> $balo &nbsp;</td>
				<td style='$stn' class='hidden-print text-center'>$bto</td></tr>");
						  $n++;					$gto+=$tot;					$gpa+=$pay;					$gba+=$bal;
						}
			   
	$gto=number_format($gto, 2);				$gpa=number_format($gpa, 2);				$gba=number_format($gba, 2);				
						?>
						
                     </tbody><thead><tr>
					 <th class='hidden-xs' style='$stn'> </th>
					 <th style='$stn' colspan='4' class='text-center'> Total Amount </th><th class='text-right'><?php echo $gto ?></th>
					 <th class='text-right'><?php echo $gpa ?></th><th class='text-right'><?php echo $gba ?></th><th class="hidden-print"> &nbsp; </th></table>
					 <?php
		echo"<input type='hidden' name='dato' value='$dato'><input type='hidden' name='datos' value='$datos'>
		<input type='hidden' name='n' value='$n'><input type='hidden' name='p' value='$p'><input type='hidden' name='client' value='$desti'>
		<input type='hidden' name='dest' value='$dest'><input type='hidden' name='client' value='$desti'>";
					 if($conde=='' AND $_SESSION['Spay']){
						 ?>
					 <div class="pull-right hidden-print">
                        <button class="btn  btn-success btn-block" type="submit" name="addopay" style="width:80px;">
						<i class="lnr lnr-briefcase"></i> PAY </button>                   
					  </div>
					  
					  <?php
						}
					  elseif($u==1 AND $_SESSION['Spay']){
?>
<div class="col-md-1">  </div><div class="col-md-2">
           <input name="dati" class="form-control" type="text" onkeypress='return isNumberKey(event)' style="text-align:center;" value="<?php echo $Date ?>" autocomplete='off' title='Date of payment' data-toggle='tooltip' data-placement='top'>
            </div>

<div class="col-md-2">
			 <select class="form-control" name="brc" onclick="return pageScroll()" required>			
			 <?php
				echo"<option value='' selected='selected'> SELECT A BRANCH </option>";
							
	$doi=mysql_query("SELECT `Number`, `Name` FROM `branches` WHERE `Status`='0' ORDER BY `Number` ASC");
		$foi=mysql_num_rows($doi);
			while($roi=mysql_fetch_assoc($doi)){
				$fna=$roi['Name'];
				$num=$roi['Number'];
				if($dst==$fna OR $foi==1)
					$s='selected';
				else
					$s='';
			echo"<option value='$num' $s> $fna </option>";
			}
			?>			    
            </select>
					</div>

			<div class="col-md-2">
           <input name="amo" class="form-control" type="text" onkeyup='format(this);' onkeypress='return isNumberKey(event)' style="text-align:center;" placeholder="Paid Amount" autocomplete='off' title='Paid Amount' data-toggle='tooltip' data-placement='top'>
            </div>

			<div class="col-md-2">
          <SELECT name="pline" class="form-control" onchange='showDiv(this.value);'>
	<OPTION VALUE="CASH" SELECTED>CASH</OPTION>
		<OPTION VALUE="CHEQUE">CHEQUE</OPTION>
 <OPTION value='BANK'>DEPOSIT</OPTION>
</SELECT><?php echo"<input type='hidden' name='p' value='$p'>"; ?>
            </div>

			<div class="col-md-2">
           <button class="btn  btn-success btn-block" type="submit" name="supay">
						<i class="lnr lnr-briefcase"></i> SAVE </button> 
            </div><div class="col-md-1"> </div>




 <div id='CHEQUE'  class="form-group hiddenDiv" style="margin-top:60px; border:0px;">

<div class="col-md-3"> </div><div class="col-md-4">
<input class="form-control form-center" name="cheno" type="text" placeholder="CHEQUE No" onkeypress='return isNumberKey(event)' style="border:1px solid blue;"></div>
		<div class="col-md-4 text-right"><select class="form-control" name="bna" style="border:1px solid blue;">
				<option value='' selected='selected'>BANK NAME</option>
			<?php
			$doi=mysql_query("SELECT `Fnames` FROM `banks` ORDER BY `Fnames` ASC");
			while($roi=mysql_fetch_assoc($doi)){
				$fna=$roi['Fnames'];
			echo"<option value='$fna'> $fna </option>";
			}
			?>   
                            </select></div>
					</div>
							





















	
 <div id='BANK' class="form-group hiddenDiv" style="margin-top:60px; border:0px;">

<div class="col-md-3"> </div>
<div class="col-md-4"><input class="form-control form-center" name="slino" type="text" placeholder="BANK SLIP No" onkeypress='return isNumberKey(event)' style="border:1px solid #33cc99;"></div>
		<div class="col-md-4 text-right"><select class="form-control" name="acco" style="border:1px solid #33cc66;">
				<option value='' selected='selected'>BANK ACCOUNT</option>
			<?php
			$doi=mysql_query("SELECT *FROM `baccount` ORDER BY `Number` ASC");
			while($roi=mysql_fetch_assoc($doi)){
				$nu=$roi['Number'];
				$fna=$roi['Bank'];
				$acco=$roi['Account'];
				$purpo=$roi['Purpose'];
			echo"<option value='$nu' title='$purpo'> $fna $acco </option>";
			}
			?>   
                            </select></div>

	
					</div>
						





	<?php
		}
					  ?>
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
$do=mysql_query("UPDATE `supay`, `stouse` SET `supay`.`Supplier`=`stouse`.`Destin` WHERE `supay`.`Supplier`='' AND `stouse`.`Action`='RECEIVE' AND `supay`.`Docno`=`stouse`.`Voucher`");
   include'footer.php';
   ?>
