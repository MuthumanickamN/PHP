 <?php 
 $this->load->view('includes/header3'); ?>
 <style type="text/css">
#title
{
   background-image: linear-gradient(180deg, #efefef, #dfe1e2);
    text-shadow: #fff 0 1px 0;
    border: solid 1px #cdcdcd;
    border-color: #d4d4d4;
    border-top-color: #e6e6e6;
    border-right-color: #d4d4d4;
    border-bottom-color: #cdcdcd;
    border-left-color: #d4d4d4;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 0 1px #FFF inset;
    font-size: 1em;
    font-weight: bold;
    line-height: 18px;
    margin-bottom: 0.5em;
    color: #5E6469;
    padding: 5px 10px 3px 10px;
    border-right: none;
    text-align: left;
    padding-left: 12px;
    padding-right: 12px;
  font-size: 20px;
  line-height: 20px;
}
h5
{
  font-family: "Open Sans",-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif;
  font-size: 15px;
  line-height: 20px;
  font-size: 1em;
    font-weight: bold;
    line-height: 18px;
    margin-bottom: 0.5em;
    color: #5E6469;
    padding: 5px 10px 3px 10px;
    border-right: none;
    text-align: left;
    padding-left: 12px;
    padding-right: 12px;
  font-size: 12px;
  line-height: 20px;
}
 </style>
 
 <script type="text/javascript">
 	$(function () {
              
                    $('#dialog').fadeIn('slow').delay(1000).fadeOut('slow');
                });
 </script>
    
      <div id="active_admin_content" class="without_sidebar">
        <div id="main_content_wrapper">
          <div id="main_content">
<div class="marquee-bg">
<marquee behavior="scroll" direction="left">
  <span>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $scroll_Text['message']; ?>
  </span>
</marquee>
</div>
 <div class="app-content content">
      <div class="content-overlay"></div>
      <div class="content-wrapper">
         <div class="content-body"><!-- Zero configuration table -->
<section id="configuration" class="dashboard">
    <div class="row">
        <div class="col-12">
            
                    <h4 class="heading1">Dashboard Status</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>




<div class="row">
                <div class="col-12 col-md-3">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Activity Details</h4>
       
      </div>
      <div class="card-content collapse show">
        <div class="card-body p-0" style="overflow: scroll; overflow-x:scroll;
                white-space: nowrap;
                text-overflow: ellipsis; height:360px;">
                          <h5>Total Kids Strength - <?php echo $active_kids;?></h5>
                          <h5>Total Active Strength - <?php echo $active_student;?></h5>
                          <h5> Swimming - <?php echo $active_swim;?></h5>
                          <h5> Badminton -<?php echo $active_Bad;?></h5>
                          <h5> Chess - <?php echo $active_chess;?></h5>
                          <h5> Table Tennis - <?php echo $active_tennis;?></h5>
                          <h5> Karate - <?php echo $active_karate;?></h5>
                          <h5> Football - <?php echo $active_foot_ball;?></h5>
                          <h5>Total Inactive Strength - <?php echo $inactive_student;?></h5>
                          <h5> Swimming - <?php echo $inactive_swim;?></h5>
                          <h5> Badminton - <?php echo $inactive_Bad;?></h5>
                          <h5> Chess - <?php echo $inactive_chess;?></h5>
                          <h5> Table Tennis - <?php echo $inactive_tennis;?></h5>
                          <h5> Karate - <?php echo $inactive_karate;?></h5>
                          <h5> Football - <?php echo $inactive_foot_ball;?></h5>
                          <h5>Total Active Parents - <?php echo $active_parent;?></h5>
                          <h5>Total Inactive Parents - <?php echo $inactive_parent;?></h5>
                          <h5>Total Active Coaches - <?php echo $active_coach;?></h5>
                          <h5>Total Inactive Coaches - <?php echo $inactive_coach;?></h5>
                          <h5><strong>Wallet Transaction details</strong></h5>
                          <h5>Total Transaction- <?php echo $transactions;?></h5>
                          <h5>Total Invoice- <?php echo $invoices;?></h5>
        </div>
      </div>
    </div>
  </div>

   <div class="col-12 col-md-3">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Daily Activity</h4>
       
      </div>
      <div class="card-content collapse show">
        <div class="card-body p-0" style="overflow: scroll; overflow-x:scroll;
                white-space: nowrap;
                text-overflow: ellipsis; height:360px;">
                 <!--<h5>Total Activity Slots- 0</h5>
                          <h5> Swimming - 0</h5>
                          <h5> Badminton - 0</h5>
                          <h5> Chess - 0</h5>
                          <h5> Table Tennis - 0</h5>
                          <h5> Karate - 0</h5>
                          <h5> Fitness - 0</h5>
                          <h5>Wallet Transaction details</h5>
                          <h5>Total Transaction- 0</h5>
                          <h5>Total Invoice- 0</h5>-->
                          <h5>Total Activity Slots- <?php echo $total_activityslot;?></h5>
                          <h5> Swimming - <?php echo $swim;?></h5>
                          <h5> Badminton - <?php echo $active_Badmiton;?></h5>
                          <h5> Chess - <?php echo $chess;?></h5>
                          <h5> Table Tennis -  <?php echo $tennis;?></h5>
                          <h5> Karate - <?php echo $karate;?></h5>
                          <h5> Football - <?php echo $foot_ball;?></h5>
                          <h5><strong>Wallet Transaction details</strong></h5>
                          <h5>Total Transaction- <?php echo $daily_transactions;?></h5>
                          <h5>Total Invoice- <?php echo $daily_invoices;?></h5>
                          
                        </div>
                      </div>
                    </div>
                  </div>
    <div class="col-12 col-md-3">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Upcoming Events</h4>
       
      </div>
      <div class="card-content collapse show">
        <div class="card-body p-0" style="overflow: scroll; overflow-x:scroll;
                white-space: nowrap;
                text-overflow: ellipsis; height:360px;">
                 <?php  
                 if(isset($eventList) && !empty($eventList)){
                 foreach ($eventList as $key => $value) { ?>
                   <h5>Date   : <?php echo date("d-m-Y",strtotime($value['event_date'])); ?></h5>
                   <h5>Place  : <?php echo $value['event_place']; ?></h5>
                   <h5>Name   : <?php echo $value['event_name']; ?></h5>
                   <h5>Detail : <?php echo $value['event_detail']; ?></h5>
                   <hr>
                    <?php } }else{
                      echo "<h5>No Upcoming Events.</h5>";
                    }?>
                 </div>
               </div>
             </div>
           </div>

               <div class="col-12 col-md-3">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">List of Holidays</h4>
       
      </div>
      <div class="card-content collapse show">
        <div class="card-body p-0" style="overflow: scroll; overflow-x:scroll;
                white-space: nowrap;
                text-overflow: ellipsis; height:360px;">
                 <?php 
                 if(isset($holidaysList) && !empty($holidaysList)) {
                 foreach($holidaysList as $holiday){ ?>
                   <h5>Date   : <?php echo date("d-m-Y",strtotime($holiday['select_date'])); ?></h5>
                
                   <h5>Name   : <?php echo $holiday['holiday_name']; ?></h5>
                   <hr>
                 <?php } } else{
                    echo "<h5>No data available.</h5>";
                   }?>
                 </div>
               </div></div></div>

                </div>
              
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</div>
</div>
</div>
</div>
</html>




                