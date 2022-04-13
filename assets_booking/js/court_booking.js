jQuery(document).ready(function(){    
    //$('[data-toggle="tooltip"]').tooltip();
    $('.parent_id').select2();
    var date_last_clicked = null;
    jQuery(document).on('change','.parent_id', function(e){
        var parent_id = $(this).val();
        if(parent_id != 0)
        {
            $('#show_cart').css('display', 'block');
        }
        else{
            $('#show_cart').css('display', 'none');
        }
    });
    jQuery(document).on('click','#slots', function(e){
        $('#hide2').css('display', 'none');
        $('#hide3').css('display', 'none');
        $('.calendarDiv').css('display', 'block');
        show_booking_timeslot();
    });
    numeric_input();   
   
   $("#sports").change(function(){
        getLocationNames();
    });
   
   $('.date-picker').datepicker({
    format: "dd-mm-yyyy", 
    autoclose: true,
    todayHighlight: true,
    //startDate: '-0d',
    endDate: '+90d'
    }).on("changeDate", function (e) {
        $('.date-picker').valid();
    });
    
    
    $('.view-booked-timeslot').click(function(e){
        alert(1);  
        /*var booked_slotid = $(this).attr('data-id');
        var fromtime = $(this).attr('data-fromtime');
        var totime = $(this).attr('data-totime');     
                         
        view_modal_popup(booked_slotid, fromtime, totime);*/
    });
    
    customer_mobile_autocomplete();
    
    $('#show_cart').click(function(e){
        $('.calendarDiv').css('display', 'none');
        $('#hide2').css('display', 'block');
        $('#hide3').css('display', 'none');
        show_cart_list();
    });
    $('#discount_btn').click(function(e){
        discount_calc();
        wallet_calc();
    });
    
    $("input[name=pay_mode]").click(function(){
      wallet_calc();
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
    
    jQuery.validator.addMethod('check_valid_walletAmount', function (value) {
       // var customer_old_deductable_wallet_amount = get_customerPenddingDeductableAmount();
        var balance_amount = ($('#hidden_balance_amount').val() !='') ?  parseInt($('#hidden_balance_amount').val()) : 0;
        var customer_wallet_amount = get_customerWalletAmount();
        var return_var = true;
        //var sum_amount = parseInt(balance_amount) + parseInt(customer_old_deductable_wallet_amount);
       // alert(customer_old_deductable_wallet_amount);
        if( $('input[name=pay_mode]:checked').val() == '1' ){
            return_var = (balance_amount > customer_wallet_amount) ? false : true ;
        }
        return return_var;
    });
    
    jQuery.validator.addMethod('check_valid_deuctablePendingAmount', function (value) {
        var customer_old_deductable_wallet_amount = get_customerPenddingDeductableAmount();
        var balance_amount = ($('#hidden_balance_amount').val() !='') ?  parseInt($('#hidden_balance_amount').val()) : 0;
        var customer_wallet_amount = get_customerWalletAmount();
        var return_var = true;
        var sum_amount = parseInt(balance_amount) + parseInt(customer_old_deductable_wallet_amount);
       // alert(customer_old_deductable_wallet_amount);
        if( $('input[name=pay_mode]:checked').val() == '1' ){
            return_var = (sum_amount > customer_wallet_amount) ? false : true ;
        }
        return return_var;
    });
   
    $("form[name='Court_booking']").validate({
        // Specify validation rules
        ignore: [],
        debug: false,
        rules: {
            sports: {
                check_sports: true
            },
            location: {
                check_location: true
            },
            slot_date: {
                required: true
            },
            customer_email: {
                required: true
            },
            pay_mode: { 
                required: true,
                check_valid_walletAmount: true,
                check_valid_deuctablePendingAmount: true
            }
        },
        messages: {
            sports: {
                check_sports: "Please select sports!"
            },
            location: {
                check_location: "Please select location!"
            },
            slot_date: {
                required: "Please select date!"
            },
            customer_email: {
                required: "Please enter customer email address !"
            },
            pay_mode: { 
                required: "Please select payment mode!",
                check_valid_walletAmount: "Sorry, Insufficient wallet amount!",
                check_valid_deuctablePendingAmount: "Sorry, Customer deductable amount is still waiting for admin approval!"
            }
        }
    });
    
    
    $('.btn-cancel').click(function(e){
       clear_cart_history();
       clear_makeBooking_history();
    }); 
   
    $("#discount_amount").keyup(function(){
        $("#hidden_discount_amount").val($("#discount_amount").val());
       // discount_calc();
    });
	
	
	$('#checkout').click(function(){
		var parent_id = $('#parent_id').val();
                $.ajax({ 	
					type: "POST",   
					url: base_url+"Court_booking/check_cart_items",
					data:"parent_id="+parent_id,
					async: false,
					datatype: "html",
					success : function(data)
					{   
					
						if(data==1)
						{
							var gross_amount = $("#hidden_gross_amount").val();
							if(gross_amount > 0)
							{
								$("#hide3").show("slow");
								get_customerDetailsbyID(parent_id);
								var net_amount = $("#hidden_net_amount").val();
								var balance_amount = $("#hidden_balance_amount").val();
								$("#gross_amount").html(gross_amount+'/-');
								$("#net_amount").html(net_amount+'/-');
								$("#balance_amount").html(balance_amount+'/-');
								customer_mobile_autocomplete();
							}
						}
						else{
							 swal({
							  title: "some slot(s) removed from your cart",
							  text: "Sorry, those are booked by someone",
							  type: "warning",
							  //timer: 1000
						   });
							show_cart_list();
						}
				
					}
				});
            });
			
    
});
var id_array = [] ;

function clear_cart_history(){
    $.each( id_array, function( key, value ) {
        $.removeCookie(value);
        $('#'+value).addClass("btn-success");
        $('#'+value).removeClass("btn-primary");
    });
    id_array.splice(0, id_array.length);
    id_array.length = 0;
    while(id_array.length > 0) {        
        id_array.pop();
    }
    id_array = [] ;
    $("#example3 tbody tr").not(':last').remove(); 
    $("#hide2").hide("slow");  
}

function clear_makeBooking_history(){  
    
    var gross_amount = $("#hidden_gross_amount").val('');
    var net_amount = $("#hidden_net_amount").val('');
    var balance_amount = $("#hidden_balance_amount").val('');
    $("#gross_amount").html(gross_amount+'/-');
    $("#net_amount").html(net_amount+'/-');
    $("#balance_amount").html(balance_amount+'/-');
    $("#hidden_discount_amount").val('');
    $("#discount_amount").val('');
    $("#hidden_net_amount").val('');
    $("#hidden_balance_amount").val('');
    $('#customer_name').val('');
    $('#customer_mobile').val('');
    $('#customer_email').val('');
    $('#cus_hid').val('');
    $('#customer_wallet_amount').val('');
    $('input[name=pay_mode]').attr('checked', false);
    $("#hide3").hide("slow"); 
}

function show_booking_timeslot(){
    var sports = ( $('#sports').val() !=='' ) ? $('#sports').val() : '';
    var location = ( $('#location').val() !=='' ) ? $('#location').val() : '';
    var parent_id = ( $('#parent_id').val() !=='' ) ? $('#parent_id').val() : '';
    if(sports !='' && location !='' && parent_id !=''){
        var holidays = [];
        $.ajax({
            url:base_url+"Student_profile_slot_booking/get_holidays/",
            type:"POST",
			async: false,
            success:function(data){   
                var obj = JSON.parse(data);
				//console.log(obj);
				$.each(obj, function (key, val) {
					holidays.push(val);
				});
                holidays = obj;
            }
        });
    //console.log(holidays);
    $('#calendar').fullCalendar('destroy');
    $('#calendar').fullCalendar({
    defaultView: 'month',
    selectable: true,
        
    selectAllow: function(select) {
        return moment().diff(select.start) <= 0
    },
    events : base_url+'Court_booking/get_events/'+sports+'/'+location+'/'+parent_id,
    eventMouseover: function (data, event, view) {

                //tooltip = '<div class="tooltiptopicevent" style="width:auto;height:auto;background:#feb811;position:absolute;z-index:10001;padding:10px 10px 10px 10px ;  line-height: 200%;">' + 'Activity ' + ': ' + data.title  + '</div>';
                tooltip = '<div class="tooltiptopicevent" style="width:auto;height:auto;background:#feb811;position:absolute;z-index:10001;padding:10px 10px 10px 10px ;  line-height: 200%;">'  + data.title  + '</div>';


                $("body").append(tooltip);
                $(this).mouseover(function (e) {
                    $(this).css('z-index', 10000);
                    $('.tooltiptopicevent').fadeIn('500');
                    $('.tooltiptopicevent').fadeTo('10', 1.9);
                }).mousemove(function (e) {
                    $('.tooltiptopicevent').css('top', e.pageY + 10);
                    $('.tooltiptopicevent').css('left', e.pageX + 20);
                });


            },
            eventMouseout: function (data, event, view) {
                $(this).css('z-index', 8);

                $('.tooltiptopicevent').remove();

            },

        eventSources: [
        {
        editable:true,
        header:{
            left:'prev,next today',
            center:'title',
            right:'month,agendaWeek,agendaDay'
        },
        eventRender: function (event, element) {
            var eventDate = event.start;
            //alert(1);
            var calendarDate = $('#calendar').fullCalendar('getDate');
            //alert(eventDate.get('month'), calendarDate.get('month'));
            if (eventDate.get('month') !== calendarDate.get('month')) {
                return false;
            }
        },
        
        },
        ],
        
        dayClick: function(date, jsEvent,allDay,  view) {
        date_last_clicked = $(this);
        var today=new Date();
        if(today.getHours() != 0 && today.getMinutes() != 0 && 
            today.getSeconds() != 0 && today.getMilliseconds() != 0){
                today.setHours(0,0,0,0);
        } 
        var month = today.getMonth() + 1; //months from 1-12
        var day = today.getDate();
        var year = today.getFullYear();
        var today2 = month + "/" + day + "/" + year;
        today=new Date(today2).getTime();
        
        today = new Date().setHours(0, 0, 0, 0);
        var thatDay = new Date(date).setHours(0, 0, 0, 0);
        var thatDay3 = new Date(date);
        var month2 = thatDay3.getMonth() + 1; //months from 1-12
		if (month2 < 10){
			month2 = '0'+month2;
		}
			
        var day2 = thatDay3.getDate();
        var year2 = thatDay3.getFullYear();
        var thatDay2 = year2 + "-" + month2 + "-" + day2;
        console.log(thatDay2);
        if ($.inArray(thatDay2, holidays) != -1)
        {
            swal('Holiday');
            return false;
        }
        
        t_month =  new Date().getMonth();
        t_year =  new Date().getFullYear();
        
        d_month =  new Date(date).getMonth();
        d_year =  new Date(date).getFullYear();
        
        l_t_date = new Date();
        var lastDay = new Date(l_t_date.getFullYear(), l_t_date.getMonth() + 1, 0);
        var lastDate = lastDay.getDate();
        //alert(lastDate);
		if (date<today){
			//swal("Error! Please select valid date");
			
			day_val = $('#day_val').val();
            clickDay = date.day();
            set_form( sports, location, parent_id, clickDay, thatDay2,'not_today');
            $('#addModal').modal();
            $(this).css('background-color', '#bed7f3');
            $(this).addClass('fc_highlighted');
            var data=new Date(date).toISOString();
            var datas= moment(data).utc().format('YYYY-MM-DD');
            var datas2= moment(data).utc().format('DD/MM/YYYY');
            //document.getElementById('dates').value=datas;
            $("button.form_date").each(function(){
                $(this).attr("data-dates",datas);
            });
            document.getElementById('show_date').value=datas2;
            $('.dates').val(datas);
            $(this).css('background-color', '#bed7f3');
            //$('.daysDiv').hide();
            $('.showDays_'+clickDay).show(); 
			
        }
        
        else{
            
            if(t_year < d_year)
            {
                //swal("Warning", "Sorry, you can book only current year slot", "error");
                //return false;
            }
            else if(t_year == d_year)
            {
                /*if((t_month < d_month) && (t_month + 1 == d_month))
                {
                    if(lastDate != day || lastDate+1 != day) //only allow to book next month slots on end of the month 30 & 31 st
                    {
                        if(role !='superadmin22'){
                        swal("Warning", "Sorry, slot is not available to book.Please try to book on end of the month.", "error");
                        return false;
                        }
                    }
                }
                else
                {
                    if(t_month != d_month)
                    {
                        if(role !='superadmin22'){
                        swal("Warning", "Sorry, slot is not available to book.Please try to book on end of the current month.", "error");
                        return false;
                        }
                    }
                }*/
                
            }
            /*if(role  == 'parent')
            {
            
                if(today === thatDay){
                    swal("Access Denied", "Sorry, Parent can't book it.", "error");
                    return false;
                }
                else
                {
                day_val = $('#day_val').val();
                clickDay = date.day();
                set_form( activity_id, slot_id, coach_id, location_id, hour,  clickDay, thatDay2);
                $('#addModal').modal();
                $(this).css('background-color', '#bed7f3');
                $(this).addClass('fc_highlighted');
                var data=new Date(date).toISOString();
                var datas= moment(data).utc().format('YYYY-MM-DD');
                var datas2= moment(data).utc().format('DD/MM/YYYY');
                //document.getElementById('dates').value=datas;
                $("button.form_date").each(function(){
                    $(this).attr("data-dates",datas);
                });
                document.getElementById('show_date').value=datas2;
                $('.dates').val(datas);
                $(this).css('background-color', '#bed7f3');
                $('.daysDiv').hide();
                $('.showDays_'+clickDay).show(); 
                    
                }
                
                
            }
            else
            {*/
            day_val = $('#day_val').val();
            clickDay = date.day();
            set_form( sports, location, parent_id, clickDay, thatDay2,'today');
            $('#addModal').modal();
            $(this).css('background-color', '#bed7f3');
            $(this).addClass('fc_highlighted');
            var data=new Date(date).toISOString();
            var datas= moment(data).utc().format('YYYY-MM-DD');
            var datas2= moment(data).utc().format('DD/MM/YYYY');
            //document.getElementById('dates').value=datas;
            $("button.form_date").each(function(){
                $(this).attr("data-dates",datas);
            });
            document.getElementById('show_date').value=datas2;
            $('.dates').val(datas);
            $(this).css('background-color', '#bed7f3');
            //$('.daysDiv').hide();
            $('.showDays_'+clickDay).show(); 
            //}
        }
                
        
        },
    eventClick: function(event, jsEvent, view) {
        $('#name').val(event.title);
        $('#description').val(event.description);
        $('#start_date').val(moment(event.start).format('YYYY/MM/DD HH:mm'));
        if(event.end) {
            $('#end_date').val(moment(event.end).format('YYYY/MM/DD HH:mm'));
        } else {
            $('#end_date').val(moment(event.start).format('YYYY/MM/DD HH:mm'));
        }
        $('#event_id').val(event.id);
        $('#editModal').modal();
    },
        });
       
    }else{
        alert('Please select all the fields!');
    }

}


function set_form( activity_id, location_id, parent_id, clickDay, date, date_info)
{
    
    $.ajax({
        url:base_url+'Court_booking/set_form/',
        data:{activity_id:activity_id,location_id:location_id,clickDay:clickDay,date:date, parent_id:parent_id, date_info:date_info},
        type:"POST",
        async:false,
        success:function(data){   
        $('#slotSelection').html(data);
        //document.getElementById('slotSelection tbody').innerHTML=data;
        
        $('.view-booked-timeslot').click(function(e){
            //alert(1);  
            var booked_slotid = $(this).attr('data-id');
            view_modal_popup(booked_slotid);
        });

        }
    });

}

function show_booking_timeslot_old(){
    var sports = ( $('#sports').val() !=='' ) ? $('#sports').val() : '';
    var location = ( $('#location').val() !=='' ) ? $('#location').val() : '';
    var date = ( $('#datepicker').val() !=='' ) ? $('#datepicker').val() : '';
    if(sports !='' && location !='' && date !=''){
      //  clear_cart_history();
        $.ajax({ 	
            type: "POST",   
            url: base_url+"Court_booking/show_booking_timeslot",
            data:"sid="+sports+"&lid="+location+"&date="+date,
            //data:"sid="+sports+"&lid="+location,
            async: false,
            datatype: "html",
            success : function(data)
            {   
                //console.log(data);
                if( data !=''){
                    $("#hide1").show("slow");
                    $("#example2 tbody").html(data);
                    $('.booking-timeslot').click(function(e){
                        $(this).removeClass("btn-success");
                        $(this).addClass("btn-primary");
                        var price_time_slot_id = $(this).attr('data-id');
                        var arraykey = $(this).attr('data-arraykey');
                        var fromtime = $(this).attr('data-fromtime');
                        var totime = $(this).attr('data-totime');
                        var btnid = $(this).attr('id');
                        $("#hide2").show("slow");
                        show_booking_cart_details(price_time_slot_id, arraykey, fromtime, totime, date, btnid);
                    });
                    $('.view-booked-timeslot').click(function(e){
                        var booked_slotid = $(this).attr('data-id');                   
                        view_modal_popup(booked_slotid);
                    });
                }else{
                    alert('No record found for this selected sports and location!');
                }
            },
            fail: function( jqXHR, textStatus, errorThrown ) {
                    console.log( 'Could not get posts, server response: ' + textStatus + ': ' + errorThrown );
            }
        });
    }else{
        alert('Please select all the fields first!');
    }

}

function show_booking_cart_details(id, arraykey, fromtime, totime, date, btnid){    

   if($.inArray(arraykey, id_array) > -1)
   {
       alert('Sorry already you booked for this time slot!');
   }
   else
   {
    id_array.push(arraykey);   
    $.ajax({ 	
        type: "POST",   
        url: base_url+"Court_booking/show_timeslot_details",
        data:"id="+id+"&fromtime="+fromtime+"&totime="+totime+"&date="+date+"&btnid="+btnid,
        async: false,
        datatype: "html",
        success : function(data)
        {   
            //console.log(data);            
            $("#example3 tbody tr:last").before(data); 
            total_price_cost();
            selected_slot_ids(id_array);
            $.cookie(arraykey, 1);
            //console.log(arraykey);
            $("#hidden_slot_ids").val(id_array.join(","));
            $('.rmve_btn').click(function(e){
                $(this).closest('tr').remove(); 
                 
                 var btn_id = $(this).attr('data-btnid');
                 //alert(btn_id);
                 $('#'+btn_id).addClass("btn-success");
                 $('#'+btn_id).removeClass("btn-primary");
                id_array = jQuery.grep(id_array, function(value) {
                    $.removeCookie(btn_id);
                    return value != btn_id;                    
                }); 
                if(id_array.length > 0){
                    //$('#checkout').show();
                   // $('#hide3').show(); 
                   // $('#hide2').show();
                }else{
                   // $('#checkout').hide();
                    $('#hide3').hide('slow');
                    $('#hide2').hide('slow');
                }
                get_customerDetailsbyID(parent_id);
                total_price_cost();
                selected_slot_ids(id_array);                
            });
            
        },
        fail: function( jqXHR, textStatus, errorThrown ) {
                console.log( 'Could not get posts, server response: ' + textStatus + ': ' + errorThrown );
        }
    });
   }

}

function customer_mobile_autocomplete(){
    
    $('#customer_email').autocomplete({
        select: function(event, ui) {
            //$('#scan_order').prop('disabled', false);
            var customer_email = ui.item.value;
            get_customerDetails(customer_email);
        },
        source: function( request, response ) {
            $.ajax({
                type: "POST",
                url : base_url+"prepaid_credits_booking/get_customer_email",
                dataType: "json",
                data: {
                    customer_email: request.term
                },
                success: function( data ) {
                        response( $.map( data, function(item ) {
                            return {
                                label: item.email,
                                value: item.email
                            }
                        }));
                    
                },
                fail: function( jqXHR, textStatus, errorThrown ) {
                    //alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                    $('#customer_name').val('');
                    $('#customer_mobile').val('');
                    $('#customer_wallet_amount').val('');
                }  
            });

        },
        autoFocus: true,
        minLength: 2,
    });
}

function get_customerDetails(customer_email){
    //var mob_no = $("#customer_mobile").val();
	//alert(1);
    $.ajax({ 	
        type: "POST",   
        url: base_url+"prepaid_credits_booking/get_customer_details",
		data:{
			email:customer_email
			},
       // data:"mob_no="+customer_mobile,		
        async: false,
        datatype: "json",
        success : function(data)
        {
            //console.log(data);
            var obj = JSON.parse(data);
            $('#customer_name').val(obj.parent_name);
            $('#customer_mobile').val(obj.mobile_no);
            $('#cus_hid').val(obj.parent_id);
            //var wallet_amount = parseInt(obj.amount);       
            $('#customer_wallet_amount').val(obj.balance_credits);

        },
        fail: function( jqXHR, textStatus, errorThrown ) {
                console.log( 'Could not get posts, server response: ' + textStatus + ': ' + errorThrown );
        }
    }); 
}

function get_customerDetailsbyID(parent_id){
    //var mob_no = $("#customer_mobile").val();
	//alert(1);
    $.ajax({ 	
        type: "POST",   
        url: base_url+"prepaid_credits_booking/get_customer_details_by_id",
		data:{
			id:parent_id
			},
       // data:"mob_no="+customer_mobile,		
        async: false,
        datatype: "json",
        success : function(data)
        {
            //console.log(data);
            var obj = JSON.parse(data);
            $('#customer_email').val(obj.email_id);
            $('#customer_name').val(obj.parent_name);
            $('#customer_mobile').val(obj.mobile_no);
            $('#cus_hid').val(obj.parent_id);
            //var wallet_amount = parseInt(obj.amount);       
            $('#customer_wallet_amount').val(obj.balance_credits);

        },
        fail: function( jqXHR, textStatus, errorThrown ) {
                console.log( 'Could not get posts, server response: ' + textStatus + ': ' + errorThrown );
        }
    }); 
}

function get_customerWalletAmount(){
    //alert(2);
    var email = $("#customer_email").val();
    var walletAmount;
    $.ajax({ 	
        type: "POST",   
        url: base_url+"prepaid_credits_booking/get_customer_details",
		data:{
			email:email
			},
        //data:"mob_no="+mob_no,		
        async: false,
        datatype: "json",
        success : function(data)
        {
            var obj = JSON.parse(data);
            walletAmount = obj.balance_credits;
            console.log(walletAmount);

        },
        fail: function( jqXHR, textStatus, errorThrown ) {
                console.log( 'Could not get posts, server response: ' + textStatus + ': ' + errorThrown );
        }
    }); 
    return walletAmount;
}

function get_customerPenddingDeductableAmount(){
    var email = $("#customer_email").val();
    var pennding_deductable_amount = 0;
    $.ajax({ 	
        type: "POST",   
        url: base_url+"Court_booking/get_customerPendingDeductableAmount",
		data:{
			email:email
			},
        //data:"mob_no="+mob_no,		
        async: false,
        datatype: "json",
        success : function(data)
        {
            var obj = JSON.parse(data);
            pennding_deductable_amount = obj.total_deductable_amount;
            //console.log(walletAmount);

        },
        fail: function( jqXHR, textStatus, errorThrown ) {
                console.log( 'Could not get posts, server response: ' + textStatus + ': ' + errorThrown );
        }
    }); 
    return pennding_deductable_amount;
}

function discount_calc(){
    var gross_amount = ($('#hidden_gross_amount').val() !='') ? parseFloat($('#hidden_gross_amount').val()) : 0;
    var discount_amount = ($('#discount_amount').val() !='') ? parseFloat($('#discount_amount').val()) : 0;
    var net_amount = 0;
    //if(discount_amount > 0){        
        if(discount_amount < gross_amount){
            net_amount2 = gross_amount - discount_amount;
        }else{
            alert('Discount amount should be lesser than gross amount!');
             $("#hidden_discount_amount").val('');
             $("#discount_amount").val('');
             net_amount2 = gross_amount;
        }

        vat_amount = (parseFloat(net_amount2)*5/100).toFixed(2);
        net_amount = parseFloat(net_amount2)+parseFloat(vat_amount);
        $("#hidden_vat_amount").val(vat_amount);
        $("#hidden_vat_perc").val(5.00);
        $("#hidden_discount_amount").val(discount_amount);
        $("#hidden_net_amount").val(net_amount);
        $("#net_amount").html(net_amount+'/-');
        $("#hidden_balance_amount").val(net_amount);
        $("#balance_amount").html(net_amount+'/-');
        $("#vat_amount").html(vat_amount+'/-');
        
    //}
}


function wallet_calc(){
    //get_customerWalletAmount();
    var net_amount = ($('#hidden_net_amount').val() !='') ? parseFloat($('#hidden_net_amount').val()) : 0 ;
    var customer_wallet_amount = ($('#customer_wallet_amount').val() !='') ? parseFloat($('#customer_wallet_amount').val()) : 0 ; 
    if( $('input[name=pay_mode]:checked').val() == '1' ){
        if($("#cus_hid").val() !=''){
            var amount_need_to_update = get_customerWalletAmount();
            if(customer_wallet_amount !=''){
                //alert(balance_amount+' '+customer_wallet_amount);
                if(net_amount <= customer_wallet_amount){
                    amount_need_to_update = get_customerWalletAmount() - net_amount;
                    
                }else{
                    alert('Insufficient wallet amount!');
                    $('input[name=pay_mode]').attr('checked', false);
                }
                $("#customer_wallet_amount").val(amount_need_to_update);
            }
        }
        else{
            alert('Please enter valid email first!');
            $('input[name=pay_mode]').attr('checked', false);
        }
    }
    else{
        if($("#customer_wallet_amount").val()!=''){
            var amount_need_to_update = get_customerWalletAmount();
            $("#customer_wallet_amount").val(amount_need_to_update);
        }else{
            $("#customer_wallet_amount").val(''); 
        }
    }
}


function total_price_cost(){    
    var sum = 0;
    $('.hidden_price').each(function() {
        sum += Number($(this).val());
    });
    $("#hidden_total_price").val(sum);
    $("#total_price strong").html(sum);
    $("#hidden_gross_amount").val(sum);

    vat_amount = (parseFloat(sum)*5/100).toFixed(2);
    net_amount = parseFloat(sum)+parseFloat(vat_amount);
    $("#hidden_vat_amount").val(vat_amount);
    $("#vat_amount").html(vat_amount+'/-');

    $("#hidden_net_amount").val(net_amount);  
    $("#hidden_vat_perc").val(5.00);  
    $("#hidden_balance_amount").val(net_amount);
    $("#gross_amount").html(sum+'/-');
    $("#net_amount").html(net_amount+'/-');
    $("#balance_amount").html(net_amount+'/-');
    $('#customer_name').val('');
    $('#customer_mobile').val('');
    $('#customer_email').val('');
    $('#cus_hid').val('');
    $('#customer_wallet_amount').val('');
    $('input[name=pay_mode]').attr('checked', false);
    

    
}

function selected_slot_ids(){    
//    var ids = $("input.hidden_btnids").map(function() {
//        return this.value;
//    }).get().join(",");
//    $("#hidden_slot_ids").val(ids);
    $("#hidden_slot_ids").val(id_array.join(","));
}

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


function view_modal_popup(booked_slotid){
    
    $.ajax({ 	
        type: "POST",   
        url: base_url+"Court_booking/get_bookedslot_details",
        data:"booked_slotid="+booked_slotid,		
        async: false,
        datatype: "html",
        success : function(data)
        {
            $("#viewModal").html(data);
            $('.booking-cancel').click(function(e){
                var customer_id = $("#customer_id").val();
                var paid_amount =  $("#paid_amount").val();
                var booking_id =  $("#booking_id").val();bookingslot_id
                var bookingslot_id =  $("#bookingslot_id").val();
                var remarks =  $("#remarks").val();
                cancel_booking(customer_id,paid_amount,booking_id, bookingslot_id, remarks);
            });
            $('#sbt_btn').click(function(e){                 
                $("form[name='update_booking_form']").submit();                
            });
            
        },
        fail: function( jqXHR, textStatus, errorThrown ) {
                console.log( 'Could not get posts, server response: ' + textStatus + ': ' + errorThrown );
        }
    });     
    //$("#viewModal").html(output);
}

function cancel_booking(customer_id,paid_amount,booking_id, bookingslot_id, remarks=''){
    //alert('test1');
    if(confirm('Are you sure!,Do you want to cancel booking?')) {
    $.ajax({ 	
        type: "POST",   
        url: base_url+"Court_booking/cancel_booking",
        data:"customer_id="+customer_id+"&booking_id="+booking_id+"&bookingslot_id="+bookingslot_id+"&paid_amount="+paid_amount+"&remarks="+remarks,		
        async: false,
        datatype: "html",
        success : function(data)
        {
            $('#viewModal').modal('hide');
            location.reload(true);
        },
        fail: function( jqXHR, textStatus, errorThrown ) {
                console.log( 'Could not get posts, server response: ' + textStatus + ': ' + errorThrown );
        }
    });   
    }
    else{
        return false;
    }
    //$("#viewModal").html(output);
}

function getLocationNames(){
    var selectedSports = $("#sports").val();
    if(selectedSports !='')
    {
        //alert(selectedSports+' '+selectedLocation);
        $.ajax({
            type: "POST",
            url: base_url+"Court_booking/get_locationnames",
            data: { sports_id : selectedSports} 
        }).done(function(data){
            $("#location").html(data);
        });
    }else{
        $("#location").children('option:not(:first)').remove();
    }
}

function addSlot(this_){
    
    
    var activity_id = $(this_).attr('data-activity_id'); 
    var location_id = $(this_).attr('data-location_id'); 
    var parent_id = $(this_).attr('data-parent_id'); 
    var court_id = $(this_).attr('data-court_id'); 
    var slot_to_time = $(this_).attr('data-totime'); 
    var slot_from_time = $(this_).attr('data-fromtime'); 
    var dates = $(this_).attr('data-date');
    var today = $(this_) .attr('data-today');	
    
    
    jQuery.ajax({
        type:'POST',
        url:baseurl+'Court_booking/add_slot_booking',
        data:{
            activity_id:activity_id,
            location_id:location_id,
            parent_id:parent_id,
            court_id:court_id,
            slot_from_time:slot_from_time,
            slot_to_time:slot_to_time,
            dates:dates,
			today:today
        },
        dataType:'json',                       
        success: function (result) {
          if(result['status'] == 'success'){
            $('#cart_slot').val(result['count'])
                $('.cart_slot').html(result['count'])
                //$('.close').click()
                
                swal({
                  title: "Added to Cart!",
                  text: "",
                  type: "success",
                  timer: 1000
               });
               $('.refresh_btn').trigger("onclick"); 
                $('#calendar').fullCalendar('refetchEvents');

          }else{
            //location.reload();
			
			swal({
                  title: result['message'],
                  text: "",
                  type: "warning",
                  //timer: 1000
               });
            $('.refresh_btn').trigger("onclick");  
			$('#calendar').fullCalendar('refetchEvents');
            
          }
        }, 
               
    });
}

function show_cart_list(){
    var parent_id = $('#parent_id').val();
    $.ajax({ 	
        type: "POST",   
        url: base_url+"Court_booking/show_timeslot_details",
        data:"parent_id="+parent_id,
        async: false,
        datatype: "html",
        success : function(data)
        {   
            //console.log(data);            
            $("#example3 tbody").html(data); 
            total_price_cost();
            $('.rmve_btn').click(function(e){
                $(this).closest('tr').remove(); 
                 
                var id = $(this).attr('data-id');
                remove_cart_item(id); 
                
                total_price_cost();
                //alert(9);
                get_customerDetailsbyID(parent_id);
                //selected_slot_ids(id_array);                
            });
            
        },
        fail: function( jqXHR, textStatus, errorThrown ) {
                console.log( 'Could not get posts, server response: ' + textStatus + ': ' + errorThrown );
        }
    });
}

function remove_cart_item(id)
{
    $.ajax({ 	
        type: "POST",   
        url: base_url+"Court_booking/remove_cart_item",
        data:"id="+id,
        async: false,
        datatype: "html",
        success : function(data)
        {   

        }
    });
}