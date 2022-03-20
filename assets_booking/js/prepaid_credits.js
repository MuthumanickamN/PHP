jQuery(document).ready(function(){ 
//$('#fetch').prop('disabled', true);

$('#datepicker').datepicker({
        format: "dd-mm-yyyy", 
        showClear: true,
        autoclose: true
    }).on("changeDate", function (e) {	
        datetimepicker();		
        $('#datepicker').valid();		
    });

    $('#datepicker1').datepicker({
        format: "dd-mm-yyyy", 
        showClear: true,
        autoclose: true
    }).on("changeDate", function (e) {	
        if($('#date_search_from').val() !=''){
            datetimepicker();		
        }
        $('#datepicker1').valid();		
    });
	
	
	
	function datetimepicker()
{
    var startdate = $('#datepicker').val();
    var enddate = $('#datepicker1').val();
    //if(startdate != ''){
        var new_date = add_day(startdate);
        $("#datepicker").datepicker('setEndDate', enddate);
        $("#datepicker1").datepicker('setStartDate', new_date);
    //}
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




get_credit_member_list();

jQuery.validator.addMethod('chk_mobile', function (value) {
       // var hid_id = $("#hidden_id").val();
        var customer_mobile = $('#customer_mobile').val();
        var return_var = '';
        if(customer_mobile != ''){
            $.ajax({ 	
                    type: "POST",   
                    url: base_url+"prepaid_credits/check_mobile_exist",
                    data:"customer_mobile="+customer_mobile,		
                    async: false,
                    datatype: "json",
                    success : function(data)
                    {
						
                            var obj = JSON.parse(data);	
                            return_var = (!obj) ? false : true;
						
                    },
                    fail: function( jqXHR, textStatus, errorThrown ) {
                            console.log( 'Could not get posts, server response: ' + textStatus + ': ' + errorThrown );
                    }
            });
        }
        return return_var;
    });

$("form[name='recharge_history']").validate({
        // Specify validation rules
		ignore: [],
              debug: false,
       rules: {
			datepicker: {
                required: true
            },
			datepicker1: {
                required: true
            }
        },
        messages: {
            datepicker: {
                required: "Please select from date"
            },
			datepicker1: {
                required: "Please select to date"
            }
        }
    });


$("form[name='recharge_form']").validate({
        // Specify validation rules
		ignore: [],
        debug: false,
       rules: {
            customer_name: {
                required: true
            },
            customer_email: {
                required: true
            },
			balance_credits: {
                required: true
            },
			datepicker2: {
                required: true
            },
			amount_paid: {
                required: true,
				number: true
            },
			type: {
                required: true
            }
        },
        messages: {
            customer_name: {
                required: "Please enter the customer name"
            },
            customer_email: {
                required: "Please enter the email"
            },
			balance_credits: {
                required: "Please enter the balance credit"
            },
			datepicker2: {
                required: "Please select date"
            },
			amount_paid: {
                required: "Please enter the amount",
				number: "please enter correct amount..!"
            },
			type: {
                required: "Please select the type"
            },
			court_address: {
                required: "Please enter the address"
            }
        }
    });


	
	

	
	
	
	$('#customer_email').autocomplete({
				    select: function(event, ui) {
						$('#fetch').prop('disabled', false);
						
		if ($('div').hasClass('tooltip-arrow')){
		$('.tooltip-arrow').attr('style','display:none;');
		}
		if ($('div').hasClass('tooltip-inner')){
		$('.tooltip-inner').attr('style','display:none;');
		}
					//$('#scan_order').prop('disabled', false);
					//alert(ui.item.value);
					//fill(ui.item.value);
				
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
							response( $.map( data, function( item ) {
							       return {
										   label: item.email,
										   value: item.email
							              }
							         }));
			                       }
			               });
			
			          },
			autoFocus: true,
			minLength: 1 ,

			});
			
