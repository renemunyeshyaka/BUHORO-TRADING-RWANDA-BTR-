<?php
if(basename($_SERVER['PHP_SELF']) == 'tools.php') 
$nv=" class='current'";
include'header.php';
$custo=$conde='';
$lim=30;

	$phon1=$phon2=$drive=$eme1=$eme2=$eme3=$vid='';

if(isset($_POST['savet']))
		{
			$custo=$_POST['custo'];
			$code=$_POST['code'];
			$a=$_POST['a'];
	    for($i=1; $i<=$a; $i++){
			$tls=$_POST["tls$i"];
			$qts=$_POST["qts$i"];
			$con=$_POST["con$i"];
			$ito=$_POST["ito$i"];
			$dat=$_POST["dat$i"];
			if(!$dat)
			$dat=$Date;
			
		if($con)
	$so=mysqli_query($conn, "UPDATE `tools` SET `Quantity`='$qts', `Date`='$dat', `User`='$loge' WHERE `Vehicle`='$code' AND `Tool`='$tls'");
	    else
	$so=mysqli_query($conn, "INSERT INTO `tools` (`Date`, `User`, `Vehicle`, `Tool`, `Quantity`, `Status`) VALUES ('$dat', '$loge', '$code', '$tls', '$qts', '0')");
	        }
			$lim=1200;
		}

if(isset($_POST['search']))
		{
			$custo=$_POST['custo'];
			$lim=1200;
		}

		if($custo){
		    if($custo!='ALL' AND $custo!='*')
			$conde="AND (`Plate` LIKE '%$custo%')";
		}
		
		        $stl="style='padding:1px; font-size:12px;'";
		
	$de=mysqli_query($conn, "DELETE FROM `tools` WHERE `Quantity`='0'");

$do=mysqli_query($conn, "SELECT *FROM `vehicles` WHERE `Status`='0' AND `Plate` NOT LIKE '%GEN%' $conde ORDER BY `Number` ASC LIMIT $lim");
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

	   <li class="list-group-item active">
              <a href="tools.php">
                <p>
                <i class="lnr lnr-book"></i>&nbsp;Tools & Materials
                </p>
              </a></li> 

	   <li class="list-group-item">
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
      <input class="form-control"  name="custo" type="text" id="searchu" autofocus="autofocus" OnKeyup='return cUpper(this);'>
			</div>                      
                       
                       <div class="col-lg-2 hidden-xs hidden-print">
                        <button class="btn  btn-primary btn-block" type="submit" name="search"><i class="lnr lnr-magnifier"></i> Search</button>
                   
					  </div>
                         
                    
                     
                  
            </form> 
             
               
            </div>
             <div class="row">
            <div class="col-lg-12" style='margin-top:-20px;'>
             <span> &nbsp;&nbsp; Total Records Found : <b><?php echo" $fo " ?></b></span><span class="pull-right text-right">
             <a href="#" onclick="return window.print()" class="hidden-print" title='Print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a>&nbsp;&nbsp;&nbsp;</span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">
               
            <table class="table table-striped table-hover">     
                 <thead><tr role="row">
