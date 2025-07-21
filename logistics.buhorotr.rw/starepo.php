<?php
if(basename($_SERVER['PHP_SELF']) == 'starepo.php') 
  $cm=" class='current'";
include'header.php';
$dato=$datos=$Date;
$custo=$conde='';
$condi='';
$p=0;

// search for an item to be added to the chart
if(isset($_POST['search']))
		{
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$custo=$_POST['custo'];
			$p=1;
		}

		if(isset($_POST['delete_id']))
		{
			$rowid=$_POST['rowid'];
	$then=mysqli_query($conn, "DELETE FROM `consumption` WHERE `Number`='$rowid' LIMIT 1");
			$p=$_POST['p'];
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$custo=$_POST['custo'];
		}
		if(isset($_POST['updat']))
		{
			$rowid=$_POST['rowid'];
			$p=$_POST['p'];
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$custo=$_POST['custo'];
			$fuel=$_POST['fuel'];
			$curre=$_POST['curre'];
			$qt=$_POST['qt'];
			$prio=str_replace(',', '', $_POST['prio']);
			$am=$qt*$prio;
	$then=mysqli_query($conn, "UPDATE `consumption` SET `Amount`='$am', `Price`='$prio', `Rate`='$curre' WHERE `Number`='$rowid' LIMIT 1");
		}
	
	if($dato==$datos)
			$mpri="ON $dato";
		else
			$mpri="FROM $dato TO $datos";

			if($custo)
				$condi="AND `consumption`.`Station`='$custo'";
			else
			    $condi="AND `vehicles`.`Plate` NOT LIKE '%PETRO%'";

				if($p)
			$conde="AND `consumption`.`Date` BETWEEN '$dato' AND '$datos'";
?>
<div class="container-fluid main-content">
        <div class="page-title hidden-print">
          <h3 style='margin-top:-20px; margin-bottom: 5px; color:#ffcc33'>
         Stations Report
          </h3>
                 </div>
     
        <div class="row">
  <div class="col-lg-2 hidden-print">
   
  <ul class="list-group">   

    <li class="list-group-item active">
	  <a href="starepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Stations Report
                </p>
              </a></li>   
                         
            </ul>
  </div>
                    
           
           
    <form action="" method="post" class="form-horizontal "> 
        <div class="col-lg-10">
                  <div class="row">

				  <div class="col-lg-3"> </div>         

                     <div class="col-lg-3">
			<select class="form-control" name="custo">
				<option value='' selected='selected'>Select Station</option>
			 <?php
			$dois=mysqli_query($conn, "SELECT `Station` FROM `consumption` WHERE `Station`!='' GROUP BY `Station` ORDER BY `Station` ASC");
			while($rois=mysqli_fetch_assoc($dois)){
				$fue=$rois['Station'];
				if($fue==$custo)
					$sli="selected='selected'";
				else
					$sli='';
			echo"<option value='$fue' $sli> $fue </option>";
			}
			?>    
                            </select>
					   </div>
							
                       <div class="col-lg-6 hidden-print">
            <div class="col-lg-4"> 
           <div class="input-group date" data-provide="datepicker">
      <input class="form-control form-center" name="dato" type="text" value="<?php echo $dato ?>" onkeypress='return isNumberKey(event)' required>
	  <span class="input-group-addon"><i class="lnr lnr-calendar-full"></i></span>
			</div></div>


		  <div class="col-lg-4"> 
           <div class="input-group date" data-provide="datepicker">	
      <input class="form-control form-center" name="datos" type="text" value="<?php echo $datos ?>" onkeypress='return isNumberKey(event)' required>
	  <span class="input-group-addon"><i class="lnr lnr-calendar-full"></i></span>
              </div></div>                      
                       
                       <div class="col-lg-3">
                        <button class="btn  btn-primary btn-block" type="submit" name="search"><i class="lnr lnr-magnifier"></i> Search</button>
                   
					  </div>
                         </div> 
                      
                     
                  
            </form> 
             
               
            </div>
             <?php
				if($p)
$do=mysqli_query($conn, "SELECT `consumption`.* FROM `consumption` INNER JOIN `vehicles` ON `vehicles`.`Number` = `consumption`.`Vehicle` WHERE  `consumption`.`Status`='0' $conde $condi ORDER BY `consumption`.`Date` ASC");
	else
$do=mysqli_query($conn, "SELECT *FROM (SELECT `consumption`.* FROM `consumption` INNER JOIN `vehicles` ON `vehicles`.`Number` = `consumption`.`Vehicle` WHERE `consumption`.`Status`='0' ORDER BY `consumption`.`Date` DESC LIMIT 15) SUB ORDER BY `Date` ASC");

