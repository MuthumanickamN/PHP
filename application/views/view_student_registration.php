 <?php 

 //require_once 'config.php';


 $this->load->view('includes/header3'); ?>
 <html>
 <body>
 <head>
  <title>Student Registration</title>
</head>
<style type="text/css">
     #login
{
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
  font-size: 13px;
  line-height: 20px;
}
</style>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
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
                  <li class="breadcrumb-item"><a href="#">Student Registration</a>
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
            <li> <?php if($this->session->userdata('role')=='Parent') { ?>
            <a href="<?php echo site_url('Active_kids'); ?>" class="btn btn-primary"   ><b>Back</b></a>
            <?php } else { ?>
            <a href="<?php echo site_url('Students'); ?>" class="btn btn-primary"   ><b>Back</b></a>
            <?php } ?>
            </li>
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
        <h4 class="card-title">Student Registration Details</h4>
       
      </div>
      <div class="card-content collapse show">
         <div class="table-responsive">
            <table class="table mb-0">
            
                <tr>
                  <th class="text-left">Registration-ID</th>
                   <td class="text-left"><?php echo $sid; ?></td>           </tr>
                <tr>
                  <th class="text-left">Role</th>
                   <td class="text-left"><?php echo 'Student'; ?></td>           </tr>
                     <tr>
                  <th class="text-left">Name</th>
                   <td class="text-left"><?php echo $name; ?></td>           </tr>
                     <tr>
                  <th class="text-left">Date of Birth</th>
                   <td class="text-left"><?php echo date("d-m-Y", strtotime("$dob")); ?></td>           </tr>
                     <tr>
                  <th class="text-left">Age</th>
                   <td class="text-left"><?php echo $age; ?></td>           </tr>
                     <tr>
                  <th class="text-left">Gender</th>
                   <td class="text-left"><?php echo $gender; ?></td>           </tr>
                     <tr>
                  <th class="text-left">Father's Name</th>
                   <td class="text-left"><?php echo $father_name; ?></td>           </tr>
                      
                     <tr>
                  <th class="text-left">Father's Contact No.</th>
                   <td class="text-left"><?php echo $father_contact; ?></td>           </tr>
                     <tr>
                  <th class="text-left">Mother's Name</th>
                   <td class="text-left"><?php echo  $mother_name;  ?></td>           </tr>
                    <tr>
                  <th class="text-left">Passport Id</th>
                   <td class="text-left"><?php echo $passport_id; ?></td>           </tr>
                     <tr>
                  <th class="text-left">T Shirt Size</th>
                   <td class="text-left"><?php echo $t_shirt_size; ?></td>           </tr>
                     <tr>
                  <th class="text-left">Reg Fee Category</th>
                   <td class="text-left"><?php echo $registration['reg_fee_category']; ?></td>           </tr>


                     <tr>
                  <th class="text-left">Registration Fee Amount(AED)</th>
                   <td class="text-left"><?php echo $registration['reg_fee']; ?></td>           </tr>
                    <!-- <tr>
                  <th class="text-left">Reg Fees Status</th>
                   <td class="text-left"><?php echo  $row3['reg_fee_status'];  ?></td>           </tr>-->
                     
                     <tr>
                  <th class="text-left">Parent Name</th>
                   <td class="text-left"><?php echo $father_name; ?></td>           </tr>
                     
                     <tr>
                  <th class="text-left">Parent Email</th>
                   <td class="text-left"><?php echo $parent_email_id; ?></td>           </tr>
                     <tr>
                  <th class="text-left">Parent Mobile Number</th>
                   <td class="text-left"><?php echo $parent_mobile; ?></td>           </tr>
                     <tr>
                
                 <tr>
                  <th class="text-left">Student Status</th>
                   <td class="text-left"><?php echo $status; ?></td>           </tr>

                     <tr>
                  <th class="text-left">Approval Status</th>
           <td class="text-left"><?php echo $approval_status; ?></td>            </tr>
           <tr>
                   <th class="text-left">Student's Photo</th>
                   <td class="text-left">
                    <?php if($image_file_name != ""){ ?>
                    <a href="<?php echo base_url().'assets/'.$image_file_name; ?>">
                    <img src="<?php echo base_url().'assets/'.$image_file_name; ?>" style="width:20px; height:20px;  vertical-align: middle"/>View here</a>
                  <?php } else { echo "--"; } ?>
                    </td>           
                  </tr>
                     <tr>
                  <th class="text-left">Student's Passport Image</th>
                   <td class="text-left">
                    <?php if($student_passport_file_name != ""){ ?>
                     <a href="<?php echo base_url().'assets/'.$student_passport_file_name; ?>">
                      <img src="<?php echo base_url().'assets/'.$student_passport_file_name; ?>" style="width:20px; height:20px;  vertical-align: middle"/>View here</a>
                      <?php } else { echo "--"; } ?>
                    </td>           
                  </tr>

                     <tr>
                  <th class="text-left">Student's Visa Image</th>
                   <td class="text-left">
                    <?php if($student_visapage_file_name != ""){ ?>
                      <a href="<?php echo base_url().'assets/'.$student_visapage_file_name; ?>">
                      <img src="<?php echo base_url().'assets/'.$student_visapage_file_name; ?>" style="width:20px; height:20px;  vertical-align: middle"/>View here</a>
                      <?php } else { echo "--"; } ?>
                    </td>           
                  </tr>
                     <tr>
                  <th class="text-left">Student's Emirates-ID</th>
                   <td class="text-left">
                    <?php if($student_emid_file_name != ""){ ?>
                      <a href="<?php echo base_url().'assets/'.$student_emid_file_name; ?>">
                      <img src="<?php echo base_url().'assets/'.$student_emid_file_name; ?>" style="width:20px; height:20px;  vertical-align: middle"/>View here</a>
                    <?php } else { echo "--"; } ?>
                    </td>           
                  </tr>
                  <tr>
                  <th class="text-left">Sponsor's Passport</th>
                   <td class="text-left">
                    <?php if($sponser_passport_file_name != ""){ ?>
                     <a href="<?php echo base_url().'assets/'.$sponser_passport_file_name; ?>">
                      <img src="<?php echo base_url().'assets/'.$sponser_passport_file_name; ?>" style="width:20px; height:20px;  vertical-align: middle"/>View here</a>
                      <?php } else { echo "--"; } ?>
                    </td>            
                  </tr>
                  <tr>
                  <th class="text-left">Sponsor's Visa Image</th>
                   <td class="text-left">
                    <?php if($sponsor_visapage_file_name != ""){ ?>
                      <a href="<?php echo base_url().'assets/'.$sponsor_visapage_file_name; ?>">
                      <img src="<?php echo base_url().'assets/'.$sponsor_visapage_file_name; ?>" style="width:20px; height:20px;  vertical-align: middle"/>View here</a>
                      <?php } else { echo "--"; } ?>
                    </td>           
                  </tr>
                     <tr>
                  <th class="text-left">Sponsor's Emirates-ID</th>
                   <td class="text-left">
                    <?php if($sponsor_emid_file_name != ""){ ?>
                      <a href="<?php echo base_url().'assets/'.$sponsor_emid_file_name; ?>">
                      <img src="<?php echo base_url().'assets/'.$sponsor_emid_file_name; ?>" style="width:20px; height:20px;  vertical-align: middle"/>View here</a>
                    <?php } else { echo "--"; } ?>
                    </td>           
                  </tr>
                

                     <tr>
                  <th class="text-left">Updated Admin's Name</th>
                   <td class="text-left"><?php echo   $updated_admin_name;?></td>           </tr>
                     <tr>
                  <th class="text-left">Updated Admin's Email</th>
                   <td class="text-left"><?php echo $updated_admin_email; ?></td>           </tr>
                     <tr>
                  <th class="text-left">Updated Date And Time</th>
                   <td class="text-left"><?php if($updated_at=='0000-00-00 00:00:00') { echo '-'; } else  { echo date("d-m-y-h-i-s", strtotime("$updated_at")); } ?> </td>           </tr>
                     <tr>
                  <th class="text-left">Verified By</th>
                   <td class="text-left"><?php echo  $updated_admin_name; ?></td>           </tr>
                     <tr>
                  <th class="text-left">Created At</th>
                   <td class="text-left"><?php echo date("d-m-y-h-i-s", strtotime("$created_at")); ?></td>           </tr>
                     <tr>
                  <th class="text-left">Updated At</th>
                   <td class="text-left"> <?php if($updated_at=='0000-00-00 00:00:00') { echo '-'; } else  { echo date("d-m-y-h-i-s", strtotime("$updated_at")); } ?></td>       </tr>
                 
                   
            </table>
          </div>
       </div>
     </div>

      <!--<div class="card-header">
        <h4 class="card-title">Activity List</h4>
      </div>

       <div class="card-content collapse show">
          <div class="card-body card-dashboard">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered dt-responsive nowrap" border="0" cellpadding="0" cellspacing="0" style="width:100%">
                <thead>
                <tr>
                     <td>Balance <?php echo isset($balance)?number_format((float)$balance, 2, '.', ''):'0.00';?> AED</td>
                      <td></td>
                      <td>Transaction History</td>
                      <td></td>
                      
                      <td style="text-align: center; width: 150px; height: 50px">
                        <?php if($status == 'Active'){ ?>
                          <button id="my1Btn" class="btn btn-primary" onClick="$('#myModal').show()">New</button>
                        <?php } ?>
                        </td>
                </tr>
                  <tr>
                  <th style="text-align: center">PSA-ID</th>
                  <th style="text-align: center">Activity</th>
                  <th style="text-align: center">Level</th>
                   <th style="text-align: center">Contract</th>
                   <th style="text-align: center">View</th>
                  
                  

                </tr>
              
        </thead>
        <tbody>
           <?php                      
              foreach ($activitylists as $key => $row1) { ?>
                <tr>
                   <td style="text-align: center"><?php   echo $row1['sid'];  ?></td>
                <td style="text-align: center"><?php echo $row1['game']; ?></td>
                <td style="text-align: center"><?php echo $row1['level']; ?></td>
                <td style="text-align: center"><?php echo $row1['contract']; ?></td>
                <td>
                  <a id="myBtn" class="btn btn-info"  href="<?php echo base_url('index.php/student_profile_slot_booking/viewbooking/'.$row1['activity_id'].'/'.$row1['student_id']); ?>">View</a>
                </td>
               
                    
                </tr>
              <?php } ?>
            </tbody>
          </table>
