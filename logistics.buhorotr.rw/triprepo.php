<?php
if(basename($_SERVER['PHP_SELF']) == 'triprepo.php') 
  $cm=" class='current'";
include'header.php';
include'connection.php';
$custo=$conde=$condi='';
$dato=$datos=$Date;
$code=$p=0;

if(isset($_POST['search']))
		{
			$custo=$_POST['custo'];
			$datos=$_POST['datos'];
			$dato=$_POST['dato'];
			$p=1;
		}

	if(isset($_POST['open']))
		{
			$code=$_POST['rowid'];
			$custo=$_POST['custo'];
			$datos=$_POST['datos'];
			$dato=$_POST['dato'];
			$p=$_POST['p'];
		}

	
	if($custo)
	    $conde="AND `Plate` = '$custo'";
	    
	    if($code)
	        $condi="AND `Number` = '$code'";

if($p=='0')
$doje=mysqli_query($conn, "SELECT `Vehicle`, `Plate`, `Driver` FROM (SELECT *FROM `trips` WHERE `Status`='0' $condi GROUP BY `Vehicle` ORDER BY `ETD` DESC LIMIT 10) SUB ORDER BY `ETD` ASC");
else
$doje=mysqli_query($conn, "SELECT `Vehicle`, `Plate`, `Driver` FROM `trips` WHERE `Status`='0' AND `ETD` BETWEEN '$dato' AND '$datos' $conde $condi GROUP BY `Vehicle` ORDER BY `ETD` ASC");

