<?php
if(basename($_SERVER['PHP_SELF']) == 'logrepo.php') 
  $cm=" class='current'";
include'header.php';
include'connection.php';
$dato=$datos=$Date;
$custo='';

if(isset($_POST['search']))
		{
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$custo=$_POST['custo'];
		}
		
		

		if($dato==$datos)
			$mpri="ON $dato";
		else
			$mpri="FROM $dato TO $datos";

if($custo)
$conde="AND `User`='$custo'";
else
$conde="";

$do=mysql_query("SELECT *FROM `moves` WHERE `Date` BETWEEN '$dato' AND '$datos' $conde ORDER BY `Number` ASC");
$fo=mysql_num_rows($do);
?>
<div class="container-fluid main-content">
        <div class="page-title hidden-print">
          <h2 style='margin-top:-20px; margin-bottom: 5px;'>
         Control Report
          </h2>
                 </div>
     
        <div class="row">
  <div class="col-lg-2 hidden-print">
   
   <ul class="list-group">

    <li class="list-group-item">
	  <a href="#">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Control Report
                </p>
              </a></li>  

	 <li class="list-group-item">
	  <a href="damrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Damage Report
                </p>
              </a></li>     

	 <li class="list-group-item">
	  <a href="deleport.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Deleted Report
                </p>
              </a></li>   

	 <li class="list-group-item active">
	  <a href="logrepo.php">
                <p>
                <i class="lnr lnr-menu-circle"></i>&nbsp;Logging Report
                </p>
              </a></li> 
                         
            </ul>
  </div>
                    
           
           
       
        <div class="col-lg-10">
                  <div class="row">
         
           <div class="col-lg-3"> </div>
          
         
           

        <form action="" method="post" class="form-horizontal ">                  
                       <div class="col-lg-9 hidden-print"><div class="col-lg-3"> 
					   
			   <select class="form-control" name="custo"><option value=''> SELECT USER </option>
	<?php

$doi=mysql_query("SELECT `User` FROM `moves` GROUP BY `User` ORDER BY `User` ASC");
			while($roi=mysql_fetch_assoc($doi)){
				$fna=$roi['User'];
				if($fna==$custo)
					$s='selected';
				else
					$s='';
			echo"<option value='$fna' $s> $fna </option>";
			}
?></select>
					   
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

			<div class="divFooter"><center><u><b>LOGGING REPORT <?php echo $mpri ?></b></u></center></div>
             <div class="row">
            <div class="col-lg-12">
             <span>Total Records Found : <b><?php echo" $fo " ?></b></span>
			 <span class="pull-right"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SYSTEM LOG</b>
			 &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span><span class="pull-right"><b>&nbsp;&nbsp;&nbsp; 
			 &nbsp;&nbsp;&nbsp;<?php echo $cs ?></b></span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">
               
                                 <table class="table table-striped table-hover">     
                                      <thead>
                     <tr role="row">
                     <th class="hidden-xs"> No </th> 
                       <th> Due&nbsp;Date </th>
                       <th> System&nbsp;User </th>
                       <th><div align='right'> Address &nbsp;&nbsp;&nbsp; </th>
                        <th> Location </th>
                     </tr>
                    </thead>
                                        <tbody>
					<?php
					$n=1;				$tp=0;	
						while($ro=mysql_fetch_assoc($do)){
				$code=$ro['Number'];
				$user=$ro['User'];			
			$dte=$ro['Date'];			
			$tme=$ro['Time'];
			$adde=$ro['Address'];
			$loco=$ro['Location'];
			$stn="padding-top:0px; padding-bottom:0px;";
		print("<tr>
          <td class='hidden-xs' style='$stn'><div align='center'>$n&nbsp;&nbsp;</td>
			<td style='$stn'> $dte&nbsp;&nbsp;&nbsp;$tme </td><td style='$stn'> $user </td> <td style='$stn'><div align='right'> $adde </td>
			<td style='$stn'> $loco </td></tr>");
						  $n++;				
						}
							
						?>
						
                     </tbody>
                  </table><br>

<?php
$ip   = $_SERVER['REMOTE_ADDR'];
$long = ip2long($ip);

if ($long == -1 || $long === FALSE) {
    echo 'Invalid IP, please try again';
} else {
    echo $ip   . "\n";            // 192.0.34.166
    echo $long . "\n";            // 3221234342 (-1073732954 on 32-bit systems, due to integer overflow)
    printf("%u\n", ip2long($ip)); // 3221234342
}
?>


              </div>
            </div></div>
                  </div>                    
                <span class="pull-right">
			 &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return window.print()" class="hidden-print" title='Print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
      
   </div></div></div> 
    
   <?php
   include'footer.php';
   ?>
