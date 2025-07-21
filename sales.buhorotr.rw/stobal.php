<?php
if(basename($_SERVER['PHP_SELF']) == 'stobal.php') 
  $cm=" class='current'";
include'header.php';
include'connection.php';
$custo='';
$conde='';
$stor=$condi='';
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
			$stor=$_POST['duse'];
		}

		
		if($custo)
			$conde="AND `Number`='$custo'";

			if($stor)
				$condi="AND `Store`='$stor'";

$dop=mysql_query("SELECT *FROM `itype` WHERE `Location`='0' $conde GROUP BY `Type` ORDER BY `Type` ASC LIMIT 1400");
$fop=mysql_num_rows($dop);
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
	  <a href="storeport.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Store Report
                </p>
              </a></li>  

	 <li class="list-group-item">
	  <a href="inrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;S.In Report
                </p>
              </a></li>  
      
    <li class="list-group-item">
	  <a href="outrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;S.Out Report
                </p>
              </a></li>    

			   <li class="list-group-item">
              <a href="transrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Transfer Report
                </p>
              </a></li> 

			   <li class="list-group-item">
              <a href="delirepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Delivery Report
                </p>
              </a></li> 

			   <li class="list-group-item">
              <a href="recerepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Receiving Report
                </p>
              </a></li>

			  <li class="list-group-item">
              <a href="purrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Purchase Report
                </p>
              </a></li>   

	 <li class="list-group-item">
	  <a href="dispatch.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Count Report
                </p>
              </a></li>       

	 <li class="list-group-item active">
	  <a href="stobal.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Item Report
                </p>
              </a></li>  
                         
            </ul>
  </div>
                    
           
           
       
        <div class="col-lg-10">
                  <div class="row">
         
           <div class="col-lg-2 hidden-print"> </div>
          
         
           

        <form action="" method="post" class="form-horizontal ">                  
                       <div class="col-lg-10 hidden-print">
	<div class="col-lg-3 hidden-print"> </div>
		<div class="col-lg-2 hidden-print"> 					
<select class='form-control' name='duse' style="padding-left:5px; padding-right:5px;">
				<option value=''> STORE </option>
		<?php
	$dob=mysqli_query($cons, "SELECT *FROM `stores` WHERE `Status`>='0' ORDER BY `Number` ASC");
		while($rob=mysqli_fetch_assoc($dob)){
			$stonum=$rob['Store'];
			$stona=$rob['Name'];
			if($stonum==$stor)
				$s="selected";
			else
				$s="";
	echo"<option value='$stonum' $s> &nbsp;&nbsp; $stona </option>";
		}
				?>
		</select>	   
					   </div>
            <div class="col-lg-4 hidden-print"> 
      <select class="form-control" name="custo">
          <option value=''> Select a Brand Name </option>
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
			?>		</select>
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
                        <th> Description </th>
						 <th> Cost&nbsp;Price </th>
                       <th> Sales&nbsp;Price </th>
                        <th><div align='center'> Open. </th><th><div align='center'> Receive </th>
						<th><div align='center'> Sold/Out </th><th><div align='center'> &nbsp;&nbsp;Clos. </th>
                     </tr>
                    </thead>
                                        <tbody>
					<?php
						$n=1;
			while($rop=mysql_fetch_assoc($dop)){
			   $typ=$rop['Type'];
			   $tyn=$rop['Number'];
			   
			   echo"<tr><th colspan='10'> $typ </th></tr>";
	
	$do=mysql_query("SELECT *FROM `items` WHERE `Store`<='2' AND `Status`='0' AND `Type`='$tyn' ORDER BY `Iname` ASC LIMIT 1400");
	        $fo=mysql_num_rows($do);
	        
		while($ro=mysql_fetch_assoc($do)){
				$code=$ro['Number'];
				$iname=$ro['Iname'];
			$kin=$ro['Type'];
			$descri=$ro['Descri'];
			$uno=$ro['Unit'];			
			$cost=$ro['Cost'];			$costo=number_format($cost, 2);
		
			$pri=$ro['Price'];			$prio=number_format($pri, 2);

			if($stor){				
			$qt=$ro["$stor"];							$qty=number_format($qt, 2);
			}
			else{
			$qt=$ro['S1']+$ro['S2']+$ro['S3'];							$qty=number_format($qt, 2);
			}

				$stn="padding:1px;";

$doi=mysql_query("SELECT *FROM `itype` WHERE `Number`='$kin' ORDER BY `Number` ASC");
		$roi=mysql_fetch_assoc($doi);
				$type=$roi['Type'];

				$dox=mysql_query("SELECT *FROM `unit` WHERE `Number`='$uno' ORDER BY `Number` ASC");
					$rox=mysql_fetch_assoc($dox);
							$unit=$rox['Unit'];

	// received and used item
	$rec=$use=0;
	$dor=mysql_query("SELECT *FROM `stouse` WHERE `Item`='$code' AND `Status`='0' AND `Voucher`!='0' AND `Upda`='1' AND `Date`='$Date' AND (`Action`='RECEIVE' OR `Action`='TAKEN') $condi ORDER BY `Number` DESC");
		while($ror=mysql_fetch_assoc($dor)){
						$act=$ror['Action'];
						$qts=$ror['Quantity'];
if($act=='RECEIVE')
	$rec+=$qts;

if($act=='TAKEN')
	$use+=$qts;
		}
										$ope=$qt-$rec+$use;
         $rece=number_format($rec, 2);					$uses=number_format($use, 2);				$open=number_format($ope, 2); 

if($ope OR $rec OR $use OR $qt){
		print("<tr><td class='hidden-xs' style='$stn'>
                        <div align='center'>$n&nbsp;&nbsp;</td>
                        <td style='$stn'> $type </td>
						<td style='$stn'> $iname </td>
						<td style='$stn'> $descri </td>
                        <td style='$stn'><div align='right'> $costo </td>
						<td style='$stn'><div align='right'> $prio </td>
						<td style='$stn'><div align='right'> $open </td>
						<td style='$stn'><div align='right'> $rece </td><td style='$stn'><div align='right'> $uses </td>
						<td style='$stn padding-right:10px;'><div align='right'> $qty </td></tr>");
}
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
