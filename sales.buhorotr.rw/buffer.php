<?php
if(basename($_SERVER['PHP_SELF']) == 'mainsto.php') 
  $pp=" class='current'";
include'header.php';
include'connection.php';
$_SESSION['Dato']="";
$custo='';
$conde='';
$l1=1;
$l2=40;
$lim=2;
$client=$condi='';
$_SESSION['Stok']='S1';

if(isset($_GET['lim']))
		{
			$lim=$_GET['lim'];
			$l1=$l1+(40*$lim);
			$l2=$l2+(40*$lim);
			$lim++;
		}
if(isset($_GET['xlim']))
		{
			$xlim=$_GET['xlim'];
			$l1=$l1+(40*$xlim);
			$l2=$l2+(40*$xlim);
			$xlim--;
		}

if(isset($_POST['delo']))
		{
			$rowid=$_POST['rowid'];
			$custo=$_POST['custo'];
			$then=mysql_query("UPDATE `items` SET `Status`='1' WHERE `Number`='$rowid' LIMIT 1");
		}

if(isset($_POST['search']))
		{
			$custo=$_POST['custo'];
		}
		
		if(isset($_POST['client']))
		{
			$client=$_POST['client'];
		}

	$lim=20;	
		if($custo){
			$conde="AND (`Iname` LIKE '%$custo%' OR `Descri` LIKE '%$custo%' OR `Ecode`='$custo')";
		}
		else{
			$conde='';
		}
		
		if($custo=='*'){
			$conde="";
			$lim=1200;
		}
		
		if($client){
			$conde="AND `Type` = '$client'";
			$lim=1200;
		}

		$do=mysql_query("UPDATE `stouse` SET `Ticked`='0' WHERE `Ticked`!='0'");

$do=mysql_query("SELECT *FROM `items` WHERE `Store`<='2' AND `Status`='0' AND `Daily`>'0' AND (`S1`+`S2`+`S3`)<=`Daily` ORDER BY `Iname` ASC LIMIT $lim");
$fo=mysql_num_rows($do);
?>
<div class="container-fluid main-content">
        <div class="page-title hidden-print">
          <h2 style='margin-top:-20px; margin-bottom: 5px; color:#ffcc33'>
         Main Store
          </h2>
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

 <li class="list-group-item active">
              <a href="buffer.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Buffer &nbsp; Report
                </p>
              </a></li>	
    <?php
}
?>
                       
            </ul><br><br><br>
<center>
<?php
if($_SESSION['Phyc']=='1')
echo"<a href='count.php' class='btn btn-info' style='width:100%'><i class='lnr lnr-layers'>&nbsp;Physical Count</i></a>";
?>
		</center><br>
  <div class="text-success text-center">Use <b>*</b> to display all items</div>
  </div>
                    
           
           
       
        <div class="col-lg-10">
                  <div class="row">
                      
                      <div class="col-lg-1 hidden-print"> </div>
         <form action="" method="post" class="form-horizontal" enctype="multipart/form-data" name='myform'>
           <div class="col-lg-2 hidden-print">  </div>
          
         </form><div class="col-lg-1 hidden-print"> </div>
           

        <form action="" method="post" class="form-horizontal ">                  
                       <div class="col-lg-8 hidden-print"><div class="col-lg-3"> 					
					   
					   </div>
            <div class="col-lg-6"> 
      <input class="form-control"  name="custo" type="text" id="search" autofocus="autofocus" readonly required>
			</div>                      
                       
                       <div class="col-lg-2">
                        <button class="btn  btn-primary btn-block" type="button" name="search" disabled><i class="lnr lnr-magnifier"></i> Search</button>
                   
					  </div>
                         </div> 
                      
                     
                  
            </form> 
             
               
            </div>
             <div class="row">
            <div class="col-lg-12" style='margin-top:-20px;'>
             <span> &nbsp;&nbsp; Total Records Found : <b><?php echo" $fo " ?></b></span><span class="pull-right hidden-print">
			 <a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'>
			 <i class="lnr lnr-printer"></i></a>&nbsp;&nbsp;</span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">
               
                                 <table class="table table-striped table-hover">     
                                      <thead>
                    <tr role="row">
                     <th class="hidden-xs"> No </th>
                       <th> Brand&nbsp;Name </th>
                       <th> Item&nbsp;Name </th>
                        <th> Description </th>
						 <th class='text-center' colspan='2'>&nbsp;&nbsp;&nbsp;&nbsp;Cost/Unit&nbsp;&nbsp;&nbsp;</th>
						 <th class='text-center'> Price </th>
						 
						<?php
						$k=0;				$sto=array();
	$dob=mysqli_query($cons, "SELECT `Store`, `Name` FROM `stores` WHERE `Status`>='0' ORDER BY `Number` ASC");
		while($rob=mysqli_fetch_assoc($dob)){
			$stonum=$rob['Store'];
			$stona=$rob['Name'];
			$k++;
			$sto[$k]=$stonum;
	echo"<th style='width:80px;'><div align='right'>&nbsp;$stona&nbsp;</th>";
		}
				?> 
						 
			<th><div align='center'> TOTAL </th><th colspan='2'><div align='center'>BUFFER </th><th class="hidden-xs" style="width:40px; text-align:center;" colspan='2'> Options </th>
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
			$cost=$ro['Cost'];
			$dail=$ro['Daily'];
			$costo=number_format($cost, 2);			
			$prix=$ro['Price'];					
			$prixo=number_format($prix, 2);

				$stn="padding:2px;";

