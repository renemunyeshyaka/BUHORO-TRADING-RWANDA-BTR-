<?php
if(basename($_SERVER['PHP_SELF']) == 'erepo.php') 
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

    <li class="list-group-item">
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

<li class="list-group-item active">
	  <a href="erepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Employees Report
                </p>
              </a></li> 
                         
            </ul>
  </div>
                    
           
           
    <form action="" method="post" class="form-horizontal "> 
        <div class="col-lg-10">

   <?php
$do=mysqli_query($conn, "SELECT *FROM `employees` WHERE `Eid`!='1001' AND `Status`='0' ORDER BY `Fname` ASC");
	$fo=mysqli_num_rows($do);
					?>
            <div class="divFooter"><center><u><b>EMPLOYEES REPORT <?php echo"$mpri"; ?></b></u></center></div>
		 <div class="row">
            <div class="col-lg-12">
             <span> &nbsp;&nbsp; Total Records Found : <b><?php echo" $fo " ?></b></span>
			 <span class="pull-right"><a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">


                           <table class="table table-striped table-hover">
                          <thead>
                    <tr role="row">
                     <th class="hidden-xs"> No </th>
					   <th><center> Stat_Date </th> 
                       <th> First&nbsp;Name </th>
                       <th> Last&nbsp;Name </th> 
                       <th> Telephone </th>
					   <th> ID_Number </th>
					   <th> Address </th>
					   <th><center> Position </th>
					   <th><center> Bank&nbsp;Account </th>
					   <th><center> Salary </th>
                     </tr>
                    </thead>
                                        <tbody>
                                          
				<?php
				$n=1;
				while($ro=mysqli_fetch_assoc($do)){
$code=$ro['Eid'];
$fna=$ro['Fname'];
$lna=$ro['Lname'];
$dep=$ro['Depart'];
$cont=$ro['Contact1'];
$idn=$ro['Idno'];
$pos=$ro['Currentp'];
$adde=$ro['Address'];
$sala=number_format($ro['Salary']);
$bank=$ro['Bank'];
$acco=$ro['Account'];
$std=$ro['Starting'];
$stn="style='padding:1px;'";

if(!$bank AND !$acco)
$banko='';
else
$banko="$acco/$bank";

$then=mysql_query("SELECT `Depart` FROM `depart` WHERE `Number` = '$dep'");
$ren=mysql_fetch_assoc($then);
$dep=$ren['Depart'];

$theni=mysql_query("SELECT `Postname` FROM `position` WHERE `Postid` = '$pos'");
$reni=mysql_fetch_assoc($theni);
$pos=$reni['Postname'];

	print("<tr><td class='hidden-xs text-right' $stn> $n &nbsp;</td><td $stn> $std</td><td $stn> $fna</td><td $stn> $lna</td>
	<td align='right' $stn> $cont</td><td align='right' $stn> $idn</td><td $stn> $adde</td><td $stn> $pos</td>
	<td $stn> $banko</td><td $stn><div align='right'> $sala</td></tr>");
												$n++;
				}
				?>
                    </tbody>   
                  </table>
         








                                
              </div>
            </div></div>
        </div><span class="pull-right hidden-print">
			 &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>

			 </div></div></div>
<?php
include'footer.php';
?>