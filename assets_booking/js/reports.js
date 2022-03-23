$(function(){
	
	   get_transaction_list();
	   get_booking_list();
	   get_cancellation_list();
	   
$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
  var target = $(e.target).attr("href") // activated tab
  if(target == "#sectionA")
  {
	  get_transaction_list();
  }
  else if(target == "#sectionB")
  {
	  get_booking_list();
  }
  else if(target == "#sectionC")
  {
	  get_cancellation_list();
  }
  
}); 
	 

 $('#single').change(function() {
        if($(this).is(":checked")) {
			
				 $('#datepicker').datepicker('setDate', null);
				 $('#datepicker1').datepicker('setDate', null);
        }
           
    });
	$('#single1').change(function() {
        if($(this).is(":checked")) {
			
				 $('#datepicker2').datepicker('setDate', null);
				 $('#datepicker3').datepicker('setDate', null);
        }
           
    });
	$('#single2').change(function() {
        if($(this).is(":checked")) {
			
				 $('#datepicker4').datepicker('setDate', null);
				 $('#datepicker5').datepicker('setDate', null);
        }
           
    });



	    

	//transaction//
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



// booking
$('#datepicker2').datepicker({
        format: "dd-mm-yyyy", 
        showClear: true,
        autoclose: true
    }).on("changeDate", function (e) {	
        datetimepicker1();		
        $('#datepicker2').valid();		
    });

    $('#datepicker3').datepicker({
        format: "dd-mm-yyyy", 
        showClear: true,
        autoclose: true
    }).on("changeDate", function (e) {	
        if($('#date_search_from').val() !=''){
            datetimepicker1();		
        }
        $('#datepicker3').valid();		
    });
	
	
	
	function datetimepicker1()
{
    var startdate = $('#datepicker2').val();
    var enddate = $('#datepicker3').val();
    //if(startdate != ''){
        var new_date = add_day(startdate);
        $("#datepicker2").datepicker('setEndDate', enddate);
        $("#datepicker3").datepicker('setStartDate', new_date);
    //}
}

//cancellation

$('#datepicker4').datepicker({
        format: "dd-mm-yyyy", 
        showClear: true,
        autoclose: true
    }).on("changeDate", function (e) {	
        datetimepicker2();		
        $('#datepicker4').valid();		
    });

    $('#datepicker5').datepicker({
        format: "dd-mm-yyyy", 
        showClear: true,
        autoclose: true
    }).on("changeDate", function (e) {	
        if($('#date_search_from').val() !=''){
            datetimepicker2();		
        }
        $('#datepicker5').valid();		
    });
	
	
	
	function datetimepicker2()
{
    var startdate = $('#datepicker4').val();
    var enddate = $('#datepicker5').val();
    //if(startdate != ''){
        var new_date = add_day(startdate);
        $("#datepicker4").datepicker('setEndDate', enddate);
        $("#datepicker5").datepicker('setStartDate', new_date);
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

	
	$("form[name='transaction_search']").validate({
		    ignore: "input[type='text']:hidden",
              debug: false,
            // Specify validation rules
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
                    required: "This field is required!"
                },
                datepicker1: {
                    required: "This field is required!"
                }
                
            }
           
    });
	
	
	$("form[name='booking_search']").validate({
		    ignore: "input[type='text']:hidden",
              debug: false,
            // Specify validation rules
            rules: {
                datepicker2: {
                    required: true
                },
               datepicker3: {
                    required: true
                }
            },
            messages: {
                datepicker2: {
                    required: "This field is required!"
                },
                datepicker3: {
                    required: "This field is required!"
                }
                
            }
           
    });
	
	$("form[name='cancellation_search']").validate({
		    ignore: "input[type='text']:hidden",
              debug: false,
            // Specify validation rules
            rules: {
                datepicker4: {
                    required: true
                },
               datepicker5: {
                    required: true
                }
            },
            messages: {
                datepicker4: {
                    required: "This field is required!"
                },
                datepicker5: {
                    required: "This field is required!"
                }
                
            }
           
    });

	
	$(document).on('click','#transaction_generate',function(e){
		
		var isVisible = $('#datepicker1').is(':visible');
		if(isVisible === false)
		{
			$('#datepicker1').datepicker('setDate', null);
			
		}
		
		
		if($('#transaction_search').valid())
		{
			
	var from_date = $('#datepicker').val();
	var	to_date = $('#datepicker1').val();
	var user = $('#adminSelect').val();
	//get_transaction_list();
	
		$.ajax({
			url:base_url+"reports_booking/get_transaction_search_history",
			type:'post',
			async: false,
			datatype:'html',
			data:{
				from_date:from_date,to_date:to_date,user:user
			},
			success:function(data){
			$("#example1").dataTable().fnDestroy();
			$('#example1 tbody').html(data);
			$('#example1').DataTable({
			"paging": true,
			"lengthChange": true,
			"searching": true,
			"ordering": true,
			"info": true,
			"autoWidth": true
			});
			

			
				
			},
			failure:function( jqXHR, textStatus, errorThrown ) {
                    console.log( 'Could not get posts, server response: ' + textStatus + ': ' + errorThrown );
            }
			
		});
			
			
			
		}
	
	});
	
	
	
	
			$(document).on('click','#booking_generate',function(e){

			var isVisible = $('#datepicker3').is(':visible');
			if(isVisible === false)
			{
			$('#datepicker3').datepicker('setDate', null);

			}


			if($('#booking_search').valid())
			{

			var from_date = $('#datepicker2').val();
			var	to_date = $('#datepicker3').val();

			$.ajax({
			url:base_url+"reports_booking/get_booking_search_history",
			type:'post',
			datatype:'json',
			data:{
			from_date:from_date,to_date:to_date
			},
			success:function(data){
            $("#example2").dataTable().fnDestroy();
			$('#example2 tbody').html(data);
			$('#example2').DataTable({
			"paging": true,
			"lengthChange": true,
			"searching": true,
			"ordering": true,
			"info": true,
			"autoWidth": true
			});
			

			},
			failure:function( jqXHR, textStatus, errorThrown ) {
			console.log( 'Could not get posts, server response: ' + textStatus + ': ' + errorThrown );
			}

			});



			}

			});
	
	
	
	
	$(document).on('click','#cancellation_generate',function(e){
		
		var isVisible = $('#datepicker5').is(':visible');
		if(isVisible === false)
		{
			$('#datepicker5').datepicker('setDate', null);
			
		}
		
		
		if($('#cancellation_search').valid())
		{
			
			var from_date = $('#datepicker4').val();
	var	to_date = $('#datepicker5').val();
	
		$.ajax({
			url:base_url+"reports_booking/get_cancellation_search_history",
			type:'post',
			datatype:'json',
			data:{
				from_date:from_date,to_date:to_date
			},
			success:function(data){
				$("#example3").dataTable().fnDestroy();
				$('#example3 tbody').html(data);
				$('#example3').DataTable({
				"paging": true,
				"lengthChange": true,
				"searching": true,
				"ordering": true,
				"info": true,
				"autoWidth": true
				});

				
			},
			failure:function( jqXHR, textStatus, errorThrown ) {
                    console.log( 'Could not get posts, server response: ' + textStatus + ': ' + errorThrown );
            }
			
		});
			
			
			
		}
	
	});
	
	
	
});



