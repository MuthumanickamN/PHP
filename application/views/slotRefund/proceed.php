<?php $this->load->view('includes/header3'); ?>
<div class="app-content content">
<div class="content-overlay"></div>
<div class="content-wrapper">
<div class="content-header row">
  <div class="content-header-left col-md-6 col-12 mb-2">
    <h3 class="content-header-title" style="color: green">Refund Request / Swap Slot</h3>
    <div class="row breadcrumbs-top">
      <div class="breadcrumb-wrapper col-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a>
          </li>
          <li class="breadcrumb-item"><a href="#"><?php echo $title;?></a>
          </li>
         
        </ol>
      </div>
    </div>
  </div>
</div>
<div class="content-body"><!-- Zero configuration table -->
<section id="configuration">
<div class="row">
<div class="col-sm-12">
<div class="card">
<div class="card-header">
    <h4 class="card-title"><?php echo $title;?></h4>
    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
   
</div>
<div class="card-content collapse show">
<div class="card-body card-dashboard">
  	<div  class="mainbox col-sm-12">
  	<div class="panel panel-info">
		<form id="refundProceedForm" class="form-horizontal" name="form" method="POST" style="margin-top: 25px; margin-left: 5px; margin-right: 5px" enctype="multipart/form-data">
			<div class="row">
				<div class="col-md-3 control ">
					<span><strong>Date</strong>*</span>
				</div>
				<div class="col-md-3 control ">
					<select name="bookingid" id="bookingid" class="form-control input-proceed-bookingid"  required="" onchange="getDetailsByDate()">
						<option value="">Select</option>
						<?php foreach ($bookingDateList as $key => $value) { ?>
							<option value="<?php echo $value['id'];?>"><?php echo date('d-m-Y',strtotime($value['checkout_date']));?></option>
						<?php } ?>
					</select>
					<span class="errorMsg"></span>
					<input type="hidden" name="activity_id" id="activity_id">
					<input type="hidden" name="location_id" id="location_id">
					<input type="hidden" name="level_id" id="level_id">
					<input type="hidden" name="lane_court_id" id="lane_court_id">
					<input type="hidden" name="coach_id" id="coach_id">
	          	</div>
          
	        <div class="col-md-3 control text-left"><strong>Activity</strong>*</div>
	        <div class="col-md-3 control text-left">
	        	<input type="text" id="activity" name="activity" class="form-control" readonly="">
	        </div>
	    </div>
	    <div class="row">
	        <div class="col-md-3 control text-left"><strong>Location</strong>*</div>
	        <div class="col-md-3 control text-left">  
	        <input type="text" id="location" name="location" class="form-control" readonly="">   
	        </div>
	    
	        <div class="col-md-3 control text-left"><strong>Lane/Court</strong>*</div>
	        <div class="col-md-3 control text-left">
	        <input type="text" id="lane_court" name="lane_court" class="form-control" readonly="">        
	        </div>
	    </div>

	     <div class="row">
	        <div class="col-md-3 control text-left"><strong>Level</strong>*</div>
	        <div class="col-md-3 control text-left">     
	        	<input type="text" id="level" name="level" class="form-control" readonly="">        
	        </div>
	        <div class="col-md-3 control text-left"><strong>Coach</strong>*</div>
	        <div class="col-md-3 control text-left">     
	        	<input type="text" id="coach" name="coach" class="form-control" readonly="">        
	        </div>
	    </div>

	     <div class="row">
	        <div class="col-md-3 control text-left"><strong>Slot Time From</strong>*</div>
	        <div class="col-md-3 control text-left">     
	        	<input type="text" id="from_time" name="from_time" class="form-control" readonly="">    
	        </div>
	    
	        <div class="col-md-3 control text-left"><strong>Slot Time To</strong>*</div>
	        <div class="col-md-3 control text-left"> 
	        	<input type="text" id="to_time" name="to_time" class="form-control" readonly=""> 
	        </div>
	    </div>
	       <div class="row">
	        <div class="col-md-3 control text-left"><strong>Slot Code</strong>*</div>
	        <div class="col-md-3 control text-left">     
	          <input type="text" id="slot_code" name="slot_code" class="form-control" readonly="">
	        </div>
	        <div class="col-md-3 control text-left"><strong>Slot Count</strong>*</div>
	        <div class="col-md-3 control text-left">     
	          <input type="text" id="slot_count" name="slot_count" class="form-control" readonly="">
	        </div></div>

	        
	      <div class="row">
	        <div class="col-md-3 control text-left"><strong>Hour</strong>*</div>
	        <div class="col-md-3 control text-left"> 
	          <input type="text" id="hour" name="hour" class="form-control" readonly="">
	        </div>
	      
	        <div class="col-md-3 control text-left"><strong>Days</strong>*</div>
	        <div class="col-md-3 control text-left">     
	          <select id="days" name="days" class="form-control choiceChosen" disabled="">
	            <option value="">Select</option>
	            <option value="Sunday" >Sunday</option> 
	             <option value="Monday">Monday</option>
	             <option value="Tuesday" >Tuesday</option>
	             <option value="Wednesday" >Wednesday</option>
	             <option value="Thursday"  >Thursday</option>
	             <option value="Friday" >Friday</option>
	           </select>
	        </div>
	    </div> 

	       <div class="row">
	        <div class="col-md-3 control text-left"><strong>Category</strong>*</div>
	        <div class="col-md-3 control text-left">     
	           <select id="category" name="category" disabled="" class="form-control choiceChosen">
	            <option value="">Select</option>
	            <option value="Kid" >Kid</option>
	             <option value="Adult" >Adult</option>
	           </select>
	        </div>
	        <div class="col-md-3 control text-left"><strong>Status</strong>*</div>
	        <div class="col-md-3 control text-left">     
	          <select id="status" name="status" class="form-control choiceChosen" disabled="">
	            <option value="">Select</option>
	            <option value="Approved" >Approved</option>
	             <option value="Pending" >Pending</option>
	           </select>
	        </div>
	    </div>
	    <div class="row">
	        <div class="col-md-3 control text-left"><strong>Type</strong>*</div>
	        <div class="col-md-3 control text-left">     
	           <select id="type" name="type" class="form-control choiceChosen" onchange="changeType()">
	            <option value="">Select</option>
	            <option value="Swap" >Swap</option>
	             <option value="Refund" >Refund</option>
	           </select>
	           <span class="errorMsg"></span>
	        </div>
	        <div class="col-md-3 control text-left"><strong>Amount</strong>*</div>
	        <div class="col-md-3 control text-left">     
	          <input type="text" id="amount" name="amount" class="form-control" readonly="">
	        </div>
	    </div>
	    
		    <div class="row" >
		        <div class="col-md-3 control text-left"><strong>Reason</strong>*</div>
		        <div class="col-md-3 control text-left">     
		          <textarea class="form-control" id="reason" name="reason"></textarea>
		          <span class="errorMsg"></span>
		        </div>
		        <div class="col-md-3 control text-left"><strong>Certificate</strong>*</div>
		        <div class="col-md-3 control text-left">     
		           <input type="file" name="medical_proof_file_name" id="medical_proof_file_name" onchange="return fileValidation(document.form.medical_proof_file_name)" ><p>(Only .pdf .png and .jpg are allowed)</p>
		           <span class="errorMsg"></span>
		        </div>
		    </div>
		    <div class="refundDiv " style="display: none;">
		    	<div class="row">
		        <div class="col-md-3 control text-left"><strong>Change Slot date</strong>*</div>
		        <div class="col-md-3 control text-left">     
		           <input type="text" id="change_slot_date" name="change_slot_date" class="form-control" onchange="getTimeSlot(this.value)" >
		           <span class="errorMsg"></span>
		        </div>
		        <input type="hidden" name="change_slot_from_time" id="change_slot_from_time">
		        <input type="hidden" name="change_slot_to_time" id="change_slot_to_time">
		        <div class="col-md-3 control text-left"><strong>Time Slot</strong>*</div>
		        <div class="col-md-3 control text-left">     
		          <select id="change_slot_time" name="change_slot_time" class="form-control choiceChosen">
		            <option value="">Select</option>
		           </select>
		           <span class="errorMsg"></span>
		        </div>

		        </div>

		    </div>

		<div class="row">
              <div class="col-md-6 control text-center">
                <button type="submit" id="save" class="btn btn-success"  ><b> Submit</b></button>
                <a href="<?php echo base_url().'index.php/slot_refund_request' ?>" class="btn btn-danger" >Cancel</a>
              </div>
            </div>


		</form>
	</div>
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

