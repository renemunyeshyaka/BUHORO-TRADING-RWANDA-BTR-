<?php
if(basename($_SERVER['PHP_SELF']) == 'sarepo.php') 
  $cm=" class='current'";
include'header.php';
include'connection.php';
$dato=$datos=$Date;
$custo='';
$conde='';
$t=$p=0;

// search for an item to be added to the chart
if(isset($_POST['search']))
		{
			$brc=$_POST['brc'];
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$p=1;
		}

// open for a given requisition to mark as taken
if(isset($_POST['open']))
		{
			$brc=$_POST['brc'];
			$vous=$_POST['vous'];
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$dte=$_POST['dte'];
			$t=$p=1;
		}
	
	if($dato==$datos)
			$mpri="ON $dato";
		else
			$mpri="FROM $dato TO $datos";

$rece=mysql_query("SELECT `Number` FROM `branches` WHERE `Name`='$brc' ORDER BY `Number` DESC LIMIT 1");
				$recet=mysql_fetch_assoc($rece);
					$brco=$recet['Number'];
?>

<script>

var btn = document.getElementsByClassName("click-to-open");

for (var i = 0; i < btn.length; i++) {
  var thisBtn = btn[i];
  thisBtn.addEventListener("click", function(){
    var modal = document.getElementById(this.dataset.modal);
    modal.style.display = "block";
}, false);
</script>
<div class="container-fluid main-content">
        <div class="page-title hidden-print">
          <h2 style='margin-top:-20px; margin-bottom: 5px; color:#ffcc33'>
         Production Report
          </h2>
                 </div>
     
         <div class="row">
  <div class="col-lg-2 hidden-print">
   
   <ul class="list-group">

    <li class="list-group-item">
	  <a href="prodaily.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Production Report
                </p>
              </a></li>
			  
	 <li class="list-group-item">
	  <a href="consurepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Consumption Report
                </p>
              </a></li>
	
	<li class="list-group-item">
	  <a href="prodispatch.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Dispatch Report
                </p>
              </a></li> 
			  
	<li class="list-group-item active">
	  <a href="suarepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Item Used Report
                </p>
              </a></li>

	 <li class="list-group-item">
	  <a href="prorepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Configuration Report
                </p>
              </a></li> 

	 <li class="list-group-item">
	  <a href="#">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Control Report
                </p>
              </a></li> 
                         
            </ul>
  </div>
                    
           
           
       
        <div class="col-lg-10">
                  <div class="row">
         
           <div class="col-lg-4"> </div>
          
         
           

        <form action="" method="post" class="form-horizontal ">                  
                       <div class="col-lg-8 hidden-print"><div class="col-lg-3"> 
		<select class="form-control" name="brc" style='padding-right:5px;' required><option value='' selected='selected'> SELECT BRANCH </option>
			   <?php
		$seek=mysql_query("SELECT `Destin` FROM `brause` WHERE `Destin`!='' AND `Destin` LIKE '%PRODUCTION%' GROUP BY `Destin` ORDER BY `Destin` ASC LIMIT 18");
			if($feek=mysql_num_rows($seek)){
		while($roi=mysql_fetch_assoc($seek)){
				$fna=$roi['Destin'];
				if($brc==$fna)
					$s='selected';
				else
					$s='';

$doi=mysql_query("SELECT *FROM `production` WHERE `Convert`='$fna' ORDER BY `Number` ASC");
			$roi=mysql_fetch_assoc($doi);
				$fnae=$roi['Name'];
			echo"<option value='$fna' $s> $fnae &nbsp;&nbsp;</option>";
			}
			}
			?>			    
            </select>
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
$do=mysql_query("SELECT *FROM `brause` WHERE `Date` BETWEEN '$dato' AND '$datos' AND `Destin`='$brc' GROUP BY `Ingre` ORDER BY `Number` ASC");		
				if($fo=mysql_num_rows($do)){
				   ?>
                 <div class="divFooter"><center><u><b>SALES REPORT <?php echo $mpri ?></b></u></center></div>
             <div class="row">
            <div class="col-lg-12">
             <span> &nbsp;&nbsp; Total Records Found : <b><?php echo" $fo " ?></b></span> 
			 <span class="pull-right"><?php echo $brc ?>&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">

								 <form action="" method="post" class="form-horizontal "> 
				<table class="table table-striped">     
                                      <thead>
                    <tr role="row">
                     <th class="hidden-xs"> NO </th>
                       <th> Due&nbsp;Date </th> 
                       <th> Done&nbsp;By </th>
                       <th> Destination </th>
                       <th> Voucher&nbsp;No </th>
                       <th> Items </th>
                        <th> Quantity </th>
                        <th> Price/Unit </th>
			<th colspan='2'><div align='right'>Amount&nbsp;&nbsp;</th>
                        <th class="hidden-xs hidden-print" style="width:40px; text-align:center;" colspan='2'> Options </th>
                     </tr>
                    </thead>
                                        <tbody>
					<?php
					$n=1;				$tp=0;
						while($ro=mysql_fetch_assoc($do)){
				
				$dte=$ro['Date'];
				$des=$ro['Destin'];
				$user=$ro['User'];
				$cashier=$ro['User'];
$item=$ro['Ingre'];
				$to=0;
$doi=mysql_query("SELECT *FROM `production` WHERE `Convert`='$des' ORDER BY `Number` ASC");
			$roi=mysql_fetch_assoc($doi);
				$fnae=$roi['Name'];

$dor=mysql_query("SELECT SUM(Quantity) AS 'QTO' FROM `brause` WHERE `Destin`='$des' AND `Ingre`='$item' AND `Date` BETWEEN '$dato' AND '$datos' ORDER BY `Number` ASC");
			$for=mysql_num_rows($dor);
				while($ror=mysql_fetch_assoc($dor)){
				$qty=$ror['QTO'];
				}

$dov=mysql_query("SELECT *FROM `items` WHERE `Number`='$item' ORDER BY `Number` DESC LIMIT 1");
		$rov=mysql_fetch_assoc($dov);
			$kin=$rov['Type'];
			$descri=$rov['Descri'];
			$uno=$rov['Unit'];
			$iname=$rov['Iname'];
				$pri=$rov['Cost'];
			$to=$pri*$qty;

			$stn="padding:0px;";	

				$dox=mysql_query("SELECT *FROM `unit` WHERE `Number`='$uno' ORDER BY `Number` ASC");
					$rox=mysql_fetch_assoc($dox);
							$unit=$rox['Unit'];
			
						$too=number_format($to, 2);

						$stn="padding:1px;";

$qto=number_format($qty, 2);		$prio=number_format($pri, 2);			
		print("<tr><td class=hidden-xs style='$stn'><div align='center'>$n&nbsp;&nbsp;</td>
<td style='$stn'> $dte </td><td style='$stn'> $user </td><td style='$stn'> $fnae </td>
		<td style='$stn'><div align='center'> $vou </td>
						
						<td style='$stn'> $iname </td><td style='$stn'><div align='right'> $qto&nbsp;&nbsp; </td>
	<td style='$stn'><div align='right'> $prio&nbsp;&nbsp; </td><td style='$stn'><div align='right'> $too&nbsp;&nbsp; </td><td>");

print("<div id='modal-$n' class='modal fade' role='dialog'>
  <div class='modal-dialog'><div class='modal-content'>
      <div class='modal-header'>
        <button type='button' class='close' data-dismiss='modal'>&times;</button>
        <h4 class='modal-title'>$iname &nbsp;&nbsp; &nbsp;&nbsp; $qto</h4>
      </div>
      <div class='modal-body'><div align='center'>

<table class='table table-striped'>
          <thead>
          </thead>
          <tbody>
            <tr>
              <td width='10%'><div align='center'>#</td>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;Item&nbsp;Name</td>
              <td width='10%'><div align='center'>Config.</td>
              <td width='10%'><div align='center'>Sales</td>
              <td width='10%'><div align='center'>Quantity</td>
            </tr>");

	$i=1;
$dori=mysql_query("SELECT *FROM `brause` WHERE `Destin`='$des' AND `Ingre`='$item' AND `Date` BETWEEN '$dato' AND '$datos' GROUP BY `Item` ORDER BY `Number` ASC");
	while($rori=mysql_fetch_assoc($dori)){	
$mit=$rori['Item'];
$mdo=mysql_query("SELECT *FROM `iconfig` WHERE `Ingre`='$item' AND `Item`='$mit' ORDER BY `Number` ASC");
	$mro=mysql_fetch_assoc($mdo);
$mq=$mro['Quantity'];
				
$mdov=mysql_query("SELECT `Iname` FROM `items` WHERE `Number`='$mit' ORDER BY `Number` DESC LIMIT 1");
	$mrov=mysql_fetch_assoc($mdov);
		$miname=$mrov['Iname'];

$dore=mysql_query("SELECT SUM(Quantity) AS 'QTi' FROM `sales` WHERE `Date` BETWEEN '$dato' AND '$datos' AND `Branche`='$brco' AND `Item`='$miname' GROUP BY `Item` ORDER BY `Number` ASC");
			$rore=mysql_fetch_assoc($dore);
				$qtu=$rore['QTi'];
$to=$qtu*$mq;

print("<tr><td style='$stn'><div align='right'> $i &nbsp;&nbsp; </td><td style='$stn'> $miname </td><td style='$stn'> $mq$unit </td>
<td style='$stn'><div align='right'> $qtu&nbsp;&nbsp;</td><td style='$stn'><div align='right'> $to&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>");
$i++;
}

print("</tbody>
        </table>


      </div>
      <div class='modal-footer'>
        <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
      </div>
    </div></div>
    </div>");

	print("</td><input type='hidden' name='brc' value='$brc'><input type='hidden' name='dte' value='$dte'>
<td class='hidden-xs hidden-print' align='right' style='width:40px; padding:0px;'>
       <input type='hidden' name='vous' value='$vou'> <input type='hidden' name='dato' value='$dato'> <input type='hidden' name='datos' value='$datos'>
                          <button type='button' class='btn btn-xs btn-success hidden-print' name='open' style='height:18px; padding:0px; margin:0px;'  title='Open' data-placement='top' data-toggle='modal' data-target='#modal-$n'>
						  &nbsp;&nbsp;<i class='lnr lnr-download'></i>&nbsp;&nbsp;</button></td></form>
						  
						  <form method=post action=''><td class='hidden-xs hidden-print' align='right' style='width:40px; padding:0px;'>
        <input type='hidden' name='vous' value='$vou'> <input type='hidden' name='dato' value='$dato'> <input type='hidden' name='datos' value='$datos'>
       <button type='button' class='btn btn-xs btn-danger hidden-print' name='del' style='height:18px; padding:0px; margin:0px;' data-toggle='confirmation'>
						  &nbsp;&nbsp;<i class='lnr lnr-trash'></i>&nbsp;&nbsp;</button></td></form></tr>");
						  $n++;		$tp+=$to;
						}
						$tpo=number_format($tp, 2);	
						?>
						
                     </tbody>

					 <thead>
					<tr><th class="hidden-xs"> </th><th colspan='7'><div align='center'> Total Amount </th>
					<th colspan='2'><div align='right'><?php echo $tpo ?></th>
					<th colspan='2' class="hidden-xs hidden-print"><div align='center'> -- </th></tr>
                  </table><br>

				  
				  <?php
				}
				 else{
						echo"<div class='row'>
            <div class='col-lg-12' style='margin-top:-20px;'>
             <span> &nbsp;&nbsp; Total Records Found : <b> 0 </b></span>
			 <span class='pull-right hidden-print'> $brc &nbsp;&nbsp;<a href='#' onclick='return window.print()' class='hidden-print' title='Click to print' data-toggle='tooltip' data-placement='top'><i class='lnr lnr-printer'></i></a></span>
            <div class='widget-container fluid-height clearfix'>
            <div class='widget-content padded clearfix'>
			<br><br><br><br><br><br>
						<div style='text-align:center; font-size:24px; color:#ff3333'> There is no sales on selected date </div><br><br><br><br><br><br><br>";
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


