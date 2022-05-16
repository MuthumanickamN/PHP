<?php 
 
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
                    
                    <h4 class="card-title"><?php if($slot_id==0) { echo 'Slot Booking'; } else { echo 'Swap Slot'; }?></h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                </div>
              <div class="card-content collapse show">
          <div class="card-body card-dashboard">
                <div  class="mainbox col-sm-12">
                      <div class="panel panel-info">
          <form id="viewCalenderForm" class="form-horizontal" role="form" name="form" method="POST" style="margin-top: 25px; margin-left: 5px; margin-right: 5px" action="<?php echo base_url().'Student_profile_slot_booking/view_calender' ?>">
          <div class="row">
            <div class="col-md-2 control text-left"><strong>Activity <?php echo $activity_id;?></strong>
             <select name="activity_id" id="activity_id" class="form-control choiceChosen"  required="" >
                <option value="">Select</option>
                <?php                        
              if(isset($activityList)){ 
                foreach($activityList as $activityVal) { ?>
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
                /*if(isset($coachList)){                         
              foreach ($coachList as $coachVal){ ?>
            <option value="<?php echo $coachVal['coach_id'] ?>" <?php if($coachVal['coach_id']==$coach_id){ echo 'selected';} ?>><?php echo $coachVal['coach_name'] ?>
             </option><?php } } */?></select>
            </div>
            <div class="col-md-2 control text-left"><strong>Hour</strong>   
            
            <?php if($slot_id == 0) { ?>
            <select name="hour" id="hour"  class="form-control choiceChosen"  required="" >
            <option value="">Select</option>
            <option value="One">One Hour Session</option>
            <option value="Two">Two Hour Session</option>
            <option value="Three">Three Hour Session</option>
            </select>
            <?php } else { ?>
            
            <select name="hour" id="hour"  class="form-control choiceChosen"  required="" readonly>
           
            <option value="One"  <?php if($hours==One){ echo 'selected';} ?>>One Hour Session</option>
                  <option value="Two"  <?php if($hours==Two){ echo 'selected';} ?>>Two Hour Session</option>
                  <option value="Three"  <?php if($hour==Three){ echo 'selected';} ?>>Three Hour Session</option>
            </select>
            
            <?php } ?>
                <input type="hidden" name="sid" value="<?php echo $sid;?>" id ="sid">
            </div>

               <div class="col-md-2 control text-left margin-top-20">
                <input type="hidden" name="slot_id" id="slot_id" value="<?php echo $slot_id;?>">
                   <input id="save" type="submit" name="submit" value="Show Slots"      class="btn btn-success" />
               </div>
          </div>
        </form></div>

          <br/>
            <div class="modal-body" id="image" style="display:block;">

    <?php  
    $query="select * from  fees_structure_images where activity_id='$activity_id'";
    $result = $this->db->query($query);
    if($result->num_rows() > 0)
    {
        foreach($result->result_array() as $key => $value) {
            //alert alert-danger
    ?>
    <div class="modal-body">
        
         <div class="alert alert-info">
          <div class="alert alert-info">
          <a href="#" class="close" data-dismiss="modal" aria-label="close"></a>
        
        <h3><strong> <?php echo $value['description'];?></strong></h3>

        </div>
        

          <img class="img-responsive" src="<?php echo base_url().'assets/Fees_structure_images/'.$value['fee_image_file_name'] ?>" alt="image" width = "100%" />
         
        </div>
        
    </div>
    <?php }
    }
    ?>

    


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

<script type="text/javascript">
  var slot_id = "<?php echo $slot_id;?>";
  if(slot_id != 0)
  {
    var activity_id = "<?php echo $activity_id;?>";
    var location_id = "<?php echo $location_id;?>";

    jQuery.ajax({
      type:'POST',
      url:baseurl+'Student_profile_slot_booking/filter_coach',
      data:{
          location_id:location_id,
          activity_id:activity_id,
      },
      dataType:'html',                       
      success: function (result) {
        $('#coach_id').html(result);
      }, 
              
  });
    //$('#hour').attr('readonly', true);
  }
$('#location_id').on('change',function(){
  var location_id = $(this).val();
  var activity_id = $('#activity_id').val();
  jQuery.ajax({
      type:'POST',
      url:baseurl+'Student_profile_slot_booking/filter_coach',
      data:{
          location_id:location_id,
          activity_id:activity_id,
      },
      dataType:'html',                       
      success: function (result) {
        $('#coach_id').html(result);
      }, 
              
  });
});
</script>