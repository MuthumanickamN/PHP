<?php require_once 'config.php'; ?> <html>
 <body style="font-family: Arial, Helvetica, sans-serif;">
 <head>
  <title>Refund Request Swap Slot</title>
</head>

 <?php $this->load->view('includes/header3'); ?>

<?php displayMessage(); ?>
<div class="app-content content">
      <div class="content-overlay"></div>
      <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title" style="color: green">Parent Login</h3>
            <div class="row breadcrumbs-top">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.html">Slot Booking</a>
                  </li>
                  <li class="breadcrumb-item"><a href="#">Refund Request Swap Slot</a>
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
                    <h4 class="card-title">Refund Request Swap Slot</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                   
                </div>
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                       
                        <div class="table-responsive">
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th style="text-align:center">REG-ID</th>
        <th style="text-align:center">Name</th>
        <th style="text-align:center">Category</th>
        <th style="text-align:center">Status</th>
      
      
    </tr>
     </thead>
    <tbody>
      <?php  $username=$this->session->userdata('username');

             $osql = "select * from users where email='".$username."'";                              
             $oexe = mysqli_query( $con, $osql );
             $row= mysqli_fetch_assoc( $oexe );

             $osql1 = "select * from registrations where status='Active' and id='".$row['user_id']."'";                              
             $oexe1 = mysqli_query( $con, $osql1 );
             $row1 = mysqli_fetch_assoc( $oexe1 );
      ?>
      <tr>
        <td style="text-align:center"><?php echo  $row1['id']; ?></td>
        <td style="text-align:center"><?php echo  $row1['name']; ?></td>
        <td style="text-align:center"><?php echo 'Kid'; ?></td>
        <td style="text-align:center"><?php echo  $row1['status']; ?></td>
      
        
    </tr>
</tbody>
</table>
<br/>
<br/>
<table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th style="text-align:center">PSA-ID</th>
        <th style="text-align:center">Activity</th>
        <th style="text-align:center">Level</th>
        <th style="text-align:center">Contract</th>
        <th style="text-align:center">Change Reguest</th>
        
      
    </tr>
     </thead>
    <tbody>
       <?php 


             $username=$this->session->userdata('username');

             $osql = "select * from users where email='".$username."'";                              
             $oexe = mysqli_query( $con, $osql );
             $row= mysqli_fetch_assoc( $oexe );

             $osql1 = "select * from activity_selections where status='ACTIVE' and user_id='".$row['user_id']."'";                              
             $oexe1 = mysqli_query( $con, $osql1 );
            while( $row1 = mysqli_fetch_assoc( $oexe1 )) 
            {

              $osql2 = "select * from games where game_id='".$row1['activity_id']."'";                              
             $oexe2 = mysqli_query( $con, $osql2 );
             $row2 = mysqli_fetch_assoc( $oexe2 );


             $osql3 = "select * from game_levels where games_level_id='".$row1['level_id']."'";                              
             $oexe3 = mysqli_query( $con, $osql3 );
             $row3 = mysqli_fetch_assoc( $oexe3 ); ?>
      <tr>
        <td style="text-align:center"><?php echo  $row1['sid']; ?></td>
        <td style="text-align:center"><?php echo  $row2['game']; ?></td>
        <td style="text-align:center"><?php echo $row3['level']; ?></td>
        <td style="text-align:center"><?php echo  $row1['contract']; ?></td>
        <td style="text-align:center"><a id="myBtn" class="btn btn-info"  href="<?php echo base_url('index.php/student_profile_slot_booking/request/'.$row1['id']); ?>">Proceed</a></td>
      
        
        
    </tr>
  <?php } ?>
</tbody>
</table>
</div>
</div>
</div></div></div></div></section></div></div></div>


    









    

    </body></html>    
        