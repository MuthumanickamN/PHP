<?php $this->load->view('includes/header3'); ?>
<style>
	.table td{
		padding: 15px !important;
	}
</style>
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
                  <li class="breadcrumb-item"><a href="#"><?php echo $title;?></a>
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
            <li> <a href="<?php echo site_url('index.php/slot_refund_request/list'); ?>" class="btn btn-primary"   ><b>Back</b></a></li>
          </ul>
                
              </div>
            </div>
          </div>
        </div>
       <div class="content-body"><!-- Zero configuration table -->
<section id="configuration">
    <div class="row">
    <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title"><?php echo $title;?></h4>
       
      </div>
      <div class="card-content collapse show">
         <div class="table-responsive">
            <table class="table mb-0">
                <tr>
                  <td class="text-left">Ticket No</td>
                   <td class="text-left"><?php echo $slot['bkid']; ?></td>           
               </tr>
               <tr>
                  <td class="text-left">Registration ID</td>
                   <td class="text-left"><?php echo 'PS00'.$slot['student_id']; ?></td>           
               </tr>
               <tr>
                  <td class="text-left">PSA ID</td>
                   <td class="text-left"><?php echo $slot['psa_id']; ?></td>           
               </tr>
               <tr>
                  <td class="text-left">Student name</td>
                   <td class="text-left"><?php echo $slot['student_name']; ?></td>           
               </tr>
               <tr>
                  <td class="text-left">Activity</td>
                   <td class="text-left"><?php echo $slot['activity_id']; ?></td>           
               </tr>
               <tr>
                  <td class="text-left">Location</td>
                   <td class="text-left"><?php echo $slot['location_id']; ?></td>           
               </tr>
               <tr>
                  <td class="text-left">Level</td>
                   <td class="text-left"><?php echo $slot['level_id']; ?></td>           
               </tr>
               <tr>
                  <td class="text-left">Lane/Court</td>
                   <td class="text-left"><?php echo $slot['lane_court_id']; ?></td>           
               </tr>
               <tr>
                  <td class="text-left">Coach</td>
                   <td class="text-left"><?php echo $slot['coach_id']; ?></td>           
               </tr>
               <tr><td colspan="2">
               <h4><b>Booking Time Details</b></h4></td>
               </tr>
               <tr>
                  <td class="text-left">Booked date</td>
                   <td class="text-left"><?php echo date('d-m-Y',strtotime($slot['checkout_date'])); ?></td>           
               </tr>
               <tr>
                  <td class="text-left">Time slot</td>
                   <td class="text-left"><?php echo $slot['from_time'].' - '.$slot['to_time']; ?></td>           
               </tr>
               
               <tr><td colspan="2">
               <h4><b>Change slot Details</b></h4></td>
               </tr>
               <tr>
                  <td class="text-left">Change Slot date</td>
                   <td class="text-left"><?php echo date('d-m-Y',strtotime($slot['change_slot_date'])); ?></td>           
               </tr>
               <tr>
                  <td class="text-left">Change Slot Time</td>
                   <td class="text-left"><?php echo $slot['change_slot_from_time'].' - '.$slot['change_slot_to_time']; ?></td>           
               </tr>
               <tr>
                  <td class="text-left">Reason</td>
                   <td class="text-left"><?php echo $slot['reason']; ?></td>           
               </tr>
               <tr>
                  <td class="text-left">Document</td>
                   <td class="text-left">
                   	<?php $image1=$slot['medical_proof_file_name']; 
                if($image1 != ''){ ?> 
                <a href="<?php echo base_url().'assets/Refund_images/'.$slot['parent_user_id'].'/'.$slot['parent_user_id'].''.$slot['medical_proof_file_name']; ?>">
                <img src="<?php echo base_url().'assets/Refund_images/'.$slot['parent_user_id'].'/'.$slot['parent_user_id'].''.$slot['medical_proof_file_name']; ?>" style="width:60px; height:60px;  vertical-align: middle"/>View here
                </a>
            <?php } else{ echo "--"; } ?>
                   </td>           
               </tr>
               <tr>
                  <td class="text-left">Approval Status</td>
                   <td class="text-left"><?php echo $slot['approval_status']; ?></td>           
               </tr>
               <tr>
                  <td class="text-left">Comment</td>
                   <td class="text-left"><?php echo $slot['comment']; ?></td>           
               </tr>
               <tr>
                  <td class="text-left">Updated by</td>
                   <td class="text-left"><?php echo ($slot['updated_admin_id'] !='')?$slot['updated_admin_id']:'-'; ?></td>           
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