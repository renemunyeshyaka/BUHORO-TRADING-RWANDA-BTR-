<?php
if(basename($_SERVER['PHP_SELF']) == 'prorequi.php') 
  $kk=" class='current'";
include'header.php';
include'connection.php';
$dato=$datos=$Date;
$conde='';
$custo='TOTAL';

if(isset($_POST['search']))
		{
			$dato=$_POST['dato'];
			$custo=$_POST['custo'];
		}
		
		if($custo!='' AND $custo!='TOTAL')
			$conde="AND `Destin` = '$custo'";
		else
			$conde="AND `Destin` !=''";

			$mpri="ON $dato";

$do=mysql_query("SELECT *FROM `requis` WHERE `Date` = '$dato' AND `Status`='0' AND `Action`='INTERNAL' AND `Voucher`!='0' AND `Direct`='1' $conde GROUP BY `Item` ORDER BY `Number` ASC");
$fo=mysql_num_rows($do);
?>
<div class="container-fluid main-content">
       
        <div class="col-lg-12">
                  <div class="row">
         
           <div class="col-lg-4"> </div>
          
         
           

        <form action="" method="post" class="form-horizontal ">  
        <div class="col-lg-3"> </div>
        
                       <div class="col-lg-8 hidden-print"><div class="col-lg-3">
					   
			   <select class="form-control" name="custo">
			   <?php
			   if($custo=='TOTAL')
				$t='selected';
			else
				$t='';
				?>
			   <option value='TOTAL' <?php echo $t ?>>TOTAL ONLY</option>
			    <?php
	$doi=mysql_query("SELECT `Destin` FROM `requis` WHERE `Destin`!='' AND `Voucher`>'0' AND `Status`='0' GROUP BY `Destin` ORDER BY `Destin` ASC");
			while($roi=mysql_fetch_assoc($doi)){
				$fna=$roi['Destin'];
				if($custo==$fna)
					$s='selected';
				else
					$s='';

				if($fna=='PRODUCTION A')
					$fno='SNACKS';
				elseif($fna=='PRODUCTION B')
					$fno='BAKERY';
				else
					$fno=$fna;
			echo"<option value='$fna' $s> $fno &nbsp;&nbsp;</option>";
			}
			?>

			  <?php
			   if($custo=='')
				$b='selected';
			else
				$b='';
				?>
			   <option value='' <?php echo $b ?>>ALL BRANCHES</option></select>
					   
					   </div>
            <div class="col-lg-3"> 
           <div class="input-group date datepicker">
      <input class="form-control form-center" id="from" name="dato" type="text" value="<?php echo $dato ?>" onkeypress='return isNumberKey(event)' required>
	  <span class="input-group-addon"><i class="lnr lnr-calendar-full"></i></span>
			</div></div>
                       
                       <div class="col-lg-2">
                        <button class="btn  btn-primary btn-block" type="submit" name="search"><i class="lnr lnr-magnifier"></i> Search</button>
                   
					  </div>
                         </div> 
                      
                     
                  
            </form> 
             
               
            </div>

			<div class="divFooter"><center><u><b>REQUISITION REPORT <?php echo $mpri ?></b></u></center></div>
             <div class="row">
            <div class="col-lg-12">
             <span>  <b><?php echo" $fol " ?></b></span>
			 <span class="pull-right"><b>MARKET</b>
			 &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to open delivery voucher' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">
               
                                 <table class="table table-striped table-hover">     
                                      <thead>
                     <tr role="row">
                     <th class="hidden-xs"> No </th>
                       <th> ITEM&nbsp;NAME </th>
			   <?php
			   if($custo!='TOTAL'){
	$doi=mysql_query("SELECT `Destin` FROM `requis` WHERE `Destin`!='' AND `Voucher`>'0' AND `Status`='0' $conde GROUP BY `Destin` ORDER BY `Destin` ASC");
			while($roi=mysql_fetch_assoc($doi)){
				$fna=$roi['Destin'];
				if($fna=='PRODUCTION A')
					$fno='SNACKS';
				elseif($fna=='PRODUCTION B')
					$fno='BAKERY';
				else
					$fno=$fna;
				$fna = substr("$fno", 0, 3);
			echo"<th><div align='right'> $fna </th>";
			}
			   }
			?>	
                    
					 
					 <?php
					 if($custo=='' OR $custo=='TOTAL')
		echo"<th><div align='right'>TOT</div></th>";
			?></tr>
                    </thead>
                                        <tbody>
					<?php
					$n=1;			
						while($ro=mysql_fetch_assoc($do)){
				$code=$ro['Number'];
				$item=$ro['Item'];
			$qt=$ro['Quantity'];
			$dte=$ro['Date'];
			$type=$ro['Destin'];
			$user=$ro['User'];

	$dov=mysql_query("SELECT *FROM `items` WHERE `Number`='$item' AND `Direct`='1' ORDER BY `Number` DESC LIMIT 1");
	if($fov=mysql_num_rows($dov)){
		$rov=mysql_fetch_assoc($dov);
			$kin=$rov['Type'];
			$descri=$rov['Descri'];
			$uno=$rov['Unit'];
			$iname=$rov['Iname'];

$stn="padding:1px;";					
										$tp=0;	
		print("<tr>
          <td class='hidden-xs' style='$stn'>
          <div align='center'>$n&nbsp;</td><td style='$stn'> $iname &nbsp; $descri </td>");
          
	$doi=mysql_query("SELECT `Destin` FROM `requis` WHERE `Destin`!='' AND `Voucher`>'0' AND `Status`='0' $conde GROUP BY `Destin` ORDER BY `Destin` ASC");
			while($roi=mysql_fetch_assoc($doi)){
				$fna=$roi['Destin'];
	$dox=mysql_query("SELECT SUM(Quantity) AS 'QTY' FROM `requis` WHERE `Date` = '$dato' AND `Status`='0' AND `Action`='INTERNAL' AND `Voucher`!='0' AND `Direct`='1' AND `Item`='$item' AND `Destin`='$fna' GROUP BY `Item` ORDER BY `Number` ASC");
	if($fox=mysql_num_rows($dox)){
	    $rox=mysql_fetch_assoc($dox);
	        $qty=$rox['QTY'];
	}
	else
	    $qty=0;
	    
	    $qto=number_format($qty, 2);
	     if($custo!='TOTAL')
			echo"<td><div align='center'> $qto </td>";
			$tp+=$qty;
				}
						$tpo=number_format($tp, 2);	
						 if($custo=='' OR $custo=='TOTAL')
				print("<td><div align='right'><b> $tpo&nbsp;</td>");
						 
						 print("</tr>");
						  $n++;					$tp+=$tot;
						}
						}		
						?>
						
                     </tbody>
                  </table>                   
                
              </div>
            </div></div>
                  </div> <span class="pull-right">
			 &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to open delivery voucher' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
      
   </div></div></div>
 
   <?php
   include'footer.php';
   ?>
