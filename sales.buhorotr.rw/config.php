<?php
if(basename($_SERVER['PHP_SELF']) == 'config.php') 
  $pp=" class='current'";
include'header.php';
include'connection.php';
$custo='';
$conde='';

if(isset($_POST['search']))
		{
			$_SESSION['Dato']=$_POST['dato'];
			$_SESSION['Stor']=$_POST['store'];
		}
		
		$date=$_SESSION['Dato'];
		$stor=$_SESSION['Stor'];

if(isset($_POST['adjust']))
		{
			$custo=$_POST['custo'];
			$qts=$_POST['qts'];
$see=mysql_query("SELECT `Number`, `$stor` FROM `items` WHERE `Iname`='$custo' AND `Status`='0' LIMIT 1");
$ree=mysql_fetch_assoc($see);
$code=$ree['Number'];
$qtin=$ree["$stor"];

// received and used item after date
	$rec=$use=0;
	$dor=mysql_query("SELECT *FROM `stouse` WHERE `Item`='$code' AND `Status`='0' AND `Voucher`!='0' AND `Upda`='1' AND `Date`>='$date' AND (`Action`='RECEIVE' OR `Action`='TAKEN' OR `Action`='SALES') ORDER BY `Number` DESC");
		while($ror=mysql_fetch_assoc($dor)){
if(($ror['Action']=='RECEIVE' AND $ror['Store']=='$stor') OR ($ror['Action']=='TRANSFER' AND $ror['Destin']=='$stor'))
	$rec+=$ror['Quantity'];

if(($ror['Action']=='TAKEN' AND $ror['Store']='$stor') OR ($ror['Action']=='SALES' AND $ror['Store']=='$stor') OR ($ror['Action']=='TRANSFER' AND $ror['Store']=='$stor'))
	$use+=$ror['Quantity'];
		}
		$qtin=$qtin-$rec+$use;
		    $bal=$qts-$qtin;
		
			$so=mysql_query("UPDATE `items` SET `$stor`=`$stor`+'$bal' WHERE `Iname`='$custo' AND `Status`='0' LIMIT 1");
$soso=mysql_query("INSERT INTO `count` (`Number`, `Item`, `Qtin`, `Qton`, `Date`, `User`, `Store`) VALUES (NULL, '$code', '$qtin', '$qts', '$date', '$loge', '$stor')");
		}

$do=mysql_query("SELECT `count`.`Date` AS 'Cda', `count`.`Qtin`, `count`,`Qton`, `count`.`Item`, `count`.`Store` AS `Stor`, `items`.* FROM `count` INNER JOIN `items` ON `count`.`Item`=`items`.`Number` ORDER BY `count`.`Number` DESC LIMIT 10");
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
              </a></li><li class="list-group-item active">
              <a href="config.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Monthly Inventories
                </p>
              </a></li> 
                       
            </ul><br><br>
