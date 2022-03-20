jQuery(document).ready(function(){
  
    get_location_details(); 
   

    function get_location_details(){
      
        $.ajax({ 	
            type: "POST",   
            url: base_url+"location/get_location_details",
            //data:"date="+date,		
            async: false,
            datatype: "json",
            success : function(data)
            {
                    $("#loc_list_table tbody").html(data);
            },
            fail: function( jqXHR, textStatus, errorThrown ) {
                    console.log( 'Could not get posts, server response: ' + textStatus + ': ' + errorThrown );
            }
        });

    }
	
	// for status
	$(document).on('click', '.comp', function () {
		  
		var stid = $(this).attr('stat_at');
	//alert(stid);
    if(stid==0)
	{
		//alert(stid);btn-success
		$(this).removeClass("btn-danger");
		$(this).addClass("btn-success");
		
		$(this).children("i").removeClass("fa fa-times");
		$(this).children("i").addClass("fa fa-check");
		
		
	}else {
		$(this).removeClass("btn-success");
		$(this).addClass("btn-danger");
		
		$(this).children("i").removeClass("fa fa-check");
		$(this).children("i").addClass("fa fa-times");
		}
		  
		  
		  var statid = $(this).attr('stat_at');
		   var locationid = $(this).attr('id');
		   if(statid=='0'){ var statid=1;}else{var statid=0;}
		  
		  $(this).attr("stat_at", statid);
		 
					
			$.ajax({ 	
            type: "POST",   
            url: base_url+"location/location_status_update",
            data: {locationid:locationid,statid:statid,reg:"status"},		
            async: false,
            datatype: "json",
            success : function(data)
            {
                                          
            },
            fail: function( jqXHR, textStatus, errorThrown ) {
                    console.log( 'Could not get posts, server response: ' + textStatus + ': ' + errorThrown );
            }
        });
				   
				});
	
	// status-end
	
	jQuery(document).on('click','.add_location', function(e){
       
        
                $('#location_hidden_id').val('');
                $('#location').val('');                                  
            
    });
	
	jQuery(document).on('click','.edit_location', function(e){
       
        var id = $(this).attr('data-id');
        $.ajax({ 	
            type: "POST",   
            url: base_url+"location/get_location",
            data:"id="+id,		
            async: false,
            datatype: "json",
            success : function(data)
            {
                var obj = JSON.parse(data);
                $('#location_hidden_id').val(obj.id);
                $('#location').val(obj.location);                                  
            },
            fail: function( jqXHR, textStatus, errorThrown ) {
                    console.log( 'Could not get posts, server response: ' + textStatus + ': ' + errorThrown );
            }
        }); 
         e.preventDefault(); 
    });
	
	
	
		jQuery(document).on('click','.delete_location', function(e){
		
		if (confirm("Are you sure you want to delete this record?")) {
			// your deletion code		
			var id = $(this).attr('data-id');
			var newdiv = '';
			$.ajax({ 	
				type: "POST",   
				url: base_url+"location/delete_location",
				data:"id="+id,		
				async: false,
				datatype: "html",
				success : function(data)
				{
					get_location_details();
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