$doi=mysql_query("SELECT *FROM `itype` WHERE `Number`='$kin' ORDER BY `Number` ASC");
		$roi=mysql_fetch_assoc($doi);
				$type=$roi['Type'];

				$dox=mysql_query("SELECT *FROM `unit` WHERE `Number`='$uno' ORDER BY `Number` ASC");
					$rox=mysql_fetch_assoc($dox);
							$unit=$rox['Unit'];

	/* received and taken items
	$rec=$use=0;
	$dor=mysql_query("SELECT *FROM `stouse` WHERE `Item`='$code' AND `Status`='0' AND `Voucher`!='0' AND `Upda`='1' AND `Date`='$Date' AND (`Action`='RECEIVE' OR `Action`='TAKEN' OR (`Action`='SALES' AND `Invoice`='MAIN STORE')) ORDER BY `Number` DESC");
		while($ror=mysql_fetch_assoc($dor)){
						$act=$ror['Action'];
						$qts=$ror['Quantity'];
if($act=='RECEIVE')
	$rec+=$qts;

if($act=='TAKEN' OR $act=='SALES')
	$use+=$qts;
		}
         $rece=number_format($rec, 2);					$uses=number_format($use, 2);				$open=number_format($qt-$rec+$use, 2);
		*/


		 if($_SESSION['Cancel']){
			 $dbutn='submit';
			 $disa='';
		 }
		 else{
			 $dbutn='button';
			 $disa='disabled';
		 }

					$to=0;
		print("<tr><td class='hidden-xs' style='$stn'><div align='center'>$n&nbsp;&nbsp;</td><td style='$stn'> $type </td>
				<td style='$stn'> $iname </td><td style='$stn'> $descri </td>
                        	<td style='$stn'><div align='right'> $costo </td><td style='$stn'> $unit </td>
                        	<td style='$stn'><div align='right'> $prixo </td>");
			
			for($i=1; $i<=$k; $i++){
				$val=$sto[$i];
				$qt=$ro["$val"];							$qto=number_format($qt, 2);
				echo"<td style='$stn'><div align='right'> $qto </td>";
						$to+=$qt;						
			}
			
			$too=number_format($to, 2);

		print("<td style='$stn'><div align='right'> $too </td><td style='$stn'><div align='right'> $dail </td><td style='$stn' class='hidden-xs hidden-print'>&nbsp;&nbsp;");
				
				
				
				
				echo"<div class='modal fade' id='exampleModal$n' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true' 
		style='top:220px;'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLabel'>DELETE CONFIRMATION 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $iname </h5>

      </div>
      <div class='modal-body' style='height:40px;'>
        <h5 style='color:#ff0033'>Are you sure you want to delete this item?</h5>
      </div><form method='post' action=''><input type='hidden' name='rowid' value='$code'><input type='hidden' name='custo' value='$custo'>
      <div class='modal-footer' style='margin-top:-10px; height:50px; padding-top:5px; border:0px solid blue;'>
        <button type='button' class='btn btn-sm btn-success' data-dismiss='modal'>&nbsp;NO&nbsp;</button>
        <button type='$dbutn' name='delo' class='btn btn-sm btn-danger' $disa>YES</button>
      </div></form>
    </div>
  </div>
</div>";



print("</td>
						   <form method=post action='crete.php'><td class='hidden-xs hidden-print' align='right' style='width:40px; padding:0px;'>
                              <input type='hidden' name='rowid' value='$code'>
                          <button type='submit' class='btn btn-xs btn-warning hidden-print' name='open' style='height:20px; padding:0px; margin-top:5px; margin-botton:2px;' title='Edit' data-toggle='tooltip' data-placement='top'>
						  &nbsp;&nbsp;<i class='lnr lnr-pencil'></i>&nbsp;&nbsp;</button></td></form>
						  
						  <form method=post action=''><td class='hidden-xs hidden-print' align='right' style='width:40px; padding:0px;'>
						   <div title='Delete' data-toggle='tooltip' data-placement='top'>
                              <input type='hidden' name='rowid' value='$code'><input type='hidden' name='custo' value='$custo'>

						  <button type='button' class='btn btn-xs btn-danger hidden-print' style='height:20px; padding:0px; margin-top:2px; margin-botton:2px;' data-placement='top' data-toggle='modal' data-target='#exampleModal$n' $disa>
						  &nbsp;&nbsp;<i class='lnr lnr-trash'></i>&nbsp;&nbsp;</button></div></td></form></tr>");
						  $n++;
						}
						$toto=number_format($tot);			$tco=number_format($tco);
						?>
						
                    </tbody>
                  </table>

					 <div class="col-md-12"><hr>
                  <div class="pull-right">
                 <span class="pull-right hidden-print">
			 <a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'>
			 <i class="lnr lnr-printer"></i></a>&nbsp;&nbsp;</span>
              </div></div>

                  </div>                     
                
              </div>
            </div></div>
                  </div>
      
   </div></div></div>  
   <?php
   include'footer.php';
   ?>
