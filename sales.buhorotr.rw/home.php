<?php
if(basename($_SERVER['PHP_SELF']) == 'home.php') {
  $co=" class='current'";
} else {
  $co="";
} 
include'header.php';
$brc="";

if(isset($_GET['brc']))
		{
			$brc=$_GET['brc'];
		}
?>
<script src="style/chart.min.js"></script>  
        <!-- Statistics -->
                <div class="row">
          <div class="col-lg-12">
            <br>

<?php
	 if($_SESSION['Accusto'])
				$mlink='mainsto.php';
			else
				$mlink='';
        echo"<div class='col-md-4' style='margin:0px 0px 10px 0px;'>
		<div class='widget-container stats-container' style='border-radius:5px; height:60px;'>
		<a href='$mlink' style='onmouseover=this.color:#ffffff;'>
                <div class='number'><br>
                  <div class='lnr lnr-store homeicons'></div>
				   &nbsp;&nbsp;&nbsp;";
				   if($asto)
			echo"<span class='badge' style='float:center; font-size:12px; margin-right:10px; height:18px; background-color:#ff66cc; width:20px; position:absolute;'> $asto </span>";			
			
			echo"</div></a>
                <div class='text'>
                 <a href='$mlink' style='color:#66cc66'> MAIN STORE : <font color='blue'> 1 </font>
                </div>
              </div></a></div>";
			  
			  
			  
		 if($_SESSION['Apro'])
				$plink='deposit.php';
			else
				$plink='';	  
			  
			  echo"<div class='col-md-4' style='margin:0px 0px 10px 0px;'>
		<div class='widget-container stats-container' style='border-radius:5px; height:60px;'>
		<a href='$plink' style='onmouseover=this.color:#ffffff;'>
                <div class='number'><br>
                  <div class='lnr lnr-layers homeicons'></div>
				   &nbsp;&nbsp;&nbsp;";
				  if($pfequo)
							echo"<span class='badge' style='float:center; font-size:12px; margin-right:10px; height:18px; background-color:#ffcc66; width:20px; position:absolute;'> 1 </span>";
			
			echo"</div></a>
                <div class='text'>
                 <a href='$plink' style='color:#66cc66'> OPERATIONS : <font color='blue'> 1 </font>
                </div>
              </div></a></div>";
			  
			  
		$do=mysql_query("SELECT *FROM `branches` WHERE `Status`!='10' $conde ORDER BY `Number` DESC LIMIT 100");
			$fo=mysql_num_rows($do);	  
		 if($_SESSION['Xbra'])
				$blink='branches.php';
			else
				$blink='';	  
			  
			  echo"<div class='col-md-4' style='margin:0px 0px 10px 0px;'>
		<div class='widget-container stats-container' style='border-radius:5px; height:60px;'>
		<a href='$blink' style='onmouseover=this.color:#ffffff;'>
                <div class='number'><br>
                  <div class='lnr lnr-cart homeicons'></div>
				   &nbsp;&nbsp;&nbsp;";
				  if($fcode)
							echo"<span class='badge' style='float:center; font-size:12px; margin-right:10px; height:18px; background-color:#cc3366; width:20px; position:absolute;'> $fcode </span>";
			
			echo"</div></a>
                <div class='text'>
                 <a href='$blink' style='color:#66cc66'> BRANCHES : <font color='blue'> $fo&nbsp;-&nbsp;$fo </font>
                </div>
              </div></a></div>";

?>

            

            </div>
        </div>        <!-- End Statistics -->

		<div class="pull-right" style="padding-right:40px; margin-top:10px; font-size:18px;">
		
		<?php
			if($brc=='0' OR $brc==''){
				$conde="";
				$clr="blue";
		}
			else{
				$conde="AND `stouse`.`Branche`='$brc'";
				$clr="#9999ff";
			}

