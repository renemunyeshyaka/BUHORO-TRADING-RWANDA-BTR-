<?php
if(basename($_SERVER['PHP_SELF']) == 'prodaily.php') 
  $cm=" class='current'";
include'header.php';
include'connection.php';
$dato=$datos=$Date;
$custo='';
$conde='';

if(isset($_POST['search']))
		{
			$custo=$_POST['custo'];
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
		}

		
		if($custo){
			$conde="AND `Destin` LIKE '%$custo%'";
			$lim=999999999;
		}
		else{
			$conde='';
		}

$do=mysql_query("SELECT *FROM `stouse` WHERE `Date` BETWEEN '$dato' AND '$datos' AND `Status`='0' AND `Voucher`!='0' AND `Action`='PRODUCE' $conde GROUP BY `Voucher` ORDER BY `Date` ASC");
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

     <li class="list-group-item active">
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
                       <div class="col-lg-9 hidden-print"><div class="col-lg-3"> 
					   
			   <select class="form-control" name="custo">
			<?php
				echo"<option value='' selected='selected'> DESTINATION </option>";
			
	 $top=mysql_query("SELECT `Destin` FROM `Stouse` WHERE `Status`='0' AND `Destin`!='' AND `Action`='PRODUCE' GROUP BY `Destin` ORDER BY `Destin` DESC LIMIT 20");
			while($rop=mysql_fetch_assoc($top)){
				$sup=$rop['Destin'];
				if($custo==$sup)
					$t='selected';
				else
					$t='';

				if($sup=='PRODUCTION A')
					$supo='SNACKS';
				else
					$supo='BAKERY';
			echo"<option value='$sup' $t> $supo </option>";
			}
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
	
	<?php
while($ro=mysql_fetch_assoc($do)){
	$vous=$ro['Voucher'];

$dor=mysql_query("SELECT *FROM `stouse` WHERE `Date` BETWEEN '$dato' AND '$datos' AND `Status`='0' AND `Voucher`='$vous' AND `Action`='PRODUCE' ORDER BY `Number` ASC");
	?>
        
             <table class="table table-striped">     
                                      <thead>
                    <tr role="row">
                     <th class="hidden-xs"> NO </th>
					 <th> Due&nbsp;Date </th>
					 <th> Producer </th>
                       <th> Item&nbsp;Name </th>
                        <th> Description </th>
                       <th> Item&nbsp;Type </th>
						 <th> Cost Price </th><th> Sale Price </th>
                       <th> Unit </th>
                        <th><div align='center'> Requested </th><th><div align='center'> Produced </th>
						<th><div align='center'> Balance </th>
                     </tr>
                    </thead>
                                        <tbody>
					<?php
					$n=1;		
						while($ror=mysql_fetch_assoc($dor)){
						$code=$ror['Number'];
						$item=$ror['Item'];
						$sale=$ror['Price'];			
						$cost=$ror['Cost'];	
						$qty=$ror['Quantity'];
						$dte=$ror['Date'];
						$voi=$ror['Voucher'];
						$pers=$ror['Person'];
			
	$dou=mysql_query("SELECT *FROM `items` WHERE `Number`='$item' ORDER BY `Number` DESC LIMIT 1");
		$rou=mysql_fetch_assoc($dou);
			$iname=$rou['Iname'];
			$kin=$rou['Type'];
			$descri=$rou['Descri'];
			$uno=$rou['Unit'];
			$pri=$rou['Price'];

$doi=mysql_query("SELECT *FROM `itype` WHERE `Number`='$kin' ORDER BY `Number` ASC");
		$roi=mysql_fetch_assoc($doi);
				$type=$roi['Type'];

				$dox=mysql_query("SELECT *FROM `unit` WHERE `Number`='$uno' ORDER BY `Number` ASC");
					$rox=mysql_fetch_assoc($dox);
							$unit=$rox['Unit'];

			$costo=number_format($cost, 2);			$prio=number_format($pri, 2);


			$doki=mysql_query("SELECT `Quantity` FROM `stouse` WHERE `Produce`='$voi' AND `Status`='0' AND `Upda`='1' AND `Item`='$item' AND `Action`='RECEIVE' ORDER BY `Number` ASC");
					$roki=mysql_fetch_assoc($doki);
						$rec=$roki['Quantity'];
							$b=$qty-$rec;

	   $qty=number_format($qty, 2);					$rec=number_format($rec, 2);						$b=number_format($b, 2);
		print("<tr>
                        <td class=hidden-xs><div align='center'>$n&nbsp;&nbsp;</td>
						<td> $dte </td><td> $pers </td><td> $iname </td><td> $descri </td>
                        <td> $type </td><td><div align='right'> $costo </th>
						<td><div align='right'> $prio </td><td> $unit </td>
						
						<td><div align='right'> $qty </td>
						<td><div align='right'> $rec </td>						 
						 <td><div align='right'> $b </div></td></tr>");
						  $n++;
						}
						
						?>
						
                    </tbody>
                  </table><br><br>

				  <?php
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