$fo=mysqli_num_rows($do);
					?>
					<div class="divFooter"><center><u><b>STATION REPORT <?php echo"$mpri"; ?></b></u></center></div>
		 <div class="row">
            <div class="col-lg-12">
             <span> &nbsp;&nbsp; Total Records Found : <b><?php echo" $fo " ?></b></span>
			 <span class="pull-right hidden-print">
			 &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
			 
			  <span class="pull-right hidden-print">
			 &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="exportTableToExcel('tblData')" class="hidden-print" title='Export to excell' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-line-spacing"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">

			 <table class="table table-striped table-hover" id="tblData">     
                                      <thead>
                    <tr role="row">
                        <th class="text-center"> Date </th>
                        <th class="text-center"> Station </th>
                       <th class="text-center"> Vehicle </th> 
						 <th class="text-center"> Purchase </th> 
                        <th class="text-center"> Quantity </th> 
                        <th class="text-center"> Type </th>
                        <th class="text-center"> Price </th>
						 <th class="text-center"> Amount </th>
						 <th class="text-center"> Rate </th>
                        <th class="text-center"> Price </th>
						 <th class="text-center"> Total </th>
						 <th colspan='2' class="text-center"> Discount </th>
						 <th class="text-center"> Value </th>
						 <th class="hidden-print text-center" width="1%"> # </th></tr></thead>
                                        <tbody>
					<?php
					$n=1;					$tam=$tdi=$tq=$tpa=$tsi=$tva=0;
		
		$xdis=$xdif=0;
						while($ro=mysqli_fetch_assoc($do)){
$code=$ro['Number'];
$emplo=$ro['Vehicle'];
$amo=$ro['Amount'];
$amoo=number_format($amo, 2);
$disc=$ro['Discount'];
$dte=$ro['Date'];
$pri=$ro['Price'];
if($pri)
$qty=$amo/$pri;
else
$qty=$ro['Quantity'];
$fuel=$ro['Fuel'];
$tdo=$qty*$disco;
$pai=$amo-$tdo;
$purcha=$ro['Purchase'];
$plate=$ro['Plate'];
$sta=$ro['Station'];
$rate=$ro['Rate'];
$value=$amo*$rate;
$lpri=$pri*$rate;
$qt=$ro['Quantity'];
$tdis=$disc*$qty;
$dif=$value-$tdis;

if($amo>0 AND $pri>0){
    $dle=$dls="";
     $stn="style='padding:1px; font-size:12px;'";
}
else{
    $dle="<del>";
    $dls="</del>";
     $stn="style='padding:1px; font-size:12px; color:red;'";
     $disco=$tdo=$tdis=$dif=0;
}

	$prio=number_format($pri, 2);
	$tdoo=number_format($tdo, 2);
	$qto=number_format($qty, 2);
	$paio=number_format($pai, 2);
	$rato=number_format($rate, 2);
	$valo=number_format($value, 2);
	$lpro=number_format($lpri, 2);
	$tdiso=number_format($tdis, 2);
	$difo=number_format($dif, 2);

$doi=mysqli_query($conn, "SELECT  `Plate`, `Driver` FROM `vehicles` WHERE `Number`='$emplo'");
			$roi=mysqli_fetch_assoc($doi);
				$fna=$roi['Plate'];
				$dri=$roi['Driver'];

$doil=mysqli_query($conn, "SELECT `Purchase` FROM `consumption` WHERE `Vehicle`='$emplo' AND `Purchase`!='0' AND `Purchase`<'$purcha' ORDER BY `Purchase` DESC LIMIT 1");
	if($foil=mysqli_num_rows($doil)){
			$roil=mysqli_fetch_assoc($doil);
				$dis=$purcha-$roil['Purchase'];
				$tsi+=$dis;
	}
	else
		$dis="--";
				
				if($_SESSION['Cancel'])
				    $disa="";
				else
				    $disa="disabled";
				    
           
					print("<tr>
                <td $stn> $dte </td><td $stn> $sta </td><td $stn> $fna </td>
	<td class='text-right' $stn> $purcha </td><td class='text-right' $stn>$dle $qto $dls</td><td $stn>&nbsp;&nbsp;$fuel </td>
						<td class='text-right' style='padding:1px; font-size:12px;'> <a href='#' data-toggle='modal' data-target='#exampleModalx$n'>$prio</a> </td>
						<td class='text-right' $stn> $amoo </td>
						<td class='text-right' style='padding:1px; font-size:12px;'> <a href='#' data-toggle='modal' data-target='#exampleModalx$n'>$rato</a> </td>");
						
			
			
			
	echo"<div class='modal fade' id='exampleModalx$n' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true' 
		style='top:220px;'><div class='modal-dialog' role='document'>
    <div class='modal-content'><div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLabel'>PRICE UPDATION
        <label class='pull-right text-right'>[<b> $sta &nbsp;&nbsp; $dte </b>]</label></h5>

      </div><form method='post' action=''>
      <div class='modal-body' style='height:80px;'>
      <div class='col-md-3 text-right'> Price&nbsp;Per&nbsp;Unit </div>
      <div class='col-md-5'>
       <input name='prio' class='form-control text-center' type='text' onkeypress='return isNumberKey(event)' onkeyup='format(this);' value='$prio' required>
       </div>
       
       <div class='col-md-4'><select class='form-control' name='curre' title='Currency' data-toggle='tooltip' data-placement='top' style='margin-left:0px;' required>";
		
			$doi=mysqli_query($conn, "SELECT `Code`, `Rate` FROM `currency` WHERE `Code`!='' ORDER BY `Code` ASC");
			while($roi=mysqli_fetch_assoc($doi)){
				$fna=$roi['Code'];
				$rat=$roi['Rate'];
				$rte=number_format($rat, 2);
				if($rate==$rat)
			echo"<option value='$rat' selected> $fna @ $rte </option>";
			    else
			echo"<option value='$rat'> $fna @ $rte </option>";
			}
		
		   echo"</select></div>
      </div>
      
      <input type='hidden' name='rowid' value='$code'>
      <input type='hidden' name='fuel' value='$fuel'>
	  <input value='$p' name='p' type='hidden'>
	  <input value='$qt' name='qt' type='hidden'>
	  <input value='$custo' name='custo' type='hidden'>
	  <input value='$dato' name='dato' type='hidden'>
	  <input value='$datos' name='datos' type='hidden'>
      <div class='modal-header text-right;' style='height:50px; padding-top:10px; padding-right:60px; text-align:right;'>
        <button type='button' class='btn btn-sm btn-danger' data-dismiss='modal'>CANCEL</button>
        <button type='submit' name='updat' class='btn btn-sm btn-success'>UPDATE</button>
      </div></form>
    </div>
  </div>
</div>";



		
	print("<td class='text-right' $stn> $lpro </td>
	<td class='text-right' $stn> $valo </td>
    <td class='text-right' $stn>&nbsp;&nbsp;$disc&nbsp;&nbsp;</td>
    <td class='text-right' $stn> $tdiso </td><td class='text-right' $stn> $difo </td>");

echo"<div class='modal fade' id='exampleModal$n' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true' 
		style='top:220px;'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLabel'>DELETE CONFIRMATION  
		<label style='float:right;'> $fna &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		$amoo </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5>

      </div>
      <div class='modal-body' style='height:40px;'>
        <h5 style='color:#ff0033'>Are you sure you want to delete this record?</h5>
      </div><form method='post' action=''><input type='hidden' name='rowid' value='$code'><input type='hidden' name='fuel' value='$fuel'>
	  <input value='$p' name='p' type='hidden'><input value='$custo' name='custo' type='hidden'>
	  <input value='$dato' name='dato' type='hidden'><input value='$datos' name='datos' type='hidden'>
      <div class='modal-footer' style='margin-top:-10px; height:50px; padding-top:5px; border:0px solid blue;'>
        <button type='button' class='btn btn-sm btn-success' data-dismiss='modal'>&nbsp;NO&nbsp;</button>
        <button type='submit' name='delete_id' class='btn btn-sm btn-danger' $disa>YES</button>
      </div></form>
    </div>
  </div>
</div>";
						
						
						
								echo"<td align='right' style='width:20px; padding:0px; padding-left:8px;'>
						  <button type='button' class='btn btn-xs btn-danger hidden-print' style='height:18px; padding:0px; margin:0px;
						  width:25px;' data-placement='top' data-toggle='modal' data-target='#exampleModal$n' $disa>
						  <i class='lnr lnr-trash'></i></button></td></tr>";
						  $n++;				$tam+=$amo;		
						  $tpa+=$pai;			
						  if($amo>0 AND $pri>0)
						    $tq+=$qty;
						  
    $tdi+=$tdo;         $tva+=$value;         $xdis+=$tdis;         $xdif+=$dif;
						}
									
	$tq=number_format($tq, 2);					$tam=number_format($tam, 2);					$tba=number_format($tba, 2);
	$tva=number_format($tva, 2);				$tdi=number_format($tdi, 2);					$tsi=number_format($tsi, 2);
	$xdis=number_format($xdis, 2);            $xdif=number_format($xdif, 2);

		?>
                    </tbody><thead> 
		<tr><th colspan='3' style="padding:1px; font-size:12px; font-weight:bold;">&nbsp;&nbsp;Total Amount </th>
			<th colspan='2' class='text-right' style='padding:1px; font-size:12px; font-weight:bold;'><?php echo $tq ?></th>
			<th class='text-right' style='padding:1px; font-size:12px; font-weight:bold;'> </th>
			<th colspan='2' class='text-right' style='padding:1px; font-size:12px; font-weight:bold;'><?php echo $tam ?></th><th> </th>
            <th class='text-right' colspan='2' style='padding:1px; font-size:12px; font-weight:bold;'><?php echo $tva ?></th>
			<th colspan='2' class='text-right' style='padding:1px; font-size:12px; font-weight:bold;'><?php echo $xdis ?>
			<th class='text-right' style='padding:1px; font-size:12px; font-weight:bold;'><?php echo $xdif ?></th>
			<th class='text-right' style='padding:1px; font-size:12px; font-weight:bold;'> </th></tr>
                  </thead></table>
                                      
                
              </div>
            </div></div>
                  </div>                  
                <span class="pull-right hidden-print">
			 &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span> 
			 
			    <span class="pull-right hidden-print">
			 &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="exportTableToExcel('tblData')" class="hidden-print" title='Export to excell' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-line-spacing"></i></a></span>
      
   </div></div></div>  
   <?php
   include'footer.php';
   ?>