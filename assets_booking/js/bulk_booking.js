jQuery(document).ready(function(){    
    //$('[data-toggle="tooltip"]').tooltip();
    jQuery(document).on('click','#check', function(e){
        show_bulkBooking_details();
    });
    numeric_input();     
    
    $('#timepicker1').timepicker();
    $('#timepicker2').timepicker();
    
    $('#from_date_bulk').datepicker({
    format: "dd-mm-yyyy", 
    showClear: true,
    autoclose: true,
    todayHighlight: true,
    startDate: '-0d',
    endDate: '+90d'	
    }).on("changeDate", function (e) {	
            datetimepicker();		
            $('#from_date_bulk').valid();		
    });

    $('#to_date_bulk').datepicker({
    format: "dd-mm-yyyy", 
    showClear: true,
    autoclose: true,
    todayHighlight: true,
    startDate: '-0d',
    endDate: '+90d'
    }).on("changeDate", function (e) {	
            if($('#from_date_bulk').val() !=''){
            datetimepicker();		
            }
            $('#to_date_bulk').valid();		
    });
    
    customer_mobile_autocomplete();
    
    $("#sports").change(function(){
        getLocationNames();
        get_courtnames();
        form_reset();
    });
    
    $("#location").change(function(){
        get_courtnames();
        form_reset();
    }); 
    
    $("#court").change(function(){
        form_reset();
    });
    
    jQuery(document).on('click','.check_availability', function(e){
        check_availability_timeslot();
    });
    
    $('#discount_btn').click(function(e){
        discount_calc();
        wallet_calc();
    });
    
    $("input[name=pay_mode]").click(function(){
      if($('#hidden_net_amount').val() !=''){
        wallet_calc();
      }else{
          alert('Please click the check availability button first');
          $('.check_availability').focus();
          return false;
      }
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
    
    jQuery.validator.addMethod('check_day_name', function (value) {
        var day_name = $('#day_name').val();
        var return_var = (day_name == '') ? false : true ;			
        return return_var;
    });
    
    jQuery.validator.addMethod('check_availability_slot', function (value) {
        var hidden_form_submit_permission = $('#hidden_form_submit_permission').val();
        var gross_amount = $('#hidden_gross_amount').val();
        var return_var = true;
        if(hidden_form_submit_permission == '1'){
            return_var = (gross_amount == '') ? false : true ;		
        }
        return return_var;
    });
        
    jQuery.validator.addMethod('check_valid_walletAmount', function (value) {
        //var customer_old_deductable_wallet_amount = get_customerPenddingDeductableAmount();
        var balance_amount = ($('#hidden_balance_amount').val() !='') ?  parseInt($('#hidden_balance_amount').val()) : 0;
        var customer_wallet_amount = get_customerWalletAmount();
        var return_var = true;
      //  var sum_amount = parseInt(balance_amount) + parseInt(customer_old_deductable_wallet_amount);
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
       
   
   $("form[name='bulk_booking']").validate({
        // Specify validation rules
        ignore: [],
        debug: false,
        rules: {
            sports: {
                check_sports: true,
                check_availability_slot: true
            },
            location: {
                check_location: true
            },
            court: {
                check_court: true
            },
            from_date_bulk: {
                required: true
            },
            to_date_bulk: {
                required: true
            },
            day_name: {
                check_day_name: true
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
                check_sports: "Please select sports!",
                check_availability_slot: "Please check available slot and then proceed!"
            },
            location: {
                check_location: "Please select location!"
            },
            court: {
                check_court: "Please select court!"
            },
            from_date_bulk: {
                required: "Please select from date!"
            },
            to_date_bulk: {
                required: "Please select to date!"
            },
            day_name: {
                check_day_name: "Please select day!"
            },
            customer_email: {
                required: "Please enter customer email address!"
            },
            pay_mode: { 
                required: "Please select payment mode!",
                check_valid_walletAmount: "Sorry, Insufficient wallet amount!",
                check_valid_deuctablePendingAmount: "Sorry, Customer deductable amount is still waiting for admin approval!"
            }
        }
    });
    
    $('.booking-cancel').click(function(e){
        var customer_id = $(this).attr('data-custid');
        var paid_amount =  $(this).attr('data-paidamount');
        var booking_id =  $(this).attr('data-id');
        //alert(customer_id+','+paid_amount+','+booking_id);
        cancel_booking(customer_id,paid_amount,booking_id);
    });
    
    $("#discount_amount").keyup(function(){
        $("#hidden_discount_amount").val($("#discount_amount").val());
        $("#hidden_net_amount").val($("#hidden_gross_amount").val());
        $("#net_amount").html($("#hidden_gross_amount").val()+'/-');
        $("#hidden_balance_amount").val($("#hidden_gross_amount").val());
        $("#balance_amount").html($("#hidden_gross_amount").val()+'/-');
       // discount_calc();
    });
    
});

function form_reset(){   
   // $('#hidden_form_submit_permission').val(0);
    $('.slot-count').html('');
    $('#gross_amount').html('');
    $('#net_amount').html('');
    $('#balance_amount').html('');
    $('#hidden_gross_amount').val('');
    $('#hidden_net_amount').val('');
    $('#hidden_balance_amount').val('');
    $('#discount_amount').val('');
    $('#hidden_discount_amount').val('');
    var amount_need_to_update = get_customerWalletAmount();
    $('#customer_wallet_amount').val(amount_need_to_update); 
}


function show_bulkBooking_details(){

    //alert(selectedSports+' '+selectedLocation);
    $.ajax({
        type: "POST",
        url: base_url+"bulk_booking/get_bulkBooking_list",
        //data: { sports_id : selectedSports, location_id : selectedLocation } ,
        datatype: "html",
    }).done(function(data){
        $("#bulk_booking_list tbody").html(data);
        $('.booking-cancel').click(function(e){
            var customer_id = $(this).attr('data-custid');
            var paid_amount =  $(this).attr('data-paidamount');
            var booking_id =  $(this).attr('data-id');
            //alert(customer_id+','+paid_amount+','+booking_id);
            cancel_booking(customer_id,paid_amount,booking_id);
        });
    });
   
}

function get_courtnames(){
    var selectedSports = $("#sports").val();
    var selectedLocation = $("#location").val();
    if(selectedSports !='' && selectedLocation !='')
    {
        //alert(selectedSports+' '+selectedLocation);
        $.ajax({
            type: "POST",
            url: base_url+"pricing/get_courtnames",
            data: { sports_id : selectedSports, location_id : selectedLocation } 
        }).done(function(data){
            $("#court").html(data);
        });
    }else{
        $("#court").children('option:not(:first)').remove();
    }
}

function check_availability_timeslot(){
    var sports = ( $('#sports').val() !=='' ) ? $('#sports').val() : '';
    var location = ( $('#location').val() !=='' ) ? $('#location').val() : '';
    var court = ( $('#court').val() !=='' ) ? $('#court').val() : '';
    var from_date = ( $('#from_date_bulk').val() !=='' ) ? $('#from_date_bulk').val() : '';
    var to_date = ( $('#to_date_bulk').val() !=='' ) ? $('#to_date_bulk').val() : '';
    var from_time = ( $('#timepicker1').val() !=='' ) ? $('#timepicker1').val() : '';
    var to_time = ( $('#timepicker2').val() !=='' ) ? $('#timepicker2').val() : '';
    var day_name = ( $('#day_name').val() !=='' ) ? $('#day_name').val() : '';
    if(sports !='' && location !='' && from_date !='' && to_date !=''){
        //clear_cart_history();
        $.ajax({ 	
            type: "POST",   
            url: base_url+"bulk_booking/check_availability_timeslot",
            data:"sid="+sports+"&lid="+location+"&cid="+court+"&from_date="+from_date+"&to_date="+to_date+"&from_time="+from_time+"&to_time="+to_time+"&day_name="+day_name,
            //data:"sid="+sports+"&lid="+location,
            async: false,
            datatype: "json",
            success : function(data)
            {   
                //console.log(data);
                var obj = JSON.parse(data);
                //alert((obj.data.price));
                if(obj.msg == '1'){
                    var slot_count_display = parseInt(obj.data[0].day_count) * parseInt(obj.data[0].slot_count);
                $('.slot-count').html('<strong>'+obj.data[0].day_count_display+', '+slot_count_display+' Slots</strong>');
                //var slot_price = parseInt(obj.data.day_count) * parseInt(obj.data.slot_price);
                var slot_price = parseInt(obj.data.price);
                $('#gross_amount').html(slot_price+' /-');
                $('#net_amount').html(slot_price+' /-');
                $('#balance_amount').html(slot_price+' /-');
                $('#hidden_gross_amount').val(slot_price);
                $('#hidden_net_amount').val(slot_price);
                $('#hidden_balance_amount').val(slot_price);
                $('#customer_name').val('');
                $('#customer_mobile').val('');
                $('#customer_email').val('');
                $('#cus_hid').val('');
                $('#customer_wallet_amount').val('');
                $('input[name=pay_mode]').attr('checked', false);
                //console.log(obj);
                }else{
                    $('.slot-count').html('<strong>Sorry, Slots not available!</strong>');
                }
                $('#hidden_form_submit_permission').val(obj.msg);
            },
            fail: function( jqXHR, textStatus, errorThrown ) {
                    console.log( 'Could not get posts, server response: ' + textStatus + ': ' + errorThrown );
            }
        });
    }else{
        alert('Before check availability, please select all the fields first!');
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
   // if(discount_amount !=''){        
        if(discount_amount < gross_amount){
            net_amount = gross_amount - discount_amount;
        }else{
            alert('Discount amount should be lesser than gross amount!');
             $("#hidden_discount_amount").val('');
              $("#discount_amount").val('');
        }
        $("#hidden_discount_amount").val(discount_amount);
        $("#hidden_net_amount").val(net_amount);
        $("#net_amount").html(net_amount+'/-');
        $("#hidden_balance_amount").val(net_amount);
        $("#balance_amount").html(net_amount+'/-');
   // }
}

function wallet_calc(){
    //get_customerWalletAmount();
    var net_amount = ($('#hidden_net_amount').val() !='') ? parseInt($('#hidden_net_amount').val()) : 0 ;
    var customer_wallet_amount = ($('#customer_wallet_amount').val() !='') ? parseInt($('#customer_wallet_amount').val()) : 0 ;
    if( $('input[name=pay_mode]:checked').val() == '1' ){
        if($("#cus_hid").val() !=''){
            var amount_need_to_update = get_customerWalletAmount();
            if(customer_wallet_amount !=''){
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
    }else{
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

function datetimepicker()
{
    var startdate = $('#from_date_bulk').val();
    var enddate = $('#to_date_bulk').val();
    var new_date = add_day(startdate);
    $("#from_date_bulk").datepicker('setEndDate', enddate);
    $("#to_date_bulk").datepicker('setStartDate', new_date);
}

function add_day(date)
{
	var dmy = date.split("-");        
	var joindate = new Date(
	parseInt(dmy[2], 10),
	parseInt(dmy[1], 10) - 1,
	parseInt(dmy[0], 10)
	);
	//alert(joindate);                          
	joindate.setDate(joindate.getDate() + 1);
	//alert(joindate);                          
	var return_date = ("0" + joindate.getDate()).slice(-2) + "-" + ("0" + (joindate.getMonth() + 1)).slice(-2) + "-" +
	joindate.getFullYear();
	return return_date;
}

function cancel_booking(customer_id,paid_amount,booking_id){
    if(confirm('Are you sure!,Do you want to cancel booking?')) {
    $.ajax({ 	
        type: "POST",   
        url: base_url+"regular_booking/cancel_booking",
        data:"customer_id="+customer_id+"&booking_id="+booking_id+"&paid_amount="+paid_amount,		
        async: false,
        datatype: "html",
        success : function(data)
        {
            //alert('test2');
            show_bulkBooking_details();
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
            url: base_url+"bulk_booking/get_locationnames",
            data: { sports_id : selectedSports} 
        }).done(function(data){
            $("#location").html(data);
        });
    }else{
        $("#location").children('option:not(:first)').remove();
    }
}

