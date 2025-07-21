<?php
// ************************************* Open payment modal ******************************************
echo"<div class='modal fade' id='exampleModal$i' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true' style='top:80px;'>
  <div class='modal-dialog' role='document' style='width:680px;'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLabel'>PAYMENT REPORT 
&nbsp;&nbsp;&nbsp;&nbsp;<label class='pull-right'><b>$cust &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $payo</b></label></h5>

      </div>
      <div class='modal-body' style='height:auto;'>
	  <table class='table table-striped table-hover ' 
	  style='font-size:11px;'><thead><tr>
	  <th width='12%' class='text-center'> Date </th>
	  <th class='text-center'> Customer </th>
	  <th width='10%' class='text-center'> Mode </th>
	  <th class='text-center'> Reference </th>
	  <th class='text-center' width='1%'> Amount </th>
	  <th class='text-center' width='1%'> Rate </th>
	  <th colspan='2' class='text-center'> # </th>
	  </tr></thead></tbody>";
		$k=9000000000;				$sts="padding:1px; font-size:11px; background-color:transparent;";        $img=array();
		$kt=1;
		
		// ***************** Direct payment ************************
$spai=mysqli_query($conn, "SELECT *FROM `payment` WHERE `Status`='0' AND `Invoice`='$code' AND `Action`='SUPPLIER' ORDER BY `Number` ASC");
        $fl=mysqli_num_rows($spai);
				while($rpai=mysqli_fetch_assoc($spai)){
					$prs=number_format($rpai['Amount'], 2);
					$mod=$rpai['Pline'];
					$cur=$rpai['Currency'];
					$rat=number_format($rpai['Rate'], 2);
					$cho=$rpai['Cheno'];
					$bna=$rpai['Bname'];
					$dti=$rpai['Date'];
					$num=$rpai['Number'];
					$customer=$rpai['Customer'];
					$pri=$rpai['Amount'];
					$rti=$rpai['Rate'];
					$file=$rpai['Files'];
					$img[$kt]=$file;

					if($mod=='CASH')
						$refe="PAID BY CASH";
					elseif($mod=='CHEQUE')
						$refe="CHQ No: $cho / $bna";
					elseif($mod=='DEPOSIT'){
		$dois=mysqli_query($conn, "SELECT *FROM `baccount` WHERE `Number`='$bna' ORDER BY `Number` ASC");
			$rois=mysqli_fetch_assoc($dois);
				$bank=$rois['Bank'];
				$acc=$rois['Account'];
				$refe="$bank $acc";
			}
	
                // **************** For payment *****************
		echo"<tr style='background-color:transparent;' onMouseover=this.bgColor='#b5cfd2' onMouseout=this.bgColor=''>
		<form action='' method='post'>
		<td class='text-center' style='$sts'><input name='dte' class='form-control' type='text' onkeypress='return isNumberKey(event)' onChange=this.style.color='#ff3366' style='text-align:center; width:90px; height:20px; margin:0px 0px 0px 0px; padding-left:5px; padding-right:5px;' value='$dti' $dbl></td>
		<td style='$sts'> $customer </td>
		<td style='$sts'> $mod </td><td style='$sts'> $refe </td>
		<td style='text-align:right; $sts'><div title='Rate: $rat' data-toggle='tooltip' data-placement='top'><div class='input-group'><input name='prs' class='form-control' type='text' onkeyup='format(this);' onkeypress='return isNumberKey(event)' onChange=this.style.color='#ff3366' style='text-align:right; width:100px; height:20px; margin:0px 0px 0px 0px; padding-left:5px; padding-right:5px;' value='$prs'><span class='input-group-addon text-info' style='height:20px; width:20px; padding:2px;'>$cur</span></div></div></td>
		<td style='$sts'><input name='rat' class='form-control' type='text' onkeyup='format(this);' onkeypress='return isNumberKey(event)' onChange=this.style.color='#ff3366' style='text-align:right; width:80px; height:20px; margin:0px 0px 0px 5px;' value='$rat'></td>
		
		
		
		<td style='width:5px; $sts'>
	
		<div title='Edit' data-toggle='tooltip' data-placement='top'>
		<input type='hidden' name='dato' value='$dato'>
	  <input type='hidden' name='datos' value='$datos'>
	  <input type='hidden' name='custo' value='$custo'>
	  <input type='hidden' name='file' value='$file'>
	  <input type='hidden' name='code' value='$code'>
	  <input type='hidden' name='pri' value='$pri'>
	  <input type='hidden' name='rti' value='$rti'>
	  <input type='hidden' name='num' value='$num'>
	  <input type='hidden' name='p' value='$p'>
      <input type='hidden' name='sepa' value='$sepa'>
		
		<button type='submit' class='btn btn-xs btn-link text-primary hidden-print' style='height:16px; padding:0px; margin:0px; width:auto; margin-top:-5px;' name='pedit'>&nbsp;<i class='lnr lnr-pencil'></i>&nbsp;</button></div></td>
		
		<td style='width:5px; $sts'><div title='Delete' data-toggle='tooltip' data-placement='top'><button type='$dbutn' class='btn btn-xs btn-link text-danger hidden-print' style='height:16px; padding:0px; margin:0px; width:auto; margin-top:-5px;' name='pdele' $disa>&nbsp;<i class='lnr lnr-trash'></i>&nbsp;</button></div></td></form></tr>";
			$k++;                   $kt++;
				} 
				
				
				
				
				
		// ***************** Load from payout ***********************

