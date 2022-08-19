<?php //require_once 'config.php'; ?> <?php $this->load->view('includes/header3'); ?>
 <html>
 <body>
 <head>
  <title>Registration Fees</title>
</head>

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

<script type="text/javascript">
    $(document).ready(function() {
    $('#example').DataTable();
} );

 function view_registration_fees(id)
{
    
    window.location='<?php echo site_url('/Registration_fees/view/'); ?>'+id; 

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

<div id="dialog" style="display: none; left:40%; position: fixed; background-color:#f4f5fa;
            height: 50px;line-height: 45px; width: 300px;" class="row">
            <span id="lblText" style="color: Green; top: 50px;"></span> <?php displayMessage(); ?></div>
<div class="app-content content">
      <div class="content-overlay"></div>
      <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title" style="color: green">Academy Activites</h3>
            <div class="row breadcrumbs-top">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.html">Academy Activites</a>
                  </li>
                  <li class="breadcrumb-item"><a href="#">Registration Fees</a>
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
            <li> <a href="<?php echo site_url('index.php/Registration_fees/'); ?>" class="btn btn-primary"   ><b>New Registration Fees</b></a></li>
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
                    <h4 class="card-title">Registration Fees List</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                   
                </div>
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                       
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered" border="0" cellpadding="0" cellspacing="0">
                                <thead>
                                    <tr> 
                                        <!--<th style="text-align: center">REG-ID</th>-->
                                        <th style="text-align: center">Student Name</th>
                                        <th style="text-align: center">Parent-ID</th>
                                        <th style="text-align: center">Parent Name</th>
                                        <th style="text-align: center">Location</th>
                                        <th style="text-align: center">Parent Mobile</th>
                                        <th style="text-align: center">Paid Amount(AED)</th>
                                        <th style="text-align: center">Payment Type</th>
                                        <th style="text-align: center">Created at</th>
                                        <!--<th style="text-align: center">UPDATED AT</th>               
                                        
                                        <th style="text-align: center">EDIT</th>
                                        <th style="text-align: center">DELETE</th>-->
                                           
                
                                    </tr>
                                </thead>
                                <tbody>
                                <?php                        
                         
                            foreach ( $data as $key => $row1 ){  



                             $date_time=$row1['created_at'];
                             $date_time1=$row1['updated_at'];?>
            <tr>

                <!--<td style="text-align: center"><?php echo $row1['id']; ?></td> --> 
                <td><?php echo $row1['student_name']; ?></td>
                <td style="text-align: center"> <?php echo $row1['parent_code']; ?></td>
                <td><?php echo $row1['parent_name']; ?></td>
                <td style="text-align: center"> <?php echo $row1['location_id']; ?></td>
                <td style="text-align: center"><?php echo $row1['parent_contact']; ?></td>
                <td style="text-align: center"><?php echo $row1['net_amount']; ?></td>
                <td style="text-align: center"><?php echo Ucfirst($row1['pay_type']); ?></td>  
                
                <td style="text-align: center"><span style="display:none;"><?php echo strtotime($date_time);?></span><?php echo date("d/m/Y H:i", strtotime("$date_time")); ?></td>
                  <!-- <td style="text-align: center;"><?php if($date_time1=='0000-00-00 00:00:00') { echo '-'; } else  { echo date("d/m/Y H:i", strtotime("$date_time1")); } ?></td>
              
                  <!--<td style="text-align: center"><a type="button" style="color:white;text-decoration:none" onClick="view_registration_fees(<?php echo $row1['id'];?>)" class="btn btn-info fa fa-eye" data-id="4" data-toggle="tooltip" title="View"> 
        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a></td>
                <td style="text-align: center"><a type="button" style="color:white;text-decoration:none; line-height: 15px" class="btn btn-warning fa fa-edit" data-id="4" data-toggle="tooltip" title="Edit" href="<?php echo base_url('Registration_fees/edit/'.$row1['id']); ?>">
        </a>
                    </td>

                <td style="text-align: center">
                    <a type="button" onClick="return confirm('Are you sure you want to delete?')" style="color:white;text-decoration:none; line-height: 15px;" class="btn btn-danger fa fa-trash" data-id="4" data-toggle="tooltip"  href="<?php echo base_url('Registration_fees/delete/'.$row1['id']); ?>">
        </a>
                  </td>-->
          


                 
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




