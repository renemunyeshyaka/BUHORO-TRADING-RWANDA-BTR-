<?php
if($mail){
$to_email = "$mail";
$subject = "Vehicle Notification";
   
   $body = "BUHORO TR;
   ";
   $body .= "Dear Sir/Madam, 
Turabibutsa ko $per ya $plate izarangira $endi. $pt

   Thank you!
  BUHORO TR
Tel: $pho1 / $pho2
Driver: $driv";

    $from="info@buhorotr.rw";
    $headers = "From:$from \r\n";
	$headers .= "Reply-To:$from \r\n";
 
	 mail($to_email, $subject, $body, $headers);
 
   //  mail($bcc, $subject, $body, $headers);
		
$then=mysqli_query($conn, "UPDATE `notify` SET `Sent` = '1' WHERE `Number` = '$nuo'");
					}