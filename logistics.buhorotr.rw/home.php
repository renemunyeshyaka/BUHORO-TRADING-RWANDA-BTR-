<?php
if(basename($_SERVER['PHP_SELF']) == 'home.php') {
  $co=" class='current'";
} else {
  $co="";
} 
include'header.php';
include'connection.php';
?>
  <script src="Shift_files/fullcalendar.js" type="text/javascript"></script>
<div class="container-fluid main-content">
     <div class="row">
          <div class="col-md-12">                 
                  <div class="widget-content padded " style="text-align: center;">
                
                    <h1 style="margin-top:-20px;">       Logistics Management System (LMS)     </h1> 
                  <small>@<?php echo $cna ?></small> 
                  
                  
              
             </div>
             
            
          </div>
        </div>
        
			 <?php
             if($_SESSION['Empopa'])
                $py='employees.php';
             else
                $py='#';
             ?>

        <!-- Statistics -->
                <div class="row">
          <div class="col-lg-12" style="margin-top:-20px;">
            <div class="widget-container stats-container">
              <div class="col-md-4"><a href="<?php echo $py ?>">
                <div class="number">
                  <div class="lnr lnr-users homeicons"></div>
             <?php
			 $n=1;
	$do=mysql_query("SELECT *FROM `employees` WHERE `Eid`!='1001' AND `Status`='0' GROUP BY `Depart` ORDER BY `Depart` ASC");
		$fo=mysql_num_rows($do);
		while($ro=mysql_fetch_assoc($do)){
			$de=$ro['Depart'];
		$dep=mysql_query("SELECT *FROM `depart` WHERE `Number`='$de' ORDER BY `Number` ASC");
			  $rep=mysql_fetch_assoc($dep);
					$depi=$rep['Depart'];
	$and=mysql_query("SELECT *FROM `employees` WHERE `Eid`!='1001' AND `Status`='0' AND `Depart`='$de' ORDER BY `Depart` ASC");
			$fa=mysql_num_rows($and);
			echo"<label title='$depi'>$fa</label>";
	if($fo>$n)
		echo" - ";
	$n++;
		}
?>	  
</div></a>
                <div class="text">
                 <a href="employees.php">Total Employees</a>
                </div>
              </div>
              <div class="col-md-4"><a href='#'>
                <div class="number">
                  <div class="lnr lnr-map homeicons"></div>
             <?php
		$do=mysql_query("SELECT *FROM `items` WHERE `Quantity`>'0' AND `Status`='0' ORDER BY `Number` ASC");
			$fo=mysql_num_rows($do);
				echo $fo;
				?>
		</div></a>
                <div class="text">
                 <a href="#">Total Items</a>
                </div>
              </div>
              <div class="col-md-4"><a href='mainsto.php'>
                <div class="number">
                  <div class="lnr lnr-car homeicons"></div>
                   <?php
		$do=mysql_query("SELECT *FROM `vehicles` WHERE `Status`='0' ORDER BY `Number` ASC");
			$fo=mysql_num_rows($do);
				echo $fo;
				?>				
		       </div></a>
                <div class="text">
                 <a href="mainsto.php"> Total Vehicles </a>
                </div>
              </div>
              <!-- <div class="col-md-3">
                <div class="number">
                  <div class="lnr lnr-pushpin homeicons"></div>
                 1                </div>
                <div class="text">
                 <a href="#">Total Object</a>
                </div>
              </div> -->
            </div>
          </div>
        </div>        <!-- End Statistics -->
























