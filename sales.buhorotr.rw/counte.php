<?php
if(basename($_SERVER['PHP_SELF']) == 'counte.php') 
  $bb=" class='current'";
include'header.php';
include'connection.php';
$custo='';
$conde='';
$l1=1;
$l2=40;
$lim=2;
 $brc=$_SESSION['BR'];	
 $doib=mysql_query("SELECT `Name` FROM `branches` WHERE `Number`='$brc' ORDER BY `Number` ASC");
			$roib=mysql_fetch_assoc($doib);
				$bra=$roib['Name'];

$fld="S$brc";			

if(isset($_POST['adjust']))
		{
			$custo=$_POST['custo'];
			$qts=$_POST['qts'];
			$so=mysql_query("UPDATE `items` SET `Cost`='$qts' WHERE `Iname`='$custo' AND `Status`='0' LIMIT 1");
		}

		
		if($custo){
			$conde="AND (`Iname` LIKE '%$custo%' OR `Descri` LIKE '%$custo%')";
		}
		else{
			$conde="AND `$fld`!='0'";
		}

$do=mysql_query("SELECT *FROM `items` WHERE `Store`<='2' AND `Status`='0' $conde ORDER BY `Iname` ASC LIMIT 1400");
$fo=mysql_num_rows($do);
?>
<div class="container-fluid main-content">
        <div class="page-title hidden-print">
          <h2 style='margin-top:-20px; margin-bottom: 5px; color:#ffcc33'>
         Sales/Payment
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

	   <li class="list-group-item">
              <a href="stobranch.php" <?php echo $dsa ?>>
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Store Status
                </p>
              </a></li>

   <li class="list-group-item">
	  <a href="createa.php" <?php echo $dsa ?>>
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Create Account
                </p>
              </a></li> 

   <li class="list-group-item">
	  <a href="dadd.php" <?php echo $dsa ?>>
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Pay on Account
                </p>
              </a></li>   

   <li class="list-group-item">
	  <a href="cashbox.php" <?php echo $dsa ?>>
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Add to Cashbox
                </p>
              </a></li> 

   <li class="list-group-item">
	  <a href="madd.php" <?php echo $dsa ?>>
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Make a Payout
                </p>
              </a></li> 
                       
            </ul><br><center>
			<?php
			if($fo>='1'){
				?>
<center>
		
<?php
if($_SESSION['Phyc']){
?>
			<a href="counte.php" class="btn btn-warning" style="width:100%;"><i class="lnr lnr-layers">&nbsp;Physical Count</i></a>
<?php
}
?>
				</center><br><br><br>
  
				 <ul class="list-group">

   <li class="list-group-item" style="border:1px dashed #cccccc; border-radius:5px; margin:0px 0px 4px 0px;">
	  <a href="urepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Sales Report
                </p>
              </a></li> 

			   <li class="list-group-item" style="border:1px dashed #cccccc; border-radius:5px; margin:0px 0px 4px 0px;">
	  <a href="transit.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Payment Report
				<?php
$doq=mysqli_query($cons, "SELECT `Amount` FROM `payment` WHERE `Status`='0' AND `Action`='SALES' AND `Branche`='$custo' AND `Voucher`='0' ORDER BY `Number` ASC");
				if($foq=mysqli_num_rows($doq))
echo"<span class='badge' style='float:right; font-size:12px; margin-right:0px; margin-top:0px; height:18px; background-color:#ffcc66; width:auto;'> $foq </span>";
					?>
                </p>
              </a></li>  
			  
			  <li class="list-group-item" style="border:1px dashed #cccccc; border-radius:5px; margin:0px 0px 4px 0px;">
	  <a href="breceive.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Receiving Report
                </p>
              </a></li>
	</ul>
			  <?php
			}
   ?>
  </div>
                    
     <?php      
       if($pto==3669){
		print("<div class='alert alert-danger' style='border-radius:5px;'>
		<i class='lnr lnr-sad'></i> <button class='close' data-dismiss='alert' type='button'>×</button>Wrong password, please try again.
		</div>");
	}    
       ?>

        <div class="col-lg-10">
                  <div class="row">
         
           <div class="col-lg-2 hidden-print"> </div>
          
         
           

        <form action="" method="post" class="form-horizontal ">                  
                       <div class="col-lg-10  hidden-print"><div class="col-lg-2"> 					
					   
					   </div>
            <div class="col-lg-4"> 
      <input class="form-control"  name="custo" type="text" id="searchs" autofocus="autofocus" required>
			</div>  

		 <div class="col-lg-2">
		 <input name='qts' class='form-control sm' type='text' style='text-align:center;' placeholder='Cost Price'>
		 </div>
                    
                       
                       <div class="col-lg-2">
                        <button class="btn  btn-primary btn-block" type="submit" name="adjust"><i class="lnr lnr-plus-circle"></i> Adjust </button>
                   
					  </div>

<div class="col-lg-1">
                    
<div id="element" class="btn btn-danger show-modal"><i class="lnr lnr-cross-circle"></i> Reset </div>
                   
					  </div>
                         </div> 
                     
                     
                  
            </form> 

<form action='' method='post'>
<div id="testmodal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Confirmation</h4>
            </div>
            <div class="modal-body">
             
		 <input name='passkey' class="form-control sm" type='password' style='text-align:center;' placeholder="Enter your password" required>
		
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" name='resetall' class="btn btn-primary">Reset All</button>
            </div>
        </div>
    </div>
</div>
</form>
             
			<div class="divFooter"><center><u><b>STORE REPORT ON <?php echo $Date ?></b></u></center></div>   
            </div>
             <div class="row">
            <div class="col-lg-12" style='margin-top:-20px;'>
             <span> &nbsp;&nbsp; Total Records Found : <b><?php echo" $fo " ?></b></span>
			 <span class="pull-right hidden-print"><?php echo $bra ?>&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">
               
                                 <table class="table table-striped">     
                                      <thead>
                    <tr role="row">
                     <th class="hidden-xs"> NO </th>
                       <th> Item&nbsp;Name </th>
                        <th> Description </th>
                       <th> Item&nbsp;Type </th>
		<th class='text-center' colspan='2'> Cost&nbsp;/&nbsp;Price </th>
                        <th><div align='center'> Open. </th><th><div align='center'> New </th>
						<th><div align='center'> Used </th><th><div align='center'> &nbsp;&nbsp;Clos. </th>
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
			$qt=$ro["$fld"];				$qty=number_format($qt, 2);			
			$pri=$ro['Price'];			$prio=number_format($pri, 2);
			
			$smin=$ro['Smin'];
			$sval=$ro['Svalue'];
			$bmin=$ro['Bvalue'];
			$bval=$ro['Bvalue'];

							$stn="padding:1px;";

$doi=mysql_query("SELECT *FROM `itype` WHERE `Number`='$kin' ORDER BY `Number` ASC");
		$roi=mysql_fetch_assoc($doi);
				$type=$roi['Type'];

				$dox=mysql_query("SELECT *FROM `unit` WHERE `Number`='$uno' ORDER BY `Number` ASC");
					$rox=mysql_fetch_assoc($dox);
							$unit=$rox['Unit'];

	// received and used item
	$rec=$use=0;
	$dor=mysql_query("SELECT *FROM `stouse` WHERE `Item`='$code' AND `Status`='0' AND `Voucher`!='0' AND `Upda`='1' AND `Date`='$Date' AND `Action`='TAKEN' AND `Destin`='$bra' ORDER BY `Number` DESC");
		while($ror=mysql_fetch_assoc($dor)){
						$act=$ror['Action'];
						$qts=$ror['Quantity'];
	$rec+=$qts;
		}

$dor=mysql_query("SELECT *FROM `stouse` WHERE `Item`='$code' AND `Status`='0' AND `Voucher`!='0' AND `Upda`='1' AND `Date`='$Date' AND `Action`='SALES' AND `Invoice`='$bra' ORDER BY `Number` DESC");
		while($ror=mysql_fetch_assoc($dor)){
						$act=$ror['Sale'];
						$qts=$ror['Quantity'];
	$use+=$qts;
		}
         $rece=number_format($rec, 2);					$uses=number_format($use, 2);				$open=number_format($qt-$rec+$use, 2);

		// $so=mysql_query("UPDATE `items` SET `$fld`='$qty' WHERE `Number`='$code' AND `Status`='0' LIMIT 1");
		print("<tr>
                        <td class='hidden-xs' style='$stn'><div align='center'>$n&nbsp;&nbsp;</td>
						<td style='$stn'> $iname </td><td style='$stn'> $descri </td>
                        <td style='$stn'> $type </td><td style='$stn'><div align='right'> $costo&nbsp;/&nbsp;$prio &nbsp;</td>
						<td style='$stn'> $unit </td><td style='$stn'><div align='right'> $open </td>
						<td style='$stn'><div align='right'> $rece </td><td style='$stn'><div align='right'> $uses </td>
						<td style='$stn'><div align='right'> $qty </td></tr>");
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
                        >> </a>
                      </li>
                    </ul>
              </div></div>

                  </div>                     
                
              </div>
            </div></div>
				  <span class="pull-right hidden-print">
			 &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>   
      
                  </div>  
   </div></div></div>  
   <?php
   include'footer.php';
   ?>
