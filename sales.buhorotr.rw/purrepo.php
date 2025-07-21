<?php
if(basename($_SERVER['PHP_SELF']) == 'purrepo.php') 
  $cm=" class='current'";
include'header.php';
include'connection.php';
$custo='';
$conde='';
$t=0;
$lim=20;
$dato=$datos=$Date;

// delete an item from a given chart
if(isset($_POST['delo']))
		{
			$rowid=$_POST['rowid'];
			$then=mysql_query("DELETE FROM `stouse` WHERE `Number`='$rowid' LIMIT 1");
		}

// edit an item from a given chart
if(isset($_POST['edit']))
		{
			$rowid=$_POST['rowid'];
			$qty=$_POST['qty'];
				$qty=str_replace(',', '', $qty);
			$pre=$_POST['pre'];
				$pre=str_replace(',', '', $pre);
			$then=mysql_query("UPDATE `stouse` SET `Quantity`='$qty', `Price`='$pre' WHERE `Number`='$rowid' LIMIT 1");
		}

// search for an item to be added to the chart
if(isset($_POST['search']))
		{
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			//$t=1;
		}

// Add found item to the chart
		if(isset($_POST['addo']))
		{
			$n=$_POST['n'];
			while($n>0){
				$item=$_POST["item$n"];
				$qty=$_POST["qty$n"];
				$pri=$_POST["pri$n"];
				$cost=$_POST["cost$n"];
				if($qty)
		$so=mysql_query("INSERT INTO `stouse` (`Number`, `Date`, `User`, `Item`, `Cost`, `Quantity`, `Price`, `Action`, `Destin`, `Voucher`, `Status`) VALUES (NULL, '$Date', '$loge', '$item', '$cost', '$qty', '$pri', 'PURCHASE', '', '0', '0')");
			$n--;
			}
		}

	if($custo){
			$conde="AND (`Iname` LIKE '%$custo%' OR `Descri` LIKE '%$custo%')";
			$lim=100;
		}
		else{
			$conde='';
			$lim=140;
		}

		$rece=mysql_query("SELECT `Voucher` FROM `stouse` WHERE `Action`='PURCHASE' ORDER BY `Voucher` DESC LIMIT 1");
				$re=mysql_fetch_assoc($rece);
					$vou=$re['Voucher']+1;

// Close the current chart
		if(isset($_POST['receive']))
		{
			$supplier=$_POST['supplier'];
			$dato=$_POST['dato'];
	$so=mysql_query("UPDATE `stouse` SET `Date`='$dato', `Destin`='$supplier', `Voucher`='$vou' WHERE `Status`='0' AND `Voucher`='0' AND `Action`='PURCHASE'");
		}

		// delete an item from a given chart
if(isset($_POST['deloq']))
		{
			$vous=$_POST['vous'];
			$and=mysql_query("UPDATE `stouse` SET `Status`='1' WHERE `Voucher`='$vous' AND `Action`='PURCHASE' LIMIT 1000");
		}
