<?php
if(basename($_SERVER['PHP_SELF']) == 'counting.php') 
  $pp=" class='current'";
include'header.php';
include'connection.php';
$custo='';
$conde='';
$condi='';
$l1=1;
$l2=40;
$lim=2;

if(isset($_GET['lim']))
		{
			$lim=$_GET['lim'];
			$l1=$l1+(40*$lim);
			$l2=$l2+(40*$lim);
			$lim++;
		}
if(isset($_GET['xlim']))
		{
			$xlim=$_GET['xlim'];
			$l1=$l1+(40*$xlim);
			$l2=$l2+(40*$xlim);
			$xlim--;
		}

if(isset($_POST['search']))
		{
			$custo=$_POST['custo'];
		}
		
		
		if(isset($_POST['client']))
		{
			$_SESSION['Stok']=$_POST['client'];
			$custo=$_POST['custo'];
		}

    $stor=$_SESSION['Stok'];
		
		if($custo){
			$conde="AND `Number`='$custo'";
			$condi="AND `Type`='$custo'";
		}

$dop=mysql_query("SELECT *FROM `itype` WHERE `Location`='0' $conde GROUP BY `Type` ORDER BY `Type` ASC LIMIT 1400");

$dol=mysql_query("SELECT *FROM `items` WHERE `Status`='0' $condi ORDER BY `Number` ASC LIMIT 1400");
$fop=mysql_num_rows($dol);
?>

<div class="container-fluid main-content">
        <div class="page-title hidden-print">
          <h2 style='margin-top:-20px; margin-bottom: 5px; color:#ffcc33'>
         Store Report
          </h2>
                 </div>
     
        <div class="row">
  <div class="col-lg-2 hidden-print">
   
   <ul class="list-group">

   

    <li class="list-group-item">
	  <a href="mainsto.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Store Status
                </p>
              </a></li> 

	   <li class="list-group-item">
              <a href="crete.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Create New Items
                </p>
              </a></li>   

			  <li class="list-group-item">
              
              
			      <?php
			      if($_SESSION['Acrepo']){
			          echo"<a href='purcha.php'>";
			}
			else{
			   
			          echo"<a href='#'>";
			}
			?>
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Purchase Orders
				<?php
				if($pfuquo)
					echo"<span class='badge' style='float:right; font-size:12px; margin-right:0px; margin-top:0px; height:18px; background-color:#ff66cc; width:26px;'> $pfuquo </span>";
					?>
                </p>
              </a></li>		
                  
			  <li class="list-group-item">
              <a href="receive.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Receive Items
                </p>
              </a></li>
			  
			   <li class="list-group-item">
              <a href="taken.php">
                <p>
                <i class="lnr lnr-circle-minus"></i>&nbsp;Stock &nbsp; Delivery
                </p>
              </a></li>	   
<?php
if($_SESSION['Spay']){
    ?>
			  <li class="list-group-item">
              <a href="billpay.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Supplier Payment
                </p>
              </a></li> 
              <?php
}
?>
			  
			   <li class="list-group-item active">
              <a href="counting.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Inventories List
                </p>
              </a></li> <li class="list-group-item">
              <a href="config.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Monthly Inventories
                </p>
              </a></li> 
                       
            </ul><br><br>
<center>
			<a href="count.php" class="btn btn-info" style="width:100%"><i class="lnr lnr-layers">&nbsp;Physical Count</i></a>
			</center><br>
  <div class="text-success text-center">This operation will increase or descrease quantity accordingly.</div>

  </div>
                    
           
           
       
        <div class="col-lg-10">
                  <div class="row">
         
            <div class="col-lg-1 hidden-print"> </div>
         <form action="" method="post" class="form-horizontal" enctype="multipart/form-data" name='myform'>
           <div class="col-lg-2 hidden-print"> <select class="form-control" name="client"   id='category' onchange='submitForm();' required>
				<option value='' selected='selected'>SELECT STORE</option>
			<?php
			 $dobs=mysqli_query($cons, "SELECT *FROM `stores` WHERE `Status`>='0' ORDER BY `Number` ASC");
		while($robs=mysqli_fetch_assoc($dobs)){
			$stonum=$robs['Store'];
			$stona=$robs['Name'];
	echo"<option value='$stonum'> &nbsp; $stona </option>";
			}
			?>   
                            </select>
        <?php
            echo"<input type='hidden' name='custo' value='$custo'>";
            ?></div>
          
         </form><div class="col-lg-1 hidden-print"> </div>
          
         
           

        <form action="" method="post" class="form-horizontal ">                  
                       <div class="col-lg-8 hidden-print">
		<div class="col-lg-5 hidden-print"> 					
					   
					   </div>
            <div class="col-lg-4 hidden-print"> 
      <select class="form-control" name="custo">
          <option value=''> ALL ITEMS </option>
			<?php
			$i=1;               $type=$tyno=array();
	$dois=mysql_query("SELECT *FROM `itype` GROUP BY `Type` ORDER BY `Type` ASC");
			while($rois=mysql_fetch_assoc($dois)){
				$fna=$rois['Type'];
				$nuo=$rois['Number'];
				$type[$i]=$fna;
				$tyno[$i]=$nuo;
				if($custo==$nuo)
					$t='selected';
				else
					$t='';
			echo"<option value='$nuo' $t> $fna </option>";
			    $i++;
			}
			?>	
          </select>
		 </div>
                    
                       
                       <div class="col-lg-2">
                        <button class="btn  btn-primary btn-block" type="submit" name="search"><i class="lnr lnr-magnifier"></i> Search</button>
                   
					  </div>
                         </div> </div>
                      
                     
                  
          </form> 

