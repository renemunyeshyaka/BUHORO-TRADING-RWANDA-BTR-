<?php
$settings=$cancel=$payro=$payrepo=$cpo=$cpi=$avh=$asr=$eccr=$aos=0;
$empopa=$alogi=$acance=$arat=$apc=$cpe=$cnt=$cfr=$afr=$ctr=$etr=0;
$cpd=$cbt=$ucs=$aiv=$alv=$ofp=$pcance=$sss=$rsi=$avt=$cons=$spay=0;
$phys=$acr=$ecr=0;

$previ=mysqli_query($conn, "SELECT *FROM `previleges` ORDER BY `NUMBER` ASC");
	$frevi=mysqli_num_rows($previ);
		while($revi=mysqli_fetch_assoc($previ)){
			$pri=$revi['PNAME'];
			$vla=$revi["$access"];
		if($pri=='Access to system settings' AND $vla=='1')
			$settings=1;
		if($pri=='Cancel a given logistics record' AND $vla=='1')
			$cancel=1;
		if($pri=='Access to payroll page' AND $vla=='1')
			$payro=1;
		if($pri=='Access payroll reports' AND $vla=='1')
			$payrepo=1;
		if($pri=='Access to employees page' AND $vla=='1')
			$empopa=1;
		if($pri=='Access to logistics page' AND $vla=='1')
			$alogi=1;
		if($pri=='Cancel a given employees record' AND $vla=='1')
			$acance=1;
		if($pri=='Cancel a given payroll record' AND $vla=='1')
			$pcance=1;
		if($pri=='Access to change exchange rate' AND $vla=='1')
			$arat=1;
		if($pri=='Add a payment to cashbox' AND $vla=='1')
			$apc=1;
		if($pri=='Make a payout/expense from cashbox' AND $vla=='1')
			$cpe=1;
		if($pri=='Create a new vehicle trip' AND $vla=='1')
			$cnt=1;
		if($pri=='Create purchase orders' AND $vla=='1')
			$cpo=1;
		if($pri=='Create proforma invoices' AND $vla=='1')
			$cpi=1;
		if($pri=='Cancel a given finance record' AND $vla=='1')
			$cfr=1;
		if($pri=='Access vehicles report' AND $vla=='1')
			$avr=1;
		if($pri=='Access stores report' AND $vla=='1')
			$asr=1;
		if($pri=='Access finance reports' AND $vla=='1')
			$afr=1;
		if($pri=='Edit a given trip record' AND $vla=='1')
			$etr=1;
		if($pri=='Cancel a given trip record' AND $vla=='1')
			$ctr=1;
		if($pri=='Edit/Cancel a given cashbox report' AND $vla=='1')
			$eccr=1;
		if($pri=='Access to operate in store' AND $vla=='1')
			$aos=1;
		if($pri=='Upload cash sales to cashbox' AND $vla=='1')
			$ucs=1;
		if($pri=='Access international vehicles' AND $vla=='1')
			$aiv=1;
		if($pri=='Access local vehicles' AND $vla=='1')
			$alv=1;
		if($pri=='Create overdue fuel per trip' AND $vla=='1')
			$ofp=1;
		if($pri=='Access sales and spareparts store' AND $vla=='1')
			$sss=1;
		if($pri=='Access to receive store item' AND $vla=='1')
			$rsi=1;
		if($pri=='Access vehicle trip reports' AND $vla=='1')
			$avt=1;
		}

$_SESSION['Settings']=$settings;
$_SESSION['Acance']=$acance;
$_SESSION['Pcance']=$pcance;
$_SESSION['Cancel']=$cancel;
$_SESSION['Payro']=$payro;
$_SESSION['Payrepo']=$payrepo;
$_SESSION['Empopa']=$empopa;
$_SESSION['Alogi']=$alogi;
$_SESSION['Arat']=$arat;
$_SESSION['Apc']=$apc;
$_SESSION['Cpe']=$cpe;
$_SESSION['Cnt']=$cnt;
$_SESSION['Cpo']=$cpo;
$_SESSION['Cpi']=$cpi;
$_SESSION['Cfr']=$cfr;
$_SESSION['Avr']=$avr;
$_SESSION['Asr']=$asr;
$_SESSION['Afr']=$afr;
$_SESSION['Ctr']=$ctr;
$_SESSION['Etr']=$etr;
$_SESSION['Eccr']=$eccr;
$_SESSION['Aos']=$aos;
$_SESSION['Cpd']=$cpd;
$_SESSION['Cbt']=$cbt;
$_SESSION['Ucs']=$ucs;
$_SESSION['Aiv']=$aiv;
$_SESSION['Alv']=$alv;
$_SESSION['Ofp']=$ofp;
$_SESSION['Sss']=$sss;
$_SESSION['Rsi']=$rsi;
$_SESSION['Avt']=$avt;
?>
