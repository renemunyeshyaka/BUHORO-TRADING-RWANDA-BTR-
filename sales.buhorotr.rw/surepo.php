<?php
if(basename($_SERVER['PHP_SELF']) == 'surepo.php') 
  $cm=" class='current'";
include'header.php';
include'connection.php';
$dato=$datos=$Date;
$custo=$conde='';
$t=$p=$brc=0;
$brc=$_SESSION['Branche'];
$brancho=$_SESSION['Branche'];

// search for an item to be added to the chart
if(isset($_POST['search']))
		{
		//	$brc=$_POST['brc'];
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$p=1;
		}

// open for a given requisition to mark as taken
if(isset($_POST['open']))
		{
		//	$brc=$_POST['brc'];
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

if($brc=='0' OR $brc=='')
$conde="";
else
$conde="AND `Branche`='$brc'";

$rece=mysql_query("SELECT `Name` FROM `branches` WHERE `Number`='$brc' ORDER BY `Number` DESC LIMIT 1");
				$recet=mysql_fetch_assoc($rece);
					$bra=$recet['Name'];
?>

<div class="container-fluid main-content">
        <div class="page-title hidden-print">
          <h2 style='margin-top:-20px; margin-bottom: 5px; color:#ffcc33'>
         Sales Report
          </h2>
                 </div>
     
        <div class="row">
  <div class="col-lg-2 hidden-print">
   
 <ul class="list-group">

    <li class="list-group-item">
	  <a href="sarepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Sales Report
                </p>
              </a></li>  

    <li class="list-group-item active">
	  <a href="surepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Item Sold Report
                </p>
              </a></li> 

<li class="list-group-item">
	  <a href="parepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Payment Report
                </p>
              </a></li> 

	 <li class="list-group-item">
	  <a href="crerepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Credit Report
                </p>
              </a></li> 
              
    <li class="list-group-item">
	  <a href="recorepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Recovery Report
                </p>
              </a></li>    

	 <li class="list-group-item">
	  <a href="debrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Debtors Report
                </p>
              </a></li>   

	 <li class="list-group-item">
	  <a href="conterepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Balance Report
                </p>
              </a></li>    

	 <li class="list-group-item">
	  <a href="balrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Control Report
                </p>
              </a></li>     

	 <li class="list-group-item">
	  <a href="dayrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Income Report
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

$do=mysql_query("SELECT *FROM `stouse` WHERE `Date` BETWEEN '$dato' AND '$datos' AND `Item`!='' AND `Action`='SALES' AND `Status`='0' $conde GROUP BY `Item` ORDER BY `Item` ASC");	
				if($fo=mysql_num_rows($do)){
				   ?>
                 <div class="divFooter"><center><u><b>ITEM SALES REPORT <?php echo $mpri ?></b></u></center></div>
             <div class="row">
            <div class="col-lg-12">
             <span> &nbsp;&nbsp; Total Records Found : <b><?php echo" $fo " ?></b></span> 
			 <span class="pull-right"><?php echo $bra ?>&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">

								 <form action="" method="post" class="form-horizontal "> 
				<table class="table table-striped table-hover" style="font-size:10px;">     
                                      <thead>
                    <tr role="row">
                     <th class="hidden-xs">&nbsp;&nbsp;&nbsp;&nbsp;No&nbsp;&nbsp;</th>
                       <th> Due&nbsp;Date </th> 
                       <th> Brand&nbsp;Name </th>
                       <th> Item&nbsp;Name </th>
                       <th> Item&nbsp;Price </th>
                       <th> Quantity </th>
                       <th> Sales&nbsp;Price </th>
					   <th><div align='right'>Amount&nbsp;&nbsp;</th>
                       <th class="hidden-xs hidden-print" style="width:40px; text-align:center;">&nbsp;&nbsp;&nbsp;#&nbsp;&nbsp;&nbsp;</th>
                     </tr>
                    </thead>
                        <tbody>

					<?php
						$n=1;		$tpo=0;
		while($ro=mysql_fetch_assoc($do)){
				$dte=$ro['Date'];
				$des=$ro['Destin'];
				$user=$ro['User'];
				$item=$ro['Item'];
				$tot=0;
				$qty=0;

$dor=mysql_query("SELECT *FROM `stouse` WHERE `Action`='SALES' AND `Item`='$item' AND `Date` BETWEEN '$dato' AND '$datos' AND `Status`='0' $conde ORDER BY `Number` ASC");
			$for=mysql_num_rows($dor);
				while($ror=mysql_fetch_assoc($dor)){
					$qt=$ror['Quantity'];
				$qty+=$qt;
					$pr=$ror['Price'];
				$tot+=$pr*$qt;
				}

$dov=mysql_query("SELECT *FROM `items` WHERE `Number`='$item' ORDER BY `Number` DESC LIMIT 1");
		$rov=mysql_fetch_assoc($dov);
		    $kin=$rov['Type'];
			$ipri=$rov['Price'];
			$iname=$rov['Iname'];
			$pri=$tot/$qty;
			
	$doi=mysql_query("SELECT *FROM `itype` WHERE `Number`='$kin' ORDER BY `Number` ASC");
		$roi=mysql_fetch_assoc($doi);
				$type=$roi['Type'];

			$stn="padding:0px;";
			
	$toto=number_format($tot, 2);			$prio=number_format($pri, 2);			$qto=number_format($qty, 2);			$iprio=number_format($ipri, 2);

						$stn="padding:1px;";

if(!$bra)
	$bra="ALL BRANCHES";

		print("<tr><td class=hidden-xs style='$stn'><div align='center'>$n&nbsp;&nbsp;</td>
<td style='$stn'> $datos </td><td style='$stn'> $type </td>
							
<td style='$stn'> $iname </td><td style='$stn'><div align='right'> $iprio&nbsp;&nbsp;</td>
<td style='color:blue;$stn'><div align='right'> $qto&nbsp;&nbsp; <button type='button' class='btn btn-xs btn-default hidden-print' name='open' style='height:18px; padding:0px; margin:0px;'  title='Open' data-placement='top' data-toggle='modal' data-target='#modal-$n'>&nbsp;&nbsp;<i class='lnr lnr-layers'></i>&nbsp;&nbsp;</button> </td><td style='$stn'><div align='right'> $prio&nbsp;&nbsp; </td>
<td style='color:blue;$stn'><div align='right'> $toto&nbsp;&nbsp; </td><td class='hidden-xs hidden-print' align='right' style='width:40px; padding:0px;'>");

		// ****************************** Open modal **********************************
	print("<div id='modal-$n' class='modal fade' role='dialog'>
  <div class='modal-dialog'><div class='modal-content text-left'>
      <div class='modal-header' style='height:50px;'>
        <button type='button' class='close' data-dismiss='modal'>&times;</button>
        <h4 class='modal-title'>$iname &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $qto</h4>
      </div>
      <div class='modal-body text-center' style='height:420px; overflow-y:auto;'>

<table class='table table-striped'>
          <thead>
            <tr style='background-color:#ffffff;'>
              <td style='background-color:#ffffff;' width='5%' class='text-center'> # </td>
              <td style='background-color:#ffffff;' class='text-center'> Time </td>
              <td style='background-color:#ffffff;'> Customer </td>
              <td style='background-color:#ffffff;' class='text-center'> Item&nbsp;Name </td>
              <td style='background-color:#ffffff;' width='14%' class='text-center'>Quantity</td>
              <td style='background-color:#ffffff;' width='14%' class='text-center'>Price</td>
              <td style='background-color:#ffffff;' width='14%' class='text-center'>Total</td>
					</tr></thead>");

	$i=1;				$ptu=0;				$dsu='0000-00-00';
$dori=mysql_query("SELECT *FROM `stouse` WHERE `Item`='$item' AND `Date` BETWEEN '$dato' AND '$datos' AND `Action`='SALES' AND `Status`='0' $conde ORDER BY `Number` ASC");
				$subq=$suba=0;
			while($rori=mysql_fetch_assoc($dori)){
				$qtu=$rori['Quantity'];					$qtuo=number_format($qtu, 2);
				$pru=$rori['Price'];					$pruo=number_format($pru, 2);
				$desu=$rori['Destin'];
				$tut=$qtu*$pru;							$tuto=number_format($tut, 2);
				$dtu=$rori['Date'];
				$dtm=$rori['Time'];

if($dsu!=$dtu AND $dsu!='0000-00-00'){
								$subao=number_format($suba, 2);			$subqo=number_format($subq, 2);
	echo" <tbody><tr><th class='text-center' colspan='4' style='background-color:#ffffff; font-weight:normal; color:#6699cc; $stn'> Sub-Total ($dtu) </th>
<th class='text-right' style='background-color:#ffffff; color:#6699cc; font-weight:normal; $stn'> $subqo&nbsp;&nbsp;</th>
<th class='text-right' colspan='2' style='background-color:#ffffff; font-weight:normal; color:#6699cc; $stn'> $subao&nbsp;&nbsp;</th></tr>";
							$subq=$suba=0;
					}
			$dsu=$dtu;

print("<tr><td style='background-color:#ffffff; $stn'><div align='right'> $i &nbsp;&nbsp; </td><td style='background-color:#ffffff; $stn'> $dtm </td>
<td style='background-color:#ffffff; $stn'> $desu </td>
<td style='background-color:#ffffff; $stn'> $iname </td><td style='background-color:#ffffff; $stn'><div align='right'> $qtuo&nbsp;&nbsp;</td>
<td style='background-color:#ffffff; $stn'><div align='right'> $pruo&nbsp;&nbsp;</td><td style='background-color:#ffffff; $stn'><div align='right'> $tuto&nbsp;&nbsp;</td></tr>");
$i++;					$ptu+=$tut;						$subq+=$qtu;								$suba+=$tut;
}

								$subao=number_format($suba, 2);			$subqo=number_format($subq, 2);
echo"<tr><th class='text-center' colspan='4' style='background-color:#ffffff; font-weight:normal; color:#6699cc; $stn'> Sub-Total ($dtu) </th>
<th class='text-right' style='background-color:#ffffff; color:#6699cc; font-weight:normal; $stn'> $subqo&nbsp;&nbsp;</th>
<th class='text-right' colspan='2' style='background-color:#ffffff; font-weight:normal; color:#6699cc; $stn'> $subao&nbsp;&nbsp;</th></tr>";
												$pru=number_format($ptu, 2);
print("</tbody><thead><tr><th style='background-color:#ffffff;' colspan='4'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total Amount</th>
<th style='background-color:#ffffff;' class='text-right'> $qto&nbsp;</th><th colspan='2' style='background-color:#ffffff;' class='text-right'> $ptu&nbsp;</th></tr></thead></table>


			</div><div class='modal-footer' style='height:50px;'>
        <button type='button' class='btn btn-default' data-dismiss='modal' style='margin-top:-20px;'>Close</button>
      </div></div></div></div>
			</div>");

					// *********************************** End of modal *****************************
						  
			print("<button type='button' class='btn btn-xs btn-danger hidden-print' disabled style='height:18px; padding:0px; margin:0px;'>
						  &nbsp;&nbsp;<i class='lnr lnr-trash'></i>&nbsp;&nbsp;</button>&nbsp;&nbsp;</td></tr>");
						  $n++;								$tpo+=$tot;		
						}
								 
						$tpo=number_format($tpo, 2);			
						?>
						
                     </tbody>
					 <thead>
					<tr><th class="hidden-xs"> </th><th colspan='4'>
          <div align='left'> TOTAL AMOUNT </th><th colspan='3'><div align='right'><?php echo $tpo ?></th>
					<th class="hidden-xs hidden-print"><div align='center'> -- </th></tr>
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
						<div style='text-align:center; font-size:24px; color:#ff3333'> Report not available on selected date </div><br><br><br><br><br><br><br>";
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


