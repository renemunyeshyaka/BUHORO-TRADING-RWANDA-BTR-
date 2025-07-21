<br><br><br>
<div class="row hidden-print" style='position: fixed; width:100%; margin:0px; left: 0px; bottom: 0px; background-color: #0020C2; color: white; text-align: center; height:30px; padding-top:6px; clear: both; z-index: 10;'>
&nbsp;<font size='1'>@ <?php echo $cna ?></font>&nbsp;

</div>

<script>
 // popovers initialization - on hover
    $('[data-toggle="popover-hover"]').popover({
      html: true,
      trigger: 'hover',
      placement: 'bottom',
      content: function () { return '<img src="' + $(this).data('img') + '" />'; }
    });

    // popovers initialization - on click
    $('[data-toggle="popover-click"]').popover({
      html: true,
      trigger: 'click',
      placement: 'bottom',
      content: function () { return '<img src="' + $(this).data('img') + '" />'; }
    });

	// popovers Initialization
        $(function () {
        $('[data-toggle="popover"]').popover()
        })

function cUpper(cObj) 
{
cObj.value=cObj.value.toUpperCase();
} 

 $(function() 
{
 $( "#search" ).autocomplete({
  source: 'search.php'
 });
});

 $(function() 
{
 $( "#searche" ).autocomplete({
  source: 'searche.php'
 });
});

 $(function() 
{
 $( "#searchs" ).autocomplete({
  source: 'searchs.php'
 });
});

 function toggle() {
	var ele = document.getElementById("toggleText");
	var text = document.getElementById("displayText");
	if(ele.style.display == "block") {
    		ele.style.display = "none";
		text.innerHTML = "<U>Description</U>";
  	}
	else {
		ele.style.display = "block";
		text.innerHTML = "<U>Description</U>";
	}
} 

  function validate(formCheck) 
{ 
if (formCheck.employee.value=="")
{ 
alert("Please, select an employee !"); 
formCheck.employee.focus();
return false;
}
return true;
}

$(document).ready(function(){
	$(".pdf").click(function(){
		$("#table1").hide();
		setTimeout(function(){$("#table1").show()},1000);
		});
});
</script>

<script> 
 //For profile pic size
  $('#profile_pic').bind('change', function() {
  $('#profilesize').val(this.files[0].size);
  var a = this.files[0].size;
  var b= 2097152;
if(a>b)
  alert("File size must be less than 2M");
});
  // For qualification files
          $('#qual_1').bind('change', function() {

        	  $('#qualification_1').val(this.files[0].size);
        	  var a = this.files[0].size;
        	  var b= 2097152;
        	if(a>b)
        	  alert("File size must be less than 2M");

        	});
          $('#qual_2').bind('change', function() {

        	  $('#qualification_2').val(this.files[0].size);
        	  var a = this.files[0].size;
        	  var b= 2097152;
        	if(a>b)
        	  alert("File size must be less than 2M");

        	});
          $('#qual_3').bind('change', function() {

        	  $('#qualification_3').val(this.files[0].size);
        	  var a = this.files[0].size;
        	  var b= 2097152;
        	if(a>b)
        	  alert("File size must be less than 2M");

        	});
          $('#qual_4').bind('change', function() {

        	  $('#qualification_4').val(this.files[0].size);
        	  var a = this.files[0].size;
        	  var b= 2097152;
        	if(a>b)
        	  alert("File size must be less than 2M");

        	});
          $('#qual_5').bind('change', function() {

        	  $('#qualification_5').val(this.files[0].size);
        	  var a = this.files[0].size;
        	  var b= 2097152;
        	if(a>b)
        	  alert("File size must be less than 2M");

        	});

        	//for addressproof and idproof
          $('#add_proof').bind('change', function() {

        	  $('#add_proof_size').val(this.files[0].size);
        	  var a = this.files[0].size;
        	  var b= 2097152;
        	if(a>b)
        	  alert("File size must be less than 2M");

        	});
          $('#id_proof').bind('change', function() {

        	  $('#id_proof_size').val(this.files[0].size);
        	  var a = this.files[0].size;
        	  var b= 2097152;
        	if(a>b)
        	  alert("File size must be less than 2M");

        	});
          </script>
   
  <script>
