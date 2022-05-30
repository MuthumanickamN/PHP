<?php 

 $this->load->view('includes/header3'); ?>
 <html>
 <body>
 <head>
  <title>Slot Booking Activity</title>
  
</head>
<style type="text/css">
    .modal-backdrop {background-color: transparent;z-index:0}
    .calendarDiv{ margin:20px; }
    .fc-past{background-color:#f2f2f0; }
    .row.subheading {
    background-color: #ccc;
    padding: 5px;
    border-radius: 3px;
    font-size: 18px;
}
    .make-booking{
		background-color:#f2f2f0;
		}
	.make-booking h6 {
		font-weight:700;
		}
	.text{
		background-color:transparent;
		}
	.payment{
		border:1px solid grey;
		}
	.apply{
		width:40%;
		}
	.thead{
		display:none;
		}
		.terms_conditions{
			color:blue !important;
		}
		.form-check-label a {
		color: blue;
		}
</style>
<div id="dialog" style="display: none; left:40%; position: fixed; background-color:#f4f5fa;
            height: 50px;line-height: 45px; width: 300px;" class="row">
            <span id="lblText" style="color: Green; top: 50px;"></span> <?php displayMessage(); ?></div>
 <div class="app-content content">
      <div class="content-overlay"></div>
      <div class="content-wrapper">
      
       <div class="content-body"><!-- Zero configuration table -->
<section id="configuration">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Slot Booking</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                   
                </div>
                <div class="card-content collapse show">
                <div class="card-body card-dashboard">

                <div  class="mainbox col-sm-12">
                <div class="panel panel-info">
                    <?php 
                    if($contract=="Yes") {
                    ?>
                    <div class="row subheading">
                      <b>Slot Booking - Name : <span class="stud_name"><?php echo $stud_name;?></span> in contract Activity : <span class="activity_name"><?php echo $activity_name;?></span></b>
                    </div>
                    <?php } else{ ?>
                    <div class="row subheading">
                      <b>Slot Booking - Name : <span class="stud_name"><?php echo $stud_name;?></span> Activity : <span class="activity_name"><?php echo $activity_name;?></span></b>
                    </div>
                    <?php } ?>



          <form id="selectBooking" class="form-horizontal" role="form" name="form" method="POST" style="margin-top: 25px; margin-left: 5px; margin-right: 5px" action="<?php echo base_url().'Student_profile_slot_booking/view_calender' ?>">
          <div class="row">
            <input type="hidden" name="sid" value="<?php echo $sid;?>" id="sid">
            <input type="hidden" name="parent_id" id="parent_id" value="<?php echo $parent_id;?>">
            <div class="col-md-2 control text-left"><strong>Activity</strong>
             <select name="activity_id" id="activity_id" class="form-control choiceChosen"  required="" >
                <option value="">Select</option>
                <?php                        
              if(isset($activityList)){ 
                foreach($activityList as $activityVal) {?>
            <option value="<?php echo $activityVal['game_id'] ?>" <?php if($activityVal['game_id']==$activity_id ){ echo 'selected';} ?>><?php echo $activityVal['game'] ?>
             </option><?php } } ?></select>
            </div>
            <div class="col-md-2 control text-left"><strong>Location</strong>     
             <select name="location_id" id="location_id" class="form-control choiceChosen"  required="" >
                <option value="">Select</option>
               <?php   
                if(isset($locationList)){                      
              foreach($locationList as $locationVal){ ?>
            <option value="<?php echo $locationVal['location_id'] ?>" <?php if($locationVal['location_id']==$location_id ){ echo 'selected';} ?>><?php echo $locationVal['location'] ?>
             </option><?php } } ?></select>
            </div>
            <div class="col-md-2 control text-left"><strong>Coach</strong>             
            <select name="coach_id" id="coach_id"  class="form-control choiceChosen"  required="" >
                <option value="">Select</option>
                <?php   
                if(isset($coachList)){                         
              foreach ($coachList as $coachVal){ ?>
            <option value="<?php echo $coachVal['coach_id'] ?>" <?php if($coachVal['coach_id']==$coach_id){ echo 'selected';} ?>><?php echo $coachVal['coach_name'] ?>
             </option><?php } } ?></select>
            </div>
            <div class="col-md-2 control text-left"><strong>Hour</strong>             
             <select name="hour" id="hour"  class="form-control choiceChosen"  required="" >
                <option value="">Select</option>
                 <option value="One"  <?php if($hour==One){ echo 'selected';} ?>>One Hour Session</option>
                  <option value="Two"  <?php if($hour==Two){ echo 'selected';} ?>>Two Hour Session</option>
                  <option value="Three"  <?php if($hour==Three){ echo 'selected';} ?>>Three Hour Session</option>
                </select>
            </div>

           <div class="col-md-2  control text-left">
               <input type="hidden" name="slot_id" id="slot_id" value="<?php echo $slot_id;?>">
            <input id="save" type="submit" name="submit" value="Show Slots" class="btn btn-success margin-top-20" />
           </div> 
          </div>
        </form></div>

          <br/>
                       

<div id="booking">

<div class="pull-right">
    

<?php if($slot_id == 0) { ?>
<a type ="button" style="color: white" class="btn btn-primary my_cart_button" id="slot_booking_my_cart_button" onclick="mycartview()" data-id="" data-toggle="tooltip" title="My Cart"  ><i class="fa fa-shopping-cart" aria-hidden="true"> MY CART (<span class="cart_slot"><?php echo $count;?></span>) <input type="hidden" value="<?php echo $count;?>" name="cart_slot" id="cart_slot"> </i></a>
<?php } ?>
</div>
    <div class="clearfix"></div>


<div id="show2">

     <!--<div class="pull-right"><img  src="<?php echo base_url().'images/status_image.png' ?>" alt="Notes" title="Notes"></div>-->
    <div class="clearfix"></div>

    <div class="row calendarDiv">
    <div class="col-md-12">
    <div id="calendar">
    </div>
    </div>
    </div>
    <div class="row myCartDiv" id="myCartDiv" style="display:none;">

    </div>
    

   <div class="container-fluid make-booking" style="margin-top:20px;display:none;">
    	<h3>Make Booking</h3>
    	<hr>
    	<div class="row mb-5">
    	<div class="col-md-3">
    		<h6>Parent-ID</h6>
    		<input type="text" class="text" id="parent_id_mb" placeholder="" readonly>
    	</div>
    	<div class="col-md-3">
    		<h6>Parent-Name</h6>
    	<input type="text" class="text" placeholder="" id="parent_name" readonly>
    	</div>
    	<div class="col-md-3">
    		<h6>Mobile-No</h6>
    		<input type="text" class="text" placeholder="" id="parent_mobile_no" readonly>
    	</div>
    	<div class="col-md-3">
    		<h6>Wallet Balance</h6>
    		<input type="text" class="text" placeholder="" id="wallet_balance" readonly>
    	</div>
    	</div>
    	<table class="table table-bordered">
    	<thead class="thead">
    		<tr>
    		<th></th>
    		<th></th>
    		<th></th>
    		<th></th>
    		</tr>
    	</thead>
    	<tbody>
    	<tr>
    	<div class="row">
    				<td class="col-md-4"> <h6>Mode</h6></td>
    				<td class="col-md-2"><p>Wallet</p></td>
    	</div>
    	</tr>
    	<tr>
    	<div class="row">
    			<td class="col-md-4"><h6>Gross Amount</h6></td>
    			<td  class="col-md-2"><p id="total_cart_amount"></p></td>
    		</div>
    		</tr>
    	<tr>
    	<div class="row">
    		<td class="col-sm-3"><h6>Payable Amount</h6></td>
    		<td class="col-sm-3"><input type="checkbox" id="payable_amount"></td>
    		<td class="col-sm-3"><textarea id="pa_description" class="pa_check" cols="30" rows="2" style="display:none;"></textarea></td>
    		<td class="col-sm-3">
    		    <div class="pa_check" style="display:none;">
    		    <input type="text" class="apply" id="apply_val" name="apply_value">
    			<button type="button" class=" btn btn-success apply_btn"  > <i class="fa fa-check"></i> Apply</button></div></td>
    		</div>
    		</tr>
    		<tr>
    		<div class="row">
    		<td class="col-md-3"><h6>VAT</h6></td>
    		<td class="col-md-3"><p><span id="vat_percentage"></span><span>%</span></p></td>
    		<td class="col-md-3"><h6>Net Amount <small id="inclusive_vat">(Inclusive of VAT)</small></h6></td>
    		<td class="col-md-3"><h6><p id="net_amount"></p></h6></td>
    		</div>
    		</tr>
    		<tr>
    		<div class="row">
    		<td class="col-md-3"><h6>VAT Amount</h6></td>
    		<td class="col-md-3"><p id="vat_amount"></p></td>
    		<td class="col-md-3"><h6>Wallet Balance</h6></td>
    		<td class="col-md-3"><h6><p id="wallet_balance_after"></p></h6></td>
    		</div>
    		</tr>
    	</tbody>
    	</table>
    	<div class="form-check tc_check" style="display:block;">
    		<input type="checkbox" name="tc_chkbox" id="tc_chkbox">
    		<label class="form-check-label">
    		I have read and agreed to the <a href="http://sports.primestaruae.com/assets/TERMS%20&%20Conditions%20-%20Prime%20Star%20Sports%20Services.pdf" target="_blank"><span style="font-size:20px;"> Terms & Conditions </span></a> as mentioned in the link
    		</label>
        
		</div>
		<div>
		    <button type="button" style="display:none;margin-top:20px;" class=" btn btn-success proceed_btn"  > <i class="fa fa-check"></i> Proceed</button></div></td>
	    </div>
	</div>
          </div>
          <div class="body">
            
            
          </div>
      </div>
    </div>
    <style>
body {font-family: Arial, Helvetica, sans-serif;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); 
  /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  position: relative;
  background-color: white;
  margin: auto;
  padding: 0;
  border: 1px solid #888;
  width: 100%;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
  -webkit-animation-name: animatetop;
  -webkit-animation-duration: 0.4s;
  animation-name: animatetop;
  animation-duration: 0.4s;

}