function get_transaction_list(){
	$('#datepicker').val("");
	$('#datepicker1').val("");
	$('#adminSelect').val("All");

	
	var from_date = "";
	var	to_date = "";
   var user = "";
    $.ajax({
			url:base_url+"reports_booking/get_transaction_search_history",
			type:'post',
			async: false,
			datatype:'html',
			data:{
				from_date:from_date,to_date:to_date,user:user
			},
			success:function(data){
	
            $("#example1").dataTable().fnDestroy();
			$('#example1 tbody').html(data);
			$('#example1').DataTable({
			"paging": true,
			"lengthChange": true,
			"searching": true,
			"ordering": true,
			"info": true,
			"autoWidth": true
			});
				
			},
			failure:function( jqXHR, textStatus, errorThrown ) {
                    console.log( 'Could not get posts, server response: ' + textStatus + ': ' + errorThrown );
            }
			
		});

}

function get_booking_list(){
	$('#datepicker2').val("");
	$('#datepicker3').val("");
    var from_date = "";
	var	to_date = "";
    $.ajax({
			url:base_url+"reports_booking/get_booking_search_history",
			type:'post',
			datatype:'json',
			data:{
			from_date:from_date,to_date:to_date
			},
			success:function(data){
            $("#example2").dataTable().fnDestroy();
			$('#example2 tbody').html(data);
			$('#example2').DataTable({
			"paging": true,
			"lengthChange": true,
			"searching": true,
			"ordering": true,
			"info": true,
			"autoWidth": true
			});

			},
			failure:function( jqXHR, textStatus, errorThrown ) {
			console.log( 'Could not get posts, server response: ' + textStatus + ': ' + errorThrown );
			}

			});

}


function get_cancellation_list(){
	$('#datepicker4').val("");
	$('#datepicker5').val("");
	
    var from_date = "";
	var	to_date = "";
    $.ajax({
			url:base_url+"reports_booking/get_cancellation_search_history",
			type:'post',
			datatype:'json',
			data:{
				from_date:from_date,to_date:to_date
			},
			success:function(data){
				$("#example3").dataTable().fnDestroy();
				$('#example3 tbody').html(data);
				$('#example3').DataTable({
				"paging": true,
				"lengthChange": true,
				"searching": true,
				"ordering": true,
				"info": true,
				"autoWidth": true
				});
				
			},
			failure:function( jqXHR, textStatus, errorThrown ) {
                    console.log( 'Could not get posts, server response: ' + textStatus + ': ' + errorThrown );
            }
			
		});

}