<form action='' method='post'>
<div id="testmodal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Confirmation</h4>
            </div>
            <div class="modal-body">
<div class="col-lg-6"> 
             <select class="form-control" name="store" required><option value='' selected='selected'> SELECT STORE </option>
<option value='0'> MAIN STORE </option><option value='1'> DIRECT USE </option></select>
</div>
<div class="col-lg-6"> 
		 <input name='passkey' class="form-control sm" type='password' style='text-align:center;' placeholder="Enter your password" required>
	</div>	
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" name='resetall' class="btn btn-primary">Reset All</button>
            </div>
        </div>
    </div>
</div>
</form>
             
			<div class="divFooter"><center><u><b>MAIN STORE REPORT </b></u></center></div>

             <div class="row">
            <div class="col-lg-12" style='margin-top:-20px;'>
             <span> &nbsp;&nbsp; Total Records Found : <b><?php echo" $fop " ?></b></span>
			 <span class="pull-right hidden-print">&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">
               
                                 <table class="table table-striped">     
                                      <thead>
                    <tr role="row">
                     <th class="hidden-xs"> No </th>
                       <th> Brand&nbsp;Name </th>
                       <th> Item&nbsp;Name </th>
                        <th> Store </th>
                       <th> Sales&nbsp;Price </th>
                       <th><div align='center'> &nbsp;&nbsp;Quantity </th>
                       <th><div align='center'> &nbsp;&nbsp;Counted </th>
                     </tr>
                    </thead>
                                        <tbody>
					<?php
						$n=1;
			while($rop=mysql_fetch_assoc($dop)){
			   $typ=$rop['Type'];
			   $tyn=$rop['Number'];
	
	$do=mysql_query("SELECT *FROM `items` WHERE `Store`<='2' AND `Status`='0' AND `Type`='$tyn' ORDER BY `Iname` ASC LIMIT 1400");
	        $fo=mysql_num_rows($do);
	        
		while($ro=mysql_fetch_assoc($do)){
				$code=$ro['Number'];
				$iname=$ro['Iname'];
			$kin=$ro['Type'];
			$descri=$ro['Descri'];
			$uno=$ro['Unit'];			
			$qt=$ro["$stor"];				$qty=number_format($qt, 2);		
			$pri=$ro['Price'];			$prio=number_format($pri, 2);

				$stn="padding:1px;";

$doi=mysql_query("SELECT *FROM `itype` WHERE `Number`='$kin' ORDER BY `Number` ASC");
		$roi=mysql_fetch_assoc($doi);
				$type=$roi['Type'];
	

 $dos=mysql_query("SELECT `Name` FROM `stores` WHERE `Store`='$stor' ORDER BY `Number` ASC");
		$ros=mysql_fetch_assoc($dos);
				$descri=$ros['Name'];
				

				$dox=mysql_query("SELECT *FROM `unit` WHERE `Number`='$uno' ORDER BY `Number` ASC");
					$rox=mysql_fetch_assoc($dox);
							$unit=$rox['Unit'];

		print("<tr><td class='hidden-xs' style='$stn'>
                        <div align='center'>$n&nbsp;&nbsp;</td>
                        <td style='$stn'> $type </td>
						<td style='$stn'> $iname </td>
						<td style='$stn'> $descri </td>
						<td style='$stn'><div align='right'> $prio </td>
						<td style='$stn'><div align='right'> $qty </td>
						<td style='$stn'><div align='right'>  </td></tr>");
						  $n++;
						}
						$set=mysql_query("UPDATE `itype` SET `Count`='$fo' WHERE `Number`='$tyn'");
			}
						?>
						
                    </tbody>
                  </table>

					 <div class="col-md-12 hidden-print">
                  <div class="pull-right">
                  <ul class="pagination">
                      <li class="activei">
					  <?php
					  if($l1!=0){
						  ?>
					    <a href="#">
                        &nbsp;<<&nbsp; </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<?php
					 }
						?>
                       
						<?php
						echo"<a href='#'>";
						?>
                        >>                        </a>
                      </li>
                    </ul>
              </div></div>

                  </div></div>   
				  <span class="pull-right hidden-print">
			 &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>                       
              
            </div></div>
                  </div>
      
   </div></div></div>  
   <?php
   include'footer.php';
   ?>