$fo=mysqli_num_rows($doje);
?>
<div class="container-fluid main-content">
        <div class="page-title hidden-print">
          <h2 style='margin-top:-20px; margin-bottom: 5px; color:#ffcc33'>
         Trip Report
          </h2>
  
    </div>
   <div class="row">
  <div class="col-lg-2 hidden-print">
   
  <ul class="list-group">
                  
			  <li class="list-group-item active">
              <a href="triprepo.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Trip Report
                </p>
              </a></li>

    <li class="list-group-item">
	  <a href="disrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Dispatch Report
                </p>
              </a></li> 

    <li class="list-group-item">
	  <a href="arrirepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Departure Report
                </p>
              </a></li>  

    <li class="list-group-item">
	  <a href="mirepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Mileage Report
                </p>
              </a></li>  

    <li class="list-group-item">
	  <a href="ductrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Deduction Report
                </p>
              </a></li>  

    <li class="list-group-item">
	  <a href="custorepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Recovery Report
                </p>
              </a></li>  

    <li class="list-group-item">
	  <a href="currerepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Currency Report
                </p>
              </a></li>   

    <li class="list-group-item">
	  <a href="payreport.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Payment Report
                </p>
              </a></li>    

    <li class="list-group-item">
	  <a href="debtors.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Debtors Report
                </p>
              </a></li>      

    <li class="list-group-item">
	  <a href="girepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;GPS Report
                </p>
              </a></li>         

    <li class="list-group-item">
	  <a href="trepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Target  Report
                </p>
              </a></li>     
                       
            </ul><br><br>
  </div>
                    
           
           
       
        <div class="col-lg-10">
                  <div class="row hidden-print">
		<div class="col-lg-4"> </div>  
         
           

        <form action="" method="post" class="form-horizontal ">                  
                       <div class="col-lg-8 no-print">
					   
					   <div class="col-lg-4 hidden-print"> 
      <select class="form-control" name="custo">
				<option value='' selected='selected'>Select Vehicle</option>
			 <?php
	$doi=mysqli_query($conn, "SELECT `vehicles`.`Plate`, `trips`.`Vehicle` FROM `trips` INNER JOIN `vehicles` ON `vehicles`.`Number` = `trips`.`Vehicle` GROUP BY `trips`.`Vehicle` ORDER BY `trips`.`Vehicle` ASC");
			while($roi=mysqli_fetch_assoc($doi)){
				$veh=$roi['Vehicle'];
				$fna=$roi['Plate'];
				if($fna==$custo)
					$sle="selected";
				else
					$sle='';
			echo"<option value='$fna' $sle> $fna </option>";
			}
			?>    
                            </select>
			</div>          
            
			 <div class="col-lg-3 hidden-print"> 
           <div class="input-group date" data-provide="datepicker">
      <input class="form-control form-center" id="from" name="dato" type="text" value="<?php echo $dato ?>" onkeypress='return isNumberKey(event)' required>
	  <span class="input-group-addon"><i class="lnr lnr-calendar-full"></i></span>
			</div></div>


		  <div class="col-lg-3 hidden-print"> 
           <div class="input-group date" data-provide="datepicker">	
      <input class="form-control form-center" id="to" name="datos" type="text" value="<?php echo $datos ?>" onkeypress='return isNumberKey(event)' required>
	  <span class="input-group-addon"><i class="lnr lnr-calendar-full"></i></span>
              </div></div> 
                       
                       <div class="col-lg-2">
                        <button class="btn  btn-primary btn-block" type="submit" name="search"><i class="lnr lnr-magnifier"></i> Search</button>
                   
					  </div>
                         </div> 
                      
                      
                     
                  
            </form> 
             
               
            </div>
             <div class="row">
            <div class="col-lg-12" style='margin-top:-20px;'>
             <span>Total Records Found : <b><?php echo" $fo " ?></b></span>
			  <span class="pull-right hidden-print">
			 &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a>&nbsp;&nbsp;&nbsp;</span>
			 
			 <span class="pull-right hidden-print">
		&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" id="exporttable" class="hidden-print" title='Export to excell' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-line-spacing"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">

    <div class="table-responsive">
			<table class="table table-striped table-hover table-sm" style="font-size:8px;" id="htmltable"><thead>
    <tr role="row"><th width='4px'> Trip&nbsp;No&nbsp;</th>
		<th class="text-center" width='7%'> Date </th>
		<th><div align='center'> Customer </th><th> Vehicle </th>
    <th> Destination </th><th> Location </th><th> Final </th>
    <th> Load&nbsp;Size </th><th> Distance </th>
    <th><div align='center'> Inconce </th>
    <th><div align='center'> Charges </th><th><div align='center'> Balance </th>
	<th class="hidden-print" style="width:20px; text-align:center;" colspan='2'> # </th></tr>
                    </thead><tbody>
		<?php
					$n=1;									$balo="0.00";
			$tdi=$tsi=$tin=$tcha=$tba=0;

    
    while($roje=mysqli_fetch_assoc($doje)){
        $tveh=$roje['Vehicle'];
        $tpla=$roje['Plate'];
        $driv=$roje['Driver'];
        
    echo"<tr><th style='padding:1px;'> </th><th colspan='12' class='text-success' style='padding:1px;'> [$tveh] $tpla &nbsp;&nbsp; $driv </th></tr>";			
	if($p=='0')
$doj=mysqli_query($conn, "SELECT *FROM (SELECT *FROM `trips` WHERE `Status`='0' AND `Vehicle`='$tveh' $condi ORDER BY `ETD` DESC LIMIT 5) SUB ORDER BY `ETD` ASC");
else
$doj=mysqli_query($conn, "SELECT *FROM `trips` WHERE `Status`='0' AND `ETD` BETWEEN '$dato' AND '$datos'AND `Vehicle`='$tveh' $conde $condi ORDER BY `ETD` ASC");

		while($ro=mysqli_fetch_assoc($doj)){
$code=$ro['Number'];
$name=$ro['Vehicle'];
$dte=$ro['ETD'];
$loce=$ro['Location'];
$dicha=$ro['Final'];
$dese=$ro['Destination'];
$desc=$ro['Description'];
$capa=$ro['Capacity'];									
$capao=number_format($capa, 2);
$caps=number_format($capa);
$dista=$ro['Distance'];									
$distao=number_format($dista, 2);
$dists=number_format($dista);
$driver=$ro['Driver'];
$d='KM';
$c='TON';

$etd=$ro['ETD'];
$eta=$ro['ETA'];
$pla=$ro['Plate'];

$seco=mysqli_query($conn, "SELECT *FROM `trip_note` WHERE `Trip`='$code'");
if($feco=mysqli_num_rows($seco))
$stl="style='padding:1px; font-size:12px; color:#C27935;'";
else
$stl="style='padding:1px; font-size:12px;'";

if($fo=='1')
	$ttl="";
else
	$ttl="title='$desc'";
	
	$custom=mysqli_query($conn, "SELECT `account`.`Customer` FROM `account` INNER JOIN `income` ON `account`.`Number` = `income`.`Customer` WHERE `income`.`Trip`='$code' AND `income`.`Status`='0' AND `income`.`Customer`!='0' ORDER BY `income`.`Number` DESC LIMIT 1");
			$rusto=mysqli_fetch_assoc($custom);
				$cus=$rusto['Customer'];
				
	$inco=mysqli_query($conn, "SELECT SUM(`Amount`*`Rate`) AS 'Amon' FROM `income` WHERE `Trip`='$code' AND `Status`='0'");
	$rinco=mysqli_fetch_assoc($inco);
	    $tco=$rinco['Amon'];
	    $tcoo=number_format($tco);
	    
	    $tca=0;
	$char=mysqli_query($conn, "SELECT SUM(`Amount`) AS 'Amoc' FROM `repair` WHERE `Trip`='$code' AND `Status`='0'");
	$rar=mysqli_fetch_assoc($char);
	    $tca+=$rar['Amoc'];
	    $tcao=number_format($tca);
	    
    $fl=mysqli_query($conn, "SELECT SUM(`Amount`*`Rate`) AS 'Amol' FROM `consumption` WHERE `Trip`='$code' AND `Status`='0'");
	$rl=mysqli_fetch_assoc($fl);
	    $tca+=$rl['Amol'];
	    $tcao=number_format($tca);
	    
	                                $bal=$tco-$tca;
	  $balo=number_format($bal, 2);
	  
	  $tdi+=$dista;                 $tsi+=$capa;
	  $tin+=$tco;           $tcha+=$tca;                $tba+=$bal;

print("<tr $ttl data-toggle='tooltip' data-placement='top'>
<td $stl><div align='center'> $code&nbsp;</td>
<td $stl><div align='center'>$dte</td><td $stl> $cus </td>
	<td $stl>$pla&nbsp;</td><td $stl> $dese </td><td $stl> $loce </td>
	<td $stl> $dicha </td>
	<td $stl><div align='right'>&nbsp;$capao&nbsp;$c&nbsp;</td>
    <td $stl><div align='right'>&nbsp;$distao&nbsp;$d&nbsp;</td>
	<td $stl><div align='right'>&nbsp;$tcoo&nbsp;</td>
	<td $stl><div align='right'>&nbsp;$tcao&nbsp;</td>
		<td $stl><div align='right'>&nbsp;$balo&nbsp;</td> 
						  
			<form method=post action=''>
	<td class='hidden-print' align='right' style='width:20px; padding:0px;'>
              <input type='hidden' name='rowid' value='$code'>
              <input type='hidden' name='custo' value='$custo'>
              <input type='hidden' name='dato' value='$dato'>
              <input type='hidden' name='datos' value='$datos'>
              <input type='hidden' name='p' value='$p'>
    <button type='submit' name='open' class='btn btn-xs btn-success hidden-print' style='height:18px; padding:0px; margin:3px;'>&nbsp;&nbsp;<i class='lnr lnr-download'></i>&nbsp;&nbsp;</button></td></form></tr>");
    
    $n++;

        	if($fo==1){
echo"<tr><td> </td><form method=post action=''><td class='text-center' style='padding:2px 4px 20px 4px; font-size:12px; vertical-align:top;'>
    
              <input type='hidden' name='custo' value='$custo'>
              <input type='hidden' name='dato' value='$dato'>
              <input type='hidden' name='datos' value='$datos'>
              <input type='hidden' name='p' value='$p'>
              <input type='hidden' name='rowid' value='0'>
              
    <button type='submit' class='btn btn-xs btn-info hidden-print' name='open' style='height:18px; padding:0px; font-size:12px; margin:0px; width:80px;' title='Back to list' data-toggle='tooltip' data-placement='top'>&nbsp;&nbsp;<i class='lnr lnr-chevron-left-circle'></i>&nbsp;&nbsp;BACK&nbsp;&nbsp;</button>";

    print("<input type='hidden' name='custo' value='$custor'>
    </th></form></td><td class='text-center' style='color:blue; padding:0px 0px 20px 0px; font-size:11px;'> ETD: $etd </td>
	<td colspan='2' class='text-center' style='color:blue; padding:0px 0px 20px 0px; font-size:11px;' $stl> ETA: $eta </td>
	<td colspan='2' class='text-center' style='padding:0px 0px 20px 0px; color:blue; font-size:11px;'>");
	
	if($billo)
	    echo"<button type='button' class='btn btn-xs btn-danger btn-link' style='height:18px; padding:0px; margin:0px;'
	data-toggle='modal' data-target='#fiModal$n'><i class='lnr lnr-cross-circle text-danger'></i></button>BILL&nbsp;No: <a href='files/$file' style='color:blue' target='_blank'>$billo</a>";
	    
	    print("</td><td colspan='4' class='text-success' style='padding:0px 0px 20px 0px; font-size:11px;'> $desc </td>");
			$n++;	
			

		
	echo"<td class='text-right text-danger' style='padding:2px 0px 20px 0px; font-size:12px; vertical-align:top;'> </td>
	
<td style='padding:2px 4px 20px 4px; font-size:12px; vertical-align:top;'>";
	
	    if($_SESSION['Ctr'])
	echo"<button type='button' class='btn btn-xs btn-danger btn-block' style='height:18px; padding:0px; font-size:10px; margin:0px;'
	data-toggle='modal' data-target='#xModal$n'>
	<i class='lnr lnr-trash'></i>&nbsp;DELETE&nbsp;</button>";
		
		
		
	
// ****************************** Delete a trip ***************************

echo"<div class='modal fade' id='xModal$n' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
  <div class='modal-dialog' role='document'><div class='modal-content'><div class='modal-header text-left'>
        <h5 class='modal-title' id='exampleModalLabel'>DELETE CONFIRMATION <span class='pull-right'> $pla: $dese - $loce </span></h5>

      </div><form action='' method='post'>
      <div class='modal-body text-left' style='height:40px;'>
        <h5 style='color:#ff0033'>Are you sure you want to delete this container ?</h5>
      </div><input type='hidden' name='code' value='$code'>
      <div class='modal-footer' style='margin-top:-10px; height:50px; padding-top:5px; border:0px solid blue;'>
        <button type='button' class='btn btn-sm btn-success' data-dismiss='modal'>&nbsp;NO&nbsp;</button>
        <button type='submit' name='delox' class='btn btn-sm btn-danger'>YES</button>
      </div></form>
    </div>
  </div>
</div>";

// *************************************** End of modal *******************




				echo"</td></tr>";
			}
			
	}
    }
        	if($fo!=1){
        	    $stn="style='padding:2px;'";
        $tdi=number_format($tdi ,2);
        $tsi=number_format($tsi ,2);
        $tin=number_format($tin ,2);
        $tcha=number_format($tcha ,2);
        $tba=number_format($tba ,2);
    echo"<tr><th $stn> </th><th colspan='6' $stn> Total Amount </th>
    <th class='text-right' $stn> $tsi </th><th class='text-right' $stn> $tdi </th><th class='text-right' $stn> $tin </th><th class='text-right' $stn> $tcha </th><th class='text-right' $stn> $tba </th></tr>";
        	}
				?></tbody>
                  </table>
	<?php
	if($fo=='1')
    include'loading.php';
			?>
                    </div></div></div></div></div>                 
               <div class="col-lg-12 hidden-print">
                   <span class="pull-right hidden-print">
            &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a>&nbsp;&nbsp;&nbsp;</span>
            
            
            <span class="pull-right hidden-print">
		&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" id="exporttable" class="hidden-print" title='Export to excell' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-line-spacing"></i></a></span>
			 
		</div> 
                          
                  </div>
      
   </div></div></div>
   <?php
   include'footer.php';
   ?>