</div></div></div>-->



              </div></table></div></div></div></div></div></section></div></div></div>
            <style>
body {font-family: Arial, Helvetica, sans-serif;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); 
  /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  position: relative;
  background-color: #fefefe;
  margin: auto;
  padding: 0;
  border: 1px solid #888;
  width: 40%;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
  -webkit-animation-name: animatetop;
  -webkit-animation-duration: 0.4s;
  animation-name: animatetop;
  animation-duration: 0.4s;

}

/* Add Animation */
@-webkit-keyframes animatetop {
  from {top:-300px; opacity:0} 
  to {top:0; opacity:1}
}

@keyframes animatetop {
  from {top:-300px; opacity:0}
  to {top:0; opacity:1}
}

/* The Close Button */
.close {
  color: white;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

.modal-header {
  padding: 2px 16px;
  background-color: #5cb85c;
  color: white;
}

.modal-body {padding: 2px 16px;}

.modal-footer {
  padding: 2px 16px;
  background-color: #5cb85c;
  color: white;
}
.alert-info {
    background-color: #d9edf7!important;
    color: #053858!important;
    margin-top: 15px;
}

</style>
</head>
</body>



<!-- Trigger/Open The Modal -->
<div id="myModal" class="modal" role="dialog" data-backdrop="static" data-keyboard="false" style="display: none;">
  <div class="modal-dialog" style="width: 100%; margin-top: 100px">
    <div class="modal-content" style="width: 100%">
      <div class="modal-body" style="width: 100%">
      <div class="alert alert-info">
        <!-- <a href="#" class="close" data-dismiss="modal" aria-label="close">X</a> -->
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: black" onClick="$('#myModal').hide();">&times;</button>
        <strong> Activity Selection </strong>
      </div>
      <div class="alert alert-info">
        <form id="addActivityForm" class="form-horizontal"  name="form" method="POST">
          <label > Activity </label>&nbsp;&nbsp;&nbsp;
          <input type="hidden" name="sid" class="sid" value="<?php echo $id; ?>">
          <input type="hidden" name="registration_id" class="registration_id" value="<?php echo $parent_user_id; ?>">
          <select name="activity_id" id="activity_id" class="form-control"  required="">
            <option value="">Select</option>
            <?php                        
            
            foreach($games as $key => $row5){ ?>
            <option value="<?php echo $row5['game_id'] ?>" ><?php echo $row5['game'] ?>
            </option><?php   }  ?>
          </select>
          <br>
          <br>
          <br>
          <button id="save" type="button" name="submit" class="btn btn-success" onclick="createActivity();" >Submit</button>
          <!--<input id="save" type="submit" value="Submit" name="submit" class="btn btn-success" >-->
          <a onClick="$('#myModal').hide();"    class="btn btn-danger" >Cancel</a>
        </form>
      </div>
      </div>
    </div>
  </div>
</div>
</body>
<script type="text/javascript">
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
</html>





         
            