// ************************************************** Second division ***************************************************
		$doi=mysql_query("SELECT `Number`, `Name` FROM `branches` WHERE `Status`='0' ORDER BY `Number` ASC");
			while($roi=mysql_fetch_assoc($doi)){
				$fna=$roi['Name'];
				$num=$roi['Number'];
					if($num==$brc)
						$clrs="blue";
					else
						$clrs="#9999ff;";
				
					echo"<a href='home.php?brc=$num' style='color:$clrs'> $fna </a> &nbsp;|&nbsp; ";
			}
			echo"<a href='home.php?brc=0' style='color:$clr'> ALL BRANCHES </a>";
			?>

				</div><hr width="97%" style="margin-top:2px;">
        
        <div class="row">
          <div class="col-lg-12 hidden-print">             
		
				<div class="col-md-4" style='color:#6633ff; border:0px solid #ffffff; background-color:transparent;'>
			<label style='padding-left:40px; font-size:16px; text-shadow: 2px 2px 2px #000000;'>Most Sold Items</label>
		<span class="widget-container stats-container active" style="border-radius:10px; height:232px; padding-top:0px; border:0px solid #ff66cc;">
		<table class="table table-striped table-hover" style="border:0px;">
           <?php
		   $date = strtotime("-63 days", strtotime("$Date"));
				$date = date ("Y-m-d", $date);

		   $dori=mysql_query("SELECT `items`.`Iname`, SUM(`stouse`.`Quantity`) AS 'Total' FROM `stouse` INNER JOIN `items` ON `items`.`Number`=`stouse`.`Item` WHERE `stouse`.`Date` >= '$date' AND `stouse`.`Action`='SALES' AND `stouse`.`Status`='0' $conde GROUP BY `stouse`.`Item` ORDER BY `Total` DESC LIMIT 10");
				$subq=$suba=0;
			while($rori=mysql_fetch_assoc($dori)){
				$qtu=$rori['Total'];					$qtuo=number_format($qtu, 2);
				$item=$rori['Item'];
				$iname=$rori['Iname'];	
				
							echo"<tr><td style='color:#000000; padding:1px 20px 1px 20px;' class='text-left'> $iname  </td>
							<td width='30%' style='color:#000000; padding:1px 20px 1px 20px;' class='text-right'>
							<span class='badge badge-warning' style='width:60px; float:right;'>$qtuo</span></td></tr>";
			}

		   ?>
               
					</table>

		</span></div>

		<div class="col-md-4" style="color:#6633ff; border:0px solid #ffffff; background-color:transparent;">
			<label style="padding-left:140px; font-size:16px; text-shadow: 2px 2px 4px #000000;">Most Valuable Item</label>
		<span class="widget-container stats-container shadow-none" style="border-radius:10px; height:232px; padding-top:5px; border:0px; background-color:transparent;">
			
			
          <?php
					$n=1;			$jsonArray = array();				$data = array();
		    $dori=mysql_query("SELECT `items`.`Iname`, SUM((`stouse`.`Quantity`*`stouse`.`Price`)-(`stouse`.`Quantity`*`stouse`.`Cost`)) AS 'Total' FROM `stouse` INNER JOIN `items` ON `items`.`Number`=`stouse`.`Item` WHERE `stouse`.`Date` >= '$date' AND `stouse`.`Action`='SALES' AND `stouse`.`Status`='0' $conde GROUP BY `stouse`.`Item` ORDER BY `Total` DESC LIMIT 10");
				$subq=$suba=0;
			while($rori=mysql_fetch_assoc($dori)){
				$qtu=$rori['Total'];					$qtuo=number_format($qtu, 2);
				$iname=$rori['Iname'];	
				if($n==1)
					$tot=$qtu;						$per=number_format($qtu/$tot*100, 2);					$pero="$per%&nbsp;$iname";
					
				echo"<div class='progress' style='background-color:transparent; padding:0px; margin:0px 0px 3px 0px; height:20px;'>
  <button type='button' class='btn btn-warning btn-sx pull-left arrow-steps clearfix' role='progressbar' style='width:$per%; margin-top:1px; margin-bottom:1px; text-align:left; font-size:14px; padding:0px 0px 0px 10px; color:#009900; border-radius:10px; height:19px;'> $pero </button>";
     
        $jsonArrayItem = array();
        $jsonArrayItem['label'] = $rori['Iname'];
        $jsonArrayItem['value'] = $rori['Total'];
        //append the above created object into the main array.
        array_push($jsonArray, $jsonArrayItem);

		
	$data[] = $rori['Iname'];


      
		echo"</div>";
								$n++;
			}
			?>
					

		</span></div>



		<div class="col-md-4" style='color:#6633ff; border:0px solid #ffffff; background-color:transparent;'>
			<label style='padding-left:220px; font-size:16px; text-shadow: 2px 2px 2px #000000;'>Customer Performance</label>
		<span class="widget-container stats-container" style="border-radius:10px; height:232px; padding-top:0px; border:0px solid #0033ff;">
       <table class='table table-striped table-hover'>
			
          <?php        			
               
 $doris=mysql_query("SELECT DISTINCT `Destin`, COUNT(`Destin`) AS 'Total' FROM `stouse` WHERE `Date` >= '$date' AND `Action`='SALES' AND `Status`='0' AND `Upda`='1' $conde GROUP BY `Destin` ORDER BY `Total` DESC LIMIT 10");
				$subq=$suba=0;
			while($roris=mysql_fetch_assoc($doris)){
				$qtu=$roris['Total'];					$qtuo=number_format($qtu);
							$iname=$roris['Destin'];	
				
				
							echo"<tr><td style='color:#000000; padding:1px 20px 1px 20px;' class='text-left'> $iname  </td>
							<td width='30%' style='color:#000000; padding:1px 20px 1px 20px;' class='text-right'><span class='badge badge-danger ml-2' style='width:50px; float:right;'>$qtuo</span></td></tr>";
			}

		   ?>
               
					</table>

		</span></div>



              </div>
			 </div>
           
          
        </div>  </div>

<?php
include'footer.php';
?>
