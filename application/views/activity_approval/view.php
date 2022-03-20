<?php $this->load->view('includes/header3'); ?>
<div class="app-content content">
<div class="content-overlay"></div>
<div class="content-wrapper">
<div class="content-header row">
  <div class="content-header-left col-md-6 col-12 mb-2">
    <h3 class="content-header-title" style="color: green">Academy Activities</h3>
    <div class="row breadcrumbs-top">
      <div class="breadcrumb-wrapper col-12">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Academy Activities</a>
        </li>
        <li class="breadcrumb-item"><a href="#">Activity Approval</a>
        </li>
       
      </ol>
      </div>
    </div>
  </div>
  <div class="content-header-right col-md-6 col-12">
    <div class="media width-250 float-right">
    <media-left class="media-middle">
    <div id="sp-bar-total-sales"></div>
    </media-left>
    <div class="media-body media-right text-right">
     <ul class="list-inline mb-0">
    <li> <a href="<?php echo site_url('activity_approval'); ?>" class="btn btn-primary"   ><b>Back</b></a></li>
    </ul>

    </div>
    </div>
  </div>
</div>
<div class="content-body"><!-- Zero configuration table -->
<section id="configuration">
<div class="row">
<div class="col-12 col-md-12">
<div class="card">
<div class="card-header">
<h4 class="card-title"><?php echo  $title;?></h4>

</div>
<div class="card-content collapse show">
<div class="table-responsive">
<table class="table mb-0">

  <tr>
    <th class="text-left">Name</th>
    <td class="text-left"><?php echo $activity['student_name']; ?></td>           
  </tr>
  <tr>
    <th class="text-left">Activity</th>
    <td class="text-left"><?php echo $activity['activity_id']; ?></td>           
  </tr>
  <tr>
    <th class="text-left">Level</th>
    <td class="text-left"><?php echo $activity['level']; ?></td>           
  </tr>
  <tr>
    <th class="text-left">Session Month</th>
    <td class="text-left"><?php echo $activity['session']; ?></td>           
  </tr>
  <tr>
    <th class="text-left">Contract</th>
    <td class="text-left"><?php echo $activity['contract']; ?></td>           
  </tr>
  <tr>
    <th class="text-left">Head coach</th>
    <td class="text-left"><?php echo $activity['head_coach_id']; ?></td>           
  </tr>
  <tr>
    <th class="text-left">Discount Applicable</th>
    <td class="text-left"><?php echo $activity['discount_applicable']; ?></td>           
  </tr>
  <tr>
    <th class="text-left">Status</th>
    <td class="text-left"><?php echo $activity['status']; ?></td>           
  </tr>
  <tr>
    <th class="text-left">Approval status</th>
    <td class="text-left"><?php echo $activity['approval_status']; ?></td>           
  </tr>
  <tr>
    <th class="text-left">Parent Id</th>
    <td class="text-left"><?php echo 'PSA00'.$activity['parent_user_id']; ?></td>           
  </tr>
  <tr>
    <th class="text-left">Parent Name</th>
    <td class="text-left"><?php echo $activity['parent_name']; ?></td>           
  </tr>
  <tr>
    <th class="text-left">Parent Mobile</th>
    <td class="text-left"><?php echo $activity['parent_mobile']; ?></td>           
  </tr>
  <tr>
    <th class="text-left">Parent Email</th>
    <td class="text-left"><?php echo $activity['parent_email_id']; ?></td>           
  </tr>
  <tr>
    <th class="text-left">Updated_by</th>
    <td class="text-left"><?php echo $activity['updated_admin_id']; ?></td>           
  </tr>
  <tr>
    <th class="text-left">Created at</th>
    <td class="text-left"><?php echo date('d-m-Y', strtotime($activity['created_at'])); ?></td>           
  </tr>

   
</table>
</div>
</div>
</div>
</div>
</div>
</section>
</div>
</div>
</div>






