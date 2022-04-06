jQuery(document).on('click', '#preview_transaction_popup', function(){
      jQuery.ajax({
        type:'POST',
        url:baseurl+'index.php/Daily_transaction/save',
        data:jQuery("form#daily_transaction").serialize(),
        dataType:'json',                       
        success: function (result) {
            $('.text-danger').remove();
            if (result['error']) {
                for (i in result['error']) {
                    //var element = $('.input-school-' + i.replace('_', '-'));
                    var element = $('.input-transaction-' + i);
                    if ($(element).parent().hasClass('input-group')) {                       
                        $(element).parent().after('<div class="text-danger left_align" style="font-size: 14px;">' + result['error'][i] + '</div>');
                    } else {
                        $(element).after('<div class="text-danger left_align" style="font-size: 14px;">' + result['error'][i] + '</div>');
                    }
                }
            } else if (result['status']){
                jQuery('#preview_transaction').modal('show');
                jQuery('.preview_transaction.fade').addClass('show');
                jQuery('.modal-backdrop').addClass('show');
                jQuery('.previewDiv').css('display','block');
                jQuery('.InlineEditDiv').css('display','none');

                
                var inputs = $('#daily_transaction').serializeArray();
                jQuery.each(inputs, function (i, input) {
                    var field = $('.input-preview-'+input.name)
                    //jQuery(field).html(input.value);
                    var selectedval = input.value;
                    var dropdownfield = ['account_code','transaction_type','activity_id','location_id','coach_id','approved_by','settled_by','paid_to','bank'];
                    if(jQuery.inArray( input.name, dropdownfield ) != -1){
                        var selectedval = jQuery('#'+input.name).children("option:selected").text();
                    }
                    if(selectedval == 'Select'){
                        jQuery(field).html('');
                    }else{
                    jQuery(field).html(selectedval);
                    }
                    if(input.name == 'payment_type' && input.value != 'Cheque' ){
                        $('.input-preview-cheque_number').html('');
                        $('.input-preview-cheque_date').html('');
                    }
                    if(input.name == 'payment_type' && input.value == 'Cash' ){
                        $('.input-preview-bank').html('');
                    }
                });
                $('#is_submit').val('0');
            }

        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        } 
               
    });
});
jQuery(document).on('click', 'button.add-daily-transaction', function(){
      jQuery.ajax({
        type:'POST',
        url:baseurl+'index.php/Daily_transaction/save',
        data:jQuery("form#daily_transaction").serialize(),
        dataType:'json',    
        beforeSend: function () {
            jQuery('button#add-school').button('loading');
        },
        success: function (json) {
            $('.text-danger').remove();
            if (json['error']) {             
                for (i in json['error']) {
                    //var element = $('.input-school-' + i.replace('_', '-'));
                    var element = $('.input-transaction-' + i);
                    if ($(element).parent().hasClass('input-group')) {                       
                        $(element).parent().after('<div class="text-danger left_align" style="font-size: 14px;">' + json['error'][i] + '</div>');
                    } else {
                        $(element).after('<div class="text-danger left_align" style="font-size: 14px;">' + json['error'][i] + '</div>');
                    }
                }
            } else {
                if(json['status'] == 'success'){
                jQuery('span#success-msg').html('<div class="alert alert-success">Record added successfully.</div>');
                jQuery('form#daily_transaction').find('textarea, input').each(function () {
                    jQuery(this).val('');
                });
                window.location.href = baseurl+'index.php/Daily_transaction/list_';
            }
                
            }

        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }        
    });
});

jQuery(document).on('keyup', '.input-transaction-transaction_amount', function(){
    var amount = jQuery(this).val();
    var vatpercent = jQuery('#vat_percentage').val();
    jQuery('.input-transaction-gross_amount').val(amount);
    var percentvalue = (amount*vatpercent /100);
    var netamount = parseFloat(amount) + parseFloat(percentvalue);
    jQuery('.input-transaction-vat_value').val(percentvalue);
    jQuery('.input-transaction-net_amount').val(netamount);
    

});

jQuery(document).on('click', 'button#add-popup-daily-transaction', function(){
      jQuery.ajax({
        type:'POST',
        url:baseurl+'index.php/Daily_transaction/save',
        data:jQuery("form#preview_transaction-form").serialize(),
        dataType:'json',    
        success: function (json) {
            $('.text-danger').remove();
            if (json['error']) {             
                for (i in json['error']) {
                    //var element = $('.input-school-' + i.replace('_', '-'));
                    var element = $('.input-preview-' + i);
                    var paymentArr = ['bank','cheque_number','cheque_date'];
                    if(jQuery.inArray( i, paymentArr ) != -1){
                        var element = $('.input-transaction-' + i);
                    }
                    
                    if ($(element).parent().hasClass('input-group')) {                       
                        $(element).parent().after('<div class="text-danger left_align" style="font-size: 14px;">' + json['error'][i] + '</div>');
                    } else {
                        $(element).after('<div class="text-danger left_align" style="font-size: 14px;">' + json['error'][i] + '</div>');
                    }
                }
            } else {
                if(json['status'] == 'success'){
                jQuery('span#success-msg').html('<div class="alert alert-success">Record added successfully.</div>');
                jQuery('form#daily_transaction').find('textarea, input').each(function () {
                    jQuery(this).val('');
                });
                window.location.href = baseurl+'index.php/Daily_transaction/list_';
            }
                
            }

        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }        
    });
});