/* Add Animation */
@-webkit-keyframes animatetop {
  from {top:-300px; opacity:0} 
  to {top:0; opacity:1}
}

@keyframes animatetop {
  from {top:-300px; opacity:0}
  to {top:0; opacity:1}
}

/* The Close Button */
.close {
  color: white;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

.modal-header {
  padding: 2px 16px;
  color: white;
}

.modal-body {
  padding: 2px 16px;
  background-color: white;
}


.alert-info {
    background-color: #d9edf7!important;
    color: #053858!important;
    margin-top: 15px;
}

</style>
<div id="addModal" class="modal" role="dialog" data-backdrop="static" data-keyboard="false" style="display: none;">
    <div class="modal-dialog" style="width: 30%; margin-top: 100px">
  <div class="modal-content" style="width: 100%">
      <div class="modal-body" style="width: 100%">
        <div class="alert alert-info">
          <!-- <a href="#" class="close" data-dismiss="modal" aria-label="close">X</a> -->
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: black;opacity:0.6" onClick="$('#addModal').hide();">&times;<span class="close-x">Close</span></button>
        
        <strong>Time Slot on<input type="text" name="show_date" id="show_date" style="border:0; background-color:#d9edf7"></strong>
        </div>
        <div class="alert alert-info">
     <h4><?php  echo $hour; ?>&nbsp;&nbsp;Hour Session</h4>
     <table id="slotSelection" class="table table-striped table-bordered dt-responsive nowrap" border="0" cellpadding="0" cellspacing="0" style="width:100%; background-color: white" >
    <thead>
        
            <tr>
              <th style="text-align: center;">Time</th>
              <th style="text-align: center;">Slot</th>
            </tr>
          </thead>
          <tbody>
           
    
    
    </tbody>
  </table>
   <br>
   
       
    </div>
  </div>
</div>
</div>

  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
 <!--<link rel="stylesheet" href="<?php echo base_url().'css2/calendar.css' ?>" >-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css"  />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js" ></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <script>
      var baseurl = "<?php echo site_url(); ?>";
      var hour = "<?php echo $hour; ?>";
      var coach_id = "<?php echo $coach_id; ?>";
      var location_id = "<?php echo $location_id; ?>";
      var activity_id = "<?php echo $activity_id; ?>";
      var slot_id = "<?php echo $slot_id; ?>";
      var role = "<?php echo strtolower($this->session->userdata('role')); ?>";
      
      </script>
<script type="text/javascript">
function addSlot(this_){
    
 /* jQuery.ajax({
        type:'POST',
        url:baseurl+'Student_profile_slot_booking/add_slot_booking',
        data:jQuery("form#addSlotSelection_"+id).serialize(),
        dataType:'json',                       
        success: function (result) {
          if(result['status'] == 'success'){
            $('#cart_slot').val(result['count'])
            $('.cart_slot').html(result['count'])
            $('.close').click()
          }else{
            location.reload();
            
          }
        }, 
               
    });*/
    
    
        
        var activity_id = $(this_).attr('data-activity_id'); 
        var location_id = $(this_).attr('data-location_id'); 
        var coach_id = $(this_).attr('data-coach_id'); 
        var lane_id = $(this_).attr('data-lane_id'); 
        var hour = $(this_).attr('data-hour'); 
        var slot_to_time = $(this_).attr('data-slot_to_time'); 
        var slot_from_time = $(this_).attr('data-slot_from_time'); 
        var dates = $(this_).attr('data-dates'); 
        var sid = $(this_).attr('data-sid');
        var activityselection_id = $(this_).attr('data-activityselection_id');
        var slot_id = $(this_).attr('data-slot_id');
        
        jQuery.ajax({
            type:'POST',
            url:baseurl+'Student_profile_slot_booking/add_slot_booking',
            data:{
                activity_id:activity_id,
                location_id:location_id,
                coach_id:coach_id,
                lane_id:lane_id,
                slot_from_time:slot_from_time,
                slot_to_time:slot_to_time,
                dates:dates,
                sid:sid,
                activityselection_id:activityselection_id,
                slot_id:slot_id,
                hour:hour
            },
            dataType:'json',                       
            success: function (result) {
              if(result['status'] == 'success'){
                $('#cart_slot').val(result['count'])
                $('.cart_slot').html(result['count'])
                $('.close').click()
                
                swal({
                  title: "Added to Cart!",
                  text: "",
                  type: "success",
                  timer: 1000
               });
               
                $('#calendar').fullCalendar('refetchEvents');
                //location.reload();
              }else{
                location.reload();
                
              }
            }, 
                   
        });
}

//function swapSlot(id, slot_id){
function swapSlot(this_){
  
  /*jQuery.ajax({
        type:'POST',
        url:baseurl+'Student_profile_slot_booking/swap_slot_booking',
        data:jQuery("form#addSlotSelection_"+id).serialize(),
        dataType:'text',                       
        success: function (result) {
            
            swal("Swapped", "", "success");
            setTimeout(function(){ 
                window.location.href=baseurl+result; 
            
            }, 3000);
          
        }, 
               
    });*/
    
    var activity_id = $(this_).attr('data-activity_id'); 
    var location_id = $(this_).attr('data-location_id'); 
    var coach_id = $(this_).attr('data-coach_id'); 
    var lane_id = $(this_).attr('data-lane_id'); 
    var hour = $(this_).attr('data-hour'); 
    var slot_to_time = $(this_).attr('data-slot_to_time'); 
    var slot_from_time = $(this_).attr('data-slot_from_time'); 
    var dates = $(this_).attr('data-dates'); 
    var sid = $(this_).attr('data-sid');
    var activityselection_id = $(this_).attr('data-activityselection_id');
    var slot_id = $(this_).attr('data-slot_id');
    var slotid = $(this_).attr('data-slotid');
    
     jQuery.ajax({
            type:'POST',
            url:baseurl+'Student_profile_slot_booking/swap_slot_booking',
            data:{
                activity_id:activity_id,
                location_id:location_id,
                coach_id:coach_id,
                lane_id:lane_id,
                slot_from_time:slot_from_time,
                slot_to_time:slot_to_time,
                dates:dates,
                sid:sid,
                activityselection_id:activityselection_id,
                slot_id:slot_id,
                hid_slot_id:slotid,
                hour:hour,
            },
            //dataType:'json',                       
            success: function (result) {
               // alert(123);
                swal("Swapped", "", "success");
                setTimeout(function(){ 
                    window.location.href=baseurl+result; 
                }, 3000);
              
            }, 
                   
        });
    
}


function mycartview(){
  $('.calendarDiv').css('display','none');
  $('.myCartDiv').css('display','block');
  $('.make-booking').css('display','none');
  var stud_id = $('#sid').val();
  var parent_id = $('#parent_id').val();
  var activity_id = $('#activity_id').val();
  $.ajax({
    url:"<?php echo base_url().'Student_profile_slot_booking/getCartDetails/'; ?>"+stud_id+"/"+activity_id+"/"+parent_id,
    type:"POST",
    //data:{sid:stud_id,activity_id:activity_id},
    success:function(result){   
      document.getElementById('myCartDiv').innerHTML=result;
    }
});
}
function backView(){
    $('.calendarDiv').css('display','block');
    $('.myCartDiv').css('display','none');
    $('.make-booking').css('display','none');
    $('.fc_highlighted ').css('background-color','transparent');
    $('#calendar').fullCalendar('refetchEvents');
}
function checkout(parent_id, total){
   $('.make-booking').css('display','block');
   
  $.ajax({
          url:"<?php echo base_url().'Student_profile_slot_booking/makeBookingDetails/'; ?>",
          type:"POST",
          data:{parent_id:parent_id},
          success:function(data){   
            var obj = JSON.parse(data);
             $('#parent_id_mb').val(obj.parent_code);
             $('#parent_name').val(obj.parent_name);
             $('#parent_mobile_no').val(obj.mobile_no);
             $('#wallet_balance').val(obj.balance_credits);
             $('#vat_percentage').html(obj.percentage);
             $('#total_cart_amount').html(total);
             
             var vat_amount = (parseFloat(total)*parseFloat(obj.percentage)/100);
             var net_amount = parseFloat(total)+parseFloat(vat_amount);
             $('#vat_amount').html(vat_amount.toFixed(2));
             $('#net_amount').html(net_amount.toFixed(2));
             
             var w_b_a  = parseFloat(obj.balance_credits) - parseFloat(net_amount)
             $('#wallet_balance_after').html(w_b_a.toFixed(2));
            
            if(obj.balance_credits < net_amount)
            {
                swal("Insufficient Wallet Amount", "", "warning");
                $('#wallet_balance_after').css('color','red');
                $('.tc_check').css('display','none');
                return false; 
            }
            else
            {
                $('#wallet_balance_after').css('color','green');
                $('.tc_check').css('display','block');
                return false; 
            }
          }
  });
    return false;
  
}

function checkout_confirm()
{
    var role = "<?php echo $role;?>";
    var sid = $('#sid').val();
    var payable_amount_chk = 0;
    var payable_amount = '';
    var payable_description = '';
    if($("#payable_amount").prop('checked') == true){
       payable_amount_chk = 1;
       payable_amount = $('#apply_val').val();
       payable_description = $('#pa_description').val();
    }
    var vat_percentage = $('#vat_percentage').html();
    
    $.ajax({
          url:"<?php echo base_url().'Student_profile_slot_booking/checkout/'; ?>",
          type:"POST",
          data:jQuery("form#myCartForm").serialize() + '&payable_amount_chk=' + payable_amount_chk+ '&payable_amount=' + payable_amount+ '&payable_description=' + payable_description+ '&vat_percentage=' + vat_percentage,
          success:function(data){   
            
               // location.reload();
               //alert(role);
               if(role == "parent")
               {
                    window.location.href = base_url+'Active_kids/';
               }
               else
               {
               window.location.href = base_url+'Students/edit/'+sid;
               }
          }
      });
}
function deletetmp(idval){
    confirmDialog('Are you sure want to the delete?', function(){
        $.ajax({
          url:"<?php echo base_url().'Student_profile_slot_booking/deletetmp/'; ?>"+idval,
          type:"POST",
          success:function(data){   
            cartCount = $('#cart_slot').val();

            var newVal = parseInt(cartCount)-1;
            $('#cart_slot').val(newVal);
            $('.cart_slot').html(newVal);
            document.getElementById('myCartDiv').innerHTML=data;
            
            if($('.make-booking').is(":visible"))
            {
                $(".checkout_btn").click(); 
                $('#payable_amount').prop('checked', false);
                $('#pa_description').val('');
                $('#apply_val').val('');
                $('.tc_check').css('display','block');
                $('#tc_chkbox').prop('checked',false);
                $('.pa_check').css('display','none');

                return false;
            }
          }
      });
    });
}

function confirmDialog(message, onConfirm){
    var fClose = function(){
        modal.modal("hide");
    };
    var modal = $("#confirmModal");
    modal.modal("show");
    $('.modal-backdrop').addClass('show');
    $('.modal-backdrop').addClass('in');
    $("#confirmMessage").empty().append(message);
    $("#confirmOk").unbind().one('click', onConfirm).one('click', fClose);
    $("#confirmCancel").unbind().one("click", fClose);
}

$(document).ready(function() {
  var parent_id = $('#parent_id').val();
  var activity_id = $('#activity_id').val();
  var location_id = $('#location_id').val();
  var slot_id = $('#slot_id').val();
  var date_last_clicked = null;
  var stud_id = $('#sid').val();
  
   var holidays = [];
    $.ajax({
          url:"<?php echo base_url().'Student_profile_slot_booking/get_holidays/'; ?>",
          type:"POST",
          success:function(data){   
            var obj = JSON.parse(data);
            holidays = obj;
          }
    });
    
      
   $('#calendar').fullCalendar({
    defaultView: 'month',
   selectable: true,
       
   selectAllow: function(select) {
      return moment().diff(select.start) <= 0
   },
   
   events : '<?php echo base_url() ?>Student_profile_slot_booking/get_events/'+stud_id+'/'+parent_id+'/'+activity_id+'/'+location_id+'/'+slot_id,
 /* eventTimeFormat: { // like '14:30:00'
    hour: '2-digit',
    minute: false,
    second: false,
    meridiem: false
  },*/
   eventMouseover: function (data, event, view) {

            //tooltip = '<div class="tooltiptopicevent" style="width:auto;height:auto;background:#feb811;position:absolute;z-index:10001;padding:10px 10px 10px 10px ;  line-height: 200%;">' + 'Activity ' + ': ' + data.title  + '</div>';
            tooltip = '<div class="tooltiptopicevent" style="width:auto;height:auto;background:#feb811;position:absolute;z-index:10001;padding:10px 10px 10px 10px ;  line-height: 200%;">'  + data.title  + '</div>';


            $("body").append(tooltip);
            $(this).mouseover(function (e) {
                $(this).css('z-index', 10000);
                $('.tooltiptopicevent').fadeIn('500');
                $('.tooltiptopicevent').fadeTo('10', 1.9);
            }).mousemove(function (e) {
                $('.tooltiptopicevent').css('top', e.pageY + 10);
                $('.tooltiptopicevent').css('left', e.pageX + 20);
            });


        },
         eventMouseout: function (data, event, view) {
            $(this).css('z-index', 8);

            $('.tooltiptopicevent').remove();

        },

    eventSources: [
    {
    editable:true,
    header:{
        left:'prev,next today',
        center:'title',
        right:'month,agendaWeek,agendaDay'
    },
    eventRender: function (event, element) {
        var eventDate = event.start;
        alert(1);
        var calendarDate = $('#calendar').fullCalendar('getDate');
        alert(eventDate.get('month'), calendarDate.get('month'));
        if (eventDate.get('month') !== calendarDate.get('month')) {
            return false;
        }
    },
    /*events: function(start, end, timezone, callback) {
          $.ajax({
              url: '<?php echo base_url() ?>index.php/Student_profile_slot_booking/get_events',
              dataType: 'json',
              data: {
                  start: start.unix(),
                  end: end.unix()
              },
              success: function(msg) {
                  var events = msg.events;
                  callback(events);
              }
          });
        }*/
    },
    ],
    /*validRange: function(nowDate){
         return {start: nowDate} //to prevent anterior dates
     },*/
    dayClick: function(date, jsEvent,allDay,  view) {
      date_last_clicked = $(this);
      var today=new Date();
   if(today.getHours() != 0 && today.getMinutes() != 0 && 
       today.getSeconds() != 0 && today.getMilliseconds() != 0){
        today.setHours(0,0,0,0);
    } 
    var month = today.getMonth() + 1; //months from 1-12
    var day = today.getDate();
    var year = today.getFullYear();
    var today2 = month + "/" + day + "/" + year;
    today=new Date(today2).getTime();
    
    today = new Date().setHours(0, 0, 0, 0);
    var thatDay = new Date(date).setHours(0, 0, 0, 0);
    var thatDay3 = new Date(date);
    var month2 = thatDay3.getMonth() + 1; //months from 1-12
    var day2 = thatDay3.getDate();
    var year2 = thatDay3.getFullYear();
    var thatDay2 = year2 + "-" + month2 + "-" + day2;
    
    if ($.inArray(thatDay2, holidays) != -1)
    {
        swal('Holiday');
        return false;
    }
    
    t_month =  new Date().getMonth();
    t_year =  new Date().getFullYear();
    
    d_month =  new Date(date).getMonth();
    d_year =  new Date(date).getFullYear();
    
    l_t_date = new Date();
    var lastDay = new Date(l_t_date.getFullYear(), l_t_date.getMonth() + 1, 0);
    var lastDate = lastDay.getDate();
    //alert(lastDate);
    if (date<today){
      swal("Error! Please select valid date");
    }
    else{
        
        if(t_year < d_year)
        {
            swal("Warning", "Sorry, you can book only current year slot", "error");
            return false;
        }
        else if(t_year == d_year)
        {
            /*if((t_month < d_month) && (t_month + 1 == d_month))
            {
                if(lastDate != day || lastDate+1 != day) //only allow to book next month slots on end of the month 30 & 31 st
                {
                    if(role !='superadmin22'){
                    swal("Warning", "Sorry, slot is not available to book.Please try to book on end of the month.", "error");
                    return false;
                    }
                }
            }
            else
            {
                if(t_month != d_month)
                {
                    if(role !='superadmin22'){
                    swal("Warning", "Sorry, slot is not available to book.Please try to book on end of the current month.", "error");
                    return false;
                    }
                }
            }*/
            
        }
        
        
        
        if(slot_id !=0)
            {
                
                if((t_month == d_month) && (t_year == d_year) )
                {
                    
                }
                else
                {
                    swal("Warning", "Sorry, you can swap only current month slot", "error");
                    return false;
                }
            }
        
        
        
        
        if(role  == 'parent')
        {
           
            if(today === thatDay){
                swal("Access Denied", "Sorry, Parent can't book it.", "error");
                return false;
            }
            else
            {
              day_val = $('#day_val').val();
              clickDay = date.day();
              set_form( activity_id, slot_id, coach_id, location_id, hour,  clickDay, thatDay2);
              $('#addModal').modal();
              $(this).css('background-color', '#bed7f3');
              $(this).addClass('fc_highlighted');
              var data=new Date(date).toISOString();
              var datas= moment(data).utc().format('YYYY-MM-DD');
              var datas2= moment(data).utc().format('DD/MM/YYYY');
              //document.getElementById('dates').value=datas;
              $("button.form_date").each(function(){
                $(this).attr("data-dates",datas);
              });
              document.getElementById('show_date').value=datas2;
              $('.dates').val(datas);
              $(this).css('background-color', '#bed7f3');
              $('.daysDiv').hide();
              $('.showDays_'+clickDay).show(); 
                
            }
            
            
        }
        else
        {
          day_val = $('#day_val').val();
          clickDay = date.day();
          set_form( activity_id, slot_id, coach_id, location_id, hour,  clickDay, thatDay2);
          $('#addModal').modal();
          $(this).css('background-color', '#bed7f3');
          $(this).addClass('fc_highlighted');
          var data=new Date(date).toISOString();
          var datas= moment(data).utc().format('YYYY-MM-DD');
          var datas2= moment(data).utc().format('DD/MM/YYYY');
          //document.getElementById('dates').value=datas;
          $("button.form_date").each(function(){
            $(this).attr("data-dates",datas);
          });
          document.getElementById('show_date').value=datas2;
          $('.dates').val(datas);
          $(this).css('background-color', '#bed7f3');
          $('.daysDiv').hide();
          $('.showDays_'+clickDay).show(); 
        }
    }
            
       
    },
   eventClick: function(event, jsEvent, view) {
      $('#name').val(event.title);
      $('#description').val(event.description);
      $('#start_date').val(moment(event.start).format('YYYY/MM/DD HH:mm'));
      if(event.end) {
        $('#end_date').val(moment(event.end).format('YYYY/MM/DD HH:mm'));
      } else {
        $('#end_date').val(moment(event.start).format('YYYY/MM/DD HH:mm'));
      }
      $('#event_id').val(event.id);
      $('#editModal').modal();
   },
    });
   
    
    $('#payable_amount').change(function() {
        if(this.checked) {
            $('.pa_check').css('display','block');
            $('.tc_check').css('display','none');
            $('.proceed_btn').css('display','none');
        }
        else
        {
           $('#apply_val').val('');
           $('#pa_description').val('');
           var gross_amount = $('#total_cart_amount').text();
           var vat_percentage = $('#vat_percentage').text();
           
           var vat_amount = parseFloat((parseFloat(gross_amount) * parseFloat(vat_percentage)) /100).toFixed(2);
           $('#vat_amount').text(vat_amount);
           
           var net_amount = parseFloat(parseFloat(gross_amount) + parseFloat(vat_amount)).toFixed(2);
           $('#net_amount').text(net_amount);
           var wallet_balance = $('#wallet_balance').val();
           var wallet_balance_after = parseFloat(parseFloat(wallet_balance) - parseFloat(net_amount)).toFixed(2);
           $('#wallet_balance_after').text(wallet_balance_after);
           
           if(wallet_balance_after < 0)
            {
                swal("Insufficient Wallet Amount", "", "warning");
                $('#wallet_balance_after').css('color','red');
                $('.pa_check').css('display','none');  
                $('.tc_check').css('display','none');
                $('.proceed_btn').css('display','none');
                return false; 
            }
            else
            {
                $('#wallet_balance_after').css('color','green');
                $('.pa_check').css('display','none');  
               $('.tc_check').css('display','block');
               $('#tc_chkbox').prop('checked',false);
               $('.proceed_btn').css('display','block');
                return false; 
            }
            
           
           //$('.proceed_btn').css('display','block');
        }
               
    });
    
    $('#tc_chkbox').change(function() {
        if(this.checked) {
            $('.proceed_btn').css('display','block');
        }
        else
        {
          $('.proceed_btn').css('display','none');
        }
               
    });
    
    

    $('.proceed_btn').on('click',function(){
        var wallet_balance_after = parseFloat($('#wallet_balance_after').text());
        
        if(wallet_balance_after < 0)
        {
            swal("Insufficient Wallet Amount", "", "warning");
            return false;
        }
        else
        {
            //alert('confirm');
            //return false;
            checkout_confirm();
        }
        
    });
    
    $('.addSlot').on('click',function(){
        var this_ = this;
        
        var activity_id = $(this).attr('data-activity_id'); 
        var location_id = $(this).attr('data-location_id'); 
        var coach_id = $(this).attr('data-coach_id'); 
        var lane_id = $(this).attr('data-lane_id'); 
        var hour = $(this).attr('data-hour'); 
        var slot_to_time = $(this).attr('data-slot_to_time'); 
        var slot_from_time = $(this).attr('data-slot_from_time'); 
        var dates = $(this).attr('data-dates'); 
        var sid = $(this).attr('data-sid');
        var activityselection_id = $(this).attr('data-activityselection_id');
        var slot_id = $(this).attr('data-slot_id');
        
        jQuery.ajax({
            type:'POST',
            url:baseurl+'Student_profile_slot_booking/add_slot_booking',
            data:{
                activity_id:activity_id,
                location_id:location_id,
                coach_id:coach_id,
                lane_id:lane_id,
                slot_from_time:slot_from_time,
                slot_to_time:slot_to_time,
                dates:dates,
                sid:sid,
                activityselection_id:activityselection_id,
                slot_id:slot_id,
            },
            dataType:'json',                       
            success: function (result) {
              if(result['status'] == 'success'){
                $('#cart_slot').val(result['count'])
                $('.cart_slot').html(result['count'])
                $('.close').click()
              }else{
                location.reload();
                
              }
            }, 
                   
        });
    });
    $('.apply_btn').on('click',function(){
        
        var apply_val = $('#apply_val').val();
        var pa_description = $('#pa_description').val();
        if(apply_val != "")
        {
            if(pa_description == "")
            {
                $('#pa_description').focus();
                swal("Warning", "Please enter Description", "warning");
                
                return false;
            }
            var apply_val = parseFloat(apply_val).toFixed(2);
            var balance_credits = $('#wallet_balance').val();
            var percentage = $('#vat_percentage').html();
            //$('#total_cart_amount').html(apply_val);
             
            var vat_amount = (parseFloat(apply_val)*parseFloat(percentage)/100);
            var net_amount = parseFloat(apply_val)+parseFloat(vat_amount);
            $('#vat_amount').html(vat_amount.toFixed(2));
            $('#net_amount').html(net_amount.toFixed(2));
             
            var w_b_a  = parseFloat(balance_credits) - parseFloat(net_amount)
            $('#wallet_balance_after').html(w_b_a.toFixed(2));
            
            
            if(balance_credits < net_amount)
            {
                swal("Insufficient Wallet Amount", "", "warning");
                $('#wallet_balance_after').css('color','red');
                $('.tc_check').css('display','none');
                $("#tc_chkbox").prop('checked',false);
                $('.proceed_btn').css('display','none');
                return false; 
            }
            else
            {
                $('#wallet_balance_after').css('color','green');
                $('.tc_check').css('display','block');
                $("#tc_chkbox").prop('checked',false);
                $('.proceed_btn').css('display','none');
                //checkout_confirm();
                return false; 
            }
        }
        else
        {
            $('#apply_val').focus();
            swal("Warning", "Please enter payable amount", "warning");
            
        }
        
        
    });
    
    function set_form( activity_id, slot_id, coach_id, location_id, hour,  clickDay, date)
    {
        var sid = $('#sid').val();
        //alert(activity_id+' '+slot_id+' '+coach_id+' '+location_id+' '+hour+' '+clickDay+' '+date);
         $.ajax({
          url:"<?php echo base_url().'Student_profile_slot_booking/set_form/'; ?>",
          data:{activity_id:activity_id,slot_id:slot_id,coach_id:coach_id,location_id:location_id,hour:hour,clickDay:clickDay,date:date, sid:sid},
          type:"POST",
          async:false,
          success:function(data){   
            $('#slotSelection tbody').html(data);
           //document.getElementById('slotSelection tbody').innerHTML=data;
          }
      });
    }
    
});
</script>
    
          
          
            




                         </div>
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
   </body>
   </html>

