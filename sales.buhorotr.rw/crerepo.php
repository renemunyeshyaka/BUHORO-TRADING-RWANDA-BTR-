<?php
if(basename($_SERVER['PHP_SELF']) == 'crerepo.php') 
  $cm=" class='current'";
include'header.php';
include'connection.php';
$dato=$datos=$Date;
$custo=$condi='';
$conde=$brc='';
$t=$p=0;

// search for an item to be added to the chart
if(isset($_POST['search']))
		{
			$brc=$_POST['brc'];
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$p=1;
		}

		if($dato==$datos)
			$mpri="ON $dato";
		else
			$mpri="FROM $dato TO $datos";

	if($brc){
		$conde="AND `Customer`='$brc'";
		$condi="AND `Destin`='$brc'";
	}

$rece=mysql_query("SELECT `Name` FROM `branches` WHERE `Number`='$brc' ORDER BY `Number` DESC LIMIT 1");
				$recet=mysql_fetch_assoc($rece);
					$bra=$recet['Name'];
?>
<div class="container-fluid main-content">
        <div class="page-title hidden-print">
          <h3 style='margin-top:-20px; margin-bottom: 5px; color:#ffcc33'>
         Sales Report
          </h3>
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

    <li class="list-group-item">
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

	 <li class="list-group-item active">
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
         
           <div class="col-lg-3"> </div>
          
         
           

        <form action="" method="post" class="form-horizontal ">                  
                       <div class="col-lg-3"> 
			<select class="form-control" name="brc" style='padding-right:5px;'>
			   <?php
