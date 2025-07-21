<?php
if(basename($_SERVER['PHP_SELF']) == 'taken.php') 
  $pp=" class='current'";
include'connection.php';
$custo='';
$conde='';
$spto=0;
$t=0;

	// stock transfer
if(isset($_POST['trans']) AND $_POST['form_token'] == $_SESSION['form_token'])
		{
		
			$fsto=$_POST['fsto'];
			$tsto=$_POST['tsto'];
				$plate=str_replace("'", "`", $_POST['plate']);
				$locat=str_replace("'", "`", $_POST['locat']);
			    $comme=str_replace("'", "`", $_POST['comme']);
	
        $rece=mysql_query("SELECT `Voucher` FROM `stouse` WHERE `Voucher`!='0' ORDER BY `Voucher` DESC LIMIT 1");
				$re=mysql_fetch_assoc($rece);
					$vou=$re['Voucher']+1;
					    $pr=$fp=0;
			
			if($fsto==$tsto){
			    $spto=10;
			}
			else{
			    $spto=40;
		
		for($a=1; $a<=5; $a++){
		    	$ito=$_POST["ito$a"];
			$qto=str_replace(',', '', $_POST["qto$a"]);
	$dobi=mysqli_query($cons, "SELECT `Number`, `Cost`, `Price`, `$fsto` FROM `items` WHERE `Status`='0' AND `Iname`='$ito' ORDER BY `Number` ASC");
	if($fobi=mysqli_num_rows($dobi)){
		$robi=mysqli_fetch_assoc($dobi);
		    $item=$robi['Number'];
		    $cost=$robi['Cost'];
		    $prix=$robi['Price'];
		  if($robi["$fsto"]<$qto){
		     $spto++;
		  }
		  else{
			$action='TRANSFER';
			$cprint='DEL';
					
		    $doin=mysql_query("UPDATE `items` SET `$tsto`=`$tsto`+'$qto' WHERE `Number`='$item' ORDER BY `Number` ASC LIMIT 1");
		    
		    $doout=mysql_query("UPDATE `items` SET `$fsto`=`$fsto`-'$qto' WHERE `Number`='$item' ORDER BY `Number` ASC LIMIT 1");
		    
	$then=mysql_query("INSERT INTO `stouse` (`Date`, `Time`, `User`, `Item`, `Cost`, `Quantity`, `Price`, `Action`, `Destin`, `Voucher`, `Invoice`, `Status`, `Upda`, `Person`, `Comment`, `Otype`, `Closing`, `Source`, `Edite`, `Store`, `Paid`, `Ticked`, `Branche`, `Printed`, `Requis`, `Sales`, `Client`, `Plate`, `Location`) VALUES ('$Date', '$Time', '$loge', '$item', '$cost', '$qto', '$prix', 'TRANSFER', '$tsto', '$vou', '', '0', '1', '', '$comme', '', '0', '0', '0', '$fsto', '0', '0', '1', '0', '0', '$prix', '0', '$plate', '$locat')");
	$pr++;
		  }
	}
	else
	    $fp++;
		}
			}
			if($fp==5)
			    $spto=30;
			else{
		if($pr){   
		   $spto=20;
	include'creceipt.php';  
		}  
		    
	}
	    	}
	    	
	    	// Close the current chart
		if(isset($_POST['receive']))
		{
			$supplier=$_POST['supplier'];
			$dato=$_POST['dato'];
			$taker=$_POST['taker'];
			$otype=$_POST['otype'];
			$comment=$_POST['comment'];
			$store=$_POST['store'];
			$comment=str_replace("'", "`", $comment);
			
	$rece=mysql_query("SELECT `Voucher` FROM `stouse` WHERE `Voucher`!='0' ORDER BY `Voucher` DESC LIMIT 1");
			$re=mysql_fetch_assoc($rece);
				$vou=$re['Voucher']+1;
			$action='RECEIVE';
			$cprint='DEL';
				
	$so=mysql_query("UPDATE `stouse` SET `Date`='$dato', `Time`='$Time', `Destin`='$supplier', `Voucher`='$vou', `Invoice`='MAIN STORE', `Person`='$taker', `Comment`='$comment', `Otype`='$otype', `Store`='$store' WHERE `Status`='0' AND `Voucher`='0' AND `Action`='TAKEN'");

				// Update quantity when there is any stock taken *****************************************************
   $recex=mysql_query("SELECT *FROM `stouse` WHERE `Action`='TAKEN' AND `Voucher`='$vou' AND `Upda`='0' AND `Status`='0' ORDER BY `Voucher` DESC LIMIT 60");
   if($fecex=mysql_num_rows($recex)){
				while($rex=mysql_fetch_assoc($recex)){
					$nuo=$rex['Number'];
					$ito=$rex['Item'];
					$qto=$rex['Quantity'];
					$dest=$rex['Destin'];
					$stor=$rex['Store'];

$dow=mysql_query("UPDATE `items` SET `$stor`=`$stor`-'$qto', `Star`=`Star`+'1' WHERE `Number`='$ito' ORDER BY `Number` ASC LIMIT 1");
		

			$dova=mysql_query("SELECT *FROM `items` WHERE `Number`='$ito' ORDER BY `Number` DESC LIMIT 1");
				$rova=mysql_fetch_assoc($dova);
						$qty=$rova["$stor"];
	$thent=mysql_query("UPDATE `stouse` SET `Upda`='1', `Closing`='$qty' WHERE `Number`='$nuo' ORDER BY `Number` ASC LIMIT 1");
				}
   }
	include'creceipt.php'; 
		}
		

