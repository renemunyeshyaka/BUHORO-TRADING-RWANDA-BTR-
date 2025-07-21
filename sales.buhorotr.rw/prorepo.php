<?php
if(basename($_SERVER['PHP_SELF']) == 'prorepo.php') 
  $cm=" class='current'";
include'header.php';
include'connection.php';
$dato=$datos=$Date;
$conde=$custo='';

if(isset($_POST['search']))
		{
			$custo=$_POST['custo'];
		}
		
	if($custo=='')
		$conde="";
	else
		$conde="AND `Number`='$custo'";

$dov=mysql_query("SELECT *FROM `items` WHERE `Status`='0' AND `Store`='2' $conde ORDER BY `Number` ASC");
$fov=mysql_num_rows($dov);
?>
<div class="container-fluid main-content">
        <div class="page-title hidden-print">
          <h2 style='margin-top:-20px; margin-bottom: 5px;'>
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
			  
	<li class="list-group-item">
	  <a href="suarepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Item Used Report
                </p>
              </a></li>

	 <li class="list-group-item active">
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
                       <div class="col-lg-8 hidden-print">

					   <div class="col-lg-4"> </div><div class="col-lg-4"> 
					   
			   <select class="form-control" name="custo">
	<option value='' selected='selected'> SELECT AN ITEM </option>
<?php
$do=mysql_query("SELECT *FROM `items` WHERE `Status`='0' AND `Store`='2' ORDER BY `Iname` ASC LIMIT 500");
		while($ro=mysql_fetch_assoc($do)){
			$nuo=$ro['Number'];
			$iname=$ro['Iname'];
			$cost=number_format($ro['Cost']);
			$descri=$ro['Descri'];
			$uno=$ro['Unit'];
	$dox=mysql_query("SELECT *FROM `unit` WHERE `Number`='$uno' ORDER BY `Number` ASC");
					$rox=mysql_fetch_assoc($dox);
							$unit=$rox['Unit'];

	echo"<option value='$nuo'> $iname $descri </option>";
		}
		?></select>
					   
					</div>                     
                       
                       <div class="col-lg-3">
                        <button class="btn  btn-primary btn-block" type="submit" name="search"><i class="lnr lnr-magnifier"></i> Search</button>
                   
					  </div>
                         </div>                 
                     
                  
            </form> 
             
               
            </div>

			<div class="divFooter"><center><u><b>ITEM CONFIGURATION REPORT</b></u></center></div>
             <div class="row">
            <div class="col-lg-12">
             <span>Total Records Found : <b><?php echo" $fov " ?></b></span><span class="pull-right"><b>PRODUCTION</b>
			 &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix"><br>

			<?php
			while($rov=mysql_fetch_assoc($dov)){
			$code=$rov['Number'];
			$descri=$rov['Descri'];
			$iname=$rov['Iname'];
			$cst=$rov['Price'];
			$costi=$rov['Cost'];
			if($costi>0){
		echo"<b>$iname $descri</b>";
			?>
               
                                 <table class="table table-striped table-hover">     
                                      <thead>
                     <tr role="row">
                     <th class="hidden-xs"> No </th> 
                       <th> Items </th> 
                       <th> Unit </th>
                       <th> Quantity </th>
                        <th> Portion </th>
						 <th> Price/Unit </th>
                       <th> Tot.&nbsp;Price </th>
						 <th> Yield </th>
						 <th> Purchase </th>
						 <th> Sales </th>
						 <th> Cost&nbsp;% </th>
                     </tr>
                    </thead>
                                        <tbody>
					<?php
					$n=1;				$tp=0;	
						
	$dou=mysql_query("SELECT *FROM `iconfig` WHERE `Item`='$code' ORDER BY `Number` ASC");
				while($rou=mysql_fetch_assoc($dou)){
							$ico=$rou['Number'];
							$ingre=$rou['Ingre'];
							$count=$rou['Count'];
							$qti=$rou['Quantity'];

			$dop=mysql_query("SELECT *FROM `items` WHERE `Number`='$ingre' ORDER BY `Number` DESC LIMIT 1");
				$rop=mysql_fetch_assoc($dop);
					$ine=$rop['Iname'];
					$des=$rop['Descri'];
					$cost=$rop['Cost'];
					$uno=$rop['Unit'];
					$amo=($qti*$cost);				

				$dox=mysql_query("SELECT *FROM `unit` WHERE `Number`='$uno' ORDER BY `Number` ASC");
					$rox=mysql_fetch_assoc($dox);
							$unit=$rox['Unit'];

         $amoo=number_format($amo, 2);						$stn="padding:1px;";		
									$qty=number_format($qti, 2);				$prio=number_format($cost);
		print("<tr>
          <td class='hidden-xs' style='$stn'><div align='center'>$n&nbsp;&nbsp;</td>
			<td style='$stn'> $ine $des </td><td style='$stn'> $unit </td><td style='$stn'><div align='right'> $qti </td>
                <td style='$stn'><div align='right'> $qty &nbsp;&nbsp;</td><td style='$stn'><div align='right'> $prio &nbsp;&nbsp;</td>
				<td style='$stn'><div align='right'> $amoo &nbsp;&nbsp;</td><td style='$stn'><div align='right'> </td>
				<td style='$stn'><div align='right'> </td><td style='$stn'><div align='right'> </td>
				<td style='$stn'><div align='right'> </td></tr>");
						  $n++;					$tp+=$amo;
						}

					$per=$tp/$cst*100;
						$tpo=number_format($tp, 2);				$pero=number_format($per, 2);				$csto=number_format($cst, 2);			
						?>
						
                     </tbody><thead>
					<tr><th class='hidden-xs'> </th>
					<th colspan='5'><div align='center'> Total Amount </th>
				<th><div align='right'><?php echo $tpo ?>&nbsp;</th><th><div align='right'>1&nbsp;</th>
				<th><div align='right'><?php echo $tpo ?>&nbsp;</th><th><div align='right'><?php echo $csto ?>&nbsp;</th>
				<th><div align='right'><?php echo $pero ?>%&nbsp;</th></tr>
                  </table><br>
				  <?php
						 $then=mysql_query("UPDATE `items` SET `Cost`='$tp' WHERE `Number`='$code' LIMIT 1");
			}
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
