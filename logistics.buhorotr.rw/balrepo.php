<?php
if(basename($_SERVER['PHP_SELF']) == 'balrepo.php') 
$cm=" class='current'";
include'header.php';
include'connection.php';
$dato=$datos=$Date;
$custo=$conde='';
$p=0;

// search for an item to be added to the chart
if(isset($_POST['search']))
		{
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$custo=$_POST['custo'];
			$p=1;
		}
		
		if($dato==$datos)
			$mpri="ON $dato";
		else
			$mpri="FROM $dato TO $datos";
?>
<div class="container-fluid main-content">
        <div class="page-title hidden-xs hidden-print">
          <h2 style='margin-top:-20px; margin-bottom: 5px; color:#ffcc33'>
         Store Report
          </h2>
                 </div>
     
        <div class="row">
  <div class="col-lg-2 hidden-print">
   
   <ul class="list-group">

    <li class="list-group-item">
	  <a href="storepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Store Status
                </p>
              </a></li>
                  
			  <li class="list-group-item">
              <a href="recerepo.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;S.In &nbsp;Report
                </p>
              </a></li>
                  
			  <li class="list-group-item">
              <a href="recerepo.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Receiving Report
                </p>
              </a></li>
                  
			  <li class="list-group-item">
              <a href="requirepo.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Requisition Report
                </p>
              </a></li>
                  
			  <li class="list-group-item">
              <a href="consurepo.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Consumption Report
                </p>
              </a></li>  
                  
			  <li class="list-group-item active">
              <a href="balrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Balance Report
                </p>
              </a></li> 
                  
			  <li class="list-group-item">
              <a href="suprepo.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Suppliers Report
                </p>
              </a></li> 
                  
			  <li class="list-group-item">
              <a href="counting.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Counting Papers
                </p>
              </a></li> 
                       
            </ul><br><br><br>
  </div>
                    
           
           
       
        <form action="" method="post" class="form-horizontal "> 
        <div class="col-lg-10">
                  <div class="row">

				  <div class="col-lg-3"> </div>  
				  
             <div class="col-lg-3">
			 <input class="form-control"  name="custo" type="text" id="search" autofocus="autofocus" value="<?php echo $custo ?>">
	    </div> 
                         
                       <div class="col-lg-6 hidden-print">
            <div class="col-lg-4"> 
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
	$stem=mysqli_query($conn, "SELECT *FROM `items` WHERE `Item`='$custo'");
    	if($ftem=mysqli_num_rows($stem)){
	        $rtem=mysqli_fetch_assoc($stem);
	            $qty=$rtem['Quantity'];
	            $code=$rtem['Number'];

// ****************** Calculate opening stock **********************
$dop=mysqli_query($conn, "SELECT SUM(IF(`Action`='RECEIVE', `Quantity`, 0)) AS `Rece`, SUM(IF(`Action`='USED', `Quantity`, 0)) AS `Use`, SUM(IF(`Action`='PURCHASE', `Quantity`, 0)) AS `Pur` FROM `stouse` WHERE (`Item`='$code' AND `Status`='0' AND `Store`='1' AND `Date`>='$dato' AND (`Action`='USED' OR `Action`='RECEIVE')) OR (`Destin`='$custo' AND `Status`='0' AND `Store`='1' AND `Date`>='$dato' AND `Action`='PURCHASE') ORDER BY `Number` ASC");
        $fo=mysqli_num_rows($dop);
            $rop=mysqli_fetch_assoc($dop);
                $ope=$qty-$rop['Rece']+$rop['Use']+$rop['Pur'];
                $opeo=number_format($ope, 2);
                $rec=$rop['Rece'];
                $use=$rop['Use']+$rop['Pur'];
?>
<div class="divFooter"><center><u><b>BALANCE REPORT <?php echo"$mpri"; ?></b></u></center></div>
             <div class="row">
            <div class="col-lg-12" style='margin-top:-20px;'>
             <span> &nbsp;&nbsp; Total Records Found : <b><?php echo" $fo " ?></b></span>
			 <span class="pull-right"><a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">
               
                <table class="table table-striped table-hover">     
                    <thead><tr role="row"><th> No </th>
                        <th><div align='center'> DATE </th>
                        <th><div align='center'> ITEM&nbsp;NAME </th>
					   <th width='30%'><div align='center'> DESCRIPTION </th>
				<th> DESTINATION </th><th><div align='center'> PRICE </th>
					<th><div align='center'> QUANTITY </th>
				    <th><div align='center'>BALANCE</th>
                     </tr></thead>
                        <tbody>
					<?php
			$stl="style='padding:1px;'";
    print("<tr><th colspan='6' $stl><div align='center'> Opening Balance </th>
		<th colspan='2' $stl class='text-right' style='padding:1px 10px 1px 1px;'> $opeo &nbsp; </th></tr>");
	
	$do=mysqli_query($conn, "SELECT *FROM `stouse` WHERE (`Item`='$code' AND `Status`='0' AND `Store`='1' AND `Date`>='$dato' AND (`Action`='USED' OR `Action`='RECEIVE')) OR (`Status`='0' AND `Store`='1' AND `Date`>='$dato' AND `Destin`='$custo' AND `Action`='PURCHASE') ORDER BY `Date` ASC, `Number` ASC");				
					$n=1;				$to=0;
			while($ro=mysqli_fetch_assoc($do)){
				$stat=$ro['Vehicles'];
				$dat=$ro['Date'];
			    $pri=$ro['Price'];
			    $qty=$ro['Quantity'];
			    if($stat=='0')
			    $stat=$ro['Item'];
			    
				$item=$ro['Item'];
				$type=$ro['Type'];
				$repa=$ro['Repair'];
				$vous=$ro['Voucher'];
				$invo=$ro['Number'];
				
				if($ro['Action']=='RECEIVE'){
				    $ope+=$qty;
				$stl="style='padding:1px; color:blue;'";
				$pla=$ro['Destin'];
				$dest=$ro['Invoice'];
				$dri="";
				}
				else{
				    $ope-=$qty;
				$stl="style='padding:1px;'";
				
			$sdo=mysqli_query($conn, "SELECT `Plate` FROM `vehicles` WHERE `Number`='$stat' ORDER BY `Number` DESC");
				$sro=mysqli_fetch_assoc($sdo);
				    $pla=$sro['Plate'];
				    
			$rdo=mysqli_query($conn, "SELECT `Destination`, `Location`, `Driver` FROM `trips` WHERE `Vehicle`='$stat' AND `Date`<='$dat' ORDER BY `Number` DESC LIMIT 1");
				$rro=mysqli_fetch_assoc($rdo);
				    $dest=$rro['Destination']." ".$rro['Location'];
				    //$loco=$rro['Location'];
				        if($rro['Driver'])
				    $dri=" &nbsp; <font color='teal'>".$rro['Driver']."</font>";
				        else
				            $dri="";
				}

	$prio=number_format($pri,2);				$qto=number_format($qty, 2);					$opeo=number_format($ope, 2);
		 
		print("<tr><td $stl><div align='right'>$n&nbsp;&nbsp;</td>
				<td class='text-center' $stl> $dat </td>
	<td $stl> $custo </td><td $stl> $pla $dri </td><td $stl> $dest </td>
				<td $stl class='text-right'> $prio </td>
				<td $stl class='text-right'> $qto </td>
	<td $stl class='text-right'><div style='padding:1px 10px 1px 1px;'>$opeo</div></tr>");
							$n++;                    $to+=$val;
						}
						$to=number_format($to, 2);					
						?>
						
                    </tbody>
			<tr><th colspan='6'><div align='center'> Closing Balance </th>
					<th class='text-right' style='padding:1px 10px 1px 1px;' colspan='2'><?php echo $opeo ?></th></tr>
                  </table>
              </div></div>

                  </div>                     
                
              </div><span class="pull-right hidden-print">
			 &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
            </div></div>
                  </div>
        
        <?php
    	}
    	else{
    	    if($p=='1')
    	    	echo"<div class='row'>
            <div class='col-lg-12' style='margin-top:-20px;'>
             <span> &nbsp;&nbsp; Total Records Found : <b> 0 </b></span> 
            <div class='widget-container fluid-height clearfix'>
            <div class='widget-content padded clearfix'>
			<br><br><br><br><br><br>
	<div style='text-align:center; font-size:24px; color:#ff9999'>Report not available on selected date</div><br><br><br><br><br><br><br>";
	        else
    	    	echo"<div class='row'>
            <div class='col-lg-12' style='margin-top:-20px;'>
             <span> &nbsp;&nbsp; Total Records Found : <b> 0 </b></span> 
            <div class='widget-container fluid-height clearfix'>
            <div class='widget-content padded clearfix'>
			<br><br><br><br><br><br>
	<div style='text-align:center; font-size:24px; color:#ff9999'>Please select an item and set date period then search</div><br><br><br><br><br><br><br>";
    	}
   include'footer.php';
   ?>
