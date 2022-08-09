<?php  ?> <?php $this->load->view('includes/header3'); ?>
 <html>
 <body>
 <head>
  <title>Admin Registration</title>
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
function ChangePassword(id){
        //alert(id);
        jQuery('#id_value').val(id);
    }
 function view_admin(id, add_from)
{
    if(add_from == 'superadmin') {
        window.location='<?php echo site_url('Admin/superadmin_view/'); ?>'+id; 
    }
    else
    {
        window.location='<?php echo site_url('Admin/view/'); ?>'+id;
    }

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
            <h3 class="content-header-title" style="color: green">Academy Activities</h3>
            
          </div>
          <div class="content-header-right col-md-6 col-12">
            <div class="media width-250 float-right">
              <media-left class="media-middle">
                <div id="sp-bar-total-sales"></div>
              </media-left>
              <div class="media-body media-right text-right">
                 <ul class="list-inline mb-0">
             
            <li> <a href="<?php echo site_url('Admin?add=').$from; ?>" class="btn btn-primary"   ><b>New <?php echo ucfirst($from);?></b></a></li>
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
                    <h4 class="card-title">Admin List</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                   
                </div>
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                       
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered dt-responsive nowrap" border="0" cellpadding="0" cellspacing="0" style="width:100%">
                                
                           <thead>
                                    <tr>
                                        
                                        <th style="text-align: center" scope="col">#</th>
                                        <th style="text-align: center" scope="col">User ID</th>
                                        <th style="text-align: center" scope="col">Name</th>
                                        <th style="text-align: center" scope="col">Email</th>
                                        <th style="text-align: center" scope="col">Role</th>
                                        <th style="text-align: center" scope="col">Mobile</th>
                                        <th style="text-align: center" scope="col">Current Sign In</th>
                                        <th style="text-align: center" scope="col">Sign In Count</th>
                                        <th style="text-align: center" scope="col">Last Sign In</th>
                                        <th style="text-align: center" scope="col">Status</th>
                                        <th style="text-align: center" scope="col">Action</th>
                                    </tr>
                                </thead>
                                                                              
                               
        <tbody>
        <?php      
        foreach ($adminList as $key => $coach) {
            $user_id = $coach['user_id'];
            $statusVal= '';
            if($coach['status'] == 'Active'){
                $statusVal = "<label class='btn-success'>Active</label>";
            }else{
                $statusVal = "<label class='btn-danger'>Inactive</label>";
            }
        ?>
        <tr>

        <td style="text-align: center"></td>
        <td style="text-align: center"><?php echo $coach['code']; ?></td>
        <td style="text-align: center"><?php echo $coach['user_name']; ?></td>
        <td style="text-align: center"><?php echo $coach['email']; ?></td>
        <td style="text-align: center"><?php echo ucfirst($coach['role']); ?></td>
        
        <td style="text-align: center"><?php echo $coach['mobile']; ?></td>
        <td style="text-align: center;"><?php if($coach['current_sign_in_at']) { ?><span style="display:none;"><?php echo strtotime($coach['current_sign_in_at']);?></span><?php  echo $coach['current_sign_in_at'];  } ?></td>
        <td style="text-align: center"><?php echo $coach['sign_in_count']; ?></td>
        <td style="text-align: center;"><?php if($coach['last_sign_in_at']) { ?><span style="display:none;"><?php echo strtotime($coach['last_sign_in_at']);?></span><?php  echo $coach['last_sign_in_at'];  } ?></td>
        <td style="text-align: center"><?php echo $statusVal; ?></td>
        <td align="center" style="display:flex;border:none"><a type="button" style="color:white;text-decoration:none" onClick="view_admin(<?php echo $coach['admin_id'];?>, '<?php echo $from;?>' )" class="btn btn-info fa fa-eye" data-id="4" data-toggle="tooltip" title="View">
        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
        
        <?php if($from=='superadmin') { ?>
        <a type="button" style="color:white;text-decoration:none;" class="btn btn-warning fa fa-edit" data-id="4" data-toggle="tooltip" title="Edit" href="<?php echo base_url('admin/superadmin_edit/'.$coach['admin_id']); ?>">
        </a>
        
        <!--<a type="button" onClick="return confirm('Are you sure you want to delete?')" style="color:white;text-decoration:none;" class="btn btn-danger fa fa-trash" data-id="4" data-toggle="tooltip" title="Delete"  href="<?php echo base_url('admin/superadmin_delete/'.$coach['admin_id']); ?>">
        </a> -->
        <a data-toggle="modal" data-target="#update-password" href="javascript:void(0);" title="Change Password" class="change-password-details ml-1 btn btn-warning fa fa-lock" onclick="ChangePassword(<?php echo $coach['user_id'];?>)"  data-userid="<?php echo $coach['user_id'];?>"></a>
        <?php } else { ?>
        <a type="button" style="color:white;text-decoration:none;" class="btn btn-warning fa fa-edit" data-id="4" data-toggle="tooltip" title="Edit" href="<?php echo base_url('admin/edit/'.$coach['admin_id']); ?>">
        </a>
        
        <!--<a type="button" onClick="return confirm('Are you sure you want to delete?')" style="color:white;text-decoration:none;" class="btn btn-danger fa fa-trash" data-id="4" data-toggle="tooltip" title="Delete"  href="<?php echo base_url('admin/delete/'.$coach['admin_id']); ?>">
        </a>-->
        <a data-toggle="modal" data-target="#update-password" href="javascript:void(0);" title="Change Password" class="change-password-details ml-1  btn btn-warning fa fa-lock" onclick="ChangePassword(<?php echo $coach['user_id'];?>)"  data-userid="<?php echo $coach['user_id'];?>"></a>
         
         <?php } ?>
        <a href="<?php echo base_url().'Role_delegation?id='.$user_id;?>"  class="btn  btn-primary fa " >Assign</a>
       
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
<?php 
$this->load->view('users/popup/password');
  
?>
<!--<script
  src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"
  integrity="sha256-hlKLmzaRlE8SCJC1Kw8zoUbU8BxA+8kR3gseuKfMjxA="
  crossorigin="anonymous"></script>-->
<script src="<?php echo site_url(); ?>/assets/js/users.js"></script>
