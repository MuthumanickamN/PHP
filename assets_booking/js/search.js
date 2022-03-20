$(function(){
	
	//$('#search_submit').prop('disabled',true);
	
	
	
	$('#mobile_book_id').autocomplete({
				    select: function(event, ui) {
						    get_cus_id(ui.item.value);
							//$('#search_submit').prop('disabled',false);
					
			},
			source: function( request, response ) {
				     
					 $.ajax({
							type: "POST",
							url : base_url+"search/get_records",
							dataType: "json",
							data: {
							        customer_email: request.term
							      },
							success: function( data ) {
								console.log(data);
							response( $.map( data, function( item ) {
							       return {
										   label: item. email,
										   value: item. email
							              }
							         }));
			                       }
			               });
			
			          },
			autoFocus: true,
			minLength: 1 ,

			});
			
		$(document).on('click','#search_submit',function(e){
			
			$('#search_form').validate({
		rules: {
			mobile_book_id: {
				required: true
			}
		},
		messages: {
			mobile_book_id: {
				required: "Please enter the Email or Booking ID..!"
			}
		},
		submitHandler: function(form) {
    // do other things for a valid form
   // form.submit();
                var cus_id = $('#mobile_book_id_hid').val();
				var search_value = $('#mobile_book_id').val();
				
				
				
				$.ajax({
					     type:"POST",
					     url:base_url+"search/search_email_check",
						 datatype:"json",
						 async:false,
						 data:{
							 cus_id:cus_id,search_value:search_value
						 },
						 success: function(data){
							 
										var obj = JSON.parse(data);	
										return_var = (!obj) ? "tru" : "fal";
										if(return_var == "fal")
										{
											
											$.ajax({
											type:"POST",
											url:base_url+"search/get_booking_details",
											datatype:"json",
											data:{
											cus_id:cus_id,search_value:search_value
											},
											success: function(data){
											$("#booking_table tbody").html(data);
											$("#hide_search").show("slow");
											//$('#search_submit').prop('disabled', true);
											}

											});
								
									
									}
									else{
										
										alert("Email Address or Booking Number does not exist..!");
										$("#booking_table tbody").html("");
											$("#hide_search").hide("slow");
											$("#mobile_book_id").val("");
											
											//$('#search_submit').prop('disabled', true);
									}
							
							}
					
					});
   
   
  }
	});
			
			
			
		});
		
		
		$(document).on("click",".view",function(){
			$('.table_res').html("");
			
			var booking_id = $(this).attr("data-id");
						
			$.ajax({
				url:base_url+"search/get_view_details",
				type:"post",
				datatype:"json",
				data:{
					booking_id:booking_id
				},
				async:"false",
				success: function(data){
					$('.table_res').html(data);
					$('#viewModal').modal('show');
				}
				
			});
		});
})


function get_cus_id(value){
	
	          $.ajax({
					     type:"POST",
					     url:base_url+"search/get_cus_id",
						 data:{
							 mobile_booking_id:value
						 },
						 datatype:"json",
						 success : function(data)
									{
										var obj = JSON.parse(data);
										$('#mobile_book_id_hid').val(obj.id); 				
									},
									fail: function( jqXHR, textStatus, errorThrown ) {
											console.log( 'Could not get posts, server response: ' + textStatus + ': ' + errorThrown );
									}
					
					});
}


