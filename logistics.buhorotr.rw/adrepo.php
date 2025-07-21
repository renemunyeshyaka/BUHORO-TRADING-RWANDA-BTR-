<?php
if(basename($_SERVER['PHP_SELF']) == 'adrepo.php') 
  $cm=" class='current'";
include'header.php';
include'connection.php';
$custo=$conde=$condi='';
$dato=$datos=$Date;
$p=0;

// search for an item to be added to the chart
if(isset($_POST['search']))
		{
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$custo=$_POST['custo'];
			$conde="AND `Date` BETWEEN '$dato' AND '$datos'";
			$p=1;

			if($custo)
				$condi="AND `Employee`='$custo'";
		}
	
	if($dato==$datos)
			$mpri="ON $dato";
		else
			$mpri="FROM $dato TO $datos";
?>
<div class="container-fluid main-content">
        <div class="page-title hidden-print">
          <h3 style='margin-top:-20px; margin-bottom: 5px; color:#ffcc33'>
         Payroll Report
          </h3>
                 </div>
     
        <div class="row">
  <div class="col-lg-2 hidden-print">
   
  <ul class="list-group">   

    <li class="list-group-item">
	  <a href="rollrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Payroll Report
                </p>
              </a></li>  
              
     <li class="list-group-item">
	  <a href="payerepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Payroll Report & PAYE
                </p>
              </a></li>   

    <li class="list-group-item">
	  <a href="bankrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Payroll Report & BANK
                </p>
              </a></li>    

    <li class="list-group-item">
	  <a href="handrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Payroll Report & HAND
                </p>
              </a></li> 

    <li class="list-group-item active">
	  <a href="adrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Advance Report
                </p>
              </a></li>  

    <li class="list-group-item">
	  <a href="allrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Allowance Report
                </p>
              </a></li>

	 <li class="list-group-item">
	  <a href="derepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Deduction Report
                </p>
              </a></li>    

<li class="list-group-item">
	  <a href="payrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Payment Report
                </p>
              </a></li>      

<li class="list-group-item">
	  <a href="erepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Employees Report
                </p>
              </a></li> 
                         
            </ul>
  </div>
                    
           
           
    <form action="" method="post" class="form-horizontal "> 
        <div class="col-lg-10">
                  <div class="row">

				  <div class="col-lg-4"> </div>         

                         
                       <div class="col-lg-8 hidden-print"><div class="col-lg-3">
			<select class="form-control" name="custo" style="margin-left:-55px; width:220px;">
				<option value='' selected='selected'>Select Employee</option>
			 <?php
			$doi=mysql_query("SELECT `employees`.* FROM `advance` INNER JOIN `employees` ON `advance`.`Employee` = `employees`.`Eid` WHERE `employees`.`Status`='0' AND `employees`.`Eid`!='1001' GROUP BY `advance`.`Employee` ORDER BY `employees`.`Fname` ASC");
			while($roi=mysql_fetch_assoc($doi)){
				$code=$roi['Eid'];
				$fna=$roi['Fname'];
				$lna=$roi['Lname'];
				if($code==$custo)
					$sle="selected='selected'";
				else
					$sle='';
			echo"<option value='$code' $sle> $fna $lna </option>";
			}
			?>    
                            </select>
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
             <?php
				if($p)
$do=mysqli_query($conn, "SELECT *FROM `advance` WHERE `Status`='0' $conde $condi ORDER BY `Number` ASC");
	else
$do=mysqli_query($conn, "SELECT *FROM (SELECT *FROM `advance` WHERE `Status`='0' ORDER BY `Date` DESC LIMIT 15) SUB ORDER BY `Date` ASC");
$fo=mysqli_num_rows($do);
					?>
					<div class="divFooter"><center><u><b>ADVANCE REPORT <?php echo"$mpri"; ?></b></u></center></div>
		 <div class="row">
            <div class="col-lg-12">
             <span> &nbsp;&nbsp; Total Records Found : <b><?php echo" $fo " ?></b></span>
			 <span class="pull-right"><a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">

			 <table class="table table-striped table-hover">     
                                      <thead>
                    <tr role="row">
                     <th> No </th>
                        <th> Due&nbsp;Date </th>
                       <th> Employee`s&nbsp;Name</th> 
                        <th> Purpose/Issue </th> 
                        <th> Payment/Month </th>
						 <th> Total&nbsp;Amount </th>
						 <th> Paid&nbsp;Amount </th>
						 <th> Balance </th></tr></thead>
                                        <tbody>
					<?php
					$n=1;					$tam=$tba=0;
						while($ro=mysqli_fetch_assoc($do)){
$code=$ro['Number'];
$emplo=$ro['Employee'];
$amo=$ro['Amount'];
	$amoo=number_format($amo);
$purpo=$ro['Purpose'];
$dte=$ro['Date'];
$im=$ro['File1'];
$pamo=$ro['Payment'];
//$bal=$ro['Balance'];
$month=explode(" ", $ro['Month']);

$mt=$month[0];
$yr=$month[1];

$doi=mysqli_query($conn, "SELECT *FROM `employees` WHERE `Eid`='$emplo'");
			$roi=mysqli_fetch_assoc($doi);
				$fna=$roi['Fname'];
				$lna=$roi['Lname'];
				
	$sso=mysqli_query($conn, "SELECT `Advance` FROM `payrolls` WHERE `Month`='$mt' AND `Year`='$yr' AND `Employee`='$emplo'");
			$sro=mysqli_fetch_assoc($sso);
				$pai=$sro['Advance'];
				$bal=$amo-$pamo;
				
	$pamoo=number_format($pamo);
	$balo=number_format($bal);
	$paio=number_format($pai);
/*
if($file1)
	$dfile="<a href='down_contra.php?link=$file1'>Download&nbsp;File</a>";
else
	$dfile="";
*/
$stn="style='padding:1px;'";
           
		print("<tr><td $stn class='text-center'>$n</td>
                        <td $stn> $dte </td>
                        <td $stn> $fna $lna </td><td $stn> $purpo </td>
						<td class='text-right' style='padding:0px 40px 0px 0px;'> $pamoo </td>
						<td class='text-right' style='padding:0px 40px 0px 0px;'> $amoo </td>
						<td class='text-right' style='padding:0px 40px 0px 0px;'> $paio </td>
						<td class='text-right' style='padding:0px 40px 0px 0px;'> $balo </td></tr>");
						  $n++;				$tam+=$amo;					$tba+=$bal;
						}
									
		$tpa=number_format($tam-$tba);					$tam=number_format($tam);					$tba=number_format($tba);

		?>
                    </tbody> 
		<tr><th> <th>
			<th colspan='3'>&nbsp;&nbsp;&nbsp;&nbsp;Total Amount </th>
			<th class='text-right' style='padding:0px 40px 0px 0px;'><?php echo $tam ?></th>
			<th class='text-right' style='padding:0px 40px 0px 0px;'><?php echo $tpa ?></th>
			<th class='text-right' style='padding:0px 40px 0px 0px;'><?php echo $tba ?></th></tr>
                  </table>
                                      
                
              </div>
            </div></div>
                  </div>                  
                <span class="pull-right hidden-print">
			 &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
      
   </div></div></div>  
   <?php
   include'footer.php';
   ?>