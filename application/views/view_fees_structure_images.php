<?php require_once 'config.php'; ?>
 <?php $this->load->view('includes/header3'); ?>
 <html>
 <body>
 <head>
  <title>Fees Structure Image</title>
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
            <h3 class="content-header-title" style="color: green">Maintenance</h3>
            <div class="row breadcrumbs-top">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.html">Maintenance</a>
                  </li>
                  <li class="breadcrumb-item"><a href="#">Fees Structure Image</a>
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
            <li> <a href="<?php echo site_url('index.php/fees_structure_images'); ?>" class="btn btn-primary"   ><b>Back</b></a></li>
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
        <h4 class="card-title">Fees Structure Image Details</h4>
       
      </div>
      <div class="card-content collapse show">
         <div class="table-responsive">
            <table class="table mb-0">
              <thead>
                <tr>
                  <th style="text-align: center">ID</th>
                                              <th style="text-align: center">Activity</th>
                                              <th style="text-align: center">Description</th>
                                               <th style="text-align: center">Image</th>
                                              <th style="text-align: center">Created At</th>
                                              <th style="text-align: center">Updated At</th>
                
                  
                </tr>
              </thead>
              <tbody>
               
                <tr>
                  <td style="text-align: center"><?php echo $id;?></td>
                  <td style="text-align: center"><?php 
                              $osql3= "select * from games where game_id=".$activity_id;                              
                              $oexe3 = mysqli_query( $con, $osql3 );
                              $row3 = mysqli_fetch_assoc( $oexe3 );

                              echo $row3['game']; ?></td>
                    <td style="text-align: center"><?php echo $description;?></td>
                    <td style="text-align: center">  <?php echo $fee_image_file_name; ?>
                                <img src="<?php echo base_url().'assets/Fees_structure_images/1'.$fee_image_file_name; ?>" style="width:50px; height:50px; margin-top:10px;"/></td>
                  <td style="text-align: center"><?php echo date("d-m-y-h-i-s", strtotime("$created_at")); ?></td>
                    <td style="text-align: center"><?php if($updated_at=='0000-00-00 00:00:00') { echo '-'; } else  { echo date("d/m/y-h-i-s", strtotime("$updated_at")); } ?></td>
                  
                </tr>
               
              </tbody>
            </table>
          </div>

                </div></div></div>





         
                  </div></section></div></div></div></body></html>

