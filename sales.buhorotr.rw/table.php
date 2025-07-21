<?php
$dor=mysql_query("SELECT *FROM `tables` GROUP BY `Name` ORDER BY `Name` ASC");
				if($for=mysql_num_rows($dor)){
							$n=1;
					while($rop=mysql_fetch_assoc($dor)){
							$num=$rop['Number'];
							$sup=$rop['Name'];
							$sta=$rop["S$brc"];
							$tdat=$rop['Date'];
							$od=$vout=0;

							if($sta=='1' AND $tdat==$Date){
			$dox=mysql_query("SELECT *FROM `sales` WHERE `Tnumber`='$sup' AND `Status`='0' AND `Sales`='0' AND `Voucher`!='0' AND `Date`='$Date' ORDER BY `Number` ASC");
				if($fox=mysql_num_rows($dox)){
						$to=0;
					while($rox=mysql_fetch_assoc($dox)){
						$prx=$rox['Price'];
						$qtx=$rox['Quantity'];
						$cas=$rox['Owner'];
						$vous=$rox['Voucher'];
						$to+=($prx*$qtx);
						if($vout!=$vous)
							$od++;

						$vout=$vous;
					}
					$curro=$curre1;
					$to=number_format($to);
					$btn='submit';
					$dso='';
					$brd="border:1px solid #ff66cc";
				}
		$stao="<font size='1' style='margin:10px 0px 0px 10px; color:#ff66cc; float:left;'><b> OPEN &nbsp;&nbsp;&nbsp; ($od) </b></font></font>";
							}
							else{
		$stao="<font size='1' style='margin:10px 0px 0px 10px; color:#66cc99; float:left;'><b> VACCANT </b></font></font>";
					$btn='button';
					$dso='disabled';
					$curro='';
					$cas='&nbsp;';
					$to=$brd='';
		$do=mysql_query("UPDATE `tables` SET `Status`='0', `S$brc`='0' WHERE `Number`='$num' ORDER BY `Number` LIMIT 1");
							}

		echo"<div class='col-lg-3'><form action='orders.php' method='post' class='form-horizontal'>
		<button type='$btn' name='prir' class='btn btn-xs btn-block btn-secondary' style='margin-bottom:20px; font-size:14px; $brd' title='$sup' data-toggle='tooltip' data-placement='top' $dso> $sup <font style='float:left; padding-left:10px; color:#669999;'> $cas </font> 
				<span class='badge' style='float:right; background-color:#99ccff;margin-right:5px; top:0px;'> $n </span><br>
				<input type='hidden' name='vous' value='$vous'><input type='hidden' name='tabl' value='$sup'> $stao 
				
		<span class='badge' style='float:right; font-size:12px; margin:10px 10px -10px 0px; background-color:grey;'> $curro $to </span>
				</button></form></div>";
						$n++;
					}
				}
?>