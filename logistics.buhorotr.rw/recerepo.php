<?php
if(basename($_SERVER['PHP_SELF']) == 'recerepo.php') 
  $cm=" class='current'";
include'header.php';
include'connection.php';
$dato=$datos=$Date;
$custo=$conde='';

// search for an item to be added to the chart
if(isset($_POST['search']))
		{
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$custo=$_POST['custo'];
			$conde="AND `Date` BETWEEN '$dato' AND '$datos'";
			$p=1;

			if($custo)
				$condi="AND `Destin`='$custo'";
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
                  
			  <li class="list-group-item active">
              <a href="recerepo.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;S.In &nbsp;Report
                </p>
              </a></li>
                  
			  <li class="list-group-item">
              <a href="xrecerepo.php">
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
                  
			  <li class="list-group-item">
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

				  <div class="col-lg-4"> </div>         

                         
                       <div class="col-lg-8 hidden-print"><div class="col-lg-3">
			<select class="form-control" name="custo" style="margin-left:-55px; width:220px;">
				<option value='' selected='selected'>Select Supplier</option>
			 <?php
			$doi=mysqli_query($conn, "SELECT `Destin` FROM `stouse` WHERE `Status`='0' AND `Action`='RECEIVE' AND `Destin`!='' GROUP BY `Destin` ORDER BY `Destin` ASC");
			while($roi=mysqli_fetch_assoc($doi)){
				$desto=$roi['Destin'];
				if($desto==$custo)
					$sle="selected='selected'";
				else
					$sle='';
			echo"<option value='$desto' $sle> $desto </option>";
			}
			?>    
                            </select>
					   </div>
            <div class="col-lg-3"> 
           <div class="input-group date" data-provide="datepicker">
      <input class="form-control form-center" id="from" name="dato" type="text" value="<?php echo $dato ?>" onkeypress='return isNumberKey(event)' required>
	  <span class="input-group-addon"><i class="lnr lnr-calendar-full"></i></span>
			</div></div>


		  <div class="col-lg-3"> 
           <div class="input-group date" data-provide="datepicker">	
      <input class="form-control form-center" id="to" name="datos" type="text" value="<?php echo $datos ?>" onkeypress='return isNumberKey(event)' required>
	  <span class="input-group-addon"><i class="lnr lnr-calendar-full"></i></span>
              </div></div>                      
                       
                       <div class="col-lg-2">
                        <button class="btn  btn-primary btn-block" type="submit" name="search"><i class="lnr lnr-magnifier"></i> Search</button>
                   
					  </div>
                         </div> 
                      
                     
                  
            </form> 

			</div>
<?php
			 if($p)
$do=mysqli_query($conn, "SELECT *FROM `stouse` WHERE `Action`='RECEIVE' AND `Status`='0' $conde $condi ORDER BY `Number` ASC");
	else
$do=mysqli_query($conn, "SELECT *FROM (SELECT *FROM `stouse` WHERE `Action`='RECEIVE' AND `Status`='0' ORDER BY `Date` DESC LIMIT 15) SUB ORDER BY `Date` ASC");
$fo=mysqli_num_rows($do);
?>


<div class="divFooter"><center><u><b>RECEIVING REPORT <?php echo"$mpri"; ?></b></u></center></div>
             <div class="row">
            <div class="col-lg-12" style='margin-top:-20px;'>
             <span> &nbsp;&nbsp; Total Records Found : <b><?php echo" $fo " ?></b></span>
			 <span class="pull-right"><a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">
               
                                 <table class="table table-striped table-hover">     
                                      <thead>
                    <tr role="row">
                     <th> No </th>
                        <th><div align='center'> DATE </th>
                        <th><div align='center'> ITEM&nbsp;NAME </th>
                       <th><div align='center'> ITEM&nbsp;TYPE </th>
                       <th><div align='center'> SUPPLIER </th>
					   <th><div align='center'> STATUS </th>
						 <th><div align='center'> PRICE </th>
						 <th><div align='center'> QUANTITY </th>
							<th><div align='center'>AMOUNT</th>
                     </tr>
                    </thead>
                                        <tbody>
					<?php
					$n=1;				$to=0;
						while($ro=mysqli_fetch_assoc($do)){
				$code=$ro['Number'];
				$dest=$ro['Destin'];
				$stat=$ro['Invoice'];
				$dat=$ro['Date'];
			$ite=$ro['Item'];
			$pri=$ro['Price'];
			$qty=$ro['Quantity'];
			$val=$qty*$pri;

			$sdo=mysqli_query($conn, "SELECT *FROM `items` WHERE `Status`='0' AND `Number`='$ite' ORDER BY `Number` DESC");
				$sro=mysqli_fetch_assoc($sdo);
					$item=$sro['Item'];
					$type=$sro['Type'];


			$prio=number_format($pri,2);				$qto=number_format($qty,2);					$valo=number_format($val,2);
			$stl="style='padding:1px;'";
		 
		print("<tr>
                        <td $stl><div align='right'>$n&nbsp;&nbsp;</td>
						<td class='text-center' $stl> $dat </td>
						<td $stl> $item </td><td $stl> $type </td><td $stl> $dest </td>
						<td $stl> $stat </td><td $stl class='text-right'> $prio </td>
						<td $stl class='text-right'> $qto </td>
						<td class='text-right' style='padding:1px 10px 1px 1px;'>$valo</div></tr>");
							$n++;                    $to+=$val;
						}
						$to=number_format($to, 2);					
						?>
						
                    </tbody>
					<tr><th> </th><th colspan='6'>&nbsp;&nbsp;&nbsp;&nbsp; TOTAL VALUE </th>
					<th class='text-right' colspan='3'><?php echo $to ?>&nbsp;</th></tr>
                  </table>
              </div></div>

                  </div>                     
                
              </div><span class="pull-right hidden-print">
			 &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
            </div></div>
                  </div>
        
   <?php
   include'footer.php';
   ?>
