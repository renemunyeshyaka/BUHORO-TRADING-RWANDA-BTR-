<?php
// **************************************** Add items on repaired car ******************************************************		
	echo"<div class='modal fade' id='mode$n' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'><div class='modal-header text-left'>
        <h5 class='modal-title' id='exampleModalLabel'> ADD ITEM 
		<label style='float:right;'> $veh </label></h5>		

      </div>
      <div class='modal-body' style='height:auto;'>
	  <table class='table table-striped'>     
                                      <thead>
                    <tr role='row'><th class='hidden-xs'>No</th>
					<th class='text-center'> Item Name </th><th class='text-center'> Qty </th>
					<th class='text-center'> Price </th><th colspan='2' class='text-right'> Total&nbsp;&nbsp;&nbsp;&nbsp;Store </th>
					<th colspan='2' style='width:20px;'><div align='center'> # </th></th>
						 <tbody>";
				$x=1;
			$stl="padding:0px; background-color:transparent;";
			$clr="";				$to=0;
	  $dob=mysqli_query($conn, "SELECT `items`.`Item`, `stouse`.`Number`, `stouse`.`Date`, `stouse`.`Price`, `stouse`.`Quantity`, `stouse`.`Status`, `stouse`.`Store`, `stouse`.`Item` AS 'Ites' FROM `stouse` INNER JOIN `items` ON `stouse`.`Item` = `items`.`Number` WHERE `stouse`.`Status`!='10' AND `stouse`.`Repair`='$num' ORDER BY `stouse`.`Number` ASC");
		$fob=mysqli_num_rows($dob);
		while($rob=mysqli_fetch_assoc($dob)){
			$numu=$rob['Number'];
			$dato=$rob['Date'];
			$pri=$rob['Price'];
			$qty=$rob['Quantity'];
			$name=$rob['Item'];
			$status=$rob['Status'];
			$stor=$rob['Store'];
			$ites=$rob['Ites'];
			if($stor=='1')
				$chk="checked";
			else
				$chk='';
			$all=$pri*$qty;

			$prio=number_format($pri);					$qto=number_format($qty);				$allo=number_format($all);

			print("<tr><form method='post' action=''><td class='hidden-xs' style='$stl $clr'><div align='center'>$x</td>
						
						<td style='$stl $clr'><div align='left'>
						<input name='name' class='form-control' type='text' style='text-align:left; width:200px; height:24px; margin:0px 0px 0px 0px; padding:0px 10px 0px 10px; background-color:transparent;' value='$name' onChange=this.style.color='#ff3366' readonly></td>

						<td style='$stl $clr'><div align='left'>
						<input name='qty' class='form-control' type='text' style='text-align:right; width:50px; height:24px; margin:0px 0px 0px 0px; padding:0px 10px 0px 10px; background-color:transparent;' onChange=this.style.color='#ff3366' value='$qto' readonly></td>
						
						<td style='$stl $clr'><div align='left'>
						<input name='pri' class='form-control' type='text' style='text-align:right; width:70px; height:24px; margin:0px 0px 0px 0px; padding:0px 10px 0px 10px; background-color:transparent;' value='$prio' onChange=this.style.color='#ff3366' readonly></td>

						<td style='$stl $clr'><div align='left'>
						<input name='all' class='form-control' type='text' style='text-align:right; width:70px; height:24px; margin:0px 0px 0px 0px; padding:0px 10px 0px 10px; background-color:transparent;' value='$allo' onChange=this.style.color='#ff3366' readonly></td>
						  
						  <td style='padding:0px; background-color:transparent; width:10px;'><div align='center'>
						<input class='form-control' name='prive$n' type='checkbox' value='1' $chk style='margin:1px; width:30px; height:18px;'></td>

						<td style='padding:0px; background-color:transparent; width:10px;' class='text-center'>
						<button type='button' class='btn btn-xs btn-warning hidden-print' style='height:22px; margin:0px 0px 0px 0px; padding:0px;' title='Edit' data-toggle='tooltip' data-placement='top' disabled>&nbsp;&nbsp;<i class='lnr lnr-pencil'></i>&nbsp;&nbsp;</button></td>
						
						<td style='padding:0px; background-color:transparent; width:10px;' class='text-center'>
						<input type='hidden' name='numu' value='$numu'><input type='hidden' name='stor' value='$stor'>
						<input type='hidden' name='qts' value='$qty'><input type='hidden' name='ites' value='$ites'>
						<button type='submit' class='btn btn-xs btn-danger hidden-print' style='height:22px; margin:0px 0px 0px 0px; padding:0px;' data-placement='top' name='deloge' title='Delete' data-toggle='tooltip' data-placement='top'>
						  &nbsp;&nbsp;<i class='lnr lnr-trash'></i>&nbsp;</button></td></form></tr>");

						$x++;				$to+=$all;
						}
			$too = number_format($to);

			$i=1;
			print("<form method='post' action=''>");

			while($i<5){
		print("<tr><td class='hidden-xs' style='$stl $clr'>
				<div align='center'>$x</td><td style='$stl $clr'><div align='left'>
				<input name='item$i' class='form-control' type='text' style='text-align:left; width:200px; height:24px; margin:0px 0px 0px 0px; padding:0px 10px 0px 10px; background-color:transparent;' onChange=this.style.color='#ff3366' list='ites'><datalist style='border:1px solid blue;' id='ites'>");
		
$do=mysql_query("SELECT `Item`, `Price` FROM `items` WHERE `Status`!='10' ORDER BY `Item` ASC");
		while($ro=mysql_fetch_assoc($do)){
			$iname=$ro['Item'];
			$prio=number_format($ro['Price']);
			echo"<option value='$iname @ $prio'></option>";
		}
		
					echo("</datalist></td><td style='$stl $clr'><div align='left'>
						<input name='qty$i' class='form-control' type='text' style='text-align:right; width:50px; height:24px; margin:0px 0px 0px 0px; padding:0px 10px 0px 10px; background-color:transparent;' onChange=this.style.color='#ff3366' onkeyup='format(this);' onkeypress='return isNumberKey(event)'></td>

						<td style='$stl $clr'><div align='left'>
						<input name='pri$i' class='form-control' type='text' style='text-align:right; width:70px; height:24px; margin:0px 0px 0px 0px; padding:0px 10px 0px 10px; background-color:transparent;' onChange=this.style.color='#ff3366' onkeyup='format(this);' onkeypress='return isNumberKey(event)'></td><td style='$stl $clr'> &nbsp; </td>

						<td style='padding:0px; background-color:transparent; width:10px;'><div align='left'>
						<input class='form-control' name='store$i' type='checkbox' value='1' style='margin:1px; width:30px; height:18px;'></td>

			<td style='$stl $clr' colspan='2' class='text-center'><input type='hidden' name='num' value='$num'>
			<input type='hidden' name='veh' value='$vei'><input type='hidden' name='i' value='$i'>
			<button type='submit' class='btn btn-xs btn-success hidden-print' name='eddoge' style='width:65px; height:22px; margin:0px 9px 0px 8px; padding:0px;' title='Create' data-toggle='tooltip' data-placement='top'>&nbsp;&nbsp;<i class='lnr lnr-plus-circle'></i>&nbsp;ADD&nbsp;</button></td></tr>");
							$i++;						$x++;
			}



			echo"</form></table></div><div class='modal-footer' style='margin-top:-10px; height:50px; padding-top:5px; border:0px solid blue;'>";
			if($to)
				echo"<b> Total Amount : $too </b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";

        echo"<button type='button' class='btn btn-sm btn-danger' data-dismiss='modal' style='height:20px; padding-top:0px; width:80px;'>CLOSE</button>
      </div>
    </div>
  </div>";
?>