<center>
			<a href="count.php" class="btn btn-info" style="width:100%"><i class="lnr lnr-layers">&nbsp;Physical Count</i></a>
			</center><br>
  <div class="text-success text-center">This operation will over write store quantity accordingly.</div>

  </div>
                    
           
           
       
        <div class="col-lg-10">
                  <div class="row">
         
           <div class="col-lg-2 hidden-print"> </div>

        <form action="" method="post" class="form-horizontal ">                  
                       <div class="col-lg-10 hidden-print">
                           
    <?php
        if($_SESSION['Dato']==''){
        ?> 
        <div class="col-lg-4 text-right" style="padding-top:-5px; font-size:24px;"> Count Date </div>
        
          <div class="col-lg-3"> 
           <div class="input-group date datepicker">	
      <input class="form-control form-center" id="to" name="dato" type="text" value="<?php echo $Date ?>" onkeypress='return isNumberKey(event)' placeholder='Select an item' required><span class="input-group-addon">
          <i class="lnr lnr-calendar-full"></i></span>
              </div></div> <div class="col-md-2 hidden-print">
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
                       
        <div class="col-lg-2">
    <button class="btn  btn-primary btn-block" type="submit" name="search"><i class="lnr lnr-magnifier"></i> Search</button>
                   
					  </div>   
        <?php    
        }
        else{
            ?>
		<div class="col-lg-3 hidden-print"> 					
					   
					   </div>
            <div class="col-lg-4 hidden-print"> 
      <input class="form-control"  name="custo" type="text" id="searchu" autofocus="autofocus" required>
			</div>  

		 <div class="col-lg-2 hidden-print">
		 <input name='qts' class='form-control sm' type='text' style='text-align:center;' placeholder='Quantity'>
		 </div>
                    
                       
                       <div class="col-lg-2 hidden-print">
                        <button class="btn  btn-primary btn-block" type="submit" name="adjust"><i class="lnr lnr-plus-circle"></i> Save </button>
                   
					  </div>

<div class="col-lg-1">
                   
					  </div>
	<?php
        }
        ?>
                         </div> 
                  
          </form></div> 
             
			<div class="divFooter"><center><u><b>INVENTORIES COUNT REPORT </b></u></center></div>

             <div class="row">
            <div class="col-lg-12" style='margin-top:-20px;'>
             <span> &nbsp;&nbsp; <?php 
             if($date)
             echo"Count Date :<b> $date </b>";
             ?></b></span>
			 <span class="pull-right hidden-print">&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">
               
                <table class="table table-striped">     
                    <thead>
                            <tr role="row">
                     <th class="hidden-xs"> No </th>
                       <th> Date </th>
                       <th> Brand&nbsp;Name </th>
                       <th> Item&nbsp;Name </th>
                        <th> Store </th>
						 <th> Cost Price </th>
                         <th> Sales&nbsp;Price </th>
                        <th><div align='center'> S.Count </th>
                        <th><div align='center'> I.Count </th>
						<th><div align='center'> Balance </th></tr>
                    </thead>
                                        <tbody>
					<?php
					$n=1;		
			while($ro=mysql_fetch_assoc($do)){
				$code=$ro['Number'];
				$item=$ro['Item'];
				$stor=$ro['Stor'];
			$qt=$ro['Qtin'];				$qty=number_format($qt, 2);	
			$qo=$ro['Qton'];                $qto=number_format($qo, 2);

	$stn="padding:1px;";                   $balo=number_format($qo-$qt);
				
	$dox=mysql_query("SELECT *FROM `items` WHERE `Number`='$item' ORDER BY `Number` ASC");
		$rox=mysql_fetch_assoc($dox);
			$iname=$rox['Iname'];
			$kin=$rox['Type'];
			$descri=$rox['Descri'];
			$uno=$rox['Unit'];			
			$cost=$rox['Cost'];			$costo=number_format($cost, 2);		
			$pri=$rox['Price'];			$prio=number_format($pri, 2);
			$cda=$ro['Cda'];

    $doi=mysql_query("SELECT `Type` FROM `itype` WHERE `Number`='$kin' ORDER BY `Number` ASC");
		$roi=mysql_fetch_assoc($doi);
				$type=$roi['Type'];

 $dos=mysql_query("SELECT `Name` FROM `stores` WHERE `Store`='$stor' ORDER BY `Number` ASC");
		$ros=mysql_fetch_assoc($dos);
				$descri=$ros['Name'];

		print("<tr><td class='hidden-xs' style='$stn'>
                        <div align='center'>$n&nbsp;&nbsp;</td>
                       <td style='text-align:center; $stn'> $cda </td>
                        <td style='$stn'> $type </td>
						<td style='$stn'> $iname </td>
						<td style='$stn'> $descri </td>
                        <td style='$stn'><div align='right'> $costo </td>
						<td style='$stn'><div align='right'> $prio </td>
						<td style='$stn'><div align='right'> $qty </td>
						<td style='$stn'><div align='right'> $qto </td>
						<td style='$stn'><div align='right' style='padding-right:20px;'> $balo </td></tr>");
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
