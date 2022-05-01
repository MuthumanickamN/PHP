jQuery(document).on('click', 'a.display-school', function(){
    var school_id = jQuery(this).data('schoolid');
    jQuery.ajax({
        type:'POST',
        url:baseurl+'index.php/school_profile_reports/display',
        data:{school_id: school_id},
        dataType:'html',    
        beforeSend: function () {
            jQuery('#render-dispaly-data').html('<div class="text-center"><i class="fa fa-spinner fa-pulse fa-5x fa-fw"></i></div>');
        },                      
        success: function (html) {
            jQuery('#render-dispaly-data').html(html);
			jQuery('#dispaly-school').modal('show');
                                 
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }        
    });
});
jQuery(document).on('click', 'a.update-school-details', function(){
    var school_id = jQuery(this).data('schoolid');	
    jQuery.ajax({
        type:'POST',
        url:baseurl+'index.php/school_profile_reports/edit',
        data:{school_id: school_id},
        dataType:'html',    
        beforeSend: function () {
            jQuery('#render-update-data').html('<div class="text-center"><i class="fa fa-spinner fa-pulse fa-5x fa-fw"></i></div>');
        },                      
        success: function (html) {			
            jQuery('#render-update-data').html(html);
			jQuery('#update-school').modal('show');
                                 
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }        
    });
});
jQuery(document).on('click', 'a.delete-school-details', function(){
    var school_id = jQuery(this).attr('data-schoolid');
	$('#delete-school').on('shown.bs.modal', function (event) {	 
	  jQuery('#school_id').val(school_id);
	});
});
jQuery(document).on('click', 'button#delete-school', function(){
    var school_id = jQuery('#school_id').val();
    jQuery.ajax({
        type:'POST',
        url:baseurl+'index.php/school_profile_reports/delete',
        data:{school_id: school_id},
        dataType:'html',  
        success: function (html) {
			jQuery('span#success-msg').html('');
            location.reload();
            jQuery('span#success-msg').html('<div class="alert alert-success">Deleted school successfully.</div>');  
			jQuery('#schoolListing').DataTable().ajax.reload();		
			jQuery('#delete-school').modal('hide');			
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }        
    });
});
jQuery(document).on('click', 'button#add-school', function(){
	    jQuery.ajax({
        type:'POST',
        url:baseurl+'index.php/school_profile_reports/save',
        data:jQuery("form#add-school-form").serialize(),
        dataType:'json',    
        beforeSend: function () {
            jQuery('button#add-school').button('loading');
        },
        complete: function () {
            jQuery('button#add-school').button('reset');
            setTimeout(function () {
                jQuery('span#success-msg').html('');
            }, 5000);
        },                
        success: function (json) {
            $('.text-danger').remove();
            if (json['error']) {             
                for (i in json['error']) {
                    //var element = $('.input-school-' + i.replace('_', '-'));
                    var element = $('.input-school-' + i);
                    if ($(element).parent().hasClass('input-group')) {                       
                        $(element).parent().after('<div class="text-danger" style="font-size: 14px;">' + json['error'][i] + '</div>');
                    } else {
                        $(element).after('<div class="text-danger" style="font-size: 14px;">' + json['error'][i] + '</div>');
                    }
                }
            } else {
                jQuery('span#success-msg').html('<div class="alert alert-success">Record added successfully.</div>');
                jQuery('#schoolListing').DataTable().ajax.reload();
                jQuery('form#add-school-form').find('textarea, input').each(function () {
                    jQuery(this).val('');
                });
                location.reload();
                //jQuery('#add-school').modal('hide');
                //jQuery('.modal-backdrop.fade').css('display','none');
            }

        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }        
    });
});
jQuery(document).on('click', 'button#update-school', function(){
    jQuery.ajax({
        type:'POST',
        url:baseurl+'index.php/school_profile_reports/update',
        data:jQuery("form#update-school-form").serialize(),
        dataType:'json',    
        beforeSend: function () {
            jQuery('button#update-school').button('loading');
        },
        complete: function () {
            jQuery('button#update-school').button('reset');
            setTimeout(function () {
                jQuery('span#success-msg').html('');
            }, 5000);
            
        },                
        success: function (json) {
            $('.text-danger').remove();
            if (json['error']) {             
                for (i in json['error']) {
                  //var element = $('.input-school-' + i.replace('_', '-'));
                  var element = $('.input-school-' + i);
                  if ($(element).parent().hasClass('input-group')) {                       
                    $(element).parent().after('<div class="text-danger" style="font-size: 14px;">' + json['error'][i] + '</div>');
                  } else {
                    $(element).after('<div class="text-danger" style="font-size: 14px;">' + json['error'][i] + '</div>');
                  }
                }
            } else {
                jQuery('span#success-msg').html('<div class="alert alert-success">Record updated successfully.</div>');
                jQuery('#schoolListing').DataTable().ajax.reload();
                jQuery('form#update-school-form').find('textarea, input').each(function () {
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
//added on 28.4.21 for school credit module
//get school details
jQuery(document).on('change', '.input-credit-school_id', function(){
    var school_id = jQuery(this).val();
    var inputList = [];
    jQuery.ajax({
        type:'POST',
        url:baseurl+'index.php/school_credits/getSchoolDetails',
        data:{school_id: school_id},
        dataType:'json',                         
        success: function (json) {
            if(json['schoolInfo']){
				inputList = ['school_name','school_location','contact','contact_person','trn_number'];
				jQuery('.input-credit-email_id').val(json['schoolInfo']['school_email_id']);
				for (i in inputList) {
					jQuery('.input-credit-'+inputList[i]).val(json['schoolInfo'][inputList[i]]);
				}
			}                             
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }        
    });
});
// vat percentage calculation
jQuery(document).on('keyup', '.input-credit-transaction_amount', function(){
    var amount = jQuery(this).val();
    var vatpercent = jQuery('#vat_percentage').val();
    jQuery('.input-credit-gross_amount').val(amount);
    var percentvalue = (amount*vatpercent /100);
    var netamount = parseFloat(amount) + parseFloat(percentvalue);
    jQuery('.input-credit-vat_value').val(percentvalue);
    jQuery('.input-credit-net_amount').val(netamount);
    

});

//add school credit invoice
jQuery(document).on('click', 'button#add-school-credit', function(){
        jQuery.ajax({
        type:'POST',
        url:baseurl+'index.php/school_credits/save',
        data:jQuery("form#add-school-credit-form").serialize(),
        dataType:'json',    
        beforeSend: function () {
            jQuery('button#add-school-credit-form').button('loading');
        },
        complete: function () {
            window.location.href = baseurl+'school_credits/report';
            
        },                
        success: function (json) {
            $('.text-danger').remove();
            if (json['error']) {             
                for (i in json['error']) {
                    //var element = $('.input-school-' + i.replace('_', '-'));
                    var element = $('.input-credit-' + i);
                    if ($(element).parent().hasClass('form-control')) {                       
                        $(element).parent().after('<div class="text-danger" style="font-size: 14px;">' + json['error'][i] + '</div>');
                    } else {
                        $(element).after('<div class="text-danger" style="font-size: 14px;">' + json['error'][i] + '</div>');
                    }
                }
            } else {
              if(json['status'] == 'success'){
                jQuery('form#radd-school-credit-form').find('textarea, input, select').each(function () {
                    jQuery(this).val('');
                });
                window.location.href = baseurl+'school_credits/report';
          }
              
          }

        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }        
    });
});

           
       