$(document).ready(function(){
	$(".pdf").click(function(){
		$("#table1").hide();
		setTimeout(function(){$("#table1").show()},1000);
		});
});
</script>
  <!-- used for show calendar -->
   <script src="style/bootstrap.js" type="text/javascript"></script>
  <script src="style/jquery_002.js" type="text/javascript"></script>
 <!-- ****************************** -->
  
   <script src="style/jquery.js" type="text/javascript"></script>
  <script src="style/datatable-editable.js" type="text/javascript"></script>
  <!-- used for calendar -->
 <script src="style/jquery_003.js" type="text/javascript"></script>
 <!-- ******************************* -->
  
  <script src="style/bootstrap-fileupload.js" type="text/javascript"></script>
   <script src="style/bootstrap-datepicker.js" type="text/javascript"></script>
   <script src="style/bootstrap-timepicker.js" type="text/javascript"></script>
   <script src="style/jquery_004.js" type="text/javascript"></script>
   
    
     <script>
	 // validate input to be numbers only
	 function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 42 || charCode > 57))
            return false;

         return true;
      }
	  // if password are not matching
function validatepass(formCheck) 
{ 
if (formCheck.password.value != formCheck.confirm_password.value)
{  
formCheck.confirm_password.focus();
return false;
}
return true;
}

	  // check password confirmation
	  $('#confirm_password').on('keyup', function () {
    if ($(this).val() == $('#password').val()) {
        $('#message').html('Matching').css('color', 'green');
    } else $('#message').html('Not matching').css('color', 'red');
});

     /*   for mobile navigation */
     $('.navbar-toggle').click(function() {
         return $('body, html').toggleClass("nav-open");
       });

     /*
      * =============================================================================
      *   DataTables
      * =============================================================================
      */
     $("#dataTable1").dataTable({
       "sPaginationType": "full_numbers",
       aoColumnDefs: [
         {
           bSortable: false,
           aTargets: [0, -1]
         }
       ]
     });
     $('.table').each(function() {
       return $(".table #checkAll").click(function() {
         if ($(".table #checkAll").is(":checked")) {
           return $(".table input[type=checkbox]").each(function() {
             return $(this).prop("checked", true);
           });
         } else {
           return $(".table input[type=checkbox]").each(function() {
             return $(this).prop("checked", false);
           });
         }
       });
     });


     /*
      * =============================================================================
      *   Bootstrap Popover
      * =============================================================================
      */
     
     $(".popover-trigger").popover(); 
     /*
      * =============================================================================
      *   Datepicker
      * =============================================================================
      */
   
    var date = new Date();
    $("#from").datepicker();
    
    $("#to").datepicker();
    $("#dob").datepicker();     
   
    
     if($("#watermark_yes").is(":checked")){
     	  $("#watermark").show();
       }
     else{
     $("#watermark").hide();
     }
     $("#watermark_yes").click(function(){
 	    $("#watermark").show();
 	});
     $("#watermark_no").click(function(){
   	    $("#watermark").hide();
   	});
     </script>
  
  <script>
  $(document).ready(function (){
	  $(".fancybox").fancybox({
	      maxWidth: 700,
	      height: 'auto',
	      fitToView: false,
	      autoSize: true,
	      padding: 15,
	      nextEffect: 'fade',
	      prevEffect: 'fade',
	      helpers: {
	        title: {
	          type: "outside"
	        }
	      }
	    });
     var a = $("#db_country").val();     
     $("#country").val(a);
	  });
  </script>
 <script>
  $(document).ready(function (){
     var a = $("#db_timezone").val();     
     $("#timezone").val(a);
	  });
  $('#timepicker1').timepicker();
  $('#timepicker2').timepicker();
  $('#timepicker3').timepicker();
  $('#timepicker4').timepicker();
  $('#timepicker5').timepicker();
  $('#timepicker6').timepicker();
  $('#timepicker7').timepicker();
  $('#timepicker8').timepicker();
  $('#timepicker9').timepicker();
  $('#timepicker10').timepicker();
  $('#timepicker11').timepicker();
  $('#timepicker12').timepicker();
  $('#timepicker13').timepicker();
  $('#timepicker14').timepicker();

   /*$("#timepicker1").timepicker({
	      minuteStep: 1,
	      showSeconds: true,
	      showMeridian: false
	    });
   $("#timepicker2").timepicker({
	      minuteStep: 1,
	      showSeconds: true,
	      showMeridian: false
	    });*/
 
  </script>
  
   <script>
  $(document).ready(function (){
     var a = $("#date_format").val();     
     $("#dateformat").val(a);
	  });
  </script>
     
   <script>
   $("#enable_check").click(function(){
	   if($("#enable_check").is(":checked")){
           $("#time1").hide();
           $("#time2").hide();
		   }
		   else {
			   $("#time1").show();
			   $("#time2").show();
			   }
	   });
   </script>
   <script>
   $("#emp_view_check").click(function(){
	  
   if($("#emp_view_check").is(":checked")){
	   
	  	  $("#emp_edit_check").show();
		  	$("#emp_del_check").show();
			$("#emp_add_check").show();
	    }
	  else{
	  $("#emp_edit_check").hide();
	  $("#emp_del_check").hide();
		$("#emp_add_check").hide();
	  }
	  });

   $("#dep_view_check").click(function(){
		  
	   if($("#dep_view_check").is(":checked")){
		   
		  	  $("#dep_edit_check").show();
			  	$("#dep_del_check").show();
			  	 $("#dep_add_check").show();
		    }
		  else{
		  $("#dep_edit_check").hide();
		  $("#dep_del_check").hide();
		  $("#dep_add_check").hide();
		  }
		  });
   $("#holiday_view_check").click(function(){
		  
	   if($("#holiday_view_check").is(":checked")){
		   
		  	  $("#holiday_edit_check").show();
			  	$("#holiday_del_check").show();
				$("#holiday_add_check").show();
		    }
		  else{
		  $("#holiday_edit_check").hide();
		  $("#holiday_del_check").hide();
			$("#holiday_add_check").hide();
		  }
		  });
   $("#task_view_check").click(function(){
		  
	   if($("#task_view_check").is(":checked")){
		  	  $("#task_edit_check").show();
			  	$("#task_del_check").show();
				$("#task_add_check").show();
		    }
		  else{
		  $("#task_edit_check").hide();
		  $("#task_del_check").hide();
			$("#task_add_check").hide();
		  }
		  });
   $("#payslip_view_check").click(function(){
		  
	   if($("#payslip_view_check").is(":checked")){
			  	$("#payslip_del_check").show();
			  	$("#payslip_add_check").show();
		    }
		  else{
		  
		  $("#payslip_del_check").hide();
		  $("#payslip_add_check").hide();
		  }
		  });
   $("#template_view_check").click(function(){
		  
	   if($("#template_view_check").is(":checked")){
		   
		   $("#template_edit_check").show();
			  	$("#template_del_check").show();
			  	$("#template_add_check").show();
		    }
		  else{
		  $("#template_edit_check").hide();
		  $("#template_del_check").hide();
		  $("#template_add_check").hide();
		  }
		  });
   </script>
   
  <script>
  
  
  if($("#fixed_based").is(":checked")){
	 
	  	  $("#annual_fixed_leaves").show();
	    }
	  else{
		  $("#annual_fixed_leaves").hide();
	  }
  $("#fixed_based").click(function(){
	  $("#service_based").removeAttr("checked");
	    $("#annual_fixed_leaves").show();
	    $("#service_based_leaves").hide();
	    $("#service_based_heading").hide();
	    $("#annual").show();
	});
  $("#service_based").click(function(){
	  $("#fixed_based").removeAttr("checked");
	    $("#service_based_leaves").show();
	    $("#annual_fixed_leaves").show();
	    $("#service_based_heading").show();
	    $("#annual").hide();
	    
	});
  if($("#service_based").is(":checked")){
	  
  	  $("#service_based_leaves").show();
  	  $("#annual_fixed_leaves").show();
    	$("#service_based_heading").show();
    	$("#annual").hide();
    }
  else{
	  $("#service_based_leaves").hide();
  }

   </script>
  
    <script>
   $("#sun_check").click(function(){
	   if($("#sun_check").is(":checked")){
		   $("#timepicker13").attr("disabled",true);
		   $("#timepicker14").attr("disabled",true);
         }
		   else {
			   $("#timepicker13").attr("disabled",false);
			   $("#timepicker14").attr("disabled",false);
			   }
	   });
   $("#mon_check").click(function(){
	   if($("#mon_check").is(":checked")){
		   $("#timepicker1").attr("disabled",true);
		   $("#timepicker2").attr("disabled",true);
         }
		   else {
			   $("#timepicker1").attr("disabled",false);
			   $("#timepicker2").attr("disabled",false);
			   }
	   });
   $("#tues_check").click(function(){
	   if($("#tues_check").is(":checked")){
		   $("#timepicker3").attr("disabled",true);
		   $("#timepicker4").attr("disabled",true);
         }
		   else {
			   $("#timepicker3").attr("disabled",false);
			   $("#timepicker4").attr("disabled",false);
			   }
	   });
   $("#wed_check").click(function(){
	   if($("#wed_check").is(":checked")){
		   $("#timepicker5").attr("disabled",true);
		   $("#timepicker6").attr("disabled",true);
         }
		   else {
			   $("#timepicker5").attr("disabled",false);
			   $("#timepicker6").attr("disabled",false);
			   }
	   });
   $("#thurs_check").click(function(){
	   if($("#thurs_check").is(":checked")){
		   $("#timepicker7").attr("disabled",true);
		   $("#timepicker8").attr("disabled",true);
         }
		   else {
			   $("#timepicker7").attr("disabled",false);
			   $("#timepicker8").attr("disabled",false);
			   }
	   });
   $("#fri_check").click(function(){
	   if($("#fri_check").is(":checked")){
		   $("#timepicker9").attr("disabled",true);
		   $("#timepicker10").attr("disabled",true);
         }
		   else {
			   $("#timepicker9").attr("disabled",false);
			   $("#timepicker10").attr("disabled",false);
			   }
	   });
   $("#sat_check").click(function(){
	   if($("#sat_check").is(":checked")){
		   $("#timepicker11").attr("disabled",true);
		   $("#timepicker12").attr("disabled",true);
         }
		   else {
			   $("#timepicker11").attr("disabled",false);
			   $("#timepicker12").attr("disabled",false);
			   }
	   });

	   date = new Date();
