<?php
if(basename($_SERVER['PHP_SELF']) == 'odreport.php') 
  $cm=" class='current'";
include'header.php';
include'connection.php';
$dato=$datos=$Date;
$custo='';
$conde=$condi='';
$t=$p=0;
$brc=$_SESSION['Branche'];
$brancho=$_SESSION['Branche'];

// search for an item to be added to the chart
if(isset($_POST['search']))
		{
			$brc=$_POST['brc'];
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$custo=$_POST['custo'];
			$p=1;
		}

	if($dato==$datos)
			$mpri="ON $dato";
		else
			$mpri="FROM $dato TO $datos";

	if($brc=='0' OR $brc=='')
		$conde="";
	else
		$conde="AND `Branche`='$brc'";

		

	if($custo)
		$condi="AND `Destin`='$custo'";
	else
		$condi="";
?>
<div class="container-fluid main-content">
        <div class="page-title hidden-print">
          <h3 style='margin-top:-20px; margin-bottom: 5px; color:#ffcc33'>
         Customers Report
          </h3>
                 </div>
     
        <div class="row">
  <div class="col-lg-2 hidden-print">
   
 <ul class="list-group">

    <li class="list-group-item">
	  <a href="prirepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Balance Report
                </p>
              </a></li>  		  

    <li class="list-group-item">
	  <a href="prireport.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Details &nbsp; Report
                </p>
              </a></li>

    <li class="list-group-item active">
	  <a href="odreport.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Invoices Report
                </p>
              </a></li>   

    <li class="list-group-item">
	  <a href="csrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Payment Report
                </p>
              </a></li>   
                         
            </ul>
  </div>
      <script>
	  

	  var btn = document.getElementsByClassName("click-to-open");

