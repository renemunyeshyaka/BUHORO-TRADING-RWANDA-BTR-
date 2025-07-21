<?php
if(basename($_SERVER['PHP_SELF']) == 'subrepo.php') 
  $cm=" class='current'";
include'header.php';
include'connection.php';
$dato=$datos=$Date;
$conde=$custo='';

if(isset($_POST['search']))
		{
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$custo=$_POST['custo'];
		}

		
		if($custo){
			$conde="AND (`Supplier`='$custo')";
			$lim=999999999;
		}
		else{
			$conde='';
			$lim=140;
		}

		if($dato==$datos)
			$mpri="ON $dato";
		else
			$mpri="FROM $dato TO $datos";

$do=mysql_query("SELECT *FROM `suppliers` WHERE `Status`='0' $conde ORDER BY `Number` DESC LIMIT $lim");
$fo=mysql_num_rows($do);
?>
<div class="container-fluid main-content">
        <div class="page-title">
          <h3 style='margin-top:-20px; margin-bottom: 5px; color:#ffcc33'>
         Suppliers Report
          </h3>
                 </div>
     
        <div class="row">
  <div class="col-lg-2 hidden-print">
   
   <ul class="list-group">

    <li class="list-group-item">
	  <a href="suprepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Suppliers Report
                </p>
              </a></li> 

    <li class="list-group-item">
	  <a href="payrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Payment Report
                </p>
              </a></li>  

    <li class="list-group-item">
	  <a href="advarepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Advance Report
                </p>
              </a></li>  

    <li class="list-group-item active">
	  <a href="subrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Balance Report
                </p>
              </a></li> 
                         
            </ul>
  </div>
                    
           
           
       
       <div class="col-lg-10">
                  <div class="row">
         
           <div class="col-lg-1"> </div>
          
         
           

        <form action="" method="post" class="form-horizontal ">                  
                       <div class="col-lg-11 hidden-print"><div class="col-lg-3"> 
					   
			   
					   
					   </div>
					   <div class="col-lg-3"> 
					   
			   <select class="form-control" name="custo">
 <?php
				echo"<option value='' selected='selected'> SELECT SUPPLIER </option>";
				  $top=mysql_query("SELECT `Destin` FROM `stouse` WHERE `Status`='0' AND `Action`='RECEIVE' GROUP BY `Destin` ORDER BY `Destin` ASC");
						while($rop=mysql_fetch_assoc($top)){
							$sup=$rop['Destin'];
			echo"<option value='$sup'> $sup </option>";
						}
						?>
			   </select>
					   
					   </div>
            <div class="col-lg-2"> 
           <div class="input-group date datepicker">
      <input class="form-control form-center" id="from" name="dato" type="text" value="<?php echo $dato ?>" onkeypress='return isNumberKey(event)' required>
	  <span class="input-group-addon"><i class="lnr lnr-calendar-full"></i></span>
			</div></div>


		  <div class="col-lg-2"> 
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

             <div class="divFooter"><center><u><b>SUPPLIERS BALANCE REPORT <?php echo $mpri ?></b></u></center></div>
             <div class="row">
            <div class="col-lg-12">
             <span>Total Records Found : <b><?php echo" $fo " ?></b></span>
			 <span class="pull-right hidden-print">&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer hidden-print"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">

			<div class='table-responsive'><table class="table table-striped table-hover">     
                                      <thead>
                    <tr role="row"> <th> S.NO</th>
                        <th class='text-center'> Due&nbsp;Date </th><th> Name </th><th> Address </th>
                        <th> Telephone </th><th><div align='right'> &nbsp;Supplies </th>
						<th><div align='right'> &nbsp;Payment </th><th><div align='right'> &nbsp;Balance </th></tr>
                    </thead>
                                        <tbody>
		<?php
					$n=1;			$toti=$payi=0;	
			while($ro=mysql_fetch_assoc($do)){
				$code=$ro['Number'];
				$name=$ro['Supplier'];
				$dte=$ro['Cdate'];
				$addre=$ro['Address'];
				$tele=$ro['Telephone'];
				$tot=$pay=0;

				$stl="style='padding:0px;'";

	$doxe=mysql_query("SELECT `Date`, SUM(`Quantity`*`Price`) AS 'Tot' FROM `stouse` WHERE `Voucher` != '0' AND `Status`='0' AND `Action`='RECEIVE' AND `Destin`='$name' ORDER BY `Number` ASC");
		$roxe=mysql_fetch_assoc($doxe);		
			$tot=$roxe['Tot'];			
			$dao=$roxe['Date'];
			
	$toto=number_format($tot);

$doxi=mysql_query("SELECT SUM(`supay`.`Amount`) AS 'PAY' FROM `supay` WHERE (`supay`.`Amount` > '0' AND `supay`.`Supplier`='$name' AND `supay`.`Status`='0')");	
		$roxi=mysql_fetch_assoc($doxi);				
			$pay+=$roxi['PAY'];

$doxu=mysql_query("SELECT SUM(`payment`.`Amount`) AS 'ADVA' FROM `payment` WHERE (`payment`.`Status`='0' AND `payment`.`Customer`='$name' AND `payment`.`Payment`='10' AND `payment`.`Action`='PURCHASE' AND `payment`.`Voucher`>='2147483647')");			
		$roxu=mysql_fetch_assoc($doxu);
			$pay+=$roxu['ADVA'];

		if($dte=='0000-00-00')
			$con=", `Cdate`='$dao'";
		else
			$con="";

				$bal=$tot-$pay;	
			$then=mysql_query("UPDATE `suppliers` SET `Balance`='$bal' $con WHERE `Number`='$code' LIMIT 1");
						$payo=number_format($pay);								$balo=number_format($bal);
if($bal!=0)
print("<tr><td $stl><div align='center'>$n&nbsp;&nbsp;</td><td $stl><div align='center'> $dte </td>
	<td $stl>$name</td><td $stl> $addre </td><td class='text-right' $stl> $tele </td><td $stl><div align='right'>&nbsp;$toto&nbsp;</td>
	<td $stl><div align='right'>&nbsp;$payo&nbsp;</td><td $stl><div align='right'>&nbsp;$balo&nbsp;</td></tr>");
			$n++;							$toti+=$tot;						$payi+=$pay;
	}
				$balo=number_format($toti-$payi);					         $toto=number_format($toti);						$payo=number_format($payi);
		print("<tr><th colspan='5' style='padding-left:80px;'> Total Amount </th><th colspan='1'><div align='right'>&nbsp;$toto</th>
		<th colspan='1'><div align='right'>&nbsp;$payo</th><th colspan='1'><div align='right'>&nbsp;$balo</th></tr>");
				?>
                  </table><br></div>



              </div></div></div>                
                
              </div><span class="pull-right hidden-print">
			 &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
      
   </div></div></div>
   <?php
   include'footer.php';
   ?>