d = date.getDate();
m = date.getMonth();
y = date.getFullYear();
$("#calendar").fullCalendar({
  header: {
    left: "prev,next today",
    center: "title",
    right: "month,agendaWeek,agendaDay"
  }, 
  editable: true,
  droppable: true,
  drop: function(date, allDay) {
    /*
     * retrieve the dropped element's stored Event Object
     */
    var copiedEventObject, originalEventObject;
    originalEventObject = $(this).data("eventObject");

    /*
     * we need to copy it, so that multiple events don't have a reference to the same object
     */
    copiedEventObject = $.extend({}, originalEventObject);

    /*
     * assign it the date that was reported
     */
    copiedEventObject.start = date;
    copiedEventObject.allDay = allDay;
    copiedEventObject.className = $(this).attr("data-class");

    /*
     * render the event on the calendar
     * the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
     */
    $("#calendar").fullCalendar("renderEvent", copiedEventObject, true);

    /*
     * is the "remove after drop" checkbox checked?
     * if so, remove the element from the "Draggable Events" list
     */
    if ($("#drop-remove").is(":checked")) {
      return $(this).remove();
    }
  },
  events: [
           ////////////////////////////
             
    { 
    	
      title: "HOLIDAY : Holiday",
       start: new Date(2016, 5, 29),
      end: new Date(2016, 5, 29),
      className: "label label-danger",

    },
      
    { 
    	
      title: "HOLIDAY : Sunday",
       start: new Date(2016, 6, 10),
      end: new Date(2016, 6, 10),
      className: "label label-danger",

    },
      
    { 
    	
      title: "HOLIDAY : Isefhliua",
       start: new Date(2016, 6, 17),
      end: new Date(2016, 6, 17),
      className: "label label-danger",

    },
      
    { 
    	
      title: "HOLIDAY : Dipavali",
       start: new Date(2016, 6, 29),
      end: new Date(2016, 6, 29),
      className: "label label-danger",

    },
      
    { 
    	
      title: "HOLIDAY : Independence Day",
       start: new Date(2016, 7, 15),
      end: new Date(2016, 7, 15),
      className: "label label-danger",

    },
      
    { 
    	
      title: "HOLIDAY : National Day",
       start: new Date(2016, 7, 31),
      end: new Date(2016, 7, 31),
      className: "label label-danger",

    },
      
    { 
    	
      title: "HOLIDAY : Hari Raya",
       start: new Date(2016, 6, 06),
      end: new Date(2016, 6, 13),
      className: "label label-danger",

    },
     
//********************************************End Holidays**************************************************************/

  
          
           /* For  show present and not marked attendance----------------------------------------------------------------------------*/

           
                           
            ],
  
  
});

	   	function format(input)
{
    var nStr = input.value + '';
    nStr = nStr.replace( /\,/g, "");
    var x = nStr.split( '.' );
    var x1 = x[0];
    var x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while ( rgx.test(x1) ) {
        x1 = x1.replace( rgx, '$1' + ',' + '$2' );
    }
    input.value = x1 + x2;
}
  
   </script>

    <script>

   function multiplyBy1()
{
        num1 = document.getElementById("box1").value;
        num2 = document.getElementById("box10").value;
        document.getElementById("result1").innerHTML = num1 * num2;
}

   function multiplyBy2()
{
        num1 = document.getElementById("box2").value;
        num2 = document.getElementById("box20").value;
        document.getElementById("result2").innerHTML = num1 * num2;
}

   function multiplyBy3()
{
        num1 = document.getElementById("box3").value;
        num2 = document.getElementById("box30").value;
        document.getElementById("result3").innerHTML = num1 * num2;
}

   function multiplyBy4()
{
        num1 = document.getElementById("box4").value;
        num2 = document.getElementById("box40").value;
        document.getElementById("result4").innerHTML = num1 * num2;
}

   function multiplyBy5()
{
        num1 = document.getElementById("box5").value;
        num2 = document.getElementById("box50").value;
        document.getElementById("result5").innerHTML = num1 * num2;
}

   function multiplyBy6()
{
        num1 = document.getElementById("box6").value;
        num2 = document.getElementById("box60").value;
        document.getElementById("result6").innerHTML = num1 * num2;
}

   function multiplyBy7()
{
        num1 = document.getElementById("box7").value;
        num2 = document.getElementById("box70").value;
        document.getElementById("result7").innerHTML = num1 * num2;
}

   function multiplyBy8()
{
        num1 = document.getElementById("box8").value;
        num2 = document.getElementById("box80").value;
        document.getElementById("result8").innerHTML = num1 * num2;
}

   function multiplyBy9()
{
        num1 = document.getElementById("box9").value;
        num2 = document.getElementById("box90").value;
        document.getElementById("result9").innerHTML = num1 * num2;
}

   function multiplyBy10()
{
        num1 = document.getElementById("box10").value;
        num2 = document.getElementById("box100").value;
        document.getElementById("result10").innerHTML = num1 * num2;
}

 function multiplyBy11()
{
        num1 = document.getElementById("box11").value;
        num2 = document.getElementById("box110").value;
        document.getElementById("result11").innerHTML = num1 * num2;
}

 function multiplyBy12()
{
        num1 = document.getElementById("box12").value;
        num2 = document.getElementById("box120").value;
        document.getElementById("result12").innerHTML = num1 * num2;
}

 function multiplyBy13()
{
        num1 = document.getElementById("box13").value;
        num2 = document.getElementById("box130").value;
        document.getElementById("result13").innerHTML = num1 * num2;
}

 function multiplyBy14()
{
        num1 = document.getElementById("box14").value;
        num2 = document.getElementById("box140").value;
        document.getElementById("result14").innerHTML = num1 * num2;
}

 function multiplyBy15()
{
        num1 = document.getElementById("box15").value;
        num2 = document.getElementById("box150").value;
        document.getElementById("result15").innerHTML = num1 * num2;
}

