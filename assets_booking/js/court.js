jQuery(document).ready(function(){ 
//$('[data-toggle="tooltip"]').tooltip();    
    get_court_list();    
$("#editModal").on('hide.bs.modal', function () {
         var validator = $( '#add_court' ).validate();
         validator.resetForm();
         $(this).find('form')[0].reset();
         if ($('div').hasClass('tooltip-arrow')){
             $('.tooltip-arrow').attr('style','display:none;');
         }
         if ($('div').hasClass('tooltip-inner')){
             $('.tooltip-inner').attr('style','display:none;');
         }
    });
	
jQuery.validator.addMethod("alphanumeric", function(value, element) {
 return this.optional(element) || /^[a-zA-Z0-9 ]+$/i.test(value);
}, "Letters, numbers, and underscores only please");

	jQuery.validator.addMethod('chk_image', function (value) {
        var hid_id = $("#image_hidden").val();
        //var court_name = $('#court_name').val();
        var return_var = '';
       if(hid_id == ''){
                           
                            return_var = false ;
						}
						else{
							return_var = true;
						}
        return return_var;
    });
	
	

	jQuery.validator.addMethod('chk_court_exist', function (value) {
		 var hid_id = $("#hidden_id").val();
		var sports_id = $("#sports_id").val();
        var location_id = $("#location_id").val();
        var court_name = $('#court_name').val().trim();
        var return_var = true;
        if(court_name != '' && location_id != '' && sports_id != ''){
            $.ajax({ 	
                    type: "POST",   
                    url: base_url+"court/check_court_exist",
                    data:"hid_id="+hid_id+"&court_name="+court_name+"&sports_id="+sports_id+"&location_id="+location_id,		
                    async: false,
                    datatype: "json",
                    success : function(data)
                    {
						//console.log(data);
                            var obj = JSON.parse(data);	
                            return_var = (!obj) ? true : false;
							//alert(data);
						
                    },
                    fail: function( jqXHR, textStatus, errorThrown ) {
                            console.log( 'Could not get posts, server response: ' + textStatus + ': ' + errorThrown );
                    }
            });
        }
        return return_var;
    });


// for status
	$(document).on('click', '.comp', function () {
		  
		var stid = $(this).attr('stat_at');
	//alert(stid);
    if(stid==0)
	{
		//alert(stid);btn-success
		$(this).removeClass("btn-danger");
		$(this).addClass("btn-success");
		
		$(this).children("i").removeClass("fa fa-times");
		$(this).children("i").addClass("fa fa-check");
		
		
	}else {
		$(this).removeClass("btn-success");
		$(this).addClass("btn-danger");
		
		$(this).children("i").removeClass("fa fa-check");
		$(this).children("i").addClass("fa fa-times");
		}
		  
		  
		  var statid = $(this).attr('stat_at');
		   var courtid = $(this).attr('id');
		   if(statid=='0'){ var statid=1;}else{var statid=0;}
		  
		  $(this).attr("stat_at", statid);
		 
					
			$.ajax({ 	
            type: "POST",   
            url: base_url+"court/court_status_update",
            data: {courtid:courtid,statid:statid,reg:"status"},		
            async: false,
            datatype: "json",
            success : function(data)
            {
                                          
            },
            fail: function( jqXHR, textStatus, errorThrown ) {
                    console.log( 'Could not get posts, server response: ' + textStatus + ': ' + errorThrown );
            }
        });
				   
				});
	
	// status-end

   
    
    
    jQuery(document).on('click','.delete_court', function(e){
       if (confirm("Are you sure you want to delete this record?")) {
        var id = $(this).attr('data-id');
        var newdiv = '';
        $.ajax({ 	
                type: "POST",   
                url: base_url+"court/delete_court",
                data:"id="+id,		
                async: false,
                datatype: "html",
                success : function(data)
                {  
                    get_court_list();
                    //location.reload();
                    newdiv += "<div class='col-sm-12 col-md-12' id='hideMe'><div class='alert alert-success'>";
                    newdiv += "<i class='fa fa-check-square' aria-hidden='true'></i>"; 
                    newdiv += "<strong>&nbsp;Court details deleted succesfully!</strong></div></div>";
                    $("#dynamic_message").after(newdiv);
                    $('#hideMe').delay(3000).fadeOut('slow');      
                    
                },
                fail: function( jqXHR, textStatus, errorThrown ) {
                    console.log( 'Could not get posts, server response: ' + textStatus + ': ' + errorThrown );
                }
        });
	   }
	   else{
		   return false;
	   }
	
    });

    
    jQuery(document).on('click','.edit_court', function(e){
        $('.modal-title').html('Edit Court');
        var id = $(this).attr('data-id');
        $.ajax({ 	
            type: "POST",   
            url: base_url+"court/get_court_details",
            data:"id="+id,		
            async: false,
            datatype: "json",
            success : function(data)
            {
                var obj = JSON.parse(data);
                $('#hidden_id').val(id);
				//alert(obj.id);
                //$('#sports_id option[value="'+ obj.sid +'"]').attr('selected', true);
                //$('#location_id option[value="'+ obj.lid +'"]').attr('selected', true);
                $('#sports_id').val(obj.sid);
                $('#location_id').val(obj.lid);
                $('#court_name').val(obj.courtname); 

                 $('#court_type').val(obj.courttype);	
                //$('#court_timings').val(obj.timings);			 
                //$('#timepicker1').val(tConvert(obj.from_time));
                //$('#timepicker2').val(tConvert(obj.to_time));
                $('#timepicker1').timepicker('setTime', tConvert(obj.from_time));
                $('#timepicker2').timepicker('setTime', tConvert(obj.to_time));
                time_settings();
                $('#court_address').val(obj.address);	
                $('#court_location_map').val(obj.locationmap);
                //for ckeditor edit
                var rr=$("#cke_court_add_info").find(".cke_wysiwyg_frame");
                rr.contents().find(".cke_editable").html(obj.addinfo);
                //
                var img_url = base_url+"uploads/images/"+obj.imgfilename;
                $("#courtimage").attr("src", img_url);
                $('#image_hidden').val(obj.imgfilename);				 			 
            },
            fail: function( jqXHR, textStatus, errorThrown ) {
                    console.log( 'Could not get posts, server response: ' + textStatus + ': ' + errorThrown );
            }
        }); 
         e.preventDefault(); 
    });

   //$('#myModal').modal({backdrop: 'static', keyboard: false});
   $(".add_court").on('click', function(){
        $('.modal-title').html('Add Court');
        $('#hidden_id').val('');
        $('#sports_id').val('');
        $('#location_id').val('');
        $('#court_name').val(''); 

        $('#court_type').val('');	
        $('#court_timings').val('');	
        $('#court_address').val('');	
        $('#court_location_map').val('');
        //for ckeditor edit
        var rr=$("#cke_court_add_info").find(".cke_wysiwyg_frame");
        rr.contents().find(".cke_editable").html('');
        //
        $("#courtimage").attr("src", '');
        $('#image_hidden').val('');
        
        $('#timepicker1').timepicker('setTime', '06:00 AM');
        $('#timepicker2').timepicker('setTime', '06:00 PM');
        time_settings();
    }); 
    
     $("#myModal").on('hide.bs.modal', function () {
         var validator = $( '#add_court' ).validate();
         validator.resetForm();
         $(this).find('form')[0].reset();
         if ($('div').hasClass('tooltip-arrow')){
             $('.tooltip-arrow').attr('style','display:none;');
         }
         if ($('div').hasClass('tooltip-inner')){
             $('.tooltip-inner').attr('style','display:none;');
         }
         
         $('#timepicker1').timepicker('setTime', '06:00 AM');
         $('#timepicker2').timepicker('setTime', '06:00 PM');
         time_settings();
    });
    
    
    jQuery.validator.addMethod('chk_from_time', function (value) {
        var return_var = ($("#timepicker1").val() !='') ? true : false;
        return return_var;
    });
    
    jQuery.validator.addMethod('chk_to_time', function (value) {
        var return_var = ($("#timepicker2").val() !='') ? true : false;
        return return_var;
    });
	
	
    
    $(document).on("click","#submit1",function(e){
		//e.preventDefault();
        $("form[name='add_court']").validate({
            // Specify validation rules
            onkeyup: false,
            rules: {
                sports_id: {
                    required: true
                },
                location_id: {
                    required: true
                },
                court_name: {
                    required: true,
                    chk_court_exist:true,
                    alphanumeric:true,
                    minlength: 4
                },
                court_type: {
                    required: true
                },
                timepicker1: {
                    chk_from_time: true
                },
                timepicker2: {
                    chk_to_time: true
                },
                court_address: {
                    required: true
                },
                court_location_map: {
                    required: true
                }
				/* ,
                 court_file: {
                    chk_image: true
                }  */
            },
            messages: {
                sports_id: {
                    required: "Please select activity"
                },
                location_id: {
                    required: "Please select location"
                },
                court_name: {
                    required: "Please enter the court name",
                    chk_court_exist: " This Court already exist!",
                    alphanumeric:"Only alpha numeric keys are accepted!",
                    minlength: "Court name must contains atleast 4 characters"
                },
                court_type: {
                    required: "Please select court type"
                },
                timepicker1: {
                    chk_from_time: "Please select the from time"
                },
                timepicker2: {
                    chk_to_time: "Please select the to time"
                },
                court_address: {
                    required: "Please enter the address"
                },
                court_location_map: {
                    required: "Please enter the location map"
                }
				/* ,
                 court_file: {
                    chk_image: "You have choosen invalid file type! please select valid image"
                }  */
            },
			 submitHandler: function (form) {
				 
if($("form[name='add_court']").valid()){
					  
						if(file == "valid")
						{
						$("#submit1").button('loading');
						form.submit();
						 return true;
						}
						else{
						alert('You have choosen invalid file type! please select valid image');
						return false;
						}                                                     //$('#add_court').submit;
        }
              
            }
        });
	
        
    });
    
    

        
});

