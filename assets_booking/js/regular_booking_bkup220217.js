jQuery(document).ready(function(){    
    //$('[data-toggle="tooltip"]').tooltip();
    jQuery(document).on('click','#slots', function(e){
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
    startDate: '-0d',
    endDate: '+90d'
    }).on("changeDate", function (e) {
        $('.date-picker').valid();
    });
    
    $('.booking-timeslot').click(function(e){
        var price_time_slot_id = $(this).attr('data-id');
        $("#hide2").show("slow");
        show_booking_cart_details(price_time_slot_id);
    });
    
    $('.view-booked-timeslot').click(function(e){
        var booked_slotid = $(this).attr('data-id');
        var fromtime = $(this).attr('data-fromtime');
        var totime = $(this).attr('data-totime');                        
        view_modal_popup(booked_slotid, fromtime, totime);
    });
    
    customer_mobile_autocomplete();
    
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
   
    $("form[name='regular_booking']").validate({
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
    
});
var id_array = [] ;

function clear_cart_history(){
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
    var date = ( $('#datepicker').val() !=='' ) ? $('#datepicker').val() : '';
    if(sports !='' && location !='' && date !=''){
        clear_cart_history();
        $.ajax({ 	
            type: "POST",   
            url: base_url+"regular_booking/show_booking_timeslot",
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
                        var price_time_slot_id = $(this).attr('data-id');
                        var arraykey = $(this).attr('data-arraykey');
                        var fromtime = $(this).attr('data-fromtime');
                        var totime = $(this).attr('data-totime');
                        $("#hide2").show("slow");
                        show_booking_cart_details(price_time_slot_id, arraykey, fromtime, totime, date );
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

function show_booking_cart_details(id, arraykey, fromtime, totime, date){    

   if($.inArray(arraykey, id_array) > -1)
   {
       alert('Sorry already you booked for this time slot!');
   }
   else
   {
    id_array.push(arraykey);   
    $.ajax({ 	
        type: "POST",   
        url: base_url+"regular_booking/show_timeslot_details",
        data:"id="+id+"&fromtime="+fromtime+"&totime="+totime+"&date="+date,
        async: false,
        datatype: "html",
        success : function(data)
        {   
            //console.log(data);            
            $("#example3 tbody tr:last").before(data); 
            total_price_cost();
            selected_slot_ids();
            $("#hidden_slot_id").val(id_array.join(","));
            $('.rmve_btn').click(function(e){
                $(this).closest('tr').remove();
                id_array = jQuery.grep(id_array, function(value) {
                    return value != arraykey;
                }); 
                if(id_array.length > 0){
                    //$('#checkout').show();
                    $('#hide3').show(); 
                    $('#hide2').show();
                }else{
                   // $('#checkout').hide();
                    $('#hide3').hide('slow');
                    $('#hide2').hide('slow');
                }
                total_price_cost();
                selected_slot_ids();
            });
            $('#checkout').click(function(){
                $("#hide3").show("slow");
                var gross_amount = $("#hidden_gross_amount").val();
                var net_amount = $("#hidden_net_amount").val();
                var balance_amount = $("#hidden_balance_amount").val();
                $("#gross_amount").html(gross_amount+'/-');
                $("#net_amount").html(net_amount+'/-');
                $("#balance_amount").html(balance_amount+'/-');
                customer_mobile_autocomplete();
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
                url : base_url+"prepaid_credits/get_customer_email",
                dataType: "json",
                data: {
                    customer_mobile: request.term
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
	
    $.ajax({ 	
        type: "POST",   
        url: base_url+"prepaid_credits/get_customer_details",
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
            $('#customer_name').val(obj.name);
            $('#customer_mobile').val(obj.mobile);
            $('#cus_hid').val(obj.custid);
            //var wallet_amount = parseInt(obj.amount);       
            $('#customer_wallet_amount').val(obj.amount);

        },
        fail: function( jqXHR, textStatus, errorThrown ) {
                console.log( 'Could not get posts, server response: ' + textStatus + ': ' + errorThrown );
        }
    }); 
}

function get_customerWalletAmount(){
    var email = $("#customer_email").val();
    var walletAmount;
    $.ajax({ 	
        type: "POST",   
        url: base_url+"prepaid_credits/get_customer_details",
		data:{
			email:email
			},
        //data:"mob_no="+mob_no,		
        async: false,
        datatype: "json",
        success : function(data)
        {
            var obj = JSON.parse(data);
            walletAmount = obj.amount;
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
        url: base_url+"regular_booking/get_customerPendingDeductableAmount",
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
    var gross_amount = ($('#hidden_gross_amount').val() !='') ? parseInt($('#hidden_gross_amount').val()) : 0;
    var discount_amount = ($('#discount_amount').val() !='') ? parseInt($('#discount_amount').val()) : 0;
    var net_amount = 0;
    //if(discount_amount > 0){        
        if(discount_amount < gross_amount){
            net_amount = gross_amount - discount_amount;
        }else{
            alert('Discount amount should be lesser than gross amount!');
             $("#hidden_discount_amount").val('');
             $("#discount_amount").val('');
             net_amount = gross_amount;
        }
        $("#hidden_discount_amount").val(discount_amount);
        $("#hidden_net_amount").val(net_amount);
        $("#net_amount").html(net_amount+'/-');
        $("#hidden_balance_amount").val(net_amount);
        $("#balance_amount").html(net_amount+'/-');
    //}
}


function wallet_calc(){
    //get_customerWalletAmount();
    var net_amount = ($('#hidden_net_amount').val() !='') ? parseInt($('#hidden_net_amount').val()) : 0 ;
    var customer_wallet_amount = ($('#customer_wallet_amount').val() !='') ? parseInt($('#customer_wallet_amount').val()) : 0 ; 
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
    $("#hidden_net_amount").val(sum);  
    $("#hidden_balance_amount").val(sum);
    $("#gross_amount").html(sum+'/-');
    $("#net_amount").html(sum+'/-');
    $("#balance_amount").html(sum+'/-');
    $('#customer_name').val('');
    $('#customer_mobile').val('');
    $('#customer_email').val('');
    $('#cus_hid').val('');
    $('#customer_wallet_amount').val('');
    $('input[name=pay_mode]').attr('checked', false);
    
}

function selected_slot_ids(){    
    var ids = $("input.hidden_id").map(function() {
        return this.value;
    }).get().join(",");
    $("#hidden_slot_ids").val(ids);
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
        url: base_url+"regular_booking/get_bookedslot_details",
        data:"booked_slotid="+booked_slotid,		
        async: false,
        datatype: "html",
        success : function(data)
        {
            $("#viewModal").html(data);
            $('.booking-cancel').click(function(e){
                var customer_id = $("#customer_id").val();
                var paid_amount =  $("#paid_amount").val();
                var booking_id =  $("#booking_id").val();
                cancel_booking(customer_id,paid_amount,booking_id);
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

function cancel_booking(customer_id,paid_amount,booking_id){
    //alert('test1');
    if(confirm('Are you sure!,Do you want to cancel booking?')) {
    $.ajax({ 	
        type: "POST",   
        url: base_url+"regular_booking/cancel_booking",
        data:"customer_id="+customer_id+"&booking_id="+booking_id+"&paid_amount="+paid_amount,		
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
            url: base_url+"regular_booking/get_locationnames",
            data: { sports_id : selectedSports} 
        }).done(function(data){
            $("#location").html(data);
        });
    }else{
        $("#location").children('option:not(:first)').remove();
    }
}