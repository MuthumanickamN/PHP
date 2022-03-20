<?php require_once 'config.php'; ?> <?php $this->load->view('includes/header3'); ?>
 <html>
 <body>
 <head>
  <title>Slot Refund Approval</title>
</head>
<script type="text/javascript">
    $(document).ready(function() {
    $('#example').DataTable();

} );

 function view_student(id)
{
    
    window.location='<?php echo site_url('index.php/student/view/'); ?>'+id; 

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
            height: 50px;line-height: 45px; width: 300px;" class="row">
            <span id="lblText" style="color: Green; top: 50px;"></span> <?php displayMessage(); ?></div>
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
                  <li class="breadcrumb-item"><a href="#">Slot Refund Approval</a>
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
                    <h4 class="card-title">Slot Refund Approval List</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                   
                </div>
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                       
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered dt-responsive nowrap" border="0" cellpadding="0" cellspacing="0" style="width:200%">
                                <thead>
                                    <tr>
                                            <th style="text-align: center;">Tkt No</th>
                                            <th style="text-align: center;">Reg ID</th>
                                            <th style="text-align: center;">PSA ID</th>
                                            <th style="text-align: center;">Name</th>
                                            <th style="text-align: center;">Bkid</th>
                                            <th style="text-align: center;">Activity</th>
                                            <th style="text-align: center;">Location</th>
                                            <th style="text-align: center;">Booking Date</th>
                                            <th style="text-align: center;">Coach</th>
                                            <th style="text-align: center;">Reason</th>
                                            <th style="text-align: center;">Approval Status</th>
                                            <th style="text-align: center;">View</th>
                                            <th style="text-align: center;">Edit</th>
                                                                      </tr>
                                </thead>
                                <tbody>
                                   <?php                        
                          $osql1 = "select * from refund_fees";                              
                            $oexe1 = mysqli_query( $con, $osql1 );
                             while ( $row1 = mysqli_fetch_assoc( $oexe1 ) ){  



                             $date_time=$row1['created_at'];
                             $date_time1=$row1['updated_at'];
                             $dob=$row1['dob'];
                             $issue=$row1['emirates_id_issue'];
                             $expiry=$row1['emirates_id_expiry'];
                             ?>
            <tr>

                <td style="text-align: center"><?php echo $row1['id']; ?></td>
                <td><?php echo $row1['name']; ?></td>
                <td style="text-align: center"><?php echo date("d-m-y", strtotime("$dob"));  ?></td>
                <td style="text-align: center"><?php echo $row1['age']; ?></td>
                <td style="text-align: center"><?php echo $row1['gender']; ?></td>
                <td style="text-align: center"><?php echo $row1['nationality']; ?></td>
                <td><?php echo $row1['school_name']; ?></td>
                <td><?php echo $row1['sibling_name']; ?></td>
                <td style="text-align: center"><?php echo $row1['sibling_reg_no']; ?></td>
                <td><?php echo $row1['father_name']; ?></td>
                <td style="text-align: center"><?php echo $row1['father_contact']; ?></td>
               

                   <td align="center"><a type="button" style="color:white;text-decoration:none" onClick="view_student(<?php echo $row1['id'];?>)" class="btn btn-info fa fa-eye" data-id="4" data-toggle="tooltip" title="View">
        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a></td>
                <td style="text-align: center; line-height: 8px"><a type="button" style="color:white;text-decoration:none;" class="btn btn-warning fa fa-edit" data-id="4" data-toggle="tooltip" title="Edit" href="<?php echo base_url('index.php/student/edit/'.$row1['id']); ?>">
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
</body>
</html>

