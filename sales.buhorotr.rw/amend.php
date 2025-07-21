<?php
 // ************************************* Update quantity when there is any sales amendment*****************************************
   $recex=mysql_query("SELECT *FROM `stouse` WHERE `Action`='SALES' AND `Upda`='1' AND `Status`>'0' AND `Voucher`='$vous' ORDER BY `Voucher` DESC LIMIT 100");
		if($fecex=mysql_num_rows($recex)){
				while($rex=mysql_fetch_assoc($recex)){
					$nuo=$rex['Number'];
					$ito=$rex['Item'];
					$qto=$rex['Quantity'];
					$stor=$rex['Store'];

				$dow=mysql_query("UPDATE `items` SET `$stor`=`$stor`+'$qto' WHERE `Number`='$ito' ORDER BY `Number` ASC LIMIT 1");
	$thent=mysql_query("UPDATE `stouse` SET `Upda`='0', `Closing`='0', `Status`='0', `Voucher`='0' WHERE `Number`='$nuo' ORDER BY `Number` ASC LIMIT 1");
				}
   }

   // ************************** Roll back payments when there is any sales amendment *************************************
	$doit=mysqli_query($cons, "SELECT *FROM `payment` WHERE `Status`>'0' AND `Action`='SALES' AND `Voucher`='$vous' AND `Upda`='1' ORDER BY `Number` ASC LIMIT 10");
				while($roit=mysqli_fetch_assoc($doit)){
					$nuo=$roit['Number'];
					if($roit['Pline']=='CREDIT'){
						$cre=$roit['Amount'];
						$cus=$roit['Client'];

			$crdi=mysqli_query($cons, "UPDATE `account` SET `Balance`=`Balance`-'$cre' WHERE `Number`='$cus' ORDER BY `Number` ASC LIMIT 1");
					}
					if($roit['Pline']=='BANK'){
						$pa=$roit['Amount'];
						$pda=$roit['Date'];
						$cheno=$roit['Cheno'];
						$cuso=$roit['Customer'];
						$bna=$roit['Bname'];
						$vous=$roit['Voucher'];
						$descri="Invoice No: $vous";

		$and=mysqli_query($cons, "DELETE FROM `deposit` WHERE `Item`='DEPOSIT' AND `Refer`='$cheno' AND `Amount`='$pa' AND `Customer`='$cuso' AND `Operation`='SALES' AND `Account`='$bna' AND `Descri`='$descri' AND `Voucher`='$vous'");
					}

		if($roit['Status']=='2')
			$upi=", `Status`='0', `Voucher`='0'";
		else
			$upi="";

			$thent=mysqli_query($cons, "UPDATE `payment` SET `Upda`='0' $upi WHERE `Number`='$nuo' ORDER BY `Number` ASC LIMIT 1");
				}
				?>