function time_settings(court_ftime='',court_totime=''){
    var court_from_time = (court_ftime !='') ? court_ftime : '06:00 AM';
    var court_to_time = (court_totime !='') ? court_totime : '06:00 PM';
    //alert(court_from_time+' '+court_to_time);
    $('#timepicker1').timepicker({
       defaultTime : court_from_time,
    }).on('changeTime.timepicker', function(e) {
        //console.log('The time is ' + e.time);
        var st = ($(this).val() !='') ? convert_timeFormat($(this).val()) : '';
        var et = ( $('#timepicker2').val() !='') ? convert_timeFormat( $('#timepicker2').val()) : ''; 
        if(et !=''){
            var time_diff = calculate(st,et);
            if(time_diff == 0){
                 if(st >= et){
                     alert("From time must be smaller than to time");
                     $(this).val('');
                 }
            }
            else{
                alert("Difference between two time value should be round off value!");
                $(this).val('');
            }
        }
            
       
    }); 

    $('#timepicker2').timepicker({
       defaultTime : court_to_time,
    }).on('changeTime.timepicker', function(e) {
        var et = ($(this).val() !='') ? convert_timeFormat($(this).val()) : '';
        var st = ( $('#timepicker1').val() !='') ? convert_timeFormat( $('#timepicker1').val()) : '';   
       // alert(et);
        if(st !=''){
            var time_diff = calculate(st,et);
            if(time_diff == 0){
                if(st >= et){
                    alert("To time must be greater than from time");
                    $(this).val('');
                }
            }
            else{
                alert("Difference between two time value should be round off value!");
                $(this).val('');
            }
        }
    }); 
}

