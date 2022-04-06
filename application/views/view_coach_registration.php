 <?php 
 
 $this->load->view('includes/header3'); ?>
 <html>
 <body>
 <head>
  <title>Coach Registration</title>
</head>
<style type="text/css">
.table td, .table th {
    padding: 15px 20px !important;
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
                  <li class="breadcrumb-item"><a href="#">Coach Registration</a>
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
            <li> <a href="<?php echo site_url('Coach/list_'); ?>" class="btn btn-primary"   ><b>Back</b></a></li>
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
        <h4 class="card-title">Coach Registration Details</h4>
       
      </div>
      <div class="card-content collapse show">
         <div class="table-responsive">
            <table class="table mb-0">
            
                <tr>
                  <th class="text-left">Coach-ID</th>
                   <td class="text-left"><?php echo $code; ?></td>           </tr>

                    <tr>
                  <th class="text-left">Name</th>
                   <td class="text-left"><?php echo $coach_name; ?></td>           </tr>

                <tr>
                  <th class="text-left">Role</th>
                   <td class="text-left"><?php echo $role; ?></td>           </tr>
                    
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
                  <th class="text-left">Activity</th>
                   <td class="text-left"><?php echo $activity_id; ?></td>           
                 </tr>
                      
                     <tr>
                  <th class="text-left">Location</th>
                   <td class="text-left"><?php echo $location_id; ?></td>           </tr>
                     <tr>
                  <th class="text-left">Years of Experience</th>
                   <td class="text-left"><?php echo  $experience;  ?></td>           </tr>
                    <tr>
                  <th class="text-left">Address</th>
                   <td class="text-left"><?php echo $address; ?></td>           </tr>
                     <tr>
                  <th class="text-left">City</th>
                   <td class="text-left"><?php echo $city; ?></td>           </tr>
                     <tr>
                  <th class="text-left">State</th>
                   <td class="text-left"><?php echo  $state; ?></td>           </tr>
                     <tr>
                  <th class="text-left">Country</th>
                   <td class="text-left"><?php echo $country; ?></td>           </tr>
                     <tr>
                  <th class="text-left">Postal Code</th>
                   <td class="text-left"><?php echo  $postal_code;  ?></td>           </tr>
                     <tr>
                  <th class="text-left">Phone 1</th>
                   <td class="text-left"><?php echo $phone1; ?></td>           </tr>

                     <tr>
                  <th class="text-left">Email</th>
                   <td class="text-left"><?php echo $email_id; ?></td>           </tr>
                     <tr>
                  <th class="text-left">Arab id</th>
                   <td class="text-left"><?php echo $emirates_id; ?></td>           </tr>
                     <tr>
                  <th class="text-left">Date of Expire</th>
                   <td class="text-left"><?php if($expiry_date){ echo date("d/m/Y", strtotime("$expiry_date")); } ?></td>           </tr>
                     <tr>
                  <th class="text-left">Status</th>
                   <td class="text-left"><?php echo $status; ?></td>           </tr>
                     <tr>
                  <th class="text-left">Photo</th>
                   <td class="text-left">
                    <?php if($passport_size_image != ""){ ?>
                    <a href="<?php echo base_url().'assets/'.$passport_size_image; ?>">
                    <img src="<?php echo base_url().'assets/'.$passport_size_image; ?>" style="width:20px; height:20px;  vertical-align: middle"/>View here</a>
                  <?php } else { echo "--"; } ?>
                    </td>           
                  </tr>
                     <tr>
                  <th class="text-left">Passport Image</th>
                   <td class="text-left">
                    <?php if($passport_image != ""){ ?>
                     <a href="<?php echo base_url().'assets/'.$passport_image; ?>">
                      <img src="<?php echo base_url().'assets/'.$passport_image; ?>" style="width:20px; height:20px;  vertical-align: middle"/>View here</a>
                      <?php } else { echo "--"; } ?>
                    </td>           
                  </tr>

                     <tr>
                  <th class="text-left">Visa Image</th>
                   <td class="text-left">
                    <?php if($visa_image != ""){ ?>
                      <a href="<?php echo base_url().'assets/'.$visa_image; ?>">
                      <img src="<?php echo base_url().'assets/'.$visa_image; ?>" style="width:20px; height:20px;  vertical-align: middle"/>View here</a>
                      <?php } else { echo "--"; } ?>
                    </td>           
                  </tr>
                     <tr>
                  <th class="text-left">Emirates Id Image</th>
                   <td class="text-left">
                    <?php if($emirates_id_image != ""){ ?>
                      <a href="<?php echo base_url().'assets/'.$emirates_id_image; ?>">
                      <img src="<?php echo base_url().'assets/'.$emirates_id_image; ?>" style="width:20px; height:20px;  vertical-align: middle"/>View here</a>
                    <?php } else { echo "--"; } ?>
                    </td>           
                  </tr>
                  <tr>
                  <th class="text-left">Police Verification Image</th>
                   <td class="text-left">
                    <?php if($police_verification_image != ""){ ?>
                    <a href="<?php echo base_url().'assets/'.$police_verification_image; ?>">
                                <img src="<?php echo base_url().'assets/'.$police_verification_image; ?>" style="width:20px; height:20px;  vertical-align: middle"/>View here</a>
                    <?php } else { echo "--"; } ?>
                  </td>           
                  </tr>
                  <tr>
                  <th class="text-left">Municipality Certificate</th>
                   <td class="text-left">
                    <?php if($municipality_certificate_image != ""){ ?>
                     <a href="<?php echo base_url().'assets/'.$municipality_certificate_image; ?>">
                      <img src="<?php echo base_url().'assets/'.$municipality_certificate_image; ?>" style="width:20px; height:20px;  vertical-align: middle"/>View here</a>
                      <?php } else { echo "--"; } ?>
                    </td>           
                  </tr>
                     <tr>
                  <th class="text-left">Experience Certificate Image</th>
                   <td class="text-left">
                    <?php if($experience_certificate_image != ""){ ?>
                    <a href="<?php echo base_url().'assets/'.$experience_certificate_image; ?>">
                                <img src="<?php echo base_url().'assets/'.$experience_certificate_image; ?>" style="width:20px; height:20px;  vertical-align: middle"/>View here</a>
                    <?php } else { echo "--"; } ?>
                  </td>           
                </tr>
                <tr>
                  <th class="text-left">Created At</th>
                  <td class="text-left"><?php  echo date("d-m-Y h-i A", strtotime($created_at)); ?></td>           
                </tr>

                <tr>
                  <th class="text-left">Updated At</th>
                  <td class="text-left"><?php if(!$updated_at) { echo '-'; } else  { echo date("d/m/Y H:i", strtotime($updated_at)); } ?></td>       
                </tr>
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
</body>
</html>





         
            





