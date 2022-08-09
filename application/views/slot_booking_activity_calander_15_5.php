<?php 
require_once 'config.php';
 $this->load->view('includes/header3'); ?>
 <html>
 <body>
 <head>
  <title>Slot Booking Activity</title>
</head>
<style type="text/css">
.table
th
    {
        
        font-family: Arial, Helvetica;
    }
    .btn2
    {
        color: black;
        background-color: white;
    }
    .navbar-dark, .navbar-dark.navbar-horizontal {
    	height: 50px;
    }
    .modal-backdrop {background-color: transparent;z-index:0}
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
                       




          <form id="selectBooking" class="form-horizontal" role="form" name="form" method="POST" style="margin-top: 25px; margin-left: 5px; margin-right: 5px">
          <div class="row">
            <input type="hidden" name="sid" value="<?php echo $sid;?>" id="sid">
            <div class="col-md-2 control text-left"><strong>Activity</strong>
             <select name="game_id" id="game_id" class="form-control choiceChosen"  required="" >
                <option value="">Select</option>
                <?php                        
              $osql1 = "select game_id,game from games ORDER BY game ASC";                              
                $oexe1 = mysqli_query( $con, $osql1 );
                 while ( $row1 = mysqli_fetch_assoc( $oexe1 ) ){ ?>
            <option value="<?php echo $row1['game_id'] ?>" <?php if($row1['game_id']==$activity_id ){ echo 'selected';} ?>><?php echo $row1['game'] ?>
             </option><?php }  ?></select>
            </div>
            <div class="col-md-2 control text-left"><strong>Location</strong>     
             <select name="location_id" id="location_id" class="form-control choiceChosen"  required="" >
                <option value="">Select</option>
                <?php                        
              $osql3 = "select location_id,location from locations ORDER BY location ASC";                              
                $oexe3 = mysqli_query( $con, $osql3 );
                 while ( $row3 = mysqli_fetch_assoc( $oexe3 ) ){ ?>
            <option value="<?php echo $row3['location_id'] ?>" <?php if($row3['location_id']==$location_id ){ echo 'selected';} ?>><?php echo $row3['location'] ?>
             </option><?php }  ?></select>
            </div>
            <div class="col-md-2 control text-left"><strong>Coach</strong>             
            <select name="coach_id" id="coach_id"  class="form-control choiceChosen"  required="" >
                <option value="">Select</option>
                <?php                        
              $osql5 = "select coach_id,coach_name from coach";                              
                $oexe5 = mysqli_query( $con, $osql5 );
                 while ( $row5 = mysqli_fetch_assoc( $oexe5 ) ){ ?>
            <option value="<?php echo $row5['coach_id'] ?>" <?php if($row5['coach_id']==$coach_id){ echo 'selected';} ?>><?php echo $row5['coach_name'] ?>
             </option><?php }  ?></select>
            </div>
            <div class="col-md-2 control text-left"><strong>Hour</strong>             
             <select name="hour" id="hour"  class="form-control choiceChosen"  required="" >
                <option value="">Select</option>
                 <option value="One"  <?php if($hour==One){ echo 'selected';} ?>>One Hour Session</option>
                  <option value="Two"  <?php if($hour==Two){ echo 'selected';} ?>>Two Hour Session</option>
                </select>
            </div>

               <div class="col-md-2  control text-left">
                <button id="my1Btn" class="btn btn-primary margin-top-20" onClick="<?php echo base_url().'index.php/student_profile_slot_booking/book' ?>;$('#image').hide(); $('#booking').show()" >Show Slots</button>
               </div>
          </div>
        </form></div>

          <br/>
                       

<div id="booking">

<div class="pull-right">
    


<a type ="button" style="color: white" class="btn btn-primary my_cart_button" id="slot_booking_my_cart_button" data-id="" data-toggle="tooltip" title="My Cart"  ><i class="fa fa-shopping-cart" aria-hidden="true"> MY CART (<span class="my_cart_slot_count">0</span>) </i></a>
</div>
    <div class="clearfix"></div>


