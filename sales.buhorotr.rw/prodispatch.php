<?php
if(basename($_SERVER['PHP_SELF']) == 'prodispatch.php') 
  $cm=" class='current'";
include'header.php';
include'connection.php';
$dato=$datos=$Date;
$custo='';
$conde='';
$fiva='FIGURE';

if(isset($_POST['search']))
		{
			$custo=$_POST['custo'];
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$fiva=$_POST['fiva'];
		}

$do=mysql_query("SELECT *FROM `stouse` WHERE `Date` BETWEEN '$dato' AND '$datos' AND `Status`='0' AND `Voucher`!='0' AND `Action`='TAKEN' AND `Store`='2' GROUP BY `Item` ORDER BY `Number` ASC");
$fo=mysql_num_rows($do);
?>
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
	
	<li class="list-group-item active">
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
         
           <div class="col-lg-3"> </div>
          
         
           

        <form action="" method="post" class="form-horizontal ">                  
                       <div class="col-lg-9 hidden-print"><div class="col-lg-2"> 
	<select class="form-control" name="fiva" required>
			  
			   <?php
			   if($fiva=='FIGURE')
			echo"<option value='FIGURE'> FIGURE </option><option value='VALUE'> VALUE </option>";
				else
			echo"<option value='VALUE'> VALUE </option><option value='FIGURE'> FIGURE </option>";
			?>    
                            </select>
		   
		   </div>  <div class="col-lg-2"> 
					   
			      <select class="form-control" name="custo">
			<?php
			if($custo=='PRODUCTION A')
					$p='selected';
				else
					$p='';

if($custo=='PRODUCTION B')
					$pe='selected';
				else
					$pe='';

				echo"<option value='' selected='selected'> SELECT DESTINATION </option>
				<option value='PRODUCTION A' $p> SNACKS </option><option value='PRODUCTION B' $pe> BAKERY </option>";
			?>		</select>
					   
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

			<div class="divFooter"><center><u><b>PRODUCTION REPORT <?php echo $mpri ?></b></u></center></div>
             <div class="row">
            <div class="col-lg-12">
             <span>Total Records Found : <b><?php echo" $fo " ?></b></span>
			 <span class="pull-right"><b>PRODUCTION</b>
			 &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">
	
	
              <table class="table table-striped table-hover">     
                                      <thead>
                     <tr role="row">
                     <th class="hidden-xs"> No </th>
                       <th> Item&nbsp;Name </th>
                        <th> Description </th>
			   <?php
	$doi=mysql_query("SELECT `Destin` FROM `stouse` WHERE `Destin`!='' AND `Date` BETWEEN '$dato' AND '$datos' AND `Voucher`>'0' AND `Status`='0' AND `Action`='TAKEN' AND `Store`='2' GROUP BY `Destin` ORDER BY `Destin` ASC");
			while($roi=mysql_fetch_assoc($doi)){
				$fna=$roi['Destin'];				

				if($fna=='PRODUCTION A')
					$fno='SNACKS';
				elseif($fna=='PRODUCTION B')
					$fno='BAKERY';
				else
					$fno=$fna;
				$fna = substr("$fno", 0, 8);
			echo"<th><div align='right'> $fna </th>";
			}
			?>	
                     <th><div align='right'>TOTAL</div></th></tr>
                    </thead>
                                        <tbody>
					<?php
					$n=1;				$tp=0;			
						while($ro=mysql_fetch_assoc($do)){
				$code=$ro['Number'];
				$item=$ro['Item'];
			$qt=$ro['Quantity'];
			$dte=$ro['Date'];
			$type=$ro['Destin'];
			$user=$ro['User'];

	$dov=mysql_query("SELECT *FROM `items` WHERE `Number`='$item' AND `Store`='2' ORDER BY `Number` DESC LIMIT 1");
		$rov=mysql_fetch_assoc($dov);
			$kin=$rov['Type'];
			$descri=$rov['Descri'];
			$uno=$rov['Unit'];
			$iname=$rov['Iname'];

$stn="padding:1px;";	

$dove=mysql_query("SELECT *FROM `stouse` WHERE `Item`='$item' AND `Action`='PRODUCE' AND `Destin`='PRODUCTION A' AND `Date`>='2019-04-01' ORDER BY `Number` DESC LIMIT 1");
	$fove=mysql_num_rows($dove);

$dovi=mysql_query("SELECT *FROM `stouse` WHERE `Item`='$item' AND `Action`='PRODUCE' AND `Destin`='PRODUCTION B' AND `Date`>='2019-04-01' ORDER BY `Number` DESC LIMIT 1");
	$fovi=mysql_num_rows($dovi);
				
if(($custo=='PRODUCTION A' AND $fove>='1') OR ($custo=='PRODUCTION B' AND $fovi>='1') OR ($custo=='')){									
		print("<tr>
          <td class='hidden-xs' style='$stn'>
          <div align='center'>$n&nbsp;</td><td style='$stn'> $iname </td>
			<td style='$stn'> $descri </td>");
$tp=0;
          
	$doi=mysql_query("SELECT `Destin` FROM `stouse` WHERE `Destin`!='' AND `Date` BETWEEN '$dato' AND '$datos' AND `Voucher`>'0' AND `Status`='0' AND `Action`='TAKEN' AND `Store`='2' GROUP BY `Destin` ORDER BY `Destin` ASC");
			while($roi=mysql_fetch_assoc($doi)){
				$fna=$roi['Destin'];
	$dox=mysql_query("SELECT `Price`, SUM(Quantity) AS 'QTY' FROM `stouse` WHERE `Date` BETWEEN '$dato' AND '$datos' AND `Status`='0' AND `Action`='TAKEN' AND `Voucher`!='0' AND `Store`='2' AND `Item`='$item' AND `Destin`='$fna' GROUP BY `Item` ORDER BY `Number` ASC");
	if($fox=mysql_num_rows($dox)){
	    $rox=mysql_fetch_assoc($dox);
	        $qty=$rox['QTY'];
$pri=$rox['Price'];
	}
	else
	    $qty=0;

if($fiva=='VALUE')
$qty=$qty*$pri;
	    
	    $qto=number_format($qty, 2);
			echo"<td style='$stn'><div align='right'> $qto &nbsp;</td>";
			$tp+=$qty;
				}
						$tpo=number_format($tp, 2);	
				print("<td style='$stn'><div align='right'><b> $tpo </td></tr>");
						  $n++;					$tp+=$tot;

}
}

						?>
						
                     </tbody>
                  </table><br>

              </div>
            </div></div>
                  </div> 
				  <span class="pull-right hidden-print">
			 &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
      
   </div></div></div>   
 
   <?php
   include'footer.php';
   ?>
