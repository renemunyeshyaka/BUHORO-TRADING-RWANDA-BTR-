<?php
if(basename($_SERVER['PHP_SELF']) == 'debtors.php') 
  $cm=" class='current'";
include'header.php';
include'connection.php';
$custo=$conde=$condi='';
$dato=$datos=$Date;

if(isset($_POST['search']))
		{
			$custo=$_POST['custo'];
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
		}

		
		if($custo){
			$conde="AND (`Customer` LIKE '%$custo%')";
		}
		else{
		    $conde="AND (`Number`!='2')";
		}

$doj=mysqli_query($conn, "SELECT *FROM `account` WHERE `Status`='0' $conde ORDER BY `Customer` ASC");
$fo=mysqli_num_rows($doj);
?>
<div class="container-fluid main-content">
        <div class="page-title hidden-print">
          <h2 style='margin-top:-20px; margin-bottom: 5px; color:#ffcc33'>
         Trip Report
          </h2>
  
    </div>
   <div class="row">
  <div class="col-lg-2 hidden-print">
   
  <ul class="list-group">
                  
			  <li class="list-group-item">
              <a href="triprepo.php">
                <p>
                <i class="lnr lnr-plus-circle"></i>&nbsp;Trip Report
                </p>
              </a></li>

    <li class="list-group-item">
	  <a href="disrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Dispatch Report
                </p>
              </a></li> 

    <li class="list-group-item">
	  <a href="arrirepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Departure Report
                </p>
              </a></li>  

    <li class="list-group-item">
	  <a href="mirepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Mileage Report
                </p>
              </a></li>  

    <li class="list-group-item">
	  <a href="ductrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Deduction Report
                </p>
              </a></li>  

    <li class="list-group-item">
	  <a href="custorepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Recovery Report
                </p>
              </a></li>  

    <li class="list-group-item">
	  <a href="currerepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Currency Report
                </p>
              </a></li>   

    <li class="list-group-item">
	  <a href="payreport.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Payment Report
                </p>
              </a></li>    

    <li class="list-group-item active">
	  <a href="debtors.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Debtors Report
                </p>
              </a></li>      

    <li class="list-group-item">
	  <a href="girepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;GPS Report
                </p>
              </a></li>         

    <li class="list-group-item">
	  <a href="trepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Target  Report
                </p>
              </a></li>     
              
              </ul>
  </div>
           
       
        <div class="col-lg-10">
                  <div class="row hidden-print">
         
           <div class="col-lg-3 hidden-print"> </div>
          
         
           

        <form action="" method="post" class="form-horizontal ">                  
                       <div class="col-lg-3 hidden-print">
			<select class="form-control" name="custo">
				<option value='' selected='selected'>Select Customer</option>
			 <?php
			$doi=mysqli_query($conn, "SELECT `account`.`Number`, `account`.`Customer` FROM `account` INNER JOIN `income` ON `account`.`Number`=`income`.`Customer` WHERE `account`.`status`='0' AND `income`.`External`='1' GROUP BY `account`.`Customer` ORDER BY `account`.`Customer` ASC");
			while($roi=mysqli_fetch_assoc($doi)){
				$code=$roi['Number'];
				$fna=$roi['Customer'];
				if($code==$custo)
					$sle="selected='selected'";
				else
					$sle='';
			echo"<option value='$fna' $sle> $fna </option>";
			}
			?>    
                            </select>
					   </div>
					   <div class="col-lg-6 hidden-print">
            <div class="col-lg-4"> 
           <div class="input-group date" data-provide="datepicker">
      <input class="form-control form-center" name="dato" type="text" value="<?php echo $dato ?>" onkeypress='return isNumberKey(event)' required>
	  <span class="input-group-addon"><i class="lnr lnr-calendar-full"></i></span>
			</div></div>


		  <div class="col-lg-4"> 
           <div class="input-group date" data-provide="datepicker">	
      <input class="form-control form-center" name="datos" type="text" value="<?php echo $datos ?>" onkeypress='return isNumberKey(event)' required>
	  <span class="input-group-addon"><i class="lnr lnr-calendar-full"></i></span>
              </div></div>                      
                       
                       <div class="col-lg-3">
                        <button class="btn  btn-primary btn-block" type="submit" name="search"><i class="lnr lnr-magnifier"></i> Search</button>
                   
					  </div>
                         </div> 
                      
                     
                  
            </form> 
             
               
            </div>
             <div class="row">
            <div class="col-lg-12" style='margin-top:-20px;'>
             <span>Total Records Found : <b><?php echo" $fo " ?></b></span>
			  <span class="pull-right">&nbsp;&nbsp; 
			  <a href="#" onclick="return window.print()" class="hidden-print" title='Print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
			  
			  <span class="pull-right hidden-print">
		&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" id="exporttable" class="hidden-print" title='Export to excell' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-line-spacing"></i></a></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">

			<table class="table table-striped table-hover table-sm" style="font-size:8px;" id="htmltable">     
                                      <thead>
                    <tr role="row"> <th>&nbsp;&nbsp;No&nbsp;&nbsp;</th>
                        <th> Customer&nbsp;Name </th>
                <th><div align='right'>&nbsp;&nbsp;Telephone&nbsp;&nbsp;</th>
                <th><div align='center'> Tin </th><th><div align='center'> Open. </th><th><div align='center'> New </th><th><div align='center'> Paid </th><th><div align='center'> Balnce </th></tr></thead><tbody>
		<?php
					$n=1;	        $top=$tnew=$tpa=$tclo=0;		
		while($ro=mysqli_fetch_assoc($doj)){
$code=$ro['Number'];
$name=$ro['Customer'];
$dte=$ro['Date'];
$tele=$ro['Telephone'];
$tin=$ro['Tin'];

// ************************ Closing Balance ***********************
$clo=mysqli_query($conn, "SELECT SUM(`Amount`*`Rate`) AS 'Inco' FROM `income` WHERE `Status`='0' AND `Customer`='$code' AND `Date` BETWEEN '2022-01-01' AND '$datos' AND `External`='1'");
        $clos=mysqli_fetch_assoc($clo);
            $inco=$clos['Inco'];

$pas=mysqli_query($conn, "SELECT SUM(`Amount`*`Rate`) AS 'Paid' FROM `payment` WHERE `Status`='0' AND `Account`='$code' AND `Date` BETWEEN '2022-01-01' AND '$datos' AND `Action`='TRANSPORT'");
        $pass=mysqli_fetch_assoc($pas);
            $paid=$pass['Paid'];
            
            $bal=$inco-$paid;
            $balo=number_format($bal);
            
   /*         
// ************************ Balance after datos ***********************
$cloa=mysqli_query($conn, "SELECT SUM(`Amount`*`Rate`) AS 'Inco' FROM `income` WHERE `Status`='0' AND `Customer`='$code' AND `Date`>'$datos' AND `External`='1'");
        $closa=mysqli_fetch_assoc($cloa);
            $incoa=$closa['Inco'];

$pasa=mysqli_query($conn, "SELECT SUM(`Amount`*`Rate`) AS 'Paid' FROM `payment` WHERE `Status`='0' AND `Account`='$code' AND `Date`>'$datos' AND `Action`='TRANSPORT'");
        $passa=mysqli_fetch_assoc($pasa);
            $paida=$passa['Paid'];
            
            $bal=$bal-$incoa+$paida;
            $balo=number_format($bal);
    */
            
// ********************* Rolling between dates *******************
$dclo=mysqli_query($conn, "SELECT SUM(`Amount`*`Rate`) AS 'Inco' FROM `income` WHERE `Status`='0' AND `Customer`='$code' AND `Date` BETWEEN '$dato' AND '$datos' AND `External`='1'");
        $dclos=mysqli_fetch_assoc($dclo);
            $dinco=$dclos['Inco'];

$dpas=mysqli_query($conn, "SELECT SUM(`Amount`*`Rate`) AS 'Paid' FROM `payment` WHERE `Status`='0' AND `Account`='$code' AND `Date` BETWEEN '$dato' AND '$datos' AND `Action`='TRANSPORT' AND `Date`>'2022-01-01'");
        $dpass=mysqli_fetch_assoc($dpas);
            $dpaid=$dpass['Paid'];
            
            $ope=$bal-$dinco+$dpaid;
            $opeo=number_format($ope);
            $dincoo=number_format($dinco);
            $dpaido=number_format($dpaid);

$stl="style='padding:1px;'";

if($ope OR $dinco OR $dpaid OR $bal){
print("<tr><td $stl><div align='center'>$n&nbsp;</td>
	<td $stl>$name</td><td $stl><div align='right'>&nbsp;$tele&nbsp;</td>
	<td $stl><div align='right'>&nbsp;$tin&nbsp;</td><td class='text-right' $stl> $opeo </td><td class='text-right' $stl> $dincoo </td><td class='text-right' $stl> $dpaido </td><td class='text-right' $stl> $balo </td></tr>");
			$n++;           $top+=$ope;         $tnew+=$dinco;          $tpa+=$dpaid;           $tclo+=$bal;
}
	}
	
            $top=number_format($top);
            $tnew=number_format($tnew);
            $tpa=number_format($tpa);
            $tclo=number_format($tclo);

				?></tbody>
				<?php
	echo"<thead><tr><th colspan='4' style='text-align:center;'> Total Amount </th><th class='text-right'> $top </th><th class='text-right'> $tnew </th><th class='text-right'> $tpa </th><th class='text-right'> $tclo </th></tr></thead>";			
				?>
                  </table>
                    <div class="row">
                    </div></div></div> </div>                   
               <div class="col-lg-12 hidden-print"> <span class="pull-right hidden-print"><a href="#" onclick="return window.print()" class="hidden-print" title='Print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a>&nbsp;&nbsp;&nbsp;</span></div> 
              
            </div>
                  </div>
      
   </div></div></div>
   <?php
   include'footer.php';
   ?>