include'header.php';

// delete item from a given chart
if(isset($_POST['delo']))
		{
			$rowid=$_POST['rowid'];
			$then=mysql_query("DELETE FROM `stouse` WHERE `Number`='$rowid' LIMIT 1");
		}

// delete all items from a given chart
if(isset($_POST['delox']))
		{
			$then=mysqli_query($cons, "DELETE FROM `stouse` WHERE `Action`='TAKEN' AND `Voucher`='0' LIMIT 100");
		}

// edit an item from a given chart
if(isset($_POST['edit']))
		{
			$rowid=$_POST['rowid'];
			$qty=$_POST['qty'];
				$qty=str_replace(',', '', $qty);
			$then=mysql_query("UPDATE `stouse` SET `Quantity`='$qty' WHERE `Number`='$rowid' LIMIT 1");
		}

// Search for an item to be added to the chart
if(isset($_POST['search']))
		{
			$custo=$_POST['custo'];
			$t=1;
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
		$so=mysql_query("INSERT INTO `stouse` (`Number`, `Date`, `Time`, `User`, `Item`, `Cost`, `Quantity`, `Price`, `Action`, `Destin`, `Voucher`, `Status`) VALUES (NULL, '$Date', '$Time', '$loge', '$item', '$cost', '$qty', '$pri', 'TAKEN', '', '0', '0')");
			$n--;
			}
		}

		// edit a given voucher from delivery report
if(isset($_POST['edivo']))
		{
			$vous=$_POST['vous'];

			// Update quantity for items that were taken *****************************************************
   $rece=mysql_query("SELECT *FROM `stouse` WHERE `Action`='TAKEN' AND `Voucher`='$vous' AND `Upda`='1' AND `Status`='0' ORDER BY `Number` DESC");
   if($fece=mysql_num_rows($rece)){
				while($re=mysql_fetch_assoc($rece)){
					$nuo=$re['Number'];
					$ito=$re['Item'];
					$qto=$re['Quantity'];
					$dest=$re['Destin'];
					$stor=$re['Store'];

	$do=mysql_query("UPDATE `items` SET `$stor`=`$stor`+'$qto' WHERE `Number`='$ito' ORDER BY `Number` ASC LIMIT 1");
		
	$then=mysql_query("UPDATE `stouse` SET `Voucher`='0', `Upda`='0', `Closing`='0' WHERE `Number`='$nuo' ORDER BY `Number` ASC LIMIT 1");
				}
   }
		}

	if($custo){
			$conde="AND (`Iname` LIKE '%$custo%' OR `Descri` LIKE '%$custo%' OR `Ecode`='$custo')";
			$lim=100;
		}
		else{
			$conde='';
			$lim=140;
		}

		$rece=mysql_query("SELECT `Voucher` FROM `stouse` WHERE `Voucher`!='0' ORDER BY `Voucher` DESC LIMIT 1");
				$re=mysql_fetch_assoc($rece);
					$vou=$re['Voucher']+1;
	
