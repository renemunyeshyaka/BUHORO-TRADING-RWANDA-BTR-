<?php
if(basename($_SERVER['PHP_SELF']) == 'person.php') 
  $cm=" class='current'";
include'header.php';
include'connection.php';
$dato=$datos=$Date;
$conde='';
$emploi='';
$emplo='Select Employee';

if(isset($_POST['search']))
		{
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$emplo=$_POST['emplo'];
			$emploi=$emplo;
		}

$so=mysql_query("DELETE FROM `payment` WHERE `Amount`='0' AND `Commis`='0' ORDER BY `Number` ASC LIMIT 50");

		if($emplo!='Select Employee' AND $emplo!='')
			$conde="AND `Employee`='$emplo'";

		if($emploi=='')
			$emplo='Select Employee';

$do=mysql_query("SELECT *FROM `parking` WHERE `Date` BETWEEN '$dato' AND '$datos' AND `Destin`='WASHING' $conde GROUP BY `Employee` ORDER BY `Employee` ASC");
	$fo=mysql_num_rows($do);

$dop=mysql_query("SELECT SUM(Price) AS 'Pri' FROM `parking` WHERE `Date` BETWEEN '$dato' AND '$datos' AND `Destin`='WASHING' $conde ORDER BY `Employee` ASC");
	$rop=mysql_fetch_assoc($dop);
		$sum=$rop['Pri'];