$.validator.addMethod("valid_email", function(value, element) {
	return this.optional(element) || /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(value);
});	
	
	$('#fetch').click(function(){
		//$('#fetch').prop('disabled', true);
		
		
		$("form[name='customer_number_fetch']").validate({
        // Specify validation rules
		ignore: [],
              debug: false,
       rules: {
			customer_email: {
                required: true,
				valid_email:true
				//chk_mobile: true
            }
        },
        messages: {
            customer_email: {
                required: "Please enter email address",
				valid_email:"Please enter correct email address"
				//chk_mobile: "This mobile number is not exist..!"
            }
        },
		submitHandler: function(form) {
			var email = $("#customer_email").val();
			
			$.ajax({
					     type:"POST",
					     url:base_url+"prepaid_credits/search_email_check",
						 datatype:"json",
						 async:false,
						 data:{
							 email:email
						 },
						 success: function(data){
							 
										var obj = JSON.parse(data);	
										return_var = (!obj) ? "tru" : "fal";
										if(return_var == "fal")
										{
											
												$.ajax({ 	
												type: "POST",   
												url: base_url+"prepaid_credits/get_customer_details",
												data:{
												email:email
												},
												// data:"mob_no="+mob_no,		
												async: false,
												datatype: "json",
												success : function(data)
												{
												var obj = JSON.parse(data);

												$('#customer_name').val(obj.name);
												$('#customer_email_field').val(obj.email);
												$('#cus_hid').val(obj.custid);
												$('#wal_hid').val(obj.id);

												$('#balance_credits').val(obj.amount);

                                                $("#hide1").show("slow");

												},
												fail: function( jqXHR, textStatus, errorThrown ) {
												console.log( 'Could not get posts, server response: ' + textStatus + ': ' + errorThrown );
												}
												}); 
								
									
									}
									else{
										
										alert("Email Address does not exist..!");
										$('#customer_name').val(obj.name);
												$('#customer_email').val("");
												$('#cus_hid').val("");
												$('#wal_hid').val("");

												$('#balance_credits').val("");
											$("#hide1").hide("slow");
											$("#customer_email").val("");
											
											//$('#search_submit').prop('disabled', true);
									}
							
							}
					
					});
			
			
		}
    });
		
	
	
	

});
	

    $('#fetch1').click(function(){
		
	var $form = $('#recharge_history');
	if($form.valid())
	{
		 
		 
		var from_date = $("#datepicker").val();
		var to_date = $("#datepicker1").val();
		
		
		$.ajax({ 	
            type: "POST",   
            url: base_url+"prepaid_credits/get_recharge_history",
            data:"from_date="+from_date+"&to_date="+to_date,		
            async: false,
            datatype: "json",
            success : function(data)
            {
               
				$("#example1").dataTable().fnDestroy();
			$('#example1 tbody').html(data);
			$('#example1').DataTable({
				oLanguage: {
                  sProcessing: "<img src='<?php echo base_url(); ?>images/admin/loadingroundimage.gif' style='width:40px; height:40px;'>"
                            },
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
			 
			 
			 
			 
							 /* $.ajax({ 	
							type: "POST",   
							url: base_url+"prepaid_credits/get_recharge_history_total",
							data:"from_date="+from_date+"&to_date="+to_date,		
							async: false,
							datatype: "json",
							success : function(data)
							{
							   
								var obj = JSON.parse(data);
								
                               $('#cash').html(obj.cash_total);
							   $('#card').html(obj.card_total);
							   
							   var total = parseInt(obj.cash_total) + parseInt(obj.card_total);
							   $('#total').html(total);
							   
								
								
							},
							fail: function( jqXHR, textStatus, errorThrown ) {
									console.log( 'Could not get posts, server response: ' + textStatus + ': ' + errorThrown );
							}
						}); */
			 
				
				
            },
            fail: function( jqXHR, textStatus, errorThrown ) {
                    console.log( 'Could not get posts, server response: ' + textStatus + ': ' + errorThrown );
            }
        }); 
		
		$("#hide2").show("slow");
		//$("#example1").DataTable();
		
		
		
	}

});
    
        
});

function get_credit_member_list(){

    $.ajax({ 	
        type: "POST",   
        url: base_url+"prepaid_credits/get_credit_member_list",
       // data:"court_name="+court_name,
        async: false,
        datatype: "html",
        success : function(data)
        {
                $("#example2 tbody").html(data);
        },
        fail: function( jqXHR, textStatus, errorThrown ) {
                console.log( 'Could not get posts, server response: ' + textStatus + ': ' + errorThrown );
        }
    });

}


