<?php
if(basename($_SERVER['PHP_SELF']) == 'mainsto.php') 
  $nv=" class='current'";
include'header.php';
include'connection.php';
$client='';
$in=$lt='';
$custo='';
$conde='';

if(isset($_POST['delo']))
		{
			$rowid=$_POST['rowid'];
			$custo=$_POST['custo'];
			$then=mysqli_query($conn, "UPDATE `vehicles` SET `Status`='1' WHERE `Number`='$rowid' LIMIT 1");
		}

        if(isset($_POST['search']))
		{
			$custo=$_POST['custo'];
		}
		
		if(isset($_GET['client']))
		{
			$client=$_GET['client'];
			$_SESSION['Client']=$client;
		}
		
		if(isset($_POST['client']))
		{
			$client=$_POST['client'];
			$_SESSION['Client']=$client;
		}

		if($custo)
			$conde="AND (`Plate` LIKE '%$custo%' OR `Make` LIKE '%$custo%')";
			
	$dest=$_SESSION['Client'];
	
	    if($dest=='1'){
	        $condi="AND `Trip`='1'";
	        $in="selected";
	    }
	    elseif($dest=='2'){
	        $condi="AND `Trip`='0'";
	        $lt="selected";
	    }
	    else
	        $condi="";
	    

$do=mysqli_query($conn, "SELECT *FROM `vehicles` WHERE `Status`='0' $conde $condi ORDER BY `Number` ASC LIMIT 100");
$fo=mysqli_num_rows($do);
?>
<div class="container-fluid main-content">
        <div class="page-title hidden-xs hidden-print">
          <h2 style='margin-top:-20px; margin-bottom: 5px; color:#ffcc33'>
         Vehicles
          </h2>
                 </div>
     
        <div class="row">
  <div class="col-lg-2 hidden-print">
   
   <ul class="list-group">
                  
			  <li class="list-group-item">
              <a href="ment.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Repair & Services
                </p>
              </a></li>

    <li class="list-group-item active">
	  <a href="mainsto.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;List of Vehicles
                </p>
              </a></li> 

	   <li class="list-group-item">
              <a href="crete.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Create a Vehicle
                </p>
              </a></li>     

	   <li class="list-group-item">
              <a href="tools.php">
                <p>
                <i class="lnr lnr-book"></i>&nbsp;Tools & Materials
                </p>
              </a></li> 

	   <li class="list-group-item">
              <a href="notes.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Notifications
                </p>
              </a></li>
                       
            </ul><br><br>

			<li class="list-group-item" style="border:1px dashed #cccccc; border-radius:5px; margin:0px 0px 4px 0px;">
	  <a href="createa.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Create Customers
                </p>
              </a></li>	
              
            <li class="list-group-item" style="border:1px dashed #cccccc; border-radius:5px; margin:0px 0px 4px 0px;">
	  <a href="dispatch.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Create Vehicle Trip
                </p>
              </a></li>	
			 
                <?php
              if($_SESSION['Cpo']){
                  ?>
			  <li class="list-group-item" style="border:1px dashed #cccccc; border-radius:5px; margin:0px 0px 4px 0px;">
              <a href="purcha.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Purchase Orders
                </p>
              </a></li>
              <?php
              }
              if($_SESSION['Cpi']){
                  ?>
            <li class="list-group-item" style="border:1px dashed #cccccc; border-radius:5px; margin:0px 0px 4px 0px;">
	  <a href="profo.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Create Proforma
                </p>
              </a></li>	
              <?php
              }
              ?>
              
            <li class="list-group-item" style="border:1px dashed #cccccc; border-radius:5px; margin:0px 0px 4px 0px;">
	  <a href="payslip.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Payment Vouchers
                </p>
              </a></li>	
              
            <li class="list-group-item" style="border:1px dashed #cccccc; border-radius:5px; margin:0px 0px 4px 0px;">
	  <a href="conterepo.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Container Dispatch
                </p>
              </a></li>
  </div>
                    
     <script>