<br><br><br>
        
        <div class="row">
          <div class="col-lg-12">
            <div class="widget-container stats-container" style="height:200px;">
              <div class="col-md-4"><div class="text" style="margin:-42px 0px 5px 0px;">
                 <a href="ment.php" style="font-size:32px;">Control Inspection</a>
                </div>                


				<?php					
					$stn="style='padding:0px;'";
				echo"<table class='table table-striped table-hover' style='font-size:10px;'><thead><tr>
                     <th colspan='2' width='1%' $stn>&nbsp;&nbsp;&nbsp;No </th><th $stn><div align='center'> VEHICLE </th>
					 <th $stn><div align='center'> STARTING </th><th $stn><div align='center'> ENDING </th>
					 <th $stn> PLACE </th>
							</tr> </thead><tbody>";

	$insp=mysqli_query($conn, "SELECT `vehicles`.`Plate`, `inspection`.* FROM `inspection` INNER JOIN `vehicles` ON `inspection`.`Vehicle`=`vehicles`.`Number` WHERE `inspection`.`Ending`>'$Date' ORDER BY `inspection`.`Ending` ASC LIMIT 8");	
			$finsp=mysqli_num_rows($insp);	
			
					$n=1;
			while($rip=mysqli_fetch_assoc($insp)){
				$veh=$rip['Plate'];
				$sta=$rip['Start'];
				$end=$rip['Ending'];
				$file=$rip['File'];
				$plac=$rip['Place'];

				echo"<style>
tr img { display:none; }
tr:hover img { display:block; }
	</style>";

				echo"<tr>";

				if($file)
					echo"<td style='width:1px;'> 						  
				<img src='inspection/$file' style='margin-left:5px; margin-top:-280px; position:absolute' width='310' height='240' /></td>";
				else
					echo"<td style='width:1px;'> </td>";
				
				echo"<td class='text-right' $stn>$n&nbsp;&nbsp;</td><td class='text-center' $stn> $veh </td><td class='text-center' $stn> $sta </td>
				<td class='text-center' $stn> $end </td><td class='text-center' $stn>$plac</td></tr>";
                     $n++;
			}
                        
						  echo"</tbody></table>";
						  ?>
               


              </div>
              <div class="col-md-4"><div class="text" style="margin:-42px 0px 5px 0px;">
                 <a href="ment.php" style="font-size:32px;">Transport Permit</a>
                </div>                
             <?php
 $inst=mysqli_query($conn, "SELECT `vehicles`.`Plate`, `permit`.* FROM `permit` INNER JOIN `vehicles` ON `permit`.`Vehicle`=`vehicles`.`Number` WHERE `permit`.`Ending`>'$Date' ORDER BY `permit`.`Ending` ASC LIMIT 8");	
			$finst=mysqli_num_rows($inst);

				echo"<table class='table table-striped table-hover' style='font-size:10px;'>
                     	<thead><tr>
                     <th colspan='2' width='1%' $stn>&nbsp;&nbsp;&nbsp;No </th><th $stn><div align='center'> VEHICLE </th>
					 <th $stn><div align='center'> STARTING </th><th $stn><div align='center'> ENDING </th>
					 <th class='text-center' $stn> TYPE </th>
							</tr> </thead>
                                        <tbody>";
					
	$n=1;               $stl="style='padding:0px; font-size:13px;'";
			while($ri=mysqli_fetch_assoc($inst)){
				$veh=$ri['Plate'];
				$sta=$ri['Start'];
				$end=$ri['Ending'];
				$file=$ri['File'];
				$type=$ri['Type'];

				echo"<style>
tr img { display:none; }
tr:hover img { display:block; }
	</style>";

				echo"<tr>";

				if($file)
			echo"<td style='width:1px; font-size:13px; padding:0px;'> 						  
			<img src='permit/$file' style='margin-left:5px; margin-top:-280px; position:absolute' width='310' height='240' /></td>";
				else
		    echo"<td style='width:1px; font-size:13px; padding:0px;'> </td>";
				
		echo"<td class='text-right' $stl>$n&nbsp;&nbsp;</td><td class='text-center' $stl> $veh </td><td class='text-center' $stl> $sta </td>
				<td class='text-center' $stl> $end </td><td class='text-left' $stl>$type</td></tr>";
                     $n++;
			}
                        
						  echo"</tbody></table>";
						  ?>
              </div>
              <div class="col-md-4"><div class="text" style="margin:-42px 0px 5px 0px;">
                 <a href="ment.php" style="font-size:32px;">Insurance</a>
                </div>                
             <?php
	$insu=mysqli_query($conn, "SELECT `vehicles`.`Plate`, `insurance`.* FROM `insurance` INNER JOIN `vehicles` ON `insurance`.`Vehicle`=`vehicles`.`Number` WHERE `insurance`.`Ending`>'$Date' ORDER BY `insurance`.`Ending` ASC LIMIT 8");	
			$finsu=mysqli_num_rows($insu);

			echo"<table class='table table-striped table-hover' style='font-size:10px;'>
							<thead><tr>
                     <th colspan='2' width='1%' $stn>&nbsp;&nbsp;&nbsp;No </th><th $stn><div align='center'> VEHICLE </th>
					 <th $stn><div align='center'> STARTING </th><th $stn><div align='center'> ENDING </th>
					 <th class='text-center' $stn> COMPANY </th>
							</tr> </thead>
                                        <tbody>";
					
					$n=1;
			while($ri=mysqli_fetch_assoc($insu)){
				$veh=$ri['Plate'];
				$sta=$ri['Start'];
				$end=$ri['Ending'];
				$file=$ri['File'];
				$comp=$ri['Company'];

				echo"<style>
tr img { display:none; }
tr:hover img { display:block; }
	</style>";

				echo"<tr>";

				if($file)
					echo"<td $stn style='width:1px;'> 						  
				<img src='insurance/$file' style='margin-left:5px; margin-top:-280px; position:absolute' width='310' height='240' /></td>";
				else
					echo"<td $stn style='width:1px;'> </td>";
				
				echo"<td class='text-right' class='text-center' $stn>$n&nbsp;&nbsp;</td><td class='text-center' $stn> $veh </td>
				<td class='text-center' $stn> $sta </td><td class='text-center' $stn> $end </td><td class='text-center' $stn>$comp</td></tr>";
                     $n++;
			}
                        
						  echo"</thead></table>";
						  ?>
              </div>

            </div>
          </div>
        </div>     
	<hr><br>



</div>

<?php
//include'upda.php';
include'footer.php';
?>