for (var i = 0; i < btn.length; i++) {
  var thisBtn = btn[i];
  thisBtn.addEventListener("click", function(){
    var modal = document.getElementById(this.dataset.modal);
    modal.style.display = "block";
}, false);

</script>          
           
       
        <div class="col-lg-10">
                  <div class="row">
         
           <div class="col-lg-2"> </div>
          
         
           

        <form action="" method="post" class="form-horizontal ">                  
                       <div class="col-lg-10 hidden-print"><div class="col-lg-3"> 
		<select class="form-control" name="brc" style='padding-right:5px;'>
			   <?php
if($brancho)
echo"<option value='$brc' selected> $brc </option>";
else{
echo"<option value='0' selected='selected'> SELECT BRANCH </option>";
	$seek=mysql_query("SELECT `Invoice`, `Branche` FROM `stouse` WHERE `Branche`!='0' AND `Status`='0' AND `Upda`='1' AND `Action`='SALES' AND `Invoice`!='MAIN STORE' GROUP BY `Branche` ORDER BY `Branche` ASC LIMIT 18");
			if($feek=mysql_num_rows($seek)){
		while($roi=mysql_fetch_assoc($seek)){
				$fna=$roi['Invoice'];
				$num=$roi['Branche'];
				if($brc==$num)
					$s='selected';
				else
					$s='';
			echo"<option value='$num' $s> $fna &nbsp;&nbsp;</option>";
			}
			}
}
			?>			    
            </select>
					   </div><div class="col-lg-3">
		<select class="form-control" name="custo" style='padding-right:5px;'>
						<?php
				echo"<option value='0' selected='selected'> SELECT CUSTOMER </option>";
	$seek=mysql_query("SELECT `Customer` FROM `payment` WHERE `Branche`!='0' AND `Status`='0' AND `Upda`='1' AND `Action`='SALES' AND `Amount`>'0' GROUP BY `Customer` ORDER BY `Customer` ASC LIMIT 1000");
			if($feek=mysql_num_rows($seek)){
		while($roi=mysql_fetch_assoc($seek)){
				$fna=$roi['Customer'];
				if($custo==$fna)
					$s='selected';
				else
					$s='';
			echo"<option value='$fna' $s> $fna </option>";
			}
			}
			?>			    
            </select>
					   </div>
            <div class="col-lg-2"> 
           <div class="input-group date datepicker">
      <input class="form-control form-center" id="from" name="dato" type="text" value="<?php echo $dato ?>" onkeypress='return isNumberKey(event)' style="padding-left:2px; padding-right:2px;" required>
	  <span class="input-group-addon"><i class="lnr lnr-calendar-full"></i></span>
			</div></div>


		  <div class="col-lg-2"> 
           <div class="input-group date datepicker">	
      <input class="form-control form-center" id="to" name="datos" type="text" value="<?php echo $datos ?>" onkeypress='return isNumberKey(event)' style="padding-left:2px; padding-right:2px;" required>
	  <span class="input-group-addon"><i class="lnr lnr-calendar-full"></i></span>
              </div></div>                      
                       
                       <div class="col-lg-2">
                        <button class="btn  btn-primary btn-block" type="submit" name="search"><i class="lnr lnr-magnifier"></i> Search</button>
                   
					  </div>
                         </div> 
                      
                     
                  
            </form> 
             
               
            </div>
               <?php
			  
		$dox=mysqli_query($cons, "SELECT *FROM `stouse` WHERE `Status`='0' AND `Voucher`!='0' AND `Action`='SALES' AND `Date` BETWEEN '$dato' AND '$datos' $conde $condi GROUP BY `Voucher` ORDER BY `Voucher` ASC LIMIT 1000");
				if($fox=mysqli_num_rows($dox)){
					?>
					<div class="divFooter"><center><u><b>DETAILS REPORT <?php echo"$mpri"; ?></b></u></center></div>
		 <div class="row">
            <div class="col-lg-12">
             <span> &nbsp;&nbsp; Total Records Found : <b><?php echo" $fox " ?></b></span>
			 <span class="pull-right hidden-print"><?php echo $bra ?>&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">
			
			<?php
				$tcre=$tto=0;			$i=1;
	while($rox=mysqli_fetch_assoc($dox)){
		$vous=$rox['Voucher'];
	$do=mysqli_query($cons, "SELECT *FROM `stouse` WHERE `Status`='0' AND `Voucher`='$vous' AND `Action`='SALES' $conde $condi ORDER BY `Number` ASC LIMIT 100");
			   ?>
             
		<form action="" method="post">
				<table class="table table-striped table-hover">     
                       <thead><tr role="row">
                     <th width='5%'>&nbsp;&nbsp;&nbsp;&nbsp;# </th>
                       <th width='12%'> Due&nbsp;Date </th>
                       <th> Cashier </th><th> Customer </th>
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
						while($ro=mysqli_fetch_assoc($do)){
							$num=$ro['Number'];
				$vou=$ro['Voucher'];
				$dte=$ro['Date'];
				$user=$ro['User'];
				$pri=$ro['Price'];
				$prio=number_format($pri, 2);
				$qty=$ro['Quantity'];
				$item=$ro['Item'];
				$custo=$ro['Destin'];
				$refer=$ro['Refer'];

				if($sales=='0')
					$stao='Open';
				else
					$stao='Closed';
				$to=$qty*$pri;
				$too=number_format($to, 2);

	$dop=mysqli_query($cons, "SELECT *FROM `items` WHERE `Number`='$item' ORDER BY `Number` DESC LIMIT 1");
				$rop=mysqli_fetch_assoc($dop);
					$iname=$rop['Iname'];
					$kin=$rop['Type'];
					
	$doi=mysql_query("SELECT *FROM `itype` WHERE `Number`='$kin' ORDER BY `Number` ASC");
		$roi=mysql_fetch_assoc($doi);
				$type=$roi['Type'];

					$sup=$custo;

					$stn="padding:0px;";

		print("<tr><td style='$stn' class='text-center'>$n&nbsp;&nbsp;</td><td style='$stn'> $dte </td>
		<td style='$stn'> $user </td><td style='$stn' class='text-left'>&nbsp;&nbsp;$sup </td><td style='$stn'><div align='left'> $type </td><td style='$stn'>&nbsp;$iname </td>

		<td style='padding:0px;'><input name='pri' class='form-control' type='text' onkeyup='format(this);' onkeypress='return isNumberKey(event);' onChange=this.style.color='#ff3366' style='text-align:right; width:80px; height:20px; margin:0px 2px 0px 0px; padding:0px 10px 0px 0px;' value='$prio' readonly></td>

		<td style='padding:0px;'><input name='qty' class='form-control' type='text' onkeyup='format(this);' onkeypress='return isNumberKey(event);' onChange=this.style.color='#ff3366' style='text-align:right; width:80px; height:20px; margin:0px 2px 0px 0px; padding:0px 10px 0px 0px;' value='$qty' readonly></td>
						
		<td style='padding:0px;'><input name='tot' class='form-control' type='text' onkeyup='format(this);' onkeypress='return isNumberKey(event);' onChange=this.style.color='#ff3366' style='text-align:right; width:80px; height:20px; margin:0px 0px 0px 0px; padding:0px 10px 0px 0px;' value='$too' readonly></td></tr>");
						  $n++;					$tot+=$to;
						}
						$tpo=number_format($tot, 2);						

				$pay=$cre=0;				$pli='';
	$spa=mysqli_query($cons, "SELECT *FROM `payment` WHERE `Voucher`='$vou' AND `Status`='0' AND `Action`='SALES' ORDER BY `Number` ASC");
				while($rpa=mysqli_fetch_assoc($spa)){
						$pay+=$rpa['Amount'];					$amon=number_format($rpa['Amount'], 2);
						$pline=$rpa['Pline'];
						$chen=$rpa['Cheno'];
				
						$pli="$pli $pline [$amon] &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; $chen";
				}
			
						$cre=$tot-$pay;
				
				$payo=number_format($pay, 2);			
				$creo=number_format($cre, 2);

	        

				$tcre+=$cre;
						
						
                  print("</tbody><thead><tr>
					<th style='padding:3px;'> </th>
		<th colspan='5' class='text-left' style='padding:2px 3px 2px 40px;; color:#ff66cc; font-weight:normal; font-size:11px;'>  
		No:&nbsp; $vou &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;$pli 
					&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;$refer </th>");
									$i++;
						  ?>
					
					
					
		<th colspan='3' style='padding:0px;'><div align='right'><?php echo"<input name='tot' class='form-control' type='text' onkeyup='format(this);' onkeypress='return isNumberKey(event);' onChange=this.style.color='#ff3366' style='text-align:right; width:100%; height:20px; margin:0px 0px 0px 0px; padding:0px 10px 0px 0px; margin:0px; font-weight:bold; color:#ff66cc;' value='$tpo' readonly>"; ?></th></tr>
                  </table></form><br>

				  <?php
				}

				}
					else{
						echo"<div class='row'>
            <div class='col-lg-12' style='margin-top:-20px;'>
             <span> &nbsp;&nbsp; Total Records Found : <b> 0 </b></span>
			 <span class='pull-right hidden-print'> $bra &nbsp;&nbsp;<a href='#' onclick='return window.print()' class='hidden-print' title='Click to print' data-toggle='tooltip' data-placement='top'><i class='lnr lnr-printer'></i></a></span>
            <div class='widget-container fluid-height clearfix'>
            <div class='widget-content padded clearfix'>
			<br><br><br><br><br><br>
						<div style='text-align:center; font-size:24px; color:#ff9999'>Report not available on selected date </div><br><br><br><br><br><br><br>";
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