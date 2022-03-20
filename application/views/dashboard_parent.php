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
        <div class="col-12">
            
                    <h4 class="">Your Wallet Balance : ADE <strong><?php echo number_format($walletbalance,2);?> </strong></h4>
                   

<div class="row">
                <div class="col-12 col-md-6">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Activity Details</h4>
       
      </div>
      <div class="card-content collapse show">
        <div class="card-body p-0" style="overflow: scroll; overflow-x:scroll;
                white-space: nowrap;
                text-overflow: ellipsis; height:360px;">
                 <style>
                      
                 </style>
                  <table class="table table-striped table-bordered dt-responsive nowrap" border="0" cellpadding="0" cellspacing="0" style="width:100%">
                   <tr>
                    <th style="text-align: center">Attendance</th>
                    <th style="text-align: center">Date</th> 
                    <th style="text-align: center">Name</th>
                    <th style="text-align: center">Activity</th>
                    <th style="text-align: center">Location</th>
                    <th style="text-align: center">From</th>
                    <th style="text-align: center">To</th>
                    <th style="text-align: center">Lane/Coach</th>
                    <th style="text-align: center">Coach</th>
                    </tr>
                    <?php  
        // $i=1;        
                     
                        foreach ($ActivityDetails as $row)  
                      {  

                        
                             ?><tr>  
                                <td><?php echo $row->Attendance;?></td>
                                <td><?php echo $row->Date;?></td>  
                                <td><?php echo $row->Name;?></td>  
                                <td><?php echo $row->Activity;?></td> 
                                <td><?php echo $row->Location;?></td> 
                                <td><?php echo $row->start;?></td>
                                <td><?php echo $row->end;?></td>
                                <td><?php echo $row->Lane;?></td>
                                <td><?php echo $row->Coach ;?></td>
                                </tr>  
         <?php }
         // i++;
         ?>  


            </table>
  
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




                