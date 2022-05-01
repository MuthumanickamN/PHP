<?php require_once 'config.php'; ?> <?php $this->load->view('includes/header3'); ?>
 <head>
  <title>Student Registration</title>
</head>
<style rel="stylesheet" src="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css"></style>

<style rel="stylesheet" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"></style>
<style rel="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"></style>
<style rel="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css" ></style>
<style rel="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css"></style>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap4.min.js"></script>

<script type="text/javascript" src="js/script.js"></script>
<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
    $('#example').DataTable();

} );

 function view_student(id){
    window.location='<?php echo site_url('index.php/student/view/'); ?>'+id; 
}

$(function () {          
    $('#dialog').fadeIn('slow').delay(1000).fadeOut('slow');
});
</script>
<style type="text/css">
.btn2{
    color: black;
    background-color: white;
}
</style>

<div id="dialog" style="display: none; left:40%; position: fixed; background-color:#f4f5fa; height: 50px;line-height: 45px; width: 500px;" class="row">
    <span id="lblText" style="color: Green; top: 50px;"></span> <?php displayMessage(); ?>
</div>
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
            <li> <a href="<?php echo site_url('index.php/student'); ?>" class="btn btn-primary"   ><b>New Student</b></a></li>
          </ul>
                
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
<table id="example" class="table table-striped table-bordered dt-responsive nowrap" border="0" cellpadding="0" cellspacing="0" style="width:100%">
    <thead>
        <tr>
        <th>REG-ID</th>
        <th>NAME</th>
        <th>DATE OF BIRTH</th>
        <th>AGE</th>
        <th>GENDER</th>
        <th>NATIONALITY</th>
        <th>SCHOOL NAME</th>
        <th>SIBLING NAME</th>
        <th>SIBLING REG NO</th>
        <th>FATHER'S NAME</th>
        <th>FATHER'S CONTACT</th>
        <th>FATHER'S E-MAIL</th>
        <th>MOTHER'S NAME</th>
        <th>MOTHER'S CONTACT</th>
        <th>MOTHER'S E-MAIL</th>
        <th>STUDENT'S E-MAIL</th>
        <th>ADDRESS 1</th>
        <th>ADDRESS 2</th>
        <th>CITY</th>
        <th>STATE</th>
        <th>COUNTRY</th>
        <th>POSTAL CODE</th>
        <th>STUDENT'S EMIRATES ID</th>
        <th>DATE OF ISSUE</th>
        <th>DATE OF EXPIRY</th>
        <th>T-SHIRT SIZE</th>
        <th>SESSION/MONTH</th>
        <th>COACH</th>
        <th>STUDENT'S IMAGE</th>
        <th>STUDENT'S EMIRATES-ID</th>
        <th>STUDENT'S PASSPORT</th>
        <th>STUDENT'S VISA-PAGE</th>
        <th>SPONSOR'S EMIRATES-ID</th>
        <th>SPONSOR'S PASSPORT</th>
        <th>SPONSOR'S VISA-PAGE</th>              
        <th>STATUS</th>
        <th>APPROVAL STATUS</th>
        <th>ACTION</th>                                   
    </tr>
    </thead>
    <tbody>
        <?php                        
        foreach($studentList as $key=> $studList){
         $date_time=$studList['created_at'];
         $date_time1=$studList['updated_at'];
         $dob=$studList['dob'];
         $issue=$studList['emirates_id_issue'];
         $expiry=$studList['emirates_id_expiry'];
         ?>
        <tr>
        <td style="text-align: center"><?php echo $studList['sid']; ?></td>
        <td><?php echo $studList['name']; ?></td>
        <td style="text-align: center"><?php echo date("d-m-Y", strtotime("$dob"));  ?></td>
        <td style="text-align: center"><?php echo $studList['age']; ?></td>
        <td style="text-align: center"><?php echo $studList['gender']; ?></td>
        <td style="text-align: center"><?php echo $studList['nationality']; ?></td>
        <td><?php echo $studList['school_name']; ?></td>
        <td><?php echo $studList['sibling_name']; ?></td>
        <td style="text-align: center"><?php echo $studList['sibling_reg_no']; ?></td>
        <td><?php echo $studList['father_name']; ?></td>
        <td style="text-align: center"><?php echo $studList['father_contact']; ?></td>
        <td><?php echo $studList['father_email']; ?></td>
        <td><?php echo $studList['mother_name']; ?></td>
        <td style="text-align: center"><?php echo $studList['mother_contact']; ?></td>    
        <td><?php echo $studList['mother_email']; ?></td>
        <td><?php echo $studList['student_email']; ?></td>
        <td><?php echo $studList['address_1']; ?></td>
        <td><?php echo $studList['address_2']; ?></td>
        <td style="text-align: center"><?php echo $studList['city']; ?></td>
        <td style="text-align: center"><?php echo $studList['state']; ?></td>
        <td style="text-align: center"><?php echo $studList['country']; ?></td>
        <td style="text-align: center"><?php echo $studList['postal_code']; ?></td>
        <td style="text-align: center"><?php echo $studList['emirates_id']; ?></td>
        <td style="text-align: center"><?php echo date("d-m-Y", strtotime("$issue"));  ?></td>    
        <td style="text-align: center;"><?php if($expiry=='') { echo '-'; } else  {  echo date("d-m-Y", strtotime("$expiry")); }?></td>    
        <td style="text-align: center"><?php echo $studList['t_shirt_size']; ?></td>
        <td style="text-align: center"><?php echo $studList['session_month']; ?></td>
        <td><?php echo $studList['coach']; ?></td>
        <td style="text-align: center">
            <?php $image1=$studList['image_file_name']; 
                if($image1 != ''){ ?> 
                <a href="<?php echo base_url().'assets/Student_images/1/1'.$studList['image_file_name']; ?>">
                <img src="<?php echo base_url().'assets/Student_images/1/1'.$studList['image_file_name']; ?>" style="width:20px; height:20px;  vertical-align: middle"/>View here
                </a>
            <?php } else{ echo "--"; }?>
        </td>
        <td style="text-align: center"><?php echo $studList['emirates_id']; ?></td>
        <td style="text-align: center">
            <?php $image2=$studList['student_passport_file_name']; 
                if($image2 != ''){?> 
                <a href="<?php echo base_url().'assets/Student_images/1/1'.$studList['student_passport_file_name']; ?>">
                <img src="<?php echo base_url().'assets/Student_images/1/1'.$studList['student_passport_file_name']; ?>" style="width:20px; height:20px;  vertical-align: middle"/>View here
                </a>
            <?php } else{ echo "--"; }?>
        </td>
        <td style="text-align: center">
            <?php $image3=$studList['student_visapage_file_name'];  
                if($image3 != ''){?> 
                <a href="<?php echo base_url().'assets/Student_images/1/1'.$studList['student_visapage_file_name']; ?>">
                <img src="<?php echo base_url().'assets/Student_images/1/1'.$studList['student_visapage_file_name']; ?>" style="width:20px; height:20px;  vertical-align: middle"/>View here
                </a>
            <?php } else{ echo "--"; }?>
            </td>    
        <td style="text-align: center"><?php echo $studList['emirates_id']; ?></td>
        <td style="text-align: center">
            <?php $image4=$studList['sponsor_passport_file_name']; 
            if($image4 != ''){ ?> 
                <a href="<?php echo base_url().'assets/Student_images/1/1'.$studList['sponsor_passport_file_name']; ?>">
                <img src="<?php  echo base_url().'assets/Student_images/1/1'.$studList['sponsor_passport_file_name'];  ?>" style="width:20px; height:20px;  vertical-align: middle"/>View here</a>
            <?php } else{ echo "--"; }?>
        </td>
        <td style="text-align: center">
            <?php $image5=$studList['sponsor_visapage_file_name']; 
            if($image5 != ''){ ?> 
                <a href="<?php echo base_url().'assets/Student_images/1/1'.$studList['sponsor_visapage_file_name']; ?>">
                <img src="<?php echo base_url().'assets/Student_images/1/1'.$studList['sponsor_visapage_file_name']; ?>" style="width:20px; height:20px;  vertical-align: middle"/>View here
                </a>
            <?php } else{ echo "--"; }?>
            </td>    
        <td style="text-align: center">
            <?php if($studList['status'] == 'Inactive'){?>
                <label style="padding: 2px 8px; " class="btn-danger"><?php echo $studList['status'];?></label>
                <?php }else { ?>
                <label style="padding: 2px 8px; " class="btn-success"><?php echo $studList['status'];?></label>
            <?php } ?>
        </td>
        <td style="text-align: center">
            <?php if($studList['approval_status'] == 'Pending'){?>
                <label style="padding: 2px 8px; " class="btn-warningī"><?php echo $studList['approval_status'];?></label>
                <?php }else { ?>
                <label style="padding: 2px 8px; " class="btn-success"><?php echo $studList['approval_status'];?></label>
            <?php } ?>
        </td>

        <td align="center">
            <a type="button" style="color:white;text-decoration:none" onClick="view_student(<?php echo $studList['id'];?>)" class="btn btn-info fa fa-eye" data-id="4" data-toggle="tooltip" title="View">
                <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
            </a>

            <a type="button" style="color:white;text-decoration:none;" class="btn btn-warning fa fa-edit" data-id="4" data-toggle="tooltip" title="Edit" href="<?php echo base_url('index.php/student/edit/'.$studList['id']); ?>">
            </a>
            <a type="button" onClick="return confirm('Are you sure you want to delete?')" style="color:white;text-decoration:none;" class="btn btn-danger fa fa-trash" data-id="4" data-toggle="tooltip"  href="<?php echo base_url('index.php/student/delete/'.$studList['id']); ?>">
            </a>
        </td>    
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

