<?php
if (isset($_POST["addo"]))
{
   $dato=$_POST['dato'];
   $custo=$_POST['custo'];
   $ftype=$_POST['ftype'];
   $_SESSION['BR']=$custo;
	$n=$trig=1;    $T=$P=1;
//  $allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
 $user=$item=$price=$quantity=$tot='0';
 if($_FILES["file"]["type"]){
        $targetPath = 'files2/'.$_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);
        
        $Reader = new SpreadsheetReader($targetPath);
        
        $sheetCount = count($Reader->sheets());
        for($i=0;$i<$sheetCount;$i++)
        {
            
            $Reader->ChangeSheet($i);
            
            foreach ($Reader as $Row)
            {
          
                $r1 = "";
                if(isset($Row[1])) {
                    $r1 = mysql_real_escape_string($Row[1]);
					if($r1=='Item')
						$item=1;
					if($r1=='User')
						$user=1;
					if($r1=='Quantity')
						$quantity=1;
					if($r1=='Sale price')
						$price=1;
					if($r1=='Group')
						$cate=1;
                }
                $r2 = "";
                if(isset($Row[2])) {
                    $r2 = mysql_real_escape_string($Row[2]);
					if($r2=='Item')
						$item=2;
					if($r2=='User')
						$user=2;
					if($r2=='Quantity')
						$quantity=2;
					if($r2=='Sale price')
						$price=2;
					if($r2=='Group')
						$cate=2;
                }
                $r3 = "";
                if(isset($Row[3])) {
                    $r3 = mysql_real_escape_string($Row[3]);
					if($r3=='Item')
						$item=3;
					if($r3=='User')
						$user=3;
					if($r3=='Quantity')
						$quantity=3;
					if($r3=='Sale price')
						$price=3;
					if($r3=='Group')
						$cate=3;
                }
                $r4 = "";
                if(isset($Row[4])) {
                    $r4 = mysql_real_escape_string($Row[4]);
					if($r4=='Item')
						$item=4;
					if($r4=='User')
						$user=4;
					if($r4=='Quantity')
						$quantity=4;
					if($r4=='Sale price')
						$price=4;
					if($r4=='Group')
						$cate=4;
                }
                $r5 = "";
                if(isset($Row[5])) {
                    $r5 = mysql_real_escape_string($Row[5]);
					if($r5=='Item')
						$item=5;
					if($r5=='User')
						$user=5;
					if($r5=='Quantity')
						$quantity=5;
					if($r5=='Sale price')
						$price=5;
					if($r5=='Group')
						$cate=5;
                }
                $r6 = "";
                if(isset($Row[6])) {
                    $r6 = mysql_real_escape_string($Row[6]);
					if($r6=='Item')
						$item=6;
					if($r6=='User')
						$user=6;
					if($r6=='Quantity')
						$quantity=6;
					if($r6=='Sale price')
						$price=6;
					if($r6=='Group')
						$cate=6;
                }
                $r7 = "";
                if(isset($Row[7])) {
                    $r7 = mysql_real_escape_string($Row[7]);
					if($r7=='Item')
						$item=7;
					if($r7=='User')
						$user=7;
					if($r7=='Quantity')
						$quantity=7;
					if($r7=='Sale price')
						$price=7;
					if($r7=='Group')
						$cate=7;
                }
                $r8 = "";
                if(isset($Row[8])) {
                    $r8 = mysql_real_escape_string($Row[8]);
					if($r8=='Item')
						$item=8;
					if($r8=='User')
						$user=8;
					if($r8=='Quantity')
						$quantity=8;
					if($r8=='Sale price')
						$price=8;
					if($r8=='Group')
						$cate=8;
                }
                $r9 = "";
                if(isset($Row[9])) {
                    $r9 = mysql_real_escape_string($Row[9]);
					if($r9=='Item')
						$item=9;
					if($r9=='User')
						$user=9;
					if($r9=='Quantity')
						$quantity=9;
					if($r9=='Sale price')
						$price=9;
					if($r9=='Group')
						$cate=9;
                }
                $r10 = "";
                if(isset($Row[10])) {
                    $r10 = mysql_real_escape_string($Row[10]);
					if($r10=='Item')
						$item=10;
					if($r10=='User')
						$user=10;
					if($r10=='Quantity')
						$quantity=10;
					if($r10=='Sale price')
						$price=10;
					if($r10=='Group')
						$cate=10;
                }
                $r11 = "";
                if(isset($Row[11])) {
                    $r11 = mysql_real_escape_string($Row[11]);
					if($r11=='Item')
						$item=11;
					if($r11=='User')
						$user=11;
					if($r11=='Quantity')
						$quantity=11;
					if($r11=='Sale price')
						$price=11;
					if($r11=='Group')
						$cate=11;
                }
                $r12 = "";
                if(isset($Row[12])) {
                    $r12 = mysql_real_escape_string($Row[12]);
					if($r12=='Item')
						$item=12;
					if($r12=='User')
						$user=12;
					if($r12=='Quantity')
						$quantity=12;
					if($r12=='Sale price')
						$price=12;
					if($r12=='Group')
						$cate=12;
                }
                $r13 = "";
                if(isset($Row[13])) {
                    $r13 = mysql_real_escape_string($Row[13]);
					if($r13=='Item')
						$item=13;
					if($r13=='User')
						$user=13;
					if($r13=='Quantity')
						$quantity=13;
					if($r13=='Sale price')
						$price=13;
					if($r13=='Group')
						$cate=13;
                }
                $r14 = "";
                if(isset($Row[14])) {
                    $r14 = mysql_real_escape_string($Row[14]);
					if($r14=='Item')
						$item=14;
					if($r14=='User')
						$user=14;
					if($r14=='Quantity')
						$quantity=14;
					if($r14=='Sale price')
						$price=14;
					if($r14=='Group')
						$cate=14;
                }
                $r15 = "";
                if(isset($Row[15])) {
                    $r15 = mysql_real_escape_string($Row[15]);
					if($r15=='Item')
						$item=15;
					if($r15=='User')
						$user=15;
					if($r15=='Quantity')
						$quantity=15;
					if($r15=='Sale price')
						$price=15;
					if($r15=='Group')
						$cate=15;
                }
                $r16 = "";
                if(isset($Row[16])) {
                    $r16 = mysql_real_escape_string($Row[16]);
					if($r16=='Item')
						$item=16;
					if($r16=='User')
						$user=16;
					if($r16=='Quantity')
						$quantity=16;
					if($r16=='Sale price')
						$price=16;
					if($r16=='Group')
						$cate=16;
                }
                $r17 = "";
                if(isset($Row[17])) {
                    $r17 = mysql_real_escape_string($Row[17]);
					if($r17=='Item')
						$item=17;
					if($r17=='User')
						$user=17;
					if($r17=='Quantity')
						$quantity=17;
					if($r17=='Sale price')
						$price=17;
					if($r17=='Group')
						$cate=17;
                }
                $r18 = "";
                if(isset($Row[18])) {
                    $r18 = mysql_real_escape_string($Row[18]);
					if($r18=='Item')
						$item=18;
					if($r18=='User')
						$user=18;
					if($r18=='Quantity')
						$quantity=18;
					if($r18=='Sale price')
						$price=18;
					if($r18=='Group')
						$cate=18;
                }
                $r19 = "";
                if(isset($Row[19])) {
                    $r19 = mysql_real_escape_string($Row[19]);
					if($r19=='Item')
						$item=19;
					if($r19=='User')
						$user=19;
					if($r19=='Quantity')
						$quantity=19;
					if($r19=='Sale price')
						$price=19;
					if($r19=='Group')
						$cate=19;
                }
                $r20 = "";
                if(isset($Row[20])) {
                    $r20 = mysql_real_escape_string($Row[20]);
					if($r20=='Item')
						$item=20;
					if($r20=='User')
						$user=20;
					if($r20=='Quantity')
						$quantity=20;
					if($r20=='Sale price')
						$price=20;
					if($r20=='Group')
						$cate=20;
                }
                $r21 = "";
                if(isset($Row[21])) {
                    $r21 = mysql_real_escape_string($Row[21]);
					if($r21=='Item')
						$item=21;
					if($r21=='User')
						$user=21;
					if($r21=='Quantity')
						$quantity=21;
					if($r21=='Sale price')
						$price=21;
					if($r21=='Group')
						$cate=21;
                }
                $r22 = "";
                if(isset($Row[22])) {
                    $r22 = mysql_real_escape_string($Row[22]);
					if($r22=='Item')
						$item=22;
					if($r22=='User')
						$user=22;
					if($r22=='Quantity')
						$quantity=22;
					if($r22=='Sale price')
						$price=22;
					if($r22=='Group')
						$cate=22;
                }
                $r23 = "";
                if(isset($Row[23])) {
                    $r23 = mysql_real_escape_string($Row[23]);
					if($r23=='Item')
						$item=23;
					if($r23=='User')
						$user=23;
					if($r23=='Quantity')
						$quantity=23;
					if($r23=='Sale price')
						$price=23;
					if($r23=='Group')
						$cate=23;
                }
			
					$pr = "";
			  if(isset($Row[$price])) {
                  $pr = mysql_real_escape_string($Row[$price]);
			  }

			  $it = "";
			  if(isset($Row[$item])) {
                  $it = mysql_real_escape_string($Row[$item]);
			  }

			  $qt = "";
			  if(isset($Row[$quantity])) {
                  $qt = mysql_real_escape_string($Row[$quantity]);
			  }

			  $us = "";
			  if(isset($Row[$user])) {
                  $us = mysql_real_escape_string($Row[$user]);
			  }
			  
			  $ct = "";
			  if(isset($Row[$cate])) {
                  $ct = mysql_real_escape_string($Row[$cate]);
			  }

				$pri=str_replace(',', '', $pr); 
				$qty=str_replace(',', '', $qt);
				$ite=str_replace("'", "`", $it);
				$use=str_replace("'", "`", $us);
				$cte=str_replace("'", "`", $ct);
				$tot+=($qty*$pri);

                if (!empty($ite)) {
				//	if($n=='1')
			//$do=mysql_query("DELETE FROM `sales` WHERE `Date`='$dato' AND `Branche`='$custo'");

      $doix="INSERT INTO `sales` (`Date`, `Time`, `Cashier`, `Item`, `Price`, `Quantity`, `Branche`, `Owner`, `Voucher`, `Ftype`) VALUES ('$dato', '$Time', '$use', '$ite', '$pri', '$qty', '$custo', '$loge', '$vou', '$ftype')";					
				$n++;
							                
				$result=mysql_query($doix);
                    if (!empty($result)) {
                        $pto=10;       
						$T++;
                    } 
					else{
                        $pto=50;
                    }
					$code=0;
				$doin=mysql_query("SELECT *FROM `items` WHERE `Iname` = '$ite' AND `Store`='3' AND `Price`='$pri' ORDER BY `Number` DESC LIMIT 1");
			if(!$foin=mysql_num_rows($doin)){
		$doilu=mysql_query("SELECT *FROM `itype` WHERE `Location`='1' AND `Type` = '$cte' ORDER BY `Number` DESC");
			$roilu=mysql_fetch_assoc($doilu);
				$code=$roilu['Number'];
			
if($ite!='' AND $pri>0)
      $doiv=mysql_query("INSERT INTO `items` (`Date`, `User`, `Iname`, `Descri`, `Cost`, `Price`, `Store`, `Unit`, `Type`, `Ecode`, `Source`, `File`) VALUES ('$Date', '$loge', '$ite', '', '0', '$pri', '3', '4', '$code', '1', '', '')");	
			}
                }
				else
					$pto=50;
             }
        
         }
  }
  else
  { 
   $pto=40;
	}
	if($tot==0)
		$T=1;
}
?>