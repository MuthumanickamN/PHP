<?php require_once 'config.php'; ?> <html>
 <body style="font-family: Arial, Helvetica, sans-serif;">
 <head>
  <title>Student Profile Slot Booking</title>
</head>

 <?php $this->load->view('includes/header3'); ?>

<?php displayMessage(); ?>
<div class="app-content content">
      <div class="content-overlay"></div>
      <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title" style="color: green">Parent Login</h3>
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
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title"><?php echo $title;?></h4>
          <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
        </div>
        <div class="card-content collapse show">
        <div class="card-body card-dashboard">
          <div class="table-responsive">
            <?php      if(isset($studentDetails) && !empty($studentDetails)){ ?>
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th style="text-align:center">REG-ID</th>
                  <th style="text-align:center">Name</th>
                  <th style="text-align:center">Category</th>
                  <th style="text-align:center">Status</th>
                  <th style="text-align:center">Profile</th>
                  <th style="text-align:center">Activity</th>
              </tr>
               </thead>
              <tbody>
                <?php  
                  foreach ($studentDetails as $key => $stud) {
                ?>
                <tr>
                  <td style="text-align:center"><?php echo  $stud['sid']; ?></td>
                  <td style="text-align:center"><?php echo  $stud['name']; ?></td>
                  <td style="text-align:center"><?php echo 'Kid'; ?></td>
                  <td style="text-align:center"><?php echo  $stud['status']; ?></td>
                  <td style="text-align:center"><a href="<?php echo base_url('index.php/student_profile_slot_booking/view/'.$stud['id']);?>"><input type="button" value="View" class="btn btn-info" name=""></a></td>
                  <td style="text-align:center"><button id="my1Btn" data-toggle="modal" data-target="#createActivity" class="btn btn-primary" onClick="addActivity('<?php echo $stud['id'];?>','<?php echo $stud['parent_user_id'];?>')">New</button></td>
                  
              </tr>
              <?php 
            }
          ?>
          </tbody>
          </table>
          <br/>
          <br/>
          <?php if(isset($selectedActivities) && !empty($selectedActivities)){  ?>
          <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th style="text-align:center">PSA-ID</th>
                  <th style="text-align:center">Activity</th>
                  <th style="text-align:center">Level</th>
                  <th style="text-align:center">Contract</th>
                  <th style="text-align:center">Slot</th>
                  <th style="text-align:center">Booking</th>
                  <th style="text-align:center">Coach Review</th>
                
              </tr>
               </thead>
              <tbody>
                 <?php 
                  
                    foreach ($selectedActivities as $key => $selActivity) {
                      ?>
                  <td style="text-align:center"><?php echo  $selActivity['sid']; ?></td>
                  <td style="text-align:center"><?php echo  $selActivity['activity']; ?></td>
                  <td style="text-align:center"><?php echo  ($selActivity['status'] == 'Active')?$selActivity['level_id']:'--'; ?></td>
                  <td style="text-align:center"><?php echo  ($selActivity['status'] == 'Active')?$selActivity['contract']:'--'; ?></td>
                  <td style="text-align:center">
                  <?php if($selActivity['status'] == 'Active'){ ?>
                  <a id="myBtn" class="btn btn-success"  href="<?php echo base_url('index.php/student_profile_slot_booking/book/'.$selActivity['activity_id'].'/'.$selActivity['student_id']); ?>">Book</a>
                <?php }else{ echo "--";  }?>
                  </td>
                  <td style="text-align:center">
                    <?php if($selActivity['status'] == 'Active'){ ?>
                      <a id="myBtn" class="btn btn-info"  href="<?php echo base_url('index.php/student_profile_slot_booking/viewbooking/'.$selActivity['activity_id'].'/'.$selActivity['student_id']); ?>">View</a>
                    <?php }else{ echo "--"; } ?>
                  </td>
                  <td style="text-align:center">--</td>
                  
              </tr>
            <?php
            } }else{
              //echo "<div class='row col-md-12'><div class='col-md-6'>No activities found. </div> ";

            } } else{
              echo "<div class='row col-md-12'><div class='col-md-6'>No students found. </div> ";?>
              <div class='col-md-6' style="text-align: right;">
              <a href="<?php echo base_url('student');?>" class="btn btn-primary" >Add Student</a>
            </div></div>
            <?php
            }?>
          </tbody>
          </table>
</div>
</div>
</div></div></div></div></section></div></div></div>
</head>
</body>



<!-- Trigger/Open The Modal -->
<div class="modal fade rotate" id="createActivity" style="display:none;">
    <div class="modal-dialog modal-sm"> 
          <div class="modal-content panel panel-primary">
              <div class="modal-header panel-heading">
                  <h4 class="modal-title -remove-title">Activity Selection</h4>
                  <button type="button" class="close close_button" data-dismiss="modal">&times;<span class="close-x">Close</span></button>
              </div>
              <div class="modal-body panel-body">
                    <form id="addActivityForm" method="post">   
                        <label > Activity </label>&nbsp;&nbsp;&nbsp;
                        <input type="hidden" name="sid" class="sid">
                        <input type="hidden" name="registration_id" class="registration_id">
                        <select name="activity_id" id="activity_id" class="form-control"  required="">
                            <option value="">Select</option>
                            <?php if(isset($activityList)){
                            foreach ($activityList as $key => $activity) { ?>
                            <option value="<?php echo $activity['game_id'] ?>" ><?php echo $activity['game'] ?></option>
                        <?php   }  } ?>
                        </select>
                        <div class="errorDiv"></div>
                    </form>
              </div>
              <div class="modal-footer panel-footer">
                  <div class="row">
                      <div class="col-sm-12">                            
                          <button id="save" type="button" name="submit" class="btn btn-success" onclick="createActivity();" >Submit</button>
                          <button type="button" class="btn rkmd-btn btn-danger close_button" data-dismiss="modal">Close</button>
                      </div>                    
                  </div>
              </div>
          </div>
    </div>
</div>



<!-- The Modal -->

<script>var baseurl = "<?php echo site_url(); ?>";</script>
<script>
function addActivity(stud_id, parent_id){
  //jQuery('#createActivity').show();
  jQuery('.sid').val(stud_id);
  jQuery('.registration_id').val(parent_id);
}
function createActivity(){
    activity_id = jQuery('#activity_id').val();
    if(activity_id == ''){
      var element = $('.errorDiv');
      $(element).html('<div class="text-danger left_align" style="font-size: 14px;">Please select activity.</div>');
    }else{
      jQuery.ajax({
          type:'POST',
          url:baseurl+'student_profile_slot_booking/addActivity',
          data:jQuery("form#addActivityForm").serialize(),
          dataType:'json',    
          beforeSend: function () {
              jQuery('button#addActivityForm-form').button('loading');
          },
          success: function (json) {
              $('.text-danger').remove();
              if(json['status']=='success'){
                location.reload();
              }

          },
          error: function (xhr, ajaxOptions, thrownError) {
              console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
          }        
      });
    }
}

</script>