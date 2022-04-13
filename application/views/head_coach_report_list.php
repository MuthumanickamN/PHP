<?php  ?> <?php $this->load->view('includes/header3'); ?>
 <html>
 <body>
 <head>
  <title><?php echo ucfirst($from);?> Registration</title>
</head>
<script type="text/javascript">
    $(document).ready(function() {
    $('#example').DataTable({
        
        "fnRowCallback" : function(nRow, aData, iDisplayIndex){
                $("td:first", nRow).html(iDisplayIndex +1);
               return nRow;
            },
    });

} );

 function view_coach(id)
{
    
    window.location='<?php echo site_url('Coach/view/'); ?>'+id; 

}

 $(function () {
              
                    $('#dialog').fadeIn('slow').delay(1000).fadeOut('slow');
                });
</script>
<style type="text/css">

    .btn2
    {
        color: black;
        background-color: white;

    }
</style>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
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

<link href="font/glyphicons-halflings-regular.woff2">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>


<script src='https://www.google.com/recaptcha/api.js'></script>
<script src='https://www.google.com/recaptcha/api.js?hl=es'></script>


<div id="dialog" style="display: none; left:40%; position: fixed; background-color:#f4f5fa;
            height: 50px;line-height: 45px; width: 500px;" class="row">
            <span id="lblText" style="color: Green; top: 50px;"></span> <?php displayMessage(); ?></div>
<div class="app-content content">
      <div class="content-overlay"></div>
      <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title" style="color: green">Head Coach Credentials</h3>
            <div class="row breadcrumbs-top">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Head Coach Credentials</a>
                  </li>
                  <li class="breadcrumb-item"><a href="#"></a>
                  </li>
                 
                </ol>
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
                    <h4 class="card-title"><?php echo ucfirst($from);?> List</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                   
                </div>
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                       
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered dt-responsive nowrap" border="0" cellpadding="0" cellspacing="0" style="width:100%">
                                <thead>
                                    <tr>
                                            <th style="text-align:center">#</th>
                                            <th style="text-align:center"><?php echo ucfirst($from);?>-ID</th>
                                            <th style="text-align:center">Name</th>
                                            <th style="text-align:center">Email</th>
                                            <th style="text-align:center">Role</th>
                                            <th style="text-align:center">Mobile</th>
                                            <th style="text-align:center">Activity</th>
                                            <th style="text-align:center">Location</th>
                                            <th style="text-align: center" scope="col">Current Sign In</th>
                                            <th style="text-align: center" scope="col">Sign In Count</th>
                                            <th style="text-align: center" scope="col">Last Sign In</th>
                                            <th style="text-align: center" scope="col">Status</th>
                                           <th style="text-align:center">Actions</th>
                                     </tr>
                                </thead>
        <tbody>
        <?php      
        foreach ($coachList as $key => $coach) {
            
            $user_id = $coach['user_id'];
            
            $statusVal= '';
            if($coach['status'] == 'Active'){
                $statusVal = "<label class='btn-success'>Active</label>";
            }else{
                $statusVal = "<label class='btn-danger'>Inactive</label>";
            }
            
        $date_time=$coach['created_at'];
        $date_time1=$coach['updated_at'];

        $image1=$coach['emirates_id_image'];
        $image2=$coach['passport_size_image'];
        $image2_1=$coach['passport_image'];
        $image3=$coach['visa_image'];
        $image4=$coach['experience_certificate_image'];
        $image5=$coach['police_verification_image'];
        $image6=$coach['municipality_certificate_image'];
        ?>
        <tr>

        <td style="text-align: center"></td>
        <td style="text-align: center"><?php echo $coach['code']; ?></td>
        <td style="text-align: center"><?php echo $coach['user_name']; ?></td>
        <td style="text-align: center"><?php echo $coach['email']; ?></td>
        <td style="text-align: center"><?php echo Ucfirst($coach['role']); ?></td>
        <td style="text-align: center"><?php echo $coach['mobile']; ?></td>
        <td style="text-align: center"><?php echo $coach['activity_id']; ?></td>
        <td style="text-align: center"><?php echo $coach['location_id']; ?></td>
        <td style="text-align: center;"><?php if($coach['current_sign_in_at']) { ?><span style="display:none;"><?php echo strtotime($coach['current_sign_in_at']);?></span><?php  echo $coach['current_sign_in_at'];  } ?></td>
        <td style="text-align: center"><?php echo $coach['sign_in_count']; ?></td>
        <td style="text-align: center;"><?php if($coach['last_sign_in_at']) { ?><span style="display:none;"><?php echo strtotime($coach['last_sign_in_at']);?></span><?php  echo $coach['last_sign_in_at'];  } ?></td>
        <td style="text-align: center"><?php echo $statusVal; ?></td>
        <td align="center"><a type="button" style="color:white;text-decoration:none" onClick="view_coach(<?php echo $coach['coach_id'];?>)" class="btn btn-info fa fa-eye" data-id="4" data-toggle="tooltip" title="View">
        </a>
        
        
        <!--<a type="button" style="color:white;text-decoration:none;" class="btn btn-warning fa fa-edit" data-id="4" data-toggle="tooltip" title="Edit" href="<?php echo base_url('coach/edit/'.$coach['coach_id']); ?>">
        </a>-->
         
        <!--<a type="button" onClick="return confirm('Are you sure you want to delete?')" style="color:white;text-decoration:none;" class="btn btn-danger fa fa-trash" data-id="4" data-toggle="tooltip" title="Delete"  href="<?php echo base_url('coach/delete/'.$coach['coach_id']); ?>">
        </a>-->
        <!--<a href="<?php echo base_url().'Role_delegation?id='.$user_id;?>"  class="btn  btn-primary fa " >Assign</a>-->
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
</body>
</html>