?>
<div class="container-fluid main-content">
        <div class="page-title">
          <h2 style='margin-top:-20px; margin-bottom: 5px; color:#ffcc33'>
         Main Store
          </h2>
                 </div>

<style type="text/css" media="screen">
 .hiddenDiv {
 display: none;
 }
 .visibleDiv {
 display: block;
 border: 1px grey solid;
 margin-top: 5px;
  margin-bottom: 0px;
   padding-top: 5px;
    padding-bottom: 5px;
 }
 </style>
     
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
              
			      <?php
			      if($_SESSION['Aco']){
			          echo"<a href='purcha.php'>";
			}
			else{
			   
			          echo"<a href='#'>";
			}
			?>
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Purchase Orders
				<?php
				if($pfuquo)
					echo"<span class='badge' style='float:right; font-size:12px; margin-right:0px; margin-top:0px; height:18px; background-color:#ff66cc; width:26px;'> $pfuquo </span>";
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
			  <li class="list-group-item active">
              <a href="taken.php">
                <p>
                <i class="lnr lnr-circle-minus"></i>&nbsp;Stock &nbsp; Delivery
                </p>
              </a></li>    
<?php
}
if($_SESSION['Spay']){
    ?>
			  <li class="list-group-item">
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
                    
           
           
       
        <div class="col-lg-10">
                  <div class="row">
                      
                      
                      
                      
                      
                      
       <?php                
       if($spto==10)
echo"<center><div class='alert alert-warning' style='width:88%; text-align:center;float:center; border-radius:5px; height:30px; padding:5px;'>
		<i class='lnr lnr-sad'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>&times;</button>You cannot transfer in the same store. </div></center>"; 
		
		
       if($spto==30)
echo"<center><div class='alert alert-danger' style='width:88%; text-align:center;float:center; border-radius:5px; height:30px; padding:5px;'>
		<i class='lnr lnr-sad'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>&times;</button>All items was not found, please try again. </div></center>"; 
		
		              
       if($spto>40)
echo"<center><div class='alert alert-danger' style='width:88%; text-align:center;float:center; border-radius:5px; height:30px; padding:5px;'>
		<i class='lnr lnr-sad'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>&times;</button>Store quantity is bellow, please verify. </div></center>";
		              
       if($spto==20)
echo"<center><div class='alert alert-success' style='width:88%; text-align:center;float:center; border-radius:5px; height:30px; padding:5px;'>
		<i class='lnr lnr-checkmark-circle'></i> &nbsp;&nbsp; <button class='close' data-dismiss='alert' type='button'>&times;</button>Item is transfered successfully. </div></center>"; 
		?>
                      
                      
                      
         
                      
     <?php
if($_SESSION['Asd']){
    ?>                 
                      
    <div class='modal fade text-left' id='exampleModal91' style='top:40px;'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content' style='border-radius:5px;'>
      <div class='modal-header' style='border-radius:5px;'>
    <h5 class='modal-title'>STOCK TRANSFER </h5></div>
    <form action="" method="post">
      <div class='modal-body' style='height:auto; padding:20px; height:340px;'>
        <div class="form-group">
            
            <?php
            for($a=1; $a<=5; $a++){
                if($a==1)
            $re="required";
                else
            $re="";
    echo"<div class='col-lg-8 hidden-print' style='margin-top:2px;'> 
      <input class='form-control' name='ito$a' type='text' list='searchs' placeholder='Item $a' style='height:28px;' $re>
      <datalist id='searchs'>";
       	
		 $dobi=mysqli_query($cons, "SELECT `Iname` FROM `items` WHERE `Status`='0' ORDER BY `Iname` ASC");
		while($robi=mysqli_fetch_assoc($dobi)){
			$item=$robi['Iname'];
    	echo"<option value='$item'>";
		    }
		
          echo"</datalist></div>
			
		<div class='col-md-4 col-sm' align='right' style='margin-top:2px;'>
		<input name='qto$a' class='form-control text-center' type='text' onkeyup='format(this);' onkeypress='return isNumberKey(event)' placeholder='Quantity' onfocus=this.value='' style='height:28px;' $re></div>";
            }
            ?>
		
		
		</div>
		<div class="row"> &nbsp; </div><br>
		
		<div class="col-sm-12 text-center" style="border:1px solid #00ffff; padding-left:0px; padding-right:0px; height:90px;
			 margin-bottom:0px; border-radius:5px; padding-top:10px;">
	
	<div class="form-group">	
		<div class='col-md-6 col-sm'> 
		<select class='form-control' name='fsto' required>
		<option value=''> FROM STORE </option>
		<?php
		 $dob=mysqli_query($cons, "SELECT *FROM `stores` WHERE `Status`>='0' ORDER BY `Number` ASC");
		while($rob=mysqli_fetch_assoc($dob)){
			$stonum=$rob['Store'];
			$stona=$rob['Name'];
	echo"<option value='$stonum'> &nbsp; $stona </option>";
		}
		?></select></div>
			
		<div class='col-md-6 col-sm'>
		    <select class='form-control' name='tsto' required>
		<option value=''> TO STORE </option>
		<?php
		 $dobs=mysqli_query($cons, "SELECT *FROM `stores` WHERE `Status`>='0' ORDER BY `Number` ASC");
		while($robs=mysqli_fetch_assoc($dobs)){
			$stonum=$robs['Store'];
			$stona=$robs['Name'];
	echo"<option value='$stonum'> &nbsp; $stona </option>";
		}
		?></select></div>
        
        
<div class='col-md-6 col-sm' style='margin-top:5px;'><input class="form-control form-center text-info" name="plate" type="text" placeholder="Plate No" OnKeyup='return cUpper(this);'></div>
<div class='col-md-6 col-sm' style='margin-top:5px;'><input class="form-control text-info" name="locat" type="text" placeholder="Location"></div></div>	

<div id='toggleText' style='display: none;'><br><br>
<div class="col-md-2" style="padding-top:0px;"> </div>
<div class="col-md-10" style='margin-top:10px;'><textarea name="comme" class="form-control" style="margin:0px;" placeholder="Reference/Comment"></textarea></div></div><div class="row"> </div>
		
      </div></div>
      
                <?php
        $form_token = uniqid();
        $_SESSION['form_token'] = $form_token;
  	  echo"<input type='hidden' name='form_token' value='$form_token'>";
			 ?>

      <div class='modal-header text-right' style='padding-top:10px; height:50px; border:0px solid blue; margin-top:20px;'>
          
          <button type='button' class='btn btn-sm btn-default pull-left' name='button' title='Add Comment' data-toggle='tooltip' data-placement='top' onclick="javascript:toggle();">&nbsp;&nbsp;<i class='lnr lnr-pencil'></i>&nbsp;&nbsp;</button>
          
        <button type='button' class='btn btn-sm btn-warning' data-dismiss='modal' style='width:80px;'>&nbsp;CANCEL&nbsp;</button>
        <button type='submit' name='trans' class='btn btn-sm btn-success' style='width:80px;'><i class='lnr lnr-checkmark-circle'></i> SAVE </button>
      </div></form>
    </div>
  </div>
</div>
<?php
}
?>
         
         <div class="col-lg-1"> </div>
           <div class="col-lg-2"> <button class='btn btn-sm btn-info btn-block' style='font-size:14px; padding-top:0px; padding-bottom:0px;' type='button' data-toggle='modal' data-target='#exampleModal91'>
						<i class='lnr lnr-car'></i> STOCK TRANSFER </button></div>
          <div class="col-lg-1"> </div>
         
           
<?php
if($_SESSION['Asd']){
    ?>
        <form action="" method="post" class="form-horizontal ">                  <?php
}
?>
                       <div class="col-lg-8 no-print"><div class="col-lg-3"> 					
					   
					   </div>
            <div class="col-lg-6"> 
      <input class="form-control" name="custo" type="text" id="searchu" autofocus="autofocus" required>
			</div>                      
                       
                       <div class="col-lg-2">
                        <button class="btn  btn-primary btn-block" type="submit" name="search"><i class="lnr lnr-magnifier"></i> Search</button>
                   
					  </div>
                         </div> 
                      
                     
                  
            </form> 
             
               
            </div>
               <?php
			   if($t==1){
		$do=mysql_query("SELECT *FROM `items` WHERE `Store`<='2' AND `Status`='0' $conde ORDER BY `Number` DESC LIMIT $lim");
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
                     <th class="hidden-xs"> No </th>
                       <th> Brand&nbsp;Name </th>
                       <th> Item&nbsp;Name </th>
                        <th> Description </th>
             <th colspan='2'>&nbsp;&nbsp;Qty&nbsp;In&nbsp;/&nbsp;Unit </th>
					<th> Cost&nbsp;Price </th>
                        <th><div align='center'> Quantity </th>
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
$store=$ro['Store'];			
if($store=='1')		
	$cost=$ro['Cost'];
else
	$cost=$ro['Price'];
	
$costo=number_format($cost, 2);

			$qt=$ro['S1']+$ro['S2']+$ro['S3'];	
			$qty=number_format($qt, 2);

$doi=mysql_query("SELECT *FROM `itype` WHERE `Number`='$kin' ORDER BY `Number` ASC");
		$roi=mysql_fetch_assoc($doi);
				$type=$roi['Type'];

				$dox=mysql_query("SELECT *FROM `unit` WHERE `Number`='$uno' ORDER BY `Number` ASC");
					$rox=mysql_fetch_assoc($dox);
							$unit=$rox['Unit'];
          $b=$n*10;
          		
	 if($_SESSION['Aco']!='1'){
				    $costo="******&nbsp;&nbsp;";
			    $dsa="readonly";
			    $typ="password";
				    $id="";
				}
				else{
				    $costo=number_format($cost, 2);
				    $id="id='result$n'";
				    $dsa="";
				    $typ="text";
				}
		print("<tr><td class=hidden-xs><div align='center'>$n&nbsp;&nbsp;</td><td> $type </td><td> $iname </td><td> $descri </td><td><div align='right'> $qty </td><td> $unit </td>
				<td><input name='pri$n' class='form-control' type='$typ' onkeyup='multiplyBy$n();' onkeypress='return isNumberKey(event)' style='text-align:right; width:130px; height:24px;' id='box$b' value='$cost' $dsa></td>
				<td><input name='qty$n' class='form-control' type='text' onkeyup='multiplyBy$n();' onkeypress='return isNumberKey(event)' style='text-align:right; width:120px; height:24px; margin:0px 0px 0px 0px' id='box$n'></td>
				<td class='hidden-xs hidden-print' width='10%'><div align='right' style='border:1px solid #cccccc; width:120px; height:24px; border-radius:5px; padding:0px 10px 0px 0px;'><input type='hidden' name='item$n' value='$code'>
						<span class='dollars' style='text-align:right; width:130px; height:24px; font-size:18px; color:#66cccc; float:center; text-align:right;' $id onchange='format(this);'></span></div><input type='hidden' name='cost$n' value='$cost'></td></tr>");
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
             <span> &nbsp;&nbsp; Store Voucher No : <b> $vou </b></span>
            <div class='widget-container fluid-height clearfix'>
            <div class='widget-content padded clearfix'>
			<br><br><br><br><br><br>
						<div style='text-align:center; font-size:24px; color:#ff3333'> Item not found found for your search [$custo] </div><br><br><br><br><br><br><br>";
					}  
			}
				   else{
		$dor=mysql_query("SELECT *FROM `stouse` WHERE `Status`='0' AND `Voucher`='0' AND `Action`='TAKEN' ORDER BY `Number` DESC");
				if($for=mysql_num_rows($dor)){
			  $click=0;
?>
 <div class="row">
            <div class="col-lg-12" style='margin-top:-20px;'>
             <span> &nbsp;&nbsp; Delivery Voucher No : <b><?php echo" $vou " ?></b></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">

<table class="table table-striped">     
                                      <thead>
                    <tr role="row">
                     <th class="hidden-xs"> No </th>
                       <th> Brand&nbsp;Name </th>
                       <th> Item&nbsp;Name </th>
                        <th> Description </th>
        <th colspan='2'>&nbsp;&nbsp;Qty&nbsp;In&nbsp;/&nbsp;Unit</th>
						 <th> Cost&nbsp;Price </th>
                        <th><div align='center'> Quantity </th>
						<th>Total&nbsp;Amount</th>
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
						$dst=$ror['Destin'];
						$dte=$ror['Date'];
						$pers=$ror['Person'];
						$stor=$ror['Stor'];
$pri=$ror['Price'];
	$do=mysql_query("SELECT *FROM `items` WHERE `Status`='0' AND `Number`='$item' ORDER BY `Number` DESC LIMIT $lim");
		$ro=mysql_fetch_assoc($do);
			$iname=$ro['Iname'];
			$kin=$ro['Type'];
			$descri=$ro['Descri'];
			$uno=$ro['Unit'];	
			$qin=$ro['S1']+$ro['S2']+$ro['S3'];
			
			$qty=number_format($qt, 2);			$costo=number_format($cost, 2);				$prio=number_format($pri, 2);			

$doi=mysql_query("SELECT *FROM `itype` WHERE `Number`='$kin' ORDER BY `Number` ASC");
		$roi=mysql_fetch_assoc($doi);
				$type=$roi['Type'];

				$dox=mysql_query("SELECT *FROM `unit` WHERE `Number`='$uno' ORDER BY `Number` ASC");
					$rox=mysql_fetch_assoc($dox);
							$unit=$rox['Unit'];
							if($cost==$sale)
								$arr="";
							elseif($cost>$sale)
								$arr="<i class='lnr lnr-arrow-down'></i>";
							else
								$arr="<i class='lnr lnr-arrow-up'></i>";
          $to=$pri*$qt;				$too=number_format($to, 2);			$qino=number_format($qin, 2);

		  if($qin<$qt){
			  $stl="style='color:#ff3333;'";
			  $click++;
		  }
		  else{
			  $stl='';
		  }
		  
		   if($_SESSION['Aco']){
	     $prio=number_format($pri, 2);
	     $too=number_format($to, 2);	 
	     }
	     else{
	        $prio="******&nbsp;&nbsp;";
	        $too="******&nbsp;&nbsp;";
	     }
	     
		print("<tr><form action='' method='post'>
                        <td $stl class=hidden-xs><div align='center'>$n&nbsp;&nbsp;</td><td $stl> $type </td>
						<td $stl> $iname </td><td $stl> $descri </td><td $stl><div align='right'> $qino </td>
						<td $stl> $unit </td><td $stl><div align='right'>&nbsp;$prio&nbsp;&nbsp;&nbsp;&nbsp;</td>
						<td $stl><div align='right'><input name='qty' class='form-control' type='text' onkeyup='format(this);' onkeypress='return isNumberKey(event)' onChange=this.style.color='#ff3366' style='text-align:right; width:80px; height:24px; margin:0px 0px 0px 0px;' value='$qty'></td><td $stl><div align='right'>$too</td>
						
						
						<td class='hidden-xs hidden-print' align='right' style='width:40px; padding:0px;'>
                              <input type='hidden' name='rowid' value='$code'>
                          <button type='submit' class='btn btn-xs btn-warning hidden-print' name='edit' style='height:18px; padding:0px;' title='Edit' data-toggle='tooltip' data-placement='top'>
						  &nbsp;&nbsp;<i class='lnr lnr-pencil'></i>&nbsp;&nbsp;</button></td></form>
						  
						  <form method=post action=''><td class='hidden-xs hidden-print' align='right' style='width:40px; padding:0px;'>
                              <input type='hidden' name='rowid' value='$code'>
                          <button type='submit' class='btn btn-xs btn-danger hidden-print' name='delo' style='height:18px; padding:0px;' title='Delete' data-toggle='tooltip' data-placement='top'>
						  &nbsp;&nbsp;<i class='lnr lnr-trash'></i>&nbsp;&nbsp;</button></td></form></tr>");
						  $n++;				$tot+=$to;
						}
						$toto=number_format($tot, 2);			
						?>
						
                    </tbody>

					 <thead>
					<tr><th class="hidden-xs"> </th><th colspan='5'><div align='center'> Grand Total </th>
					<th colspan='3'><div align='right'><?php echo $toto ?></th><th colspan='2'><div align='center'> -- </th></tr>
                  </table><br>
		
			<label class="control-label col-md-1"> </label>

				  <form method='post' action=''><label class="control-label col-md-3">
			  <select class="form-control" name="supplier" onchange='showDiv(this.value);' onclick="return pageScroll()" required>			
			 <?php
				if($dst=='DAMAGED/EXPIRIES')
					$d='selected';
				else
					$d='';
					
				if($dst=='PERSONAL USE')
					$u='selected';
				else
					$u='';
					
				if($dst=='GIFT')
					$g='selected';
				else
					$g='';
					
				if($dst=='DDC SHOP')
					$c='selected';
				else
					$c='';
					
				if($dst=='OTHER')
					$o='selected';
				else
					$o='';

				if($dst=='')
					$dte=$Date;

				echo"<option value='' selected='selected'> SELECT DESTINATION </option>
				<option value='DAMAGED/EXPIRIES' $d> DAMAGED/EXPIRIES </option>
				
				<option value='PERSONAL USE' $u> PERSONAL USE </option>
				<option value='OTHER' $o> OTHER </option>";
			?>			    
            </select></label>

	<label class="control-label col-md-5"><label class="control-label col-md-5">
<input list="take" name="taker" class="form-control" placeholder="TAKEN BY" OnKeyup="return cUpper(this);" required>
<datalist id="take">
 <?php
			 $top=mysql_query("SELECT `Person` FROM `stouse` WHERE `Status`='0' AND `Person`!='' GROUP BY `Person` ORDER BY `Date` DESC LIMIT 10");
						while($rop=mysql_fetch_assoc($top)){
							$sup=$rop['Person'];
				if($pers==$sup)
					$t='selected';
				else
					$t='';
			echo"<option value='$sup' $t>";
						}
						?>
	</datalist></label>
		<label class="control-label col-md-4">
		<select class='form-control' name='store' style="padding-left:5px; padding-right:5px;" required><option value=''> STORE </option>
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
		</select></label>

	<label class="control-label col-md-3"><input name="dato" id="from" class="form-control sm" type="text" style="text-align:center; width:100px;" VALUE="<?php echo $dte ?>" onclick="return pageScroll()"></label></label>
<?php
		if($click=='0'){
			$btl='submit';
$tle="title='Save' data-toggle='tooltip' data-placement='top'";
}
	else{
		$btl="button";
		$tle="title='Some items are missing in your store' data-toggle='tooltip' data-placement='top'";
	}
	?>
			 <label class="control-label col-md-2">
			 <button class="btn btn-md btn-block btn-info" type="<?php echo $btl ?>" name="receive" <?php echo $tle ?>>
			 <i class="lnr lnr-plus-circle"></i> DELIVER </button>
			 </label>
			 
			  <label class="control-label col-md-1" style="text-align:right;">
			    <?php
				  if($n>3){
				  echo"<button type='submit' class='btn btn-md btn-danger hidden-print' name='delox' title='Remove All' data-toggle='tooltip' data-placement='top'>&nbsp;&nbsp;<i class='lnr lnr-trash'></i>&nbsp;&nbsp;</button>";
			  }
			  ?>
			  </label>

		<?php
				}
					else{
						echo"<div class='row'>
            <div class='col-lg-12' style='margin-top:-20px;'>
             <span> &nbsp;&nbsp; Delivery Voucher No : <b> $vou </b></span>
            <div class='widget-container fluid-height clearfix'>
            <div class='widget-content padded clearfix'>
			<br><br><br><br><br><br>
						<div style='text-align:center; font-size:24px; color:#ff9999'>Load items to be delivered </div><br><br><br><br><br><br><br>";
					}
			}
					?>
                                      
                
              </div>
            </div></div>
                  </div>

				  <div id="DAMAGED/EXPIRIES" class="hiddenDiv" style="border:0px; height:32px; margin:0px; padding:0px; text-align='right'"><br>
		 <label class="control-label col-md-2"> </label>

		 <label class="control-label col-md-2 pull-right"><br><br><div class="form-check"> 
		 <input type="radio" name="otype" value="DAMAGED" class="form-check-input">&nbsp;<font color='#ff0033'>Damaged</font>
		 <br><br><input type="radio" name="otype" value="EXPIRED" class="form-check-input" checked>&nbsp;<font color='#ff66cc'>Expired</font>
		 </div></label>

		  <label class="control-label col-md-8"> &nbsp;&nbsp;&nbsp;&nbsp; <font color="#0033ff">Write comment here &nbsp; &#9660;</font>
		<textarea  class="form-control" name="comment" rows="4" cols="80"> </textarea>
			</label>
				  </div>
      </form>
   </div></div></div>  
   <?php
   include'footer.php';
   ?>
