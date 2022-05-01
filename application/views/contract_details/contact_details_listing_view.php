<?php $this->load->view('includes/header3'); ?>
 <html>
 <body>
 <head>
  <title>Contract Detail</title>
</head>

<div class="app-content content">
<div class="content-overlay"></div>
<div class="content-wrapper">
  <div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
      <h3 class="content-header-title" style="color: green">Contract Detail Listing</h3>
      <div class="row breadcrumbs-top">
        <div class="breadcrumb-wrapper col-12">
          <ol class="breadcrumb">
            
           
           
          </ol>
        </div>
      </div>
    </div>
  </div>
<div class="content-body"><!-- Zero configuration table -->
<section id="configuration">
<div class="row">
<div class="col-12">
<div class="card">
<div class="card-header">
<h4 class="card-title">Contract Detail Listing</h4>
<a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>

</div>

<div class="panel panel-info" style="margin-top:20px; margin-left:20px;">
	<div class="row input-daterange" >
		<div class="col-md-3 col-md-offset-2 ">
			<input type="text" name="start_date" id="start_date" class="form-control start_date" autocomplete="off" required />
			<span class="errorMsg"></span>
		</div>
		<div class="col-md-3">
			<input type="text" name="end_date" id="end_date" class="form-control end_date" autocomplete="off" required />
		</div>
		<div class="col-md-3">
		<input type="button" name="select_listing" id="select_listing" value="Search" class="btn btn-info" />
		<input type="button" name="reset_listing" id="reset_listing" value="Reset" class="btn btn-warning" />
	</div>
	</div>
	
	
</div>


<div class="card-content">
<div class="card-body card-dashboard">
    <div class="table-responsive">
        <table id="example1" class="table table-striped table-bordered dt-responsive nowrap" border="0" cellpadding="0" cellspacing="0" style="width:100%">
            <thead>
                <tr>
                  <th style="text-align: center">S.No</th>
                  <th style="text-align: center">Student Name</th>
                  <th style="text-align: center">Parent Name</th>
                  <th style="text-align: center">Activity</th>
                  <th style="text-align: center">Contract From</th>
                  <th style="text-align: center">Contract To</th>
                  <th style="text-align: center">Vat Amount</th>
                  <th style="text-align: center">Net Amount</th>
                  <th style="text-align: center">Payment View</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
</div>
</div>
</div>
</div>
</section>
</div>
</div>
</div>
<!-- confirm modal -->

<!-- Modal 

<div class="modal" id="confirmModal"  style="display: none;" role="dialog" data-backdrop="static" data-keyboard="false" style="width: 100%;display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content panel panel-primary">
            <div class="modal-header panel-heading alert alert-info">
                    <h4 class="modal-title -remove-title">Student Detail</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
               </div>
            <div class="modal-body student_append alert alert-info">

            </div>

        </div>
    </div>
</div>-->

<div id="confirmModal" class="modal" role="dialog" data-backdrop="static" data-keyboard="false" style="width: 100%;display: none;">
  <div class="modal-dialog" style="width: 100%;
    float: none;
    margin: 0 auto;
    max-width: 38">
    <div class="modal-content">
      <div class="modal-body" style="width: 100%;">
      <div class="alert alert-info">
        <!-- <a href="#" class="close" data-dismiss="modal" aria-label="close">X</a> -->
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: black;opacity:0.6" onClick="$('#confirmModal').hide();">&times;<span class="close-x">Close</span></button>
        <strong>  Payment Details </strong>
      </div>
      <div class="student_append">
      </div>
      </div>
    </div>
  </div>
</div>  
            





</body>
</html>


<script type="text/javascript" language="javascript" >
var base_url = "<?php echo base_url(); ?>";
$(function () {

 
  $('.start_date').datepicker({
  todayBtn:'linked',
  format: "dd/mm/yyyy",
  autoclose: true
 });
 
   $('.end_date').datepicker({
  todayBtn:'linked',
  format: "dd/mm/yyyy",
  autoclose: true
 });
 
	contact_listing();
});




jQuery(document).on('click','#reset_listing', function(e){
	 location.reload();
});	

jQuery(document).on('click','#select_listing', function(e){

	var start_date= $("#start_date").val(); 
	var end_date = $("#end_date").val(); 
	

	if(start_date!="" && end_date !="")
	{
		contact_listing(start_date,end_date);
	}
	else
	{
		swal("","Please Select Start/End Date","warning");
	}	
  
}); 

function contact_listing(start_date="",end_date=""){

    $('#example1').DataTable( {
       
            "columnDefs": [
                {"className": "dt-center"}
              ],
        
            "searching": true,
            "processing": true,
            "serverSide": true,
            oLanguage: {
               // sProcessing: "<img src='"+base_url+"images/admin/loadingroundimage.gif' style='width:40px; height:40px;'>"
            },
           "ajax": {
                "url": base_url+'Contract_details/contact_listing',
                "type": 'POST',
				"data":{start_date : start_date,end_date:end_date},
                
            },
             "bDestroy": true
        });  

}



function show_student_details(contact_id)
{
	
	
	

	        jQuery.ajax({
            type:'POST',
            url:baseurl+'Contract_details/show_student_details',
			data :{contact_id : contact_id},
            dataType:'html',    
                   
            success: function (data) {
                $(".student_append").html(data);
				$("#confirmModal").modal("toggle");
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }          
        });
}

</script>