<script type="text/javascript">

$(document).ready(function(){
var date_input=$('input[name="change_slot_date"]'); 
date_input.datepicker({
	format: 'dd-mm-yyyy',
	startDate: '-0m',
	daysOfWeekDisabled: "<?php echo $daysList;?>",
})
})

function getTimeSlot(days){
	var bookingid = $('#bookingid').val();
	if(bookingid == ''){
		$('#bookingid').focus();
		$('#bookingid').parent().find(".errorMsg").html('Please select date');
		$('#change_slot_date').val('');
	}else{
		$('.errorMsg').html('');
		jQuery.ajax({
			type:'POST',
			url:baseurl+'index.php/Slot_refund_request/getTimeSlot',
			data:jQuery("form#refundProceedForm").serialize(),
			dataType:'json',    
			success: function (json) {
				$("#change_slot_time").html('');
				$("#change_slot_time").append("<option value=''>Select</option>");
				if (json['slotSelection']) {             
				    for (i in json['slotSelection']) {
				    	var idVal =json['slotSelection'][i]['id'];
				    	var timeSlot = json['slotSelection'][i]['slot_from_time']+' - '+json['slotSelection'][i]['slot_to_time'];
				        $("#change_slot_time").append("<option value='"+idVal+"'>"+timeSlot+"</option>");
				        $('#change_slot_from_time').val(json['slotSelection'][i]['slot_from_time']);
				        $('#change_slot_to_time').val(json['slotSelection'][i]['slot_to_time']);
				    }
				}
			},
			    
		});
	}
}

	function fileValidation(fileInput) {
	  var filePath = fileInput.value; 
	  // Allowing file type 
	  var allowedExtensions =  /(\.jpg|\.jpeg|\.png|\.gif)$/i; 
	  if (!allowedExtensions.exec(filePath)) { 
	      jQuery('#'+fileInput.id).parent().find(".errorMsg").html('Invalid file type (Accept only jpeg, png, jpg, gif)'); 
	      fileInput.value = ''; 
	      return false; 
	  }  
	  else{ 
	      // Image preview 
	      if (fileInput.files && fileInput.files[0]) { 
	          var reader = new FileReader(); 
	          reader.onload = function(e) { 
	              document.getElementById( 
	                  'imagePreview').innerHTML =  
	                  '<img src="' + e.target.result 
	                  + '"/>'; 
	          }; 
	          reader.readAsDataURL(fileInput.files[0]); 
	      } 
	  } 
	}
	function getDetailsByDate(){
		$('.errorMsg').html('');
		bookingid = $('#bookingid').val();
	    jQuery.ajax({
	        type:'POST',
	        url:baseurl+'index.php/Slot_refund_request/getDetailsByDate',
	        data:{bookingid: bookingid},
	        dataType:'json',    
	        success: function (json) {
	        	if(json['status'] == 'error'){
	        		location.reload();
	        	}else{
		            var booking = json['booking'];
		            $.each(booking, function(i, d) {
		                $('#'+i).val(d);
		            });
		        }

	        },
	              
	    });
	}
	function changeType(){
		var type = $('#type').val();
		if(type == 'Swap'){
			$('.refundDiv').css('display','block');
		}else{
			$('.refundDiv').css('display','none');
		}
	}
	$(document).ready(function (e) {
	$("#refundProceedForm").on('submit',(function(e) {
	  e.preventDefault();
	  $.ajax({
	    url: baseurl+'index.php/Slot_refund_request/addRequest',
	   type: "POST",
	   data:  new FormData(this),
	   contentType: false,
	    cache: false,
	   processData:false,
	   success: function(json){
	    $('.text-danger').remove();
	          if (json['error']) {             
	              for (i in json['error']) {
	                  if(i == 'error_msg'){
	                    location.reload();
	                  }
	                  var element = $('#'+ i);
	                  $(element).parent().find(".errorMsg").html(json['error'][i]);
	              }
	          } else {
	          	window.location.href = baseurl+'index.php/Slot_refund_request';
	          }
	      },
	     error: function (xhr, ajaxOptions, thrownError) {
	            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
	        }          
	    });
	 }));
	});

	
</script>