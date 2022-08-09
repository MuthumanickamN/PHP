<?php require_once 'config.php'; ?> <?php $this->load->view('includes/header3'); ?>
 <html>
 <body>
 <head>
  <title>Refund Request / Swap Slot</title>
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

<link href="<?php echo base_url().'fonts/glyphicons-halflings-regular.woff' ?>">
<link href="<?php echo base_url().'fonts/glyphicons-halflings-regular.eot' ?>">
<link href="<?php echo base_url().'fonts/glyphicons-halflings-regular.svg' ?>">
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
            <div class="row breadcrumbs-top">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.html">Academy Activities</a>
                  </li>
                  <li class="breadcrumb-item"><a href="#">Refund Request / Swap Slot</a>
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
                    <h4 class="card-title">Refund Request List</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                   
                </div>
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                       
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered dt-responsive nowrap" border="0" cellpadding="0" cellspacing="0" style="width:100%">
                                <thead>
                                    <tr>
                                           <th style="text-align: center">Registration ID</th>
                                           <th>Student Name</th>
                                            <th style="text-align: center">Activity</th>
                                            <th style="text-align: center">Parent Name</th>
                                            <th style="text-align: center">Parent Id</th>
                                            <th style="text-align: center">Parent Email</th>
                                            <th style="text-align: center">Status</th>
                                            <th style="text-align: center">Approval Status</th>
                                             <th style="text-align: center">View</th>
                                              <th style="text-align: center">Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <?php                      
                          $osql1 = "select * from activity_selections";                              
                            $oexe1 = mysqli_query( $con, $osql1 );
                             while ( $row1 = mysqli_fetch_assoc( $oexe1 ) ){  
                              
                                 $osql2 = "select game from games where game_id=".$row1['activity_id'];                              
                            $oexe2 = mysqli_query( $con, $osql2 );
                            $row2 = mysqli_fetch_assoc( $oexe2);

                            $status=$row1['status'];
                             $approval_status=$row1['approval_status'];

                            ?>

            <tr>
                 <td style="text-align: center"><?php   echo $row1['id'];  ?></td>
                <td><?php echo $row1['student_name']; ?></td>
                <td style="text-align: center"><?php echo $row2['game']; ?></td>
                <td style="text-align: center"><?php echo $row1['parent_name']; ?></td>
                 <td style="text-align: center;"><?php echo $row1['user_id'];  ?></td>
                  <td style="text-align: center"><?php echo $row1['parent_email_id']; ?></td>
                 <td style="text-align: center;"> <?php if ($status==ACTIVE) { ?> 
                   <span style="color: white; background-color: green; width: 25px; height: 15px; padding: 4px; font-size: 13px"><?php echo $row1['status'];  ?></span><?php } else { ?><span style="color: white; background-color: #FF0000; width: 25px; height: 15px; padding: 4px; font-size: 13px"><?php echo $row1['status'];  ?></span><?php } ?></td>
                 <td style="text-align: center;"><?php if ($approval_status==APPROVED) { ?> 
                   <span style="color: white; background-color: green; width: 25px; height: 15px; padding: 4px; font-size: 13px"><?php echo $row1['approval_status'];  ?></span><?php } else { ?><span style="color: white; background-color: #FF9900; width: 25px; height: 15px; padding: 4px; font-size: 13px"><?php echo $row1['status'];  ?></span><?php } ?></td>

                  <td style="text-align: center"><a type="button" style="color:white;text-decoration:none" onClick="view_games_level(<?php echo $row1['id'];?>)" class="btn btn-info fa fa-eye" data-id="4" data-toggle="tooltip" title="View">
        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a></td>
                <td style="text-align: center"><a type="button" style="color:white;text-decoration:none; line-height: 15px" class="btn btn-warning fa fa-edit" data-id="4" data-toggle="tooltip" title="Edit" href="<?php echo base_url('index.php/activity_approval/edit/'.$row1['id']); ?>">
        </a>
                    </td>

              



              
                
            </tr>
            <?php $i++; } ?>
            
                                    
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

