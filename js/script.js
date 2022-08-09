
/*
* ------------------------------------------------------------------------------
* login js file 
* Includes scripts for logging in
* Author Dinesh Kumar Muthukrishnan 
* -------------------------------------------------------------------------------
*/

/*
* Clear message 
*/

$(document).ready(function() {
	
	$('.message').html('');

});


$(document).on( 'click', '#signIn' , function(){
	$('#signupbox').hide(); $('#loginbox').show()
});


/*
* login click event handler
*/
$(document).on('click','#loginBtn',function() {
	
	var username    = $('#username').val();
	var password = $('#password').val();
	var org_id  = $('#org_id').val();	
	var formData = $('#loginForm').serialize();
	var message = '';
	var flag     = 1 ;

    
	if( username == "" ){
		message = "Please enter Username";
		flag = 0;
		$('#username').focus();
		$('.message').addClass('error').html(message);
	}	

	if ( password == "" ){
		message = "Please enter password";
		flag = 0;
		$('#password').focus();
		$('.message').addClass('error').html(message);
	}

	if( org_id == "-1" ){
		message = "Please enter Organization";
		flag = 0;
		$('#org_id').focus();
		$('.message').addClass('error').html(message);
	}

	if ( flag == 1 ){
		$.ajax({

			url  : serverUrl+'#',
			data : formData,
			method : 'POST',
			success: function( response ) {
				console.log(response);
				var objData = JSON.parse( response );
				if ( objData.code == 200 ){
		       		window.location.href = objData.url+'.php';
			    }
			   	if ( objData.code == 404 || objData.code == 405 ){	       	
		   			message = objData.data;
		   			$('.message').addClass('error').html(message);
		   		}	
		    },
		    error: function () {
		        if ( response.code == 401){
		       		window.location.replace('/');		       	
		        }
		        $('.message').addClass('error').html(message);
		    } 
		});
	}

});


/*
* Organization Details
*/