function multiplyBy16()
{
        num1 = document.getElementById("box16").value;
        num2 = document.getElementById("box160").value;
        document.getElementById("result16").innerHTML = num1 * num2;
}

function multiplyBy17()
{
        num1 = document.getElementById("box17").value;
        num2 = document.getElementById("box170").value;
        document.getElementById("result17").innerHTML = num1 * num2;
}

function multiplyBy18()
{
        num1 = document.getElementById("box18").value;
        num2 = document.getElementById("box180").value;
        document.getElementById("result18").innerHTML = num1 * num2;
}

function multiplyBy19()
{
        num1 = document.getElementById("box19").value;
        num2 = document.getElementById("box190").value;
        document.getElementById("result19").innerHTML = num1 * num2;
}

function multiplyBy20()
{
        num1 = document.getElementById("box20").value;
        num2 = document.getElementById("box200").value;
        document.getElementById("result20").innerHTML = num1 * num2;
}








 function devideBy1()
{
        num1 = document.getElementById("box1").value;
        num2 = document.getElementById("box10").value;
        document.getElementById("result1").innerHTML = num1 / num2;
}

   function devideBy2()
{
        num1 = document.getElementById("box2").value;
        num2 = document.getElementById("box20").value;
        document.getElementById("result2").innerHTML = num1 / num2;
}

   function devideBy3()
{
        num1 = document.getElementById("box3").value;
        num2 = document.getElementById("box30").value;
        document.getElementById("result3").innerHTML = num1 / num2;
}

   function devideBy4()
{
        num1 = document.getElementById("box4").value;
        num2 = document.getElementById("box40").value;
        document.getElementById("result4").innerHTML = num1 / num2;
}

   function devideBy5()
{
        num1 = document.getElementById("box5").value;
        num2 = document.getElementById("box50").value;
        document.getElementById("result5").innerHTML = num1 / num2;
}

</script>

<script language="Javascript">
<!--
function ShowPicture(id,Source) {
if (Source=="1"){
if (document.layers) document.layers[''+id+''].visibility = "show"
else if (document.all) document.all[''+id+''].style.visibility = "visible"
else if (document.getElementById) document.getElementById(''+id+'').style.visibility = "visible"
}
else
if (Source=="0"){
if (document.layers) document.layers[''+id+''].visibility = "hide"
else if (document.all) document.all[''+id+''].style.visibility = "hidden"
else if (document.getElementById) document.getElementById(''+id+'').style.visibility = "hidden"
}
}

function pageScroll() {
    	window.scrollBy(0,500); // horizontal and vertical scroll increments
}
</script>
 </body></html>