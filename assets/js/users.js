jQuery(document).on('click', 'a.display-user', function(){
    var user_id = jQuery(this).data('userid');
    jQuery.ajax({
        type:'POST',
        url:baseurl+'index.php/users/display',
        data:{user_id: user_id},
        dataType:'html',    
        beforeSend: function () {
            jQuery('#render-dispaly-data').html('<div class="text-center"><i class="fa fa-spinner fa-pulse fa-5x fa-fw"></i></div>');
        },                      
        success: function (html) {
            jQuery('#render-dispaly-data').html(html);
			jQuery('#dispaly-user').modal('show');
                                 
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }        
    });
});
jQuery(document).on('click', 'a.update-user-details', function(){
    var user_id = jQuery(this).data('userid');	
    jQuery.ajax({
        type:'POST',
        url:baseurl+'index.php/users/edit',
        data:{user_id: user_id},
        dataType:'html',    
        beforeSend: function () {
            jQuery('#render-update-data').html('<div class="text-center"><i class="fa fa-spinner fa-pulse fa-5x fa-fw"></i></div>');
        },                      
        success: function (html) {			
            jQuery('#render-update-data').html(html);
			jQuery('#update-user').modal('show');
                                 
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }        
    });
});
jQuery(document).on('click', 'a.delete-user-details', function(){
    var user_id = jQuery(this).attr('data-userid');
	$('#delete-user').on('shown.bs.modal', function (event) {	 
	  jQuery('#user_id').val(user_id);
	});
});
jQuery(document).on('click', 'button#delete-user', function(){
    var user_id = jQuery('#user_id').val();
    jQuery.ajax({
        type:'POST',
        url:baseurl+'index.php/users/delete',
        data:{user_id: user_id},
        dataType:'html',  
        success: function (html) {
			jQuery('span#success-msg').html('');
            jQuery('span#success-msg').html('<div class="alert alert-success">Deleted user successfully.</div>');  
			jQuery('#userListing').DataTable().ajax.reload();		
			jQuery('#delete-user').modal('hide');			
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }        
    });
});
jQuery(document).on('click', 'button#add-user', function(){
    jQuery.ajax({
        type:'POST',
        url:baseurl+'index.php/users/save',
        data:jQuery("form#add-user-form").serialize(),
        dataType:'json',    
        beforeSend: function () {
            jQuery('button#add-user').button('loading');
        },
        complete: function () {
            jQuery('button#add-user').button('reset');
            setTimeout(function () {
                jQuery('span#success-msg').html('');
            }, 5000);
            
        },                
        success: function (json) {
            $('.text-danger').remove();
            if (json['error']) {             
                for (i in json['error']) {
                    if(i == 'error_msg'){
                        location.reload();
                    }
                    var element = $('.input-user-' + i.replace('_', '-'));
                   
                    if ($(element).parent().hasClass('input-group')) {                       
                        $(element).parent().after('<div class="text-danger" style="font-size: 14px;">' + json['error'][i] + '</div>');
                    } else {
                        $(element).after('<div class="text-danger" style="font-size: 14px;">' + json['error'][i] + '</div>');
                    }
                }
            } else {
                    jQuery('span#success-msg').html('<div class="alert alert-success">Record added successfully.</div>');
                    jQuery('#userListing').DataTable().ajax.reload();
                    jQuery('form#add-user-form').find('textarea, input').each(function () {
                        jQuery(this).val('');
                    });
                    jQuery('#add-user').modal('hide');
                    jQuery('.modal-backdrop.fade').css('display','none');
                
            }

        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }        
    });
});
jQuery(document).on('click', 'button#update-user', function(){
    jQuery.ajax({
        type:'POST',
        url:baseurl+'users/update',
        data:jQuery("form#update-user-form").serialize(),
        dataType:'json',    
        beforeSend: function () {
            jQuery('button#update-user').button('loading');
        },
        complete: function () {
            jQuery('button#update-user').button('reset');
            setTimeout(function () {
                jQuery('span#success-msg').html('');
            }, 5000);
            
        },            
        success: function (json) {
            $('.text-danger').remove();
            if (json['error']) {             
                for (i in json['error']) {
                  var element = $('.input-user-' + i.replace('_', '-'));
                  if ($(element).parent().hasClass('input-group')) {                       
                    $(element).parent().after('<div class="text-danger" style="font-size: 14px;">' + json['error'][i] + '</div>');
                  } else {
                    $(element).after('<div class="text-danger" style="font-size: 14px;">' + json['error'][i] + '</div>');
                  }
                }
            } else {

                jQuery('span#success-msg').html('<div class="alert alert-success">Record updated successfully.</div>');
                jQuery('#userListing').DataTable().ajax.reload();
                jQuery('form#update-user-form').find('textarea, input').each(function () {
                    jQuery(this).val('');
                });
                jQuery('#update-user').modal('hide');
                jQuery('.modal-backdrop.fade').css('display','none');
            }   
            
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }        
    });
});

jQuery(document).on('click', 'button#update-password', function(){
    jQuery.ajax({
        type:'POST',
        url:baseurl+'users/changepassword',
        data:jQuery("form#update-password-form").serialize(),
        dataType:'json',    
        beforeSend: function () {
            //jQuery('button#update-password').button('loading');
        },
                        
        success: function (json) {
            $('.text-danger').remove();
            if (json['error']) {             
                for (i in json['error']) {
                  var element = $('.input-user-' + i);
                  if ($(element).parent().hasClass('input-group')) {                       
                    $(element).parent().after('<div class="text-danger" style="font-size: 14px;">' + json['error'][i] + '</div>');
                  } else {
                    $(element).after('<div class="text-danger" style="font-size: 14px;">' + json['error'][i] + '</div>');
                  }
                }
            } else {
                location.reload();
            }                       
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }        
    });
});