$spai=mysqli_query($conn, "SELECT *FROM `expenses` WHERE `Status`='0' AND `Service`='$code' AND `External`='0' ORDER BY `Number` ASC");
				while($rpai=mysqli_fetch_assoc($spai)){
					$prs=number_format($rpai['Amount'], 2);
					$mod=$rpai['Payment'];
					$cur=$rpai['Currency'];
					$rat="1.00";
					$cho=$rpai['Cheno'];
					$bna=$rpai['Bname'];
					$dti=$rpai['Date'];
					$num=$rpai['Number'];
					$customer=$rpai['Payto'];
					$pri=$rpai['Amount'];
					$rti=$rat;

					if($mod=='CASH')
						$refe="BY PAYOUT";
					elseif($mod=='CHEQUE')
						$refe="BY PAYOUT";
					elseif($mod=='DEPOSIT')
				        $refe="BY PAYOUT";
			
                // **************** For payment *****************
		echo"<tr style='background-color:transparent;'>
		<form action='' method='post'>
		<td class='text-center' style='$sts'><input name='dte' class='form-control' type='text' onkeypress='return isNumberKey(event)' onChange=this.style.color='#ff3366' style='text-align:center; width:90px; height:20px; margin:0px 0px 0px 0px; padding-left:5px; padding-right:5px;' value='$dti' $dbl></td>
		<td style='$sts'> $customer </td>
		<td style='$sts'> $mod </td><td style='$sts'> $refe </td>
		<td style='text-align:right; $sts'><div title='Rate: $rat' data-toggle='tooltip' data-placement='top'><div class='input-group'><input name='prs' disabled class='form-control' type='text' onkeyup='format(this);' onkeypress='return isNumberKey(event)' onChange=this.style.color='#ff3366' style='text-align:right; width:100px; height:20px; margin:0px 0px 0px 0px; padding-left:5px; padding-right:5px;' value='$prs'><span class='input-group-addon text-info' style='height:20px; width:20px; padding:2px;'>RWF</span></div></div></td>
		<td style='$sts'><input name='rat' disabled class='form-control' type='text' onkeyup='format(this);' onkeypress='return isNumberKey(event)' onChange=this.style.color='#ff3366' style='text-align:right; width:80px; height:20px; margin:0px 0px 0px 5px;' value='$rat'></td>
		
		
		
		<td style='width:5px; $sts'>
	
		<div title='Edit' data-toggle='tooltip' data-placement='top'>
		<input type='hidden' name='dato' value='$dato'>
	  <input type='hidden' name='num' value='$num'>
	  <input type='hidden' name='datos' value='$datos'>
	  <input type='hidden' name='custo' value='$custo'>
	  <input type='hidden' name='p' value='$p'>
	  <input type='hidden' name='pri' value='$pri'>
	  <input type='hidden' name='rti' value='$rti'>
	  <input type='hidden' name='code' value='$code'>
      <input type='hidden' name='sepa' value='$sepa'>
		
		<button type='button' class='btn btn-xs btn-link text-primary hidden-print' style='height:16px; padding:0px; margin:0px; width:auto; margin-top:-5px;' disabled>&nbsp;<i class='lnr lnr-pencil'></i>&nbsp;</button></div></td>
		
		<td style='width:5px; $sts'><div title='Delete' data-toggle='tooltip' data-placement='top'><button type='$dbutn' class='btn btn-xs btn-link text-danger hidden-print' style='height:16px; padding:0px; margin:0px; width:auto; margin-top:-5px;' name='sdele' $disa>&nbsp;<i class='lnr lnr-trash'></i>&nbsp;</button></div></td></form></tr>";
			$k++;
				} 
				      
      echo"</tbody></table><center>";
      
      for($ln=1; $ln<=$fl; $ln++){
          $ims=$img[$ln];
          
          echo"<style>
          .hover_img a { position:relative; }
.hover_img a span { position:absolute; display:none; z-index:99; font-size:14px; }
.hover_img a:hover span { display:block; }
    </style>";
                if($ims)
    echo"<label class='hover_img'>
     <a href='files/$ims' target='_blank'>$ims<span><img src='files/$ims' alt='image' height='500' width='500' /></span></a></label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
      }
      
      
      echo"</div><div class='modal-header text-right' 
	  style='margin-top:-10px; height:40px; padding-top:10px; border:0px solid blue;'>
  <button type='button' class='btn btn-xs btn-warning' data-dismiss='modal'>&nbsp;&nbsp;&nbsp;CLOSE&nbsp;&nbsp;&nbsp;</button>
      </div>
    </div>
  </div>
</div>";
	// ****************************************** End of modal ****************************************
	?>