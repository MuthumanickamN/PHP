jQuery(document).ready(function(){    
    //$('[data-toggle="tooltip"]').tooltip();    
    get_booking_list();
    //var table_data = get_booking_list();
   var table = $('#example2').DataTable( {
       // "ajax": table_data,
        "columns": [
            {
                "className":      'details-control',
                "orderable":      false,
                "data":           null,
                "defaultContent": ''
            },
            { "data": "Sno" },
            { "data": "Name" },
            { "data": "Mobile" },
            { "data": "Booking ID" },
            //{ "data": "Booking Date" },
//            { "data": "Location" },
            //{ "data": "Slot" },
            //{ "data": "Court" },
            { "data": "Approve" },
            { "data": "Reject" }
        ],
        "order": [[1, 'asc']]
    });
    jQuery(document).on('click','.reject_btn', function(e){
        //if(confirm('Are you sure!,Do you want to delete this pricing details?')) {
            var id = $(this).attr('data-bid');
            $('#hidden_id').val(id);
//        }
//        else{
//            return false;
//        }
    }); 
    
    jQuery(document).on('click','.approve_btn', function(e){
       $(this).button('loading');
        var id = $(this).attr('data-bid');
        $('#hidden_id').val(id);
        //alert(id);
        var newdiv = '';
        $.ajax({ 	
            type: "POST",   
            url: base_url+"booking_approval/booking_approved",
            data:"id="+id,		
            async: false,
            datatype: "html",
            success : function(data)
            {
                get_booking_list();
               // table_data = get_booking_list();
                
                newdiv += "<div class='col-sm-12 col-md-12' id='hideMe'><div class='alert alert-success'>";
                newdiv += "<i class='fa fa-check-square' aria-hidden='true'></i>"; 
                newdiv += "<strong>&nbsp;Booking approved succesfully!</strong></div></div>";
                $("#dynamic_message").after(newdiv);
                $('#hideMe').delay(3000).fadeOut('slow'); 
                 if(data != false){
                    setTimeout(function(){
                         location.reload(); 
                    }, 1000); 
                 }
                $(".approve_btn").button('reset');
            },
            fail: function( jqXHR, textStatus, errorThrown ) {
                    console.log( 'Could not get posts, server response: ' + textStatus + ': ' + errorThrown );
            }
        }); 
        e.preventDefault(); 
    }); 
    
    
    jQuery("#rejectModal").on('hide.bs.modal', function () {
        $('#hidden_id').val('');
    });
    
     
    // Add event listener for opening and closing details
    $('#example2 tbody').on('click', 'td.details-control', function () {
        var id = $(this).attr('data-id');
        var tr = $(this).closest('tr');
        var row = table.row( tr );
 
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(id) ).show();
            tr.addClass('shown');
        }
    } );
    
    
});


function format ( d ) {
    //alert(d);
    // `d` is the original data object for the row    
    var html_data = '';
    $.ajax({ 	
        type: "POST",   
        url: base_url+"booking_approval/get_bookingslot_list",
        data:"id="+d,
        async: false,
        datatype: "html",
        success : function(data)
        {       
           //html_data = data;
           html_data +='<h4>Slot details</h4><table class="table table-bordered">';
           html_data +='<thead>';
           html_data +='<tr>';
           html_data +='<th>S.No</th>';
           html_data +='<th>Booking Date</th>';
           html_data +='<th>Booking Slot</th>';
           html_data +='<th>Sports</th>';
           html_data +='<th>Location</th>';
           html_data +='<th>Court</th>';
           html_data +='</tr>';
           html_data +='</thead>';
           html_data +='<tbody>'+ data +'</tbody>';
           html_data +='</table>';
           //$("#example1").DataTable();
        },
        fail: function( jqXHR, textStatus, errorThrown ) {
                console.log( 'Could not get posts, server response: ' + textStatus + ': ' + errorThrown );
        }
    });
    return html_data;
    
}

function get_booking_list(){
    //var court_name = ( $('#court_name').val() !=='' ) ? $('#court_name').val() : '';
    $.ajax({ 	
        type: "POST",   
        url: base_url+"booking_approval/get_booking_list",
        //data:"id="+court_name,
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