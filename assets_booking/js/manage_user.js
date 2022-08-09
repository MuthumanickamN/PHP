jQuery(document).ready(function(){ 

var sel= function(){
	if($("#user_hidden_id").val() != ''){
		$('#court').multiselect('select', $('#hiddenselect').val().split(','));
	}
	
}
RadionButtonSelectedValueSet = function (name, SelectedValue) {
	var input_name = name.toLowerCase();
	var selected_name_value = SelectedValue.toLowerCase();
    $('input[name="' + input_name+ '"]').val([selected_name_value]);
}
$.validator.addMethod("valid_email", function(value, element) {
	return this.optional(element) || /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(value);
});
jQuery.validator.addMethod("alphanumeric", function(value, element) {
    return this.optional(element) || /^[a-zA-Z ]+$/i.test(value);
}, "Letters, numbers, and underscores only please");

$.validator.addMethod("valid_mobile", function(value, element) {
        //alert('test');
        //return this.optional(element) ||  /^[+,]+([0-9]{12})*$/.test(value);  
        //return this.optional(element) || /^[+,]+(\s{0,1}[0-9]{10})*$/.test(value);
		return this.optional(element) || /^[0-9]{12}$/.test(value);
       
    });

jQuery.validator.addMethod('chk_mobile_exist', function (value) {
       var user_hidden_id = $("#user_hidden_id").val();
        var mobile_number = $('#user_mobile').val();
        var return_var = '';
        if(mobile_number != ''){
            $.ajax({ 	
                    type: "POST",   
                    url: base_url+"manage_user/check_mobile_exist",
                    data:"mobile_number="+mobile_number+"&user_hidden_id="+user_hidden_id,		
                    async: false,
                    datatype: "json",
                    success : function(data)
                    {
						
                            var obj = JSON.parse(data);	
                            return_var = (!obj) ? true : false;
						
                    },
                    fail: function( jqXHR, textStatus, errorThrown ) {
                            console.log( 'Could not get posts, server response: ' + textStatus + ': ' + errorThrown );
                    }
            });
        }
        return return_var;
    });
	
	jQuery.validator.addMethod('chk_email_exist', function (value) {
        var user_hidden_id = $("#user_hidden_id").val();
        var user_email = $('#user_email').val();
        var return_var = '';
        if(user_email != ''){
            $.ajax({ 	
                    type: "POST",   
                    url: base_url+"manage_user/check_email_exist",
                    data:"user_email="+user_email+"&user_hidden_id="+user_hidden_id,		
                    async: false,
                    datatype: "json",
                    success : function(data)
                    {
						
                            var obj = JSON.parse(data);	
                            return_var = (!obj) ? true : false;
						
                    },
                    fail: function( jqXHR, textStatus, errorThrown ) {
                            console.log( 'Could not get posts, server response: ' + textStatus + ': ' + errorThrown );
                    }
            });
        }
        return return_var;
    });
	
	
	jQuery.validator.addMethod('chk_image', function (value) {
        var hid_id = $("#user_hid_image").val();
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
	
	jQuery.validator.addMethod('chk_image1', function (value) {
        var hid_id = $("#user_id_hid_image").val();
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
	
	
	
	
$("form[name='add_user']").validate({
        // Specify validation rules
		ignore: "input[type='text']:hidden",
              debug: false,
			  onkeyup: false,
       rules: {
           /*  user_hid_image: {
                required: true
            }, */
			/* user_image: {
				chk_image:true
            }, */
			user_image: {
				//required:true
				chk_image:true
            },
			user_id_image: {
				//required:true
				chk_image1:true
            },
			user_name: {
                required: true,
				alphanumeric:true
            },
			user_mobile: {
                required: true,
				chk_mobile_exist:true,
				valid_mobile:true
            },
			user_email: {
                required: true,
				chk_email_exist:true,
				valid_email:true
            },
			datepicker: {
                required: true
            },
			datepicker1: {
                required: true
            },
			gender: {
                required: true
            },
			register_fee: {
                required: true
            },
			Password: {
                required: true
            },
			confirm_Password: {
                required: true,
				equalTo:"#Password"
            }
        },
        messages: {
            /* user_hid_image: {
                required: "Please select image"
            }, */
			/* user_image: {
				chk_image: " Please select image!"
            }, */
			user_image: {
				//required: " Please select image!"
				chk_image: " Please select image!"
            },
			user_id_image: {
				//required:" Please select image!"
				chk_image1: " Please select image!"
				
            },
			user_name: {
                required: "Please enter the user name",
				alphanumeric:"Special characters, spaces and numbers are not allowed"
            },
			user_mobile: {
                required: "Please enter the mobile number",
				chk_mobile_exist: " This Mobile number already exist!",
				valid_mobile:"Please enter correct mobile number"
            },
			user_email: {
                required: "Please enter the email address",
				chk_email_exist:"This Email already exist!",
				valid_email: "Please enter the correct email address"
            },
			datepicker: {
                required: "Please select date"
            },
			datepicker1: {
                required: "Please select ID expiry date"
            },
			gender: {
                required: "Please select gender"
            },
			/* court: {
                required: "Please select the sports"
            }, */
			register_fee:{
                required: "Please enter the registration fees"
            },
			Password: {
                required: "Please enter the Password"
            },
			confirm_Password: {
                required: "Please  confirm Password",
				equalTo : "Password does not match..!"
            }
        }
    });

	

   
     
    get_user_list();
    
    jQuery(document).on('click','.delete_user', function(e){
       if (confirm("Are you sure you want to delete this record?")) {
        var id = $(this).attr('data-id');
        var newdiv = '';
        $.ajax({ 	
                type: "POST",   
                url: base_url+"manage_user/delete_user",
                data:"id="+id,		
                async: false,
                datatype: "html",
                success : function(data)
                {  
                    get_user_list();
                    //location.reload();
                    newdiv += "<div class='col-sm-12 col-md-12' id='hideMe'><div class='alert alert-success'>";
                    newdiv += "<i class='fa fa-check-square' aria-hidden='true'></i>"; 
                    newdiv += "<strong>&nbsp;User details deleted succesfully!</strong></div></div>";
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

    
    jQuery(document).on('click','.edit', function(e){
        $('.modal-title').html('Edit User');
        var id = $(this).attr('data-id');
        $.ajax({ 	
            type: "POST",   
            url: base_url+"manage_user/get_user_details",
            data:"id="+id,		
            async: false,
            datatype: "json",
            success : function(data)
            {
				$('#pass').hide();
				$('#c_pass').hide();
				
                var obj = JSON.parse(data);
                $('#user_hidden_id').val(id);
                $('#user_name').val(obj.name);
                $('#user_mobile').val(obj.mobile);
                $('#user_email').val(obj.email); 
				 $('#user_email_hidden').val(obj.email); 
				if(obj.dob == "0000-00-00")
				{
					
					var dob = "";
				}
				else{
					var dob = formatDate (obj.dob);
				}
				
				
				  
                 $('#datepicker').val(dob);
				 
				 if(obj.id_expiry_date == "0000-00-00")
				{
					
					var expiry_date = "";
				}
				else{
					var expiry_date = formatDate (obj.id_expiry_date);
				}
				
                 $('#datepicker1').val(expiry_date);				 
				
                 RadionButtonSelectedValueSet('gender',obj.gender);

				
	            // $('#hiddenselect').val(obj.sports);			 
				 $('#register_fee').val(obj.fee);
				 $('#pin').val(obj.pin);
				 
				 $('#confirm_pin').val(obj.pin);
				
				var img_url = base_url+"uploads/user_images/"+obj.user_image;
				$("#upload_image1").attr("src", img_url); 
				$('#user_hid_image').val(obj.user_image);
				
				var img_url1 = base_url+"uploads/user_images/"+obj.user_id_image;
				$("#upload_id_image1").attr("src", img_url1);
				$('#user_id_hid_image').val(obj.user_image);
				//alert(img_url1);
				$('.simpleLens-lens-image').attr('data-lens-image', img_url1);
				
                sel();				
            },
            fail: function( jqXHR, textStatus, errorThrown ) {
                    console.log( 'Could not get posts, server response: ' + textStatus + ': ' + errorThrown );
            }
        }); 
         e.preventDefault(); 
    });

	function formatDate (input) {
  var datePart = input.match(/\d+/g),
  year = datePart[0].substring(0), // get only two digits
  month = datePart[1], day = datePart[2];

  return day+'-'+month+'-'+year;
}



	
	jQuery(document).on('click','.view', function(e){
        $('.modal-title').html('View User');
        var id = $(this).attr('data-id');
        $.ajax({ 	
            type: "POST",   
            url: base_url+"manage_user/get_user_list_view",
            data:"id="+id,		
            async: false,
            datatype: "html",
            success : function(data)
            {
				$("#view_table tbody").html(data);
				$('#demo-2 .simpleLens-big-image').simpleLens({
            loading_image: 'images/loading.gif'
        }); 
		
				$("#sub_edit").attr('data-id',id);
				
		
            },
            fail: function( jqXHR, textStatus, errorThrown ) {
                    console.log( 'Could not get posts, server response: ' + textStatus + ': ' + errorThrown );
            }
        });

       		
         e.preventDefault(); 
    });
	
	jQuery(document).on('click','#sub_edit', function(e){
        
        var id = $(this).attr('data-id');
         	
            $.ajax({ 	
            type: "POST",   
            url: base_url+"manage_user/get_user_details",
            data:"id="+id,		
            async: false,
            datatype: "json",
            success : function(data)
            {
				$('#viewModal').modal('hide');
				
				
                var obj = JSON.parse(data);
                $('#user_hidden_id').val(id);
                $('#user_name').val(obj.name);
                $('#user_mobile').val(obj.mobile);
                $('#user_email').val(obj.email); 

                 $('#datepicker').val(obj.dob);
				
				 
				
                 RadionButtonSelectedValueSet('gender',obj.gender);

				
	             $('#hiddenselect').val(obj.sports);			 
				 $('#register_fee').val(obj.fee);
				 $('#pin').val(obj.pin);
				 
				 $('#confirm_pin').val(obj.pin);
				
				var img_url = base_url+"uploads/user_images/"+obj.user_image;
				$("#upload_image1").attr("src", img_url);
				$('#user_hid_image').val(obj.user_image);
				
				var img_url1 = base_url+"uploads/user_images/"+obj.user_id_image;
				$("#upload_id_image1").attr("src", img_url1);
				$('#user_id_hid_image').val(obj.user_image);
				$('.simpleLens-lens-image').attr('data-lens-image', img_url1);
				
                sel();
				$('.modal-title').html('Edit User');				
				$('#editModal').modal('show');				
            },
            fail: function( jqXHR, textStatus, errorThrown ) {
                    console.log( 'Could not get posts, server response: ' + textStatus + ': ' + errorThrown );
            }
        });
        

       		
         e.preventDefault(); 
    });
	
	
	
	
   $(".add_user").on('click', function(){
	   $('#pass').show();
				$('#c_pass').show();
       $('.modal-title').html('Add User');
        $('#user_hidden_id').val('');
               var validator = $( '#add_user' ).validate();
         validator.resetForm();
         $("#editModal").find('form')[0].reset();
				
				jQuery('#upload_image1').attr('src', '');
				$('#user_hid_image').val('');
				
				jQuery('#upload_id_image1').attr('src', '');
				$('#user_id_hid_image').val('');
				$('.simpleLens-lens-image').attr('data-lens-image', '');
				
				$('.multiselect-selected-text').html('None selected');
    }); 
    
     
	 
	 
	 
	 jQuery(document).on('click','.password_change', function(e){
		 
		 
        //$('.modal-title').html('Edit User');
        var id = $(this).attr('data-id');
		
		$.ajax({ 	
            type: "POST",   
            url: base_url+"manage_user/get_user_details",
            data:"id="+id,		
            async: false,
            datatype: "json",
            success : function(data)
            {
				var obj = JSON.parse(data);
                $('#user_password_hidden_id').val(id);
                $('#user_password_hidden_name').val(obj.name);
                $('#user_password_hidden_email').val(obj.email); 				
            },
            fail: function( jqXHR, textStatus, errorThrown ) {
                    console.log( 'Could not get posts, server response: ' + textStatus + ': ' + errorThrown );
            }
        });
         
    });
	
	
    
    
        
});

$(function () {
            /* $('#court').multiselect({
                includeSelectAllOption: true,
				onDropdownHidden: function (e) {
					$('#hiddenselect').val($('#court').val().join(','));
				}
            });
			$('#btnSelected').click(function () {
                var selected = $("#court option:selected");
                var message = "";
                selected.each(function () {
                    message += $(this).text() + " " + $(this).val() + "\n";
					alert(message);
                });
                
            }); */
			
        });

var modal_close = function(){
	
	 var validator = $( '#add_user' ).validate();
         validator.resetForm();
         $("#editModal").find('form')[0].reset();
		 jQuery('#upload_image1').attr('src', '');
         if ($('div').hasClass('tooltip-arrow')){
             $('.tooltip-arrow').attr('style','display:none;');
         }
         if ($('div').hasClass('tooltip-inner')){
             $('.tooltip-inner').attr('style','display:none;');
         }
	
}

var modal_close_password = function(){
	
	var validator = $( '#change_password' ).validate();
         validator.resetForm();
         $("#passwordModal").find('form')[0].reset();
		
         if ($('div').hasClass('tooltip-arrow')){
             $('.tooltip-arrow').attr('style','display:none;');
         }
         if ($('div').hasClass('tooltip-inner')){
             $('.tooltip-inner').attr('style','display:none;');
         }
	
}

function get_user_list(){
    $.ajax({ 	
        type: "POST",   
        url: base_url+"manage_user/get_user_list",
        async: false,
        datatype: "html",
        success : function(data)
        {
			$("#example2").dataTable().fnDestroy();
			$("#example2 tbody").html(data);
			$('#example2').DataTable({
	"columnDefs": [ {
          "targets": 'no-sort',
          "orderable": false,
    } ],
"paging": true,
"lengthChange": true,
"searching": true,
"ordering": true,
"info": true,
"autoWidth": true
});
                //$("#example2 tbody").html(data);
        },
        fail: function( jqXHR, textStatus, errorThrown ) {
                console.log( 'Could not get posts, server response: ' + textStatus + ': ' + errorThrown );
        }
    });

}

