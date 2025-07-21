<?php
if(basename($_SERVER['PHP_SELF']) == 'notes.php') 
  $nv=" class='current'";
include'header.php';
$custo=$conde='';

	$phon1=$phon2=$drive=$eme1=$eme2=$eme3=$vid='';
			
if(isset($_POST['updo']))
		{
			$code=$_POST['code'];
			
	for ($i=1; $i<=$code; $i++){
            $phon1=$_POST["phon1$i"]; 
            $phon2=$_POST["phon2$i"]; 
            $eme1=$_POST["eme1$i"];  
            $eme2=$_POST["eme2$i"];  
            $eme3=$_POST["eme3$i"]; 
   
	$then=mysqli_query($conn, "UPDATE `vehicles` SET `Phone1`='$phon1', `Phone2`='$phon2', `Email1`='$eme1', `Email2`='$eme2', `Email3`='$eme3' WHERE `Number`='$i' LIMIT 1");
		}
		}

if(isset($_POST['search']))
		{
			$custo=$_POST['custo'];
		}

		if($custo)
			$conde="AND (`Plate` LIKE '%$custo%' OR `Make` LIKE '%$custo%')";

$do=mysqli_query($conn, "SELECT *FROM `vehicles` WHERE `Status`='0' AND `Plate` NOT LIKE '%GEN%' $conde ORDER BY `Number` ASC LIMIT 40");
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

    <li class="list-group-item">
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

	   <li class="list-group-item active">
              <a href="notes.php">
                <p>
                <i class="lnr lnr-envelope"></i>&nbsp;Notifications
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
                    
           
           
       
        <div class="col-lg-10">
                  <div class="row">
         
           <div class="col-lg-6"> </div>
          
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
    <form action="" method="post" class="form-horizontal">
            <div class="col-lg-12" style='margin-top:-20px;'>
             <span> &nbsp;&nbsp; Total Records Found : <b><?php echo" $fo " ?></b></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">
               
                                 <table class="table table-striped table-hover">     
                                      <thead>
                    <tr role="row">
                     <th class="hidden-xs text-center"> No </th>
                        <th><div align='center'> VEHICLE&nbsp;ID </th>
					   <th><div align='center'> DRIVER </th>
                       <th><div align='center'> PHONE1 </th>
                       <th><div align='center'> PHONE2 </th>
						 <th><div align='center'> EMAIL1 </th>
						 <th><div align='center'> EMAIL2 </th>
						 <th><div align='center'> EMAIL3 </th>
                     </tr>
                    </thead>
                                        <tbody>
					<?php
					$n=1;				$ido='0';   
						while($ro=mysqli_fetch_assoc($do)){
				$code=$ro['Number'];
			$phon1=$ro['Phone1'];
			$phon2=$ro['Phone2'];
			$drive=$ro['Driver'];
			$eme1=$ro['Email1'];
			$eme2=$ro['Email2'];
			$eme3=$ro['Email3'];
			$vid=$ro['Plate'];
		
		if(!$phon2){	
	$does=mysqli_query($conn, "SELECT `Contact1` FROM `employees` WHERE `Fullname` = '$drive' AND `Fullname` != ''");
	if($foes=mysqli_num_rows($does)){
		$roes=mysqli_fetch_assoc($does);
			$phon2=$roes['Contact1'];
			
	$sos=mysqli_query($conn, "UPDATE `vehicles` SET `Phone2`='$phon2' WHERE `Number`='$code'");
	}
		}
			
						$stn="style='padding:1px;'";
		 
		print("<tr>
            <td class='hidden-xs' $stn><div align='right'>$n&nbsp;&nbsp;</td>
						<td $stn><div align='center'> $vid </td>
						<td $stn> $drive </td><td $stn><input name='phon1$code' class='form-control' type='text' onkeypress='return isNumberKey(event)' onChange=this.style.color='#ff3366' style='text-align:center; width:95px; height:24px; margin:0px 0px 0px 0px; padding:0px 5px 0px 4px;' value='$phon1'></td>
						<td $stn><input name='phon2$code' class='form-control' type='text' onkeypress='return isNumberKey(event)' onChange=this.style.color='#ff3366' style='text-align:center; width:95px; height:24px; margin:0px 0px 0px 0px; padding:0px 5px 0px 4px;' value='$phon2'></td>
						
						<td $stn><input name='eme1$code' class='form-control' type='text' onChange=this.style.color='#ff3366' style='text-align:left; width:200px; height:24px; margin:0px 0px 0px 0px; padding:0px 5px 0px 4px;' value='$eme1'></td>
						
						<td $stn><input name='eme2$code' class='form-control' type='text' onChange=this.style.color='#ff3366' style='text-align:left; width:200px; height:24px; margin:0px 0px 0px 0px; padding:0px 5px 0px 4px;' value='$eme2'></td>
						
						<td $stn><input name='eme3$code' class='form-control' type='text' onChange=this.style.color='#ff3366' style='text-align:left; width:200px; height:24px; margin:0px 0px 0px 0px; padding:0px 5px 0px 4px;' value='$eme3'></td></tr>");
							$n++;	
	$phon1=$phon2=$drive=$eme1=$eme2=$eme3=$vid='';		
						}
									
						?>
						
                    </tbody>
                  </table>

					 <div class="col-md-12 hidden-xs hidden-print">
                  <div class="pull-right hidden-xs hidden-print"><br>
            <?php echo"<input type='hidden' name='code' value='$code'>"; ?>
                 <button class="btn  btn-warning btn-block" type="submit" name="updo" style="width:220px;"><i class="lnr lnr-pencil"></i> &nbsp; UPDATE </button><br><br>
              </div></div>

                  </div></form>                     
                
              </div>
            </div></div>
                  </div>
      
   </div></div></div>  
   <?php
   include'footer.php';
   ?>