<th style='padding:1px; font-size:12px;' class="hidden-xs text-center"> No </th>
<th style='padding:1px; font-size:12px;'><div align='center'> VEHICLE&nbsp;ID </th>
<th style='padding:1px; font-size:12px;'><div align='center'> DRIVER </th>
					   
				<?php 
				$t=1;                       $tool=$nuo=$qts=$toda=array();
		$doi=mysqli_query($conn, "SELECT `Number`, `Name` FROM `advalue` WHERE `Name`!='' AND `Status`='0' GROUP BY `Name` ORDER BY `Name` ASC");
			while($roi=mysqli_fetch_assoc($doi)){
				$fna=$roi['Name'];
				$tool[$t]=$fna;
				$nuo[$t]=$roi['Number'];
            echo"<th $stl><div align='center'> $fna </th>";
                        $t++;
			        }
			?>
                     
			<th width='1%'><div align='center'> # </th></tr>
                    </thead><tbody>
					<?php
			$n=1;				$ido='0';                      
			while($ro=mysqli_fetch_assoc($do)){
				$code=$ro['Number'];
			    $drive=$ro['Driver'];
			    $vid=$ro['Plate'];
			    $stn="style='padding:1px;'";
		 
		        print("<tr>
            <td class='hidden-xs' $stn><div align='right'>$n&nbsp;&nbsp;</td>
						<td $stn><div align='center'> $vid </td>
						<td $stn> $drive </td>");
				
			for($a=1; $a<$t; $a++){
			$tl=$tool[$a];
			$nu=$nuo[$a];
			$qt=$da='';
			
		$does=mysqli_query($conn, "SELECT `Date`, `Quantity` FROM `tools` WHERE `Vehicle` = '$code' AND `Tool` = '$nu'");
		if($foes=mysqli_num_rows($does)){
	        	$roes=mysqli_fetch_assoc($does);
			        $qt=$roes['Quantity'];
			        $da=$roes['Date'];
		            }
			        $qts[$a]=$qt;
			        $toda[$a]=$da;
			echo"<td class='text-center' $stn> $qt </td>";
				}
				
				
	echo"<div class='modal fade' id='tModal$n' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
        <div class='modal-dialog' role='document'>
    <div class='modal-content'><div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLabel'>TOOLS & MATERIALS 
		<label style='float:right; text-align:right;'><b> $vid </b></label></h5>

      </div><form method='post' action=''>
      <div class='modal-body' style='padding-top:10px;'>";
      
        for($a=1; $a<$t; $a++){
			$tl=$tool[$a];
			$nu=$nuo[$a];
			$qtl=$qts[$a];
			$dat=$toda[$a];
        echo"<div class='col-lg-3 input group'>   
    <input name='dat$a' class='form-control text-center date' data-provide='datepicker' placeholder='$Date' type='text' value='$dat' style='padding:1px 5px 1px 5px; height:22px;' title='$tl' data-toggle='tooltip' data-placement='top'></div><div class='col-lg-6'>   
    <input name='item' class='form-control text-left' type='text' value='$tl' style='padding:1px 5px 1px 5px; height:22px;' readonly disabled required></div><div class='col-lg-3'>   
    <input name='qts$a' class='form-control text-center' type='text' onkeyup='format(this);' title='$tl' style='padding:1px 5px 1px 5px; height:22px;' data-toggle='tooltip' data-placement='top' onkeypress='return isNumberKey(event)' value='$qtl'><input type='hidden' name='ito$a' value='$tl'><input type='hidden' name='tls$a' value='$nu'>
       <input type='hidden' name='con$a' value='$qtl'></div>";
        }
        
      echo"</div><input type='hidden' name='code' value='$code'>
      <input type='hidden' name='a' value='$a'><input type='hidden' name='custo' value='$vid'><div class='row'> </div>
      
      <div class='modal-header text-right' style='height:50px; padding-top:10px; border:0px solid blue; margin-top:10px;'>
        <button type='button' class='btn btn-sm btn-warning' data-dismiss='modal' style='width:80px;'> CANCEL </button>
        <button type='submit' name='savet' class='btn btn-sm btn-success' style='width:80px;'> SAVE </button>
      </div></form>
    </div>
  </div>
</div>";

    print("<td class='hidden-print' align='right' style='width:20px; padding:0px;'><button type='button' class='btn btn-xs btn-info hidden-print' style='height:18px; padding:0px; margin:3px;' data-placement='top' data-toggle='modal' data-target='#tModal$n'>&nbsp;&nbsp;<i class='lnr lnr-undo'></i>&nbsp;&nbsp;</button></td></tr>");
							$n++;		
						}
									
						?>
						
                    </tbody>
                  </table>

					
                  </div>                   
                
              </div><span class="pull-right text-right">
             <a href="#" onclick="return window.print()" class="hidden-print" title='Print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a>&nbsp;&nbsp;&nbsp;</span>
            </div></div>
                  </div>
      
   </div></div></div>  
   <?php
   include'footer.php';
   ?>
