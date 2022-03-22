<section class="content-header">
<h1>Manage Location</h1>
<ol class="breadcrumb">
<li><i class="fa fa-map-marker" aria-hidden="true"></i> Manage Location</li>
<li class="active">Add Location</li>
</ol>
</section>
<!-- Main content -->
<!-- Main content -->
<section class="content admin_table">
<div class="col-sm-12 col-md-12 add_button"><button type="button"  data-toggle="modal" data-target="#editModal" class="btn btn-success pull-right add_location"><i class="fa fa-user-plus" aria-hidden="true"></i> &nbsp; Add New Location</button>
<div class="clearfix"></div>
</div>
<div class="clearfix"></div>

	<div class="clearfix" id="dynamic_message"></div>
	<?php if($this->session->flashdata('success_message')){ ?>
	<div class="col-sm-12 col-md-12" id="hideMe">
	<div class="alert alert-success">
	<i class="fa fa-check-square" aria-hidden="true"></i> 
	<strong><?php echo $this->session->flashdata('success_message'); ?></strong>
	</div>
	</div>
	<?php } if($this->session->flashdata('error_message')){ ?>
	<div class="error_message"><p class="alert alert-danger"><?php echo $this->session->flashdata('error_message'); ?></p></div>
	<?php } ?>
	
        <div class="clearfix"></div>
<div class="clearfix"></div>
<div class="table-responsive">
<table id="loc_list_table" class="table table-bordered table-striped">
	<thead>
		<tr>
		    <th>S.No</th>
			<th>Location</th>
			<th class="no-sort">Edit</th>
			<th class="no-sort">Status</th>
		</tr>
	</thead>
	<tbody>

		
	</tbody>
</table>
</div>
<div class="clearfix"></div>
</section>
<!-- /.content -->

<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url(); ?>assets_booking/libraries/demo.js"></script>
<script src="<?php echo base_url(); ?>assets_booking/js/location_booking.js"></script>
<script type="text/javascript">
				
				
$(document).ready(function(){
	
	$("#editModal").on('hide.bs.modal', function () {
         var validator = $( '#location_form' ).validate();
         validator.resetForm();
         $(this).find('form')[0].reset();
         if ($('div').hasClass('tooltip-arrow')){
             $('.tooltip-arrow').attr('style','display:none;');
         }
         if ($('div').hasClass('tooltip-inner')){
             $('.tooltip-inner').attr('style','display:none;');
         }
    });
	
	$('.alert-success').delay(3000).fadeOut('slow');
	
$('[data-toggle="tooltip"]').tooltip();  
	
$("#example1").DataTable();
$('#loc_list_table').DataTable({
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

jQuery.validator.addMethod("alphanumeric", function(value, element) {
    return this.optional(element) || /^[a-zA-Z ]+$/i.test(value);
}, "Letters, numbers, and underscores only please");

jQuery.validator.addMethod('chk_location_exist', function (value) {
        var location_hidden_id = $("#location_hidden_id").val();
        var location_name = $('#location').val().trim();
        var return_var = '';
        if(location_name != ''){
            $.ajax({ 	
                    type: "POST",   
                    url: base_url+"location_booking/check_location_exist",
                    data:"location_hidden_id="+location_hidden_id+"&location_name="+location_name,		
                    async: false,
                    datatype: "json",
                    success : function(data)
                    {
						//if(hid_id == ''){
                            var obj = JSON.parse(data);	
                            return_var = (!obj) ? true : false;
						/* }
						else{
							return_var = true;
						} */
                    },
                    fail: function( jqXHR, textStatus, errorThrown ) {
                            console.log( 'Could not get posts, server response: ' + textStatus + ': ' + errorThrown );
                    }
            });
        }
        return return_var;
    });

$(document).on('click', '#location_add', function () {
     
    $("#location_form").validate({
		    ignore: [],
            debug: false,
            onkeyup: false,
        // Specify validation rules
       rules: {
            location:{
				required:true,
				//alphanumeric: true,
				chk_location_exist:true
				}
        },
        messages: {
			location:{
				required: "Please enter the location",
			    //alphanumeric: "Special characters, spaces are not allowed",
				chk_location_exist: "Entered location is already existing"
				}
			}
    });
	
	
		var loc=$('#location').val();
		var $form = $('#location_form');
	if($form.valid())
	{
		
		$form.submit();
		
		             
						
	}
		
		
	});




});

</script>
<!-- Edit Modal HTML -->
<div id="editModal" class="modal fade">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title">Edit / Add New Location</h4>
</div>
<div class="modal-body">
<form name="location_form" id="location_form" action="<?php echo base_url(); ?>location_booking/add_location"  method="POST" class="form-horizontal" role="form" autocomplete="off">
<div class="col-sm-12 col-md-12">
    <p class="form_text1">Location</p>
	<input type="text" name="location" id="location" placeholder="Egyptian Club in Oudmetha Road">
	<input type="hidden" name="location_hidden_id" id="location_hidden_id" value="">
	<?php
	//print_r($location_list);
	
	?>
	
</div>
<div class="clearfix"></div>
<div class="col-sm-12 col-md-12 pad_top_20"><input class="btn btn-success" name="location_add" id="location_add" value="Save" type="submit"/> <button type="button" class="btn btn-danger pull-right" data-dismiss="modal" aria-hidden="true"><i class="glyphicon glyphicon-remove-sign"></i> Close</button></div>
<div class="clearfix"></div>
</form>
</div>
</div>
</div>
</div>
