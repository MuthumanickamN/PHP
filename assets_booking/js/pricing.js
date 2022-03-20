 var court_from_time = '06:00 AM';
 var court_to_time = '06:00 PM';
jQuery(document).ready(function(){    
    //$('[data-toggle="tooltip"]').tooltip();    
    get_pricing_list();
    if($('#hidden_id').val() !=''){
        getLocationNames();
        get_courtnames();   
        var court_from_time = ($("#hidden_court_ftime").val() !='') ? $("#hidden_court_ftime").val() : '06:00 AM';
        var court_to_time = ($("#hidden_court_totime").val() !='') ? $("#hidden_court_totime").val() : '06:00 PM';
        $('#show_court_timings').html("<strong>( "+court_from_time+" - "+court_to_time+" )</strong> Configure Pricing per 60 Minutes");        
    } 
    numeric_input();
    
//    if($('#hidden_id').val() !=''){
//        court_onchange();
//    }
    
    $("#court").change(function(){
        court_onchange();
    });
    
    jQuery(document).on('click','.delete_user', function(e){
        if(confirm('Are you sure!,Do you want to delete this pricing details?')) {
        var pid = $(this).attr('data-id');
        $.ajax({ 	
        type: "POST",   
        url: base_url+"pricing/delete_pricing_details",
        data:"pid="+pid,		
        async: false,
        datatype: "html",
        success : function(data)
        {
            get_pricing_list();
            var div = "<strong>&nbsp;Deleted Succesfully!</strong></div></div>";
            $("#dynamic_message").html(div);
            
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

   
    $('#show_court_timings').html("<strong>( "+court_from_time+" - "+court_to_time+" )</strong> Configure Pricing per 60 Minutes");
    
    
    jQuery(document).on('click','#sbt_btn', function(e){ 
        validation_function();
        //checkexist();
    });
    
    jQuery.validator.addMethod('check_sports', function (value) {
        var sports = $('#sports').val();
        var return_var = (sports == '') ? false : true ;			
        return return_var;
    });
    jQuery.validator.addMethod('check_location', function (value) {
        var location = $('#location').val();
        var return_var = (location == '') ? false : true ;			
        return return_var;
    });
    jQuery.validator.addMethod('check_court', function (value) {
        var court = $('#court').val();
        var return_var = (court == '') ? false : true ;			
        return return_var;
    });
    
    jQuery.validator.addMethod('check_court_exist_from', function (value) {
        var return_var = checkexist();   
        return return_var;
    });
    
    jQuery.validator.addMethod('check_court_exist_to', function (value) {
        var return_var = checkexist();   
        return return_var;
    });
    
    jQuery.validator.addMethod('check_court_exist_holiday', function (value) {
        var return_var = checkexist();   
        return return_var;
    });
    
    
    jQuery.validator.addMethod('check_day_type', function (value) {
        var return_var = ( $('[name="day_type"]:checked').length > 0 ) ?  true: false ;			
        return return_var;
    });
    jQuery.validator.addMethod('check_from_day', function (value) {
        if( ( $('[name="day_type"]:checked').val() == 0 ) || ( $('[name="day_type"]:checked').val() == 1 ) ) {
            var return_var = ( $('#from_day').val() == '') ? false : true ;
        } 			
        return return_var;
    });
    
    jQuery.validator.addMethod('check_to_day', function (value) {
        if ( $('[name="day_type"]:checked').val() == 1 ) {
            var return_var = ( $('#to_day').val() == '') ? false : true ;
        } 			
        return return_var;
    });
    
    jQuery.validator.addMethod('check_holidays', function (value) {
        if ( $('[name="day_type"]:checked').val() == 2 ) {
            var return_var = ( $('#holidays').val() == '') ? false : true ;
        } 			
        return return_var;
    }); 
    
    jQuery.validator.addMethod('check_valid_from', function (value) {
        var from_day = $('#from_day').val();
        var to_day = $('#to_day').val();
        var return_var = true;
        if(to_day !=''){
            return_var = ( from_day >= to_day) ? false : true ;
        }			
        return return_var;
    });
    
    jQuery.validator.addMethod('check_valid_to', function (value) {
        var from_day = $('#from_day').val();
        var to_day = $('#to_day').val();
        var return_var = true;
        if(from_day !='' && to_day !=''){
            return_var = ( from_day >= to_day) ? false : true ;
        }			
        return return_var;
    });

 
  var validation_function = function(){ $("form[name='add_pricing']").validate({
            // Specify validation rules
            rules: {
                sports: {
                    check_sports: true
                },
                location: {
                    check_location: true
                },
                court: {
                    check_court: true
                },
                day_type: {
                    check_day_type: true
                },
                from_day: {
                    check_from_day: true,
                    check_court_exist_from: true,
                    check_valid_from: true
                },
                to_day: {
                    check_to_day: true,
                    check_court_exist_to: true,
                    check_valid_to: true
                },
                holidays: {
                    check_holidays: true,
                    check_court_exist_holiday: true
                },
                'from_time[]': "required",
                'to_time[]': "required",
                'slot_price[]': "required"
            },
            messages: {
                sports: {
                    check_sports: "Please select sports!"
                },
                location: {
                    check_location: "Please select location!"
                },
                court: {
                    check_court: "Please select court!"
                },
                day_type: {
                    check_day_type: "Please check any one of the day type!"
                },
                from_day: {
                    check_from_day: "Please select From-day!",
                    check_court_exist_from: "Sorry court already exist for this day type!",
                    check_valid_from: "From day should always smaller than to day!"
                },
                to_day: {
                    check_to_day: "Please select To-day!",
                    check_court_exist_to: "Sorry court already exist for this day type!",
                    check_valid_to: "To day should always greater than from day!"
                },
                holidays: {
                    check_holidays: "Please select holiday date!",
                    check_court_exist_holiday: "Sorry court already exist for this day type!",
                }
            },
            submitHandler: function (form) {
                alert("Validation Success!");
                form.submit();
                return true;
            }
    });     
  }
    $("#sports").change(function(){
        getLocationNames();
        get_courtnames();
    });
    
    $("#location").change(function(){
        get_courtnames();
    });

    jQuery(document).on('click','#single', function(e){
        $('#to_day').val('');
        $('#to_day').attr('selected', false);
        // $('#to_day').valid(); 
        $('#holidays').val('');
        $('#holidays').attr('selected', false);
         //$('#holidays').valid(); 
        $(".hide_single").show();
        $(".hide_multiple").hide();
        $(".hide_holiday").hide();       
    });

    jQuery(document).on('click','#multiple', function(e){  
        $('#holidays').val('');
        $('#holidays').attr('selected', false);
       // $('#holidays').valid(); 
        $(".hide_holiday").hide();
        $(".hide_single").show();
        $(".hide_multiple").show();
    });

    jQuery(document).on('click','#holiday', function(e){  
        $('#from_day').val('');
        $('#from_day').attr('selected', false);
        //$('#from_day').valid(); 
        $('#to_day').val('');
        $('#to_day').attr('selected', false);
       // $('#to_day').valid(); 
        $(".hide_holiday").show();
        $(".hide_single").hide();
        $(".hide_multiple").hide();
    });
    
    jQuery(document).on('click','.addtimerange', function(e){    
        //e.preventDefault();
        var court_from_time = ($("#hidden_court_ftime").val() !='') ? $("#hidden_court_ftime").val() : '06:00 AM';
        var court_to_time = ($("#hidden_court_totime").val() !='') ? $("#hidden_court_totime").val() : '06:00 PM';
        update_slotcount_add();   
        var slotcount = $('#slotcount').val();
        var html_element = '';
        html_element += '<div id="slot_set_'+slotcount+'" class="mar_top_20">';
        
        html_element += '<div class="col-sm-12 col-md-10">';
        html_element += '<div class="col-sm-12 col-md-2"><p class="form_text1 pad_top_10 text-right">From</p></div>';
        html_element += '<div class="col-sm-12 col-md-2">';
        html_element += '<div class="input-group bootstrap-timepicker timepicker">';
        html_element += '<input id="timepicker'+slotcount+'" name="from_time[]" type="text" class="form-control input-small timepickertext_from" data-rule-required="true" readonly/>';
        html_element += '<input type="hidden" name="pricing_timeslot_id[]" value="">';
        html_element += '<input type="hidden" name="current_slotcount[]" class="current_slotcount" value="'+slotcount+'">';
        html_element += '<span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>';
        html_element += '</div></div>';

        html_element += '<div class="col-sm-12 col-md-2">';
        html_element += '<p class="form_text1 pad_top_10 text-right">To</p></div>';
        html_element += '<div class="col-sm-12 col-md-2">';
        html_element += '<div class="input-group bootstrap-timepicker timepicker">';
        html_element += '<input id="timepicker'+slotcount+'A" name="to_time[]" type="text" class="form-control input-small timepickertext_to" data-rule-required="true" readonly />';
        html_element += '<span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>';
        html_element += '</div></div>';

        html_element += '<div class="col-sm-12 col-md-2"><input type="text" id="slot_price'+slotcount+'" name="slot_price[]" class="timeslot_price numeric_input" value="" data-rule-required="true" /></div>';
        html_element += '<div class="clearfix"></div>';
        html_element += '<div id="showslot1" class="mar_top_10" style="display: none;">';
        html_element += '<div class="col-sm-6 col-md-1 hidden-sm hidden-xs"></div>';
        html_element += '<div class="col-sm-6 col-md-2 hidden-sm hidden-xs"></div>';
        html_element += '<div class="col-sm-6 col-md-1 hidden-sm hidden-xs"></div>';
        html_element += '<div class="col-sm-6 col-md-2 hidden-sm hidden-xs"></div>';
        html_element += '<div class="col-sm-6 col-md-1 hidden-sm hidden-xs"></div>';
        html_element += '<div class="clearfix"></div></div>';
        html_element += '<div class="clearfix"></div>';
        html_element += '</div>';
        html_element += '<div class="col-sm-12 col-md-2">';
        html_element += '<button type="button" title="Remove" data-slot="'+slotcount+'" class="btn btn-danger btn-md removetimerange">';
        html_element += '<i class="glyphicon glyphicon-trash"></i></button>';
        html_element += '</div><div class="clearfix"></div>';
        
        html_element += '</div>';        
        // prevent default submit action         
        e.preventDefault();
        
        //$("form[name='add_pricing']").validate();
        validation_function();
        
        if(slotcount > 1){
            var prev_slotCount = parseInt(slotcount) - 1;
            var prev_totime_val = $('#timepicker'+prev_slotCount+'A').val();
            court_from_time = prev_totime_val
        }
        $('#timerange').append(html_element);  
        $('.timepickertext_from').timepicker({
            defaultTime : court_from_time,
        }).on('changeTime.timepicker', function(e) {
            //console.log('The time is ' + e.time);
            var court_from_time = convert_timeFormat($('#hidden_court_ftime').val());
            var st = convert_timeFormat($(this).val());
            if(court_from_time <= st){
                //var totime_id = $(this).prop('id')+'A';
                //var et = convert_timeFormat($('#'+totime_id).val());
                var et = convert_timeFormat($(this).parent("div").parent("div").next("div").next("div").children("div").find('.timepickertext_to').val());
                var current_slot_count = $(this).parent("div").find('.current_slotcount').val();
                if(current_slot_count > 1){
                    var prev_slotCount = parseInt(current_slot_count) - 1;
                    var get_prev_totime_val = $('#timepicker'+prev_slotCount+'A').val();
                }
               // alert(get_prev_totime_val+'   '+st);
                if(convert_timeFormat(get_prev_totime_val) <= st){
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
                else{
                    alert("From time should not greater than previous slot's to time!");
                    $(this).val('');
                }
            }
            else{
                alert("From time must be greater than or equal to court from time ("+court_from_time+")");
                $(this).val('');
            }

        });  

        $('.timepickertext_to').timepicker({
            defaultTime : court_to_time,
        }).on('changeTime.timepicker', function(e) {
            var et = convert_timeFormat($(this).val());
            var court_to_time = convert_timeFormat($('#hidden_court_totime').val());
            if(court_to_time >= et){
                var st = convert_timeFormat($(this).parent("div").parent("div").prev("div").prev("div").children("div").find('.timepickertext_from').val()); 
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
            else{
                alert("To time must be smaller than or equal to court to time ("+court_to_time+")");
                $(this).val('');
            }
        });  
        
        numeric_input();
         $("[name^=slot_price]").each(function () {
            $(this).rules("add", {
                required: true
            });
        });
        
    });
    
    jQuery(document).on('click','.removetimerange', function(e){
       // alert('test');
        var slotcount = $(this).attr('data-slot');
        $('#slot_set_'+slotcount).remove();
        update_slotcount_remove();
    });

   time_settings();

   
});



function time_settings(court_ftime='',court_totime=''){
    var court_from_time = (court_ftime !='') ? court_ftime : '06:00 AM';
    var court_to_time = (court_totime !='') ? court_totime : '06:00 PM';
    var slotcount = $('#slotcount').val();
    
    $('.timepickertext_from').timepicker({
       defaultTime : court_from_time,
    }).on('changeTime.timepicker', function(e) {
        //console.log('The time is ' + e.time);
       var court_from_time = ($('#hidden_court_ftime').val() !='') ? convert_timeFormat($('#hidden_court_ftime').val()) : '06:00 PM';
       var st = ($(this).val() !='') ? convert_timeFormat($(this).val()) : '';
       if(court_from_time <= st){
           //var totime_id = $(this).prop('id')+'A';
           //var et = convert_timeFormat($('#'+totime_id).val());
           var et = convert_timeFormat($(this).parent("div").parent("div").next("div").next("div").children("div").find('.timepickertext_to').val());
           if(slotcount > 1){
                var prev_slotCount = parseInt(slotcount) - 1;
                var get_prev_totime_val = $('#timepicker'+prev_slotCount+'A').val();
           
                if(convert_timeFormat(get_prev_totime_val) <= st){
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
                else{
                     alert("From time should not greater than previous slot's to time!");
                     $(this).val('');
                }
            }else{
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
       }
       else{
           alert("From time must be greater than or equal to court from time ("+court_from_time+")");
           $(this).val('');
       }
    }); 

    $('.timepickertext_to').timepicker({
       defaultTime : court_to_time,
    }).on('changeTime.timepicker', function(e) {
        var et = ($(this).val() !='') ? convert_timeFormat($(this).val()) : '';
        var court_to_time = ($('#hidden_court_totime').val() !='') ? convert_timeFormat($('#hidden_court_totime').val()) : '06:00 PM';
        if(court_to_time >= et){
            var st = convert_timeFormat($(this).parent("div").parent("div").prev("div").prev("div").children("div").find('.timepickertext_from').val()); 
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
        else{
            alert("To time must be smaller than or equal to court to time ("+court_to_time+")");
            $(this).val('');
        }
    }); 
}

function court_onchange(){
    var court = $('#court').val();
    if(court !=''){
        $.ajax({
        type: "POST",
        url: base_url+"pricing/get_courtdetails",
        data: { cid : court },
        datatype: "json",
        async:false,
        }).done(function(data){
            var obj = jQuery.parseJSON(data);
            //console.log(obj);alert(court_from_time+' '+court_to_time);
            var court_from_time = obj.from_time;
            var court_to_time = obj.to_time;
            //alert(court_from_time+' '+court_to_time);
            $('#hidden_court_ftime').val(obj.from_time);	
            $('#hidden_court_totime').val(obj.to_time);
            $('#show_court_timings').html("<strong>( "+court_from_time+" - "+court_to_time+" )</strong> Configure Pricing per 60 Minutes");
            $('.timepickertext_from').timepicker('setTime', court_from_time);
            $('.timepickertext_to').timepicker('setTime', court_to_time);
            //time_settings(court_from_time,court_to_time)
        });
    }
    else{
        $('#hidden_court_fromtime').val('06:00 AM');
        $('#hidden_court_totime').val('06:00 PM');
        var court_from_time = '06:00 AM';
        var court_to_time = '06:00 PM';
        //alert(court_from_time+' '+court_to_time);
        $('#show_court_timings').html("<strong>( "+court_from_time+" - "+court_to_time+" )</strong> Configure Pricing per 60 Minutes");
        $('.timepickertext_from').timepicker('setTime', court_from_time);
        $('.timepickertext_to').timepicker('setTime', court_to_time);
    }
}

function calculate(fromtime,totime) {
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
    if(AMPM == "PM" && hours<12) hours = hours+12;
    if(AMPM == "AM" && hours==12) hours = hours-12;
    var sHours = hours.toString();
    var sMinutes = minutes.toString();
    if(hours<10) sHours = "0" + sHours;
    if(minutes<10) sMinutes = "0" + sMinutes;
    return time = sHours + ":" + sMinutes;
}

// For validation i used this function
function checkexist(){
    var court = $('#court').val();
    var day_type = $('[name="day_type"]:checked').val();
    var from_day = ($('#from_day').val() !='') ? $('#from_day').val() : '';
    var to_day = ($('#to_day').val() !='') ? $('#to_day').val() : '';
    var holidays = ($('#holidays').val() !='') ? $('#holidays').val() : '';
    var hidden_id = $('#hidden_id').val();
    var return_var = false;
    if(court !='' && day_type !='')
    {
    if($('[name="day_type"]:checked').val() == '0'){
        $('#to_day').val('');
        $('#to_day').attr('selected', false);
        $('#holidays').val('');
        $('#holidays').attr('selected', false);
    }
    else if($('[name="day_type"]:checked').val() == '1'){
        $('#holidays').val('');
        $('#holidays').attr('selected', false);
    }else{
        $('#from_day').val('');
        $('#from_day').attr('selected', false);
        $('#to_day').val('');
        $('#to_day').attr('selected', false);
    }    
    $.ajax({
        type: "POST",
        url: base_url+"pricing/check_courtExist",
        data: { cid : court, day_type : day_type, hidden_id: hidden_id, fromday: from_day, today: to_day, holidays: holidays } ,
        datatype: "json",
        async:false,
    }).done(function(data){
       //alert(data);
        //var obj = jQuery.parseJSON(data);
        return_var = (data > 0 ) ? false : true ;	
    });
    }

    return return_var;
}
//*********

function numeric_input(){
    $(".numeric_input").keydown(function (e) {
       // alert(value);
        //keycode fr dot is 190
        // Allow: backspace, delete, tab, escape, enter and 
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
    
    //$(".numeric_input").attr("maxlength", "4");
    $(".numeric_input").keyup(function(){
        var value = $(this).val();
        value = value.replace(/^(0*)/,"");
        $(this).val(value);
    });
}

function get_pricing_list(){
    //var court_name = ( $('#court_name').val() !=='' ) ? $('#court_name').val() : '';
    $.ajax({ 	
        type: "POST",   
        url: base_url+"pricing/get_pricing_list",
        //data:"id="+court_name,
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

function get_courtnames(){
    var selectedSports = $("#sports").val();
    var selectedLocation = ($('#hidden_id').val() !='') ? $('#hidden_location_id').val() : $("#location").val() ;
    if(selectedSports !='' && selectedLocation !='')
    {
        //alert(selectedSports+' '+selectedLocation);
        $.ajax({
            type: "POST",
            url: base_url+"pricing/get_courtnames",
            data: { sports_id : selectedSports, location_id : selectedLocation } 
        }).done(function(data){
            $("#court").html(data);
            if($('#hidden_id').val() !=''){
                var hidden_court_id = $('#hidden_court_id').val();
                $('#court option[value="'+hidden_court_id+'"]').attr('selected', true);
            }
        });
    }else{
        $("#court").children('option:not(:first)').remove();
    }
}

function getLocationNames(){
    var selectedSports = $("#sports").val();
    if(selectedSports !='')
    {
        //alert(selectedSports+' '+selectedLocation);
        $.ajax({
            type: "POST",
            url: base_url+"pricing/get_locationnames",
            data: { sports_id : selectedSports} 
        }).done(function(data){
            $("#location").html(data);
            if($('#hidden_id').val() !=''){
                var hidden_location_id = $('#hidden_location_id').val();
                $('#location option[value="'+hidden_location_id+'"]').attr('selected', true);
            }
        });
    }else{
        $("#location").children('option:not(:first)').remove();
    }
}

function formatDate(d){
    var months = ["Januaray", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ]; //you would need to include the rest
    return days = months[d.getMonth()] + " " + (d.getDate() < 10 ? "0" + d.getDate() : d.getDate()) + ", " + d.getFullYear();
}

function update_slotcount_add(){
    var count = ( $('#slotcount').val() !='' ) ? $('#slotcount').val() : 1 ;
    var slotcount = parseInt(count) + 1;
    $('#slotcount').val(slotcount);    
}

function update_slotcount_remove(){
    var count = ( $('#slotcount').val() !='' ) ? $('#slotcount').val() : 1 ;
    var slotcount = parseInt(count) - 1;
    $('#slotcount').val(slotcount);    
}