?>
<div class="container-fluid main-content">
        <div class="page-title">
          <h2 style='margin-top:-20px; margin-bottom: 5px;'>
         Allowance Report
          </h2>
                 </div>
     
        <div class="row">
  <div class="col-lg-2 hidden-print">
   
   <ul class="list-group">
      
	   <li class="list-group-item">
	  <a href="comrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Per Commission
                </p>
              </a></li>   

	   <li class="list-group-item active">
              <a href="person.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Per Employee
                </p>
              </a></li>  

    <li class="list-group-item">
	  <a href="allowance.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Per Services
                </p>
              </a></li>
                         
            </ul>
  </div>
                    
           
           
       
        <div class="col-lg-10">
                  <div class="row">
         
           <div class="col-lg-4"> </div>
          
         
           

        <form action="" method="post" class="form-horizontal ">                  
                       <div class="col-lg-8 no-print"><div class="col-lg-3"> 					   
					<select class="form-control" name="emplo">				
			 <?php
				echo"<option value='$emploi' selected='selected'>$emplo</option>";
			$doi=mysql_query("SELECT `Employee` FROM `parking` WHERE `Employee`!='' GROUP BY `Employee` ORDER BY `Employee` ASC");
			while($roi=mysql_fetch_assoc($doi)){
				$fna=$roi['Employee'];
				if($fna==$emplox)
					$sle="selected='selected'";
				else
					$sle='';
			echo"<option value='$fna' $sle> $fna </option>";
			}
			?>    
                            <option value=''>ALL EMPLOYEES</option></select>   
					   
					   
					   
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
             <div class="row">
            <div class="col-lg-12">
             <span>Total Records Found : <b><?php echo" $fo " ?></b></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">
               
                                 <table class="table table-striped">     
                                      <thead>
                   <tr role="row">
                     <th> S.NO</th>
                        <th> From - To Date </th>
                       <th> Employee&nbsp;Name</th>
                        <th> Vehicles </th> 
                        <th> Amount </th>
						 <th><div align='right'> Value </th> 
						 <th><div align='right'> Allowance </th>
						 <th><div align='center'> Perform </th> 
                     </tr>
                    </thead>
                                        <tbody>
					<?php
					$n=1;		$itot=$itall=$iamo=$veh=0;
						while($ro=mysql_fetch_assoc($do)){
							$emplot=$ro['Employee'];
							$tot=$tall=$amo=$allo=$per=$valu=$fov=0;
		$doi=mysql_query("SELECT *FROM `parking` WHERE `Date` BETWEEN '$dato' AND '$datos' AND `Destin`='WASHING' AND `Employee`='$emplot' ORDER BY `Employee` ASC");
			while($roi=mysql_fetch_assoc($doi)){
				$disc=$ro['Discount'];
				$pla=$ro['Plate'];
				$pri=$ro['Price'];

			$allo=$pri*$disc/100;
			$valu=$pri-$allo;
			$tot+=$valu;
			$tall+=$allo;
			$amo+=$pri;

			$itot+=$valu;		$itall+=$allo;		$iamo+=$pri;
			}
	
	$dov=mysql_query("SELECT *FROM `parking` WHERE `Date` BETWEEN '$dato' AND '$datos' AND `Destin`='WASHING' AND `Employee`='$emplot' GROUP BY `Plate` ORDER BY `Employee` ASC");
		$fov=mysql_num_rows($dov);
	
	$amoo=number_format($amo);
	$toto=number_format($tot);
	$tallo=number_format($tall);

	$per=round($amo/$sum*100, 2);
          $veh+=$fov; 
		print("<tr>
                        <td class=hidden-xs><div align='center'>$n&nbsp;&nbsp;</td>
                        <td> $dato&nbsp;-&nbsp;$datos </td><td> $emplot </td>
                        <td><div align='center'> $fov </td>
                        <td><div align='right'> $amoo&nbsp;</td>
                        <td><div align='right'> $toto&nbsp;</td>
                        <td><div align='right'><b> $tallo&nbsp;</td>
                        <td><div align='center'> $per%&nbsp;</td></tr>");
						  $n++;				$valu=$allo=$pri=0;
						}
						$itoto=number_format($itot);
						$itallo=number_format($itall);
						$iamoo=number_format($iamo);
						?>
						
                    </tbody><thead>
					<tr><th class='hidden-xs'> </th>
					<th colspan='2'><div align='center'> Total Amount </th>	
					<th><div align='center'><?php echo $veh ?>&nbsp;</th>
					<th><div align='right'><?php echo $iamoo ?>&nbsp;</th>
					<th><div align='right'><?php echo $itoto ?>&nbsp;</th>
					<th><div align='right'><?php echo $itallo ?>&nbsp;</th>
					<th><div align='center'>100%</th></tr>
                  </table>
                    <div class="row">
                  <div class="col-lg-12">
                  <div class="pull-right">
                 <button class="btn btn-primary btn-success hidden-print" onclick="return window.print()"><i class="lnr lnr-printer"></i> Print</button>
              </div></div></div>                     
                
              </div>
            </div></div>
                  </div>
      
   </div></div></div>  
   <style>
   @media print
{    
    .no-print, .no-print *
    {
        display: none !important;
    }
}
</style>
  <script>
$(document).ready(function(){
	$(".pdf").click(function(){
		$("#table1").hide();
		setTimeout(function(){$("#table1").show()},1000);
		});
});
</script>
  <!-- used for show calendar -->
   <script src="style/bootstrap.js" type="text/javascript"></script>
  <script src="style/jquery_002.js" type="text/javascript"></script>
 <!-- ****************************** -->
  
   <script src="style/jquery.js" type="text/javascript"></script>
  <script src="style/datatable-editable.js" type="text/javascript"></script>
  <!-- used for calendar -->
 <script src="style/jquery_003.js" type="text/javascript"></script>
 <!-- ******************************* -->
<script src="style/bootstrap-confirmation.js"></script>
  
  <script src="style/bootstrap-fileupload.js" type="text/javascript"></script>
   <script src="style/bootstrap-datepicker.js" type="text/javascript"></script>
   <script src="style/bootstrap-timepicker.js" type="text/javascript"></script>
   <script src="style/jquery_004.js" type="text/javascript"></script>
   
    
     <script>
     /*   for mobile navigation */
     $('.navbar-toggle').click(function() {
         return $('body, html').toggleClass("nav-open");
       });

     /*
      * =============================================================================
      *   DataTables
      * =============================================================================
      */
     $("#dataTable1").dataTable({
       "sPaginationType": "full_numbers",
       aoColumnDefs: [
         {
           bSortable: false,
           aTargets: [0, -1]
         }
       ]
     });
     $('.table').each(function() {
       return $(".table #checkAll").click(function() {
         if ($(".table #checkAll").is(":checked")) {
           return $(".table input[type=checkbox]").each(function() {
             return $(this).prop("checked", true);
           });
         } else {
           return $(".table input[type=checkbox]").each(function() {
             return $(this).prop("checked", false);
           });
         }
       });
     });


     /*
      * =============================================================================
      *   Bootstrap Popover
      * =============================================================================
      */
     
     $(".popover-trigger").popover(); 
     /*
      * =============================================================================
      *   Datepicker
      * =============================================================================
      */
   
     $('.datepicker').datepicker({
    format: 'yyyy-mm-dd'
 });
   
  
   </script>
 </body></html>