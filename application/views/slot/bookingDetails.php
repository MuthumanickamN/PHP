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
                  <li class="breadcrumb-item"><a href="<?php echo site_url('student_profile_slot_booking/approval'); ?>">Booking Approval</a>
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
            <li> <a href="<?php echo site_url('student_profile_slot_booking/approval'); ?>" class="btn btn-primary"   ><b>Back</b></a></li>
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
                   <td class="text-left"><?php echo $bookingList['ticket_no']; ?></td>           
               </tr>
               <tr>
                  <td class="text-left">Registration ID</td>
                   <td class="text-left"><?php echo $bookingList['student_code']; ?></td>           
               </tr>
               <tr>
                  <td class="text-left">PSA ID</td>
                   <td class="text-left"><?php echo $bookingList['parent_code']; ?></td>           
               </tr>
               <tr>
                  <td class="text-left">Student name</td>
                   <td class="text-left"><?php echo $bookingList['name']; ?></td>           
               </tr>
              <!-- <tr>
                  <td class="text-left">Activity</td>
                   <td class="text-left"><?php echo $bookingList['activity_id']; ?></td>           
               </tr>
               <tr>
                  <td class="text-left">Location</td>
                   <td class="text-left"><?php echo $bookingList['location_id']; ?></td>           
               </tr>
               <tr>
                  <td class="text-left">Level</td>
                   <td class="text-left"><?php echo $bookingList['level_id']; ?></td>           
               </tr>
               <tr>
                  <td class="text-left">Lane/Court</td>
                   <td class="text-left"><?php echo $bookingList['lane_court_id']; ?></td>           
               </tr>
               <tr>
                  <td class="text-left">Coach</td>
                   <td class="text-left"><?php echo $bookingListData['coach_id']; ?></td>           
               </tr>-->
               <tr>
                  <td class="text-left">Checkout date</td>
                   <td class="text-left"><?php echo Date('d/m/Y',strtotime($bookingList['created_at'])); ?></td>           
               </tr>
               <!--<tr>
                  <td class="text-left">Time</td>
                   <td class="text-left"><?php echo $bookingList['from_time'].'-'.$bookingList['to_time']; ?></td>           
               </tr>-->
               <tr>
                  <td class="text-left">Reason</td>
                   <td class="text-left"><?php echo $bookingList['reason']; ?></td>           
               </tr>
               <tr>
                  <td class="text-left">Approval Status</td>
                   <td class="text-left"><?php echo $bookingList['status']; ?></td>           
               </tr>
               <!--<tr>
                  <td class="text-left">Updated by</td>
                   <td class="text-left"><?php echo ($bookingList['updated_admin_id'] !='')?$bookingList['updated_admin_id']:'-'; ?></td>           
               </tr>-->
            </table>
          </div>
       </div>
     </div>
     </div>
 </div>
 
 <div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Booked Slots</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
               
            </div>
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered dt-responsive nowrap" border="0" cellpadding="0" cellspacing="0" style="width:100%">
                    <thead>
                    
                      <tr>
                      <th style="text-align: center">Bk id</th>
                      <th style="text-align: center">Date</th>
                      <th style="text-align: center">Time</th>
                      <th style="text-align: center">Hour</th>
                      <th style="text-align: center">Activity</th>
                      <th style="text-align: center">Location</th>
                      <th style="text-align: center">Level</th>
                      <th style="text-align: center">Lane/Court</th>
                      <th style="text-align: center">Coach</th>
                     <!-- <th style="text-align: center">Price (AED)</th> -->
                      
    
                    </tr>
                  
            </thead>
            <tbody>
               <?php                      
                  foreach ($bookingListData as $key => $row1) { ?>
                    <tr>
                       <td style="text-align: center"><?php   echo $row1['booking_no'];  ?></td>
                    <td style="text-align: center"><span style="display:none;"><?php echo strtotime($row1['booked_date']); ?></span><?php echo date('d/m/Y',strtotime($row1['booked_date'])); ?></td>
                    <td style="text-align: center"><?php echo $row1['from_time'].' - '. $row1['to_time']; ?></td>
                    <td style="text-align: center"><?php echo $row1['hours']; ?></td>
                    <td style="text-align: center"><?php echo $row1['game']; ?></td>
                    <td style="text-align: center"><?php echo $row1['location']; ?></td>
                    <td style="text-align: center"><?php echo $row1['level']; ?></td>
                    <td style="text-align: center"><?php echo $row1['lane_court']; ?></td>
                    <td style="text-align: center"><?php echo $row1['coach_name']; ?></td>
                    
                   
                        
                    </tr>
                  <?php } ?>
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