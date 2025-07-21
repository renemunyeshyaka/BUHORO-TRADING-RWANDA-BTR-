 <?php
        $dato=$_SESSION['Dato'];
		$datos=$_SESSION['Datos'];
		$mt=$_SESSION['Mt'];
		$yr=$_SESSION['Yr'];
		$sd=$_SESSION['Sd'];
		$ed=$_SESSION['Ed'];
		$po=$_SESSION['Po'];
		$depart=$_SESSION['Depart'];
		$p=$_SESSION['P'];
		
    include'connection.php';
		        
					if($p==0){		
	$do=mysqli_query($conn, "SELECT *FROM (SELECT *FROM `payrolls` GROUP BY `Month`, `Year` ORDER BY `Date` DESC LIMIT 12) SUB ORDER BY `Date` ASC");
					echo"<div class='divFooter'><center><u><b>PAYROLL REPORT $mpri</b></u></center></div>";
			}
					elseif($p==1){		
	$do=mysqli_query($conn, "SELECT *FROM (SELECT *FROM `payrolls` WHERE `Date` BETWEEN '$dato' AND '$datos' GROUP BY `Month`, `Year` ORDER BY `Date` DESC LIMIT 12) SUB ORDER BY `Date` ASC");
					echo"<div class='divFooter'><center><u><b>PAYROLL REPORT $mpri</b></u></center></div>";
					}
					elseif($p==2){
	$do=mysqli_query($conn, "SELECT *FROM `payrolls` WHERE `Month`='$mt' AND `Year`='$yr' AND `Depart`='1' AND `Salary`>='40000' $conde ORDER BY `Currentp` ASC");
					echo"<div class='divFooter' style='text-transform: uppercase;'><center><u><b>PAYROLL REPORT FOR $mt $yr</b></u></center></div>";
					}
			$fo=mysqli_num_rows($do);
					?>
		 <div class="row">
            <div class="col-lg-12">
             <span> &nbsp;&nbsp; Total Records Found : <b><?php echo" $fo " ?></b></span>
			 <span class="pull-right"><a href="#" onclick="return window.print()" class="hidden-print" title='Click to print' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-printer"></i></a></span>
			 
			  <span class="pull-right hidden-print"><a href='#' onclick=window.location.href='data.php' title='Export to Excel' data-toggle='tooltip' data-placement='top'><i class="lnr lnr-line-spacing"></i></a> &nbsp;&nbsp; </span>
            <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">

			<?php
			if($p==2){
				?>
 <table class="table table-striped table-hover" style="font-size:8px;">
                       
                                      <thead>
                    <tr role="row">
                      <th style="padding:1px;font-size:10px;"> No </th> 					  
                       <th style="padding:1px;font-size:10px;" align='center'> Full Name </th>			  
                        <th style="padding:1px;font-size:10px;"> Joining&nbsp;Date </th>
                        <th style="padding:1px;font-size:10px;"> Position </th>
                        <th style="padding:1px;font-size:10px;"> Address </th>
                       <th style="padding:1px;font-size:10px;"> Salary </th>
                       <th style="padding:1px;font-size:10px;"> Last Comitment </th>	
                       <th style="padding:1px;font-size:10px;" class='text-center'> Counted Salary </th> 	
                       <th style="padding:1px;font-size:10px;" class='text-center'> Total Salary </th>  	
                       <th style="padding:1px;font-size:10px;" class='text-center'> Advance </th> 
                       <th style="padding:1px;font-size:10px;" class="text-center"> Allow. </th> 	 							  
                       <th style="padding:1px;font-size:10px;" class="text-center"> Deduct </th> 	 							  
                       <th style="padding:1px;font-size:10px;" class="text-center"> Total Comitment </th>
                       <th style="padding:1px;font-size:10px;" class="text-center"> Payment </th> 	
                       <th style="padding:1px;font-size:10px;" class="text-center"> Take Home </th>
                       <th style="padding:0px;font-size:10px;" width="6%"> Remaining comitment </th>
                       <th style="padding:1px;font-size:10px;"> Signature </th>
                     </tr>
                    </thead>
                                        <tbody>
<?php
$n=1;

	while($ro=mysqli_fetch_assoc($do)){
$numb=$ro['Number'];
$mt=$ro['Month'];
$user=$ro['User'];
$yr=$ro['Year'];
$dati=$ro['Date'];
$st=$ro['Status'];
$sal=$ro['Salary'];
$empo=$ro['Employee'];
$currentp=$ro['Currentp'];
$allow=$ro['Allowance'];
$duct=$ro['Deduction'];
$adva=$ro['Advance'];
$bala=$ro['Balance'];
$pay=$ro['Payment'];
$cou=$ro['Counted'];
$tav=$ro['Tadvance'];
$clo=$ro['Closing'];
$depo=$ro['Depart'];
$paid=$ro['Paid'];
$my="$mt $yr";
$tco=$bala+$duct+$tav-$allow;

$doe=mysqli_query($conn, "SELECT *FROM `employees` WHERE `Eid`='$empo' ORDER BY `Fname` ASC");
		$foe=mysqli_num_rows($doe);
		while($roe=mysqli_fetch_assoc($doe)){
			$fna=$roe['Fname'];
			$lna=$roe['Lname'];
			$sta=$roe['Starting'];
			$adde=$roe['Address'];
		}

$dei=mysqli_query($conn, "SELECT *FROM `position` WHERE `Postid`='$currentp' ORDER BY `Postname` ASC");
			 if($fei=mysqli_num_rows($dei)){
				 $rei=mysqli_fetch_assoc($dei);
					$post=$rei['Postname'];
			 }
			 else
				 $post="N/A";

		/*
			 if($sal>100000)
				 $tpr=((100000-30000)*(20/100))+(($sal-100000)*(30/100));
			 else
				 $tpr=($sal-30000)*(20/100);
		*/
	
           $salo=number_format($sal);
		   $advao=number_format($adva);

$allowo=number_format($allow);
$ducto=number_format($duct);
$balao=number_format($bala);
$payo=number_format($pay+$adva+$paid);
$tcoo=number_format($tco);
$couo=number_format($cou);
$tavo=number_format($tav);
$tsal=$sal;

if($cou)
$tsal=$cou;

$net=$tsal+$allow-$adva-$pay;
//$clo=$bala+$duct-$pay;
$neto=number_format($net);

			  $tot=$empor;
		   $toto=number_format($tot);
		   $cloo=number_format($clo);
		   $tsalo=number_format($tsal);					
		   $stn="style='padding:1px;font-size:10px;'";
		
				print("<tr><td $stn class='text-right'>&nbsp;$n&nbsp;</td>
		<td $stn>$fna $lna</td><td class='text-center' $stn> $sta </td>
				<td $stn> $post </td><td $stn> $adde </td>
					<td class='text-right' $stn> $salo </td>
					<td $stn class='text-right'>$balao</td>
						
							<td $stn class='text-right'> $couo </td>
							<td $stn class='text-right'> $tsalo </td>
							<td $stn class='text-right'> $tavo </td>
						<td $stn class='text-right'> $allowo </td>
						<td $stn class='text-right'> $ducto </td>
						<td $stn class='text-right'> $tcoo </td>
						<td $stn class='text-right'> $payo </td>
						<td $stn class='text-right'> $neto </td>
			            <td $stn class='text-right'> $cloo </td>
						<td $stn class='text-right'> </td></tr>");
	$n++;
	$isal+=$sal;
	$iadv+=$tav;

	$inet+=$net;
	$iall+=$allow;
	$ided+=$duct;
	$ibal+=$bala;
	$ipay+=($pay+$adva);
	$iclo+=$clo;
	$itco+=$tco;
    $icou+=$cou;
		   $itot+=$tot;
		   $itsa+=$tsal;
	}

			$isalo=number_format($isal);
		   $iadvo=number_format($iadv);
		   $iallo=number_format($iall);
		   $idedo=number_format($ided);
		   $ineto=number_format($inet);
		   $itsa=number_format($itsa);
		   
		   $itoto=number_format($itot);
		   $ibalo=number_format($ibal);
		   $ipayo=number_format($ipay);
		   $iclo=number_format($iclo);
		   $itco=number_format($itco);
		   $icou=number_format($icou);
		   
		   $stn="style='padding-right:1px; font-size:10px;'";

	print("</tbody><tr><th $stn> </th> 
	<th colspan='4' style='align:center; 
	padding-left:1px 1px 1px 80px; font-size:10px;'> TOTAL AMOUNT </th>
	<th class='text-right' $stn> $isalo </th>
	<th class='text-right' $stn> $ibalo </th>
	<th class='text-right' $stn> $icou </th>
	<th class='text-right' $stn> $itsa </th>
	<th class='text-right' $stn> $iadvo </th>
	<th class='text-right' $stn> $iallo </th>
	<th class='text-right' $stn> $idedo </th>
	<th class='text-right' $stn> $itco </th>
	<th class='text-right' $stn> $ipayo </th>
	<th class='text-right' $stn> $ineto </th>
	<th class='text-right' $stn> $iclo </th>
	<th class='text-right' $stn> </th></tr>");
	?>              
                       
                  </table>

			<?php

			  }
			  else{
				  ?>
                
                                 <table class="table table-striped table-hover">
                       
                                      <thead>
                    <tr role="row">
                      <th> No </th> 					  
                       <th align='center'> Due&nbsp;Date </th> 							  
                       <th> Done&nbsp;By </th> 					  
                       <th> Type </th><th> Month </th>
                       <th> Year </th>
                       <th> Employees </th> 
                       <th class="text-center"> Amount </th>
                       <th class="text-center"> Allowance </th>
                       <th class="text-center"> Advance </th>
                       <th class="text-center"> Deduction </th>
                       <th class="text-center"> Payment </th>
                       <th class="hidden-xs hidden-print" style="text-align:center;">#</th>
                     </tr>
                    </thead>
                                        <tbody>
<?php
$n=1;
	while($ro=mysqli_fetch_assoc($do)){
$numb=$ro['Number'];
$mt=$ro['Month'];
$user=$ro['User'];
$yr=$ro['Year'];
$dati=$ro['Date'];
$st=$ro['Status'];
$lv=$ro['Level'];
$std=$ro['Starting'];
$end=$ro['Ending'];
$stn="style='padding:1px;'";

	$lvo="PAYROLL";

	
		$acti="<td class='text-right hidden-xs hidden-print' style='width:20px; padding:1px;'>
   <button type='submit' name='open_id' class='btn btn-xs btn-info hidden-print text-center' style='height:20px; padding:0px; margin-top:2px; margin-botton:2px; width:25px; text-align:center; padding-right:5px;' title='Open' data-toggle='tooltip' data-placement='top'>
						  &nbsp;&nbsp;<i class='lnr lnr-download'></i></button></td>";
		
		$amo=$adva=$ded=$allo=$pay=0;
$dot=mysqli_query($conn, "SELECT *FROM `payrolls` WHERE `Month`='$mt' AND `Year`='$yr'");
		if($fot=mysqli_num_rows($dot)){
			while($rot=mysqli_fetch_assoc($dot)){
					$amo+=$rot['Salary'];
					$adva+=$rot['Tadvance'];
					$dedu+=$rot['Deduction'];
					$allo+=$rot['Allowance'];
					$pay+=($rot['Payment']+$rot['Advance']);
			}
		}	

 $amoo=number_format($amo);			$alloo=number_format($allo);			$advao=number_format($adva);				$deduo=number_format($dedu);
                $payo=number_format($pay);
                
		print("<tr><form action='payerepo.php' method='post'>
                        <td $stn class='text-right'>$n 
						<input type='hidden' value='$mt' name='mt'>
						<input type='hidden' value='$yr' name='yr'>
						<input type='hidden' value='$std' name='std'>
						<input type='hidden' value='$p' name='po'>
						<input type='hidden' value='$dato' name='dato'>
						<input type='hidden' value='$datos' name='datos'>
						<input type='hidden' value='$end' name='end'>&nbsp;</td>
                        <td $stn class='text-center'>$dati</td>
                        <td $stn>$user</td><td $stn> $lvo </td> 
						<td $stn> $mt </td><td $stn> $yr </td>
                        <td $stn class='text-center'> $fot </td>
                        <td align='right' style='padding:1px; padding-right:10px;'> $amoo </td>
                        <td align='right' style='padding:1px; padding-right:10px;'> $alloo </td>
                        <td align='right' style='padding:1px; padding-right:10px;'> $advao </td>
                        <td align='right' style='padding:1px; padding-right:10px;'> $deduo </td>
                        <td align='right' style='padding:1px; padding-right:10px;'> $payo </td>
                            $acti </form></tr>");
	$n++;          $allo=$deduo=$advao=$amoo=$payo=0;
	$allo=$amo=$adva=$pay=$dedu=0;
	}
	?>
              
                    </tbody>   
                  </table>
			<?php
			  }
			  ?>