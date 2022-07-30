<?php $this->load->view('includes/header3'); ?>
<div class="app-content content">
      <div class="content-overlay"></div>
      <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title" style="color: green">School</h3>
            <div class="row breadcrumbs-top">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.html">School</a>
                  </li>
                  <li class="breadcrumb-item"><a href="#"><?php echo $title;?></a>
                  </li>
                 
                </ol>
              </div>
            </div>
          </div>
          <div class="content-header-right col-md-6 col-12">
            <div class="media float-right">
              <media-left class="media-middle">
                <div id="sp-bar-total-sales"></div>
              </media-left>
              <div class="media-body media-right ">
                 <ul class="list-inline mb-0">
                  
            <li> <a href="<?php echo site_url('index.php/school_attendance'); ?>" class="btn btn-primary"   ><b><i class="fa fa-list"></i>School Attendance</b></a></li>
          </ul>
                
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
                    <h4 class="card-title"><?php echo $title;?></h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                   
                </div>

                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                      <form id="school_booking" class="form-horizontal" role="form" name="form" method="POST" style="margin-top: 25px; margin-left: 5px;">
                         

                          <div class="row">
                          <div class="col-md-2 control">
                          <strong>School Name</strong>*
                          </div>                            
                          <div class="col-md-4 control ">
                          <select name="school_id" id="school_id" class="input-booking-school_id form-control">
                          <option value="">Select School</option>
                          <?php
                          if(isset($schoolList)){
                            foreach($schoolList as $school){ echo '<option value="'.$school['id'].'">'.$school['school_name'].' / '.$school['contact'].'</option>';} 
                          }
                          ?>
                        </select>
                          </div>
                          </div>
                    <div class="row">
                        <div class="col-md-2 control">
                                <strong>School name</strong>*
                              </div>                            
                        <div class="col-md-4 control ">
                          <input type="text" name="school_name" class="form-control input-booking-school_name" id="school_name" placeholder="School name">
                        </div>
                    </div>
                    <div id="result1"></div>
                     <div class="row">
                        <div class="col-md-2 control"><strong>Location</strong>*</div>                            
                        <div class="col-md-4 control ">
                         <input type="text" name="location_id" class="form-control input-booking-school_location" id="location_id" placeholder="Location">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 control"><strong>Activity</strong>*</div>                            
                        <div class="col-md-4 control ">
                         <select name="activity_id" id="activity_id" class="form-control input-booking-activity_id"  > 
                            <option value="">Select</option>
                            <?php 
                            if(isset($activityList)){ 
                            foreach ($activityList as $row) { ?>
                              <option value="<?php echo $row['game_id'] ?>" <?php if(isset($activity_id) && $row['game_id']==$activity_id ){ echo 'selected';} ?>><?php echo $row['game']; ?></option>
                          <?php } } ?>
                          </select>
                        </div>
                    </div>
                    <div class="row">
                          <div class="col-md-2 control">
                          <strong>Booking date</strong>*
                          </div>                            
                          <div class="col-md-4 control ">
                          <input type="date" required=""  name="date" id="date" class="form-control input-booking-date" value="<?php echo isset($date)?$date:''; ?>">
                          </div>
                    </div>
                    <div class="row">
                          <div class="col-md-2 control">
                          <strong>Time Slot</strong>*
                          </div>                            
                          <div class="col-md-4 control ">
                          <input type="text" required=""  name="time" id="time" class="form-control input-booking-time" value="<?php echo isset($time)?$time:''; ?>">
                          </div>
                    </div>
                    
                    

                    <div class="row">
                        <div class="col-md-2 control"><strong>Coach</strong>*</div>                            
                        <div class="col-md-4 control ">
                         <select name="coach_id" id="coach_id" class="form-control input-booking-coach_id"  > 
                            <option value="">Select</option>
                            <?php foreach ($coachList as $coach) { ?>
                            <option value="<?php echo $coach['coach_id'] ?>" <?php if(isset($coach_id) && $coach['coach_id']==$coach_id ){ echo 'selected';} ?>><?php echo $coach['coach_name']; ?></option>
                          <?php } ?>
                          </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 centerAlign">                            
                            <button type="button" class="btn rkmd-btn btn-secondary" id="add-booking-create">Add</button> 
                            <a href="<?php echo base_url().'School_attendance' ?>"     class="btn btn-secondary" >Cancel</a></div></div>
                        </div>                    
                    </div>

                  </form>
                  
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>
</div>
<?php
$this->load->view('popup/voucher');
?>

<script>var baseurl = "<?php echo site_url(); ?>";</script>
<script src="<?php echo site_url(); ?>/assets/js/school_attendance.js"></script>
<script type="text/javascript">

function payment_details(payment_type){ 
  $.ajax({
    url:"<?php echo base_url().'index.php/Daily_transaction/payment_type/'; ?>?payment_type=payment_type",
    type:"POST",
    data:{payment_type:payment_type},
    success:function(data)
    {       
    document.getElementById('result').innerHTML=data;
    
    }
});
}
jQuery(function() {
  jQuery('#time').val('');
   jQuery('#time').daterangepicker({
            timePicker : true,
            timePicker24Hour : false,
            timePickerIncrement : 1,
            autoApply : true,
            //autoUpdateInput :true,
            locale : {
                format : 'hh:mm A'
            }
        }).on('show.daterangepicker', function(ev, picker) {
            picker.container.find(".calendar-table").hide();
   });
})
</script>