function calculate(fromtime,totime) {
    //alert(fromtime+' '+totime);
     var time1 = fromtime.split(':'), time2 = totime.split(':');
     var hours1 = parseInt(time1[0], 10), 
         hours2 = parseInt(time2[0], 10),
         mins1 = parseInt(time1[1], 10),
         mins2 = parseInt(time2[1], 10);
     var hours = hours2 - hours1, mins = 0;

     // get hours
     if(hours < 0) hours = 24 + hours;

     // get minutes
     if(mins2 >= mins1) {
         mins = mins2 - mins1;
     }
     else {
         mins = (mins2 + 60) - mins1;
         hours--;
     }

     // convert to fraction of 60
     mins = mins / 60; 

     hours += mins;
     hours = hours.toFixed(2);
    // hours = hours;
    var mod = hours % 1 ;
        mod != 0
     return mod;
 }


function convert_timeFormat(time){
    //var time = $("#starttime").val();
    var hours = Number(time.match(/^(\d+)/)[1]);
    var minutes = Number(time.match(/:(\d+)/)[1]);
    var AMPM = time.match(/\s(.*)$/)[1];
   // alert(AMPM+' '+hours);
    if(AMPM == "PM" && hours<12) hours = hours+12;
    if(AMPM == "AM" && hours==12) hours = hours-12;
    var sHours = hours.toString();
    var sMinutes = minutes.toString();
    if(hours<10) sHours = "0" + sHours;
    if(minutes<10) sMinutes = "0" + sMinutes;
    return time = sHours + ":" + sMinutes;
}

function get_court_list(){
   // var court_name = ( $('#court_name').val() !=='' ) ? $('#court_name').val() : '';
    $.ajax({ 	
        type: "POST",   
        url: base_url+"court/get_court_list",
       // data:"court_name="+court_name,
        async: false,
        datatype: "html",
        success : function(data)
        {
           
            $("#example2 tbody").html(data);
            
        },
        fail: function( jqXHR, textStatus, errorThrown ) {
                console.log( 'Could not get posts, server response: ' + textStatus + ': ' + errorThrown );
        }
    });

}
/* function timetoedit(time){
	
	var dt = new Date(time);
    var h =  dt.getHours(), m = dt.getMinutes();
    var thistime = (h > 12) ? (h-12 + ':' + m +' PM') : (h + ':' + m +' AM');
console.log(thistime);
return thistime;
	
} */

function tConvert(time) {
  // Check correct time format and split into components
  var time = time.toString ().match (/^([01]\d|2[0-3])(:)([0-5]\d)(:[0-5]\d)?$/) || [time];

  if (time.length > 1) { // If time format correct
    time = time.slice (1);  // Remove full string match value
    time[5] = +time[0] < 12 ? 'AM' : 'PM'; // Set AM/PM
    time[0] = +time[0] % 12 || 12; // Adjust hours
  }
  return time.join (''); // return adjusted time or original string
}

