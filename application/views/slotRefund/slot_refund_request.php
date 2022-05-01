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
                  <th style="text-align:center">Change Request</th>
                
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
                    <a id="myBtn" class="btn btn-warning"  href="<?php echo base_url('index.php/Slot_refund_request/proceed/'.$selActivity['activity_id']);?>">Proceed</a>
                  </td>
                  
              </tr>
            <?php
            } } } ?>
          </tbody>
          </table>
</div>
</div>
</div></div></div></div></section></div></div></div>
</head>
</body>

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