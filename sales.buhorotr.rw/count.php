<?php
if(basename($_SERVER['PHP_SELF']) == 'count.php') 
  $pp=" class='current'";
include'header.php';
include'connection.php';
$_SESSION['Dato']="";
$_SESSION['Stor']="";
$custo='';
$conde='';

if(isset($_POST['adjust']))
		{
			$custo=$_POST['custo'];
			$qts=$_POST['qts'];
			$stor=$_POST['store'];
$see=mysql_query("SELECT `Number`, `$stor` FROM `items` WHERE `Iname`='$custo' AND `Status`='0' LIMIT 1");
$ree=mysql_fetch_assoc($see);
$nuo=$ree['Number'];
$qtin=$ree["$stor"];
	$so=mysql_query("UPDATE `items` SET `$stor`=`$stor`+'$qts' WHERE `Iname`='$custo' AND `Status`='0' LIMIT 1");
$soso=mysql_query("INSERT INTO `count` (`Number`, `Item`, `Qtin`, `Qton`, `Date`, `User`, `Store`) VALUES (NULL, '$nuo', '$qtin', '$qts', '$Date', '$loge', '$stor')");
		}


if(isset($_POST['resetall']))
		{
			$passkey=md5($_POST['passkey']);
$store=$_POST['store'];
$che=mysql_query("SELECT *FROM `employees` WHERE `Password`='$passkey' AND `Currentp`='5' LIMIT 1");
if($fe=mysql_num_rows($che))
			$so=mysql_query("UPDATE `items` SET `$store`='0' WHERE `Iname`!='' AND `Status`>='0' AND `Direct`='$store' LIMIT 1000");
else
$pto=3669;
		}

		
		if($custo){
			$conde="AND (`Iname` LIKE '%$custo%' OR `Descri` LIKE '%$custo%')";
		}
		else{
			$conde='';
		}

$do=mysql_query("SELECT *FROM `items` WHERE `Store`<='2' AND `Status`='0' $conde ORDER BY `Iname` ASC LIMIT 1400");
$fo=mysql_num_rows($do);
?>
<div class="container-fluid main-content">
        <div class="page-title hidden-print">
          <h2 style='margin-top:-20px; margin-bottom: 5px; color:#ffcc33'>
         Main Store
          </h2>
                 </div>

<script>
$(document).ready(function(){
  var show_btn=$('.show-modal');
  var show_btn=$('.show-modal');
  //$("#testmodal").modal('show');
  
    show_btn.click(function(){
      $("#testmodal").modal('show');
  })
});

$(function() {
        $('#element').on('click', function( e ) {
            Custombox.open({
                target: '#testmodal-1',
                effect: 'fadein'
            });
            e.preventDefault();
        });
    });
</script>
     
        <div class="row">
  <div class="col-lg-2 hidden-print">
   
   <ul class="list-group">

   

    <li class="list-group-item active">
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
			      if($_SESSION['Acrepo']){
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
                  
			  <li class="list-group-item">
              <a href="receive.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Receive Items
                </p>
              </a></li>
			  
			   <li class="list-group-item">
              <a href="taken.php">
                <p>
                <i class="lnr lnr-circle-minus"></i>&nbsp;Stock &nbsp; Delivery
                </p>
              </a></li>	   
<?php
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
?>
			  
			   <li class="list-group-item">
              <a href="counting.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Inventories List
                </p>
              </a></li> <li class="list-group-item">
              <a href="config.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Monthly Inventories
                </p>
              </a></li> 
                       
            </ul><br><br>
<center>
			<a href="count.php" class="btn btn-info" style="width:100%"><i class="lnr lnr-layers">&nbsp;Physical Count</i></a>
			</center><br>
  <div class="text-success text-center">This operation will increase or descrease quantity accordingly.</div>

  </div>
                    
           
           
       
        <div class="col-lg-10">
                  <div class="row">
         
           <div class="col-lg-2 hidden-print"> </div>
          
         
           

        <form action="" method="post" class="form-horizontal ">                  
                       <div class="col-lg-10 hidden-print">
            <div class="col-lg-4 hidden-print"> 
      <input class="form-control"  name="custo" type="text" id="searchs" autofocus="autofocus" required>
			</div>  

		 <div class="col-lg-2 hidden-print">
		 <input name='qts' class='form-control sm' type='text' style='text-align:center;' placeholder='Quantity'>
		 </div>
		 
		 <div class="col-md-2 hidden-print">
		<select class='form-control' name='store' required><option value=''> STORE </option>
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
		</select></div>
                    
                       
                       <div class="col-lg-2 hidden-print">
                        <button class="btn  btn-primary btn-block" type="submit" name="adjust"><i class="lnr lnr-checkmark-circle"></i> Adjust </button>
                   
					  </div>

<div class="col-lg-1">
                    
<div id="element" class="btn btn-danger show-modal"><i class="lnr lnr-cross-circle"></i> Reset All </div>
                   
					  </div>
                         </div> </div>
                      
                     
                  
          </form> 

<form action='' method='post'>
<div id="testmodal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Reset Confirmation</h4>
            </div>
            <div class="modal-body">
<div class="col-lg-6"> 
             <select class="form-control" name="store" required><option value='' selected='selected'> SELECT STORE </option>
             <?php
              $dobs=mysqli_query($cons, "SELECT *FROM `stores` WHERE `Status`>='0' ORDER BY `Number` ASC");
		while($robs=mysqli_fetch_assoc($dobs)){
			$stonum=$robs['Store'];
			$stona=$robs['Name'];
	echo"<option value='$stonum'> &nbsp; $stona </option>";
		}
		?>
</div>
<div class="col-lg-6"> 
		 <input name='passkey' class="form-control sm" type='password' style='text-align:center;' placeholder="Enter your password" required>
	</div>	
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" style="width:90px;">Close</button>
                <button type="submit" name='resetall' class="btn btn-primary"  style="width:90px;">Reset All</button>
            </div>
        </div>
    </div>
</div>
</form>
             
			<div class="divFooter"><center><u><b>MAIN STORE REPORT </b></u></center></div>

             <div class="row">
            <div class="col-lg-12" style='margin-top:-20px;'>
             <span> &nbsp;&nbsp; Total Records Found : <b><?php echo" $fo " ?></b></span>
			 <span class="pull-right hidden-print">&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
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
						 
						 <th colspan='2'><div align='center'>&nbsp;TOTAL&nbsp;&nbsp;&nbsp;</th></tr>
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
			$cost=$ro['Cost'];											$costo=number_format($cost, 2);			
			$prix=$ro['Price'];											$prixo=number_format($prix, 2);

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

		print("<td style='$stn'><div align='right'> $too </td></tr>");
						  $n++;
						}
						$toto=number_format($tot);			$tco=number_format($tco);
						?>
						
                    </tbody>
                  </table>

					 <div class="col-md-12 hidden-print">
                  <div class="pull-right">
                  <ul class="pagination">
                      <li class="activei">
					  <?php
					  if($l1!=0){
						  ?>
					    <a href="#">
                        &nbsp;<<&nbsp; </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<?php
					 }
						?>
                       
						<?php
						echo"<a href='#'>";
						?>
                        >>                        </a>
                      </li>
                    </ul>
              </div></div>

                  </div></div>   
				  <span class="pull-right hidden-print">
			 &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>                       
              
            </div></div>
                  </div>
      
   </div></div></div>  
   <?php
   include'footer.php';
   ?>