?>
<div class="container-fluid main-content">
        <div class="page-title">
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

			   <li class="list-group-item">
              <a href="recerepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Receiving Report
                </p>
              </a></li>

			  <li class="list-group-item active">
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
         
           <div class="col-lg-4"> </div>
          
         
           

        <form action="" method="post" class="form-horizontal ">                  
                       <div class="col-lg-8 hidden-print"><div class="col-lg-3"> 					
					   
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
               <?php
			   if($t==1){
		$do=mysql_query("SELECT *FROM `items` WHERE `Store`='1' AND `Status`='0' $conde ORDER BY `Number` DESC LIMIT $lim");
				if($fo=mysql_num_rows($do)){
				   ?>
                 
             <div class="row">
            <div class="col-lg-12" style='margin-top:-20px;'>
             <span> &nbsp;&nbsp; Total Records Found : <b><?php echo" $fo " ?></b></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">

								 <form action="" method="post" class="form-horizontal "> 
				<table class="table table-striped">     
                                      <thead>
                    <tr role="row">
                     <th class="hidden-xs"> NO </th>
                       <th> Item&nbsp;Name </th>
                        <th> Description </th>
                       <th> Item&nbsp;Type </th>
                       <th>&nbsp;&nbsp;Qty&nbsp;In&nbsp;&nbsp;</th>
                       <th> Count&nbsp;Unit </th>
						 <th> Cost&nbsp;Price </th>
                        <th><div align='center'> Quantity </th><th><div align='center'> Price/Unit </th>
						<th class="hidden-xs hidden-print">Total&nbsp;Amount</th>
                     </tr>
                    </thead>
                                        <tbody>
					<?php
					$n=1;		
						while($ro=mysql_fetch_assoc($do)){
				$code=$ro['Number'];
				$iname=$ro['Iname'];
			$kin=$ro['Type'];
			$descri=$ro['Descri'];
			$uno=$ro['Unit'];			
			$cost=$ro['Cost'];			$costo=number_format($cost, 2);
			$qt=$ro['Quanity'];				$qty=number_format($qt, 2);

$doi=mysql_query("SELECT *FROM `itype` WHERE `Number`='$kin' ORDER BY `Number` ASC");
		$roi=mysql_fetch_assoc($doi);
				$type=$roi['Type'];

				$dox=mysql_query("SELECT *FROM `unit` WHERE `Number`='$uno' ORDER BY `Number` ASC");
					$rox=mysql_fetch_assoc($dox);
							$unit=$rox['Unit'];
          $b=$n*10;

		  $stn="padding:1px;";

		print("<tr>
                        <td class=hidden-xs><div align='center'>$n&nbsp;&nbsp;</td>
						<td> $iname </td><td> $descri </td><td> $type </td><td><div align='right'> $qty </td><td> $unit </td>
						<td><div align='right'>&nbsp;$costo&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
						<td><input name='qty$n' class='form-control' type='text' onkeyup='multiplyBy$n();' onkeypress='return isNumberKey(event)' style='text-align:right; width:120px; height:24px; margin:0px 0px 0px 0px' id='box$n'></td>
						<td><input name='pri$n' class='form-control' type='text' onkeyup='multiplyBy$n();' onkeypress='return isNumberKey(event)' 
						style='text-align:right; width:130px; height:24px;' value='$cost' onclick=this.value='' id='box$b'></td>
						<td class='hidden-xs hidden-print' width='10%'><div align='right' style='border:1px solid #cccccc; width:120px; height:24px; border-radius:5px; padding:0px 10px 0px 0px;'><input type='hidden' name='item$n' value='$code'>
						<span class='dollars' style='text-align:right; width:130px; height:24px; font-size:18px; color:#66cccc; float:center; text-align:right;' id='result$n' onchange='format(this);'></span></div><input type='hidden' name='cost$n' value='$cost'></td></tr>");
						  $n++;
						}
						$toto=number_format($tot);			$tco=number_format($tco);
						?>
						
                    </tbody>
                  </table>

				   <div class="row"><br>
                  <div class="col-lg-10"><hr></div><div class="col-lg-2">
                 <?php echo"<input type='hidden' name='n' value='$n'>"; ?>
                 <button class="btn btn-sm btn-block btn-primary hidden-print" type="submit" name="addo" style="margin:0px 0px 0px -15px;">
				 <i class="lnr lnr-plus-circle"></i> Add to Cart </button>
              </div></div></form>
				  <?php
				}
				 else{
						echo"<div class='row'>
            <div class='col-lg-12' style='margin-top:-20px;'>
             <span> &nbsp;&nbsp; Purchase Order No : <b> $vou </b></span>
            <div class='widget-container fluid-height clearfix'>
            <div class='widget-content padded clearfix'>
			<br><br><br><br><br><br>
						<div style='text-align:center; font-size:24px; color:#ff3333'> Item not found for your search [$custo] </div><br><br><br><br><br><br><br>";
					}  
			}
				   else{
		$dor=mysql_query("SELECT *FROM `stouse` WHERE `Status`='10' AND `Voucher`='0' AND `Action`='PURCHASE' ORDER BY `Number` DESC");
				if($for=mysql_num_rows($dor)){
?>
 <div class="row">
            <div class="col-lg-12" style='margin-top:-20px;'>
             <span> &nbsp;&nbsp; Purchase Order No : <b><?php echo" $vou " ?></b></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">

<table class="table table-striped">     
                                      <thead>
                    <tr role="row">
                     <th class="hidden-xs"> NO </th>
                       <th> Item&nbsp;Name </th>
                        <th> Description </th>
                       <th>&nbsp;&nbsp;&nbsp;&nbsp;Item&nbsp;Type&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                       <th>&nbsp;&nbsp;&nbsp;&nbsp;Qty&nbsp;In&nbsp;&nbsp;&nbsp;&nbsp;</th>
                       <th> Count&nbsp;Unit </th>
						 <th> Cost&nbsp;Price </th>
                        <th><div align='center'> Quantity </th>
						<th><div align='center'> Price/Unit </th>
						<th colspan='2'>Total&nbsp;Amount</th>
                        <th class="hidden-xs hidden-print" style="width:40px; text-align:center;" colspan='2'> Options </th>
                     </tr>
                    </thead>
                                        <tbody>
										<?php
	$n=1;			$tot=0;
					while($ror=mysql_fetch_assoc($dor)){
						$code=$ror['Number'];
						$item=$ror['Item'];
						$sale=$ror['Price'];			
						$cost=$ror['Cost'];	
						$qt=$ror['Quantity'];
						$sour=$ror['Source'];
$smin=$ror['Smin'];

	$do=mysql_query("SELECT *FROM `items` WHERE `Status`='0' AND `Number`='$item' ORDER BY `Number` DESC LIMIT $lim");
		$ro=mysql_fetch_assoc($do);
			$iname=$ro['Iname'];
			$kin=$ro['Type'];
			$descri=$ro['Descri'];
			$uno=$ro['Unit'];	
			$qin=$ro['Quantity'];
			$smin=number_format($ro['Smin'], 2);

			$stn="padding:1px;";
			
			$qty=number_format($qt, 2);			$costo=number_format($cost, 2);			$sales=number_format($sale, 2);

$doi=mysql_query("SELECT *FROM `itype` WHERE `Number`='$kin' ORDER BY `Number` ASC");
		$roi=mysql_fetch_assoc($doi);
				$type=$roi['Type'];

				$dox=mysql_query("SELECT *FROM `unit` WHERE `Number`='$uno' ORDER BY `Number` ASC");
					$rox=mysql_fetch_assoc($dox);
							$unit=$rox['Unit'];
				
				if($sour=='1' AND $qin>=$smin){
					$dexi=mysql_query("DELETE FROM `stouse` WHERE `Number`='$code' AND `Voucher`='0' AND `Upda`='0' AND `Source`='1'");
				}
				else{

if($sour=='1')
$smino="&nbsp;&nbsp;&nbsp;&nbsp;<font size='2' style='color:powderblue;'>$smin</font>";
else
$smino="";
							if($cost==$sale)
								$arr="";
							elseif($cost>$sale)
								$arr="<i class='lnr lnr-arrow-down'></i>";
							else
								$arr="<i class='lnr lnr-arrow-up'></i>";
          $to=$sale*$qty;				$too=number_format($to, 2);			$qino=number_format($qin, 2);
		print("<tr><form action='' method='post'>
                        <td class=hidden-xs style='$stn'><div align='center'>$n&nbsp;&nbsp;</td>
						<td style='$stn'> $iname </td><td style='$stn'> $descri </td><td style='$stn'> $type </td>
						<td style='$stn'><div align='right'> $qino&nbsp;/&nbsp;$smin</td>
						<td style='$stn'> $unit </td><td style='$stn'><div align='right'>&nbsp;$costo&nbsp;&nbsp;&nbsp;&nbsp;</td>
						<td><div align='right'><input name='qty' class='form-control' type='text' onChange=this.style.color='#ff3366' onkeyup='format(this);' onkeypress='return isNumberKey(event)' style='text-align:right; width:70px; height:20px; margin:0px 0px 0px 0px; padding:0px 10px 0px 0px;' value='$qty'></td><td><div align='right'><input name='pre' class='form-control' type='text' onkeyup='format(this);' onkeypress='return isNumberKey(event)' onChange=this.style.color='#ff3366' style='text-align:right; width:70px; height:20px; margin:0px 0px 0px 0px; padding:0px 10px 0px 0px;' value='$sales'></td><td><div align='right'>$too</td><td width='1%'>$arr</td>
						
						
						<td class='hidden-xs hidden-print' align='right' style='width:40px; padding:0px;'>
                              <input type='hidden' name='rowid' value='$code'>
                          <button type='submit' class='btn btn-xs btn-warning hidden-print' name='edit' style='height:18px; padding:0px;' title='Click to edit this item' data-toggle='tooltip' data-placement='top'>
						  &nbsp;&nbsp;<i class='lnr lnr-pencil'></i>&nbsp;&nbsp;</button></td></form>
						  
						  <form method=post action=''><td class='hidden-xs hidden-print' align='right' style='width:40px; padding:0px;'>
                              <input type='hidden' name='rowid' value='$code'>
                          <button type='submit' class='btn btn-xs btn-danger hidden-print' name='delo' style='height:18px; padding:0px;' title='Click to delete this item' data-toggle='tooltip' data-placement='top'>
						  &nbsp;&nbsp;<i class='lnr lnr-trash'></i>&nbsp;&nbsp;</button></td></form></tr>");
						  $n++;				$tot+=$to;
				}
						}
						$toto=number_format($tot, 2);			
						?>
						
                    </tbody>

					 <thead>
					<tr><th class="hidden-xs"> </th><th colspan='7'><div align='center'> Grand Total </th>
					<th colspan='2'><div align='right'><?php echo $toto ?></th><th colspan='3'><div align='center'> -- </th></tr>
                  </table><br>

				  <label class="control-label col-md-2"> </label>

				  <form method='post' action=''><label class="control-label col-md-3">
			  <select class="form-control" name="supplier">			
			 <?php
				echo"<option value='' selected='selected'> SELECT DESTINATION </option><option value='PURCHASE'> PURCHASE </option>";
				  $top=mysql_query("SELECT *FROM `suppliers` WHERE `Status`='0' ORDER BY `Supplier` ASC");
						while($rop=mysql_fetch_assoc($top)){
							$sup=$rop['Supplier'];
			echo"<option value='$sup'> $sup </option>";
						}
						
			echo"</select><input type='hidden' name='rowid' value='$code'><input type='hidden' name='tag' value='$tag'>";
			?></label>

	
	<label class="control-label col-md-2"><input name="dato" id="from" class="form-control sm" type="text" style="text-align:center;" VALUE="<?php echo $Date ?>"></label>

			 <label class="control-label col-md-3">
			 <button class="btn btn-md btn-block btn-info" type="submit" name="receive"><i class="lnr lnr-cart"></i> PURCHASE </button>
			 </label></form><form action="" method="post">
			 
			  <label class="control-label col-md-2" style="text-align:right;">
			    <?php
				  if($n>3){
				  echo"<button type='submit' class='btn btn-md btn-danger hidden-print' name='delopur'>
						  &nbsp;&nbsp;<i class='lnr lnr-trash'></i>&nbsp;&nbsp;</button>";
			  }
			  ?>
			  </label></form>

		<?php
				}
					else{
$dore=mysql_query("SELECT *FROM `stouse` WHERE `Status`='0' AND `Voucher`!='0' AND `Action`='PURCHASE' GROUP BY `Voucher` ORDER BY `Voucher` DESC LIMIT 15");
				if($fore=mysql_num_rows($dore)){
					?>
	<div class="divFooter"><center><u><b>PURCHASE REPORT <?php echo $mpri ?></b></u></center></div>
             <div class="row">
            <div class="col-lg-12">
             <span>Total Records Found : <b><?php echo" $fore " ?></b></span>
			 <span class="pull-right hidden-print"><b>MAIN STORE</b>
			 &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer hidden-print"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">
			


		<?php
				echo"<table class='table table-striped'>     
                                      <thead>
                    <tr role='row'>
                     <th class='hidden-xs'> NO </th>
                       <th> Due&nbsp;Date </th>
                        <th> Done&nbsp;By </th>
                       <th> Items </th>
                       <th> Destination </th>
						<th><div align='right'> Total&nbsp;Amount &nbsp;&nbsp;&nbsp;&nbsp; </th>
                        <th class='hidden-xs hidden-print' style='width:40px; text-align:center;' colspan='2'> Options </th>
                     </tr>
                    </thead>
                             <tbody>";
			$tot=0;		$n=1;
		while($rore=mysql_fetch_assoc($dore)){
			$vouch=$rore['Voucher'];
			$dte=$rore['Date'];
			$user=$rore['User'];
			$dest=$rore['Destin'];
			$amo=0;

			$_SESSION['Vouch']=$vouch;
			$stn="padding:1px;";

	$dox=mysql_query("SELECT *FROM `stouse` WHERE `Voucher`='$vouch' AND `Action`='PURCHASE'");
	$fox=mysql_num_rows($dox);
		while($rox=mysql_fetch_assoc($dox)){
						$sale=$rox['Price'];
						$qt=$rox['Quantity'];
			$amo+=($sale*$qt);
		}
		$amoo=number_format($amo);
		echo"<tr>
                        <td class=hidden-xs style='$stn'><div align='center'>$n&nbsp;&nbsp;</td>
						<td style='$stn'> $dte </td><td style='$stn'> $user </td><td style='$stn'> $fox </td><td> $dest </td>
						<td style='$stn'><div align='right'> $amoo &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>";
						?>
						
						
						
					<?php
			echo"<form method='post' action='purdoc.php' target='_blank'>
						<td class='hidden-xs hidden-print' align='right' style='width:40px; padding:0px;'><input type='hidden' name='vous' value='$vouch'>
                          <button type='submit' class='btn btn-xs btn-success hidden-print' name='open' style='height:18px; padding:0px; margin:0px;'>
						  &nbsp;&nbsp;<i class='lnr lnr-download'></i>&nbsp;&nbsp;</td></form>";
					
							echo"<form method=post action=''><td class='hidden-xs hidden-print' align='right' style='width:40px; padding:0px;'>
                              <input type='hidden' name='vous' value='$vouch'><input type='hidden' name='pros' value='$pro'>
                          <button type='submit' class='btn btn-xs btn-danger hidden-print' name='deloq' style='height:18px; padding:0px; margin:0px;'>
						  &nbsp;&nbsp;<i class='lnr lnr-trash'></i>&nbsp;&nbsp;</button></td></form></tr>";
		$tot+=$amo;				$n++;
		}
				$toto=number_format($tot);
			echo"</tbody>

					 <thead>
					<tr><th class='hidden-xs'> </th><th colspan='4'><div align='center'> Grand Total </th>
					<th><div align='right'> $toto &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </th>
					<th class='hidden-xs hidden-print' colspan='2'><div align='center'> -- </th></tr>
                  </table><br>
				  
				  <span class='pull-right hidden-print'>
			 &nbsp;&nbsp;&nbsp;&nbsp;<a href='#' onclick='return window.print()' class='hidden-print' title='Click to print' data-toggle='tooltip' data-placement='top'><i class='lnr lnr-printer'></i></a></span>";
				}
				else{
						echo"<div class='row'>
            <div class='col-lg-12' style='margin-top:-20px;'>
             <span> &nbsp;&nbsp; Purchase Order No : <b> $vou </b></span>
            <div class='widget-container fluid-height clearfix'>
            <div class='widget-content padded clearfix'>
			<br><br><br><br><br><br>
						<div style='text-align:center; font-size:24px; color:#ff9999'> Report not available on selected report </div><br><br><br><br><br><br><br>";
					}
					}
			}
					?>
                                      
                
              </div>
            </div></div>
                  </div>
      
   </div></div></div>  
   <?php
   include'footer.php';
   ?>
