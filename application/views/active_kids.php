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

/*table, th, td {
       border: 1px solid white;
       border-collapse: collapse;
       }*/
th, td {
     
     text-align:center;
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
              
<div id="dialog" style="display: none; left:40%; position: fixed; background-color:#f4f5fa; height: 50px;line-height: 45px; width: 500px;" class="row">
    <span id="lblText" style="color: Green; top: 50px;"></span> <?php displayMessage(); ?>
</div>

 <div class="app-content content">
      <div class="content-overlay"></div>
      <div class="content-wrapper">
         <div class="content-body"><!-- Zero configuration table -->
<section id="configuration" class="dashboard">
    <div class="row">
        <div class="col-12">

        <div class="row">
        <div class="col-12"><div class="card">
      <div class="card-header">
        <h4 class="card-title">Student Profile / Booking Slot </h4>
            </div>
            </div> 
            </div> 
            </div> 
            </div> 
            </div> 
          
 
                    <div class="row">
        <div class="col-12">
<div class="row">

<?php if(count($students) > 0){foreach($students as $key => $value) { ?>
    <div class="col-12 col-md-<?php if(count($students)%2 != 0 && $key+1 == count($students)){ echo '12';} else { echo '6'; }?>">
    <div class="card">
     
      <div class="card-content collapse show">
        <div class="card-body p-0" style="background-color: #f2f2f2;
                white-space: nowrap;
                text-overflow: ellipsis; height:360px;">
                 
                  <table class="table table-striped table-bordered dt-responsive nowrap" border="0" cellpadding="0" cellspacing="0" style="width:100%">
                  <thead>
        <tr>
          <th>Reg ID</th>
          <th>Name</th>
          <th>Category</th>
          <th>Status</th>
          <th>Profile</th>
          <th>Activity</th>
                 
        </tr>
      </thead>
      
      <tbody>
        <tr>
            <?php  $id= $value['id']; ?>
          <th><?php echo $value['sid'];?></th>
          <th><?php echo $value['name'];?></th>
          <th><?php  if($value['age']<19){ echo 'Kid';}else{echo 'Adult';};?></th>
          <th><?php echo $value['status'];?></th>
          <th><a id="myBtn" class="btn btn-info fa fa-eye"  href="<?php echo base_url('Student_details/index/'.$id); ?>"></a></th>
          <th>
          <button id="my1Btn" class="btn btn-primary" onClick="$('#myModal_<?php echo $id;?>').show()">New</button></th>
        </tr>
      </tbody>
      
    </table>
    </br>

    <div class="table2" style="overflow: scroll;">
    <table  class="table table-striped table-bordered dt-responsive nowrap" border="0" cellpadding="0" cellspacing="0" style="width:100%"> 
      <thead>
        <tr>
          <th>PSA ID</th>
          <th>Activity</th>
          <th>Level</th>
          <th>Contract</th>
          
          <th>Book slots</th>
          <th>View Booked Slots</th>
          <th>Refund/Swap Slot</th>
          <!--<th>Coach Review</th>-->
         
          
                 
        </tr>
      </thead>
      <tbody>
          <?php 
         
            $activitylists = $this->db->query("select a_s.*, cd.contract_form_sent_to_parent, cd.parent_approved from activity_selections as a_s 
            left join contract_details cd on cd.activity_selection_id = a_s.id
            where a_s.student_id=".$id); 
        	$activitylists=$activitylists->result_array();
        
        	foreach ($activitylists as $key => $value) {
        		$activitylists[$key]['game'] = ($value['activity_id'] !='')?$this->transaction->getActivityDetail($value['activity_id']):'';
        		$activitylists[$key]['level'] = ($value['level_id'] !='')?$this->default->getLevelDetail($value['level_id']):'';
        	}
          
            foreach ($activitylists as $key2 => $row1) { 
          ?>
      
        <tr>
           <td style="text-align: center"><?php   echo $row1['psa_id'];  ?></td>
        <td style="text-align: center"><?php echo $row1['game']; ?></td>
        <td style="text-align: center"><?php echo $row1['level']; ?></td>
        <td style="text-align: center">
            
  
             <?php if($row1['contract_form_sent_to_parent'] == '1' && $row1['parent_approved']=="Pending")
             { ?>
                      
                <button type="button" id="" data-id="<?php echo $row1['id'];?>" class="btn btn-primary contractBtn" onClick="$('#contractform').show();">Contract Form</button>
            <?php }else{ echo $row1['contract']; } ?>
        
                      
                    </a>
        
        </td>
                <div id="contractform" class="modal" role="dialog" data-backdrop="static" data-keyboard="false" style="width: 100%;display: none;overflow:scroll;"> 
                 <!--     <div class="modal" id="contractform" role="dialog">  -->
                       
                                  <div class="modal-dialog" style="width: 100%;
                                        float: none;
                                        margin: 0 auto;
                                        max-width: 38%;
                                        position: absolute;
                                        left: 4%;">
                                        <div class="modal-content" style="width: 246%;">
                                          <div class="modal-body" style="width: 100%;white-space: normal !important;">
                                          <div class="alert alert-info">
                                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: black" onClick="$('#contractform').hide();">&times;</button>
                                
                              <p>PRIME STAR SPORT SERVICES “YEARLY SPONSORSHIP CONTRACT”</p>
                            </div>
                            <div id="contract_form_data">
                                
                            </div>
                            <div class="form-check">
      <input type="checkbox" class="form-check-input" id="check1" name="option1" value="">
      <label class="form-check-label" for="check1"> I have read and agreed to the <a href="#" style="color:blue;text-decoration: underline">Terms and Conditions</a> as mentioned above</label>
    </div>
     <div class="form_btn">
    <div class="btn1_con" style="float:left;width:30%;text-align:center">
    <button type="submit" class="btn btn-danger mr-10">No</button>
    </div>
    <div class="btn2_con" style="float:left;width:50%;text-align:center">
    <button type="submit" class="btn btn-success">Yes</button>
    </div>
    </div>
                          </div>
                       </div>

        
        
        
        
        <td style="text-align: center">
            <!--href="<?php echo base_url('Student_profile_slot_booking/book/'.$row1['activity_id'].'/'.$id )?>" -->
            <button style="color:white;text-decoration:none;" data-activity_id="<?php echo $row1['activity_id'];?>" data-id="<?php echo $id;?>" class="btn btn-success fa fa-calendar-check-o book_slots"  >
            </button></td>
        
        <td style="text-align: center;" >
          <a id="myBtn" class="btn btn-info fa fa-eye"  href="<?php echo base_url('student_profile_slot_booking/viewbooking/'.$row1['activity_id'].'/'.$row1['student_id']); ?>"></a>
        </td>
         <td style="text-align: center;" >
          <a id="myBtn2" class="btn btn-danger fa fa-exchange"  href="<?php echo base_url('student_profile_slot_booking/swap_slot_list/'.$row1['activity_id'].'/'.$row1['student_id'].'/'.$id); ?>"></a>
        </td>
         <!--<td><button type="button" class="btn btn-warning">Coach Review</button></td> -->
       
            
        </tr>
      <?php } ?>
          
          
      </tbody>
      
    </table>
    </div>
  
        </div>
      </div>
    </div>
  </div>
  
  <!-- Trigger/Open The Modal -->
<div id="myModal_<?php echo $id;?>" class="modal" role="dialog" data-backdrop="static" data-keyboard="false" style="display: none;">
  <div class="modal-dialog" style="width: 100%; margin-top: 100px">
    <div class="modal-content" style="width: 100%">
      <div class="modal-body" style="width: 100%">
      <div class="alert alert-info">
        <!-- <a href="#" class="close" data-dismiss="modal" aria-label="close">X</a> -->
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: black" onClick="$('#myModal_<?php echo $id;?>').hide();">&times;</button>
        <strong> Activity Selection </strong>
      </div>
      <div class="alert alert-info">
        <form id="addActivityForm_<?php echo $id;?>" class="form-horizontal"  name="form" method="POST">
          <label > Activity </label>&nbsp;&nbsp;&nbsp;
          <input type="hidden" name="sid" class="sid" value="<?php echo $id; ?>">
          <input type="hidden" name="registration_id" class="registration_id" value="<?php echo $value['parent_user_id']; ?>">
          <input type="hidden" name="parent_id" class="parent_id" value="<?php echo $parent_id; ?>">
          <select name="activity_id" id="activity_id" class="form-control"  required="">
            <option value="">Select</option>
            <?php                        
            
            foreach($games as $key => $row5){ ?>
            <option value="<?php echo $row5['game_id'] ?>" ><?php echo $row5['game'] ?>
            </option><?php   }  ?>
          </select>
          <br>
          <span class="errorMsg activityError"></span>
          <br>
          <br>
          <button id="save"  type="button" name="submit" class="btn btn-success activity_submit" onClick="createActivity(<?php echo $id;?>);" >Submit</button>
          <!--<input id="save" type="submit" value="Submit" name="submit" class="btn btn-success" >-->
          <a onClick="$('#myModal_<?php echo $id;?>').hide();"    class="btn btn-danger" >Cancel</a>
        </form>
      </div>
      </div>
    </div>
  </div>
</div>

<?php }}else{ ?>
<div class="col-12">
<div class="card">

<p style="text-align:center;"><strong>Please Register Student(s) in Academic Activities Menu.</strong></p>
</div>
    </div>

  <?php } ?>
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css"  />
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js" ></script>

<script type="text/javascript">
jQuery(document).ready(function(){
    
$(document).on("click",".book_slots",function(){
    var id= $(this).attr('data-id');
    var activity_id= $(this).attr('data-activity_id');
    var role= "<?php echo $role;?>";
    $.ajax({
		type: "POST",
		url: base_url+"Student_profile_slot_booking/check_student_to_book",
		data: {id:id, activity_id:activity_id},
		async: true,
		datatype: "text",
		success : function(data)
		{
		    //$('#contract_form_data').html(data);
		    //var obj = JSON.parse(data);
		    if(data)
		    {
		        swal(data,'','warning');
		        
		    }
		    else
		    {
		        window.location=base_url+'Student_profile_slot_booking/book/'+activity_id+'/'+id;
		    }
		    
		}
    });
});

$(document).on("click",".contractBtn",function(){
    var id= $(this).attr('data-id');
    var activity_id= $(this).attr('data-activity_id');
    var role= "<?php echo $role;?>";
    $.ajax({
		type: "POST",
		url: base_url+"Activity_selections/contract_form_data",
		data: {id:id},
		async: true,
		datatype: "text",
		success : function(data)
		{
		    $('#contract_form_data').html(data);
		
		}
    });
});

});

  function createActivity(sid){
    activity_id = jQuery('form#addActivityForm_'+sid+' #activity_id').val();
    if(activity_id == ''){
      var element = $('.activityError');
      $(element).html('<div class="text-danger left_align" style="font-size: 14px;">Please select activity.</div>');
    }else{
      jQuery.ajax({
          type:'POST',
          url:baseurl+'student_profile_slot_booking/addActivity',
          data:jQuery("form#addActivityForm_"+sid).serialize(),
          dataType:'json',    
          beforeSend: function () {
              jQuery('button.activity_submit').text('loading');
          },
          success: function (json) {
              $('.text-danger').remove();
              if (json['error']) {             
                var element = $('.activityError');
                $(element).html('<div class="text-danger left_align" style="font-size: 14px;">'+json['error']+'</div>');
                
                jQuery('button.activity_submit').text('Submit');
            } else {
              
              if(json['status']=='success'){
                location.reload();
              }
            }

          },
          error: function (xhr, ajaxOptions, thrownError) {
              console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
          }        
      });
    }
}


</script>


                
