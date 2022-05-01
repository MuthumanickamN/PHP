jQuery(document).on('change', '.input-booking-school_id', function(){
    var school_id = jQuery(this).val();
    var inputList = [];
    jQuery.ajax({
        type:'POST',
        url:baseurl+'index.php/school_credits/getSchoolDetails',
        data:{school_id: school_id},
        dataType:'json',                         
        success: function (json) {
            if(json['schoolInfo']){
				inputList = ['school_name','school_location'];
				jQuery('.input-booking-email_id').val(json['schoolInfo']['school_email_id']);
				for (i in inputList) {
					jQuery('.input-booking-'+inputList[i]).val(json['schoolInfo'][inputList[i]]);
				}
			}                             
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }        
    });
});

jQuery(document).on('click', 'button#add-booking-create', function(){    
        jQuery.ajax({
        type:'POST',
        url:baseurl+'index.php/school_attendance/createbooking',
        data:jQuery("form#school_booking").serialize(),
        dataType:'json',    
        beforeSend: function () {
            jQuery('button#add-booking-create').button('loading');
        },
        complete: function () {
            jQuery('button#add-booking-create').button('reset');
            setTimeout(function () {
                jQuery('span#success-msg').html('');
            }, 5000);
        },                
        success: function (json) {
            $('.text-danger').remove();
            if (json['error']) {             
                //alert('err');
                for (i in json['error']) {
                    var element = $('.input-booking-' + i);
                    if ($(element).parent().hasClass('input-group')) {                       
                        $(element).parent().after('<div class="text-danger" style="font-size: 14px;">' + json['error'][i] + '</div>');
                    } else {
                        $(element).after('<div class="text-danger" style="font-size: 14px;">' + json['error'][i] + '</div>');
                    }
                }
            } else {
                jQuery('span#success-msg').html('<div class="alert alert-success">Record added successfully.</div>');
                //jQuery('#schoolListing').DataTable().ajax.reload();
                jQuery('form#school_booking').find('textarea, input, select').each(function () {
                    jQuery(this).val('');
                });
                location.reload();
            }

        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }        
    });
});