echo"<option value='0' selected='selected'> SELECT CUSTOMER </option>";
	$seek=mysql_query("SELECT `Destin` FROM `stouse` WHERE `Destin`!='' AND `Status`='0' AND `Upda`='1' AND `Action`='SALES' GROUP BY `Destin` ORDER BY `Destin` ASC LIMIT 1800");
			if($feek=mysql_num_rows($seek)){
		while($roi=mysql_fetch_assoc($seek)){
				$fna=$roi['Destin'];
				if($brc==$fna)
					$s='selected';
				else
					$s='';
			echo"<option value='$fna' $s> $fna &nbsp;&nbsp;</option>";
			}
			}

			?>			    
            </select>
					   </div>
            <div class="col-lg-6 hidden-print"><div class="col-lg-4"> 
           <div class="input-group date datepicker">
      <input class="form-control form-center" id="from" name="dato" type="text" value="<?php echo $dato ?>" onkeypress='return isNumberKey(event)' required>
	  <span class="input-group-addon"><i class="lnr lnr-calendar-full"></i></span>
			</div></div>


		  <div class="col-lg-4"> 
           <div class="input-group date datepicker">	
      <input class="form-control form-center" id="to" name="datos" type="text" value="<?php echo $datos ?>" onkeypress='return isNumberKey(event)' required>
	  <span class="input-group-addon"><i class="lnr lnr-calendar-full"></i></span>
              </div></div>                      
                       
                       <div class="col-lg-3">
                        <button class="btn  btn-primary btn-block" type="submit" name="search"><i class="lnr lnr-magnifier"></i> Search</button>
                   
					  </div>
                         </div> 
                      
                     
                  
            </form> 
             
               
            </div>
               <?php
			  
		$dox=mysql_query("SELECT *FROM `payment` WHERE `Status`='0' AND `Pline`='CREDIT' AND `Voucher`!='0' AND `Action`='SALES' AND `Date` BETWEEN '$dato' AND '$datos' $conde GROUP BY `Voucher` ORDER BY `Voucher` ASC LIMIT 1000");
				if($fox=mysql_num_rows($dox)){
					?>
					<div class="divFooter"><center><u><b>CREDIT REPORT <?php echo"$mpri"; ?></b></u></center></div>
		 <div class="row">
            <div class="col-lg-12">
             <span> &nbsp;&nbsp; Total Records Found : <b><?php echo" $for " ?></b></span>
			 <span class="pull-right hidden-print"><?php echo $bra ?>&nbsp;&nbsp;&nbsp;&nbsp;
			 <a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'>
			 <i class="lnr lnr-printer"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">
			
			<?php
				$tcre=0;			$i=1;
	while($rox=mysql_fetch_assoc($dox)){
		$vous=$rox['Voucher'];
	$do=mysql_query("SELECT *FROM `stouse` WHERE `Status`='0' AND `Action`='SALES' AND `Voucher`='$vous' $condi ORDER BY `Number` ASC LIMIT 100");
			   ?>
             
		<form action="" method="post">
				<table class="table table-striped">     
                       <thead><tr role="row">
                     <th width='5%' class="hidden-xs">&nbsp;&nbsp;&nbsp;&nbsp;# </th>
                       <th width='10%'> Due&nbsp;Date </th>
                       <th> Cashier </th>
                       <th> Customer </th>
                       <th> Item&nbsp;Type </th>
                        <th> Item&nbsp;Name </th>
                       <th width='5%'> Price </th>
                       <th width='5%'> Quantity </th>
						<th width='5%'>Amount</th>
                     </tr>
                    </thead>
                                        <tbody>
					<?php
					$n=1;				$tot=0;	
						while($ro=mysql_fetch_assoc($do)){
							$num=$ro['Number'];
				$vou=$ro['Voucher'];
				$dte=$ro['Date'];
				$user=$ro['User'];
				$pri=$ro['Price'];
				$prio=number_format($pri);
				$qty=$ro['Quantity'];
				$item=$ro['Item'];
				$waiter=$ro['Invoice'];
				$tabl=$ro['Branche'];
				$custo=$ro['Destin'];
				$to=$qty*$pri;
				$too=number_format($to);

	$dop=mysql_query("SELECT *FROM `items` WHERE `Number`='$item' ORDER BY `Number` DESC LIMIT 1");
				$rop=mysql_fetch_assoc($dop);
				    $kin=$rop['Type'];
					$iname=$rop['Iname'];
					$sup=$custo;
					
	$doi=mysql_query("SELECT *FROM `itype` WHERE `Number`='$kin' ORDER BY `Number` ASC");
		$roi=mysql_fetch_assoc($doi);
				$type=$roi['Type'];

					$stn="padding:0px;";

		print("<tr>
		<td class=hidden-xs style='$stn'><div align='center'>$n&nbsp;&nbsp;</td><td style='$stn'> $dte </td><td style='$stn'> $user </td>
		<td style='$stn'><div align='left'> $sup </td><td style='$stn'><div align='left'> $type </td><td style='$stn'> $iname </td>

		<td style='padding:0px;'><input name='pri' class='form-control' type='text' onkeyup='format(this);' onkeypress='return isNumberKey(event);' onChange=this.style.color='#ff3366' style='text-align:right; width:80px; height:20px; margin:0px 2px 0px 0px; padding:0px 10px 0px 0px;' value='$prio' readonly></td>

		<td style='padding:0px;'><input name='qty' class='form-control' type='text' onkeyup='format(this);' onkeypress='return isNumberKey(event);' onChange=this.style.color='#ff3366' style='text-align:right; width:80px; height:20px; margin:0px 2px 0px 0px; padding:0px 10px 0px 0px;' value='$qty' readonly></td>
						
		<td style='padding:0px;'><input name='tot' class='form-control' type='text' onkeyup='format(this);' onkeypress='return isNumberKey(event);' onChange=this.style.color='#ff3366' style='text-align:right; width:80px; height:20px; margin:0px 0px 0px 0px; padding:0px 10px 0px 0px;' value='$too' readonly></td></tr>");
						  $n++;					$tot+=$to;
						}
						$tpo=number_format($tot);						

				$pay=$cre=0;
	$spa=mysql_query("SELECT *FROM `payment` WHERE `Voucher`='$vou' AND `Status`='0' AND `Branche`='$tabl' AND `Action`='SALES' AND `Pline`!='CREDIT' $conde ORDER BY `Number` ASC");
				while($rpa=mysql_fetch_assoc($spa)){
						$pay+=$rpa['Amount'];
				}
				
					$cre=$tot-$pay;
				$payo=number_format($pay);			
				$creo=number_format($cre);

	         if($pay>'0')
		$tpo="$tpo - $payo = $creo";

				$tcre+=$cre;
					?>	
						
            </tbody><thead><tr><th class='hidden-xs'> </th><th style='padding:3px;'>					
      <button type='button' class='btn btn-xs btn-warning hidden-print' style='height:18px; padding:0px; margin:0px; width:80px;' title='Click to open payment' data-toggle='tooltip' data-placement='top' onclick="window.location.href = 'dadd.php'">&nbsp;&nbsp;
	  <i class='lnr lnr-download'></i>&nbsp;&nbsp;PAY&nbsp;&nbsp;</button>
	  <?php
									$i++;
						  ?>
					
					
					
					 </th><th colspan='4' style='color:powderblue; font-size:10px; padding:3px'><div align='center'>Order&nbsp;No:&nbsp;<?php echo $vou ?></th>
					<th colspan='3' style='padding:0px;'><div align='right'><?php echo"<input name='tot' class='form-control' type='text' onkeyup='format(this);' onkeypress='return isNumberKey(event);' onChange=this.style.color='#ff3366' style='text-align:right; width:100%; height:20px; margin:0px 0px 0px 0px; padding:0px 10px 0px 0px; margin:0px; font-weight:bold; color:#ff66cc;' value='$tpo' readonly>"; ?></th></tr>
                  </table>

				  <?php
				}
				  $tcre=number_format($tcre);
				  print("<div class='pull-right'>TOTAL CREDIT&nbsp;:&nbsp;&nbsp;<b>$tcre</b>&nbsp;&nbsp;&nbsp;</div><br>");
				}
					else{
						echo"<div class='row'>
            <div class='col-lg-12' style='margin-top:-20px;'>
             <span> &nbsp;&nbsp; Total Records Found : <b> 0 </b></span>
			 <span class='pull-right hidden-print'> $bra &nbsp;&nbsp;<a href='#' onclick='return window.print()' class='hidden-print' title='Click to print' data-toggle='tooltip' data-placement='top'><i class='lnr lnr-printer'></i></a></span>
            <div class='widget-container fluid-height clearfix'>
            <div class='widget-content padded clearfix'>
			<br><br><br><br><br><br>
						<div style='text-align:center; font-size:24px; color:#ff9999'> Report not available on selected date </div><br><br><br><br><br><br><br>";
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