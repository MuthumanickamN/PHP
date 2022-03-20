<?php require_once 'config.php'; ?> <?php $this->load->view('includes/header3'); ?>
 <html>
 <body>
 <head>
  <title>Fees Package Setup</title>
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
                  <li class="breadcrumb-item"><a href="#">Fees Package Setup</a>
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
            <li> <a href="<?php echo site_url('index.php/fees_package_setup'); ?>" class="btn btn-primary"   ><b>Back</b></a></li>
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
        <h4 class="card-title">Fees Package Setup Details</h4>
       
      </div>
      <div class="card-content collapse show">
         <div class="table-responsive">
            <table class="table mb-0">
              <thead>
                <tr>
                  <th class="text-center">Classes</th>
                   <th class="text-center">Activity</th>
                   <th class="text-center">Level</th>
                   <th class="text-center">Hour</th>
                   <th class="text-center">Fees (AED)</th>
                   <th class="text-center">Created At</th>
                   <th class="text-center">Updated At</th>
                
                  
                </tr>
              </thead>
              <tbody>
               
                <tr>
                  <td class="text-center"> <?php echo $slot_classes_min;  ?>-<?php echo $slot_classes_max;  ?></td>
                  <td class="text-center">   <?php 
                         $osql2 = "select game from games where game_id=".$game_id;                              
                            $oexe2 = mysqli_query( $con, $osql2 );
                            $row2 = mysqli_fetch_assoc( $oexe2);
                            echo $row2['game']; ?></td>
                    <td class="text-center">    <?php 
                        $osql4 = "select level from game_levels where games_level_id=".$level_id;                              
                            $oexe4 = mysqli_query( $con, $osql4 );
                            $row4 = mysqli_fetch_assoc( $oexe4 );
                        echo $row4['level']; ?></td>
                         <td class="text-center">  <?php echo $hour; ?></td>
                    <td class="text-center">  <?php echo $fees; ?></td>
                  <td class="text-center"><?php echo date("d-m-y-h-i-s", strtotime("$created_at")); ?></td>
                   <td class="text-center"><?php if($updated_at=='0000-00-00 00:00:00') { echo '-'; } else  { echo date("d-m-y-h-i-s", strtotime("$updated_at")); } ?></td>
                  
                </tr>
               
              </tbody>
            </table>
          </div>

                </div></div></div>





         
                  </div></section></div></div></div></body></html>




