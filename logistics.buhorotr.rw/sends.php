<?php
$to=strlen($Te);
$count = substr("$Te", 0, 2);

if($to==10 AND $count=='07'){
$sms="Turabibutsa ko $per ya $plate izarangira $endi. $pt";

require_once('nusoap.php');
//$wsdl="http://simba.kaneza.com/index.php?wsdl";
$wsdl="https://gateway.esicia.com/index.php?wsdl";
$client=new nusoap_client($wsdl, 'wsdl','', '', '', '');
$param=array(
'account'=>"$suser",
'pin'=>"$spass",
'sender'=>"BUHORO TR",
'message'=>"$sms",
'msgid'=>"$Time",
'phone'=>"25$Te"); 
$client->call('ksend',$param, '', '', false, true);

$client->request;
$client->response;

$check = $client->response;
$file = strstr($check, '<?xml'); 

$p = xml_parser_create();
xml_parse_into_struct($p,$file,$results,$index);
xml_parser_free($p);

$do=mysqli_query($conn, "INSERT INTO `sms` (`Number`, `Date`, `Time`, `Message`, `Descri`, `Phone`) VALUES (NULL, '$Date', '$Time', '$sms', '$per', '$Te')");

$then=mysqli_query($conn, "UPDATE `notify` SET `Sent` = '1' WHERE `Number` = '$nuo'");
		}
?>