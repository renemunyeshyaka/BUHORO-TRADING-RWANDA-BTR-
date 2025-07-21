<?php
$doix=mysql_query("SELECT *FROM `goats` WHERE `Tag`='$tag' ORDER BY `Number` ASC");
		if($foix=mysql_num_rows($doix)){
			$roix=mysql_fetch_assoc($doix);
			$tag=$roix['Tag'];
				$tag=str_replace("`", "'", $tag);
			$kind=$roix['Type'];
			$descri=$roix['Descri'];
				$descri=str_replace("`", "'", $descri);
			$sex=$roix['Sex'];
			$stat=$roix['Status'];
			$done=$roix['Done'];
			$father=$roix['Father'];
			$mother=$roix['Mother'];
			$birth=$roix['Birthday'];
			$photo=$roix['File'];
			$dest=$roix['Destination'];
			$ddate=$roix['Ddate'];
			$sales=$roix['Sales'];
			$dati=$roix['Date'];
			if($ddate!='0000-00-00')
				$Date=$ddate;
			$convert = (strtotime("$Date") - strtotime("$birth")) / (60 * 60 * 24);
			$btn='';
			}
			else{
				$tag=0;
				$kind=$sex=$descri=$birth=$stat=$father=$mother='';
$btn='disabled';
			}
	if(!$photo)
		$photo="imgs/-text.png";
	else
		$photo="photos/$photo";
		?>

		<form method="post" class="form-horizontal" action="" enctype="multipart/form-data">
			 <div class="form-group"><hr></div>

  <div class="col-md-12">  
<div class="col-md-3" style='height:300px;'>
            <div class="widget-container fluid-height" style='height:280px;'>
              <div class="heading">
                <h4>Profile Picture</h4>
              </div>
              <div class="widget-content padded " style="text-align:center;">
                            	<img src="<?php echo $photo ?>" width="150" height="120"><br><br>
								Gender: <?php echo $sex ?> <br> <hr style='margin:0px;padding:0px;'> <br>
								<div align='center'><span class="badge"><font size='4'><?php echo $tag ?></font></span></div>
                            </div>
            </div>
          </div>

          <div class="col-md-5" style='height:300px;'>
            <div class="widget-container fluid-height" style='height:280px;'>
              <div class="heading">
               <h4>Specifications</h4>
              </div>
             <div class="widget-content padded">
  <strong>Kind (Type):</strong>
   <p><?php
   $doi=mysql_query("SELECT *FROM `genres` WHERE `Number`='$kind' ORDER BY `Name` ASC");
			while($roi=mysql_fetch_assoc($doi)){
				$code=$roi['Number'];
				$fna=$roi['Name'];
			}
			echo"&nbsp;$fna&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<div style='position:relative;font-size:32px; top:-80px; right:40px; float:right; border:1px solid #f9f9f9; border-radius:50px; width:60px; text-align:center; color:powderblue; background-color:#f9f9f9; height:48px; padding:0px;'>A</div>"; ?></p>
    <strong>Birthday:</strong>
     <p><?php echo"&nbsp;$birth"; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	 <?php 
	 include'year.php';
	 echo '<font size=1 color=#0000cc>'.$years.'year'.$y.' &nbsp; '.$month.'month'.$m.' &nbsp; '.$days.'day'.$d.'</font>'; ?></p>
     <strong>Father:</strong>
    <p><?php echo"&nbsp;<a href='transfer.php?goat=$father'>$father</a>"; ?></p>
  <strong>Mother:</strong>                  
 <p><?php echo"&nbsp;<a href='transsfer.php?goat=$mother'>$mother</a>"; ?></p>             
 </div>
  </div>
   </div>

          <div class="col-md-4" style='height:300px;'>
            <div class="widget-container fluid-height" style='height:280px;'>
              <div class="heading">
                <h4>Classifications</h4>
              </div>
              <div class="widget-content padded">
              <strong>Cycle (Level):</strong>
                 <p>&nbsp;<?php 
				  $doi=mysql_query("SELECT *FROM `cycles` WHERE `Number`='$stat' ORDER BY `Name` ASC");
			while($roi=mysql_fetch_assoc($doi)){
				$code=$roi['Number'];
				$fna=$roi['Name'];
			}
			echo"$fna&nbsp;&nbsp;&nbsp;&nbsp;<font size='1' color=#0000cc>$dati</font>" ?></p>
                  <strong>Health Status:</strong>
                 <p>&nbsp;<?php echo"GOOD" ?>
                 </p>				 
                  <strong>Production:</strong>
                 <p>&nbsp;<?php echo $depart ?>
                 </p>				 				 
                  <strong>Life Status:</strong>
                 <p>&nbsp;<?php 
				if($dest=='LOSS' OR $dest=='SOLD')
					echo"<font color='#ff0000'> $dest </font>";
			else
				echo $dest;
			?>
                 </p>
              </div>
            </div>
          </div>
		  </div>



<div class="col-md-12">
<div class="col-md-1"></div>
<div class="col-md-10">


<div class="widget-container fluid-height clearfix" style='width:99%; float:center;'>
 <div class="heading"><h5><u><b>Description</b></u>&nbsp;:&nbsp;<font color="#000000"><?php echo $descri ?></font></h5><br><br>
 <strong></strong>
 </div>

</div>