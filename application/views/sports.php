<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets_booking/css2/style.css">
<section class="content-header">
<h1>Manage Sports</h1>
<ol class="breadcrumb">
<li><i class="fa fa-map-marker" aria-hidden="true"></i> Manage Sports</li>
<li class="active">Add Sports</li>
</ol>
</section>
<!-- Main content -->
<!-- Main content -->
<section class="content admin_table">
<div class="col-sm-12 col-md-12 add_button"><button type="button"  data-toggle="modal" data-target="#editModal" class="btn btn-success pull-right add_sports"><i class="fa fa-user-plus" aria-hidden="true"></i> &nbsp; Add New Sports</button>
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
<table id="spo_list_table" class="table table-bordered table-striped">
	<thead>
		<tr>
		    <th>S.No</th>
			<th>Sports</th>
			<th class="no-sort">Edit</th>
			<th class="no-sort">Status</th>
		</tr>
	</thead>
	<tbody>
		<tr>
		<!--	<td>Egyptian Club in Oudmetha Road</td>
			<td><a href="#" title="Edit" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
			<td><button type="submit" title="Remove" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></button></td>-->
		</tr>
		
	</tbody>
</table>
</div>
<div class="clearfix"></div>
</section>
<!-- /.content -->

<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url(); ?>assets_booking/libraries/demo.js"></script>
<script src="<?php echo base_url(); ?>assets_booking/js/sports.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("#editModal").on('hide.bs.modal', function () {
         var validator = $( '#sports_form' ).validate();
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
	
$("#example1").DataTable();
$('#spo_list_table').DataTable({
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


	
$('[data-toggle="tooltip"]').tooltip();  
	

jQuery.validator.addMethod("alphanumeric", function(value, element) {
    return this.optional(element) || /^[a-zA-Z ]+$/i.test(value);
}, "Letters, numbers, and underscores only please");

jQuery.validator.addMethod('chk_sports_exist', function (value) {
        var sports_hidden_id = $("#sports_hidden_id").val();
        var sports_name = $('#sports').val().trim();
        var return_var = '';
        if(sports_name != ''){
            $.ajax({ 	
                    type: "POST",   
                    url: base_url+"sports/check_Sports_exist",
                    data:"sports_hidden_id="+sports_hidden_id+"&sports_name="+sports_name,		
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

$(document).on('click', '#sports_add', function () {
	
	
     
    $("#sports_form").validate({
		
        // Specify validation rules
       rules: {
            sports: {
				required : true,
				alphanumeric:true,
				chk_sports_exist:true
				}
        },
        messages: {
            sports:{
				required:"Please enter the sports name",
				alphanumeric:"Special characters and numbers are not allowed",
				chk_sports_exist:"Entered sports name is already existing"
			} 
            
        }
    });
		var sports=$('#sports').val();
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
<button type="button" class="close close-icon" data-dismiss="modal" aria-hidden="true">&times;<span class="close-x">Close</span></button>
<h4 class="modal-title">Edit / Add New Sports</h4>
</div>
<div class="modal-body">
<form name="sports_form" id="sports_form" action="<?php echo base_url(); ?>sports/add_sports"  method="POST" class="form-horizontal" role="form" autocomplete="off">
<div class="col-sm-12 col-md-12">
	<p class="form_text1">Sports</p>
	<input type="text" name="sports" id="sports" placeholder="Egyptian Club in Oudmetha Road" value="">
	<input type="hidden" name="sports_hidden_id" id="sports_hidden_id" value="">
</div>
<div class="clearfix"></div>
<div class="col-sm-12 col-md-12 pad_top_20"><input class="btn btn-success" name="sports_add" id="sports_add" value="Save" type="submit"/> <button type="button" class="btn btn-danger pull-right" data-dismiss="modal" aria-hidden="true"><i class="glyphicon glyphicon-remove-sign"></i> Close</button></div>
<div class="clearfix"></div>
</form>
</div>
</div>
</div>
</div>