<div id="show2">

     <!--<div class="pull-right"><img  src="<?php echo base_url().'images/status_image.png' ?>" alt="Notes" title="Notes"></div>-->
    <div class="clearfix"></div>


    <div class="container">
    <div class="row">
    <div class="col-md-12">
    <h1>Add Slots and Sessions</h1>
    <div id="calendar">
    </div>
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
    <div class="modal-dialog" style="width: 100%; margin-top: 100px">
  <div class="modal-content" style="width: 100%">
      <div class="modal-body" style="width: 100%">
        <div class="alert alert-info">
          <!-- <a href="#" class="close" data-dismiss="modal" aria-label="close">X</a> -->
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: black" onClick="$('#myModal').hide();">&times;</button>
        
        <strong>Time Slot on<input type="text" name="dates" id="dates" style="border:0; background-color:#d9edf7"></strong>
        </div>
        <div class="alert alert-info">
     <h4><?php  echo $hour; ?>&nbsp;&nbsp;Hour Session</h4>
     <table id="slotSelection" class="table table-striped table-bordered dt-responsive nowrap" border="0" cellpadding="0" cellspacing="0" style="width:100%; background-color: white" >
    <thead>
        
            <tr>
              <th style="text-align: center;">S.No</th>
              <th style="text-align: center;">Time</th>
              <th style="text-align: center;">Slot</th>
            </tr>
          </thead>
          <tbody>
           <?php     
           $i=1;           
            foreach($slot_selection as $slot) { ?>
              <form id="addSlotSelection_<?php echo $slot['id']; ?>" class="form-horizontal"  name="form" method="POST" >
                <input type="hidden" name="dates" id="dates"  class="dates" >
                <input type="hidden" name="hour" id="hour" value="<?php echo $hour; ?>">
                <input type="hidden" name="activity_id" id="activity_id" value="<?php echo $activity_id; ?>">
                <input type="hidden" name="location_id" id="location_id"  value="<?php echo $location_id; ?>">
                <input type="hidden" name="coach_id" id="coach_id" value="<?php echo $coach_id; ?>">
                <input type="hidden" name="sid" id="sid" value="<?php echo $sid; ?>">
             <tr>       
        <td style="text-align: center"><?php echo $i; ?></td>
        <td style="text-align: center;"><?php echo $slot['slot_from_time']; ?>-<?php echo $slot['slot_to_time']; ?></td>
        <td style="text-align: center;"> 
          <button id="save" type="button" name="submit" onclick="addSlot('<?php echo $slot['id']; ?>')" class="btn btn-success" > ADD TO CART</button>
        </td>
        <input type="hidden" name="slot_from_time" id="slot_from_time" value="<?php echo $slot['slot_from_time']; ?>">
        <input type="hidden" name="slot_to_time" id="slot_to_time" value="<?php echo $slot['slot_to_time']; ?>">
        <input type="hidden" name="activityselection_id" id="activityselection_id" value="<?php echo $slot['id']; ?>">
      </tr>
      </form>
    <?php  $i++; } ?>
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

    
<script type="text/javascript">
function addSlot(id){
  jQuery.ajax({
        type:'POST',
        url:baseurl+'index.php/Student_profile_slot_booking/add_slot_booking',
        data:jQuery("form#addSlotSelection_"+id).serialize(),
        dataType:'json',                       
        success: function (result) {
          location.reload();
        }, 
               
    });
}

$(document).ready(function() {
   var date_last_clicked = null;
   $('#calendar').fullCalendar({
    defaultView: 'month',
   selectable: true,
   selectAllow: function(select) {
      return moment().diff(select.start) <= 0
   },
            eventSources: [
           {
            editable:true,
            header:{
                left:'prev,next today',
                center:'title',
                right:'month,agendaWeek,agendaDay'
            },
           events: function(start, end, timezone, callback) {
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
              }
            },
        ],
        validRange: function(nowDate){
             return {start: nowDate} //to prevent anterior dates
         },
        dayClick: function(date, jsEvent,allDay,  view) {
          date_last_clicked = $(this);
          var today=new Date();
        if(today.getHours() != 0 && today.getMinutes() != 0 && 
           today.getSeconds() != 0 && today.getMilliseconds() != 0){
            today.setHours(0,0,0,0);
        }
        if (date<today){
          swal("Error! Please select valid date");
        }
        else{
          
            $('#addModal').modal();
             $(this).css('background-color', '#bed7f3');
            var data=new Date(date).toISOString();
           var datas= moment(data).utc().format('YYYY-MM-DD');
            document.getElementById('dates').value=datas;
            $('.dates').val(datas);
             $(this).css('background-color', '#bed7f3');
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

