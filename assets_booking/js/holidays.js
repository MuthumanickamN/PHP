jQuery(document).ready(function(){
  
    get_holidays_details(); 
   

    function get_holidays_details(){
      
        $.ajax({ 	
            type: "POST",   
            url: base_url+"holidays/get_holidays_details",
            //data:"date="+date,		
            async: false,
            datatype: "json",
            success : function(data)
            {
                    $("#hol_list_table tbody").html(data);
            },
            fail: function( jqXHR, textStatus, errorThrown ) {
                    console.log( 'Could not get posts, server response: ' + textStatus + ': ' + errorThrown );
            }
        });

    }
	
	
	
	
	
	
	
		jQuery(document).on('click','.delete_holidays', function(e){
		if (confirm("Are you sure you want to delete this record?")) {
			// your deletion code		
			var id = $(this).attr('data-id');
			var newdiv = '';
			$.ajax({ 	
				type: "POST",   
				url: base_url+"holidays/delete_holidays",
				data:"id="+id,		
				async: false,
				datatype: "html",
				success : function(data)
				{
					get_holidays_details();
					newdiv += "<div class='col-sm-12 col-md-12' id='hideMe'><div class='alert alert-success'>";
					newdiv += "<i class='fa fa-check-square' aria-hidden='true'></i>"; 
					newdiv += "<strong>&nbsp;Deleted Succesfully!</strong></div></div>";
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
	
});