// Submit a form by selecting an option on client
function submitForm(){
    var val = document.myform.client.value;
    if(val!= '0'){
        document.myform.submit();
    }
}
 </script>      
           
       
        <div class="col-lg-10">
                  <div class="row">
         <form action="" method="post" class="form-horizontal" enctype="multipart/form-data" name='myform'> 
           <div class="col-lg-3 hidden-print" style="padding-left:50px;"> <select class="form-control" name="client" id='category' onchange='submitForm();' required>
				<option value='' selected='selected'>ALL VEHICLES</option>
				<option value='1' <?php echo $in ?>>TRANSIT VEHICLES</option>
				<option value='2' <?php echo $lt ?>>LOCAL TRANSPORT</option>
                            </select> </div>
         <div class="col-lg-3"> </div></form>
           

        <form action="" method="post" class="form-horizontal ">                  
                       
            <div class="col-lg-3 hidden-xs hidden-print"> 
      <input class="form-control"  name="custo" type="text" id="search" autofocus="autofocus">
			</div>                      
                       
                       <div class="col-lg-2 hidden-xs hidden-print">
                        <button class="btn  btn-primary btn-block" type="submit" name="search"><i class="lnr lnr-magnifier"></i> Search</button>
                   
					  </div>
                         
                      
                     
                  
            </form> 
             
               
            </div>
             <div class="row">
            <div class="col-lg-12" style='margin-top:-20px;'>
             <span> &nbsp;&nbsp; Total Records Found : <b><?php echo" $fo " ?></b></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">
               
                                 <table class="table table-striped table-hover">     
                                      <thead>
                    <tr role="row">
                     <th class="hidden-xs"> NO </th>
                        <th><div align='center'> VEHICLE&nbsp;ID </th>
                       <th><div align='center'> MAKE </th>
                       <th><div align='center'> MODEL </th>
					   <th><div align='center'> CHASSIS </th>
						 <th><div align='center'> DRIVER </th>
						 <th><div align='center'> FUEL </th>
						 <th><div align='center'> YEAR </th>
                        <th class="hidden-xs hidden-print" style="width:20px; text-align:center;" colspan='2'> Options </th>
                     </tr>
                    </thead>
                                        <tbody>
					<?php
					$n=1;				$to=0;
						while($ro=mysqli_fetch_assoc($do)){
				$code=$ro['Number'];
			$make=$ro['Make'];
			$mode=$ro['Mode'];
			$chassis=$ro['Chassis'];
			$year=$ro['Year'];

			$fuel=$ro['Fuel'];
			$vid=$ro['Plate'];
			$source=$ro['Driver'];
			
			$seti=mysqli_query($conn, "SELECT `Number` FROM `trips` WHERE `Vehicle`='$code' ORDER BY `Number` DESC LIMIT 1");
			    $reti=mysqli_fetch_assoc($seti);
			    $trino=$reti['Number'];
			
	$then=mysqli_query($conn, "UPDATE `income` SET `Plate`='$vid' WHERE `Vehicle`='$code' AND `Plate`='' ORDER BY `Number` ASC LIMIT 100");
	
	$then=mysqli_query($conn, "UPDATE `repair` SET `Plate`='$vid' WHERE `Vehicle`='$code' AND `Plate`='' ORDER BY `Number` ASC LIMIT 100");
	
	$then=mysqli_query($conn, "UPDATE `consumption` SET `Plate`='$vid' WHERE `Vehicle`='$code' AND `Plate`='' ORDER BY `Number` ASC LIMIT 100");
	
	$then=mysqli_query($conn, "UPDATE `vehicles` SET `Tripo`='$trino' WHERE `Number`='$code' AND `Plate`='$vid' ORDER BY `Number` ASC LIMIT 1");

		 if($_SESSION['Cancel']){
			 $dbutn='submit';
			 $disa='';
		 }
		 else{
			 $dbutn='button';
			 $disa='disabled';
		 }

		 if($ro['Receive']=='0')
			 $stat="<label style='background-color:#ffff00; padding:2px 15px 2px 15px; margin:0px; width:110px; text-align:center;'>WAITING</label>";
		 else{
			 if($ro['Status']=='0')
				 $stat="<label style='background-color:#00cc99; padding:2px 15px 2px 15px; margin:0px; width:110px; text-align:center; margin:0px;'>AVAILABLE</label>";
			 if($ro['Status']=='1')
				 $stat="<label style='background-color:#ff3366; padding:2px 15px 2px 15px; margin:0px; width:110px; text-align:center;'>DELETED</label>";
			 if($ro['Status']=='2'){
				 $stat="<label style='background-color:#ffcc66; padding:2px 15px 2px 15px; margin:0px; width:110px; text-align:center;'>SOLD&nbsp;OUT</label>";
				 $edo="button";
			 }
		 }
		 if($ro['Status']=='1')
				 $stat="<label style='background-color:#ff3366; padding:2px 15px 2px 15px; margin:0px; width:110px; text-align:center;'>DELETED</label>";

						$stn="style='padding:1px;'";
		 
		print("<tr>
                        <td class='hidden-xs' $stn><div align='right'>$n&nbsp;&nbsp;</td>
				<td $stn><div align='center'> $vid </td><td $stn> $make </td>
			  <td $stn> $mode </td><td $stn> $chassis </td>
			<td $stn> $source </td><td $stn><div align='left'> $fuel </td>
						<td $stn><div align='center'> $year ");







		echo"<div class='modal fade' id='exampleModal$n' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true' 
		style='top:120px;'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLabel'>DELETE CONFIRMATION 
		<label style='float:right; text-align:right;'><b> $make $mode $vid </b></label></h5>

      </div>
      <div class='modal-body' style='height:40px;'>
        <h5 style='color:#ff0033'>Are you sure you want to delete this item?</h5>
      </div><form method='post' action=''><input type='hidden' name='rowid' value='$code'><input type='hidden' name='custo' value='$custo'>
      <div class='modal-footer' style='margin-top:-10px; height:50px; padding-top:5px; border:0px solid blue;'>
        <button type='button' class='btn btn-sm btn-success' data-dismiss='modal'>&nbsp;NO&nbsp;</button>
        <button type='$dbutn' name='delo' class='btn btn-sm btn-danger'>YES</button>
      </div></form>
    </div>
  </div>
</div>";
						
						
						
						
						
						echo("</td>
						   <form method=post action='crete.php'><td class='hidden-xs hidden-print' align='right' style='width:20px; padding:0px;'>
                              <input type='hidden' name='rowid' value='$code'>
                          <button type='$edo' class='btn btn-xs btn-warning hidden-print' name='open' style='height:26px; padding:0px; margin:0px;' title='Edit' data-toggle='tooltip' data-placement='top'>
						  &nbsp;&nbsp;<i class='lnr lnr-pencil'></i>&nbsp;&nbsp;</button></td></form>
						  
						  <form method=post action=''>
						  <td class='hidden-xs hidden-print' align='right' style='width:20px; padding:0px; padding-right:5px;'>
						  <div title='Delete' data-toggle='tooltip' data-placement='top'>
                              <input type='hidden' name='rowid' value='$code'><input type='hidden' name='custo' value='$custo'>
                          <button type='button' class='btn btn-xs btn-danger hidden-print' style='height:26px; padding:0px; margin:0px;' data-placement='top'
						  data-toggle='modal' data-target='#exampleModal$n' $disa>
						  &nbsp;&nbsp;<i class='lnr lnr-trash'></i>&nbsp;&nbsp;</button></div></td></form></tr>");
							$n++;			
							 if($ro['Status']!='1')
								 $to+=$ro['Price'];
						}
						$to=number_format($to);					
						?>
						
                    </tbody>
                  </table>

					 <div class="col-md-12 hidden-xs hidden-print">
                  <div class="pull-right hidden-xs hidden-print">
                  <ul class="pagination">
                      <li>
                                            </li>
                      <li class="activei">
					  <?php
					  if($l1!=0){
						  ?>
					    <a href="#">
                        &nbsp;<<&nbsp;                        </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<?php
					 }
						?>
                       
						<?php
						echo"<a href='#'>";
						?>
                        >>                        </a>
                      </li>
                                             <li>
                                            </li>
                    </ul>
              </div></div>

                  </div>                     
                
              </div>
            </div></div>
                  </div>
      
   </div></div></div>  
   <?php
   include'footer.php';
   ?>
