<?php
if(basename($_SERVER['PHP_SELF']) == 'arrirepo.php') 
  $cm=" class='current'";
include'header.php';
include'connection.php';
$custo=$conde=$condi='';
$dato = strtotime("-10days", strtotime("$Date"));
$dato = date ("Y-m-d", $dato);
$datos = $Date;
$custo=$conde='';
$code=$p=0;

if(isset($_POST['search']))
		{
			$custo=$_POST['custo'];
			$dato=$_POST['dato'];
			$datos=$_POST['datos'];
			$p=1;
		}

		
		if($custo)
    $conde="AND `Vehicle` = '$custo'";
		


$doj=mysqli_query($conn, "SELECT *FROM `trips` WHERE `Status`='0' AND `ETD` BETWEEN '$dato' AND '$datos' $conde ORDER BY `Number` DESC");
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

    <li class="list-group-item active">
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

    <li class="list-group-item">
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
                       
            </ul><br><br>
  </div> 

        <div class="col-lg-10">
                  <div class="row hidden-print">
		<div class="col-lg-4"> </div>  
         
           

        <form action="" method="post" class="form-horizontal ">                  
                       <div class="col-lg-8 no-print">
					   
					   <div class="col-lg-4 hidden-print"> 
      <select class="form-control" name="custo">
				<option value='' selected='selected'>Select Vehicle</option>
			 <?php
	$doi=mysqli_query($conn, "SELECT `vehicles`.`Plate`, `trips`.`Vehicle` FROM `trips` INNER JOIN `vehicles` ON `vehicles`.`Number` = `trips`.`Vehicle` GROUP BY `trips`.`Vehicle` ORDER BY `trips`.`Vehicle` ASC");
			while($roi=mysqli_fetch_assoc($doi)){
				$veh=$roi['Vehicle'];
				$fna=$roi['Plate'];
				if($veh==$custo)
					$sle="selected='selected'";
				else
					$sle='';
			echo"<option value='$veh' $sle> $fna </option>";
			}
			?>    
                            </select>
			</div>          
            
			 <div class="col-lg-3 hidden-print"> 
           <div class="input-group date" data-provide="datepicker">
      <input class="form-control form-center" id="from" name="dato" type="text" value="<?php echo $dato ?>" onkeypress='return isNumberKey(event)' required>
	  <span class="input-group-addon"><i class="lnr lnr-calendar-full"></i></span>
			</div></div>


		  <div class="col-lg-3 hidden-print"> 
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
             <div class="row">
            <div class="col-lg-12" style='margin-top:-20px;'>
             <span>Total Records Found : <b><?php echo" $fo " ?></b></span>
			  <span class="pull-right"><a href="#" onclick="return window.print()" class="hidden-print" title='Print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a>&nbsp;&nbsp;&nbsp;</span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">

<div class="table-responsive">
			<table class="table table-striped table-hover table-sm" style="font-size:8px;">     
                                      <thead>
                    <tr role="row"><th style='width:10px;'>&nbsp;No&nbsp;</th>
                    <?php
        $date=$dato; 
        $dte=array();
        $n=1;
        while($date<=$datos){
                $dao=date("d/m", strtotime("$date"));
            echo"<th class='text-center' title='$n'> $dao </th>";
            $date = strtotime("+1 day", strtotime("$date"));
				$date=date("Y-m-d", $date);
				$dte[$n]=$date;
				$n++;
        }
          ?>          
            </tr>
                    </thead><tbody>
		<?php
		for($t=1; $t<=10; $t++){
				$k=1;                      $dat=""; 
				
echo"<tr><td class='text-center' style='padding:0px; width:10px;'> $t </td>";
		   for($i=0; $i<$n; $i++){
		       $das=$dte[$i];
	
	$doj=mysqli_query($conn, "SELECT *FROM `trips` WHERE `Status`='0' AND `ETD` = '$das' $conde ORDER BY `Number` ASC LIMIT $t, 1");
	 if($foj=mysqli_num_rows($doj)){
		     $ro=mysqli_fetch_assoc($doj);
		     $code=$ro['Number'];
		     $conte=$ro['Vehicle'];
		     $count=$ro['Location'];
		     $desti=$ro['Destination'];
		     $dat=$ro['ETD'];
		     
        $doi=mysqli_query($conn, "SELECT `Plate` FROM `vehicles` WHERE `Number`='$conte'");
			$roi=mysqli_fetch_assoc($doi);
				$fna=$roi['Plate'];
		      
		       if($i%2=='0')
		       $bte="warning";
		       else
		       $bte="info";
	echo"<form method=post action='dispatch.php'><td style='padding:0px; text-align:center;'>
              <input type='hidden' name='rowid' value='$code'>
    <button type='submit' name='open' class='btn btn-$bte' style='height:40px; font-size:12px; padding-left:2px; padding-right:2px; width:80px; font-weight:bold;' title='$dat \n $desti' data-toggle='tooltip' data-placement='top'> $fna <br> <span class='badge' style='float:right; color:#000000; font-size:8px;'>$count</span></button></td></form>";
		       }
		       else
		        echo"<td style='padding:0px;'>  </td>";
		   }  
		     
		     echo"</tr>";
		     $k++;
		 }
				
				?></tbody>
                  </table>
			
                    </div></div></div></div></div>                 
               <div class="col-lg-12 hidden-print"> <span class="pull-right hidden-print"><a href="#" onclick="return window.print()" class="hidden-print" title='Print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a>&nbsp;&nbsp;&nbsp;</span></div> 
                          
                  </div>
      
   </div></div></div>
   <?php
   include'footer.php';
   ?>