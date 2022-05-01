$(function(){
	$('[data-toggle="tooltip"]').tooltip();

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
	
	
	$('#fetch1').click(function(){
		
	var $form = $('#recharge_history');
	if($form.valid())
	{
		 
		 
		var from_date = $("#datepicker").val();
		var to_date = $("#datepicker1").val();
		
		
		$.ajax({ 	
            type: "POST",   
            url: base_url+"Recharge_history/ajax_recharge_history",
			//url: base_url+"Prepaid_credits_booking/get_recharge_history",
		    //url: "ajax_recharge_history.php",
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
		  
          },{ "width": "10px", "targets": 0 }],		 
            "fixedColumns": true,
			"paging": true,
			"lengthChange": true,
			"searching": true,
			"ordering": true,
			"info": true,
			    "autoWidth": false,

			});
			 
			 
				
            },
            fail: function( jqXHR, textStatus, errorThrown ) {
                    console.log( 'Could not get posts, server response: ' + textStatus + ': ' + errorThrown );
            }
        }); 
		
	//	$("#hide2").show("slow");
		//$("#example1").DataTable();
		
		
		
	}

});
	
	
});

