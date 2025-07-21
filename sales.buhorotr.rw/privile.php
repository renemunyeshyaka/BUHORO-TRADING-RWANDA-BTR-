<?php
$accusto=$acrepo=$abra=$apro=$upsa=$icon=$cancel=$edit=$settings=$aco=0;
$xsto=$xpay=$xbra=$xpro=$xcon=$phyc=$moder=$xput=$spay=$xacco=$adat=0;
$ari=$asd=0;
$po=mysql_query("SELECT `Postname` FROM `position` WHERE `Postid`='$currentp' ORDER BY `Postname` ASC");
			  $ro=mysql_fetch_assoc($po);
					$position=$ro['Postname'];
$previ=mysql_query("SELECT *FROM `previleges` ORDER BY `NUMBER` ASC");
	$frevi=mysql_num_rows($previ);
		while($revi=mysql_fetch_assoc($previ)){
			$pri=$revi['PNAME'];
			$vla=$revi["$position"];
		if($pri=='Access to main store' AND $vla=='1')
			$accusto=1;
	
		if($pri=='Access to system reports' AND $vla=='1')
			$acrepo=1;

		if($pri=='Access to sales/payment operation' AND $vla=='1')
			$abra=1;	
		
		if($pri=='Access to bank operations' AND $vla=='1')
			$apro=1;			
		
		if($pri=='Cancel a geven record' AND $vla=='1')
			$cancel=1;				
		
		if($pri=='Edit a given record' AND $vla=='1')
			$edit=1;				
		
		if($pri=='Access to system settings' AND $vla=='1')
			$settings=1;			
		
		if($pri=='Access to store report' AND $vla=='1')
			$xsto=1;			
		
		if($pri=='Access to payment report' AND $vla=='1')
			$xpay=1;			
		
		if($pri=='Access to sales report' AND $vla=='1')
			$xbra=1;			
		
		if($pri=='Access to operations report' AND $vla=='1')
			$xpro=1;			
		
		if($pri=='Access to control report' AND $vla=='1')
			$xcon=1;			
		
		if($pri=='Access to make sales order' AND $vla=='1')
			$moder=1;

if($pri=='Access to physical count' AND $vla=='1')
			$phyc=1;

if($pri=='Access to make a payout' AND $vla=='1')
			$xput=1;

if($pri=='Access to make a pay on account' AND $vla=='1')
			$xacco=1;

if($pri=='Access to supplier payment' AND $vla=='1')
			$spay=1;

if($pri=='Change operation date' AND $vla=='1')
			$adat=1;

if($pri=='Access to change cost price' AND $vla=='1')
			$aco=1;

if($pri=='Access to receive items' AND $vla=='1')
			$ari=1;

if($pri=='Access to make stock delivery' AND $vla=='1')
			$asd=1;
		}	
		
$_SESSION['Accusto']=$accusto;
$_SESSION['Acrepo']=$acrepo;
$_SESSION['Abra']=$abra;
$_SESSION['Apro']=$apro;
$_SESSION['Settings']=$settings;
$_SESSION['Cancel']=$cancel;
$_SESSION['Edit']=$edit;
$_SESSION['Upsa']=$upsa;
$_SESSION['Icon']=$icon;
$_SESSION['Adat']=$adat;

$_SESSION['Xsto']=$xsto;
$_SESSION['Xpay']=$xpay;
$_SESSION['Xbra']=$xbra;
$_SESSION['Xpro']=$xpro;
$_SESSION['Xcon']=$xcon;
$_SESSION['Phyc']=$phyc;
$_SESSION['Moder']=$moder;
$_SESSION['Xput']=$xput;
$_SESSION['Spay']=$spay;

$_SESSION['Xacco']=$xacco;
$_SESSION['Aco']=$aco;
$_SESSION['Ari']=$ari;
$_SESSION['Asd']=$asd;
?>
